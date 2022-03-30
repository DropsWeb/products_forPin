<h1>Инструкция:</h>
<p>После того, как вы выполнили git clone, нужно:</p> 
<p>1. В корне проекта создать .env и скопировать туда всё из env.example</p> 
<p>2. Установить все необходимые npm пакеты: npm install </p> 
<p>3. Развернуть docker-контейнеры. docker-compose up -d --build</p>
<p>4. Подключиться к контейнеру php-fpm и установить версии пакетов: composer install</p>
<p>5. Сгенерировать ключ APP_KEY: php artisan key:generate</p>
<p>После проделанных операций сайт будет доступен по адресу localhost</p>
# Foobar

Foobar is a Python library for dealing with word pluralization.

## Installation

Use git clone to install project.

```bash
git clone https://github.com/DropsWeb/products_forPin
```

## Usage

When you installed the project with the git clone, do this:

```
cp ./.env.example ./.env
```

```
npm install
```

```
docker-compose up -d --build
```

```
docker exec -it products_forpin_php-fpm_1 /bin/bash
```

with docker exec php-fpm:

```
composer install
```

```
php artisan key:generate
```

```
php artisan migrate
```
