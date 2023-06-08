# Breeze Backend

## Installation
```bash
composer require laravel/passport --with-all-dependencies
```

## Setup
```bash
composer setup
```

## Seeding

```bash
php artisan migrate
php artisan migrate:fresh --seed  --seeder=RolesAndPermissionsSeeder
php artisan db:seed
```
