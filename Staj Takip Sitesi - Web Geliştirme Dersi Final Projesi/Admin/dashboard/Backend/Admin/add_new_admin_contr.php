<?php
#
#
class AddNewAdminContr extends AddNewAdmin{

    private $fullName;
    private $email;
    private $password;
    private $type;

    public function  __construct($fullName, $email, $password, $type){

        $this->fullName = $fullName;
        $this->email = $email;
        $this->password = $password;
        $this->type = $type;

    }

    public function addNewAdmin(){
        $this->addAdmin($this->fullName, $this->email, $this->password, $this->type);
    }
}