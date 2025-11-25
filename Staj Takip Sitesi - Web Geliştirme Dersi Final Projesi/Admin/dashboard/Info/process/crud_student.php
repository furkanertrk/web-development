<?php

if(isset($_POST['update_student_info'])){

    $student_id = $_POST['update_student_info'];
    $fullName = $_POST['fullName'];
    $tc = $_POST['tc'];
    $nationality = $_POST['nationality'];
    $tel = $_POST['tel'];
    $email =  $_POST['email'];
    $password = $_POST['password'];
    $university = $_POST['university'];
    $faculty = $_POST['faculty'];
    $department = $_POST['department'];
    $grade = $_POST['grade'];
    $university_no = $_POST['university_no'];
    $address = $_POST['address'];

    require '../../Backend/Student/update_student.php';
    
    $update_student_info = new UpdateStudent($fullName, $tc, $nationality, $tel, $email, $password, $university, $faculty, $department, $grade, $university_no, $address, $student_id);
    
    header('Location: ../../View/viewStudent.php?update=success');
    exit();
}

if(isset($_POST['remove_student'])){

    $student_id = $_POST['remove_student'];
    
    require '../../Backend/Student/remove_student.php';
    
    $remove_student = new RemoveStudent($student_id);

    // Veritabanı bağlantısı (Veritabanı adınızın 'yazgeldb' olduğundan emin olun)
    $connection = mysqli_connect('localhost','root','','yazgeldb');
    
    $sql = "SELECT * FROM student WHERE kullanci_id='$student_id'";
    $result = mysqli_query($connection, $sql);
    
    while($row=mysqli_fetch_assoc($result)){
        $student_number = $row['ogrenci_okul_no'];
        
        // Öğrenciye ait tüm staj ve IME verilerini sil
        $tables_to_clean = [
            "staj_basvuru", "staj_takibi", "staj_belgerli", "staj_kabul_belgesi", "staj_raporu",
            "ime_basvuru", "ime_takibi", "ime_belgeleri", "ime_kabul_belgesi"
        ];

        foreach($tables_to_clean as $table) {
            $delete_sql = "DELETE FROM $table WHERE ogrenci_numarasi='$student_number'";
            mysqli_query($connection, $delete_sql);
        }
    }
    
    header('Location: ../../View/viewStudent.php?student-remove=success');
    exit();
}
?>