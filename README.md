# Breeze Backend

## Installation
```bash
composer require laravel/passport --with-all-dependencies
```


## Seeding

```bash
php artisan migrate
php artisan db:seed --class=RoleSeeder # Seeding Roles
php artisan db:seed --class=PermissionSeeder # Seeding Permissions
```
