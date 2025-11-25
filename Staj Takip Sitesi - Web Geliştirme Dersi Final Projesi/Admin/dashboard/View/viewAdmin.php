<?php
session_start(); 
if(!isset($_SESSION['adminID'])){
  header('location: ../../../admin_login.php');
  exit();
} 
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Yönetici - Yönetici Listesi</title>
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
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"><span class="navbar-toggler-icon"></span></button>
      <a class="pt-0" href="../index.php"><center><img style="width: 70%; height:auto;" src="../assets/img/theme/neu-logo.png"  alt="NEÜ Logo"></center></a>
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <center>
            <h3 class="new-font"><div class="online-indicator"><span class="blink"></span></div> <?php echo $_SESSION['admin_fullName']; ?></h3>
            <h5 class="new-font"><?php $admin_id = $_SESSION['adminID']; $connection = mysqli_connect('localhost','root','','yazgeldb'); $sql = "SELECT * FROM admin WHERE admin_id='$admin_id'"; $res = mysqli_query($connection, $sql); while($row=mysqli_fetch_assoc($res)){ if($row['admin_type'] == 'super_admin'){ echo 'Süper Yönetici'; }else{ echo 'Yönetici'; } } ?></h5>
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
      </div>
    </nav>
    
    <div class="header pb-8 pt-5 pt-md-8" style="background-color: #0F203F; border-bottom: 4px solid #D4AF37;">
        <div class="container">
            <center><h1 class="new-font mb-4 text-white">Yöneticiler Listesi <i style="color: #D4AF37;" class="fas fa-info-circle"></i></h1></center>
            <div class="card shadow">
            <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped table-hover align-items-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ad Soyad</th>
                        <th scope="col">Mail Adresi</th>
                        <th scope="col">Parola</th>
                        <th scope="col">İşlem</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                      require '../Backend/Admin/view_all_admins.php';
                      $users = new ViewAdmins();
                      $row =  $users->ViewAllAdmins();
                      if(count($row)==0){
                        echo '<tr><td colspan="5" class="text-center">Yönetici Bulunamadı!</td></tr>';
                      }else{
                      for($i = 0; $i<count($row); $i++){ 
                  ?>
                          <tr>
                            <th scope="row"><?php echo $i+1 ?></th>
                            <td><?php echo $row[$i]['admin_full_name'] ?></td>
                            <td><?php echo $row[$i]['admin_email'] ?></td>
                            <td><?php echo $row[$i]['admin_password'] ?></td>
                            <td>
                              <a class="btn btn-sm btn-primary" style="color:#fff;" href="../Info/AdminInfo.php?view-admin=<?php echo $row[$i]['admin_id'] ?>">Görüntüle</a>
                            </td>
                          </tr>
                <?php } } ?>
                </tbody>
            </table>
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