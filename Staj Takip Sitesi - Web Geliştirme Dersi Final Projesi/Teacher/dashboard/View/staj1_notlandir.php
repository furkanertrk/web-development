<?php 
  session_start();
  if(!isset($_SESSION['teacher_id'])){
    header('location:../../../teacher_login.php');
    exit();
  }
  if(isset($_POST['staj-basarili-btn'])){
    $student_number = $_POST['staj-basarili-btn'];
    $teacher_number = $_SESSION['teacher_number'];
    $feedback = $_POST['feedback'];
    $connection = mysqli_connect('localhost','root','','yazgeldb');
    $sql = "UPDATE staj_takibi SET staj_durumu='done', geri_bildirim='$feedback', ogretmen_numarasi='$teacher_number' WHERE ogrenci_numarasi='$student_number' AND staj_tur='staj1'";
    mysqli_query($connection, $sql);
    header('Location: internship1_view.php');
    exit();
  }
  // ... Diğer post işlemleri aynen korundu ...
  if(isset($_POST['eksik-belge-btn'])){
    $student_number = $_POST['eksik-belge-btn'];
    $teacher_number = $_SESSION['teacher_number'];
    $feedback = $_POST['feedback'];
    $connection = mysqli_connect('localhost','root','','yazgeldb');
    $sql = "UPDATE staj_takibi SET staj_durumu='eksik_belge', geri_bildirim='$feedback', ogretmen_numarasi='$teacher_number' WHERE ogrenci_numarasi='$student_number' AND staj_tur='staj1'";
    mysqli_query($connection, $sql);
    header('Location: internship1_view.php');
    exit();
  }
  if(isset($_POST['staj-basarisiz-btn'])){
    $student_number = $_POST['staj-basarisiz-btn'];
    $teacher_number = $_SESSION['teacher_number'];
    $feedback = $_POST['feedback'];
    $connection = mysqli_connect('localhost','root','','yazgeldb');
    $sql = "UPDATE staj_takibi SET staj_durumu='basarisiz', geri_bildirim='$feedback', ogretmen_numarasi='$teacher_number' WHERE ogrenci_numarasi='$student_number' AND staj_tur='staj1'";
    mysqli_query($connection, $sql);
    header('Location: internship1_view.php');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Öğretmen - Staj 1 Notlandırma</title>
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&display=swap');
    .new-font{font-family: 'IBM Plex Sans JP', sans-serif;}
  </style>
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="pt-0" href="./index.php">
        <center><img style="width: 70%; height:auto;" src="../assets/img/theme/neu-logo.png" alt="NEÜ Logo"></center>
      </a>
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
           <li class="nav-item active"><a class="nav-link active" href="../index.php"><i class="ni ni-tv-2 text-primary"></i> Anasayfa</a></li>
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
        <center>
          <h1 class="new-font mb-4 text-white">Staj 1 Notlandırma <i style="color: #D4AF37;" class="fas fa-edit"></i></h1>
        </center>
        <div class="card shadow">
        <div class="card-body">
            <h3 class="text-center">Notlandırma İşlemi İçin "Görüntüle" Sayfasını Kullanınız.</h3>
            <center><a href="internship1_view.php" class="btn btn-primary">Geri Dön</a></center>
        </div>
        </div>
        </div>
    </div>
    <footer class="footer">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">&copy; 2025 <a href="#" class="font-weight-bold ml-1">Necmettin Erbakan Üniversitesi</a></div>
        </div>
      </div>
    </footer>
  </div>
  <script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/argon-dashboard.min.js?v=1.1.2"></script>
</body>
</html>