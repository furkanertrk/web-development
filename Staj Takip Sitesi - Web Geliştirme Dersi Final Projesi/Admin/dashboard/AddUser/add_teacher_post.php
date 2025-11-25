<?php

if(isset($_POST['add-teacher-btn'])){

    $new_user_id = $_POST['add-teacher-btn'];
    $connection = mysqli_connect('localhost','root','','yazgeldb');
    
    mysqli_set_charset($connection, "utf8");

    $sql = "DELETE FROM newuser WHERE user_id='$new_user_id'";
    mysqli_query($connection, $sql);

    $fullName = $_POST['fullName'];
    $tc = $_POST['tc'];
    $email =  $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $university_no = $_POST['teacher_number'];
    $password = md5($_POST['password']);
    $faculty = $_POST['faculty'];
    $department = $_POST['department'];
    $role = "ogretmen";
  
    include '../Backend/Teacher/add_new_teacher.php';
    include '../Backend/Teacher/add_new_teacher_contr.php';
  
    $add_teacher = new AddNewTeacherContr($fullName, $tc, $email, $phone_number, $university_no, $password, $faculty, $department, $role);
    $add_teacher->addTeacher();
  
    header('location: ../View/viewTeacher.php?add-teacher=success');
    exit();
}
?>