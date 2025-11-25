<?php

if(isset($_POST['add-admin-btn'])){

    $new_user_id = $_POST['add-admin-btn'];
    $connection = mysqli_connect('localhost','root','','yazgeldb');
    
    mysqli_set_charset($connection, "utf8");

    $sql = "DELETE FROM newuser WHERE user_id='$new_user_id'";
    mysqli_query($connection, $sql);

    $fullName = $_POST['fullName'];
    $email =  $_POST['email'];
    $password = md5($_POST['password']);
    $type = 'normal_admin';
    
    include '../Backend/Admin/add_new_admin.php';
    include '../Backend/Admin/add_new_admin_contr.php';
  
    $addAdmin = new AddNewAdminContr($fullName, $email, $password, $type);
    $addAdmin->addNewAdmin();
  
    header('location: ../View/viewAdmin.php?add-admin=success');
    exit();
}
?>