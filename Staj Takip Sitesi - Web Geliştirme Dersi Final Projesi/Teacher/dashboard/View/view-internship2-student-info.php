<?php 
  session_start();
  if(!isset($_SESSION['teacher_id'])){
    header('location:../../../teacher_login.php');
    exit();
  }
  
  // ONAYLA
  if(isset($_POST['staj-onayla-btn'])){
    $student_number = $_POST['staj-onayla-btn'];
    $teacher_number = $_SESSION['teacher_number'];
    $feedback = $_POST['feedback'];
    $connection = mysqli_connect('localhost','root','','yazgeldb');
    $sql = "UPDATE staj_takibi SET staj_durumu='onaylandi', geri_bildirim='Staj Basvurunuz onaylandi', ogretmen_numarasi='$teacher_number' WHERE ogrenci_numarasi='$student_number' AND staj_tur='staj2'";
    mysqli_query($connection, $sql);
    header('location: internship2_view.php');
    exit();
  }

  // REDDET / EKSİK BELGE
  if(isset($_POST['staj-red-btn'])){
    $student_number = $_POST['staj-red-btn'];
    $teacher_number = $_SESSION['teacher_number'];
    $feedback = $_POST['feedback'];
    $connection = mysqli_connect('localhost','root','','yazgeldb');
    $sql = "UPDATE staj_takibi SET staj_durumu='eksik_belge', geri_bildirim='$feedback', ogretmen_numarasi='$teacher_number' WHERE ogrenci_numarasi='$student_number' AND staj_tur='staj2'";
    mysqli_query($connection, $sql);
    header('location: internship2_view.php');
    exit();
  }

  // DEĞERLENDİRME
  if(isset($_POST['staj-degerlendirme-btn'])){
    $student_number = $_POST['staj-degerlendirme-btn'];
    $teacher_number = $_SESSION['teacher_number'];
    $feedback = $_POST['feedback'];
    $connection = mysqli_connect('localhost','root','','yazgeldb');
    $sql = "UPDATE staj_takibi SET staj_durumu='degerlendirme', geri_bildirim='$feedback', ogretmen_numarasi='$teacher_number' WHERE ogrenci_numarasi='$student_number' AND staj_tur='staj2'";
    mysqli_query($connection, $sql);
    header('location: internship2_view.php');
    exit();
  }

  // BELGE YÜKLEME
  if(isset($_POST['staj-belge-yukleme-btn'])){
    $student_number = $_POST['staj-belge-yukleme-btn'];
    $teacher_number = $_SESSION['teacher_number'];
    $feedback = $_POST['feedback'];
    $connection = mysqli_connect('localhost','root','','yazgeldb');
    $sql = "UPDATE staj_takibi SET staj_durumu='belge_yuklenmesi', geri_bildirim='$feedback', ogretmen_numarasi='$teacher_number' WHERE ogrenci_numarasi='$student_number' AND staj_tur='staj2'";
    mysqli_query($connection, $sql);
    header('location: internship2_view.php');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Öğretmen - Staj 2 Öğrenci Detayı</title>
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&display=swap');
    .new-font{font-family: 'IBM Plex Sans JP', sans-serif;}
    div.online-indicator { display: inline-block; width: 15px; height: 15px; margin-right: 10px; background-color: #0fcc45; border-radius: 50%; position: relative; }
    span.blink { display: block; width: 15px; height: 15px; background-color: #0fcc45; opacity: 0.7; border-radius: 50%; animation: blink 1s linear infinite; }
    @keyframes blink { 100% { transform: scale(2, 2); opacity: 0; } }
  </style>
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <a class="pt-0" href="./index.php">
        <center><img style="width: 70%; height:auto;" src="../assets/img/theme/neu-logo.png" alt="NEÜ Logo"></center>
      </a>
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <li class="nav-item active"><a class="nav-link active" href="../index.php"><i class="ni ni-tv-2 text-primary"></i> Anasayfa</a></li>
          <li class="nav-item"><a class="nav-link" href="../examples/profile.php"><i class="ni ni-single-02 text-yellow"></i> Profil</a></li>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="main-content">
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <a class="h4 mb-0 text-uppercase d-none d-lg-inline-block" href="../index.php">Anasayfa'ya Dön</a>
      </div>
    </nav>

    <div class="header pb-4 pt-2 pt-lg-8 d-flex align-items-center" style="min-height: 200px; background-color: #0F203F; border-bottom: 4px solid #D4AF37;">
        <div class="container">
        <center><h1 class="new-font mb-4 text-white">Staj 2 Öğrenci Detayları <i style="color: #D4AF37;" class="fas fa-info-circle"></i></h1></center>
            <div class="card shadow">
            <div class="card-body">
            <table class="table">
                <tbody>
                    <?php
                    if(isset($_GET['view-student-info'])){
                        $student_id = $_GET['view-student-info'];
                        $connection = mysqli_connect('localhost', 'root','','yazgeldb');
                        $sql = "SELECT * FROM student WHERE kullanci_id='$student_id'";
                        $result = mysqli_query($connection, $sql);
                        while($row=mysqli_fetch_assoc($result)){
                    ?>
                        <tr><td><b>Ad Soyad:</b></td><td><?php echo $row['ogrenci_ad_soyad'];?></td><td><b>Numara:</b></td><td><?php echo $row['ogrenci_okul_no'] ?></td></tr>
                        <tr><td><b>Fakülte:</b></td><td><?php echo $row['ogrenci_fakulte_adi'] ?></td><td><b>Bölüm:</b></td><td><?php echo $row['ogrenci_bolumm_adi'] ?></td></tr>
                        
                        <?php
                            $student_number = $row['ogrenci_okul_no'];
                            $new_sql = "SELECT * FROM staj_basvuru WHERE basvuru_turu='staj2' AND ogrenci_numarasi='$student_number'";
                            $res = mysqli_query($connection, $new_sql);
                            while($new_row=mysqli_fetch_assoc($res)){
                        ?>
                            <tr><td><b>Başlama:</b></td><td><?php echo $new_row['baslama_tarihi'] ?></td><td><b>Bitiş:</b></td><td><?php echo $new_row['bitis_tarihi'] ?></td></tr>
                            <tr><td><b>İş Günü:</b></td><td><?php echo $new_row['is_gunu'] ?></td><td><b>Firma:</b></td><td><?php echo $new_row['firma_adi'] ?></td></tr>
                            
                            <tr>
                              <td><b>Staj Durumu:</b></td>
                              <td>
                                <b style="color: green;">
                                <?php
                                    $sql2 = "SELECT staj_durumu FROM staj_takibi WHERE ogrenci_numarasi='$student_number' AND staj_tur='staj2'";
                                    $res2 = mysqli_query($connection, $sql2);
                                    while($row2 = mysqli_fetch_assoc($res2)){
                                      echo $row2['staj_durumu'];
                                    }
                                ?>
                                </b>
                              </td>
                            </tr>
                            
                            <tr><td><b>Staj Kabul Belgesi:</b></td></tr>
                            <tr><td colspan="4">
                                <?php
                                    $file_sql = "SELECT ogrenci_staj_kabul_belgesi FROM staj_kabul_belgesi WHERE ogrenci_numarasi='$student_number' AND staj_turu='staj2'";
                                    $file_result = mysqli_query($connection, $file_sql);
                                    if(mysqli_num_rows($file_result)== 0){ echo '<div class="alert alert-danger">Yüklenmemiş!</div>'; }
                                    else{ while($file_row = mysqli_fetch_assoc($file_result)){ echo '<embed src="../../../Student/dashboard/Internship/Internship2_Pdf/'.$file_row['ogrenci_staj_kabul_belgesi'].'" width="100%" height="400" type="application/pdf">'; } }
                                ?>
                            </td></tr>
                            
                            <form action="./view-internship2-student-info.php" method="post">
                                <tr><td colspan="4"><input name="feedback" type="text" class="form-control" placeholder="Öğrenciye geri bildirim yazınız..." required></td></tr>
                                <tr>
                                  <td colspan="4">
                                      <?php
                                        $sql3 = "SELECT staj_durumu FROM staj_takibi WHERE ogrenci_numarasi='$student_number' AND staj_tur='staj2'";
                                        $res3 = mysqli_query($connection, $sql3);
                                        while($row3 = mysqli_fetch_assoc($res3)){
                                          if($row3['staj_durumu'] === 'degerlendirme'){
                                      ?>
                                      <button type="submit" name="staj-belge-yukleme-btn" value="<?php echo $student_number ?>" class="btn btn-success">Bitirme Belgelerini İste</button>
                                      <?php }else{ ?>
                                            <button <?php if($row3['staj_durumu'] == 'onaylandi' || $row3['staj_durumu']=='belge_yuklenmesi'){ echo 'disabled'; } ?> type="submit" name="staj-onayla-btn" value="<?php echo $student_number ?>" class="btn btn-success">Staj Onayla</button>
                                            <button <?php if($row3['staj_durumu'] != 'onaylandi'){ echo 'disabled'; } ?> type="submit" name="staj-degerlendirme-btn" value="<?php echo $student_number ?>" class="btn btn-primary">Değerlendirmeye Al</button>
                                      <?php } } ?>
                                      <button type="submit" name="staj-red-btn" value="<?php echo $student_number ?>" class="btn btn-outline-danger">Staj Red</button>
                                  </td>
                                </tr>
                            </form>
                        <?php
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
            </div>
            </div>
        </div>
    </div>
    <footer class="footer">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6"><div class="copyright text-center text-xl-left text-muted">&copy; 2025 <a href="#" class="font-weight-bold ml-1">Necmettin Erbakan Üniversitesi</a></div></div>
      </div>
    </footer>
  </div>
  <script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/argon-dashboard.min.js?v=1.1.2"></script>
</body>
</html>