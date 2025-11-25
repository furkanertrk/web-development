<?php
  session_start(); 
  if(!isset($_SESSION['adminID'])){
    header('location: ../../admin_login.php');
    exit();
  }  
  $user_count = 0;
  $admin_count = 0;
  $student_count = 0;
  $teacher_count = 0;
  $inter_count = 0;
  $commission_count = 0;
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <title>NEÜ Yönetici Paneli</title>
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
    .bg-neu-dark { background-color: #0F203F !important; }
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
          <li class="nav-item active"><a class="nav-link active" href="./index.php"><i class="ni ni-tv-2 text-primary"></i> Anasayfa</a></li>
          <li class="nav-item"><a class="nav-link" href="./examples/profile.php"><i class="ni ni-single-02 text-yellow"></i> Profil</a></li>
          <li class="nav-item"><a class="nav-link" href="./examples/register.php"><i class="ni ni-circle-08 text-pink"></i> Kullanıcı Ekle</a></li>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="main-content">
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.php">Yönetim Paneli</a>
      </div>
    </nav>
    
    <div class="header pb-8 pt-5 pt-md-8 bg-neu-dark">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row">
          <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Yeni Kullanıcı</h5>
                      <span class="h3 font-weight-bold mb-0">
                      <?php 
                        require 'Backend/User/view_all_users.php';
                        $users = new ViewUsers();
                        $row =  $users->viewAllUsers();
                        echo count($row);
                        $user_count = count($row);
                      ?>
                      </span>
                    </div>
                    <div class="col-auto"><div class="icon icon-shape bg-danger text-white rounded-circle shadow"><i class="fas fa-user"></i></div></div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm"><a href="View/viewUser.php" class="btn btn-sm btn-primary">Görüntüle</a></p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Yönetici</h5>
                      <span class="h3 font-weight-bold mb-0">
                      <?php 
                        $admins = new ViewUsers();
                        $row =  $admins->viewAllAdmins();
                        echo count($row);
                        $admin_count = count($row);
                      ?>
                      </span>
                    </div>
                    <div class="col-auto"><div class="icon icon-shape bg-primary text-white rounded-circle shadow"><i class="fas fa-user-cog"></i></div></div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm"><a href="View/viewAdmin.php" class="btn btn-sm btn-primary">Görüntüle</a></p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Komisyon</h5>
                      <span class="h3 font-weight-bold mb-0">
                      <?php 
                        $commission = new ViewUsers();
                        $row =  $commission->viewAllCommission();
                        echo count($row);
                        $commission_count = count($row);
                      ?>
                      </span>
                    </div>
                    <div class="col-auto"><div class="icon icon-shape bg-warning text-white rounded-circle shadow"><i class="fas fa-chart-pie"></i></div></div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm"><a href="View/viewCommission.php" class="btn btn-sm btn-primary">Görüntüle</a></p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Öğretmen</h5>
                      <span class="h3 font-weight-bold mb-0">
                      <?php 
                        $teachers = new ViewUsers();
                        $row =  $teachers->viewAllTeachers();
                        echo count($row);
                        $teacher_count = count($row);
                      ?>
                      </span>
                    </div>
                    <div class="col-auto"><div class="icon icon-shape bg-yellow text-white rounded-circle shadow"><i class="fas fa-users"></i></div></div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm"><a href="View/viewTeacher.php" class="btn btn-sm btn-primary">Görüntüle</a></p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 mt-4">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Öğrenci</h5>
                      <span class="h3 font-weight-bold mb-0">
                      <?php 
                        $students = new ViewUsers();
                        $row =  $students->viewAllStudents();
                        echo count($row);
                        $student_count = count($row);
                      ?>
                      </span>
                    </div>
                    <div class="col-auto"><div class="icon icon-shape bg-success text-white rounded-circle shadow"><i class="fas fa-users"></i></div></div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm"><a href="View/viewStudent.php" class="btn btn-sm btn-primary">Görüntüle</a></p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 mt-4">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Staj</h5>
                      <span class="h3 font-weight-bold mb-0">
                        <?php
                          $connection = mysqli_connect('localhost','root','','yazgeldb');
                          $sql = "SELECT * FROM staj_basvuru";
                          $result = mysqli_query($connection, $sql);
                          echo mysqli_num_rows($result);
                          $inter_count = mysqli_num_rows($result);
                        ?>
                      </span>
                    </div>
                    <div class="col-auto"><div class="icon icon-shape bg-info text-white rounded-circle shadow"><i class="fas fa-user"></i></div></div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm"><a href="View/viewStaj.php" class="btn btn-sm btn-primary">Görüntüle</a></p>
                </div>
              </div>
            </div>
            <?php
                $dataPoints = array(
                  array("label"=> "Kullanıcı", "y"=> $user_count),
                  array("label"=> "Öğretmen", "y"=> $teacher_count),
                  array("label"=> "Staj Öğrencisi", "y"=> $inter_count),
                  array("label"=> "Yönetici", "y"=> $admin_count),
                  array("label"=> "Öğrenci", "y"=> $student_count),
                  array("label"=> "Komisyon Üyesi", "y"=> $commission_count)
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
            <div class="copyright text-center text-xl-left text-muted">&copy; <?php echo date("Y"); ?> <a href="#" class="font-weight-bold ml-1">Necmettin Erbakan Üniversitesi</a></div>
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
      title:{ text: "İstatistikler" },
      data: [{
        type: "pie",
        showInLegend: "true",
        legendText: "{label}",
        indexLabelFontSize: 16,
        indexLabel: "{label} - #percent%",
        yValueFormatString: "#,##0",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
      }]
    });
    chart.render();
    }
  </script>
</body>
</html>