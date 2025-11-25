<?php
#
#
class AddNewStudentContr extends AddNewStudent{

    private $fullName;
    private $tc;
    private $nationality;
    private $tel;
    private $email;
    private $password;
    private $university;
    private $faculty;
    private $department;
    private $grade;
    private $university_no;
    private $address;

    public function  __construct($fullName, $tc, $nationality, $tel, $email, $password, $university, $faculty, $department, $grade, $university_no, $address){

        $this->fullName = $fullName;
        $this->tc = $tc;
        $this->nationality = $nationality;
        $this->tel = $tel;
        $this->email = $email;
        $this->password = $password;
        $this->university = $university;
        $this->faculty = $faculty;
        $this->department = $department;
        $this->grade = $grade;
        $this->university_no = $university_no;
        $this->address = $address;

    }

    public function addStudent(){
        $this->addNewStudent($this->fullName, $this->tc, $this->nationality, $this->tel, $this->email, $this->password, $this->university, $this->faculty, $this->department, $this->grade, $this->university_no, $this->address);
    }
}