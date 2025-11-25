<?php

if(isset($_POST['add-student-btn'])){

    $new_user_id = $_POST['add-student-btn'];
    $connection = mysqli_connect('localhost','root','','yazgeldb');
    
    mysqli_set_charset($connection, "utf8");

    $sql = "DELETE FROM newuser WHERE user_id='$new_user_id'";
    mysqli_query($connection, $sql);

    $fullName = $_POST['fullName'];
    $tc = $_POST['tc'];
    $nationality = $_POST['nationality'];
    $tel = $_POST['tel'];
    $email =  $_POST['email'];
    $password = md5($_POST['password']);
    $university = $_POST['university'];
    $faculty = $_POST['faculty'];
    $department = $_POST['department'];
    $grade = $_POST['grade'];
    $university_no = $_POST['university_no'];
    $address = $_POST['address'];

    include '../Backend/Student/add_new_student.php';
    include '../Backend/Student/add_new_student_contr.php';
  
    $add_student = new AddNewStudentContr($fullName, $tc, $nationality, $tel, $email, $password, $university, $faculty, $department, $grade, $university_no, $address);
    $add_student->addStudent();
    header('location: ../View/viewStudent.php?add-student=success');
    exit();
}
?>