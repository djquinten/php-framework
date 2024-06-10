# This file is created using the djquinten docker template (https://github.com/djquinten/docker-template)
FROM nginx:stable-alpine

RUN delgroup dialout

RUN addgroup -g 1000 --system php-framework
RUN adduser -G php-framework --system -D -s /bin/sh -u 1000 php-framework
RUN sed -i "s/user  nginx/user php-framework/g" /etc/nginx/nginx.conf