<?php
require 'add_new_admin.php';
class UpdateAdmin extends AddNewAdmin{

    public function __construct($admin_full_name, $admin_email, $admin_password, $admin_id){
        $this->updateAdminInfo($admin_full_name, $admin_email, $admin_password, $admin_id);
    }
}