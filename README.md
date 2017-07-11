# YANS
Yet Another News Site

YANS is a platform for users to post articles in markdown. It allows them to give the articles away for free or charge for them.

## Run
1. Pull in dependencies: `$ composer update`
2. Set up .env: `$ cp .env.example .env`
3. In .env, fill in DB_USERNAME, DB_PASSWORD, TESTING_DB_USERNAME, TESTING_DB_PASSWORD 
4. Generate APP_KEY by running:`$ php artisan key:generate`
5. Get database up to speed by running: `$ php artisan migrate`
6. Ensure everything is working: `$ vendor/bin/phpunit`