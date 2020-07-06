# ProductKit API

This project provides a web solution for manage products and kits with MercadoLivre API for get products categories. This is the back-end repositorie, the front-end: (https://github.com/ValdirJunior/product-kit-app)

## Requirements

- [x] Authentication with token received from front-end
- [x] Create, Update, Read, Delete and List Products
- [x] Create, Update, Read, Delete and List Kits
- [ ] List with pagination

## Build With

- [PHP 7.x](https://www.php.net)
- [Laravel 7.x](https://laravel.com)
- [MySQL](https://www.mysql.com)

## Run
    git clone https://github.com/ValdirJunior/product-kit-api.git
    cd product-kit-api
    composer install
    cp .env.example .env
    php artisan key:generate
    mysql> create database <name_of_your_database>
    <config your .env with database name, username and password>
    php artisan migrate
    php artisan serve
    #run the web application on fron-end repositorie(https://github.com/ValdirJunior/product-kit-app)