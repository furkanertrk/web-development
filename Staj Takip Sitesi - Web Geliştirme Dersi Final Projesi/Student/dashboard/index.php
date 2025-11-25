<?php 
  session_start();
  if(!isset($_SESSION['studentID'])){
    header('location: ../../index.php');
    exit();
  }
  $inter1_apply = 0;
  $intern2_apply = 0;
  //
  $student_number = $_SESSION['student_number'];
  $connection = mysqli_connect('localhost','root','','yazgeldb');
  //
  $sql = "SELECT * FROM staj_basvuru WHERE basvuru_turu='staj1' AND ogrenci_numarasi='$student_number'";
  $res1 = mysqli_query($connection, $sql);
  if(mysqli_num_rows($res1) > 0){
    $inter1_apply = 50; // Yüzde 50 yapıldı (2 seçenek kaldığı için)
  }
  //
  $sql2 = "SELECT * FROM staj_basvuru WHERE basvuru_turu='staj2' AND ogrenci_numarasi='$student_number'";
  $res2 = mysqli_query($connection, $sql2);
  if(mysqli_num_rows($res2) > 0){
    $intern2_apply = 50;
  }
?>
<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>NEÜ Öğrenci Paneli</title>
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <link href="./assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="./assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="./assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    .btn-alert{ border: none; background-color: transparent; padding: 2%; border-radius: 80%; box-shadow: 5px 5px 15px -5px rgba(0, 0, 0, 0.3); }
    .btn-alert img{ border-radius: 100%; }
    .modal-body{ text-align: center; }
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
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="pt-0" href="./index.php">
        <center><img style="width: 70%; height:auto;" src="./assets/img/theme/neu-logo.png" alt="NEÜ Logo"></center>
      </a>
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <center>
            <h5 class="new-font"><div class="online-indicator"><span class="blink"></span></div> <?php echo $_SESSION['student_fullName']; ?></h5>
            <h5 class="new-font text-muted">Öğrenci</h5>
          </center>
          <li class="nav-item active"><a class="nav-link active" href="./index.php"><i class="ni ni-tv-2 text-primary"></i> Anasayfa</a></li>
          <li class="nav-item"><a class="nav-link" href="./examples/profile.php"><i class="ni ni-single-02 text-yellow"></i> Profil</a></li>
          <li class="nav-item"><a class="nav-link" href="./examples/apply_internship.php"><i style="color: #764AF1;" class="fas fa-pen"></i> Staj Başvurusu</a></li>
          <li class="nav-item"><a class="nav-link" href="./examples/announcements.php"><i class="fas fa-bullhorn text-green"></i> Duyurular</a></li>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="main-content">
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <a class="h4 mb-0 text-uppercase d-none d-lg-inline-block" href="../index.php" style="color: #fff;">Anasayfa'ya Dön</a>
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle"><img alt="Image placeholder" src="./assets/img/theme/man.jpg"></span>
                <div class="media-body ml-2 d-none d-lg-block"><span class="mb-0 text-sm font-weight-bold text-white"><?php echo isset($_SESSION['studentID']) ? $_SESSION['student_fullName'] : 'Logout'; ?></span></div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                <div class="dropdown-header noti-title"><h6 class="text-overflow m-0">Hoşgeldiniz!</h6></div>
                <a href="./examples/profile.php" class="dropdown-item"><i class="ni ni-single-02"></i><span>Profil</span></a>
                <div class="dropdown-divider"></div>
                <a href="../logout.php" class="dropdown-item"><i class="ni ni-user-run"></i><span>Çıkış Yap</span></a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <div class="header pb-8 pt-5 pt-md-8" style="background-color:#0F203F; border-bottom: 4px solid #D4AF37;">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row">
            <div class="col-xl-6 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                    <h5 class="card-title text-uppercase mb-0"><b>Staj 1 Takibi</b></h5>
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5">Bildirim</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                          <?php
                            $connection = mysqli_connect('localhost','root','','yazgeldb');
                            $student_number = $_SESSION['student_number'];
                            $sql = "SELECT * FROM staj_takibi WHERE ogrenci_numarasi='$student_number' AND staj_tur='staj1'";
                            $result = mysqli_query($connection, $sql);
                            if(mysqli_num_rows($result)==0){
                              echo 'Staj Başvurunuz Bulunmadı! <br><img class="mt-3" style="width:40%;" src="Internship/img/no-result.png">';
                            }else{
                              while($row=mysqli_fetch_assoc($result)){
                                $status = $row['staj_durumu'];
                                if($status == 'yeni_basvuru') echo 'Başvurunuz Yapıldı!<br><img class="mt-3" style="width:40%;" src="Internship/img/tick-mark.png">';
                                elseif($status == 'degerlendirme') echo 'Değerlendirmeye Alındı!<br><img class="mt-3" style="width:40%;" src="Internship/img/evaluation.png">';
                                elseif($status == 'onaylandi') echo 'Onaylandı!<br><img class="mt-3" style="width:40%;" src="Internship/img/tick-mark.png">';
                                elseif($status == 'eksik_belge') echo '<span style="color:red;">Eksik Belge!<br><img class="mt-3" style="width:40%;" src="Internship/img/missing-doc.png"></span>';
                                elseif($status == 'done') echo 'Tamamlandı!<br><img class="mt-3" style="width:40%;" src="Internship/img/done.png">';
                                else echo 'Bildirim Yok';
                              }
                            }
                          ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                            <a href="Internship/staj1-takibi.php" class="btn btn-primary">Görüntüle</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <button type="button" class="btn-alert" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          <img style="width:60px;" src="Internship/img/notification.gif">
                        </button>
                      </div>
                    </div>
                  </div>
                  <a href="Internship/staj1-takibi.php" class="btn btn-primary mt-3">Takip Et</a>
                </div>
              </div>
            </div>

            <div class="col-xl-6 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                    <h5 class="card-title text-uppercase mb-0"><b>Staj 2 Takibi</b></h5>
                    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5">Bildirim</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                          <?php
                            $sql = "SELECT * FROM staj_takibi WHERE ogrenci_numarasi='$student_number' AND staj_tur='staj2'";
                            $result = mysqli_query($connection, $sql);
                            if(mysqli_num_rows($result)==0){
                                echo 'Staj Başvurunuz Bulunmadı! <br><img class="mt-3" style="width:40%;" src="Internship/img/no-result.png">';
                            }else{
                              while($row=mysqli_fetch_assoc($result)){
                                $status = $row['staj_durumu'];
                                if($status == 'yeni_basvuru') echo 'Başvurunuz Yapıldı!<br><img class="mt-3" style="width:40%;" src="Internship/img/tick-mark.png">';
                                elseif($status == 'degerlendirme') echo 'Değerlendirmeye Alındı!<br><img class="mt-3" style="width:40%;" src="Internship/img/evaluation.png">';
                                elseif($status == 'onaylandi') echo 'Onaylandı!<br><img class="mt-3" style="width:40%;" src="Internship/img/tick-mark.png">';
                                elseif($status == 'eksik_belge') echo '<span style="color:red;">Eksik Belge!<br><img class="mt-3" style="width:40%;" src="Internship/img/missing-doc.png"></span>';
                                elseif($status == 'done') echo 'Tamamlandı!<br><img class="mt-3" style="width:40%;" src="Internship/img/done.png">';
                                else echo 'Bildirim Yok';
                              }
                            }
                          ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                            <a href="Internship/staj2-takibi.php" class="btn btn-primary">Görüntüle</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <button type="button" class="btn-alert" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                          <img style="width:60px;" src="Internship/img/notification.gif">
                        </button>
                      </div>
                    </div>
                  </div>
                  <a href="Internship/staj2-takibi.php" class="btn btn-primary mt-3">Takip Et</a>
                </div>
              </div>
            </div>
            
            <?php
                $dataPoints = array(
                  array("label"=> "Staj 1 Başvurusu", "y"=> $inter1_apply),
                  array("label"=> "Staj 2 Başvurusu", "y"=> $intern2_apply)
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
  <script src="./assets/js/argon-dashboard.min.js?v=1.1.2"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script>
    window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      exportEnabled: true,
      title:{ text: "Staj Başvuru İstatistikleri" },
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