FROM php:8.2-apache

# Enable mod_rewrite
RUN a2enmod rewrite

# Copy source code to /var/www/html
COPY . /var/www/html/

# Enable .htaccess overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
