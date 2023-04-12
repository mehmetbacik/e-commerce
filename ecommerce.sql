-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 12 Nis 2023, 21:52:36
-- Sunucu sürümü: 8.0.17
-- PHP Sürümü: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ecommerce`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `setting_logo` varchar(150) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_title` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_description` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_author` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_tel` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_gsm` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_fax` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_mail` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_district` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_country` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_adress` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_time` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_maps` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_analystic` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_desk` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_facebook` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_twitter` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_google` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_youtube` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_smtphost` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_smtppassword` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_smtpport` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_live` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `setting`
--

INSERT INTO `setting` (`setting_id`, `setting_logo`, `setting_title`, `setting_description`, `setting_author`, `setting_tel`, `setting_gsm`, `setting_fax`, `setting_mail`, `setting_district`, `setting_country`, `setting_adress`, `setting_time`, `setting_maps`, `setting_analystic`, `setting_desk`, `setting_facebook`, `setting_twitter`, `setting_google`, `setting_youtube`, `setting_smtphost`, `setting_smtppassword`, `setting_smtpport`, `setting_live`) VALUES
(1, 'logo.png', 'E-Commerce', 'E-commerce shopping page', 'MBCK', '02120000000', '05000000000', '02160000000', 'admin@ecommerce.com', 'Kadıköy', 'İstanbul', 'Bağdat Cad., No:2B, Kadıköy, İstanbul, Türkiye', '09:00 - 18:00', NULL, NULL, NULL, 'facebook_adresi', 'twitter_adresi', 'google_adresi', 'youtube_adresi', NULL, NULL, NULL, '1');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
