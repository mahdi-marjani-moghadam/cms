FROM php:8.2.1-fpm

ARG user
ARG uid


# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    git \
    curl \
    vim \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libgd-dev \
    jpegoptim optipng pngquant gifsicle \
    zip \
    sudo \
    unzip \
    npm \
    nginx \
    software-properties-common

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sysvmsg
# RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
# change php.ini
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini && \
    sed -i 's/post_max_size = 800M/upload_max_filesize = 1280M/g' /usr/local/etc/php/php.ini && \
    sed -i 's/whatever_option = 1234/whatever_option = 4321/g' /usr/local/etc/php/php.ini
    # sed -i 's/;session.save_path = "\/tmp"/session.save_path = "\/tmp"/g' /usr/local/etc/php/php.ini


# Get latest Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Add Nginx configuration
COPY ./nginx.conf /etc/nginx/conf.d/default.conf

# Copy existing application directory permissions
# RUN chown -R www-data:www-data /var/www
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Add a new user
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# RUN npm install npm@latest -g && \
# npm install n -g && \
# n latest

RUN npm config set strict-ssl false
RUN npm install
RUN npm config set strict-ssl true

# Change current user to
USER $user

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]


