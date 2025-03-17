<?php 

include("../../../vendor/autoload.php");
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

$table = new UsersTable(new MySQL);

$table->insertSetting([
    "academicyear" => $_POST['academicyear'],
    "closuredate" => $_POST['closuredate'],
    "finalclosuredate" => $_POST['finalclosuredate'],
]);
HTTP::redirect('/src/Admin/design/dashboard.php');