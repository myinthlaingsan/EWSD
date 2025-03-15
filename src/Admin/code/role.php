<?php
include("../../../vendor/autoload.php");

use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$table = new UsersTable(new MySQL);
$table->roleinsert([
    "role_name" => $_POST['role_name'],
]);
HTTP::redirect('/src/Admin/design/role.php');