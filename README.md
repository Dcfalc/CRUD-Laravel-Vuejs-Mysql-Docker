# CRUD: Laravel + Vue.js + Mysql in Docker
Small blog CRUD project, using Laravel 8.12, Vue.js 2.6.11 and Mysql 5.7.33 in Docker. In a standardized development environment.

## Prerequisites:
[Composer](https://getcomposer.org) for Laravel, [Node.js (NPM)](https://nodejs.org) for Vue.js and [Docker](https://www.docker.com).

## Back Laravel

### setup

```
cd back/
composer install
```

### Running tests
```
cd back/
./vendor/bin/phpunit
```

## Front Vue.js

### setup
```
cd front
npm install
```

## Running Docker

```
docker-compose up
```

