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
container-compose build
container exec breeze_app composer setup
```

# Test

```bash
composer test
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

# Vercel Setup

- `/(.*)` forward to `/`
- `/api/(.*)` forward to `/api`

```json
{
    "routes": [
        {
            "src": "/(.*)",
            "dest": "/api/index.php"
        },
        {
            "src": "/api/(.*)",
            "dest": "/api/index.php"
        }
    ]
}
```
