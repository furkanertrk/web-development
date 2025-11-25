<?php 
  session_start();
  if(!isset($_SESSION['teacher_id'])){
    header('location: ../../teacher_login.php');
    exit();
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if(isset($_POST['update-info-btn'])){
    $teacher_number = $_SESSION['teacher_number'];
    $email = test_input($_POST['email']);
    $phone_number = test_input($_POST['tel']);

    $connection = mysqli_connect('localhost','root','','yazgeldb');
    $sql ="UPDATE teacher set ogretmen_mail='$email', ogretmen_tel='$phone_number' WHERE ogretmen_okul_no='$teacher_number'";
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
  <title>Öğretmen Profili</title>
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&display=swap');
    /* font-family: 'IBM Plex Sans JP', sans-serif; */
    .new-font{font-family: 'IBM Plex Sans JP', sans-serif;}
    div.online-indicator {
      display: inline-block;
      width: 15px;
      height: 15px;
      margin-right: 10px;
      
      background-color: #0fcc45;
      border-radius: 50%;
      
      position: relative;
    }
    span.blink {
      display: block;
      width: 15px;
      height: 15px;
      
      background-color: #0fcc45;
      opacity: 0.7;
      border-radius: 50%;
      
      animation: blink 1s linear infinite;
    }
    /*Animations*/

    @keyframes blink {
      100% { transform: scale(2, 2); 
              opacity: 0;
            }
    }
  </style>
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="pt-0" href="./index.php">
        <center>
          <img style="width: 70%; height:auto;" src="../assets/img/theme/neu-logo.png" alt="NEÜ Logo">
        </center>
      </a>
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Bildirim</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="../assets/img/theme/man.jpg">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Hoşgeldiniz!</h6>
            </div>
            <a href="./profile.php" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>Profil</span>
            </a>
            <a href="./profile.php" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Ayarlar</span>
            </a>
            <a href="./profile.php" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Etkinlikler</span>
            </a>
            <div class="dropdown-divider"></div>
            <span>
                    <?php
                        if(isset($_SESSION['teacher_id'])){
                          echo '<a href="../logout.php" class="dropdown-item"><i class="ni ni-user-run"></i>Çıkış Yap</a>';
                        }else{
                          echo 'Çıkış';
                        }
                    ?>
            </span>
          </div>
        </li>
      </ul>
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="../index.html">
              <img src="../assets/img/theme/neu-logo.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav">
          <center>
            <h4 class="new-font">
            <div class="online-indicator">
              <span class="blink"></span>
            </div>
              <?php echo $_SESSION['teacher_name']; ?></h4>
            <h5 class="new-font text-muted">Öğretmen</h5>
          </center>
          <hr class="my-3">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">
              <i class="ni ni-tv-2 text-primary"></i> Anasayfa
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link active" href="./profile.php">
              <i class="ni ni-single-02 text-yellow"></i> Profil
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="main-content">
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <a class="h4 mb-0 text-uppercase d-none d-lg-inline-block" style="color: #fff;" href="../index.php">Anasayfa'ya Dön</a>
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="../assets/img/theme/man.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">
                    <span style="color:white;">
                    <?php
                        if(isset($_SESSION['teacher_id'])){
                          echo $_SESSION['teacher_name'];
                        }else{
                          echo 'User';
                        }
                    ?>
                    </span>
                  </span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Hoşgeldiniz!</h6>
              </div>
              <a href="./profile.php" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>Profil</span>
              </a>
              <a href="./profile.php" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Ayarlar</span>
              </a>
              <a href="./profile.php" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Etkinlikler</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="../logout.php" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Çıkış Yap</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 400px; background-color: #0F203F; border-bottom: 4px solid #D4AF37; background-size: cover; background-position: center top;">
      <span class="mask opacity-8" style="background-color: #0F203F;"></span>
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-12 col-md-10">
            <h1 class="display-2 text-white">Merhaba <?php echo $_SESSION['teacher_name']; ?></h1>
            <p class="text-white mt-0 mb-5">Bu profil sayfanızdır. Bilgilerinizi buradan görebilir ve güncelleyebilirsiniz.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="../assets/img/theme/man.jpg" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                  <?php echo $_SESSION['teacher_name']; ?>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>Türkiye
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Öğretim Görevlisi
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>Necmettin Erbakan Üniversitesi
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Hesabım</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <center>
                <h4 style="color:green ;">
                  <?php
                    if(isset($_SESSION['update_info'])){
                      if($_SESSION['update_info'] == 'success'){
                        echo 'Bilgileriniz Başarıyla Güncellenmiştir!';
                        unset($_SESSION['update_info']);
                      }else{
                        echo 'Sistemde bir hata oluştu! Bilgileriniz güncellenmedi!';
                        unset($_SESSION['update_info']);
                      }
                    }
                  ?>
                </h4>
              </center>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <?php
                      $connection = mysqli_connect('localhost','root','','yazgeldb');
                      $teacher_number = $_SESSION['teacher_number'];
                      $sql ="SELECT * FROM teacher WHERE ogretmen_okul_no='$teacher_number'";
                      $result = mysqli_query($connection, $sql);
                      while($row=mysqli_fetch_assoc($result)){
                    ?>
                <h6 class="heading-small text-muted mb-4">Öğretmen Bilgileri</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Ad Soyad</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" value="<?php echo $row['ogretmen_ad_soyad'] ?>" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">T.C Kimlik</label>
                        <input type="text" id="input-email" class="form-control form-control-alternative" value="<?php echo $row['ogretmen_tc'] ?>" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Üniversite Adı</label>
                        <input type="text" id="input-first-name" class="form-control form-control-alternative" value="Necmettin Erbakan Üniversitesi" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Fakülte</label>
                        <input type="text" id="input-last-name" class="form-control form-control-alternative" value="<?php echo $row['ogretmen_fakulte_adi'] ?> Fakültesi" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Bölüm</label>
                        <input type="text" id="input-first-name" class="form-control form-control-alternative"value="<?php echo $row['ogretmen_bolum_adi'] ?>" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Öğremen Numarası</label>
                        <input type="text" id="input-last-name" class="form-control form-control-alternative" value="<?php echo $row['ogretmen_okul_no'] ?>" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Tel</label>
                        <input name="tel" type="text" id="input-first-name" class="form-control form-control-alternative"value="<?php echo $row['ogretmen_tel'] ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Mail Adresi</label>
                        <input name="email" type="email" id="input-last-name" class="form-control form-control-alternative" value="<?php echo $row['ogretmen_mail'] ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary" name="update-info-btn" type="submit">Güncelle</button>
                <?php
                  }
                ?>
              </form>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2025 <a href="#" class="font-weight-bold ml-1">Necmettin Erbakan Üniversitesi</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="#" class="nav-link">MIT License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/argon-dashboard.min.js?v=1.1.2"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
</body>

</html>