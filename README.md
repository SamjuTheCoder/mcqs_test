

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
5. Seed initial record into the db my running: 'php artisan db:seed AdminSeeder', 'php artisan db:seed ModuleSeeder', 'php artisan db:seed RoleSeeder' 
6. Run 'php artisan serve' to run the application
7. Open http://127.0.0.1:8000/
8. Login with: admin@gmail.com and password: 12345
9. Click 'Assign Module to Role' to assign the available modules to Admin role(Create Questions, Create Options, All Exam) and Student Role (Take Exam, My Exam)
10. Click 'Assign User to Role' to assign user to a particulary role

#You can upload .sql file located in the repos

#Project is ongoing development
