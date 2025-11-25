-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 22 Kas 2025, 18:05:05
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `yazgeldb`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_full_name` varchar(128) DEFAULT NULL,
  `admin_email` varchar(128) NOT NULL,
  `admin_password` varchar(128) DEFAULT NULL,
  `admin_type` enum('super_admin','normal_admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_full_name`, `admin_email`, `admin_password`, `admin_type`) VALUES
(1, 'Doç. Dr. Murat KARAKOYUN', 'mkarakoyun@erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'super_admin'),
(2, 'Prof. Dr. Mehmet HACIBEYOĞLU', 'hacibeyoglu@erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'normal_admin'),
(3, 'Doç. Dr. Hüseyin HAKLI', 'hhakli@erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'normal_admin');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` int(11) NOT NULL,
  `announcement_title` varchar(256) NOT NULL,
  `announcement_content` varchar(1000) NOT NULL,
  `announcement_file` varchar(300) DEFAULT NULL,
  `announcement_author` varchar(256) NOT NULL,
  `announcement_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `announcement`
--

INSERT INTO `announcement` (`announcement_id`, `announcement_title`, `announcement_content`, `announcement_file`, `announcement_author`, `announcement_datetime`) VALUES
(10, 'Bu Bir deneme Duyurusudur', 'Deneme duyurusu 1 2 3', '6921d5b754f691.08318398.pdf', '200107005', '2025-11-22 15:24:39');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `newuser`
--

CREATE TABLE `newuser` (
  `user_id` int(11) NOT NULL,
  `user_fullName` varchar(128) NOT NULL,
  `user_password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pdf_file`
--

CREATE TABLE `pdf_file` (
  `id` int(11) NOT NULL,
  `pdf` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `pdf_file`
--

INSERT INTO `pdf_file` (`id`, `pdf`) VALUES
(1, 'Hafta_1.1.pdf');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `staj_basvuru`
--

CREATE TABLE `staj_basvuru` (
  `basvuru_id` int(11) NOT NULL,
  `basvuru_turu` enum('staj1','staj2') NOT NULL,
  `ogrenci_numarasi` varchar(32) NOT NULL,
  `baslama_tarihi` varchar(64) NOT NULL,
  `bitis_tarihi` varchar(64) NOT NULL,
  `is_gunu` int(11) NOT NULL,
  `cumartesi_calisiyor` enum('yes','no') DEFAULT NULL,
  `gss_kapsam` enum('yes','no') NOT NULL,
  `saglik_hizmet_almasi` enum('yes','no') NOT NULL,
  `yas_25` enum('yes','no') NOT NULL,
  `firma_adi` varchar(256) NOT NULL,
  `firma_email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `staj_basvuru`
--

INSERT INTO `staj_basvuru` (`basvuru_id`, `basvuru_turu`, `ogrenci_numarasi`, `baslama_tarihi`, `bitis_tarihi`, `is_gunu`, `cumartesi_calisiyor`, `gss_kapsam`, `saglik_hizmet_almasi`, `yas_25`, `firma_adi`, `firma_email`) VALUES
(32, 'staj1', '191307033', '2025-11-22', '2026-01-10', 30, NULL, 'yes', 'yes', 'yes', 'dasdasdsa', 'czxcxzc@gmail.com'),
(33, 'staj2', '191307033', '2026-02-02', '2026-05-05', 30, NULL, 'yes', 'yes', 'yes', 'qwertyuı', 'czxcxzc@gmail.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `staj_belgeleri`
--

CREATE TABLE `staj_belgeleri` (
  `id` int(11) NOT NULL,
  `staj_turu` enum('staj1','staj2') NOT NULL,
  `ogrenci_numarasi` varchar(32) NOT NULL,
  `staj_raporu` varchar(300) NOT NULL,
  `staj_degerlendirme_formu` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `staj_kabul_belgesi`
--

CREATE TABLE `staj_kabul_belgesi` (
  `id` int(11) NOT NULL,
  `staj_turu` enum('staj1','staj2') NOT NULL,
  `ogrenci_numarasi` varchar(32) NOT NULL,
  `ogrenci_staj_kabul_belgesi` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `staj_raporu`
--

CREATE TABLE `staj_raporu` (
  `id` int(11) NOT NULL,
  `staj_turu` enum('staj1','staj2') NOT NULL,
  `ogrenci_numarasi` varchar(32) NOT NULL,
  `rapor` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `staj_takibi`
--

CREATE TABLE `staj_takibi` (
  `id` int(11) NOT NULL,
  `staj_tur` enum('staj1','staj2') NOT NULL,
  `ogrenci_numarasi` varchar(32) NOT NULL,
  `staj_durumu` enum('done','belge_yuklenmesi','degerlendirme','eksik_belge','onaylandi','yeni_basvuru','basarisiz') NOT NULL,
  `geri_bildirim` varchar(1000) DEFAULT NULL,
  `ogretmen_numarasi` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `student`
--

CREATE TABLE `student` (
  `kullanci_id` int(11) NOT NULL,
  `ogrenci_ad_soyad` varchar(128) NOT NULL,
  `ogrenci_tc` varchar(15) NOT NULL,
  `ogrenci_uyrugu` varchar(64) NOT NULL,
  `ogrenci_tel` varchar(20) DEFAULT NULL,
  `ogrenci_mail` varchar(128) NOT NULL,
  `ogrenci_password` varchar(128) NOT NULL,
  `ogrenci_okul_adi` varchar(256) NOT NULL,
  `ogrenci_fakulte_adi` varchar(128) NOT NULL,
  `ogrenci_bolumm_adi` varchar(128) NOT NULL,
  `ogrenci_sinif` varchar(16) NOT NULL,
  `ogrenci_okul_no` varchar(64) NOT NULL,
  `ogrenci_address` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `student`
--

INSERT INTO `student` (`kullanci_id`, `ogrenci_ad_soyad`, `ogrenci_tc`, `ogrenci_uyrugu`, `ogrenci_tel`, `ogrenci_mail`, `ogrenci_password`, `ogrenci_okul_adi`, `ogrenci_fakulte_adi`, `ogrenci_bolumm_adi`, `ogrenci_sinif`, `ogrenci_okul_no`, `ogrenci_address`) VALUES
(1, 'Hayri Batuhan ARAL', '11111111101', 'T.C.', '+90 555 111 2233', '191307033@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '4', '191307033', 'Selçuklu, Konya'),
(2, 'Ahmet YILMAZ', '11111111102', 'T.C.', '+90 555 222 3344', '201307001@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '3', '201307001', 'Çankaya, Ankara'),
(3, 'Ayşe DEMİR', '11111111103', 'T.C.', '+90 555 333 4455', '201307002@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '3', '201307002', 'Kadıköy, İstanbul'),
(4, 'Mehmet KAYA', '11111111104', 'T.C.', '+90 555 444 5566', '211307003@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '2', '211307003', 'Muratpaşa, Antalya'),
(5, 'Fatma ÇELİK', '11111111105', 'T.C.', '+90 555 555 6677', '191307004@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '4', '191307004', 'Bornova, İzmir'),
(6, 'Mustafa ŞAHİN', '11111111106', 'T.C.', '+90 555 666 7788', '211307005@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '2', '211307005', 'Nilüfer, Bursa'),
(7, 'Zeynep ÖZTÜRK', '11111111107', 'T.C.', '+90 555 777 8899', '201307006@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '3', '201307006', 'Seyhan, Adana'),
(8, 'Emre AYDIN', '11111111108', 'T.C.', '+90 555 888 9900', '221307007@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '1', '221307007', 'Şahinbey, Gaziantep'),
(9, 'Selin YILDIZ', '11111111109', 'T.C.', '+90 555 999 0011', '191307008@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '4', '191307008', 'Odunpazarı, Eskişehir'),
(10, 'Burak KILIÇ', '11111111110', 'T.C.', '+90 555 000 1122', '201307009@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '3', '201307009', 'Pamukkale, Denizli'),
(11, 'Elif ARSLAN', '11111111111', 'T.C.', '+90 555 123 4567', '211307010@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '2', '211307010', 'Atakum, Samsun'),
(12, 'Caner GÜNEŞ', '11111111112', 'T.C.', '+90 555 234 5678', '221307011@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '1', '221307011', 'Ortahisar, Trabzon'),
(13, 'Gizem KOÇ', '11111111113', 'T.C.', '+90 555 345 6789', '191307012@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '4', '191307012', 'İpekyolu, Van'),
(14, 'Oğuzhan TEKİN', '11111111114', 'T.C.', '+90 555 456 7890', '201307013@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '3', '201307013', 'Yeşilyurt, Malatya'),
(15, 'Buse ÜNAL', '11111111115', 'T.C.', '+90 555 567 8901', '211307014@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '2', '211307014', 'Onikişubat, Kahramanmaraş'),
(16, 'Serkan POLAT', '11111111116', 'T.C.', '+90 555 678 9012', '221307015@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '1', '221307015', 'Haliliye, Şanlıurfa'),
(17, 'Ceren YAVUZ', '11111111117', 'T.C.', '+90 555 789 0123', '191307016@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '4', '191307016', 'Kayapınar, Diyarbakır'),
(18, 'Kaan ERDEM', '11111111118', 'T.C.', '+90 555 890 1234', '201307017@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '3', '201307017', 'Merkez, Sivas'),
(19, 'İrem ACAR', '11111111119', 'T.C.', '+90 555 901 2345', '211307018@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '2', '211307018', 'Merkez, Kütahya'),
(20, 'Onur CAN', '11111111120', 'T.C.', '+90 555 012 3456', '221307019@ogr.erbakan.edu.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'Necmettin Erbakan Üniversitesi', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', '1', '221307019', 'Meram, Konya');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `teacher`
--

CREATE TABLE `teacher` (
  `ogretmen_id` int(11) NOT NULL,
  `ogretmen_ad_soyad` varchar(128) NOT NULL,
  `ogretmen_tc` varchar(20) NOT NULL,
  `ogretmen_mail` varchar(128) NOT NULL,
  `ogretmen_tel` varchar(20) NOT NULL,
  `ogretmen_okul_no` varchar(20) NOT NULL,
  `ogretmen_password` varchar(128) NOT NULL,
  `ogretmen_fakulte_adi` varchar(128) NOT NULL,
  `ogretmen_bolum_adi` varchar(128) NOT NULL,
  `role` enum('ogretmen','komisyon') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `teacher`
--

INSERT INTO `teacher` (`ogretmen_id`, `ogretmen_ad_soyad`, `ogretmen_tc`, `ogretmen_mail`, `ogretmen_tel`, `ogretmen_okul_no`, `ogretmen_password`, `ogretmen_fakulte_adi`, `ogretmen_bolum_adi`, `role`) VALUES
(1, 'Prof. Dr. Mehmet HACIBEYOĞLU', '10000000001', 'hacibeyoglu@erbakan.edu.tr', '+90 332 324 3030', '200107001', '827ccb0eea8a706c4c34a16891f84e7b', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', 'komisyon'),
(2, 'Prof. Dr. Sabri KOÇER', '10000000002', 'skocer@erbakan.edu.tr', '+90 332 324 3031', '200107002', '827ccb0eea8a706c4c34a16891f84e7b', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', 'komisyon'),
(3, 'Doç. Dr. Hüseyin HAKLI', '10000000003', 'hhakli@erbakan.edu.tr', '+90 332 324 3032', '200107003', '827ccb0eea8a706c4c34a16891f84e7b', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', 'komisyon'),
(4, 'Prof. Dr. Abdullah Erdal TÜMER', '10000000004', 'tumer@erbakan.edu.tr', '+90 332 324 3033', '200107004', '827ccb0eea8a706c4c34a16891f84e7b', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', 'ogretmen'),
(5, 'Doç. Dr. Murat KARAKOYUN', '10000000005', 'mkarakoyun@erbakan.edu.tr', '+90 332 324 3034', '200107005', '827ccb0eea8a706c4c34a16891f84e7b', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', 'ogretmen'),
(6, 'Doç. Dr. Ahmet ÖZKİŞ', '10000000006', 'aozkis@erbakan.edu.tr', '+90 332 324 3035', '200107006', '827ccb0eea8a706c4c34a16891f84e7b', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', 'ogretmen'),
(7, 'Doç. Dr. Muhammed KARAALTUN', '10000000007', 'muhammed.karaaltun@erbakan.edu.tr', '+90 332 324 3036', '200107007', '827ccb0eea8a706c4c34a16891f84e7b', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', 'ogretmen'),
(8, 'Dr. Öğr. Üyesi Alperen EROĞLU', '10000000008', 'aeroglu@erbakan.edu.tr', '+90 332 324 3037', '200107008', '827ccb0eea8a706c4c34a16891f84e7b', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', 'ogretmen'),
(9, 'Dr. Öğr. Üyesi Özlem ERDAŞ ÇİÇEK', '10000000009', 'ozlem.erdascicek@erbakan.edu.tr', '+90 332 324 3038', '200107009', '827ccb0eea8a706c4c34a16891f84e7b', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', 'ogretmen'),
(10, 'Dr. Öğr. Üyesi Arda SÖYLEV', '10000000010', 'asoylev@erbakan.edu.tr', '+90 332 324 3039', '200107010', '827ccb0eea8a706c4c34a16891f84e7b', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', 'ogretmen'),
(11, 'Arş. Gör. Dr. Sinem ÇINAROĞLU', '10000000011', 'soren@erbakan.edu.tr', '+90 332 324 3040', '200107011', '827ccb0eea8a706c4c34a16891f84e7b', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', 'ogretmen'),
(12, 'Arş. Gör. Behice Gülsüm ÇELİK', '10000000012', 'bgcelik@erbakan.edu.tr', '+90 332 324 3041', '200107012', '827ccb0eea8a706c4c34a16891f84e7b', 'Mühendislik Fakültesi', 'Bilgisayar Mühendisliği', 'ogretmen');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Tablo için indeksler `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Tablo için indeksler `newuser`
--
ALTER TABLE `newuser`
  ADD PRIMARY KEY (`user_id`);

--
-- Tablo için indeksler `pdf_file`
--
ALTER TABLE `pdf_file`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `staj_basvuru`
--
ALTER TABLE `staj_basvuru`
  ADD PRIMARY KEY (`basvuru_id`);

--
-- Tablo için indeksler `staj_belgeleri`
--
ALTER TABLE `staj_belgeleri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `staj_kabul_belgesi`
--
ALTER TABLE `staj_kabul_belgesi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `staj_raporu`
--
ALTER TABLE `staj_raporu`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `staj_takibi`
--
ALTER TABLE `staj_takibi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`kullanci_id`);

--
-- Tablo için indeksler `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`ogretmen_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `newuser`
--
ALTER TABLE `newuser`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Tablo için AUTO_INCREMENT değeri `pdf_file`
--
ALTER TABLE `pdf_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `staj_basvuru`
--
ALTER TABLE `staj_basvuru`
  MODIFY `basvuru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Tablo için AUTO_INCREMENT değeri `staj_belgeleri`
--
ALTER TABLE `staj_belgeleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `staj_kabul_belgesi`
--
ALTER TABLE `staj_kabul_belgesi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `staj_raporu`
--
ALTER TABLE `staj_raporu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `staj_takibi`
--
ALTER TABLE `staj_takibi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Tablo için AUTO_INCREMENT değeri `student`
--
ALTER TABLE `student`
  MODIFY `kullanci_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `teacher`
--
ALTER TABLE `teacher`
  MODIFY `ogretmen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
