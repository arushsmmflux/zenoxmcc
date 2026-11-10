
FROM php:8.2-apache

RUN echo "========== APACHE MPM CHECK ==========" \
    && grep -RniE 'LoadModule.*mpm_|mpm_.*\.load' /etc/apache2 \
    && echo "========== ENABLED MODULES ==========" \
    && ls -la /etc/apache2/mods-enabled/ \
    && echo "========== APACHE CONFIG TEST ==========" \
    && apache2ctl -t

WORKDIR /var/www/html

COPY . /var/www/html/

EXPOSE 80

CMD ["apache2-foreground"]
