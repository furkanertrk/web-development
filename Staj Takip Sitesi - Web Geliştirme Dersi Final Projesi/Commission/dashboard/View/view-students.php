<?php 
  session_start();
  if(!isset($_SESSION['commission_id'])){
    header('location: ../../commission_login.php');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Komisyon - Öğrenci Listesi</title>
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
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Bildirim</a>
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
            <a href="../examples/profile.php" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>Profil</span>
            </a>
            <a href="../examples/profile.php" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Ayarlar</span>
            </a>
            <a href="../examples/profile.php" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Etkinlikler</span>
            </a>
            <div class="dropdown-divider"></div>
            <span>
                <?php
                    if(isset($_SESSION['commission_id'])){
                      echo '<a href="../logout.php"><i class="ml-3 mr-2 ni ni-user-run"></i>Çıkış</a>';
                    }else{
                      echo 'Çıkış';
                    }
                ?>
            </span>
          </div>
      </ul>
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="../index.php">
                NEÜ Bilişim
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
            <h3 class="new-font">
            <div class="online-indicator">
              <span class="blink"></span>
            </div>
              <?php echo $_SESSION['commission_name']; ?></h3>
            <h5 class="new-font">Komisyon Üyesi</h5>
          </center>
          <hr class="my-3">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">
              <i class="ni ni-tv-2 text-primary"></i> Anasayfa
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../examples/profile.php">
              <i class="ni ni-single-02 text-yellow"></i> Profil
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../examples/announcements.php">
              <i class="fas fa-bullhorn text-success"></i> Duyurular
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../examples/add_announcement.php">
              <i class="far fa-calendar-plus text-red"></i> Duyuru Ekle
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
                        if(isset($_SESSION['commission_id'])){
                          echo $_SESSION['commission_name'];
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
                <h6 class="text-overflow m-0">Hoş Geldiniz!</h6>
              </div>
              <a href="../examples/profile.php" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>Profil</span>
              </a>
              <a href="../examples/profile.php" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Ayarlar</span>
              </a>
              <a href="../examples/profile.php" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Etkinlikler</span>
              </a>
              <div class="dropdown-divider"></div>
              <span>
                    <?php
                        if(isset($_SESSION['commission_id'])){
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
    <div class="header pb-8 pt-5 pt-md-8 bg-neu-dark d-flex align-items-center">
        </div>
    
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Öğrenci Listesi</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ad Soyad</th>
                        <th scope="col">Öğrenci NO</th>
                        <th scope="col">Staj 1</th>
                        <th scope="col">Staj 2</th>
                        </tr>
                </thead>
                <tbody>
                    <?php
                        $connection = mysqli_connect('localhost', 'root','','yazgeldb');
                        $sql = "SELECT * FROM student";
                        $result = mysqli_query($connection, $sql);
                        if(mysqli_num_rows($result) == 0){
                            echo '<tr><td colspan="5"><h4 style="text-align:center;">Kayıt bulunamadı!</h4></td></tr>';
                        }else{
                            $i = 1;
                            while($new_row = mysqli_fetch_assoc($result)){
                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i ?></th>
                                        <td><?php echo $new_row['ogrenci_ad_soyad']; ?></td>
                                        <td><?php echo $new_row['ogrenci_okul_no']; ?></td>
                                        <td>
                                            <?php
                                                $student_number = $new_row['ogrenci_okul_no'];
                                                $sqll = "SELECT * FROM staj_takibi WHERE staj_tur='staj1' AND ogrenci_numarasi='$student_number'";
                                                $res = mysqli_query($connection, $sqll);
                                                if(mysqli_num_rows($res) == 0){
                                                    echo '<i style="color: red;" class="fas fa-times"></i>';
                                                }else{
                                                    while($r = mysqli_fetch_assoc($res)){
                                                        if($r['staj_durumu'] == 'done'){
                                                            echo '<i style="color: #3CCF4E;" class="fas fa-check"></i>';
                                                        }else{
                                                            echo '<i style="color: red;" class="fas fa-times"></i>';
                                                        }
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                $student_number = $new_row['ogrenci_okul_no'];
                                                $sqll = "SELECT * FROM staj_takibi WHERE staj_tur='staj2' AND ogrenci_numarasi='$student_number'";
                                                $res = mysqli_query($connection, $sqll);
                                                if(mysqli_num_rows($res) == 0){
                                                    echo '<i style="color: red;" class="fas fa-times"></i>';
                                                }else{
                                                    while($r = mysqli_fetch_assoc($res)){
                                                        if($r['staj_durumu'] == 'done'){
                                                            echo '<i style="color: #3CCF4E;" class="fas fa-check"></i>';
                                                        }else{
                                                            echo '<i style="color: red;" class="fas fa-times"></i>';
                                                        }
                                                    }
                                                }
                                            ?>
                                        </td>
                                        </tr>
                    <?php
                    $i++;
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