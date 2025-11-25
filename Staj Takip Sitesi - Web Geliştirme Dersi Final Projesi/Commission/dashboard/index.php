<?php 
  session_start();
  if(!isset($_SESSION['commission_id'])){
    header('location: ../../commission_login.php');
    exit();
  }
  $student_count = 0;
  $teacher_count = 0;
  $intern1_student_count = 0;
  $intern2_student_count = 0;
  $commission_count = 0;
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>NEÜ Komisyon Paneli</title>
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="./assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="./assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="./assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&display=swap');
    .new-font{font-family: 'IBM Plex Sans JP', sans-serif;}
    
    /* NEÜ Renk Paleti */
    .bg-neu-dark { background-color: #0F203F !important; }
    .text-neu-gold { color: #D4AF37 !important; }

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
    .chartContainer{
      background-color: #fff;
      padding: 2%;
      border-radius: 10px;
      box-shadow: 0 0 2rem 0 rgba(136, 152, 170, 0.15);
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class=" pt-0" href="./index.php">
        <center>
          <img style="width: 70%; height:auto;" src="assets/img/theme/neu-logo.png"  alt="NEÜ Logo">
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
            <a class="dropdown-item" href="#">Bildirim</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="./assets/img/theme/man.jpg">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Hoşgeldiniz!</h6>
            </div>
            <a href="./examples/profile.php" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>Profil</span>
            </a>
            <a href="./examples/profile.php" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Ayarlar</span>
            </a>
            <a href="./examples/profile.php" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Etkinlikler</span>
            </a>
            <div class="dropdown-divider"></div>
            <span>
                    <?php
                        if(isset($_SESSION['commission_id'])){
                          echo '<a href="logout.php"><i class="ml-3 mr-2 ni ni-user-run"></i>Çıkış</a>';
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
              <a href="./index.php">Anasayfa</a>
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
            <h5 class="new-font text-muted">Komisyon Üyesi</h5>
          </center>
          <hr class="my-3">
          <li class="nav-item active">
            <a class="nav-link active" href="./index.php">
              <i class="ni ni-tv-2 text-primary"></i> Anasayfa
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./examples/profile.php">
              <i class="ni ni-single-02 text-yellow"></i> Profil
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./examples/announcements.php">
              <i class="fas fa-bullhorn text-success"></i> Duyurular
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./examples/add_announcement.php">
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.php">Komisyon Paneli</a>
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="./assets/img/theme/man.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm font-weight-bold text-white">
                  <span>
                  <?php
                        if(isset($_SESSION['commission_id'])){
                          echo $_SESSION['commission_name'];
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
                <h6 class="text-overflow m-0">Hoşgeldiniz</h6>
              </div>
              <a href="./examples/profile.php" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>Profil</span>
              </a>
              <a href="./examples/profile.php" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Ayarlar</span>
              </a>
              <a href="./examples/profile.php" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Etkinlikler</span>
              </a>
              <div class="dropdown-divider"></div>
              <span>
                    <?php
                        if(isset($_SESSION['commission_id'])){
                          echo '<a href="logout.php"><i class="ml-3 mr-2 ni ni-user-run"></i>Çıkış</a>';
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
    <div class="header pb-8 pt-5 pt-md-8 bg-neu-dark">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row">
            <?php
              if(isset($_SESSION['commission_id'])){
                    $commission_id = $_SESSION['commission_id'];
                    $connection = mysqli_connect('localhost','root','','yazgeldb');
                    $sql = "SELECT * FROM teacher WHERE ogretmen_id='$commission_id' and role='komisyon'";
                    $result = mysqli_query($connection, $sql);
                    while($row = mysqli_fetch_assoc($result)){
          ?>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase mb-0"><?php echo $row['ogretmen_ad_soyad'] ?></h5>
                      <h5 class="card-title text-uppercase text-muted mb-0"><?php echo $row['ogretmen_okul_no'] ?></h5>
                      <h5 class="card-title text-uppercase text-muted mb-0">Necmettin Erbakan Üniversitesi</h5>
                      <h5 class="card-title text-uppercase text-muted mb-0"><?php echo $row['ogretmen_fakulte_adi'] ?> Fakültesi</h5>
                      <h5 class="card-title text-uppercase text-muted mb-0"><?php echo $row['ogretmen_bolum_adi'] ?></h5>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                      <i class="fas fa-user"></i>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-primary"><a style="color:#fff ;" href="examples/profile.php">Görüntüle</a></button>
                </div>
              </div>
            </div>
            <?php
                }
              }
          ?>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <span class="h2 font-weight-bold mb-0">
                        <?php
                          $connection = mysqli_connect('localhost','root','','yazgeldb');
                          $sql = "SELECT * FROM student";
                          $result = mysqli_query($connection, $sql);
                          echo mysqli_num_rows($result);
                          $student_count = mysqli_num_rows($result);
                        ?>
                      </span> 
                      <h5 class="card-title text-uppercase text-muted mb-0">Öğrenci</h5>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                      <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-primary mt-5"><a style="color:#fff ;" href="View/view-students.php">Görüntüle</a></button>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <span class="h2 font-weight-bold mb-0">
                        <?php
                          $connection = mysqli_connect('localhost','root','','yazgeldb');
                          $sql = "SELECT * FROM teacher";
                          $result = mysqli_query($connection, $sql);
                          echo mysqli_num_rows($result);
                          $teacher_count = mysqli_num_rows($result);
                        ?>
                      </span> 
                      <h5 class="card-title text-uppercase text-muted mb-0">Öğretmen</h5>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                      <i class="fas fa-user-tie"></i>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-primary mt-5"><a style="color:#fff ;" href="View/view-teachers.php">Görüntüle</a></button>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <span class="h2 font-weight-bold mb-0">
                        <?php
                          $connection = mysqli_connect('localhost','root','','yazgeldb');
                          $sql = "SELECT * FROM staj_basvuru WHERE basvuru_turu='staj1'";
                          $result = mysqli_query($connection, $sql);
                          echo mysqli_num_rows($result);
                          $intern1_student_count = mysqli_num_rows($result);
                        ?>
                      </span> 
                      <h5 class="card-title text-uppercase text-muted mb-0">Staj 1 Öğrencileri</h5>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-primary mt-5"><a style="color:#fff ;" href="View/internship1_view.php">Görüntüle</a></button>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 mt-3">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                    <span class="h2 font-weight-bold mb-0">
                        <?php
                          $connection = mysqli_connect('localhost','root','','yazgeldb');
                          $sql = "SELECT * FROM staj_basvuru WHERE basvuru_turu='staj2'";
                          $result = mysqli_query($connection, $sql);
                          echo mysqli_num_rows($result);
                          $intern2_student_count = mysqli_num_rows($result);
                        ?>
                      </span> 
                      <h5 class="card-title text-uppercase text-muted mb-0">Staj 2 Öğrencileri</h5>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-primary mt-5"><a style="color:#fff ;" href="View/internship2_view.php">Görüntüle</a></button>
                </div>
              </div>
            </div>
            
            <?php
                // İME verileri grafik dizisinden çıkarıldı
                $dataPoints = array(
                  array("label"=> "Öğrenci", "y"=> $student_count),
                  array("label"=> "Öğretmen", "y"=> $teacher_count),
                  array("label"=> "Staj 1 Öğrencisi", "y"=> $intern1_student_count),
                  array("label"=> "Staj 2 Öğrencisi", "y"=> $intern2_student_count),
                  array("label"=> "Komisyon Üyesi", "y"=> 5)
                );
              ?>
              <div class="container mt-7">
                <div class="row">
                  <div class="col-lg-12 chartContainer">
                    <div id="chartContainer" style="height: 400px; width: 100%;"></div>
                  </div>
                </div>
              </div>
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
  <script src="./assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="./assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/plugins/chart.js/dist/Chart.min.js"></script>
  <script src="./assets/js/plugins/chart.js/dist/Chart.extension.js"></script>
  <script src="./assets/js/argon-dashboard.min.js?v=1.1.2"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script>
    window.onload = function () {
    
    var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      exportEnabled: true,
      title:{
        text: "İstatistikler"
      },
      data: [{
        type: "pie",
        showInLegend: "true",
        legendText: "{label}",
        indexLabelFontSize: 16,
        indexLabel: "{label} - #percent%",
        yValueFormatString: "฿#,##0",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
      }]
    });
    chart.render();
    
    }
  </script>
</body>

</html>