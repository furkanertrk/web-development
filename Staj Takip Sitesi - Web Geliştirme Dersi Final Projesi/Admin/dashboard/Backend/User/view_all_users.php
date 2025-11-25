<?php
require 'add_new_user.php';
class ViewUsers extends AddUser{
   
    public function viewAllUsers(){
        $result = $this->getAllUsers();
        return $result;
    }

    public function viewAllAdmins(){
        $result = $this->getAllAdmins();
        return $result;
    }

    public function viewAllStudents(){
        $result = $this->getAllStudents();
        return $result;
    }

    public function viewAllTeachers(){
        $result = $this->getAllTeachers();
        return $result;
    }

    public function viewAllCommission(){
        $result = $this->getAllCommission();
        return $result;
    }


}