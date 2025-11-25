<?php
       // Form verilerini veritabanına kaydetme (Aynen korundu)
       $student_Name = 'Nazir';
       if(isset($_POST['internship_1_apply_submit_form'])){
        // Değişken atamaları... (Önceki kodun aynısı)
        $department_name = $_POST['department_name'];
        $student_number = $_POST['student_number'];
        $student_fullName = $_POST['student_fullName'];
        $student_tc_kimlik = $_POST['student_tc_kimlik'];
        $student_nationality = $_POST['student_nationality'];
        $student_phone_number = $_POST['student_phone_number'];
        $student_email = $_POST['student_email'];
        $s_district_name = $_POST['s_district_name'];
        $s_city_name = $_POST['s_city_name'];
        $s_post_code = $_POST['s_post_code'];
        $internship_starting_date = $_POST['starting_date'];
        $internship_ending_date = $_POST['ending_date'];
        $working_day = $_POST['working_day'];
        $saturday_works = $_POST['saturday_work'];
        $health_service = $_POST['saglik_hizmet'];
        $health_insurance = $_POST['genel_saglik_sigorta'];
        $mean_25 = $_POST['25_doldurdum'];
        $company_name = $_POST['company_name'];
        $company_workspace = $_POST['company_workspace'];
        $company_district_name = $_POST['company_district_name'];
        $company_city_name = $_POST['company_city_name'];
        $company_post_code = $_POST['company_post_code'];
        $company_phone_number = $_POST['company_phone_number'];
        $company_fax = $_POST['company_fax'];
        $company_email_address = $_POST['company_email_address'];
        $internship_responsible_title = $_POST['unvan'];
        $rule = $_POST['3308_sayili_devlet_katkisi_yararlanmak'];
        $company_owner_fullName = $_POST['company_owner_fullName'];
        $company_owner_degree = $_POST['company_owner_degree'];

        $connection = mysqli_connect('localhost','root','','yazgeldb');
        $sql = "INSERT INTO staj_basvuru(basvuru_turu, ogrenci_numarasi, baslama_tarihi, bitis_tarihi, is_gunu, cumartesi_calisiyor, gss_kapsam, saglik_hizmet_almasi, yas_25, firma_adi, firma_email) VALUES('staj1', '$student_number', '$internship_starting_date', '$internship_ending_date', '$working_day', '$saturday_works', '$health_insurance', '$health_service', '$mean_25', '$company_name', '$company_email_address')";
        mysqli_query($connection, $sql);

        $new_sql = "INSERT INTO staj_takibi(staj_tur, ogrenci_numarasi, staj_durumu, geri_bildirim, ogretmen_numarasi) VALUES('staj1','$student_number','yeni_basvuru','Yeni basvuru','0')";
        mysqli_query($connection, $new_sql);
       }

require_once("fpdf184/fpdf.php");

// Değişkenler...
$todays_date = date("Y-m-d");
$ogrenci_bolum_adi=$_POST['department_name'];
$ogrenci_okul_no=$_POST['student_number'];
$ogrenci_ad_soyad=$_POST['student_fullName'];
$ogrenci_tc=$_POST['student_tc_kimlik'];
$ogrenci_uyrugu=$_POST['student_nationality'];
$ogrenci_tel=$_POST['student_phone_number'];
$ogrenci_mail=$_POST['student_email'];
$ogrenci_il=$_POST['s_district_name'];
$ogrenci_ilce=$_POST['s_city_name'];
$ogrenci_posta_kod=$_POST['s_post_code'];
$staj_baslama_tarih=$_POST['starting_date'];
$staj_bitis_tarih=$_POST['ending_date'];
$is_gunu=$_POST['working_day'];
$cumartesi_calisma=$_POST['saturday_work'];
$saglik_hizmet=$_POST['saglik_hizmet'];
$genel_saglik_sigorta=$_POST['genel_saglik_sigorta'];
$yirmibes_doldurdum=$_POST['25_doldurdum'];
$devlet_katkisi=$_POST['3308_sayili_devlet_katkisi_yararlanmak'];
$firma_isim=$_POST['company_name'];
$firma_calismaalani=$_POST['company_workspace'];
$firma_il=$_POST['company_district_name'];
$firma_ilce=$_POST['company_city_name'];
$firma_posta_kod=$_POST['company_post_code'];
$firma_tel=$_POST['company_phone_number'];
$firma_fax=$_POST['company_fax'];
$firma_email=$_POST['company_email_address'];
$firma_yetkili_adsoyad=$_POST['company_owner_fullName'];
$firma_yetkili_unvan=$_POST['company_owner_degree'];

