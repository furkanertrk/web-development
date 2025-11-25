<?php 
  session_start();
  if(!isset($_SESSION['commission_id'])){
    header('location:../../../commission_login.php');
    exit();
  }
?>
<?php
  if(isset($_POST['staj-onayla-btn'])){
    $student_number = $_POST['staj-onayla-btn'];
    $teacher_number = $_POST['teacher_number'];
    $feedback = $_POST['feedback'];

    $connection = mysqli_connect('localhost','root','','yazgeldb');
    $sql = "UPDATE staj_takibi SET staj_durumu='onaylandi', geri_bildirim='Staj Basvurunuz onaylandi', ogretmen_numarasi='$teacher_number'   WHERE ogrenci_numarasi='$student_number' AND staj_tur='staj2'";
    mysqli_query($connection, $sql);
  }

  if(isset($_POST['staj-red-btn'])){
    $student_number = $_POST['staj-red-btn'];
    $teacher_number = $_POST['teacher_number'];
    $feedback = $_POST['feedback'];

    $connection = mysqli_connect('localhost','root','','yazgeldb');
    $sql = "UPDATE staj_takibi SET staj_durumu='eksik_belge', geri_bildirim='$feedback', ogretmen_numarasi='$teacher_number'   WHERE ogrenci_numarasi='$student_number' AND staj_tur='staj2'";
    mysqli_query($connection, $sql);
  }
