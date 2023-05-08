-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 08 May 2023, 18:49:26
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
-- Tablo için tablo yapısı `about`
--

CREATE TABLE `about` (
  `about_id` int(11) NOT NULL,
  `about_title` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `about_content` text COLLATE utf8_turkish_ci NOT NULL,
  `about_video` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `about_vision` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `about_mission` varchar(500) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `about`
--

INSERT INTO `about` (`about_id`, `about_title`, `about_content`, `about_video`, `about_vision`, `about_mission`) VALUES
(1, 'About Title', '<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </strong>Proin sed ex vel elit luctus euismod. Donec commodo a massa quis ultricies. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec condimentum placerat massa, eu ornare nibh sagittis sit amet. Nullam convallis cursus scelerisque. Ut iaculis sollicitudin dolor, vel lobortis leo tempus in. Donec rutrum justo id viverra convallis. Fusce gravida ullamcorper posuere.</p>', 'jNQXAC9IVRw', 'Nullam ut varius sapien. In quis urna ut felis hendrerit vehicula tincidunt eu mi. Donec varius varius sem at bibendum. Mauris placerat libero ut accumsan tempor. Praesent eu sodales urna. Morbi sed metus convallis, egestas nisl vel, tristique ante.', 'Nullam ut varius sapien. In quis urna ut felis hendrerit vehicula tincidunt eu mi. Donec varius varius sem at bibendum. Mauris placerat libero ut accumsan tempor. Praesent eu sodales urna. Morbi sed metus convallis, egestas nisl vel, tristique ante.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `category_top` int(2) NOT NULL,
  `category_seourl` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `category_order` int(2) NOT NULL,
  `category_status` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_top`, `category_seourl`, `category_order`, `category_status`) VALUES
(1, 'Shoes', 0, '', 0, '1'),
(2, 'Shirt', 0, '', 1, '1'),
(3, 'Jumper', 0, '', 2, '1'),
(4, 'Coats', 0, '', 3, '1'),
(5, 'Jeans', 0, '', 4, '1'),
(6, 'Jacket', 0, '', 5, '1'),
(7, 'Bag', 0, '', 6, '1'),
(8, 'Hat', 0, '', 7, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_top` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `menu_name` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `menu_detail` text COLLATE utf8_turkish_ci NOT NULL,
  `menu_url` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `menu_order` int(2) NOT NULL,
  `menu_status` enum('0','1') COLLATE utf8_turkish_ci NOT NULL,
  `menu_seourl` varchar(250) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_top`, `menu_name`, `menu_detail`, `menu_url`, `menu_order`, `menu_status`, `menu_seourl`) VALUES
(1, '0', 'About', '', 'about', 0, '1', 'about'),
(3, '0', 'Contact', '', 'contact', 1, '1', 'contact'),
(4, '0', 'Category', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', '', 2, '1', 'category'),
(7, '', 'Product', '<p>Menu Detail Content Text</p>', 'product', 3, '0', 'product');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `setting_logo` varchar(150) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_url` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `setting_title` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_description` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `setting_keywords` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
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

INSERT INTO `setting` (`setting_id`, `setting_logo`, `setting_url`, `setting_title`, `setting_description`, `setting_keywords`, `setting_author`, `setting_tel`, `setting_gsm`, `setting_fax`, `setting_mail`, `setting_district`, `setting_country`, `setting_adress`, `setting_time`, `setting_maps`, `setting_analystic`, `setting_desk`, `setting_facebook`, `setting_twitter`, `setting_google`, `setting_youtube`, `setting_smtphost`, `setting_smtppassword`, `setting_smtpport`, `setting_live`) VALUES
(1, 'images/30283logo.png', 'http://siteadi.com', 'E-Commerce Page', 'E-commerce shopping page', 'E-Commerce, Shopping', 'MBCK', '02120000000', '05000000000', '02160000000', 'admin@ecommerce.com', 'Kadıköy', 'İstanbul', 'Bağdat Cad., No:2B, Kadıköy, İstanbul, Türkiye', '09:00 - 18:00', 'Maps test code', 'Analystic test code', 'Helpdesk test code', 'facebook_adresi', 'twitter_adresi', 'google_adresi', 'youtube_adresi', 'host', '123456789', 'port', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_name` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `slider_imgurl` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `slider_order` int(2) NOT NULL,
  `slider_link` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `slider_status` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_name`, `slider_imgurl`, `slider_order`, `slider_link`, `slider_status`) VALUES
(5, 'Slider 1', 'images/slider/28466236822818125814slide-1.jpg', 1, 'test', '1'),
(6, 'Slider 2', 'images/slider/24799289202516622533slide-2.jpg', 2, '', '1'),
(7, 'Slider 3', 'images/slider/30063252702659021852slide-3.jpg', 3, '', '1'),
(10, 'Slider 4', 'images/slider/29862204183105924319slide-4.jpg', 4, 'test', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_image` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_tc` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_mail` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_gsm` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_password` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_adress` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_country` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_district` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_authority` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`user_id`, `user_time`, `user_image`, `user_tc`, `user_name`, `user_mail`, `user_gsm`, `user_password`, `user_adress`, `user_country`, `user_district`, `user_title`, `user_authority`, `user_status`) VALUES
(1, '2023-04-19 19:17:15', NULL, NULL, 'Name', 'name.surname@ecommerce.com', '0500 000 00 00', '25d55ad283aa400af464c76d713c07ad', 'Türkiye', 'İstanbul', 'Üsküdar', NULL, '9', 1),
(2, '2023-04-19 19:17:15', NULL, NULL, 'Nameee', '1@ecommerce.com', '0500 000 00 00', '25d55ad283aa400af464c76d713c07ad', 'Türkiye', 'İstanbul', 'Üsküdar', NULL, '9', 1),
(3, '2023-04-19 19:17:15', NULL, NULL, 'Name123', '2@ecommerce.com', '0500 000 00 00', '25d55ad283aa400af464c76d713c07ad', 'Türkiye', 'İstanbul', 'Üsküdar', NULL, '9', 1),
(8, '2023-05-02 19:47:37', NULL, NULL, 'test test', 'test@test.com', '0500 000 00 00', '25d55ad283aa400af464c76d713c07ad', 'Türkiye', 'İstanbul', 'Fatih', NULL, '1', 1),
(9, '2023-05-05 15:10:52', NULL, NULL, 'test1', 'test1@test.com', NULL, 'e99a18c428cb38d5f260853678922e03', NULL, NULL, NULL, NULL, '1', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`about_id`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Tablo için indeksler `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Tablo için indeksler `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Tablo için indeksler `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
