# TestProject

TestProject for my feature work

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
