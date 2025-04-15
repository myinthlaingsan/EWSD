in your pc not having composer need to download composer

(https://getcomposer.org/)

after download check in "cmd" => run "composer"

after this in your vs code terminal run "composer install"

in phpmyadmin create database name with "ewsd"
(or)
import ewsd.sql to phpmyadmin

in chrome => db connect and create table
first => http://localhost/ewsd/_classes/Libs/Database/MySQL.php
(or)
import ewsd.sql no need to do this => second => http://localhost/ewsd/_classes/Libs/Database/Setup.php

login => http://localhost/ewsd/src/Auth/design/login.php

admin -> admin@gmail.com,password
manager -> manager@gmail.com, password
coordniator => coor@gmail.com , password
student => student@gmail.com, password
guest => guest@gmail.com, password

all user password are "password"

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