$pdf= new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);

// LOGO GÜNCELLEMESİ: neu-logo.png kullanıldı
$pdf->Image('neu-logo.png',10,5,22);
// Diğer logoları şimdilik tuttum veya kaldırabilirsiniz
// $pdf->Image('Bservatory-logo.png',170,14,22); 

$pdf->SetFont('Arial','B',8);
$pdf->Cell(80);
$pdf->Cell(30,2,'T.C',0,1,'C');
$pdf->Cell(80);
// ÜNİVERSİTE ADI GÜNCELLEMESİ
$pdf->Cell(30,5,'NECMETTIN ERBAKAN UNIVERSITESI',0,1,'C');
$pdf->Cell(80);
$pdf->Cell(30,5,'MUHENDISLIK FAKULTESI',0,1,'C');
$pdf->Cell(80);
$pdf->Cell(30,5,'(Staj Basvuru ve Kabul Formu)',0,1,'C');
$pdf->Cell(160);
$pdf->Cell(30,20,"Tarih: {$todays_date}",0,1,'L');
$pdf->Ln(-6);
$pdf->Cell(185,3,'ILGILI MAKAMA',0,1,'C'); 
$pdf->SetFont('Arial','',8);
// METİN GÜNCELLEMESİ
$pdf->MultiCell(189,5,"   Muhendislik Fakultesi  {$ogrenci_bolum_adi} Bolumu  $ogrenci_okul_no  numarali ogrencisiyim. Kurumunuzda staj yapmamin uygun gorulmesi halinde bu formun alttaki kismini doldurularak fakultemiz ilgili bolum baskanligina gonderilmesini saygilarimla arz ederim.",'LRTB','false');

