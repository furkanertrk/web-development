<?php
if(isset($_POST['add_as_commission'])){

    $teacher_id =  $_POST['add_as_commission'];
    $fullName = $_POST['fullName'];
    $tc = $_POST['tc'];
    $email =  $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $university_no = $_POST['teacher_number'];
    $password = $_POST['password'];
    $faculty = $_POST['faculty'];
    $department = $_POST['department'];
    $role = "komisyon";
  
    require '../../Backend/Teacher/update_teacher.php';
    $update_teacher_info = new UpdateTeacher($fullName, $tc, $email, $phone_number, $university_no, $password, $faculty, $department, $role, $teacher_id);
    header('Location: ../../View/viewTeacher.php?role-update=success');
    exit();
}

if(isset($_POST['update_teacher_info'])){

    $teacher_id =  $_POST['update_teacher_info'];
    $fullName = $_POST['fullName'];
    $tc = $_POST['tc'];
    $email =  $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $university_no = $_POST['teacher_number'];
    $password = $_POST['password'];
    $faculty = $_POST['faculty'];
    $department = $_POST['department'];
    $role = "ogretmen";
  
    require '../../Backend/Teacher/update_teacher.php';
    $update_teacher_info = new UpdateTeacher($fullName, $tc, $email, $phone_number, $university_no, $password, $faculty, $department, $role, $teacher_id);
    header('Location: ../../View/viewTeacher.php?update=success');
    exit();
}

if(isset($_POST['remove_teacher'])){

    $teacher_id = $_POST['remove_teacher'];
    require '../../Backend/Teacher/remove_Teacher.php';
    $remove_teacher = new RemoveTeacher($teacher_id);
    header('Location: ../../View/viewTeacher.php?teacher-remove=success');
    exit();
}
?>