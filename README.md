# loginsystem
A login system with email verification password reset and avatar upload.  UI by CleverTechie

before using it create your database and make sure to make changes in php files as per your database 
or heres the sql code u need to run so as to create the database(which i created)

```
CREATE DATABASE accounts;

CREATE TABLE `accounts`.`users` 
(
    `id` INT NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(50) NOT NULL,
     `last_name` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `hash` VARCHAR(32) NOT NULL,
    `active` TINYINT NOT NULL DEFAULT 0,
    `imagelocation` VARCHAR(100) NOT NULL,
PRIMARY KEY (`id`) 
);
```
