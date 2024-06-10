# This file is created using the djquinten docker template (https://github.com/djquinten/docker-template)
FROM php:8-fpm-alpine

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN delgroup dialout

RUN addgroup -g 1000 --system php-framework
RUN adduser -G php-framework --system -D -s /bin/sh -u 1000 php-framework

RUN sed -i "s/user = www-data/user = php-framework/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = php-framework/g" /usr/local/etc/php-fpm.d/www.conf
RUN echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

RUN apk --no-cache add \
    icu-dev \
    libzip-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_mysql intl zip

USER php-framework

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]