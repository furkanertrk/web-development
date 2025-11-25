<?php
session_start(); 
if(!isset($_SESSION['adminID'])){
  header('location: ../../../admin_login.php');
  exit();
} 
$student_id = '';
$fullName = '';
$tc = '';
$email = '';
$phone_number = '';
$university_no = '';
$password = '';
$faculty = '';
$department = '';

if(isset($_GET['view-teacher'])){

  $teacher_id = $_GET['view-teacher'];
  require '../Backend/Teacher/view_all_teachers.php';
  $teachers = new ViewTeachers();
  $row =  $teachers->viewAllTeachers();
  for($i = 0; $i<count($row); $i++){
    if($row[$i]['ogretmen_id'] == $teacher_id){
      $teacher_id = $row[$i]['ogretmen_id'];
      $fullName = $row[$i]['ogretmen_ad_soyad'];
      $tc = $row[$i]['ogretmen_tc'];
      $phone_number = $row[$i]['ogretmen_tel'];
      $email = $row[$i]['ogretmen_mail'];
      $university_no = $row[$i]['ogretmen_okul_no'];
      $password = $row[$i]['ogretmen_password'];
      $faculty = $row[$i]['ogretmen_fakulte_adi'];
      $department = $row[$i]['ogretmen_bolum_adi'];
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Yönetici - Öğretmen Bilgileri</title>
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&display=swap');
    
    .new-font{font-family: 'IBM Plex Sans JP', sans-serif;}
    
    /* --- NEÜ ÖZEL TEMA BAŞLANGIÇ --- */
    /* Header ve Sidebar Arka Planı */
    .navbar-vertical.navbar-expand-md {
        border-right: 1px solid rgba(0, 0, 0, 0.05);
        background-color: #fff; /* Sidebar beyaz kalabilir veya lacivert yapılabilir */
    }
    
    /* Üst Bar Renkleri */
    .bg-gradient-primary {
        background: #0F203F !important; /* NEÜ Lacivert */
        background: linear-gradient(87deg, #0F203F 0, #162e58 100%) !important;
    }
    
    /* Buton Renkleri (Lacivert) */
    .btn-primary {
        background-color: #0F203F;
        border-color: #0F203F;
    }
    .btn-primary:hover {
        background-color: #09152b;
        border-color: #09152b;
    }
    
    /* Metin ve Link Renkleri */
    .text-primary {
        color: #0F203F !important;
    }
    a.text-primary:hover, .nav-link.active i {
        color: #D4AF37 !important; /* Altın Sarısı Hover */
    }
    
    /* Alt Çizgiler */
    .header {
        border-bottom: 4px solid #D4AF37; /* Altın Sarısı Çizgi */
    }
    /* --- NEÜ ÖZEL TEMA BİTİŞ --- */

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
      <a class="pt-0" href="../index.php">
        <center>
        <img style="width: 80%; max-height: 150px;" src="../assets/img/theme/neu-logo.png" alt="Necmettin Erbakan Üniversitesi">
        </center>
      </a>
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
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
            <a href="profile.php" class="dropdown-item">
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
                        if(isset($_SESSION['adminID'])){
                          echo '<a href="../logout.php"><i class="ml-3 mr-2 ni ni-user-run"></i>Çıkış</a>';
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
        </form>
        <ul class="navbar-nav">
          <center>
            <h3 class="new-font">
            <div class="online-indicator">
              <span class="blink"></span>
            </div>
              <?php echo $_SESSION['admin_fullName']; ?></h3>
              <h5 class="new-font">
              <?php
                $admin_id = $_SESSION['adminID'];
                $connection = mysqli_connect('localhost','root','','yazgeldb');
                $sql = "SELECT * FROM admin WHERE admin_id='$admin_id'";
                $res = mysqli_query($connection, $sql);
                while($row=mysqli_fetch_assoc($res)){
                  if($row['admin_type'] == 'super_admin'){
                    echo 'Süper Yönetici';
                  }else{
                    echo 'Yönetici';
                  }
                }
              ?>
            </h5>
          </center>
          <li class="nav-item active">
            <a class="nav-link active" href="../index.php">
              <i class="ni ni-tv-2 text-primary"></i> Anasayfa
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="../examples/profile.php">
              <i class="ni ni-single-02 text-yellow"></i> Profil
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../examples/register.php">
              <i class="ni ni-circle-08 text-pink"></i> Kullancı Ekle
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="main-content">
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <a class="h4 mb-0 text-uppercase d-none d-lg-inline-block" href="../index.php">Anasayfa'ya Dön</a>
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="../assets/img/theme/man.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                <span style="color:black ;" class="mb-0 text-sm  font-weight-bold">
                    <?php
                        if(isset($_SESSION['adminID'])){
                            echo $_SESSION['admin_fullName'];
                        }else{
                          echo 'User';
                        }
                    ?>
                  </span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Hoşgeldiniz!</h6>
            </div>
            <a href="profile.php" class="dropdown-item">
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
                        if(isset($_SESSION['adminID'])){
                          echo '<a href="../logout.php"><i class="ml-3 mr-2 ni ni-user-run"></i>Çıkış</a>';
                        }else{
                          echo 'Çıkış';
                        }
                    ?>
              </span>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 100px; background-color: #0F203F; border-bottom: 4px solid #D4AF37;">
      <div class="container">
         <center>
          <h1 class="new-font mb-4 text-white">Öğretmen Bilgileri <i style="color: #D4AF37;" class="fas fa-info-circle"></i></h1>
        </center>
      </div>
    </div>
    <div class="container-fluid mt--7">
      <center>
          <h1 class="new-font mb-4">Öğretmen Bilgileri <i style="color: #0F203F;" class="fas fa-info-circle"></i></h1>
        </center>
        <div class="order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Hesap</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
            <form method="POST" action="process/crud_teacher.php">
                <h6 class="heading-small text-muted mb-4">Öğretmen Bilgileri</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Ad Soyad</label>
                        <input type="text" name="fullName" id="input-username" class="form-control form-control-alternative" placeholder="Full Name" value="<?php echo $fullName ?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">T.C Kimlik</label>
                        <input type="text" name="tc" id="input-username" class="form-control form-control-alternative" placeholder="T.C Number" value="<?php echo $tc ?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Öğretmen NO</label>
                        <input type="text" name="teacher_number" id="input-username" class="form-control form-control-alternative" placeholder="1511xxxxxxxx" value="<?php echo $university_no ?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Tel</label>
                        <input type="text" name="phone_number" id="input-email" class="form-control form-control-alternative" placeholder="+90 5xxxxxxxxx" value="<?php echo $phone_number ?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Fakülte</label>
                        <input type="text" name="faculty" id="input-username" class="form-control form-control-alternative" placeholder="Faculty Name" value="<?php echo $faculty ?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Bölüm</label>
                        <input type="text" name="department" id="input-username" class="form-control form-control-alternative" placeholder="Department Name" value="<?php echo $department ?>" required>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Mail Adresi</label>
                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder="exmple@gmail.com" value="<?php echo $email ?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Parola</label>
                        <input type="password" name="password" id="input-email" class="form-control form-control-alternative" placeholder="exmple@gmail.com" value="<?php echo $password ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <button type="submit" name="add_as_commission" value="<?php echo $teacher_id  ?>" class="btn btn-primary">Komisyon Üyesi'ne Ekle</button>
                      <button type="submit" name="update_teacher_info" value="<?php echo $teacher_id  ?>" class="btn btn-primary">Güncelle</button>
                      <button type="submit" name="remove_teacher" value="<?php echo $teacher_id  ?>" class="btn btn-danger" onclick="return confirm('Bu kullanıcıyı tamamen silmek istediğinize emin misiniz? Bu işlem geri alınamaz.');">Sil</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2025 <a href="https://www.erbakan.edu.tr/" class="font-weight-bold ml-1" style="color: #0F203F;">Necmettin Erbakan Üniversitesi</a>
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