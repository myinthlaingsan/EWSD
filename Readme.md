in your pc not having composer download composer
(https://getcomposer.org/)

after download check in "cmd" => run "composer"

after this in your vs code terminal run "composer install"

"optional"
need to install |
composer install | not having composer.json =>
composer init

in psr4 add ("Helpers\\":"_classes/Helpers",
            "Libs\\":"_classes/Libs")

after this in command line run this =>
composer dump autoload