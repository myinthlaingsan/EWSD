<?php
namespace Libs\Database;
use PDO;
use PDOException;

class UsersTable{
    private $db;

    public function __construct(MySQL $mysql)
    {
        $this->db = $mysql->connect();
    }
    //register
    public function insert($data){
        try{
            $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
            // Start a transaction
            $this->db->beginTransaction();

            $statement = $this->db->prepare(
                "INSERT INTO users (name,email,address,phone,password,created_at) values(:name,:email,:address,:phone,:password,NOW())"
            );
            $statement->execute($data);
            // Get the last inserted user ID
            $user_id = $this->db->lastInsertId();

            $role_id = 1;
            $statement = $this->db->prepare(
                "INSERT INTO role_user (user_id, role_id) 
                VALUES (:user_id, :role_id)"
            );
            $statement->execute([
                'user_id' => $user_id,
                'role_id' => $role_id,
            ]);
            // Commit the transaction
            $this->db->commit();
            return $this->db;
        }catch(PDOException $e){
            echo $e->getMessage();
            exit();
        }
    }

    //insert role
    public function roleinsert($data){
        try{
            $statement = $this->db->prepare(
                "INSERT INTO roles (role_name,created_at) values(:role_name,NOW())"
            );
            $statement->execute($data);
            return $this->db;
        }catch(PDOException $e){
            echo $e->getMessage();
            exit();
        }
    }

    //select all roles
    public function roleall(){
        $statement = $this->db->query(
            "SELECT * from roles"
        );
        return $statement->fetchAll();
    }

    //select users with rolename
    public function allusers(){
        $statement = $this->db->query(
            "SELECT users.*, roles.role_name from users
            LEFT JOIN role_user on users.id = role_user.user_id
            LEFT JOIN roles on role_user.role_id = roles.id"
        );
        return $statement->fetchAll();
    }

    //select user by id
    public function getuserbyId($id){
        $statement = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $statement->execute(['id' => $id]);
        return $statement->fetch(PDO::FETCH_OBJ);
    }

    // select role by id
    public function getrolebyId($id){
        $statement = $this->db->prepare("SELECT * FROM roles WHERE id = :id");
        // $statement->execute([$id]);
        $statement->execute(['id' => $id]);
        return $statement->fetch(PDO::FETCH_OBJ);
    }

    // Get user's current role
    public function getUserRole($id) {
        $statement = $this->db->prepare("
            SELECT role_id FROM role_user WHERE user_id = ?
        ");
        $statement->execute([$id]);
        return $statement->fetch(PDO::FETCH_OBJ);
    }

    // Assign or update role
    public function assignRole($user_id, $role_id) {
        // Check if user already has a role
        $existing = $this->getUserRole($user_id);

        if ($existing) {
            // Update role if it already exists
            $statement = $this->db->prepare("UPDATE role_user SET role_id = :role_id WHERE user_id = :user_id");
            return $statement->execute(['role_id' => $role_id, 'user_id' => $user_id]);
        } else {
            // Insert new role assignment
            $statement = $this->db->prepare("INSERT INTO role_user (user_id, role_id) VALUES (:user_id, :role_id)");
            return $statement->execute(['user_id' => $user_id, 'role_id' => $role_id]);
        }
    }

    //insert permissions
    public function insertpermission($data){
        try{
            $statement = $this->db->prepare(
                "INSERT INTO permissions (permission_name,created_at) values(:permission_name,NOW())"
            );
            $statement->execute($data);
            return $this->db;
        }catch(PDOException $e){
            echo $e->getMessage();
            exit();
        }
    }
    //select all permissions
    public function allpermissions(){
        $statement = $this->db->query(
            "SELECT * from permissions"
        );
        return $statement->fetchAll();
    }
    
    // select permissionbyrole
    public function getPermissionByRole($role_id){
        $statement = $this->db->prepare("
            SELECT permissions.* FROM permissions
            JOIN role_permission ON permissions.id = role_permission.permission_id
            WHERE role_permission.role_id = :role_id
        ");
        $statement->execute(['role_id' => $role_id]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    //assignpermissionRole
    public function assignPermissionToRole($role_id,$permission_id){
        $statement = $this->db->prepare("
            INSERT INTO role_permission(role_id,permission_id) VALUES (:role_id,:permission_id)
        ");
        $statement->execute(['role_id' => $role_id, 'permission_id' => $permission_id]);
    }

    //removeRolePermission
    public function removeRolePermissions($role_id){
        $statement = $this->db->prepare("DELETE FROM role_permission WHERE role_id = :role_id");
        $statement->execute(['role_id' => $role_id]);
    }

    //insert setting
    public function insertSetting($data){
        $statement = $this->db->prepare("INSERT INTO settings (academicyear,closure_date,final_closure_date,created_at,updated_at) values (:academicyear,:closuredate,:finalclosuredate,NOW(),NOW())");
        $statement->execute($data);
        return $this->db;
    }
    //select setting
    public function selectSetting(){
        $statement = $this->db->prepare("
            SELECT * FROM settings
        ");
        return $statement->fetchAll();
    }

    //select setting by id
    public function getsettingby($settingid){
        $statement = $this->db->prepare("SELECT * FROM settings WHERE setting_id = :settingid");
        // $statement->execute([$id]);
        $statement->execute(['settingid' => $settingid]);
        return $statement->fetch(PDO::FETCH_OBJ);
    }

    //insert faculty
    public function insertFaculty($data){
        try{
            $statement = $this->db->prepare(
                "INSERT INTO faculties (faculty_name,created_at) values(:faculty_name,NOW())"
            );
            $statement->execute($data);
            return $this->db;
        }catch(PDOException $e){
            echo $e->getMessage();
            exit();
        }
    }
    //login
    public function find($email,$password){
        try{
            // $statement=$this->db->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
            //use this below
            // $statement=$this->db->prepare("SELECT * FROM users WHERE email=:email");
            $statement = $this->db->prepare("
                SELECT users.*, roles.role_name 
                FROM users
                LEFT JOIN role_user ON users.id = role_user.user_id
                LEFT JOIN roles ON role_user.role_id = roles.id
                WHERE users.email = :email
            ");
            // $statement->execute(['email'=>$email,'password'=>$password]);
            $statement->execute(['email'=>$email]);

            $user = $statement->fetch();
            if($user){
                if(password_verify($password,
                $user->password)){
                    return $user;
                }
            }
            return false;
        }catch(PDOException $e){
            echo $e->getMessage();
            exit();
        } 
    }
}