<?php 
  $starting_date = '';
  $ending_date = '';
  session_start();
  if(!isset($_SESSION['studentID'])){
    header('location: ../../../../index.php');
    exit();
  }
  if(isset($_GET['starting-date'])){
    $starting_date = $_GET['starting-date'];
  }
  if(isset($_GET['ending-date'])){
    $ending_date = $_GET['ending-date'];
  }
?>
<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Öğrenci - Staj 2 Başvuru Formu</title>
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="../../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="../../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="../../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&display=swap');
    .new-font{font-family: 'IBM Plex Sans JP', sans-serif;}
    .bg-neu-dark { background-color: #0F203F !important; }
    
    /* Tasarım Düzenlemeleri */
    .internship-form {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 10px;
        margin-top: -80px;
        position: relative;
        z-index: 10;
    }
    .header-row {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
    }
    .form-logo img {
        width: 100px;
        height: auto;
    }
    .form-title {
        padding-left: 20px;
        text-align: left;
        border-left: 2px solid #eee;
    }
    .form-title h2 {
        font-size: 20px;
        font-weight: 800;
        margin: 0;
        color: #0F203F;
        line-height: 1.3;
    }
    .form-title h3 {
        font-size: 16px;
        font-weight: 400;
        margin-top: 5px;
        font-style: italic;
        color: #666;
    }
  </style>
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="pt-0" href="./index.php">
        <center><img style="width: 70%; height:auto;" src="../../assets/img/theme/neu-logo.png"  alt="NEÜ Logo"></center>
      </a>
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
           <li class="nav-item active"><a class="nav-link active" href="../../index.php"><i class="ni ni-tv-2 text-primary"></i> Anasayfa</a></li>
           <li class="nav-item"><a class="nav-link" href="../apply_internship.php"><i class="fas fa-arrow-left text-orange"></i> Geri Dön</a></li>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="main-content">
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center bg-neu-dark" style="min-height: 250px;"></div>
    
    <div class="container-fluid mt--7"> 
      <div class="container internship-form shadow">
        
        <div class="header-row">
            <div class="form-logo">
                <img src="../../assets/img/theme/neu-logo.png" alt="NEÜ Logo">
            </div>
            <div class="form-title">
                <h2>T.C.<br>NECMETTİN ERBAKAN ÜNİVERSİTESİ<br>Mühendislik Fakültesi Dekanlığına</h2>
                <h3>(Staj Başvuru ve Kabul Formu)</h3>
            </div>
        </div>

        <h4 class="text-right mb-4">Tarih: <?php echo date("d.m.Y");?></h4>
        <h4 class="text-center mb-5" style="text-decoration: underline;">İLGİLİ MAKAMA</h4>
        
        <form method="post" action="pdf/create_pdf_2.php">
            <?php
                $connection = mysqli_connect('localhost', 'root', '', 'yazgeldb');
                $student_id = $_SESSION['studentID'];
                $sql = "SELECT * FROM student WHERE kullanci_id='$student_id'";
                $result = mysqli_query($connection, $sql);
                while($row=mysqli_fetch_assoc($result)){
            ?>
            
            <p class="mb-4">
                Fakülteniz <strong><?php echo $row['ogrenci_bolumm_adi'] ?></strong> Bölümü, 
                <strong><?php echo $row['ogrenci_okul_no'] ?></strong> numaralı öğrencisiyim.
                Aşağıda bilgileri yer alan kurumda staj yapmamın uygunluğu hususunda gereğini arz ederim.
            </p>
            
            <input type="hidden" name="department_name" value="<?php echo $row['ogrenci_bolumm_adi'] ?>">
            <input type="hidden" name="student_number" value="<?php echo $row['ogrenci_okul_no'] ?>">

            <h6 class="heading-small text-muted mb-4">Öğrenci Bilgileri</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Ad Soyad</label>
                        <input class="form-control" name="student_fullName" type="text" value="<?php echo $row['ogrenci_ad_soyad'] ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">T.C. Kimlik No</label>
                        <input class="form-control" name="student_tc_kimlik" type="text" value="<?php echo $row['ogrenci_tc'] ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Telefon</label>
                        <input class="form-control" name="student_phone_number" type="text" value="<?php echo $row['ogrenci_tel'] ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">E-posta</label>
                        <input class="form-control" name="student_email" type="email" value="<?php echo $row['ogrenci_mail'] ?>" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">İkametgah Adresi (İl/İlçe/PK)</label>
                        <div class="row">
                            <div class="col-md-4"><input class="form-control" name="s_district_name" placeholder="İl" type="text" required></div>
                            <div class="col-md-4"><input class="form-control" name="s_city_name" placeholder="İlçe" type="text" required></div>
                            <div class="col-md-4"><input class="form-control" name="s_post_code" placeholder="Posta Kodu" type="text" required></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="my-4" />
            
            <h6 class="heading-small text-muted mb-4">Staj Bilgileri (Staj 2)</h6>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Başlama Tarihi</label>
                        <input name="starting_date" class="form-control" type="text" value="<?php echo $starting_date;?>" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Bitiş Tarihi</label>
                        <input name="ending_date" class="form-control" type="text" value="<?php echo $ending_date;?>" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">İş Günü Sayısı</label>
                        <input class="form-control" name="working_day" type="text" value="30" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Cumartesi günleri çalışıyor mu?</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="sat_yes" name="saturday_work" value="Evet" class="custom-control-input">
                          <label class="custom-control-label" for="sat_yes">Evet</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="sat_no" name="saturday_work" value="Hayir" class="custom-control-input" checked>
                          <label class="custom-control-label" for="sat_no">Hayır</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Sağlık Hizmeti Durumu</label>
                        <select class="form-control" name="saglik_durumu">
                            <option value="Ailemden/Kendimden Aliyorum">Ailemden/Kendimden Alıyorum</option>
                            <option value="Almiyorum (GSS Primi Odensin)">Almıyorum (GSS Primi Ödensin)</option>
                        </select>
                    </div>
                </div>
            </div>

            <?php } ?>
            
            <hr class="my-4" />

            <h6 class="heading-small text-muted mb-4">Staj Yapılacak Kurum Bilgileri</h6>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">Kurumun Resmi Adı</label>
                        <input class="form-control" name="company_name" type="text" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">Faaliyet Alanı</label>
                        <input class="form-control" name="company_workspace" type="text" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">Kurum Adresi</label>
                        <div class="row">
                            <div class="col-md-4"><input class="form-control" name="company_district_name" placeholder="İl" type="text" required></div>
                            <div class="col-md-4"><input class="form-control" name="company_city_name" placeholder="İlçe" type="text" required></div>
                            <div class="col-md-4"><input class="form-control" name="company_post_code" placeholder="Posta Kodu" type="text" required></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Telefon</label>
                        <input class="form-control" name="company_phone_number" type="text" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Fax (Varsa)</label>
                        <input class="form-control" name="company_fax" type="text">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">E-posta</label>
                        <input class="form-control" name="company_email_address" type="email" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">3308 sayılı kanun devlet katkısından yararlanmak istiyor mu?</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="devlet_yes" name="devlet_katkisi" value="Evet" class="custom-control-input">
                          <label class="custom-control-label" for="devlet_yes">Evet</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="devlet_no" name="devlet_katkisi" value="Hayir" class="custom-control-input" checked>
                          <label class="custom-control-label" for="devlet_no">Hayır</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center pb-5">
                <button class="btn btn-primary btn-lg" type="submit" name="create_pdf">Formu Oluştur (PDF)</button>
                <a href="../apply_internship.php" class="btn btn-danger btn-lg">İptal</a>
            </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>