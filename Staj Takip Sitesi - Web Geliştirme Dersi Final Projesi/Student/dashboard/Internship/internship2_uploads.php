<?php
session_start();
if(isset($_POST['submit'])){
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExtension = strtolower(end($fileExt));

    $allowed = array('pdf','docx','doc');

    if(in_array($fileActualExtension, $allowed)){
        if($error === 0){
            if($fileSize > 5000){
                $fileNameNew =  uniqid('', true).".".$fileActualExtension;
                $fileDestination = 'Internship2_Pdf/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                /*
                *
                *
                */
                if(isset($_SESSION['studentID'])){

                    $student_id = $_SESSION['studentID'];
                    $connection = mysqli_connect('localhost', 'root', '', 'yazgeldb');
                    $sql = "SELECT * FROM student WHERE kullanci_id='$student_id'";
                    $result = mysqli_query($connection, $sql);

                    while($row = mysqli_fetch_assoc($result)){

                        $student_number = $row['ogrenci_okul_no'];
                        $new_sql = "INSERT into staj_kabul_belgesi(staj_turu, ogrenci_numarasi, ogrenci_staj_kabul_belgesi) VALUES('staj2', '$student_number', '$fileNameNew')";
                        mysqli_query($connection, $new_sql);
                        $_SESSION['upload_file_error'] = 'Your file successfully uploaded!';
                        header('location: staj2-takibi.php?upload=success');
                        exit();
                    }
                }
                /*
                *
                *
                */
            }else{
                $_SESSION['upload_file_error'] = 'Your file is too big!'.($fileSize/1000);
                header('location: staj2-takibi.php?upload-file=unsuccessful');
                exit();
            }
        }else{
            $_SESSION['upload_file_error'] = 'YThere was an error while uploading your file! Try Again!';
            header('location: staj2-takibi.php?upload-file=unsuccessful');
            exit();
        }
    }else{
        echo 'You cannot upload files of this type!';
        $_SESSION['upload_file_error'] = 'You cannot upload files of this type! Allowed file types("pdf", "docx", "doc")';
        header('location: staj2-takibi.php?upload-file=unsuccessful');
        exit();
    }
}
if(isset($_POST['submit-again'])){
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExtension = strtolower(end($fileExt));

    $allowed = array('pdf','docx','doc');

    if(in_array($fileActualExtension, $allowed)){
        if($error === 0){
            if($fileSize > 5000){
                $fileNameNew =  uniqid('', true).".".$fileActualExtension;
                $fileDestination = 'Internship2_Pdf/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                /*
                *
                *
                */
                if(isset($_SESSION['studentID'])){

                    $student_id = $_SESSION['studentID'];
                    $connection = mysqli_connect('localhost', 'root', '', 'yazgeldb');
                    $sql = "SELECT * FROM student WHERE kullanci_id='$student_id'";
                    $result = mysqli_query($connection, $sql);

                    while($row = mysqli_fetch_assoc($result)){

                        $student_number = $row['ogrenci_okul_no'];
                        $new_sql = "UPDATE staj_kabul_belgesi SET ogrenci_staj_kabul_belgesi='$fileNameNew' WHERE ogrenci_numarasi='$student_number' AND staj_turu='staj2'";
                        mysqli_query($connection, $new_sql);
                        $_SESSION['upload_file_error'] = 'Your file successfully uploaded!';
                        header('location: staj2-takibi.php?upload=success');
                        exit();
                    }
                }
                /*
                *
                *
                */
            }else{
                $_SESSION['upload_file_error'] = 'Your file is too big!'.($fileSize/1000);
                header('location: staj1-takibi.php?upload-file=unsuccessful');
                exit();
            }
        }else{
            $_SESSION['upload_file_error'] = 'YThere was an error while uploading your file! Try Again!';
            header('location: staj1-takibi.php?upload-file=unsuccessful');
            exit();
        }
    }else{
        echo 'You cannot upload files of this type!';
        $_SESSION['upload_file_error'] = 'You cannot upload files of this type! Allowed file types("pdf", "docx", "doc")';
        header('location: staj1-takibi.php?upload-file=unsuccessful');
        exit();
    }
}
if(isset($_POST['submit-internship-docs'])){

    $staj_raporu = $_FILES['staj_raporu'];
    $staj_degerlendirme_formu = $_FILES['staj_degerlendirme_formu'];

    // @staj_raporu...
    $fileName1 = $_FILES['staj_raporu']['name'];
    $fileTmpName1 = $_FILES['staj_raporu']['tmp_name'];
    $fileSize1 = $_FILES['staj_raporu']['size'];
    $error1 = $_FILES['staj_raporu']['error'];
    $fileType1 = $_FILES['staj_raporu']['type'];
    $fileExt1 = explode('.', $fileName1);
    $fileActualExtension1 = strtolower(end($fileExt1));

    // @staj_degerlendirme_formu...
    $fileName2 = $_FILES['staj_degerlendirme_formu']['name'];
    $fileTmpName2 = $_FILES['staj_degerlendirme_formu']['tmp_name'];
    $fileSize2 = $_FILES['staj_degerlendirme_formu']['size'];
    $error2 = $_FILES['staj_degerlendirme_formu']['error'];
    $fileType2 = $_FILES['staj_degerlendirme_formu']['type'];
    $fileExt2 = explode('.', $fileName2);
    $fileActualExtension2 = strtolower(end($fileExt2));

    $allowed = array('pdf','docx','doc');

    $fileNameNew1;
    $fileNameNew2;
    if(in_array($fileActualExtension1, $allowed) and in_array($fileActualExtension2, $allowed)){
        if($error1 === 0 and $error2 === 0){
            if($fileSize1 > 5000 and $fileSize2 > 5000){

                $fileNameNew1 =  uniqid('', true).".".$fileActualExtension1;
                $fileDestination1 = 'Internship_docs/'.$fileNameNew1;
                move_uploaded_file($fileTmpName1, $fileDestination1);

                $fileNameNew2 =  uniqid('', true).".".$fileActualExtension2;
                $fileDestination2 = 'Internship_docs/'.$fileNameNew2;
                move_uploaded_file($fileTmpName2, $fileDestination2);

                if(isset($_SESSION['studentID'])){

                    $student_id = $_SESSION['studentID'];
                    $connection = mysqli_connect('localhost', 'root', '', 'yazgeldb');
                    $sql = "SELECT * FROM student WHERE kullanci_id='$student_id'";
                    $result = mysqli_query($connection, $sql);

                    while($row = mysqli_fetch_assoc($result)){

                        $student_number = $row['ogrenci_okul_no'];
                        $new_sql = "INSERT into staj_belgeleri(staj_turu, ogrenci_numarasi, staj_raporu, staj_degerlendirme_formu) VALUES('staj2', '$student_number', '$fileNameNew1','$fileNameNew2')";
                        mysqli_query($connection, $new_sql);
                        $_SESSION['upload_file_error'] = 'Your file successfully uploaded!';
                        header('location: staj1-takibi.php?upload=success');
                        exit();
                    }
                }
            }else{
                $_SESSION['upload_file_error'] = 'Your file is too big!'.($fileSize1/1000);
                header('location: staj1-takibi.php?upload-file=unsuccessful');
                exit();
            }
        }else{
            $_SESSION['upload_file_error'] = 'YThere was an error while uploading your file! Try Again!';
            header('location: staj1-takibi.php?upload-file=unsuccessful');
            exit();
        }
    }else{
        echo 'You cannot upload files of this type!';
        $_SESSION['upload_file_error'] = 'You cannot upload files of this type! Allowed file types("pdf", "docx", "doc")';
        header('location: staj1-takibi.php?upload-file=unsuccessful');
        exit();
    }
}