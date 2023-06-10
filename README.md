# Breeze Backend

## Installation

```bash
composer require laravel/passport --with-all-dependencies
```

## Setup

```bash
composer setup
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
