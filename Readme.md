in your pc not having composer download composer
(https://getcomposer.org/)

after download check in "cmd" => run "composer"

after this in your vs code terminal run "composer install"

in phpmyadmin create database name with "ewsd" and then 

in chrome => db connect and create table
first => http://localhost/ewsd/_classes/Libs/Database/MySQL.php
second => http://localhost/ewsd/_classes/Libs/Database/Setup.php

to test register with using simple password using "password"
third register => http://localhost/ewsd../src/Auth/design/login.php

after register and login => create Role, "assign role" to user, assing permission

"optional"
need to install |
composer install | not having composer.json =>
composer init

in psr4 add ("Helpers\\":"_classes/Helpers",
            "Libs\\":"_classes/Libs")
composer require phpoffice/phpword

after this in command line run this =>
composer dump autoload