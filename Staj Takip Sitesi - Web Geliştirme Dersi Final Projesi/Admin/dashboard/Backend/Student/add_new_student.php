<?php
require dirname(__DIR__)."/DB/db.php";

class AddNewStudent extends Dbh{

    protected function addNewStudent($fullName, $tc, $nationality, $tel, $email, $password, $university, $faculty, $department, $grade, $university_no, $address){
        $sql = 'INSERT INTO student(ogrenci_ad_soyad, ogrenci_tc, ogrenci_uyrugu, ogrenci_tel, ogrenci_mail, ogrenci_password, ogrenci_okul_adi
        , ogrenci_fakulte_adi, ogrenci_bolumm_adi, ogrenci_sinif, ogrenci_okul_no, ogrenci_address) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)';
        $stmt = $this->connectDB()->prepare($sql);
        if(!$stmt->execute([$fullName, $tc, $nationality, $tel, $email, $password, $university, $faculty, $department, $grade, $university_no, $address])){
            $stmt = null;
            header('location: ../../examples/register.php?error=register-failed');
            exit();
        }
        $stmt = null;
    }

    protected function getAllStudents(){

        $sql = 'SELECT * from student ORDER BY kullanci_id DESC';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;

    }

    protected function updateStudentInfo($fullName, $tc, $nationality, $tel, $email, $password, $university, $faculty, $department, $grade, $university_no, $address, $student_id){

        $sql = "UPDATE student SET ogrenci_ad_soyad=?, ogrenci_tc=?, ogrenci_uyrugu=?, ogrenci_tel=?, ogrenci_mail=?, ogrenci_password=?, ogrenci_okul_adi=?,
        ogrenci_fakulte_adi=?, ogrenci_bolumm_adi=?, ogrenci_sinif=?, ogrenci_okul_no=?, ogrenci_address=? WHERE kullanci_id=?";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute([$fullName, $tc, $nationality, $tel, $email, $password, $university, $faculty, $department, $grade, $university_no, $address, $student_id]);

    }

    protected function removeStudent($student_id){
        $sql = 'DELETE FROM student WHERE kullanci_id = ?';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute([$student_id]);
    }

}