# HOW TO RUN BOOKHAVEN SITE
    - To build the website, just run `run_me_please.bat` using command line.
    - If it doesn't work, follow the steps bellow;
        - You need to install composer and node dependencies by running `composer install` and `npm install`
        - To build js assets, run `npm run build`
        - To add the following tables to the database you need to configure the "DB_USERNAME" and "DB_PASSWORD" in the ".env" file.
        - Once it configured, run `php artisan migrate` to migrate all tables to the database
        - After the migration succeed, run `php artisan db:seed` to insert data
        - Run `php artisan serve` to run the laravel server
