<?php
session_start(); 
if(!isset($_SESSION['adminID'])){
  header('location: ../../../admin_login.php');
  exit();
} 
$fullName = '';
$email = '';
$password = '';
$admin_id = '';
$admin_type='';
$logged_in_admin_type = '';

if(isset($_GET['view-admin'])){

  $admin_id = $_GET['view-admin'];
  require '../Backend/Admin/view_all_admins.php';
  $admins = new ViewAdmins();
  $row =  $admins->viewAllAdmins();
  for($i = 0; $i<count($row); $i++){
    if($row[$i]['admin_id'] == $admin_id){
      $admin_id = $row[$i]['admin_id'];
      $fullName = $row[$i]['admin_full_name'];
      $email = $row[$i]['admin_email'];
      $password = $row[$i]['admin_password'];
      $admin_type = $row[$i]['admin_type'];
    }
  }
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Yönetici - Yönetici Bilgileri</title>
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
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="pt-0" href="../index.php">
        <center><img style="width: 70%; height:auto;" src="../assets/img/theme/neu-logo.png"  alt="NEÜ Logo"></center>
      </a>
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <center>
            <h3 class="new-font"><div class="online-indicator"><span class="blink"></span></div> <?php echo $_SESSION['admin_fullName']; ?></h3>
            <h5 class="new-font">
              <?php
                $admin_id = $_SESSION['adminID'];
                $connection = mysqli_connect('localhost','root','','yazgeldb');
                $sql = "SELECT * FROM admin WHERE admin_id='$admin_id'";
                $res = mysqli_query($connection, $sql);
                while($row=mysqli_fetch_assoc($res)){
                  $logged_in_admin_type = $row['admin_type'];
                  if($row['admin_type'] == 'super_admin'){ echo 'Süper Yönetici'; }else{ echo 'Yönetici'; }
                }
              ?>
            </h5>
          </center>
          <li class="nav-item active"><a class="nav-link active" href="../index.php"><i class="ni ni-tv-2 text-primary"></i> Anasayfa</a></li>
          <li class="nav-item"><a class="nav-link" href="../examples/profile.php"><i class="ni ni-single-02 text-yellow"></i> Profil</a></li>
          <li class="nav-item"><a class="nav-link" href="../examples/register.php"><i class="ni ni-circle-08 text-pink"></i> Kullanıcı Ekle</a></li>
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
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle"><img alt="Image placeholder" src="../assets/img/theme/man.jpg"></span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm font-weight-bold" style="color:black;">
                    <?php echo isset($_SESSION['adminID']) ? $_SESSION['admin_fullName'] : 'User'; ?>
                  </span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class="dropdown-header noti-title"><h6 class="text-overflow m-0">Hoşgeldiniz!</h6></div>
              <a href="profile.php" class="dropdown-item"><i class="ni ni-single-02"></i><span>Profil</span></a>
              <div class="dropdown-divider"></div>
              <a href="../logout.php" class="dropdown-item"><i class="ni ni-user-run"></i><span>Çıkış</span></a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 200px; background-color: #0F203F; border-bottom: 4px solid #D4AF37;">
        <div class="container">
           <center><h1 class="new-font mb-4 text-white">Yönetici Bilgileri <i style="color: #D4AF37;" class="fas fa-info-circle"></i></h1></center>
        </div>
    </div>
    
    <div class="container-fluid mt--7">
        <div class="order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-12">
                  <center>
                      <?php if($admin_type == 'super_admin'){ ?>
                        <h4 style="color: #54B435;" class="new-font"><i class="fas fa-users-cog"></i> Süper Yönetici</h4>
                        <h6 style="color: #6B728E;" class="new-font"><i class="fas fa-exclamation-circle"></i> Süper Yönetici'nin bilgilerini güncelleyemezsiniz ve Silemezsiniz</h6>
                      <?php }else{ ?>
                        <h4 style="color: #54B435;" class="new-font"><i class="fas fa-user"></i> Yönetici</h4>
                      <?php } ?>
                  </center>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form method="post" action="process/crud_admin.php">
                <h6 class="heading-small text-muted mb-4">Yönetici Bilgileri</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Ad Soyad</label>
                        <input type="text" name="admin_full_name" class="form-control form-control-alternative" value="<?php echo $fullName ?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Mail Adresi</label>
                        <input type="email" name="admin_email" class="form-control form-control-alternative" value="<?php echo $email ?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Parola</label>
                        <input type="password" name="admin_password" class="form-control form-control-alternative" value="<?php echo $password ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                        <?php if($logged_in_admin_type =='super_admin'){ ?>
                            <button type="submit" name="update_admin_info" value="<?php echo $admin_id  ?>" class="btn btn-primary">Güncelle</button>
                            <button type="submit" name="remove_admin" value="<?php echo $admin_id  ?>" class="btn btn-danger">Sil</button>
                        <?php } ?>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between