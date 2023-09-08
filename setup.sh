#!/usr/bin/env bash

php artisan migrate:fresh --seed
php artisan passport:install --force
