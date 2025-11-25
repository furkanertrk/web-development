<?php
#
#
class AdminLoginContr extends AdminLogin{

    private $admin_email;
    private $admin_password;

    public function  __construct($admin_email, $admin_password){

        $this->admin_email = $admin_email;
        $this->admin_password = $admin_password;

    }

    public function loginAdmin(){
        $this->getAdmin($this->admin_email, $this->admin_password);
    }
}