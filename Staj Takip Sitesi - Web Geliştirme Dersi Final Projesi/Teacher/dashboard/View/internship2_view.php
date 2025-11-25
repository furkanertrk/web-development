<?php 
  session_start();
  if(!isset($_SESSION['teacher_id'])){
    header('location: ../../teacher_login.php');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Öğretmen - Staj 2 Öğrenci Listesi</title>
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
      <a class="pt-0" href="./index.php">
        <center><img style="width: 70%; height:auto;" src="../assets/img/theme/neu-logo.png"  alt="NEÜ Logo"></center>
      </a>
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <center>
            <h4 class="new-font"><div class="online-indicator"><span class="blink"></span></div> <?php echo $_SESSION['teacher_name']; ?></h4>
            <h5 class="new-font">Öğretmen Üyesi</h5>
          </center>
          <li class="nav-item active"><a class="nav-link active" href="../index.php"><i class="ni ni-tv-2 text-primary"></i> Anasayfa</a></li>
          <li class="nav-item"><a class="nav-link" href="../examples/profile.php"><i class="ni ni-single-02 text-yellow"></i> Profil</a></li>
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
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle"><img alt="Image placeholder" src="../assets/img/theme/man.jpg"></span>
                <div class="media-body ml-2 d-none d-lg-block"><span class="mb-0 text-sm font-weight-bold text-white"><?php echo isset($_SESSION['teacher_id']) ? $_SESSION['teacher_name'] : 'User'; ?></span></div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class="dropdown-header noti-title"><h6 class="text-overflow m-0">Hoşgeldiniz</h6></div>
              <a href="../examples/profile.php" class="dropdown-item"><i class="ni ni-single-02"></i><span>Profil</span></a>
              <div class="dropdown-divider"></div>
              <a href="../logout.php" class="dropdown-item"><i class="ni ni-user-run"></i><span>Çıkış Yap</span></a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    
    <div class="header pb-4 pt-2 pt-lg-8 d-flex align-items-center" style="min-height: 200px; background-color: #0F203F; border-bottom: 4px solid #D4AF37;">
        <div class="container">
        <center><h1 class="new-font mb-4 text-white">Staj 2 Öğrenci Listesi <i style="color: #D4AF37;" class="fas fa-info-circle"></i></h1></center>
            <div class="card shadow">
            <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ad Soyad</th>
                        <th scope="col">Öğrenci NO</th>
                        <th scope="col">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $connection = mysqli_connect('localhost', 'root','','yazgeldb');
                        $teacher_number = $_SESSION['teacher_number'];
                        $sql = "SELECT ogrenci_numarasi FROM staj_takibi WHERE staj_tur ='staj2' AND ogretmen_numarasi='$teacher_number'";
                        $result = mysqli_query($connection, $sql);
                        if(mysqli_num_rows($result) == 0){
                            echo '<tr><td colspan="4"><h4 style="text-align:center;">Kayıt bulunamadı!</h4></td></tr>';
                        }else{
                            while($row=mysqli_fetch_assoc($result)){
                                $student_number = $row['ogrenci_numarasi'];
                                $new_sql = "SELECT * FROM student WHERE ogrenci_okul_no='$student_number' ";
                                $new_result = mysqli_query($connection, $new_sql);
                                while($new_row=mysqli_fetch_assoc($new_result)){
                    ?>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td><?php echo $new_row['ogrenci_ad_soyad']; ?></td>
                                        <td><?php echo $new_row['ogrenci_okul_no']; ?></td>
                                        <td>
                                            <a href="view-internship2-student-info.php?view-student-info=<?php echo $new_row['kullanci_id'];?>" class="btn btn-primary btn-sm">Görüntüle</a>
                                            <a href="staj2_notlandir.php?view-student-info=<?php echo $new_row['kullanci_id'];?>" class="btn btn-success btn-sm">Notlandır</a>
                                        </td>
                                    </tr>
                    <?php
                                }
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
            <div class="copyright text-center text-xl-left text-muted">&copy; 2025 <a href="#" class="font-weight-bold ml-1">Necmettin Erbakan Üniversitesi</a></div>
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