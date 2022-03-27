FROM alpine/git:v2.32.0 as wait
ADD https://github.com/ufoscout/docker-compose-wait/releases/download/2.8.0/wait /wait

FROM composer as composer
WORKDIR /app
COPY composer.json .
COPY composer.lock .
RUN composer install --no-interaction --no-progress --no-autoloader --dev --ignore-platform-reqs
COPY . .
RUN composer dump-autoload

FROM php:8.1-fpm
RUN echo "UTC" > /etc/timezone
COPY --from=wait /wait /wait
RUN chmod +x /wait
RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql pgsql

WORKDIR /app
COPY --from=composer /app .
CMD /wait \
    && ./artisan migrate --force --seed \
    && php -S 0.0.0.0:80 -t public
