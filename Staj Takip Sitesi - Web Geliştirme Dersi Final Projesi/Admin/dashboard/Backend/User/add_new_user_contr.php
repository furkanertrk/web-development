<?php
#
#
class AddNewUserContr extends AddUser{

    private $fullName;
    private $password;

    public function  __construct($fullName, $password){

        $this->fullName = $fullName;
        $this->password = $password;

    }

    public function addNewUser(){
        $this->addUser($this->fullName, $this->password);
    }
}