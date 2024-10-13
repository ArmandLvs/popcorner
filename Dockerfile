# Use the official PHP image from Docker Hub
FROM php:8.1-apache

# Copy your application code into the container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Install any necessary PHP extensions (like PDO for database support)
RUN docker-php-ext-install pdo pdo_mysql

# Expose port 80 for web traffic
EXPOSE 80
