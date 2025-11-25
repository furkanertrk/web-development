<?php
require "add_new_student.php";
class RemoveStudent extends AddNewStudent{

    public function __construct($student_id){
        $this->removeStudent($student_id);
    }
}