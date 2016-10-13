## Laravel 5 example ##
===

Application for the calculation of construction costs (https://github.com/DraganValjak/WaterrproofingApp-Laravel5).
Issuing tenders and bills, based on materials and items of work.
* [Laravel](http://laravel.com)

## Requirement

* Apache Web Server
* PHP 5.6 or above
* MySQL

### Installation ###

* `git clone  https://github.com/DraganValjak/WaterrproofingApp-Laravel5.git projectname`
* `cd projectname`
* `composer install`
* `cp .env.example .env` generate .env file
* `Change .env file`
         DB_HOST=localhost
         DB_DATABASE=databasename
         DB_USERNAME=youru-sername
         DB_PASSWORD=your-password
* `php artisan key:generate`
* `php artisan migrate --seed` to create and populate tables
* `php artisan serve` to start the app on http://localhost:8000/

### Running the Application ###

* `You can access the application from http://localhost:8000`
* `Email: admin@admin.com`
* `Password: 1234`


