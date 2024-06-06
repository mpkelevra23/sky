# Использование официального базового образа PHP с предустановленным PHP-FPM
FROM php:8.2-fpm as base

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    npm \
    nodejs \
    && echo "force-unsafe-io" > /etc/dpkg/dpkg.cfg.d/02apt-speedup \
    && echo "Acquire::http {No-Cache=True;};" > /etc/apt/apt.conf.d/no-cache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Установка расширений PHP
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Установка Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Аргументы
ARG project_name

# Установка рабочей директории
WORKDIR /var/www/$project_name

# Настройка непривилегированного пользователя
# Проверяем, существует ли пользователь www-data, если нет, создаем его
RUN if id "www-data" >/dev/null 2>&1; then \
    usermod -u 1000 www-data; \
else \
    useradd -u 1000 -ms /bin/bash -g www-data www-data; \
fi


# Копирование только composer файлов для установки зависимостей
COPY --chown=www-data:www-data composer.json composer.lock /var/www/$project_name/
RUN composer install --no-scripts --no-autoloader && rm -rf /root/.composer

# Копирование остального кода приложения с изменением владельца
COPY --chown=www-data:www-data . /var/www/$project_name

# Выполнение автозагрузки Composer и оптимизация
RUN composer dump-autoload --optimize && \
    php artisan optimize

# Настройка прав доступа после копирования
RUN chown -R www-data:www-data /var/www/$project_name  \
    && find /var/www/$project_name -type d -exec chmod 775 {} \; \
    && find /var/www/$project_name -type f -exec chmod 664 {} \;


# Смена пользователя
USER www-data

# Открытие порта 9000
EXPOSE 9000

# Запуск PHP-FPM
CMD ["php-fpm"]
