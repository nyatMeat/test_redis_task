FROM php:7.4-cli

# Protobuf and GRPC
ENV PROTOBUF_VERSION "3.14.0"
RUN apt-get update && apt-get install -y --no-install-recommends  libzip-dev unzip libicu-dev libonig-dev

RUN docker-php-ext-install bcmath intl opcache zip sockets mbstring

RUN pecl channel-update pecl.php.net && pecl install protobuf-${PROTOBUF_VERSION} grpc && \
                                              docker-php-ext-enable protobuf grpc

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /usr/src/app

ADD . /usr/src/app
COPY .env.sample .env

ENV APP_ENV=prod

RUN composer install --no-dev --no-scripts --no-plugins --prefer-dist --no-progress --no-interaction && \
    ./vendor/bin/rr get-binary --location /usr/local/bin && chmod +x /usr/local/bin/rr && \
    composer dump-autoload --optimize && \
    composer check-platform-reqs && \
    php bin/console cache:warmup

CMD  /usr/local/bin/rr serve -c /usr/src/app/.rr.prod.yaml
