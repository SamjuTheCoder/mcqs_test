

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
8. Open phpmyadmin, open the users table and set user_type=1 and active=1 default, to make the first user the admin to inherit the Admin Role
9. Log into the application
10. At this point, subsequent registered users inherit the Student Role
11. After login as admin, goto Add Module link and create the following modules routes: takeExam, myExam, viewQuestions, viewAnswer, allExam
12. Create Questions - viewQuestions	
13. Create Options-	viewAnswer	
14. Take Exam - takeExam	
15. My Exams - myExam	
16. All Exams - allExam

#Project is ongoing development
