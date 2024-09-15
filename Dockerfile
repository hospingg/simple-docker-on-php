# Використовуємо офіційний образ PHP
FROM php:8.2-cli

# Встановлюємо веб-сервер (наприклад, PHP's built-in server)
RUN apt-get update && apt-get install -y libzip-dev unzip \
    && docker-php-ext-install zip

# Встановлюємо директорію для коду
WORKDIR /var/www/html

# Копіюємо код у контейнер
COPY src/ /var/www/html/

# Вказуємо команду запуску сервера
CMD ["php", "-S", "0.0.0.0:8080"]