?>
<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Komisyon - Staj 2 Detay</title>
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&display=swap');
    .new-font{font-family: 'IBM Plex Sans JP', sans-serif;}
    .bg-neu-dark { background-color: #0F203F !important; }

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
          <img style="width: 70%; height:auto;" src="../assets/img/theme/neu-logo.png"  alt="NEÜ Logo">
        </center>
      </a>
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <center>
            <h3 class="new-font">
            <div class="online-indicator">
              <span class="blink"></span>
            </div>
              <?php echo $_SESSION['commission_name']; ?></h3>
            <h5 class="new-font">Komisyon Üyesi</h5>
          </center>
          <hr class="my-3">
          <li class="nav-item  active ">
            <a class="nav-link  active " href="../index.php">
              <i class="ni ni-tv-2 text-primary"></i> Anasayfa
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="../examples/profile.php">
              <i class="ni ni-single-02 text-yellow"></i> Profil
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="../examples/announcements.php">
              <i class="fas fa-bullhorn text-success"></i> Duyurular
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="../examples/add_announcement.php">
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="../index.php">Anasayfa'ya Dön</a>
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="../assets/img/theme/man.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span style="color:black;" class="mb-0 text-sm font-weight-bold">
                    <?php echo isset($_SESSION['commission_name']) ? $_SESSION['commission_name'] : 'User'; ?>
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
              <div class="dropdown-divider"></div>
              <a href="../logout.php" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Çıkış</span>
              </a>
          </div>
          </li>
        </ul>
      </div>
    </nav>
    
    <div class="header pb-8 pt-5 pt-md-8 bg-neu-dark d-flex align-items-center"></div>

    <div class="container-fluid mt--7">
        <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Staj 2 Öğrenci Başvurusu Bilgisi</h3>
            </div>
            <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <tbody>
                    <?php
                    if(isset($_GET['view-student-info'])){
                        $student_id = $_GET['view-student-info'];
                        $connection = mysqli_connect('localhost', 'root','','yazgeldb');
                        $sql = "SELECT * FROM student WHERE kullanci_id='$student_id'";
                        $result = mysqli_query($connection, $sql);
                        while($row=mysqli_fetch_assoc($result)){
                    ?>
                        <tr>
                            <td><b>Ad Soyad:</b></td>
                            <td><?php echo $row['ogrenci_ad_soyad'];?></td>
                            <td><b>Öğrenci Numarası:</b></td>
                            <td><?php echo $row['ogrenci_okul_no'] ?></td>

                        </tr>
                        <tr>
                            <td><b>Fakülte Adı: </b></td>
                            <td><?php echo $row['ogrenci_fakulte_adi'] ?></td>
                            <td><b>Bölüm Adı: </b></td>
                            <td><?php echo $row['ogrenci_bolumm_adi'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Sınıf: </b></td>
                            <td><?php echo $row['ogrenci_sinif'] ?></td>
                            <td><b>Mail Adresi: </b></td>
                            <td><?php echo $row['ogrenci_mail'] ?></td>
                        </tr>
                    <?php
                        $student_number = $row['ogrenci_okul_no'];
                        $new_sql = "SELECT * FROM staj_basvuru WHERE basvuru_turu='staj2' AND ogrenci_numarasi='$student_number'";
                        $res = mysqli_query($connection, $new_sql);
                        while($new_row=mysqli_fetch_assoc($res)){
                    ?>
                            <tr>
                                <td><b>Staj Başlama Tarihi: </b></td>
                                <td><?php echo $new_row['baslama_tarihi'] ?></td>
                                <td><b>Staj Bitiş Tarihi: </b></td>
                                <td><?php echo $new_row['bitis_tarihi'] ?></td>
                            </tr>
                            <tr>
                                <td><b>İş Günü: </b></td>
                                <td><?php echo $new_row['is_gunu'] ?></td>
                                <td><b>Staj Yapılacak Kurum Adı: </b></td>
                                <td><?php echo $new_row['firma_adi'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Staj Yapılacak Kurum'un Mail Adresi: </b></td>
                                <td><?php echo $new_row['firma_email'] ?></td>
                            </tr>
                            <tr>
                            <td><b>Staj Kabul Belgesi:</b></td>
                            </tr>
                            <tr>
                              <td colspan="4">
                                <?php
                                    $student_num = $row['ogrenci_okul_no'];
                                    $file_sql = "SELECT ogrenci_staj_kabul_belgesi FROM staj_kabul_belgesi WHERE ogrenci_numarasi='$student_num' AND staj_turu='staj2'";
                                    $file_result = mysqli_query($connection, $file_sql);
                                    if(mysqli_num_rows($file_result)== 0){
                                    ?>
                                        <div class="alert alert-danger" role="alert">Staj Kabul Belgesi Yüklenmemiştir!</div>
                                    <?php
                                    }else{
                                      while($file_row = mysqli_fetch_assoc($file_result)){
                                ?>
                                      <embed src="../../../Student/dashboard/Internship/Internship2_Pdf/<?php echo $file_row['ogrenci_staj_kabul_belgesi'] ?>" width="1100" height="400" type="application/pdf">
                                <?php
                                      }
                                    }
                                ?>
                              </td>
                            </tr>
                            <form action="./view-internship2-student-info.php" method="post">
                                <tr>
                                    <td>
                                        <select name="teacher_number" class="form-control">
                                            <option selected disabled required>Stajı Değerlendirecek Öğretemeni Seçin</option>
                                            <?php
                                                $sqli = "SELECT * FROM teacher WHERE role='ogretmen'";
                                                $ress = mysqli_query($connection, $sqli);
                                                if(mysqli_num_rows($ress) == 0){
                                            ?>
                                                <option value="1">Öğretmen Mevcut değildir.</option>
                                            <?php
                                                }else{
                                                    while($r = mysqli_fetch_assoc($ress)){
                                            ?>
                                                    <option value="<?php echo $r['ogretmen_okul_no'] ?>">
                                                        <?php echo $r['ogretmen_ad_soyad']?>
                                                    </option>
                                                    <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td colspan="3">
                                        <input name="feedback" type="text" class="form-control" placeholder="Öğrenci'ye geri bildirim yaz" required>
                                    </td>
                                </tr>
                                <tr>
                                <td>
                                        <button type="submit" name="staj-onayla-btn" value="<?php echo $student_num  ?>" class="btn btn-primary">Staj Onayla</button>
                                        <button type="submit" name="staj-red-btn" value="<?php echo $student_num  ?>" class="btn btn-outline-danger">Staj Red</button>
                                    </td>
                                </tr>
                            </form>
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
  <script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/argon-dashboard.min.js?v=1.1.2"></script>
</body>
</html>