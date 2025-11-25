<?php
require "add_new_teacher.php";
class RemoveTeacher extends AddNewTeacher{

    public function __construct($teacher_id){
        $this->removeTeacher($teacher_id);
    }
}