<?php

include("../../../vendor/autoload.php");

use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$table=new UsersTable(new MySQL);

$table->insert([
    "name" => $_POST['name'],
    "email" => $_POST['email'],
    "address" => $_POST['address'],
    'phone' => $_POST['phone'],
    "password" => $_POST['password'],
]);
HTTP::redirect("/src/Auth/design/login.php", "register=success");