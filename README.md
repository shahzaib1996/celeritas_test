## Project Setup

1. Install packages by running the following command in terminal: 
    composer install

2. Create database on mysql server using command
    CREATE DATABASE db_celeritas;

3. Generate env file
    php -r "file_exists('.env') || copy('.env.example', '.env');"

4. Generate app key by running the following command in terminal:
    php artisan key:generate

5. Update database connection settings in env file.

6. Create db tables by running the following command in terminal:
    php artisan migrate

7. Link storage using the following command:
    php artisan storage:link

