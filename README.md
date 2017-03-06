# **Shoe Distributor**
#### Jason Brown 3/3/2017

&nbsp;
## Description
An app for a shoe distributor to keep track of brands of shoes and stores that sell corresponding brands.

&nbsp;
## Database Setup
* Start MAMP.
* Make sure MAMP is running in main project directory.
* - From Terminal -
* /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot
* CREATE DATABASE shoes;
* USE shoes;
* CREATE TABLE brands (id serial PRIMARY KEY, brand_name VARCHAR (255));

* CREATE TABLE stores (id serial PRIMARY KEY, store_name VARCHAR(255));

* CREATE TABLE brands_stores (id serial PRIMARY KEY, brand_id int, store_id int);

* From http://localhost:8888/MAMP/index.php?page=phpmyadmin&language=English select shoes database.  Copy shoes and name it shoes_test.

&nbsp;
## Specifications

|Behavior - Store View | Input 1| Output|
|--------|-------|------|
| Input brand name . | "Nike" | "Nike" |
| Inputs another brand. | "Adidas" | " Nike", "Adidas" |
| Delete one brand. |'delete' "Adidas"| "Nike"|
| Delete all brands. | 'delete' | " " |
| Update brand name.| (original - adidas) "Adidas" | "Adidas" |
| Update store name. |(original - "Adidas facorey outlet") "Adidas Factory Outlet"| "Adidas Factory Outlet" |
| Find brands by store. | "Macys"| "Nike, Adidas, Timberlands"|

|Behavior - Brand View | Input 1| Output|
|--------|-------|------|
| Input store name. | "Footlocker" | "Footlocker" |
| Inputs another store. | "Payless" | " Footlocker", "Payless" |
| Delete one store. |'delete' "Payless"| "Footlocker"|
| Find stores by brand. | "Nike"| "Footlocker, Payless"|


&nbsp;
## Setup/Installation Requirements
##### _To view and use this application:_
* You will need the dependency manager Composer installed on your computer to use this application. Go to [getcomposer.org] (https://getcomposer.org/) to download Composer for free.
* Go to my [Github repository] (https://github.com/Evan-Alexander/shoe-distributor)
* Download the zip file via the green button
* Unzip the file and open the **_shoes-distributor-master_** folder
* Open Terminal, navigate to **_shoes-distributor-master_** project folder, type **_composer install_** and hit enter
* Navigate Terminal to the **_shoes-distributor-master/web_** folder and set up a server by typing **_php -S localhost:8000_**
* Type **_localhost:8000_** into your web browser
* The application will load and be ready to use!

&nbsp;
## Known Bugs
* No known bugs

&nbsp;
## Technologies Used
* PHP
* Silex
* SQL
* Apache
* Twig
* PHPUnit
* Composer
* Bootstrap
* CSS
* HTML



Copyright (c) 2017 Jason Brown

This software is licensed under the GPL license
