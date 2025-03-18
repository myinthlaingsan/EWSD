<?php
include("../../../vendor/autoload.php");

use Helpers\HTTP;
use Libs\Database\UsersTable;
use Libs\Database\MySQL;

$table = new UsersTable(new MySQL);
$table->insertFaculty([
    "faculty_name" => $_POST['faculty_name']
]);
HTTP::redirect('/src/Admin/design/dashboard.php');