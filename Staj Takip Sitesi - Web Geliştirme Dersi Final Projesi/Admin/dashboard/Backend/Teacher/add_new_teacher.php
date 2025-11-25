<?php
require dirname(__DIR__)."/DB/db.php";

class AddNewTeacher extends Dbh{

    protected function addNewTeacher($fullName, $tc, $email, $phone_number, $university_no, $password, $faculty, $department, $role){

        $sql = 'INSERT INTO teacher(ogretmen_ad_soyad, ogretmen_tc, ogretmen_mail, ogretmen_tel, ogretmen_okul_no, ogretmen_password, ogretmen_fakulte_adi, ogretmen_bolum_adi, role) VALUES(?, ?, ?,?, ?, ?,?, ?, ?)';
        $stmt = $this->connectDB()->prepare($sql);
        if(!$stmt->execute([$fullName, $tc, $email, $phone_number, $university_no, $password, $faculty, $department, $role])){
            $stmt = null;
            header('location: ../../examples/register.php?error=register-failed');
            exit();
        }
        $stmt = null;

    }

    protected function getAllTeachers(){

        $sql = 'SELECT * from teacher  WHERE role="ogretmen"';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;

    }

    protected function getAllCommission(){

        $sql = 'SELECT * from teacher WHERE role="komisyon"';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;

    }

    protected function updateTeacherInfo($fullName, $tc, $email, $phone_number, $university_no, $password, $faculty, $department, $role, $teacher_id){

        $sql = "UPDATE teacher SET ogretmen_ad_soyad=?, ogretmen_tc=?, ogretmen_mail=?, ogretmen_tel=?, ogretmen_okul_no=?, ogretmen_password=?, ogretmen_fakulte_adi=?, ogretmen_bolum_adi=?, role=? WHERE ogretmen_id=?";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute([$fullName, $tc, $email, $phone_number, $university_no, $password, $faculty, $department, $role, $teacher_id]);

    }

    protected function removeTeacher($teacher_id){
        $sql = 'DELETE FROM teacher WHERE ogretmen_id = ?';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute([$teacher_id]);
    }

}