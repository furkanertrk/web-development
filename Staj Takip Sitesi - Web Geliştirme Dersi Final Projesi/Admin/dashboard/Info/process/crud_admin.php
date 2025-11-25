<?php

if(isset($_POST['update_admin_info'])){

    $admin_id = $_POST['update_admin_info'];
    $admin_full_name = $_POST['admin_full_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    
    require '../../Backend/Admin/update_admin.php';
    
    $update_admin_info = new UpdateAdmin($admin_full_name, $admin_email, $admin_password, $admin_id);
    
    header('Location: ../../View/viewAdmin.php?update=success');
    exit();
}

if(isset($_POST['remove_admin'])){

    $admin_id = $_POST['remove_admin'];
    
    require '../../Backend/Admin/remove_admin.php';
    
    $remove_admin = new RemoveAdmin($admin_id);
    
    header('Location: ../../View/viewAdmin.php?admin-remove=success');
    exit();

}
?>