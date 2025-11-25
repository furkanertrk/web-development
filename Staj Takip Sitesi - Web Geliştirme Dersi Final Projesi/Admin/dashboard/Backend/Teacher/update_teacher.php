<?php
require 'add_new_teacher.php';
class UpdateTeacher extends AddNewTeacher{

    public function __construct($fullName, $tc, $email, $phone_number, $university_no, $password, $faculty, $department, $role, $teacher_id){
        $this->updateTeacherInfo($fullName, $tc, $email, $phone_number, $university_no, $password, $faculty, $department, $role, $teacher_id);
    }
}
