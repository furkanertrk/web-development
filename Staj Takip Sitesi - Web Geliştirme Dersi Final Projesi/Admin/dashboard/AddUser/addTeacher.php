<?php
  session_start(); 
  if(!isset($_SESSION['adminID'])){
    header('location: ../../../admin_login.php');
    exit();
  } 
  $fullName = '';
  $password = '';
  $new_user_id;

  if(isset($_GET['add-teacher'])){

    $user_id = $_GET['add-teacher'];
    $new_user_id = $user_id;
    require '../Backend/User/view_all_users.php';
    $users = new ViewUsers();
    $row =  $users->viewAllUsers();
    for($i = 0; $i<count($row); $i++){
      if($row[$i]['user_id'] == $user_id){
        $fullName = $row[$i]['user_fullName'];
        $password = $row[$i]['user_password'];
      }
    }

  }

?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Yönetici - Öğretmen Ekleme Paneli</title>
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&display=swap');
    .new-font{font-family: 'IBM Plex Sans JP', sans-serif;}
    .bg-neu-dark { background-color: #0F203F !important; }

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
    @keyframes blink {
      100% { transform: scale(2, 2); opacity: 0; }
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
        <img style="width: 70%; height:auto;" src="../assets/img/theme/neu-logo.png"  alt="NEÜ Logo">
        </center>
      </a>
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
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
          <hr class="my-3">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">
              <i class="ni ni-tv-2 text-primary"></i> Anasayfa
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="../examples/profile.php">
              <i class="ni ni-single-02 text-yellow"></i> Profil
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link active" href="../examples/register.php">
              <i class="ni ni-circle-08 text-pink"></i> Kullanıcı Ekle
            </a>
          </li>
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
            <div class="dropdown-divider"></div>
            <span>
                <a href="../logout.php" class="dropdown-item"><i class="ni ni-user-run"></i>Çıkış</a>
            </span>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    
    <div class="header pb-8 pt-5 pt-lg-8 bg-neu-dark d-flex align-items-center" style="min-height: 100px;">
    </div>

    <div class="container-fluid mt--7">
        <center>
          <h1 class="new-font">Öğretmen Ekleme Paneli</h1>
        </center>
        <div class="order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Yeni Hesap</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form method="POST" action="add_teacher_post.php">
                <h6 class="heading-small text-muted mb-4">Öğretmen Bilgileri</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Ad Soyad</label>
                        <input type="text" name="fullName" id="input-username" class="form-control form-control-alternative" placeholder="Ad Soyad" value="<?php echo $fullName ?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">T.C</label>
                        <input type="text" name="tc" id="input-username" class="form-control form-control-alternative" placeholder="T.C Kimlik No" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Öğretmen Numarası</label>
                        <input type="text" name="teacher_number" id="input-username" class="form-control form-control-alternative" placeholder="Öğretmen No" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Tel</label>
                        <input type="text" name="phone_number" id="input-email" class="form-control form-control-alternative" placeholder="+90 5xxxxxxxxx" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Fakülte</label>
                        <input type="text" name="faculty" id="input-username" class="form-control form-control-alternative" value="Mühendislik" placeholder="Mühendislik" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Bölüm</label>
                        <input type="text" name="department" id="input-username" class="form-control form-control-alternative" value="Bilgisayar Mühendisliği" placeholder="Bilgisayar Mühendisliği" required>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Mail Adresi</label>
                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder="ornek@gmail.com" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Parola</label>
                        <input type="password" name="password" id="input-email" class="form-control form-control-alternative" placeholder="Parola" value="<?php echo $password ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-primary" value="<?php echo $new_user_id ?>" type="submit" name="add-teacher-btn">Öğretmen Ekle</button>
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
</body>
</html>