<?php
require dirname(__DIR__)."/DB/db.php";
#
#
class AddNewAdmin extends Dbh{

    protected function addAdmin($fullName, $email, $password, $type){
        $sql = 'INSERT INTO admin(admin_full_name, admin_email, admin_password, admin_type) VALUES(?,?,?,?)';
        $stmt = $this->connectDB()->prepare($sql);
        // $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        if(!$stmt->execute([$fullName, $email, $password, $type])){
            $stmt = null;
            header('location: ../../examples/register.php?error=register-failed');
            exit();
        }
        $stmt = null;
    }
    
    protected function getAllAdmins(){
        $sql = 'SELECT * from admin';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    protected function updateAdminInfo($fullName, $email, $password, $admin_id){
        $sql = "UPDATE admin SET admin_full_name=?,admin_email=?,admin_password=? WHERE admin_id=?";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute([$fullName, $email, $password, $admin_id]);
    }

    protected function removeAdmin($admin_id){
        $sql = 'DELETE FROM admin WHERE admin_id = ?';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute([$admin_id]);
    }
}