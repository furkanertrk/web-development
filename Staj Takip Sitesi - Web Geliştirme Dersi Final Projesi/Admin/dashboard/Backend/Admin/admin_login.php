<?php
session_start();
require dirname(__DIR__)."/DB/db.php";

class AdminLogin extends Dbh{
    protected function getAdmin($admin_email, $admin_password){
        $encryptedPassword = md5($admin_password);
        $sql = 'SELECT admin_password from admin WHERE admin_email=?';
        $stmt = $this->connectDB()->prepare($sql);
        //
        if(!$stmt->execute([$admin_email])){
            $stmt = null;
            $_SESSION['a_message'] = "Bir Hata Oluştu!";
            header('location: http://localhost/stajtakibi/admin_login.php?error=stmt-failed');
            exit();
        }
        //
        if($stmt->rowCount() == 0){
            $stmt = null;
            $_SESSION['a_message'] = "Kullanıcı Bulunamadı";
            header('location: http://localhost/stajtakibi/admin_login.php?error=user-not-found');
            exit();
        }
        /*
        */
        $pwd = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($encryptedPassword != $pwd[0]['admin_password']){

            $stmt = null;
            $_SESSION['a_message'] = "Girdiğiniz Parola Hatalıır!";
            header('location: http://localhost/stajtakibi/admin_login.php?error=wrong-password');
            exit();

        }
        if($encryptedPassword == $pwd[0]['admin_password']){

            $sql = 'SELECT * from admin WHERE admin_email =? AND admin_password = ?';
            $stmt = $this->connectDB()->prepare($sql);
            
            if(!$stmt->execute([$admin_email, $encryptedPassword])){

                $stmt = null;
                $_SESSION['a_message'] = "Bir Hata Oluştu!";
                header('location: http://localhost/stajtakibi/admin_login.php?error=stmt-failed');
                exit();

            }
            
            if($stmt->rowCount() == 0){

                $stmt = null;
                $_SESSION['a_message'] = "Kullanıcı Bulunamadı!";
                header('location: http://localhost/stajtakibi/admin_login.php?error=user-not-found');
                exit();

            }
            
            $admin = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['adminID'] = $admin[0]['admin_id'];
            $_SESSION['admin_fullName'] = $admin[0]['admin_full_name'];
            $stmt = null;
        }

        $stmt = null;
    }
}