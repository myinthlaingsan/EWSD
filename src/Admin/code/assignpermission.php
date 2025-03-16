<?php
include("../../../vendor/autoload.php");
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
    $table = new UsersTable(new MySQL);
    
    // Get role_id from POST
    $role_id = $_POST['role_id'] ?? null;
    if (!$role_id) {
        die("Role ID is missing!");
    }

    // Get selected permissions
    $permissions = $_POST['permissions'] ?? [];

    // Remove existing permissions
    $table->removeRolePermissions($role_id);

    // Insert new permissions
    foreach ($permissions as $permission_id) {
        $table->assignPermissionToRole($role_id, $permission_id);
    }

    // Redirect
    HTTP::redirect("/src/Admin/design/assignpermission.php?id=" . $role_id . "&success=1");


