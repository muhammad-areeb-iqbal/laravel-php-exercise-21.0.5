# PHP Excersise v21.0.5
A Task which have a form, on the behalf of form data should be display in the table format using their API. A graph also shown to compare the values from the display data. Also Email sent to the email account. Both side Validations (client side and server side) included. Test cases also included to make sure every thing is working fine. System using the Laravel version 9 with php version 8.1.
https://github.com/muhammad-areeb-iqbal/laravel-php-exercise-21.0.5.git


## Requirements
- Php min vesion 8.1
- Laravel version 9.
- Mysql Version 10.4.27-MariaDB

## Setup and Run Procedure

1) download repo from git hub
```
git clone https://github.com/muhammad-areeb-iqbal/laravel-php-exercise-21.0.5.git
```
2) Go to the directory
```
cd laravel-php-exercise-21.0.5
```
3) Install dependencies
```
composer install
```
4) Decrypt .env and .env.testing using key
```
php artisan env:decrypt --key=12985678906256567890424453782011
```
This will create a ".env" file.

5) We are using SendGrid Email You can create free account from https://signup.sendgrid.com/ and create an api key. Alternate you can use any email like mandgrill etc.

SET your smtp credentials here in ".env" OR use my credentials already set in .env file

```
MAIL_MAILER=smtp
MAIL_DRIVER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=your_api_username
MAIL_PASSWORD=your_api_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=YOUR_FROM_EMAIL
MAIL_SEND_LOW_STOCK=YOUR_SEND_EMAIL
MAIL_FROM_NAME=YOUR_USERNAME
```

NOTE:- I have not removed my credentials from .env file So that you can test eaisly.

6) Set DB credentials in ".env" file and Create relevant database. We are using Database queue for sending an email.

.env:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=php-exersice
DB_USERNAME=root
DB_PASSWORD=
```
7) Set DB tables using migrate commands.
```
php artisan migrate
```
8) run application
```
php artisan serve
```
9) We are sending email in the background using DB queue laravel, So for that run laravel worker in another terminal to the same project/folder path
```
php artisan queue:work --tries=3 --timeout=30
```
10) Now test the url via browser
url:
```
http://127.0.0.1:8000/historical-data
```
Try to fill the values as per given in the email as an example or your own choice
Symbol: AMRN
Start Date: 2023-04-01
End Date: 2023-04-30
Email: <your_email_address>

11) Run Test cases in laravel in another terminal
```
php artisan test
```
