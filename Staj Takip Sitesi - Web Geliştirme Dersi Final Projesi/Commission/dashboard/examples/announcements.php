<?php 
  session_start();
  if(!isset($_SESSION['commission_id'])){
    header('location: ../../commission_login.php');
    exit();
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if(isset($_GET['delete'])){
    $announcement_id = test_input($_GET['delete']);
    $connection = mysqli_connect('localhost','root','','yazgeldb');
    $sql = "DELETE FROM announcement WHERE announcement_id='$announcement_id'";
    $res = mysqli_query($connection, $sql);
    if($res){
      $_SESSION['announcement_delete_msg']= "Duyuru Başarıyla Silindi";
      header('location: announcements.php?announcement-delete=success');
      exit();
    }else{
      $_SESSION['announcement_delete_msg']= "Sistemde bir hata oluştu! Silme eylemi gerçekleşemedi!";
      header('location: announcements.php?announcement-delete=error');
      exit();
    }
  }
  
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Komisyon - Duyurular</title>
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&display=swap');
    .new-font{font-family: 'IBM Plex Sans JP', sans-serif;}
    
    /* NEÜ Özel Renkler */
    .bg-neu-dark { background-color: #0F203F !important; }
    .text-primary { color: #0F203F !important; }
    .btn-primary {
        background-color: #0F203F !important;
        border-color: #0F203F !important;
        color: #fff !important;
    }
    .btn-primary:hover { background-color: #09152b !important; }
    
    /* Buton güncellemesi (Yeşil -> Lacivert) */
    .btn-success {
        background-color: #0F203F !important;
        border-color: #0F203F !important;
    }

    /* animated texts */
    .colorized-span{ font-size: 60px; }
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
    .card input[type=file]{
      box-shadow: 5px 5px 15px -5px rgba(0, 0, 0, 0.5);
    }
    .card input[type=file]::file-selector-button {
        background-color: #fff;
        border: 0px;
        margin-right: 20px;
        transition: .5s;
        border-radius: 5px;
        cursor: pointer;
    }
    .col-lg-12{
        border-radius: 6px;
        background-color: #EFF5F5;
        padding: 1%;
        margin: 1% 0;
    }
    .count-span{
        background-color: #0F203F; /* Lacivert yapıldı */
        border-radius: 100px;
        padding: 5px;
        text-align: center;
        color: #fff;
        font-size: 13px;
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
          <img style="width: 80%; max-height: 150px;" src="../assets/img/theme/neu-logo.png" alt="NEÜ Logo">
        </center>
      </a>
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
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
              <h6 class="text-overflow m-0">Hoşgeldiniz</h6>
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
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="../index.html">
                <img src="../assets/img/theme/neu-logo.png">
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
          <li class="nav-item">
            <a class="nav-link" href="../index.php">
              <i class="ni ni-tv-2 text-primary"></i> Anasayfa
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./profile.php">
              <i class="ni ni-single-02 text-yellow"></i> Profil
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link active" href="./announcements.php">
              <i class="fas fa-bullhorn text-green"></i> Duyurular
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./add_announcement.php">
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
        <a class="h4 mb-0 text-uppercase d-none d-lg-inline-block" href="../index.php" style="color: #0F203F;">Anasayfa'ya Dön</a>
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="../assets/img/theme/man.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span style="color: black;" class="mb-0 text-sm  font-weight-bold">
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
          </li>
        </ul>
      </div>
    </nav>
    <div class="header pt-7 align-items-center" style="background-color: #EFF5F5; min-height: 700px;">
      <div class="container">
        <div class="card p-5">
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
            <?php
                if($announcement_count < 10){
                    echo '0'.$announcement_count;
                }else{
                    echo $announcement_count;
                }
            ?>
            </span>
            </button>
            <p class="new-font" style="color:red ;">
                <?php
                  if(isset($_SESSION['announcement_delete_msg'])){
                    echo $_SESSION['announcement_delete_msg'];
                    unset($_SESSION['announcement_delete_msg']);
                  }
                ?>
            </p>
          </center>
          <div class="row">
            <?php
                $connection = mysqli_connect('localhost','root','','yazgeldb');
                $sql = "SELECT * FROM announcement ORDER BY announcement_datetime DESC";
                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) == 0){
                    echo "<center><p>Henüz herhangi bir duyuru eklenmemiştir!</p></center>";
                }else{
                    while($row = mysqli_fetch_assoc($result)){
                        $author = $row['announcement_author'];
                        $new_author="Komisyon Daire Başkanlığı";
                        $new_sql = "SELECT role from teacher WHERE ogretmen_okul_no='$author'";
                        $res = mysqli_query($connection, $new_sql);
                        while($r = mysqli_fetch_assoc($res)){
                            if($r['role'] == 'komisyon'){
                                $new_author = 'Komisyon Daire Başkanlığı';
                            }else{
                                $new_author = 'Öğretmen Daire Başkanlığı';
                            }
                        }
            ?>
                        <div class="col-lg-12">
                            <h4 class="new-font"><?php echo substr($row['announcement_title'], 0, 50) ?>...</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#announcement<?php echo $row['announcement_id'] ?>">
                            <?php echo $row['announcement_datetime'] ?>
                            </button>
                            <span style="color: #6B728E;"><i class="fad fa-pen-square"></i> <?php echo $new_author ?></span>
                            <a href="announcements.php?delete=<?php echo $row['announcement_id'] ?>" class="btn" style="float:right ;color:red;"><i class="fas fa-trash-alt"></i></a>

                            <div class="modal fade" id="announcement<?php echo $row['announcement_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="justify-content:justify ;"><?php echo $row['announcement_title'] ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>Duyuru Yayınlama Tarihi: <?php echo $row['announcement_datetime'] ?></h5>
                                    <p style="justify-content:justify ;">
                                    <?php echo $row['announcement_content'] ?>
                                    </p>
                                    <span style="font-weight:800 ;">Ek: </span>
                                    <a target="_blank" href="./Announcements/<?php echo $row['announcement_file']; ?>" class="btn btn-light"><i class="fas fa-download"></i> İndirmek için tıklayın</a>
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
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2025 <a href="https://www.erbakan.edu.tr/" class="font-weight-bold ml-1" style="color: #0F203F;">Necmettin Erbakan Üniversitesi</a>
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