FROM webdevops/php-nginx:8.1

COPY . /app

WORKDIR /app

RUN composer install

ENV WEB_DOCUMENT_INDEX /public/index.php
