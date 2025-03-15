<?php
namespace Helpers; 
class Auth{
    static function check(){
        session_start();
        if(isset($_SESSION['user'])){
            return $_SESSION['user'];
        }

        HTTP::redirect("../src/Auth/design/login.php", "auth=fail");
    }
}