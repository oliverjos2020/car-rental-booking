-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 22, 2024 at 02:12 AM
-- Server version: 10.6.19-MariaDB-cll-lve-log
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akwafeca_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_orders`
--

CREATE TABLE `booking_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pickupDate` date DEFAULT NULL,
  `pickupTime` varchar(255) DEFAULT NULL,
  `dropoffDate` date DEFAULT NULL,
  `dropoffTime` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `payment_status` char(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `entertainmentMenu` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `participants` varchar(10) DEFAULT NULL,
  `hours` varchar(10) DEFAULT NULL,
  `no_of_stops` varchar(10) DEFAULT NULL,
  `selectedMenus` varchar(255) DEFAULT NULL,
  `entertainment_date` varchar(150) DEFAULT NULL,
  `entertainment` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_orders`
--

INSERT INTO `booking_orders` (`id`, `user_id`, `vehicle_id`, `pickupDate`, `pickupTime`, `dropoffDate`, `dropoffTime`, `duration`, `amount`, `payment_status`, `created_at`, `updated_at`, `status`, `entertainmentMenu`, `event`, `address`, `participants`, `hours`, `no_of_stops`, `selectedMenus`, `entertainment_date`, `entertainment`) VALUES
(21, 10, NULL, NULL, NULL, NULL, NULL, NULL, 1950.00, '1', '2024-09-12 12:00:14', '2024-09-12 12:00:53', '1', NULL, 'Michaels Birthhday', 'No 148 Panaf Drive', '4', '3', '2', '[1,\"4\",\"5\",\"3\"]', '2024-09-16', '1'),
(22, 13, NULL, NULL, NULL, NULL, NULL, NULL, 3000.00, '1', '2024-09-15 22:34:03', '2024-09-15 22:35:13', '1', NULL, 'Blessings Birthhday', 'No 148 Panaf Drive', '4', '4', '1', '[1,\"2\",\"3\",\"4\",\"5\"]', '2024-09-19', '1');

-- --------------------------------------------------------

--
-- Table structure for table `car_brands`
--

CREATE TABLE `car_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_brands`
--

