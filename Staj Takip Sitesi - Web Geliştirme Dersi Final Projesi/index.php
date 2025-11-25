<?php session_start(); ?>
<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>NEÜ Staj Takibi - Anasayfa</title>
  <link href="admin/dashboard/assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="admin/dashboard/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="admin/dashboard/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="Admin/dashboard/assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  
  <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&display=swap');
    html {
      scroll-behavior: smooth;
    }
    /* font-family: 'IBM Plex Sans JP', sans-serif; */
    .new-font{font-family: 'IBM Plex Sans JP', sans-serif;}
    #about{
      padding:5% 6% 5%;
    }
    #about img{
      width: 30%;
      margin: 7%;
    }
    #about .col-lg-4 .card{
      padding: 10% 3%;
      cursor: pointer;
      transition: 0.5s ease;
      box-shadow: 5px 5px 15px -5px rgba(0, 0, 0, 0.1);
      margin: 5px 0;
    }
    #about .col-lg-4 .card:hover{
      /* NEÜ Altın Sarısı Açık Ton (Hover Rengi) */
      background-color: #FFE7BD; 
    }
    #contact i{
      font-size: 40px;
      border-radius: 100px;
      margin: 0 7px;
      cursor: pointer;
      transition: 0.5 ease;
    }
    #contact i:hover{
      opacity: 0.8;
    }
    
    /* NEÜ Custom Text Colors */
    .text-neu-blue { color: #0F203F !important; }
    .text-neu-gold { color: #D4AF37 !important; }
  </style>
</head>

<body class="bg-default"> <div class="main-content">
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="" href="#">
          <img style="height: 60px;" src="Admin/dashboard/assets/img/theme/neu-logo.png"  alt="NEÜ Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6">
                <a href="#">
                 <img src="Admin/dashboard/assets/img/theme/neu-logo.png"  alt="NEÜ Logo">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a style="color: #fff;" class="nav-link nav-link-icon" href="#">
                <i class="ni ni-planet"></i>
                <span class="nav-link-inner--text new-font">Anasayfa</span>
              </a>
            </li>
            <li class="nav-item">
              <a style="color: #fff;" href="#about" class="nav-link nav-link-icon" href="#">
                <i class="ni ni-circle-08"></i>
                <span class="nav-link-inner--text new-font">Hakkımızda</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#contact" style="color: #fff;" class="nav-link nav-link-icon" href="#">
                <i class="fas fa-address-book"></i>
                <span class="nav-link-inner--text new-font">İletişim</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="header py-7 py-lg-8" style="background-color: #0F203F; border-bottom: 4px solid #D4AF37;">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 style="font-size:30px; color:#D4AF37;" class="new-font">Hoşgeldiniz!</h1>
              <h3 style="color: #fff;" class="new-font">NEÜ Staj Takip Sistemi</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-secondary" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>

    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
                  <?php if(isset($_SESSION['s_message'])): ?>
                      <div class="alert" style="color: red; text-align:center;">
                          <?php echo '<p class="new-font"><i class="fas fa-exclamation-circle"></i> '.$_SESSION['s_message'].'</p>';
                              unset($_SESSION['s_message']);
                          ?>
                      </div>
                  <?php endif ?>
              <form method="POST" action="process/student_login.php">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input name="student_number" class="form-control" placeholder="Öğrenci Numarası" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input name="student_password" class="form-control" placeholder="Parola" type="password" required>
                  </div>
                </div>
                <div class="text-center">
                  <button name="student_login_btn" type="submit" class="btn btn-primary my-4"><i class="fas fa-sign-in-alt"></i> Öğrenci Girişi</button>
                </div>
                
                <div class="text-center">
                    <a class="new-font text-muted" href="teacher_login.php?teacher-login" style="font-size:14px;">Öğretim Görevlisi Girişi</a><br>
                    <a class="new-font text-muted" href="commission_login.php?commission-login" style="font-size:14px;">Komisyon Girişi</a><br>
                    <a class="new-font text-muted" href="admin_login.php?admin-login" style="font-size:14px;">Yönetici Girişi</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section id="about">
      <center>
        <h1 style="font-size:30px; color:white;" class="new-font mb-6">Neler Yapabiliyorsunuz <i class="fas fa-question-circle"></i></h1>
      </center>
      <div class="row justify-content-center">
        <div class="col-lg-4">
          <div class="card">
            <center>
              <img src="./img/done.png" alt="">
              <h3 class="new-font"><i style="color:#D4AF37;" class="ni ni-planet"></i> Staj 1 Başvurusu</h3>
              <h4 class="new-font">Staj 1 Takibi</h4>
            </center>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
            <center>
              <img src="./img/yes.png" alt="">
              <h3 class="new-font"><i style="color:#D4AF37;" class="ni ni-planet"></i> Staj 2 Başvurusu</h3>
              <h4 class="new-font">Staj 2 Takibi</h4>
            </center>
          </div>
        </div>
        </div>
    </section>
    
    <section id="contact">
    <div style="background-color: #0F203F;" class="pt-4 pb-4">
      <div class="container p-5">
        <center>
            <a href="https://www.facebook.com/NEUniversitesi/?locale=tr_TR" target="_blank"><i style="color: #fff;" class="fab fa-facebook-square"></i></a>
            <a href="https://www.instagram.com/neuniversitesi/" target="_blank"><i style="color: #fff;" class="fab fa-instagram"></i></a>
            
            <a href="https://x.com/NEUniversitesi" target="_blank" style="text-decoration:none;">
                <svg xmlns="http://www.w3.org/2000/svg" height="40" width="40" viewBox="0 0 512 512" style="fill:#fff; margin: 0 7px; vertical-align: middle; position: relative; top: -10px;">
                    <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                </svg>
            </a>

            <a href="https://www.youtube.com/c/NecmettinErbakan%C3%9CniversitesiTv" target="_blank"><i style="color: #fff;" class="fab fa-youtube"></i></a>
            
            <h4 style="color: #FFE7BD;" class="new-font mt-4">Copyright © <?php echo date("Y"); ?> Necmettin Erbakan Üniversitesi</h4>
        </center>
    </div>
    </section>
  </div>
  <script src="MainPage/js/jquery.min.js"></script>
  <script src="MainPage/js/bootstrap.bundle.min.js"></script>
</body>

</html>