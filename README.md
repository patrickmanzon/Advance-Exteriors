# Advance-Exteriors

## backend installation


cd backend
composer install
php artisan key:generate
cp example.env .env
modify credentials on your env
run php artisan migrate --seed

## frontend installation

install quasar on https://v1.quasar.dev/start/quasar-cli
cd frontend
npm install
quasar dev


