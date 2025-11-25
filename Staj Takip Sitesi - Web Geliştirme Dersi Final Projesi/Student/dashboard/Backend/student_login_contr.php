<?php
#
#
class StudentLoginContr extends StudentLogin{

    private $student_number;
    private $student_password;

    public function  __construct($student_number, $student_password){

        $this->student_number = $student_number;
        $this->student_password = $student_password;

    }

    public function loginStudent(){
        $this->getStudent($this->student_number, $this->student_password);
    }
}