// ... (Tablo kısımları aynı kalıyor) ...
$pdf->SetFont('Arial','B',8);
$pdf->Cell(30,7,'Ad Soyad',1,0,'L');
$pdf->Cell(159,7,$ogrenci_ad_soyad,1,1,'L');
$pdf->Cell(45,7,'TC Kimlik Numarasi',1,0,'L');
$pdf->Cell(49.5,7,$ogrenci_tc,1,0,'L');   
$pdf->Cell(45,7,'Uyrugu',1,0,'L');
$pdf->Cell(49.5,7,$ogrenci_uyrugu,1,1,'L');
$pdf->Cell(30,7,'Ev TeL/ GSM',1,0,'L');
$pdf->Cell(40,7,$ogrenci_tel,1,0,'L');
$pdf->Cell(20,7,'E-Posta',1,0,'L');
$pdf->Cell(99,7,$ogrenci_mail,1,1,'L');
$pdf->Cell(15,10,'Adres',1,0,'L');
$pdf->Cell(10,10,'il',1,0,'L');
$pdf->Cell(50,10,$ogrenci_il,1,0,'L');
$pdf->Cell(12,10,'ilce',1,0,'L');
$pdf->Cell(50,10,$ogrenci_ilce,1,0,'L');
$pdf->Cell(22,10,'Posta Kodu',1,0,'L');
$pdf->Cell(30,10,$ogrenci_posta_kod,1,1,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->MultiCell(189,5,'Staj Bilgileri','LRTB','C',false);
$pdf->Cell(189,5,'Staj I',1,1,'C');
$pdf->Cell(47.25,7,"Baslama Tarihi: {$staj_baslama_tarih}" ,1,0,'C');
$pdf->Cell(40,7,"Bitis Tarihi: {$staj_bitis_tarih}",1,0,'C');
$pdf->Cell(35,7,"Is Gunu: {$is_gunu}",1,0,'C');
$pdf->Cell(66.75,7,"Cumartesi Çalisiyor: {$cumartesi_calisma}",1,1,'C');
$pdf->Ln(4);
$pdf->SetFont('Arial','',6);
$pdf->Cell(169,7,'Ailemden,  Kendimden veya  Anne-Baba Uzerinden Genel Saglik Sigortasi Kapsaminda Saglik Hizmeti Aliyorum',1,0,'L');
$pdf->SetFont('Arial','B',6);
$pdf->Cell(20,7,"$saglik_hizmet",1,1,'C');
$pdf->SetFont('Arial','',6);
$pdf->Cell(169,7,'Genel Saglik Sigortasi (GSS) (Gelir Testi Yaptirdim Pirim Oduyorum)',1,0,'L');
$pdf->SetFont('Arial','B',6);
$pdf->Cell(20,7,"$genel_saglik_sigorta",1,1,'C');
$pdf->SetFont('Arial','',6);
$pdf->Cell(169,7,'25 Yasini Doldurdum',1,0,'L');
$pdf->SetFont('Arial','B',6);
$pdf->Cell(20,7,"$yirmibes_doldurdum",1,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->MultiCell(189,5,'Staj Yapilacak Kurum Bilgileri','LRTB','C',false);
$pdf->Cell(30,7,'Resmi Adi',1,0,'L');
$pdf->Cell(159,7,$firma_isim,1,1,'C');
$pdf->Cell(30,7,'Faaliyet Alani',1,0,'L');
$pdf->Cell(159,7,$firma_calismaalani,1,1,'C');
$pdf->Cell(15,10,'Adres',1,0,'L');
$pdf->Cell(10,10,'Il',1,0,'L');
$pdf->Cell(50,10,$firma_il,1,0,'L');
$pdf->Cell(12,10,'Ilce',1,0,'L');
$pdf->Cell(50,10,$firma_ilce,1,0,'L');
$pdf->Cell(22,10,'Posta Kodu',1,0,'L');
$pdf->Cell(30,10,$firma_posta_kod,1,1,'L');
$pdf->MultiCell(189,7,'İletisim Bilgileri','LRTB','C',false);
$pdf->Cell(63,7,"Telefon: {$firma_tel}",1,0,'L');
$pdf->Cell(63,7,"Fax:{$firma_fax} ",1,0,'L');
$pdf->Cell(63,7,"E-Posta: {$firma_email} ",1,1,'L');
$pdf->Cell(50,7,'Staj Sorumlusunun Unvani',1,0,'L');
$pdf->Cell(139,7,$firma_yetkili_unvan,1,1,'L');
$pdf->Cell(136,7,'Kurum olarak 3308 sayili kanundaki devlet katkisindan yararlanmak istiyor musunuz?',1,0,'L');
$pdf->Cell(54,7,"$devlet_katkisi",1,1,'C');
$pdf->SetFont('Arial','',8,);
$pdf->Cell(180,6,'Yukarida adi geçen ogrencinin ilgili tarihlerde staj uygulamasini kurumumuzda yapmasi uygun gorulmustur',0,0,'L');
$pdf->SetFont('Arial','B',8,);
$pdf->Cell(-16,12,"Firma Yetkilisinin Adi Soyadi: {$firma_yetkili_adsoyad}",0,1,'R');
$pdf->Cell(158,-2,"Unvani: {$firma_yetkili_unvan}",0,1,'R');
$pdf->Cell(158,8,'Kaşe ve Imza: ',0,1,'R');
$pdf->SetFont('Arial','',6,);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',8,);
// FOOTER GÜNCELLEMESİ
$pdf->MultiCell(189,5,'T.C. Necmettin Erbakan Universitesi Muhendislik Fakultesi Bolum Is Yeri ve Staj Komisyonu Onayi','','C',false);
$pdf->MultiCell(189,5,'  Yukarida adi geçen ogrencinin ilgili tarihlerde staj uygulamasini ilgili kurumda yapmasi','LRTB','C',false);
$pdf->Cell(94.5,5,'Uygundur ',1,0,'C');
$pdf->Cell(94.5,5,'Uygun Değildir ',1,1,'C');
$pdf->Cell(189,10,'Not: ',1,1,'L');
$pdf->Cell(180,10,'ONAY',0,1,'R');

$pdf->Output();