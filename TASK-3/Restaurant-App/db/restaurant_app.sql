-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: db:3306
-- Üretim Zamanı: 17 Eki 2024, 19:30:29
-- Sunucu sürümü: 9.0.1
-- PHP Sürümü: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `restaurant_app`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `0rder`
--

CREATE TABLE `0rder` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `order_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'hazirlaniyor',
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `0rder`
--

INSERT INTO `0rder` (`id`, `user_id`, `order_status`, `total_price`, `created_at`) VALUES
(1, 0, 'hazirlaniyor', 0.00, '2024-10-11 13:51:12'),
(2, 0, 'hazirlaniyor', 0.00, '2024-10-11 13:51:28');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `basket`
--

CREATE TABLE `basket` (
  `id` int NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `food_id` bigint UNSIGNED DEFAULT NULL,
  `note` text,
  `quantity` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `basket`
--

INSERT INTO `basket` (`id`, `user_id`, `food_id`, `note`, `quantity`, `created_at`) VALUES
(1, 0, 1, 'asdfg', 112, '2024-10-09 16:03:37'),
(2, 0, 1, 'asdfg', 217, '2024-10-09 16:03:59'),
(3, 0, 1, 'vergisiz olsun', 217, '2024-10-09 16:04:05'),
(4, 0, 2, 'sos getirin', 132, '2024-10-09 16:04:50'),
(5, 0, 2, 'sos getirin', 132, '2024-10-09 16:06:03'),
(6, 0, 2, 'asdf', 132, '2024-10-09 16:12:52'),
(7, 0, 1, 'vergisiz olsun', 217, '2024-10-09 16:28:33'),
(8, 36, 1, 'sos getirin', 217, '2024-10-14 21:01:26');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `restaurant_id` int UNSIGNED DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `company`
--

CREATE TABLE `company` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `logo_path` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `company`
--

INSERT INTO `company` (`id`, `name`, `description`, `logo_path`, `deleted_at`) VALUES
(1, 'YAVUZLAR İNC.', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `coupon`
--

CREATE TABLE `coupon` (
  `id` bigint UNSIGNED NOT NULL,
  `restaurant_id` int UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `food`
--

CREATE TABLE `food` (
  `id` bigint UNSIGNED NOT NULL,
  `restaurant_id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `image_path` varchar(255) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `discount` decimal(6,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `food`
--

INSERT INTO `food` (`id`, `restaurant_id`, `name`, `description`, `image_path`, `price`, `discount`, `created_at`, `deleted_at`) VALUES
(1, 4, 'Zurna Döner', 'vergisiz', 'img\\food\\zurna_dürüm.jpg', 232.14, 15.00, '2024-10-06 12:35:18', NULL),
(2, 4, 'Normal dürüm', 'normal', 'null', 132.33, NULL, '2024-10-07 17:35:08', '2024-10-07 18:08:07'),
(7, 4, 'Adana Dürüm', '%100 dana eti', 'null', 137.37, NULL, '2024-10-14 21:05:34', '2024-10-14 21:05:41');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int UNSIGNED NOT NULL,
  `company_id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `restaurant`
--

INSERT INTO `restaurant` (`id`, `company_id`, `name`, `description`, `image_path`, `created_at`, `deleted_at`) VALUES
(1, 1, 'donerG', NULL, 'img/restaurant/1/donerg.jpg', NULL, NULL),
(2, 1, 'etG', NULL, '/img/restaurant/2/etG.jpg', NULL, NULL),
(4, 1, 'Katık', 'Vergisiz  Döner', 'img/restaurant/1/donerg.jpg', '2024-10-05 16:01:32', '2024-10-06 13:57:17'),
(5, 1, 'ms DÜRÜM', 'leziz', 'NULL', '2024-10-06 14:01:15', '2024-10-06 14:01:29');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `is_admin` int NOT NULL DEFAULT '0',
  `company_id` int UNSIGNED DEFAULT NULL,
  `restaurant_id` int DEFAULT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_tr_0900_as_cs NOT NULL,
  `balance` decimal(10,3) DEFAULT '5000.000',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `is_admin`, `company_id`, `restaurant_id`, `role`, `name`, `surname`, `username`, `password`, `balance`, `created_at`, `deleted_at`) VALUES
(0, 1, NULL, NULL, 'musteri', 'admin', 'admin', 'admin', '$argon2id$v=19$m=65536,t=4,p=1$c3VSMkpLQlhxcG9XYUtWUw$ihkB2eVPDFE2hitsD3Z138gFdKzaWqVV3Mvym+Yc5bc', 5000.000, '2024-10-07 15:56:37', NULL),
(1, 0, NULL, NULL, '', NULL, NULL, 'phphiçsevmem', '', 5000.000, '2024-09-17 17:28:08', NULL),
(4, 0, NULL, NULL, '', NULL, NULL, 'lastuser', '', 5000.000, '2024-09-17 17:33:14', NULL),
(5, 0, NULL, NULL, 'calisan', 'Tucker Dotson', 'Lowe', 'qejocequdi', '$argon2i$v=19$m=65536', 5000.000, '2024-09-17 18:24:33', NULL),
(6, 0, NULL, NULL, 'calisan', 'Gloria Vargas', 'Wilkinson', 'tahusutex', '$argon2i$v=19$m=65536', 5000.000, '2024-09-17 18:42:20', NULL),
(7, 0, NULL, NULL, 'calisan', 'Maite Carney', 'Hendricks', 'zedihib', '$argon2i$v=19$m=65536', 5000.000, '2024-09-17 18:44:56', NULL),
(8, 0, NULL, NULL, 'calisan', 'Clementine Pope', 'Clark', 'qezubutupo', '$argon2i$v=19$m=65536', 5000.000, '2024-09-17 18:45:25', NULL),
(9, 0, NULL, NULL, 'calisan', 'Brennan Bennett', 'Mcclure', 'fowuzem', '$argon2i$v=19$m=65536', 5000.000, '2024-09-17 18:46:28', NULL),
(10, 0, NULL, NULL, 'calisan', 'Yetta Kennedy', 'Chen', 'gikynatit', '$argon2i$v=19$m=65536', 5000.000, '2024-09-17 18:47:33', NULL),
(11, 0, NULL, NULL, 'calisan', 'Melinda Cervantes', 'Ryan', 'piwacag', '$argon2i$v=19$m=65536', 5000.000, '2024-09-17 18:48:45', NULL),
(12, 0, 1, NULL, 'calisan', 'Chancellor Wilder', 'Holden', 'zaxus', '$argon2i$v=19$m=65536', 5000.000, '2024-09-17 18:49:53', NULL),
(13, 0, NULL, NULL, 'musteri', 'Bianca Case', 'Harding', 'jofelahu', '$argon2i$v=19$m=65536', 5000.000, '2024-09-17 18:50:32', NULL),
(14, 0, 1, NULL, 'calisan', 'Rhiannon Padilla', 'Clark', 'piculesa', '$argon2i$v=19$m=65536', 5000.000, '2024-09-18 14:13:32', NULL),
(15, 0, NULL, NULL, '', '', '', '', '$argon2i$v=19$m=65536', 5000.000, '2024-09-23 14:28:43', NULL),
(16, 0, 1, NULL, 'calisan', 'asdfsdf', 'sdfsdf', 'sdfds', '$argon2i$v=19$m=65536', 5000.000, '2024-10-06 14:11:47', NULL),
(17, 0, NULL, NULL, 'calisan', 'deneme', 'deneme', 'deneme', '$argon2i$v=19$m=65536', 5000.000, '2024-10-06 14:24:12', NULL),
(18, 0, NULL, NULL, 'calisan', 'deneme2', 'deneme2', 'deneme2', '$argon2i$v=19$m=65536', 5000.000, '2024-10-06 14:28:06', NULL),
(19, 0, NULL, NULL, 'calisan', 'deneme3', 'deneme3', 'deneme3', '$argon2i$v=19$m=65536', 5000.000, '2024-10-06 14:32:19', NULL),
(20, 0, NULL, NULL, 'calisan', 'asd', 'asd', 'asd', '$argon2i$v=19$m=65536', 5000.000, '2024-10-06 14:32:45', NULL),
(21, 0, NULL, NULL, 'calisan', 'deneme5', 'deneme5', 'deneme5', '$argon2i$v=19$m=65536', 5000.000, '2024-10-06 14:34:22', NULL),
(22, 0, 1, 4, 'calisan', 'deneme6', 'deneme6', 'deneme6', '$argon2i$v=19$m=65536', 5000.000, '2024-10-06 14:40:11', NULL),
(23, 0, 1, 5, 'calisan', 'deneme7', 'deneme7', 'deneme7', '$argon2i$v=19$m=65536', 5000.000, '2024-10-06 14:56:40', NULL),
(24, 0, NULL, NULL, 'musteri', 'deneme8', 'deneme8', 'deneme8', '$argon2i$v=19$m=65536', 5000.000, '2024-10-07 14:59:19', NULL),
(25, 0, NULL, NULL, '', 'deneme9', 'deneme9', 'deneme9', '$argon2i$v=19$m=65536', 5000.000, '2024-10-07 15:06:32', NULL),
(26, 0, NULL, NULL, 'musteri', 'deneme33', 'deneme33', 'deneme33', '$argon2i$v=19$m=65536', 5000.000, '2024-10-07 15:07:05', NULL),
(27, 0, NULL, NULL, 'musteri', 'deneme35', 'deneme35', 'deneme35', '$argon2id$v=19$m=65536', 5000.000, '2024-10-07 15:08:50', NULL),
(28, 0, NULL, NULL, 'musteri', 'deneme74', 'deneme74', 'deneme74', '$argon2id$v=19$m=65536', 5000.000, '2024-10-07 15:11:31', NULL),
(29, 0, NULL, NULL, 'musteri', 'deneme75', 'deneme75', 'deneme75', '$argon2id$v=19$m=65536', 5000.000, '2024-10-07 15:14:34', NULL),
(34, 0, NULL, NULL, 'musteri', 'deneme100', 'deneme100', 'deneme100', '$argon2id$v=19$m=65536,t=4,p=1$TUJHNUNNVEY0eDRvZ1dMRA$gcovWUHP7dkWYIwG8Ux3QaFbHOqZLXCKiOTLlC9b8po', 5000.000, '2024-10-07 15:34:27', NULL),
(35, 0, 1, 4, 'calisan', 'katıkcı', 'vergi', 'katık74', '$argon2id$v=19$m=65536,t=4,p=1$M3IyVkdUbjM2TlBmd044Uw$wVFcUV5hrEBqT8BIQPSAcSg6fgplKIvjH6SIT6+rkt4', 5000.000, '2024-10-07 15:47:36', NULL),
(36, 0, NULL, NULL, 'musteri', 'Ahmet', 'Sdf', 'ahmet1453', '$argon2id$v=19$m=65536,t=4,p=1$RWNZR0EySEloV2VyREd5eA$ZyEh3DQ9rt6sN8xZT1bO6nzApY4eVaBgFPxK586tnkI', 5000.000, '2024-10-14 20:56:54', NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `0rder`
--
ALTER TABLE `0rder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Tablo için indeksler `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Tablo için indeksler `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Tablo için indeksler `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `company_id` (`company_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `0rder`
--
ALTER TABLE `0rder`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `company`
--
ALTER TABLE `company`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `food`
--
ALTER TABLE `food`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `0rder`
--
ALTER TABLE `0rder`
  ADD CONSTRAINT `0rder_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`);

--
-- Tablo kısıtlamaları `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Tablo kısıtlamaları `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `coupon_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Tablo kısıtlamaları `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Tablo kısıtlamaları `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `restaurant_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Tablo kısıtlamaları `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
