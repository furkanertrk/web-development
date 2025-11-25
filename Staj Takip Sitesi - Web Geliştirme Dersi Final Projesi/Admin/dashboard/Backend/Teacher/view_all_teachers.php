<?php
require 'add_new_teacher.php';
class ViewTeachers extends AddNewTeacher{
   
    public function viewAllTeachers(){
        $result = $this->getAllTeachers();
        return $result;
    }

    public function viewAllCommission(){
        $result = $this->getAllCommission();
        return $result;
    }
}