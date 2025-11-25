<?php 
   session_start();
   if(!isset($_SESSION['studentID'])){
     header('location: ../../../index.php');
     exit();
   }
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Öğrenci - Duyurular</title>
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
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
    .col-lg-12{ border-radius: 6px; background-color: #EFF5F5; padding: 1%; margin: 1% 0; }
  </style>
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"><span class="navbar-toggler-icon"></span></button>
      
      <a class="pt-0" href="../index.php">
        <center><img style="width: 70%; height:auto;" src="../assets/img/theme/neu-logo.png"  alt="NEÜ Logo"></center>
      </a>
      
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <center>
            <h5 class="new-font"><div class="online-indicator"><span class="blink"></span></div> <?php echo $_SESSION['student_fullName']; ?></h5>
            <h5 class="new-font text-muted">Öğrenci</h5>
          </center>
          <hr class="my-3">
          <li class="nav-item"><a class="nav-link" href="../index.php"><i class="ni ni-tv-2 text-primary"></i> Anasayfa</a></li>
          <li class="nav-item"><a class="nav-link " href="./profile.php"><i class="ni ni-single-02 text-yellow"></i> Profil</a></li>
          <li class="nav-item"><a class="nav-link" href="./apply_internship.php"><i style="color: #764AF1;" class="fas fa-pen"></i> Staj Başvurusu</a></li>
          <li class="nav-item active"><a class="nav-link active" href="./announcements.php"><i class="fas fa-bullhorn text-success"></i> Duyurular</a></li>
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
                <span class="avatar avatar-sm rounded-circle"><img alt="Image placeholder" src="../assets/img/theme/man.jpg"></span>
                <div class="media-body ml-2 d-none d-lg-block"><span style="color: black;" class="mb-0 text-sm font-weight-bold"><?php echo isset($_SESSION['studentID']) ? $_SESSION['student_fullName'] : 'User'; ?></span></div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title"><h6 class="text-overflow m-0">Hoşgeldiniz!</h6></div>
              <a href="./profile.php" class="dropdown-item"><i class="ni ni-single-02"></i><span>Profil</span></a>
              <div class="dropdown-divider"></div>
              <span><a href="../logout.php" class="dropdown-item"><i class="ni ni-user-run"></i>Çıkış</a></span>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <div class="header pt-7 align-items-center bg-neu-dark" style="min-height: 700px;">
      <div class="container">
        <div class="card p-5 shadow">
          <center>
            <?php
            $connection = mysqli_connect('localhost','root','','yazgeldb');
            $sql = "SELECT * FROM announcement";
            $result = mysqli_query($connection, $sql);
            $announcement_count = mysqli_num_rows($result);
            ?>
            <button type="button" class="btn btn-primary position-relative mb-2">
                <i class="fas fa-bullhorn text-white"></i> Duyurular
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?php echo ($announcement_count < 10) ? '0'.$announcement_count : $announcement_count; ?>
            </span>
            </button>
            <p class="new-font" style="color:red ;"><?php if(isset($_SESSION['announcement_delete_msg'])){ echo $_SESSION['announcement_delete_msg']; unset($_SESSION['announcement_delete_msg']); } ?></p>
          </center>
          <div class="row">
            <?php
                $sql = "SELECT * FROM announcement ORDER BY announcement_datetime DESC";
                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) == 0){
                    echo "<center><p>Henüz herhangi bir duyuru eklenmemiştir!</p></center>";
                }else{
                    while($row = mysqli_fetch_assoc($result)){
            ?>
                        <div class="col-lg-12">
                            <h4 class="new-font"><?php echo substr($row['announcement_title'], 0, 50) ?>...</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#announcement<?php echo $row['announcement_id'] ?>">
                            <?php echo $row['announcement_datetime'] ?>
                            </button>
                
                            <div class="modal fade" id="announcement<?php echo $row['announcement_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="justify-content:justify ;"><?php echo $row['announcement_title'] ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>Duyuru Yayınlama Tarihi: <?php echo $row['announcement_datetime'] ?></h5>
                                    <p style="justify-content:justify ;"><?php echo $row['announcement_content'] ?></p>
                                    <span style="font-weight:800 ;">Ek: </span>
                                    <a target="_blank" href="../../../Commission/dashboard/examples/Announcements/<?php echo $row['announcement_file']; ?>" class="btn btn-light"><i class="fas fa-download"></i> İndirmek için tıklayın</a>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>
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