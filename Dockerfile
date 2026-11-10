
FROM php:8.2-apache

# Ensure only prefork MPM is enabled
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load \
          /etc/apache2/mods-enabled/mpm_*.conf \
    && a2enmod mpm_prefork rewrite headers \
    && apache2ctl -M

# Configure Apache for Railway
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
    && sed -i 's/:80>/:8080>/' /etc/apache2/sites-available/000-default.conf

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
