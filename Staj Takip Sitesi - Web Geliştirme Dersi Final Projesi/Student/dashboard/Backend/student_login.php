<?php
session_start();
require 'db.php';

class StudentLogin extends Db{
    protected function getStudent($student_number, $student_password){
        $encryptedPassword = md5($student_password);
        $sql = 'SELECT ogrenci_password from student WHERE ogrenci_okul_no=?';
        $stmt = $this->connectDB()->prepare($sql);
        //
        if(!$stmt->execute([$student_number])){
            $stmt = null;
            $_SESSION['s_message'] = "Bir Hata Oluştu!";
            header('location: ../index.php?error');
            exit();
        }
        //
        if($stmt->rowCount() == 0){
            $stmt = null;
            $_SESSION['s_message'] = "Kullanıcı Bulunamadı";
            header('location: ../index.php?no-user-found');
            exit();
        }
        /*
        */
        $pwd = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($encryptedPassword != $pwd[0]['ogrenci_password']){

            $stmt = null;
            $_SESSION['s_message'] = "Girdiğiniz Parola Hatalıır!";
            header('location: ../index.php?error=wrong-password');
            exit();

        }
        if($encryptedPassword == $pwd[0]['ogrenci_password']){

            $sql = 'SELECT * from student WHERE ogrenci_okul_no =? AND ogrenci_password = ?';
            $stmt = $this->connectDB()->prepare($sql);
            
            if(!$stmt->execute([$student_number, $encryptedPassword])){

                $stmt = null;
                $_SESSION['s_message'] = "Bir Hata Oluştu!";
                header('location: ../index.php?error');
                exit();

            }
            
            if($stmt->rowCount() == 0){

                $stmt = null;
                $_SESSION['s_message'] = "Kullanıcı Bulunamadı!";
                header('location: ../index.php?no-user-found');
                exit();

            }
            
            $student = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['studentID'] = $student[0]['kullanci_id'];
            $_SESSION['student_fullName'] = $student[0]['ogrenci_ad_soyad'];
            $_SESSION['student_number'] = $student[0]['ogrenci_okul_no'];
            $stmt = null;
        }

        $stmt = null;
    }
}