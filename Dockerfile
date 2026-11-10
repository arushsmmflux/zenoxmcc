
FROM php:8.2-apache

RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
    && sed -i 's/:80>/:8080>/' /etc/apache2/sites-available/000-default.conf \
    && a2enmod rewrite headers

WORKDIR /var/www/html

COPY . /var/www/html/

RUN printf '%s\n' \
    '<Directory /var/www/html>' \
    '    Options -Indexes' \
    '    AllowOverride All' \
    '    Require all granted' \
    '</Directory>' \
    > /etc/apache2/conf-available/ffmaxtopup.conf \
    && a2enconf ffmaxtopup \
    && chown -R www-data:www-data /var/www/html

EXPOSE 8080

CMD ["apache2-foreground"]
