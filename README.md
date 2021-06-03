

## About MCQS TEST

This project is about MCQS Test. It is developed using laravel framework. The design pattern is based on repository design pattern using dependency injection.

## Installation Guide
1. Download the project and change directory
2. Open your phpmyadmin from locahost and create database 'mcqstest'
3. On the .evn file, set this:
/*
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=mcqstest
    DB_USERNAME=root
    DB_PASSWORD=
*/
4. Run 'php artisan migrate' to migrate all the tables
5. Run 'php artisan serve' to run the application
6. Open http://127.0.0.1:8000/
7. Click on register link, to create account
8. Open phpmyadmin, open the users table and change the user_type to 1 to make the first user the admin to inherit the Admin Role
9. Log into the application
10. At this point, subsequent registered users inherit the Student Role

#Project is ongoing development
