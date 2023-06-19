# Breeze Backend

## Installation

```bash
composer require laravel/passport --with-all-dependencies
```

## Setup

```bash
composer setup
```

## Docker Setup
```bash
docker-compose build
docker exec breeze_app composer setup
```

# Exposing Server

```bash
sudo php artisan serve --host 192.168.1.4 --port 80
sudo php artisan serve --host 0.0.0.0  --port 80
```

# PHP Server Setup

We will need to install `apfd` to handle form data in `PUT` and `PATCH` method.

```bash
pecl channel-update pecl.php.net
pecl install apfd
```

Add the following extension to the `php.ini`

```bash
extension=apfd.so
```
