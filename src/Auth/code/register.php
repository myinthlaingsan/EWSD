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
    'faculty_id' => $_POST['faculty_id'],
]);
HTTP::redirect("/src/Auth/design/login.php", "register=success");