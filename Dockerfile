# Use official PHP 8.2 image with Apache
FROM php:8.2-apache

# Copy all project files into the Apache web directory
COPY . /var/www/html/

# Enable Apache rewrite module (useful for routing)
RUN a2enmod rewrite

# Set correct permissions (optional but good practice)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
