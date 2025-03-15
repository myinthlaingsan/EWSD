<?php
include('../../../vendor/autoload.php');
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$table = new UsersTable(new MySQL);
$table->insertpermission([
    "permission_name" => $_POST['permission_name'],
]);
HTTP::redirect('/src/Admin/design/permissions.php');