<?php 
  session_start();
  if(!isset($_SESSION['studentID'])){
    header('location: ../../../index.php');
    exit();
  }
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if(isset($_POST['update-info-btn'])){
    $student_number = $_SESSION['student_number'];
    $email = test_input($_POST['email']);
    $phone_number = test_input($_POST['tel']);
    $address = test_input($_POST['address']);

    $connection = mysqli_connect('localhost','root','','yazgeldb');
    $sql ="UPDATE student set ogrenci_mail='$email', ogrenci_tel='$phone_number',ogrenci_address='$address' WHERE ogrenci_okul_no='$student_number'";
    $result = mysqli_query($connection, $sql);
    if($result){
      $_SESSION['update_info'] = 'success';
      header('location: profile.php?info-update=success');
      exit();
    }else{
      $_SESSION['update_info'] = 'error';
      header('location: profile.php?info-update=error');
      exit();
    }
  }
?>
<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Öğrenci Profil</title>
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
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
          <li class="nav-item active"><a class="nav-link active" href="./profile.php"><i class="ni ni-single-02 text-yellow"></i> Profil</a></li>
          <li class="nav-item"><a class="nav-link" href="./apply_internship.php"><i style="color: #764AF1;" class="fas fa-pen"></i> Staj Başvurusu</a></li>
          <li class="nav-item"><a class="nav-link" href="./announcements.php"><i class="fas fa-bullhorn text-success"></i> Duyurular</a></li>
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
                <div class="media-body ml-2 d-none d-lg-block"><span style="color: white;" class="mb-0 text-sm font-weight-bold"><?php echo isset($_SESSION['studentID']) ? $_SESSION['student_fullName'] : 'User'; ?></span></div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title"><h6 class="text-overflow m-0">Hoşgeldiniz!</h6></div>
              <a href="./profile.php" class="dropdown-item"><i class="ni ni-single-02"></i><span>Profil</span></a>
              <div class="dropdown-divider"></div>
              <span><a href="../logout.php" class="dropdown-item"><i class="ni ni-user-run"></i>Çıkış</a></span>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    
    <div class="header pb-8 pt-5 pt-lg-8 bg-neu-dark d-flex align-items-center" style="min-height: 100px;"></div>
    
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image"><a href="#"><img src="../assets/img/theme/man.jpg" class="rounded-circle"></a></div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4"></div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row"><div class="col"><div class="card-profile-stats d-flex justify-content-center mt-md-5"></div></div></div>
              <div class="text-center">
                <h3><?php echo $_SESSION['student_fullName']; ?></h3>
                <div class="h5 font-weight-300"><i class="ni location_pin mr-2"></i>Konya, Türkiye</div>
                <div class="h5 mt-4"><i class="ni business_briefcase-24 mr-2"></i>Öğrenci</div>
                <div><i class="ni education_hat mr-2"></i>Necmettin Erbakan Üniversitesi</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center"><div class="col-8"><h3 class="mb-0">Hesabım</h3></div></div>
            </div>
            <div class="card-body">
              <center><h4 style="color:green ;" class="new-font">
                  <?php if(isset($_SESSION['update_info'])){ if($_SESSION['update_info'] == 'success'){ echo 'Bilgileriniz Başarıyla Güncellenmiştir!'; unset($_SESSION['update_info']); }else{ echo 'Sistemde bir hata oluştu!'; unset($_SESSION['update_info']); } } ?>
              </h4></center>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <h6 class="heading-small text-muted mb-4">Öğrenci Bilgileri</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <?php 
                        $connection = mysqli_connect('localhost','root','','yazgeldb');
                        $student_id = $_SESSION['studentID'];
                        $sql = "SELECT * FROM student WHERE kullanci_id='$student_id'";
                        $result = mysqli_query($connection, $sql);
                        while($row=mysqli_fetch_assoc($result)){
                    ?>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Ad Soyad</label><input disabled type="text" class="form-control form-control-alternative" value="<?php echo $row['ogrenci_ad_soyad'] ?>"></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">T.C Kimlik</label><input disabled type="text" class="form-control form-control-alternative" value="<?php echo $row['ogrenci_tc'] ?>"></div></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Üniversite</label><input disabled type="text" class="form-control form-control-alternative" value="Necmettin Erbakan Üniversitesi"></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Fakülte</label><input disabled type="text" class="form-control form-control-alternative" value="Mühendislik Fakültesi"></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Bölüm</label><input disabled type="text" class="form-control form-control-alternative" value="<?php echo $row['ogrenci_bolumm_adi'] ?>"></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Sınıf</label><input disabled type="text" class="form-control form-control-alternative" value="<?php echo $row['ogrenci_sinif'] ?>"></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Öğrenci Numarası</label><input disabled type="text" class="form-control form-control-alternative" value="<?php echo $row['ogrenci_okul_no'] ?>"></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Adres</label><input name="address" type="text" class="form-control form-control-alternative" value="<?php echo $row['ogrenci_address'] ?>"></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Tel</label><input name="tel" type="text" class="form-control form-control-alternative" value="<?php echo $row['ogrenci_tel'] ?>"></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Mail Adresi</label><input name="email" type="email" class="form-control form-control-alternative" value="<?php echo $row['ogrenci_mail'] ?>"></div></div>
                  </div>
                </div>
                <button class="btn btn-primary" name="update-info-btn" type="submit">Güncelle</button>
                <?php } ?>
              </form>
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
  </div>
  <script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/argon-dashboard.min.js?v=1.1.2"></script>
</body>
</html>