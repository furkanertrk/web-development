<?php
#
#
class AddNewTeacherContr extends AddNewTeacher{

    private $fullName;
    private $tc;
    private $email;
    private $phone_number;
    private $university_no;
    private $password;
    private $faculty;
    private $department;
    private $role;


    public function  __construct($fullName, $tc, $email, $phone_number, $university_no, $password, $faculty, $department, $role){

        $this->fullName = $fullName;
        $this->tc = $tc;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->university_no = $university_no;
        $this->password = $password;
        $this->faculty = $faculty;
        $this->department = $department;
        $this->role = $role;
       

    }

    public function addTeacher(){
        $this->addNewTeacher($this->fullName, $this->tc, $this->email, $this->phone_number, $this->university_no, $this->password, $this->faculty, $this->department, $this->role);
    }
}