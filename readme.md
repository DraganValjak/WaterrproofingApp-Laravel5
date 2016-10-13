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
* `php artisan key:generate`
* Create a new database, we suggest to use MySQL `create database izracuntroskova`.
* `php artisan migrate --seed` to create and populate tables
* `php artisan serve` to start the app on http://localhost:8000/

### Running the Application ###

* `You can access the application from http://localhost:8000`
* `Email: admin@admin.com`
* `Password: 1234`


