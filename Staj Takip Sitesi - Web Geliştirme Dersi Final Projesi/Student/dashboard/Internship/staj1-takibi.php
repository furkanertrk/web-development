<?php 
  session_start();
  if(!isset($_SESSION['studentID'])){
    header('location: ../../../index.php');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Öğrenci - Staj 1 Takibi</title>
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <script src="https://kit.fontawesome.com/812fd4bca0.js" crossorigin="anonymous"></script>

  <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&display=swap');
    .new-font{font-family: 'IBM Plex Sans JP', sans-serif;}
    .bg-neu-dark { background-color: #0F203F !important; }

    div.online-indicator { display: inline-block; width: 15px; height: 15px; margin-right: 10px; background-color: #0fcc45; border-radius: 50%; position: relative; }
    span.blink { display: block; width: 15px; height: 15px; background-color: #0fcc45; opacity: 0.7; border-radius: 50%; animation: blink 1s linear infinite; }
    @keyframes blink { 100% { transform: scale(2, 2); opacity: 0; } }

    .result{ text-align: center; padding: 3%; }
    .result h4{ margin: 15px 0 10px; }
    .upload-file, .approved, .evaluation, .done { padding: 3% 5%; text-align: center; }
    .upload-file input{ box-shadow: 5px 5px 15px -5px rgba(0, 0, 0, 0.5); background-color: #fff; }
    .upload-file input[type=file]::file-selector-button { background-color: #fff; border: 0px; margin-right: 20px; transition: .5s; border-radius: 5px; cursor: pointer; }
    .upload-file button{ box-shadow: 5px 5px 15px -5px rgba(0, 0, 0, 0.5); }
    .upload-card h3{ color: red; margin: 5px 0; }
  </style>
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"><span class="navbar-toggler-icon"></span></button>
      <a class="pt-0" href="../index.php">
        <center><img style="width: 70%; height:auto;" src="../assets/img/theme/neu-logo.png"  alt="NEÜ Logo"></center>
      </a>
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <center>
            <h5 class="new-font"><div class="online-indicator"><span class="blink"></span></div> <?php echo $_SESSION['student_fullName']; ?></h5>
            <h5 class="new-font text-muted">Öğrenci</h5>
          </center>
          <hr class="my-3">
          <li class="nav-item"><a class="nav-link" href="../index.php"><i class="ni ni-tv-2 text-primary"></i> Anasayfa</a></li>
          <li class="nav-item"><a class="nav-link" href="../examples/profile.php"><i class="ni ni-single-02 text-yellow"></i> Profil</a></li>
          <li class="nav-item"><a class="nav-link" href="../examples/apply_internship.php"><i style="color: #764AF1;" class="fas fa-pen"></i> Staj Başvurusu</a></li>
          <li class="nav-item"><a class="nav-link" href="../examples/announcements.php"><i class="fas fa-bullhorn text-success"></i> Duyurular</a></li>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="main-content">
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="../index.php">Anasayfa'ya Dön</a>
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle"><img alt="Image placeholder" src="../assets/img/theme/man.jpg"></span>
                <div class="media-body ml-2 d-none d-lg-block"><span style="color: black;" class="mb-0 text-sm font-weight-bold"><?php echo isset($_SESSION['studentID']) ? $_SESSION['student_fullName'] : 'User'; ?></span></div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title"><h6 class="text-overflow m-0">Hoşgeldiniz!</h6></div>
              <a href="../examples/profile.php" class="dropdown-item"><i class="ni ni-single-02"></i><span>Profil</span></a>
              <div class="dropdown-divider"></div>
              <a href="../logout.php" class="dropdown-item"><i class="ni ni-user-run"></i>Çıkış</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <div class="header pb-4 pt-2 pt-lg-8 d-flex align-items-center bg-neu-dark" style="min-height: 150px;"></div>
    
    <div class="container-fluid mt--5">
      <div class="card shadow">
        <div class="container">
              <center><h2 class="new-font mt-4 mb-3">Staj 1 Takibi Paneli <i style="color: green;" class="fas fa-info-circle"></i></h2></center>
              <?php
                  $connection = mysqli_connect('localhost', 'root', '', 'yazgeldb');
                  $student_id = $_SESSION['studentID'];
                  $sql = "SELECT ogrenci_okul_no FROM student WHERE kullanci_id='$student_id'";
                  $result = mysqli_query($connection, $sql);
                  while($row=mysqli_fetch_assoc($result)){
                    $student_number = $row['ogrenci_okul_no'];

                    $query = "SELECT * FROM staj_takibi WHERE ogrenci_numarasi='$student_number' AND staj_tur='staj1'";
                    $res = mysqli_query($connection, $query);
                    if(mysqli_num_rows($res) == 0){
                    ?>
                      <div class="result">
                        <img style="width:20% ;" src="img/no-result.png" alt="">
                        <h4 style="color: orange;" class="new-font mt-5 mb-2">Staj Başvurunuz bulunmadı!</h4>
                        <button class="btn btn-primary"><a style="color:#fff ;" href="../examples/apply_internship.php">Staj'a Başvurun</a></button>
                      </div>
                    <?php
                    }else{
                      while($row = mysqli_fetch_assoc($res)){
                        if($row['staj_durumu'] == 'yeni_basvuru'){
                      ?>
                            <div class="upload-card">
                            <div class="upload-file">
                                <?php
                                    if(isset($_SESSION['upload_file_error'])){
                                        echo '<h3 class="alert new-font">'.$_SESSION['upload_file_error'].'</h3>';
                                    }else{
                                        echo '<h3 class="alert new-font">Staj sürecinizi başlatmak için lütfen staj kabul formunun imzalı halini sisteme yükleyin!</h3>';
                                        echo '<p style="color:green;"> <i class="fas fa-bell"></i> '.$row['geri_bildirim'].'</p>';
                                    }
                                ?>
                                <img style="width:20% ;" class="mb-3" src="img/missing-doc.png" alt="">
                                <form action="upload.php" method="POST" enctype="multipart/form-data">
                                    <input class="btn" type="file" name="file" required><br>
                                    <button class="btn btn-primary mt-3" name="submit" type="submit"><i class="fas fa-upload mr-3"></i>Dosya Yükle</button>
                                </form>
                            </div>
                          </div>
                      <?php
                        }elseif($row['staj_durumu'] == 'eksik_belge'){
                        ?>
                          <div class="upload-card">
                            <div class="upload-file">
                                <?php
                                    if(isset($_SESSION['upload_file_error'])){
                                        echo '<h3 class="alert new-font">'.$_SESSION['upload_file_error'].'</h3>';
                                    }else{
                                        echo '<h3 class="alert new-font">Staj evraklarınız eksik. Lütfen tekrar yükleyiniz!</h3>';
                                        echo '<p style="color:red;"><i class="fas fa-bell"></i> '.$row['geri_bildirim'].'</p>';
                                    }
                                ?>
                                <img style="width:20% ;" class="mb-3" src="img/missing-doc.png" alt="">
                                <form action="upload.php" method="POST" enctype="multipart/form-data">
                                    <input class="btn" type="file" name="file" required><br>
                                    <button class="btn btn-primary mt-3" name="submit-again" type="submit"><i class="fas fa-upload mr-3"></i>Dosya Yükle</button>
                                </form>
                            </div>
                          </div>
                      <?php
                        }elseif($row['staj_durumu'] == 'onaylandi'){
                      ?>
                            <div class="approved">
                              <img style="width: 20%;" src="img/tick-mark.png" alt="">
                              <h3 class="mt-2 mb-1 new-font"><b><?php echo $student_number ?></b> nolu öğrencinin staj başvurusu onaylanmıştır!</h3>
                              <?php echo '<p style="color:green;"><i class="fas fa-bell"></i> '.$row['geri_bildirim'].'</p>' ?>
                            </div>
                      <?php
                        }elseif($row['staj_durumu'] == 'degerlendirme'){
                      ?>
                            <div class="evaluation">
                              <img style="width: 20%;" src="img/evaluation.png" alt="">
                              <h3 class="mt-2 mb-1 new-font"><b><?php echo $student_number ?></b> nolu öğrencinin staj süreci değerlendirmeye alınmıştır!</h3>
                            </div>
                      <?php
                        }elseif($row['staj_durumu'] == 'done'){
                      ?>
                          <div class="done">
                            <img style="width: 20%;" src="img/done.png" alt="">
                            <h3 class="mt-2 mb-3"><b><?php echo $student_number ?></b> nolu öğrenci staj 1'i başarıyla tamamlamıştır!</h3>
                            <?php echo '<p class="new-font" style="color:green;"><i class="fas fa-bell"></i> '.$row['geri_bildirim'].'</p>' ?>
                            <button class="btn btn-primary"><a style="color:#fff ;" href="../examples/apply_internship.php">Staj 2'ye Başvurun</a></button>
                          </div>
                      <?php
                        }elseif($row['staj_durumu'] == 'belge_yuklenmesi'){
                      ?>
                            <div class="upload-file">
                                <?php
                                    if(isset($_SESSION['upload_file_error'])){
                                        echo '<h3 class="alert new-font">'.$_SESSION['upload_file_error'].'</h3>';
                                    }else{
                                        echo '<h3 class="alert new-font">Staj 1 sürecini bitirmek için staj raporunuzu sisteme yükleyin!</h3>';
                                        echo '<p class="new-font" style="color:green;"><i class="fas fa-bell"></i> '.$row['geri_bildirim'].'</p>';
                                    }
                                ?>
                                <form action="upload.php" method="POST" enctype="multipart/form-data">
                                    <label style="color:orange ;" for="">Staj Raporunuzu Yükleyin</label><br>
                                    <input class="btn mb-4" type="file" name="staj_raporu" required><br>
                                    <label style="color:orange ;"  for="">Staj Değerlendirme Formu Yükleyin</label><br>
                                    <input  class="btn" type="file" name="staj_degerlendirme_formu" required><br>
                                    <button class="btn btn-primary mt-3" name="submit-internship-docs" type="submit"><i class="fas fa-upload mr-3"></i>Dosya Yükle</button>
                                </form>
                            </div>
                      <?php
                        }
                      }
                    }
                  }
              ?>
        </div>
        
        <div class="container pb-5">
              <div class="text-center">
                <center>
                  <h4 style="color:#54B435 ;" class="new-font mt-4 mb-2">Öğrenci Bilgileri <i style="color: green;" class="fas fa-info-circle"></i></h4>
                </center>
              </div>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col"><b class="new-font">Ad Soyad</b></th>
                    <th scope="col"><b class="new-font">Öğrenci NO</b></th>
                    <th scope="col"><b class="new-font">Mail Adresi</b></th>
                    <th scope="col"><b class="new-font">Tel</b></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php 
                      $connection = mysqli_connect('localhost','root','','yazgeldb');
                      $student_number = $_SESSION['student_number'];
                      $sql = "SELECT * FROM student WHERE ogrenci_okul_no='$student_number'";
                      $result = mysqli_query($connection, $sql);
                      while($row=mysqli_fetch_assoc($result)){
                    ?>
                      <td><?php echo $row['ogrenci_ad_soyad'] ?></td>
                      <td><?php echo $row['ogrenci_okul_no'] ?></td>
                      <td><?php echo $row['ogrenci_mail'] ?></td>
                      <td><?php echo $row['ogrenci_tel'] ?></td>
                    <?php } ?>
                  </tr>
                </tbody>
              </table>
              
              <center><h4 style="color: #54B435;" class="new-font mt-5 mb-2">Öğrenci Staj Bilgileri <i style="color: green;" class="fas fa-info-circle"></i></h4></center>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col"><b class="new-font">Başlangıç Tarihi</b></th>
                    <th scope="col"><b class="new-font">Bitiş Tarihi</b></th>
                    <th scope="col"><b class="new-font">Değerlendiren Öğretmen</b></th>
                    <th scope="col"><b class="new-font">Öğretmen Mail</b></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php 
                      $connection = mysqli_connect('localhost','root','','yazgeldb');
                      $sql = "SELECT * FROM staj_basvuru WHERE ogrenci_numarasi='$student_number' AND basvuru_turu='staj1'";
                      $result = mysqli_query($connection, $sql);
                      if(mysqli_num_rows($result) == 0){
                    ?>
                    <td colspan="4" class="text-center text-danger">Başvuru Bulunmadı <i class="fas fa-info-circle"></i></td>
                    <?php
                      }else{
                        while($row=mysqli_fetch_assoc($result)){
                    ?>
                    <td><?php echo $row['baslama_tarihi'] ?></td>
                    <td><?php echo $row['bitis_tarihi'] ?></td>
                    <?php
                          $sql2 = "SELECT * FROM staj_takibi WHERE ogrenci_numarasi='$student_number' AND staj_tur='staj1'";
                          $res = mysqli_query($connection, $sql2);
                          $teacher_found = false;
                          while($row2 = mysqli_fetch_assoc($res)){
                            $teacher_number = $row2['ogretmen_numarasi'];
                            $sql3 = "SELECT * FROM teacher WHERE ogretmen_okul_no='$teacher_number'";
                            $res2 = mysqli_query($connection, $sql3);
                            while($row3=mysqli_fetch_assoc($res2)){
                                $teacher_found = true;
                    ?>
                    <td><b class="new-font"><?php echo $row3['ogretmen_ad_soyad'] ?></b></td>
                    <td><b class="new-font"><?php echo $row3['ogretmen_mail'] ?></b></td>
                    <?php
                            }
                          }
                          if(!$teacher_found) { echo "<td>Henüz Atanmadı</td><td>-</td>"; }
                        }
                      }
                    ?>
                  </tr>
                </tbody>
              </table>
        </div>
      </div>
      
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6"><div class="copyright text-center text-xl-left text-muted">&copy; 2025 <a href="#" class="font-weight-bold ml-1">Necmettin Erbakan Üniversitesi</a></div></div>
        </div>
      </footer>
    </div>
  </div>
  <script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/argon-dashboard.min.js?v=1.1.2"></script>
</body>
</html>