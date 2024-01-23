Install dependencies
composer install
npm install

Set up database
php artisan migrate

Seed the database
php artisan db:seed

Some tests
php artisan test --filter unit