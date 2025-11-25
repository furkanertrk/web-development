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

  if(isset($_POST['add-announcement-btn'])){

    $announcement_title = test_input($_POST['announcement_title']);
    $announcement_content = test_input($_POST['announcement_content']);
    $announcement_file = $_FILES['announcement_file'];
    $announcement_author = $_SESSION['commission_number'];

    $fileName = $_FILES['announcement_file']['name'];
    $fileTmpName = $_FILES['announcement_file']['tmp_name'];
    $fileSize = $_FILES['announcement_file']['size'];
    $error = $_FILES['announcement_file']['error'];
    $fileType = $_FILES['announcement_file']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExtension = strtolower(end($fileExt));

    $allowed = array('pdf','docx','doc','png','jpeg','jpg','xlsx','ppt');

    if(in_array($fileActualExtension, $allowed)){
        if($error === 0){
            if($fileSize > 5000){
                $fileNameNew =  uniqid('', true).".".$fileActualExtension;
                $fileDestination = 'Announcements/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                //
                $connection = mysqli_connect('localhost','root','','yazgeldb');
                $sql = "INSERT INTO announcement (announcement_title,announcement_content,announcement_file,announcement_author) VALUES('$announcement_title','$announcement_content','$fileNameNew','$announcement_author');";
                $result = mysqli_query($connection, $sql);
                if($result){
                  $_SESSION['upload_file_error'] = 'Duyuru Başarıyla Eklendi! <a href="announcements.php">Görüntüle</a>';
                  header('location: add_announcement.php?add-announcement=successful');
                  exit();
                }else{
                  $_SESSION['upload_file_error'] = 'Sistemde bir hata oluştu! İşlem tamamlanmadı! Bir daha deneyin!';
                  header('location: add_announcement.php?add-announcement=error');
                  exit();
                }
                
            }else{
                $_SESSION['upload_file_error'] = 'Yüklediğiniz dosya çok büyük! Duyuru Eklenmedi, bir daha deneyin!'.($fileSize/1000);
                header('location: add_announcement.php?upload-file=unsuccessful');
                exit();
            }
        }else{
            $_SESSION['upload_file_error'] = 'Dosyanızı yüklerken bir hata oluştu! Bir daha deneyin!';
            header('location: add_announcement.php?upload-file=unsuccessful');
            exit();
        }
    }else{
        $_SESSION['upload_file_error'] = 'Yüklediğiniz dosya tipi geçersizdir!Yüklemenize izin verilen dosya tipleri("pdf", "docx", "doc","png","jpeg","jpg","xlsx")';
        header('location: add_announcement.php?upload-file=unsuccessful');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Komisyon - Duyuru Ekleme</title>
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&display=swap');
    .new-font{font-family: 'IBM Plex Sans JP', sans-serif;}
    
    /* NEÜ Özel Renkler */
    .text-primary { color: #0F203F !important; }
    .btn-primary {
        background-color: #0F203F !important;
        border-color: #0F203F !important;
        color: #fff !important;
    }
    .btn-primary:hover { background-color: #09152b !important; }

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
          <li class="nav-item">
            <a class="nav-link " href="./announcements.php">
              <i class="fas fa-bullhorn text-green"></i> Duyurular
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link active" href="./add_announcement.php">
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
    <div class="header pt-6 align-items-center" style="background-color: #EFF5F5; min-height: 700px;">
      <div class="container">
        <div class="card p-3">
          <center>
            <p style="color: red;">
              <?php
                if(isset($_SESSION['upload_file_error'])){
                  echo $_SESSION['upload_file_error'];
                  unset($_SESSION['upload_file_error']);
                }              
              ?>
            </p>
            <h3 class="new-font">Duyuru Ekleme Paneli</h3>
          </center>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
            <label style="color: #0F203F;" class="new-font" for="title"><b>Duyuru Başlığı</b></label>
            <input id="title" type="text" name="announcement_title" class="form-control" placeholder="Duyuru Başlığını yazınız..." required>
            <label style="color: #0F203F;" class="new-font mt-2" for="content"><b>Duyuru İçeriği</b></label>
            <textarea id="content" class="form-control" name="announcement_content" rows="10" required></textarea>
            <label style="color: #0F203F;" class="new-font mt-2" for="content">Duyuru İçeriği ya da dosyası</label> <br>
            <input class="btn mt-2 mb-1" type="file" name="announcement_file" required> <br>
            <button class="btn btn-primary mt-2" type="submit" name="add-announcement-btn">Yayınla</button>
          </form>
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