<?php 
  session_start();
  if(!isset($_SESSION['studentID'])){
    header('location: ../../../index.php');
    exit();
  }
  function get_working_days($startingDate, $endingDate, $holidays){
    $startingDate = strtotime($startingDate);
    $endingDate = strtotime($endingDate);
    $days = abs(round($endingDate - $startingDate)/86400) + 1;
    $no_full_weeks = floor($days / 7);
    $no_remaining_days = fmod($days, 7);
    $the_first_day_of_week = date("N", $startingDate);
    $the_last_day_of_week = date("N", $endingDate);
    if ($the_first_day_of_week <= $the_last_day_of_week) {
      if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
      if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
    }else{
      if ($the_first_day_of_week == 7) {
        $no_remaining_days--;
        if ($the_last_day_of_week == 6) { $no_remaining_days--; }else{ $no_remaining_days -= 2; }
      }
    }
    $workingDays = $no_full_weeks * 5;
    if ($no_remaining_days > 0 ) { $workingDays += $no_remaining_days; }
    foreach($holidays as $holiday){
        $time_stamp=strtotime($holiday);
        if ($startingDate <= $time_stamp && $time_stamp <= $endingDate && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)
            $workingDays--;
    }
    return $workingDays;
  }
  $year = date('Y');
  $holidays = array($year.'-01-01', $year.'-04-23', $year.'-05-19', $year.'08-30', $year.'10-29');
  
