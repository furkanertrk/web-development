<?php
define('FPDF_FONTPATH','font/');
require('fpdf.php'); 

// Geliştirme aşamasında hataları görmek için
error_reporting(E_ALL);
ini_set('display_errors', 1);

function convert_tr($str) {
    $tr = array('ş','Ş','ı','İ','ğ','Ğ','ü','Ü','ö','Ö','ç','Ç');
    $en = array('s','S','i','I','g','G','u','U','o','O','c','C');
    $str = str_replace($tr, $en, $str);
    return $str;
}

if(isset($_POST['create_pdf'])){
    
    // --- 1. VERİTABANI BAĞLANTISI ---
    $connection = mysqli_connect('localhost', 'root', '', 'yazgeldb');
    
    if (mysqli_connect_errno()) {
        die("Veritabanı bağlantı hatası: " . mysqli_connect_error());
    }
    
    mysqli_set_charset($connection, "utf8");

    // Veritabanı için ham veriler
    $db_ogrenci_no = $_POST['student_number'];
    $db_baslama = $_POST['starting_date'];
    $db_bitis = $_POST['ending_date'];
    $db_is_gunu = $_POST['working_day'];
    $db_firma_adi = $_POST['company_name'];
    $db_firma_email = $_POST['company_email_address'];
    
    if(empty($db_ogrenci_no) || empty($db_baslama)) {
        die("Hata: Öğrenci numarası veya başlama tarihi boş!");
    }

    // --- 2. SQL SORGUSU (STAJ 2 İÇİN) ---
    
    // Kontrol: Bu öğrencinin Staj 2 başvurusu var mı?
    $check_sql = "SELECT * FROM staj_basvuru WHERE ogrenci_numarasi='$db_ogrenci_no' AND basvuru_turu='staj2'";
    $check_res = mysqli_query($connection, $check_sql);

    if (!$check_res) {
        die("Sorgu Hatası (Select): " . mysqli_error($connection));
    }

    if(mysqli_num_rows($check_res) > 0){
        // Varsa GÜNCELLE (staj2)
        $sql = "UPDATE staj_basvuru SET 
                baslama_tarihi='$db_baslama', 
                bitis_tarihi='$db_bitis', 
                is_gunu='$db_is_gunu', 
                firma_adi='$db_firma_adi', 
                firma_email='$db_firma_email' 
                WHERE ogrenci_numarasi='$db_ogrenci_no' AND basvuru_turu='staj2'";
    } else {
        // Yoksa EKLE (staj2)
        $sql = "INSERT INTO staj_basvuru (
                    basvuru_turu, 
                    ogrenci_numarasi, 
                    baslama_tarihi, 
                    bitis_tarihi, 
                    is_gunu, 
                    firma_adi, 
                    firma_email
                ) VALUES (
                    'staj2', 
                    '$db_ogrenci_no', 
                    '$db_baslama', 
                    '$db_bitis', 
                    '$db_is_gunu', 
                    '$db_firma_adi', 
                    '$db_firma_email'
                )";
    }
    
    if (!mysqli_query($connection, $sql)) {
        die("Kayıt Hatası (Insert/Update): " . mysqli_error($connection));
    }

    // Staj Takibi Tablosuna Ekleme (staj2)
    $takip_sql = "SELECT * FROM staj_takibi WHERE ogrenci_numarasi='$db_ogrenci_no' AND staj_tur='staj2'";
    $takip_res = mysqli_query($connection, $takip_sql);
    
    if(mysqli_num_rows($takip_res) == 0){
        $insert_takip = "INSERT INTO staj_takibi (ogrenci_numarasi, staj_tur, staj_durumu, geri_bildirim) 
                         VALUES ('$db_ogrenci_no', 'staj2', 'degerlendirme', 'Yeni Basvuru')";
        if (!mysqli_query($connection, $insert_takip)) {
             die("Takip Tablosu Hatası: " . mysqli_error($connection));
        }
    }

    // --- 3. PDF OLUŞTURMA ---
    
    $department = convert_tr($_POST['department_name']);
    $student_no = $_POST['student_number'];
    $ad_soyad = convert_tr($_POST['student_fullName']);
    $tc = $_POST['student_tc_kimlik'];
    $tel = $_POST['student_phone_number'];
    $email = $_POST['student_email'];
    
    $adres = convert_tr($_POST['s_district_name'] . " / " . $_POST['s_city_name'] . " PK: " . $_POST['s_post_code']);
    
    $baslama = $_POST['starting_date'];
    $bitis = $_POST['ending_date'];
    $is_gunu = $_POST['working_day'];
    $cumartesi = convert_tr($_POST['saturday_work']);
    $saglik = convert_tr($_POST['saglik_durumu']);
    
    $kurum_adi = convert_tr($_POST['company_name']);
    $faaliyet = convert_tr($_POST['company_workspace']);
    $kurum_adres = convert_tr($_POST['company_district_name'] . " / " . $_POST['company_city_name'] . " PK: " . $_POST['company_post_code']);
    $kurum_tel = $_POST['company_phone_number'];
    $kurum_mail = $_POST['company_email_address'];
    $devlet_katkisi = convert_tr($_POST['devlet_katkisi']);

    class PDF extends FPDF {
        function Header() {
            $this->Image('../../../assets/img/theme/neu-logo.png', 10, 10, 30);
            $this->SetFont('Helvetica', 'B', 12);
            $this->Cell(0, 10, iconv('utf-8', 'ISO-8859-9', 'T.C.'), 0, 1, 'C');
            $this->Cell(0, 10, iconv('utf-8', 'ISO-8859-9', 'NECMETTİN ERBAKAN ÜNİVERSİTESİ'), 0, 1, 'C');
            $this->Cell(0, 10, iconv('utf-8', 'ISO-8859-9', 'Mühendislik Fakültesi Dekanlığına'), 0, 1, 'C');
            $this->SetFont('Helvetica', 'I', 10);
            $this->Cell(0, 10, iconv('utf-8', 'ISO-8859-9', '(Staj Başvuru ve Kabul Formu)'), 0, 1, 'C');
            $this->Ln(15);
        }

        function Footer() {
            $this->SetY(-15);
            $this->SetFont('Helvetica', 'I', 8);
            $this->Cell(0, 10, iconv('utf-8', 'ISO-8859-9', 'Sayfa ') . $this->PageNo(), 0, 0, 'C');
        }
    }

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Helvetica', '', 11);
    
    $tarih = date("d.m.Y");
    $pdf->Cell(0, 10, "Tarih: " . $tarih, 0, 1, 'R');
    
    $metin = "Fakulteniz " . $department . " Bolumu, " . $student_no . " numarali ogrencisiyim. " .
             "Asagida bilgileri yer alan kurumda staj yapmamin uygunlugu hususunda geregini arz ederim.";
             
    $pdf->MultiCell(0, 7, $metin);
    $pdf->Ln(5);

    // ÖĞRENCİ BİLGİLERİ
    $pdf->SetFont('Helvetica', 'B', 11);
    $pdf->Cell(0, 10, 'OGRENCI BILGILERI', 0, 1, 'L');
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->SetFont('Helvetica', '', 10);
    
    $pdf->Cell(50, 8, 'Adi Soyadi:', 0, 0); $pdf->Cell(0, 8, $ad_soyad, 0, 1);
    $pdf->Cell(50, 8, 'T.C. Kimlik No:', 0, 0); $pdf->Cell(0, 8, $tc, 0, 1);
    $pdf->Cell(50, 8, 'Telefon:', 0, 0); $pdf->Cell(0, 8, $tel, 0, 1);
    $pdf->Cell(50, 8, 'E-posta:', 0, 0); $pdf->Cell(0, 8, $email, 0, 1);
    $pdf->Cell(50, 8, 'Adres:', 0, 0); $pdf->MultiCell(0, 8, $adres);
    $pdf->Ln(5);

    // STAJ BİLGİLERİ (STAJ 2)
    $pdf->SetFont('Helvetica', 'B', 11);
    $pdf->Cell(0, 10, 'STAJ BILGILERI (STAJ 2)', 0, 1, 'L');
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->SetFont('Helvetica', '', 10);
    
    $pdf->Cell(50, 8, 'Baslama - Bitis:', 0, 0); $pdf->Cell(0, 8, $baslama . " - " . $bitis, 0, 1);
    $pdf->Cell(50, 8, 'Is Gunu / Cumartesi:', 0, 0); $pdf->Cell(0, 8, $is_gunu . " Gun / Calisiyor mu: " . $cumartesi, 0, 1);
    $pdf->Cell(50, 8, 'Saglik Hizmeti:', 0, 0); $pdf->Cell(0, 8, $saglik, 0, 1);
    $pdf->Ln(5);

    // KURUM BİLGİLERİ
    $pdf->SetFont('Helvetica', 'B', 11);
    $pdf->Cell(0, 10, 'STAJ YAPILACAK KURUM BILGILERI', 0, 1, 'L');
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->SetFont('Helvetica', '', 10);
    
    $pdf->Cell(50, 8, 'Kurum Adi:', 0, 0); $pdf->Cell(0, 8, $kurum_adi, 0, 1);
    $pdf->Cell(50, 8, 'Faaliyet Alani:', 0, 0); $pdf->Cell(0, 8, $faaliyet, 0, 1);
    $pdf->Cell(50, 8, 'Adres:', 0, 0); $pdf->MultiCell(0, 8, $kurum_adres);
    $pdf->Cell(50, 8, 'Iletisim (Tel/Mail):', 0, 0); $pdf->Cell(0, 8, $kurum_tel . " / " . $kurum_mail, 0, 1);
    $pdf->Cell(50, 8, 'Devlet Katkisi Istiyor mu:', 0, 0); $pdf->Cell(0, 8, $devlet_katkisi, 0, 1);
    
    $pdf->Ln(20);
    
    $pdf->Cell(100, 10, 'Ogrenci Imza', 0, 0, 'L');
    $pdf->Cell(0, 10, 'Kurum Yetkilisi Imza/Kase', 0, 1, 'R');

    $pdf->Output('D', 'Staj_2_Basvuru_Formu.pdf');
} else {
    echo "Form gonderilemedi.";
}
?>