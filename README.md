<h1>Инструкция:</h>
<p>После того, как вы выполнили git clone, нужно:</p> 
<p>1. В корне проекта создать .env и скопировать туда всё из env.example</p> 
<p>2. Установить все необходимые npm пакеты: npm install </p> 
<p>3. Развернуть docker-контейнеры. docker-compose up -d --build</p>
<p>4. Подключиться к контейнеру php-fpm и установить версии пакетов: composer install</p>
<p>5. Сгенерировать ключ APP_KEY: php artisan key:generate</p>
<p>После проделанных операций сайт будет доступен по адресу localhost</p>
