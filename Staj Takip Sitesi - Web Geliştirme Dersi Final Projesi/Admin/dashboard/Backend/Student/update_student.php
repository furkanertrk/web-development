<?php
require 'add_new_student.php';
class UpdateStudent extends AddNewStudent{

    public function __construct($fullName, $tc, $nationality, $tel, $email, $password, $university, $faculty, $department, $grade, $university_no, $address, $student_id){
        $this->updateStudentInfo($fullName, $tc, $nationality, $tel, $email, $password, $university, $faculty, $department, $grade, $university_no, $address, $student_id);
    }
}