<?php
require "add_new_admin.php";
class RemoveAdmin extends AddNewAdmin{

    public function __construct($admin_id){
        $this->removeAdmin($admin_id);
    }
}