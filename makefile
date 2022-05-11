SHELL = /bin/bash
.SHELLFLAGS = -euo pipefail -c
SO := $(shell uname -s)

shell:
    docker container exec -it curso-phpunit_app_1 bash

build:
    docker-compose build --no-cache
    docker-compose exec -T redhookschool_laravel.test_1 composer install --ignore-platform-reqs --no-scripts
    docker-compose exec -T redhookschool_laravel.test_1 php artisan key:generate
    docker-compose exec -T redhookschool_laravel.test_1 php artisan config:clear
    exit

start:
    docker-compose up -d
