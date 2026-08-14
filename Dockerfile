FROM webdevops/php-nginx:8.2
ENV WEB_DOCUMENT_ROOT=/app/public
WORKDIR /app
COPY . /app
RUN composer install --no-interaction --optimize-autoloader
RUN chown -R application:application /app/storage /app/bootstrap/cache
