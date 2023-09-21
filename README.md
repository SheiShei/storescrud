# Setup

## Pre-requisite
- PHP 8
- Mysql/Postgres
- NodeJs

## Running Locally
- Install dependecies/packages using `composer install` and `npm install`
- copy .env.example and setup your db environment
- Run `php artisan ke:generate`
- Run `php artisan migrate`
- Then finally, Run both `npm run dev` and `php artisan serve` in separate terminal window
