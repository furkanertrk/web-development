<?php
require 'add_new_student.php';
class ViewStudents extends AddNewStudent{
   
    public function viewAllStudents(){
        $result = $this->getAllStudents();
        return $result;
    }
}