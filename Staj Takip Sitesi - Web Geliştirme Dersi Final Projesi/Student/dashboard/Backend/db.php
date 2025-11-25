<?php
#
#
class Db{
    protected function connectDB(){
        try{
            $username = 'root';
            $password = '';
            $dbh = new PDO('mysql:host=localhost;dbname=yazgeldb', $username, $password);
            return $dbh;
        }catch(PDOException $error){
            print 'Error: '. $error->getMessage() . '<br>';
            die();
        }
    }
}