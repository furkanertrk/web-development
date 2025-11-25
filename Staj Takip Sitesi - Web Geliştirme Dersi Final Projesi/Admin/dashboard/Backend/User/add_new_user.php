<?php

require dirname(__DIR__)."/DB/db.php";
#
#
class AddUser extends Dbh{

    protected function addUser($fullName, $password){
        $sql = 'INSERT INTO newuser(user_fullName, user_password) VALUES(?,?)';
        $stmt = $this->connectDB()->prepare($sql);
        // $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        if(!$stmt->execute([$fullName, $password])){
            $stmt = null;
            header('location: ../../examples/register.php?error=register-failed');
            // header('location: http://localhost/stajtakibi/admin/dashboard/examples/register.php?error=registerfaild!');
            exit();
        }
        $stmt = null;
    }
    
    protected function getAllUsers(){
        $sql = 'SELECT * from newuser ORDER BY user_id desc';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    protected function getAllAdmins(){
        $sql = 'SELECT * from admin';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    protected function getAllStudents(){
        $sql = 'SELECT * from student';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    protected function getAllTeachers(){
        $sql = 'SELECT * from teacher';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    protected function getAllCommission(){
        $sql = 'SELECT * from teacher WHERE role="komisyon"';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


}