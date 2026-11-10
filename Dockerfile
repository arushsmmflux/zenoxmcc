FROM php:8.2-apache

# Railway routes traffic to the service port configured below.
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
    && sed -i 's/<VirtualHost \\*:80>/<VirtualHost *:8080>/' /etc/apache2/sites-available/000-default.conf \
    && a2enmod rewrite headers

WORKDIR /var/www/html
COPY . /var/www/html/

# Keep Apache from exposing directory listings and allow the PHP entry pages.
RUN printf '%s\n' \
    '<Directory /var/www/html>' \
    '    AllowOverride All' \
    '    Require all granted' \
    '</Directory>' \
    > /etc/apache2/conf-available/ffmaxtopup.conf \
    && a2enconf ffmaxtopup \
    && chown -R www-data:www-data /var/www/html

EXPOSE 8080
CMD ["apache2-foreground"]
