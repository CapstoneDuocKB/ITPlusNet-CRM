@echo off
REM Set variables
set MYSQL_USER=root
set DATABASE_NAME=crm_itplusnet
set SQL_FILE=itplusnet_crm.sql

REM Create and configure the database
echo Creating and configuring database...
mysql -u %MYSQL_USER% < %SQL_FILE%

REM Run Laravel Artisan commands
echo Running migrations and seeding data...
php artisan migrate
php artisan importar:datos-api
php artisan db:seed

REM Done
echo Setup completed successfully.
pause
