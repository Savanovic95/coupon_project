# Coupon Generator

Generate all types of coupons for your application.

## Installation

Make a new folder at your local machine. Inside that folder open terminal and run following git command.

```bash
git clone https://github.com/Savanovic95/coupon_project.git
```
In your Terminal enter the root of folder where your project has been created.

Run the following command.

```bash
composer install
```
After successfully composer installation run the following command.

```bash
composer update
```

## Start app

Before you run app you must edit env variables inside .env file.

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YOUR DB NAME
DB_USERNAME=YOUR DB USERNAME
DB_PASSWORD=YOUR DB PASSWORD
```

Finally to start this app run:

```bash
php artisan serve
```
Project should be serverd on http://localhost:8000


## Running migration and seeders

To run migrations and seeders for you database, run following command.

```bash
php artisan migrate:refresh --seed 
```
## Credentials for login

```bash
email: admin@gmail.com
password: 123456
```





