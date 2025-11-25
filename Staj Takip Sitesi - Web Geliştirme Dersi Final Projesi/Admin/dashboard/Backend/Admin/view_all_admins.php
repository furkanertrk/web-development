<?php
require 'add_new_admin.php';
class ViewAdmins extends AddNewAdmin{
   
    public function viewAllAdmins(){
        $result = $this->getAllAdmins();
        return $result;
    }
}