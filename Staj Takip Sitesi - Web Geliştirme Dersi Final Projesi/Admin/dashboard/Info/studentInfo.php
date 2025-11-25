<?php
session_start(); 
if(!isset($_SESSION['adminID'])){
  header('location: ../../../admin_login.php');
  exit();
} 
$student_id = '';
$fullName = '';
$tc = '';
$nationality = '';
$tel  = '';
$email = '';
$password = '';
$university = '';
$faculty = '';
$department = '';
$grade = '';
$university_no = '';
$address = '';

if(isset($_GET['view-student'])){

  $student_id = $_GET['view-student'];
  require '../Backend/Student/view_all_students.php';
  $students = new ViewStudents();
  $row =  $students->viewAllStudents();
  for($i = 0; $i<count($row); $i++){
    if($row[$i]['kullanci_id'] == $student_id){
      $student_id = $row[$i]['kullanci_id'];
      $fullName = $row[$i]['ogrenci_ad_soyad'];
      $tc = $row[$i]['ogrenci_tc'];
      $nationality = $row[$i]['ogrenci_uyrugu'];
      $tel = $row[$i]['ogrenci_tel'];
      $email = $row[$i]['ogrenci_mail'];
      $password = $row[$i]['ogrenci_password'];
      $university = $row[$i]['ogrenci_okul_adi'];
      $faculty = $row[$i]['ogrenci_fakulte_adi'];
      $department = $row[$i]['ogrenci_bolumm_adi'];
      $grade = $row[$i]['ogrenci_sinif'];
      $university_no = $row[$i]['ogrenci_okul_no'];
      $address = $row[$i]['ogrenci_address'];
    }
  }
}

?>
<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Yönetici - Öğrenci Bilgileri</title>
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&display=swap');
    .new-font{font-family: 'IBM Plex Sans JP', sans-serif;}
    div.online-indicator { display: inline-block; width: 15px; height: 15px; margin-right: 10px; background-color: #0fcc45; border-radius: 50%; position: relative; }
    span.blink { display: block; width: 15px; height: 15px; background-color: #0fcc45; opacity: 0.7; border-radius: 50%; animation: blink 1s linear infinite; }
    @keyframes blink { 100% { transform: scale(2, 2); opacity: 0; } }
  </style>
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"><span class="navbar-toggler-icon"></span></button>
      <a class="pt-0" href="../index.php"><center><img style="width: 70%; height:auto;" src="../assets/img/theme/neu-logo.png"  alt="NEÜ Logo"></center></a>
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <center>
            <h3 class="new-font"><div class="online-indicator"><span class="blink"></span></div> <?php echo $_SESSION['admin_fullName']; ?></h3>
            <h5 class="new-font">
              <?php
                $admin_id = $_SESSION['adminID'];
                $connection = mysqli_connect('localhost','root','','yazgeldb');
                $sql = "SELECT * FROM admin WHERE admin_id='$admin_id'";
                $res = mysqli_query($connection, $sql);
                while($row=mysqli_fetch_assoc($res)){ if($row['admin_type'] == 'super_admin'){ echo 'Süper Yönetici'; }else{ echo 'Yönetici'; } }
              ?>
            </h5>
          </center>
          <li class="nav-item active"><a class="nav-link active" href="../index.php"><i class="ni ni-tv-2 text-primary"></i> Anasayfa</a></li>
          <li class="nav-item"><a class="nav-link" href="../examples/profile.php"><i class="ni ni-single-02 text-yellow"></i> Profil</a></li>
          <li class="nav-item"><a class="nav-link" href="../examples/register.php"><i class="ni ni-circle-08 text-pink"></i> Kullanıcı Ekle</a></li>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="main-content">
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid"><a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="../index.php">Anasayfa'ya Dön</a></div>
    </nav>
    
    <div class="header pb-6 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 200px; background-color: #0F203F; border-bottom: 4px solid #D4AF37;">
       <div class="container"><center><h1 class="new-font text-white">Öğrenci Bilgileri <i style="color: #D4AF37;" class="fas fa-info-circle"></i></h1></center></div>
    </div>
    
    <div class="container-fluid mt--7">
        <div class="order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center"><div class="col-8"><h3 class="mb-0">Hesap Bilgileri</h3></div></div>
            </div>
            <div class="card-body">
            <form method="post" action="process/crud_student.php">
                <h6 class="heading-small text-muted mb-4">Öğrenci Bilgileri</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Ad Soyad</label><input type="text" name="fullName" class="form-control form-control-alternative" value="<?php echo $fullName; ?>" required></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">T.C</label><input type="text" name="tc" class="form-control form-control-alternative" value="<?php echo $tc; ?>" required></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Uyruğu</label><input type="text" name="nationality" class="form-control form-control-alternative" value="<?php echo $nationality; ?>" required></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Tel</label><input type="text" name="tel" class="form-control form-control-alternative" value="<?php echo $tel; ?>" required></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Mail Adresi</label><input type="email" name="email" class="form-control form-control-alternative" value="<?php echo $email; ?>" required></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Parola</label><input type="password" name="password" class="form-control form-control-alternative" value="<?php echo $password; ?>" required></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Üniversite Adı</label><input type="text" name="university" class="form-control form-control-alternative" value="<?php echo $university; ?>" required></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Fakülte</label><input type="text" name="faculty" class="form-control form-control-alternative" value="<?php echo $faculty; ?>" required></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Bölüm</label><input type="text" name="department" class="form-control form-control-alternative" value="<?php echo $department; ?>" required></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Sınıf</label><input type="text" name="grade" class="form-control form-control-alternative" value="<?php echo $grade; ?>" required></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Öğrenci Numarası</label><input type="text" name="university_no" class="form-control form-control-alternative" value="<?php echo $university_no; ?>" required></div></div>
                    <div class="col-lg-6"><div class="form-group"><label class="form-control-label">Adres</label><input type="text" name="address" class="form-control form-control-alternative" value="<?php echo $address; ?>" required></div></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" name="update_student_info" value="<?php echo $student_id  ?>" class="btn btn-primary">Güncelle</button>
                        <button type="submit" name="remove_student" value="<?php echo $student_id  ?>" class="btn btn-danger" onclick="return confirm('Bu kullanıcıyı tamamen silmek istediğinize emin misiniz? Bu işlem geri alınamaz.');">Sil</button>
                    </div>
                  </div>
                  </div>
                </div>
              </form>
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