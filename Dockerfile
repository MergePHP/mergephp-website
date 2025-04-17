FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    zip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions required by the project
RUN docker-php-ext-install zip
RUN docker-php-ext-install dom
RUN docker-php-ext-install simplexml
RUN docker-php-ext-install mbstring
RUN docker-php-ext-configure pcntl --enable-pcntl && docker-php-ext-install pcntl

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Set up entrypoint
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh
ENTRYPOINT ["docker-entrypoint.sh"]

# Install dependencies by default (can be overridden)
CMD ["composer", "install"]