/* Staj 1 Logic */
  if(isset($_POST['apply-internship-1'])){

    $now = date('Y-m-d'); // Format düzeltildi (y->Y)
    $starting_date = date('Y-m-d', strtotime($_POST['starting_date']));
    $ending_date = date('Y-m-d', strtotime($_POST['ending_date']));

    if($now > $starting_date){
      $_SESSION['message'] = "Geçmiş bir başlangıç tarihi girdiniz: ".$starting_date .". Bugünün tarihi: ".$now;
      header('location: apply_internship.php?error=invalid-staring-date');
      exit();
    }
    if($now > $ending_date){
      $_SESSION['message'] = "Geçmiş bir bitiş tarihi girdiniz: ".$ending_date .". Bugünün tarihi: ".$now;
      header('location: apply_internship.php?error=invalid-ending-date');
      exit();
    }
    if($starting_date > $ending_date){ // Mantık hatası düzeltildi (Bitiş başlangıçtan önce olamaz)
      $_SESSION['message'] = "Bitiş tarihi başlangıç tarihinden önce olamaz.";
      header('location: apply_internship.php?error=invalid-date-range');
      exit();
    }else{
      $diff = get_working_days($starting_date, $ending_date, $holidays);
      $diff = abs(round($diff));
      
      // DÜZELTME BURADA: Sadece 30'dan küçükse hata ver, 30 ve üzeriyse kabul et.
      if($diff < 30){
        $_SESSION['message'] = "Staj en az 30 iş günü olmalıdır! Sizin süreniz: ".$diff.' iş günü!';
        header('location: apply_internship.php?error=short-internship-days');
        exit();
      }else{
        // 30 gün ve üzeriyse kabul et
        header('location: forms/internship_1_form.php?starting-date='.$starting_date.'&ending-date='.$ending_date);
        exit();
      }
    }
  }

  /* Staj 2 Logic */
  if(isset($_POST['apply-internship-2'])){

    $now = date('Y-m-d');
    $starting_date = date('Y-m-d', strtotime($_POST['starting_date']));
    $ending_date = date('Y-m-d', strtotime($_POST['ending_date']));

    if($now > $starting_date){
      $_SESSION['message'] = "Geçmiş bir başlangıç tarihi girdiniz: ".$starting_date;
      header('location: apply_internship.php?error=invalid-staring-date');
      exit();
    }
    if($now > $ending_date){
      $_SESSION['message'] = "Geçmiş bir bitiş tarihi girdiniz: ".$ending_date;
      header('location: apply_internship.php?error=invalid-ending-date');
      exit();
    }
    if($starting_date > $ending_date){
      $_SESSION['message'] = "Bitiş tarihi başlangıç tarihinden önce olamaz.";
      header('location: apply_internship.php?error=invalid-date-range');
      exit();
    }else{

      $connection = mysqli_connect('localhost','root', '', 'yazgeldb');
      $student_number = $_SESSION['student_number'];
      $sql = "SELECT bitis_tarihi FROM staj_basvuru WHERE ogrenci_numarasi='$student_number' ";
      $result = mysqli_query($connection,$sql);
      $staj1_bitis_tarihi = ''; // Değişken başlatma
      while($row=mysqli_fetch_assoc($result)){
        $staj1_bitis_tarihi = $row['bitis_tarihi'];
      }
      
      // Eğer staj 1 tarihi varsa kontrol et
      if(!empty($staj1_bitis_tarihi) && strtotime($staj1_bitis_tarihi) >= strtotime($starting_date)){
        $_SESSION['message'] = "Staj 1 bitmeden Staj 2'yi yapamazsınız! (Staj 1 bitiş: ".$staj1_bitis_tarihi.").";
        header('location: apply_internship.php?error=staj1-devam-ediyor');
        exit();
      }else{
          $diff = get_working_days($starting_date, $ending_date, $holidays);
          $diff = abs(round($diff));
          
          // DÜZELTME BURADA:
          if($diff < 30){
            $_SESSION['message'] = "Staj en az 30 iş günü olmalıdır! Sizin süreniz: ".$diff.' iş günü!';
            header('location: apply_internship.php?error=short-internship-days');
            exit();
          }else{
            // 30 gün ve üzeriyse kabul et
            header('location: forms/internship_2_form.php?starting-date='.$starting_date.'&ending-date='.$ending_date);
            exit();
          }
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Öğrenci - Staj Başvurusu</title>
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&display=swap');
    .new-font{font-family: 'IBM Plex Sans JP', sans-serif;}
    .bg-neu-dark { background-color: #0F203F !important; }

    div.online-indicator { display: inline-block; width: 15px; height: 15px; margin-right: 10px; background-color: #0fcc45; border-radius: 50%; position: relative; }
    span.blink { display: block; width: 15px; height: 15px; background-color: #0fcc45; opacity: 0.7; border-radius: 50%; animation: blink 1s linear infinite; }
    @keyframes blink { 100% { transform: scale(2, 2); opacity: 0; } }
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
          <li class="nav-item active"><a class="nav-link active" href="./apply_internship.php"><i style="color: #764AF1;" class="fas fa-pen"></i> Staj Başvurusu</a></li>
          <li class="nav-item"><a class="nav-link" href="./announcements.php"><i class="fas fa-bullhorn text-success"></i> Duyurular</a></li>
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
    
    <div class="header pb-8 pt-5 pt-lg-8 bg-neu-dark d-flex align-items-center"></div>
    
    <div class="container-fluid mt--7">
        <center><h1 class="new-font mb-3 text-white">Staj Başvuru Paneli <i style="color: white;" class="fas fa-info-circle"></i></h1></center>
        <div class="order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0"><div class="row align-items-center"><div class="col-8"><h3 class="mb-0">Staj Başvurusu Yap</h3></div></div></div>
            <div class="card-body">
              <form method="post" action="apply_internship.php">
                <h6 class="heading-small text-muted mb-4">Başvuru Bilgileri</h6>
                  <?php if(isset($_SESSION['message'])): ?>
                      <div class="alert" style="color: red;"><?php echo '*'.$_SESSION['message']; unset($_SESSION['message']); ?></div>
                  <?php endif ?>

                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label" for="starting-date">Başlangıç Tarihi</label><input type="date" id="starting_date" class="form-control form-control-alternative" name="starting_date" value="<?php echo date("Y-m-d");?>" required></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label" for="ending-date">Bitiş Tarihi</label><input type="date" id="ending-date" class="form-control form-control-alternative" name="ending_date" required></div></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-primary" type="submit" name="apply-internship-1"
                        <?php
                          $connection = mysqli_connect('localhost','root', '','yazgeldb');
                          $student_number = $_SESSION['student_number'];
                          $sql = "SELECT * FROM staj_basvuru WHERE basvuru_turu='staj1' AND ogrenci_numarasi='$student_number'";
                          $result=  mysqli_query($connection, $sql);
                          if(mysqli_num_rows($result) >= 1){ echo 'disabled'; }
                        ?>>Staj 1 Başvurusu</button>

                        <button class="btn btn-primary" type="submit" name="apply-internship-2"
                        <?php
                          $connection = mysqli_connect('localhost','root', '','yazgeldb');
                          $student_number = $_SESSION['student_number'];
                          $sql = "SELECT * FROM staj_basvuru WHERE basvuru_turu='staj1' AND ogrenci_numarasi='$student_number'";
                          $result=  mysqli_query($connection, $sql);
                          if(mysqli_num_rows($result) == 0){ echo 'disabled'; }
                        ?>
                        <?php
                          $connection = mysqli_connect('localhost','root', '','yazgeldb');
                          $student_number = $_SESSION['student_number'];
                          $sql = "SELECT * FROM staj_basvuru WHERE basvuru_turu='staj2' AND ogrenci_numarasi='$student_number'";
                          $result=  mysqli_query($connection, $sql);
                          if(mysqli_num_rows($result) >= 1){ echo 'disabled'; }
                        ?>>Staj 2 Başvurusu</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6"><div class="copyright text-center text-xl-left text-muted">&copy; 2025 <a href="#" class="font-weight-bold ml-1">Necmettin Erbakan Üniversitesi</a></div></div>
        </div>
      </footer>
    </div>
  </div>
  <script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/argon-dashboard.min.js?v=1.1.2"></script>
</body>
</html>