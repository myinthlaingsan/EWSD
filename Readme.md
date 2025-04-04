in your pc not having composer download composer
(https://getcomposer.org/)

after download check in "cmd" => run "composer"

after this in your vs code terminal run "composer install"

in phpmyadmin create database name with "ewsd" and then 

in chrome => db connect and create table
first => http://localhost/ewsd/_classes/Libs/Database/MySQL.php
second => http://localhost/ewsd/_classes/Libs/Database/Setup.php

to test register with using simple password using "password"
third register => http://localhost/ewsd/src/Auth/design/login.php

after register and login => create Role, "assign role" to user, assing permission

"optional"
need to install |
composer install | not having composer.json =>
composer init

in psr4 add ("Helpers\\":"_classes/Helpers",
            "Libs\\":"_classes/Libs")

need to install composer require phpmailer/phpmailer
after this in command line run this =>
composer dump autoload


To Test mail you need to have mailtrap account
login to mailtrap
Home -> email testing -> My Inbox you will get credentials data -> go to _classes/Helpers/Mailers.php -> at username password used your username,password -> run -> http://localhost/ewsd/_classes/Helpers/test.php can test mailtrap