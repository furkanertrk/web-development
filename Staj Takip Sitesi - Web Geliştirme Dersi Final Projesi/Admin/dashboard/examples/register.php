<?php
  session_start(); 
  if(!isset($_SESSION['adminID'])){
    header('location: ../../../admin_login.php');
    exit();
  } 
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if(isset($_POST['add-user'])){
    $fullName =  test_input($_POST['fullName']);
    $password = test_input($_POST['password']);
    $password = md5($password);
    
    include '../Backend/User/add_new_user.php';
    include '../Backend/User/add_new_user_contr.php';

    $addUser = new AddNewUserContr($fullName, $password);
    $addUser->addNewUser();

    header('location: ../View/viewUser.php?add-user=success');
  }
?>
<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Yönetici - Kullanıcı Ekle</title>
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&display=swap');
    .new-font{font-family: 'IBM Plex Sans JP', sans-serif;}
    
    /* NEÜ Renkleri */
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
        <center><img style="width: 70%; height:auto;" src="../assets/img/theme/neu-logo.png" alt="NEÜ Logo"></center>
      </a>
      
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <center>
            <h3 class="new-font"><div class="online-indicator"><span class="blink"></span></div> <?php echo $_SESSION['admin_fullName']; ?></h3>
            <h5 class="new-font text-muted">
              <?php
                $admin_id = $_SESSION['adminID'];
                $connection = mysqli_connect('localhost','root','','yazgeldb');
                $sql = "SELECT * FROM admin WHERE admin_id='$admin_id'";
                $res = mysqli_query($connection, $sql);
                while($row=mysqli_fetch_assoc($res)){
                  if($row['admin_type'] == 'super_admin'){ echo 'Süper Yönetici'; }else{ echo 'Yönetici'; }
                }
              ?>
            </h5>
          </center>
          <hr class="my-3">
          <li class="nav-item"><a class="nav-link" href="../index.php"><i class="ni ni-tv-2 text-primary"></i> Anasayfa</a></li>
          <li class="nav-item"><a class="nav-link" href="./profile.php"><i class="ni ni-single-02 text-yellow"></i> Profil</a></li>
          
          <li class="nav-item active"><a class="nav-link active" href="./register.php"><i class="ni ni-circle-08 text-pink"></i> Kullanıcı Ekle</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="main-content">
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="../index.php">Anasayfa'ya Dön</a>
      </div>
    </nav>
    
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center bg-neu-dark" style="border-bottom: 4px solid #D4AF37;">
      <span class="mask opacity-8" style="background-color: #0F203F;"></span>
    </div>
    
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4"><small>Yeni Kullanıcı Bilgileri</small></div>
              <form role="form" method="post" action="">
                <div class="form-group">
                  <label for="">Kullanıcı Ad ve Soyadı</label>
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="ni ni-hat-3"></i></span></div>
                    <input class="form-control" placeholder="Ad Soyad Giriniz" type="text" required name="fullName">
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Kullanıcı Şifresi</label>
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span></div>
                    <input class="form-control" placeholder="Parola Giriniz" type="password" name="password" required>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-4" name="add-user">Kullanıcı Ekle</button>
                </div>
              </form>
              </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="footer">
        <div class="row align-items-center justify-content-xl-between"><div class="col-xl-6"><div class="copyright text-center text-xl-left text-muted">&copy; 2025 <a href="#" class="font-weight-bold ml-1">Necmettin Erbakan Üniversitesi</a></div></div></div>
    </footer>
  </div>
  <script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/argon-dashboard.min.js?v=1.1.2"></script>
</body>
</html>