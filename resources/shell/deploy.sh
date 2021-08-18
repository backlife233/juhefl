#!/bin/bash
cd $1
git pull
php artisan config:cache
php artisan event:cache
php artisan migrate --force
php artisan queue:restart
