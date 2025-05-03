
FROM php:8.2-apache

# Enable mod_rewrite
RUN a2enmod rewrite

# Allow .htaccess overrides for /var/www/html
RUN sed -i '/<Directory \/var\/www\/html>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Copy source code
COPY . /var/www/html/
