<?php 
  session_start();
  if(!isset($_SESSION['teacher_id'])){
    header('location: ../../teacher_login.php');
    exit();
  }
  $intern1_count = 0;
  $intern2_count = 0;
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <title>NEÜ Öğretmen Paneli</title>
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="./assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="./assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="./assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&display=swap');
    .new-font{font-family: 'IBM Plex Sans JP', sans-serif;}
    div.online-indicator { display: inline-block; width: 15px; height: 15px; margin-right: 10px; background-color: #0fcc45; border-radius: 50%; position: relative; }
    span.blink { display: block; width: 15px; height: 15px; background-color: #0fcc45; opacity: 0.7; border-radius: 50%; animation: blink 1s linear infinite; }
    @keyframes blink { 100% { transform: scale(2, 2); opacity: 0; } }
    .chartContainer{ background-color: #fff; padding: 2%; border-radius: 10px; box-shadow: 0 0 2rem 0 rgba(136, 152, 170, 0.15); }
  </style>
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"><span class="navbar-toggler-icon"></span></button>
      <a class="pt-0" href="./index.php">
        <center><img style="width: 70%; height:auto;" src="assets/img/theme/neu-logo.png" alt="NEÜ Logo"></center>
      </a>
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <center>
            <h4 class="new-font"><div class="online-indicator"><span class="blink"></span></div> <?php echo $_SESSION['teacher_name']; ?></h4>
            <h5 class="new-font">Öğretmen Üyesi</h5>
          </center>
          <li class="nav-item active"><a class="nav-link active" href="./index.php"><i class="ni ni-tv-2 text-primary"></i> Anasayfa</a></li>
          <li class="nav-item"><a class="nav-link" href="./examples/profile.php"><i class="ni ni-single-02 text-yellow"></i> Profil</a></li>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="main-content">
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <a class="h4 mb-0 text-uppercase d-none d-lg-inline-block" href="./index.php">Anasayfa'ya Dön</a>
      </div>
    </nav>
    
    <div class="header pb-8 pt-5 pt-md-8" style="background-color: #0F203F; border-bottom: 4px solid #D4AF37;">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row">
            <div class="col-xl-6 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <span class="h2 font-weight-bold mb-0">
                        <?php
                          $connection = mysqli_connect('localhost','root','','yazgeldb');
                          $teacher_number = $_SESSION['teacher_number'];
                          $sql = "SELECT * FROM staj_takibi WHERE staj_tur='staj1' AND ogretmen_numarasi='$teacher_number'";
                          $result = mysqli_query($connection, $sql);
                          echo mysqli_num_rows($result);
                          $intern1_count = mysqli_num_rows($result);
                        ?>
                      </span> 
                      <h5 class="card-title text-uppercase text-muted mb-0">Staj 1 Öğrencisi</h5>
                    </div>
                    <div class="col-auto"><div class="icon icon-shape bg-warning text-white rounded-circle shadow"><i class="fas fa-users"></i></div></div>
                  </div>
                  <a href="View/internship1_view.php" class="btn btn-primary mt-5">Görüntüle</a>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <span class="h2 font-weight-bold mb-0">
                        <?php
                          $sql = "SELECT * FROM staj_takibi WHERE staj_tur='staj2' AND ogretmen_numarasi='$teacher_number'";
                          $result = mysqli_query($connection, $sql);
                          echo mysqli_num_rows($result);
                          $intern2_count = mysqli_num_rows($result);
                        ?>
                      </span> 
                      <h5 class="card-title text-uppercase text-muted mb-0">Staj 2 Öğrencisi</h5>
                    </div>
                    <div class="col-auto"><div class="icon icon-shape bg-yellow text-white rounded-circle shadow"><i class="fas fa-users"></i></div></div>
                  </div>
                  <a href="View/internship2_view.php" class="btn btn-primary mt-5">Görüntüle</a>
                </div>
              </div>
            </div>
            
            <?php
                $dataPoints = array(
                  array("label"=> "Staj 1 Öğrencisi", "y"=> $intern1_count),
                  array("label"=> "Staj 2 Öğrencisi", "y"=> $intern2_count)
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
        </div>
      </footer>
    </div>
  </div>
  <script src="./assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="./assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/plugins/chart.js/dist/Chart.min.js"></script>
  <script src="./assets/js/argon-dashboard.min.js?v=1.1.2"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script>
    window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      exportEnabled: true,
      title:{ text: "İstatistikler" },
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