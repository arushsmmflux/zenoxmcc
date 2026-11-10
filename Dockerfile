
FROM php:8.2-apache

WORKDIR /var/www/html

COPY . /var/www/html/

CMD ["bash", "-lc", "echo '===== ENABLED MPM FILES ====='; ls -la /etc/apache2/mods-enabled/mpm* 2>&1; echo '===== MPM CONFIG REFERENCES ====='; grep -Rni 'LoadModule.*mpm_' /etc/apache2 2>/dev/null; echo '===== APACHE CONFIGURATION ====='; apache2ctl -t; sleep 300"]
