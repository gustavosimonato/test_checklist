FROM php:8.0.28-fpm

ARG user
ARG uid

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

ENV APP_DIR=/backspace

WORKDIR $APP_DIR

COPY . $APP_DIR

COPY --from=composer:2.5.5 /usr/bin/composer /bin/composer

RUN /bin/composer install

COPY .env.example .env

EXPOSE 3000

RUN useradd -G root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user && \
    chown -R $user:$user $APP_DIR

USER $user

ENTRYPOINT ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "3000"]