INSERT INTO `car_brands` (`id`, `brand`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Land Rover', 'land-rover', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(2, 'Mazda', 'mazda', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(3, 'Honda', 'honda', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(4, 'Mercedes-Benz', 'mercedes-benz', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(5, 'Ford', 'ford', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(6, 'Tesla', 'tesla', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(7, 'Toyota', 'toyota', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(8, 'Chevrolet', 'chevrolet', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(9, 'Lexus', 'lexus', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(10, 'Volvo', 'volvo', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(11, 'Porsche', 'porsche', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(12, 'Ferrari', 'ferrari', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(13, 'Audi', 'audi', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(14, 'Hyundai', 'hyundai', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(15, 'Jaguar', 'jaguar', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(16, 'Volkswagen', 'volkswagen', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(17, 'Subaru', 'subaru', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(18, 'Kia', 'kia', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(19, 'BMW', 'bmw', '2024-07-16 09:57:38', '2024-07-16 09:57:38'),
(20, 'Nissan', 'nissan', '2024-07-16 09:57:38', '2024-07-16 09:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Hire', 'hire', '2024-07-16 09:24:39', NULL),
(2, 'Booking', 'booking', '2024-07-16 09:24:39', NULL),
(3, 'Entertainment', 'entertainment', '2024-07-16 09:24:39', NULL),
(4, 'Bubaax1', 'bubaax1', '2024-08-09 10:58:18', '2024-08-09 10:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `entertainment_menus`
--

CREATE TABLE `entertainment_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item` varchar(255) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `required` char(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entertainment_menus`
--

INSERT INTO `entertainment_menus` (`id`, `item`, `amount`, `required`, `created_at`, `updated_at`) VALUES
(1, 'Red Carpet', 200.00, '1', '2024-08-09 09:10:35', '2024-08-09 09:31:49'),
(2, 'Food', 100.00, NULL, '2024-08-09 10:53:37', '2024-08-09 10:53:37'),
(3, 'MC', 300.00, '0', '2024-08-09 10:54:31', '2024-08-09 10:56:55'),
(4, 'Music', 100.00, NULL, '2024-08-09 10:54:48', '2024-08-09 10:54:48'),
(5, 'Drinks', 50.00, NULL, '2024-08-09 10:56:19', '2024-08-09 10:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Tyreeburgh', 'tyreeburgh', '2024-07-16 09:52:46', '2024-07-16 09:52:46'),
(2, 'North Shadtown', 'north-shadtown', '2024-07-16 09:52:46', '2024-07-16 09:52:46'),
(3, 'Jorgefort', 'jorgefort', '2024-07-16 09:52:46', '2024-07-16 09:52:46'),
(4, 'East Genesis', 'east-genesis', '2024-07-16 09:52:46', '2024-07-16 09:52:46'),
(5, 'East Dorisville', 'east-dorisville', '2024-07-16 09:52:46', '2024-07-16 09:52:46'),
(6, 'South Jolie', 'south-jolie', '2024-07-16 09:52:46', '2024-07-16 09:52:46'),
(7, 'Emilieville', 'emilieville', '2024-07-16 09:52:46', '2024-07-16 09:52:46'),
(8, 'East Luisa', 'east-luisa', '2024-07-16 09:52:47', '2024-07-16 09:52:47'),
(9, 'East Tayaton', 'east-tayaton', '2024-07-16 09:52:47', '2024-07-16 09:52:47'),
(10, 'Caratown', 'caratown', '2024-07-16 09:52:47', '2024-07-16 09:52:47'),
(11, 'Lake Hayleybury', 'lake-hayleybury', '2024-07-16 09:52:47', '2024-07-16 09:52:47'),
(12, 'North Claud', 'north-claud', '2024-07-16 09:52:47', '2024-07-16 09:52:47'),
(13, 'South Jaden', 'south-jaden', '2024-07-16 09:52:47', '2024-07-16 09:52:47'),
(14, 'Port Ora', 'port-ora', '2024-07-16 09:52:47', '2024-07-16 09:52:47'),
(15, 'East Alfreda', 'east-alfreda', '2024-07-16 09:52:47', '2024-07-16 09:52:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(83, '2014_10_12_000000_create_users_table', 1),
(84, '2014_10_12_100000_create_password_resets_table', 1),
(85, '2019_08_19_000000_create_failed_jobs_table', 1),
(86, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(87, '2024_06_05_140555_create_roles_table', 1),
(88, '2024_06_06_094412_create_categories_table', 1),
(89, '2024_06_06_103511_create_locations_table', 1),
(90, '2024_06_06_105038_create_car_brands_table', 1),
(91, '2024_06_06_151113_create_price_setups_table', 1),
(92, '2024_06_10_183248_add_role_to_users_table', 1),
(93, '2024_06_12_153512_add_extra_fields_to_users_table', 1),
(94, '2024_06_27_202139_create_vehicles_table', 1),
(95, '2024_06_28_150614_create_photos_table', 1),
(96, '2024_07_17_220957_create_booking_orders_table', 2),
(97, '2024_08_04_153155_create_ride_orders_table', 3),
(98, '2024_08_09_092452_create_entertainment_menus_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `vehicle_id`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 50, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(2, 30, 'img/cars/c2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(3, 3, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(4, 50, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(5, 34, 'assets-ii/media/content/b-goods/360x260/11.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(6, 32, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(7, 1, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(8, 42, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(9, 12, 'img/cars/c4.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(10, 27, 'img/cars/c2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(11, 6, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(12, 33, 'img/cars/c4.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(13, 37, 'img/cars/c3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(14, 13, 'img/cars/02.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(15, 7, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(16, 40, 'img/cars/01.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(17, 48, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(18, 30, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(19, 9, 'img/cars/c4.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(20, 11, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(21, 1, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(22, 9, 'img/cars/c7.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(23, 9, 'img/cars/c5.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(24, 30, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(25, 19, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(26, 4, 'img/cars/c9.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(27, 37, 'img/cars/02.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(28, 19, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(29, 36, 'img/cars/c3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(30, 9, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(31, 32, 'img/cars/01.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(32, 9, 'img/cars/c9.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(33, 3, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(34, 38, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(35, 44, 'img/cars/03.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(36, 44, 'img/cars/01.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(37, 32, 'img/cars/c3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(38, 44, 'img/cars/c4.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(39, 1, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(40, 31, 'img/cars/c8.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(41, 33, 'img/cars/c4.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(42, 46, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(43, 42, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(44, 17, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(45, 9, 'img/cars/05.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(46, 1, 'img/cars/01.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(47, 18, 'img/cars/c2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(48, 10, 'img/cars/c7.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(49, 18, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(50, 13, 'img/cars/c9.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(51, 29, 'img/cars/c7.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(52, 12, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(53, 10, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(54, 43, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(55, 24, 'img/cars/06.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(56, 50, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(57, 37, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(58, 30, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(59, 47, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(60, 42, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(61, 20, 'img/cars/02.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(62, 30, 'img/cars/01.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(63, 13, 'img/cars/05.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(64, 37, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(65, 36, 'img/cars/03.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(66, 32, 'img/cars/c8.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(67, 12, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(68, 28, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(69, 36, 'img/cars/c9.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(70, 18, 'img/cars/c3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(71, 10, 'img/cars/c8.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(72, 36, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(73, 29, 'img/cars/c8.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(74, 39, 'img/cars/05.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(75, 6, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(76, 1, 'img/cars/04.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(77, 31, 'img/cars/01.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(78, 45, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(79, 36, 'img/cars/04.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(80, 20, 'img/cars/05.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(81, 41, 'img/cars/c3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(82, 22, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(83, 33, 'img/cars/06.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(84, 48, 'img/cars/05.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(85, 21, 'img/cars/02.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(86, 42, 'img/cars/c3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(87, 31, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(88, 39, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(89, 40, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(90, 37, 'img/cars/c4.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(91, 17, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(92, 46, 'assets-ii/media/content/b-goods/360x260/11.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(93, 50, 'img/cars/c2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(94, 25, 'img/cars/06.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(95, 40, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(96, 21, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(97, 40, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(98, 47, 'img/cars/c9.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(99, 40, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(100, 16, 'assets-ii/media/content/b-goods/360x260/11.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(101, 25, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(102, 16, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(103, 18, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(104, 12, 'img/cars/02.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(105, 41, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(106, 50, 'img/cars/c7.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(107, 19, 'img/cars/c2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(108, 14, 'img/cars/c2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(109, 38, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(110, 44, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(111, 46, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(112, 39, 'img/cars/04.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(113, 11, 'img/cars/04.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(114, 23, 'img/cars/c2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(115, 19, 'img/cars/c7.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(116, 21, 'img/cars/05.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(117, 26, 'img/cars/c3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(118, 46, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(119, 32, 'img/cars/03.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(120, 25, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(121, 45, 'img/cars/01.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(122, 35, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(123, 11, 'img/cars/c8.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(124, 1, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(125, 20, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(126, 24, 'img/cars/05.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(127, 3, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(128, 49, 'img/cars/c4.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(129, 38, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(130, 8, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(131, 33, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(132, 5, 'img/cars/04.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(133, 37, 'img/cars/06.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(134, 47, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(135, 28, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(136, 33, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(137, 20, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(138, 21, 'img/cars/06.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(139, 6, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(140, 35, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(141, 4, 'assets-ii/media/content/b-goods/360x260/11.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(142, 24, 'img/cars/06.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(143, 6, 'img/cars/c5.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(144, 28, 'img/cars/03.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(145, 37, 'img/cars/c5.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(146, 30, 'img/cars/02.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(147, 28, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(148, 27, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(149, 36, 'img/cars/c2.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(150, 5, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(151, 34, 'assets-ii/media/content/b-goods/360x260/11.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(152, 11, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(153, 1, 'img/cars/05.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(154, 44, 'img/cars/04.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(155, 24, 'img/cars/c9.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(156, 4, 'img/cars/04.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(157, 14, 'img/cars/06.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(158, 15, 'img/cars/01.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(159, 7, 'img/cars/c7.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(160, 21, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(161, 7, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(162, 46, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(163, 31, 'img/cars/c8.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(164, 34, 'img/cars/c5.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(165, 21, 'img/cars/05.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(166, 26, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(167, 43, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(168, 14, 'img/cars/03.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(169, 34, 'img/cars/03.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(170, 46, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(171, 14, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:42', '2024-07-16 10:17:42'),
(172, 47, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(173, 12, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(174, 5, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(175, 17, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(176, 46, 'img/cars/06.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(177, 4, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(178, 28, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(179, 46, 'img/cars/04.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(180, 2, 'img/cars/c8.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(181, 45, 'img/cars/06.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(182, 10, 'img/cars/03.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(183, 41, 'img/cars/c4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(184, 23, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(185, 21, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(186, 29, 'img/cars/03.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(187, 6, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(188, 19, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(189, 16, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(190, 17, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(191, 19, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(192, 19, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(193, 34, 'assets-ii/media/content/b-goods/360x260/11.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(194, 50, 'img/cars/05.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(195, 40, 'img/cars/c9.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(196, 17, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(197, 24, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(198, 25, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(199, 33, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(200, 41, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(201, 23, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(202, 20, 'img/cars/c7.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(203, 43, 'img/cars/05.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(204, 48, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(205, 23, 'assets-ii/media/content/b-goods/360x260/11.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(206, 46, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(207, 1, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(208, 44, 'img/cars/c7.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(209, 26, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(210, 1, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(211, 33, 'img/cars/01.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(212, 23, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(213, 25, 'img/cars/03.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(214, 13, 'img/cars/c2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(215, 31, 'img/cars/05.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(216, 32, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(217, 26, 'img/cars/03.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(218, 3, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(219, 40, 'img/cars/01.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(220, 38, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(221, 32, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(222, 12, 'img/cars/03.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(223, 44, 'img/cars/02.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(224, 15, 'img/cars/04.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(225, 37, 'img/cars/c5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(226, 29, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(227, 24, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(228, 9, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(229, 45, 'img/cars/03.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(230, 6, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(231, 7, 'img/cars/c5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(232, 8, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(233, 47, 'img/cars/c2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(234, 23, 'img/cars/03.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(235, 16, 'img/cars/c8.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(236, 8, 'img/cars/c5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(237, 18, 'img/cars/c9.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(238, 26, 'img/cars/04.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(239, 10, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(240, 4, 'img/cars/04.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(241, 28, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(242, 19, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(243, 9, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(244, 24, 'img/cars/04.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(245, 37, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(246, 13, 'img/cars/05.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(247, 40, 'img/cars/05.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(248, 16, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(249, 7, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(250, 9, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(251, 46, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(252, 40, 'img/cars/c5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(253, 28, 'img/cars/c9.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(254, 10, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(255, 20, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(256, 39, 'img/cars/02.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(257, 10, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(258, 45, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(259, 46, 'img/cars/c2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(260, 12, 'assets-ii/media/content/b-goods/360x260/11.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(261, 10, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(262, 23, 'img/cars/c9.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(263, 4, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(264, 2, 'img/cars/01.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(265, 46, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(266, 18, 'img/cars/c9.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(267, 10, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(268, 33, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(269, 13, 'img/cars/c8.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(270, 25, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(271, 48, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(272, 39, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(273, 41, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(274, 16, 'img/cars/c8.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(275, 36, 'img/cars/01.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(276, 10, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(277, 9, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(278, 38, 'img/cars/04.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(279, 48, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(280, 24, 'img/cars/c5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(281, 13, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(282, 31, 'img/cars/c5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(283, 35, 'img/cars/05.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(284, 46, 'img/cars/c4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(285, 5, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(286, 47, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(287, 10, 'img/cars/c9.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(288, 23, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(289, 23, 'img/cars/c9.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(290, 7, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(291, 16, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(292, 19, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(293, 35, 'assets-ii/media/content/b-goods/360x260/11.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(294, 20, 'img/cars/c8.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(295, 31, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(296, 18, 'assets-ii/media/content/b-goods/360x260/11.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(297, 36, 'img/cars/c7.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(298, 43, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(299, 6, 'img/cars/02.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(300, 43, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(301, 18, 'img/cars/c8.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(302, 24, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(303, 10, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(304, 25, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(305, 4, 'img/cars/c4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(306, 28, 'img/cars/05.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(307, 18, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(308, 4, 'img/cars/c2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(309, 33, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(310, 3, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(311, 3, 'img/cars/01.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(312, 29, 'img/cars/01.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(313, 32, 'img/cars/02.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(314, 7, 'img/cars/c4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(315, 47, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(316, 33, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(317, 4, 'img/cars/c9.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(318, 45, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(319, 29, 'img/cars/c2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(320, 29, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(321, 18, 'img/cars/02.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(322, 28, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(323, 36, 'img/cars/06.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(324, 21, 'img/cars/06.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(325, 19, 'img/cars/02.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(326, 31, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(327, 7, 'img/cars/04.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(328, 25, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(329, 40, 'img/cars/c9.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(330, 4, 'img/cars/03.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(331, 35, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(332, 41, 'img/cars/c4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(333, 17, 'img/cars/06.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(334, 43, 'img/cars/c5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(335, 33, 'img/cars/06.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(336, 33, 'img/cars/c7.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(337, 5, 'img/cars/06.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(338, 11, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(339, 22, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(340, 17, 'img/cars/c8.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(341, 42, 'img/cars/c9.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(342, 11, 'img/cars/c8.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(343, 36, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(344, 9, 'img/cars/c7.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(345, 39, 'img/cars/02.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(346, 29, 'img/cars/c9.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(347, 27, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(348, 7, 'assets-ii/media/content/b-goods/360x260/11.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(349, 33, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(350, 6, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(351, 27, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(352, 6, 'assets-ii/media/content/b-goods/360x260/11.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(353, 5, 'img/cars/c2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(354, 40, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(355, 39, 'img/cars/c4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(356, 22, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(357, 34, 'img/cars/c5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(358, 29, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(359, 25, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(360, 39, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(361, 49, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(362, 28, 'img/cars/04.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(363, 24, 'img/cars/c5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(364, 39, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(365, 45, 'img/cars/03.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(366, 44, 'img/cars/06.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(367, 19, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(368, 16, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(369, 11, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(370, 9, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(371, 3, 'img/cars/05.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(372, 37, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(373, 32, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(374, 34, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(375, 6, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(376, 25, 'img/cars/04.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(377, 34, 'img/cars/c8.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(378, 11, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(379, 35, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(380, 7, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(381, 36, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(382, 38, 'img/cars/c5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(383, 11, 'img/cars/c7.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(384, 22, 'img/cars/01.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(385, 6, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(386, 13, 'assets-ii/media/content/b-goods/360x260/11.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(387, 36, 'img/cars/02.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(388, 47, 'img/cars/02.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(389, 4, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(390, 13, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(391, 18, 'img/cars/04.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(392, 48, 'assets-ii/media/content/b-goods/360x260/11.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(393, 7, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(394, 39, 'img/cars/05.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(395, 45, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(396, 2, 'img/cars/c8.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(397, 4, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(398, 2, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(399, 11, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(400, 42, 'img/cars/05.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(401, 31, 'img/cars/c3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(402, 17, 'img/cars/01.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(403, 6, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(404, 50, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(405, 10, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(406, 28, 'img/cars/c4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(407, 24, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(408, 14, 'img/cars/04.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(409, 10, 'img/cars/01.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(410, 7, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(411, 18, 'img/cars/02.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(412, 7, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(413, 27, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(414, 7, 'img/cars/c4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(415, 8, 'img/cars/c8.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(416, 20, 'img/cars/c7.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(417, 46, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(418, 6, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(419, 27, 'img/cars/06.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(420, 32, 'img/cars/02.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(421, 23, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(422, 28, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(423, 43, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(424, 40, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(425, 10, 'img/cars/c4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(426, 35, 'img/cars/06.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(427, 22, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(428, 30, 'img/cars/02.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(429, 42, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(430, 21, 'img/cars/c9.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(431, 48, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(432, 6, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(433, 32, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(434, 14, 'img/cars/01.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(435, 1, 'img/cars/c8.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(436, 20, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(437, 2, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(438, 27, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(439, 27, 'img/cars/01.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(440, 28, 'img/cars/c4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(441, 19, 'assets-ii/media/content/b-goods/294x223/1.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(442, 45, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(443, 37, 'img/cars/c7.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(444, 50, 'img/cars/c7.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(445, 15, 'img/cars/05.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(446, 36, 'assets-ii/media/content/b-goods/294x223/5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(447, 23, 'img/cars/c8.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(448, 43, 'img/cars/02.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(449, 34, 'img/cars/04.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(450, 16, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(451, 35, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(452, 28, 'img/cars/03.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(453, 31, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(454, 9, 'img/cars/01.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(455, 9, 'img/cars/c2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(456, 6, 'img/cars/01.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(457, 44, 'img/cars/c4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(458, 36, 'img/cars/01.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(459, 46, 'img/cars/05.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(460, 50, 'img/cars/02.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(461, 38, 'assets-ii/media/content/b-goods/360x260/12.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(462, 9, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(463, 8, 'img/cars/c5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(464, 9, 'img/cars/c2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(465, 37, 'img/cars/c9.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(466, 10, 'img/cars/06.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(467, 48, 'img/cars/03.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(468, 1, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(469, 45, 'img/cars/03.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(470, 21, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(471, 33, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(472, 25, 'img/cars/c2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(473, 44, 'img/cars/03.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(474, 40, 'img/cars/c5.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(475, 3, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(476, 14, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(477, 15, 'img/cars/c4.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(478, 25, 'img/cars/05.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(479, 39, 'assets-ii/media/content/b-goods/294x223/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(480, 39, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(481, 29, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(482, 16, 'assets-ii/media/content/b-goods/294x223/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(483, 15, 'assets-ii/media/content/b-goods/360x260/2.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(484, 46, 'assets-ii/media/content/b-goods/360x260/3.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(485, 2, 'img/cars/02.jpg', '2024-07-16 10:17:43', '2024-07-16 10:17:43'),
(486, 13, 'img/cars/c8.jpg', '2024-07-16 10:17:44', '2024-07-16 10:17:44'),
(487, 49, 'assets-ii/media/content/b-goods/360x260/10.jpg', '2024-07-16 10:17:44', '2024-07-16 10:17:44'),
(488, 26, 'img/cars/03.jpg', '2024-07-16 10:17:44', '2024-07-16 10:17:44'),
(489, 20, 'assets-ii/media/content/b-goods/360x260/13.jpg', '2024-07-16 10:17:44', '2024-07-16 10:17:44'),
(490, 5, 'img/cars/c3.jpg', '2024-07-16 10:17:44', '2024-07-16 10:17:44'),
(491, 46, 'img/cars/c5.jpg', '2024-07-16 10:17:44', '2024-07-16 10:17:44'),
(492, 49, 'img/cars/c4.jpg', '2024-07-16 10:17:44', '2024-07-16 10:17:44'),
(493, 49, 'assets-ii/media/content/b-goods/294x223/4.jpg', '2024-07-16 10:17:44', '2024-07-16 10:17:44'),
(494, 38, 'img/cars/c2.jpg', '2024-07-16 10:17:44', '2024-07-16 10:17:44'),
(495, 1, 'img/cars/c7.jpg', '2024-07-16 10:17:44', '2024-07-16 10:17:44'),
(496, 47, 'assets-ii/media/content/b-goods/360x260/11.jpg', '2024-07-16 10:17:44', '2024-07-16 10:17:44'),
(497, 29, 'img/cars/01.jpg', '2024-07-16 10:17:44', '2024-07-16 10:17:44'),
(498, 1, 'img/cars/04.jpg', '2024-07-16 10:17:44', '2024-07-16 10:17:44'),
(499, 35, 'img/cars/03.jpg', '2024-07-16 10:17:44', '2024-07-16 10:17:44'),
(500, 14, 'img/cars/c3.jpg', '2024-07-16 10:17:44', '2024-07-16 10:17:44'),
(501, 51, '/storage/uploads/vehicle/vehImage-0OY1ucP5qm.jpg', '2024-07-23 08:22:28', '2024-07-23 08:22:28'),
(502, 51, '/storage/uploads/vehicle/vehImage-3yGCyIT0No.jpg', '2024-07-23 08:22:28', '2024-07-23 08:22:28'),
(503, 51, '/storage/uploads/vehicle/vehImage-kvSam3ot6x.jpg', '2024-07-23 08:22:28', '2024-07-23 08:22:28'),
(504, 51, '/storage/uploads/vehicle/vehImage-Mv1L8goZ5x.jpg', '2024-07-23 08:22:28', '2024-07-23 08:22:28'),
(505, 51, '/storage/uploads/vehicle/vehImage-O1WCTfZ1bQ.jpg', '2024-07-23 08:22:28', '2024-07-23 08:22:28');

-- --------------------------------------------------------

--
-- Table structure for table `price_setups`
--

CREATE TABLE `price_setups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_setups`
--

INSERT INTO `price_setups` (`id`, `item`, `slug`, `duration`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'Luxury Cars', 'luxury-cars', 1, 5000.00, '2024-07-16 09:40:56', '2024-07-16 09:40:56'),
(2, 'Sport Cars', 'sport-cars', 1, 10000.00, '2024-07-16 09:41:37', '2024-07-16 09:41:37'),
(3, 'SUV', 'suv', 1, 15000.00, '2024-07-16 09:41:49', '2024-07-16 09:41:49'),
(4, 'Convertible', 'convertible', 1, 20000.00, '2024-07-16 09:42:03', '2024-08-09 09:25:38'),
(5, 'Entertainment', 'entertainment', 1, 200.00, '2024-08-12 09:37:49', '2024-08-12 09:37:49');

-- --------------------------------------------------------

--
-- Table structure for table `ride_orders`
--

CREATE TABLE `ride_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `originCoords` varchar(255) NOT NULL,
  `destinationCoords` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `status` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', NULL, NULL),
(2, 'partner', 'partner', NULL, NULL),
(3, 'User', 'user', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `meansOfIdentification` varchar(255) DEFAULT NULL,
  `identificationDocument` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `accountNumber` varchar(255) DEFAULT NULL,
  `accountName` varchar(255) DEFAULT NULL,
  `accountType` varchar(255) DEFAULT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `driverLicense` varchar(255) DEFAULT NULL,
  `insurance` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`, `phone_no`, `address`, `meansOfIdentification`, `identificationDocument`, `bank`, `accountNumber`, `accountName`, `accountType`, `passport`, `driverLicense`, `insurance`, `latitude`, `longitude`) VALUES
(1, 'Admin DPL', 'admin@dpl.com', NULL, '$2y$10$0hzruvy74htNTxqG8MYifejSrp7fUpnNPrtHEKcUFzxEJTp1L59Km', 'OdIKAIKmAoxzfK3ThV7wqtNftU3Qtcs1j2jAbBhC7e2sRprfs8UVh0Ltfs7C', '2024-07-16 09:24:39', '2024-08-01 12:33:13', 1, '07062902972', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9.0567', '7.4969'),
(2, 'Amina Skiles', 'pauline35@example.org', '2024-07-16 10:08:18', '$2y$10$DE0NQdU8WtjWAF9A1HbMDut/3gpYD/vVj2bYZOXogmCjDi19k4aTe', 'PypMWvMPL3G8tu6PcRT2ScmNiqM7m2v92lR9Qea09VZMdRfqJbp6yinzyP5n', '2024-07-16 10:08:18', '2024-07-16 10:08:18', 3, '1-661-839-9650', '28850 Arden Avenue Suite 663\nRomainebury, MN 44532-1532', 'Driver License', 'img/passport.jpg', 'Prof. Brayan Marks', '844-246-1474', 'Candido Padberg', 'savings', 'img/team/3.jpg', NULL, NULL, '9.13153', '7.38810'),
(3, 'Reva Langosh', 'deron17@example.org', '2024-07-16 10:08:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Q1fMw3PymA', '2024-07-16 10:08:18', '2024-07-16 10:08:18', 2, '+16294617906', '7027 Bartoletti Centers Apt. 112\nLake Teagan, ND 85138', 'Driver License', 'img/passport.jpg', 'Mrs. Cathryn Schaden PhD', '920-826-5408', 'Arturo Hansen', 'current', 'img/team/3.jpg', NULL, NULL, '9.0477', '7.4879'),
(4, 'Eldred Daugherty', 'hane.eula@example.org', '2024-07-16 10:08:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CtJjvvT2jjaor9QsBFEfuZCfCK9mhWi1zqHq3anCu8kRD3EnKCTUln9m2mTW', '2024-07-16 10:08:18', '2024-08-03 14:06:40', 2, '08063534537', '6833 Jamel Wall\nForestmouth, NM 46757-0307', 'Drivers License', 'img/passport.jpg', 'Angelica Mante PhD', '636-265-9750', 'Dolores Zulauf', 'current', 'img/team/3.jpg', NULL, NULL, '6.5243793', '3.3792057'),
(5, 'Prof. Ashton Stark', 'savanah.mante@example.net', '2024-07-16 10:08:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'TYOCzwlvac', '2024-07-16 10:08:18', '2024-07-16 10:08:18', 3, '+1 (810) 659-4776', '856 Kassulke Mill Apt. 309\nEarlinebury, CA 09135', 'Driver License', 'img/passport.jpg', 'Isadore Shanahan', '989-406-9378', 'Immanuel Leffler', 'savings', 'img/team/3.jpg', NULL, NULL, NULL, NULL),
(6, 'Thaddeus Mann', 'polly.white@example.org', '2024-07-16 10:08:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BvxScZLFCD', '2024-07-16 10:08:18', '2024-07-16 10:08:18', 2, '281-456-8191', '1563 Mante Parkways Suite 697\nBauchshire, NM 85454', 'Driver License', 'img/passport.jpg', 'Laisha Schumm', '685-256-6788', 'Vita Walsh', 'savings', 'img/team/3.jpg', NULL, NULL, NULL, NULL),
(7, 'Neil Morar IV', 'aliza75@example.com', '2024-07-16 10:08:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'quHTB7OGj8', '2024-07-16 10:08:18', '2024-07-16 10:08:18', 2, '+1-321-824-3955', '1800 Nolan Prairie Suite 185\nNorth Brownside, SC 88810-4719', 'Driver License', 'img/passport.jpg', 'Oleta Walker', '472-102-4802', 'Leone Quitzon', 'current', 'img/team/3.jpg', NULL, NULL, NULL, NULL),
(8, 'Golden Flatley', 'keira84@example.org', '2024-07-16 10:08:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hAGFZWHOAo', '2024-07-16 10:08:18', '2024-07-16 10:08:18', 3, '(319) 798-3794', '49318 Krajcik Parks Suite 202\nCaroletown, WI 32961', 'Driver License', 'img/passport.jpg', 'Shea Harris', '326-102-7457', 'Vicky Terry', 'savings', 'img/team/3.jpg', NULL, NULL, NULL, NULL),
(9, 'Kenyatta Robel', 'morar.kelvin@example.net', '2024-07-16 10:08:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Of4OtufS7z', '2024-07-16 10:08:18', '2024-07-16 10:08:18', 2, '1-812-514-9432', '93871 Hackett Trail\nSouth Jonathon, WA 03309', 'Driver License', 'img/passport.jpg', 'Amie Ratke', '043-207-3937', 'Ms. Arielle Erdman', 'savings', 'img/team/3.jpg', NULL, NULL, NULL, NULL),
(10, 'Mr. Arvel Green III', 'upton.nella@example.com', '2024-07-16 10:08:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'eZzVcJWPr130PIBIcjvCR8cEkRJL4cSPM67c0gJ6chAgwBJ05WzWJ38z3JLw', '2024-07-16 10:08:18', '2024-07-16 10:08:18', 2, '812.980.0886', '9063 Emmitt Burg\nNew Harrison, TX 50939', 'Driver License', 'img/passport.jpg', 'Derek Gleichner', '114-960-7500', 'Gregorio Blick DDS', 'savings', 'img/team/3.jpg', NULL, NULL, NULL, NULL),
(11, 'Mr. Joaquin Bayer', 'melyssa32@example.org', '2024-07-16 10:08:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '7Aj26zvn8D', '2024-07-16 10:08:18', '2024-07-16 10:08:18', 2, '959-568-4640', '365 Balistreri Route\nWest Jaquanberg, KS 73061', 'Driver License', 'img/passport.jpg', 'Flo Littel', '144-811-8063', 'Katelynn Bednar', 'current', 'img/team/3.jpg', NULL, NULL, NULL, NULL),
(13, 'Oliver Gbenga', 'ezekielafolabi22@gmail.com', NULL, '$2y$10$DE0NQdU8WtjWAF9A1HbMDut/3gpYD/vVj2bYZOXogmCjDi19k4aTe', NULL, '2024-09-05 18:56:00', '2024-09-05 18:56:00', 3, '07062902973', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `driverLicense` enum('yes','no') DEFAULT NULL,
  `vehicleMake` varchar(255) DEFAULT NULL,
  `vehicleYear` varchar(255) DEFAULT NULL,
  `vehicleModel` varchar(255) DEFAULT NULL,
  `transmission` varchar(255) DEFAULT NULL,
  `doors` varchar(255) DEFAULT NULL,
  `passengers` varchar(255) DEFAULT NULL,
  `airCondition` enum('yes','no') DEFAULT NULL,
  `seats` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `price_setup_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` char(1) DEFAULT '0',
  `dateApproved` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `on_trip` char(1) DEFAULT '0',
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `user_id`, `reason`, `location`, `driverLicense`, `vehicleMake`, `vehicleYear`, `vehicleModel`, `transmission`, `doors`, `passengers`, `airCondition`, `seats`, `category_id`, `price_setup_id`, `status`, `dateApproved`, `created_at`, `updated_at`, `on_trip`, `latitude`, `longitude`) VALUES
(1, 8, NULL, 'Kaileemouth', 'no', 'Hyundai', NULL, 'C-Class', 'automatic', '2', '3', 'yes', '4', 3, 5, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(2, 2, NULL, 'Beckerside', 'yes', 'Ferrari', NULL, 'RX', 'manual', '2', '6', 'no', '2', 1, 1, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '1', NULL, NULL),
(3, 6, NULL, 'Lake Raventon', 'yes', 'Nissan', NULL, '488', 'manual', '2', '7', 'no', '16', 2, 3, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(4, 8, NULL, 'New Royalview', 'yes', 'Land Rover', NULL, 'Camry', 'automatic', '3', '12', 'yes', '9', 1, 1, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(5, 8, NULL, 'Jillianport', 'no', 'Volvo', NULL, 'Model S', 'manual', '4', '13', 'yes', '2', 1, 4, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-20 18:44:25', '1', NULL, NULL),
(6, 4, NULL, 'West Kelley', 'yes', 'Audi', NULL, 'A4', 'automatic', '3', '8', 'no', '11', 1, 2, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-20 18:50:29', '0', NULL, NULL),
(7, 2, NULL, 'Eusebioport', 'yes', 'Chevrolet', NULL, 'Civic', 'automatic', '4', '13', 'no', '11', 1, 1, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(8, 3, NULL, 'East Jovanistad', 'no', 'Land Rover', NULL, 'C-Class', 'automatic', '3', '11', 'no', '8', 3, 5, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(9, 7, NULL, 'New Adahberg', 'yes', 'Hyundai', NULL, 'Mustang', 'manual', '2', '2', 'yes', '13', 1, 2, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(10, 10, NULL, 'Rainastad', 'no', 'Porsche', NULL, '488', 'manual', '2', '15', 'yes', '10', 1, 1, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(11, 7, NULL, 'Deshaunstad', 'no', 'BMW', NULL, 'Elantra', 'automatic', '3', '13', 'yes', '8', 1, 2, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(12, 9, NULL, 'Harveyland', 'no', 'Land Rover', NULL, '3 Series', 'manual', '2', '4', 'yes', '2', 1, 3, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(13, 9, NULL, 'Brycenview', 'yes', 'Lexus', NULL, 'Altima', 'manual', '4', '2', 'no', '5', 2, 1, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(14, 6, NULL, 'East Geoffreystad', 'no', 'Porsche', NULL, 'Model S', 'manual', '3', '8', 'no', '9', 1, 1, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(15, 7, NULL, 'South Antonettetown', 'yes', 'Ford', NULL, 'Mustang', 'manual', '3', '12', 'no', '4', 2, 4, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(16, 4, NULL, 'Lutherhaven', 'no', 'Ferrari', NULL, 'Outback', 'manual', '4', '7', 'yes', '12', 3, 5, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(17, 7, NULL, 'New Rebeca', 'yes', 'Kia', NULL, 'XC90', 'manual', '3', '2', 'yes', '11', 2, 2, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(18, 5, NULL, 'Gilbertofurt', 'no', 'Volvo', NULL, '911', 'automatic', '2', '3', 'yes', '15', 3, 5, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(19, 8, NULL, 'South Else', 'no', 'Volkswagen', NULL, 'A4', 'automatic', '2', '4', 'no', '6', 2, 1, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(20, 7, NULL, 'Abbottton', 'no', 'Chevrolet', NULL, 'Altima', 'manual', '4', '10', 'no', '3', 2, 3, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(21, 8, NULL, 'New Bobbyton', 'yes', 'Volvo', NULL, 'Range Rover', 'manual', '2', '16', 'yes', '4', 1, 1, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(22, 5, NULL, 'Marcellaborough', 'no', 'Porsche', NULL, 'Camry', 'automatic', '2', '6', 'yes', '7', 1, 1, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(23, 2, NULL, 'Lake Ramonmouth', 'no', 'Chevrolet', NULL, 'Model S', 'manual', '2', '5', 'no', '8', 3, 5, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(24, 7, NULL, 'West Mabelle', 'no', 'Tesla', NULL, 'Model S', 'manual', '4', '14', 'no', '5', 2, 2, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(25, 4, NULL, 'South Sibyl', 'yes', 'Chevrolet', NULL, '911', 'automatic', '2', '9', 'yes', '12', 2, 4, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-08-04 14:07:32', '0', '6.5243793', '3.3792057'),
(26, 4, NULL, 'Lake Ednaburgh', 'no', 'Volvo', NULL, '488', 'manual', '4', '16', 'no', '2', 2, 4, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', '9.23153', '7.48810'),
(27, 2, NULL, 'New Quincytown', 'yes', 'Kia', NULL, '911', 'automatic', '4', '13', 'no', '14', 1, 1, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(28, 11, NULL, 'Dickiborough', 'no', 'Tesla', NULL, '488', 'manual', '3', '15', 'no', '8', 1, 1, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(29, 3, NULL, 'New Okeyland', 'no', 'Audi', NULL, 'A4', 'manual', '3', '16', 'yes', '11', 1, 2, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(30, 9, NULL, 'Naderport', 'yes', 'Lexus', NULL, 'Model S', 'automatic', '2', '12', 'no', '16', 1, 3, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(31, 2, NULL, 'Ebertfort', 'yes', 'Tesla', NULL, 'A4', 'manual', '2', '5', 'yes', '7', 3, 5, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(32, 2, NULL, 'Lake Wilber', 'yes', 'Tesla', NULL, 'Sorento', 'automatic', '3', '10', 'no', '2', 2, 3, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(33, 11, NULL, 'Elissaton', 'yes', 'BMW', NULL, 'Camry', 'manual', '4', '8', 'yes', '4', 2, 4, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(34, 6, NULL, 'South Kelsi', 'yes', 'Honda', NULL, 'Camry', 'manual', '3', '3', 'no', '14', 2, 2, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(35, 11, NULL, 'Jordihaven', 'yes', 'Volkswagen', NULL, 'Impala', 'manual', '4', '13', 'no', '4', 2, 1, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(36, 8, NULL, 'Feilfort', 'yes', 'Volkswagen', NULL, 'Sorento', 'automatic', '3', '14', 'no', '6', 2, 3, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(37, 7, NULL, 'Genevievetown', 'yes', 'Audi', NULL, 'A4', 'automatic', '4', '3', 'yes', '13', 2, 3, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(38, 8, NULL, 'North Darius', 'yes', 'Hyundai', NULL, 'Sorento', 'automatic', '2', '16', 'yes', '12', 3, 5, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(39, 3, NULL, 'North Simfurt', 'no', 'Nissan', NULL, 'Altima', 'automatic', '3', '15', 'yes', '4', 3, 5, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(40, 5, NULL, 'Ziemannbury', 'yes', 'Tesla', NULL, '911', 'manual', '3', '8', 'yes', '6', 3, 5, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(41, 9, NULL, 'Lake Ezekiel', 'yes', 'Chevrolet', NULL, 'RX', 'automatic', '3', '14', 'yes', '12', 1, 1, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(42, 8, NULL, 'Turcotteburgh', 'no', 'Hyundai', NULL, 'Altima', 'automatic', '4', '14', 'no', '7', 3, 5, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(43, 7, NULL, 'South Herminiomouth', 'yes', 'Tesla', NULL, '911', 'manual', '3', '13', 'no', '4', 2, 2, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(44, 11, NULL, 'West Emelyside', 'yes', 'Audi', NULL, 'Civic', 'manual', '3', '14', 'yes', '6', 2, 2, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(45, 2, NULL, 'Port Thaddeuschester', 'no', 'Hyundai', NULL, 'Camry', 'automatic', '3', '9', 'no', '6', 1, 1, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(46, 4, NULL, 'Cristside', 'yes', 'Porsche', NULL, 'RX', 'automatic', '2', '6', 'no', '10', 1, 1, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(47, 3, NULL, 'Lake Macey', 'yes', 'Audi', NULL, 'A4', 'automatic', '4', '13', 'yes', '2', 3, 5, '3', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(48, 10, NULL, 'Vitachester', 'yes', 'Ferrari', NULL, '3 Series', 'manual', '2', '11', 'yes', '8', 2, 2, '2', '2024-08-24 22:30:42', '2024-07-16 10:12:54', '2024-08-25 02:45:44', '0', '9.0567', '7.4969'),
(49, 7, NULL, 'South Burdette', 'no', 'Subaru', NULL, 'Impala', 'automatic', '4', '15', 'no', '12', 3, 5, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(50, 11, NULL, 'South Robertbury', 'yes', 'Kia', NULL, 'Altima', 'manual', '4', '8', 'yes', '4', 1, 4, '2', '2024-07-16 11:12:54', '2024-07-16 10:12:54', '2024-07-16 10:12:54', '0', NULL, NULL),
(51, 4, NULL, 'South Jaden', 'yes', 'kia', '2020', 'Golf', 'automatic', '4', '8', 'yes', '4', 3, 5, '2', '2024-07-23 10:22:30', '2024-07-23 08:22:28', '2024-08-13 11:28:26', '1', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_orders`
--
ALTER TABLE `booking_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_orders_user_id_foreign` (`user_id`),
  ADD KEY `booking_orders_vehicle_id_foreign` (`vehicle_id`);

--
-- Indexes for table `car_brands`
--
ALTER TABLE `car_brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `car_brands_slug_unique` (`slug`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `entertainment_menus`
--
ALTER TABLE `entertainment_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locations_slug_unique` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_vehicle_id_foreign` (`vehicle_id`);

--
-- Indexes for table `price_setups`
--
ALTER TABLE `price_setups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `price_setups_item_unique` (`item`),
  ADD UNIQUE KEY `price_setups_slug_unique` (`slug`);

--
-- Indexes for table `ride_orders`
--
ALTER TABLE `ride_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ride_orders_user_id_foreign` (`user_id`),
  ADD KEY `ride_orders_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `ride_orders_driver_id_foreign` (`driver_id`) USING BTREE;

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_user_id_foreign` (`user_id`),
  ADD KEY `vehicles_category_foreign` (`category_id`),
  ADD KEY `vehicles_price_setup_id_foreign` (`price_setup_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_orders`
--
ALTER TABLE `booking_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `car_brands`
--
ALTER TABLE `car_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `entertainment_menus`
--
ALTER TABLE `entertainment_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=506;

--
-- AUTO_INCREMENT for table `price_setups`
--
ALTER TABLE `price_setups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ride_orders`
--
ALTER TABLE `ride_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_orders`
--
ALTER TABLE `booking_orders`
  ADD CONSTRAINT `booking_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_orders_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ride_orders`
--
ALTER TABLE `ride_orders`
  ADD CONSTRAINT `ride_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ride_orders_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_category_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicles_price_setup_id_foreign` FOREIGN KEY (`price_setup_id`) REFERENCES `price_setups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
