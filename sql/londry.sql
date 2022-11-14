-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2022 at 06:00 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `londry`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `image`, `title`, `subtitle`, `text`, `status`, `created_at`, `updated_at`) VALUES
(1, 'public/uploads/about/img-1.png', 'As Quick as a Click', 'PackeN Move', 'Looking for delivery partner; for your business deliveries or to surprise someone special with a gift? Well, our service is the best in terms of accuracy, communication and speed. Our motto “As Quick as a Click” says it all to the problem of every Bangladeshi getting deliveries in a delayed time.  Alongside with our accuracy and communication with the delivery man is also on point.  So what are you waiting for? Try out our service!', 1, '2021-02-09 06:55:28', '2021-02-27 00:00:16');

-- --------------------------------------------------------

--
-- Table structure for table `account_heads`
--

CREATE TABLE `account_heads` (
  `id` bigint(20) NOT NULL,
  `head_type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` tinyint(3) DEFAULT '0',
  `head_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:active,0:inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_heads`
--

INSERT INTO `account_heads` (`id`, `head_type`, `user_id`, `role_id`, `head_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 1, 0, '1masud', 1, '2022-09-14 17:13:42', '2022-09-14 17:13:42'),
(2, 1, 1, 0, '1customer-1', 1, '2022-09-14 17:20:41', '2022-09-14 17:20:41'),
(3, 1, 2, 0, '2customer-2', 1, '2022-09-14 11:25:46', '2022-09-14 11:25:46'),
(4, 6, 1, 0, '1test', 1, '2022-09-14 18:20:57', '2022-09-14 18:20:57'),
(5, 2, 1, 0, '1test', 1, '2022-09-14 18:21:52', '2022-09-14 18:21:52'),
(6, 1, 3, 0, '3hafizul', 1, '2022-09-14 18:36:43', '2022-09-14 18:36:43'),
(7, 5, 3, 0, '3nam', 1, '2022-09-14 19:08:03', '2022-09-14 19:08:03'),
(8, 7, 2, 0, '2emploee-1', 1, '2022-09-14 19:44:55', '2022-09-14 19:44:55'),
(9, 1, 4, 0, '4test1', 1, '2022-09-14 14:13:52', '2022-09-14 14:13:52'),
(10, 3, 1, 1, 'hafizur', 1, '2022-09-22 10:10:51', '2022-09-22 10:10:51'),
(11, 3, 1, 1, 'Hotel Xyz', 1, '2022-09-25 15:17:10', '2022-09-25 15:17:10'),
(12, 1, 5, 0, '5hr', 1, '2022-10-05 11:31:07', '2022-10-05 11:31:07'),
(13, 1, 6, 0, '6Corporate 1', 1, '2022-10-29 17:57:04', '2022-10-29 17:57:04'),
(14, 1, 7, 0, '7Corporate 2', 1, '2022-10-29 18:02:01', '2022-10-29 18:02:01'),
(15, 7, 4, 0, '4gh', 1, '2022-11-02 19:11:03', '2022-11-02 19:11:03'),
(16, 3, 1, 1, 'Invest', 1, '2022-11-03 13:47:24', '2022-11-03 13:47:24'),
(17, 4, 1, 1, 'Salary', 1, '2022-11-03 19:16:35', '2022-11-03 19:16:35'),
(18, 4, 1, 1, 'Snacks', 1, '2022-11-12 15:06:28', '2022-11-12 15:06:28'),
(19, 1, 8, 0, '8abu huraira', 1, '2022-11-12 10:54:54', '2022-11-12 10:54:54'),
(20, 6, 2, 0, '2test', 1, '2022-11-12 17:04:05', '2022-11-12 17:04:05'),
(21, 1, 9, 0, '9office', 1, '2022-11-12 17:09:29', '2022-11-12 17:09:29'),
(22, 1, 10, 0, '10Mahfuz', 1, '2022-11-12 19:44:15', '2022-11-12 19:44:15'),
(23, 1, 11, 0, '11sagor', 1, '2022-11-13 11:44:08', '2022-11-13 11:44:08'),
(24, 1, 12, 0, '12Md Rakibuzzaman Khan', 1, '2022-11-13 12:03:13', '2022-11-13 12:03:13'),
(25, 5, 4, 0, '4abc', 1, '2022-11-13 17:17:50', '2022-11-13 17:17:50'),
(26, 7, 5, 0, '5sales', 1, '2022-11-14 09:44:33', '2022-11-14 09:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `account_head_types`
--

CREATE TABLE `account_head_types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:active,0:inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_head_types`
--

INSERT INTO `account_head_types` (`id`, `type_name`, `status`) VALUES
(1, 'Customer', 1),
(2, 'Deliveryman', 1),
(3, 'Income', 1),
(4, 'Expense', 1),
(5, 'Supplier', 1),
(6, 'Pickupman', 1),
(7, 'Employee', 1);

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alternative_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `thana_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `latitude` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwordReset` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public/avatar/avatar.png',
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agent_thanas`
--

CREATE TABLE `agent_thanas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agent_id` bigint(20) NOT NULL,
  `district_id` bigint(20) DEFAULT NULL,
  `thana_id` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `thana_id` int(11) DEFAULT NULL,
  `deliverymen_id` int(11) DEFAULT NULL,
  `pickupman_id` int(11) DEFAULT NULL,
  `coverage` tinyint(4) DEFAULT NULL COMMENT '1=Yes, 2=No',
  `delivery_type` tinyint(4) DEFAULT NULL COMMENT '1=Home Delivery, 2=Point Delivery',
  `pickup` tinyint(4) DEFAULT NULL COMMENT '1=Yes, 2=No',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `division_id`, `district_id`, `thana_id`, `deliverymen_id`, `pickupman_id`, `coverage`, `delivery_type`, `pickup`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Jahaj Building', 1, 1, 1, 1, NULL, NULL, NULL, NULL, 1, '2022-04-24 06:15:33', '2022-04-24 07:31:55'),
(2, 'Testing Area', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-24 06:57:29', '2022-04-24 06:57:29'),
(3, 'Section-10', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-26 23:15:50', '2022-04-26 23:15:50'),
(4, 'Section-1', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-26 23:16:12', '2022-04-26 23:16:12'),
(5, 'Section-2', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-26 23:16:29', '2022-04-26 23:16:29'),
(6, 'sec-12', 1, 1, 5, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-27 05:36:03', '2022-04-27 05:36:03'),
(7, 'Pallabi', 1, 1, 5, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-27 05:36:34', '2022-04-27 05:36:34'),
(8, 'Mirpur DOHS', 1, 1, 5, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-27 05:38:14', '2022-04-27 05:38:14'),
(9, 'Shagufta', 1, 1, 5, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-27 05:39:01', '2022-04-27 05:39:01'),
(10, 'Khilkhet', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:45:01', '2022-04-28 17:45:01'),
(11, 'Kurmitola high school & college', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:50:36', '2022-04-28 17:50:36'),
(12, 'Namapara', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:51:03', '2022-04-28 17:51:03'),
(13, 'International convention city Bashundhara', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:51:44', '2022-04-28 17:51:44'),
(14, 'Khilkhet Graveyard', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:52:16', '2022-04-28 17:52:16'),
(15, 'Progoti saroni 300 feet, Neela market', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:53:21', '2022-04-28 17:53:21'),
(16, 'Pink city model town', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:53:53', '2022-04-28 17:53:53'),
(17, 'Dumini', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:54:19', '2022-04-28 17:54:19'),
(18, 'Bombay sweets & co', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:54:53', '2022-04-28 17:54:53'),
(19, 'Ismaili jamatkhana and certre', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:56:02', '2022-04-28 17:56:02'),
(20, 'Khilkhet bazar', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:56:24', '2022-04-28 17:56:24'),
(21, 'Moddho para', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:56:49', '2022-04-28 17:56:49'),
(22, 'Uttar para', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:57:04', '2022-04-28 17:57:04'),
(23, 'Bhuiya bari', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:57:55', '2022-04-28 17:57:55'),
(24, 'Member bari', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:58:14', '2022-04-28 17:58:14'),
(25, 'Bottola', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:58:58', '2022-04-28 17:58:58'),
(26, 'Amtola Khilkhet', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 17:59:34', '2022-04-28 17:59:34'),
(27, 'Khilkhet bashtola', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:00:00', '2022-04-28 18:00:00'),
(28, 'Taltola', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:00:12', '2022-04-28 18:00:12'),
(29, 'Talertek', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:00:33', '2022-04-28 18:00:33'),
(30, 'Botghat', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:01:50', '2022-04-28 18:01:50'),
(31, 'Lakecity', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:02:19', '2022-04-28 18:02:19'),
(32, 'Boura', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:02:41', '2022-04-28 18:02:41'),
(33, 'Lonjonipara', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:03:12', '2022-04-28 18:03:12'),
(34, 'Sodesh', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:03:55', '2022-04-28 18:03:55'),
(35, 'Mastul', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:04:13', '2022-04-28 18:04:13'),
(36, 'Patira', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:04:32', '2022-04-28 18:04:32'),
(37, 'Purbachal 300 FT', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:05:01', '2022-04-28 18:05:01'),
(38, 'Lake city concord', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:05:37', '2022-04-28 18:05:37'),
(39, 'Banorupa housing', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:06:35', '2022-04-28 18:06:35'),
(40, '300 Feet (Khilkhet to purbachal)', 1, 1, 30, NULL, NULL, 1, 1, 1, 1, '2022-04-28 18:08:43', '2022-05-19 22:59:54'),
(41, 'Tanpara', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:09:07', '2022-04-28 18:09:07'),
(42, 'Army Golf Kurmitula Golf', 1, 1, 30, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:09:47', '2022-04-28 18:09:47'),
(43, 'Road 1', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:28:19', '2022-04-28 21:04:09'),
(44, 'Rd 2', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:28:42', '2022-04-28 18:28:42'),
(45, 'Rd 3', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:28:55', '2022-04-28 18:28:55'),
(46, 'Rd 4', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:29:10', '2022-04-28 18:29:10'),
(47, 'Rd 5', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:29:24', '2022-04-28 18:29:24'),
(48, 'Rd 6', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:29:36', '2022-04-28 18:29:36'),
(49, 'Rd 7', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:29:49', '2022-04-28 18:29:49'),
(50, 'Rd 8', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:30:03', '2022-04-28 18:30:03'),
(51, 'Rd 8', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:30:44', '2022-04-28 18:30:44'),
(52, 'Rd 9', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:31:09', '2022-04-28 18:31:09'),
(53, 'Rd 10', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:31:37', '2022-04-28 18:31:37'),
(54, 'Rd 11', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:31:53', '2022-04-28 18:31:53'),
(55, 'Rd 12', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:32:05', '2022-04-28 18:32:05'),
(56, 'Rd 13', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:32:22', '2022-04-28 18:32:22'),
(58, 'Rd 14', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:33:34', '2022-04-28 18:33:34'),
(60, 'Rd 15', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:34:10', '2022-04-28 18:34:10'),
(61, 'Rd 16', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:34:22', '2022-04-28 18:34:22'),
(62, 'Rd 17', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:34:45', '2022-04-28 18:35:08'),
(63, 'Rd 18', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:35:24', '2022-04-28 18:35:24'),
(64, 'Rd 19', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:36:31', '2022-04-28 18:36:31'),
(65, 'Rd 20', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:36:48', '2022-04-28 18:36:48'),
(66, 'Rd 21', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:37:06', '2022-04-28 18:37:06'),
(67, 'Rd 22', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:37:19', '2022-04-28 18:37:19'),
(68, 'Rd 23', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:37:30', '2022-04-28 18:37:44'),
(69, 'Rd 24', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:37:58', '2022-04-28 18:37:58'),
(70, 'Rd 25', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:38:13', '2022-04-28 18:38:13'),
(71, 'Rd 26', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:38:42', '2022-04-28 18:38:42'),
(72, 'Rd 27', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:39:09', '2022-04-28 18:39:09'),
(73, 'Fakhruddin restaurant', 1, 1, 53, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:39:42', '2022-04-28 18:39:42'),
(74, 'Rd 1', 1, 1, 54, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:40:20', '2022-04-28 18:40:20'),
(75, 'Rd 2', 1, 1, 54, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:42:40', '2022-04-28 18:42:40'),
(76, 'Rd 3', 1, 1, 54, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:43:05', '2022-04-28 18:43:05'),
(77, 'Rd 4', 1, 1, 54, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:43:46', '2022-04-28 18:43:46'),
(78, 'Rd 5', 1, 1, 54, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:44:05', '2022-04-28 18:44:05'),
(79, 'Rd 6', 1, 1, 54, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:44:23', '2022-04-28 18:44:23'),
(80, 'Western Road', 1, 1, 54, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:45:01', '2022-04-28 18:45:01'),
(81, 'Masjid Road', 1, 1, 54, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:45:29', '2022-04-28 18:45:29'),
(82, 'Rd 1', 1, 1, 55, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:47:10', '2022-04-28 18:47:10'),
(83, 'Rd 2', 1, 1, 55, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:47:23', '2022-04-28 18:47:23'),
(84, 'Rd 3', 1, 1, 55, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:47:35', '2022-04-28 18:47:35'),
(85, 'Rd 4', 1, 1, 55, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:47:46', '2022-04-28 18:47:46'),
(86, 'Rd 5', 1, 1, 55, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:47:58', '2022-04-28 18:47:58'),
(87, 'Rd 6', 1, 1, 55, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:48:11', '2022-04-28 18:48:11'),
(88, 'Rd 7', 1, 1, 55, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:48:21', '2022-04-28 18:48:21'),
(89, 'Rd 8', 1, 1, 55, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:48:32', '2022-04-28 18:48:32'),
(90, 'Rd 9', 1, 1, 55, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:48:44', '2022-04-28 18:48:54'),
(91, 'Rd 10', 1, 1, 55, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:49:16', '2022-04-28 18:49:16'),
(92, 'Rd 11', 1, 1, 55, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:49:30', '2022-04-28 18:49:30'),
(93, '12', 1, 1, 55, NULL, NULL, 1, 1, 1, 1, '2022-04-28 18:49:42', '2022-05-18 00:02:35'),
(94, 'Un Road', 1, 1, 55, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:50:06', '2022-04-28 18:50:06'),
(95, 'Park Road', 1, 1, 55, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:50:35', '2022-04-28 18:50:35'),
(96, 'Green Squre', 1, 1, 149, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:53:48', '2022-04-28 18:53:48'),
(97, 'Green Road', 1, 1, 149, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:54:22', '2022-04-28 18:54:22'),
(98, 'Green Corner', 1, 1, 149, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:54:54', '2022-04-28 18:54:54'),
(99, 'Sharawardi Avenue', 1, 1, 55, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:55:14', '2022-04-28 18:55:14'),
(100, 'Central Hospital', 1, 1, 149, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:55:33', '2022-04-28 18:55:33'),
(101, 'Rd 1', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:56:11', '2022-04-28 18:56:11'),
(102, 'Green Road Staff Quarter', 1, 1, 149, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:56:16', '2022-04-28 18:56:16'),
(103, 'Rd 2', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:56:23', '2022-04-28 18:56:23'),
(104, 'Rd 3', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:56:33', '2022-04-28 18:56:33'),
(105, 'Rd 4', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:56:45', '2022-04-28 18:56:45'),
(106, 'Rd 5', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:57:10', '2022-04-28 18:57:10'),
(107, 'Rd 6', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:57:24', '2022-04-28 18:57:24'),
(108, 'Rd 7', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 18:57:50', '2022-04-28 18:57:50'),
(109, 'Motaleb Plaza', 1, 1, 13, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 19:40:53', '2022-04-28 19:40:53'),
(110, 'Sobhan Bagh', 1, 1, 13, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 19:41:47', '2022-04-28 19:41:47'),
(111, 'Govt. Quarter', 1, 1, 13, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 19:44:19', '2022-04-28 19:44:19'),
(112, 'Bashir Uddin Road', 1, 1, 13, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 19:45:59', '2022-04-28 19:45:59'),
(113, 'Kala Bagan 3rd Lane', 1, 1, 13, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 19:47:02', '2022-04-28 19:47:02'),
(114, 'Kala Bagan 2nd Lane', 1, 1, 13, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 19:47:34', '2022-04-28 19:47:34'),
(115, 'Kala Bagan 1st Lane', 1, 1, 13, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 19:48:10', '2022-04-28 19:48:10'),
(116, 'Lake Circus', 1, 1, 13, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 19:48:50', '2022-04-28 19:48:50'),
(117, 'Kala Bagan', 1, 1, 13, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 19:50:23', '2022-04-28 19:50:23'),
(118, 'Shukrabad', 1, 1, 35, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 19:54:05', '2022-04-28 19:54:05'),
(119, 'Panthapath Signal', 1, 1, 35, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 19:54:43', '2022-04-28 19:54:43'),
(120, 'BRB Hospital', 1, 1, 35, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 19:55:16', '2022-04-28 19:55:16'),
(121, 'Square Hospital', 1, 1, 35, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 19:55:53', '2022-04-28 19:55:53'),
(122, 'Basundhara City', 1, 1, 35, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 19:56:38', '2022-04-28 19:56:38'),
(123, 'West Testuri Bazar', 1, 1, 35, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 19:57:24', '2022-04-28 19:57:24'),
(124, 'Sonargaon Signal', 1, 1, 147, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 19:57:54', '2022-04-28 19:59:01'),
(125, 'TCB Bhaban', 1, 1, 147, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:01:00', '2022-04-28 20:01:00'),
(126, 'Kawran Bazar Post Office', 1, 1, 147, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:01:32', '2022-04-28 20:01:32'),
(127, 'Dhaka Trade Center', 1, 1, 147, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:02:19', '2022-04-28 20:02:19'),
(128, 'Kawran Bazar (Kacha Bazar)', 1, 1, 147, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:02:57', '2022-04-28 20:02:57'),
(129, 'Farmgate', 1, 1, 146, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:04:51', '2022-04-28 20:04:51'),
(130, 'Tejturi Bazar', 1, 1, 146, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:05:36', '2022-04-28 20:05:36'),
(131, 'Tejkuni Para', 1, 1, 146, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:06:13', '2022-04-28 20:06:13'),
(132, 'Monipuri Para', 1, 1, 146, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:06:36', '2022-04-28 20:06:36'),
(133, 'Talla Bagh', 1, 1, 146, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:07:08', '2022-04-28 20:07:08'),
(134, 'Khamar Bari', 1, 1, 146, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:07:49', '2022-04-28 20:07:49'),
(135, 'West Raza Bazar', 1, 1, 146, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:08:22', '2022-04-28 20:08:22'),
(136, 'East Raza Bazar', 1, 1, 146, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:09:04', '2022-04-28 20:09:04'),
(137, 'Manik Mia Aveneu', 1, 1, 146, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:09:47', '2022-04-28 20:09:47'),
(138, 'Raza Bazar', 1, 1, 146, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:10:12', '2022-04-28 20:10:12'),
(139, 'Indira Road', 1, 1, 146, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:13:22', '2022-04-28 20:13:22'),
(140, 'Gonobhabon', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:14:41', '2022-04-28 20:14:41'),
(141, 'Shishu Mela', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:15:33', '2022-04-28 20:15:33'),
(142, 'Agargaon Taltola', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:17:55', '2022-04-28 20:17:55'),
(143, 'Shere Bangla Nagar', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:19:08', '2022-04-28 20:19:08'),
(144, 'West Agargaon', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:21:26', '2022-04-28 20:21:26'),
(145, 'Agargaon Bus Stop', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:25:26', '2022-04-28 20:25:26'),
(146, 'Rd 8', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:29:22', '2022-04-28 20:29:22'),
(147, 'Rd 9', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:29:45', '2022-04-28 20:29:45'),
(148, 'Rd 10', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:30:12', '2022-04-28 20:30:24'),
(149, 'IDB Bhaban', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:30:13', '2022-04-28 20:30:13'),
(150, 'Rd 11', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:30:51', '2022-04-28 20:30:51'),
(151, '12', 1, 1, 57, NULL, NULL, 1, 1, 1, 1, '2022-04-28 20:31:16', '2022-05-18 00:03:05'),
(152, 'Bangabandhu International Conference Center', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:31:19', '2022-04-28 20:31:19'),
(153, 'Rd 13', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:31:38', '2022-04-28 20:31:38'),
(154, 'Rd 14', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:32:01', '2022-04-28 20:32:14'),
(155, 'Rd 15', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:32:43', '2022-04-28 20:32:43'),
(156, 'Chandrima Uddayan', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:33:43', '2022-04-28 20:33:43'),
(157, 'Block A', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:33:47', '2022-04-28 20:33:47'),
(158, 'Block B', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:34:18', '2022-04-28 20:34:18'),
(159, 'Block C', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:34:36', '2022-04-28 20:34:36'),
(160, 'National Parliament', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:34:41', '2022-04-28 20:34:41'),
(161, 'Block D', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:35:00', '2022-04-28 20:35:00'),
(162, 'Block E', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:35:20', '2022-04-28 20:35:20'),
(163, 'Block F', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:35:42', '2022-04-28 20:35:42'),
(164, 'Block G', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:36:06', '2022-04-28 20:36:06'),
(165, 'Block H', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:36:32', '2022-04-28 20:36:32'),
(166, 'Block I', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:36:49', '2022-04-28 20:36:49'),
(167, 'Block J', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:37:14', '2022-04-28 20:37:14'),
(168, 'Block K', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:37:35', '2022-04-28 20:37:35'),
(169, 'Shaheed Suhrawardy Medical College And Hospital', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:37:37', '2022-04-28 20:37:37'),
(170, 'Block L', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:37:54', '2022-04-28 20:37:54'),
(171, 'Block M', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:38:14', '2022-04-28 20:38:14'),
(172, 'Block N', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:38:43', '2022-04-28 20:38:43'),
(173, 'Sher-e-bangla Agriculture University', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:38:52', '2022-04-28 20:38:52'),
(174, 'Walton corporate office', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:39:25', '2022-04-28 20:39:25'),
(175, 'North south university', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:40:00', '2022-04-28 20:40:00'),
(176, 'Divisional Passport & Visa Office', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:40:18', '2022-04-28 20:40:18'),
(177, 'GP house', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:40:41', '2022-04-28 20:40:41'),
(178, 'Bangladesh Technical Education Board', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:41:13', '2022-04-28 20:41:13'),
(179, 'BNP Bazar', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:42:22', '2022-04-28 20:42:22'),
(180, 'Department of Environment', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:43:16', '2022-04-28 20:43:16'),
(181, 'Bangladesh Betar', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:43:52', '2022-04-28 20:43:52'),
(182, 'Road 1', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:44:02', '2022-04-28 20:44:02'),
(183, 'Road 2', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:44:53', '2022-04-28 20:44:53'),
(184, 'Ansar Camp-Kallyanpur', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:45:04', '2022-04-28 20:45:04'),
(185, 'Gopi Para', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:46:55', '2022-04-28 20:46:55'),
(186, 'Road 4', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:47:20', '2022-04-28 20:47:20'),
(187, 'Road 3', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:47:43', '2022-04-28 20:47:43'),
(188, 'Diabari (Bottola to gabtoli)', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:47:56', '2022-04-28 20:47:56'),
(189, 'Road 6', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:48:19', '2022-04-28 20:48:19'),
(190, 'Road 5', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:48:38', '2022-04-28 20:48:38'),
(191, 'Mirpur 60 Fit', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:48:42', '2022-04-28 20:48:42'),
(192, 'Road 7', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:49:01', '2022-04-28 20:49:01'),
(193, 'Road 8', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:49:24', '2022-04-28 20:49:24'),
(194, 'Road 9', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:49:43', '2022-04-28 20:49:43'),
(195, 'Road 10', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:50:05', '2022-04-28 20:50:05'),
(196, 'Road 11', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:50:24', '2022-04-28 20:50:24'),
(197, 'Road 12', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:50:41', '2022-04-28 20:50:41'),
(198, 'Road 13', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:52:40', '2022-04-28 20:52:40'),
(199, 'Road 14', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:52:58', '2022-04-28 20:52:58'),
(200, 'Road 15', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:53:15', '2022-04-28 20:53:15'),
(201, 'Road 16', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:53:51', '2022-04-28 20:53:51'),
(202, 'Road 17', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:54:11', '2022-04-28 20:54:11'),
(203, 'Road 18', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:54:45', '2022-04-28 20:54:45'),
(204, 'Road 19', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:55:03', '2022-04-28 20:55:03'),
(205, 'Road 20', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:55:33', '2022-04-28 20:55:33'),
(206, 'Road 21', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:55:58', '2022-04-28 20:55:58'),
(207, 'Road 22', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:56:20', '2022-04-28 20:56:20'),
(208, 'Road 23', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:56:47', '2022-04-28 20:56:47'),
(209, 'Road 24', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:57:11', '2022-04-28 20:57:11'),
(210, 'Road 25', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:57:33', '2022-04-28 20:57:33'),
(211, 'Road 26', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:58:02', '2022-04-28 20:58:02'),
(212, 'Road 27', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:58:21', '2022-04-28 20:58:21'),
(213, 'Road 28', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:58:37', '2022-04-28 20:58:37'),
(214, 'Road 29', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:58:59', '2022-04-28 20:58:59'),
(215, 'Road 30', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:59:19', '2022-04-28 20:59:19'),
(216, 'Road 31', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 20:59:38', '2022-04-28 20:59:38'),
(217, 'Road 32', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:00:00', '2022-04-28 21:00:41'),
(218, 'Road 33', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:01:01', '2022-04-28 21:01:01'),
(219, 'Road 34', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:01:30', '2022-04-28 21:27:21'),
(220, 'Road 35', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:02:40', '2022-04-28 21:26:40'),
(221, 'Road 36', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:03:27', '2022-04-28 21:26:25'),
(222, 'Road 37', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:04:20', '2022-04-28 21:26:08'),
(223, 'Road 38', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:04:53', '2022-04-28 21:25:44'),
(224, 'Road 39', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:05:11', '2022-04-28 21:25:23'),
(225, 'Road 40', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:05:29', '2022-04-28 21:25:00'),
(226, 'Road 41', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:05:49', '2022-04-28 21:24:41'),
(227, 'Road 42', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:06:14', '2022-04-28 21:24:16'),
(228, 'Road 43', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:06:55', '2022-04-28 21:23:53'),
(229, 'Road 44', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:07:14', '2022-04-28 21:22:02'),
(230, 'Road 45', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:07:36', '2022-04-28 21:20:55'),
(231, 'Road 46', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:07:57', '2022-04-28 21:20:17'),
(232, 'Road 47', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:08:19', '2022-04-28 21:19:54'),
(233, 'Road 48', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:08:38', '2022-04-28 21:18:38'),
(234, 'Road 49', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:09:04', '2022-04-28 21:18:20'),
(235, 'Road 50', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:09:48', '2022-04-28 21:18:03'),
(236, 'Road 51', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:10:12', '2022-04-28 21:17:46'),
(237, 'Road 52', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:10:34', '2022-04-28 21:17:32'),
(238, 'Road 53', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:11:25', '2022-04-28 21:17:18'),
(239, 'Road 54', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:12:15', '2022-04-28 21:16:42'),
(240, 'Road 116', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:30:14', '2022-04-28 21:30:14'),
(241, 'Road 117', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:30:39', '2022-04-28 21:30:39'),
(242, 'Road 118', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:31:06', '2022-04-28 21:31:06'),
(243, 'Road 119', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:31:31', '2022-04-28 21:31:42'),
(244, 'Road 120', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 21:32:19', '2022-04-28 21:32:47'),
(245, 'Road 121', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-28 23:22:05', '2022-04-28 23:22:05'),
(246, 'Technical', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:26:48', '2022-04-29 00:26:48'),
(247, 'Bishil', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:31:18', '2022-04-29 00:31:18'),
(248, 'Technical Kallyanpur', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:32:36', '2022-04-29 00:32:36'),
(249, 'Golar Tek', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:33:18', '2022-04-29 00:33:18'),
(250, 'Baghbari- Kallyanpur', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:34:08', '2022-04-29 00:34:08'),
(251, 'Kallyanpur Road 12', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:35:06', '2022-04-29 00:35:06'),
(252, 'Kallyanpur Road 11', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:35:38', '2022-04-29 00:35:38'),
(253, 'Kallyanpur Road 10', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:36:16', '2022-04-29 00:36:16'),
(254, 'Kallyanpur Road 09', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:36:48', '2022-04-29 00:36:48'),
(255, 'Kallyanpur Road 08', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:37:20', '2022-04-29 00:37:20'),
(256, 'Kallyanpur Road 07', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:38:04', '2022-04-29 00:38:04'),
(257, 'Kallyanpur Road 06', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:38:39', '2022-04-29 00:38:39'),
(258, 'Kallyanpur Road 05', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:39:10', '2022-04-29 00:39:10'),
(259, 'Kallyanpur Road 04', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:43:38', '2022-04-29 00:43:38'),
(260, 'Kallyanpur Road 03', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:44:13', '2022-04-29 00:44:13'),
(261, 'Kallyanpur Road 02', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:44:41', '2022-04-29 00:44:41'),
(262, 'Kallyanpur Road 01', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 00:45:32', '2022-04-29 00:45:32'),
(263, 'Road 122', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:36:16', '2022-04-29 14:36:16'),
(264, 'Road 123', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:36:41', '2022-04-29 14:36:41'),
(265, 'Road 124', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:37:03', '2022-04-29 14:37:03'),
(266, 'Road 125', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:37:24', '2022-04-29 14:37:24'),
(267, 'Road 126', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:37:43', '2022-04-29 14:37:43'),
(268, 'Road 127', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:38:01', '2022-04-29 14:38:01'),
(269, 'Road 128', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:38:22', '2022-04-29 14:38:22'),
(270, 'Road 129', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:38:42', '2022-04-29 14:38:42'),
(271, 'Road 130', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:39:06', '2022-04-29 14:39:06'),
(272, 'Road 131', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:39:28', '2022-04-29 14:39:28'),
(273, 'Road 132', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:39:51', '2022-04-29 14:39:51'),
(274, 'Road 133', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:40:15', '2022-04-29 14:40:15'),
(275, 'Road 134', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:40:35', '2022-04-29 14:40:35'),
(276, 'Road 135', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:41:01', '2022-04-29 14:41:01'),
(277, 'Road 136', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:41:28', '2022-04-29 14:41:28'),
(278, 'Road 137', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:41:54', '2022-04-29 14:41:54'),
(279, 'Road 138', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:42:14', '2022-04-29 14:42:14'),
(280, 'Road 139', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:42:33', '2022-04-29 14:42:33'),
(281, 'Road 140', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:42:53', '2022-04-29 14:42:53'),
(282, 'Road 141', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:43:15', '2022-04-29 14:43:15'),
(283, 'Road 142', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:43:37', '2022-04-29 14:43:37'),
(284, 'Police palza concord shopping mall', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:44:25', '2022-04-29 14:44:25'),
(285, 'Gulshan shooting club', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:45:20', '2022-04-29 14:45:20'),
(286, 'KFC', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:45:39', '2022-04-29 14:45:39'),
(287, 'Pizza hut', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:53:00', '2022-04-29 14:53:00'),
(288, 'Spectra conversation centre', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:53:35', '2022-04-29 14:53:35'),
(289, 'Cadet college club limited', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:55:32', '2022-04-29 14:55:32'),
(290, 'DCC Market', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:56:07', '2022-04-29 14:56:07'),
(291, 'Zaara convention centre', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:57:04', '2022-04-29 14:57:04'),
(292, 'Tha glass house', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:58:03', '2022-04-29 14:58:03'),
(293, 'Jabbar tower', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:58:35', '2022-04-29 14:58:35'),
(294, 'Gulshan-1 circle', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 14:59:55', '2022-04-29 14:59:55'),
(295, 'DESCO', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:00:23', '2022-04-29 15:00:23'),
(296, 'Navana tower', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:00:50', '2022-04-29 15:00:50'),
(297, 'Fakhruddin restaurant', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:01:23', '2022-04-29 15:01:23'),
(298, 'Gulshan 1 Aarong', 1, 1, 59, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:02:02', '2022-04-29 15:02:02'),
(299, 'United commercial bank limited head office', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:02:44', '2022-04-29 15:02:44'),
(300, 'Road 55', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:04:09', '2022-04-29 15:04:09'),
(301, 'Cadet college club limited', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:04:54', '2022-04-29 15:04:54'),
(302, 'Road 57', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:05:12', '2022-04-29 15:05:12'),
(303, 'Road 58', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:05:32', '2022-04-29 15:05:32'),
(304, 'Road 59', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:06:05', '2022-04-29 15:06:05'),
(305, 'Road 60', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:06:31', '2022-04-29 15:06:31'),
(306, 'Road 61', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:06:48', '2022-04-29 15:06:48'),
(307, 'Road 62', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:08:08', '2022-04-29 15:08:08'),
(308, 'Road 63', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:08:38', '2022-04-29 15:08:38'),
(309, 'Road 64', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:09:11', '2022-04-29 15:09:11'),
(310, 'Road 65', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:09:37', '2022-04-29 15:09:37'),
(311, 'Road 66', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:10:12', '2022-04-29 15:10:12'),
(312, 'Road 67', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:10:33', '2022-04-29 15:10:33'),
(313, 'Road 71', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:11:05', '2022-04-29 15:11:05'),
(314, 'Road 72', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:11:37', '2022-04-29 15:11:37'),
(315, 'Road 73', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:12:00', '2022-04-29 15:12:00'),
(316, 'Road 74', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:12:21', '2022-04-29 15:12:21'),
(317, 'Road 75', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:12:37', '2022-04-29 15:12:37'),
(318, 'Road 76', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:13:35', '2022-04-29 15:13:35'),
(319, 'Road 77', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:13:55', '2022-04-29 15:13:55'),
(320, 'Road 78', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:14:16', '2022-04-29 15:14:16'),
(321, 'Road 79', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:14:35', '2022-04-29 15:14:35'),
(322, 'Road 80', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:14:55', '2022-04-29 15:14:55'),
(323, 'Road 81', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:15:21', '2022-04-29 15:15:21'),
(324, 'Road 82', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:15:42', '2022-04-29 15:15:42'),
(325, 'Road 83', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:16:57', '2022-04-29 15:16:57'),
(326, 'Road 84', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:17:24', '2022-04-29 15:17:24'),
(327, 'Road 85', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:17:47', '2022-04-29 15:17:58'),
(328, 'Road 86', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:18:25', '2022-04-29 15:18:25'),
(329, 'Road 87', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:19:25', '2022-04-29 15:19:25'),
(330, 'Road 88', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:19:46', '2022-04-29 15:19:46'),
(331, 'Road 89', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:20:08', '2022-04-29 15:20:08'),
(332, 'Road 90', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:20:33', '2022-04-29 15:20:33'),
(333, 'Road 91', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:20:51', '2022-04-29 15:20:51'),
(334, 'Road 92', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:21:09', '2022-04-29 15:21:09'),
(335, 'Road 93', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:21:27', '2022-04-29 15:21:27'),
(336, 'Road 94', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:21:45', '2022-04-29 15:21:45'),
(337, 'Road 95', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:22:02', '2022-04-29 15:22:33'),
(338, 'Road 96', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:22:52', '2022-04-29 15:22:52'),
(339, 'Road 97', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:23:09', '2022-04-29 15:23:09'),
(340, 'Road 98', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:23:32', '2022-04-29 15:23:32'),
(341, 'Road 99', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:23:50', '2022-04-29 15:23:50'),
(342, 'Road 100', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:24:43', '2022-04-29 15:24:43'),
(343, 'Road 101', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:25:20', '2022-04-29 15:25:20'),
(344, 'Road 102', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:25:41', '2022-04-29 15:25:41'),
(345, 'Road 103', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:26:02', '2022-04-29 15:26:16'),
(346, 'Road 104', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:26:36', '2022-04-29 15:26:36'),
(347, 'Road 105', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:27:05', '2022-04-29 15:27:05'),
(348, 'Road 106', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:27:24', '2022-04-29 15:27:24'),
(349, 'Road 107', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:27:46', '2022-04-29 15:27:46'),
(350, 'Road 108', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:28:12', '2022-04-29 15:28:24'),
(351, 'Road 109', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:28:43', '2022-04-29 15:28:43'),
(352, 'Road 110', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:29:05', '2022-04-29 15:29:05'),
(353, 'Road 111', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:29:26', '2022-04-29 15:29:26'),
(354, 'Road 112', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:29:44', '2022-04-29 15:29:44'),
(355, 'Road 113', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:30:08', '2022-04-29 15:30:08'),
(356, 'Gulshan central masjid (azad mosjid)', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:31:02', '2022-04-29 15:31:02'),
(357, 'The westin dhaka', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:31:38', '2022-04-29 15:31:38'),
(358, 'Banglalink customer care centre', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:32:09', '2022-04-29 15:32:09'),
(359, 'Gulshan lake park', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:32:30', '2022-04-29 15:32:30'),
(360, 'United hospital limited', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:33:01', '2022-04-29 15:33:01'),
(361, 'Justices shahabuddin park', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:33:51', '2022-04-29 15:33:51'),
(362, 'Gulshan DCC and super market', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:34:37', '2022-04-29 15:34:37'),
(363, 'Gulshan pink city shopping complex', 1, 1, 60, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:35:11', '2022-04-29 15:35:11'),
(364, 'Bou bazar', 1, 1, 61, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:35:39', '2022-04-29 15:35:39'),
(365, 'Joar shahara', 1, 1, 61, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:36:19', '2022-04-29 15:36:19'),
(366, 'Olipara', 1, 1, 61, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:36:55', '2022-04-29 15:36:55'),
(367, 'Lichubagan', 1, 1, 61, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:37:20', '2022-04-29 15:37:20'),
(368, 'Kalachadpur', 1, 1, 61, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:37:44', '2022-04-29 15:37:44'),
(369, 'Kuril bishawa Road', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:38:32', '2022-04-29 15:38:32'),
(370, 'Haji shahabuddin baitul falah jame masjid', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:39:24', '2022-04-29 15:39:24'),
(371, 'Power tech', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:39:46', '2022-04-29 15:39:46'),
(372, 'American inter-nation university bangladesh', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:41:02', '2022-04-29 15:41:02'),
(373, 'Aga khan academy', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:41:29', '2022-04-29 15:41:29'),
(374, 'Bashundhara industrial headquarter-2', 1, 1, 58, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:42:48', '2022-04-29 15:42:48'),
(375, 'Joshim uddin institute', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:43:56', '2022-04-29 15:43:56'),
(376, 'Kuratoli bazar', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:44:17', '2022-04-29 15:44:34'),
(377, 'Kuril kuratoli adarshaw high school', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:45:25', '2022-04-29 15:45:25'),
(378, 'Kuril flyover', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:45:49', '2022-04-29 15:45:49'),
(379, 'Pubali bank limited', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:46:22', '2022-04-29 15:46:22'),
(380, 'First security islami bank limited', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:47:59', '2022-04-29 15:47:59'),
(381, 'Kuril primary school', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:48:41', '2022-04-29 15:48:41'),
(382, 'Jamuna future park', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:49:04', '2022-04-29 15:49:04'),
(383, 'Jagannathpur', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:49:29', '2022-04-29 15:49:29'),
(384, 'Harez sharak', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:50:08', '2022-04-29 15:50:08'),
(385, 'Shahid abdul aziz sharak', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:51:29', '2022-04-29 15:51:29'),
(386, 'Pitha Ghor', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:51:51', '2022-04-29 15:52:08'),
(387, 'Saudi Masjid', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:52:32', '2022-04-29 15:52:32'),
(388, 'Walton plaza', 1, 1, 62, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:52:58', '2022-04-29 15:52:58'),
(389, 'Bkash customer care centre', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:53:57', '2022-04-29 15:53:57'),
(390, 'BATB Playground', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:54:52', '2022-04-29 15:54:52'),
(391, 'Raowa convention hall', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:55:43', '2022-04-29 15:55:53'),
(392, 'Mohakhali flyover', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:56:23', '2022-04-29 15:56:23'),
(393, 'Sks tower', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:56:44', '2022-04-29 15:56:44'),
(394, 'Mohakhali bus terminal', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:57:13', '2022-04-29 15:57:13'),
(395, 'ICDDRB Dhaka hospital', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:57:50', '2022-04-29 15:57:50'),
(396, 'Mohakhali TB Gate', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:58:14', '2022-04-29 15:58:14'),
(397, 'Government titumir collage', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:58:43', '2022-04-29 15:58:43'),
(398, 'Dhaka bank limited', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:59:15', '2022-04-29 15:59:15'),
(399, 'Brac university', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 15:59:58', '2022-04-29 15:59:58'),
(400, 'Partex group', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:00:55', '2022-04-29 16:00:55'),
(401, 'Brac centre', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:01:30', '2022-04-29 16:01:30'),
(402, 'TB Gate Road', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:01:59', '2022-04-29 16:01:59'),
(403, 'National institute of disease of the chest', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:02:51', '2022-04-29 16:02:51'),
(404, 'Infectious disease hospital', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:03:39', '2022-04-29 16:03:39'),
(405, 'Institute of public health', 1, 1, 63, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:04:09', '2022-04-29 16:04:09'),
(406, 'Road 1', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:04:53', '2022-04-29 16:04:53'),
(407, 'Road 2', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:05:17', '2022-04-29 16:05:17'),
(408, 'Road 3', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:05:46', '2022-04-29 16:05:46'),
(409, 'Road 4', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:06:06', '2022-04-29 16:06:06'),
(410, 'Road 5', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:06:25', '2022-04-29 16:06:25'),
(411, 'Road 6', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:06:43', '2022-04-29 16:06:43'),
(412, 'Road 7', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:07:07', '2022-04-29 16:07:07'),
(413, 'Road 8', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:08:16', '2022-04-29 16:08:16'),
(414, 'Road 9', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:08:34', '2022-04-29 16:08:34'),
(415, 'Road 10', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:08:54', '2022-04-29 16:08:54'),
(416, 'Road 11', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:10:01', '2022-04-29 16:10:01'),
(417, 'Road 12', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:10:22', '2022-04-29 16:10:22'),
(418, 'Road 13', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:10:46', '2022-04-29 16:10:46'),
(419, 'Road 14', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:11:07', '2022-04-29 16:11:07'),
(420, 'Road 15', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:11:37', '2022-04-29 16:11:37'),
(421, 'Road 16', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:11:59', '2022-04-29 16:11:59'),
(422, 'Road 17', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:12:16', '2022-04-29 16:12:16'),
(423, 'Road 18', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:12:35', '2022-04-29 16:12:35'),
(424, 'Road 19', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:12:54', '2022-04-29 16:12:54'),
(425, 'Road 20', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:13:19', '2022-04-29 16:13:19'),
(426, 'Road 21', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:13:51', '2022-04-29 16:13:51'),
(427, 'Road 22', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:14:13', '2022-04-29 16:14:13'),
(428, 'Road 23', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:14:37', '2022-04-29 16:14:37'),
(429, 'Road 24', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:15:14', '2022-04-29 16:15:14'),
(430, 'Road 25', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:15:46', '2022-04-29 16:15:46'),
(431, 'Road 26', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:17:19', '2022-04-29 16:17:19'),
(432, 'Road 27', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:17:41', '2022-04-29 16:17:41'),
(433, 'Road 28', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:18:04', '2022-04-29 16:18:04'),
(434, 'Road 29', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:22:03', '2022-04-29 16:22:03'),
(435, 'Road 30', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:22:38', '2022-04-29 16:22:38'),
(436, 'Road 31', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:23:14', '2022-04-29 16:23:14'),
(437, 'Road 33', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:24:14', '2022-04-29 16:24:14'),
(438, 'Road 32', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:24:42', '2022-04-29 16:24:42'),
(439, 'Road 34', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:25:05', '2022-04-29 16:25:05'),
(440, 'Road 35', 1, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:25:35', '2022-04-29 16:25:35'),
(441, 'Mural bazar', 1, 1, 61, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:26:44', '2022-04-29 16:26:44'),
(442, 'Sharkarbari', 1, 1, 61, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:27:36', '2022-04-29 16:27:36'),
(443, 'Nadda', 1, 1, 61, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:28:02', '2022-04-29 16:28:02'),
(444, 'BAF Shaheen college', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:29:23', '2022-04-29 16:29:23'),
(445, 'Arjotapara', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:29:51', '2022-04-29 16:29:51'),
(446, 'Universal medical college & hospital ltd', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:30:49', '2022-04-29 16:30:49'),
(447, 'Falcon tower', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:31:43', '2022-04-29 16:31:43'),
(448, 'The prime minister office', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:32:28', '2022-04-29 16:32:28'),
(449, 'Nakhalpara', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:33:22', '2022-04-29 16:33:22'),
(450, 'Nakhalpara government primary school', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:34:12', '2022-04-29 16:34:12'),
(451, 'Rahimafroz Battery headquarter', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:40:00', '2022-04-29 16:40:00'),
(452, 'Sony Rangs Showroom', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:41:26', '2022-04-29 16:41:26'),
(453, 'MP hostel road', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:44:11', '2022-04-29 16:44:11'),
(454, 'Nakhalpara sub post office', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:45:06', '2022-04-29 16:45:06'),
(455, 'Bijoy swaroni tejgaon flyover', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:46:25', '2022-04-29 16:46:25'),
(456, 'Jahangir gate', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:47:11', '2022-04-29 16:47:11'),
(457, 'Universal medical college & hospital', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:47:57', '2022-04-29 16:47:57');
INSERT INTO `areas` (`id`, `name`, `division_id`, `district_id`, `thana_id`, `deliverymen_id`, `pickupman_id`, `coverage`, `delivery_type`, `pickup`, `status`, `created_at`, `updated_at`) VALUES
(458, 'Mohakhali flyover', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:49:14', '2022-04-29 16:49:14'),
(459, 'Mohakhali railgate', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:50:00', '2022-04-29 16:50:00'),
(460, 'Mohakhali plaza', 1, 1, 65, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 16:50:37', '2022-04-29 16:50:37'),
(461, 'Kallyanpur Bus Stop', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:10:16', '2022-04-29 17:10:16'),
(462, 'Darussalam Tower', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:10:49', '2022-04-29 17:10:49'),
(463, 'Gabtoli Bus Stand', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:11:46', '2022-04-29 17:11:46'),
(464, 'Gabtoli Bus Terminal', 1, 1, 144, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:12:26', '2022-04-29 17:12:26'),
(465, 'Housing Society', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:13:09', '2022-04-29 17:13:09'),
(466, 'Nobodoy Housing Society', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:13:47', '2022-04-29 17:13:47'),
(467, 'Mohammadia Housing Limited', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:14:29', '2022-04-29 17:14:29'),
(468, 'Dhaka Uddan', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:15:07', '2022-04-29 17:15:07'),
(469, 'Nabi Nagar Housing', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:16:05', '2022-04-29 17:16:05'),
(470, 'Geneva Camp', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:16:39', '2022-04-29 17:16:39'),
(471, 'Bashbari', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:17:01', '2022-04-29 17:24:12'),
(472, 'Tajmahal Road', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:17:30', '2022-04-29 17:17:30'),
(473, 'Mohammadpur Bus Stand', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:18:17', '2022-04-29 17:23:43'),
(474, 'Salimullah Road', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:18:50', '2022-04-29 17:18:50'),
(475, 'Razia Sultana Road', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:19:36', '2022-04-29 17:19:36'),
(476, 'Nurjahan Road', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:20:04', '2022-04-29 17:20:04'),
(477, 'Shahjahan Road', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:21:11', '2022-04-29 17:21:11'),
(478, 'Iqbal Road', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:21:35', '2022-04-29 17:21:35'),
(479, 'Pulpar', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:22:20', '2022-04-29 17:22:20'),
(480, 'Jafrabad', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:22:45', '2022-04-29 17:22:45'),
(481, 'Kaderabad', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:25:02', '2022-04-29 17:25:02'),
(482, 'Katashur', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:25:29', '2022-04-29 17:25:29'),
(483, 'Mokbul Hossain College', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:26:01', '2022-04-29 17:26:01'),
(484, 'Kaderabad Housing', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:26:36', '2022-04-29 17:26:36'),
(485, 'Bosila', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:27:06', '2022-04-29 17:27:06'),
(486, 'Asad Avenue', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:27:34', '2022-04-29 17:27:34'),
(487, 'Asad Gate', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:28:02', '2022-04-29 17:28:02'),
(488, 'Zakir Hossain Road', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:30:50', '2022-04-29 17:30:50'),
(489, 'Arong', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:31:20', '2022-04-29 17:31:20'),
(490, 'Lalmatia Block G', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:32:30', '2022-04-29 17:32:30'),
(491, 'Lalmatia Block F', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:34:27', '2022-04-29 17:34:27'),
(492, 'Lalmatia Block D', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:38:52', '2022-04-29 17:38:52'),
(493, 'Lalmatia Block C', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:39:23', '2022-04-29 17:39:23'),
(494, 'Lalmatia Block B', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:39:58', '2022-04-29 17:39:58'),
(495, 'Lalmatia Block E', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:40:20', '2022-04-29 17:40:20'),
(496, 'Lalmatia Block A', 1, 1, 11, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:40:40', '2022-04-29 17:40:40'),
(497, 'Tikka Para', 1, 1, 143, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 17:41:57', '2022-04-29 17:41:57'),
(498, 'Shyamoli Square', 1, 1, 143, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:47:00', '2022-04-29 22:47:00'),
(499, 'Bijli Moholla', 1, 1, 143, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:47:54', '2022-04-29 22:47:54'),
(500, 'Humayun Road', 1, 1, 143, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:48:50', '2022-04-29 22:48:50'),
(501, 'Khilji Road', 1, 1, 143, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:49:30', '2022-04-29 22:49:30'),
(502, 'Babor Road', 1, 1, 143, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:50:18', '2022-04-29 22:50:18'),
(503, 'Tajmohol Road', 1, 1, 143, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:51:33', '2022-04-29 22:51:33'),
(504, 'Krishi Market', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:52:29', '2022-04-29 22:52:29'),
(505, 'Chad Uddan', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:54:05', '2022-04-29 22:54:05'),
(506, 'PC Culture Housing Sekertek', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:55:16', '2022-04-29 22:55:16'),
(507, 'Japan Garden City', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:55:56', '2022-04-29 22:55:56'),
(508, 'Shekhertekh Road 01', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:56:57', '2022-04-29 22:56:57'),
(509, 'Shekhertekh Road 02', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:57:22', '2022-04-29 22:57:22'),
(510, 'Shekhertekh Road 03', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:57:50', '2022-04-29 22:57:50'),
(511, 'Shekhertekh Road 04', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:58:18', '2022-04-29 22:58:18'),
(512, 'Shekhertekh Road 05', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:58:43', '2022-04-29 22:58:43'),
(513, 'Shekhertekh Road 06', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:59:08', '2022-04-29 22:59:08'),
(514, 'Shekhertekh Road 07', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 22:59:31', '2022-04-29 22:59:31'),
(515, 'Shekhertekh Road 08', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:00:09', '2022-04-29 23:00:09'),
(516, 'Shekhertekh Road 09', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:00:34', '2022-04-29 23:00:59'),
(517, 'Shekhertekh Road 10', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:01:35', '2022-04-29 23:01:35'),
(518, 'Baitul Aman Housing Society', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:02:30', '2022-04-29 23:02:30'),
(519, 'Suchona Community Center', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:03:16', '2022-04-29 23:03:16'),
(520, 'Monsurabad', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:06:02', '2022-04-29 23:06:02'),
(521, 'Adabor Road 14', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:07:07', '2022-04-29 23:07:07'),
(522, 'Adabor Road 13', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:07:43', '2022-04-29 23:07:43'),
(523, 'Adabor Road 12', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:09:07', '2022-04-29 23:09:07'),
(524, 'Adabor Road 11', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:09:32', '2022-04-29 23:09:32'),
(525, 'Adabor Road 10', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:09:53', '2022-04-29 23:09:53'),
(526, 'Adabor Road 09', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:14:55', '2022-04-29 23:14:55'),
(527, 'Adabor Road 08', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:15:21', '2022-04-29 23:15:21'),
(528, 'Adabor Road 07', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:16:04', '2022-04-29 23:16:30'),
(529, 'Adabor Road 06', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:16:55', '2022-04-29 23:16:55'),
(530, 'Adabor Road 05', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:17:31', '2022-04-29 23:17:31'),
(531, 'Adabor Road 04', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:17:56', '2022-04-29 23:17:56'),
(532, 'Adabor Road 03', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:18:27', '2022-04-29 23:18:27'),
(533, 'Adabor Road 02', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:18:46', '2022-04-29 23:18:46'),
(534, 'Adabor Road 01', 1, 1, 16, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-29 23:19:10', '2022-04-29 23:19:10'),
(535, 'Shyamoli Road 01', 1, 1, 143, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:36:14', '2022-04-30 20:36:14'),
(536, 'Shyamoli Road 02', 1, 1, 143, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:36:42', '2022-04-30 20:36:42'),
(537, 'Shyamoli Road 03', 1, 1, 143, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:37:08', '2022-04-30 20:37:08'),
(538, 'PC Culture Housing', 1, 1, 143, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:38:16', '2022-04-30 20:38:16'),
(539, 'Golden Street', 1, 1, 143, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:38:54', '2022-04-30 20:38:54'),
(540, 'Ring Road', 1, 1, 145, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:39:22', '2022-04-30 20:39:22'),
(541, 'Tollabagh', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:40:18', '2022-04-30 20:40:18'),
(542, 'Rayer Bazar', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:41:02', '2022-04-30 20:41:02'),
(543, 'Hazi Afsar Uddin Lane', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:41:51', '2022-04-30 20:41:51'),
(544, 'Mitali Road', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:42:25', '2022-04-30 20:42:25'),
(545, 'Jigatola Post Office', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:43:05', '2022-04-30 20:43:05'),
(546, 'Moneshwar Road', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:44:07', '2022-04-30 20:44:07'),
(547, 'Jigatola Bus Stand', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:44:40', '2022-04-30 20:44:40'),
(548, 'Old Dhanmondi All Roads', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:45:33', '2022-04-30 20:45:48'),
(549, 'Shatmosjid Road', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:46:19', '2022-04-30 20:46:19'),
(550, 'Shimanto Square', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:46:58', '2022-04-30 20:46:58'),
(551, 'Bangladesh Medical College', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:47:31', '2022-04-30 20:47:31'),
(552, 'Bangladesh Eye Hospital', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:48:24', '2022-04-30 20:48:24'),
(553, 'Genetic Plaza', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:48:58', '2022-04-30 20:48:58'),
(554, 'West Dhanmondi', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:49:46', '2022-04-30 20:49:46'),
(555, 'Shankar', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:50:38', '2022-04-30 20:50:38'),
(556, 'Dhanmondi 1 A', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:53:32', '2022-04-30 20:54:06'),
(557, 'Dhanmondi 2 A', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:54:28', '2022-04-30 20:54:28'),
(558, 'Dhanmondi 5 A', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:54:49', '2022-04-30 20:57:51'),
(559, 'Dhanmondi 3 A', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:55:08', '2022-04-30 20:55:08'),
(560, 'Dhanmondi  4 A', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:57:15', '2022-04-30 20:57:15'),
(561, 'Dhanmondi  6 A', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:59:37', '2022-04-30 21:00:30'),
(562, 'Dhanmondi  7 A', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 20:59:38', '2022-04-30 21:01:03'),
(563, 'Dhanmondi 8 A', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:01:47', '2022-04-30 21:01:47'),
(564, 'Dhanmondi 9 A', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:02:08', '2022-04-30 21:02:08'),
(565, 'Dhanmondi 10 A', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:02:24', '2022-04-30 21:02:24'),
(566, 'Dhanmondi 11 A', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:02:52', '2022-04-30 21:02:52'),
(567, 'Dhanmondi 12 A', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:03:08', '2022-04-30 21:03:08'),
(568, 'Dhanmondi 13 A', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:03:30', '2022-04-30 21:03:30'),
(569, 'Dhanmondi 27', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:03:58', '2022-04-30 21:03:58'),
(570, 'Dhanmondi  32', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:04:21', '2022-04-30 21:04:21'),
(571, 'Dhanmondi  1', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:05:17', '2022-04-30 21:05:32'),
(572, 'Dhanmondi 2', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:06:46', '2022-04-30 21:06:46'),
(573, 'Dhanmondi 3', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:07:21', '2022-04-30 21:07:21'),
(574, 'Dhanmondi 4', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:08:00', '2022-04-30 21:08:00'),
(575, 'Dhanmondi 5', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:09:27', '2022-04-30 21:09:27'),
(576, 'Dhanmondi 6', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:10:19', '2022-04-30 21:10:19'),
(577, 'Dhanmondi 7', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:11:06', '2022-04-30 21:11:06'),
(578, 'Dhanmondi 8', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:11:48', '2022-04-30 21:11:48'),
(579, 'Dhanmondi 9', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:12:42', '2022-04-30 21:12:42'),
(580, 'Dhanmondi 10', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:13:23', '2022-04-30 21:13:23'),
(581, 'Dhanmondi 11', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:13:58', '2022-04-30 21:13:58'),
(582, 'Dhanmondi 12', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:14:41', '2022-04-30 21:14:41'),
(583, 'Dhanmondi 13', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:15:12', '2022-04-30 21:15:12'),
(584, 'Dhanmondi 14', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:16:56', '2022-04-30 21:16:56'),
(585, 'Dhanmondi 15', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:17:31', '2022-04-30 21:17:31'),
(586, 'Dhanmondi 16', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:18:02', '2022-04-30 21:18:02'),
(587, 'Dhanmondi  Staff Quarter', 1, 1, 12, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:20:58', '2022-04-30 21:20:58'),
(588, 'Mirpur 1 Block (C)', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:24:07', '2022-04-30 21:24:07'),
(589, 'Mirpur 1 Block (D)', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:25:36', '2022-04-30 21:25:36'),
(590, 'Mirpur 1 Block (E)', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:26:22', '2022-04-30 21:26:22'),
(591, 'Mirpur 1 Block (F)', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:27:19', '2022-04-30 21:27:19'),
(592, 'Mirpur 1 Block (G)', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:28:11', '2022-04-30 21:28:11'),
(593, 'Mirpur 1 Block (H)', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:29:53', '2022-04-30 21:29:53'),
(594, 'Mirpur 1 Block (New C )', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:31:09', '2022-04-30 21:31:09'),
(595, 'Mukto Bangla Shopping Mall', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:32:22', '2022-04-30 21:32:22'),
(596, 'Barabag', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:33:12', '2022-04-30 21:33:36'),
(597, 'Mirpur 1 Hakim Plaza', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:34:32', '2022-04-30 21:34:32'),
(598, 'Mirpur 1 Shine Pukur', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:35:31', '2022-04-30 21:35:31'),
(599, 'Mirpur 1 Shah Ali Bag', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:36:34', '2022-04-30 21:36:34'),
(600, 'Mirpur 1 Zoo Road', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:37:44', '2022-04-30 21:37:44'),
(601, 'Mirpur 2 Commerce Collage Road', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:38:38', '2022-04-30 21:38:38'),
(602, 'Mirpur 2 Block (A)', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:39:47', '2022-04-30 21:39:47'),
(603, 'Mirpur 2 Block (B)', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:40:19', '2022-04-30 21:40:19'),
(604, 'Mirpur 2 Block (C)', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:40:53', '2022-04-30 21:40:53'),
(605, 'Mirpur 2 Block (D)', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:41:26', '2022-04-30 21:41:26'),
(606, 'Mirpur 2 Block (E)', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:42:59', '2022-04-30 21:42:59'),
(607, 'Mirpur 2 Block (F)', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:43:32', '2022-04-30 21:43:32'),
(608, 'Mirpur 2 Block (G)', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:45:24', '2022-04-30 21:45:24'),
(609, 'Mirpur 2 Block (G1)', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 21:54:09', '2022-04-30 21:54:09'),
(610, 'Mirpur 2 Block (H)', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 22:01:06', '2022-04-30 22:01:06'),
(611, 'Mirpur 2', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 22:02:48', '2022-04-30 22:02:48'),
(612, 'Mirpur 2 Rain Khola', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 22:04:58', '2022-04-30 22:04:58'),
(613, 'Monipur', 1, 1, 6, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 22:07:47', '2022-04-30 22:07:47'),
(614, 'Monipur', 1, 1, 110, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-30 22:13:14', '2022-04-30 22:13:14'),
(615, 'Barabag', 1, 1, 111, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:07:54', '2022-05-02 17:07:54'),
(616, 'Middle Monipur', 1, 1, 111, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:08:33', '2022-05-02 17:08:33'),
(617, 'West Monipur', 1, 1, 111, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:09:18', '2022-05-02 17:09:18'),
(618, 'South Monipur', 1, 1, 111, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:09:52', '2022-05-02 17:09:52'),
(619, 'West Pirerbag', 1, 1, 112, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:12:37', '2022-05-02 17:12:37'),
(620, 'Middle Pirerbagh', 1, 1, 112, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:13:41', '2022-05-02 17:13:41'),
(621, 'South Pirerbagh', 1, 1, 112, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:14:13', '2022-05-02 17:14:13'),
(622, 'West Kafrul', 1, 1, 9, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:15:15', '2022-05-02 17:15:15'),
(623, 'West Shewrapara', 1, 1, 113, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:15:46', '2022-05-02 17:15:46'),
(624, 'East Shewra Para', 1, 1, 113, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:17:02', '2022-05-02 17:17:02'),
(625, 'Senpara', 1, 1, 151, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:18:56', '2022-05-02 17:18:56'),
(626, 'Mirpur 06, Block Kha', 1, 1, 114, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:19:54', '2022-05-02 17:19:54'),
(627, 'Mirpur 06, Block Ka', 1, 1, 115, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:21:05', '2022-05-02 17:21:05'),
(628, 'Mirpur 06, Block A', 1, 1, 115, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:21:47', '2022-05-02 17:21:47'),
(629, 'Mirpur 06, Block B', 1, 1, 115, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:22:16', '2022-05-02 17:22:16'),
(630, 'Mirpur 06, Block C', 1, 1, 115, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:22:42', '2022-05-02 17:22:42'),
(631, 'Mirpur 06, Block D', 1, 1, 115, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:23:06', '2022-05-02 17:23:06'),
(632, 'Mirpur 06, Block E', 1, 1, 115, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:23:35', '2022-05-02 17:23:35'),
(633, 'Mirpur 6', 1, 1, 115, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:24:01', '2022-05-02 17:24:01'),
(634, 'Rupnagar R/A', 1, 1, 8, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:24:46', '2022-05-12 02:42:06'),
(635, 'Arambag Block A', 1, 1, 8, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:26:04', '2022-05-02 17:26:04'),
(636, 'Arambag Block B', 1, 1, 8, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:31:32', '2022-05-02 17:31:32'),
(637, 'Arambag Block C', 1, 1, 8, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:31:55', '2022-05-02 17:31:55'),
(638, 'Arambag Block D', 1, 1, 8, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:32:22', '2022-05-02 17:32:22'),
(639, 'Arambag Block E', 1, 1, 8, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:32:52', '2022-05-02 17:32:52'),
(640, 'Arambag Block F', 1, 1, 8, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:33:08', '2022-05-02 17:33:08'),
(641, 'Arifabad', 1, 1, 8, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:33:38', '2022-05-02 17:33:38'),
(642, 'Mirpur 7 (R/A)', 1, 1, 8, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:34:15', '2022-05-02 17:34:15'),
(643, 'Mirpur 7 (C/A)', 1, 1, 8, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:34:46', '2022-05-02 17:34:46'),
(644, 'Proshika', 1, 1, 8, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:35:04', '2022-05-02 17:35:37'),
(645, 'EXT Pallabi', 1, 1, 5, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:36:09', '2022-05-02 17:36:09'),
(646, 'Pallabi R/A', 1, 1, 5, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:36:33', '2022-05-02 17:36:33'),
(647, 'Eastern Housing', 1, 1, 5, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 17:36:56', '2022-05-02 17:36:56'),
(648, 'Alubdi', 1, 1, 5, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:45:35', '2022-05-02 18:45:35'),
(649, 'Milk Vita', 1, 1, 5, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:45:55', '2022-05-02 18:45:55'),
(650, 'Ceramic', 1, 1, 5, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:46:19', '2022-05-02 18:46:19'),
(651, 'MIST', 1, 1, 5, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:46:39', '2022-05-02 18:46:39'),
(652, 'Purobi', 1, 1, 5, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:46:59', '2022-05-02 18:46:59'),
(653, 'Mirpur Cantonment Restricted Area', 1, 1, 116, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:48:36', '2022-05-02 18:48:36'),
(654, 'Mirpur DOHS', 1, 1, 116, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:49:09', '2022-05-02 18:49:09'),
(655, 'Ceramic Block PO', 1, 1, 116, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:50:01', '2022-05-02 18:50:01'),
(656, 'Mirpur 12 Block A', 1, 1, 117, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:50:42', '2022-05-02 18:50:42'),
(657, 'Mirpur 12 Block B', 1, 1, 117, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:51:06', '2022-05-02 18:51:06'),
(658, 'Mirpur 12 Block D', 1, 1, 117, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:55:11', '2022-05-02 18:55:11'),
(659, 'Mirpur 12 Block C', 1, 1, 117, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:55:39', '2022-05-02 18:55:39'),
(660, 'Mirpur 12 Block E', 1, 1, 117, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:56:11', '2022-05-02 18:56:11'),
(661, 'Mirpur 12 Block Tha', 1, 1, 117, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:56:48', '2022-05-02 18:56:48'),
(662, 'Mirpur 12 Block Dha', 1, 1, 117, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:57:19', '2022-05-02 18:57:19'),
(663, 'Mirpur 12 Duip Area', 1, 1, 117, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:57:49', '2022-05-02 18:57:49'),
(664, 'Mirpur 12 Sagufta', 1, 1, 117, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 18:58:18', '2022-05-02 18:58:18'),
(665, 'Senpara', 1, 1, 114, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:24:58', '2022-05-02 20:24:58'),
(666, 'Block A', 1, 1, 114, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:25:05', '2022-05-02 20:26:10'),
(667, 'Block B', 1, 1, 114, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:26:58', '2022-05-02 20:26:58'),
(668, 'Block C', 1, 1, 114, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:28:29', '2022-05-02 20:28:29'),
(669, 'Block D', 1, 1, 114, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:29:30', '2022-05-02 20:29:30'),
(670, 'Block A', 1, 1, 118, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:31:30', '2022-05-02 20:31:30'),
(671, 'Block B', 1, 1, 118, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:32:20', '2022-05-02 20:32:20'),
(672, 'Block D', 1, 1, 118, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:34:29', '2022-05-02 20:34:29'),
(673, 'Block C', 1, 1, 118, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:35:17', '2022-05-02 20:35:17'),
(674, 'Shamol Polli Kalbat', 1, 1, 118, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:36:23', '2022-05-02 20:36:23'),
(675, 'Block A', 1, 1, 119, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:37:26', '2022-05-02 20:37:26'),
(676, 'Block B', 1, 1, 119, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:38:08', '2022-05-02 20:38:08'),
(677, 'Block C', 1, 1, 119, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:40:15', '2022-05-02 20:40:15'),
(678, 'Block D', 1, 1, 119, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:41:03', '2022-05-02 20:41:03'),
(679, 'Kafrul', 1, 1, 119, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:41:48', '2022-05-02 20:41:48'),
(680, 'Ibrahim Pur', 1, 1, 119, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:42:49', '2022-05-02 20:42:49'),
(681, 'East Kazi Para', 1, 1, 114, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:43:26', '2022-05-02 20:43:26'),
(682, 'East Shewra Para', 1, 1, 114, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:43:58', '2022-05-02 20:43:58'),
(683, 'North Kafrul', 1, 1, 9, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:44:49', '2022-05-02 20:44:49'),
(684, 'South Kafrul', 1, 1, 9, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:45:29', '2022-05-02 20:45:29'),
(685, 'East Kafrul', 1, 1, 9, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:45:55', '2022-05-02 20:45:55'),
(686, 'Barontag', 1, 1, 120, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:48:04', '2022-05-02 20:48:04'),
(687, 'Aziz Market', 1, 1, 120, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 20:48:48', '2022-05-02 20:48:48'),
(688, 'Niketan housing project', 1, 1, 66, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:18:38', '2022-05-02 21:18:38'),
(689, 'Asian television', 1, 1, 66, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:19:32', '2022-05-02 21:19:32'),
(690, 'Brac university girls hostel', 1, 1, 66, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:20:50', '2022-05-02 21:20:50'),
(691, 'Pran RFL Group production House', 1, 1, 66, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:21:59', '2022-05-02 21:21:59'),
(692, 'Niketan central jame masjid', 1, 1, 66, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:23:10', '2022-05-02 21:23:10'),
(693, 'Niketan gate 2', 1, 1, 66, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:23:45', '2022-05-02 21:23:45'),
(694, 'Road 1', 1, 1, 66, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:25:40', '2022-05-02 21:25:40'),
(695, 'Road 2', 1, 1, 66, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:26:28', '2022-05-02 21:26:28'),
(696, 'Road 3', 1, 1, 66, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:27:00', '2022-05-02 21:27:00'),
(697, 'Road 4', 1, 1, 66, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:27:28', '2022-05-02 21:27:28'),
(698, 'Road 5', 1, 1, 66, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:27:51', '2022-05-02 21:28:54'),
(699, 'Road 6', 1, 1, 66, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:28:35', '2022-05-02 21:28:35'),
(700, 'Road 7', 1, 1, 66, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:29:42', '2022-05-02 21:29:42'),
(701, 'Road 8', 1, 1, 66, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:30:12', '2022-05-02 21:30:12'),
(702, 'Road 9', 1, 1, 66, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:30:40', '2022-05-02 21:30:40'),
(703, 'Road 10', 1, 1, 66, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:31:04', '2022-05-02 21:31:04'),
(704, 'Road 1', 1, 1, 67, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:32:15', '2022-05-02 21:32:15'),
(705, 'Road 2', 1, 1, 67, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:32:46', '2022-05-02 21:32:46'),
(706, 'Road 3', 1, 1, 67, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:33:15', '2022-05-02 21:33:15'),
(707, 'Road 4', 1, 1, 67, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:33:36', '2022-05-02 21:33:36'),
(708, 'Road 5', 1, 1, 67, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:33:58', '2022-05-02 21:33:58'),
(709, 'Road 6', 1, 1, 67, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:36:10', '2022-05-02 21:36:10'),
(710, 'Road 7', 1, 1, 67, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:36:35', '2022-05-02 21:36:35'),
(711, 'Road 8', 1, 1, 67, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:37:11', '2022-05-02 21:37:11'),
(712, 'Road 9', 1, 1, 67, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:37:32', '2022-05-02 21:37:32'),
(713, 'Road 12', 1, 1, 68, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:38:21', '2022-05-02 21:38:21'),
(714, 'Road 13', 1, 1, 68, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:38:46', '2022-05-02 21:38:46'),
(715, 'Road 14', 1, 1, 68, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:39:14', '2022-05-02 21:39:14'),
(716, 'Road 15', 1, 1, 68, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:39:39', '2022-05-02 21:39:39'),
(717, 'Road 16', 1, 1, 68, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:41:50', '2022-05-02 21:41:50'),
(718, 'Road 17', 1, 1, 68, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:42:14', '2022-05-02 21:42:14'),
(719, 'Road 18', 1, 1, 68, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:42:39', '2022-05-02 21:42:39'),
(720, 'Road 19', 1, 1, 68, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:43:05', '2022-05-02 21:43:05'),
(721, 'Road 20', 1, 1, 68, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:43:27', '2022-05-02 21:43:27'),
(722, 'Tibet factory', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:45:13', '2022-05-02 21:45:13'),
(723, 'Nabisco biscuit & bread factory ltd', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:46:16', '2022-05-02 21:46:16'),
(724, 'South east university', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:47:13', '2022-05-02 21:47:13'),
(725, 'Shanta westen tower', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:48:31', '2022-05-02 21:48:31'),
(726, 'Nava tower', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:50:37', '2022-05-02 21:50:37'),
(727, 'Hashim tower', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:51:08', '2022-05-02 21:51:08'),
(728, 'Akij house', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:52:11', '2022-05-02 21:52:11'),
(729, 'Tejgaon industrial area', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:52:59', '2022-05-02 21:52:59'),
(730, 'Begunbari tejgaon', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:53:28', '2022-05-02 21:53:28'),
(731, 'Film development corporation', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:54:02', '2022-05-02 21:54:02'),
(732, 'Dhaka polytechnic institute', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:54:38', '2022-05-02 21:54:38'),
(733, 'Brac bank head office', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:55:36', '2022-05-02 21:55:36'),
(734, 'Bashundhara city', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:56:15', '2022-05-02 21:56:15'),
(735, 'BG press quarter', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:56:46', '2022-05-02 21:56:46'),
(736, 'BSTI', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:57:06', '2022-05-02 21:57:06'),
(737, 'Channel 24', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:57:36', '2022-05-02 21:57:36'),
(738, 'Essential drugs company', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:58:04', '2022-05-02 21:58:04'),
(739, 'Polar', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:58:25', '2022-05-02 21:58:25'),
(740, 'Satrasta', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:58:55', '2022-05-02 21:58:55'),
(741, 'Shahinbag', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:59:17', '2022-05-02 21:59:17'),
(742, 'Shantiniketon', 1, 1, 42, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 21:59:41', '2022-05-02 22:00:05'),
(743, 'Hazi Market', 1, 1, 120, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 22:10:22', '2022-05-02 22:10:22'),
(744, 'Bepari Market', 1, 1, 120, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 22:11:34', '2022-05-02 22:11:34'),
(745, 'Namapara Borobari', 1, 1, 120, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 22:12:26', '2022-05-02 22:12:26'),
(746, 'Balurghat Bazar', 1, 1, 120, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 22:13:19', '2022-05-02 22:13:19'),
(747, 'Madrasa Road', 1, 1, 121, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 22:14:39', '2022-05-02 22:14:39'),
(748, 'Manikdi Bazar', 1, 1, 121, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 22:15:41', '2022-05-02 22:15:41'),
(749, 'ECB Chottor Bus Stand', 1, 1, 121, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 22:16:58', '2022-05-02 22:16:58'),
(750, 'ECB Chottor Bus Stand', 1, 1, 121, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 22:16:58', '2022-05-02 22:16:58'),
(751, 'Namapara Cantonment', 1, 1, 121, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 22:28:22', '2022-05-02 22:28:22'),
(752, 'Matikata Bazar', 1, 1, 121, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 22:29:46', '2022-05-02 22:29:46'),
(753, 'West Matikata', 1, 1, 122, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 22:31:08', '2022-05-02 22:31:08'),
(754, 'Vasantak Bazar', 1, 1, 122, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 22:32:21', '2022-05-02 22:32:21'),
(755, 'Baganbari', 1, 1, 122, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 22:33:47', '2022-05-02 22:33:47'),
(756, 'Combined Military Hospital (CMH)', 1, 1, 19, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-02 22:37:44', '2022-05-02 22:37:44'),
(757, 'Shomorita medical college', 1, 1, 43, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:20:45', '2022-05-08 16:20:45'),
(758, 'Tejgaon ceramic institute', 1, 1, 43, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:21:25', '2022-05-08 16:21:25'),
(759, 'Tejgaon hokers market', 1, 1, 43, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:22:08', '2022-05-08 16:22:08'),
(760, 'Tejgaon land office', 1, 1, 43, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:22:35', '2022-05-08 16:22:35'),
(761, 'Tejgaon link Road', 1, 1, 43, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:23:06', '2022-05-08 16:23:06'),
(762, 'Tejgaon rail station', 1, 1, 43, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:24:01', '2022-05-08 16:24:01'),
(763, 'Tejgaon sonali bank', 1, 1, 43, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:24:38', '2022-05-08 16:24:38'),
(764, 'Tejgaon Thana', 1, 1, 43, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:25:08', '2022-05-08 16:25:08'),
(765, 'Tibbot', 1, 1, 43, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:25:42', '2022-05-08 16:25:42'),
(766, 'Lucas er mor', 1, 1, 43, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:26:47', '2022-05-08 16:26:47'),
(767, 'Kawranbazar truck stand', 1, 1, 43, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:27:30', '2022-05-08 16:27:30'),
(768, 'Elenbari-tejgaon', 1, 1, 43, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:28:47', '2022-05-08 16:28:47'),
(769, 'BG press', 1, 1, 43, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:29:32', '2022-05-08 16:29:32'),
(770, 'Rangs Tower', 1, 1, 43, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:30:00', '2022-05-08 16:30:00'),
(771, 'Solmaid', 1, 1, 45, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:30:35', '2022-05-08 16:30:35'),
(772, 'Wazuddin Road', 1, 1, 45, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:31:13', '2022-05-08 16:31:13'),
(773, 'Khondokar barir mor', 1, 1, 45, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:31:48', '2022-05-08 16:31:48'),
(774, 'Nayanagar', 1, 1, 45, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:32:31', '2022-05-08 16:32:31'),
(775, 'Cocacola', 1, 1, 45, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:33:03', '2022-05-08 16:33:03'),
(776, 'Apollo hospital', 1, 1, 45, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:33:40', '2022-05-08 16:33:40'),
(777, 'Jomoz Road', 1, 1, 45, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:34:09', '2022-05-08 16:34:09'),
(778, 'Kuratuly', 1, 1, 45, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:34:36', '2022-05-08 16:34:58'),
(779, 'Noton bazar', 1, 1, 45, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:35:27', '2022-05-08 16:35:27'),
(780, 'North badda', 1, 1, 45, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:35:55', '2022-05-08 16:35:55'),
(781, 'Block A', 1, 1, 69, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:37:53', '2022-05-08 16:37:53'),
(782, 'Block B', 1, 1, 69, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:38:27', '2022-05-08 16:38:27'),
(783, 'Block C', 1, 1, 69, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:38:52', '2022-05-08 16:38:52'),
(784, 'Block D', 1, 1, 69, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:39:20', '2022-05-08 16:39:20'),
(785, 'Block E', 1, 1, 69, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:39:50', '2022-05-08 16:39:50'),
(786, 'Block F', 1, 1, 69, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:40:13', '2022-05-08 16:40:13'),
(787, 'Block G', 1, 1, 69, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:40:32', '2022-05-08 16:40:32'),
(788, 'Block H', 1, 1, 69, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:40:56', '2022-05-08 16:40:56'),
(789, 'Block J', 1, 1, 69, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:41:19', '2022-05-08 16:41:19'),
(790, 'Shanta vantage', 1, 1, 69, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:41:48', '2022-05-08 16:41:48'),
(791, 'Ideal school goli', 1, 1, 69, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:42:43', '2022-05-08 16:42:43'),
(792, 'Farazi hospital Road', 1, 1, 69, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:43:58', '2022-05-08 16:43:58'),
(793, 'Meradia bazar', 1, 1, 69, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:45:09', '2022-05-08 16:45:09'),
(794, 'Block A', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:45:42', '2022-05-08 16:45:42'),
(795, 'Block B', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:47:01', '2022-05-08 16:47:01'),
(796, 'Block C', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:47:26', '2022-05-08 16:47:26'),
(797, 'Block D', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:47:56', '2022-05-08 16:47:56'),
(798, 'Block E', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:48:24', '2022-05-08 16:48:24'),
(799, 'Block M', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:49:06', '2022-05-08 16:49:06'),
(800, 'Block F', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:49:30', '2022-05-08 16:49:30'),
(801, 'Block H', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:49:56', '2022-05-08 16:49:56'),
(802, 'Block G', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:50:20', '2022-05-08 16:50:20'),
(803, 'Block J', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:50:53', '2022-05-08 16:50:53'),
(804, 'Block K', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:51:17', '2022-05-08 16:51:17'),
(805, 'Block L', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:51:40', '2022-05-08 16:51:40'),
(806, 'Block N', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:52:07', '2022-05-08 16:52:07'),
(807, 'Dosh tala market', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:52:44', '2022-05-08 16:52:44'),
(808, 'Falguny check', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:54:05', '2022-05-08 16:54:05'),
(809, 'Protik ruposree residential project', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:55:07', '2022-05-08 16:55:07'),
(810, 'Society vaban', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:55:46', '2022-05-08 16:55:46'),
(811, 'Trimohoni', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:56:25', '2022-05-08 16:56:25'),
(812, 'Trimohoni bazar', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:56:57', '2022-05-08 16:56:57'),
(813, 'Titas road,uttara bank', 1, 1, 70, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:57:41', '2022-05-08 16:57:41'),
(814, 'Peyarabag', 1, 1, 71, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:58:47', '2022-05-08 16:58:47'),
(815, 'Red crescent', 1, 1, 71, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:59:22', '2022-05-08 16:59:22'),
(816, 'Gabtola', 1, 1, 71, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 16:59:44', '2022-05-08 16:59:44'),
(817, 'Batar goli', 1, 1, 71, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:01:15', '2022-05-08 17:01:15'),
(818, 'Ad-din hospital', 1, 1, 71, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:01:52', '2022-05-08 17:01:52'),
(819, 'Ramna century avenue', 1, 1, 71, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:02:27', '2022-05-08 17:02:27'),
(820, 'Kazi office goli', 1, 1, 71, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:03:00', '2022-05-08 17:03:00'),
(821, 'Ramna officers quarter', 1, 1, 71, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:04:12', '2022-05-08 17:04:12'),
(822, 'High court staff quarter', 1, 1, 71, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:05:25', '2022-05-08 17:05:25'),
(823, 'Officer’s club', 1, 1, 71, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:06:18', '2022-05-08 17:06:18'),
(824, 'Eskaton garden', 1, 1, 71, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:06:54', '2022-05-08 17:06:54'),
(825, 'New eskaton Road', 1, 1, 71, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:07:25', '2022-05-08 17:07:25'),
(826, 'Mogbazar rail crossing', 1, 1, 71, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:08:11', '2022-05-08 17:08:11'),
(827, 'Moghbazar out circular road', 1, 1, 71, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:09:29', '2022-05-08 17:09:29'),
(828, 'Wireless', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:13:21', '2022-05-08 17:13:21'),
(829, 'Doctor goli', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:14:02', '2022-05-08 17:14:02'),
(830, 'Green way', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:14:39', '2022-05-08 17:14:39'),
(831, 'Bepari goli', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:15:26', '2022-05-08 17:15:26'),
(832, 'Kakon goli', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:16:14', '2022-05-08 17:16:14'),
(833, 'Chairman goli', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:16:51', '2022-05-08 17:16:51'),
(834, 'East nayatola', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:17:35', '2022-05-08 17:17:35'),
(835, 'West nayatola', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:18:10', '2022-05-08 17:18:10'),
(836, 'Ideal point', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:19:09', '2022-05-08 17:19:09'),
(837, 'Central road', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:19:35', '2022-05-08 17:19:35'),
(838, 'Sher-E-Bangla school road', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:20:19', '2022-05-08 17:20:19'),
(839, 'Hazi tower goli', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:21:06', '2022-05-08 17:21:06'),
(840, 'Modhubag', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:21:36', '2022-05-08 17:21:36'),
(841, 'Mirbag', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:22:02', '2022-05-08 17:22:02'),
(842, 'Ambagan, hatirjheel', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:23:17', '2022-05-08 17:23:17'),
(843, 'Shawpno goli', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:24:08', '2022-05-08 17:24:08'),
(844, 'Bakery goli', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:24:40', '2022-05-08 17:24:40'),
(845, 'Grand plaza', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:25:07', '2022-05-08 17:25:07'),
(846, 'Telephone bhaban', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:25:50', '2022-05-08 17:26:18'),
(847, 'Aarong', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:26:45', '2022-05-08 17:26:45'),
(848, 'Agora', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:27:13', '2022-05-08 17:27:13'),
(849, 'Holifamily hospital Moghbazar', 1, 1, 72, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-08 17:28:00', '2022-05-08 17:28:00'),
(850, 'Razzak Plaza', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:04:20', '2022-05-09 16:04:20'),
(852, 'Jolpai restaurant', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:06:59', '2022-05-09 16:06:59'),
(853, 'Eskaton gallery', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:07:49', '2022-05-09 16:07:49'),
(854, 'Queens garden home', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:08:40', '2022-05-09 16:08:40'),
(855, '129 Rangs Tower', 1, 1, 73, NULL, NULL, 1, 1, 1, 1, '2022-05-09 16:09:13', '2022-05-19 17:47:33'),
(856, '2 hajar goli', 1, 1, 73, NULL, NULL, 1, 1, 1, 1, '2022-05-09 16:10:40', '2022-05-19 19:23:48'),
(857, 'Agrani Aysha, Eskaton', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:11:31', '2022-05-09 16:11:31'),
(858, 'Navana sattar garden', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:12:13', '2022-05-09 16:12:13'),
(859, 'Rupayan Trade Centre', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:12:51', '2022-05-09 16:12:51'),
(860, 'Officers Quarter', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:13:38', '2022-05-09 16:13:38'),
(861, 'Inter continental hotel', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:14:45', '2022-05-09 16:14:45'),
(862, 'Borak unique heights tower', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:17:58', '2022-05-09 16:17:58'),
(863, 'Holy family hospital', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:21:56', '2022-05-09 16:21:56'),
(864, 'Minto Road', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:22:18', '2022-05-09 16:22:18'),
(865, 'DB Office,Minto Road', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:23:06', '2022-05-09 16:23:06'),
(866, 'Insaf barakah kidney and general hospital', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:24:19', '2022-05-09 16:24:19'),
(867, 'Shanti kunja goli', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:24:47', '2022-05-09 16:24:47'),
(868, 'Dilu Road', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:25:23', '2022-05-09 16:25:23'),
(869, 'Gaush Nagar', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:25:54', '2022-05-09 16:25:54'),
(870, '46 Rupayan Gellaxy', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:27:09', '2022-05-09 16:27:09'),
(871, '41 Navana Tower', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:27:48', '2022-05-09 16:27:48'),
(872, 'BM Goli', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:28:13', '2022-05-09 16:28:13'),
(873, '37  Rangs Tower', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:28:58', '2022-05-09 16:28:58'),
(874, '31 Rashid View', 1, 1, 73, NULL, NULL, 1, 1, 1, 1, '2022-05-09 16:29:39', '2022-05-20 07:19:15'),
(875, 'BM School', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:30:24', '2022-05-09 16:30:24'),
(876, '46 Rupayan gellaxy', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:31:39', '2022-05-09 16:31:39'),
(877, 'Shanta Tower, Banglamotor', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:32:34', '2022-05-09 16:32:34'),
(878, '51 Eastern Tower', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:33:16', '2022-05-09 16:33:16'),
(879, '52/1 Hasan Holding', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:34:50', '2022-05-09 16:34:50'),
(880, '53 ABC Crescent', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:35:58', '2022-05-09 16:35:58'),
(881, '54 Property Homes', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:36:53', '2022-05-09 16:36:53'),
(882, '57 Togor Bhaban', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:37:29', '2022-05-09 16:37:29'),
(883, 'MHK Tower', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:38:04', '2022-05-09 16:38:04'),
(884, 'MTB Tower', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:38:37', '2022-05-09 16:38:37'),
(885, 'Concord Tower', 1, 1, 73, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:39:11', '2022-05-09 16:39:11'),
(886, 'Tempu Stand', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:39:54', '2022-05-09 16:39:54'),
(887, 'Chapra Masjid', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:46:38', '2022-05-09 16:46:38'),
(888, 'Ali Ahmed School Road', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:47:11', '2022-05-09 16:47:11'),
(889, 'Adharsha School Road', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:48:07', '2022-05-09 16:48:07'),
(890, 'Hawai goli', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:48:59', '2022-05-09 16:48:59'),
(891, 'Fire service', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:49:31', '2022-05-09 16:49:31'),
(892, 'Shantipur Masjid', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:50:06', '2022-05-09 16:50:06'),
(893, 'Comilla Hotel Goli', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:50:41', '2022-05-09 16:50:41'),
(894, 'Tilpa para', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:51:23', '2022-05-09 16:51:23'),
(895, 'Goran Road  7', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:52:10', '2022-05-09 16:52:10'),
(896, 'Goran Road  8', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:52:32', '2022-05-09 16:52:32'),
(897, 'Goran Road  9', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:52:57', '2022-05-09 16:52:57'),
(898, 'Goran Road  10', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:53:25', '2022-05-09 16:53:25'),
(899, 'West Goran', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:53:53', '2022-05-09 16:53:53'),
(900, 'South Goran', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:54:23', '2022-05-09 16:54:23'),
(901, 'North Goran', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:54:53', '2022-05-09 16:54:53'),
(902, 'Shipahi bag', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:55:25', '2022-05-09 16:55:25'),
(903, 'Nababer mor', 1, 1, 74, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:55:51', '2022-05-09 16:55:51');
INSERT INTO `areas` (`id`, `name`, `division_id`, `district_id`, `thana_id`, `deliverymen_id`, `pickupman_id`, `coverage`, `delivery_type`, `pickup`, `status`, `created_at`, `updated_at`) VALUES
(904, 'Khilgaon rail gate', 1, 1, 29, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:58:36', '2022-05-09 16:58:36'),
(905, 'Purabarir  mor', 1, 1, 29, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 16:59:18', '2022-05-09 16:59:18'),
(906, 'Modhuban hotel mor', 1, 1, 29, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:00:28', '2022-05-09 17:00:28'),
(907, 'Bhuyanpara kachabazar', 1, 1, 29, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:01:09', '2022-05-09 17:01:09'),
(908, 'Bhuyanpara minara masjid', 1, 1, 29, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:03:20', '2022-05-09 17:03:20'),
(909, 'Block A, Tilapara', 1, 1, 29, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:04:16', '2022-05-09 17:04:16'),
(910, 'Block B Chowdhury Para', 1, 1, 29, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:05:14', '2022-05-09 17:05:14'),
(911, 'Block C Chowdhury Para', 1, 1, 29, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:05:50', '2022-05-09 17:05:50'),
(912, 'Chowdhury Para', 1, 1, 29, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:06:12', '2022-05-09 17:06:12'),
(913, 'Riazbag', 1, 1, 29, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:06:37', '2022-05-09 17:06:37'),
(914, 'Taltola', 1, 1, 29, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:06:59', '2022-05-09 17:06:59'),
(915, 'Biddyut office', 1, 1, 29, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:07:41', '2022-05-09 17:07:41'),
(916, 'Khilgaon matir masjid', 1, 1, 29, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:08:17', '2022-05-09 17:08:17'),
(917, 'Natunbag', 1, 1, 29, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:08:46', '2022-05-09 17:08:46'),
(918, 'UIU', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:10:55', '2022-05-09 17:10:55'),
(919, 'Nurerchala', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:11:43', '2022-05-09 17:11:43'),
(920, 'Satarkul', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:12:57', '2022-05-09 17:12:57'),
(921, 'Khilbarirtek', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:13:43', '2022-05-09 17:13:43'),
(922, 'Shahjadpur', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:14:51', '2022-05-09 17:14:51'),
(923, 'Sayed Nagar, 100 Feet Road', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:16:04', '2022-05-09 17:16:04'),
(924, 'Bashtola', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:16:37', '2022-05-09 17:16:37'),
(925, 'US Embassy', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:18:54', '2022-05-09 17:18:54'),
(926, 'Indian embassy', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:19:29', '2022-05-09 17:19:29'),
(927, 'Canadian embassy', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:20:19', '2022-05-09 17:20:19'),
(928, 'Nepal embassy', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:21:00', '2022-05-09 17:21:00'),
(929, 'Confidence centre', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:22:05', '2022-05-09 17:22:05'),
(930, 'Suvastu Nazar valley', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:23:22', '2022-05-09 17:23:22'),
(931, 'Suvastu Tower', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:23:57', '2022-05-09 17:23:57'),
(932, 'Cambrian college', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:24:44', '2022-05-09 17:24:44'),
(933, 'High Way homes', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:25:25', '2022-05-09 17:25:25'),
(934, 'BTI premier plaza', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:26:31', '2022-05-09 17:26:31'),
(935, 'GMG Tower', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:27:29', '2022-05-09 17:27:29'),
(936, 'Morium Tower 1', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:28:26', '2022-05-09 17:28:26'),
(937, 'Morium Tower 2', 1, 1, 75, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:28:50', '2022-05-09 17:28:50'),
(938, 'RFL Tower', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:29:24', '2022-05-09 17:29:24'),
(939, 'Manama Tower', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:29:52', '2022-05-09 17:29:52'),
(940, 'MF Tower, Link Road', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:30:40', '2022-05-09 17:30:40'),
(941, 'Tropical molla tower', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:31:26', '2022-05-09 17:31:26'),
(942, 'Middle badda', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:31:51', '2022-05-09 17:31:51'),
(943, 'Post office goli, middle badda', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:32:30', '2022-05-09 17:32:30'),
(944, 'Beparipara goli, middle badda', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:33:42', '2022-05-09 17:33:42'),
(945, 'Bazar Road, middle badda', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:34:39', '2022-05-09 17:34:39'),
(946, 'Adarsha Nagar, Middle Badda', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:35:22', '2022-05-09 17:35:22'),
(947, 'Monirbag, Uttar Badda', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:36:12', '2022-05-09 17:36:12'),
(948, 'Shadhinota Sharani', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:36:57', '2022-05-09 17:36:57'),
(949, 'Tetul Tola, Uttar Badda', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:41:36', '2022-05-09 17:41:36'),
(950, 'Alir mor, Uttar Badda', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:42:41', '2022-05-09 17:42:41'),
(951, 'Abdullahbag, Uttar Badda', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:43:22', '2022-05-09 17:43:45'),
(952, 'Thana Road, Uttar Badda', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:44:37', '2022-05-09 17:44:37'),
(953, 'Hazi Para, Uttar Badda', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:45:37', '2022-05-09 17:45:37'),
(954, 'Satarkul, Uttar Badda', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:47:05', '2022-05-09 17:47:05'),
(955, 'Gupipara, Uttar Badda', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:49:14', '2022-05-09 17:49:14'),
(956, 'Sobjigoli, Uttar Badda', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:50:04', '2022-05-09 17:50:04'),
(957, 'Badda general hospital', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:50:36', '2022-05-09 17:50:36'),
(958, 'Khanbag Masjid, Uttar Badda', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:51:17', '2022-05-09 17:51:17'),
(959, 'Gudaraghat', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:51:58', '2022-05-09 17:51:58'),
(960, 'Badda high school goli', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:52:19', '2022-05-09 17:52:19'),
(961, 'Baishakhi Sarani', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:53:01', '2022-05-09 17:53:01'),
(962, 'South Badda', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:53:43', '2022-05-09 17:53:43'),
(963, 'Gulshan Link Road', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:54:24', '2022-05-09 17:54:24'),
(964, 'Badda Link Road', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:54:53', '2022-05-09 17:54:53'),
(965, 'Facilities Tower', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:55:36', '2022-05-09 17:55:36'),
(966, 'Cumilla Para', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:56:11', '2022-05-09 17:56:11'),
(967, 'Kuwaity masjid', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:56:40', '2022-05-09 17:56:40'),
(968, 'Jahurul haque city', 1, 1, 17, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-09 17:57:14', '2022-05-09 17:57:14'),
(969, 'Khan Tek', 1, 1, 142, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:32:01', '2022-05-10 19:32:01'),
(970, 'BRTA', 1, 1, 142, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:33:34', '2022-05-10 19:33:34'),
(971, 'Road 01', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:35:45', '2022-05-10 19:39:18'),
(972, 'Road 02', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:36:37', '2022-05-10 19:36:37'),
(973, 'Road 03', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:37:07', '2022-05-10 19:37:07'),
(974, 'Road 04', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:37:35', '2022-05-10 19:37:35'),
(975, 'Road 05', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:39:54', '2022-05-10 19:39:54'),
(976, 'Road 06', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:40:20', '2022-05-10 19:40:20'),
(977, 'Road 07', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:40:44', '2022-05-10 19:40:44'),
(978, 'Road 08', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:41:05', '2022-05-10 19:41:25'),
(979, 'Road 09', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:41:52', '2022-05-10 19:41:52'),
(980, 'Road 10', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:42:24', '2022-05-10 19:42:24'),
(981, 'Road 11', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:42:46', '2022-05-10 19:42:46'),
(982, 'Road 12', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:43:05', '2022-05-10 19:43:05'),
(983, 'Road 13', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:43:28', '2022-05-10 19:43:28'),
(984, 'Road 14', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:43:52', '2022-05-10 19:43:52'),
(985, 'Road 15', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:44:11', '2022-05-10 19:44:11'),
(986, 'Road 16', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:44:33', '2022-05-10 19:46:37'),
(987, 'Road 17', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:44:53', '2022-05-10 19:46:51'),
(988, 'Road 18', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:47:24', '2022-05-10 19:47:24'),
(989, 'Road 19', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:47:50', '2022-05-10 19:48:09'),
(990, 'Road 20', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:48:42', '2022-05-10 19:49:10'),
(991, 'Road 21', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:49:38', '2022-05-10 19:49:38'),
(992, 'Rajlaxmi', 1, 1, 140, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:50:32', '2022-05-10 19:50:32'),
(993, 'Road 01', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:51:34', '2022-05-10 19:57:48'),
(994, 'Road 02', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:57:17', '2022-05-10 19:57:17'),
(995, 'Road 03', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:58:54', '2022-05-10 19:58:54'),
(996, 'Road 04', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:59:25', '2022-05-10 19:59:25'),
(997, 'Road 05', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 19:59:56', '2022-05-10 19:59:56'),
(998, 'Road 06', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:02:14', '2022-05-10 20:02:14'),
(999, 'Road 07', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:02:50', '2022-05-10 20:02:50'),
(1000, 'Road 08', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:05:45', '2022-05-10 20:05:45'),
(1001, 'Road 09', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:06:21', '2022-05-10 20:06:21'),
(1002, 'Road 10', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:07:14', '2022-05-10 20:07:14'),
(1003, 'Road 11', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:08:18', '2022-05-10 20:08:18'),
(1004, 'Road 12', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:08:57', '2022-05-10 20:08:57'),
(1005, 'Road 13', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:09:28', '2022-05-10 20:09:28'),
(1006, 'Road 14', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:09:58', '2022-05-10 20:09:58'),
(1007, 'Road 15', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:10:28', '2022-05-10 20:10:28'),
(1008, 'Road 16', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:11:02', '2022-05-10 20:11:02'),
(1009, 'Road 17', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:11:30', '2022-05-10 20:11:30'),
(1010, 'Road 18', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:12:14', '2022-05-10 20:12:14'),
(1011, 'Road 19', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:12:54', '2022-05-10 20:12:54'),
(1012, 'Road 20', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:13:27', '2022-05-10 20:13:27'),
(1013, 'Road 21', 1, 1, 141, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:14:21', '2022-05-10 20:14:21'),
(1014, 'Road 01', 1, 1, 138, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:15:27', '2022-05-10 20:52:07'),
(1015, 'Road 02', 1, 1, 138, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:16:10', '2022-05-10 20:52:36'),
(1016, 'Road 03', 1, 1, 138, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:56:37', '2022-05-10 20:56:37'),
(1017, 'Road 04', 1, 1, 138, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:57:09', '2022-05-10 20:57:09'),
(1018, 'Road 05', 1, 1, 138, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:57:44', '2022-05-10 20:57:44'),
(1019, 'Road 06', 1, 1, 138, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:58:09', '2022-05-10 20:58:09'),
(1020, 'Road 07', 1, 1, 138, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:58:50', '2022-05-10 20:58:50'),
(1021, 'Road 08', 1, 1, 138, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 20:59:18', '2022-05-10 20:59:18'),
(1022, 'Road 09', 1, 1, 138, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:00:19', '2022-05-10 21:00:52'),
(1023, 'Road 10', 1, 1, 138, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:01:41', '2022-05-10 21:01:41'),
(1024, 'Road 11', 1, 1, 138, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:02:29', '2022-05-10 21:02:29'),
(1025, 'Road 12', 1, 1, 138, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:03:13', '2022-05-10 21:03:13'),
(1026, 'Road 01', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:06:12', '2022-05-10 21:06:12'),
(1027, 'Road 02', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:07:01', '2022-05-10 21:07:01'),
(1028, 'Road 03', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:07:37', '2022-05-10 21:07:37'),
(1029, 'Road 04', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:08:18', '2022-05-10 21:08:18'),
(1030, 'Road 05', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:08:50', '2022-05-10 21:09:29'),
(1031, 'Road 06', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:10:13', '2022-05-10 21:10:13'),
(1032, 'Road 07', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:11:03', '2022-05-10 21:11:03'),
(1033, 'Road 09', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:11:52', '2022-05-10 21:11:52'),
(1034, 'Road 08', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:13:45', '2022-05-10 21:13:45'),
(1035, 'Road 10', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:14:45', '2022-05-10 21:15:13'),
(1036, 'Road 11', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:16:36', '2022-05-10 21:16:36'),
(1037, 'Road 12', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:17:23', '2022-05-10 21:17:23'),
(1038, 'Road 13', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:18:12', '2022-05-10 21:18:12'),
(1039, 'Road 14', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:18:51', '2022-05-10 21:18:51'),
(1040, 'Road 15', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:19:29', '2022-05-10 21:19:29'),
(1041, 'Road 16', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:30:02', '2022-05-10 21:30:02'),
(1042, 'Road 18', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:30:32', '2022-05-10 21:30:32'),
(1043, 'Road 17', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:31:03', '2022-05-10 21:31:03'),
(1044, 'Road 19', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:31:59', '2022-05-10 21:31:59'),
(1045, 'Road 20', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:32:38', '2022-05-10 21:32:38'),
(1046, 'Road 21', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:33:23', '2022-05-10 21:33:23'),
(1047, 'Road 22', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:34:10', '2022-05-10 21:34:10'),
(1048, 'Road 23', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:35:25', '2022-05-10 21:46:52'),
(1049, 'Road 24', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:35:50', '2022-05-10 21:47:31'),
(1050, 'Road 25', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 0, '2022-05-10 21:36:41', '2022-05-10 21:47:58'),
(1051, 'Road 26', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:48:54', '2022-05-10 21:48:54'),
(1052, 'Road 27', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:49:34', '2022-05-10 21:49:34'),
(1053, 'Road 28', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:50:09', '2022-05-10 21:50:09'),
(1054, 'Road 29', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:50:39', '2022-05-10 21:50:39'),
(1055, 'Road 30', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:51:06', '2022-05-10 21:51:06'),
(1056, 'Road 31', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:51:40', '2022-05-10 21:51:40'),
(1057, 'Road 32', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:52:14', '2022-05-10 21:52:14'),
(1058, 'Road 33', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:53:01', '2022-05-10 21:53:01'),
(1059, 'Road 34', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:53:32', '2022-05-10 21:53:32'),
(1060, 'Road 35', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:54:04', '2022-05-10 21:54:04'),
(1061, 'Road 36', 1, 1, 132, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 21:54:28', '2022-05-10 21:55:09'),
(1062, 'Road 01', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:04:41', '2022-05-10 22:04:41'),
(1063, 'Road 02', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:05:15', '2022-05-10 22:05:15'),
(1064, 'Road 03', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:05:53', '2022-05-10 22:05:53'),
(1065, 'Road 04', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:07:17', '2022-05-10 22:07:17'),
(1066, 'Road 05', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:08:06', '2022-05-10 22:08:06'),
(1067, 'Road 06', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:08:51', '2022-05-10 22:08:51'),
(1068, 'Road 07', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:09:28', '2022-05-10 22:09:28'),
(1069, 'Road 08', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:10:04', '2022-05-10 22:10:04'),
(1070, 'Road 09', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:10:50', '2022-05-10 22:10:50'),
(1071, 'Road 10', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:11:28', '2022-05-10 22:11:28'),
(1072, 'Road 11', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:12:07', '2022-05-10 22:12:07'),
(1073, 'Road 12', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:12:42', '2022-05-10 22:12:42'),
(1074, 'Road 13', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:30:19', '2022-05-10 22:30:19'),
(1075, 'Road 14', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:45:01', '2022-05-10 22:45:01'),
(1076, 'Road 15', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:45:40', '2022-05-10 22:45:40'),
(1077, 'Road 16', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:46:07', '2022-05-10 22:46:07'),
(1078, 'Road 17', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:46:28', '2022-05-10 22:46:28'),
(1079, 'Road 19', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:46:53', '2022-05-10 22:46:53'),
(1080, 'Road 18', 1, 1, 137, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:47:15', '2022-05-10 22:47:15'),
(1081, 'Road 01', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:48:12', '2022-05-10 22:48:12'),
(1082, 'Road 02', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:48:49', '2022-05-10 22:48:49'),
(1083, 'Road 03', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:49:24', '2022-05-10 22:49:24'),
(1084, 'Road 04', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:49:43', '2022-05-10 22:49:43'),
(1085, 'Road 05', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:50:03', '2022-05-10 22:50:21'),
(1086, 'Road 06', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:50:45', '2022-05-10 22:50:45'),
(1087, 'Road 07', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:51:13', '2022-05-10 22:51:13'),
(1088, 'Road 08', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:51:37', '2022-05-10 22:51:37'),
(1089, 'Road 09', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:51:59', '2022-05-10 22:51:59'),
(1090, 'Road 10', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:52:30', '2022-05-10 22:52:30'),
(1091, 'Road 11', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:52:49', '2022-05-10 22:52:49'),
(1092, 'Road 12', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:53:11', '2022-05-10 22:53:11'),
(1093, 'Road 13', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:53:45', '2022-05-10 22:53:45'),
(1094, 'Road 14', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:54:09', '2022-05-10 22:54:09'),
(1095, 'Road 15', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:54:32', '2022-05-10 22:54:53'),
(1096, 'Road 16', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:55:13', '2022-05-10 22:55:13'),
(1097, 'Road 17', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:55:35', '2022-05-10 22:55:35'),
(1098, 'Road 18', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:55:56', '2022-05-10 22:55:56'),
(1099, 'Road 19', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:56:22', '2022-05-10 22:56:22'),
(1100, 'Road 20', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:56:42', '2022-05-10 22:56:42'),
(1101, 'Road 21', 1, 1, 136, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:57:06', '2022-05-10 22:57:06'),
(1102, 'Road 01', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:58:21', '2022-05-10 22:58:21'),
(1103, 'Road 02', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:58:44', '2022-05-10 22:58:44'),
(1104, 'Road 03', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:59:06', '2022-05-10 22:59:06'),
(1105, 'Road 04', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:59:33', '2022-05-10 22:59:33'),
(1106, 'Road 05', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 22:59:55', '2022-05-10 23:00:12'),
(1107, 'Road 06', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 0, '2022-05-10 23:00:30', '2022-05-10 23:00:47'),
(1108, 'Road 07', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:01:22', '2022-05-10 23:01:22'),
(1109, 'Road 08', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:01:44', '2022-05-10 23:01:44'),
(1110, 'Road 09', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:02:06', '2022-05-10 23:02:06'),
(1111, 'Road 10', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:02:27', '2022-05-10 23:02:27'),
(1112, 'Road 11', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:02:49', '2022-05-10 23:02:49'),
(1113, 'Road 12', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:03:10', '2022-05-10 23:03:10'),
(1114, 'Road 13', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:03:32', '2022-05-10 23:03:32'),
(1115, 'Road 14', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:03:56', '2022-05-10 23:03:56'),
(1116, 'Road 15', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:04:16', '2022-05-10 23:04:16'),
(1117, 'Road 16', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:04:36', '2022-05-10 23:04:36'),
(1118, 'Road 17', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:04:56', '2022-05-10 23:04:56'),
(1119, 'Road 18', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:05:20', '2022-05-10 23:05:20'),
(1120, 'Road 19', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:05:39', '2022-05-10 23:05:39'),
(1121, 'Moylar Mor', 1, 1, 135, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:06:03', '2022-05-10 23:06:03'),
(1122, 'Road 01', 1, 1, 133, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:06:57', '2022-05-10 23:06:57'),
(1123, 'Road 02', 1, 1, 133, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:07:17', '2022-05-10 23:07:17'),
(1124, 'Road 03', 1, 1, 133, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:07:42', '2022-05-10 23:07:42'),
(1125, 'Road 04', 1, 1, 133, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:08:04', '2022-05-10 23:08:04'),
(1126, 'Road 05', 1, 1, 133, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:08:30', '2022-05-10 23:08:30'),
(1127, 'Road 07', 1, 1, 133, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:08:51', '2022-05-10 23:08:51'),
(1128, 'Road 06', 1, 1, 133, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:09:12', '2022-05-10 23:09:12'),
(1129, 'Road 08', 1, 1, 133, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:09:33', '2022-05-10 23:09:33'),
(1130, 'Road 09', 1, 1, 133, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:10:15', '2022-05-10 23:10:15'),
(1131, 'Road 02', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:11:10', '2022-05-10 23:11:10'),
(1132, 'Road 01', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:11:30', '2022-05-10 23:11:30'),
(1133, 'Road 04', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:11:48', '2022-05-10 23:11:48'),
(1134, 'Road 03', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:12:05', '2022-05-10 23:12:05'),
(1135, 'Road 05', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:12:26', '2022-05-10 23:12:26'),
(1136, 'Road 06', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:12:47', '2022-05-10 23:12:47'),
(1137, 'Road 07', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:13:12', '2022-05-10 23:13:12'),
(1138, 'Road 08', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 0, '2022-05-10 23:13:14', '2022-05-10 23:13:48'),
(1139, 'Road 10', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:14:22', '2022-05-10 23:14:22'),
(1140, 'Road 09', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:14:44', '2022-05-10 23:14:44'),
(1141, 'Road 11', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:15:16', '2022-05-10 23:15:16'),
(1142, 'Road 12', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:15:37', '2022-05-10 23:15:37'),
(1143, 'Road 13', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:15:58', '2022-05-10 23:21:52'),
(1144, 'Road 14', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:23:06', '2022-05-10 23:23:06'),
(1145, 'Road 15', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:26:12', '2022-05-10 23:26:12'),
(1146, 'Road 16', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:26:33', '2022-05-10 23:26:33'),
(1147, 'Road 17', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:28:08', '2022-05-10 23:28:08'),
(1148, 'Road 18', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:28:29', '2022-05-10 23:28:29'),
(1149, 'Road 19', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:28:55', '2022-05-10 23:29:25'),
(1150, 'Road 20', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:29:50', '2022-05-10 23:29:50'),
(1151, 'Road 21', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:31:12', '2022-05-10 23:31:12'),
(1152, 'Road 22', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:31:31', '2022-05-10 23:31:31'),
(1153, 'Road 23', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:31:52', '2022-05-10 23:31:52'),
(1154, 'Road 24', 1, 1, 134, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-10 23:33:00', '2022-05-10 23:33:00'),
(1155, 'Sritidhara', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-11 16:27:36', '2022-05-11 16:27:36'),
(1156, 'Giridhara', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-11 16:28:35', '2022-05-11 16:28:35'),
(1157, 'Road 1A', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-11 16:29:54', '2022-05-11 16:29:54'),
(1158, 'Saddam Market', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-11 16:33:45', '2022-05-11 16:33:45'),
(1159, 'Laboratory Road', 1, 1, 101, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-11 23:57:15', '2022-05-11 23:57:15'),
(1160, 'Science Lab Colony Masjid', 1, 1, 101, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-11 23:58:08', '2022-05-11 23:58:08'),
(1161, 'Sherin Plaza, Laboratory Road', 1, 1, 101, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-11 23:59:04', '2022-05-11 23:59:04'),
(1162, 'Multiplan Centre', 1, 1, 101, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 00:00:26', '2022-05-12 00:00:26'),
(1163, 'Priyangon Shopping Centre', 1, 1, 101, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 00:02:04', '2022-05-12 00:02:04'),
(1164, 'Priyangon Shopping Centre Goli Elephant Road', 1, 1, 101, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 00:03:26', '2022-05-12 00:03:26'),
(1165, 'BCSIR', 1, 1, 101, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 00:04:40', '2022-05-12 00:04:40'),
(1166, 'Science Lab Colony Masjid(BCSIR)', 1, 1, 101, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 00:08:35', '2022-05-12 00:08:35'),
(1167, 'Baitul Mamur Jaame Mosjid', 1, 1, 101, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 01:46:50', '2022-05-12 01:46:50'),
(1168, 'UCC Science lab', 1, 1, 101, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 01:48:07', '2022-05-12 01:48:07'),
(1169, 'Eastern Mollika Goli', 1, 1, 101, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 01:49:20', '2022-05-12 01:49:20'),
(1170, 'Cats Eye Goli', 1, 1, 101, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 01:50:49', '2022-05-12 01:50:49'),
(1171, 'BCSIR Secratariate', 1, 1, 101, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 01:55:53', '2022-05-12 01:55:53'),
(1172, 'North Road', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 01:56:57', '2022-05-12 01:56:57'),
(1173, 'Vuter Goli Water Pump Goli', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 01:57:45', '2022-05-12 01:57:45'),
(1174, 'Circular Road', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 01:58:46', '2022-05-12 01:58:46'),
(1175, 'NORTH Circular Road', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 01:59:44', '2022-05-12 01:59:44'),
(1176, 'Vuter Goli', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:00:26', '2022-05-12 02:00:26'),
(1177, 'Green Road', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:01:12', '2022-05-12 02:01:12'),
(1178, 'Cresent Road', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:02:04', '2022-05-12 02:02:04'),
(1179, 'Green Corner', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:02:52', '2022-05-12 02:02:52'),
(1180, 'Central Road', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:06:20', '2022-05-12 02:06:20'),
(1181, 'Children Home Pre-cadet High School Goli', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:07:46', '2022-05-12 02:07:46'),
(1182, 'Labaid Best Hospital Goli', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:09:28', '2022-05-12 02:09:28'),
(1183, 'West East St Central Road', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:12:06', '2022-05-12 02:12:06'),
(1184, 'Central hospital Nursing Institute Road', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:16:15', '2022-05-12 02:16:15'),
(1185, 'Green Corner Jame Mosjid Road', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:23:24', '2022-05-12 02:23:24'),
(1186, 'Hotel Kaderia & Chistia Resturent Goli', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:27:09', '2022-05-12 02:27:09'),
(1187, 'Ideal College', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:30:32', '2022-05-12 02:30:32'),
(1188, 'Kalabagan Police station', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:32:49', '2022-05-12 02:32:49'),
(1189, 'Al Hera Jame Mosjid', 1, 1, 102, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:35:03', '2022-05-12 02:35:03'),
(1190, 'Rupnagar Tin Shed', 1, 1, 8, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:43:05', '2022-05-12 02:43:05'),
(1191, 'Hatirpool Bazar', 1, 1, 103, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:45:02', '2022-05-12 02:45:02'),
(1192, 'Sonartori Hotel & Resturent Goli', 1, 1, 103, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:46:27', '2022-05-12 02:46:27'),
(1193, 'S Kamruzzaman Saroni', 1, 1, 103, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:47:33', '2022-05-12 02:47:33'),
(1194, 'New Life Hospital Ltd', 1, 1, 103, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:48:55', '2022-05-12 02:48:55'),
(1195, 'Cresent Road', 1, 1, 103, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:49:57', '2022-05-12 02:49:57'),
(1196, 'Motalib Plaza', 1, 1, 103, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:51:30', '2022-05-12 02:51:30'),
(1197, 'Nahar Plaza', 1, 1, 103, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:52:19', '2022-05-12 02:52:19'),
(1198, 'Eastern Plaza', 1, 1, 103, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:55:58', '2022-05-12 02:55:58'),
(1199, 'Hatirpool Link Road', 1, 1, 103, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:57:03', '2022-05-12 02:57:03'),
(1200, 'Bangladesh Law College', 1, 1, 103, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:57:53', '2022-05-12 02:57:53'),
(1201, 'Hatirpool jame Mosjid', 1, 1, 103, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 02:58:54', '2022-05-12 02:58:54'),
(1202, 'Free School street Hatirpool', 1, 1, 103, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 03:02:22', '2022-05-12 03:02:22'),
(1203, 'Hatirpool', 1, 1, 103, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 03:03:34', '2022-05-12 03:03:34'),
(1204, 'Free School street', 1, 1, 104, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 03:05:05', '2022-05-12 03:05:05'),
(1205, 'Free School street Jame Mosjid Pukurpar', 1, 1, 104, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 03:06:28', '2022-05-12 03:06:28'),
(1206, 'Sonar goon Road. Hatirpool', 1, 1, 104, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 03:08:23', '2022-05-12 03:08:23'),
(1207, 'Kathalbagan Dhal', 1, 1, 104, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 03:13:22', '2022-05-12 03:13:22'),
(1208, 'Road 3 A', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:19:41', '2022-05-12 15:25:25'),
(1209, 'Road 2 A', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:21:34', '2022-05-12 15:24:25'),
(1210, 'Road 2C', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:28:50', '2022-05-12 15:28:50'),
(1211, 'Road 01', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:33:02', '2022-05-12 15:55:58'),
(1212, 'Road 2', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:33:57', '2022-05-12 15:33:57'),
(1213, 'Road 3', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:34:44', '2022-05-12 15:34:44'),
(1214, 'Road 4', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:35:05', '2022-05-12 15:35:05'),
(1215, 'Road 5', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:35:42', '2022-05-12 15:35:42'),
(1216, 'Road 6', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:36:04', '2022-05-12 15:36:04'),
(1217, 'Road 7', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:36:34', '2022-05-12 15:36:34'),
(1218, 'Road 2B', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:37:28', '2022-05-12 15:37:28'),
(1219, 'Road 2C', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:38:44', '2022-05-12 15:38:44'),
(1220, 'Road 2D', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:39:15', '2022-05-12 15:39:15'),
(1221, 'Road 8', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:39:26', '2022-05-12 15:39:26'),
(1222, 'Road 9', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:39:48', '2022-05-12 15:39:48'),
(1223, 'Road 10', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:40:15', '2022-05-12 15:40:15'),
(1224, 'Ma O Shishu Clinic', 1, 1, 57, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:42:43', '2022-05-12 15:42:43'),
(1226, 'Rofikul Islam Road', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:44:34', '2022-05-12 15:44:34'),
(1227, 'Abu Jafar Gifary Collage Road', 1, 1, 76, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:44:50', '2022-05-12 15:44:50'),
(1228, 'Khanbari 4Road', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:45:31', '2022-05-12 15:45:31'),
(1229, 'Shantibag', 1, 1, 76, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:45:35', '2022-05-12 15:45:35'),
(1230, 'Road 11', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:47:09', '2022-05-12 15:47:09'),
(1231, 'Road 12', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:47:37', '2022-05-12 15:47:37'),
(1232, 'South Rayerbag gas road', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:48:11', '2022-05-12 15:48:11'),
(1233, 'Hasem Road', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:49:03', '2022-05-12 15:49:03'),
(1234, 'Pabna Colony', 1, 1, 76, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:49:54', '2022-05-12 15:49:54'),
(1235, 'Keranipara', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:50:13', '2022-05-12 15:50:13'),
(1236, 'Inu potti', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:50:54', '2022-05-12 15:50:54'),
(1237, 'Gulbag', 1, 1, 76, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:51:03', '2022-05-12 15:51:03'),
(1238, 'Razarbag', 1, 1, 76, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:51:52', '2022-05-12 15:51:52'),
(1239, 'Lotib mia collage', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:51:57', '2022-05-12 15:51:57'),
(1240, 'Road 13', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:52:19', '2022-05-12 15:52:19'),
(1241, 'Momenbag', 1, 1, 76, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:52:31', '2022-05-12 15:52:31'),
(1242, 'Collage Road', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:52:31', '2022-05-12 15:52:31'),
(1243, 'Road 14', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:52:40', '2022-05-12 15:52:40'),
(1244, 'Kodomtoli chow rasta', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:53:40', '2022-05-12 15:53:40'),
(1245, 'Amtola Mzasjid Road', 1, 1, 76, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:53:54', '2022-05-12 15:53:54'),
(1246, 'Road 15', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:54:07', '2022-05-12 15:54:07'),
(1247, 'Road 16', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:54:31', '2022-05-12 15:54:31'),
(1248, 'Mogol Nogor', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:54:37', '2022-05-12 15:54:37'),
(1249, 'Uttara Bank Goli', 1, 1, 76, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:54:45', '2022-05-12 15:54:45'),
(1250, 'Road 17', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:54:55', '2022-05-12 15:54:55'),
(1251, 'Shohor Polli', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:55:35', '2022-05-12 15:55:35'),
(1252, 'Officers Colony', 1, 1, 76, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:55:57', '2022-05-12 15:55:57'),
(1253, 'Muslim Nogor', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:56:36', '2022-05-12 15:56:36'),
(1254, 'Railway Colony', 1, 1, 76, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:56:42', '2022-05-12 15:56:42'),
(1255, 'Road 18', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:57:16', '2022-05-12 15:57:16'),
(1256, 'Badsha Mia Road', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:57:27', '2022-05-12 15:57:27'),
(1257, 'Road 19', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:57:42', '2022-05-12 15:57:42'),
(1258, 'Kobi Benjir Bagan Bari', 1, 1, 76, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:57:49', '2022-05-12 15:57:49'),
(1259, 'Road 20', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:58:01', '2022-05-12 15:58:01'),
(1260, 'Road 21', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:58:22', '2022-05-12 15:58:22'),
(1261, 'Navana Tower', 1, 1, 76, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:58:33', '2022-05-12 15:58:33'),
(1262, 'Road 22', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:58:42', '2022-05-12 15:58:42'),
(1263, 'Rajarbag Gate 3', 1, 1, 76, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 15:59:19', '2022-05-12 15:59:19'),
(1264, 'Rajarbag Mor', 1, 1, 76, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:00:03', '2022-05-12 16:00:03'),
(1265, 'Rajarbag Gate 2', 1, 1, 76, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:00:50', '2022-05-12 16:00:50'),
(1266, 'Azampur', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:00:55', '2022-05-12 16:00:55'),
(1267, 'Goalghat', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:01:04', '2022-05-12 16:01:04'),
(1268, 'Jashim Uddin', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:01:30', '2022-05-12 16:01:30'),
(1269, 'Cosmos Centre, Mouchak', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:01:52', '2022-05-12 16:01:52'),
(1270, 'Ahsan manjil', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:02:04', '2022-05-12 16:02:04'),
(1271, 'Sector 2, Uttara', 1, 1, 123, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:02:20', '2022-05-12 16:02:20'),
(1272, 'Kagoji Tola', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:02:58', '2022-05-12 16:02:58'),
(1273, 'Road 1', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:03:23', '2022-05-12 16:03:23'),
(1274, 'Malibag 1st Lane', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:03:31', '2022-05-12 16:03:31'),
(1275, 'Road 2', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:03:42', '2022-05-12 16:03:42'),
(1276, 'Shingtola', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:03:50', '2022-05-12 16:03:50'),
(1277, 'Road 7', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:04:00', '2022-05-12 16:06:47'),
(1278, 'Proprty Plaza', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:04:21', '2022-05-12 16:04:21'),
(1279, 'Road 3', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:04:23', '2022-05-12 16:04:23'),
(1280, 'Road 4', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:04:42', '2022-05-12 16:04:42'),
(1281, 'Dhalkanagar lane', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:04:51', '2022-05-12 16:04:51'),
(1282, 'Road 5', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:05:04', '2022-05-12 16:05:04'),
(1283, 'West Malibag', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:05:18', '2022-05-12 16:05:18'),
(1284, 'Road 6', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:05:32', '2022-05-12 16:05:32'),
(1285, 'Jorpool lane', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:05:55', '2022-05-12 16:05:55'),
(1286, 'Hosaf Tower', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:06:13', '2022-05-12 16:06:13'),
(1287, 'CID Office', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:07:02', '2022-05-12 16:07:02'),
(1288, 'Road 8', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:07:11', '2022-05-12 16:07:11'),
(1289, 'Road 9', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:07:30', '2022-05-12 16:07:30'),
(1290, 'Katherpul lane', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:07:45', '2022-05-12 16:07:45'),
(1291, 'Road 10', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:07:52', '2022-05-12 16:07:52'),
(1292, 'Fortune Shopping Mall', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:08:01', '2022-05-12 16:08:01'),
(1293, 'Road 11', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:08:10', '2022-05-12 16:08:10'),
(1294, 'Alomganj road', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:08:35', '2022-05-12 16:08:35'),
(1295, 'Sirajul Islam Medical College', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:08:54', '2022-05-12 16:08:54'),
(1296, 'BK Dash Road', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:09:40', '2022-05-12 16:09:40'),
(1297, 'Rajuk Officers Quater', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:10:00', '2022-05-12 16:10:00'),
(1298, 'Bagan Bari', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:11:00', '2022-05-12 16:11:00'),
(1299, 'Malaker tola', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:11:28', '2022-05-12 16:11:28'),
(1300, 'Chowdhury Para', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:11:47', '2022-05-12 16:11:47'),
(1301, 'Forashganj', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:12:12', '2022-05-12 16:12:12'),
(1302, 'Chowdhury Para Iqra Masjid Goli', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:12:34', '2022-05-12 16:12:34'),
(1303, 'Komor Uddin Tower', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:13:37', '2022-05-12 16:13:37'),
(1304, 'Mohoni mohon dash len', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:13:55', '2022-05-12 16:13:55'),
(1305, 'Road 12', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:16:13', '2022-05-12 16:16:13'),
(1306, 'Road 13', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:16:35', '2022-05-12 16:16:35'),
(1307, 'Debebn drow nath dash len', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:16:53', '2022-05-12 16:16:53'),
(1308, 'Road 14', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:16:59', '2022-05-12 16:16:59'),
(1309, 'Road 15', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:17:19', '2022-05-12 16:17:19'),
(1310, 'Road 16', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:17:37', '2022-05-12 16:17:37'),
(1311, 'Suklal dash len', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:17:56', '2022-05-12 16:17:56'),
(1312, 'Shahjalal Avenue', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:18:10', '2022-05-12 16:18:10'),
(1313, 'Abul Hotel', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:18:27', '2022-05-12 16:18:27'),
(1314, 'Alal Avenue', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:18:40', '2022-05-12 16:18:40'),
(1315, 'Ruplal dash len', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:18:45', '2022-05-12 16:18:45'),
(1316, 'House Building', 1, 1, 124, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:19:10', '2022-05-12 16:19:10'),
(1317, 'South Point School', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:19:38', '2022-05-12 16:19:38'),
(1318, 'Tanuganj len', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:21:16', '2022-05-12 16:21:16'),
(1319, 'Labaid Hospital', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:23:06', '2022-05-12 16:23:06'),
(1320, 'Road 1', 1, 1, 125, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:23:06', '2022-05-12 16:23:06'),
(1321, 'Satish sarker road', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:23:21', '2022-05-12 16:23:21'),
(1322, 'Road 02', 1, 1, 125, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:23:30', '2022-05-12 16:23:30'),
(1323, 'Road 03', 1, 1, 125, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:24:01', '2022-05-12 16:24:01'),
(1324, 'Karimullarbagh', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:24:08', '2022-05-12 16:24:08'),
(1325, 'Ibne Sina Hospital', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:24:09', '2022-05-12 16:24:09'),
(1326, 'Road 04', 1, 1, 125, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:24:24', '2022-05-12 16:24:24'),
(1327, 'Padma Cinema Hall', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:24:46', '2022-05-12 16:24:46'),
(1328, 'Road 05', 1, 1, 125, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:24:48', '2022-05-12 16:24:48'),
(1329, 'Deen narh sen road', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:24:48', '2022-05-12 16:24:48'),
(1330, 'Road 06', 1, 1, 125, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:25:14', '2022-05-12 16:25:14'),
(1331, 'Chand Bakery Goli', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:25:24', '2022-05-12 16:25:24'),
(1332, 'Kali choron shah road', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:25:26', '2022-05-12 16:25:26'),
(1333, 'Bangla Motor', 1, 1, 77, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:25:52', '2022-05-12 16:25:52'),
(1334, 'Abdullah Pur', 1, 1, 125, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:26:13', '2022-05-12 16:26:13'),
(1335, 'Sohid nagor', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:26:21', '2022-05-12 16:26:21'),
(1336, 'Islam Tower', 1, 1, 78, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:26:22', '2022-05-12 16:26:22'),
(1337, 'Molla Tower', 1, 1, 78, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:26:49', '2022-05-12 16:26:49'),
(1338, 'Khater pul', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:26:59', '2022-05-12 16:26:59'),
(1339, 'Road 1', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:27:06', '2022-05-12 16:27:06'),
(1340, 'Road 2', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:27:26', '2022-05-12 16:27:26'),
(1341, 'Lohar pul', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:27:28', '2022-05-12 16:27:28'),
(1342, 'Ulon', 1, 1, 78, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:27:35', '2022-05-12 16:27:35'),
(1343, 'Road 3', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:27:48', '2022-05-12 16:27:48'),
(1344, 'Shakari nagor len', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:28:05', '2022-05-12 16:28:05'),
(1345, 'Road 4', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:28:05', '2022-05-12 16:28:05'),
(1346, 'DIT Project', 1, 1, 78, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:28:09', '2022-05-12 16:28:09'),
(1347, 'Road 5', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:28:22', '2022-05-12 16:28:22'),
(1348, 'Road 8', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:28:38', '2022-05-12 16:37:35'),
(1349, '100 Katha', 1, 1, 22, NULL, NULL, 1, 1, 1, 1, '2022-05-12 16:28:57', '2022-05-18 00:02:02'),
(1350, 'Mohanagar Project', 1, 1, 78, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:29:04', '2022-05-12 16:29:04'),
(1351, '52 Katha', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:29:30', '2022-05-12 16:29:30'),
(1352, 'Wapda Road', 1, 1, 78, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:29:53', '2022-05-12 16:29:53'),
(1353, 'Hazi Para', 1, 1, 78, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:30:31', '2022-05-12 16:30:31');
INSERT INTO `areas` (`id`, `name`, `division_id`, `district_id`, `thana_id`, `deliverymen_id`, `pickupman_id`, `coverage`, `delivery_type`, `pickup`, `status`, `created_at`, `updated_at`) VALUES
(1354, 'Dhalka nagar lane dhaka', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:31:09', '2022-05-12 16:31:09'),
(1355, 'Baghichar Tek', 1, 1, 78, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:31:31', '2022-05-12 16:31:31'),
(1356, 'Omor Ali Lane', 1, 1, 78, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:32:13', '2022-05-12 16:32:13'),
(1357, 'Gendaria D.I.T plot', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:32:14', '2022-05-12 16:32:14'),
(1358, 'Road 6', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:32:25', '2022-05-12 16:32:25'),
(1359, 'Jheelkanon', 1, 1, 78, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:33:13', '2022-05-12 16:33:13'),
(1360, 'Sotish sarker road', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:33:15', '2022-05-12 16:33:15'),
(1361, 'SK dash road', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:34:12', '2022-05-12 16:34:12'),
(1362, 'Road 7', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:35:25', '2022-05-12 16:35:25'),
(1363, 'Road 9', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:37:56', '2022-05-12 16:37:56'),
(1364, 'Airport', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:38:17', '2022-05-12 16:42:35'),
(1365, 'Road 10', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:38:42', '2022-05-12 16:38:42'),
(1366, 'Road 11', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:39:00', '2022-05-12 16:39:00'),
(1367, 'Road 12', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:39:18', '2022-05-12 16:39:18'),
(1368, 'Road 13', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:39:35', '2022-05-12 16:39:35'),
(1369, 'Road 14', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:39:59', '2022-05-12 16:39:59'),
(1370, 'Road 15', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:40:19', '2022-05-12 16:40:19'),
(1371, 'Road 16', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:40:42', '2022-05-12 16:40:42'),
(1372, 'Airport Custom House', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:43:01', '2022-05-12 16:44:51'),
(1373, 'RAB Headquarter', 1, 1, 126, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:44:00', '2022-05-12 16:44:00'),
(1374, 'BTV Bhaban', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:45:41', '2022-05-12 16:45:41'),
(1375, 'Sarafat ganj road', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:45:52', '2022-05-12 16:45:52'),
(1376, 'TV Road', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:46:33', '2022-05-12 16:46:33'),
(1377, 'Sosivuson chaterji len', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:46:54', '2022-05-12 16:46:54'),
(1378, 'Shial Danga', 1, 1, 127, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:47:11', '2022-05-12 16:47:11'),
(1379, 'Boubazar', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:47:21', '2022-05-12 16:47:21'),
(1380, 'Northern University', 1, 1, 127, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:47:39', '2022-05-12 16:47:39'),
(1381, 'Rojoni Chowdhury road', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:47:48', '2022-05-12 16:47:48'),
(1382, 'Staff Quarter', 1, 1, 127, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:48:04', '2022-05-12 16:48:04'),
(1383, 'High School Goli', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:48:07', '2022-05-12 16:48:07'),
(1384, 'Din nath sen road', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:48:27', '2022-05-12 16:48:27'),
(1385, 'Kawla Bazar', 1, 1, 127, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:48:30', '2022-05-12 16:48:30'),
(1386, 'Kawla Mondir', 1, 1, 127, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:48:57', '2022-05-12 16:48:57'),
(1387, 'Titash Road', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:49:03', '2022-05-12 16:49:03'),
(1388, 'Distilary road', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:49:24', '2022-05-12 16:49:24'),
(1389, 'Gowal Bari', 1, 1, 127, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:49:32', '2022-05-12 16:49:32'),
(1390, 'Kunjabon', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:49:44', '2022-05-12 16:49:44'),
(1391, 'Jamtola', 1, 1, 127, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:49:59', '2022-05-12 16:49:59'),
(1392, 'Murgitola', 1, 1, 22, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:50:17', '2022-05-12 16:50:17'),
(1393, 'Post Office Goli', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:50:21', '2022-05-12 16:50:21'),
(1394, 'Jomidar Bari', 1, 1, 127, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:50:30', '2022-05-12 16:50:30'),
(1395, 'Bangladesh bank colony', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:51:20', '2022-05-12 16:51:20'),
(1396, 'Moulovirtek Jame Masjid', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:51:24', '2022-05-12 16:51:24'),
(1397, 'Dakhil Madrasha', 1, 1, 127, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:51:42', '2022-05-12 16:51:42'),
(1398, 'Vandari goli', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:51:58', '2022-05-12 16:51:58'),
(1399, 'Noya Bari', 1, 1, 127, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:52:10', '2022-05-12 16:52:10'),
(1400, 'Bepari Bari', 1, 1, 127, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:52:39', '2022-05-12 16:52:39'),
(1401, 'Arsine gate', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:52:51', '2022-05-12 16:52:51'),
(1402, 'IG gate', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:53:19', '2022-05-12 16:53:19'),
(1403, 'Sandar Tek', 1, 1, 127, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:53:31', '2022-05-12 16:53:31'),
(1404, 'Nama Para', 1, 1, 127, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:54:02', '2022-05-12 16:54:02'),
(1405, 'Mollah Bari', 1, 1, 127, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:54:25', '2022-05-12 16:54:25'),
(1406, 'Shamsul Ulum Madrasha', 1, 1, 127, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:55:13', '2022-05-12 16:55:13'),
(1407, 'Zakir Road', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:55:35', '2022-05-12 16:55:35'),
(1408, 'FDD Complex', 1, 1, 127, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:55:43', '2022-05-12 16:55:43'),
(1409, 'Old Police Fari', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:56:30', '2022-05-12 16:56:30'),
(1410, 'Mazar Chowrasta', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:57:10', '2022-05-12 16:57:10'),
(1411, 'Ati Para', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:57:39', '2022-05-12 16:57:39'),
(1412, 'Balur Matth', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:58:12', '2022-05-12 16:58:12'),
(1413, 'Agni Shikha Goli', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:58:30', '2022-05-12 16:58:30'),
(1414, 'Adarsha Para', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:58:46', '2022-05-12 16:58:46'),
(1415, 'Polashbag', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 16:59:34', '2022-05-12 16:59:34'),
(1416, 'Shimulbag', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:00:25', '2022-05-12 17:00:25'),
(1417, 'Porabarir Goli', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:00:56', '2022-05-12 17:00:56'),
(1418, 'Jomidar Goli', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:01:49', '2022-05-12 17:01:49'),
(1419, 'Bhuyia Para', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:02:29', '2022-05-12 17:02:29'),
(1420, 'East Rampura', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:03:01', '2022-05-12 17:03:01'),
(1421, 'Khilgaon Chowdhury Para', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:04:14', '2022-05-12 17:04:14'),
(1422, 'Malibag Chowdhury Para', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:04:50', '2022-05-12 17:04:50'),
(1423, 'Block A', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:05:53', '2022-05-12 17:05:53'),
(1424, 'Block B', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:06:20', '2022-05-12 17:06:20'),
(1425, 'Jamtola', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:07:27', '2022-05-12 17:07:27'),
(1426, 'Block C', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:07:29', '2022-05-12 17:07:29'),
(1427, 'Nasir khaner goli', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:07:53', '2022-05-12 17:07:53'),
(1428, 'Madar Bari', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:07:54', '2022-05-12 17:07:54'),
(1429, 'Block D', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:08:11', '2022-05-12 17:08:11'),
(1430, 'Helal Market', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:08:22', '2022-05-12 17:08:22'),
(1431, 'Block E', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:08:34', '2022-05-12 17:08:34'),
(1432, 'Dobadiya', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:08:50', '2022-05-12 17:08:50'),
(1433, 'Block F', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:08:56', '2022-05-12 17:08:56'),
(1434, 'Chamurkhan', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:09:18', '2022-05-12 17:09:18'),
(1435, 'Shotota housing', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:09:20', '2022-05-12 17:09:20'),
(1436, 'Block G', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:09:52', '2022-05-12 17:09:52'),
(1437, 'Kanchkura', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:10:00', '2022-05-12 17:10:00'),
(1438, 'Block H', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:10:23', '2022-05-12 17:10:23'),
(1439, 'Akota housing', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:10:36', '2022-05-12 17:10:36'),
(1440, 'Block I', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:11:00', '2022-05-12 17:11:00'),
(1441, 'Boisaki housing', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:11:16', '2022-05-12 17:11:16'),
(1442, 'Block J', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:11:25', '2022-05-12 17:11:25'),
(1443, 'Jiya Bagh', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:11:31', '2022-05-12 17:11:31'),
(1444, 'Block K', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:12:11', '2022-05-12 17:12:11'),
(1445, 'Chapan', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:12:18', '2022-05-12 17:12:18'),
(1446, 'Bahadur pul len', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:12:18', '2022-05-12 17:12:18'),
(1447, 'Block L', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:12:36', '2022-05-12 17:12:36'),
(1448, 'Teromukh', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:13:01', '2022-05-12 17:13:01'),
(1449, 'Zahirul Islam City', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:13:17', '2022-05-12 17:13:17'),
(1450, 'Munda', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:13:20', '2022-05-12 17:13:20'),
(1451, 'Nabin chandra goswami road', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:13:48', '2022-05-12 17:13:48'),
(1452, 'Kalabagan', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:13:59', '2022-05-12 17:13:59'),
(1453, 'Kuri Para', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:14:27', '2022-05-12 17:14:27'),
(1454, 'East  West University', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:14:41', '2022-05-12 17:14:41'),
(1455, 'Chan Para', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:14:58', '2022-05-12 17:14:58'),
(1456, 'Ananda Nagar', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:15:12', '2022-05-12 17:15:12'),
(1457, 'Moinar Tek', 1, 1, 44, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:15:25', '2022-05-12 17:15:25'),
(1458, 'Khondoker road', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:17:03', '2022-05-12 17:17:03'),
(1459, 'Baithakhali', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:17:37', '2022-05-12 17:17:37'),
(1460, 'West Merul Badda', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:18:50', '2022-05-12 17:18:50'),
(1461, 'Merul Badda', 1, 1, 79, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:19:38', '2022-05-12 17:19:38'),
(1462, 'Mugda', 1, 1, 80, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:20:21', '2022-05-12 17:20:21'),
(1463, 'Uttar Mugda', 1, 1, 80, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:21:08', '2022-05-12 17:21:08'),
(1464, 'Dakkhin Mugda', 1, 1, 80, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:21:43', '2022-05-12 17:21:43'),
(1465, 'Mugda Stadium', 1, 1, 80, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:22:42', '2022-05-12 17:22:42'),
(1466, 'Mugda Boro Masjid', 1, 1, 80, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:23:23', '2022-05-12 17:23:23'),
(1467, 'Mugda Bengal Germents', 1, 1, 80, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:24:05', '2022-05-12 17:24:05'),
(1468, 'Bashar Tower', 1, 1, 80, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:24:45', '2022-05-12 17:24:45'),
(1469, 'Hrishi para', 1, 1, 153, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:25:15', '2022-05-12 17:25:15'),
(1470, 'Mugda Hospital', 1, 1, 80, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:25:23', '2022-05-12 17:25:23'),
(1471, 'Mugda Thana', 1, 1, 80, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:26:15', '2022-05-12 17:26:15'),
(1472, 'Muradpur madical road', 1, 1, 153, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:26:27', '2022-05-12 17:26:27'),
(1473, 'Wapda Goli', 1, 1, 80, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:27:06', '2022-05-12 17:27:06'),
(1474, 'Jannatbag', 1, 1, 80, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:27:48', '2022-05-12 17:27:48'),
(1475, 'Zero Point Goli', 1, 1, 80, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:28:36', '2022-05-12 17:28:36'),
(1476, 'Shyampur bridge', 1, 1, 153, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:28:46', '2022-05-12 17:28:46'),
(1477, 'Modinabag', 1, 1, 80, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:30:02', '2022-05-12 17:30:02'),
(1478, 'Wasa Road', 1, 1, 80, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:30:44', '2022-05-12 17:30:44'),
(1479, 'Kudar bazar', 1, 1, 153, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:31:04', '2022-05-12 17:31:04'),
(1480, 'Bank Colony', 1, 1, 80, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:31:38', '2022-05-12 17:31:38'),
(1481, 'Chairman bari', 1, 1, 153, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:32:21', '2022-05-12 17:32:21'),
(1482, 'Manik Nagar Miyazan Lane', 1, 1, 80, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:32:47', '2022-05-12 17:32:47'),
(1483, 'Muradpur', 1, 1, 153, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:33:21', '2022-05-12 17:33:21'),
(1484, 'Lalmia Goli', 1, 1, 81, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:33:42', '2022-05-12 17:33:42'),
(1485, 'Komisoner road', 1, 1, 153, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:34:00', '2022-05-12 17:34:00'),
(1486, 'Hero Mia Road', 1, 1, 81, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:34:20', '2022-05-12 17:34:20'),
(1487, 'Jurain', 1, 1, 153, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:34:33', '2022-05-12 17:34:33'),
(1488, 'Chata Masjid', 1, 1, 81, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:34:57', '2022-05-12 17:34:57'),
(1489, 'Sona Mia Road', 1, 1, 81, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:35:27', '2022-05-12 17:35:27'),
(1490, 'Khaza Moinuddin cisty road', 1, 1, 153, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:35:37', '2022-05-12 17:35:37'),
(1491, 'Kodom Ali Jheelpar', 1, 1, 81, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:35:54', '2022-05-12 17:35:54'),
(1492, 'Alambag', 1, 1, 153, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:36:17', '2022-05-12 17:36:17'),
(1493, 'Green Model Town', 1, 1, 81, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:36:40', '2022-05-12 17:36:40'),
(1494, 'Mirhazirbag', 1, 1, 153, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:36:59', '2022-05-12 17:36:59'),
(1495, 'Mistir dokan', 1, 1, 153, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:37:31', '2022-05-12 17:37:31'),
(1496, 'Manda Garments', 1, 1, 81, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:37:39', '2022-05-12 17:37:39'),
(1497, 'Miru bazar', 1, 1, 153, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:37:59', '2022-05-12 17:37:59'),
(1498, 'Rajarbag', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:38:19', '2022-05-12 17:38:19'),
(1499, 'Rajarbag Mor', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:38:47', '2022-05-12 17:38:47'),
(1500, 'Alam market,  Shopping Mall', 1, 1, 153, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:38:52', '2022-05-12 17:38:52'),
(1501, 'Bagpara', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:39:24', '2022-05-12 17:39:24'),
(1502, 'Bikrompur Plaza', 1, 1, 153, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:39:36', '2022-05-12 17:39:36'),
(1503, 'Kalibari', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:39:54', '2022-05-12 17:39:54'),
(1504, 'Kusumbag', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:40:26', '2022-05-12 17:40:26'),
(1505, 'Dholairpar', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:40:42', '2022-05-12 17:40:42'),
(1506, 'Dakshingaon Bazar', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:41:19', '2022-05-12 17:41:19'),
(1507, 'Maya Kanon', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:41:51', '2022-05-12 17:41:51'),
(1508, 'Electricity power house, shyampur', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:42:22', '2022-05-12 17:42:22'),
(1509, 'Ahmedbag', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:42:26', '2022-05-12 17:42:26'),
(1510, 'Combined Military Hospital (CMH)', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:43:06', '2022-05-12 17:43:06'),
(1511, 'Ahmedbag Wasa Pump', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:43:39', '2022-05-12 17:44:54'),
(1512, 'Dhaka Washa', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:43:40', '2022-05-12 17:43:40'),
(1513, 'Post Office Road 01', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:43:56', '2022-05-12 17:43:56'),
(1514, 'Post Office Road 02', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:44:18', '2022-05-12 17:44:18'),
(1515, 'Post Office Road 03', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:44:46', '2022-05-12 17:44:46'),
(1516, 'Post Office Road 04', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:45:13', '2022-05-12 17:45:13'),
(1517, 'Post Office Road 05', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:45:35', '2022-05-12 17:45:35'),
(1518, 'Kodomtola 1st Lane', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:45:50', '2022-05-12 17:45:50'),
(1519, 'Post Office Road 06', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:45:57', '2022-05-12 17:45:57'),
(1520, 'Dhaka match', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:46:13', '2022-05-12 17:46:13'),
(1521, 'Post Office Road 07', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:46:26', '2022-05-12 17:46:26'),
(1522, 'Post Office Road 07', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:46:57', '2022-05-12 17:46:57'),
(1523, 'Post Office Road 08', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:47:22', '2022-05-12 17:47:22'),
(1524, 'Shyampur bot tola', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:47:23', '2022-05-12 17:47:23'),
(1525, 'Kodomtola Sky View Market', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:47:37', '2022-05-12 17:47:37'),
(1526, 'Post Office Road 09', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:47:45', '2022-05-12 17:47:45'),
(1527, 'Post Office Road 10', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:48:07', '2022-05-12 17:48:07'),
(1528, 'Kodomtola High School', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:48:15', '2022-05-12 17:48:15'),
(1529, 'Nama shyampur', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:48:23', '2022-05-12 17:48:23'),
(1530, 'Post Office Road 11', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:48:26', '2022-05-12 17:48:26'),
(1531, 'Stuff Road', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:48:50', '2022-05-12 17:48:50'),
(1532, 'Kodomtola Chayapoth', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:49:05', '2022-05-12 17:49:05'),
(1533, 'Nirjhor', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:49:21', '2022-05-12 17:49:21'),
(1534, 'D I T plot shyampur', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:49:25', '2022-05-12 17:49:25'),
(1535, 'Belayat Road', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:49:54', '2022-05-12 17:49:54'),
(1536, 'Kodomtola House Society', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:50:03', '2022-05-12 17:50:03'),
(1537, 'Shyampur bazar', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:50:06', '2022-05-12 17:50:06'),
(1538, 'Mostofa Kamal Lane', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:50:22', '2022-05-12 17:50:22'),
(1539, 'Madina Masjid Sarak', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:50:34', '2022-05-12 17:50:34'),
(1540, 'Ali bohor', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:50:39', '2022-05-12 17:50:39'),
(1541, 'Mannan Line', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:50:52', '2022-05-12 17:50:52'),
(1542, 'Alam market', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:51:23', '2022-05-12 17:51:23'),
(1543, 'Purbo Bashabo', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:51:24', '2022-05-12 17:51:24'),
(1544, 'Zia Colony', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:51:35', '2022-05-12 17:51:35'),
(1545, 'Ittadi Goli', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:52:00', '2022-05-12 17:52:00'),
(1546, 'Army Golf Club', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:52:14', '2022-05-12 17:52:14'),
(1547, 'Bikrompur Plaza', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:52:38', '2022-05-12 17:52:38'),
(1548, 'Patwary Goli', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:52:46', '2022-05-12 17:52:46'),
(1549, 'Kurmitola Medical College', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:52:47', '2022-05-12 17:52:47'),
(1550, 'Balughat', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:53:14', '2022-05-12 17:53:14'),
(1551, 'Jurain koborastan', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:53:16', '2022-05-12 17:53:16'),
(1552, 'Bnak Polly', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:53:25', '2022-05-12 17:53:25'),
(1553, 'MES', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:53:37', '2022-05-12 17:53:37'),
(1554, 'Postogola', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:53:48', '2022-05-12 17:53:48'),
(1555, 'Old  Airport', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:54:09', '2022-05-12 17:54:09'),
(1556, 'Moradpur medical road', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:54:34', '2022-05-12 17:54:34'),
(1557, 'Minara Goli', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:54:38', '2022-05-12 17:54:38'),
(1558, 'BAF Officers Mess', 1, 1, 152, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:54:43', '2022-05-12 17:54:43'),
(1559, 'Shyampur kacha bazar', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:55:20', '2022-05-12 17:55:20'),
(1560, 'Sarkarpara Club Goli', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:55:28', '2022-05-12 17:55:28'),
(1561, 'Rajabari', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:56:17', '2022-05-12 17:56:17'),
(1562, 'Ali bohor', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:56:33', '2022-05-12 17:56:33'),
(1563, 'Master Para', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:56:45', '2022-05-12 17:56:45'),
(1564, 'Madertak Chawrasta', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:56:59', '2022-05-12 17:56:59'),
(1565, 'Chan Para', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:57:20', '2022-05-12 17:57:20'),
(1566, 'Kudrot ali bazar', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:57:22', '2022-05-12 17:57:22'),
(1567, 'Moinar Tek', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:57:47', '2022-05-12 17:57:47'),
(1568, 'Uttarpara Baitulla Masjid', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:57:47', '2022-05-12 17:57:47'),
(1569, 'Mausaid', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:58:11', '2022-05-12 17:58:11'),
(1570, 'Uzampur', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:58:34', '2022-05-12 17:58:34'),
(1571, 'Moradpur boro madrasa road', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:58:39', '2022-05-12 17:58:39'),
(1572, 'Madertak Elahibag', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:58:43', '2022-05-12 17:58:43'),
(1573, 'Transmiter', 1, 1, 128, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:59:01', '2022-05-12 17:59:01'),
(1574, 'Moradpur high school road', 1, 1, 40, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:59:27', '2022-05-12 17:59:27'),
(1575, 'Madertak Natunpara', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 17:59:41', '2022-05-12 17:59:41'),
(1576, 'Pabna Goli', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:00:12', '2022-05-12 18:00:12'),
(1577, 'Tushar dhara', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:00:19', '2022-05-12 18:00:19'),
(1578, 'Baganbari', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:00:44', '2022-05-12 18:00:44'),
(1579, 'Chuyartek', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:00:49', '2022-05-12 18:00:49'),
(1580, 'Adorsho nagar', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:01:08', '2022-05-12 18:01:08'),
(1581, 'Army Society', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:01:28', '2022-05-12 18:01:28'),
(1582, 'Singapore Road', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:01:29', '2022-05-12 18:01:29'),
(1583, 'Chalaban', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:01:54', '2022-05-12 18:01:54'),
(1584, 'Shohid nogor', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:02:01', '2022-05-12 18:02:01'),
(1585, 'CNG Pump', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:02:20', '2022-05-12 18:02:20'),
(1586, 'Adharshapara', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:02:23', '2022-05-12 18:02:23'),
(1587, 'Matuali medical', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:02:50', '2022-05-12 18:02:50'),
(1588, 'Kacha Bazar', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:02:55', '2022-05-12 18:02:55'),
(1589, 'Boroitola', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:03:00', '2022-05-12 18:03:00'),
(1590, 'Faidabad Chowrasta', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:03:25', '2022-05-12 18:03:25'),
(1591, 'Dakshinkhan', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:03:55', '2022-05-12 18:03:55'),
(1592, 'Rayerbag solimolla school', 1, 1, 94, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:04:18', '2022-05-12 18:04:18'),
(1593, 'Koshai Bari', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:04:40', '2022-05-12 18:04:40'),
(1594, 'Sicily Germents Goli', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:04:46', '2022-05-12 18:04:46'),
(1595, 'Munshibag', 1, 1, 94, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:05:04', '2022-05-12 18:05:04'),
(1596, 'Prem Bagan', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:05:08', '2022-05-12 18:05:08'),
(1597, 'Mollar Tek', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:05:36', '2022-05-12 18:05:36'),
(1598, 'Holan', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:06:01', '2022-05-12 18:06:01'),
(1599, 'Anol', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:06:25', '2022-05-12 18:06:25'),
(1600, 'Krishi Bank Goli', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:07:04', '2022-05-12 18:07:04'),
(1601, 'Dewan City', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:07:17', '2022-05-12 18:07:17'),
(1602, 'Kodomtoli pakar matha', 1, 1, 94, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:07:35', '2022-05-12 18:07:35'),
(1603, 'Dewan Bari', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:07:44', '2022-05-12 18:07:44'),
(1604, 'Nandi Para Bridge', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:07:54', '2022-05-12 18:07:54'),
(1605, 'Gawair', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:08:08', '2022-05-12 18:08:08'),
(1606, 'Kadamtoli', 1, 1, 94, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:08:19', '2022-05-12 18:08:19'),
(1607, 'Pandit Para', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:08:34', '2022-05-12 18:08:34'),
(1608, 'Nandi Para', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:08:43', '2022-05-12 18:08:43'),
(1609, 'Mohommod bag', 1, 1, 94, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:08:57', '2022-05-12 18:08:57'),
(1610, 'Mollah Bari', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:09:15', '2022-05-12 18:09:15'),
(1611, 'Choto Bottola, Nandi Para', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:09:32', '2022-05-12 18:09:32'),
(1612, 'Meraj nogor A block,B block,C block', 1, 1, 94, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:10:35', '2022-05-12 18:10:35'),
(1613, 'Boro Bottola, Nandi Para', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:11:00', '2022-05-12 18:11:00'),
(1614, 'Rayerbag stand', 1, 1, 94, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:11:27', '2022-05-12 18:11:27'),
(1615, 'Jonotabag', 1, 1, 94, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:12:00', '2022-05-12 18:12:00'),
(1616, 'Nur Masjid, Nandi Para', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:12:06', '2022-05-12 18:12:06'),
(1617, 'Dakshingaon Jheelpar Masjid', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:14:42', '2022-05-12 18:14:42'),
(1618, 'Rayerbag gas road', 1, 1, 94, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:27:12', '2022-05-12 18:27:12'),
(1619, 'Dakshingaon Tajuddin School', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:27:19', '2022-05-12 18:27:19'),
(1620, 'Azi oshimoddin road', 1, 1, 94, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:27:52', '2022-05-12 18:27:52'),
(1621, 'Chapakhana, Nandipara', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:27:57', '2022-05-12 18:27:57'),
(1622, 'Modinabag', 1, 1, 94, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:28:23', '2022-05-12 18:28:23'),
(1623, 'Lal Masjid, Nandipara', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:28:45', '2022-05-12 18:28:45'),
(1624, 'Kodomtoli thana', 1, 1, 94, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:29:01', '2022-05-12 18:29:01'),
(1625, 'Apon bazar', 1, 1, 94, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:29:31', '2022-05-12 18:29:31'),
(1626, 'Newajbag', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:29:44', '2022-05-12 18:29:44'),
(1627, 'Muzahid nogor', 1, 1, 94, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:30:06', '2022-05-12 18:30:06'),
(1628, 'Shekher Jaiga', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:30:16', '2022-05-12 18:30:16'),
(1629, 'Habib nagor', 1, 1, 94, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:30:36', '2022-05-12 18:30:36'),
(1630, 'Rois nagor', 1, 1, 94, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:31:12', '2022-05-12 18:31:12'),
(1631, 'Moddho Bashabo', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:31:15', '2022-05-12 18:31:15'),
(1632, 'Uttar Bashabo', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:32:09', '2022-05-12 18:32:09'),
(1633, 'Chairman Bari', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:32:29', '2022-05-12 18:32:29'),
(1634, 'Dakshin Bashabo', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:32:41', '2022-05-12 18:32:41'),
(1635, 'Navana Tower', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:33:08', '2022-05-12 18:33:08'),
(1636, 'Joynal Market', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:33:23', '2022-05-12 18:33:23'),
(1637, 'Boubazar', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:33:43', '2022-05-12 18:33:43'),
(1638, 'Tic Colony', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:33:56', '2022-05-12 18:33:56'),
(1639, 'Tilpapara Culvert', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:34:16', '2022-05-12 18:34:16'),
(1640, 'Mojibor Market', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:34:36', '2022-05-12 18:34:36'),
(1641, 'Bashabo Wap Collony', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:35:04', '2022-05-12 18:35:04'),
(1642, 'Farid Market', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:35:05', '2022-05-12 18:35:05'),
(1643, 'Nodda Para', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:35:27', '2022-05-12 18:35:27'),
(1644, 'Tempu Stand', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:35:57', '2022-05-12 18:35:57'),
(1645, 'Ainus Bagh', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:36:01', '2022-05-12 18:36:01'),
(1646, 'Airport Railway Station', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:36:57', '2022-05-12 18:36:57'),
(1647, '10 Er Mor', 1, 1, 82, NULL, NULL, 1, 1, 1, 1, '2022-05-12 18:37:14', '2022-05-17 23:24:30'),
(1648, 'Choaritek', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:37:57', '2022-05-12 18:37:57'),
(1649, 'Faidabad', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:38:45', '2022-05-12 18:38:45'),
(1650, 'Commissionar er Goli', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:38:49', '2022-05-12 18:38:49'),
(1651, 'Bashabo Chaya bithi Housing', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:39:46', '2022-05-12 18:39:46'),
(1652, 'Arong Bashabo', 1, 1, 82, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:40:33', '2022-05-12 18:40:33'),
(1653, 'Mazar', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:41:12', '2022-05-12 18:41:12'),
(1654, 'Sarulia', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:41:37', '2022-05-12 18:41:37'),
(1655, 'Dakshinkhan Bazar', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:42:15', '2022-05-12 18:43:48'),
(1656, 'Dobadiya', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:46:11', '2022-05-12 18:46:11'),
(1657, 'Kanchkura', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:47:49', '2022-05-12 18:47:49'),
(1658, 'Rajarbag Polliceline Gate 1', 1, 1, 83, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:57:24', '2022-05-12 18:57:24'),
(1659, 'Zonaki Holler  Goli', 1, 1, 83, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:59:06', '2022-05-12 18:59:06'),
(1660, 'Bhashani Goli', 1, 1, 83, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 18:59:58', '2022-05-12 18:59:58'),
(1661, 'Chamelibag', 1, 1, 83, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:01:00', '2022-05-12 19:01:00'),
(1662, 'Sarder Bari', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:02:04', '2022-05-12 19:02:04'),
(1663, 'Betuli', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:02:45', '2022-05-12 19:02:45'),
(1664, 'Tetul Tola', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:03:10', '2022-05-12 19:03:10'),
(1665, 'Shial Danga', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:03:32', '2022-05-12 19:03:32'),
(1666, 'Pirshaheber Goli', 1, 1, 83, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:03:38', '2022-05-12 19:03:38'),
(1667, 'Bazar Road', 1, 1, 83, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:04:07', '2022-05-12 19:04:07'),
(1668, 'CAAB Quarter', 1, 1, 52, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:04:10', '2022-05-12 19:04:10'),
(1669, 'Eastern Plus Market', 1, 1, 83, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:04:47', '2022-05-12 19:04:47'),
(1670, 'Baily Road', 1, 1, 84, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:05:54', '2022-05-12 19:05:54'),
(1671, 'Shiddeshshwari Road', 1, 1, 84, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:06:37', '2022-05-12 19:06:37'),
(1672, 'Shiddeshshwari Lane', 1, 1, 84, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:07:14', '2022-05-12 19:07:14'),
(1673, 'Shiddeshshwari Circular Road', 1, 1, 84, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:08:03', '2022-05-12 19:08:03'),
(1674, 'Khondokar Goli', 1, 1, 84, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:08:49', '2022-05-12 19:08:49'),
(1675, 'Viqrunnesa Noon School & Collage', 1, 1, 84, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:09:51', '2022-05-12 19:09:51'),
(1676, 'Monowara Hospital', 1, 1, 84, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:10:31', '2022-05-12 19:10:31'),
(1677, 'KFC Goli', 1, 1, 84, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:12:47', '2022-05-12 19:12:47'),
(1678, 'Hare Road', 1, 1, 84, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:13:16', '2022-05-12 19:13:16'),
(1679, 'Circuit House', 1, 1, 84, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:13:48', '2022-05-12 19:13:48'),
(1680, 'Kali Mandir', 1, 1, 84, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:14:42', '2022-05-12 19:14:42'),
(1681, 'Mouchak Market', 1, 1, 84, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:15:18', '2022-05-12 19:15:18'),
(1682, 'Anarkoli Super Market', 1, 1, 84, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:16:06', '2022-05-12 19:16:06'),
(1683, 'Bicharpoti Bhaban', 1, 1, 84, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:16:48', '2022-05-12 19:16:48'),
(1684, 'Karnafuli Market', 1, 1, 84, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:24:24', '2022-05-12 19:24:24'),
(1685, 'Kakrail', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:31:05', '2022-05-12 19:31:05'),
(1686, 'Shegunbagicha', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:31:40', '2022-05-12 19:31:40'),
(1687, 'Rajashaya Bahaban', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:32:48', '2022-05-12 19:32:48'),
(1688, 'Rajashaya bhaban', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:36:40', '2022-05-12 19:36:40'),
(1689, 'Dudok office', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:37:24', '2022-05-12 19:37:24'),
(1690, 'Shilpo Bhaban', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:40:15', '2022-05-12 19:40:15'),
(1691, 'Bhutto Bhaban', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:41:14', '2022-05-12 19:41:14'),
(1692, 'Audit Bhaban', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:42:13', '2022-05-12 19:42:13'),
(1693, 'BMIT Bhaban', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:42:56', '2022-05-12 19:42:56'),
(1694, 'Department of Narcotics Control', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:43:57', '2022-05-12 19:43:57'),
(1695, 'Dhaka Reporters Unity', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:44:55', '2022-05-12 19:44:55'),
(1696, 'Birdem Hospital 2', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:45:35', '2022-05-12 19:45:35'),
(1697, 'Purtya Bahaban', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:46:13', '2022-05-12 19:46:13'),
(1698, 'Matshaya Bhaban', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:47:16', '2022-05-12 19:47:16'),
(1699, 'Jatio Grihayan Bhaban', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:52:42', '2022-05-12 19:52:42'),
(1700, 'Shram Bahaban', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:53:16', '2022-05-12 19:53:16'),
(1701, 'Agora Goli', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:53:56', '2022-05-12 19:53:56'),
(1702, 'NSI', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:54:30', '2022-05-12 19:54:30'),
(1703, 'Janoshastho Bhaban', 1, 1, 85, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:56:45', '2022-05-12 19:56:45'),
(1704, 'Panchokhola', 1, 1, 86, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:57:30', '2022-05-12 19:57:30'),
(1705, 'Fokirkhali', 1, 1, 86, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:58:21', '2022-05-12 19:58:21'),
(1706, 'Chinadi Bazar', 1, 1, 86, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 19:59:19', '2022-05-12 19:59:19'),
(1707, 'Beriad Boatghat', 1, 1, 86, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:00:18', '2022-05-12 20:00:18'),
(1708, 'Mogadiya Bazar', 1, 1, 86, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:00:56', '2022-05-12 20:00:56'),
(1709, 'Merul', 1, 1, 86, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:01:32', '2022-05-12 20:01:32'),
(1710, 'Kathaldiya', 1, 1, 86, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:02:05', '2022-05-12 20:02:05'),
(1711, 'Bagnbari', 1, 1, 86, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:02:45', '2022-05-12 20:02:45'),
(1712, 'Boro Beraid', 1, 1, 86, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:03:21', '2022-05-12 20:03:21'),
(1713, 'Choto Beraid', 1, 1, 86, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:03:58', '2022-05-12 20:03:58'),
(1714, 'Kali Mata Debi Mandir', 1, 1, 86, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:04:36', '2022-05-12 20:04:36'),
(1715, 'Beraid Bazar', 1, 1, 86, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:05:13', '2022-05-12 20:05:13'),
(1716, 'Motijheel', 1, 1, 33, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:05:52', '2022-05-12 20:05:52'),
(1717, 'Shapla Chottor', 1, 1, 33, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:06:45', '2022-05-12 20:06:45'),
(1718, 'Dilkusha', 1, 1, 33, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:07:14', '2022-05-12 20:07:14'),
(1719, 'DIT Avenue', 1, 1, 33, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:07:54', '2022-05-12 20:07:54'),
(1720, 'Health Engineering Dep (HED)', 1, 1, 33, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:08:48', '2022-05-12 20:08:48'),
(1721, 'BIWTA Bhaban', 1, 1, 33, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:09:35', '2022-05-12 20:09:35'),
(1722, 'Bangladesh Krishi Bnak Head Office', 1, 1, 33, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:10:23', '2022-05-12 20:10:23'),
(1723, 'Islami Bank Head office', 1, 1, 33, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:11:28', '2022-05-12 20:11:28'),
(1724, 'Metlife Bangladesh', 1, 1, 33, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:12:25', '2022-05-12 20:12:25'),
(1725, 'Motijheel Commercial Area', 1, 1, 33, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:13:21', '2022-05-12 20:13:21'),
(1726, 'Rajdhani Unnayan Kartipakkha', 1, 1, 33, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:15:55', '2022-05-12 20:15:55'),
(1727, 'Bangladesh Bank', 1, 1, 87, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:17:25', '2022-05-12 20:17:25'),
(1728, 'Arambagh', 1, 1, 87, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:18:07', '2022-05-12 20:18:07'),
(1729, 'Notre Dame university Collage', 1, 1, 87, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:18:56', '2022-05-12 20:18:56'),
(1730, 'Mohammedan Sporting Club', 1, 1, 87, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:20:05', '2022-05-12 20:20:05'),
(1731, 'Arambagh Girls High School and Collage', 1, 1, 87, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:21:18', '2022-05-12 20:21:18'),
(1732, 'Motijheel Police Station', 1, 1, 87, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:22:03', '2022-05-12 20:22:03'),
(1733, 'Kobi Jashim uddin Road', 1, 1, 87, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:22:53', '2022-05-12 20:22:53'),
(1734, 'Kamlapur Rail Station', 1, 1, 87, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:23:33', '2022-05-12 20:23:33'),
(1735, 'ICT Gate', 1, 1, 87, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:24:58', '2022-05-12 20:24:58'),
(1736, 'Bangladesh Bank Colony', 1, 1, 87, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:25:58', '2022-05-12 20:25:58'),
(1737, 'AGB Colony', 1, 1, 87, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:26:48', '2022-05-12 20:26:48'),
(1738, 'TNT Colony', 1, 1, 87, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:27:37', '2022-05-12 20:27:37'),
(1739, 'Ideal zone colony', 1, 1, 87, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:28:35', '2022-05-12 20:28:35'),
(1740, 'Ideal School', 1, 1, 87, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:29:14', '2022-05-12 20:29:14'),
(1741, 'Gulisthan', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:29:44', '2022-05-12 20:29:44'),
(1742, 'Bongo Bhaban', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:30:14', '2022-05-12 20:30:14'),
(1743, 'Baitul Mukarram', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:30:59', '2022-05-12 20:30:59'),
(1744, 'Stadium Market', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:31:42', '2022-05-12 20:31:42'),
(1745, 'North South', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:32:12', '2022-05-12 20:32:12'),
(1746, 'Kaptan Bazar', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:32:44', '2022-05-12 20:32:44'),
(1747, 'Bonogram Road/Lane', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:33:35', '2022-05-12 20:33:35'),
(1748, 'Juginagar', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:34:25', '2022-05-12 20:34:25'),
(1749, 'Chondra Mohan Basak Lane', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:35:12', '2022-05-12 20:35:12'),
(1750, 'Moha jon pur lane', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:35:58', '2022-05-12 20:35:58'),
(1751, 'Taherbag lane', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:36:39', '2022-05-12 20:36:39'),
(1752, 'Teker Hat Lane', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:37:59', '2022-05-12 20:37:59'),
(1753, 'Nawabpur Road', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:38:50', '2022-05-12 20:38:50'),
(1754, 'Malitola', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:39:40', '2022-05-12 20:39:40'),
(1755, 'Manoshi Cinema Hall', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:40:16', '2022-05-12 20:40:16'),
(1756, 'Shundarban Squre Market', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:41:14', '2022-05-12 20:41:14'),
(1757, 'Shundarban Squre Market', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:42:47', '2022-05-12 20:42:47'),
(1758, 'Trade Centre', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:43:37', '2022-05-12 20:43:37'),
(1759, 'BCC Road', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:44:12', '2022-05-12 20:44:12'),
(1760, 'Lalchn Mokim Lane', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:45:30', '2022-05-12 20:45:30'),
(1761, 'Golokpal Lane', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:46:06', '2022-05-12 20:46:06'),
(1762, 'Modon pal lane', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:46:42', '2022-05-12 20:46:42'),
(1763, 'Jhuriyatuli lane', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:47:44', '2022-05-12 20:47:44'),
(1764, 'Noyabpur', 1, 1, 88, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:48:32', '2022-05-12 20:48:32'),
(1765, 'Dainik  Bangla Mor', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:49:12', '2022-05-12 20:49:12'),
(1766, 'IFIC Tower', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:49:53', '2022-05-12 20:49:53'),
(1767, '55/B Purana Paltan, Dhaka 1000', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:50:42', '2022-05-12 20:50:42'),
(1768, 'Culvert Road', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:51:30', '2022-05-12 20:51:30'),
(1769, 'Bijoynagar (old), New -172 Shahid Syed Nazrul Islam Sarani,Dhaka 1000', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:53:22', '2022-05-12 20:53:22'),
(1770, 'Al Razi Complex 166-167,Dhaka-1000', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:54:27', '2022-05-12 20:54:27'),
(1771, 'Purana Paltan Line, Dhaka 1205', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:55:24', '2022-05-12 20:55:24'),
(1772, 'Topkhana Road, Dhaka 1205', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:56:27', '2022-05-12 20:56:27'),
(1773, 'Purana paltan, Madina Tower, 165 Shahid Syed Nazrul Islam Sarani, Dhaka 1000', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 20:58:50', '2022-05-12 20:58:50'),
(1774, 'Baitul View Tower, Paltan, Dhaka 1000', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:00:20', '2022-05-12 21:00:20'),
(1775, 'Noya Paltan', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:00:56', '2022-05-12 21:00:56'),
(1776, 'Paltan Line', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:01:45', '2022-05-12 21:01:45'),
(1777, 'Hotel 71', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:02:17', '2022-05-12 21:02:17'),
(1778, 'Paltan Tower', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:02:52', '2022-05-12 21:02:52'),
(1779, 'Ministry of Foreign Affairs', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:03:54', '2022-05-12 21:03:54'),
(1780, 'Ministry of Foreign Affairs', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:04:46', '2022-05-12 21:04:46'),
(1781, 'Press club', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:05:21', '2022-05-12 21:05:21'),
(1782, 'High court', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:05:57', '2022-05-12 21:05:57'),
(1783, 'Ministry office', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:06:34', '2022-05-12 21:06:34'),
(1784, 'Bijoy Nagar', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:07:33', '2022-05-12 21:07:33'),
(1785, 'BNP Party Office', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:08:23', '2022-05-12 21:08:23'),
(1786, 'Anondo vobon', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:08:56', '2022-05-12 21:08:56'),
(1787, 'Purana Paltan', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:09:29', '2022-05-12 21:09:29'),
(1788, 'Fokirapul', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:10:01', '2022-05-12 21:10:01'),
(1789, 'Rail Bahaban', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:10:52', '2022-05-12 21:10:52'),
(1790, 'Razarbag Police line', 1, 1, 34, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:11:54', '2022-05-12 21:11:54'),
(1791, 'Gopibag', 1, 1, 89, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:12:26', '2022-05-12 21:12:26'),
(1792, 'R.k mission road', 1, 1, 89, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:13:04', '2022-05-12 21:13:04');
INSERT INTO `areas` (`id`, `name`, `division_id`, `district_id`, `thana_id`, `deliverymen_id`, `pickupman_id`, `coverage`, `delivery_type`, `pickup`, `status`, `created_at`, `updated_at`) VALUES
(1793, 'K M Dash Lane', 1, 1, 89, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:13:50', '2022-05-12 21:13:50'),
(1794, 'Avoy dash lane', 1, 1, 89, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:14:47', '2022-05-12 21:14:47'),
(1795, 'Avoy dash lane', 1, 1, 89, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:14:52', '2022-05-12 21:14:52'),
(1796, 'Bhogo boti Benarji road', 1, 1, 89, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:15:41', '2022-05-12 21:15:41'),
(1797, 'Rose garden', 1, 1, 89, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:16:31', '2022-05-12 21:16:31'),
(1798, 'Hatkhola', 1, 1, 89, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:17:04', '2022-05-12 21:17:04'),
(1799, 'Rajdhani market', 1, 1, 89, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:17:42', '2022-05-12 21:17:42'),
(1800, 'ittefaq mor', 1, 1, 89, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:18:33', '2022-05-12 21:18:33'),
(1801, 'Sher E Bangla School', 1, 1, 89, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:19:15', '2022-05-12 21:19:15'),
(1802, 'Gopibag rail line', 1, 1, 89, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:19:52', '2022-05-12 21:19:52'),
(1803, 'Golapbag rail gate', 1, 1, 89, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:20:32', '2022-05-12 21:20:32'),
(1804, 'Tikatoli', 1, 1, 89, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:21:28', '2022-05-12 21:21:28'),
(1805, 'Tipu Sultans Road', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:22:34', '2022-05-12 21:22:34'),
(1806, 'Rankin Street', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:23:08', '2022-05-12 21:23:08'),
(1807, 'Nowab street', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:23:47', '2022-05-12 21:23:47'),
(1808, 'Chondi Choron bose street', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:24:49', '2022-05-12 21:24:49'),
(1809, 'Larmini street', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:26:22', '2022-05-12 21:26:22'),
(1810, 'Hair Street', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:27:14', '2022-05-12 21:27:14'),
(1811, 'Wire Street', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:27:57', '2022-05-12 21:27:57'),
(1812, 'A K sen lane', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:28:33', '2022-05-12 21:28:33'),
(1813, 'Gopikishan lane', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:35:17', '2022-05-12 21:35:17'),
(1814, 'North mosundi', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:36:08', '2022-05-12 21:36:08'),
(1815, 'Folder Street', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:36:45', '2022-05-12 21:36:45'),
(1816, 'Bhagwati Banerjee Road', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:37:41', '2022-05-12 21:37:41'),
(1817, 'Rupchan Lane', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:38:54', '2022-05-12 21:38:54'),
(1818, 'Bhojhari Saha Street', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:39:39', '2022-05-12 21:39:39'),
(1819, 'Haricharan roy Road', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:40:32', '2022-05-12 21:40:32'),
(1820, 'Methorpotty', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:41:24', '2022-05-12 21:41:24'),
(1821, 'Wari TSO', 1, 1, 46, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:42:06', '2022-05-12 21:42:06'),
(1822, 'Narinda Road', 1, 1, 90, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:42:42', '2022-05-12 21:42:42'),
(1823, 'Voter Goli', 1, 1, 90, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:43:14', '2022-05-12 21:43:14'),
(1824, 'Bhojhari Saha Street', 1, 1, 90, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:43:46', '2022-05-12 21:43:46'),
(1825, 'vogbot shah sankho Nidhi len', 1, 1, 90, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:44:49', '2022-05-12 21:44:49'),
(1826, 'Monir Hosen Lane', 1, 1, 90, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:45:41', '2022-05-12 21:45:41'),
(1827, 'Begamganj Lane', 1, 1, 90, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:46:23', '2022-05-12 21:46:23'),
(1828, 'Shorot gupta road', 1, 1, 90, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:47:21', '2022-05-12 21:47:21'),
(1829, 'Lalmohon saha street', 1, 1, 90, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:48:14', '2022-05-12 21:48:14'),
(1830, 'South Mosundi', 1, 1, 90, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:49:03', '2022-05-12 21:49:03'),
(1831, 'Shah Shaheb Lane', 1, 1, 90, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:49:51', '2022-05-12 21:49:51'),
(1832, 'Padma Nidhi len', 1, 1, 90, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:50:28', '2022-05-12 21:50:28'),
(1833, 'Jorpul len', 1, 1, 90, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:51:02', '2022-05-12 21:51:02'),
(1834, 'Sharat chandra chakraborty lane', 1, 1, 90, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:51:53', '2022-05-12 21:51:53'),
(1835, 'Shamibag', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 21:52:31', '2022-05-12 21:52:31'),
(1836, 'Al Amin Road', 1, 1, 104, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:11:16', '2022-05-12 23:11:16'),
(1837, 'Biruttom C.R Datta Road', 1, 1, 104, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:12:36', '2022-05-12 23:12:36'),
(1838, 'Pukurpar', 1, 1, 104, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:13:20', '2022-05-12 23:13:20'),
(1839, 'Box Culvert Road Kalababan', 1, 1, 104, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:14:23', '2022-05-12 23:14:23'),
(1840, 'Laki Hotel Goli', 1, 1, 104, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:15:08', '2022-05-12 23:15:08'),
(1841, 'Kathalbagan Bazar\\', 1, 1, 104, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:15:48', '2022-05-12 23:15:48'),
(1842, 'Kathalbagan Bazar', 1, 1, 104, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:15:52', '2022-05-12 23:15:52'),
(1843, 'Tiloker Goli', 1, 1, 104, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:16:31', '2022-05-12 23:16:31'),
(1844, 'Crescent Road', 1, 1, 104, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:17:35', '2022-05-12 23:17:35'),
(1845, 'Aziz Co-Operative market', 1, 1, 38, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:18:44', '2022-05-12 23:18:44'),
(1846, 'National Museum Shahbag', 1, 1, 38, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:20:19', '2022-05-12 23:20:19'),
(1847, 'Katabon Market', 1, 1, 38, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:21:13', '2022-05-12 23:21:13'),
(1848, 'Katabon Chowrasta', 1, 1, 38, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:22:05', '2022-05-12 23:22:05'),
(1849, 'Bata Signal', 1, 1, 38, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:22:44', '2022-05-12 23:22:44'),
(1850, 'General hospital Goli', 1, 1, 38, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:23:31', '2022-05-12 23:23:31'),
(1851, 'Vojjo Teler Goli', 1, 1, 38, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:25:59', '2022-05-12 23:25:59'),
(1852, 'BCSIR Quater Goli', 1, 1, 38, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:28:23', '2022-05-12 23:28:23'),
(1853, 'Hogh Mension Market', 1, 1, 38, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:29:48', '2022-05-12 23:29:48'),
(1854, 'Top Ten Goli', 1, 1, 38, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:31:10', '2022-05-12 23:31:10'),
(1855, 'Ziyan Resturant Goli', 1, 1, 38, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-12 23:31:59', '2022-05-12 23:31:59'),
(1856, 'Doyel Chottor', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:20:12', '2022-05-14 01:20:12'),
(1857, 'Shahid Minar', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:21:16', '2022-05-14 01:21:16'),
(1858, 'Fular Road', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:21:59', '2022-05-14 01:21:59'),
(1859, 'Polashi Market', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:29:10', '2022-05-14 01:29:10'),
(1860, 'Dokkhin Nilkhet', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:29:54', '2022-05-14 01:29:54'),
(1861, 'TSC', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:30:34', '2022-05-14 01:30:34'),
(1862, 'Dhaka Medical', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:31:16', '2022-05-14 01:31:16'),
(1863, 'Dhaka Medical Mohila Hostel', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:32:17', '2022-05-14 01:32:17'),
(1864, 'Raju Baskorjo', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:35:29', '2022-05-14 01:35:29'),
(1865, 'Rokeya Hall', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:36:33', '2022-05-14 01:36:33'),
(1866, 'Secretariat Road', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:37:58', '2022-05-14 01:37:58'),
(1867, 'Millon Chottor', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:38:57', '2022-05-14 01:38:57'),
(1868, 'Mukto Moncho', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:39:49', '2022-05-14 01:39:49'),
(1869, 'Madhur Canteen', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:40:47', '2022-05-14 01:40:47'),
(1870, 'Kabi Jasim Uddin Hall', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:41:35', '2022-05-14 01:41:35'),
(1871, 'Surjo Sen Hall', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:42:24', '2022-05-14 01:42:24'),
(1872, 'Dhaka University Market', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:43:10', '2022-05-14 01:43:10'),
(1873, 'Provost Quarter', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:44:23', '2022-05-14 01:44:23'),
(1874, 'Faculty of Business, Dhaka University', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:45:35', '2022-05-14 01:45:35'),
(1875, 'Kola Bhabon', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:46:21', '2022-05-14 01:46:21'),
(1876, 'Kazi Nazrul Islam Somadi Sowdho', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:49:16', '2022-05-14 01:49:16'),
(1877, 'Mohosin Hall', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:50:37', '2022-05-14 01:50:37'),
(1878, 'Bijoy Ekattor Hall', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:51:21', '2022-05-14 01:51:21'),
(1879, 'Nilkhet Police Fari', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:53:40', '2022-05-14 01:53:40'),
(1880, 'Zahir Rayhan Hall', 1, 1, 105, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:56:04', '2022-05-14 01:56:04'),
(1881, 'B K Ray Lane', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:57:02', '2022-05-14 01:57:02'),
(1882, 'Becharam Dewri', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 01:58:28', '2022-05-14 01:58:28'),
(1883, 'Golam Mostafa Lane', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:03:00', '2022-05-14 02:03:00'),
(1884, 'Begum Bazar', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:03:53', '2022-05-14 02:03:53'),
(1885, 'K Am Azam Lane', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:12:00', '2022-05-14 02:12:00'),
(1886, 'Hafizah Lane', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:12:43', '2022-05-14 02:12:43'),
(1887, 'Nurbox Lane', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:14:57', '2022-05-14 02:14:57'),
(1888, 'Ali Hossen Khan Road', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:15:55', '2022-05-14 02:15:55'),
(1889, 'Moulavi Bazar', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:17:00', '2022-05-14 02:17:00'),
(1890, 'Mukum Katara', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:17:59', '2022-05-14 02:17:59'),
(1891, 'Aga Nabab Dewri', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:19:37', '2022-05-14 02:19:37'),
(1892, 'Imam Gonj', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:21:07', '2022-05-14 02:21:07'),
(1893, 'Panghat', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:22:05', '2022-05-14 02:22:05'),
(1894, 'Chompatoli', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:22:54', '2022-05-14 02:22:54'),
(1895, 'Sowarighat', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:24:03', '2022-05-14 02:24:03'),
(1896, 'Boro Katara', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:24:48', '2022-05-14 02:24:48'),
(1897, 'Choto Katara', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:25:24', '2022-05-14 02:25:24'),
(1898, 'Habib Ullah Road', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:26:09', '2022-05-14 02:26:09'),
(1899, 'Chowkbazar', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:27:06', '2022-05-14 02:27:06'),
(1900, 'Urdu Road', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:27:45', '2022-05-14 02:27:45'),
(1901, 'Azgar Lane', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:28:24', '2022-05-14 02:28:24'),
(1902, 'Chrihatta Jame Mosjid', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:29:59', '2022-05-14 02:29:59'),
(1903, 'Haydar Box Lane', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:31:14', '2022-05-14 02:31:14'),
(1904, 'Dal Potti', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:31:53', '2022-05-14 02:31:53'),
(1905, 'Chak Circular Road', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:34:59', '2022-05-14 02:35:46'),
(1906, 'Zial Khana Road', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:37:18', '2022-05-14 02:37:18'),
(1907, 'Zail Khana Road', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:38:14', '2022-05-14 02:38:14'),
(1908, 'Hakim Habibur Rahman Road', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:42:49', '2022-05-14 02:42:49'),
(1909, 'Ganguli Lane', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:54:25', '2022-05-14 02:54:25'),
(1910, 'Midford', 1, 1, 20, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 02:59:23', '2022-05-14 02:59:23'),
(1911, 'Koratitola', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:07:11', '2022-05-14 16:07:11'),
(1912, 'Ideal School Jatrabari', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:07:59', '2022-05-14 16:07:59'),
(1913, 'Doya Gonj', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:08:30', '2022-05-14 16:08:30'),
(1914, 'Sohid faruk road', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:09:14', '2022-05-14 16:09:14'),
(1915, 'Dholpur', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:09:56', '2022-05-14 16:09:56'),
(1916, 'Nobi nagar', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:10:30', '2022-05-14 16:10:30'),
(1917, 'Dhonia', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:11:33', '2022-05-14 16:11:33'),
(1918, 'Shuruj Nagar', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:12:03', '2022-05-14 16:12:03'),
(1919, 'Biddut goli', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:12:36', '2022-05-14 16:12:36'),
(1920, 'Shekhpara', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:13:11', '2022-05-14 16:13:11'),
(1921, 'Jatrabarimor', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:13:53', '2022-05-14 16:13:53'),
(1922, 'Obda Colony', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:14:25', '2022-05-14 16:14:25'),
(1923, 'Jatrabari maser arot', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:14:57', '2022-05-14 16:14:57'),
(1924, 'kajla', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:15:25', '2022-05-14 16:15:25'),
(1925, 'Sontek', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:16:00', '2022-05-14 16:16:00'),
(1926, 'adorsho balika school road kajla', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:16:47', '2022-05-14 16:16:47'),
(1927, 'shekdi', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:17:20', '2022-05-14 16:17:20'),
(1928, 'gobindo pur', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:22:28', '2022-05-14 16:22:28'),
(1929, 'Saydabad tarminal', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:23:24', '2022-05-14 16:23:24'),
(1930, 'Jonopod mor', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:24:42', '2022-05-14 16:24:42'),
(1931, 'Kolar arot jatrabari', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:25:27', '2022-05-14 16:25:27'),
(1932, 'sohid zia girls school', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:26:26', '2022-05-14 16:26:26'),
(1933, 'Bibir bagicha-1,2,3,4 no gate', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:27:18', '2022-05-14 16:27:18'),
(1934, 'kajla uttor para', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:28:02', '2022-05-14 16:28:02'),
(1935, 'Vhanga press', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:28:49', '2022-05-14 16:28:49'),
(1936, 'Vhanga press', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:28:58', '2022-05-14 16:28:58'),
(1937, 'Chan mia road', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:29:45', '2022-05-14 16:29:45'),
(1938, 'Chagol er arot', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:30:24', '2022-05-14 16:30:24'),
(1939, 'Kazir daw', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:31:12', '2022-05-14 16:31:12'),
(1940, 'Shekhdi', 1, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:31:47', '2022-05-14 16:31:47'),
(1941, 'Saydabad hujur bari', 1, 1, 91, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:33:25', '2022-05-14 16:33:25'),
(1942, 'Golapbag mor', 1, 1, 91, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:34:14', '2022-05-14 16:34:14'),
(1943, 'Manik Nagar pukurpar', 1, 1, 91, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:35:17', '2022-05-14 16:35:17'),
(1944, 'Dholpur staff quater', 1, 1, 91, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:36:09', '2022-05-14 16:36:09'),
(1945, 'Miyajan lane', 1, 1, 91, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:36:43', '2022-05-14 16:36:43'),
(1946, 'RAB 10 dholpur', 1, 1, 91, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:37:19', '2022-05-14 16:37:19'),
(1947, 'Maninogor 6 tala', 1, 1, 91, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:38:10', '2022-05-14 16:38:10'),
(1948, '19 kata balur math', 1, 1, 91, NULL, NULL, 1, 1, 1, 1, '2022-05-14 16:38:58', '2022-05-19 17:48:01'),
(1949, 'maniknogor model school', 1, 1, 91, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:39:45', '2022-05-14 16:39:45'),
(1950, 'washa road', 1, 1, 91, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:40:25', '2022-05-14 16:40:25'),
(1951, 'Maniknogor main road', 1, 1, 91, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:41:14', '2022-05-14 16:41:14'),
(1952, 'golapbag', 1, 1, 91, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:41:52', '2022-05-14 16:41:52'),
(1953, 'Dholpur Bou Bazar', 1, 1, 92, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:42:49', '2022-05-14 16:42:49'),
(1954, 'khalikuzzaman school', 1, 1, 92, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:43:43', '2022-05-14 16:43:43'),
(1955, 'Licu bagan Dholpur', 1, 1, 92, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:44:45', '2022-05-14 16:44:45'),
(1956, 'Madrasa Road', 1, 1, 92, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:45:19', '2022-05-14 16:45:19'),
(1957, 'Badol sorder lane', 1, 1, 92, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:46:05', '2022-05-14 16:46:05'),
(1958, 'Dholpur community centre', 1, 1, 92, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:46:56', '2022-05-14 16:46:56'),
(1959, 'Kutub khali/kutub khali boro madrasha', 1, 1, 27, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:48:01', '2022-05-14 16:48:01'),
(1960, 'Rosul pur', 1, 1, 27, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:48:45', '2022-05-14 16:48:45'),
(1961, 'south dhoniya', 1, 1, 27, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:49:31', '2022-05-14 16:49:31'),
(1962, 'Puraton AK school road', 1, 1, 27, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:50:19', '2022-05-14 16:50:19'),
(1963, 'Dholaipar bazar', 1, 1, 27, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:51:10', '2022-05-14 16:51:10'),
(1964, 'Dholaipar nur bag', 1, 1, 27, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:52:07', '2022-05-14 16:52:07'),
(1965, 'Ziya shoroni road', 1, 1, 93, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:52:49', '2022-05-14 16:52:49'),
(1966, 'Polashpur', 1, 1, 93, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:53:20', '2022-05-14 16:53:20'),
(1967, 'Gas road', 1, 1, 93, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:54:00', '2022-05-14 16:54:00'),
(1968, 'Japani bazar', 1, 1, 93, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:54:35', '2022-05-14 16:54:35'),
(1969, '24 feet', 1, 1, 93, NULL, NULL, 1, 1, 1, 1, '2022-05-14 16:55:28', '2022-05-19 21:39:46'),
(1970, 'Jiya shoroni bridge', 1, 1, 93, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:56:20', '2022-05-14 16:56:20'),
(1971, 'paterbag', 1, 1, 93, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:58:36', '2022-05-14 16:58:36'),
(1972, 'nur pur', 1, 1, 93, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:59:11', '2022-05-14 16:59:11'),
(1973, 'Bank Colony', 1, 1, 93, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 16:59:43', '2022-05-14 16:59:43'),
(1974, 'New AK school', 1, 1, 93, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:00:29', '2022-05-14 17:00:29'),
(1975, 'Dhoniya club', 1, 1, 93, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:01:16', '2022-05-14 17:01:16'),
(1976, 'Goyal barir mor', 1, 1, 93, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:01:55', '2022-05-14 17:01:55'),
(1977, 'dhoniya collage', 1, 1, 93, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:02:50', '2022-05-14 17:02:50'),
(1978, 'Ahsan Manjil', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:05:13', '2022-05-14 17:05:13'),
(1979, 'Goalghat', 1, 1, 41, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:05:57', '2022-05-14 17:05:57'),
(1980, 'Badsha mia road', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:07:38', '2022-05-14 17:07:38'),
(1981, 'Muslim nogor', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:09:15', '2022-05-14 17:09:15'),
(1982, 'Shohor polli', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:09:56', '2022-05-14 17:09:56'),
(1983, 'Mogol nogor', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:10:33', '2022-05-14 17:10:33'),
(1984, 'Kodomtoli chow rasta', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:11:24', '2022-05-14 17:11:24'),
(1985, 'Collage road', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:12:03', '2022-05-14 17:12:03'),
(1986, 'Lotib mia collage', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:12:44', '2022-05-14 17:12:44'),
(1987, 'Inu Potti', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:13:18', '2022-05-14 17:13:18'),
(1988, 'Keranipara', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:13:55', '2022-05-14 17:13:55'),
(1989, 'hasem road', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:14:38', '2022-05-14 17:14:38'),
(1990, 'South rayerbag gas road', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:15:28', '2022-05-14 17:15:28'),
(1991, 'Khanbari 4 rastha', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:16:31', '2022-05-14 17:16:31'),
(1992, 'Rofikul islam road', 1, 1, 95, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:17:20', '2022-05-14 17:17:20'),
(1993, 'Mirdhabari', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:18:14', '2022-05-14 17:18:14'),
(1994, 'Madrasha bazar', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:19:03', '2022-05-14 17:19:03'),
(1995, 'Shorif para', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:20:01', '2022-05-14 17:20:01'),
(1996, 'councile office', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:20:50', '2022-05-14 17:20:50'),
(1997, 'Matuali koborsthan', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:21:34', '2022-05-14 17:21:34'),
(1998, 'Matuali high school', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:22:14', '2022-05-14 17:22:14'),
(1999, 'Molla Bridge', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:22:51', '2022-05-14 17:22:51'),
(2000, 'Mendi bari', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:23:30', '2022-05-14 17:23:30'),
(2001, 'Katherpul', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:24:05', '2022-05-14 17:24:05'),
(2002, 'Golden bridge', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:24:45', '2022-05-14 17:24:45'),
(2003, 'Kona para stand', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:25:25', '2022-05-14 17:25:25'),
(2004, 'Dharmik para', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:26:00', '2022-05-14 17:26:00'),
(2005, 'Baserpul', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:26:45', '2022-05-14 17:26:45'),
(2006, 'Konapara farmer mor', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:27:25', '2022-05-14 17:27:25'),
(2007, 'Dogai bazar', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:28:09', '2022-05-14 17:28:09'),
(2008, 'Bamoil', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:29:16', '2022-05-14 17:29:16'),
(2009, 'Adorsho bag', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:29:56', '2022-05-14 17:29:56'),
(2010, 'Boro vanga', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:30:35', '2022-05-14 17:30:35'),
(2011, 'Staff Quater,Demra', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:31:31', '2022-05-14 17:31:31'),
(2012, 'Tarabo bazar', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:32:23', '2022-05-14 17:32:23'),
(2013, 'Chonpara Bridge', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:33:07', '2022-05-14 17:33:07'),
(2014, 'Demra bazar', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:33:47', '2022-05-14 17:33:47'),
(2015, 'Sharuliya bazar', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:34:41', '2022-05-14 17:34:41'),
(2016, 'Box nogor', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:35:16', '2022-05-14 17:35:16'),
(2017, 'Sharuliya rani mohol', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:35:55', '2022-05-14 17:35:55'),
(2018, 'Gola kata bridge', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:36:28', '2022-05-14 17:36:28'),
(2019, 'Shukoroshi bazar', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:37:50', '2022-05-14 17:37:50'),
(2020, 'Shukoroshi Grabiyard', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:38:42', '2022-05-14 17:38:42'),
(2021, 'Municipal Staff Quarter', 1, 1, 21, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:39:41', '2022-05-14 17:39:41'),
(2022, 'Khaje Dewan 1st lane', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:40:31', '2022-05-14 17:42:27'),
(2023, 'Khaje Dewan 2nd lane', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:41:27', '2022-05-14 17:41:27'),
(2024, 'Rohimbox Lane', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:43:05', '2022-05-14 17:43:05'),
(2025, 'Kellarmor', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:43:54', '2022-05-14 17:43:54'),
(2026, 'Dhakeshwari Road', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:45:01', '2022-05-14 17:45:01'),
(2027, 'Lalbagh Road', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:45:49', '2022-05-14 17:45:49'),
(2028, 'Shaistha Khan road', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:46:42', '2022-05-14 17:46:42'),
(2029, 'Royel Lane', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:47:15', '2022-05-14 17:47:15'),
(2030, 'Kamrangirchor', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:47:54', '2022-05-14 17:47:54'),
(2031, 'Devidas Ghat Lane', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:48:43', '2022-05-14 17:48:43'),
(2032, 'Posta', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:49:19', '2022-05-14 17:49:19'),
(2033, 'Rahmatganj', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:49:51', '2022-05-14 17:49:51'),
(2034, 'Hosseni Dalan', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:50:42', '2022-05-14 17:50:42'),
(2035, 'Chotokatra', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:51:44', '2022-05-14 17:51:44'),
(2036, 'borokatra', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:52:34', '2022-05-14 17:52:34'),
(2037, 'Shatrawza', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:53:18', '2022-05-14 17:53:18'),
(2038, 'Education Board', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:54:01', '2022-05-14 17:54:01'),
(2039, 'Kashmirtola', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:54:53', '2022-05-14 17:54:53'),
(2040, 'Karim Bag', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:55:30', '2022-05-14 17:55:30'),
(2041, 'Rajni Chowdhury Road', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:56:10', '2022-05-14 17:56:10'),
(2042, 'Shoarighat', 1, 1, 32, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:56:54', '2022-05-14 17:56:54'),
(2043, 'Bc Das Street', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:57:49', '2022-05-14 17:57:49'),
(2044, 'Jogonnath Saha Road', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:58:49', '2022-05-14 17:58:49'),
(2045, 'Amligola', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:59:34', '2022-05-14 17:59:34'),
(2046, 'Amligola', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 17:59:41', '2022-05-14 17:59:41'),
(2047, 'Hojrot bag', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 18:00:31', '2022-05-14 18:00:31'),
(2048, 'Sheikh Shaheb Bazar Road', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 18:01:37', '2022-05-14 18:01:37'),
(2049, 'Khan mohammad Masjid', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 18:02:20', '2022-05-14 18:02:20'),
(2050, 'Raza Sreenath Street, Dhaka', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 18:03:44', '2022-05-14 18:03:44'),
(2051, 'Shohidnogor Lalbagh', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 18:04:32', '2022-05-14 18:04:32'),
(2052, 'Shoshan Ghat Lalbagh', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 18:05:27', '2022-05-14 18:05:27'),
(2053, 'Balu Ghat', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 18:06:03', '2022-05-14 18:06:03'),
(2054, 'Kashmiri Tola Lane', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 18:07:08', '2022-05-14 18:07:08'),
(2055, 'Choto bhatt Masjid', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 18:07:52', '2022-05-14 18:07:52'),
(2056, 'Abdul Aziz Lane', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 18:08:28', '2022-05-14 18:08:28'),
(2057, 'R.N.D Road', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 18:09:13', '2022-05-14 18:09:13'),
(2058, 'Gongram Bazar', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 18:10:07', '2022-05-14 18:10:07'),
(2059, 'Nogor beltola Lane', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 18:10:56', '2022-05-14 18:10:56'),
(2060, 'Dhuri Angul', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 18:11:54', '2022-05-14 18:11:54'),
(2061, 'rasulbag', 1, 1, 96, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-14 18:12:31', '2022-05-14 18:12:31'),
(2062, 'Section', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 19:19:57', '2022-05-15 19:19:57'),
(2063, 'Lolit mohon das lane', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 19:22:05', '2022-05-15 19:22:05'),
(2064, 'Enayetgonj', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 19:24:43', '2022-05-15 19:24:43'),
(2065, 'Gonoktoli Lane', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 19:25:41', '2022-05-15 19:25:41'),
(2066, 'Q.G. Samdani & Co and Cng Filling Station', 1, 1, 100, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 19:26:05', '2022-05-15 19:26:05'),
(2067, 'Baghalpur', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 19:27:01', '2022-05-15 19:27:01'),
(2068, 'Hatirghat,Section', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 19:28:04', '2022-05-15 19:28:04'),
(2069, 'Companyghat', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 19:28:51', '2022-05-15 19:28:51'),
(2070, 'Baddanogor', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 19:46:16', '2022-05-15 19:46:16'),
(2071, 'New Market Police Station', 1, 1, 100, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 19:49:23', '2022-05-15 19:49:23'),
(2072, 'National Academy For Planning And Development', 1, 1, 100, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 19:51:54', '2022-05-15 19:51:54'),
(2073, 'Nilkhet kirmojibi mohila hostel', 1, 1, 100, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 19:54:13', '2022-05-15 19:54:13'),
(2074, 'Nilkhet Book Market', 1, 1, 100, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 19:54:54', '2022-05-15 19:54:54'),
(2075, 'Badruddoza Super market', 1, 1, 100, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 19:57:51', '2022-05-15 19:57:51'),
(2076, 'New Market Thana', 1, 1, 100, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 19:58:53', '2022-05-15 19:58:53'),
(2077, 'Balaka Cinema Hall Market', 1, 1, 100, NULL, NULL, 1, 1, 0, 1, '2022-05-15 19:59:55', '2022-05-19 17:51:22'),
(2078, 'Chandni Chwak Shopping complex', 1, 1, 100, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 20:01:35', '2022-05-15 20:01:35'),
(2079, 'Babupara Market', 1, 1, 100, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 20:02:16', '2022-05-15 20:02:16'),
(2080, 'Gawsul Azom Super Market', 1, 1, 100, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 20:03:09', '2022-05-15 20:03:09'),
(2081, 'Ali Alaka', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:05:40', '2022-05-15 21:05:40'),
(2082, 'Monessor Road,Hazaribag', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:06:40', '2022-05-15 21:06:40'),
(2083, 'Bdr 5No Gate', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:07:43', '2022-05-15 21:07:43'),
(2084, 'Leather Collage', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:08:45', '2022-05-15 21:08:45'),
(2085, 'Shikaritola', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:11:08', '2022-05-15 21:11:08'),
(2086, 'Nobipur', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:11:49', '2022-05-15 21:11:49'),
(2087, 'Bashtolal Goli,Bdr 5No Gate', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:12:45', '2022-05-15 21:12:45'),
(2088, 'Hazaribag Beribad', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:13:46', '2022-05-15 21:13:46'),
(2089, 'Kalunogor Golden City', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:14:38', '2022-05-15 21:14:38'),
(2090, 'Zawchor', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:15:11', '2022-05-15 21:15:11'),
(2091, 'Zawchor Bhuiyan Street', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:15:59', '2022-05-15 21:15:59'),
(2092, 'Kazirbag', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:16:33', '2022-05-15 21:16:33'),
(2093, 'Kulalmohol', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:17:08', '2022-05-15 21:18:20'),
(2094, 'Burhanpur', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:19:20', '2022-05-15 21:19:20'),
(2095, 'Kalunogor', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:20:05', '2022-05-15 21:20:05'),
(2096, 'Bottola,Hazaribag', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:20:52', '2022-05-15 21:20:52'),
(2097, 'Amra Tower Goli', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:21:28', '2022-05-15 21:21:28'),
(2098, 'Shahjahan Market', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:22:11', '2022-05-15 21:22:11'),
(2099, 'Gudaraghat,Zawchor', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:22:58', '2022-05-15 21:22:58'),
(2100, 'Zawchor Lononer Goli', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:24:59', '2022-05-15 21:24:59'),
(2101, 'Enayetgonj Lane', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:25:45', '2022-05-15 21:25:45'),
(2102, 'Sher E Bangla Road,Hazaribag', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:26:37', '2022-05-15 21:26:37'),
(2103, 'Vogolpur Lane', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:27:42', '2022-05-15 21:27:42'),
(2104, 'Hazaribag Road', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:28:28', '2022-05-15 21:28:28'),
(2105, 'Gajmohol', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:29:07', '2022-05-15 21:29:07'),
(2106, 'Mc Roy Lane', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:30:06', '2022-05-15 21:30:06'),
(2107, 'Somatar Goli', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:30:41', '2022-05-15 21:30:41'),
(2108, 'Hazaribag Model Town', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:31:43', '2022-05-15 21:31:43'),
(2109, 'Nelambor Saha Road', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:32:31', '2022-05-15 21:32:31'),
(2110, 'Gajmohol Puran Thana', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:33:21', '2022-05-15 21:33:21'),
(2111, 'Tanary Mor', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:34:18', '2022-05-15 21:34:18'),
(2112, 'Kajirbag', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:35:05', '2022-05-15 21:35:05'),
(2113, 'Hazaribag Golden City', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:36:14', '2022-05-15 21:36:14'),
(2114, 'BGB 1 NO Gate', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:37:02', '2022-05-15 21:37:02'),
(2115, 'Jauchar Lobon Factory', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:37:53', '2022-05-15 21:37:53'),
(2116, 'Haji Abdul Awal Road,Jawchar', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:38:42', '2022-05-15 21:38:42'),
(2117, 'Hazaribag Bazar', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:40:01', '2022-05-15 21:40:01'),
(2118, 'Kalunagar', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:41:34', '2022-05-15 21:41:34'),
(2119, 'Baddanogor Panir Tank', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:42:48', '2022-05-15 21:42:48'),
(2120, 'Nobipur Lane,Hazaribag', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:43:31', '2022-05-15 21:43:31'),
(2121, 'Gonoktuli', 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-15 21:44:26', '2022-05-15 21:44:26'),
(2122, 'Zigatola Bus Stand', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:23:49', '2022-05-16 15:23:49'),
(2123, 'BGB 4 NO Gate', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:24:41', '2022-05-16 15:24:41'),
(2124, 'Abdul Hatem Lane', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:25:23', '2022-05-16 15:25:23'),
(2125, 'Jigatola Post Office Road', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:26:06', '2022-05-16 15:26:06'),
(2126, 'Kazi Nazimuddin Lane', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:26:51', '2022-05-16 15:26:51'),
(2127, 'Puranton Kacha Bazar', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:30:14', '2022-05-16 15:30:14'),
(2128, 'Munshi Bari Road', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:30:58', '2022-05-16 15:30:58'),
(2129, 'Abdul Hai Road', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:31:48', '2022-05-16 15:31:48'),
(2130, 'Syleti Para', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:32:42', '2022-05-16 15:32:42'),
(2131, '96 Goli', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:33:16', '2022-05-16 15:33:16'),
(2132, 'Tin Mazar Mosjid Goli', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:34:15', '2022-05-16 15:34:15'),
(2133, 'Jigatola Tenarry Mor', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:35:29', '2022-05-16 15:35:29'),
(2134, 'Tolla Bag', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:36:23', '2022-05-16 15:36:23'),
(2135, 'Sher E Bangla Road,Teranimor', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:37:29', '2022-05-16 15:37:29'),
(2136, 'Sonatonghor', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:38:13', '2022-05-16 15:38:13'),
(2137, 'Shikder Real State', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:38:52', '2022-05-16 15:38:52'),
(2138, 'Shikder Medical', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:39:38', '2022-05-16 15:39:38'),
(2139, 'Gabtola Masjid', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:40:16', '2022-05-16 15:40:16'),
(2140, 'Monassor Road', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:43:12', '2022-05-16 15:43:12'),
(2141, 'Monassor Road', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:43:13', '2022-05-16 15:43:13'),
(2142, 'Hazaribag Notun Thana', 1, 1, 97, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:44:04', '2022-05-16 15:44:04'),
(2143, 'Azimpur Bus stand', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:44:53', '2022-05-16 15:44:53'),
(2144, 'Azimpur Chapra Masjid', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:45:56', '2022-05-16 15:45:56'),
(2145, 'Azimpur Bottola', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:47:53', '2022-05-16 15:47:53'),
(2146, 'Azimpur Koborsthan', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:49:03', '2022-05-16 15:49:03'),
(2147, 'Azimpur Staff Quarter', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:53:11', '2022-05-16 15:53:11'),
(2148, 'Pilkhana Road', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:54:13', '2022-05-16 15:54:13'),
(2149, 'BGB 2 NO Gate', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:55:19', '2022-05-16 15:55:19'),
(2150, 'BGB 1 NO Gate', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:55:52', '2022-05-16 15:55:52'),
(2151, 'BGB 3 NO Gate', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:56:31', '2022-05-16 15:56:31'),
(2152, 'New Polton', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:57:09', '2022-05-16 15:57:09'),
(2153, 'Bcs Chottor', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:57:49', '2022-05-16 15:57:49'),
(2154, 'Chaina Building R Goli', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:58:29', '2022-05-16 15:58:29'),
(2155, 'Azimpur Metani', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:59:01', '2022-05-16 15:59:01'),
(2156, 'Azimpur Yatimkhana', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 15:59:42', '2022-05-16 15:59:42'),
(2157, 'Azimpur Post Office', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:00:46', '2022-05-16 16:00:46'),
(2158, 'Azimpur Community Centre', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:01:28', '2022-05-16 16:01:28'),
(2159, 'Iraqi Play Gound', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:02:15', '2022-05-16 16:02:15'),
(2160, 'Bdr 3No Gate', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:03:08', '2022-05-16 16:03:08'),
(2161, 'Choto Dayera Sharif Dayemiya Masjid', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:04:23', '2022-05-16 16:04:23'),
(2162, 'Azimpur Model Government Primary', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:05:25', '2022-05-16 16:05:25'),
(2163, 'Dc Traffic Office Azimpur', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:06:16', '2022-05-16 16:06:16'),
(2164, 'New Polton Kazi Office', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:07:22', '2022-05-16 16:07:22'),
(2165, 'Azimpur Garveyard', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:08:03', '2022-05-16 16:08:03'),
(2166, 'Azimpur Graveyard', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:08:08', '2022-05-16 16:08:08'),
(2167, 'Azimpur Graveyard', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:08:08', '2022-05-16 16:08:08'),
(2168, 'Azimpur Graveyard', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:08:08', '2022-05-16 16:08:08'),
(2169, 'Azimpur Graveyard', 1, 1, 98, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:08:12', '2022-05-16 16:08:12'),
(2170, 'Green Swarnika Shopping Mall', 1, 1, 99, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:09:34', '2022-05-16 16:09:34'),
(2171, 'Gausia Market', 1, 1, 99, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:10:14', '2022-05-16 16:10:14'),
(2172, 'Elephant Road Aeroplane Masjid', 1, 1, 99, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:11:17', '2022-05-16 16:11:17'),
(2173, 'basundhara Goli', 1, 1, 99, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:52:25', '2022-05-16 16:52:25'),
(2174, 'Nurjahan Market', 1, 1, 99, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:56:02', '2022-05-16 16:56:02'),
(2175, 'Ismail Mansion Supermarket', 1, 1, 99, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 16:57:56', '2022-05-16 16:57:56'),
(2176, 'Meghna Petrol Pump', 1, 1, 99, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:00:25', '2022-05-16 17:00:25'),
(2177, 'priyangan Shopping Centre', 1, 1, 99, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:01:19', '2022-05-16 17:01:19'),
(2178, 'Ucc Science Lab', 1, 1, 99, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:01:58', '2022-05-16 17:01:58'),
(2179, 'Eastern Mollika Shopping Complex', 1, 1, 99, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:02:59', '2022-05-16 17:02:59'),
(2180, 'Meena Bazar Newmarket', 1, 1, 99, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:03:58', '2022-05-16 17:03:58'),
(2181, 'Rajdhani market, Newmarket', 1, 1, 99, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:04:48', '2022-05-16 17:04:48'),
(2182, 'Jamia Shbania Darul Ulom Madrasha Goli, Newmarket', 1, 1, 99, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:06:56', '2022-05-16 17:06:56'),
(2183, 'Jamia Shbania Darul Ulom Madrasha Goli, Newmarket', 1, 1, 99, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:14:57', '2022-05-16 17:14:57'),
(2184, 'Nurani Market', 1, 1, 99, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:15:33', '2022-05-16 17:15:33'),
(2185, 'Biswas Builders New Market', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:17:23', '2022-05-16 17:17:23'),
(2186, 'New Super Market', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:19:07', '2022-05-16 17:19:07'),
(2187, 'Chandrima Super Market', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:19:49', '2022-05-16 17:19:49'),
(2188, 'Bonolota super Market', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:20:31', '2022-05-16 17:20:31'),
(2189, 'Bcs Quater', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:21:09', '2022-05-16 17:21:09'),
(2190, 'Post Office Gate', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:22:40', '2022-05-16 17:22:40'),
(2191, 'Newmarket 1No Gate', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:23:26', '2022-05-16 17:23:26'),
(2192, 'Newmarket 1 No Gate', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:23:35', '2022-05-16 17:23:35'),
(2193, 'Newmarket 2 No Gate', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:24:10', '2022-05-16 17:24:10'),
(2194, 'Newmarket 3 No Gate', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:25:12', '2022-05-16 17:25:12'),
(2195, 'Dhaka Collage', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:25:43', '2022-05-16 17:25:43'),
(2196, 'Naem Road', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:26:16', '2022-05-16 17:26:16'),
(2197, 'Naem Road', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:26:17', '2022-05-16 17:26:17'),
(2198, 'Globe Shopping Centre,New Market', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:27:04', '2022-05-16 17:27:04'),
(2199, 'Mistir Goli', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:27:35', '2022-05-16 17:27:35'),
(2200, 'Bottola New Market Dhaka', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:28:19', '2022-05-16 17:28:19'),
(2201, 'Main Gate Of New Market', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:29:03', '2022-05-16 17:29:03'),
(2202, 'Moriom bibi Shahi Mosque', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:29:56', '2022-05-16 17:29:56'),
(2203, 'Sandhani Eye  Hospital', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:30:39', '2022-05-16 17:30:39'),
(2204, 'Sj Jahanara Imam Sarani Newmarket', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:32:01', '2022-05-16 17:32:01'),
(2205, 'National Academy For Educational Management *(NAEM)', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:34:23', '2022-05-16 17:34:23'),
(2206, 'National Academy For Educational Management (NAEM)', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:34:31', '2022-05-16 17:34:31'),
(2207, 'Meghna Petrol Pump Newmarket', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:36:58', '2022-05-16 17:36:58'),
(2208, 'Shahnewaz Hall Dhaka University', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:38:20', '2022-05-16 17:38:20'),
(2209, 'Bangamata Sheikh Fazilatunnesa mujib Hall', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:40:58', '2022-05-16 17:40:58'),
(2210, 'Bdr  Gate 3 (Bir Uttam Habibur Rahman Gate)', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:43:11', '2022-05-16 17:43:11'),
(2211, 'Govt Teacher Training Collage Dhaka', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:44:20', '2022-05-16 17:44:20'),
(2212, 'New Market Baitul Aman Jame Masjid', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:45:32', '2022-05-16 17:45:32'),
(2213, 'Dhaka New Market Byabshahi Somiti', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:48:05', '2022-05-16 17:48:05'),
(2214, 'New Market Mor', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:48:45', '2022-05-16 17:48:45'),
(2215, 'Duet Bus Stand Goli (New Market)', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:50:07', '2022-05-16 17:50:07'),
(2216, 'Bangladesh-Kuwait Friendship Hall', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:51:19', '2022-05-16 17:51:19'),
(2217, 'Pilkhana Road', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:52:06', '2022-05-16 17:52:06'),
(2218, 'Elephant Road', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:52:56', '2022-05-16 17:52:56'),
(2219, 'Kataban', 1, 1, 14, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:53:37', '2022-05-16 17:53:37'),
(2220, 'Sj Jahanara Imam Sarani', 1, 1, 101, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-16 17:54:18', '2022-05-16 17:54:18'),
(2221, 'Hazz Camp', 1, 1, 129, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 15:57:49', '2022-05-17 15:57:49'),
(2222, 'Parvin Hotel', 1, 1, 129, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 15:58:31', '2022-05-17 15:58:31'),
(2223, 'Al Huda Masjid', 1, 1, 129, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 15:59:08', '2022-05-17 15:59:08');
INSERT INTO `areas` (`id`, `name`, `division_id`, `district_id`, `thana_id`, `deliverymen_id`, `pickupman_id`, `coverage`, `delivery_type`, `pickup`, `status`, `created_at`, `updated_at`) VALUES
(2224, 'Islami Bank', 1, 1, 129, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 15:59:39', '2022-05-17 15:59:39'),
(2225, 'Shahjalal Bank', 1, 1, 129, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:00:11', '2022-05-17 16:00:11'),
(2226, 'Sonali Garden', 1, 1, 129, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:00:46', '2022-05-17 16:00:46'),
(2227, 'Medical Road', 1, 1, 129, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:01:14', '2022-05-17 16:01:14'),
(2228, 'Uchartek Mor', 1, 1, 129, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:01:54', '2022-05-17 16:01:54'),
(2229, 'Ashkona College Road', 1, 1, 129, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:02:25', '2022-05-17 16:02:25'),
(2230, 'Rasul Bag', 1, 1, 129, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:02:56', '2022-05-17 16:02:56'),
(2231, 'City Complex', 1, 1, 129, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:03:21', '2022-05-17 16:03:21'),
(2232, 'Ashkona Primary School', 1, 1, 129, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:07:06', '2022-05-17 16:07:06'),
(2233, 'Ashkona Panir Pump', 1, 1, 129, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:07:33', '2022-05-17 16:07:33'),
(2234, 'Macher Arrot', 1, 1, 129, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:08:08', '2022-05-17 16:08:08'),
(2235, 'Rupali Garden', 1, 1, 129, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:08:40', '2022-05-17 16:08:40'),
(2236, 'Taltola', 1, 1, 129, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:09:11', '2022-05-17 16:09:11'),
(2237, 'Pakuriya', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:10:16', '2022-05-17 16:10:16'),
(2238, 'Ahaliya', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:14:57', '2022-05-17 16:14:57'),
(2239, 'Habib Market', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:15:23', '2022-05-17 16:15:23'),
(2240, 'Dholipara', 1, 1, 130, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:16:15', '2022-05-17 16:16:15'),
(2241, 'Badaldi', 1, 1, 130, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:18:08', '2022-05-17 16:18:08'),
(2242, 'Bawnia', 1, 1, 130, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:18:47', '2022-05-17 16:18:47'),
(2243, 'Uludaha', 1, 1, 130, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:19:27', '2022-05-17 16:19:27'),
(2244, 'Pakar Matha', 1, 1, 130, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:20:16', '2022-05-17 16:20:16'),
(2245, 'Priyanka City', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:21:06', '2022-05-17 16:21:06'),
(2246, 'Hashur Bottola', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:21:44', '2022-05-17 16:22:26'),
(2247, 'Diya Bari', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:31:24', '2022-05-17 16:31:24'),
(2248, 'Khalpar', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:32:01', '2022-05-17 16:32:01'),
(2249, 'Nolvouge', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:32:34', '2022-05-17 16:32:34'),
(2250, 'Fulbariya', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:33:57', '2022-05-17 16:33:57'),
(2251, 'Shiraz Market', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:34:37', '2022-05-17 16:34:37'),
(2252, 'Nishat Nagar', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:35:14', '2022-05-17 16:35:14'),
(2253, 'Kamar Para', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:35:37', '2022-05-17 16:35:37'),
(2254, 'Dhour', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:36:20', '2022-05-17 16:36:20'),
(2255, 'East West Medical College', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:38:22', '2022-05-17 16:38:22'),
(2256, 'Ramjan Market', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:40:43', '2022-05-17 16:41:32'),
(2257, 'Noya Nagar', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:42:21', '2022-05-17 16:42:21'),
(2258, 'Chandal Vouge', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:43:15', '2022-05-17 16:43:15'),
(2259, 'Raja Bari', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:43:40', '2022-05-17 16:43:40'),
(2260, 'Prottasha', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:44:19', '2022-05-17 16:44:19'),
(2261, 'Sholohati, Sector 18', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:45:23', '2022-05-17 16:45:23'),
(2262, 'Kalibari', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:46:00', '2022-05-17 16:46:00'),
(2263, 'Aziz Market (Near Mirpur)', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:47:12', '2022-05-17 16:47:12'),
(2264, 'Ashulia Baribadh', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:47:53', '2022-05-17 16:47:53'),
(2265, 'Abdullah Pur', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:48:28', '2022-05-17 16:48:28'),
(2266, 'Akij Foundation', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:48:55', '2022-05-17 16:48:55'),
(2267, 'Rana Vola', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:49:22', '2022-05-17 16:49:22'),
(2268, 'Golgolar Mor', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:50:08', '2022-05-17 16:50:08'),
(2269, 'Siraj Market', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:50:34', '2022-05-17 16:50:34'),
(2270, 'Beribadh', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:51:02', '2022-05-17 16:51:02'),
(2271, 'Dharanger Tek', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:51:48', '2022-05-17 16:51:48'),
(2272, 'Bamnartek', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 16:56:43', '2022-05-17 16:56:43'),
(2273, 'Ranavola Bottola', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:16:48', '2022-05-17 17:16:48'),
(2274, 'Rupayan City', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:17:34', '2022-05-17 17:17:34'),
(2275, 'Tarar Tek', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:18:10', '2022-05-17 17:18:10'),
(2276, 'Jatrabari besides diabari', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:18:57', '2022-05-17 17:18:57'),
(2277, 'Abul Hasnat Road', 1, 1, 18, NULL, NULL, 1, 1, 1, 1, '2022-05-17 17:35:39', '2022-05-20 07:20:27'),
(2278, 'Nurbox Lane', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:36:42', '2022-05-17 17:36:42'),
(2279, 'S C C Road', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:40:24', '2022-05-17 17:40:24'),
(2280, 'Abul Kairat Road Armanitola', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:42:29', '2022-05-17 17:42:29'),
(2281, 'Armanitola', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:43:38', '2022-05-17 17:43:38'),
(2282, 'Armania Street', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:44:48', '2022-05-17 17:44:48'),
(2283, 'K P Gost Street', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:45:53', '2022-05-17 17:45:53'),
(2284, 'Samsabad Lane', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:46:36', '2022-05-17 17:46:36'),
(2285, 'Bagdasa Lane', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:47:35', '2022-05-17 17:47:35'),
(2286, 'Kosaitoli', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:48:10', '2022-05-17 17:48:10'),
(2287, 'Bangshal Road', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:51:28', '2022-05-17 17:51:28'),
(2288, 'Bangsal Pukur Par', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:52:59', '2022-05-17 17:52:59'),
(2289, 'Shikkatoli', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:53:43', '2022-05-17 17:53:43'),
(2290, 'French Road', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:54:43', '2022-05-17 17:54:43'),
(2291, 'Abdullah Sarker Lane', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 17:55:41', '2022-05-17 17:55:41'),
(2292, 'North South Road Bangsal', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 18:06:35', '2022-05-17 18:06:35'),
(2293, 'Malitola', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 18:07:17', '2022-05-17 18:07:17'),
(2294, 'Purano Mangal Toli', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 18:07:23', '2022-05-17 18:09:27'),
(2295, 'Suritola', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 23:09:42', '2022-05-17 23:09:42'),
(2296, 'Nababpur', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 23:10:11', '2022-05-17 23:10:11'),
(2297, 'Nayabazar', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 23:10:37', '2022-05-17 23:10:37'),
(2298, 'Zindha bahar 1st Lane', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 23:12:55', '2022-05-17 23:12:55'),
(2299, 'Zindha bahar 2nd Lane', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 23:13:37', '2022-05-17 23:13:37'),
(2300, 'Tatibazar', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 23:14:19', '2022-05-17 23:14:19'),
(2301, 'Babu Bazar', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 23:14:47', '2022-05-17 23:14:47'),
(2302, 'Issorchandra Road', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 23:15:26', '2022-05-17 23:15:26'),
(2303, 'Kasaituly', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 23:16:07', '2022-05-17 23:16:07'),
(2304, 'Sikkhatoli Lane', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 23:17:01', '2022-05-17 23:17:01'),
(2305, 'Thathari Bazar', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 23:17:59', '2022-05-17 23:17:59'),
(2306, 'Sayed Hasan Ali Lane', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 23:18:46', '2022-05-17 23:18:46'),
(2307, 'Armenian Charch', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 23:19:19', '2022-05-17 23:19:19'),
(2308, 'Zinda Bazar', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 23:19:45', '2022-05-17 23:19:45'),
(2309, 'Zindha Bahar Park', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 23:20:20', '2022-05-17 23:20:20'),
(2310, 'Badamtoli', 1, 1, 18, NULL, NULL, NULL, NULL, NULL, 1, '2022-05-17 23:21:04', '2022-05-17 23:21:04'),
(2311, 'Kazi Zia Uddin Road', 1, 1, 18, NULL, NULL, 1, 1, 1, 1, '2022-05-17 23:23:30', '2022-05-17 23:23:30'),
(2312, 'Zindha bahar 1st Lane', 1, 1, 106, NULL, NULL, 1, 1, 1, 1, '2022-05-19 17:47:10', '2022-05-19 17:47:10'),
(2313, 'Zindha bahar 2nd Lane', 1, 1, 106, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:10:48', '2022-05-19 18:10:48'),
(2314, 'Zindha bahar 3rd Lane', 1, 1, 106, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:11:27', '2022-05-19 18:11:27'),
(2315, 'Possondho Poddar Lane', 1, 1, 106, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:12:30', '2022-05-19 18:12:30'),
(2316, 'Radhika Mohon Bosak Lane', 1, 1, 106, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:13:31', '2022-05-19 18:13:31'),
(2317, 'Bashbari Lane', 1, 1, 106, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:14:20', '2022-05-19 18:14:20'),
(2318, 'Tati Bazar', 1, 1, 106, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:14:50', '2022-05-19 18:14:50'),
(2319, 'Panni Tola', 1, 1, 106, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:15:28', '2022-05-19 18:15:28'),
(2320, 'Kotwali Road', 1, 1, 106, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:18:15', '2022-05-19 18:18:15'),
(2321, 'Kumar Bari', 1, 1, 106, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:18:44', '2022-05-19 18:18:44'),
(2322, 'Noboroy Lane', 1, 1, 106, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:19:24', '2022-05-19 18:19:24'),
(2323, 'Kabiraz Lane', 1, 1, 106, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:20:03', '2022-05-19 18:20:03'),
(2324, 'Romakanto Nondi Lane', 1, 1, 106, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:20:50', '2022-05-19 18:20:50'),
(2325, 'Nawab Yousuf Road Puran Dhaka', 1, 1, 106, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:21:43', '2022-05-19 18:21:43'),
(2326, 'English Road', 1, 1, 106, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:22:20', '2022-05-19 18:22:20'),
(2327, 'Court House Street', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:26:23', '2022-05-19 18:26:23'),
(2328, 'Shakari Bazar', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:27:15', '2022-05-19 18:27:15'),
(2329, 'Jagannat Univesity', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:28:02', '2022-05-19 18:28:02'),
(2330, 'Semson Road', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:28:39', '2022-05-19 18:28:39'),
(2331, 'Chirtranjan Avenue', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:29:51', '2022-05-19 18:29:51'),
(2332, 'Liakat Avenue', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:30:39', '2022-05-19 18:30:39'),
(2333, 'Victory Park', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:31:13', '2022-05-19 18:31:13'),
(2334, 'Kazi Abdul Rouf Road', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:32:41', '2022-05-19 18:32:41'),
(2335, 'Roghunath Dash Street', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:33:45', '2022-05-19 18:33:45'),
(2336, 'Nondolal Dotto Lane', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:34:54', '2022-05-19 18:34:54'),
(2337, 'Kunzo Babu Lane', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:36:08', '2022-05-19 18:36:08'),
(2338, 'Raj Chandra Lane', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:37:03', '2022-05-19 18:37:03'),
(2339, 'Rishibos Das Lane', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:37:52', '2022-05-19 18:37:52'),
(2340, 'Dubar Das Lane', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:38:42', '2022-05-19 18:38:42'),
(2341, 'Pisi Benarzi Lane', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:39:30', '2022-05-19 18:39:30'),
(2342, 'Govindo Dotto Lane', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:40:07', '2022-05-19 18:40:07'),
(2343, 'Golap Shah Lane', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:41:03', '2022-05-19 18:41:03'),
(2344, 'Shama Proshad Lane', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:41:57', '2022-05-19 18:41:57'),
(2345, 'KG Gupto Lane', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:42:37', '2022-05-19 18:42:37'),
(2346, 'Patla Khan Lane', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:43:11', '2022-05-19 18:43:11'),
(2347, 'North Book Hall Road', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:44:06', '2022-05-19 18:44:06'),
(2348, 'Pari Das Lane', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:44:48', '2022-05-19 18:44:48'),
(2349, 'Joy Chandra Lane', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:46:00', '2022-05-19 18:46:00'),
(2350, 'Bangla Bazar', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:46:38', '2022-05-19 18:46:38'),
(2351, 'Shirisdas Lane', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:47:31', '2022-05-19 18:47:31'),
(2352, 'Issordas Lane', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:48:27', '2022-05-19 18:48:27'),
(2353, 'Lalkuthi', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:49:08', '2022-05-19 18:49:08'),
(2354, 'Abul Hasnat Road DTW,Dhaka Wasa', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:49:48', '2022-05-19 18:49:48'),
(2355, 'Jubli School Road', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:49:49', '2022-05-19 18:49:49'),
(2356, 'Justice Lalmohon Das Lane', 1, 1, 107, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:50:51', '2022-05-19 18:50:51'),
(2357, 'Ahsan Plastic Industry Road', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:51:00', '2022-05-19 18:51:00'),
(2358, 'Purbo Rasulpur, Kamrangirchar', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:51:56', '2022-05-19 18:51:56'),
(2359, 'Jawlahati Chowrasta', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:52:53', '2022-05-19 18:52:53'),
(2360, 'Mujibor Ghat', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:53:31', '2022-05-19 18:53:31'),
(2361, 'Chankharpool Government Primary School', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:53:35', '2022-05-19 18:53:35'),
(2362, 'Golam Makhdum Jame Mosque Goli', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:54:06', '2022-05-19 18:54:06'),
(2363, 'Khalpar Chowrasta', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:54:19', '2022-05-19 18:54:19'),
(2364, 'Khwaja Anwarul Hoque Tower', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:54:31', '2022-05-19 18:54:31'),
(2365, 'Rony Market More', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:54:56', '2022-05-19 18:54:56'),
(2366, 'Nazimuddin Rd', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:55:12', '2022-05-19 18:55:12'),
(2367, 'Suku Miah Ln', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:55:35', '2022-05-19 18:55:35'),
(2368, 'Nurbag,Kamrangirchar', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:55:41', '2022-05-19 18:55:41'),
(2369, 'Toiyabiya Jame Masjid Goli', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:55:55', '2022-05-19 18:55:55'),
(2370, 'Qayet Tuly Ln', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:56:21', '2022-05-19 18:56:21'),
(2371, 'Baitur Rahman Mosque Goli', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:56:38', '2022-05-19 18:56:38'),
(2373, 'Koylar Ghat', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:59:23', '2022-05-19 18:59:23'),
(2374, 'Nabab Katara kholipa Potti Road', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 18:59:30', '2022-05-19 18:59:30'),
(2375, 'Madbor Bazar', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:00:05', '2022-05-19 19:00:05'),
(2376, 'Asrafabad', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:00:37', '2022-05-19 19:00:37'),
(2377, 'Dhaka Law College Road', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:00:38', '2022-05-19 19:00:38'),
(2378, 'Kholamora Ghat', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:01:08', '2022-05-19 19:01:08'),
(2379, 'Nabab Katara kholipa Potti Road', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:01:37', '2022-05-19 19:01:37'),
(2380, 'Nobab Katara (Nimtoli) Chata Masjid Goli', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:02:19', '2022-05-19 19:02:19'),
(2381, 'Burigonga City Market', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:02:46', '2022-05-19 19:02:46'),
(2383, 'Eidgah Math', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:03:09', '2022-05-19 19:03:09'),
(2384, 'Nazira Bazar Choto Jame Mosque Goli', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:03:13', '2022-05-19 19:03:13'),
(2385, 'Hazan Nogor', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:03:28', '2022-05-19 19:03:28'),
(2386, 'Bismillah Kabab Ghar Goli', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:03:31', '2022-05-19 19:03:31'),
(2387, 'Bangladesh Fire Service and Civil Defense Head Quarter Road', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:03:53', '2022-05-19 19:03:53'),
(2388, 'Mohammadnogor', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:04:01', '2022-05-19 19:04:01'),
(2389, 'Khalifa Ghat', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:04:22', '2022-05-19 19:04:22'),
(2390, 'Middle Mominbag', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:05:15', '2022-05-19 19:05:15'),
(2391, 'Chad Masjid Main Road', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:05:49', '2022-05-19 19:05:49'),
(2392, 'Tekerhati', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:06:43', '2022-05-19 19:06:43'),
(2393, 'Monshihati', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:07:44', '2022-05-19 19:07:44'),
(2394, 'Kurar Ghat', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:08:39', '2022-05-19 19:08:39'),
(2395, 'Diyabari', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:08:47', '2022-05-19 19:08:47'),
(2396, 'Abu Sayed Bazar,Kamrangirchor', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:09:04', '2022-05-19 19:09:04'),
(2397, 'lalkhuthi', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:09:11', '2022-05-19 19:09:11'),
(2398, 'Bettary Ghat', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:09:26', '2022-05-19 19:09:26'),
(2399, 'Boshupara', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:09:43', '2022-05-19 19:09:43'),
(2400, 'Hasan Nogor Bandari Mor', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:09:46', '2022-05-19 19:09:46'),
(2401, 'Piyangon housing', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:10:04', '2022-05-19 19:10:04'),
(2402, 'Borogram', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:10:16', '2022-05-19 19:10:16'),
(2403, 'North Tolarbag', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:10:26', '2022-05-19 19:10:26'),
(2404, 'Hujurpara', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:10:33', '2022-05-19 19:10:33'),
(2405, 'Paikpara staff quater', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:10:44', '2022-05-19 19:10:44'),
(2406, 'Islam Nogor', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:10:55', '2022-05-19 19:10:55'),
(2407, 'Government Bangla College', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:11:04', '2022-05-19 19:11:04'),
(2408, 'Ali Nagar Bazar', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:11:14', '2022-05-19 19:11:14'),
(2409, 'Kallyanpur Housing Estate', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:11:25', '2022-05-19 19:11:25'),
(2410, 'Khatpotti', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:11:37', '2022-05-19 19:11:37'),
(2411, 'South Paikpara', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:11:51', '2022-05-19 19:11:51'),
(2412, 'Ahmed Nagar', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:12:12', '2022-05-19 19:12:12'),
(2413, 'Nabinagar Nascari Goli', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:12:14', '2022-05-19 19:12:14'),
(2414, 'Baitul Mamur Jame Masjid', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:12:35', '2022-05-19 19:12:35'),
(2415, 'Acarwala Ghat', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:12:38', '2022-05-19 19:12:38'),
(2416, 'Janata Housing', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:12:57', '2022-05-19 19:12:57'),
(2417, 'Kazi Bari Goli Khalifaghat', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:13:03', '2022-05-19 19:13:03'),
(2418, 'Misco Super Market', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:13:18', '2022-05-19 19:13:18'),
(2419, 'West Rosulpur', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:13:25', '2022-05-19 19:13:25'),
(2420, 'Zoo Road', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:13:40', '2022-05-19 19:13:40'),
(2421, 'Sylhet Bazar', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:13:57', '2022-05-19 19:13:57'),
(2422, 'Rainkhola Bazar', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:14:17', '2022-05-19 19:14:17'),
(2423, 'Tenaripukur Par', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:14:25', '2022-05-19 19:14:25'),
(2424, 'Mirpur 1 Block (A)', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:14:42', '2022-05-19 19:14:42'),
(2425, 'Pakapul', 1, 1, 28, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:14:47', '2022-05-19 19:14:47'),
(2426, 'Mirpur 1 Block (B)', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:15:04', '2022-05-19 19:15:04'),
(2427, 'Mirpur 1 Block (C)', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:15:22', '2022-05-19 19:15:22'),
(2428, 'Begum Badrunnessa Government Girls College Road', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:15:26', '2022-05-19 19:15:26'),
(2429, 'Mirpur 1 Block (D)', 1, 1, 109, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:15:41', '2022-05-19 19:15:41'),
(2430, 'Fazle Rabbi hall,main building', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:15:52', '2022-05-19 19:15:52'),
(2431, 'Nimtoli Jolla Ln', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:16:16', '2022-05-19 19:16:16'),
(2432, 'Shaikh Burhanuddin Post Graduate College', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:16:36', '2022-05-19 19:16:36'),
(2433, 'Aga Sadek Rd', 1, 1, 108, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:17:00', '2022-05-19 19:17:00'),
(2434, 'Judge Goli', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:21:54', '2022-05-19 19:21:54'),
(2435, 'Nawab Habibullah Road', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:22:25', '2022-05-19 19:22:25'),
(2436, 'Mymensingh Road, Shahbag', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:22:49', '2022-05-19 19:22:49'),
(2437, 'Tennis Club Shahbag', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:23:13', '2022-05-19 19:23:13'),
(2438, 'Birdem General Hospital', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:23:40', '2022-05-19 19:23:40'),
(2439, 'Bangabandhu Sheikh Mujib Medical University Hospital', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:24:11', '2022-05-19 19:24:11'),
(2440, 'Central Masjid Kataban', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:24:36', '2022-05-19 19:24:36'),
(2441, 'S Kamruzzaman Sharani Road', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:25:09', '2022-05-19 19:25:09'),
(2442, 'Sonargaon Road Katabon', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:25:33', '2022-05-19 19:25:33'),
(2443, 'Paribagh Wapda Officers Quarter', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:26:03', '2022-05-19 19:26:03'),
(2444, 'Bangladesh Power Development Board (Bpdb) Central', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:26:23', '2022-05-19 19:26:23'),
(2445, 'Katabon Pdb', 1, 1, 38, NULL, NULL, 1, 1, 0, 1, '2022-05-19 19:26:38', '2022-05-19 19:26:38'),
(2446, 'Katabon Boighar', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:26:57', '2022-05-19 19:26:57'),
(2447, 'Prani Shastho Sheba Kendro Katabon', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:27:21', '2022-05-19 19:27:21'),
(2448, 'Brighton Hospital Katabon', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:27:39', '2022-05-19 19:27:39'),
(2449, 'Bsmmu Road Shahbagh', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:27:58', '2022-05-19 19:27:58'),
(2450, 'Pg Hospital, D Block', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:28:14', '2022-05-19 19:28:14'),
(2451, 'Bsmmu Outdoor 1', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:28:41', '2022-05-19 19:28:41'),
(2452, 'Central Jame Mosque Goli, Bsmmu', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:29:00', '2022-05-19 19:29:00'),
(2453, 'Paribagh Jame Masjid', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:29:17', '2022-05-19 19:29:17'),
(2454, 'Paribagh Road No 2', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:29:42', '2022-05-19 19:29:42'),
(2455, 'Kazi Nazrul Islam Ave Shahbagh Road', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:29:59', '2022-05-19 19:29:59'),
(2456, 'Milon Hall At Bsmmu', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:30:17', '2022-05-19 19:30:17'),
(2457, 'Bangladesh National Museum', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:30:39', '2022-05-19 19:30:39'),
(2458, 'Sufia Kamal National Public Library', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:31:01', '2022-05-19 19:31:01'),
(2459, 'Module General Hospital Road', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:31:18', '2022-05-19 19:31:18'),
(2460, 'Motalib Plaza', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:31:35', '2022-05-19 19:31:35'),
(2461, 'Paribagh Shonargaon St', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:32:03', '2022-05-19 19:32:03'),
(2462, 'Nahar Plaza', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:32:22', '2022-05-19 19:32:22'),
(2463, 'Sonargaon Road Hatirpool', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:32:40', '2022-05-19 19:32:40'),
(2464, 'Bir Uttam Cr Dutta Link Road', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:32:59', '2022-05-19 19:32:59'),
(2465, 'Dhaka Club', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:33:16', '2022-05-19 19:33:16'),
(2466, 'Daerasharif', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:33:39', '2022-05-19 19:33:39'),
(2467, 'Ladis club', 1, 1, 38, NULL, NULL, 1, 1, 1, 1, '2022-05-19 19:34:01', '2022-05-19 19:34:01'),
(2468, 'Avenue 3', 1, 1, 155, NULL, NULL, 1, 1, 1, 1, '2022-05-21 07:14:35', '2022-05-21 07:14:35'),
(2469, 'Avenue 5', 1, 1, 155, NULL, NULL, 1, 1, 1, 1, '2022-05-21 07:15:15', '2022-05-21 07:15:15'),
(2470, 'Block-A', 1, 1, 155, NULL, NULL, 1, 1, 1, 1, '2022-05-21 07:16:08', '2022-05-21 07:16:08'),
(2471, 'Block-B', 1, 1, 155, NULL, NULL, 1, 1, 1, 1, '2022-05-21 07:16:46', '2022-05-21 07:16:46'),
(2472, 'Block-C', 1, 1, 155, NULL, NULL, 1, 1, 1, 1, '2022-05-21 07:17:18', '2022-05-21 07:17:18'),
(2473, 'Block-D', 1, 1, 155, NULL, NULL, 1, 1, 1, 1, '2022-05-21 07:18:39', '2022-05-21 07:18:39'),
(2474, 'Block-E', 1, 1, 155, NULL, NULL, 1, 1, 1, 1, '2022-05-21 07:19:29', '2022-05-21 07:19:29');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `origin` tinyint(4) DEFAULT NULL COMMENT '1:laundry,2:salon,3:pos',
  `present` tinyint(4) DEFAULT NULL COMMENT '1=present, 0=absent',
  `date` date DEFAULT NULL,
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `late` tinyint(4) DEFAULT NULL COMMENT '1=true, 0=false',
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'who insert this record',
  `status` tinyint(4) DEFAULT NULL COMMENT '1=Active, 0=In Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `origin`, `present`, `date`, `in_time`, `out_time`, `late`, `note`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '2022-11-05', '10:00:00', '18:00:00', NULL, NULL, 1, 1, '2022-11-05 11:54:48', '2022-11-05 11:54:48'),
(2, 2, 2, 0, '2022-11-05', NULL, NULL, NULL, NULL, 1, 1, '2022-11-05 11:54:48', '2022-11-05 11:54:48'),
(3, 1, 2, 0, '2022-11-04', NULL, NULL, NULL, NULL, 1, 1, '2022-11-05 11:56:47', '2022-11-05 11:56:47'),
(4, 2, 2, 1, '2022-11-04', '10:00:00', '18:00:00', NULL, NULL, 1, 1, '2022-11-05 11:56:47', '2022-11-05 11:56:47'),
(5, 1, 2, 0, '2022-11-04', NULL, NULL, NULL, NULL, 1, 1, '2022-11-05 11:57:04', '2022-11-05 11:57:04'),
(6, 2, 2, 1, '2022-11-04', '10:00:00', '18:00:00', NULL, NULL, 1, 1, '2022-11-05 11:57:05', '2022-11-05 11:57:05'),
(7, 1, 2, 1, '2022-11-03', '10:00:00', '18:00:00', NULL, NULL, 1, 1, '2022-11-05 12:02:00', '2022-11-05 12:02:00'),
(8, 2, 2, 1, '2022-11-03', '10:00:00', '18:00:00', NULL, NULL, 1, 1, '2022-11-05 12:02:00', '2022-11-05 12:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exprience` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `billing_id` int(11) NOT NULL DEFAULT '0',
  `shipping_id` int(11) NOT NULL DEFAULT '0',
  `status` varchar(30) NOT NULL COMMENT 'Active,Inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `customer_id`, `billing_id`, `shipping_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 'Active', '2022-08-11 12:55:14', '2022-09-01 10:49:50'),
(2, 5, 6, 6, 'Active', '2022-09-02 16:15:11', '2022-09-02 16:16:43'),
(3, 7, 0, 7, 'Active', '2022-09-08 16:35:52', '2022-09-08 16:36:04'),
(4, 6, 0, 9, 'Active', '2022-09-14 16:07:16', '2022-09-14 16:07:35'),
(5, 2, 0, 2, 'Active', '2022-09-14 18:16:54', '2022-09-14 18:17:26'),
(6, 3, 0, 3, 'Active', '2022-09-14 18:37:19', '2022-09-14 18:37:36'),
(7, 9, 0, 9, 'Active', '2022-11-12 17:10:42', '2022-11-12 17:19:23'),
(8, 10, 0, 10, 'Active', '2022-11-12 19:44:34', '2022-11-12 19:45:24');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(30) NOT NULL COMMENT 'Active,Inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `clientfeedbacks`
--

CREATE TABLE `clientfeedbacks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `codcharges`
--

CREATE TABLE `codcharges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codcharge` double(20,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `codcharges`
--

INSERT INTO `codcharges` (`id`, `codcharge`, `status`, `created_at`, `updated_at`) VALUES
(1, 1.00, 1, '2020-08-09 14:44:16', '2022-04-21 21:28:08');

-- --------------------------------------------------------

--
-- Table structure for table `corporate_customer_products`
--

CREATE TABLE `corporate_customer_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `amount` double(20,2) NOT NULL DEFAULT '0.00',
  `issue_date` date DEFAULT NULL,
  `validate_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `corporate_customer_products`
--

INSERT INTO `corporate_customer_products` (`id`, `customer_id`, `product_id`, `service_id`, `amount`, `issue_date`, `validate_date`, `created_at`, `updated_at`) VALUES
(9, 7, 40, 3, 8.00, '2022-11-01', '2022-11-30', '2022-11-02 06:22:46', '2022-11-02 06:22:46'),
(10, 7, 40, 2, 10.00, '2022-11-01', '2022-11-30', '2022-11-02 06:22:46', '2022-11-02 06:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE `counters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `createpages`
--

CREATE TABLE `createpages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_area` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pageName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pageName_bn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_bn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_bn` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `createpages`
--

INSERT INTO `createpages` (`id`, `page_area`, `pageName`, `slug`, `title`, `text`, `pageName_bn`, `title_bn`, `text_bn`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Left Area', 'About us', 'About-us', 'About us', 'Choose Sensor Courier as your delivery partner\r\nSensor Courier client-centered Logistics Company. It shall be the endeavor of Sensor Courier to surpass customer expectations through Innovation, Creativity and an uncompromising commitment to Quality, Transparency and Integrity in offering total logistic solutions. Our mission is to offer high-performance solutions that would exceed customer expectations through high quality service, cost control, continuous up-gradation of technology and development of our human .', 'আমাদের সম্পর্কে', 'আমাদের সম্পর্কে', 'আপনার ডেলিভারি পার্টনার হিসেবে সেন্সর কুরিয়ার বেছে নিন\r\nসেন্সর কুরিয়ার ক্লায়েন্ট-কেন্দ্রিক লজিস্টিক কোম্পানি। উদ্ভাবন, সৃজনশীলতা এবং মোট লজিস্টিক সমাধান অফার করার ক্ষেত্রে গুণমান, স্বচ্ছতা এবং সততার প্রতি আপোষহীন প্রতিশ্রুতির মাধ্যমে গ্রাহকের প্রত্যাশা অতিক্রম করার জন্য সেন্সর কুরিয়ারের প্রচেষ্টা হবে। আমাদের লক্ষ্য হল উচ্চ মানের পরিষেবা, খরচ নিয়ন্ত্রণ, প্রযুক্তির ক্রমাগত আপ-গ্রেডেশন এবং আমাদের মানুষের উন্নয়নের মাধ্যমে গ্রাহকের প্রত্যাশা ছাড়িয়ে যাওয়া উচ্চ-কার্যকারিতা সমাধানগুলি অফার করা।', 1, '2022-04-19 19:50:13', '2022-07-27 04:52:54'),
(2, 'Left Area', 'Privacy Policy', 'Privacy-Policy', 'Privacy Policy', 'What information do we collect?\r\nWe may collect, store and use the following kinds of personal data:\r\n(a) information about your visits to and use of this website;\r\n(b) information about any interactions carried out between you and us on or in relation to this website.\r\n(c) information that you provide to us for the purpose of registering with us and/or subscribing to our website services and/or email notifications.', 'গোপনীয়তা নীতি', 'গোপনীয়তা নীতি', 'আমরা কি তথ্য সংগ্রহ করবেন?\r\nআমরা নিম্নলিখিত ধরণের ব্যক্তিগত তথ্য সংগ্রহ, সঞ্চয় এবং ব্যবহার করতে পারি:\r\n(ক) এই ওয়েবসাইটে আপনার পরিদর্শন এবং ব্যবহার সম্পর্কে তথ্য;\r\n(b) এই ওয়েবসাইটে বা এর সাথে সম্পর্কিত আপনার এবং আমাদের মধ্যে সম্পাদিত কোনো মিথস্ক্রিয়া সম্পর্কে তথ্য।\r\n(c) আমাদের সাথে নিবন্ধন করার উদ্দেশ্যে এবং/অথবা আমাদের ওয়েবসাইট পরিষেবা এবং/অথবা ইমেল বিজ্ঞপ্তিগুলিতে সদস্যতা নেওয়ার উদ্দেশ্যে আপনি আমাদেরকে যে তথ্য প্রদান করেন।', 1, '2022-04-28 20:53:52', '2022-07-27 04:53:56'),
(3, 'Left Area', 'Test', 'Test', 'Test title', 'test description', 'Test', 'টেস্ট শিরোনাম', 'পরীক্ষার বিবরণী', 1, '2022-07-27 04:42:46', '2022-07-27 04:46:34'),
(4, 'Left Area', 'Something', 'Something', 'Something', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,', 'Something', 'কিছু', 'বহুকাল হইলো আমি একবার পালামৌ প্রদেশে গিয়াছিলাম, \r\n	        প্রত্যাগমন করিলে পর সেই অঞ্চলের বৃত্তান্ত লিখিবার নিমিত্ত দুই-এক জন বন্ধুবান্ধব আমাকে পুনঃপুন অনুরোধ করিতেন, \r\n	        আমি তখন তাঁহাদের উপহাস করিতাম।', 1, '2022-07-27 04:49:18', '2022-07-27 09:05:36'),
(5, 'Left Area', 'test page', 'test-page', 'test page', 'test page', 'test page', 'test page', 'test page', 1, '2022-09-14 12:59:48', '2022-09-14 12:59:48');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastName` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phoneNumber` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailAddress` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `password` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwordReset` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public/uploads/default/avator.png',
  `agree` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `verify` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_role` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) DEFAULT NULL,
  `register_by` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Online',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstName`, `lastName`, `fathers_name`, `mothers_name`, `date_of_birth`, `phoneNumber`, `emailAddress`, `origin`, `customer_type`, `balance`, `password`, `passwordReset`, `api_token`, `logo`, `agree`, `verify`, `api_role`, `status`, `register_by`, `created_at`, `updated_at`) VALUES
(2, 'customer-2', NULL, NULL, NULL, NULL, '01910863553', NULL, 'Salon', 'Regular', NULL, '$2y$10$.I0NrpVT4CL1KbCfM5T9C.8pG2G5/3rkV9XCJ6LhxK/2bkRdKRJXq', NULL, 'eL76SYfgURwhxLrmpaUjlczR8an8TawrTIbnhf56bDALV1plZE', 'public/uploads/customer/0MMSQIWK1Czj0PDXGRuYAGZw3nKeMCSHoG96FI5gfpBt73FHpo73-738269_girl-cartoon-with-hijab.jpg', '1', '1', 1, 1, 'Online', '2022-09-14 05:24:47', '2022-09-14 05:25:46'),
(3, 'hafizul', NULL, NULL, NULL, NULL, '01789725276', NULL, 'Laundry', 'Regular', NULL, '$2y$10$vs20i9OSdtx2YE6ZEbLTueN2arp0TCuWJRPu3AqUTMlP.nKQmFvim', NULL, 'rWMz1u7jwjWx2HCsVCSANNcEjW0dbm9eXNLKQkKUV2etMziOkm', 'public/uploads/default/avator.png', '1', '1', 1, 1, 'Online', '2022-09-14 12:35:44', '2022-09-14 12:36:43'),
(4, 'test1', NULL, NULL, NULL, NULL, '01776600736', 'xcellogisticsbd@gmail.com', 'Salon', 'Regular', NULL, '$2y$10$3tqbcnoaaixCgPuJ5Am3CuDBYswZjQp3gXIaO6YJLhL8bLf.yLoX2', NULL, 'LlK8djyctUEdB5xuCs9Hkdj6dd3TEtIg45QHVImViLEAypGb6s', 'public/uploads/default/avator.png', '1', '1', 1, 1, 'Online', '2022-09-14 08:13:04', '2022-09-14 08:13:52'),
(5, 'hr', NULL, NULL, NULL, NULL, '01688800826', NULL, 'Laundry', 'Corporate', NULL, '$2y$10$MY1K4vhA0Z3zq/QfQerz0.ZoTQwHxPD7OTu7qd0xJwDvSMEBO/xrW', NULL, 'UI3BfCuX3qIFKoUdIXRAWjBC5id4VjN8Di6nwKCW6g6NF9xXlj', 'public/uploads/merchant/k57eQ6GRMJIiuefJFVpb5ztNA0vY1aBsIDpM8xuY19n1MqGtF5WhatsApp Image 2022-09-23 at 4.17.57 PM.jpeg', '1', '1', 1, 1, 'Offline', '2022-10-05 18:31:07', '2022-10-05 18:31:07'),
(6, 'Corporate 1', NULL, 'asd', 'asd', NULL, '01571219996', 'a@gmail.com', 'Laundry', 'Corporate', NULL, '$2y$10$GLbRDvtQwJMxT6Dy60R7j.Ouja/M/R8Y54ExfcT4rdG/4Lrnr1sWK', NULL, 'u5tippx2UTFBmswHwsLRgavqHINEmYYopKeiMBrixKYlPoY4PE', 'public/uploads/merchant/cJn7y6LgOF4S6jBo7PjOTcAnhgErgNSU9o2nE98aI2LnkPsm2F16142843_1092471107546656_9209124065111941633_n.jpg', '1', '1', 1, 1, 'Offline', '2022-10-29 11:57:04', '2022-10-29 11:57:04'),
(7, 'Corporate 2', NULL, 'gb', 'd', NULL, '01683073952', 'b@gmail.com', 'Laundry', 'Corporate', NULL, '$2y$10$oVzN.XDC3dgQOT8pDMnNW.qfbdkjr2dkfivV09TrfZtjk/CUePWf.', NULL, 'KrsVsw6EntPgaLPc3pbRD2uymk5ptW5ulQGe5N1wMgjFfl0jF5', 'public/uploads/merchant/WQKbcy6iKNY0FhqOHa788uDzQK6bOqlfocGORa9Wk6vUInhXNAindex.jpg', '1', '1', 1, 1, 'Offline', '2022-10-29 12:02:01', '2022-10-29 12:02:01'),
(8, 'abu huraira', NULL, NULL, NULL, NULL, '01958368164', NULL, 'Salon', 'Regular', NULL, '$2y$10$Newx3Q32Ix0XnEZtyov23e3ui6JfeQWvAdVuqttsChs1Ua44OjVau', NULL, 'bwSaJ7WDYAg7ZOUCy7uHwAcpl0gzgRGG5juJFwyzuZEPAU6ubv', 'public/uploads/merchant/yuwiDSHJ8sRjI6jO421p56vZU9hnP0zTj2y4IPqtT8jORSiC2m64126ad9-5a2a-4bf0-9653-b84d5e24230b.jpg', '1', '1', 1, 1, 'Online', '2022-11-12 17:53:53', '2022-11-13 00:26:50'),
(9, 'office', NULL, NULL, NULL, NULL, '01841122026', NULL, 'Laundry', 'Regular', NULL, '$2y$10$0HEuRbl2ADLkUiJeQ8nwx.tN44gtNuVdU3KAGTmvkEbPPDkOSNgZS', NULL, 'Fgw1LDe2sktrbCAEPDsPaY7y1rvt5gLxQPRuqKKD4teGx9mpGw', 'public/uploads/merchant/xqpU4o7y3XjkQJZIUs5s1nwFInuWEt2RDmSSibvDY8QEQ8Fohapanjabi.png', '1', '1', 1, 1, 'Offline', '2022-11-13 00:09:29', '2022-11-13 00:09:29'),
(10, 'Mahfuz', NULL, NULL, NULL, NULL, '01961472921', NULL, 'Laundry', 'Regular', NULL, '$2y$10$/NWcr7koNLx.x7FIvp9Ypen5d7pkhQuuYKIPdY4SMtoHfO1bt0Bfq', NULL, 'NVncX3fh7RHzLgDbWQbh7TT357p2Fbrak5HzWV4HdTpOWJ6HpQ', 'public/uploads/default/avator.png', '1', '1', 1, 1, 'Online', '2022-11-13 02:43:34', '2022-11-13 02:44:15'),
(11, 'sagor', NULL, NULL, NULL, NULL, '01786666467', NULL, 'Salon', 'Regular', NULL, '$2y$10$4g3EoY707aMB8ffAx7rwK.u.nlzQFtVi6wOJZySKQ5fgJg7Z8rRn.', NULL, 'KAb3qmMcdKKY9NfoOhVLW0r8CMmw95nvCU7XmxVnr9y6zKQacC', 'public/uploads/merchant/FiKgvmUJpzQBYN9acIooa3pXcYg7wLuMLvZfAwDNh8eddqfNzzWhatsApp Image 2022-08-16 at 6.23.45 PM.jpeg', '1', '1', 1, 1, 'Offline', '2022-11-13 18:44:08', '2022-11-13 18:44:08'),
(12, 'Md Rakibuzzaman Khan', NULL, NULL, NULL, NULL, '01700534572', NULL, 'Salon', 'Regular', NULL, '$2y$10$KnCVfN6057FOUo0RtIjr7uHEFUZx//dc5E8lFQqSJIhWAfrC644QW', NULL, 'FoFfBIgfk4ncJ2ImTKKoZAWMN8NcqgnH9yBTJvhN829Fk1TVuQ', 'public/uploads/merchant/EHwxuPM0CIJoc0QxyEomEHaqqDNLMJDywyFTaGqyqrbrv3yhK8WhatsApp Image 2022-08-16 at 6.23.45 PM.jpeg', '1', '1', 1, 1, 'Offline', '2022-11-13 19:03:13', '2022-11-13 19:03:13');

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `is_default` varchar(3) NOT NULL DEFAULT 'no' COMMENT 'yes,no',
  `type` varchar(10) NOT NULL COMMENT 'Office,Home',
  `fullname` varchar(100) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `region_id` int(4) NOT NULL,
  `city_id` int(4) NOT NULL,
  `area_id` int(5) NOT NULL,
  `address` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `customer_id`, `is_default`, `type`, `fullname`, `mobile_no`, `region_id`, `city_id`, `area_id`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 'no', 'Home', 'customer-1', '01958368164', 1, 1, 1, 'test', '2022-09-14 17:20:41', '2022-09-14 17:20:41'),
(2, 2, 'no', 'Home', 'customer-2', '01910863553', 1, 1, 36, 'zahaz building', '2022-09-14 11:25:46', '2022-09-14 11:25:46'),
(3, 3, 'no', 'Home', 'hafizul', '01789725276', 1, 1, 1, 'zahaz building', '2022-09-14 18:36:43', '2022-09-14 18:36:43'),
(4, 4, 'no', 'Home', 'test1', '01776600736', 1, 1, 79, '359 shahid janani jahanara imam shoroni, elephant road 1205 Dhaka, Dhaka Division, Bangladesh', '2022-09-14 14:13:52', '2022-09-14 14:13:52'),
(5, 5, 'no', 'Office', 'hr', '01688800826', 1, 1, 24, 'gulsan', '2022-10-05 11:31:07', '2022-10-05 11:31:07'),
(6, 6, 'no', 'Office', 'Corporate 1', '01571219996', 1, 1, 79, 'Aftabnagar', '2022-10-29 17:57:04', '2022-10-29 17:57:04'),
(7, 7, 'no', 'Office', 'Corporate 2', '01683073952', 1, 1, 17, 'Badda', '2022-10-29 18:02:01', '2022-10-29 18:02:01'),
(8, 8, 'no', 'Home', 'abu huraira', '01958368164', 1, 1, 17, 'zahaz building', '2022-11-12 10:54:54', '2022-11-12 10:54:54'),
(9, 9, 'no', 'Home', 'office', '01841122026', 1, 1, 79, 'fdvdsfxrv', '2022-11-12 17:09:29', '2022-11-12 17:09:29'),
(10, 10, 'no', 'Home', 'Mahfuz', '01961472921', 1, 1, 17, 'jnia na', '2022-11-12 19:44:15', '2022-11-12 19:44:15'),
(11, 11, 'no', 'Home', 'sagor', '01786666467', 1, 1, 129, 'hfyjyfrjyh', '2022-11-13 11:44:08', '2022-11-13 11:44:08'),
(12, 12, 'no', 'Home', 'Md Rakibuzzaman Khan', '01700534572', 1, 1, 34, 'palton', '2022-11-13 12:03:13', '2022-11-13 12:03:13');

-- --------------------------------------------------------

--
-- Table structure for table `deliverycharges`
--

CREATE TABLE `deliverycharges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_charge_head_id` int(11) DEFAULT NULL,
  `weight` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliverycharge` double NOT NULL DEFAULT '0',
  `extradeliverycharge` double NOT NULL DEFAULT '0',
  `cod_charge` double(20,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deliverycharges`
--

INSERT INTO `deliverycharges` (`id`, `delivery_charge_head_id`, `weight`, `deliverycharge`, `extradeliverycharge`, `cod_charge`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 120, 15, 1.00, NULL, 1, '2022-04-25 06:02:16', '2022-06-13 05:05:22'),
(2, 2, NULL, 100, 15, 1.00, NULL, 1, '2022-04-25 06:04:05', '2022-06-13 05:05:09'),
(3, 1, NULL, 70, 15, 0.50, NULL, 1, '2022-05-09 11:03:41', '2022-06-13 05:41:07');

-- --------------------------------------------------------

--
-- Table structure for table `deliveryman_agents`
--

CREATE TABLE `deliveryman_agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deliveryman_id` bigint(20) DEFAULT NULL,
  `agent_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryman_areas`
--

CREATE TABLE `deliveryman_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deliveryman_id` bigint(20) DEFAULT NULL,
  `thana_id` bigint(20) DEFAULT NULL,
  `area_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryman_education`
--

CREATE TABLE `deliveryman_education` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deliveryman_id` bigint(20) DEFAULT NULL,
  `exam_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gpa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `board` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryman_experiences`
--

CREATE TABLE `deliveryman_experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deliveryman_id` bigint(20) DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryman_payments`
--

CREATE TABLE `deliveryman_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliveryman_id` bigint(20) NOT NULL,
  `parcel_id` bigint(20) NOT NULL,
  `amount` double(20,2) DEFAULT '0.00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliverymen`
--

CREATE TABLE `deliverymen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternative_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_parcel_amount` double(20,2) DEFAULT '0.00',
  `nid_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_profession` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_nid_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_profession` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_nid_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` text COLLATE utf8mb4_unicode_ci,
  `permanent_address` text COLLATE utf8mb4_unicode_ci,
  `guaranteer_information` text COLLATE utf8mb4_unicode_ci,
  `guaranteer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guaranteer_relation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guaranteer_nid_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guaranteer_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guaranteer_present_address` text COLLATE utf8mb4_unicode_ci,
  `guaranteer_permanent_address` text COLLATE utf8mb4_unicode_ci,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `thana_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passwordReset` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_role` tinyint(4) NOT NULL DEFAULT '2',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nid_front` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_back` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification_type` tinyint(1) NOT NULL COMMENT '1:nid,2:birth certificate'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deliverymen`
--

INSERT INTO `deliverymen` (`id`, `name`, `email`, `phone`, `alternative_phone`, `per_parcel_amount`, `nid_no`, `image`, `branch_id`, `designation`, `fathers_name`, `fathers_profession`, `fathers_nid_no`, `fathers_mobile_no`, `mothers_name`, `mothers_profession`, `mothers_nid_no`, `mothers_mobile_no`, `birth_date`, `religion`, `marital_status`, `present_address`, `permanent_address`, `guaranteer_information`, `guaranteer_name`, `guaranteer_relation`, `guaranteer_nid_no`, `guaranteer_mobile_no`, `guaranteer_present_address`, `guaranteer_permanent_address`, `division_id`, `district_id`, `thana_id`, `area_id`, `password`, `passwordReset`, `photo`, `latitude`, `longitude`, `location`, `api_token`, `api_role`, `status`, `created_at`, `updated_at`, `nid_front`, `nid_back`, `birth_certificate`, `identification_type`) VALUES
(1, 'test', NULL, '01910863553', NULL, 0.00, NULL, 'public/uploads/deliveryman/16631581127426a4bd1135c6e9c8ec10e8d8b183d1.jpg', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-14', 'Islam', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, '$2y$10$CChyCpsAYfpSEw2xN1rKGeq8jTxANs8wU7H6rQPyjPGz7k/14STpe', NULL, NULL, NULL, NULL, NULL, 'W7U870d73OnHIUDoav0gwIh0L4XlplNZRLnon9Avw97ANDj7Hi', 2, 1, '2022-09-14 12:21:52', '2022-09-14 12:21:52', 'public/uploads/deliveryman/Fi6CpShzqV6QRSSc1d2AHHluMhQPvDGUAd05Nk5eSZfoW10noy89898-20220723220929.jpg', 'public/uploads/deliveryman/nHg44AxGW2bCnAl7ttXqOA2dDjDaaqgFd9VfHxOmMag4bHFwUb89898-20220723220929.jpg', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_charge_heads`
--

CREATE TABLE `delivery_charge_heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bangla_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_charge_heads`
--

INSERT INTO `delivery_charge_heads` (`id`, `name`, `bangla_name`, `slug`, `service_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Inside City', ' শহরের ভিতরে', 'inside-city', '24hrs', 1, '2022-04-25 04:57:02', '2022-04-25 04:57:02'),
(2, 'City Suburb', 'উপশহর', 'city-suburb', '48-72 hrs', 1, '2022-04-25 04:57:02', '2022-04-25 04:57:02'),
(3, 'Outside City', 'শহরের বাইরে', 'outside-city', 'Within 5 days', 1, '2022-04-25 04:57:02', '2022-04-25 04:57:02');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin Department Section', 1, '2022-04-13 16:58:04', '2022-04-13 16:58:04'),
(2, 'Financial Department Section', 1, '2022-04-13 16:59:11', '2022-04-13 16:59:11'),
(5, 'Washing Men', 1, '2022-09-14 13:15:36', '2022-09-14 13:15:36');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `division_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', 1, 1, '2022-04-23 05:47:18', '2022-04-25 02:43:15'),
(2, 'Habiganj', 8, 1, '2022-04-25 02:55:17', '2022-04-25 02:55:17'),
(3, 'Moulvibazar', 8, 1, '2022-04-25 02:56:30', '2022-04-25 02:56:30'),
(4, 'Sunamganj', 8, 1, '2022-04-25 02:57:56', '2022-04-25 02:57:56'),
(5, 'Sylhet', 8, 1, '2022-04-25 02:58:18', '2022-04-25 02:58:18'),
(6, 'Gazipur', 1, 1, '2022-04-27 20:32:39', '2022-11-14 00:14:58'),
(7, 'Manikgonj', 1, 1, '2022-04-27 20:35:29', '2022-11-14 00:15:14'),
(8, 'Sher Pur', 5, 1, '2022-04-28 18:37:33', '2022-04-28 18:37:33'),
(9, 'Jamalpur', 5, 1, '2022-05-20 07:33:54', '2022-05-20 07:33:54'),
(10, 'Netrokona', 5, 1, '2022-05-20 07:34:46', '2022-05-20 07:34:46'),
(11, 'Mymensingh', 5, 1, '2022-05-20 07:35:57', '2022-05-20 07:35:57'),
(12, 'Kishorgonj', 1, 1, '2022-05-20 07:39:23', '2022-11-14 00:15:06'),
(13, 'Narayangonj', 1, 1, '2022-05-20 07:40:06', '2022-11-14 00:17:05'),
(14, 'Natore', 6, 1, '2022-11-14 00:21:20', '2022-11-14 00:21:20');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', 1, '2022-04-23 05:23:18', '2022-04-23 05:23:33'),
(2, 'Barisal', 1, '2022-04-25 02:50:07', '2022-11-14 00:14:08'),
(3, 'Chittagong', 1, '2022-04-25 02:50:35', '2022-11-14 00:14:16'),
(4, 'Khulna', 1, '2022-04-25 02:52:03', '2022-11-14 00:14:24'),
(5, 'Mymensingh', 1, '2022-04-25 02:52:39', '2022-11-14 00:14:30'),
(6, 'Rajshahi', 1, '2022-04-25 02:53:00', '2022-11-14 00:14:34'),
(7, 'Rangpur', 1, '2022-04-25 02:53:58', '2022-11-14 00:14:39'),
(8, 'Sylhet', 1, '2022-04-25 02:54:30', '2022-11-14 00:14:43');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternative_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_parcel_amount` double(20,2) DEFAULT '0.00',
  `nid_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_profession` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_nid_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_profession` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_nid_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gross_salary` double(20,2) NOT NULL DEFAULT '0.00',
  `commission` int(11) DEFAULT NULL,
  `others_allowance` double(20,2) NOT NULL DEFAULT '0.00',
  `marital_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` text COLLATE utf8mb4_unicode_ci,
  `permanent_address` text COLLATE utf8mb4_unicode_ci,
  `guaranteer_information` text COLLATE utf8mb4_unicode_ci,
  `guaranteer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guaranteer_relation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guaranteer_nid_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guaranteer_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guaranteer_present_address` text COLLATE utf8mb4_unicode_ci,
  `guaranteer_permanent_address` text COLLATE utf8mb4_unicode_ci,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `thana_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passwordReset` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_role` tinyint(4) NOT NULL DEFAULT '4',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `origin` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1:laundry,2:salon,3:pos',
  `nid_front` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_back` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `phone`, `alternative_phone`, `per_parcel_amount`, `nid_no`, `image`, `branch_id`, `department_id`, `designation`, `fathers_name`, `fathers_profession`, `fathers_nid_no`, `fathers_mobile_no`, `mothers_name`, `mothers_profession`, `mothers_nid_no`, `mothers_mobile_no`, `birth_date`, `religion`, `gross_salary`, `commission`, `others_allowance`, `marital_status`, `present_address`, `permanent_address`, `guaranteer_information`, `guaranteer_name`, `guaranteer_relation`, `guaranteer_nid_no`, `guaranteer_mobile_no`, `guaranteer_present_address`, `guaranteer_permanent_address`, `division_id`, `district_id`, `thana_id`, `area_id`, `password`, `passwordReset`, `photo`, `latitude`, `longitude`, `location`, `api_token`, `api_role`, `status`, `created_at`, `updated_at`, `origin`, `nid_front`, `nid_back`, `birth_certificate`, `identification_type`) VALUES
(1, 'masud', NULL, '01958368164', NULL, 0.00, NULL, 'public/uploads/employee/16631540227426a4bd1135c6e9c8ec10e8d8b183d1.jpg', 2, 3, 'cutting man', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Others', 0.00, 40, 0.00, 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, '$2y$10$zm3XeSoSeCRBAj3jgGBI/OvLunFa.mP5S4df/hiS6.2xHHPLOYGJG', NULL, NULL, NULL, NULL, NULL, 'RzHnvt1Xoo12WKO6HPqmCvX49KHFRmYdTYceqIlwj58HSOOShw', 4, 1, '2022-09-14 11:13:42', '2022-10-25 11:57:28', '2', 'public/uploads/employee/Jzc75r3rFMM3XBFnrzi4eqNDBj7eHiXu3moHam8L5MMDrNo0Dg89898-20220723220929.jpg', 'public/uploads/employee/nuJ68I9fNty1UKMmBtqqDYbPBIXR8X15s9JuJvkscpXZqDUbRZ292099004_113158718115411_4957683551501638313_n.jpg', NULL, 1),
(2, 'emploee-1', 'huraira.cse@gmail.com', '01910863553', NULL, 0.00, NULL, 'public/uploads/employee/1663163095fd54329c223431727ee2bf22a4320d6525af596238bdd859f772bb34e632296fcsr2.jpg', 2, 3, 'Cutting man', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-14', 'Others', 0.00, 40, 0.00, 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 79, NULL, '$2y$10$k/YAt5TE9rNlKC9s4AWrNerKetcazQ.OkXIYIUcAR7Xf5H49GSxtq', NULL, NULL, NULL, NULL, NULL, 'tN5fho8OsGPgPGvGYwx1yFwOdxKxlD5nu8quGJHRWcEvy7puzE', 4, 1, '2022-09-14 13:44:55', '2022-10-01 01:52:52', '2', 'public/uploads/employee/enIimh7VOp0Uuuy13yWsNZIWZ2RdpstVPTdL4EsWzULvowzgYU58_highcourt1-202208111951351-20220817111715.jpg', 'public/uploads/employee/fUTwrgXVZVoX76i0ivUvqhFrofjPaRAbI7xHIHpN2khQFC9x7v292099004_113158718115411_4957683551501638313_n.jpg', NULL, 1),
(3, 'emploee-4', 'hurairaaa.cse@gmail.com', '01910863554', NULL, 0.00, NULL, 'public/uploads/employee/1663163095fd54329c223431727ee2bf22a4320d6525af596238bdd859f772bb34e632296fcsr2.jpg', 2, 3, 'Cutting man', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-14', 'Others', 0.00, 40, 0.00, 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 79, NULL, '$2y$10$k/YAt5TE9rNlKC9s4AWrNerKetcazQ.OkXIYIUcAR7Xf5H49GSxtq', NULL, NULL, NULL, NULL, NULL, 'tN5fho8OsGPgPGvGYwx1yFwOdxKxlD5nu8quGJHRWcEvy7puzE', 4, 1, '2022-09-14 13:44:55', '2022-10-01 01:52:52', '1', 'public/uploads/employee/enIimh7VOp0Uuuy13yWsNZIWZ2RdpstVPTdL4EsWzULvowzgYU58_highcourt1-202208111951351-20220817111715.jpg', 'public/uploads/employee/fUTwrgXVZVoX76i0ivUvqhFrofjPaRAbI7xHIHpN2khQFC9x7v292099004_113158718115411_4957683551501638313_n.jpg', NULL, 1),
(4, 'gh', 'gfj@gmail.com', '01683073952', NULL, 0.00, '123456789', 'public/uploads/employee/166739466316142843_1092471107546656_9209124065111941633_n.jpg', 1, 3, 'jani na', 'xdz', NULL, NULL, NULL, 'dfg', NULL, NULL, NULL, '2022-11-29', 'Islam', 97.00, 0, 0.00, 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 16, NULL, '$2y$10$Y4IDs7esgecXZMVz7bQspOzAb.AApFr9jxL2x5MQpdBPCoziCUHqe', NULL, NULL, NULL, NULL, NULL, 'kSdQes2vvlEoTL0gbUH0xYfW0ynWPLisiSwCUw57qThG73MJF2', 4, 1, '2022-11-02 13:11:03', '2022-11-02 13:11:03', '1', 'public/uploads/employee/1N3JrIDUoCVKeicCLpFueq71ZUU9ryDKSF8e7V43LAR2ehTDp8index.jpg', 'public/uploads/employee/H4STIJNJF0VLFJzMLXTwE2CHMS7XJ1N4KnXkIglttdXqg0wC2qmessi.jpg', NULL, 1),
(5, 'sales', NULL, '01688800826', NULL, 0.00, NULL, 'public/uploads/employee/1668397473panjabi.png', 2, 5, 'Cutter', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 0.00, 40, 0.00, 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 16, NULL, '$2y$10$VGxO7i6qmk12CoFwVrTjtundZiqGeNe3e1k4V6gTGLSy4etpWE7ES', NULL, NULL, NULL, NULL, NULL, 'DptEkQdrxggp18gwAXVwn2EPMhcyCODhMvg8ASxFMlNOlUpNy2', 4, 1, '2022-11-14 16:44:33', '2022-11-14 16:44:33', '2', 'public/uploads/employee/XYMLUNp9Q4PGS9HF1Ch9op7pmdNNYjKq2nAftUxliPDe8FYEKtjacket.jpg', 'public/uploads/employee/OdmGJ2xZn39C5bLFwCtXk1OjbkVk5h0ZAxOxmS3pzehZMApiAYjacket.jpg', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_agents`
--

CREATE TABLE `employee_agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) DEFAULT NULL,
  `agent_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_areas`
--

CREATE TABLE `employee_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) DEFAULT NULL,
  `thana_id` bigint(20) DEFAULT NULL,
  `area_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_education`
--

CREATE TABLE `employee_education` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) DEFAULT NULL,
  `exam_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gpa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `board` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_experiences`
--

CREATE TABLE `employee_experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_services`
--

CREATE TABLE `employee_services` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL COMMENT 'Active,Inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_services`
--

INSERT INTO `employee_services` (`id`, `employee_id`, `service_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Active', '2022-09-14 17:21:26', '2022-09-14 17:53:31'),
(2, 1, 2, 'Active', '2022-09-14 17:53:31', '2022-09-14 17:53:31'),
(3, 2, 1, 'Active', '2022-09-14 19:46:09', '2022-11-12 13:46:51'),
(4, 2, 2, 'Active', '2022-09-14 19:46:09', '2022-11-12 13:46:51'),
(5, 2, 3, 'Active', '2022-11-12 13:45:21', '2022-11-12 13:46:51'),
(6, 2, 4, 'Active', '2022-11-12 13:45:21', '2022-11-12 13:46:51'),
(7, 2, 5, 'Active', '2022-11-12 13:45:21', '2022-11-12 13:46:51'),
(8, 2, 6, 'Active', '2022-11-12 13:46:51', '2022-11-12 13:46:51'),
(9, 2, 7, 'Active', '2022-11-12 13:46:51', '2022-11-12 13:46:51'),
(10, 2, 8, 'Active', '2022-11-12 13:46:51', '2022-11-12 13:46:51'),
(11, 2, 9, 'Active', '2022-11-12 13:46:51', '2022-11-12 13:46:51'),
(12, 2, 10, 'Active', '2022-11-12 13:46:51', '2022-11-12 13:46:51'),
(13, 2, 11, 'Active', '2022-11-12 13:46:52', '2022-11-12 13:46:52'),
(14, 2, 12, 'Active', '2022-11-12 13:46:52', '2022-11-12 13:46:52'),
(15, 2, 13, 'Active', '2022-11-12 13:46:52', '2022-11-12 13:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title_bn` varchar(91) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle_bn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `title`, `subtitle`, `image`, `status`, `created_at`, `updated_at`, `title_bn`, `subtitle_bn`) VALUES
(1, 'Fastest delivery guaranteed', 'Get your parcel delivered to your doorstep inside Dhaka within 24/48 hrs and outside Dhaka within 72/96 hrs', 'public/uploads/feature/fast-delivery.png', 1, '2021-06-09 04:42:22', '2022-07-27 03:05:32', 'দ্রুততম ডেলিভারি নিশ্চিত', 'আপনার পার্সেল 24/48 ঘন্টার মধ্যে আপনার দোরগোড়ায় এবং ঢাকার বাইরে 72/96 ঘন্টার মধ্যে গ্রহণ'),
(2, 'Doorstep pickup and delivery', 'Seamless delivery from your doorstep to desired destination', 'public/uploads/feature/home-delivery.png', 1, '2021-07-12 06:13:05', '2022-04-05 10:02:35', '28 / 5000 Translation results ডোরস্টেপ পিকআপ এবং বিতরণ', 'আপনার দোরগোড় থেকে কাঙ্ক্ষিত গন্তব্যে বিজোড় বিতরণ'),
(3, 'SMS updates', 'Get SMS updates on your registered mobile number during booking and delivery', 'public/uploads/feature/sms.png', 1, '2021-07-12 06:14:39', '2022-04-05 10:02:45', 'এসএমএস আপডেট', 'বুকিং এবং বিতরণের সময় আপনার নিবন্ধিত মোবাইল নম্বরে এসএমএস আপডেট পান'),
(4, '50% DISCOUNT ON DELIVERY CHARGE', 'BECOME A MERCHANT & TAKE OFFER , 50% DISCOUNT ON DELIVERY CHARGE.................. Promotional Month upto 30 June\'22', 'public/uploads/feature/blog1.jpg', 1, '2022-05-20 09:03:08', '2022-07-19 10:39:48', '50% DISCOUNT ON DELIVERY CHARGE', 'BECOME A MERCHANT & TAKE OFFER , 50% DISCOUNT ON DELIVERY CHARGE.................. Promotional Month upto 30 June\'22');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hubs`
--

CREATE TABLE `hubs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_bn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle_bn` varchar(299) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_bn` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1:yes;0:no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hubs`
--

INSERT INTO `hubs` (`id`, `title`, `subtitle`, `text`, `title_bn`, `subtitle_bn`, `text_bn`, `status`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'Mirpur', '40, Anwer Mansion, Sec-6, Block-Kha, (near 10 no Golchokkor), Mirpur, Dhaka-1216.', '40, Anwer Mansion, Sec-6, Block-Kha, (near 10 no Golchokkor), Mirpur, Dhaka-1216.', 'মিরপুর হাব', '40, Anwer Mansion, Sec-6, Block-Kha, (near 10 no Golchokkor), Mirpur, Dhaka-1216.', '40, আনোয়ার ম্যানশন, সেকেন্ড-6, ব্লক-খা, (10 নম্বর গোলচক্করের কাছে), মিরপুর, ঢাকা-1216।', 1, 0, '2022-04-05 09:57:13', '2022-10-30 12:37:33'),
(2, 'Rampura', NULL, 'Rampura wapda-road', 'রামপুরা', NULL, 'রামপুরা ওয়াপদা-রাস্তা', 1, 1, '2022-07-27 04:15:12', '2022-10-30 12:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_logs`
--

CREATE TABLE `inventory_logs` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `invoice_no` varchar(50) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `buy_price` double(20,2) NOT NULL,
  `sale_price` double(20,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` double(20,2) NOT NULL,
  `origin` varchar(50) NOT NULL DEFAULT 'Laundry',
  `in_out` varchar(20) NOT NULL DEFAULT 'In' COMMENT 'In,Out',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_logs`
--

INSERT INTO `inventory_logs` (`id`, `branch_id`, `invoice_no`, `item_id`, `unit_id`, `buy_price`, `sale_price`, `quantity`, `subtotal`, `origin`, `in_out`, `created_at`, `updated_at`) VALUES
(1, 2, '5349058', 1, 1, 75.00, 80.00, 100, 7500.00, 'Laundry', 'In', '2022-09-14 18:29:11', '2022-09-14 18:29:11'),
(2, 2, NULL, 1, 1, 75.00, 80.00, 2, 150.00, 'Laundry', 'Out', '2022-09-14 18:29:26', '2022-09-14 18:29:26'),
(3, 2, NULL, 1, 1, 75.00, 80.00, 2, 150.00, 'Laundry', 'Out', '2022-09-14 18:46:03', '2022-09-14 18:46:03'),
(4, 2, '8902602', 2, 1, 100.00, 120.00, 100, 10000.00, 'Laundry', 'In', '2022-09-14 19:10:54', '2022-09-14 19:10:54'),
(5, 2, '3713959', 1, 1, 50.00, 80.00, 100, 5000.00, 'Laundry', 'In', '2022-09-25 15:37:48', '2022-09-25 15:37:48'),
(6, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-09-30 19:00:38', '2022-09-30 19:00:38'),
(7, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-09-30 19:00:38', '2022-09-30 19:00:38'),
(8, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-09-30 19:00:38', '2022-09-30 19:00:38'),
(9, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-09-30 19:00:38', '2022-09-30 19:00:38'),
(10, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-09-30 19:00:57', '2022-09-30 19:00:57'),
(11, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-09-30 19:00:57', '2022-09-30 19:00:57'),
(12, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-09-30 19:00:57', '2022-09-30 19:00:57'),
(13, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-09-30 19:00:57', '2022-09-30 19:00:57'),
(14, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-09-30 19:02:27', '2022-09-30 19:02:27'),
(15, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-09-30 19:02:27', '2022-09-30 19:02:27'),
(16, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-09-30 19:02:27', '2022-09-30 19:02:27'),
(17, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-09-30 19:02:27', '2022-09-30 19:02:27'),
(18, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-03 19:26:11', '2022-10-03 19:26:11'),
(19, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-03 20:08:33', '2022-10-03 20:08:33'),
(20, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-03 21:06:58', '2022-10-03 21:06:58'),
(21, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-05 11:35:25', '2022-10-05 11:35:25'),
(22, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-05 11:37:40', '2022-10-05 11:37:40'),
(23, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-05 11:37:40', '2022-10-05 11:37:40'),
(24, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-06 11:51:11', '2022-10-06 11:51:11'),
(25, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-06 12:14:05', '2022-10-06 12:14:05'),
(26, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-06 16:10:02', '2022-10-06 16:10:02'),
(27, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-06 18:13:09', '2022-10-06 18:13:09'),
(28, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-06 18:22:03', '2022-10-06 18:22:03'),
(29, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-09 15:22:35', '2022-10-09 15:22:35'),
(30, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-09 15:22:35', '2022-10-09 15:22:35'),
(31, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-09 15:22:35', '2022-10-09 15:22:35'),
(32, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-09 15:22:35', '2022-10-09 15:22:35'),
(33, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-26 12:03:33', '2022-10-26 12:03:33'),
(34, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-26 12:24:57', '2022-10-26 12:24:57'),
(35, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-26 12:26:54', '2022-10-26 12:26:54'),
(36, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-26 12:29:01', '2022-10-26 12:29:01'),
(37, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-10-26 12:29:38', '2022-10-26 12:29:38'),
(38, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-09 18:00:34', '2022-11-09 18:00:34'),
(39, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-09 18:00:35', '2022-11-09 18:00:35'),
(40, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-09 18:00:35', '2022-11-09 18:00:35'),
(41, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-09 18:00:43', '2022-11-09 18:00:43'),
(42, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-09 18:00:43', '2022-11-09 18:00:43'),
(43, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-09 18:00:43', '2022-11-09 18:00:43'),
(44, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-12 14:25:23', '2022-11-12 14:25:23'),
(45, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-12 14:25:23', '2022-11-12 14:25:23'),
(46, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-12 14:25:23', '2022-11-12 14:25:23'),
(47, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-12 14:25:23', '2022-11-12 14:25:23'),
(48, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-12 14:27:49', '2022-11-12 14:27:49'),
(49, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-12 14:27:49', '2022-11-12 14:27:49'),
(50, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-12 14:27:49', '2022-11-12 14:27:49'),
(51, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-12 16:35:19', '2022-11-12 16:35:19'),
(52, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-12 16:35:19', '2022-11-12 16:35:19'),
(53, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-12 16:35:26', '2022-11-12 16:35:26'),
(54, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-12 16:35:26', '2022-11-12 16:35:26'),
(55, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 11:36:13', '2022-11-13 11:36:13'),
(56, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 11:36:13', '2022-11-13 11:36:13'),
(57, 2, NULL, 1, 1, 75.00, 80.00, 3, 225.00, 'Laundry', 'Out', '2022-11-13 11:53:56', '2022-11-13 11:53:56'),
(58, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 11:53:56', '2022-11-13 11:53:56'),
(59, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 11:53:56', '2022-11-13 11:53:56'),
(60, 2, NULL, 1, 1, 75.00, 80.00, 3, 225.00, 'Laundry', 'Out', '2022-11-13 12:08:48', '2022-11-13 12:08:48'),
(61, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 12:08:48', '2022-11-13 12:08:48'),
(62, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 12:08:48', '2022-11-13 12:08:48'),
(63, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 12:14:57', '2022-11-13 12:14:57'),
(64, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 12:14:57', '2022-11-13 12:14:57'),
(65, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 12:16:51', '2022-11-13 12:16:51'),
(66, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 12:16:51', '2022-11-13 12:16:51'),
(67, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 13:51:19', '2022-11-13 13:51:19'),
(68, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 15:29:11', '2022-11-13 15:29:11'),
(69, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 15:29:11', '2022-11-13 15:29:11'),
(70, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 15:29:11', '2022-11-13 15:29:11'),
(71, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 17:26:57', '2022-11-13 17:26:57'),
(72, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 17:26:57', '2022-11-13 17:26:57'),
(73, 2, NULL, 2, 1, 100.00, 120.00, 1, 100.00, 'Laundry', 'Out', '2022-11-13 17:26:57', '2022-11-13 17:26:57'),
(74, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 17:26:57', '2022-11-13 17:26:57'),
(75, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 17:26:57', '2022-11-13 17:26:57'),
(76, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 18:18:11', '2022-11-13 18:18:11'),
(77, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 18:18:11', '2022-11-13 18:18:11'),
(78, 2, NULL, 2, 1, 100.00, 120.00, 1, 100.00, 'Laundry', 'Out', '2022-11-13 18:18:11', '2022-11-13 18:18:11'),
(79, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 18:18:11', '2022-11-13 18:18:11'),
(80, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 18:18:11', '2022-11-13 18:18:11'),
(81, 2, NULL, 1, 1, 75.00, 80.00, 10, 750.00, 'Laundry', 'Out', '2022-11-13 19:14:40', '2022-11-13 19:14:40'),
(82, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 19:14:40', '2022-11-13 19:14:40'),
(83, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 19:14:40', '2022-11-13 19:14:40'),
(84, 2, NULL, 1, 1, 75.00, 80.00, 1, 75.00, 'Laundry', 'Out', '2022-11-13 19:14:40', '2022-11-13 19:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_discounts`
--

CREATE TABLE `laundry_discounts` (
  `id` int(11) NOT NULL,
  `customer_type` varchar(191) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_service_id` int(11) NOT NULL,
  `discount` int(11) NOT NULL COMMENT 'Percentage',
  `status` tinyint(3) NOT NULL COMMENT '1:Active,0:Inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laundry_discounts`
--

INSERT INTO `laundry_discounts` (`id`, `customer_type`, `customer_id`, `product_id`, `product_service_id`, `discount`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Regular', 3, 1, 19, 10, 1, '2022-11-09 11:30:18', '2022-11-09 11:30:18'),
(8, 'Regular', 1, 1, 19, 2, 1, '2022-11-09 12:32:22', '2022-11-09 13:20:24'),
(9, 'Regular', 1, 1, 20, 5, 1, '2022-11-09 12:32:42', '2022-11-09 12:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_items`
--

CREATE TABLE `laundry_items` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `sku` varchar(191) DEFAULT NULL,
  `description` text,
  `image` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1:active,0:inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laundry_items`
--

INSERT INTO `laundry_items` (`id`, `name`, `unit_id`, `sku`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Detergent', 1, '6321c8759bf3e', NULL, 'public/uploads/others/SRcfD4RhnwX45d9Ch1j1KHFb07pv70OAAT7RXoz5llwRGrwxdL7426a4bd1135c6e9c8ec10e8d8b183d1.jpg', 1, '2022-09-14 18:26:59', '2022-09-14 18:26:59'),
(2, 'Fabric', 1, '6321d24863547', '<p>test</p>', 'public/uploads/others/19Q4dSYsb8N5bc1XIs02ExQ5HGQ1Fm6GmwrzYYL3Hb8Z1JUeOF73-738269_girl-cartoon-with-hijab.jpg', 1, '2022-09-14 19:10:03', '2022-09-14 19:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_order_employees`
--

CREATE TABLE `laundry_order_employees` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laundry_order_employees`
--

INSERT INTO `laundry_order_employees` (`id`, `order_id`, `employee_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-09-14 18:26:08', '2022-09-14 18:26:08'),
(2, 2, 1, '2022-09-14 18:44:43', '2022-09-14 18:44:43'),
(3, 7, 1, '2022-09-22 10:14:51', '2022-09-22 10:14:51'),
(4, 8, 2, '2022-10-05 11:34:00', '2022-10-05 11:34:00'),
(5, 35, 1, '2022-11-09 18:00:30', '2022-11-09 18:00:30'),
(6, 38, 1, '2022-11-12 16:34:57', '2022-11-12 16:34:57'),
(7, 41, 1, '2022-11-13 17:26:54', '2022-11-13 17:26:54');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_packages`
--

CREATE TABLE `laundry_packages` (
  `id` int(11) NOT NULL,
  `package_name` varchar(191) NOT NULL,
  `package_amount` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `package_quantity` int(10) DEFAULT NULL COMMENT 'Maximum Quantity for this Package',
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laundry_packages`
--

INSERT INTO `laundry_packages` (`id`, `package_name`, `package_amount`, `duration`, `branch_id`, `package_quantity`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test', 1200, 30, 2, 100, NULL, 1, '2022-10-20 18:53:41', '2022-10-20 18:53:41'),
(2, 'Package 2', 1000, 30, 2, 100, NULL, 1, '2022-10-23 12:44:03', '2022-10-23 12:44:03'),
(3, 'Package 3', 1500, 30, 2, 110, 'public/uploads/laundry package/BCoD4VdlBSdnlsGjXTNpOU9VBRYNkxtSqkqbL5yhLBsY8MNCsZindex.jpg', 1, '2022-10-24 12:45:38', '2022-10-24 12:45:38'),
(4, 'Package 4', 2000, 60, 2, 30, 'public/uploads/laundry package/gwPCUwZhm5KRN1NDSq1Wm4qzy4KwxEOxOiZ9yOhMVRE2d24fRg900012-sachin-tendulkar.jpg', 1, '2022-10-27 12:04:07', '2022-10-27 12:04:07');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_package_items`
--

CREATE TABLE `laundry_package_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `max_qty` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laundry_package_items`
--

INSERT INTO `laundry_package_items` (`id`, `product_id`, `service_id`, `package_id`, `amount`, `max_qty`, `created_at`, `updated_at`, `status`) VALUES
(1, 2, 17, 1, 50, 20, '2022-10-20 18:53:41', '2022-10-20 18:53:41', 1),
(2, 8, 29, 1, 10, 20, '2022-10-20 18:53:41', '2022-10-20 18:53:41', 1),
(3, 14, 42, 1, 20, 20, '2022-10-20 18:53:41', '2022-10-20 18:53:41', 1),
(4, 16, 47, 1, 10, 20, '2022-10-20 18:53:41', '2022-10-20 18:53:41', 1),
(5, 15, 44, 1, 10, 20, '2022-10-20 18:53:41', '2022-10-20 18:53:41', 1),
(6, 1, 19, 2, 30, 10, '2022-10-23 12:44:03', '2022-10-23 12:44:47', 1),
(7, 2, 17, 2, 60, 10, '2022-10-23 12:44:03', '2022-10-23 12:44:47', 1),
(8, 16, 47, 2, 10, 10, '2022-10-23 12:44:47', '2022-10-23 12:44:47', 1),
(9, 5, 23, 3, 100, 10, '2022-10-24 12:45:38', '2022-10-24 12:45:38', 1),
(10, 15, 45, 3, 10, 10, '2022-10-24 12:45:38', '2022-10-24 12:45:38', 1),
(11, 2, 17, 4, 50, 10, '2022-10-27 12:04:07', '2022-10-27 12:04:07', 1),
(12, 6, 25, 4, 50, 10, '2022-10-27 12:04:08', '2022-10-27 12:04:08', 1),
(13, 21, 62, 4, 100, 10, '2022-10-27 12:04:08', '2022-10-27 12:04:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `laundry_pkg_order_items`
--

CREATE TABLE `laundry_pkg_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL COMMENT 'orders table id',
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `amount` double(20,2) DEFAULT '0.00',
  `max_qty` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laundry_pkg_order_items`
--

INSERT INTO `laundry_pkg_order_items` (`id`, `order_id`, `customer_id`, `product_id`, `service_id`, `package_id`, `amount`, `max_qty`, `created_at`, `updated_at`) VALUES
(1, 18, 0, 1, 19, 2, 30.00, 10, '2022-10-26 11:04:11', '2022-10-26 11:04:11'),
(2, 18, 0, 2, 17, 2, 60.00, 10, '2022-10-26 11:04:11', '2022-10-26 11:04:11'),
(3, 18, 0, 16, 47, 2, 10.00, 10, '2022-10-26 11:04:11', '2022-10-26 11:04:11'),
(10, 21, 3, 2, 17, 4, 50.00, 10, '2022-10-27 06:13:17', '2022-10-27 06:13:17'),
(11, 21, 3, 6, 25, 4, 50.00, 10, '2022-10-27 06:13:17', '2022-10-27 06:13:17'),
(12, 21, 3, 21, 62, 4, 200.00, 5, '2022-10-27 06:13:17', '2022-10-27 11:15:56'),
(13, 21, 3, 17, 50, 4, 10.00, 5, '2022-10-27 11:16:43', '2022-10-27 11:16:43'),
(14, 22, 3, 4, 14, 4, 50.00, 5, '2022-10-27 11:28:11', '2022-10-27 11:30:09'),
(15, 22, 3, 6, 25, 4, 50.00, 15, '2022-10-27 11:28:11', '2022-10-27 11:30:09'),
(16, 22, 3, 21, 62, 4, 100.00, 10, '2022-10-27 11:28:11', '2022-10-27 11:28:11');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_products`
--

CREATE TABLE `laundry_products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL COMMENT 'Active,Inactive',
  `price_range` varchar(100) NOT NULL,
  `min_price` int(11) NOT NULL DEFAULT '0',
  `max_price` int(11) NOT NULL DEFAULT '0',
  `shipping_charge` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `product_show_id` tinyint(3) NOT NULL DEFAULT '1' COMMENT '1=show only web, 2= show only corporate, 3= both(web and corporate)',
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laundry_products`
--

INSERT INTO `laundry_products` (`id`, `product_name`, `category_id`, `sku`, `slug`, `description`, `image`, `status`, `price_range`, `min_price`, `max_price`, `shipping_charge`, `rating`, `product_show_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'SHAREE COTTON', 2, '6321c5070bb00lan', 'sharee-cotton', '<p>SHAREE</p>', 'public/uploads/londryproduct/pbXlLJu27uCNyoTXlBeS3cpUEoxGt8zNyx52R9xGOlgTt4T0Mx7426a4bd1135c6e9c8ec10e8d8b183d1.jpg', 'Active', '30-120', 30, 120, 50, 0, 1, 1, '2022-09-26 13:51:57', '2022-09-26 13:51:57'),
(2, 'BLANKET', 3, '6321c5546a1c7lan', 'blanket', '<p><strong>BLANKET</strong></p>', 'public/uploads/londryproduct/pBhlExoCcwXFCjA3wPhteeU0XHAKE5SO8OGoEv9inhNzx2elIK73-738269_girl-cartoon-with-hijab.jpg', 'Active', '200-400', 200, 400, 25, 0, 1, 1, '2022-09-26 13:49:28', '2022-09-26 13:49:28'),
(3, 'test', 2, '6321cdc78a24blan', 'test', '<p>test</p>', 'public/uploads/londryproduct/F32y9lLhSsrvnxGONUf0vpj8Hg4EAwXXSBAFB2pg7nNJZc3vF8atik-vai-300x200.jpg', 'Inactive', '100-120', 100, 120, 25, 0, 1, 1, '2022-09-14 18:51:16', '2022-09-14 18:51:16'),
(4, 'BED SHEET', 3, '633158616abc8lan', 'bed-sheet', '<p>BED SHEET</p>', 'public/uploads/londryproduct/A078EoBr8L7yRNDbADEz0cDVc97uDqRR24b686FiIoens4zWqshosehold.jpg', 'Active', '20-120', 20, 120, 0, 0, 1, 1, '2022-09-26 13:46:48', '2022-09-26 13:46:48'),
(5, 'CARTAIN', 3, '63316329f193dlan', 'cartain', '<p>CARTAIN</p>', 'public/uploads/londryproduct/ZTNrOOPpW6ksdTctxu7r0pDG4IJV4pjlxIjcT6oXYe5QdUqZGghosehold.jpg', 'Active', '25-80', 25, 80, 0, 0, 1, 1, '2022-09-26 14:36:50', '2022-09-26 14:36:50'),
(6, 'KHATA', 3, '633164a50bc6alan', 'khata', '<p>KHATA</p>', 'public/uploads/londryproduct/N6BiRQuYyFNroIJGEsWjXcTDVX9BuUfI6opUeUH2y4RYLVJgDHhosehold.jpg', 'Active', '80-150', 80, 150, 0, 0, 1, 1, '2022-09-26 14:43:03', '2022-09-26 14:43:03'),
(7, 'PILLOW COVER', 3, '6331661912c99lan', 'pillow-cover', '<p>PILLOW COVER</p>', 'public/uploads/londryproduct/eaQWuPbnCnPRUGgyvqfMU9KJAl90yerloDVTiUGpQOzPPNSdL9hosehold.jpg', 'Active', '20-45', 20, 45, 0, 0, 1, 1, '2022-09-26 14:45:08', '2022-09-26 14:45:08'),
(8, 'TOWEL SMALL', 3, '63316695d1428lan', 'towel-small', '<p>TOWEL SMALL</p>', 'public/uploads/londryproduct/S6DEGszXLjSTtoSWgdNHN1U0T6CAWVRY3ttwHHEud36xGjRNf2hosehold.jpg', 'Active', '30-80', 30, 80, 0, 0, 1, 1, '2022-09-26 14:53:39', '2022-09-26 14:53:39'),
(9, 'TOWEL LARGE', 3, '63316894c1dfclan', 'towel-large', '<p>TOWEL LARGE</p>', 'public/uploads/londryproduct/7wnYeHpvUzcFH4GCETDvE3lwfnglKLn7A1k0ASn08VyylbzV3Ghosehold.jpg', 'Select', '50-100', 50, 100, 0, 0, 1, 1, '2022-09-26 14:56:23', '2022-09-26 14:56:23'),
(10, 'BLANKET COVER', 3, '63316938ba74blan', 'blanket-cover', '<p>BLANKET COVER</p>', 'public/uploads/londryproduct/BeWNcXLJ3j7TIU2tWdblvNa3xazyJQLBFkVmQMELNkcsuXQlhVhosehold.jpg', 'Active', '80-130', 80, 130, 0, 0, 1, 1, '2022-09-26 14:58:33', '2022-09-26 14:58:33'),
(11, 'TABLE CLOTH', 3, '633169b9dee7elan', 'table-cloth', '<p>TABLE CLOTH</p>', 'public/uploads/londryproduct/dnzfIyOOrNUXhDTfallShWNziQIX7mg7d2wC7cGKNHdmAFPvUkhosehold.jpg', 'Active', '25-75', 25, 75, 0, 0, 1, 1, '2022-09-26 15:08:18', '2022-09-26 15:08:18'),
(12, 'SOFA SEAT COVER', 3, '63316c02a0100lan', 'sofa-seat-cover', '<p>SOFA SEAT COVER</p>', 'public/uploads/londryproduct/LUMTWKCeMxYmELFzzVr91IVvOUqarpTVULtuAoNaSM0sljwllshosehold.jpg', 'Active', '25-120', 25, 120, 0, 0, 1, 1, '2022-09-26 15:09:47', '2022-09-26 15:09:47'),
(13, 'MOSQUITO NET', 3, '6331930ef3f33lan', 'mosquito-net', '<p>MOSQUITO NET</p>', 'public/uploads/londryproduct/n1gLZsVWfYeNUeQtxlG85Ixk3xbJA3qKTgZEQbNKQrSgMmRGaYhosehold.jpg', 'Active', '80-85', 80, 85, 0, 0, 1, 1, '2022-09-26 17:55:41', '2022-09-26 17:55:41'),
(14, 'TOWEL LARGE', 3, '6331933ebe2a9lan', 'towel-large', '<p>TOWEL LARGE</p>', 'public/uploads/londryproduct/yetqHhcqDuHEdRoTbUeHPaSNy5widc8rSzy7aOH8wYM3CyFSjVhosehold.jpg', 'Active', '50-100', 50, 100, 0, 0, 1, 1, '2022-09-26 17:57:56', '2022-09-26 17:57:56'),
(15, 'SHIRT', 1, '633193f459236lan', 'shirt', '<p>SHIRT</p>', 'public/uploads/londryproduct/acphAtnVIZYPekdJ38pQE5oXSK1ewD5CZ73w2a22Af7HyFu8gjmen.webp', 'Active', '10-60', 10, 60, 0, 0, 1, 1, '2022-09-26 18:00:40', '2022-09-26 18:00:40'),
(16, 'PANT', 1, '6331946ab8d55lan', 'pant', '<p>PANT</p>', 'public/uploads/londryproduct/iu4zEIm1zgFLz4QKQ27dGjUivTDmdt1GH4KwwvtkmKjoJDu0Mtmen.webp', 'Active', '10-60', 10, 60, 0, 0, 1, 1, '2022-09-26 18:01:51', '2022-09-26 18:01:51'),
(17, 'T-SHIRT', 1, '633194b079cc3lan', 't-shirt', '<p>T-SHIRT</p>', 'public/uploads/londryproduct/IzLnpN5pHiXiMry51jQqRA5Wt2RexGSuRPVFUX4uRtMDYvLaK1men.webp', 'Active', '10-60', 10, 60, 0, 0, 1, 1, '2022-09-26 18:03:12', '2022-09-26 18:03:12'),
(18, 'PANJABI/PAIJAMA', 1, '6331950269e11lan', 'panjabi-paijama', '<p>PANJABI/PAIJAMA</p>', 'public/uploads/londryproduct/aHMbcvDrwU026zmfBIT0MjYGg7RlXt2vQdpiP0vavh6fXJraO6men.webp', 'Active', '10-60', 10, 60, 0, 0, 1, 1, '2022-09-26 18:04:44', '2022-09-26 18:04:44'),
(19, 'JACKET', 1, '6331955d78a42lan', 'jacket', '<p>JACKET</p>', 'public/uploads/londryproduct/ruYpQmOHJox3mqnRfjiuTF99ojcmzeUlKQSDZeDuXPIfPro7icmen.webp', 'Active', '30-150', 30, 150, 0, 0, 1, 1, '2022-09-26 18:08:48', '2022-09-26 18:08:48'),
(20, 'SAFARI SUIT', 1, '633196518f970lan', 'safari-suit', '<p>SAFARI SUIT</p>', 'public/uploads/londryproduct/hanMAqerpB8E1q2J6XttFlCThIgpMp7qv5yUrGrxqikDnwLhd3men.webp', 'Active', '30-1230', 30, 1230, 0, 0, 1, 1, '2022-09-26 18:10:03', '2022-09-26 18:10:03'),
(21, 'BLAZER/COAT', 1, '6331969f8a92blan', 'blazer-coat', '<p>BLAZER/COAT</p>', 'public/uploads/londryproduct/lyXxuKyeOGAASC4EqPxl0p97fA2Gd28kVJOBrH0UCNIFgDfY5Kmen.webp', 'Active', '50-150', 50, 150, 0, 0, 1, 1, '2022-09-26 18:26:12', '2022-09-26 18:26:12'),
(22, 'LUNGI', 1, '63319a65d677blan', 'lungi', '<p>LUNGI</p>', 'public/uploads/londryproduct/3sQtyNTUGo1Y13lFPFIvBtPJBco4E2WdF8aoXpQbZbYazJTceimen.webp', 'Active', '10-40', 10, 40, 0, 0, 1, 1, '2022-09-26 18:27:13', '2022-09-26 18:27:13'),
(23, 'LUNGI', 1, '63319a65d677blan', 'lungi', '<p>LUNGI</p>', 'public/uploads/londryproduct/QvhlSFq3xk4yzWMnswuAJNqeFw8SSA2Gnr9CWCE3VhXwfTB7I1men.webp', 'Inactive', '10-40', 10, 40, NULL, 0, 1, 1, '2022-09-26 18:28:12', '2022-09-26 18:28:12'),
(24, 'SHERWANI', 1, '63319ae40bcealan', 'sherwani', '<p>SHERWANI</p>', 'public/uploads/londryproduct/ZJHpprSdVQkOF2fTSrE0MzMIZLg1LfDCdFxXh6lRrqaVMLC6Itmen.webp', 'Active', '80-350', 80, 350, 0, 0, 1, 1, '2022-09-26 18:30:08', '2022-09-26 18:30:08'),
(25, 'SWEATER', 1, '63319b531857elan', 'sweater', '<p>SWEATER</p>', 'public/uploads/londryproduct/kLu4gR42Z2WmnYJmn9NaN9xobk4qHnhgfqvocUBGlN5DRVCm3Emen.webp', 'Active', '30-130', 30, 130, 0, 0, 1, 1, '2022-09-26 18:33:18', '2022-09-26 18:33:18'),
(26, 'PANJABI SILK', 1, '63319c107a0d5lan', 'panjabi-silk', '<p>PANJABI SILK</p>', 'public/uploads/londryproduct/4UQ0lkLj55XfidgeL2ZfEStOp3dyQTgUlTxeP1iYToZ36wEof0men.webp', 'Active', '10-80', 10, 80, 0, 0, 1, 1, '2022-09-26 18:35:12', '2022-09-26 18:35:12'),
(27, 'PANT COLOUR', 1, '63319c8304d41lan', 'pant-colour', '<p>PANT COLOUR</p>', 'public/uploads/londryproduct/9y5SZyCWpAHRLvwE9EbGKqu0Bct0MNn937lGKgEYC3dUemzSrSmen.webp', 'Active', '140-140', 140, 140, 0, 0, 1, 1, '2022-09-26 18:36:27', '2022-09-26 18:36:27'),
(28, 'KAMEEZ COTTON', 2, '63354639536c1lan', 'kameez-cotton', '<p>KAMEEZ COTTON</p>', 'public/uploads/londryproduct/XfjGs0KFGJbufXcZa8Bfmc9iyBhjeWFsalRSZtvLZitWxwj7ENwomen.webp', 'Active', '10-60', 10, 60, 0, 0, 1, 1, '2022-09-29 13:17:50', '2022-09-29 13:17:50'),
(29, 'KAMEZZ SILK', 2, '633546a062421lan', 'kamezz-silk', '<p>KAMEZZ SILK</p>', 'public/uploads/londryproduct/CMwgKiMT8LChxwxsVmSDWTp0s2XV2ITlnbuePDMbgvzL2k1BdQwomen.webp', 'Active', '10-90', 10, 90, 0, 0, 1, 1, '2022-09-29 13:19:16', '2022-09-29 13:19:16'),
(30, 'SALOWER', 2, '633546f64a827lan', 'salower', '<p>SALOWER</p>', 'public/uploads/londryproduct/4sOmIOCnm74Z5CKGVKzOH4HkZpVbg9sLlHuTwOst75azIXZVrVwomen dress.jpg', 'Active', '10-70', 10, 70, 0, 0, 1, 1, '2022-09-29 13:21:00', '2022-09-29 13:21:00'),
(31, 'BLOUSE', 2, '6335475e295dalan', 'blouse', '<p>BLOUSE</p>', 'public/uploads/londryproduct/pYQM4ngnkqSBEhnxCHmScm0oW2VKPDi6gsTor5bSm6nhmyJENWwomen.webp', 'Active', '10-60', 10, 60, 0, 0, 1, 1, '2022-09-29 13:22:21', '2022-09-29 13:22:21'),
(32, 'SAREE (B COTTON)', 2, '633547ae29ea9lan', 'saree-b-cotton-', '<p>SAREE (B COTTON)</p>', 'public/uploads/londryproduct/BUcbSBMDDRwmEGoUmXlY1v5FI0K4MFd6NoyED79ChKOcxp1tWvwomen.webp', 'Active', '60-250', 60, 250, 0, 0, 1, 1, '2022-09-29 13:24:30', '2022-09-29 13:24:30'),
(33, 'SAREE JAMDANI', 2, '6335482f3ae54lan', 'saree-jamdani', '<p>SAREE JAMDANI</p>', 'public/uploads/londryproduct/la4K6IJ97BVadjvMl6AR42MKDXm38v8OpQtJ8LxgdyWgDN5JoXwomen.webp', 'Active', '70-200', 70, 200, 0, 0, 1, 1, '2022-09-29 13:25:37', '2022-09-29 13:25:37'),
(34, 'SAREE SILK', 2, '63354871e5909lan', 'saree-silk', '<p>SAREE SILK</p>', 'public/uploads/londryproduct/BMf4DgzTGBOkq1Fp6YpD1TRFtbBxceAixtE3TehSRDU0uNgtX5women.webp', 'Active', '60-180', 60, 180, 0, 0, 1, 1, '2022-09-29 13:26:43', '2022-09-29 13:26:43'),
(35, 'SAREE SILK', 2, '63354871e5909lan', 'saree-silk', '<p>SAREE SILK</p>', 'public/uploads/londryproduct/BChHFc6ixjCZiCI1UF29sofCtAZUwBlPZ2VbvSfpqdbwa23QR4women.webp', 'Active', '60-180', 60, 180, 0, 0, 1, 1, '2022-09-29 13:26:43', '2022-09-29 13:26:43'),
(36, 'BORKA', 2, '633548b436361lan', 'borka', '<p>BORKA</p>', 'public/uploads/londryproduct/nT7ULcUO3Y34hT01AO7BgVkU2RlvfFmpsu5IV7JJkmrO2fym15women dress.jpg', 'Active', '20-60', 20, 60, 0, 0, 1, 1, '2022-09-29 13:28:14', '2022-09-29 13:28:14'),
(37, 'SHAWL', 2, '6335490f6250dlan', 'shawl', '<p>SHAWL</p>', 'public/uploads/londryproduct/aMRM88KNb4tIMFu7i9ajxHinr0e38LTgUyEuQPrMkHf6MXevXjwomen.webp', 'Active', '20-120', 20, 120, 0, 0, 1, 1, '2022-09-29 13:29:09', '2022-09-29 13:29:09'),
(38, 'ORNA', 2, '63354945965b2lan', 'orna', '<p>ORNA</p>', 'public/uploads/londryproduct/XRvr0DV0Z3rN5q9acZHsZtuJKgQMio0eBU9QtrKwQQinGbiFmtwomen dress.jpg', 'Active', '10-60', 10, 60, 0, 0, 1, 1, '2022-09-29 13:30:42', '2022-09-29 13:30:42'),
(39, 'HIJAB', 2, '633549a50c4felan', 'hijab', '<p>HIJAB</p>', 'public/uploads/londryproduct/Z57ogkZ1C6Rc7hx7HujSPZ6K0c5vtgBDqXYhgo9fTfOTWMjRgnwomen.webp', 'Active', '10-60', 10, 60, 0, 0, 1, 1, '2022-09-29 13:32:34', '2022-09-29 13:32:34'),
(40, 'Corporate Product', 3, '635cd868540aelan', 'corporate-product', '<p>Corporate Product</p>', 'public/uploads/londryproduct/AYKQdhQhYl7xoTh7uuLgDgWnzOr97W9NP2ABWDlAf12IcdtkUqindex.jpg', 'Active', '50-100', 50, 100, 0, 0, 2, 1, '2022-10-29 13:39:36', '2022-10-29 13:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_product_branches`
--

CREATE TABLE `laundry_product_branches` (
  `id` bigint(11) NOT NULL,
  `laundry_product_id` int(11) NOT NULL,
  `laundry_branch_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laundry_product_branches`
--

INSERT INTO `laundry_product_branches` (`id`, `laundry_product_id`, `laundry_branch_id`, `created_at`, `updated_at`) VALUES
(7, 3, 1, '2022-09-14 18:51:16', '2022-09-14 18:51:16'),
(8, 3, 2, '2022-09-14 18:51:16', '2022-09-14 18:51:16'),
(11, 4, 2, '2022-09-26 13:46:49', '2022-09-26 13:46:49'),
(12, 2, 1, '2022-09-26 13:49:28', '2022-09-26 13:49:28'),
(13, 2, 2, '2022-09-26 13:49:28', '2022-09-26 13:49:28'),
(14, 1, 1, '2022-09-26 13:51:57', '2022-09-26 13:51:57'),
(15, 1, 2, '2022-09-26 13:51:57', '2022-09-26 13:51:57'),
(16, 5, 1, '2022-09-26 14:36:50', '2022-09-26 14:36:50'),
(17, 5, 2, '2022-09-26 14:36:50', '2022-09-26 14:36:50'),
(18, 6, 1, '2022-09-26 14:43:03', '2022-09-26 14:43:03'),
(19, 6, 2, '2022-09-26 14:43:03', '2022-09-26 14:43:03'),
(20, 7, 1, '2022-09-26 14:45:08', '2022-09-26 14:45:08'),
(21, 7, 2, '2022-09-26 14:45:08', '2022-09-26 14:45:08'),
(22, 8, 1, '2022-09-26 14:53:39', '2022-09-26 14:53:39'),
(23, 8, 2, '2022-09-26 14:53:39', '2022-09-26 14:53:39'),
(24, 9, 1, '2022-09-26 14:56:23', '2022-09-26 14:56:23'),
(25, 9, 2, '2022-09-26 14:56:23', '2022-09-26 14:56:23'),
(26, 10, 1, '2022-09-26 14:58:33', '2022-09-26 14:58:33'),
(27, 10, 2, '2022-09-26 14:58:33', '2022-09-26 14:58:33'),
(28, 11, 1, '2022-09-26 15:08:18', '2022-09-26 15:08:18'),
(29, 11, 2, '2022-09-26 15:08:18', '2022-09-26 15:08:18'),
(30, 12, 1, '2022-09-26 15:09:47', '2022-09-26 15:09:47'),
(31, 12, 2, '2022-09-26 15:09:47', '2022-09-26 15:09:47'),
(32, 13, 2, '2022-09-26 17:55:41', '2022-09-26 17:55:41'),
(33, 14, 1, '2022-09-26 17:57:56', '2022-09-26 17:57:56'),
(34, 14, 2, '2022-09-26 17:57:56', '2022-09-26 17:57:56'),
(35, 15, 1, '2022-09-26 18:00:40', '2022-09-26 18:00:40'),
(36, 15, 2, '2022-09-26 18:00:40', '2022-09-26 18:00:40'),
(37, 16, 1, '2022-09-26 18:01:51', '2022-09-26 18:01:51'),
(38, 16, 2, '2022-09-26 18:01:51', '2022-09-26 18:01:51'),
(39, 17, 1, '2022-09-26 18:03:13', '2022-09-26 18:03:13'),
(40, 17, 2, '2022-09-26 18:03:13', '2022-09-26 18:03:13'),
(41, 18, 1, '2022-09-26 18:04:44', '2022-09-26 18:04:44'),
(42, 18, 2, '2022-09-26 18:04:44', '2022-09-26 18:04:44'),
(43, 19, 1, '2022-09-26 18:08:48', '2022-09-26 18:08:48'),
(44, 19, 2, '2022-09-26 18:08:48', '2022-09-26 18:08:48'),
(45, 20, 1, '2022-09-26 18:10:03', '2022-09-26 18:10:03'),
(46, 20, 2, '2022-09-26 18:10:04', '2022-09-26 18:10:04'),
(47, 21, 1, '2022-09-26 18:26:12', '2022-09-26 18:26:12'),
(48, 21, 2, '2022-09-26 18:26:12', '2022-09-26 18:26:12'),
(49, 22, 1, '2022-09-26 18:27:13', '2022-09-26 18:27:13'),
(50, 22, 2, '2022-09-26 18:27:13', '2022-09-26 18:27:13'),
(53, 23, 1, '2022-09-26 18:28:13', '2022-09-26 18:28:13'),
(54, 23, 2, '2022-09-26 18:28:13', '2022-09-26 18:28:13'),
(55, 24, 1, '2022-09-26 18:30:08', '2022-09-26 18:30:08'),
(56, 24, 2, '2022-09-26 18:30:08', '2022-09-26 18:30:08'),
(57, 25, 1, '2022-09-26 18:33:18', '2022-09-26 18:33:18'),
(58, 25, 2, '2022-09-26 18:33:18', '2022-09-26 18:33:18'),
(59, 26, 1, '2022-09-26 18:35:12', '2022-09-26 18:35:12'),
(60, 26, 2, '2022-09-26 18:35:12', '2022-09-26 18:35:12'),
(61, 27, 1, '2022-09-26 18:36:27', '2022-09-26 18:36:27'),
(62, 27, 2, '2022-09-26 18:36:27', '2022-09-26 18:36:27'),
(63, 28, 1, '2022-09-29 13:17:50', '2022-09-29 13:17:50'),
(64, 28, 2, '2022-09-29 13:17:50', '2022-09-29 13:17:50'),
(65, 29, 1, '2022-09-29 13:19:16', '2022-09-29 13:19:16'),
(66, 29, 2, '2022-09-29 13:19:16', '2022-09-29 13:19:16'),
(67, 30, 1, '2022-09-29 13:21:00', '2022-09-29 13:21:00'),
(68, 30, 2, '2022-09-29 13:21:00', '2022-09-29 13:21:00'),
(69, 31, 1, '2022-09-29 13:22:21', '2022-09-29 13:22:21'),
(70, 31, 2, '2022-09-29 13:22:21', '2022-09-29 13:22:21'),
(71, 32, 1, '2022-09-29 13:24:30', '2022-09-29 13:24:30'),
(72, 32, 2, '2022-09-29 13:24:30', '2022-09-29 13:24:30'),
(73, 33, 1, '2022-09-29 13:25:37', '2022-09-29 13:25:37'),
(74, 33, 2, '2022-09-29 13:25:37', '2022-09-29 13:25:37'),
(75, 34, 1, '2022-09-29 13:26:43', '2022-09-29 13:26:43'),
(76, 34, 2, '2022-09-29 13:26:43', '2022-09-29 13:26:43'),
(77, 35, 1, '2022-09-29 13:26:43', '2022-09-29 13:26:43'),
(78, 35, 2, '2022-09-29 13:26:43', '2022-09-29 13:26:43'),
(79, 36, 1, '2022-09-29 13:28:14', '2022-09-29 13:28:14'),
(80, 36, 2, '2022-09-29 13:28:14', '2022-09-29 13:28:14'),
(81, 37, 1, '2022-09-29 13:29:09', '2022-09-29 13:29:09'),
(82, 37, 2, '2022-09-29 13:29:09', '2022-09-29 13:29:09'),
(83, 38, 1, '2022-09-29 13:30:43', '2022-09-29 13:30:43'),
(84, 38, 2, '2022-09-29 13:30:43', '2022-09-29 13:30:43'),
(85, 39, 1, '2022-09-29 13:32:35', '2022-09-29 13:32:35'),
(86, 39, 2, '2022-09-29 13:32:35', '2022-09-29 13:32:35'),
(87, 40, 1, '2022-10-29 13:39:36', '2022-10-29 13:39:36'),
(88, 40, 2, '2022-10-29 13:39:36', '2022-10-29 13:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_product_categories`
--

CREATE TABLE `laundry_product_categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL COMMENT 'Active,Inactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laundry_product_categories`
--

INSERT INTO `laundry_product_categories` (`id`, `cat_name`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Men', 'men', 'public/uploads/londryproduct/mELFCmSrm44Rj0MkK22DOENrt4XB1aokQ1kh6QWUhAjCwkYgRomen dress.webp', 'Active', '2022-09-14 18:10:53', '2022-09-22 10:37:33'),
(2, 'Women', 'women', 'public/uploads/londryproduct/YXBjCHNy2UTLIZrGlslhf3wk203jxfthh8qsOxai9oLiQUnQ5Ywomen dress.jpg', 'Active', '2022-09-14 18:11:02', '2022-09-22 10:37:11'),
(3, 'Household', 'household', 'public/uploads/londryproduct/o8oarsPWxdMW4LArhm7MTSmAqAs4KSmXW45jGRjkVX10eLBpTThosehold.jpg', 'Active', '2022-09-22 10:46:41', '2022-09-22 10:46:41'),
(4, 'Corporate', 'corporate', 'public/uploads/londryproduct/dETklaixDGbmUMRY0Zg1izqSj9jQc1It6B2PWXUgM4gWKbXR6Hindex.jpg', 'Active', '2022-10-29 19:16:53', '2022-10-29 19:16:53');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_product_services`
--

CREATE TABLE `laundry_product_services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL COMMENT 'Active,Inactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laundry_product_services`
--

INSERT INTO `laundry_product_services` (`id`, `service_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Laundry', 'Active', '2022-09-14 18:11:26', '2022-09-14 18:11:26'),
(2, 'Wash', 'Active', '2022-09-14 18:11:34', '2022-09-14 18:11:34'),
(3, 'Dry Wash', 'Active', '2022-09-14 18:11:43', '2022-09-14 18:11:43'),
(4, 'Iron', 'Inactive', '2022-09-22 10:24:05', '2022-09-26 17:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_product_uses`
--

CREATE TABLE `laundry_product_uses` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `uses_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laundry_product_uses`
--

INSERT INTO `laundry_product_uses` (`id`, `order_id`, `branch_id`, `item_id`, `quantity`, `uses_date`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 2, '2022-09-14 18:29:26', '2022-09-14 18:29:26', '2022-09-14 18:29:26'),
(2, 2, 2, 1, 2, '2022-09-14 18:46:03', '2022-09-14 18:46:03', '2022-09-14 18:46:03'),
(3, 8, 2, 1, 1, '2022-09-30 19:00:38', '2022-09-30 19:00:38', '2022-09-30 19:00:38'),
(4, 8, 2, 1, 1, '2022-09-30 19:00:38', '2022-09-30 19:00:38', '2022-09-30 19:00:38'),
(5, 8, 2, 1, 1, '2022-09-30 19:00:38', '2022-09-30 19:00:38', '2022-09-30 19:00:38'),
(6, 8, 2, 1, 1, '2022-09-30 19:00:38', '2022-09-30 19:00:38', '2022-09-30 19:00:38'),
(7, 8, 2, 1, 1, '2022-09-30 19:00:57', '2022-09-30 19:00:57', '2022-09-30 19:00:57'),
(8, 8, 2, 1, 1, '2022-09-30 19:00:57', '2022-09-30 19:00:57', '2022-09-30 19:00:57'),
(9, 8, 2, 1, 1, '2022-09-30 19:00:57', '2022-09-30 19:00:57', '2022-09-30 19:00:57'),
(10, 8, 2, 1, 1, '2022-09-30 19:00:57', '2022-09-30 19:00:57', '2022-09-30 19:00:57'),
(11, 8, 2, 1, 1, '2022-09-30 19:02:27', '2022-09-30 19:02:27', '2022-09-30 19:02:27'),
(12, 8, 2, 1, 1, '2022-09-30 19:02:27', '2022-09-30 19:02:27', '2022-09-30 19:02:27'),
(13, 8, 2, 1, 1, '2022-09-30 19:02:27', '2022-09-30 19:02:27', '2022-09-30 19:02:27'),
(14, 8, 2, 1, 1, '2022-09-30 19:02:27', '2022-09-30 19:02:27', '2022-09-30 19:02:27'),
(15, 9, 2, 1, 1, '2022-10-03 19:26:11', '2022-10-03 19:26:11', '2022-10-03 19:26:11'),
(16, 10, 2, 1, 1, '2022-10-03 20:08:33', '2022-10-03 20:08:33', '2022-10-03 20:08:33'),
(17, 11, 2, 1, 1, '2022-10-03 21:06:58', '2022-10-03 21:06:58', '2022-10-03 21:06:58'),
(18, 8, 2, 1, 1, '2022-10-05 11:35:25', '2022-10-05 11:35:25', '2022-10-05 11:35:25'),
(19, 12, 2, 1, 1, '2022-10-05 11:37:40', '2022-10-05 11:37:40', '2022-10-05 11:37:40'),
(20, 12, 2, 1, 1, '2022-10-05 11:37:40', '2022-10-05 11:37:40', '2022-10-05 11:37:40'),
(21, 13, 2, 1, 1, '2022-10-06 11:51:11', '2022-10-06 11:51:11', '2022-10-06 11:51:11'),
(22, 14, 2, 1, 1, '2022-10-06 12:14:05', '2022-10-06 12:14:05', '2022-10-06 12:14:05'),
(23, 15, 2, 1, 1, '2022-10-06 16:10:02', '2022-10-06 16:10:02', '2022-10-06 16:10:02'),
(24, 16, 2, 1, 1, '2022-10-06 18:13:09', '2022-10-06 18:13:09', '2022-10-06 18:13:09'),
(25, 17, 2, 1, 1, '2022-10-06 18:22:03', '2022-10-06 18:22:03', '2022-10-06 18:22:03'),
(26, 18, 2, 1, 1, '2022-10-09 15:22:35', '2022-10-09 15:22:35', '2022-10-09 15:22:35'),
(27, 18, 2, 1, 1, '2022-10-09 15:22:35', '2022-10-09 15:22:35', '2022-10-09 15:22:35'),
(28, 18, 2, 1, 1, '2022-10-09 15:22:35', '2022-10-09 15:22:35', '2022-10-09 15:22:35'),
(29, 18, 2, 1, 1, '2022-10-09 15:22:35', '2022-10-09 15:22:35', '2022-10-09 15:22:35'),
(30, 21, 2, 1, 1, '2022-10-26 12:03:33', '2022-10-26 12:03:33', '2022-10-26 12:03:33'),
(31, 22, 2, 1, 1, '2022-10-26 12:24:57', '2022-10-26 12:24:57', '2022-10-26 12:24:57'),
(32, 22, 2, 1, 1, '2022-10-26 12:26:54', '2022-10-26 12:26:54', '2022-10-26 12:26:54'),
(33, 23, 2, 1, 1, '2022-10-26 12:29:01', '2022-10-26 12:29:01', '2022-10-26 12:29:01'),
(34, 24, 2, 1, 1, '2022-10-26 12:29:38', '2022-10-26 12:29:38', '2022-10-26 12:29:38'),
(35, 35, 2, 1, 1, '2022-11-09 18:00:34', '2022-11-09 18:00:34', '2022-11-09 18:00:34'),
(36, 35, 2, 1, 1, '2022-11-09 18:00:35', '2022-11-09 18:00:35', '2022-11-09 18:00:35'),
(37, 35, 2, 1, 1, '2022-11-09 18:00:35', '2022-11-09 18:00:35', '2022-11-09 18:00:35'),
(38, 35, 2, 1, 1, '2022-11-09 18:00:43', '2022-11-09 18:00:43', '2022-11-09 18:00:43'),
(39, 35, 2, 1, 1, '2022-11-09 18:00:43', '2022-11-09 18:00:43', '2022-11-09 18:00:43'),
(40, 35, 2, 1, 1, '2022-11-09 18:00:43', '2022-11-09 18:00:43', '2022-11-09 18:00:43'),
(41, 31, 2, 1, 1, '2022-11-12 14:25:23', '2022-11-12 14:25:23', '2022-11-12 14:25:23'),
(42, 31, 2, 1, 1, '2022-11-12 14:25:23', '2022-11-12 14:25:23', '2022-11-12 14:25:23'),
(43, 31, 2, 1, 1, '2022-11-12 14:25:23', '2022-11-12 14:25:23', '2022-11-12 14:25:23'),
(44, 31, 2, 1, 1, '2022-11-12 14:25:23', '2022-11-12 14:25:23', '2022-11-12 14:25:23'),
(45, 27, 2, 1, 1, '2022-11-12 14:27:49', '2022-11-12 14:27:49', '2022-11-12 14:27:49'),
(46, 27, 2, 1, 1, '2022-11-12 14:27:49', '2022-11-12 14:27:49', '2022-11-12 14:27:49'),
(47, 27, 2, 1, 1, '2022-11-12 14:27:49', '2022-11-12 14:27:49', '2022-11-12 14:27:49'),
(48, 38, 2, 1, 1, '2022-11-12 16:35:19', '2022-11-12 16:35:19', '2022-11-12 16:35:19'),
(49, 38, 2, 1, 1, '2022-11-12 16:35:19', '2022-11-12 16:35:19', '2022-11-12 16:35:19'),
(50, 38, 2, 1, 1, '2022-11-12 16:35:26', '2022-11-12 16:35:26', '2022-11-12 16:35:26'),
(51, 38, 2, 1, 1, '2022-11-12 16:35:26', '2022-11-12 16:35:26', '2022-11-12 16:35:26'),
(52, 36, 2, 1, 1, '2022-11-13 11:36:13', '2022-11-13 11:36:13', '2022-11-13 11:36:13'),
(53, 36, 2, 1, 1, '2022-11-13 11:36:13', '2022-11-13 11:36:13', '2022-11-13 11:36:13'),
(54, 37, 2, 1, 3, '2022-11-13 11:53:56', '2022-11-13 11:53:56', '2022-11-13 11:53:56'),
(55, 37, 2, 1, 1, '2022-11-13 11:53:56', '2022-11-13 11:53:56', '2022-11-13 11:53:56'),
(56, 37, 2, 1, 1, '2022-11-13 11:53:56', '2022-11-13 11:53:56', '2022-11-13 11:53:56'),
(57, 38, 2, 1, 3, '2022-11-13 12:08:48', '2022-11-13 12:08:48', '2022-11-13 12:08:48'),
(58, 38, 2, 1, 1, '2022-11-13 12:08:48', '2022-11-13 12:08:48', '2022-11-13 12:08:48'),
(59, 38, 2, 1, 1, '2022-11-13 12:08:48', '2022-11-13 12:08:48', '2022-11-13 12:08:48'),
(60, 39, 2, 1, 1, '2022-11-13 12:14:57', '2022-11-13 12:14:57', '2022-11-13 12:14:57'),
(61, 39, 2, 1, 1, '2022-11-13 12:14:57', '2022-11-13 12:14:57', '2022-11-13 12:14:57'),
(62, 41, 2, 1, 1, '2022-11-13 12:16:51', '2022-11-13 12:16:51', '2022-11-13 12:16:51'),
(63, 41, 2, 1, 1, '2022-11-13 12:16:51', '2022-11-13 12:16:51', '2022-11-13 12:16:51'),
(64, 42, 2, 1, 1, '2022-11-13 13:51:19', '2022-11-13 13:51:19', '2022-11-13 13:51:19'),
(65, 44, 2, 1, 1, '2022-11-13 15:29:11', '2022-11-13 15:29:11', '2022-11-13 15:29:11'),
(66, 44, 2, 1, 1, '2022-11-13 15:29:11', '2022-11-13 15:29:11', '2022-11-13 15:29:11'),
(67, 44, 2, 1, 1, '2022-11-13 15:29:11', '2022-11-13 15:29:11', '2022-11-13 15:29:11'),
(68, 41, 2, 1, 1, '2022-11-13 17:26:57', '2022-11-13 17:26:57', '2022-11-13 17:26:57'),
(69, 41, 2, 1, 1, '2022-11-13 17:26:57', '2022-11-13 17:26:57', '2022-11-13 17:26:57'),
(70, 41, 2, 2, 1, '2022-11-13 17:26:57', '2022-11-13 17:26:57', '2022-11-13 17:26:57'),
(71, 41, 2, 1, 1, '2022-11-13 17:26:57', '2022-11-13 17:26:57', '2022-11-13 17:26:57'),
(72, 41, 2, 1, 1, '2022-11-13 17:26:57', '2022-11-13 17:26:57', '2022-11-13 17:26:57'),
(73, 41, 2, 1, 1, '2022-11-13 18:18:11', '2022-11-13 18:18:11', '2022-11-13 18:18:11'),
(74, 41, 2, 1, 1, '2022-11-13 18:18:11', '2022-11-13 18:18:11', '2022-11-13 18:18:11'),
(75, 41, 2, 2, 1, '2022-11-13 18:18:11', '2022-11-13 18:18:11', '2022-11-13 18:18:11'),
(76, 41, 2, 1, 1, '2022-11-13 18:18:11', '2022-11-13 18:18:11', '2022-11-13 18:18:11'),
(77, 41, 2, 1, 1, '2022-11-13 18:18:11', '2022-11-13 18:18:11', '2022-11-13 18:18:11'),
(78, 48, 2, 1, 10, '2022-11-13 19:14:40', '2022-11-13 19:14:40', '2022-11-13 19:14:40'),
(79, 48, 2, 1, 1, '2022-11-13 19:14:40', '2022-11-13 19:14:40', '2022-11-13 19:14:40'),
(80, 48, 2, 1, 1, '2022-11-13 19:14:40', '2022-11-13 19:14:40', '2022-11-13 19:14:40'),
(81, 48, 2, 1, 1, '2022-11-13 19:14:40', '2022-11-13 19:14:40', '2022-11-13 19:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_service_costs`
--

CREATE TABLE `laundry_service_costs` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1:active,0:inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laundry_service_costs`
--

INSERT INTO `laundry_service_costs` (`id`, `product_id`, `item_id`, `branch_id`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 2, 2, 1, '2022-09-19 21:44:40', '2022-09-20 20:39:30'),
(2, 6, 2, 2, 1, 0, '2022-09-19 21:44:40', '2022-09-20 20:39:30'),
(3, 2, 1, 2, 2, 1, '2022-09-21 22:03:40', '2022-09-26 13:49:28'),
(4, 4, 1, 2, 1, 1, '2022-09-26 13:46:49', '2022-09-26 13:46:49'),
(5, 1, 1, 2, 1, 1, '2022-09-26 13:51:57', '2022-09-26 13:51:57'),
(6, 5, 1, 2, 1, 1, '2022-09-26 14:36:50', '2022-09-26 14:36:50'),
(7, 6, 1, 2, 1, 1, '2022-09-26 14:43:03', '2022-09-26 14:43:03'),
(8, 7, 1, 2, 1, 1, '2022-09-26 14:45:08', '2022-09-26 14:45:08'),
(9, 8, 1, 2, 1, 1, '2022-09-26 14:53:39', '2022-09-26 14:53:39'),
(10, 9, 1, 2, 1, 1, '2022-09-26 14:56:23', '2022-09-26 14:56:23'),
(11, 10, 1, 2, 1, 1, '2022-09-26 14:58:33', '2022-09-26 14:58:33'),
(12, 11, 1, 2, 1, 1, '2022-09-26 15:08:18', '2022-09-26 15:08:18'),
(13, 12, 1, 2, 1, 1, '2022-09-26 15:09:47', '2022-09-26 15:09:47'),
(14, 13, 2, 2, 1, 1, '2022-09-26 17:55:41', '2022-09-26 17:55:41'),
(15, 14, 1, 2, 1, 1, '2022-09-26 17:57:56', '2022-09-26 17:57:56'),
(16, 15, 1, 2, 1, 1, '2022-09-26 18:00:40', '2022-09-26 18:00:40'),
(17, 16, 1, 2, 1, 1, '2022-09-26 18:01:51', '2022-09-26 18:01:51'),
(18, 17, 1, 2, 1, 1, '2022-09-26 18:03:13', '2022-09-26 18:03:13'),
(19, 18, 1, 2, 1, 1, '2022-09-26 18:04:44', '2022-09-26 18:04:44'),
(20, 19, 1, 2, 1, 1, '2022-09-26 18:08:48', '2022-09-26 18:08:48'),
(21, 20, 1, 2, 1, 1, '2022-09-26 18:10:04', '2022-09-26 18:10:04'),
(22, 21, 1, 2, 1, 1, '2022-09-26 18:26:12', '2022-09-26 18:26:12'),
(23, 22, 1, 2, 1, 1, '2022-09-26 18:27:13', '2022-09-26 18:27:13'),
(24, 23, 1, 2, 1, 1, '2022-09-26 18:27:15', '2022-09-26 18:28:13'),
(25, 24, 1, 2, 1, 1, '2022-09-26 18:30:08', '2022-09-26 18:30:08'),
(26, 25, 1, 2, 1, 1, '2022-09-26 18:33:18', '2022-09-26 18:33:18'),
(27, 26, 1, 2, 1, 1, '2022-09-26 18:35:12', '2022-09-26 18:35:12'),
(28, 27, 1, 2, 1, 1, '2022-09-26 18:36:27', '2022-09-26 18:36:27'),
(29, 28, 1, 2, 1, 1, '2022-09-29 13:17:50', '2022-09-29 13:17:50'),
(30, 29, 1, 2, 1, 1, '2022-09-29 13:19:16', '2022-09-29 13:19:16'),
(31, 30, 1, 2, 1, 1, '2022-09-29 13:21:00', '2022-09-29 13:21:00'),
(32, 31, 1, 2, 1, 1, '2022-09-29 13:22:21', '2022-09-29 13:22:21'),
(33, 32, 1, 2, 1, 1, '2022-09-29 13:24:30', '2022-09-29 13:24:30'),
(34, 33, 1, 2, 1, 1, '2022-09-29 13:25:37', '2022-09-29 13:25:37'),
(35, 34, 1, 2, 1, 1, '2022-09-29 13:26:43', '2022-09-29 13:26:43'),
(36, 35, 1, 2, 1, 1, '2022-09-29 13:26:43', '2022-09-29 13:26:43'),
(37, 36, 1, 2, 1, 1, '2022-09-29 13:28:14', '2022-09-29 13:28:14'),
(38, 37, 1, 2, 1, 1, '2022-09-29 13:29:09', '2022-09-29 13:29:09'),
(39, 38, 1, 2, 1, 1, '2022-09-29 13:30:43', '2022-09-29 13:30:43'),
(40, 39, 1, 2, 1, 1, '2022-09-29 13:32:35', '2022-09-29 13:32:35'),
(41, 40, 1, 2, 1, 1, '2022-10-29 13:39:36', '2022-10-29 13:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_transactions`
--

CREATE TABLE `laundry_transactions` (
  `id` int(11) NOT NULL,
  `transaction_type` int(11) NOT NULL,
  `account_head_id` int(11) NOT NULL,
  `amount` double(20,2) NOT NULL,
  `in_out` tinyint(1) NOT NULL COMMENT '1:in,2:out',
  `status` tinyint(1) NOT NULL COMMENT '1:active,0:inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `ref_table_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL COMMENT 'income and expense (by mf for income add and etc) ',
  `comment` varchar(20) DEFAULT NULL COMMENT 'income or expense etc.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laundry_transactions`
--

INSERT INTO `laundry_transactions` (`id`, `transaction_type`, `account_head_id`, `amount`, `in_out`, `status`, `created_at`, `updated_at`, `ref_table_id`, `quantity`, `comment`) VALUES
(1, 1, 9, 220.00, 2, 1, '2022-09-22 10:15:51', '2022-09-22 10:15:51', 7, NULL, NULL),
(4, 1, 17, 1000.00, 1, 1, '2022-11-03 19:17:05', '2022-11-03 19:17:51', 2, 5, 'Laundry Expanse'),
(5, 1, 17, 500.00, 1, 1, '2022-11-03 19:17:05', '2022-11-03 19:17:51', 2, 10, 'Laundry Expanse'),
(6, 1, 12, 33.00, 2, 1, '2022-11-09 18:00:51', '2022-11-09 18:00:51', 35, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laundry_transection_infos`
--

CREATE TABLE `laundry_transection_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issue_date` date DEFAULT NULL,
  `payment_method` tinyint(4) DEFAULT NULL COMMENT '1=cash, 2=bank, 3=mobile banking',
  `invoice_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` double(20,2) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '1=income, 2=expanse',
  `status` tinyint(4) DEFAULT NULL COMMENT '1=Active, 0=In Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laundry_transection_infos`
--

INSERT INTO `laundry_transection_infos` (`id`, `issue_date`, `payment_method`, `invoice_no`, `total`, `type`, `status`, `created_at`, `updated_at`) VALUES
(2, '2022-11-04', 1, '00002', 10000.00, 2, 1, '2022-11-03 13:17:05', '2022-11-03 13:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '3',
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`id`, `image`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'public/uploads/logo/sensor.jpg', 1, 1, '2022-04-05 10:05:46', '2022-04-05 10:05:46'),
(2, 'public/uploads/logo/0WzR2sERYO5tBhETOY3Indhl962bkP5J8UV5RyszNJTbiX7g7yopitLogo.png', 4, 1, '2022-07-27 03:17:53', '2022-07-27 07:08:40'),
(3, 'public/uploads/logo/pWhjyB5VhDQbQxOIKK6TOxzRC6vzRecvs1CuumvIupez23ezxrlogin6.png', 4, 1, '2022-07-27 07:22:29', '2022-07-27 07:22:29'),
(4, 'public/uploads/logo/KTrQ20x5FBD1KtfibQvcJ1L3eEOzMyUzY7O1KWJaF0DuP6JJ66app.jpg', 4, 1, '2022-07-27 07:22:43', '2022-07-27 07:22:43'),
(5, 'public/uploads/logo/FTab5AmFOgJ5nWheMYowFKCuQ4xGenaMhCqAUvQBXbA1zsl2Ilcourierbg.png', 4, 1, '2022-07-27 07:22:53', '2022-07-27 07:22:53'),
(6, 'public/uploads/logo/hme0a8lcJ5HJl7bGQ549BQ2i2r7lEb53WiATPUgdyVIyi77Eg9amarshop.png', 4, 1, '2022-07-27 07:23:05', '2022-07-27 07:23:05'),
(7, 'public/uploads/logo/1XfGn4OlG6N2WuY49yFBCEmBPhzyXDZtyNHGxTZFh0BsznCHMyloginbg5.png', 4, 1, '2022-07-27 07:23:20', '2022-07-27 07:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `log_activities`
--

CREATE TABLE `log_activities` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_activities`
--

INSERT INTO `log_activities` (`id`, `subject`, `order_id`, `user_id`, `user_type_id`, `created_at`, `updated_at`) VALUES
(1, 'Order confirm', 1, 1, 1, '2022-09-14 18:18:19', '2022-09-14 18:18:19'),
(2, 'Order confirm', 1, 1, 1, '2022-09-14 18:24:11', '2022-09-14 18:24:11'),
(3, 'Quantity update', 1, 1, 2, '2022-09-14 18:24:46', '2022-09-14 18:24:46'),
(4, 'Quantity update', 1, 1, 2, '2022-09-14 18:25:33', '2022-09-14 18:25:33'),
(5, 'Order update', 1, 1, 2, '2022-09-14 18:25:50', '2022-09-14 18:25:50'),
(6, 'Order picked', 1, 1, 2, '2022-09-14 18:25:59', '2022-09-14 18:25:59'),
(7, 'Processing order', 1, 1, 1, '2022-09-14 18:26:08', '2022-09-14 18:26:08'),
(8, 'Work complete', 1, 1, 1, '2022-09-14 18:29:26', '2022-09-14 18:29:26'),
(9, 'Work complete', 1, 1, 1, '2022-09-14 18:29:30', '2022-09-14 18:29:30'),
(10, 'Order delivered', 1, 1, 3, '2022-09-14 18:32:00', '2022-09-14 18:32:00'),
(11, 'Order confirm', 2, 1, 1, '2022-09-14 18:41:39', '2022-09-14 18:41:39'),
(12, 'Order confirm', 2, 1, 1, '2022-09-14 18:42:05', '2022-09-14 18:42:05'),
(13, 'Quantity update', 2, 1, 2, '2022-09-14 18:43:09', '2022-09-14 18:43:09'),
(14, 'Order update', 2, 1, 2, '2022-09-14 18:43:28', '2022-09-14 18:43:28'),
(15, 'Order picked', 2, 1, 2, '2022-09-14 18:43:48', '2022-09-14 18:43:48'),
(16, 'Processing order', 2, 1, 1, '2022-09-14 18:44:43', '2022-09-14 18:44:43'),
(17, 'Work complete', 2, 1, 1, '2022-09-14 18:46:03', '2022-09-14 18:46:03'),
(18, 'Work complete', 2, 1, 1, '2022-09-14 18:46:26', '2022-09-14 18:46:26'),
(19, 'Order delivered', 2, 1, 3, '2022-09-14 18:47:51', '2022-09-14 18:47:51'),
(20, 'Offline order add', 3, 1, 1, '2022-09-14 19:19:39', '2022-09-14 19:19:39'),
(21, 'Order confirm', 3, 1, 1, '2022-09-14 19:33:06', '2022-09-14 19:33:06'),
(22, 'Offline order add', 5, 1, 1, '2022-09-22 10:02:38', '2022-09-22 10:02:38'),
(23, 'Offline order add', 6, 1, 1, '2022-09-22 10:02:41', '2022-09-22 10:02:41'),
(24, 'Offline order add', 7, 1, 1, '2022-09-22 10:02:41', '2022-09-22 10:02:41'),
(25, 'Order confirm', 7, 1, 1, '2022-09-22 10:13:05', '2022-09-22 10:13:05'),
(26, 'Order confirm', 7, 1, 1, '2022-09-22 10:13:25', '2022-09-22 10:13:25'),
(27, 'Order picked', 7, 1, 1, '2022-09-22 10:14:33', '2022-09-22 10:14:33'),
(28, 'Processing order', 7, 1, 1, '2022-09-22 10:14:51', '2022-09-22 10:14:51'),
(29, 'Work complete', 7, 1, 1, '2022-09-22 10:14:59', '2022-09-22 10:14:59'),
(30, 'Work complete', 7, 1, 1, '2022-09-22 10:15:06', '2022-09-22 10:15:06'),
(31, 'Order delivered', 7, 1, 1, '2022-09-22 10:15:51', '2022-09-22 10:15:51'),
(32, 'Offline order add', 8, 1, 1, '2022-10-05 11:32:25', '2022-10-05 11:32:25'),
(33, 'Order confirm', 8, 1, 1, '2022-10-05 11:33:24', '2022-10-05 11:33:24'),
(34, 'Order confirm', 8, 1, 1, '2022-10-05 11:33:45', '2022-10-05 11:33:45'),
(35, 'Order picked', 8, 1, 1, '2022-10-05 11:33:48', '2022-10-05 11:33:48'),
(36, 'Processing order', 8, 1, 1, '2022-10-05 11:34:00', '2022-10-05 11:34:00'),
(37, 'Work complete', 8, 1, 1, '2022-10-05 11:35:25', '2022-10-05 11:35:25'),
(38, 'Order confirm', 9, 1, 1, '2022-10-05 11:43:51', '2022-10-05 11:43:51'),
(39, 'Order confirm', 15, 1, 1, '2022-10-24 19:13:03', '2022-10-24 19:13:03'),
(40, 'Order confirm', 15, 1, 1, '2022-10-24 19:13:11', '2022-10-24 19:13:11'),
(41, 'Quick order add', 24, 1, 1, '2022-11-02 18:44:23', '2022-11-02 18:44:23'),
(42, 'Quick order add', 25, 1, 1, '2022-11-02 18:45:32', '2022-11-02 18:45:32'),
(43, 'Quick order add', 26, 1, 1, '2022-11-02 18:47:03', '2022-11-02 18:47:03'),
(44, 'Quick order add', 27, 1, 1, '2022-11-02 18:52:14', '2022-11-02 18:52:14'),
(45, 'Quick order add', 28, 1, 1, '2022-11-02 18:54:40', '2022-11-02 18:54:40'),
(46, 'Quick order add', 29, 1, 1, '2022-11-02 18:55:14', '2022-11-02 18:55:14'),
(47, 'Quick order add', 30, 1, 1, '2022-11-02 18:55:28', '2022-11-02 18:55:28'),
(48, 'Quick order add', 30, 1, 1, '2022-11-02 18:55:29', '2022-11-02 18:55:29'),
(49, 'Quick order add', 31, 1, 1, '2022-11-02 18:56:38', '2022-11-02 18:56:38'),
(50, 'Quick order add', 31, 1, 1, '2022-11-02 18:56:39', '2022-11-02 18:56:39'),
(51, 'Quick order add', 32, 1, 1, '2022-11-02 18:57:58', '2022-11-02 18:57:58'),
(52, 'Quick order add', 32, 1, 1, '2022-11-02 18:57:58', '2022-11-02 18:57:58'),
(53, 'Quick order add', 33, 1, 1, '2022-11-02 19:00:39', '2022-11-02 19:00:39'),
(54, 'Quick order add', 33, 1, 1, '2022-11-02 19:00:40', '2022-11-02 19:00:40'),
(55, 'Order confirm', 33, 1, 1, '2022-11-02 19:01:10', '2022-11-02 19:01:10'),
(56, 'Quick order add', 34, 1, 1, '2022-11-02 19:03:18', '2022-11-02 19:03:18'),
(57, 'Quick order add', 34, 1, 1, '2022-11-02 19:03:18', '2022-11-02 19:03:18'),
(58, 'Quick order add', 35, 1, 1, '2022-11-09 17:59:35', '2022-11-09 17:59:35'),
(59, 'Quick order add', 35, 1, 1, '2022-11-09 17:59:35', '2022-11-09 17:59:35'),
(60, 'Quick order add', 35, 1, 1, '2022-11-09 17:59:35', '2022-11-09 17:59:35'),
(61, 'Order confirm', 35, 1, 1, '2022-11-09 18:00:14', '2022-11-09 18:00:14'),
(62, 'Order picked', 35, 1, 1, '2022-11-09 18:00:20', '2022-11-09 18:00:20'),
(63, 'Processing order', 35, 1, 1, '2022-11-09 18:00:30', '2022-11-09 18:00:30'),
(64, 'Work complete', 35, 1, 1, '2022-11-09 18:00:35', '2022-11-09 18:00:35'),
(65, 'Work complete', 35, 1, 1, '2022-11-09 18:00:43', '2022-11-09 18:00:43'),
(66, 'Order delivered', 35, 1, 1, '2022-11-09 18:00:51', '2022-11-09 18:00:51'),
(67, 'Quick order add', 36, 1, 1, '2022-11-11 18:35:03', '2022-11-11 18:35:03'),
(68, 'Quick order add', 37, 1, 1, '2022-11-11 18:36:35', '2022-11-11 18:36:35'),
(69, 'Quick order add', 37, 1, 1, '2022-11-11 18:36:36', '2022-11-11 18:36:36'),
(70, 'Quick order add', 38, 1, 1, '2022-11-12 16:33:43', '2022-11-12 16:33:43'),
(71, 'Quick order add', 38, 1, 1, '2022-11-12 16:33:43', '2022-11-12 16:33:43'),
(72, 'Order confirm', 38, 1, 1, '2022-11-12 16:34:06', '2022-11-12 16:34:06'),
(73, 'Order picked', 38, 1, 1, '2022-11-12 16:34:47', '2022-11-12 16:34:47'),
(74, 'Processing order', 38, 1, 1, '2022-11-12 16:34:57', '2022-11-12 16:34:57'),
(75, 'Work complete', 38, 1, 1, '2022-11-12 16:35:19', '2022-11-12 16:35:19'),
(76, 'Work complete', 38, 1, 1, '2022-11-12 16:35:26', '2022-11-12 16:35:26'),
(77, 'Order delivered', 38, 1, 1, '2022-11-12 16:35:36', '2022-11-12 16:35:36'),
(78, 'Order delivered', 38, 1, 1, '2022-11-12 16:35:41', '2022-11-12 16:35:41'),
(79, 'Order confirm', 41, 1, 1, '2022-11-13 17:26:42', '2022-11-13 17:26:42'),
(80, 'Order confirm', 41, 1, 1, '2022-11-13 17:26:46', '2022-11-13 17:26:46'),
(81, 'Order picked', 41, 1, 1, '2022-11-13 17:26:49', '2022-11-13 17:26:49'),
(82, 'Processing order', 41, 1, 1, '2022-11-13 17:26:54', '2022-11-13 17:26:54'),
(83, 'Work complete', 41, 1, 1, '2022-11-13 17:26:57', '2022-11-13 17:26:57'),
(84, 'Work complete', 41, 1, 1, '2022-11-13 18:18:11', '2022-11-13 18:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `merchantpayments`
--

CREATE TABLE `merchantpayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `merchantId` int(11) NOT NULL,
  `parcelId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchantpayments`
--

INSERT INTO `merchantpayments` (`id`, `merchantId`, `parcelId`, `created_at`, `updated_at`) VALUES
(1, 25, 25, '2022-04-23 20:21:00', '2022-04-23 20:21:00'),
(2, 25, 25, '2022-04-23 20:21:01', '2022-04-23 20:21:01'),
(3, 12, 12, '2022-04-23 21:41:45', '2022-04-23 21:41:45'),
(4, 2, 2, '2022-04-24 20:55:03', '2022-04-24 20:55:03'),
(5, 1, 1, '2022-05-26 20:32:52', '2022-05-26 20:32:52'),
(6, 2, 2, '2022-05-27 05:32:56', '2022-05-27 05:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastName` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `companyName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade_licence_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `thana_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `present_address` text COLLATE utf8mb4_unicode_ci,
  `permanent_address` text COLLATE utf8mb4_unicode_ci,
  `pickup_thana_id` int(11) DEFAULT NULL,
  `pickLocation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mAdress` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phoneNumber` bigint(20) NOT NULL,
  `otherphoneNumber` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emailAddress` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification_type` int(11) DEFAULT NULL,
  `nidnumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_photo_back` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_certificate_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_certificate_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driving_licence_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driving_licence_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nearestZone` int(11) DEFAULT NULL,
  `acqm_id` int(11) DEFAULT NULL,
  `del_commission` double(20,2) NOT NULL DEFAULT '0.00',
  `cod_commission` double(20,2) NOT NULL DEFAULT '0.00',
  `pickupPreference` int(11) DEFAULT NULL,
  `socialLink` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paymentMethod` tinyint(4) DEFAULT NULL,
  `paymentmode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `withdrawal` tinyint(4) DEFAULT NULL,
  `nameOfBank` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bankBranch` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bankAcHolder` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bankAcNo` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bkashNumber` int(20) DEFAULT NULL,
  `roketNumber` int(11) DEFAULT NULL,
  `nogodNumber` int(191) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `payoption` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_page` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwordReset` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public/uploads/default/avator.png',
  `agree` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT 'yes',
  `verify` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_role` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `firstName`, `lastName`, `username`, `companyName`, `trade_licence_no`, `fathers_name`, `mothers_name`, `date_of_birth`, `division_id`, `district_id`, `thana_id`, `area_id`, `present_address`, `permanent_address`, `pickup_thana_id`, `pickLocation`, `mAdress`, `phoneNumber`, `otherphoneNumber`, `emailAddress`, `identification_type`, `nidnumber`, `nid_photo`, `nid_photo_back`, `birth_certificate_no`, `birth_certificate_photo`, `driving_licence_no`, `driving_licence_photo`, `nearestZone`, `acqm_id`, `del_commission`, `cod_commission`, `pickupPreference`, `socialLink`, `paymentMethod`, `paymentmode`, `withdrawal`, `nameOfBank`, `bankBranch`, `bankAcHolder`, `bankAcNo`, `bkashNumber`, `roketNumber`, `nogodNumber`, `balance`, `payoption`, `website`, `facebook_page`, `password`, `passwordReset`, `api_token`, `logo`, `agree`, `verify`, `api_role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Al Arfin Rokon', NULL, NULL, 'One Point IT Solution', NULL, NULL, NULL, NULL, 1, 1, 16, NULL, 'Testing', NULL, 16, 'Pickup location', NULL, 1729890904, '11122111111', NULL, 2, '3251321435', 'public/uploads/merchant/YuuyfoXPJSZzeOyUdzvpjHR8wB7gQm3ZopetFxs562itUT5MqXslider2.jpg', 'public/uploads/merchant/P3h50VSeQg0XCxFcCrXeS5QzD3o4h8uzaMHjfA4asxAK0vqsW3slider3.jpg', '4231543215', 'public/uploads/merchant/3OVUqqRMSfEkJhII3Dkdy3K18uti7Z7prpNkaoKSkQP2Uc1QXobusiness-company-logo-27438478.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00, 1, NULL, 4, NULL, NULL, 'Dutch Bangla Bank', 'Rampura Branch', 'Al Arfin', '46544564654', 1729890904, NULL, NULL, NULL, '4', NULL, NULL, '$2y$10$hg./3xQXUEvd4CaQkHI5wep2AAnebkcMLoDjy5fhNH4sB1vVe/.x.', NULL, 'qsFsgbDRThTaVjfiuCfBqpTgw8etP4AiG2oOVUtKP0i8JqRPhK', 'public/uploads/merchant/O7eiCSH3EuaUhxSuSYB9jKuPHJ8Z2aclHBrfiD1EVDBDeo2GTzhome-delivery.png', '1', '1', 1, 1, '2022-04-06 10:32:20', '2022-07-16 11:42:02'),
(2, 'R. Zaman', NULL, NULL, 'Pink Care', NULL, NULL, NULL, NULL, 1, 1, 114, 665, NULL, NULL, NULL, '43/1, Senspara, Somaj Kalyan Mosjid Road, Mirpur, Dhaka Division, Bangladesh', '43/1, Senspara, Somaj Kalyan Mosjid Road, Mirpur, Dhaka Division, Bangladesh', 1407002201, NULL, 'pinkcarebd@gmail.com', 1, '3707070870', 'public/uploads/merchant/X14pTmrIqGhAifA23uckGFdbH2be8WmmOjwNqEtY3GQcOjXg3MScreen Shot 2022-04-29 at 12.18.35 AM.png', 'public/uploads/merchant/Ld7lVzsS8kFyoKAQlQ73BsVON4FQL6ptlFq4v7Kz8JkA9gSM80WhatsApp Image 2022-05-19 at 11.53.14 AM.jpeg', NULL, NULL, 'dr23344566', 'public/uploads/merchant/DrPS4fxgytXfT8Pq18XK2eqRHqlLIciOeAfQ4Qr8V7aY4n8ZvPADS.jpg', NULL, NULL, 0.00, 0.00, 1, NULL, 1, NULL, NULL, 'Uttara Bank Ltd', 'Shanti nagar', 'Sensor Printex & Fashion', '142012200215210', 1407002201, NULL, NULL, NULL, '1', NULL, NULL, '$2y$10$2ckbaROW88DzyC64IPv.GOUpusIjAQjx0PPDUE2r.VPgRgPQHsPWC', '498125', 'O1lL0gLWsdvYoHFeHumkf99h26IwbQ5nLtI9WoXpUlb5klWInq', 'public/uploads/default/avator.png', NULL, '1', 1, 1, '2022-04-09 22:46:39', '2022-05-28 08:42:44'),
(23, 'Hasanurjaman Raju', NULL, NULL, 'You & Baby', NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'Shop # 16, Doreen Shopping Center, R/A(Rupnogor Abashik), Main Road, Road #13, Dhaka.\r\nR/A(Rupnogor Abashik), Road #21,House No#26 Dhaka.', 'Shop # 16, Doreen Shopping Center, R/A(Rupnogor Abashik), Main Road, Road #13, Dhaka.\r\nR/A(Rupnogor Abashik), Road #21,House No#26 Dhaka.', NULL, NULL, NULL, 1670504110, NULL, 'hasanurjaman007@gmail.com', NULL, '5102395075', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 0.00, 0.00, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1670504110, NULL, '3', NULL, 'https://www.facebook.com/youbabybazar', '$2y$10$76bcH.y920QqdvS0uO5DnOhhACLg5fLi5cM/lyQ8aP.wNn5iQ/ICW', NULL, 'S4u2CqS7XXwRvfGutyGfdGJ2exvJyVeJGcSGEduDzl0nqH9lia', 'public/uploads/default/avator.png', '1', '597153', 1, 1, '2022-04-23 05:02:14', '2022-05-21 23:22:42'),
(50, 'Abdullah', NULL, NULL, 'Lazma.com', NULL, NULL, NULL, NULL, 1, 1, 114, 665, NULL, NULL, 1, 'Test address', NULL, 1713579880, NULL, 'engr.abdullahbd@gmail.com', 1, '5245523552', 'public/uploads/merchant/h30GLKoKkFpnEEAk61jf3Oy6ZgK1phhxkRbQC1GBwGNy2srqgubc6b5edc-9014-4ce3-95a6-e3f392cb213f.jpg', 'public/uploads/merchant/Gma0bvrJPkUGd0RkNdN4G3zkEodoWCCPVP3LmZTMUmybFd6LB0bc6b5edc-9014-4ce3-95a6-e3f392cb213f.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$D2wmIudNFZ1oYaRZpjMiQuPWfCpz2dy.k05Ae8aLBxLFDbpBI8Vui', NULL, 'cfOB2JWdhwt3FIbSPXLn20bFg6Tm3XbOAwpz9C5NYHEHgve5fe', 'public/uploads/default/avator.png', '1', '1', 1, 1, '2022-05-30 22:48:07', '2022-07-16 05:37:24'),
(51, 'Mehenaz Mili', NULL, NULL, 'Shuvro Jaya', NULL, NULL, NULL, NULL, 1, 1, 8, 634, 'Road:27, House:41, Rupnagar R/A, Mirpur, Dhaka', 'Road:27, House:41, Rupnagar R/A, Mirpur, Dhaka', NULL, NULL, NULL, 1711230861, NULL, 'mehnaz.maheer@gmail.com', 1, '5507078144', 'public/uploads/merchant/aOX8lVMCbjj6IakR9LZhzFJx4P0avCbdeygztaSXxRNvWVv0iN1.jpg', 'public/uploads/merchant/dpU3Elnf8wQ6KnqbjyDJICtVk95RrT2p8nIaQsv8WgF1iBxKzX2.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 2, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, 1711230861, NULL, NULL, NULL, '2', NULL, 'www.facebook.com/ShuvroJaya', '$2y$10$wkkRJNd22kBeIsqPaFRGqOGLF831JOTlEbvlmb0YDNxX/nIeu3.v2', NULL, 'cCwCfrLKPUgHzbLjBO1FdH5PwhDgRywl3GnGh0RPhqNLzZ5BGl', 'public/uploads/default/avator.png', '1', '1', 1, 1, '2022-05-31 19:57:36', '2022-05-31 23:29:30'),
(53, 'Md Sadiqul Islam', NULL, NULL, 'Bedset House', NULL, NULL, NULL, NULL, 1, 1, 9, NULL, '223 senpara,mirpur 10', '223 senpara, mirpur 10', NULL, NULL, NULL, 1701013240, NULL, NULL, 1, '5975395152', 'public/uploads/merchant/t3F9rgtbrHeGFS0BHYmvWlcrZGfcJTSk7LeQA9GG8JUsZVXnCd16539986032274928542120166749419.jpg', 'public/uploads/merchant/nIAheTy0xPLvMpLeoXTOsyuw2ritAaalM9wXPuJ7zw4LzCJPsp16539986279932115454155066436455.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1760436018, NULL, NULL, NULL, '2', NULL, NULL, '$2y$10$CzSzzmqLl4VuARVZK5GsH.F90isjDielPoMjvT/N3h6FQCbZmGwGa', NULL, 'KisVzIHFPRXV9EFq1z8L5Y02YkjAGNW5QNlibXPjbgL8VraIP3', 'public/uploads/default/avator.png', '1', '1', 1, 1, '2022-06-01 00:58:04', '2022-06-01 01:16:43'),
(54, 'Testin name here', NULL, NULL, 'Test', NULL, NULL, NULL, NULL, 1, 1, 16, NULL, NULL, NULL, NULL, NULL, NULL, 1777777722, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, '32566143', 'public/uploads/merchant/ZdMv3w1pY5O0U4ljp5IV0Me5mJlxfA0MP4qP4boYpli0AGpiYMg-logo.jpg', NULL, NULL, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$1nKPizU.m4yz/O1WnDIayuhwEkpa1AcJhJU222UlqhV/3qrCKL.I6', NULL, 'lg1xHOS6XFfAyMCe97ARx0DFKDYGfoNuxAbzvRzpNDhWeZWXVg', 'public/uploads/default/avator.png', '1', '1', 1, 0, '2022-06-06 05:35:17', '2022-06-06 05:35:17'),
(55, 'fgsdhdfh', NULL, NULL, 'dsgdfhf', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 'Location check', NULL, 35643634, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, '325134564364', 'public/uploads/merchant/ytcsdhszWefdoOkVaO4JwvZiVEhk8Z5iGqzF2tH0YjxdknbudRhome-delivery.png', NULL, NULL, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$KjDuwkSJnXj5Rrv7en9Lr.dvhDYNnM9Wx/0sMJvgoE3naUTvyoMtm', NULL, 'NxfJMxaHjfNwrH1EdGB6MxASCAl0m9qB1SpsE31DHVvb1jtE1m', 'public/uploads/default/avator.png', '1', '1', 1, 1, '2022-06-06 05:36:24', '2022-06-06 05:36:24'),
(56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1719056533, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$goUS/0nB7KwzPJr4tMsyE.4Qec6YjBXbcoslcZwyNGQX0rIpm7k/u', '515667', 'QZuPP6DWRk0iM86r96qXF4qIFDiSPNCMpvXZTAJTrJANf14UF7', 'public/uploads/default/avator.png', 'yes', '0', 1, 1, '2022-08-11 10:02:55', '2022-08-13 04:17:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_07_31_064441_create_logos_table', 1),
(5, '2020_03_04_160445_create_merchants_table', 1),
(6, '2020_03_10_144143_create_nearestzones_table', 1),
(7, '2020_03_24_142231_create_deliverycharges_table', 1),
(9, '2020_03_27_051853_create_codcharges_table', 1),
(10, '2020_03_29_234337_create_departments_table', 1),
(11, '2020_03_30_202953_create_employees_table', 1),
(19, '2020_08_09_171103_create_pickups_table', 1),
(20, '2019_12_30_163131_create_districts_table', 1),
(21, '2020_03_24_161302_create_parcels_table', 1),
(33, '2020_04_07_151122_create_services_table', 1),
(35, '2020_12_30_170501_create_agents_table', 1),
(36, '2020_12_31_121855_create_deliverymen_table', 1),
(38, '2021_01_01_224110_create_merchantpayments_table', 1),
(39, '2021_01_04_110828_create_parcelnotes_table', 1),
(40, '2019_05_30_150731_create_socialmedia_table', 1),
(41, '2021_02_09_121935_create_abouts_table', 1),
(44, '2021_02_09_133620_create_partners_table', 1),
(45, '2021_02_09_134747_create_faqs_table', 1),
(47, '2020_04_07_093608_create_banners_table', 2),
(48, '2020_10_24_234912_create_features_table', 3),
(50, '2020_04_07_160658_create_prices_table', 4),
(51, '2021_02_09_124527_create_counters_table', 4),
(52, '2020_06_20_105300_create_clientfeedbacks_table', 5),
(55, '2021_02_15_175711_create_careers_table', 6),
(56, '2021_02_15_185904_create_galleries_table', 7),
(58, '2021_02_15_192437_create_notices_table', 8),
(59, '2021_02_16_170149_create_parceltypes_table', 9),
(60, '2021_06_09_112107_create_hubs_table', 10),
(61, '2021_06_09_114848_create_pricetypes_table', 11),
(63, '2021_06_09_123335_create_createpages_table', 12),
(64, '2022_03_30_151834_create_sliders_table', 13),
(65, '2022_04_02_153026_create_slogans_table', 14),
(66, '2022_04_05_130027_create_settings_table', 15),
(67, '2022_04_23_110909_create_divisions_table', 5),
(68, '2022_04_23_115502_create_thanas_table\r\n', 5),
(69, '2022_04_23_115502_create_thanas_table', 5),
(70, '2022_04_24_111855_create_areas_table', 5),
(71, '2022_04_24_160949_create_pickupmen_table', 6),
(72, '2022_04_25_105156_create_delivery_charge_heads_table', 1),
(73, '2022_04_26_111327_create_deliveryman_agents_table', 6),
(74, '2022_04_26_122755_create_pickupman_agents_table', 1),
(76, '2022_05_08_175433_create_deliveryman_payments_table', 17),
(77, '2022_05_08_173900_create_pickupman_payments_table', 18),
(79, '2022_05_10_121126_create_weights_table', 10),
(80, '2022_05_22_145937_create_agent_thanas_table', 1),
(81, '2022_05_23_125646_create_pickupman_education_table', 1),
(82, '2022_05_23_125733_create_pickupman_experiences_table', 1),
(83, '2022_05_23_130527_create_pickupman_areas_table', 1),
(84, '2022_05_24_162728_create_deliveryman_education_table', 10),
(85, '2022_05_24_162952_create_deliveryman_experiences_table', 10),
(86, '2022_05_24_163130_create_deliveryman_areas_table', 10),
(87, '2022_05_25_122944_create_employee_education_table', 1),
(88, '2022_05_25_123007_create_employee_experiences_table', 1),
(89, '2022_05_25_125200_create_employee_agents_table', 1),
(90, '2022_05_25_125310_create_employee_areas_table', 1),
(91, '2022_05_26_112247_create_promotional_discounts_table', 10),
(92, '2022_07_02_145921_create_terms_conditions_table', 20),
(95, '2022_07_03_115506_create_permission_tables', 21),
(96, '2022_10_26_163157_create_laundry_pkg_order_items_table', 22),
(97, '2022_10_29_152049_create_corporate_customer_products_table', 23),
(99, '2022_11_03_164956_create_laundry_transection_infos_table', 24),
(100, '2022_11_05_111235_create_salon_transection_infos_table', 25),
(101, '2022_11_05_134625_create_attendances_table', 26),
(102, '2022_11_06_121404_create_years_table', 27),
(103, '2022_11_06_121651_create_months_table', 27),
(105, '2022_11_06_163038_create_salaries_table', 28);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 1),
(2, 'App\\User', 4),
(3, 'App\\User', 1),
(3, 'App\\User', 4),
(4, 'App\\User', 1),
(4, 'App\\User', 4),
(5, 'App\\User', 1),
(5, 'App\\User', 4),
(6, 'App\\User', 1),
(7, 'App\\User', 1),
(8, 'App\\User', 1),
(8, 'App\\User', 4),
(9, 'App\\User', 1),
(10, 'App\\User', 1),
(11, 'App\\User', 1),
(12, 'App\\User', 1),
(13, 'App\\User', 1),
(14, 'App\\User', 1),
(15, 'App\\User', 1),
(16, 'App\\User', 1),
(17, 'App\\User', 1),
(18, 'App\\User', 1),
(19, 'App\\User', 1),
(20, 'App\\User', 1),
(21, 'App\\User', 1),
(22, 'App\\User', 1),
(23, 'App\\User', 1),
(24, 'App\\User', 1),
(25, 'App\\User', 1),
(25, 'App\\User', 4),
(26, 'App\\User', 1),
(27, 'App\\User', 1),
(28, 'App\\User', 1),
(29, 'App\\User', 1),
(30, 'App\\User', 1),
(31, 'App\\User', 1),
(32, 'App\\User', 1),
(32, 'App\\User', 4),
(33, 'App\\User', 1),
(33, 'App\\User', 4),
(34, 'App\\User', 1),
(35, 'App\\User', 1),
(35, 'App\\User', 4),
(36, 'App\\User', 1),
(36, 'App\\User', 4),
(37, 'App\\User', 1),
(38, 'App\\User', 1),
(39, 'App\\User', 1),
(39, 'App\\User', 4),
(41, 'App\\User', 1),
(41, 'App\\User', 4),
(44, 'App\\User', 1),
(44, 'App\\User', 4),
(45, 'App\\User', 1),
(46, 'App\\User', 1),
(47, 'App\\User', 1),
(48, 'App\\User', 1),
(49, 'App\\User', 1),
(50, 'App\\User', 1),
(51, 'App\\User', 1),
(52, 'App\\User', 1),
(53, 'App\\User', 1),
(54, 'App\\User', 1),
(55, 'App\\User', 1),
(56, 'App\\User', 1),
(57, 'App\\User', 1),
(58, 'App\\User', 1),
(59, 'App\\User', 1),
(60, 'App\\User', 1),
(61, 'App\\User', 1),
(62, 'App\\User', 1),
(63, 'App\\User', 1),
(63, 'App\\User', 4),
(64, 'App\\User', 1),
(64, 'App\\User', 4),
(65, 'App\\User', 1),
(65, 'App\\User', 4),
(66, 'App\\User', 1),
(66, 'App\\User', 4),
(67, 'App\\User', 1),
(68, 'App\\User', 1),
(68, 'App\\User', 4),
(69, 'App\\User', 1),
(69, 'App\\User', 4),
(70, 'App\\User', 1),
(70, 'App\\User', 4),
(71, 'App\\User', 1),
(72, 'App\\User', 1),
(72, 'App\\User', 4),
(73, 'App\\User', 1),
(73, 'App\\User', 4),
(74, 'App\\User', 1),
(74, 'App\\User', 4),
(75, 'App\\User', 1),
(76, 'App\\User', 1),
(77, 'App\\User', 1),
(78, 'App\\User', 1),
(79, 'App\\User', 1),
(80, 'App\\User', 1),
(81, 'App\\User', 1),
(82, 'App\\User', 1),
(82, 'App\\User', 4),
(83, 'App\\User', 1),
(83, 'App\\User', 4),
(84, 'App\\User', 1),
(85, 'App\\User', 1),
(86, 'App\\User', 1),
(86, 'App\\User', 4),
(87, 'App\\User', 1),
(87, 'App\\User', 4),
(94, 'App\\User', 1),
(95, 'App\\User', 1),
(96, 'App\\User', 1),
(97, 'App\\User', 1),
(98, 'App\\User', 1),
(99, 'App\\User', 1),
(100, 'App\\User', 1),
(101, 'App\\User', 1),
(101, 'App\\User', 4),
(102, 'App\\User', 1),
(102, 'App\\User', 4),
(103, 'App\\User', 1),
(103, 'App\\User', 4),
(104, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE `months` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=In Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `months`
--

INSERT INTO `months` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'January', 1, NULL, NULL),
(2, 'February', 1, NULL, NULL),
(3, 'March', 1, NULL, NULL),
(4, 'April', 1, NULL, NULL),
(5, 'May', 1, NULL, NULL),
(6, 'June', 1, NULL, NULL),
(7, 'July', 1, NULL, NULL),
(8, 'August', 1, NULL, NULL),
(9, 'September', 1, NULL, NULL),
(10, 'October', 1, NULL, NULL),
(11, 'November', 1, NULL, NULL),
(12, 'December', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nearestzones`
--

CREATE TABLE `nearestzones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `zonename` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nearestzones`
--

INSERT INTO `nearestzones` (`id`, `zonename`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MALIBAG', 1, '2022-04-07 03:42:30', '2022-04-09 22:55:45'),
(2, 'BADDA', 1, '2022-04-07 03:42:42', '2022-04-09 22:55:13'),
(3, 'UTTARA', 1, '2022-04-09 22:53:00', '2022-04-09 22:53:00'),
(4, 'MIRPUR', 1, '2022-04-09 22:53:19', '2022-04-09 22:53:19'),
(5, 'JATRA BARI', 1, '2022-04-09 22:53:55', '2022-04-09 22:53:55'),
(6, 'DHANMONDI', 1, '2022-04-09 22:54:27', '2022-04-09 22:54:27'),
(7, 'AZIMPUR', 1, '2022-04-17 22:22:10', '2022-04-17 22:22:10'),
(8, 'Gulistan', 1, '2022-04-19 21:11:06', '2022-04-19 21:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(11) NOT NULL,
  `order_datetime` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `payment_method_id` int(3) NOT NULL,
  `picked_time` datetime NOT NULL,
  `pay_status` varchar(30) NOT NULL DEFAULT 'Unpaid' COMMENT 'Unpaid,Paid',
  `payment_method_info` text COMMENT '1=Cash, 2=Card, 3=bkash, 4=nagad, 5=rocket',
  `paid` double(20,2) NOT NULL DEFAULT '0.00',
  `order_status` int(3) NOT NULL DEFAULT '1',
  `pman_id` int(11) DEFAULT NULL,
  `dman_id` int(11) DEFAULT NULL,
  `origin` varchar(30) NOT NULL DEFAULT 'Online',
  `is_package_order` tinyint(3) NOT NULL DEFAULT '0' COMMENT '0=product, 1=package',
  `invoice_no` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_datetime`, `customer_id`, `branch_id`, `payment_method_id`, `picked_time`, `pay_status`, `payment_method_info`, `paid`, `order_status`, `pman_id`, `dman_id`, `origin`, `is_package_order`, `invoice_no`, `created_at`, `updated_at`) VALUES
(1, '2022-09-14 18:17:54', 2, 2, 1, '2022-09-14 22:17:00', 'Paid', 'bkash', 330.00, 4, 1, 1, 'Online', 0, NULL, '2022-09-14 18:17:54', '2022-09-14 18:32:00'),
(2, '2022-09-14 18:38:13', 3, 2, 1, '2022-09-14 21:00:00', 'Paid', 'bkash : 01910863553\r\nTx:', 230.00, 4, 1, 1, 'Online', 0, NULL, '2022-09-14 18:38:13', '2022-09-14 18:47:51'),
(3, '2022-09-14 19:19:39', 3, 2, 1, '2022-09-14 19:19:00', 'Unpaid', NULL, 0.00, 10, NULL, NULL, 'Offline', 0, NULL, '2022-09-14 19:19:39', '2022-09-14 19:33:06'),
(4, '2022-09-22 10:01:16', 3, 2, 1, '2022-09-22 02:04:00', 'Unpaid', NULL, 0.00, 1, NULL, NULL, 'Offline', 0, NULL, '2022-09-22 10:01:16', '2022-09-22 10:01:16'),
(5, '2022-09-22 10:02:37', 4, 2, 1, '2022-09-22 14:04:00', 'Unpaid', NULL, 0.00, 1, NULL, NULL, 'Offline', 0, NULL, '2022-09-22 10:02:37', '2022-09-22 10:02:37'),
(6, '2022-09-22 10:02:41', 4, 2, 1, '2022-09-22 14:04:00', 'Unpaid', NULL, 0.00, 1, NULL, NULL, 'Offline', 0, NULL, '2022-09-22 10:02:41', '2022-09-22 10:02:41'),
(7, '2022-09-22 10:02:41', 4, 2, 1, '2022-09-22 14:04:00', 'Paid', NULL, 0.00, 4, 1, 1, 'Offline', 0, NULL, '2022-09-22 10:02:41', '2022-09-22 10:15:50'),
(8, '2022-10-05 11:32:25', 5, 2, 1, '2022-10-05 13:34:00', 'Unpaid', NULL, 0.00, 12, 1, NULL, 'Offline', 0, NULL, '2022-10-05 11:32:25', '2022-10-05 11:35:25'),
(9, '2022-10-05 11:42:10', 3, 2, 1, '2022-10-05 14:45:00', 'Unpaid', NULL, 0.00, 10, NULL, NULL, 'Online', 0, NULL, '2022-10-05 11:42:10', '2022-10-05 11:43:51'),
(10, '2022-10-06 18:16:44', 3, 2, 1, '2022-10-06 21:19:00', 'Unpaid', NULL, 0.00, 1, NULL, NULL, 'Online', 0, NULL, '2022-10-06 18:16:44', '2022-10-06 18:16:44'),
(11, '2022-10-24 11:38:55', 3, 2, 1, '2022-10-03 10:10:00', 'Unpaid', NULL, 0.00, 1, NULL, NULL, 'Online', 0, NULL, '2022-10-24 11:38:55', '2022-10-24 11:38:55'),
(12, '2022-10-24 11:40:00', 3, 2, 1, '2022-10-03 10:10:00', 'Unpaid', NULL, 0.00, 1, NULL, NULL, 'Online', 0, NULL, '2022-10-24 11:40:00', '2022-10-24 11:40:00'),
(13, '2022-10-24 11:40:23', 3, 2, 1, '2022-10-25 10:10:00', 'Unpaid', NULL, 0.00, 1, NULL, NULL, 'Online', 0, NULL, '2022-10-24 11:40:23', '2022-10-24 11:40:23'),
(14, '2022-10-24 11:42:24', 3, 2, 1, '2022-10-25 10:10:00', 'Unpaid', NULL, 0.00, 1, NULL, NULL, 'Online', 0, NULL, '2022-10-24 11:42:24', '2022-10-24 11:42:24'),
(15, '2022-10-24 11:43:11', 3, 2, 1, '2022-10-25 10:10:00', 'Unpaid', NULL, 0.00, 10, 1, NULL, 'Online', 0, NULL, '2022-10-24 11:43:11', '2022-10-24 19:13:11'),
(16, '2022-10-24 19:11:07', 3, 2, 1, '2022-10-25 10:10:00', 'Unpaid', NULL, 0.00, 1, NULL, NULL, 'Online', 0, NULL, '2022-10-24 19:11:07', '2022-10-24 19:11:07'),
(17, '2022-10-26 10:45:08', 3, 2, 1, '2022-10-27 10:10:00', 'Unpaid', NULL, 0.00, 1, NULL, NULL, 'Online', 0, NULL, '2022-10-26 10:45:08', '2022-10-26 10:45:08'),
(18, '2022-10-26 17:04:11', 3, 2, 1, '2022-10-27 10:10:00', 'Unpaid', NULL, 0.00, 1, NULL, NULL, 'Online', 0, NULL, '2022-10-26 17:04:11', '2022-10-26 17:04:11'),
(21, '2022-10-27 12:13:17', 3, 2, 1, '2022-10-28 10:10:00', 'Unpaid', NULL, 0.00, 1, NULL, NULL, 'Online', 1, NULL, '2022-10-27 12:13:17', '2022-10-27 12:13:17'),
(22, '2022-10-27 17:28:11', 3, 2, 1, '2022-10-28 10:10:00', 'Unpaid', NULL, 0.00, 1, NULL, NULL, 'Online', 1, NULL, '2022-10-27 17:28:11', '2022-10-27 17:28:11'),
(33, '2022-11-02 00:00:00', 0, 2, 1, '2022-11-02 19:00:39', 'Unpaid', NULL, 0.00, 10, NULL, NULL, 'Quick', 0, '00021', '2022-11-02 19:00:39', '2022-11-02 19:01:10'),
(34, '2022-11-02 00:00:00', 0, 2, 1, '2022-11-02 19:03:18', 'Unpaid', NULL, 0.00, 10, NULL, NULL, 'Quick', 0, '00022', '2022-11-02 19:03:18', '2022-11-02 19:03:18'),
(35, '2022-11-09 00:00:00', 5, 2, 1, '2022-11-09 17:59:34', 'Paid', NULL, 0.00, 4, 1, 1, 'Quick', 0, '00023', '2022-11-09 17:59:34', '2022-11-09 18:00:50'),
(36, '2022-11-11 00:00:00', 0, 1, 1, '2022-11-11 18:35:03', 'Unpaid', '1', 0.00, 10, NULL, NULL, 'Quick', 0, '00024', '2022-11-11 18:35:03', '2022-11-11 18:35:03'),
(37, '2022-11-11 00:00:00', 0, 2, 1, '2022-11-11 18:36:35', 'Unpaid', '1', 0.00, 10, NULL, NULL, 'Quick', 0, '00025', '2022-11-11 18:36:35', '2022-11-11 18:36:35'),
(38, '2022-11-12 00:00:00', 0, 2, 1, '2022-11-12 16:33:43', 'Paid', '1', 0.00, 4, 1, 1, 'Quick', 0, '00026', '2022-11-12 16:33:43', '2022-11-12 16:35:36'),
(39, '2022-11-12 17:55:11', 2, 2, 1, '2022-11-13 20:58:00', 'Unpaid', NULL, 0.00, 1, NULL, NULL, 'Online', 0, NULL, '2022-11-12 17:55:11', '2022-11-12 17:55:11'),
(40, '2022-11-12 19:47:24', 10, 2, 1, '2022-11-12 22:50:00', 'Unpaid', NULL, 0.00, 1, NULL, NULL, 'Online', 0, NULL, '2022-11-12 19:47:24', '2022-11-12 19:47:24'),
(41, '2022-11-13 17:25:58', 9, 2, 1, '2022-11-13 17:26:00', 'Unpaid', NULL, 0.00, 12, 1, 1, 'Online', 0, NULL, '2022-11-13 17:25:58', '2022-11-13 18:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `order_billings`
--

CREATE TABLE `order_billings` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `region_id` int(5) NOT NULL,
  `city_id` int(5) NOT NULL,
  `area_id` int(8) NOT NULL,
  `address` varchar(155) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `order_billings`
--

INSERT INTO `order_billings` (`id`, `order_id`, `type`, `fullname`, `mobile_no`, `region_id`, `city_id`, `area_id`, `address`, `created_at`, `updated_at`) VALUES
(1, 3, 'Home', 'hafizul', '01789725276', 1, 1, 1, 'zahaz building', '2022-09-14 19:19:39', '2022-09-14 19:19:39'),
(2, 5, 'Home', 'test1', '01776600736', 1, 1, 79, '359 shahid janani jahanara imam shoroni, elephant road 1205 Dhaka, Dhaka Division, Bangladesh', '2022-09-22 10:02:38', '2022-09-22 10:02:38'),
(3, 6, 'Home', 'test1', '01776600736', 1, 1, 79, '359 shahid janani jahanara imam shoroni, elephant road 1205 Dhaka, Dhaka Division, Bangladesh', '2022-09-22 10:02:41', '2022-09-22 10:02:41'),
(4, 7, 'Home', 'test1', '01776600736', 1, 1, 79, '359 shahid janani jahanara imam shoroni, elephant road 1205 Dhaka, Dhaka Division, Bangladesh', '2022-09-22 10:02:41', '2022-09-22 10:02:41'),
(5, 8, 'Office', 'hr', '01688800826', 1, 1, 24, 'gulsan', '2022-10-05 11:32:25', '2022-10-05 11:32:25'),
(6, 35, 'Office', 'hr', '01688800826', 1, 1, 24, 'gulsan', '2022-11-09 17:59:35', '2022-11-09 17:59:35'),
(7, 35, 'Office', 'hr', '01688800826', 1, 1, 24, 'gulsan', '2022-11-09 17:59:35', '2022-11-09 17:59:35'),
(8, 35, 'Office', 'hr', '01688800826', 1, 1, 24, 'gulsan', '2022-11-09 17:59:35', '2022-11-09 17:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `qty` float NOT NULL,
  `shipping_charge` double(20,2) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `service_amount` double(20,2) DEFAULT NULL,
  `service_discount` double(20,2) DEFAULT NULL,
  `total` double(20,2) NOT NULL,
  `return_status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `customer_id`, `product_id`, `package_id`, `qty`, `shipping_charge`, `service_id`, `service_amount`, `service_discount`, `total`, `return_status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, NULL, 4, 20.00, 1, 50.00, 0.00, 220.00, 0, '2022-09-14 18:17:54', '2022-09-14 18:25:33'),
(2, 1, 2, 2, NULL, 1, 30.00, 4, 80.00, 0.00, 110.00, 0, '2022-09-14 18:25:50', '2022-09-14 18:25:50'),
(3, 2, 3, 1, NULL, 2, 20.00, 1, 50.00, 0.00, 120.00, 0, '2022-09-14 18:38:13', '2022-09-14 18:43:09'),
(4, 2, 3, 2, NULL, 1, 30.00, 4, 80.00, 0.00, 110.00, 0, '2022-09-14 18:43:28', '2022-09-14 18:43:28'),
(5, 3, 3, 1, NULL, 1, 20.00, 2, 45.00, 4.50, 60.50, 0, '2022-09-14 19:19:39', '2022-09-14 19:19:39'),
(6, 5, 4, 1, NULL, 5, 20.00, 3, 40.00, 0.00, 220.00, 0, '2022-09-22 10:02:38', '2022-09-22 10:02:38'),
(7, 6, 4, 1, NULL, 5, 20.00, 3, 40.00, 0.00, 220.00, 0, '2022-09-22 10:02:41', '2022-09-22 10:02:41'),
(8, 7, 4, 1, NULL, 5, 20.00, 3, 40.00, 0.00, 220.00, 0, '2022-09-22 10:02:41', '2022-09-22 10:02:41'),
(9, 8, 5, 11, NULL, 10, 0.00, 36, 50.00, 0.00, 500.00, 0, '2022-10-05 11:32:25', '2022-10-05 11:32:25'),
(10, 9, 3, 16, NULL, 4, 0.00, 48, 35.00, 0.00, 140.00, 0, '2022-10-05 11:42:10', '2022-10-05 11:42:10'),
(11, 9, 3, 6, NULL, 2, 0.00, 26, 150.00, 0.00, 300.00, 0, '2022-10-05 11:42:10', '2022-10-05 11:42:10'),
(12, 10, 3, 28, NULL, 1, 0.00, 79, 35.00, 0.00, 35.00, 0, '2022-10-06 18:16:44', '2022-10-24 15:13:54'),
(13, 10, 3, 35, NULL, 1, 0.00, 97, 180.00, 0.00, 180.00, 0, '2022-10-06 18:16:44', '2022-10-06 18:16:44'),
(14, 10, 3, 4, NULL, 2, 0.00, 15, 60.00, 0.00, 120.00, 0, '2022-10-06 18:16:44', '2022-10-06 18:16:44'),
(15, 15, 3, 2, NULL, 3, NULL, 18, 200.00, 0.00, 600.00, 0, '2022-10-24 11:43:11', '2022-10-24 11:43:11'),
(16, 15, 3, NULL, 2, 1, NULL, NULL, NULL, NULL, 1000.00, 0, '2022-10-24 11:43:11', '2022-10-24 11:43:11'),
(17, 16, 3, NULL, 3, 1, NULL, NULL, NULL, NULL, 1500.00, 0, '2022-10-24 19:11:07', '2022-10-24 19:11:07'),
(18, 17, 3, NULL, 2, 1, NULL, NULL, NULL, NULL, 1000.00, 0, '2022-10-26 10:45:08', '2022-10-26 10:45:08'),
(19, 18, 3, NULL, 2, 1, NULL, NULL, NULL, NULL, 1000.00, 0, '2022-10-26 17:04:11', '2022-10-26 17:04:11'),
(21, 21, 3, NULL, 4, 1, NULL, NULL, NULL, NULL, 2000.00, 0, '2022-10-27 12:13:17', '2022-10-27 12:13:17'),
(36, 32, 0, 3, NULL, 1, 25.00, 1, 100.00, 0.00, 125.00, 0, '2022-11-02 18:57:58', '2022-11-02 18:57:58'),
(37, 33, 0, 3, NULL, 1, 25.00, 3, 120.00, 0.00, 145.00, 0, '2022-11-02 19:00:39', '2022-11-02 19:00:39'),
(38, 33, 0, 3, NULL, 1, 25.00, 1, 100.00, 0.00, 125.00, 0, '2022-11-02 19:00:39', '2022-11-02 19:00:39'),
(39, 34, 0, 4, NULL, 1, 0.00, 1, 20.00, 0.00, 20.00, 0, '2022-11-02 19:03:18', '2022-11-02 19:03:18'),
(40, 34, 0, 4, NULL, 1, 0.00, 2, 60.00, 0.00, 60.00, 0, '2022-11-02 19:03:18', '2022-11-02 19:03:18'),
(41, 35, 5, 40, NULL, 1, 0.00, 3, 10.00, 0.00, 10.00, 0, '2022-11-09 17:59:35', '2022-11-09 17:59:35'),
(42, 35, 5, 40, NULL, 1, 0.00, 2, 15.00, 0.00, 15.00, 0, '2022-11-09 17:59:35', '2022-11-09 17:59:35'),
(43, 35, 5, 40, NULL, 1, 0.00, 1, 8.00, 0.00, 8.00, 0, '2022-11-09 17:59:35', '2022-11-09 17:59:35'),
(44, 36, 0, 3, NULL, 1, 25.00, 3, 120.00, 0.00, 145.00, 0, '2022-11-11 18:35:03', '2022-11-11 18:35:03'),
(45, 37, 0, 4, NULL, 1, 0.00, 1, 20.00, 0.00, 20.00, 0, '2022-11-11 18:36:35', '2022-11-11 18:36:35'),
(46, 37, 0, 2, NULL, 1, 25.00, 2, 200.00, 0.00, 225.00, 0, '2022-11-11 18:36:36', '2022-11-11 18:36:36'),
(47, 38, 0, 4, NULL, 1, 0.00, 1, 20.00, 0.00, 20.00, 0, '2022-11-12 16:33:43', '2022-11-12 16:33:43'),
(48, 38, 0, 4, NULL, 8, 0.00, 3, 100.00, 0.00, 800.00, 0, '2022-11-12 16:33:43', '2022-11-12 16:33:43'),
(49, 39, 2, 2, NULL, 1, 25.00, 18, 200.00, 0.00, 225.00, 0, '2022-11-12 17:55:11', '2022-11-12 17:55:11'),
(50, 39, 2, 1, NULL, 1, 50.00, 19, 50.00, 0.00, 100.00, 0, '2022-11-12 17:55:12', '2022-11-12 17:55:12'),
(51, 40, 10, 1, NULL, 2, 50.00, 21, 40.00, 0.00, 130.00, 0, '2022-11-12 19:47:25', '2022-11-12 19:47:25'),
(52, 40, 10, 4, NULL, 2, 0.00, 16, 100.00, 0.00, 200.00, 0, '2022-11-12 19:47:25', '2022-11-12 19:47:25'),
(53, 41, 9, 10, NULL, 1, 0.00, 34, 130.00, 0.00, 130.00, 0, '2022-11-13 17:25:58', '2022-11-13 17:25:58'),
(54, 41, 9, 11, NULL, 1, 0.00, 37, 75.00, 0.00, 75.00, 0, '2022-11-13 17:25:58', '2022-11-13 17:25:58'),
(55, 41, 9, 13, NULL, 1, 0.00, 41, 80.00, 0.00, 80.00, 0, '2022-11-13 17:25:58', '2022-11-13 17:25:58'),
(56, 41, 9, 28, NULL, 1, 0.00, 80, 60.00, 0.00, 60.00, 0, '2022-11-13 17:25:58', '2022-11-13 17:25:58'),
(57, 41, 9, 32, NULL, 3, 0.00, 91, 250.00, 0.00, 750.00, 0, '2022-11-13 17:25:58', '2022-11-13 17:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `order_shippings`
--

CREATE TABLE `order_shippings` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `region_id` int(5) NOT NULL,
  `city_id` int(5) NOT NULL,
  `area_id` int(8) NOT NULL,
  `address` varchar(155) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `order_shippings`
--

INSERT INTO `order_shippings` (`id`, `order_id`, `type`, `fullname`, `mobile_no`, `region_id`, `city_id`, `area_id`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 'Home', 'customer-2', '01910863553', 1, 1, 36, 'zahaz building', '2022-09-14 18:17:54', '2022-09-14 18:17:54'),
(2, 2, 'Home', 'hafizul', '01789725276', 1, 1, 1, 'zahaz building', '2022-09-14 18:38:13', '2022-09-14 18:38:13'),
(3, 3, 'Home', 'hafizul', '01789725276', 1, 1, 1, 'zahaz building', '2022-09-14 19:19:39', '2022-09-14 19:19:39'),
(4, 5, 'Home', 'test1', '01776600736', 1, 1, 79, '359 shahid janani jahanara imam shoroni, elephant road 1205 Dhaka, Dhaka Division, Bangladesh', '2022-09-22 10:02:38', '2022-09-22 10:02:38'),
(5, 6, 'Home', 'test1', '01776600736', 1, 1, 79, '359 shahid janani jahanara imam shoroni, elephant road 1205 Dhaka, Dhaka Division, Bangladesh', '2022-09-22 10:02:41', '2022-09-22 10:02:41'),
(6, 7, 'Home', 'test1', '01776600736', 1, 1, 79, '359 shahid janani jahanara imam shoroni, elephant road 1205 Dhaka, Dhaka Division, Bangladesh', '2022-09-22 10:02:41', '2022-09-22 10:02:41'),
(7, 8, 'Office', 'hr', '01688800826', 1, 1, 24, 'gulsan', '2022-10-05 11:32:25', '2022-10-05 11:32:25'),
(8, 9, 'Home', 'hafizul', '01789725276', 1, 1, 1, 'zahaz building', '2022-10-05 11:42:10', '2022-10-05 11:42:10'),
(9, 10, 'Home', 'hafizul', '01789725276', 1, 1, 1, 'zahaz building', '2022-10-06 18:16:45', '2022-10-06 18:16:45'),
(10, 15, 'Home', 'hafizul', '01789725276', 1, 1, 1, 'zahaz building', '2022-10-24 11:43:11', '2022-10-24 11:43:11'),
(11, 16, 'Home', 'hafizul', '01789725276', 1, 1, 1, 'zahaz building', '2022-10-24 19:11:07', '2022-10-24 19:11:07'),
(12, 17, 'Home', 'hafizul', '01789725276', 1, 1, 1, 'zahaz building', '2022-10-26 10:45:08', '2022-10-26 10:45:08'),
(13, 18, 'Home', 'hafizul', '01789725276', 1, 1, 1, 'zahaz building', '2022-10-26 17:04:11', '2022-10-26 17:04:11'),
(14, 20, 'Home', 'hafizul', '01789725276', 1, 1, 1, 'zahaz building', '2022-10-27 12:11:29', '2022-10-27 12:11:29'),
(15, 21, 'Home', 'hafizul', '01789725276', 1, 1, 1, 'zahaz building', '2022-10-27 12:13:17', '2022-10-27 12:13:17'),
(16, 22, 'Home', 'hafizul', '01789725276', 1, 1, 1, 'zahaz building', '2022-10-27 17:28:12', '2022-10-27 17:28:12'),
(17, 35, 'Office', 'hr', '01688800826', 1, 1, 24, 'gulsan', '2022-11-09 17:59:35', '2022-11-09 17:59:35'),
(18, 35, 'Office', 'hr', '01688800826', 1, 1, 24, 'gulsan', '2022-11-09 17:59:35', '2022-11-09 17:59:35'),
(19, 35, 'Office', 'hr', '01688800826', 1, 1, 24, 'gulsan', '2022-11-09 17:59:35', '2022-11-09 17:59:35'),
(20, 39, 'Home', 'customer-2', '01910863553', 1, 1, 36, 'zahaz building', '2022-11-12 17:55:12', '2022-11-12 17:55:12'),
(21, 40, 'Home', 'Mahfuz', '01961472921', 1, 1, 17, 'jnia na', '2022-11-12 19:47:25', '2022-11-12 19:47:25'),
(22, 41, 'Home', 'office', '01841122026', 1, 1, 79, 'fdvdsfxrv', '2022-11-13 17:25:58', '2022-11-13 17:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `order_views`
--

CREATE TABLE `order_views` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_views`
--

INSERT INTO `order_views` (`id`, `order_id`, `user_id`, `user_type_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2022-09-14 18:18:06', '2022-09-14 18:18:06'),
(2, 1, 1, 2, '2022-09-14 18:24:16', '2022-09-14 18:24:16'),
(3, 1, 1, 3, '2022-09-14 18:31:45', '2022-09-14 18:31:45'),
(4, 2, 1, 1, '2022-09-14 18:41:26', '2022-09-14 18:41:26'),
(5, 2, 1, 2, '2022-09-14 18:42:46', '2022-09-14 18:42:46'),
(6, 2, 1, 3, '2022-09-14 18:46:59', '2022-09-14 18:46:59'),
(7, 9, 1, 1, '2022-10-05 11:43:05', '2022-10-05 11:43:05'),
(8, 10, 1, 1, '2022-10-06 18:17:12', '2022-10-06 18:17:12'),
(9, 15, 1, 1, '2022-10-24 13:22:58', '2022-10-24 13:22:58'),
(10, 14, 1, 1, '2022-10-24 13:22:58', '2022-10-24 13:22:58'),
(11, 13, 1, 1, '2022-10-24 13:22:58', '2022-10-24 13:22:58'),
(12, 12, 1, 1, '2022-10-24 13:22:58', '2022-10-24 13:22:58'),
(13, 11, 1, 1, '2022-10-24 13:22:58', '2022-10-24 13:22:58'),
(14, 16, 1, 1, '2022-10-24 19:12:45', '2022-10-24 19:12:45'),
(15, 17, 1, 1, '2022-10-26 10:46:09', '2022-10-26 10:46:09'),
(16, 18, 1, 1, '2022-10-26 17:05:10', '2022-10-26 17:05:10'),
(17, 21, 1, 1, '2022-10-27 12:22:30', '2022-10-27 12:22:30'),
(18, 22, 1, 1, '2022-10-27 17:28:45', '2022-10-27 17:28:45'),
(19, 39, 1, 1, '2022-11-12 17:55:24', '2022-11-12 17:55:24'),
(20, 40, 1, 1, '2022-11-12 19:47:52', '2022-11-12 19:47:52'),
(21, 41, 1, 1, '2022-11-13 17:26:19', '2022-11-13 17:26:19');

-- --------------------------------------------------------

--
-- Table structure for table `parcelnotes`
--

CREATE TABLE `parcelnotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parcelId` int(11) DEFAULT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parcelnotes`
--

INSERT INTO `parcelnotes` (`id`, `parcelId`, `remark`, `note`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'parcel create successfully', NULL, '2022-04-07 04:20:39', '2022-04-07 04:20:39'),
(2, 2, NULL, 'parcel create successfully', NULL, '2022-04-09 23:01:36', '2022-04-09 23:01:36'),
(3, 1, NULL, 'Deliveryman Asign', NULL, '2022-04-17 15:08:41', '2022-04-17 15:08:41'),
(4, 3, NULL, 'parcel create successfully', NULL, '2022-04-17 18:23:21', '2022-04-17 18:23:21'),
(5, 4, NULL, 'parcel create successfully', NULL, '2022-04-17 18:27:05', '2022-04-17 18:27:05'),
(6, 5, NULL, 'parcel create successfully', NULL, '2022-04-17 18:27:30', '2022-04-17 18:27:30'),
(7, 6, NULL, 'parcel create successfully', NULL, '2022-04-17 18:27:52', '2022-04-17 18:27:52'),
(8, 7, NULL, 'parcel create successfully', NULL, '2022-04-17 18:28:10', '2022-04-17 18:28:10'),
(9, 8, NULL, 'parcel create successfully', NULL, '2022-04-17 18:28:50', '2022-04-17 18:28:50'),
(10, 9, NULL, 'parcel create successfully', NULL, '2022-04-17 18:29:16', '2022-04-17 18:29:16'),
(11, 9, NULL, 'Deliveryman Asign', NULL, '2022-04-17 18:30:59', '2022-04-17 18:30:59'),
(12, 8, NULL, 'Deliveryman Asign', NULL, '2022-04-17 18:31:06', '2022-04-17 18:31:06'),
(13, 7, NULL, 'Deliveryman Asign', NULL, '2022-04-17 18:31:15', '2022-04-17 18:31:15'),
(14, 6, NULL, 'Deliveryman Asign', NULL, '2022-04-17 18:31:26', '2022-04-17 18:31:26'),
(15, 5, NULL, 'Deliveryman Asign', NULL, '2022-04-17 18:31:37', '2022-04-17 18:31:37'),
(16, 4, NULL, 'Deliveryman Asign', NULL, '2022-04-17 18:31:46', '2022-04-17 18:31:46'),
(17, 3, NULL, 'Deliveryman Asign', NULL, '2022-04-17 18:31:55', '2022-04-17 18:31:55'),
(18, 2, NULL, 'Deliveryman Asign', NULL, '2022-04-17 18:32:04', '2022-04-17 18:32:04'),
(33, 15, NULL, 'parcel create successfully', NULL, '2022-04-23 05:17:54', '2022-04-23 05:17:54'),
(34, 16, NULL, 'parcel create successfully', NULL, '2022-04-23 09:48:00', '2022-04-23 09:48:00'),
(42, 21, NULL, 'Parcel create successfully', NULL, '2022-04-27 00:24:12', '2022-04-27 00:24:12'),
(43, 22, NULL, 'Parcel create successfully', NULL, '2022-04-27 01:10:19', '2022-04-27 01:10:19'),
(44, 23, NULL, 'Parcel create successfully', NULL, '2022-04-27 05:15:01', '2022-04-27 05:15:01'),
(45, 23, NULL, 'Agent Asign', NULL, '2022-04-27 05:27:07', '2022-04-27 05:27:07'),
(46, 23, NULL, 'Deliveryman Asign', NULL, '2022-04-27 05:27:24', '2022-04-27 05:27:24'),
(47, 23, NULL, 'Deliveryman Asign', NULL, '2022-04-27 05:27:34', '2022-04-27 05:27:34'),
(48, 24, NULL, 'Parcel create successfully', NULL, '2022-05-08 23:22:56', '2022-05-08 23:22:56'),
(49, 24, NULL, 'pickupman Asign', NULL, '2022-05-09 15:51:55', '2022-05-09 15:51:55'),
(50, 24, NULL, 'pickupman Asign', NULL, '2022-05-09 15:57:01', '2022-05-09 15:57:01'),
(52, 25, NULL, 'Parcel create successfully', NULL, '2022-05-20 03:12:24', '2022-05-20 03:12:24'),
(53, 25, 'M S R - 01958368169', 'Agent Asign', NULL, '2022-05-20 03:14:57', '2022-05-20 03:14:57'),
(54, 25, 'M S R - 01958368169', 'Agent Asign', NULL, '2022-05-20 03:15:11', '2022-05-20 03:15:11'),
(55, 25, 'Md. Mamun Sarker - 01404477009', 'Deliveryman Asign', NULL, '2022-05-20 04:08:26', '2022-05-20 04:08:26'),
(56, 25, 'Al Arfin - 01729890904', 'Deliveryman Asign', NULL, '2022-05-20 04:08:38', '2022-05-20 04:08:38'),
(60, 27, NULL, 'Parcel create successfully', NULL, '2022-05-21 06:46:21', '2022-05-21 06:46:21'),
(61, 28, NULL, 'Parcel create successfully', NULL, '2022-05-21 07:09:47', '2022-05-21 07:09:47'),
(62, 28, NULL, 'Your parcel Picked', NULL, '2022-05-22 00:26:28', '2022-05-22 00:26:28'),
(63, 27, NULL, 'Your parcel Picked', NULL, '2022-05-22 00:26:28', '2022-05-22 00:26:28'),
(64, 28, 'Jahangir Mamun - 01404466001', 'Pickupman Asign', NULL, '2022-05-22 18:11:12', '2022-05-22 18:11:12'),
(65, 28, 'Md. Mamun Sarker - 01404477009', 'Deliveryman Asign', NULL, '2022-05-22 18:11:24', '2022-05-22 18:11:24'),
(66, 28, 'Mr. Mamun Sarker - 01404477001', 'Agent Asign', NULL, '2022-05-22 18:11:51', '2022-05-22 18:11:51'),
(67, 27, 'Jahangir Mamun - 01404466001', 'Pickupman Asign', NULL, '2022-05-22 18:12:57', '2022-05-22 18:12:57'),
(68, 29, NULL, 'Parcel create successfully', NULL, '2022-05-23 23:03:10', '2022-05-23 23:03:10'),
(69, 30, NULL, 'Parcel create successfully', NULL, '2022-05-23 23:11:52', '2022-05-23 23:11:52'),
(70, 31, NULL, 'Parcel create successfully', NULL, '2022-05-23 23:14:16', '2022-05-23 23:14:16'),
(71, 32, NULL, 'Parcel create successfully', NULL, '2022-05-23 23:17:39', '2022-05-23 23:17:39'),
(72, 33, NULL, 'Parcel create successfully', NULL, '2022-05-23 23:20:21', '2022-05-23 23:20:21'),
(73, 34, NULL, 'Parcel create successfully', NULL, '2022-05-23 23:22:59', '2022-05-23 23:22:59'),
(74, 35, NULL, 'Parcel create successfully', NULL, '2022-05-25 01:33:29', '2022-05-25 01:33:29'),
(75, 35, NULL, 'Parcel updated successfully', NULL, '2022-05-25 22:27:05', '2022-05-25 22:27:05'),
(76, 35, NULL, 'Parcel updated successfully', NULL, '2022-05-25 22:29:48', '2022-05-25 22:29:48'),
(77, 33, NULL, 'Parcel updated successfully', NULL, '2022-05-25 22:30:31', '2022-05-25 22:30:31'),
(78, 35, NULL, 'Parcel updated successfully', NULL, '2022-05-25 22:33:36', '2022-05-25 22:33:36'),
(79, 33, NULL, 'Parcel updated successfully', NULL, '2022-05-25 22:34:03', '2022-05-25 22:34:03'),
(80, 35, NULL, 'Parcel updated successfully', NULL, '2022-05-25 22:43:44', '2022-05-25 22:43:44'),
(81, 35, NULL, 'Parcel updated successfully', NULL, '2022-05-26 00:54:37', '2022-05-26 00:54:37'),
(82, 35, NULL, 'Parcel updated successfully', NULL, '2022-05-26 01:32:56', '2022-05-26 01:32:56'),
(83, 28, 'Al Arfin - 01729890904', 'Pickupman Asign', NULL, '2022-05-26 01:35:07', '2022-05-26 01:35:07'),
(84, 28, 'Al Arfin Rokon - 01729890904', 'Deliveryman Asign', NULL, '2022-05-26 01:35:39', '2022-05-26 01:35:39'),
(85, 36, NULL, 'Parcel create successfully', NULL, '2022-05-26 20:10:07', '2022-05-26 20:10:07'),
(86, 37, NULL, 'Parcel create successfully', NULL, '2022-05-26 20:38:49', '2022-05-26 20:38:49'),
(87, 37, NULL, 'pickupman Asign', NULL, '2022-05-26 21:10:35', '2022-05-26 21:10:35'),
(88, 37, NULL, 'Deliveryman Asign', NULL, '2022-05-26 21:11:59', '2022-05-26 21:11:59'),
(89, 34, NULL, 'Parcel updated successfully', NULL, '2022-05-27 03:15:56', '2022-05-27 03:15:56'),
(90, 33, NULL, 'pickupman Asign', NULL, '2022-05-27 03:25:46', '2022-05-27 03:25:46'),
(91, 35, NULL, 'pickupman Asign', NULL, '2022-05-27 03:26:38', '2022-05-27 03:26:38'),
(92, 28, NULL, 'Your parcel Delivered', NULL, '2022-05-27 05:27:38', '2022-05-27 05:27:38'),
(93, 27, NULL, 'Your parcel Delivered', NULL, '2022-05-27 05:28:53', '2022-05-27 05:28:53'),
(94, 38, NULL, 'Parcel create successfully', NULL, '2022-05-27 05:44:55', '2022-05-27 05:44:55'),
(95, 38, 'Mr. Mamun Sarker - 01404477001', 'Agent Asign', NULL, '2022-05-27 05:46:04', '2022-05-27 05:46:04'),
(96, 38, 'Al Arfin - 01729890904', 'Pickupman Asign', NULL, '2022-05-27 05:46:39', '2022-05-27 05:46:39'),
(97, 38, 'Al Arfin - 01729890904', 'Deliveryman Asign', NULL, '2022-05-27 05:47:46', '2022-05-27 05:47:46'),
(98, 38, NULL, 'Your parcel Picked', NULL, '2022-05-27 07:13:04', '2022-05-27 07:13:04'),
(99, 38, NULL, 'Your parcel Hold', NULL, '2022-05-27 07:13:25', '2022-05-27 07:13:25'),
(100, 38, NULL, 'Your parcel Return To Hub', NULL, '2022-05-27 07:14:38', '2022-05-27 07:14:38'),
(101, 38, NULL, 'Your parcel Return To Merchant', NULL, '2022-05-27 07:15:08', '2022-05-27 07:15:08'),
(102, 38, NULL, 'Your parcel Pending', NULL, '2022-05-27 07:18:08', '2022-05-27 07:18:08'),
(103, 38, NULL, 'Your parcel Cancelled', NULL, '2022-05-27 07:19:02', '2022-05-27 07:19:02'),
(104, 22, 'R zaman - 01713023788', 'Agent assign', NULL, '2022-05-28 01:36:44', '2022-05-28 01:36:44'),
(105, 21, 'R zaman - 01713023788', 'Agent assign', NULL, '2022-05-28 01:36:55', '2022-05-28 01:36:55'),
(106, 39, NULL, 'Parcel create successfully', NULL, '2022-05-28 21:18:04', '2022-05-28 21:18:04'),
(107, 39, NULL, 'Parcel updated successfully', NULL, '2022-05-28 21:19:50', '2022-05-28 21:19:50'),
(108, 39, NULL, 'Your parcel Return To Merchant', NULL, '2022-06-02 09:35:45', '2022-06-02 09:35:45'),
(109, 36, 'Al Arfin - 01729890904', 'Agent Asign', NULL, '2022-06-02 11:01:02', '2022-06-02 11:01:02'),
(110, 35, NULL, 'Your parcel Delivered', NULL, '2022-06-02 11:04:27', '2022-06-02 11:04:27'),
(111, 34, NULL, 'Your parcel Cancelled', NULL, '2022-06-04 10:05:57', '2022-06-04 10:05:57'),
(112, 34, NULL, 'Parcel updated successfully', NULL, '2022-06-04 10:07:30', '2022-06-04 10:07:30'),
(113, 34, NULL, 'Your parcel Cancelled', NULL, '2022-06-04 10:07:53', '2022-06-04 10:07:53'),
(114, 37, NULL, 'Your parcel Cancelled', NULL, '2022-06-04 10:11:02', '2022-06-04 10:11:02'),
(115, 34, NULL, 'Your parcel Cancelled', NULL, '2022-06-04 10:19:40', '2022-06-04 10:19:40'),
(116, 37, NULL, 'Your parcel Cancelled', NULL, '2022-06-04 11:35:51', '2022-06-04 11:35:51'),
(117, 33, 'Al Arfin - 01729890904', 'Agent Asign', NULL, '2022-06-04 12:07:54', '2022-06-04 12:07:54'),
(118, 33, NULL, 'Your parcel Picked', NULL, '2022-06-04 12:10:22', '2022-06-04 12:10:22'),
(119, 40, NULL, 'Parcel create successfully', NULL, '2022-06-13 05:51:33', '2022-06-13 05:51:33'),
(120, 40, NULL, 'Parcel updated successfully', NULL, '2022-06-13 05:52:26', '2022-06-13 05:52:26'),
(121, 41, NULL, 'Parcel create successfully', NULL, '2022-06-13 06:08:49', '2022-06-13 06:08:49'),
(122, 41, NULL, 'Parcel updated successfully', NULL, '2022-06-13 06:09:35', '2022-06-13 06:09:35'),
(123, 41, 'Al Arfin - 01729890904', 'Pickupman Asign', NULL, '2022-06-13 09:02:05', '2022-06-13 09:02:05'),
(124, 41, NULL, 'Your parcel PICKED', NULL, '2022-06-13 09:07:12', '2022-06-13 09:07:12'),
(125, 41, NULL, 'Your parcel PICKED', NULL, '2022-06-13 09:07:38', '2022-06-13 09:07:38'),
(126, 24, NULL, 'Your parcel PICKED', NULL, '2022-06-13 09:07:38', '2022-06-13 09:07:38'),
(127, 6, NULL, 'Your parcel PICKED', NULL, '2022-06-13 10:03:13', '2022-06-13 10:03:13'),
(128, 3, NULL, 'Your parcel PICKED', NULL, '2022-06-13 10:03:13', '2022-06-13 10:03:13'),
(129, 42, NULL, 'Parcel create successfully', NULL, '2022-06-13 11:07:43', '2022-06-13 11:07:43'),
(130, 42, 'Al Arfin - 01729890904', 'Pickupman Asign', NULL, '2022-06-13 11:47:32', '2022-06-13 11:47:32'),
(131, 43, NULL, 'Parcel create successfully', NULL, '2022-06-15 09:21:18', '2022-06-15 09:21:18'),
(132, 43, NULL, 'Parcel updated successfully', NULL, '2022-06-15 09:24:26', '2022-06-15 09:24:26'),
(133, 43, NULL, 'Parcel updated successfully', NULL, '2022-06-15 09:24:39', '2022-06-15 09:24:39'),
(134, 6, NULL, 'Your parcel Hold', NULL, '2022-06-15 09:46:08', '2022-06-15 09:46:08'),
(135, 5, NULL, 'Your parcel Hold', NULL, '2022-06-15 09:47:40', '2022-06-15 09:47:40'),
(136, 41, 'Al Arfin - 01729890904', 'Deliveryman Asign', NULL, '2022-06-15 10:05:04', '2022-06-15 10:05:04'),
(137, 41, NULL, 'Your parcel Hold', NULL, '2022-06-15 10:05:42', '2022-06-15 10:05:42'),
(138, 41, NULL, 'Your parcel Delivered', NULL, '2022-06-15 10:06:51', '2022-06-15 10:06:51'),
(139, 44, NULL, 'Parcel create successfully', NULL, '2022-06-15 10:15:51', '2022-06-15 10:15:51'),
(140, 44, NULL, 'Parcel updated successfully', NULL, '2022-06-15 10:17:00', '2022-06-15 10:17:00'),
(141, 44, 'Al Arfin - 01729890904', 'Pickupman Asign', NULL, '2022-06-15 11:08:05', '2022-06-15 11:08:05'),
(142, 44, NULL, 'Your parcel Picked', NULL, '2022-06-15 11:08:25', '2022-06-15 11:08:25'),
(143, 44, NULL, 'Your parcel Picked', NULL, '2022-06-15 11:09:58', '2022-06-15 11:09:58'),
(144, 44, 'Al Arfin - 01729890904', 'Agent Asign', NULL, '2022-06-15 11:11:44', '2022-06-15 11:11:44'),
(145, 43, 'Al Arfin - 01729890904', 'Deliveryman Asign', NULL, '2022-06-15 12:26:10', '2022-06-15 12:26:10'),
(146, 3, NULL, 'Your parcel Cancelled', NULL, '2022-06-15 12:27:33', '2022-06-15 12:27:33'),
(147, 45, NULL, 'Parcel create successfully', NULL, '2022-07-02 11:59:11', '2022-07-02 11:59:11'),
(148, 45, NULL, 'Parcel updated successfully', NULL, '2022-07-03 09:13:14', '2022-07-03 09:13:14'),
(149, 45, NULL, 'Parcel updated successfully', NULL, '2022-07-03 09:15:43', '2022-07-03 09:15:43'),
(150, 46, NULL, 'Parcel create successfully', NULL, '2022-07-03 09:56:28', '2022-07-03 09:56:28'),
(151, 46, NULL, 'Parcel updated successfully', NULL, '2022-07-03 09:56:47', '2022-07-03 09:56:47'),
(152, 46, NULL, 'Parcel updated successfully', NULL, '2022-07-03 09:59:43', '2022-07-03 09:59:43'),
(153, 47, NULL, 'Parcel create successfully', NULL, '2022-07-03 12:29:54', '2022-07-03 12:29:54'),
(154, 47, NULL, 'Parcel updated successfully', NULL, '2022-07-03 12:30:23', '2022-07-03 12:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `parcels`
--

CREATE TABLE `parcels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoiceNo` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchantId` int(11) DEFAULT NULL,
  `paymentInvoice` int(11) DEFAULT NULL,
  `cod` double(20,2) DEFAULT '0.00',
  `merchantAmount` double(20,2) NOT NULL DEFAULT '0.00',
  `merchantDue` double(20,2) NOT NULL DEFAULT '0.00',
  `deliveryman_amount` double(20,2) NOT NULL DEFAULT '0.00',
  `deliveryman_paid` double(20,2) NOT NULL DEFAULT '0.00',
  `deliveryman_due` double(20,2) NOT NULL DEFAULT '0.00',
  `pickupman_amount` double(20,2) NOT NULL DEFAULT '0.00',
  `pickupman_paid` double(20,2) NOT NULL DEFAULT '0.00',
  `pickupman_due` double(20,2) NOT NULL DEFAULT '0.00',
  `merchantpayStatus` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchantPaid` double(20,2) NOT NULL DEFAULT '0.00',
  `recipientName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipientAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipientPhone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliveryCharge` double(20,2) DEFAULT '0.00',
  `promotiuonal_discount` double(20,2) NOT NULL DEFAULT '0.00',
  `codCharge` double(20,2) DEFAULT '0.00',
  `productPrice` double(20,2) DEFAULT '0.00',
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `thana_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `delivery_address` text COLLATE utf8mb4_unicode_ci,
  `deliverymanId` int(11) DEFAULT NULL,
  `pickupmanId` int(11) DEFAULT NULL,
  `agentId` int(11) DEFAULT NULL,
  `productWeight` double(20,2) DEFAULT '0.00',
  `trackingCode` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percelType` int(11) DEFAULT NULL,
  `helpNumber` int(11) DEFAULT NULL,
  `reciveZone` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_thana_id` int(11) DEFAULT NULL,
  `pickLocation` text COLLATE utf8mb4_unicode_ci,
  `orderType` int(11) NOT NULL,
  `codType` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `status_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchantpayDate` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliveryman_pay_date` timestamp NULL DEFAULT NULL,
  `pickupman_pay_date` timestamp NULL DEFAULT NULL,
  `pickup_date` timestamp NULL DEFAULT NULL,
  `delivery_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parcels`
--

INSERT INTO `parcels` (`id`, `invoiceNo`, `merchantId`, `paymentInvoice`, `cod`, `merchantAmount`, `merchantDue`, `deliveryman_amount`, `deliveryman_paid`, `deliveryman_due`, `pickupman_amount`, `pickupman_paid`, `pickupman_due`, `merchantpayStatus`, `merchantPaid`, `recipientName`, `recipientAddress`, `recipientPhone`, `note`, `deliveryCharge`, `promotiuonal_discount`, `codCharge`, `productPrice`, `division_id`, `district_id`, `thana_id`, `area_id`, `delivery_address`, `deliverymanId`, `pickupmanId`, `agentId`, `productWeight`, `trackingCode`, `percelType`, `helpNumber`, `reciveZone`, `pickup_thana_id`, `pickLocation`, `orderType`, `codType`, `status`, `status_description`, `merchantpayDate`, `deliveryman_pay_date`, `pickupman_pay_date`, `pickup_date`, `delivery_date`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, NULL, 200.00, 110.01, 0.00, 25.00, 25.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Ariful Islam', 'fdhfd', '01729890904', 'test', 90.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 5.00, 'SC-208448', 2, NULL, '1', NULL, NULL, 2, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-07 04:20:39', '2022-08-18 09:00:40'),
(2, NULL, 2, 4, 430.00, 370.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '1', 370.00, 'Tulsi Chakma', '1/16, Razia Sultana Road, \r\nMohamadpur.', '0151718799', 'afternoon', 60.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1.00, 'SC-567470', 2, NULL, '6', NULL, NULL, 2, 1, 4, NULL, '2022-04-24', NULL, NULL, NULL, NULL, '2022-04-09 23:01:36', '2022-04-24 20:55:03'),
(3, NULL, 1, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Rashed Bhai', 'Testing address', '01742068094', 'Test', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 5.00, 'SC-647847', 2, NULL, '2', NULL, NULL, 2, 1, 9, NULL, NULL, NULL, NULL, '2022-06-13 10:03:13', NULL, '2022-04-17 18:23:21', '2022-06-15 12:27:33'),
(4, NULL, 1, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Rashedul', 'sdgdsfh', '01742068094', 'dfshds', 60.00, 0.00, 0.00, 2315.00, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 3.00, 'SC-558702', 1, NULL, '1', NULL, NULL, 2, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-17 18:27:05', '2022-04-18 19:17:06'),
(5, NULL, 1, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'ewrygerhfd', 'dfhhsh', '01742068094', 'dsfhs', 170.00, 0.00, 0.00, 3254.00, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 5.00, 'SC-844636', 1, NULL, '3', NULL, NULL, 1, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-17 18:27:30', '2022-06-15 09:47:40'),
(6, NULL, 1, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'fhsdfhsd', 'fdhdfh', '01742068094', 'hfdhsd', 150.00, 0.00, 0.00, 325.00, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 5.00, 'SC-126329', 1, NULL, '4', NULL, NULL, 3, 1, 5, NULL, NULL, NULL, NULL, '2022-06-13 10:03:13', NULL, '2022-04-17 18:27:52', '2022-06-15 09:46:08'),
(7, NULL, 1, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'dgdfahfdh', 'dfhsdfh', '01742068094', 'dfhhs', 170.00, 0.00, 0.00, 2413.00, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 5.00, 'SC-412558', 1, NULL, '6', NULL, NULL, 1, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-17 18:28:10', '2022-05-01 19:03:17'),
(8, NULL, 1, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'sdfdsdf', 'dfsghdfsh', '01742068094', 'dsfhgfdsh', 170.00, 0.00, 0.00, 233.00, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 5.00, 'SC-704076', 1, NULL, '3', NULL, NULL, 1, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-17 18:28:50', '2022-04-18 19:15:32'),
(9, NULL, 1, NULL, 2344.00, 2177.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'test', 'fdhdfh', '01742068094', 'dfhhdfh', 165.00, 0.00, 2.00, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 4.00, 'SC-749185', 2, NULL, '6', NULL, NULL, 1, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-17 18:29:16', '2022-04-18 19:12:40'),
(15, NULL, 23, NULL, 120.00, 59.00, 59.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Hasanurjaman Raju', 'malibag rail station', '01670504110', NULL, 60.00, 0.00, 1.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 'SC-738488', 2, NULL, '2', NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-23 05:17:54', '2022-04-23 05:42:25'),
(16, NULL, 2, NULL, 1230.00, 1158.00, 1158.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Ashiq', 'Mascot plaza, level-5,\nUttara sector-7, Dhaka.', '01711576457', '0', 60.00, 0.00, 12.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1.00, 'SC-405604', 2, NULL, '3', NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-23 09:48:00', '2022-04-23 09:48:00'),
(21, NULL, 2, NULL, 430.00, 365.70, 365.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Mehedi', 'r1, h1, b', '01404477007', NULL, 60.00, 0.00, 4.30, NULL, 1, 1, 6, 4, 'r1, h1, b', NULL, NULL, 2, 5.00, 'SC-592263', 2, NULL, NULL, NULL, '43/1, Senspara, Somaj Kalyan Mosjid Road, Mirpur, Dhaka Division, Bangladesh', 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-27 00:24:12', '2022-05-28 01:36:55'),
(22, NULL, 2, NULL, 570.00, 504.30, 504.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'manik sir', 'h-1,r-1, b-c', '01917731078', NULL, 60.00, 0.00, 5.70, NULL, 1, 1, 6, 3, 'h-1,r-1, b-c', NULL, NULL, 2, 0.50, 'SC-163990', 2, NULL, NULL, NULL, '43/1, Senspara, Somaj Kalyan Mosjid Road, Mirpur, Dhaka Division, Bangladesh', 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-27 01:10:19', '2022-05-28 01:36:44'),
(23, NULL, 2, NULL, 1050.00, 979.50, 979.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'farin', 'Mirpur', '01647518630', NULL, 60.00, 0.00, 10.50, NULL, 1, 1, 6, 3, 'Mirpur 10', 3, 3, 2, 1.00, 'SC-373464', 2, NULL, NULL, NULL, '43/1, Senspara, Somaj Kalyan Mosjid Road, Mirpur, Dhaka Division, Bangladesh', 5, 1, 8, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-27 05:15:01', '2022-05-11 17:15:57'),
(24, NULL, 1, NULL, 500.00, 365.00, 365.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Rokon', 'Testing address', '01729890904', NULL, 130.00, 0.00, 5.00, NULL, 1, 1, 1, 1, 'Testing address', NULL, 1, NULL, 800.00, 'SC-611532', 2, NULL, NULL, NULL, 'SabujbagTangail sadar', 2, 1, 2, NULL, NULL, NULL, NULL, '2022-06-13 09:07:38', NULL, '2022-05-08 23:22:56', '2022-06-13 09:07:38'),
(25, NULL, 1, NULL, 5100.00, 4954.00, 0.00, 25.00, 25.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'sajib', 'Wapda Road', '01958368163', NULL, 95.00, 0.00, 51.00, 0.00, 1, 1, 1, 1420, 'power house', 1, NULL, 5, 2.00, 'SC-117514', 2, NULL, NULL, NULL, 'Wapda Road', 3, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-20 03:12:24', '2022-06-15 10:49:30'),
(27, NULL, 2, 6, 350.00, 276.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '1', 276.50, 'Newly Marma', '43/1, Senspara, Somaj Kalyan Mosjid Road, Mirpur, Dhaka Division, Bangladesh', '01518356610', NULL, 70.00, 0.00, 3.50, 0.00, 1, 1, 136, 1084, 'Uttara sec-11, Rd-4, House- 54', NULL, 3, NULL, 1.00, 'SC-671645', 2, NULL, NULL, NULL, '43/1, Senspara, Somaj Kalyan Mosjid Road, Mirpur, Dhaka Division, Bangladesh', 3, 1, 4, NULL, '2022-05-26', NULL, NULL, NULL, '2022-05-26 07:00:00', '2022-05-21 06:46:21', '2022-05-27 05:32:56'),
(28, NULL, 2, 6, 850.00, 771.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '1', 771.50, 'Dinitra', '43/1, Senspara, Somaj Kalyan Mosjid Road, Mirpur, Dhaka Division, Bangladesh', '01717341433', NULL, 70.00, 0.00, 8.50, 0.00, 1, 1, 155, NULL, 'House-6, Lane-6, Ave -3, Mirpur-11, Dhaka', 1, 1, 6, 1.00, 'SC-381717', 2, NULL, NULL, NULL, '43/1, Senspara, Somaj Kalyan Mosjid Road, Mirpur, Dhaka Division, Bangladesh', 3, 1, 4, NULL, '2022-05-26', NULL, NULL, NULL, '2022-05-26 07:00:00', '2022-05-21 07:09:47', '2022-05-27 05:32:56'),
(29, NULL, 1, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Rashed', 'Sabujbag,Tangail sadar', '01742068094', 'this is test parcel', 0.00, 0.00, 0.00, 0.00, 1, 1, 1, 1379, 'Gazipur', NULL, NULL, NULL, 3.00, 'SC-334292', 2, NULL, NULL, NULL, 'Sabujbag,Tangail sadar', 3, 1, 9, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-23 23:03:10', '2022-06-04 11:58:00'),
(30, NULL, 1, NULL, 2000.00, 1910.00, 1910.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Rashed', 'Sabujbag,Tangail sadar', '01742068094', 'test parcel', 70.00, 0.00, 20.00, 0.00, 1, 1, 1, 1374, 'banani', NULL, NULL, NULL, 1.00, 'SC-252049', 2, NULL, NULL, NULL, 'Sabujbag,Tangail sadar', 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-23 23:11:52', '2022-05-23 23:11:52'),
(31, NULL, 1, NULL, 4000.00, 3860.00, 3860.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'sfdsdf', 'Sabujbag,Tangail sadar', '01745236985', 'dsfsdfsd', 100.00, 0.00, 40.00, 0.00, 1, 1, 16, 534, 'fsdfsdf', NULL, NULL, NULL, 3.00, 'SC-305097', 2, NULL, NULL, NULL, 'Sabujbag,Tangail sadar', 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-23 23:14:16', '2022-05-23 23:14:16'),
(32, NULL, 1, NULL, 475.00, 400.25, 400.25, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'dsfsdf', 'Sabujbag,Tangail sadar', '01745236589', 'dfsfsdf', 70.00, 0.00, 4.75, 0.00, 1, 1, 145, 181, 'sdfsf', NULL, NULL, NULL, 1.00, 'SC-796878', 2, NULL, NULL, NULL, 'Sabujbag,Tangail sadar', 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-23 23:17:39', '2022-05-23 23:17:39'),
(33, NULL, 1, NULL, 2540.00, 2399.60, 2399.60, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Rashedul', 'Sabujbag,Tangail sadar', '01742068096', 'test parcel', 115.00, 0.00, 25.40, 0.00, 1, 1, 16, 531, 'Banani', NULL, 1, 4, 4.00, 'SC-373842', 2, NULL, NULL, NULL, 'Sabujbag,Tangail sadar', 3, 1, 2, NULL, NULL, NULL, NULL, '2022-06-04 12:10:22', NULL, '2022-05-23 23:20:21', '2022-06-04 12:10:22'),
(34, NULL, 1, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Abu Huraira', 'Sabujbag,Tangail sadar', '01729890904', NULL, 0.00, 23.00, 0.00, 0.00, 1, 1, 1, 1379, 'tv gate', NULL, NULL, NULL, 4.00, 'SC-838751', 1, NULL, NULL, NULL, 'Sabujbag,Tangail sadar', 3, 1, 9, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-23 23:22:59', '2022-06-04 10:19:40'),
(35, NULL, 1, NULL, 3500.00, 3335.00, 3335.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Abu Huraira', 'Rampura', '01742068094', 'this is testing parcel', 130.00, 0.00, 35.00, 0.00, 1, 1, 145, 142, 'Naogaon, Bangladesh', NULL, 1, NULL, 5.00, 'SC-496987', 2, NULL, NULL, NULL, 'Rampura', 3, 1, 4, NULL, NULL, NULL, NULL, NULL, '2022-06-02 11:04:26', '2022-05-25 01:33:29', '2022-06-02 11:04:27'),
(36, NULL, 1, 5, 3500.00, 3365.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '1', 3365.00, 'Abu Huraira', 'Banani', '01910863553', 'This is test parcel', 100.00, 0.00, 35.00, 0.00, 1, 1, 1, 1374, 'ulon road, 317', NULL, NULL, 4, 3.00, 'SC-276537', 2, NULL, NULL, NULL, 'Banani', 3, 1, 1, NULL, '2022-05-26', NULL, NULL, NULL, NULL, '2022-05-26 20:10:07', '2022-06-02 11:01:02'),
(37, NULL, 1, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Testing Customer', 'Sabujbag,Tangail sadar', '01729890904', NULL, 0.00, 0.00, 0.00, 0.00, 1, 1, 16, NULL, 'Testing address', 1, 1, NULL, 1.00, 'SC-736578', 2, NULL, NULL, NULL, 'Sabujbag,Tangail sadar', 3, 1, 9, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 20:38:49', '2022-06-04 11:35:51'),
(38, NULL, 2, NULL, 700.00, 637.00, 637.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Mehjabin', '43/1, Senspara, Somaj Kalyan Mosjid Road, Mirpur, Dhaka Division, Bangladesh', '01748456144', NULL, 56.00, 0.00, 7.00, 0.00, 1, 1, 26, 1915, 'madrasha Goli', 1, 1, 6, 1.00, 'SC-227483', 2, NULL, NULL, NULL, '43/1, Senspara, Somaj Kalyan Mosjid Road, Mirpur, Dhaka Division, Bangladesh', 3, 1, 9, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-27 05:44:55', '2022-05-27 07:19:02'),
(39, NULL, 1, NULL, 0.00, -100.00, -100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'abu huraira', 'Sabujbag,Tangail sadar', '01742068094', 'test parcel', 100.00, 0.00, 50.00, 0.00, 1, 1, 145, 181, 'test', NULL, NULL, NULL, 3.00, 'SC-213327', 2, NULL, NULL, NULL, 'Sabujbag,Tangail sadar', 3, 1, 8, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-28 21:18:04', '2022-06-02 09:35:45'),
(40, NULL, 1, NULL, 1200.00, 1138.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Customer name', 'Pickup Location here', '01729890904', NULL, 56.00, 14.00, 6.00, 0.00, 1, 1, 16, NULL, 'Testing', NULL, NULL, NULL, 1.00, 'SC-652396', 2, NULL, NULL, NULL, 'Pickup Location here', 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-13 05:51:33', '2022-06-13 05:51:33'),
(41, NULL, 1, NULL, 1500.00, 1436.50, 1436.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Test customer', 'Pickup Location here', '01729890904', NULL, 56.00, 14.00, 7.50, 0.00, 1, 1, 16, NULL, 'Deliver address', 1, 1, NULL, 1.00, 'SC-954168', 2, NULL, NULL, NULL, 'Pickup Location here', 3, 3, 4, NULL, NULL, NULL, NULL, '2022-06-13 09:07:38', '2022-06-15 10:06:51', '2022-06-13 06:08:49', '2022-06-15 10:06:51'),
(42, NULL, 1, NULL, 1000.00, 939.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Customer testing', 'Pickup Location here', '01729890904', NULL, 56.00, 14.00, 5.00, 0.00, 1, 1, 16, NULL, 'address', NULL, 1, NULL, 1.00, 'SC-538686', 2, NULL, NULL, NULL, 'Pickup Location here', 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-13 11:07:43', '2022-06-13 11:47:32'),
(43, NULL, 1, NULL, 1200.00, 1138.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Testing', 'Pickup location', '01729890904', NULL, 56.00, 14.00, 6.00, 0.00, 1, 1, 16, NULL, 'Testing addres', 1, NULL, NULL, 1.00, 'SC-267636', 2, NULL, NULL, 53, 'Pickup location', 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-15 09:21:18', '2022-06-15 12:26:10'),
(44, NULL, 1, NULL, 1500.00, 1412.50, 0.00, 0.00, 0.00, 0.00, 30.00, 30.00, 0.00, NULL, 0.00, 'Rokon Uzzaman', 'Delivery address', '01729890904', NULL, 80.00, 20.00, 7.50, 0.00, 1, 1, 16, NULL, 'Delivery address', NULL, 1, 4, 3.00, 'SC-394151', 2, NULL, NULL, 54, 'Pickup location', 3, 3, 2, NULL, NULL, NULL, NULL, '2022-06-15 11:09:58', NULL, '2022-06-15 10:15:51', '2022-06-15 11:11:44'),
(45, NULL, 1, NULL, 0.00, -70.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Test', 'Testing address', '01729890904', NULL, 70.00, 0.00, 0.00, 0.00, 1, 1, 16, NULL, 'Testing address', NULL, NULL, NULL, 1.00, 'SC-212205', 1, NULL, NULL, 16, 'Pickup location', 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-02 11:59:11', '2022-07-03 09:13:14'),
(46, '124324', 1, NULL, 0.00, -70.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'Customer1', 'Test', '01729890904', NULL, 70.00, 0.00, 0.00, 0.00, 1, 1, 16, NULL, 'Test', NULL, NULL, NULL, 1.00, 'SC-923094', 1, NULL, NULL, 16, 'Pickup location', 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-03 09:56:28', '2022-07-03 09:56:28'),
(47, NULL, 1, NULL, 1200.00, 1109.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 'test customer', 'test', '01729890904', NULL, 85.00, 0.00, 6.00, 0.00, 1, 1, 16, NULL, 'test', NULL, NULL, NULL, 2.00, 'SC-531232', 2, NULL, NULL, 16, 'Pickup location', 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-03 12:29:54', '2022-07-03 12:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `parceltypes`
--

CREATE TABLE `parceltypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parceltypes`
--

INSERT INTO `parceltypes` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Pending', 'pending', NULL, NULL),
(2, 'Picked', 'picked', NULL, NULL),
(3, 'In Transit', 'in-transit', NULL, NULL),
(4, 'Delivered', 'deliverd', NULL, NULL),
(5, 'Hold', 'hold', NULL, NULL),
(6, 'Return Pending', 'return-pending', NULL, NULL),
(7, 'Return To Hub', 'return-to-hub', NULL, NULL),
(8, 'Return To Merchant', 'return-to-merchant', NULL, NULL),
(9, 'Cancelled', 'cancelled', NULL, NULL),
(10, 'Confirm', 'confirm', '2022-08-14 05:48:51', '2022-08-14 05:48:51'),
(11, 'Processing', 'processing', '2022-08-14 06:50:10', '2022-08-14 06:50:10'),
(12, 'Work completed', 'work-completed', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(2, 'website', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(3, 'setting', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(4, 'logo', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(5, 'logo_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(6, 'logo_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(7, 'logo_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(8, 'slider', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(9, 'slider_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(10, 'slider_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(11, 'slogan', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(12, 'feature', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(13, 'feature_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(14, 'feature_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(15, 'feature_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(16, 'hub_area', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(17, 'hub_area_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(18, 'hub_area_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(19, 'hub_area_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(20, 'service', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(21, 'service_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(22, 'service_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(23, 'service_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(24, 'create_page', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(25, 'create_page_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(26, 'create_page_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(27, 'create_page_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(28, 'panel_user', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(29, 'user_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(30, 'user_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(31, 'user_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(32, 'bulk_sms', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(33, 'send_sms', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(34, 'sms_balance', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(35, 'merchant', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(36, 'merchant_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(37, 'merchant_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(38, 'merchant_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(39, 'delivery_charge', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(40, 'delivery_charge_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(41, 'delivery_charge_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(42, 'delivery_charge_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(43, 'discount', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(44, 'promotional_discount_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(45, 'promotional_discount_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(46, 'area_panel', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(47, 'division', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(48, 'division_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(49, 'division_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(50, 'division_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(51, 'district', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(52, 'district_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(53, 'district_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(54, 'district_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(55, 'thana', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(56, 'thana_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(57, 'thana_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(58, 'thana_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(59, 'area', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(60, 'area_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(61, 'area_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(62, 'area_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(63, 'hr', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(64, 'department', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(65, 'department_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(66, 'department_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(67, 'department_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(68, 'employee', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(69, 'employee_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(70, 'employee_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(71, 'employee_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(72, 'deliveryman', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(73, 'deliveryman_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(74, 'deliveryman_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(75, 'deliveryman_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(76, 'parcel_manage', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(77, 'parcel_create', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(78, 'parcel_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(79, 'multiple_parcel_pick', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(80, 'payment', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(81, 'payment_to_merchant', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(82, 'report', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(83, 'summary_report', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(84, 'merchant_based_report', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(85, 'deliveryman_based_report', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(86, 'slider_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(87, 'discount_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(88, 'payroll', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(89, 'salary_process_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(90, 'salary_processes', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(91, 'payroll', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(92, 'salary_process_report', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(93, 'terms_condition', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(94, 'pickupman_based_report', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(95, 'payment_to_pickupman', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(96, 'payment_to_deliveryman', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(97, 'agent', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(98, 'agent_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(99, 'agent_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(100, 'agent_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(101, 'pickupman', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(102, 'pickupman_add', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(103, 'pickupman_edit', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29'),
(104, 'pickupman_delete', 'web', '2022-06-29 03:29:29', '2022-06-29 03:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `pickupman_agents`
--

CREATE TABLE `pickupman_agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pickupman_id` bigint(20) DEFAULT NULL,
  `agent_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickupman_areas`
--

CREATE TABLE `pickupman_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pickupman_id` bigint(20) DEFAULT NULL,
  `thana_id` bigint(20) DEFAULT NULL,
  `area_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickupman_education`
--

CREATE TABLE `pickupman_education` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pickupman_id` bigint(20) DEFAULT NULL,
  `exam_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gpa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `board` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickupman_experiences`
--

CREATE TABLE `pickupman_experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pickupman_id` bigint(20) DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `continuing` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickupman_payments`
--

CREATE TABLE `pickupman_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickupman_id` bigint(20) NOT NULL,
  `parcel_id` bigint(20) NOT NULL,
  `amount` double(20,2) DEFAULT '0.00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickupmen`
--

CREATE TABLE `pickupmen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternative_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_parcel_amount` double(20,2) DEFAULT '0.00',
  `nid_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_profession` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_nid_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_profession` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_nid_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` text COLLATE utf8mb4_unicode_ci,
  `permanent_address` text COLLATE utf8mb4_unicode_ci,
  `guaranteer_information` text COLLATE utf8mb4_unicode_ci,
  `guaranteer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guaranteer_relation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guaranteer_nid_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guaranteer_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guaranteer_present_address` text COLLATE utf8mb4_unicode_ci,
  `guaranteer_permanent_address` text COLLATE utf8mb4_unicode_ci,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `thana_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passwordReset` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_role` tinyint(4) NOT NULL DEFAULT '3',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nid_front` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_back` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification_type` tinyint(1) NOT NULL COMMENT '1:nid,2:birth certificate'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pickupmen`
--

INSERT INTO `pickupmen` (`id`, `name`, `email`, `phone`, `alternative_phone`, `per_parcel_amount`, `nid_no`, `image`, `branch_id`, `designation`, `fathers_name`, `fathers_profession`, `fathers_nid_no`, `fathers_mobile_no`, `mothers_name`, `mothers_profession`, `mothers_nid_no`, `mothers_mobile_no`, `birth_date`, `religion`, `marital_status`, `present_address`, `permanent_address`, `guaranteer_information`, `guaranteer_name`, `guaranteer_relation`, `guaranteer_nid_no`, `guaranteer_mobile_no`, `guaranteer_present_address`, `guaranteer_permanent_address`, `division_id`, `district_id`, `thana_id`, `area_id`, `password`, `passwordReset`, `photo`, `latitude`, `longitude`, `location`, `api_token`, `api_role`, `status`, `created_at`, `updated_at`, `nid_front`, `nid_back`, `birth_certificate`, `identification_type`) VALUES
(1, 'test', NULL, '01910863553', NULL, 0.00, NULL, 'public/uploads/pickupman/166315805773-738269_girl-cartoon-with-hijab.jpg', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-13', 'Islam', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, '$2y$10$dOEXwRu32LuCiskupCYTRe1Gh5LD0sTKyCGA8hLLFjA8F011p9s1i', NULL, NULL, NULL, NULL, NULL, 'EZ5Uf0IUQISGYNBwwIkS6Von8gopfXWqvQNOkDeZdJlOd1ESg8', 3, 1, '2022-09-14 12:20:57', '2022-09-14 12:20:57', 'public/uploads/pickupman/TrxJrQKASiPLq4y2KpILlxiQtkLkDcHCodPEXqb2NUeun95IvA89898-20220723220929.jpg', 'public/uploads/pickupman/2cl57a3a1T6r4cZ0ZeFpNse0Az5cMJSbmWvjatUb9sCiwAgWty292099004_113158718115411_4957683551501638313_n.jpg', NULL, 1),
(2, 'test', NULL, '52135641351', NULL, 0.00, NULL, 'public/uploads/pickupman/1668251045lungi.jpg', 2, 'Cutter', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'Married', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 79, NULL, '$2y$10$QNUo.46Ydf0.N9xu1XRbVuARarc73tunkkXmrvkfTtv8oMPGlwZZi', NULL, NULL, NULL, NULL, NULL, 'K7hTLIBbit1IkjBOSv2TegCj4fwAYZZQyePdM2D1RyE8HMlYP8', 3, 1, '2022-11-13 00:04:05', '2022-11-13 00:04:05', 'public/uploads/pickupman/gDZcZJ9UgIBUe40pljIYTzHj5YfpF5PkmlvEVitfSTZYONcbsQpanjabi.png', 'public/uploads/pickupman/v008MFUryUMm4iPeM62VDmcbVksqJwMhC3GP7QazfVI4M9n68Mpanjabi.png', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pickups`
--

CREATE TABLE `pickups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pickuptype` tinyint(4) NOT NULL,
  `date` date NOT NULL,
  `pickupAddress` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchantId` int(11) NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimedparcel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `agent` int(11) DEFAULT NULL,
  `deliveryman` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pricetype_id` int(11) NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_bn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `pricetype_id`, `price`, `name`, `name_bn`, `price_bn`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '60', 'Dhaka City', 'Dhaka City', '60', 0, '2022-04-07 03:56:41', '2022-04-25 17:59:40'),
(3, 2, '100', 'Suburb', 'Out Side Dhaka', '100', 0, '2022-04-07 03:58:10', '2022-04-25 18:00:07'),
(4, 2, '100', 'Narayangonj', 'Narayangonj', '100', 0, '2022-04-07 03:58:40', '2022-04-25 18:00:17'),
(5, 2, '100', 'Gazipur', 'Gazipur', '100', 0, '2022-04-09 17:57:51', '2022-04-25 18:00:23'),
(6, 2, '100', 'Savar', 'Savar', '100', 0, '2022-04-09 17:59:02', '2022-04-25 18:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `pricetypes`
--

CREATE TABLE `pricetypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pricetypeName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pricetypeName_bn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pricetypes`
--

INSERT INTO `pricetypes` (`id`, `pricetypeName`, `pricetypeName_bn`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Inside City', 'ঢাকার ভিতরে', 1, '2021-06-09 05:51:46', '2021-06-09 05:51:46'),
(2, 'City Suburb', ' নগরী শহরতলির', 1, '2021-06-09 05:51:46', '2021-06-09 05:51:46'),
(3, 'Outside City', 'ঢাকার বাইরে', 1, '2021-06-09 05:53:56', '2021-06-09 05:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `product_services`
--

CREATE TABLE `product_services` (
  `id` bigint(11) NOT NULL,
  `laundry_product_id` int(11) NOT NULL,
  `laundry_service_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_services`
--

INSERT INTO `product_services` (`id`, `laundry_product_id`, `laundry_service_id`, `amount`, `created_at`, `updated_at`) VALUES
(9, 3, 3, 120, '2022-09-14 18:51:16', '2022-09-14 18:51:16'),
(10, 3, 2, 110, '2022-09-14 18:51:16', '2022-09-14 18:51:16'),
(11, 3, 1, 100, '2022-09-14 18:51:16', '2022-09-14 18:51:16'),
(14, 4, 1, 20, '2022-09-26 13:46:49', '2022-09-26 13:46:49'),
(15, 4, 2, 60, '2022-09-26 13:46:49', '2022-09-26 13:46:49'),
(16, 4, 3, 100, '2022-09-26 13:46:49', '2022-09-26 13:46:49'),
(17, 2, 3, 400, '2022-09-26 13:49:28', '2022-09-26 13:49:28'),
(18, 2, 2, 200, '2022-09-26 13:49:28', '2022-09-26 13:49:28'),
(19, 1, 3, 50, '2022-09-26 13:51:57', '2022-09-26 13:51:57'),
(20, 1, 2, 45, '2022-09-26 13:51:57', '2022-09-26 13:51:57'),
(21, 1, 1, 40, '2022-09-26 13:51:57', '2022-09-26 13:51:57'),
(22, 5, 1, 25, '2022-09-26 14:36:50', '2022-09-26 14:36:50'),
(23, 5, 2, 50, '2022-09-26 14:36:50', '2022-09-26 14:36:50'),
(24, 5, 3, 80, '2022-09-26 14:36:50', '2022-09-26 14:36:50'),
(25, 6, 2, 80, '2022-09-26 14:43:03', '2022-09-26 14:43:03'),
(26, 6, 3, 150, '2022-09-26 14:43:03', '2022-09-26 14:43:03'),
(27, 7, 2, 20, '2022-09-26 14:45:08', '2022-09-26 14:45:08'),
(28, 7, 3, 45, '2022-09-26 14:45:08', '2022-09-26 14:45:08'),
(29, 8, 2, 30, '2022-09-26 14:53:39', '2022-09-26 14:53:39'),
(30, 8, 3, 80, '2022-09-26 14:53:39', '2022-09-26 14:53:39'),
(31, 9, 2, 50, '2022-09-26 14:56:23', '2022-09-26 14:56:23'),
(32, 9, 3, 100, '2022-09-26 14:56:23', '2022-09-26 14:56:23'),
(33, 10, 2, 80, '2022-09-26 14:58:33', '2022-09-26 14:58:33'),
(34, 10, 3, 130, '2022-09-26 14:58:33', '2022-09-26 14:58:33'),
(35, 11, 1, 25, '2022-09-26 15:08:18', '2022-09-26 15:08:18'),
(36, 11, 2, 50, '2022-09-26 15:08:18', '2022-09-26 15:08:18'),
(37, 11, 3, 75, '2022-09-26 15:08:18', '2022-09-26 15:08:18'),
(38, 12, 1, 25, '2022-09-26 15:09:47', '2022-09-26 15:09:47'),
(39, 12, 2, 60, '2022-09-26 15:09:47', '2022-09-26 15:09:47'),
(40, 12, 3, 120, '2022-09-26 15:09:47', '2022-09-26 15:09:47'),
(41, 13, 2, 80, '2022-09-26 17:55:41', '2022-09-26 17:55:41'),
(42, 14, 2, 50, '2022-09-26 17:57:56', '2022-09-26 17:57:56'),
(43, 14, 3, 100, '2022-09-26 17:57:56', '2022-09-26 17:57:56'),
(44, 15, 1, 10, '2022-09-26 18:00:40', '2022-09-26 18:00:40'),
(45, 15, 2, 35, '2022-09-26 18:00:40', '2022-09-26 18:00:40'),
(46, 15, 3, 60, '2022-09-26 18:00:40', '2022-09-26 18:00:40'),
(47, 16, 1, 10, '2022-09-26 18:01:51', '2022-09-26 18:01:51'),
(48, 16, 2, 35, '2022-09-26 18:01:51', '2022-09-26 18:01:51'),
(49, 16, 3, 60, '2022-09-26 18:01:51', '2022-09-26 18:01:51'),
(50, 17, 1, 10, '2022-09-26 18:03:12', '2022-09-26 18:03:12'),
(51, 17, 2, 35, '2022-09-26 18:03:12', '2022-09-26 18:03:12'),
(52, 17, 3, 60, '2022-09-26 18:03:12', '2022-09-26 18:03:12'),
(53, 18, 3, 60, '2022-09-26 18:04:44', '2022-09-26 18:04:44'),
(54, 18, 2, 35, '2022-09-26 18:04:44', '2022-09-26 18:04:44'),
(55, 18, 1, 10, '2022-09-26 18:04:44', '2022-09-26 18:04:44'),
(56, 19, 3, 150, '2022-09-26 18:08:48', '2022-09-26 18:08:48'),
(57, 19, 2, 100, '2022-09-26 18:08:48', '2022-09-26 18:08:48'),
(58, 19, 1, 30, '2022-09-26 18:08:48', '2022-09-26 18:08:48'),
(59, 20, 3, 120, '2022-09-26 18:10:03', '2022-09-26 18:10:03'),
(60, 20, 2, 90, '2022-09-26 18:10:03', '2022-09-26 18:10:03'),
(61, 20, 2, 30, '2022-09-26 18:10:03', '2022-09-26 18:10:03'),
(62, 21, 3, 150, '2022-09-26 18:26:12', '2022-09-26 18:26:12'),
(63, 21, 1, 50, '2022-09-26 18:26:12', '2022-09-26 18:26:12'),
(64, 22, 2, 40, '2022-09-26 18:27:13', '2022-09-26 18:27:13'),
(65, 22, 1, 10, '2022-09-26 18:27:13', '2022-09-26 18:27:13'),
(68, 23, 2, 40, '2022-09-26 18:28:12', '2022-09-26 18:28:12'),
(69, 23, 1, 10, '2022-09-26 18:28:12', '2022-09-26 18:28:12'),
(70, 24, 1, 80, '2022-09-26 18:30:08', '2022-09-26 18:30:08'),
(71, 24, 3, 350, '2022-09-26 18:30:08', '2022-09-26 18:30:08'),
(72, 25, 1, 30, '2022-09-26 18:33:18', '2022-09-26 18:33:18'),
(73, 25, 2, 100, '2022-09-26 18:33:18', '2022-09-26 18:33:18'),
(74, 25, 3, 130, '2022-09-26 18:33:18', '2022-09-26 18:33:18'),
(75, 26, 1, 10, '2022-09-26 18:35:12', '2022-09-26 18:35:12'),
(76, 26, 3, 80, '2022-09-26 18:35:12', '2022-09-26 18:35:12'),
(77, 27, 3, 140, '2022-09-26 18:36:27', '2022-09-26 18:36:27'),
(78, 28, 1, 10, '2022-09-29 13:17:50', '2022-09-29 13:17:50'),
(79, 28, 2, 35, '2022-09-29 13:17:50', '2022-09-29 13:17:50'),
(80, 28, 3, 60, '2022-09-29 13:17:50', '2022-09-29 13:17:50'),
(81, 29, 1, 10, '2022-09-29 13:19:16', '2022-09-29 13:19:16'),
(82, 29, 2, 35, '2022-09-29 13:19:16', '2022-09-29 13:19:16'),
(83, 29, 3, 90, '2022-09-29 13:19:16', '2022-09-29 13:19:16'),
(84, 30, 1, 10, '2022-09-29 13:21:00', '2022-09-29 13:21:00'),
(85, 30, 2, 35, '2022-09-29 13:21:00', '2022-09-29 13:21:00'),
(86, 30, 3, 70, '2022-09-29 13:21:00', '2022-09-29 13:21:00'),
(87, 31, 1, 10, '2022-09-29 13:22:21', '2022-09-29 13:22:21'),
(88, 31, 2, 35, '2022-09-29 13:22:21', '2022-09-29 13:22:21'),
(89, 31, 3, 60, '2022-09-29 13:22:21', '2022-09-29 13:22:21'),
(90, 32, 1, 60, '2022-09-29 13:24:30', '2022-09-29 13:24:30'),
(91, 32, 3, 250, '2022-09-29 13:24:30', '2022-09-29 13:24:30'),
(92, 33, 1, 70, '2022-09-29 13:25:37', '2022-09-29 13:25:37'),
(93, 33, 3, 200, '2022-09-29 13:25:37', '2022-09-29 13:25:37'),
(94, 34, 1, 60, '2022-09-29 13:26:43', '2022-09-29 13:26:43'),
(95, 34, 3, 180, '2022-09-29 13:26:43', '2022-09-29 13:26:43'),
(96, 35, 1, 60, '2022-09-29 13:26:43', '2022-09-29 13:26:43'),
(97, 35, 3, 180, '2022-09-29 13:26:43', '2022-09-29 13:26:43'),
(98, 36, 1, 20, '2022-09-29 13:28:14', '2022-09-29 13:28:14'),
(99, 36, 3, 60, '2022-09-29 13:28:14', '2022-09-29 13:28:14'),
(100, 37, 1, 20, '2022-09-29 13:29:09', '2022-09-29 13:29:09'),
(101, 37, 3, 120, '2022-09-29 13:29:09', '2022-09-29 13:29:09'),
(102, 38, 1, 10, '2022-09-29 13:30:42', '2022-09-29 13:30:42'),
(103, 38, 2, 35, '2022-09-29 13:30:43', '2022-09-29 13:30:43'),
(104, 38, 3, 60, '2022-09-29 13:30:43', '2022-09-29 13:30:43'),
(105, 39, 1, 10, '2022-09-29 13:32:34', '2022-09-29 13:32:34'),
(106, 39, 2, 35, '2022-09-29 13:32:34', '2022-09-29 13:32:34'),
(107, 39, 3, 60, '2022-09-29 13:32:34', '2022-09-29 13:32:34'),
(108, 40, 3, 10, '2022-10-29 13:39:36', '2022-10-29 13:39:36'),
(109, 40, 2, 15, '2022-10-29 13:39:36', '2022-10-29 13:39:36'),
(110, 40, 1, 8, '2022-10-29 13:39:36', '2022-10-29 13:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `promotional_discounts`
--

CREATE TABLE `promotional_discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `discount` double(20,2) DEFAULT '0.00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promotional_discounts`
--

INSERT INTO `promotional_discounts` (`id`, `start_date`, `end_date`, `discount`, `status`, `created_at`, `updated_at`) VALUES
(1, '2022-05-25', '2022-06-30', 20.00, 1, '2022-05-26 06:22:54', '2022-05-30 01:15:17');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `invoice_no` varchar(191) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `purchase_date` varchar(30) NOT NULL,
  `invoice_total` double(20,2) NOT NULL,
  `discount` varchar(30) DEFAULT NULL,
  `payable` double(20,2) NOT NULL,
  `paid` double(20,2) NOT NULL DEFAULT '0.00',
  `due` double(20,2) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1:active,0:inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `branch_id`, `invoice_no`, `supplier_id`, `purchase_date`, `invoice_total`, `discount`, `payable`, `paid`, `due`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '5349058', 1, '2022-09-14', 7500.00, NULL, 7500.00, 5000.00, 2500.00, 1, '2022-09-14 18:29:11', '2022-09-14 18:29:11'),
(2, 2, '8902602', 3, '2022-09-14', 10000.00, NULL, 10000.00, 5000.00, 5000.00, 1, '2022-09-14 19:10:54', '2022-09-14 19:10:54'),
(3, 2, '3713959', 1, '2022-09-25', 5000.00, NULL, 5000.00, 4000.00, 1000.00, 1, '2022-09-25 15:37:48', '2022-09-25 15:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(191) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `buy_price` double(20,2) NOT NULL,
  `sale_price` double(20,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` double(20,2) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1:active,0:inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`id`, `invoice_no`, `purchase_id`, `item_id`, `unit_id`, `buy_price`, `sale_price`, `quantity`, `subtotal`, `status`, `created_at`, `updated_at`) VALUES
(1, '5349058', 1, 1, 1, 75.00, 80.00, 100, 7500.00, 1, '2022-09-14 18:29:11', '2022-09-14 18:29:11'),
(2, '8902602', 2, 2, 1, 100.00, 120.00, 100, 10000.00, 1, '2022-09-14 19:10:54', '2022-09-14 19:10:54'),
(3, '3713959', 3, 1, 1, 50.00, 80.00, 100, 5000.00, 1, '2022-09-25 15:37:48', '2022-09-25 15:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super admin', 'web', '2022-07-03 06:20:23', '2022-07-03 06:20:23'),
(2, 'Admin', 'web', '2022-07-03 06:20:23', '2022-07-03 06:20:23'),
(3, 'Editor', 'web', '2022-07-03 06:20:23', '2022-07-03 06:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `year` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(20,2) DEFAULT NULL COMMENT '(Gross Salary + Commission) - (Paid Commision + Advance)',
  `bonus` double(20,2) DEFAULT NULL,
  `fine` double(20,2) DEFAULT NULL,
  `remain_commission` double(20,2) DEFAULT NULL COMMENT 'Monthly Remaining Commission',
  `pay_date` date DEFAULT NULL,
  `payment_via` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origin` tinyint(4) DEFAULT NULL COMMENT '1:laundry,2:salon,3:pos',
  `status` tinyint(4) DEFAULT NULL COMMENT '1=Paid, 0=Pending',
  `invoice_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `employee_id`, `year`, `month`, `amount`, `bonus`, `fine`, `remain_commission`, `pay_date`, `payment_via`, `origin`, `status`, `invoice_no`, `created_at`, `updated_at`) VALUES
(10, 1, '2022', 'October', 568.00, NULL, NULL, 568.00, '2022-11-09', 'Mobile Banking', 2, 1, '00001', '2022-11-08 06:36:12', '2022-11-08 07:38:55'),
(11, 2, '2022', 'October', 20.00, NULL, NULL, 20.00, '2022-11-09', 'Mobile Banking', 2, 1, '00001', '2022-11-08 06:36:12', '2022-11-08 07:38:56'),
(12, 2, '2022', 'November', -10.00, NULL, NULL, -10.00, NULL, NULL, 2, 0, '00003', '2022-11-08 06:37:44', '2022-11-08 06:37:44'),
(13, 1, '2022', 'November', -168.00, NULL, NULL, -168.00, '2022-11-08', 'Cash', 2, 1, '00002', '2022-11-08 06:38:26', '2022-11-08 07:36:07');

-- --------------------------------------------------------

--
-- Table structure for table `salon_bookings`
--

CREATE TABLE `salon_bookings` (
  `id` bigint(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_address_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL DEFAULT '1' COMMENT 'ki kajer jani na',
  `status` tinyint(4) NOT NULL,
  `paid_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1:paid,0:unpaid',
  `payment_method` tinyint(4) DEFAULT NULL COMMENT '1=Cash, 2=Card, 3=bkash, 4=nagad, 5=rocket',
  `origin` varchar(50) NOT NULL DEFAULT 'Online' COMMENT 'Online,Offline',
  `invoice_no` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon_bookings`
--

INSERT INTO `salon_bookings` (`id`, `customer_id`, `customer_address_id`, `branch_id`, `payment_method_id`, `status`, `paid_status`, `payment_method`, `origin`, `invoice_no`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 1, 12, 0, NULL, 'Offline', NULL, '2022-09-14 17:21:55', '2022-11-12 13:56:26'),
(2, 2, 2, 1, 1, 12, 0, NULL, 'Online', NULL, '2022-09-14 12:00:06', '2022-09-14 18:00:46'),
(3, 1, 1, 2, 1, 11, 0, NULL, 'Offline', NULL, '2022-09-14 19:59:30', '2022-09-14 20:00:01'),
(4, 4, 4, 1, 1, 12, 0, NULL, 'Online', NULL, '2022-09-14 14:15:18', '2022-10-09 15:30:13'),
(5, 4, 4, 2, 1, 11, 0, NULL, 'Offline', NULL, '2022-09-21 18:09:32', '2022-10-25 16:27:19'),
(6, 0, 0, 1, 1, 12, 0, NULL, 'Quick', NULL, '2022-09-24 15:43:46', '2022-09-24 15:43:57'),
(7, 0, 0, 2, 1, 12, 0, NULL, 'Quick', NULL, '2022-09-25 11:51:45', '2022-09-25 11:55:34'),
(8, 0, 0, 2, 1, 12, 1, NULL, 'Quick', NULL, '2022-09-30 18:57:27', '2022-09-30 19:00:38'),
(9, 0, 0, 2, 1, 12, 1, NULL, 'Quick', NULL, '2022-10-03 19:25:50', '2022-10-03 19:26:11'),
(10, 3, 0, 2, 1, 12, 1, NULL, 'Quick', NULL, '2022-10-03 20:07:58', '2022-10-03 20:08:33'),
(11, 1, 0, 2, 1, 12, 1, NULL, 'Quick', NULL, '2022-10-03 21:06:31', '2022-10-03 21:06:58'),
(12, 0, 0, 2, 1, 12, 1, NULL, 'Quick', NULL, '2022-10-05 11:37:30', '2022-10-05 11:37:40'),
(13, 1, 0, 2, 1, 12, 1, NULL, 'Quick', NULL, '2022-10-06 11:50:58', '2022-10-06 11:51:11'),
(14, 1, 0, 1, 1, 12, 1, NULL, 'Quick', NULL, '2022-10-06 12:13:37', '2022-10-06 12:14:05'),
(15, 0, 0, 1, 1, 12, 1, NULL, 'Quick', NULL, '2022-10-06 16:09:50', '2022-10-06 16:10:02'),
(16, 0, 0, 2, 1, 12, 1, NULL, 'Quick', NULL, '2022-10-06 18:12:41', '2022-10-06 18:13:09'),
(17, 0, 0, 2, 1, 12, 1, NULL, 'Quick', NULL, '2022-10-06 18:21:39', '2022-10-06 18:22:03'),
(18, 0, 0, 2, 1, 1, 1, NULL, 'Quick', NULL, '2022-10-09 15:22:11', '2022-10-09 15:22:35'),
(19, 1, 0, 1, 1, 11, 1, 1, 'Quick', NULL, '2022-10-22 12:22:38', '2022-10-22 12:22:38'),
(20, 1, 1, 2, 1, 12, 0, NULL, 'Offline', NULL, '2022-10-25 13:28:43', '2022-10-25 13:30:12'),
(21, 0, 0, 2, 1, 12, 1, 1, 'Quick', NULL, '2022-10-26 12:02:52', '2022-10-26 12:03:33'),
(22, 0, 0, 2, 1, 9, 1, 1, 'Quick', '00022', '2022-10-26 12:23:59', '2022-10-26 12:28:25'),
(23, 0, 0, 2, 1, 9, 1, 1, 'Quick', '00023', '2022-10-26 12:28:52', '2022-10-26 12:29:09'),
(24, 0, 0, 2, 1, 12, 1, 1, 'Quick', '00024', '2022-10-26 12:29:25', '2022-10-26 12:29:38'),
(25, 3, 3, 1, 1, 12, 0, NULL, 'Offline', NULL, '2022-11-09 15:24:01', '2022-11-09 15:27:21'),
(26, 2, 2, 2, 1, 12, 0, NULL, 'Offline', NULL, '2022-11-09 15:26:25', '2022-11-09 15:28:12'),
(27, 0, 0, 2, 1, 12, 1, 1, 'Quick', '00027', '2022-11-11 18:38:24', '2022-11-12 14:27:49'),
(28, 1, 0, 2, 1, 11, 1, 1, 'Quick', '00028', '2022-11-12 11:28:16', '2022-11-12 11:28:16'),
(29, 1, 0, 1, 1, 11, 1, 1, 'Quick', '00029', '2022-11-12 11:33:32', '2022-11-12 11:33:32'),
(30, 2, 2, 1, 1, 10, 0, NULL, 'Online', NULL, '2022-11-12 07:49:45', '2022-11-12 14:02:48'),
(31, 0, 0, 2, 1, 12, 1, 1, 'Quick', '00031', '2022-11-12 14:25:00', '2022-11-12 14:25:23'),
(32, 1, 0, 2, 1, 11, 1, 1, 'Quick', '00032', '2022-11-12 14:58:37', '2022-11-12 14:58:37'),
(33, 1, 0, 2, 1, 11, 1, 1, 'Quick', '00033', '2022-11-12 15:00:49', '2022-11-12 15:00:49'),
(34, 3, 0, 2, 1, 9, 1, 1, 'Quick', '00034', '2022-11-12 18:14:34', '2022-11-12 18:17:47'),
(35, 8, 0, 2, 1, 11, 1, 1, 'Quick', '00035', '2022-11-12 18:19:42', '2022-11-12 18:19:42'),
(36, 0, 0, 2, 1, 12, 1, 1, 'Quick', '00036', '2022-11-13 11:35:43', '2022-11-13 11:36:13'),
(37, 11, 0, 2, 1, 12, 1, 1, 'Quick', '00037', '2022-11-13 11:52:43', '2022-11-13 11:53:56'),
(38, 12, 0, 2, 1, 12, 1, 1, 'Quick', '00038', '2022-11-13 12:08:24', '2022-11-13 12:08:48'),
(39, 0, 0, 1, 1, 12, 1, 1, 'Quick', '00039', '2022-11-13 12:14:21', '2022-11-13 12:14:57'),
(40, 0, 0, 1, 1, 11, 1, 1, 'Quick', '00040', '2022-11-13 12:16:14', '2022-11-13 12:16:14'),
(41, 0, 0, 1, 1, 12, 1, 1, 'Quick', '00040', '2022-11-13 12:16:17', '2022-11-13 12:16:51'),
(42, 12, 0, 1, 1, 12, 1, 1, 'Quick', '00042', '2022-11-13 13:50:29', '2022-11-13 13:51:19'),
(43, 12, 0, 1, 1, 11, 1, 1, 'Quick', '00043', '2022-11-13 14:23:15', '2022-11-13 14:23:15'),
(44, 12, 0, 1, 1, 12, 1, 1, 'Quick', '00044', '2022-11-13 15:28:23', '2022-11-13 15:29:11'),
(45, 12, 0, 2, 1, 12, 1, 1, 'Quick', '00045', '2022-11-13 16:24:10', '2022-11-13 16:24:27'),
(46, 11, 0, 2, 1, 12, 1, 1, 'Quick', '00046', '2022-11-13 19:09:30', '2022-11-13 19:09:46'),
(47, 11, 0, 2, 1, 12, 1, 1, 'Quick', '00047', '2022-11-13 19:11:19', '2022-11-13 19:11:32'),
(48, 11, 0, 2, 1, 12, 1, 1, 'Quick', '00048', '2022-11-13 19:13:51', '2022-11-13 19:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `salon_booking_items`
--

CREATE TABLE `salon_booking_items` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `service_id` int(11) NOT NULL,
  `space` int(11) NOT NULL,
  `space_amount` int(11) NOT NULL,
  `discount` float(20,2) NOT NULL,
  `time_schedule` varchar(191) NOT NULL,
  `total` double(20,2) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon_booking_items`
--

INSERT INTO `salon_booking_items` (`id`, `booking_id`, `category_id`, `customer_id`, `booking_date`, `service_id`, `space`, `space_amount`, `discount`, `time_schedule`, `total`, `employee_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2022-09-14', 1, 1, 150, 0.00, '10:00 am-11:00 am', 150.00, 1, '2022-09-14 17:21:55', '2022-09-14 17:21:55'),
(2, 2, 1, 2, '2022-09-15', 1, 1, 150, 0.00, '10:00:00-11:00:00', 150.00, 1, '2022-09-14 12:00:06', '2022-09-14 12:00:06'),
(3, 3, 1, 1, '2022-09-14', 1, 1, 150, 0.00, '02:00 pm-03:00 pm', 150.00, 2, '2022-09-14 19:59:30', '2022-09-14 19:59:30'),
(4, 4, 1, 4, '2022-09-14', 1, 1, 150, 0.00, '11:00:00-12:00:00', 150.00, 2, '2022-09-14 14:15:18', '2022-09-14 14:15:18'),
(5, 5, 1, 4, '2022-09-22', 1, 1, 150, 0.00, '11:00 am-12:00 pm', 150.00, 1, '2022-09-21 18:09:33', '2022-09-21 18:09:33'),
(6, 6, 1, 0, '2022-09-25', 2, 1, 200, 0.00, '0', 200.00, 1, '2022-09-24 15:43:46', '2022-09-24 15:43:46'),
(7, 6, 1, 0, '2022-09-25', 1, 1, 150, 0.00, '0', 150.00, 1, '2022-09-24 15:43:46', '2022-09-24 15:43:46'),
(8, 7, 1, 0, '2022-09-25', 2, 1, 200, 0.00, '0', 200.00, 1, '2022-09-25 11:51:45', '2022-09-25 11:51:45'),
(9, 7, 1, 0, '2022-09-25', 1, 1, 150, 0.00, '0', 150.00, 1, '2022-09-25 11:51:45', '2022-09-25 11:51:45'),
(10, 8, 7, 0, '2022-09-30', 66, 1, 200, 0.00, '0', 200.00, 2, '2022-09-30 18:57:27', '2022-09-30 18:57:27'),
(11, 8, 1, 0, '2022-09-30', 4, 1, 220, 0.00, '0', 220.00, 2, '2022-09-30 18:57:27', '2022-09-30 18:57:27'),
(12, 8, 1, 0, '2022-09-30', 6, 1, 100, 0.00, '0', 100.00, 2, '2022-09-30 18:57:27', '2022-09-30 18:57:27'),
(13, 8, 7, 0, '2022-09-30', 68, 1, 300, 0.00, '0', 300.00, 2, '2022-09-30 18:57:27', '2022-09-30 18:57:27'),
(14, 9, 7, 0, '2022-10-04', 68, 1, 300, 0.00, '0', 300.00, 1, '2022-10-03 19:25:50', '2022-10-03 19:25:50'),
(15, 10, 7, 3, '2022-10-03', 68, 1, 300, 0.00, '0', 300.00, 2, '2022-10-03 20:07:58', '2022-10-03 20:07:58'),
(16, 11, 7, 1, '2022-10-03', 68, 1, 300, 0.00, '0', 300.00, 1, '2022-10-03 21:06:32', '2022-10-03 21:06:32'),
(17, 12, 7, 0, '2022-10-05', 68, 1, 300, 0.00, '0', 300.00, 2, '2022-10-05 11:37:30', '2022-10-05 11:37:30'),
(18, 12, 7, 0, '2022-10-05', 65, 1, 700, 0.00, '0', 700.00, 2, '2022-10-05 11:37:30', '2022-10-05 11:37:30'),
(19, 13, 7, 1, '2022-10-06', 66, 1, 200, 0.00, '0', 200.00, 1, '2022-10-06 11:50:58', '2022-10-06 11:50:58'),
(20, 14, 7, 1, '2022-10-06', 68, 1, 300, 0.00, '0', 300.00, 1, '2022-10-06 12:13:37', '2022-10-06 12:13:37'),
(21, 15, 7, 0, '2022-10-06', 68, 1, 300, 0.00, '0', 300.00, 1, '2022-10-06 16:09:50', '2022-10-06 16:09:50'),
(22, 16, 7, 0, '2022-10-06', 66, 1, 200, 0.00, '0', 200.00, 2, '2022-10-06 18:12:41', '2022-10-06 18:12:41'),
(23, 17, 7, 0, '2022-10-06', 64, 1, 300, 0.00, '0', 300.00, 2, '2022-10-06 18:21:39', '2022-10-06 18:21:39'),
(24, 18, 1, 0, '2022-10-09', 6, 1, 100, 0.00, '0', 100.00, 1, '2022-10-09 15:22:11', '2022-10-09 15:22:11'),
(25, 18, 1, 0, '2022-10-09', 4, 1, 220, 0.00, '0', 220.00, 1, '2022-10-09 15:22:11', '2022-10-09 15:22:11'),
(26, 18, 2, 0, '2022-10-09', 16, 1, 1000, 0.00, '0', 1000.00, 1, '2022-10-09 15:22:11', '2022-10-09 15:22:11'),
(27, 18, 2, 0, '2022-10-09', 19, 1, 1200, 0.00, '0', 1200.00, 1, '2022-10-09 15:22:11', '2022-10-09 15:22:11'),
(28, 19, 1, 1, '2022-10-22', 69, 1, 160, 0.00, '0', 160.00, 1, '2022-10-22 12:22:38', '2022-10-22 12:22:38'),
(29, 19, 7, 1, '2022-10-22', 68, 1, 300, 0.00, '0', 300.00, 1, '2022-10-22 12:22:39', '2022-10-22 12:22:39'),
(30, 20, 1, 1, '2022-10-25', 1, 1, 150, 0.00, '05:00 pm-06:00 pm', 150.00, 1, '2022-10-25 13:28:44', '2022-10-25 13:28:44'),
(31, 20, 1, 1, '2022-10-25', 1, 1, 150, 0.00, '05:00 pm-06:00 pm', 150.00, 2, '2022-10-25 13:28:44', '2022-10-25 13:28:44'),
(32, 21, 7, 0, '2022-10-26', 66, 1, 200, 0.00, '0', 200.00, 1, '2022-10-26 12:02:52', '2022-10-26 12:02:52'),
(33, 22, 7, 0, '2022-10-26', 63, 1, 450, 0.00, '0', 450.00, 3, '2022-10-26 12:23:59', '2022-10-26 12:23:59'),
(34, 23, 7, 0, '2022-10-26', 63, 1, 450, 0.00, '0', 450.00, 4, '2022-10-26 12:28:52', '2022-10-26 12:28:52'),
(35, 24, 7, 0, '2022-10-26', 63, 1, 450, 0.00, '0', 450.00, 1, '2022-10-26 12:29:25', '2022-10-26 12:29:25'),
(36, 25, 1, 3, '2022-11-09', 1, 1, 150, 0.00, '04:00 pm-05:00 pm', 150.00, 1, '2022-11-09 15:24:01', '2022-11-09 15:24:01'),
(37, 26, 1, 2, '2022-11-09', 2, 1, 200, 0.00, '10:43 pm-11:43 pm', 200.00, 2, '2022-11-09 15:26:25', '2022-11-09 15:26:25'),
(38, 27, 7, 0, '2022-11-11', 67, 1, 100, 0.00, '0', 100.00, 1, '2022-11-11 18:38:25', '2022-11-11 18:38:25'),
(39, 27, 7, 0, '2022-11-11', 65, 1, 700, 0.00, '0', 700.00, 1, '2022-11-11 18:38:25', '2022-11-11 18:38:25'),
(40, 27, 7, 0, '2022-11-11', 60, 1, 200, 0.00, '0', 200.00, 1, '2022-11-11 18:38:25', '2022-11-11 18:38:25'),
(41, 28, 1, 1, '2022-11-12', 69, 1, 160, 0.00, '0', 160.00, 1, '2022-11-12 11:28:16', '2022-11-12 11:28:16'),
(42, 29, 1, 1, '2022-11-12', 69, 1, 160, 0.00, '0', 160.00, 1, '2022-11-12 11:33:32', '2022-11-12 11:33:32'),
(43, 29, 7, 1, '2022-11-12', 68, 1, 300, 0.00, '0', 300.00, 1, '2022-11-12 11:33:32', '2022-11-12 11:33:32'),
(44, 30, 1, 2, '2022-11-12', 3, 1, 150, 0.00, '13:00:00-13:30:00', 150.00, 2, '2022-11-12 07:49:45', '2022-11-12 07:49:45'),
(45, 30, 1, 2, '2022-11-12', 6, 1, 100, 0.00, '13:30:00-14:00:00', 100.00, 2, '2022-11-12 07:49:45', '2022-11-12 07:49:45'),
(46, 31, 7, 0, '2022-11-12', 66, 1, 200, 0.00, '0', 200.00, 2, '2022-11-12 14:25:00', '2022-11-12 14:25:00'),
(47, 31, 7, 0, '2022-11-12', 61, 1, 500, 0.00, '0', 500.00, 2, '2022-11-12 14:25:00', '2022-11-12 14:25:00'),
(48, 31, 7, 0, '2022-11-12', 60, 1, 200, 0.00, '0', 200.00, 2, '2022-11-12 14:25:00', '2022-11-12 14:25:00'),
(49, 31, 2, 0, '2022-11-12', 12, 1, 200, 0.00, '0', 200.00, 2, '2022-11-12 14:25:00', '2022-11-12 14:25:00'),
(50, 32, 1, 1, '2022-11-12', 1, 1, 150, 0.00, '0', 150.00, 1, '2022-11-12 14:58:37', '2022-11-12 14:58:37'),
(51, 32, 1, 1, '2022-11-12', 2, 1, 200, 0.00, '0', 200.00, 1, '2022-11-12 14:58:37', '2022-11-12 14:58:37'),
(52, 33, 1, 1, '2022-11-12', 2, 1, 200, 0.00, '0', 200.00, 1, '2022-11-12 15:00:49', '2022-11-12 15:00:49'),
(53, 34, 1, 3, '2022-11-12', 1, 1, 150, 0.00, '0', 150.00, 1, '2022-11-12 18:14:34', '2022-11-12 18:14:34'),
(54, 34, 1, 3, '2022-11-12', 2, 1, 200, 0.00, '0', 200.00, 1, '2022-11-12 18:14:34', '2022-11-12 18:14:34'),
(55, 35, 1, 8, '2022-11-12', 3, 1, 150, 0.00, '0', 150.00, 2, '2022-11-12 18:19:42', '2022-11-12 18:19:42'),
(56, 36, 1, 0, '2022-11-13', 6, 1, 100, 0.00, '0', 100.00, 1, '2022-11-13 11:35:43', '2022-11-13 11:35:43'),
(57, 36, 1, 0, '2022-11-13', 2, 1, 200, 0.00, '0', 200.00, 1, '2022-11-13 11:35:43', '2022-11-13 11:35:43'),
(58, 36, 3, 0, '2022-11-13', 25, 1, 2300, 0.00, '0', 2300.00, 1, '2022-11-13 11:35:43', '2022-11-13 11:35:43'),
(59, 37, 1, 11, '2022-11-13', 3, 1, 150, 0.00, '0', 150.00, 2, '2022-11-13 11:52:43', '2022-11-13 11:52:43'),
(60, 37, 2, 11, '2022-11-13', 12, 1, 200, 0.00, '0', 200.00, 2, '2022-11-13 11:52:43', '2022-11-13 11:52:43'),
(61, 38, 1, 12, '2022-11-13', 1, 1, 150, 0.00, '0', 150.00, 1, '2022-11-13 12:08:24', '2022-11-13 12:08:24'),
(62, 38, 1, 12, '2022-11-13', 2, 1, 200, 0.00, '0', 200.00, 1, '2022-11-13 12:08:24', '2022-11-13 12:08:24'),
(63, 38, 1, 12, '2022-11-13', 3, 1, 150, 0.00, '0', 150.00, 1, '2022-11-13 12:08:24', '2022-11-13 12:08:24'),
(64, 38, 1, 12, '2022-11-13', 4, 1, 220, 0.00, '0', 220.00, 1, '2022-11-13 12:08:24', '2022-11-13 12:08:24'),
(65, 39, 7, 0, '2022-11-13', 67, 1, 100, 0.00, '0', 100.00, 1, '2022-11-13 12:14:21', '2022-11-13 12:14:21'),
(66, 39, 7, 0, '2022-11-13', 65, 1, 700, 0.00, '0', 700.00, 1, '2022-11-13 12:14:21', '2022-11-13 12:14:21'),
(67, 40, 7, 0, '2022-11-13', 66, 1, 200, 0.00, '0', 200.00, 1, '2022-11-13 12:16:14', '2022-11-13 12:16:14'),
(68, 40, 7, 0, '2022-11-13', 64, 1, 300, 0.00, '0', 300.00, 1, '2022-11-13 12:16:14', '2022-11-13 12:16:14'),
(69, 41, 7, 0, '2022-11-13', 66, 1, 200, 0.00, '0', 200.00, 1, '2022-11-13 12:16:17', '2022-11-13 12:16:17'),
(70, 41, 7, 0, '2022-11-13', 64, 1, 300, 0.00, '0', 300.00, 1, '2022-11-13 12:16:17', '2022-11-13 12:16:17'),
(71, 42, 1, 12, '2022-11-13', 1, 1, 150, 15.00, '0', 150.00, 1, '2022-11-13 13:50:29', '2022-11-13 13:50:29'),
(72, 42, 1, 12, '2022-11-13', 6, 1, 100, 10.00, '0', 100.00, 1, '2022-11-13 13:50:29', '2022-11-13 13:50:29'),
(73, 43, 7, 12, '2022-11-13', 68, 1, 300, 30.00, '0', 300.00, 1, '2022-11-13 14:23:16', '2022-11-13 14:23:16'),
(74, 43, 7, 12, '2022-11-13', 66, 1, 200, 0.00, '0', 200.00, 1, '2022-11-13 14:23:16', '2022-11-13 14:23:16'),
(75, 43, 2, 12, '2022-11-13', 16, 1, 1000, 0.00, '0', 1000.00, 1, '2022-11-13 14:23:16', '2022-11-13 14:23:16'),
(76, 43, 2, 12, '2022-11-13', 18, 1, 1500, 0.00, '0', 1500.00, 1, '2022-11-13 14:23:16', '2022-11-13 14:23:16'),
(77, 44, 7, 12, '2022-11-13', 61, 1, 500, 0.00, '0', 500.00, 1, '2022-11-13 15:28:23', '2022-11-13 15:28:23'),
(78, 44, 7, 12, '2022-11-13', 60, 1, 200, 0.00, '0', 200.00, 1, '2022-11-13 15:28:23', '2022-11-13 15:28:23'),
(79, 44, 1, 12, '2022-11-13', 1, 1, 150, 15.00, '0', 150.00, 1, '2022-11-13 15:28:23', '2022-11-13 15:28:23'),
(80, 44, 1, 12, '2022-11-13', 6, 1, 100, 10.00, '0', 100.00, 1, '2022-11-13 15:28:23', '2022-11-13 15:28:23'),
(81, 45, 1, 12, '2022-11-13', 1, 1, 150, 15.00, '0', 150.00, 1, '2022-11-13 16:24:10', '2022-11-13 16:24:10'),
(82, 46, 1, 11, '2022-11-13', 1, 1, 150, 75.00, '0', 75.00, 1, '2022-11-13 19:09:30', '2022-11-13 19:09:30'),
(83, 47, 1, 11, '2022-11-13', 1, 1, 150, 75.00, '0', 75.00, 1, '2022-11-13 19:11:19', '2022-11-13 19:11:19'),
(84, 48, 1, 11, '2022-11-13', 69, 1, 160, 0.00, '0', 160.00, 1, '2022-11-13 19:13:51', '2022-11-13 19:13:51'),
(85, 48, 7, 11, '2022-11-13', 68, 1, 300, 0.00, '0', 300.00, 1, '2022-11-13 19:13:51', '2022-11-13 19:13:51'),
(86, 48, 7, 11, '2022-11-13', 67, 1, 100, 0.00, '0', 100.00, 1, '2022-11-13 19:13:51', '2022-11-13 19:13:51'),
(87, 48, 7, 11, '2022-11-13', 66, 1, 200, 0.00, '0', 200.00, 1, '2022-11-13 19:13:51', '2022-11-13 19:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `salon_carts`
--

CREATE TABLE `salon_carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `billing_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `shipping_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Active, Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salon_carts`
--

INSERT INTO `salon_carts` (`id`, `customer_id`, `billing_id`, `shipping_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 0, 'Active', '2022-09-14 05:52:45', '2022-09-14 05:59:56'),
(2, 4, 4, 0, 'Active', '2022-09-14 08:14:54', '2022-09-14 08:15:14'),
(3, 8, 0, 0, 'Active', '2022-11-12 17:57:01', '2022-11-12 17:57:01');

-- --------------------------------------------------------

--
-- Table structure for table `salon_cart_items`
--

CREATE TABLE `salon_cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `space` int(11) NOT NULL,
  `price_per_space` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Active, Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salon_cart_items`
--

INSERT INTO `salon_cart_items` (`id`, `cart_id`, `customer_id`, `category_id`, `service_id`, `employee_id`, `booking_date`, `schedule`, `space`, `price_per_space`, `total`, `status`, `created_at`, `updated_at`) VALUES
(5, 3, 8, 1, 1, 2, '2022-11-13', '15:00:00-16:00:00', 1, 150, NULL, 'Active', '2022-11-12 17:57:01', '2022-11-12 17:57:01'),
(6, 3, 8, 1, 6, 2, '2022-11-13', '14:00:00-14:30:00', 1, 100, NULL, 'Active', '2022-11-12 17:57:17', '2022-11-12 17:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `salon_categories`
--

CREATE TABLE `salon_categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `parent_id` varchar(30) DEFAULT NULL,
  `slug` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL COMMENT 'Active,Inactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon_categories`
--

INSERT INTO `salon_categories` (`id`, `cat_name`, `parent_id`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'HAIRCUT AND SHAVE', NULL, 'haircut-and-shave', 'public/uploads/salonproduct/RSILtfpBltOfaXcrV8O6tlN3gWygvPa701xbfLovkieC0XjSvJ65dfor4pvc9QvsoenCm4PwMviFLiVxvsNu6DcMrHqCASgzNrJ7SALON.jpg', 'Active', '2022-09-14 17:14:17', '2022-10-01 19:16:56'),
(2, 'FACIAL AND SKIN TREATMENT', NULL, 'facial-and-skin-treatment', 'public/uploads/salonproduct/9uS7fK34HenJLLWi6Y2Myh6EJlRduNtqUO59W612Mg63nnUosaSALON.jpg', 'Active', '2022-09-14 17:14:41', '2022-09-25 12:27:32'),
(3, 'HIGH QUQLITY FACIAL', NULL, 'high-quqlity-facial', 'public/uploads/salonproduct/4JpnUGmuSMrzkDld9zMEDZMBYqPRTywHcEnFsuCybSsxfSBqFZSALON.jpg', 'Active', '2022-09-25 12:26:56', '2022-09-25 12:26:56'),
(4, 'HAIR COLOR', NULL, 'hair-color', 'public/uploads/salonproduct/1c7Up7Qhf7OLAzulnJDDfT9qwvXIdpJsYl3Mg9LDRRixyztOs7SALON.jpg', 'Active', '2022-09-25 12:28:27', '2022-09-25 12:28:27'),
(5, 'HAIR TREATMENT', NULL, 'hair-treatment', 'public/uploads/salonproduct/swEiN24TQb4G0m2DQOUU1PRSI29AGjORAeq9rG2HGh3jLdSjhLSALON.jpg', 'Active', '2022-09-25 12:28:53', '2022-09-25 12:28:53'),
(6, 'FAIR POLISH', NULL, 'fair-polish', 'public/uploads/salonproduct/T7OCEN4755q5O57csPc2SSavGMOPVbQMrbQEAv9OeRPfzrrZvvSALON.jpg', 'Active', '2022-09-25 12:32:45', '2022-09-25 12:32:45'),
(7, 'BODY SPA AND MASSAGE', NULL, 'body-spa-and-massage', 'public/uploads/salonproduct/qo2StQBrcLwcDJCbh7YVjjbDaHw0NUZVcKiGssG7rxQxe80neh65dfor4pvc9QvsoenCm4PwMviFLiVxvsNu6DcMrHqCASgzNrJ7SALON.jpg', 'Active', '2022-09-25 12:33:15', '2022-10-01 19:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `salon_discounts`
--

CREATE TABLE `salon_discounts` (
  `id` int(11) NOT NULL,
  `customer_type` varchar(191) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL COMMENT '1:Active,0:Inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon_discounts`
--

INSERT INTO `salon_discounts` (`id`, `customer_type`, `customer_id`, `service_id`, `discount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Regular', 1, 1, 20, 1, '2022-11-05 12:37:04', '2022-11-12 14:55:16'),
(2, 'Regular', 1, 2, 20, 1, '2022-11-05 12:37:04', '2022-11-12 14:55:16'),
(3, 'Regular', 1, 1, 20, 1, '2022-11-12 14:55:16', '2022-11-12 14:55:16'),
(4, 'Regular', 1, 2, 20, 1, '2022-11-12 14:55:16', '2022-11-12 14:55:16'),
(5, 'Regular', 8, 1, 55, 1, '2022-11-12 16:55:40', '2022-11-13 11:40:00'),
(6, 'Regular', 8, 2, 100, 1, '2022-11-12 16:55:40', '2022-11-12 18:33:29'),
(7, 'Regular', 8, 3, 20, 1, '2022-11-12 16:55:40', '2022-11-12 16:55:40'),
(8, 'Regular', 8, 6, 50, 1, '2022-11-12 16:55:40', '2022-11-13 11:38:25'),
(9, 'Regular', 3, 1, 31, 1, '2022-11-12 18:13:50', '2022-11-12 18:34:13'),
(10, 'Regular', 3, 2, 20, 1, '2022-11-12 18:13:50', '2022-11-12 18:26:20'),
(11, 'Regular', 3, 1, 20, 1, '2022-11-12 18:26:20', '2022-11-12 18:26:20'),
(12, 'Regular', 3, 2, 20, 1, '2022-11-12 18:26:20', '2022-11-12 18:26:20'),
(13, 'Regular', 3, 3, 20, 1, '2022-11-12 18:26:20', '2022-11-12 18:26:20'),
(14, 'Regular', 3, 6, 20, 1, '2022-11-12 18:26:20', '2022-11-12 18:26:20'),
(15, 'Regular', 8, 1, 50, 1, '2022-11-12 18:33:29', '2022-11-13 11:17:53'),
(16, 'Regular', 8, 2, 20, 1, '2022-11-12 18:33:29', '2022-11-13 11:06:18'),
(17, 'Regular', 3, 1, 31, 1, '2022-11-12 18:34:13', '2022-11-12 18:34:13'),
(18, 'Regular', 8, 6, 50, 1, '2022-11-13 11:38:25', '2022-11-13 11:38:25'),
(19, 'Regular', 8, 1, 55, 1, '2022-11-13 11:40:00', '2022-11-13 11:40:00'),
(20, 'Regular', 11, 2, 20, 1, '2022-11-13 11:46:19', '2022-11-13 11:46:19'),
(21, 'Regular', 11, 3, 20, 1, '2022-11-13 11:46:19', '2022-11-13 11:46:19'),
(22, 'Regular', 11, 12, 20, 1, '2022-11-13 11:46:19', '2022-11-13 11:46:19'),
(23, 'Regular', 12, 1, 10, 1, '2022-11-13 12:07:09', '2022-11-13 12:07:09'),
(24, 'Regular', 12, 2, 10, 1, '2022-11-13 12:07:09', '2022-11-13 12:07:09'),
(25, 'Regular', 12, 3, 10, 1, '2022-11-13 12:07:09', '2022-11-13 12:07:09'),
(26, 'Regular', 12, 4, 10, 1, '2022-11-13 12:07:09', '2022-11-13 12:07:09'),
(27, 'Regular', 12, 5, 10, 1, '2022-11-13 12:07:09', '2022-11-13 12:07:09'),
(28, 'Regular', 12, 6, 10, 1, '2022-11-13 12:07:09', '2022-11-13 12:07:09'),
(29, 'Regular', 12, 7, 10, 1, '2022-11-13 12:07:09', '2022-11-13 12:07:09'),
(30, 'Regular', 12, 8, 10, 1, '2022-11-13 12:07:09', '2022-11-13 12:07:09'),
(31, 'Regular', 12, 9, 10, 1, '2022-11-13 12:07:09', '2022-11-13 12:07:09'),
(32, 'Regular', 12, 10, 10, 1, '2022-11-13 12:07:09', '2022-11-13 12:07:09'),
(33, 'Regular', 12, 11, 10, 1, '2022-11-13 12:07:09', '2022-11-13 12:07:09'),
(34, 'Regular', 12, 68, 10, 1, '2022-11-13 12:07:09', '2022-11-13 12:07:09'),
(35, 'Regular', 12, 1, 10, 1, '2022-11-13 12:19:48', '2022-11-13 12:19:48'),
(36, 'Regular', 12, 15, 10, 1, '2022-11-13 14:24:27', '2022-11-13 14:24:27'),
(37, 'Regular', 11, 1, 50, 1, '2022-11-13 19:08:37', '2022-11-13 19:08:37');

-- --------------------------------------------------------

--
-- Table structure for table `salon_inventory_logs`
--

CREATE TABLE `salon_inventory_logs` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `invoice_no` varchar(50) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `buy_price` double(20,2) NOT NULL,
  `sale_price` double(20,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` double(20,2) NOT NULL,
  `origin` varchar(50) NOT NULL DEFAULT 'Salon',
  `in_out` varchar(20) NOT NULL DEFAULT 'In' COMMENT 'In,Out',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon_inventory_logs`
--

INSERT INTO `salon_inventory_logs` (`id`, `branch_id`, `invoice_no`, `item_id`, `unit_id`, `buy_price`, `sale_price`, `quantity`, `subtotal`, `origin`, `in_out`, `created_at`, `updated_at`) VALUES
(1, 2, '1105003', 1, 1, 100.00, 120.00, 100, 10000.00, 'Salon', 'In', '2022-09-14 17:10:46', '2022-09-14 17:10:46'),
(2, 2, NULL, 1, 1, 100.00, 120.00, 1, 100.00, 'Salon', 'Out', '2022-09-14 17:22:16', '2022-09-14 17:22:16'),
(3, 2, NULL, 1, 1, 100.00, 120.00, 1, 100.00, 'Salon', 'Out', '2022-09-14 18:00:46', '2022-09-14 18:00:46'),
(4, 2, '1087303', 2, 1, 199.00, 290.00, 5, 995.00, 'Salon', 'In', '2022-11-12 15:18:53', '2022-11-12 15:18:53'),
(5, 2, '3132652', 2, 1, 200.00, 450.00, 10, 2000.00, 'Salon', 'In', '2022-11-12 15:37:09', '2022-11-12 15:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `salon_items`
--

CREATE TABLE `salon_items` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `sku` varchar(191) DEFAULT NULL,
  `description` text,
  `image` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1:active,0:inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon_items`
--

INSERT INTO `salon_items` (`id`, `name`, `unit_id`, `sku`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Creem', 1, '6321b62e58c71', '<p>test</p>', 'public/uploads/others/OnaQD8WfkRriFqA05YpeTlCWAkaGwMJYVIJg4WDjeJfy3SydMe89898-20220723220929.jpg', 1, '2022-09-14 17:09:31', '2022-09-14 17:09:31'),
(2, 'hair colour', 1, '636f64685250a', NULL, 'public/uploads/others/WZVheKla42Mj4focz0hOhyGoSMeba79yRCqQ2WuGv4NHksfX1klungi.jpg', 1, '2022-11-12 15:17:12', '2022-11-12 15:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `salon_order_employees`
--

CREATE TABLE `salon_order_employees` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `salon_parent_services`
--

CREATE TABLE `salon_parent_services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1:active,0:inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon_parent_services`
--

INSERT INTO `salon_parent_services` (`id`, `service_name`, `category_id`, `image`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Hair Cutting', 1, 'public/uploads/salonproduct/9JcgfzClfHPrIU8EQlc2ovw92ZM7VzD023F4hIuZr4Q7Gfkwe673-738269_girl-cartoon-with-hijab.jpg', 'hair-cutting', 1, '2022-09-14 17:17:21', '2022-09-14 17:17:21'),
(2, 'HAIR CUT AND SHAVE', 1, 'public/uploads/salonproduct/Cei6bXsQB8gg8ylNVaeaqKW9645I1ReZSqf3dBKjMmcE2EzCzzSALON.jpg', 'hair-cut-and-shave', 1, '2022-09-26 11:24:26', '2022-09-26 11:24:26'),
(3, 'FACIAL AND SKIN TRERATMENT', 2, 'public/uploads/salonproduct/0XC1H7IHdJ2Dmc6FEOiZCI8v99keQIKX7UFGq4vY5HrdfveAHQSALON.jpg', 'facial-and-skin-treratment', 1, '2022-09-26 11:25:02', '2022-09-26 11:25:02'),
(4, 'HIGH QUALITY FACIAL', 3, 'public/uploads/salonproduct/eAOUVis1dUJqIidogYwE68ikrDPPsMwvGPAeyEZJZpnxby3c99SALON.jpg', 'high-quality-facial', 1, '2022-09-26 11:25:30', '2022-09-26 11:25:30'),
(5, 'HAIR COLOR', 4, 'public/uploads/salonproduct/65XgaNNc3RytB17Ph14fECOMUgmIWaz1wS6FTatwlLswXk6K5NSALON.jpg', 'hair-color', 1, '2022-09-26 11:25:57', '2022-09-26 11:25:57'),
(6, 'HAIR TREATMENT', 5, 'public/uploads/salonproduct/MdPhx5LJze0wUK0DtMwgcRCScUqAIWJKk8fi2bndPIEFQH4LZnSALON.jpg', 'hair-treatment', 1, '2022-09-26 11:26:23', '2022-09-26 11:26:23'),
(7, 'FAIR POLISH', 6, 'public/uploads/salonproduct/rkhykuDsVyS9chNP2A74ctvz6emLqauFl3oA8NCGHxNYvC7wi2SALON.jpg', 'fair-polish', 1, '2022-09-26 11:26:44', '2022-09-26 11:26:44'),
(8, 'BODY SPA AND MASSAGE', 7, 'public/uploads/salonproduct/9T9m5mWRhDo8xfS580GTuWxDgkNel3A3p0A4iozrdpLn5ANT8wSALON.jpg', 'body-spa-and-massage', 1, '2022-09-26 11:27:14', '2022-09-26 11:27:14'),
(9, 'test', 4, 'public/uploads/salonproduct/bSLNFFPlLhaoGJSeTk80CkEXRlpu1dYheDMJ6kBEtY5rTJl4qe12.PNG', 'test', 1, '2022-10-03 20:10:51', '2022-10-03 20:10:51');

-- --------------------------------------------------------

--
-- Table structure for table `salon_product_uses`
--

CREATE TABLE `salon_product_uses` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `uses_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon_product_uses`
--

INSERT INTO `salon_product_uses` (`id`, `order_id`, `branch_id`, `item_id`, `quantity`, `uses_date`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 1, '2022-09-14 17:22:16', '2022-09-14 17:22:16', '2022-09-14 17:22:16'),
(2, 2, 2, 1, 1, '2022-09-14 18:00:46', '2022-09-14 18:00:46', '2022-09-14 18:00:46');

-- --------------------------------------------------------

--
-- Table structure for table `salon_purchases`
--

CREATE TABLE `salon_purchases` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `invoice_no` varchar(191) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `purchase_date` varchar(30) NOT NULL,
  `invoice_total` double(20,2) NOT NULL,
  `discount` varchar(30) DEFAULT NULL,
  `payable` double(20,2) NOT NULL,
  `paid` double(20,2) NOT NULL DEFAULT '0.00',
  `due` double(20,2) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1:active,0:inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon_purchases`
--

INSERT INTO `salon_purchases` (`id`, `branch_id`, `invoice_no`, `supplier_id`, `purchase_date`, `invoice_total`, `discount`, `payable`, `paid`, `due`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '1105003', 1, '2022-09-14', 10000.00, NULL, 10000.00, 5000.00, 5000.00, 1, '2022-09-14 17:10:46', '2022-11-12 15:36:44'),
(2, 2, '1087303', 2, '2022-11-12', 995.00, NULL, 995.00, 995.00, 0.00, 1, '2022-11-12 15:18:53', '2022-11-12 15:18:53'),
(3, 2, '3132652', 1, '2022-11-12', 2000.00, NULL, 2000.00, 1000.00, 1000.00, 1, '2022-11-12 15:37:09', '2022-11-12 15:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `salon_purchase_items`
--

CREATE TABLE `salon_purchase_items` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(191) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `buy_price` double(20,2) NOT NULL,
  `sale_price` double(20,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` double(20,2) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1:active,0:inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon_purchase_items`
--

INSERT INTO `salon_purchase_items` (`id`, `invoice_no`, `purchase_id`, `item_id`, `unit_id`, `buy_price`, `sale_price`, `quantity`, `subtotal`, `status`, `created_at`, `updated_at`) VALUES
(1, '1105003', 1, 1, 1, 100.00, 120.00, 100, 10000.00, 1, '2022-09-14 17:10:46', '2022-09-14 17:10:46'),
(2, '1087303', 2, 2, 1, 199.00, 290.00, 5, 995.00, 1, '2022-11-12 15:18:53', '2022-11-12 15:18:53'),
(3, '3132652', 3, 2, 1, 200.00, 450.00, 10, 2000.00, 1, '2022-11-12 15:37:09', '2022-11-12 15:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `salon_services`
--

CREATE TABLE `salon_services` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `parent_service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `duration` int(11) NOT NULL,
  `schedule` text NOT NULL,
  `price_per_space` int(11) NOT NULL,
  `allow_multiple_booking` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1:yes,0:no',
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(30) NOT NULL COMMENT 'Active,Inactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon_services`
--

INSERT INTO `salon_services` (`id`, `category_id`, `parent_service_id`, `service_name`, `start_time`, `end_time`, `duration`, `schedule`, `price_per_space`, `allow_multiple_booking`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Hair Cutting (General)', '10:00:00', '23:00:00', 60, '10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 150, 0, '<p>test</p>', NULL, 'Active', '2022-09-14 17:19:04', '2022-09-14 17:19:04'),
(2, 1, 1, 'Hair Cut (Stylist)', '22:43:00', '23:00:00', 60, '22:43:00-23:43:00', 200, 0, '<p>test</p>', NULL, 'Active', '2022-09-14 17:43:55', '2022-09-14 17:43:55'),
(3, 1, 2, 'HAIR CUT', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 150, 0, '<p>HAIR CUT AND SHAVE</p>', NULL, 'Active', '2022-09-26 11:29:48', '2022-09-26 11:29:48'),
(4, 1, 2, 'NORMAL HAIRCUT AND SHAVE', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 220, 0, '<p>HAIR CUT AND SHAVE</p>', NULL, 'Active', '2022-09-26 11:36:37', '2022-09-26 11:36:37'),
(5, 1, 2, 'SPECIAL HAIRCUT,SHAVE AND SHAMPO WASH', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 280, 0, '<p>SPECIAL HAIRCUT,SHAVE AND SHAMPO WASH</p>', NULL, 'Active', '2022-09-26 11:38:20', '2022-09-26 11:38:20'),
(6, 1, 2, 'SHAVE', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 100, 0, '<p>SHAVE</p>', NULL, 'Active', '2022-09-26 11:39:19', '2022-09-26 11:39:19'),
(7, 1, 2, 'SHAVE AND CLEANSER WASH', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 150, 0, '<p>SHAVE AND CLEANSER WASH</p>', NULL, 'Active', '2022-09-26 11:40:59', '2022-09-26 11:40:59'),
(8, 1, 2, 'KIDS HAIR CUT NORMAL', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 150, 0, '<p>KIDS HAIR CUT NORMAL</p>', NULL, 'Active', '2022-09-26 11:42:22', '2022-09-26 11:42:22'),
(9, 1, 2, 'BEARD TRIM AND CLEANSAR WASH', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 150, 0, '<p>BEARD TRIM AND CLEANSAR WASH</p>', NULL, 'Active', '2022-09-26 11:45:08', '2022-09-26 11:45:08'),
(10, 1, 2, 'STYLISH BEARD AND CLEANSER WASH', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 200, 0, '<p>STYLISH BEARD AND CLEANSER WASH</p>', NULL, 'Active', '2022-09-26 11:46:32', '2022-09-26 11:46:32'),
(11, 1, 2, 'ONLY SHAMPOO AND GEL', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 100, 0, '<p>ONLY SHAMPOO AND GEL</p>', NULL, 'Active', '2022-09-26 11:48:01', '2022-09-26 11:48:01'),
(12, 2, 3, 'FACE WASH NORMAL', '09:00:00', '23:00:00', 40, '09:00:00-09:40:00,09:40:00-10:20:00,10:20:00-11:00:00,11:00:00-11:40:00,11:40:00-12:20:00,12:20:00-13:00:00,13:00:00-13:40:00,13:40:00-14:20:00,14:20:00-15:00:00,15:00:00-15:40:00,15:40:00-16:20:00,16:20:00-17:00:00,17:00:00-17:40:00,17:40:00-18:20:00,18:20:00-19:00:00,19:00:00-19:40:00,19:40:00-20:20:00,20:20:00-21:00:00,21:00:00-21:40:00,21:40:00-22:20:00,22:20:00-23:00:00', 200, 1, '<p>FACE WASH NORMAL</p>', NULL, 'Active', '2022-09-29 13:09:27', '2022-09-29 13:09:27'),
(13, 2, 3, 'FACE WASH SPECIAL', '09:00:00', '23:00:00', 40, '09:00:00-09:40:00,09:40:00-10:20:00,10:20:00-11:00:00,11:00:00-11:40:00,11:40:00-12:20:00,12:20:00-13:00:00,13:00:00-13:40:00,13:40:00-14:20:00,14:20:00-15:00:00,15:00:00-15:40:00,15:40:00-16:20:00,16:20:00-17:00:00,17:00:00-17:40:00,17:40:00-18:20:00,18:20:00-19:00:00,19:00:00-19:40:00,19:40:00-20:20:00,20:20:00-21:00:00,21:00:00-21:40:00,21:40:00-22:20:00,22:20:00-23:00:00', 300, 1, '<p>FACE WASH SPECIAL</p>', NULL, 'Active', '2022-09-29 13:10:47', '2022-09-29 13:10:47'),
(14, 2, 3, 'FACE CLEAN SPECIAL', '09:00:00', '23:00:00', 40, '09:00:00-09:40:00,09:40:00-10:20:00,10:20:00-11:00:00,11:00:00-11:40:00,11:40:00-12:20:00,12:20:00-13:00:00,13:00:00-13:40:00,13:40:00-14:20:00,14:20:00-15:00:00,15:00:00-15:40:00,15:40:00-16:20:00,16:20:00-17:00:00,17:00:00-17:40:00,17:40:00-18:20:00,18:20:00-19:00:00,19:00:00-19:40:00,19:40:00-20:20:00,20:20:00-21:00:00,21:00:00-21:40:00,21:40:00-22:20:00,22:20:00-23:00:00', 450, 1, '<p>FACE CLEAN SPECIAL</p>', NULL, 'Active', '2022-09-29 13:12:18', '2022-09-29 13:12:18'),
(15, 2, 3, 'SILVER FACIAL FOR SHINING & GLOWING LOOK ALL TYPES SKIN', '09:00:00', '23:00:00', 40, '09:00:00-09:40:00,09:40:00-10:20:00,10:20:00-11:00:00,11:00:00-11:40:00,11:40:00-12:20:00,12:20:00-13:00:00,13:00:00-13:40:00,13:40:00-14:20:00,14:20:00-15:00:00,15:00:00-15:40:00,15:40:00-16:20:00,16:20:00-17:00:00,17:00:00-17:40:00,17:40:00-18:20:00,18:20:00-19:00:00,19:00:00-19:40:00,19:40:00-20:20:00,20:20:00-21:00:00,21:00:00-21:40:00,21:40:00-22:20:00,22:20:00-23:00:00', 800, 1, '<p>SILVER FACIAL FOR SHINING &amp; GLOWING LOOK ALL TYPES SKIN</p>', NULL, 'Active', '2022-09-29 17:57:24', '2022-09-29 17:57:24'),
(16, 2, 3, 'DIAMOND FACIAL HIGH QUALITY', '09:00:00', '23:00:00', 40, '09:00:00-09:40:00,09:40:00-10:20:00,10:20:00-11:00:00,11:00:00-11:40:00,11:40:00-12:20:00,12:20:00-13:00:00,13:00:00-13:40:00,13:40:00-14:20:00,14:20:00-15:00:00,15:00:00-15:40:00,15:40:00-16:20:00,16:20:00-17:00:00,17:00:00-17:40:00,17:40:00-18:20:00,18:20:00-19:00:00,19:00:00-19:40:00,19:40:00-20:20:00,20:20:00-21:00:00,21:00:00-21:40:00,21:40:00-22:20:00,22:20:00-23:00:00', 1000, 1, '<p>DIAMOND FACIAL HIGH QUALITY</p>', NULL, 'Active', '2022-09-29 17:58:47', '2022-09-29 17:58:47'),
(17, 2, 3, 'HYDRO FACIAL (AMMONIA FREE) FOR BETTER & BEAUTIFUL SKIN', '09:00:00', '23:00:00', 60, '09:00:00-10:00:00,10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 1800, 1, '<p>HYDRO FACIAL (AMMONIA FREE) FOR BETTER &amp; BEAUTIFUL SKIN</p>', NULL, 'Active', '2022-09-29 18:15:01', '2022-09-29 18:15:01'),
(18, 2, 3, 'VLG FACIAL HIGH QUALITY', '09:00:00', '23:00:00', 60, '09:00:00-10:00:00,10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 1500, 1, '<p>VLG FACIAL HIGH QUALITY</p>', NULL, 'Active', '2022-09-29 18:16:11', '2022-09-29 18:16:11'),
(19, 2, 3, 'SPA FACIAL GLOW LOOK & SHINING FACE', '09:00:00', '23:00:00', 40, '09:00:00-09:40:00,09:40:00-10:20:00,10:20:00-11:00:00,11:00:00-11:40:00,11:40:00-12:20:00,12:20:00-13:00:00,13:00:00-13:40:00,13:40:00-14:20:00,14:20:00-15:00:00,15:00:00-15:40:00,15:40:00-16:20:00,16:20:00-17:00:00,17:00:00-17:40:00,17:40:00-18:20:00,18:20:00-19:00:00,19:00:00-19:40:00,19:40:00-20:20:00,20:20:00-21:00:00,21:00:00-21:40:00,21:40:00-22:20:00,22:20:00-23:00:00', 1200, 1, '<p>SPA FACIAL GLOW LOOK &amp; SHINING FACE</p>', NULL, 'Active', '2022-09-29 18:17:48', '2022-09-29 18:17:48'),
(20, 2, 3, 'ALOE VERA FACIAL OIL CARE,CLEAN & SHINING WET LOOK', '09:00:00', '23:00:00', 40, '09:00:00-09:40:00,09:40:00-10:20:00,10:20:00-11:00:00,11:00:00-11:40:00,11:40:00-12:20:00,12:20:00-13:00:00,13:00:00-13:40:00,13:40:00-14:20:00,14:20:00-15:00:00,15:00:00-15:40:00,15:40:00-16:20:00,16:20:00-17:00:00,17:00:00-17:40:00,17:40:00-18:20:00,18:20:00-19:00:00,19:00:00-19:40:00,19:40:00-20:20:00,20:20:00-21:00:00,21:00:00-21:40:00,21:40:00-22:20:00,22:20:00-23:00:00', 1300, 1, '<p>ALOE VERA FACIAL OIL CARE,CLEAN &amp; SHINING WET LOOK</p>', NULL, 'Active', '2022-09-29 18:20:17', '2022-09-29 18:20:17'),
(21, 2, 3, 'FLOWER FACIAL FOR MIXED SKIN', '09:00:00', '23:00:00', 40, '09:00:00-09:40:00,09:40:00-10:20:00,10:20:00-11:00:00,11:00:00-11:40:00,11:40:00-12:20:00,12:20:00-13:00:00,13:00:00-13:40:00,13:40:00-14:20:00,14:20:00-15:00:00,15:00:00-15:40:00,15:40:00-16:20:00,16:20:00-17:00:00,17:00:00-17:40:00,17:40:00-18:20:00,18:20:00-19:00:00,19:00:00-19:40:00,19:40:00-20:20:00,20:20:00-21:00:00,21:00:00-21:40:00,21:40:00-22:20:00,22:20:00-23:00:00', 600, 1, '<p>FLOWER FACIAL FOR MIXED SKIN</p>', NULL, 'Active', '2022-09-29 18:21:26', '2022-09-29 18:21:26'),
(22, 2, 3, 'FRUIT FACIAL FOR NORMAL FACE', '09:00:00', '23:00:00', 40, '09:00:00-09:40:00,09:40:00-10:20:00,10:20:00-11:00:00,11:00:00-11:40:00,11:40:00-12:20:00,12:20:00-13:00:00,13:00:00-13:40:00,13:40:00-14:20:00,14:20:00-15:00:00,15:00:00-15:40:00,15:40:00-16:20:00,16:20:00-17:00:00,17:00:00-17:40:00,17:40:00-18:20:00,18:20:00-19:00:00,19:00:00-19:40:00,19:40:00-20:20:00,20:20:00-21:00:00,21:00:00-21:40:00,21:40:00-22:20:00,22:20:00-23:00:00', 700, 1, '<p>FRUIT FACIAL FOR NORMAL FACE</p>', NULL, 'Active', '2022-09-29 18:22:55', '2022-09-29 18:22:55'),
(23, 2, 3, 'GOLD FACIAL', '09:00:00', '23:00:00', 40, '09:00:00-09:40:00,09:40:00-10:20:00,10:20:00-11:00:00,11:00:00-11:40:00,11:40:00-12:20:00,12:20:00-13:00:00,13:00:00-13:40:00,13:40:00-14:20:00,14:20:00-15:00:00,15:00:00-15:40:00,15:40:00-16:20:00,16:20:00-17:00:00,17:00:00-17:40:00,17:40:00-18:20:00,18:20:00-19:00:00,19:00:00-19:40:00,19:40:00-20:20:00,20:20:00-21:00:00,21:00:00-21:40:00,21:40:00-22:20:00,22:20:00-23:00:00', 1000, 1, '<p>GOLD FACIAL</p>', NULL, 'Active', '2022-09-29 18:23:57', '2022-09-29 18:23:57'),
(24, 2, 3, 'PEARL FACIAL FOR WET LOOK & GLOW', '09:00:00', '23:00:00', 40, '09:00:00-09:40:00,09:40:00-10:20:00,10:20:00-11:00:00,11:00:00-11:40:00,11:40:00-12:20:00,12:20:00-13:00:00,13:00:00-13:40:00,13:40:00-14:20:00,14:20:00-15:00:00,15:00:00-15:40:00,15:40:00-16:20:00,16:20:00-17:00:00,17:00:00-17:40:00,17:40:00-18:20:00,18:20:00-19:00:00,19:00:00-19:40:00,19:40:00-20:20:00,20:20:00-21:00:00,21:00:00-21:40:00,21:40:00-22:20:00,22:20:00-23:00:00', 1200, 1, '<p>PEARL FACIAL FOR WET LOOK &amp; GLOW</p>', NULL, 'Active', '2022-09-29 18:25:24', '2022-09-29 18:25:24'),
(25, 3, 4, 'PEARL FACIAL (FACE-1200+NECK-900)', '09:00:00', '23:00:00', 60, '09:00:00-10:00:00,10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 2300, 1, '<p>PEARL FACIAL (FACE-1200+NECK-900)</p>', NULL, 'Active', '2022-09-30 13:49:20', '2022-09-30 13:49:20'),
(26, 3, 4, 'DIAMOND FACIAL (FACE-1100+NECK1100))', '09:00:00', '23:00:00', 60, '09:00:00-10:00:00,10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 2200, 1, '<p>DIAMOND FACIAL (FACE-1100+NECK1100))</p>', NULL, 'Active', '2022-09-30 13:51:19', '2022-09-30 13:51:19'),
(27, 3, 4, 'WATTING GLOW FACIAL (FACE-1000+NECK-900)', '09:00:00', '23:00:00', 60, '09:00:00-10:00:00,10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 1900, 1, '<p>WATTING GLOW FACIAL (FACE-1000+NECK-900)</p>', NULL, 'Active', '2022-09-30 13:53:48', '2022-09-30 13:53:48'),
(28, 3, 4, 'GOLD 24K FACIAL (FACE-1000+NECK-900)', '09:00:00', '23:00:00', 60, '09:00:00-10:00:00,10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 1900, 0, '<p>GOLD 24K FACIAL (FACE-1000+NECK-900)</p>', NULL, 'Active', '2022-09-30 13:56:42', '2022-09-30 13:56:42'),
(29, 3, 4, 'BYDEL FACIAL (FACE-1000+NECK-900)', '09:00:00', '23:00:00', 60, '09:00:00-10:00:00,10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 1900, 1, '<p>BYDEL FACIAL (FACE-1000+NECK-900)</p>', NULL, 'Active', '2022-09-30 13:58:48', '2022-09-30 13:58:48'),
(30, 3, 4, 'OXY FACIAL (FACE-900+NECK-800)', '09:00:00', '23:00:00', 60, '09:00:00-10:00:00,10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 1700, 1, '<p>OXY FACIAL (FACE-900+NECK-800)</p>', NULL, 'Active', '2022-09-30 14:00:12', '2022-09-30 14:00:12'),
(31, 4, 5, 'HI SPEED', '09:00:00', '23:00:00', 10, '09:00:00-09:10:00,09:10:00-09:20:00,09:20:00-09:30:00,09:30:00-09:40:00,09:40:00-09:50:00,09:50:00-10:00:00,10:00:00-10:10:00,10:10:00-10:20:00,10:20:00-10:30:00,10:30:00-10:40:00,10:40:00-10:50:00,10:50:00-11:00:00,11:00:00-11:10:00,11:10:00-11:20:00,11:20:00-11:30:00,11:30:00-11:40:00,11:40:00-11:50:00,11:50:00-12:00:00,12:00:00-12:10:00,12:10:00-12:20:00,12:20:00-12:30:00,12:30:00-12:40:00,12:40:00-12:50:00,12:50:00-13:00:00,13:00:00-13:10:00,13:10:00-13:20:00,13:20:00-13:30:00,13:30:00-13:40:00,13:40:00-13:50:00,13:50:00-14:00:00,14:00:00-14:10:00,14:10:00-14:20:00,14:20:00-14:30:00,14:30:00-14:40:00,14:40:00-14:50:00,14:50:00-15:00:00,15:00:00-15:10:00,15:10:00-15:20:00,15:20:00-15:30:00,15:30:00-15:40:00,15:40:00-15:50:00,15:50:00-16:00:00,16:00:00-16:10:00,16:10:00-16:20:00,16:20:00-16:30:00,16:30:00-16:40:00,16:40:00-16:50:00,16:50:00-17:00:00,17:00:00-17:10:00,17:10:00-17:20:00,17:20:00-17:30:00,17:30:00-17:40:00,17:40:00-17:50:00,17:50:00-18:00:00,18:00:00-18:10:00,18:10:00-18:20:00,18:20:00-18:30:00,18:30:00-18:40:00,18:40:00-18:50:00,18:50:00-19:00:00,19:00:00-19:10:00,19:10:00-19:20:00,19:20:00-19:30:00,19:30:00-19:40:00,19:40:00-19:50:00,19:50:00-20:00:00,20:00:00-20:10:00,20:10:00-20:20:00,20:20:00-20:30:00,20:30:00-20:40:00,20:40:00-20:50:00,20:50:00-21:00:00,21:00:00-21:10:00,21:10:00-21:20:00,21:20:00-21:30:00,21:30:00-21:40:00,21:40:00-21:50:00,21:50:00-22:00:00,22:00:00-22:10:00,22:10:00-22:20:00,22:20:00-22:30:00,22:30:00-22:40:00,22:40:00-22:50:00,22:50:00-23:00:00', 500, 1, '<p>HI SPEED</p>', NULL, 'Active', '2022-09-30 14:37:49', '2022-09-30 14:37:49'),
(32, 4, 5, 'BIGEN', '09:00:00', '23:00:00', 10, '09:00:00-09:10:00,09:10:00-09:20:00,09:20:00-09:30:00,09:30:00-09:40:00,09:40:00-09:50:00,09:50:00-10:00:00,10:00:00-10:10:00,10:10:00-10:20:00,10:20:00-10:30:00,10:30:00-10:40:00,10:40:00-10:50:00,10:50:00-11:00:00,11:00:00-11:10:00,11:10:00-11:20:00,11:20:00-11:30:00,11:30:00-11:40:00,11:40:00-11:50:00,11:50:00-12:00:00,12:00:00-12:10:00,12:10:00-12:20:00,12:20:00-12:30:00,12:30:00-12:40:00,12:40:00-12:50:00,12:50:00-13:00:00,13:00:00-13:10:00,13:10:00-13:20:00,13:20:00-13:30:00,13:30:00-13:40:00,13:40:00-13:50:00,13:50:00-14:00:00,14:00:00-14:10:00,14:10:00-14:20:00,14:20:00-14:30:00,14:30:00-14:40:00,14:40:00-14:50:00,14:50:00-15:00:00,15:00:00-15:10:00,15:10:00-15:20:00,15:20:00-15:30:00,15:30:00-15:40:00,15:40:00-15:50:00,15:50:00-16:00:00,16:00:00-16:10:00,16:10:00-16:20:00,16:20:00-16:30:00,16:30:00-16:40:00,16:40:00-16:50:00,16:50:00-17:00:00,17:00:00-17:10:00,17:10:00-17:20:00,17:20:00-17:30:00,17:30:00-17:40:00,17:40:00-17:50:00,17:50:00-18:00:00,18:00:00-18:10:00,18:10:00-18:20:00,18:20:00-18:30:00,18:30:00-18:40:00,18:40:00-18:50:00,18:50:00-19:00:00,19:00:00-19:10:00,19:10:00-19:20:00,19:20:00-19:30:00,19:30:00-19:40:00,19:40:00-19:50:00,19:50:00-20:00:00,20:00:00-20:10:00,20:10:00-20:20:00,20:20:00-20:30:00,20:30:00-20:40:00,20:40:00-20:50:00,20:50:00-21:00:00,21:00:00-21:10:00,21:10:00-21:20:00,21:20:00-21:30:00,21:30:00-21:40:00,21:40:00-21:50:00,21:50:00-22:00:00,22:00:00-22:10:00,22:10:00-22:20:00,22:20:00-22:30:00,22:30:00-22:40:00,22:40:00-22:50:00,22:50:00-23:00:00', 600, 1, '<p>BIGEN</p>', NULL, 'Active', '2022-09-30 14:38:48', '2022-09-30 14:38:48'),
(33, 4, 5, 'REVLON', '09:00:00', '23:00:00', 10, '09:00:00-09:10:00,09:10:00-09:20:00,09:20:00-09:30:00,09:30:00-09:40:00,09:40:00-09:50:00,09:50:00-10:00:00,10:00:00-10:10:00,10:10:00-10:20:00,10:20:00-10:30:00,10:30:00-10:40:00,10:40:00-10:50:00,10:50:00-11:00:00,11:00:00-11:10:00,11:10:00-11:20:00,11:20:00-11:30:00,11:30:00-11:40:00,11:40:00-11:50:00,11:50:00-12:00:00,12:00:00-12:10:00,12:10:00-12:20:00,12:20:00-12:30:00,12:30:00-12:40:00,12:40:00-12:50:00,12:50:00-13:00:00,13:00:00-13:10:00,13:10:00-13:20:00,13:20:00-13:30:00,13:30:00-13:40:00,13:40:00-13:50:00,13:50:00-14:00:00,14:00:00-14:10:00,14:10:00-14:20:00,14:20:00-14:30:00,14:30:00-14:40:00,14:40:00-14:50:00,14:50:00-15:00:00,15:00:00-15:10:00,15:10:00-15:20:00,15:20:00-15:30:00,15:30:00-15:40:00,15:40:00-15:50:00,15:50:00-16:00:00,16:00:00-16:10:00,16:10:00-16:20:00,16:20:00-16:30:00,16:30:00-16:40:00,16:40:00-16:50:00,16:50:00-17:00:00,17:00:00-17:10:00,17:10:00-17:20:00,17:20:00-17:30:00,17:30:00-17:40:00,17:40:00-17:50:00,17:50:00-18:00:00,18:00:00-18:10:00,18:10:00-18:20:00,18:20:00-18:30:00,18:30:00-18:40:00,18:40:00-18:50:00,18:50:00-19:00:00,19:00:00-19:10:00,19:10:00-19:20:00,19:20:00-19:30:00,19:30:00-19:40:00,19:40:00-19:50:00,19:50:00-20:00:00,20:00:00-20:10:00,20:10:00-20:20:00,20:20:00-20:30:00,20:30:00-20:40:00,20:40:00-20:50:00,20:50:00-21:00:00,21:00:00-21:10:00,21:10:00-21:20:00,21:20:00-21:30:00,21:30:00-21:40:00,21:40:00-21:50:00,21:50:00-22:00:00,22:00:00-22:10:00,22:10:00-22:20:00,22:20:00-22:30:00,22:30:00-22:40:00,22:40:00-22:50:00,22:50:00-23:00:00', 700, 1, '<p>REVLON</p>', NULL, 'Active', '2022-09-30 14:42:37', '2022-09-30 14:42:37'),
(34, 4, 5, 'L\'OREAL PROFESSIONAL', '09:00:00', '23:00:00', 60, '09:00:00-10:00:00,10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 1200, 1, '<p>L&#39;OREAL PROFESSIONAL</p>', NULL, 'Active', '2022-09-30 14:48:44', '2022-09-30 14:48:44'),
(35, 4, 5, 'GARNIER', '09:00:00', '23:00:00', 10, '09:00:00-09:10:00,09:10:00-09:20:00,09:20:00-09:30:00,09:30:00-09:40:00,09:40:00-09:50:00,09:50:00-10:00:00,10:00:00-10:10:00,10:10:00-10:20:00,10:20:00-10:30:00,10:30:00-10:40:00,10:40:00-10:50:00,10:50:00-11:00:00,11:00:00-11:10:00,11:10:00-11:20:00,11:20:00-11:30:00,11:30:00-11:40:00,11:40:00-11:50:00,11:50:00-12:00:00,12:00:00-12:10:00,12:10:00-12:20:00,12:20:00-12:30:00,12:30:00-12:40:00,12:40:00-12:50:00,12:50:00-13:00:00,13:00:00-13:10:00,13:10:00-13:20:00,13:20:00-13:30:00,13:30:00-13:40:00,13:40:00-13:50:00,13:50:00-14:00:00,14:00:00-14:10:00,14:10:00-14:20:00,14:20:00-14:30:00,14:30:00-14:40:00,14:40:00-14:50:00,14:50:00-15:00:00,15:00:00-15:10:00,15:10:00-15:20:00,15:20:00-15:30:00,15:30:00-15:40:00,15:40:00-15:50:00,15:50:00-16:00:00,16:00:00-16:10:00,16:10:00-16:20:00,16:20:00-16:30:00,16:30:00-16:40:00,16:40:00-16:50:00,16:50:00-17:00:00,17:00:00-17:10:00,17:10:00-17:20:00,17:20:00-17:30:00,17:30:00-17:40:00,17:40:00-17:50:00,17:50:00-18:00:00,18:00:00-18:10:00,18:10:00-18:20:00,18:20:00-18:30:00,18:30:00-18:40:00,18:40:00-18:50:00,18:50:00-19:00:00,19:00:00-19:10:00,19:10:00-19:20:00,19:20:00-19:30:00,19:30:00-19:40:00,19:40:00-19:50:00,19:50:00-20:00:00,20:00:00-20:10:00,20:10:00-20:20:00,20:20:00-20:30:00,20:30:00-20:40:00,20:40:00-20:50:00,20:50:00-21:00:00,21:00:00-21:10:00,21:10:00-21:20:00,21:20:00-21:30:00,21:30:00-21:40:00,21:40:00-21:50:00,21:50:00-22:00:00,22:00:00-22:10:00,22:10:00-22:20:00,22:20:00-22:30:00,22:30:00-22:40:00,22:40:00-22:50:00,22:50:00-23:00:00', 600, 1, '<p>GARNIER</p>', NULL, 'Active', '2022-09-30 15:09:08', '2022-09-30 15:09:08'),
(36, 4, 5, 'HENA', '09:00:00', '23:00:00', 10, '09:00:00-09:10:00,09:10:00-09:20:00,09:20:00-09:30:00,09:30:00-09:40:00,09:40:00-09:50:00,09:50:00-10:00:00,10:00:00-10:10:00,10:10:00-10:20:00,10:20:00-10:30:00,10:30:00-10:40:00,10:40:00-10:50:00,10:50:00-11:00:00,11:00:00-11:10:00,11:10:00-11:20:00,11:20:00-11:30:00,11:30:00-11:40:00,11:40:00-11:50:00,11:50:00-12:00:00,12:00:00-12:10:00,12:10:00-12:20:00,12:20:00-12:30:00,12:30:00-12:40:00,12:40:00-12:50:00,12:50:00-13:00:00,13:00:00-13:10:00,13:10:00-13:20:00,13:20:00-13:30:00,13:30:00-13:40:00,13:40:00-13:50:00,13:50:00-14:00:00,14:00:00-14:10:00,14:10:00-14:20:00,14:20:00-14:30:00,14:30:00-14:40:00,14:40:00-14:50:00,14:50:00-15:00:00,15:00:00-15:10:00,15:10:00-15:20:00,15:20:00-15:30:00,15:30:00-15:40:00,15:40:00-15:50:00,15:50:00-16:00:00,16:00:00-16:10:00,16:10:00-16:20:00,16:20:00-16:30:00,16:30:00-16:40:00,16:40:00-16:50:00,16:50:00-17:00:00,17:00:00-17:10:00,17:10:00-17:20:00,17:20:00-17:30:00,17:30:00-17:40:00,17:40:00-17:50:00,17:50:00-18:00:00,18:00:00-18:10:00,18:10:00-18:20:00,18:20:00-18:30:00,18:30:00-18:40:00,18:40:00-18:50:00,18:50:00-19:00:00,19:00:00-19:10:00,19:10:00-19:20:00,19:20:00-19:30:00,19:30:00-19:40:00,19:40:00-19:50:00,19:50:00-20:00:00,20:00:00-20:10:00,20:10:00-20:20:00,20:20:00-20:30:00,20:30:00-20:40:00,20:40:00-20:50:00,20:50:00-21:00:00,21:00:00-21:10:00,21:10:00-21:20:00,21:20:00-21:30:00,21:30:00-21:40:00,21:40:00-21:50:00,21:50:00-22:00:00,22:00:00-22:10:00,22:10:00-22:20:00,22:20:00-22:30:00,22:30:00-22:40:00,22:40:00-22:50:00,22:50:00-23:00:00', 500, 1, '<p>HENA</p>', NULL, 'Active', '2022-09-30 15:11:20', '2022-09-30 15:11:20'),
(37, 4, 5, 'NEW LOOK', '09:00:00', '23:00:00', 10, '09:00:00-09:10:00,09:10:00-09:20:00,09:20:00-09:30:00,09:30:00-09:40:00,09:40:00-09:50:00,09:50:00-10:00:00,10:00:00-10:10:00,10:10:00-10:20:00,10:20:00-10:30:00,10:30:00-10:40:00,10:40:00-10:50:00,10:50:00-11:00:00,11:00:00-11:10:00,11:10:00-11:20:00,11:20:00-11:30:00,11:30:00-11:40:00,11:40:00-11:50:00,11:50:00-12:00:00,12:00:00-12:10:00,12:10:00-12:20:00,12:20:00-12:30:00,12:30:00-12:40:00,12:40:00-12:50:00,12:50:00-13:00:00,13:00:00-13:10:00,13:10:00-13:20:00,13:20:00-13:30:00,13:30:00-13:40:00,13:40:00-13:50:00,13:50:00-14:00:00,14:00:00-14:10:00,14:10:00-14:20:00,14:20:00-14:30:00,14:30:00-14:40:00,14:40:00-14:50:00,14:50:00-15:00:00,15:00:00-15:10:00,15:10:00-15:20:00,15:20:00-15:30:00,15:30:00-15:40:00,15:40:00-15:50:00,15:50:00-16:00:00,16:00:00-16:10:00,16:10:00-16:20:00,16:20:00-16:30:00,16:30:00-16:40:00,16:40:00-16:50:00,16:50:00-17:00:00,17:00:00-17:10:00,17:10:00-17:20:00,17:20:00-17:30:00,17:30:00-17:40:00,17:40:00-17:50:00,17:50:00-18:00:00,18:00:00-18:10:00,18:10:00-18:20:00,18:20:00-18:30:00,18:30:00-18:40:00,18:40:00-18:50:00,18:50:00-19:00:00,19:00:00-19:10:00,19:10:00-19:20:00,19:20:00-19:30:00,19:30:00-19:40:00,19:40:00-19:50:00,19:50:00-20:00:00,20:00:00-20:10:00,20:10:00-20:20:00,20:20:00-20:30:00,20:30:00-20:40:00,20:40:00-20:50:00,20:50:00-21:00:00,21:00:00-21:10:00,21:10:00-21:20:00,21:20:00-21:30:00,21:30:00-21:40:00,21:40:00-21:50:00,21:50:00-22:00:00,22:00:00-22:10:00,22:10:00-22:20:00,22:20:00-22:30:00,22:30:00-22:40:00,22:40:00-22:50:00,22:50:00-23:00:00', 700, 1, '<p>NEW LOOK</p>', NULL, 'Active', '2022-09-30 15:13:06', '2022-09-30 15:13:06'),
(38, 4, 5, 'JK', '09:00:00', '23:00:00', 10, '09:00:00-09:10:00,09:10:00-09:20:00,09:20:00-09:30:00,09:30:00-09:40:00,09:40:00-09:50:00,09:50:00-10:00:00,10:00:00-10:10:00,10:10:00-10:20:00,10:20:00-10:30:00,10:30:00-10:40:00,10:40:00-10:50:00,10:50:00-11:00:00,11:00:00-11:10:00,11:10:00-11:20:00,11:20:00-11:30:00,11:30:00-11:40:00,11:40:00-11:50:00,11:50:00-12:00:00,12:00:00-12:10:00,12:10:00-12:20:00,12:20:00-12:30:00,12:30:00-12:40:00,12:40:00-12:50:00,12:50:00-13:00:00,13:00:00-13:10:00,13:10:00-13:20:00,13:20:00-13:30:00,13:30:00-13:40:00,13:40:00-13:50:00,13:50:00-14:00:00,14:00:00-14:10:00,14:10:00-14:20:00,14:20:00-14:30:00,14:30:00-14:40:00,14:40:00-14:50:00,14:50:00-15:00:00,15:00:00-15:10:00,15:10:00-15:20:00,15:20:00-15:30:00,15:30:00-15:40:00,15:40:00-15:50:00,15:50:00-16:00:00,16:00:00-16:10:00,16:10:00-16:20:00,16:20:00-16:30:00,16:30:00-16:40:00,16:40:00-16:50:00,16:50:00-17:00:00,17:00:00-17:10:00,17:10:00-17:20:00,17:20:00-17:30:00,17:30:00-17:40:00,17:40:00-17:50:00,17:50:00-18:00:00,18:00:00-18:10:00,18:10:00-18:20:00,18:20:00-18:30:00,18:30:00-18:40:00,18:40:00-18:50:00,18:50:00-19:00:00,19:00:00-19:10:00,19:10:00-19:20:00,19:20:00-19:30:00,19:30:00-19:40:00,19:40:00-19:50:00,19:50:00-20:00:00,20:00:00-20:10:00,20:10:00-20:20:00,20:20:00-20:30:00,20:30:00-20:40:00,20:40:00-20:50:00,20:50:00-21:00:00,21:00:00-21:10:00,21:10:00-21:20:00,21:20:00-21:30:00,21:30:00-21:40:00,21:40:00-21:50:00,21:50:00-22:00:00,22:00:00-22:10:00,22:10:00-22:20:00,22:20:00-22:30:00,22:30:00-22:40:00,22:40:00-22:50:00,22:50:00-23:00:00', 700, 1, '<p>JK</p>', NULL, 'Active', '2022-09-30 15:15:11', '2022-09-30 15:15:11'),
(39, 4, 5, 'STYLISH HAIR COLOR OLIVER\'S', '09:00:00', '23:00:00', 60, '09:00:00-10:00:00,10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 1200, 1, '<p>STYLISH HAIR COLOR OLIVER&#39;S&nbsp;</p>', NULL, 'Active', '2022-09-30 15:17:43', '2022-09-30 15:17:43'),
(40, 4, 5, 'FASHION HAIR COLOR HIGHLIGHTS OLIVER\'S', '09:00:00', '23:00:00', 60, '09:00:00-10:00:00,10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 1200, 1, '<p>FASHION HAIR COLOR HIGHLIGHTS OLIVER&#39;S&nbsp;</p>', NULL, 'Active', '2022-09-30 15:20:41', '2022-09-30 15:20:41'),
(41, 4, 5, 'FASHION HAIR COLOR  PER STICK', '09:00:00', '23:00:00', 60, '09:00:00-10:00:00,10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 200, 1, '<p>FASHION HAIR COLOR &nbsp;PER STICK</p>', NULL, 'Active', '2022-09-30 15:23:24', '2022-09-30 15:23:24'),
(42, 5, 6, 'DANDRUFF TREATMENT ADVANCED CARE & REPAIR FOR DANDRUFF HAIR', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 700, 1, '<p>DANDRUFF TREATMENT ADVANCED CARE &amp; REPAIR FOR DANDRUFF HAIR</p>', NULL, 'Active', '2022-09-30 15:31:57', '2022-09-30 15:31:57'),
(43, 5, 6, 'HAIR SPA AROMA THERAPY FOR SMOOTH HAIR & SHINING', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 900, 1, '<p>HAIR SPA AROMA THERAPY FOR SMOOTH HAIR &amp; SHINING</p>', NULL, 'Active', '2022-09-30 15:34:13', '2022-09-30 15:34:13'),
(44, 5, 6, 'PROTIEN HAIR TREATMENT  FOR FALLEN HAIR', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 700, 1, '<p>PROTIEN HAIR TREATMENT &nbsp;FOR FALLEN HAIR</p>', NULL, 'Active', '2022-09-30 15:38:15', '2022-09-30 15:38:15'),
(45, 5, 6, 'HAIR REBONDING (4 MONTH GUARNTEE)', '09:00:00', '23:00:00', 150, '09:00:00-11:30:00,11:30:00-14:00:00,14:00:00-16:30:00,16:30:00-19:00:00,19:00:00-21:30:00,21:30:00-00:00:00,00:00:00-02:30:00,02:30:00-05:00:00,05:00:00-07:30:00,07:30:00-10:00:00,10:00:00-12:30:00,12:30:00-15:00:00,15:00:00-17:30:00,17:30:00-20:00:00,20:00:00-22:30:00,22:30:00-01:00:00,01:00:00-03:30:00,03:30:00-06:00:00,06:00:00-08:30:00,08:30:00-11:00:00,11:00:00-13:30:00,13:30:00-16:00:00,16:00:00-18:30:00,18:30:00-21:00:00,21:00:00-23:30:00', 3500, 1, '<p>HAIR REBONDING (4 MONTH GUARNTEE)</p>', NULL, 'Active', '2022-09-30 15:43:57', '2022-09-30 15:45:15'),
(46, 5, 6, 'HAIR VOLUME', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 500, 1, '<p>HAIR VOLUME</p>', NULL, 'Active', '2022-09-30 15:54:59', '2022-09-30 15:54:59'),
(47, 5, 6, 'HAIR SHINING & HAIR TREATMENT', '09:00:00', '23:00:00', 60, '09:00:00-10:00:00,10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 1200, 1, '<p>HAIR SHINING &amp; HAIR TREATMENT</p>', NULL, 'Active', '2022-09-30 15:58:47', '2022-09-30 15:58:47'),
(48, 5, 6, 'HAIR OIL MASSAGE WITH STEAM OZON & HERBAL SHAMPOO WASH', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 500, 1, '<p>HAIR OIL MASSAGE WITH STEAM OZON &amp; HERBAL SHAMPOO WASH</p>', NULL, 'Active', '2022-09-30 16:05:38', '2022-09-30 16:05:38'),
(49, 5, 6, 'HOT OIL THERAPY FOR REFRESHING HAIR & SHAMPOO', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 500, 1, '<p>HOT OIL THERAPY FOR REFRESHING HAIR &amp; SHAMPOO</p>', NULL, 'Active', '2022-09-30 16:07:00', '2022-09-30 16:07:00'),
(50, 6, 7, 'FACE FAIR POLISH', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 400, 1, '<p>FACE FAIR POLISH</p>', NULL, 'Active', '2022-09-30 16:12:55', '2022-09-30 16:12:55'),
(51, 6, 7, 'NECK FAIR POLISH', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 400, 1, '<p>NECK FAIR POLISH</p>', NULL, 'Active', '2022-09-30 16:16:43', '2022-09-30 16:16:43'),
(52, 6, 7, 'FACE NECK FAIR POLISH', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 700, 1, '<p>FACE NECK FAIR POLISH</p>', NULL, 'Active', '2022-09-30 16:20:52', '2022-09-30 16:22:27'),
(53, 6, 7, 'FACE NECK & HAND FAIR POLISH', '09:00:00', '23:00:00', 60, '09:00:00-10:00:00,10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 1000, 1, '<p>FACE NECK &amp; HAND FAIR POLISH</p>', NULL, 'Active', '2022-09-30 16:23:50', '2022-09-30 16:23:50'),
(54, 6, 7, 'HAND FAIR POLISH', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 700, 1, '<p>HAND FAIR POLISH</p>', NULL, 'Active', '2022-09-30 16:26:15', '2022-09-30 16:26:15'),
(55, 6, 7, 'LER FAIR POLISH', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 800, 1, '<p>LER FAIR POLISH</p>', NULL, 'Active', '2022-09-30 16:28:29', '2022-09-30 16:28:29'),
(56, 6, 7, 'SPECIAL FAIR POLISH FOR FACE', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 700, 1, '<p>SPECIAL FAIR POLISH FOR FACE</p>', NULL, 'Active', '2022-09-30 16:31:12', '2022-09-30 16:31:12'),
(57, 6, 7, 'PARTY MAKEUP(START 1000 BDT)', '09:00:00', '23:00:00', 120, '09:00:00-11:00:00,11:00:00-13:00:00,13:00:00-15:00:00,15:00:00-17:00:00,17:00:00-19:00:00,19:00:00-21:00:00,21:00:00-23:00:00', 2000, 1, '<p>PARTY MAKEUP(START 1000 BDT)</p>', NULL, 'Active', '2022-09-30 17:05:45', '2022-09-30 17:05:45'),
(58, 6, 7, 'GROOMING MAKEUP PACKAGE', '09:00:00', '23:00:00', 120, '09:00:00-11:00:00,11:00:00-13:00:00,13:00:00-15:00:00,15:00:00-17:00:00,17:00:00-19:00:00,19:00:00-21:00:00,21:00:00-23:00:00', 3000, 1, '<p>GROOMING MAKEUP PACKAGE</p>', NULL, 'Active', '2022-09-30 17:08:39', '2022-09-30 17:08:39'),
(59, 6, 7, 'NATURAL MAKEUP', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 600, 1, '<p>NATURAL MAKEUP&nbsp;</p>', NULL, 'Active', '2022-09-30 17:09:34', '2022-09-30 17:09:34'),
(60, 7, 8, 'HEAD MASSAGE 20 MIN', '09:00:00', '23:00:00', 20, '09:00:00-09:20:00,09:20:00-09:40:00,09:40:00-10:00:00,10:00:00-10:20:00,10:20:00-10:40:00,10:40:00-11:00:00,11:00:00-11:20:00,11:20:00-11:40:00,11:40:00-12:00:00,12:00:00-12:20:00,12:20:00-12:40:00,12:40:00-13:00:00,13:00:00-13:20:00,13:20:00-13:40:00,13:40:00-14:00:00,14:00:00-14:20:00,14:20:00-14:40:00,14:40:00-15:00:00,15:00:00-15:20:00,15:20:00-15:40:00,15:40:00-16:00:00,16:00:00-16:20:00,16:20:00-16:40:00,16:40:00-17:00:00,17:00:00-17:20:00,17:20:00-17:40:00,17:40:00-18:00:00,18:00:00-18:20:00,18:20:00-18:40:00,18:40:00-19:00:00,19:00:00-19:20:00,19:20:00-19:40:00,19:40:00-20:00:00,20:00:00-20:20:00,20:20:00-20:40:00,20:40:00-21:00:00,21:00:00-21:20:00,21:20:00-21:40:00,21:40:00-22:00:00,22:00:00-22:20:00,22:20:00-22:40:00,22:40:00-23:00:00', 200, 1, '<p>HEAD MASSAGE 20 MIN</p>', NULL, 'Active', '2022-09-30 17:11:26', '2022-09-30 17:11:26'),
(61, 7, 8, 'FULL BODY MASSAGE 1 HOUR', '09:00:00', '23:00:00', 60, '09:00:00-10:00:00,10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 500, 1, '<p>FULL BODY MASSAGE 1 HOUR</p>', NULL, 'Active', '2022-09-30 17:16:14', '2022-09-30 17:16:14'),
(62, 7, 8, 'FOOT MASSAGE', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 300, 1, '<p>FOOT MASSAGE&nbsp;</p>', NULL, 'Active', '2022-09-30 17:17:54', '2022-09-30 17:17:54'),
(63, 7, 8, 'PEDICURE', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 450, 1, '<p>PEDICURE</p>', NULL, 'Active', '2022-09-30 17:19:47', '2022-09-30 17:19:47'),
(64, 7, 8, 'MENICURE', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 300, 1, '<p>MENICURE</p>', NULL, 'Active', '2022-09-30 17:22:40', '2022-09-30 17:22:40'),
(65, 7, 8, 'PEDICURE & MENICURE', '09:00:00', '23:00:00', 60, '09:00:00-10:00:00,10:00:00-11:00:00,11:00:00-12:00:00,12:00:00-13:00:00,13:00:00-14:00:00,14:00:00-15:00:00,15:00:00-16:00:00,16:00:00-17:00:00,17:00:00-18:00:00,18:00:00-19:00:00,19:00:00-20:00:00,20:00:00-21:00:00,21:00:00-22:00:00,22:00:00-23:00:00', 700, 1, '<p>PEDICURE &amp; MENICURE</p>', NULL, 'Active', '2022-09-30 17:25:10', '2022-09-30 17:25:10'),
(66, 7, 8, 'ONLY NAIL SHINING', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 200, 1, '<p>ONLY NAIL SHINING</p>', NULL, 'Active', '2022-09-30 17:30:58', '2022-09-30 17:30:58'),
(67, 7, 8, 'THREADING', '09:00:00', '23:00:00', 20, '09:00:00-09:20:00,09:20:00-09:40:00,09:40:00-10:00:00,10:00:00-10:20:00,10:20:00-10:40:00,10:40:00-11:00:00,11:00:00-11:20:00,11:20:00-11:40:00,11:40:00-12:00:00,12:00:00-12:20:00,12:20:00-12:40:00,12:40:00-13:00:00,13:00:00-13:20:00,13:20:00-13:40:00,13:40:00-14:00:00,14:00:00-14:20:00,14:20:00-14:40:00,14:40:00-15:00:00,15:00:00-15:20:00,15:20:00-15:40:00,15:40:00-16:00:00,16:00:00-16:20:00,16:20:00-16:40:00,16:40:00-17:00:00,17:00:00-17:20:00,17:20:00-17:40:00,17:40:00-18:00:00,18:00:00-18:20:00,18:20:00-18:40:00,18:40:00-19:00:00,19:00:00-19:20:00,19:20:00-19:40:00,19:40:00-20:00:00,20:00:00-20:20:00,20:20:00-20:40:00,20:40:00-21:00:00,21:00:00-21:20:00,21:20:00-21:40:00,21:40:00-22:00:00,22:00:00-22:20:00,22:20:00-22:40:00,22:40:00-23:00:00', 100, 1, '<p>THREADING</p>', NULL, 'Active', '2022-09-30 17:32:22', '2022-09-30 17:32:22'),
(68, 7, 8, 'BACK MASSAGE 30 MIN', '09:00:00', '23:00:00', 30, '09:00:00-09:30:00,09:30:00-10:00:00,10:00:00-10:30:00,10:30:00-11:00:00,11:00:00-11:30:00,11:30:00-12:00:00,12:00:00-12:30:00,12:30:00-13:00:00,13:00:00-13:30:00,13:30:00-14:00:00,14:00:00-14:30:00,14:30:00-15:00:00,15:00:00-15:30:00,15:30:00-16:00:00,16:00:00-16:30:00,16:30:00-17:00:00,17:00:00-17:30:00,17:30:00-18:00:00,18:00:00-18:30:00,18:30:00-19:00:00,19:00:00-19:30:00,19:30:00-20:00:00,20:00:00-20:30:00,20:30:00-21:00:00,21:00:00-21:30:00,21:30:00-22:00:00,22:00:00-22:30:00,22:30:00-23:00:00', 300, 1, '<p>BACK MASSAGE 30 MIN</p>', 'public/uploads/salom service/ppUqz53czizd2Y2oPIRKTvM8syQDskoI7mtrzUkYhN88tAHzLq64126ad9-5a2a-4bf0-9653-b84d5e24230b.jpg', 'Active', '2022-09-30 17:33:09', '2022-11-12 17:27:45'),
(69, 1, 1, 'Test', '10:00:00', '22:11:00', 55, '10:00:00-10:55:00,10:55:00-11:50:00,11:50:00-12:45:00,12:45:00-13:40:00,13:40:00-14:35:00,14:35:00-15:30:00,15:30:00-16:25:00,16:25:00-17:20:00,17:20:00-18:15:00,18:15:00-19:10:00,19:10:00-20:05:00,20:05:00-21:00:00,21:00:00-21:55:00,21:55:00-22:50:00', 160, 1, '<p>ASDFGH</p>', 'public/uploads/salom service/7sQVf0ul3FCoVlSuiS4g6rMMJgOfSp62mXCt5FAcSC1lJ42J9c16142843_1092471107546656_9209124065111941633_n.jpg', 'Active', '2022-10-22 11:43:13', '2022-10-22 11:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `salon_service_costs`
--

CREATE TABLE `salon_service_costs` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1:active,0:inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon_service_costs`
--

INSERT INTO `salon_service_costs` (`id`, `service_id`, `item_id`, `branch_id`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 2, 3, 1, '2022-09-20 21:11:18', '2022-09-20 21:53:43'),
(2, 3, 1, 2, 2, 0, '2022-09-20 21:11:18', '2022-09-20 21:53:43'),
(3, 3, 1, 2, 2, 0, '2022-09-20 21:41:16', '2022-09-20 21:53:43'),
(4, 3, 1, 2, 1, 1, '2022-09-26 11:29:48', '2022-09-26 11:29:48'),
(5, 4, 1, 2, 1, 1, '2022-09-26 11:36:37', '2022-09-26 11:36:37'),
(6, 5, 1, 2, 1, 1, '2022-09-26 11:38:20', '2022-09-26 11:38:20'),
(7, 6, 1, 2, 1, 1, '2022-09-26 11:39:19', '2022-09-26 11:39:19'),
(8, 7, 1, 2, 1, 1, '2022-09-26 11:40:59', '2022-09-26 11:40:59'),
(9, 8, 1, 2, 1, 1, '2022-09-26 11:42:22', '2022-09-26 11:42:22'),
(10, 9, 1, 2, 1, 1, '2022-09-26 11:45:08', '2022-09-26 11:45:08'),
(11, 10, 1, 2, 1, 1, '2022-09-26 11:46:32', '2022-09-26 11:46:32'),
(12, 11, 1, 2, 1, 1, '2022-09-26 11:48:01', '2022-09-26 11:48:01'),
(13, 12, 1, 2, 1, 1, '2022-09-29 13:09:27', '2022-09-29 13:09:27'),
(14, 13, 1, 2, 1, 1, '2022-09-29 13:10:47', '2022-09-29 13:10:47'),
(15, 14, 1, 2, 1, 1, '2022-09-29 13:12:18', '2022-09-29 13:12:18'),
(16, 15, 1, 2, 1, 1, '2022-09-29 17:57:24', '2022-09-29 17:57:24'),
(17, 16, 1, 2, 1, 1, '2022-09-29 17:58:47', '2022-09-29 17:58:47'),
(18, 17, 1, 2, 1, 1, '2022-09-29 18:15:01', '2022-09-29 18:15:01'),
(19, 18, 1, 2, 1, 1, '2022-09-29 18:16:11', '2022-09-29 18:16:11'),
(20, 19, 1, 2, 1, 1, '2022-09-29 18:17:48', '2022-09-29 18:17:48'),
(21, 20, 1, 2, 1, 1, '2022-09-29 18:20:17', '2022-09-29 18:20:17'),
(22, 21, 1, 2, 1, 1, '2022-09-29 18:21:26', '2022-09-29 18:21:26'),
(23, 22, 1, 2, 1, 1, '2022-09-29 18:22:55', '2022-09-29 18:22:55'),
(24, 23, 1, 2, 1, 1, '2022-09-29 18:23:57', '2022-09-29 18:23:57'),
(25, 24, 1, 2, 1, 1, '2022-09-29 18:25:24', '2022-09-29 18:25:24'),
(26, 25, 1, 2, 1, 1, '2022-09-30 13:49:20', '2022-09-30 13:49:20'),
(27, 26, 1, 2, 1, 1, '2022-09-30 13:51:19', '2022-09-30 13:51:19'),
(28, 27, 1, 2, 1, 1, '2022-09-30 13:53:48', '2022-09-30 13:53:48'),
(29, 28, 1, 2, 1, 1, '2022-09-30 13:56:42', '2022-09-30 13:56:42'),
(30, 29, 1, 2, 1, 1, '2022-09-30 13:58:48', '2022-09-30 13:58:48'),
(31, 30, 1, 2, 1, 1, '2022-09-30 14:00:12', '2022-09-30 14:00:12'),
(32, 31, 1, 2, 1, 1, '2022-09-30 14:37:49', '2022-09-30 14:37:49'),
(33, 32, 1, 2, 1, 1, '2022-09-30 14:38:48', '2022-09-30 14:38:48'),
(34, 33, 1, 2, 1, 1, '2022-09-30 14:42:37', '2022-09-30 14:42:37'),
(35, 34, 1, 2, 1, 1, '2022-09-30 14:48:44', '2022-09-30 14:48:44'),
(36, 35, 1, 2, 1, 1, '2022-09-30 15:09:08', '2022-09-30 15:09:08'),
(37, 36, 1, 2, 1, 1, '2022-09-30 15:11:20', '2022-09-30 15:11:20'),
(38, 37, 1, 2, 1, 1, '2022-09-30 15:13:06', '2022-09-30 15:13:06'),
(39, 38, 1, 2, 1, 1, '2022-09-30 15:15:11', '2022-09-30 15:15:11'),
(40, 39, 1, 2, 1, 1, '2022-09-30 15:17:43', '2022-09-30 15:17:43'),
(41, 40, 1, 2, 1, 1, '2022-09-30 15:20:41', '2022-09-30 15:20:41'),
(42, 41, 1, 2, 1, 1, '2022-09-30 15:23:24', '2022-09-30 15:23:24'),
(43, 42, 1, 2, 1, 1, '2022-09-30 15:31:57', '2022-09-30 15:31:57'),
(44, 43, 1, 2, 1, 1, '2022-09-30 15:34:13', '2022-09-30 15:34:13'),
(45, 44, 1, 2, 1, 1, '2022-09-30 15:38:15', '2022-09-30 15:38:15'),
(46, 45, 1, 2, 1, 1, '2022-09-30 15:43:57', '2022-09-30 15:45:15'),
(47, 46, 1, 2, 1, 1, '2022-09-30 15:54:59', '2022-09-30 15:54:59'),
(48, 47, 1, 2, 1, 1, '2022-09-30 15:58:47', '2022-09-30 15:58:47'),
(49, 48, 1, 2, 1, 1, '2022-09-30 16:05:38', '2022-09-30 16:05:38'),
(50, 49, 1, 2, 1, 1, '2022-09-30 16:07:00', '2022-09-30 16:07:00'),
(51, 50, 1, 2, 1, 1, '2022-09-30 16:12:55', '2022-09-30 16:12:55'),
(52, 51, 1, 2, 1, 1, '2022-09-30 16:16:43', '2022-09-30 16:16:43'),
(53, 52, 1, 2, 1, 1, '2022-09-30 16:20:52', '2022-09-30 16:22:27'),
(54, 53, 1, 2, 1, 1, '2022-09-30 16:23:50', '2022-09-30 16:23:50'),
(55, 54, 1, 2, 1, 1, '2022-09-30 16:26:15', '2022-09-30 16:26:15'),
(56, 55, 1, 2, 1, 1, '2022-09-30 16:28:29', '2022-09-30 16:28:29'),
(57, 56, 1, 2, 1, 1, '2022-09-30 16:31:12', '2022-09-30 16:31:12'),
(58, 57, 1, 2, 1, 1, '2022-09-30 17:05:45', '2022-09-30 17:05:45'),
(59, 58, 1, 2, 1, 1, '2022-09-30 17:08:39', '2022-09-30 17:08:39'),
(60, 59, 1, 2, 1, 1, '2022-09-30 17:09:34', '2022-09-30 17:09:34'),
(61, 60, 1, 2, 1, 1, '2022-09-30 17:11:26', '2022-09-30 17:11:26'),
(62, 61, 1, 2, 1, 1, '2022-09-30 17:16:14', '2022-09-30 17:16:14'),
(63, 62, 1, 2, 1, 1, '2022-09-30 17:17:54', '2022-09-30 17:17:54'),
(64, 63, 1, 2, 1, 1, '2022-09-30 17:19:47', '2022-09-30 17:19:47'),
(65, 64, 1, 2, 1, 1, '2022-09-30 17:22:40', '2022-09-30 17:22:40'),
(66, 65, 1, 2, 1, 1, '2022-09-30 17:25:10', '2022-09-30 17:25:10'),
(67, 66, 1, 2, 1, 1, '2022-09-30 17:30:58', '2022-09-30 17:30:58'),
(68, 67, 1, 2, 1, 1, '2022-09-30 17:32:22', '2022-09-30 17:32:22'),
(69, 68, 1, 2, 1, 1, '2022-09-30 17:33:09', '2022-11-12 17:27:45'),
(70, 69, 1, 2, 10, 1, '2022-10-22 11:43:13', '2022-10-22 11:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `salon_transactions`
--

CREATE TABLE `salon_transactions` (
  `id` int(11) NOT NULL,
  `transaction_type` int(11) NOT NULL,
  `account_head_id` int(11) NOT NULL,
  `amount` double(20,2) NOT NULL,
  `in_out` tinyint(1) NOT NULL COMMENT '1:in,2:out',
  `status` tinyint(1) NOT NULL COMMENT '1:active,0:inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `ref_table_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL COMMENT 'income and expense (by mf for income add and etc) ',
  `comment` varchar(20) DEFAULT NULL COMMENT 'income or expense etc. '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon_transactions`
--

INSERT INTO `salon_transactions` (`id`, `transaction_type`, `account_head_id`, `amount`, `in_out`, `status`, `created_at`, `updated_at`, `ref_table_id`, `quantity`, `comment`) VALUES
(1, 2, 2, 150.00, 2, 1, '2022-09-14 17:22:16', '2022-09-14 17:22:16', 1, NULL, NULL),
(2, 3, 1, 15.00, 1, 1, '2022-09-14 17:22:16', '2022-09-14 17:22:16', 1, NULL, NULL),
(3, 2, 3, 150.00, 2, 1, '2022-09-14 18:00:46', '2022-09-14 18:00:46', 2, NULL, NULL),
(4, 3, 1, 15.00, 1, 1, '2022-09-14 18:00:46', '2022-09-14 18:00:46', 2, NULL, NULL),
(5, 3, 1, 20.00, 1, 1, '2022-09-24 15:43:57', '2022-09-24 15:43:57', 6, NULL, NULL),
(6, 3, 1, 15.00, 1, 1, '2022-09-24 15:43:57', '2022-09-24 15:43:57', 7, NULL, NULL),
(7, 3, 1, 20.00, 1, 1, '2022-09-25 11:55:34', '2022-09-25 11:55:34', 8, NULL, NULL),
(8, 3, 1, 15.00, 1, 1, '2022-09-25 11:55:34', '2022-09-25 11:55:34', 9, NULL, NULL),
(9, 2, 6, 300.00, 2, 1, '2022-10-03 20:08:33', '2022-10-03 20:08:33', 10, NULL, NULL),
(10, 2, 2, 300.00, 2, 1, '2022-10-03 21:06:58', '2022-10-03 21:06:58', 11, NULL, NULL),
(11, 3, 1, 120.00, 1, 1, '2022-10-03 21:06:58', '2022-10-03 21:06:58', 16, NULL, NULL),
(12, 2, 2, 200.00, 2, 1, '2022-10-06 11:51:11', '2022-10-06 11:51:11', 13, NULL, NULL),
(13, 2, 2, 300.00, 2, 1, '2022-10-06 12:14:05', '2022-10-06 12:14:05', 14, NULL, NULL),
(14, 3, 1, 120.00, 1, 1, '2022-10-06 16:10:02', '2022-10-06 16:10:02', 21, NULL, NULL),
(15, 3, 8, 120.00, 1, 1, '2022-10-06 18:22:03', '2022-10-06 18:22:03', 23, NULL, NULL),
(16, 3, 1, 40.00, 1, 1, '2022-10-09 15:22:35', '2022-10-09 15:22:35', 24, NULL, NULL),
(17, 3, 1, 88.00, 1, 1, '2022-10-09 15:22:35', '2022-10-09 15:22:35', 25, NULL, NULL),
(18, 3, 1, 400.00, 1, 1, '2022-10-09 15:22:35', '2022-10-09 15:22:35', 26, NULL, NULL),
(19, 3, 1, 480.00, 1, 1, '2022-10-09 15:22:35', '2022-10-09 15:22:35', 27, NULL, NULL),
(20, 2, 9, 150.00, 2, 1, '2022-10-09 15:30:13', '2022-10-09 15:30:13', 4, NULL, NULL),
(21, 3, 8, 60.00, 1, 1, '2022-10-09 15:30:13', '2022-10-09 15:30:13', 4, NULL, NULL),
(22, 2, 2, 300.00, 2, 1, '2022-10-25 13:30:12', '2022-10-25 13:30:12', 20, NULL, NULL),
(23, 3, 1, 60.00, 1, 1, '2022-10-25 13:30:12', '2022-10-25 13:30:12', 30, NULL, NULL),
(24, 3, 8, 60.00, 1, 1, '2022-10-25 13:30:12', '2022-10-25 13:30:12', 31, NULL, NULL),
(25, 3, 1, 1000.00, 2, 1, '2022-10-26 11:26:06', '2022-10-26 11:26:06', NULL, NULL, NULL),
(26, 3, 8, 200.00, 2, 1, '2022-10-26 11:29:08', '2022-10-26 11:29:08', NULL, NULL, NULL),
(27, 3, 8, 20.00, 2, 1, '2022-10-26 11:29:26', '2022-10-26 11:29:26', NULL, NULL, NULL),
(28, 3, 1, 80.00, 1, 1, '2022-10-26 12:03:34', '2022-10-26 12:03:34', 32, NULL, NULL),
(29, 3, 1, 180.00, 1, 1, '2022-10-26 12:29:39', '2022-10-26 12:29:39', 35, NULL, NULL),
(30, 1, 16, 100.00, 1, 1, '2022-11-05 11:51:10', '2022-11-05 11:51:10', 1, 1, 'Salon Income'),
(31, 1, 16, 50.00, 1, 1, '2022-11-05 11:51:10', '2022-11-05 11:51:10', 1, 10, 'Salon Income'),
(34, 1, 17, 10000.00, 2, 1, '2022-11-05 12:30:54', '2022-11-05 12:30:54', 3, 10, 'Salon Expanse'),
(35, 1, 17, 5000.00, 2, 1, '2022-11-05 12:30:54', '2022-11-05 12:30:54', 3, 5, 'Salon Expanse'),
(36, 3, 1, 100.00, 2, 1, '2022-11-07 13:53:12', '2022-11-07 13:53:12', NULL, NULL, NULL),
(37, 3, 8, 5.00, 2, 1, '2022-11-07 13:53:12', '2022-11-07 13:53:12', NULL, NULL, NULL),
(38, 3, 1, 68.00, 2, 1, '2022-11-07 13:55:23', '2022-11-07 13:55:23', NULL, NULL, NULL),
(39, 3, 8, 5.00, 2, 1, '2022-11-07 13:55:23', '2022-11-07 13:55:23', NULL, NULL, NULL),
(40, 5, 1, 500.00, 2, 1, '2022-11-08 18:31:55', '2022-11-08 18:31:55', NULL, NULL, 'Salon Advance'),
(41, 5, 8, 1000.00, 2, 1, '2022-11-08 18:31:55', '2022-11-08 18:31:55', NULL, NULL, 'Salon Advance'),
(44, 5, 1, 50.00, 2, 1, '2022-11-08 12:00:00', '2022-11-08 18:34:08', NULL, NULL, 'Salon Advance'),
(45, 5, 8, 50.00, 2, 1, '2022-11-08 12:00:00', '2022-11-08 18:34:08', NULL, NULL, 'Salon Advance'),
(46, 5, 1, 50.00, 2, 1, '2022-11-20 12:00:00', '2022-11-08 18:38:57', NULL, NULL, 'Salon Advance'),
(47, 5, 8, 50.00, 2, 1, '2022-11-20 12:00:00', '2022-11-08 18:38:57', NULL, NULL, 'Salon Advance'),
(48, 2, 6, 150.00, 2, 1, '2022-11-09 15:27:21', '2022-11-09 15:27:21', 25, NULL, NULL),
(49, 3, 1, 60.00, 1, 1, '2022-11-09 15:27:21', '2022-11-09 15:27:21', 36, NULL, NULL),
(50, 2, 3, 200.00, 2, 1, '2022-11-09 15:28:12', '2022-11-09 15:28:12', 26, NULL, NULL),
(51, 3, 8, 80.00, 1, 1, '2022-11-09 15:28:12', '2022-11-09 15:28:12', 37, NULL, NULL),
(52, 2, 2, 150.00, 2, 1, '2022-11-12 13:56:26', '2022-11-12 13:56:26', 1, NULL, NULL),
(53, 3, 1, 60.00, 1, 1, '2022-11-12 13:56:26', '2022-11-12 13:56:26', 1, NULL, NULL),
(54, 3, 8, 80.00, 1, 1, '2022-11-12 14:25:24', '2022-11-12 14:25:24', 46, NULL, NULL),
(55, 3, 8, 200.00, 1, 1, '2022-11-12 14:25:24', '2022-11-12 14:25:24', 47, NULL, NULL),
(56, 3, 8, 80.00, 1, 1, '2022-11-12 14:25:24', '2022-11-12 14:25:24', 48, NULL, NULL),
(57, 3, 8, 80.00, 1, 1, '2022-11-12 14:25:24', '2022-11-12 14:25:24', 49, NULL, NULL),
(58, 3, 1, 40.00, 1, 1, '2022-11-12 14:27:49', '2022-11-12 14:27:49', 38, NULL, NULL),
(59, 3, 1, 280.00, 1, 1, '2022-11-12 14:27:50', '2022-11-12 14:27:50', 39, NULL, NULL),
(60, 3, 1, 80.00, 1, 1, '2022-11-12 14:27:50', '2022-11-12 14:27:50', 40, NULL, NULL),
(61, 3, 1, 20.00, 2, 1, '2022-11-12 14:46:38', '2022-11-12 14:46:38', NULL, NULL, NULL),
(62, 5, 1, 450.00, 2, 1, '2022-11-12 12:00:00', '2022-11-12 14:49:02', NULL, NULL, 'Salon Advance'),
(63, 5, 1, 50.00, 2, 1, '2022-11-12 12:00:00', '2022-11-12 14:50:11', NULL, NULL, 'Salon Advance'),
(64, 5, 1, 50.00, 2, 1, '2022-11-12 12:00:00', '2022-11-12 14:50:17', NULL, NULL, 'Salon Advance'),
(65, 5, 1, 100.00, 2, 1, '2022-11-12 12:00:00', '2022-11-12 14:50:45', NULL, NULL, 'Salon Advance'),
(66, 5, 1, 100.00, 2, 1, '2022-11-12 12:00:00', '2022-11-12 14:51:00', NULL, NULL, 'Salon Advance'),
(67, 3, 1, 100.00, 2, 1, '2022-11-12 14:52:39', '2022-11-12 14:52:39', NULL, NULL, NULL),
(68, 1, 18, 100.00, 2, 1, '2022-11-12 15:07:05', '2022-11-12 15:07:05', 4, 4, 'Salon Expanse'),
(69, 3, 1, 900.00, 2, 1, '2022-11-12 15:12:52', '2022-11-12 15:12:52', NULL, NULL, NULL),
(70, 3, 8, 530.00, 2, 1, '2022-11-12 15:12:52', '2022-11-12 15:12:52', NULL, NULL, NULL),
(71, 5, 8, 500.00, 2, 1, '2022-11-12 12:00:00', '2022-11-12 16:02:05', NULL, NULL, 'Salon Advance'),
(72, 5, 8, 500.00, 2, 1, '2022-11-12 12:00:00', '2022-11-12 16:02:17', NULL, NULL, 'Salon Advance'),
(73, 5, 8, 1000.00, 2, 1, '2022-11-12 12:00:00', '2022-11-12 16:02:42', NULL, NULL, 'Salon Advance'),
(74, 5, 8, 500.00, 2, 1, '2022-11-12 12:00:00', '2022-11-12 16:48:00', NULL, NULL, 'Salon Advance'),
(75, 5, 1, 100.00, 2, 1, '2022-11-12 12:00:00', '2022-11-12 18:05:07', NULL, NULL, 'Salon Advance'),
(76, 5, 1, 100.00, 2, 1, '2022-11-12 12:00:00', '2022-11-12 18:08:39', NULL, NULL, 'Salon Advance'),
(77, 5, 1, 100.00, 2, 1, '2022-11-13 12:00:00', '2022-11-13 11:12:09', NULL, NULL, 'Salon Advance'),
(78, 5, 8, 50.00, 2, 1, '2022-11-13 12:00:00', '2022-11-13 11:12:09', NULL, NULL, 'Salon Advance'),
(79, 5, 1, 100.00, 2, 1, '2022-11-13 12:00:00', '2022-11-13 11:13:15', NULL, NULL, 'Salon Advance'),
(80, 5, 1, 300.00, 2, 1, '2022-11-13 12:00:00', '2022-11-13 11:15:30', NULL, NULL, 'Salon Advance'),
(81, 5, 8, 400.00, 2, 1, '2022-11-13 12:00:00', '2022-11-13 11:15:30', NULL, NULL, 'Salon Advance'),
(82, 5, 1, 500.00, 2, 1, '2022-11-13 12:00:00', '2022-11-13 11:17:48', NULL, NULL, 'Salon Advance'),
(83, 5, 8, 4000.00, 2, 1, '2022-11-13 12:00:00', '2022-11-13 11:17:48', NULL, NULL, 'Salon Advance'),
(84, 3, 1, 40.00, 1, 1, '2022-11-13 11:36:13', '2022-11-13 11:36:13', 56, NULL, NULL),
(85, 3, 1, 80.00, 1, 1, '2022-11-13 11:36:13', '2022-11-13 11:36:13', 57, NULL, NULL),
(86, 3, 1, 920.00, 1, 1, '2022-11-13 11:36:13', '2022-11-13 11:36:13', 58, NULL, NULL),
(87, 3, 1, 1100.00, 2, 1, '2022-11-13 11:37:04', '2022-11-13 11:37:04', NULL, NULL, NULL),
(88, 3, 1, 500.00, 2, 1, '2022-11-13 11:37:39', '2022-11-13 11:37:39', NULL, NULL, NULL),
(89, 3, 1, 45.00, 2, 1, '2022-11-13 11:40:44', '2022-11-13 11:40:44', NULL, NULL, NULL),
(90, 2, 23, 350.00, 2, 1, '2022-11-13 11:53:56', '2022-11-13 11:53:56', 37, NULL, NULL),
(91, 3, 8, 60.00, 1, 1, '2022-11-13 11:53:56', '2022-11-13 11:53:56', 59, NULL, NULL),
(92, 3, 8, 80.00, 1, 1, '2022-11-13 11:53:56', '2022-11-13 11:53:56', 60, NULL, NULL),
(93, 2, 24, 720.00, 2, 1, '2022-11-13 12:08:48', '2022-11-13 12:08:48', 38, NULL, NULL),
(94, 3, 1, 60.00, 1, 1, '2022-11-13 12:08:48', '2022-11-13 12:08:48', 61, NULL, NULL),
(95, 3, 1, 80.00, 1, 1, '2022-11-13 12:08:48', '2022-11-13 12:08:48', 62, NULL, NULL),
(96, 3, 1, 60.00, 1, 1, '2022-11-13 12:08:48', '2022-11-13 12:08:48', 63, NULL, NULL),
(97, 3, 1, 88.00, 1, 1, '2022-11-13 12:08:48', '2022-11-13 12:08:48', 64, NULL, NULL),
(98, 3, 1, 40.00, 1, 1, '2022-11-13 12:14:57', '2022-11-13 12:14:57', 65, NULL, NULL),
(99, 3, 1, 280.00, 1, 1, '2022-11-13 12:14:57', '2022-11-13 12:14:57', 66, NULL, NULL),
(100, 3, 1, 80.00, 1, 1, '2022-11-13 12:16:51', '2022-11-13 12:16:51', 69, NULL, NULL),
(101, 3, 1, 120.00, 1, 1, '2022-11-13 12:16:51', '2022-11-13 12:16:51', 70, NULL, NULL),
(102, 3, 8, 40.00, 2, 1, '2022-11-13 13:46:42', '2022-11-13 13:46:42', NULL, NULL, NULL),
(103, 3, 1, 3.00, 2, 1, '2022-11-13 13:47:42', '2022-11-13 13:47:42', NULL, NULL, NULL),
(104, 3, 8, 50.00, 2, 1, '2022-11-13 13:47:42', '2022-11-13 13:47:42', NULL, NULL, NULL),
(105, 2, 24, 250.00, 2, 1, '2022-11-13 13:51:19', '2022-11-13 13:51:19', 42, NULL, NULL),
(106, 3, 1, 60.00, 1, 1, '2022-11-13 13:51:19', '2022-11-13 13:51:19', 71, NULL, NULL),
(107, 3, 1, 40.00, 1, 1, '2022-11-13 13:51:19', '2022-11-13 13:51:19', 72, NULL, NULL),
(108, 5, 1, 500.00, 2, 1, '2022-11-13 12:00:00', '2022-11-13 13:52:59', NULL, NULL, 'Salon Advance'),
(109, 5, 8, 500.00, 2, 1, '2022-11-13 12:00:00', '2022-11-13 13:52:59', NULL, NULL, 'Salon Advance'),
(110, 3, 8, 50.00, 2, 1, '2022-11-13 13:54:04', '2022-11-13 13:54:04', NULL, NULL, NULL),
(111, 2, 24, 950.00, 2, 1, '2022-11-13 15:29:11', '2022-11-13 15:29:11', 44, NULL, NULL),
(112, 3, 1, 200.00, 1, 1, '2022-11-13 15:29:11', '2022-11-13 15:29:11', 77, NULL, NULL),
(113, 3, 1, 80.00, 1, 1, '2022-11-13 15:29:11', '2022-11-13 15:29:11', 78, NULL, NULL),
(114, 3, 1, 60.00, 1, 1, '2022-11-13 15:29:11', '2022-11-13 15:29:11', 79, NULL, NULL),
(115, 3, 1, 40.00, 1, 1, '2022-11-13 15:29:12', '2022-11-13 15:29:12', 80, NULL, NULL),
(116, 2, 24, 150.00, 2, 1, '2022-11-13 16:24:27', '2022-11-13 16:24:27', 45, NULL, NULL),
(117, 3, 1, 60.00, 1, 1, '2022-11-13 16:24:27', '2022-11-13 16:24:27', 81, NULL, NULL),
(118, 3, 1, 740.00, 2, 1, '2022-11-13 16:26:42', '2022-11-13 16:26:42', NULL, NULL, NULL),
(119, 3, 1, 200.00, 2, 1, '2022-11-13 16:27:01', '2022-11-13 16:27:01', NULL, NULL, NULL),
(120, 5, 8, 100.00, 2, 1, '2022-11-13 12:00:00', '2022-11-13 16:30:10', NULL, NULL, 'Salon Advance'),
(121, 2, 23, 75.00, 2, 1, '2022-11-13 19:09:46', '2022-11-13 19:09:46', 46, NULL, NULL),
(122, 3, 1, 30.00, 1, 1, '2022-11-13 19:09:46', '2022-11-13 19:09:46', 82, NULL, NULL),
(123, 2, 23, 75.00, 2, 1, '2022-11-13 19:11:32', '2022-11-13 19:11:32', 47, NULL, NULL),
(124, 3, 1, 30.00, 1, 1, '2022-11-13 19:11:32', '2022-11-13 19:11:32', 83, NULL, NULL),
(125, 2, 23, 760.00, 2, 1, '2022-11-13 19:14:40', '2022-11-13 19:14:40', 48, NULL, NULL),
(126, 3, 1, 64.00, 1, 1, '2022-11-13 19:14:40', '2022-11-13 19:14:40', 84, NULL, NULL),
(127, 3, 1, 120.00, 1, 1, '2022-11-13 19:14:40', '2022-11-13 19:14:40', 85, NULL, NULL),
(128, 3, 1, 40.00, 1, 1, '2022-11-13 19:14:40', '2022-11-13 19:14:40', 86, NULL, NULL),
(129, 3, 1, 80.00, 1, 1, '2022-11-13 19:14:40', '2022-11-13 19:14:40', 87, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salon_transection_infos`
--

CREATE TABLE `salon_transection_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issue_date` date DEFAULT NULL,
  `payment_method` tinyint(4) DEFAULT NULL COMMENT '1=cash, 2=bank, 3=mobile banking',
  `invoice_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` double(20,2) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '1=income, 2=expanse',
  `status` tinyint(4) DEFAULT NULL COMMENT '1=Active, 0=In Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salon_transection_infos`
--

INSERT INTO `salon_transection_infos` (`id`, `issue_date`, `payment_method`, `invoice_no`, `total`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, '2022-11-05', 1, '00001', 600.00, 1, 1, '2022-11-05 05:51:10', '2022-11-05 05:51:10'),
(3, '2022-11-05', 1, '00002', 125000.00, 2, 1, '2022-11-05 06:30:54', '2022-11-05 06:30:54'),
(4, '2022-11-12', 1, '00003', 400.00, 2, 1, '2022-11-12 22:07:05', '2022-11-12 22:07:05');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_bn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_bn` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_plus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `address_bn` text COLLATE utf8mb4_unicode_ci,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_charge_amount_show` tinyint(4) DEFAULT '1' COMMENT '1=Show, 0=Hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `email`, `mobile_no`, `web`, `facebook`, `twitter`, `google_plus`, `instagram`, `address`, `address_bn`, `logo`, `delivery_charge_amount_show`, `created_at`, `updated_at`) VALUES
(1, 'Laundry Express Ltd', 'laundry@gmail.com', '01841122026, 01910863553', 'http://laundry.com', 'https://www.facebook.com/laundry', NULL, NULL, 'https://www.instagram.com/laundry', 'wapda-road, west rampura, \r\nDhaka-1219, Bangladesh.', 'wapda-road, west rampura, \r\nDhaka-1219, Bangladesh.', 'public/uploads/logo/stLGtumaMSP5PMnKaLl8WaQhUy0EcAyNz4xiD1oNhWGdv27mYLopitLogo.png', 1, '2022-04-05 07:08:39', '2022-09-14 13:01:43'),
(2, 'Salon', 'salon@gmail.com', '017xxxxxxxx', 'www.salon.com', 'www.facebook.com', 'www.twitter.com', NULL, NULL, 'rampura', NULL, 'public/uploads/logo/E0NXFb4MQOWygCkJSlQ5JZFLSy1JpSa6W54XOxHBYFbJG6aHyBblog1.jpg', 1, '2022-08-27 11:41:47', '2022-09-13 07:23:51');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_sdesc` text COLLATE utf8mb4_unicode_ci,
  `sort` int(11) NOT NULL DEFAULT '1',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `slider_sdesc`, `sort`, `image`, `status`, `created_at`, `updated_at`) VALUES
(6, 'sl', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 1, 'public/uploads/slider/qvb9sfzaivS4Bv6O5J2yQxbnjl159pq4t7TQ4tMeQg9NsGoXjDsl1.jpg', 1, '2022-08-06 12:01:56', '2022-08-07 05:17:19'),
(7, 'sl2', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 2, 'public/uploads/slider/qkj8OCn8kIYF4B5DCeNtouoztDbb1UUNxkcSpuEpYnI11Pyyhvsl2.jpg', 1, '2022-08-06 12:13:18', '2022-08-07 05:17:28'),
(8, 'Muhammad Abdullah', 'test', 3, 'public/uploads/slider/FKisbghYXWAOYyz826VbhvTfRgdbrE1cHu8PjrLves3vtfD2uTloundry.jpg', 1, '2022-09-14 12:57:54', '2022-09-16 00:47:20');

-- --------------------------------------------------------

--
-- Table structure for table `slogans`
--

CREATE TABLE `slogans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `description_bn` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slogans`
--

INSERT INTO `slogans` (`id`, `title`, `title_bn`, `description`, `description_bn`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Laundry service', 'আপনার ডেলিভারি পার্টনার হিসেবে সেন্সর কুরিয়ার বেছে নিন', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.', 1, '2022-04-05 09:50:28', '2022-08-06 11:55:11');

-- --------------------------------------------------------

--
-- Table structure for table `sms_list`
--

CREATE TABLE `sms_list` (
  `id` bigint(20) NOT NULL,
  `number` int(11) NOT NULL,
  `sms` varchar(7000) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sms_list`
--

INSERT INTO `sms_list` (`id`, `number`, `sms`, `status`, `created_at`, `updated_at`) VALUES
(1, 1729890904, 'Testing Message for new SMS API Regards,\n                                 Sensor Courier,\n                                 01404477009', 1, '2022-06-05 09:05:56', '2022-06-05 09:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `socialmedia`
--

CREATE TABLE `socialmedia` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternative_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prev_due` double(20,2) NOT NULL DEFAULT '0.00',
  `nid_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `thana_id` int(11) DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passwordReset` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_role` tinyint(4) NOT NULL DEFAULT '8',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `alternative_phone`, `prev_due`, `nid_no`, `image`, `fathers_name`, `mothers_name`, `address`, `division_id`, `district_id`, `thana_id`, `password`, `passwordReset`, `api_token`, `api_role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rashedul islam', 'rashed@gmail.com', '01742068094', NULL, 0.00, NULL, 'public/uploads/supplier/p8xeTBoxwCpiDDsXPC8J9g5rXiv5hdI6v4mhuB35p4iFrmjTAhblog1.jpg', NULL, NULL, 'test', 1, 1, 79, NULL, NULL, 'unt9JHtZ0o0vOurqsDqL1krJRRgJNkmj3TzwbPG9WXr0DeC4D8', 8, 1, '2022-08-21 12:15:04', '2022-08-21 12:15:04'),
(2, 'supplier', 'supplier@gmail.com', '01742068095', NULL, 0.00, NULL, 'public/uploads/supplier/g5NUEsRVnCMbT7fDVPrrdmIbVBv5iPdkEyL1MLg8r1j2EHBv9Oblog1.jpg', NULL, NULL, 'dsfsdf', 1, 1, 16, NULL, NULL, 'RaBqiTcKJhyrpNshQTjsf5mwA8gJQO5bmYhyOQjlZreqFfYoSJ', 8, 1, '2022-08-21 12:17:06', '2022-08-22 04:59:47'),
(3, 'nam', NULL, '0191083553', NULL, 0.00, NULL, 'public/uploads/supplier/AGPZs9zUTaN6ycau26fnUZxoP8dGemOlCIa15ZkhFoOumNtemX7426a4bd1135c6e9c8ec10e8d8b183d1.jpg', NULL, NULL, 'twst', 1, 1, 1, NULL, NULL, 'UtHbHsn8i3CZTHRSiPYmzY8bCrNGaea6OppnGajqjsMmxK6Wt3', 8, 1, '2022-09-14 13:08:03', '2022-09-14 13:08:03'),
(4, 'abc', NULL, '01958368164', NULL, 0.00, NULL, 'public/uploads/supplier/KMXMhpSn43jAH17LFJo3am7R8zoKKSxUo06sJFTAUcj425KWSg64126ad9-5a2a-4bf0-9653-b84d5e24230b.jpg', NULL, NULL, 'test', 1, 1, 79, NULL, NULL, 'tYddmOJTMn1OuDfz5SGya7cE4qOFmyouyKPblbvC38AInHR1Dr', 8, 1, '2022-11-14 00:17:50', '2022-11-14 00:17:50');

-- --------------------------------------------------------

--
-- Table structure for table `terms_conditions`
--

CREATE TABLE `terms_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thanas`
--

CREATE TABLE `thanas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `deliverycharge_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thanas`
--

INSERT INTO `thanas` (`id`, `name`, `division_id`, `district_id`, `deliverycharge_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rampura', 1, 1, 3, 1, '2022-04-23 06:38:36', '2022-05-11 23:29:43'),
(2, 'Sylhet Sadar', 8, 5, 1, 1, '2022-04-25 03:14:33', '2022-05-11 23:21:58'),
(3, 'Turag', 1, 1, 3, 1, '2022-04-25 03:20:57', '2022-05-11 23:21:11'),
(4, 'Uttara', 1, 1, 3, 1, '2022-04-25 03:21:16', '2022-05-11 23:20:01'),
(5, 'Pallabi', 1, 1, 3, 1, '2022-04-25 03:22:03', '2022-05-11 23:32:23'),
(6, 'Mirpur', 1, 1, 3, 1, '2022-04-25 03:22:46', '2022-05-11 23:31:03'),
(7, 'Shah Ali', 1, 1, 3, 1, '2022-04-25 03:25:29', '2022-05-11 23:27:41'),
(8, 'Rupnagar', 1, 1, 3, 1, '2022-04-25 03:26:17', '2022-05-11 23:29:12'),
(9, 'Kafrul', 1, 1, 3, 1, '2022-04-25 03:26:50', '2022-05-11 23:24:19'),
(10, 'Dar-ur-Salam', 1, 1, 3, 1, '2022-04-25 03:28:00', '2022-05-11 23:16:14'),
(11, 'Mohammadpur', 1, 1, 3, 1, '2022-04-25 03:28:41', '2022-05-11 23:34:30'),
(12, 'Dhanmondi', 1, 1, 3, 1, '2022-04-25 03:29:06', '2022-05-11 23:17:47'),
(13, 'Kala Bagan', 1, 1, 3, 1, '2022-04-25 03:29:34', '2022-05-11 23:24:31'),
(14, 'New Market', 1, 1, 3, 1, '2022-04-25 03:30:01', '2022-05-11 23:34:20'),
(16, 'Adabor', 1, 1, 3, 1, '2022-04-25 04:04:06', '2022-05-11 20:06:17'),
(17, 'Badda', 1, 1, 3, 1, '2022-04-25 04:04:47', '2022-05-11 20:11:30'),
(18, 'Bangshal', 1, 1, 3, 1, '2022-04-25 04:05:10', '2022-05-11 22:52:36'),
(19, 'Cantonment', 1, 1, 3, 1, '2022-04-25 04:05:55', '2022-05-11 23:14:49'),
(20, 'Chowkbazar', 1, 1, 3, 1, '2022-04-25 04:06:39', '2022-05-11 23:15:30'),
(21, 'Demra', 1, 1, 3, 1, '2022-04-25 04:07:10', '2022-05-11 23:16:32'),
(22, 'Gendaria', 1, 1, 3, 1, '2022-04-25 04:07:59', '2022-05-11 23:20:22'),
(23, 'Bimanbandar', 1, 1, 3, 1, '2022-04-25 04:09:16', '2022-05-11 23:11:09'),
(24, 'Gulshan', 1, 1, 3, 1, '2022-04-25 04:10:05', '2022-05-11 23:21:28'),
(25, 'Hazaribagh', 1, 1, 3, 1, '2022-04-25 04:10:43', '2022-05-11 23:23:06'),
(26, 'Jatrabari', 1, 1, 3, 1, '2022-04-25 04:11:12', '2022-05-11 23:23:29'),
(27, 'Kadamtali', 1, 1, 3, 1, '2022-04-25 04:11:43', '2022-05-11 23:24:02'),
(28, 'Kamrangirchar', 1, 1, 3, 1, '2022-04-25 04:12:35', '2022-05-11 23:25:46'),
(29, 'Khilgaon', 1, 1, 3, 1, '2022-04-25 04:13:10', '2022-05-11 23:27:28'),
(30, 'Khilkhet', 1, 1, 3, 1, '2022-04-25 04:13:55', '2022-05-11 23:27:42'),
(31, 'Kotwali', 1, 1, 3, 1, '2022-04-25 04:14:37', '2022-05-11 23:27:56'),
(32, 'Lalbagh', 1, 1, 3, 1, '2022-04-25 04:15:03', '2022-05-11 23:28:40'),
(33, 'Motijheel', 1, 1, 3, 1, '2022-04-25 04:15:51', '2022-05-11 23:34:58'),
(34, 'Paltan', 1, 1, 3, 1, '2022-04-25 04:17:59', '2022-05-11 23:31:49'),
(35, 'Panthapath', 1, 1, 3, 1, '2022-04-25 04:19:24', '2022-05-11 23:31:34'),
(36, 'Ramna', 1, 1, 3, 1, '2022-04-25 04:20:08', '2022-05-11 23:30:44'),
(37, 'Sabujbagh', 1, 1, 3, 1, '2022-04-25 04:21:12', '2022-05-11 23:28:56'),
(38, 'Shahbag', 1, 1, 3, 1, '2022-04-25 04:22:15', '2022-05-11 23:27:07'),
(39, 'Sher-E-bangla Nagar', 1, 1, 3, 1, '2022-04-25 04:22:55', '2022-05-11 23:24:48'),
(40, 'Shyampur', 1, 1, 3, 1, '2022-04-25 04:23:35', '2022-05-11 23:23:23'),
(41, 'Sutrapur', 1, 1, 3, 1, '2022-04-25 04:24:14', '2022-05-11 23:22:32'),
(42, 'Tejgaon Ind. Area', 1, 1, 3, 1, '2022-04-25 04:25:35', '2022-05-11 23:21:26'),
(43, 'Tejgaon', 1, 1, 3, 1, '2022-04-25 04:25:55', '2022-05-11 23:21:40'),
(44, 'Uttar Khan', 1, 1, 3, 1, '2022-04-25 04:26:32', '2022-05-11 23:20:18'),
(45, 'Vatara', 1, 1, 3, 1, '2022-04-25 04:27:01', '2022-05-11 23:11:47'),
(46, 'Wari', 1, 1, 3, 1, '2022-04-25 04:27:34', '2022-05-11 22:47:01'),
(47, 'Sadarghat', 1, 1, 3, 1, '2022-04-27 20:48:26', '2022-05-11 23:28:36'),
(49, 'Savar', 1, 1, 2, 1, '2022-04-27 21:14:21', '2022-05-11 20:07:44'),
(50, 'Keraniganj', 1, 1, 2, 1, '2022-04-27 21:16:30', '2022-05-11 20:13:57'),
(51, 'Bhashantek', 1, 1, 3, 1, '2022-04-27 21:20:51', '2022-05-11 23:02:41'),
(52, 'Dakshinkhan', 1, 1, 3, 1, '2022-04-27 21:22:22', '2022-05-12 18:00:02'),
(53, 'Banani', 1, 1, 3, 1, '2022-04-27 21:33:36', '2022-05-11 22:51:49'),
(54, 'Banani DOHS', 1, 1, 3, 1, '2022-04-27 21:46:42', '2022-05-11 22:52:02'),
(55, 'Baridhara Diplomatic Zone', 1, 1, 3, 1, '2022-04-27 21:48:12', '2022-05-11 22:58:27'),
(56, 'Baridhara DOHS', 1, 1, 3, 1, '2022-04-27 21:48:42', '2022-05-11 22:58:56'),
(57, 'Baridhara J Block', 1, 1, 3, 1, '2022-04-27 21:49:17', '2022-05-11 23:00:23'),
(58, 'Bashundhara', 1, 1, 3, 1, '2022-04-27 21:49:54', '2022-05-11 23:01:11'),
(59, 'Gulshan 1', 1, 1, 3, 1, '2022-04-27 21:50:19', '2022-05-11 23:21:40'),
(60, 'Gulshan 2', 1, 1, 3, 1, '2022-04-27 21:50:39', '2022-05-11 23:21:59'),
(61, 'Nadda', 1, 1, 3, 1, '2022-04-27 21:51:33', '2022-05-12 00:14:59'),
(62, 'Kuril', 1, 1, 3, 1, '2022-04-27 21:51:51', '2022-05-11 23:28:10'),
(63, 'Mohakhali', 1, 1, 3, 1, '2022-04-27 21:52:32', '2022-05-11 23:34:00'),
(64, 'Mohakhali DOHS', 1, 1, 3, 1, '2022-04-27 21:53:07', '2022-05-11 23:34:17'),
(65, 'Nakhalpara', 1, 1, 3, 1, '2022-04-27 21:53:40', '2022-05-11 23:35:38'),
(66, 'Niketan', 1, 1, 3, 1, '2022-04-27 21:54:03', '2022-05-11 23:33:46'),
(67, 'Nikunja 1', 1, 1, 3, 1, '2022-04-27 21:54:36', '2022-05-11 23:33:22'),
(68, 'Nikunja 2', 1, 1, 3, 1, '2022-04-27 21:54:56', '2022-05-11 23:33:03'),
(69, 'Banasree', 1, 1, 3, 1, '2022-04-27 21:55:47', '2022-05-11 22:52:17'),
(70, 'South Banasree', 1, 1, 3, 1, '2022-04-27 21:56:35', '2022-05-11 23:23:05'),
(71, 'Boro Moghbazar', 1, 1, 3, 1, '2022-04-27 21:57:15', '2022-05-11 23:13:20'),
(72, 'Moghbazar', 1, 1, 3, 1, '2022-04-27 21:57:46', '2022-05-11 23:33:46'),
(73, 'Eskaton Road', 1, 1, 3, 1, '2022-04-27 21:59:00', '2022-05-11 23:19:25'),
(74, 'Goran', 1, 1, 3, 1, '2022-04-27 21:59:46', '2022-05-11 23:20:44'),
(75, 'Shahjadpur', 1, 1, 3, 1, '2022-04-27 22:00:27', '2022-05-11 23:26:22'),
(76, 'Shajahanpur', 1, 1, 3, 1, '2022-04-27 22:01:41', '2022-05-11 23:26:03'),
(77, 'Malibag', 1, 1, 3, 1, '2022-04-27 22:02:06', '2022-05-11 23:28:58'),
(78, 'DIT Road', 1, 1, 3, 1, '2022-04-27 22:02:39', '2022-05-11 23:18:31'),
(79, 'Aftabnagar', 1, 1, 3, 1, '2022-04-27 22:03:26', '2022-05-11 20:06:39'),
(80, 'Mugda', 1, 1, 3, 1, '2022-04-27 22:03:50', '2022-05-11 23:35:15'),
(81, 'Manda', 1, 1, 3, 1, '2022-04-27 22:04:14', '2022-05-11 23:29:21'),
(82, 'Bashabo', 1, 1, 3, 1, '2022-04-27 22:04:37', '2022-05-11 23:00:40'),
(83, 'Shantinagar', 1, 1, 3, 1, '2022-04-27 22:04:58', '2022-05-11 23:25:22'),
(84, 'Shiddeshshwari', 1, 1, 3, 1, '2022-04-27 22:05:41', '2022-05-11 23:24:13'),
(85, 'Shegunbagicha', 1, 1, 3, 1, '2022-04-27 22:06:12', '2022-05-11 23:25:05'),
(86, 'Beraid', 1, 1, 3, 1, '2022-04-27 22:07:08', '2022-05-11 23:01:49'),
(87, 'Kamlapur', 1, 1, 3, 1, '2022-04-27 22:07:34', '2022-05-11 23:25:32'),
(88, 'Gulisthan', 1, 1, 3, 1, '2022-04-27 22:07:54', '2022-05-11 23:21:12'),
(89, 'Gopibag', 1, 1, 3, 1, '2022-04-27 22:08:18', '2022-05-11 23:20:34'),
(90, 'Narinda', 1, 1, 3, 1, '2022-04-27 22:08:35', '2022-05-11 23:35:08'),
(91, 'Maniknagar', 1, 1, 3, 1, '2022-04-27 22:08:56', '2022-05-11 23:30:09'),
(92, 'Dholpur', 1, 1, 3, 1, '2022-04-27 22:09:28', '2022-05-11 23:18:03'),
(93, 'Shanir Akhra', 1, 1, 3, 1, '2022-04-27 22:10:16', '2022-05-11 23:25:47'),
(94, 'Rayerbag', 1, 1, 3, 1, '2022-04-27 22:10:43', '2022-05-11 23:29:25'),
(95, 'Matuali', 1, 1, 3, 1, '2022-04-28 15:46:31', '2022-05-11 23:30:48'),
(96, 'Shahid Nagar', 1, 1, 3, 1, '2022-04-28 16:19:33', '2022-05-11 23:26:39'),
(97, 'Jigatola', 1, 1, 3, 1, '2022-04-28 16:20:03', '2022-05-11 23:23:41'),
(98, 'Azimpur', 1, 1, 3, 1, '2022-04-28 16:20:28', '2022-05-11 20:11:12'),
(99, 'New Elephant Road', 1, 1, 3, 1, '2022-04-28 16:21:05', '2022-05-11 23:34:51'),
(100, 'Nilkhet', 1, 1, 3, 1, '2022-04-28 16:22:03', '2022-05-11 23:32:43'),
(101, 'Elephant Road', 1, 1, 3, 1, '2022-04-28 16:22:27', '2022-05-11 23:18:44'),
(102, 'Central Road', 1, 1, 3, 1, '2022-04-28 16:22:49', '2022-05-11 23:15:09'),
(103, 'Hatirpool', 1, 1, 3, 1, '2022-04-28 16:23:18', '2022-05-11 23:22:54'),
(104, 'Kathalbagan', 1, 1, 3, 1, '2022-04-28 16:23:46', '2022-05-11 23:25:58'),
(105, 'Dhaka University', 1, 1, 3, 1, '2022-04-28 16:24:33', '2022-05-12 00:36:02'),
(106, 'Islampur', 1, 1, 3, 1, '2022-04-28 16:25:31', '2022-05-11 23:23:16'),
(107, 'Lakshmibazar', 1, 1, 3, 1, '2022-04-28 16:26:40', '2022-05-11 23:28:23'),
(108, 'Bakshi Bazar', 1, 1, 3, 1, '2022-04-28 16:27:37', '2022-05-11 20:12:08'),
(109, 'Mirpur 1', 1, 1, 3, 1, '2022-04-28 16:28:14', '2022-05-11 23:31:20'),
(110, 'Mirpur 2', 1, 1, 3, 1, '2022-04-28 16:28:44', '2022-05-11 23:32:59'),
(111, 'Monipur', 1, 1, 3, 1, '2022-04-28 16:28:59', '2022-05-12 00:17:06'),
(112, 'Pirerbag', 1, 1, 3, 1, '2022-04-28 16:29:23', '2022-05-11 23:30:58'),
(113, 'Shewrapara', 1, 1, 3, 1, '2022-04-28 16:29:55', '2022-05-11 23:24:35'),
(114, 'Mirpur 10', 1, 1, 3, 1, '2022-04-28 16:30:22', '2022-05-11 23:31:34'),
(115, 'Mirpur 6', 1, 1, 3, 1, '2022-04-28 16:30:40', '2022-05-11 23:33:13'),
(116, 'Mirpur DOHS', 1, 1, 3, 1, '2022-04-28 16:31:25', '2022-05-11 23:33:32'),
(117, 'Mirpur 12', 1, 1, 3, 1, '2022-04-28 16:31:45', '2022-05-11 23:31:53'),
(118, 'Mirpur 13', 1, 1, 3, 1, '2022-04-28 16:32:09', '2022-05-11 23:32:32'),
(119, 'Mirpur 14', 1, 1, 3, 1, '2022-04-28 17:07:23', '2022-05-11 23:32:46'),
(120, 'Balurghat', 1, 1, 3, 1, '2022-04-28 17:08:56', '2022-05-11 20:12:27'),
(121, 'Manikdi', 1, 1, 3, 1, '2022-04-28 17:09:16', '2022-05-11 23:29:36'),
(122, 'Matikata', 1, 1, 3, 1, '2022-04-28 17:09:40', '2022-05-11 23:30:28'),
(123, 'Uttara Sector 4', 1, 1, 3, 1, '2022-04-28 17:10:57', '2022-05-11 23:16:50'),
(124, 'Uttara Sector 6', 1, 1, 3, 1, '2022-04-28 17:13:05', '2022-05-11 23:16:09'),
(125, 'Uttara Sector-8', 1, 1, 3, 1, '2022-04-28 17:13:31', '2022-05-14 20:50:36'),
(126, 'Uttara Sector 1', 1, 1, 3, 1, '2022-04-28 17:13:57', '2022-05-11 23:19:43'),
(127, 'Kawla', 1, 1, 3, 1, '2022-04-28 17:14:22', '2022-05-11 23:26:11'),
(128, 'Faidabad', 1, 1, 3, 1, '2022-04-28 17:14:48', '2022-05-11 23:19:39'),
(129, 'Ashkona', 1, 1, 3, 1, '2022-04-28 17:15:35', '2022-05-11 20:10:20'),
(130, 'Bawnia', 1, 1, 3, 1, '2022-04-28 17:15:57', '2022-05-11 23:01:30'),
(132, 'Uttara Sector 7', 1, 1, 3, 1, '2022-04-28 17:17:58', '2022-05-11 23:15:45'),
(133, 'Uttara Sector 5', 1, 1, 3, 1, '2022-04-28 17:18:22', '2022-05-11 23:16:34'),
(134, 'Uttara Sector 10', 1, 1, 3, 1, '2022-04-28 17:18:43', '2022-05-11 23:19:10'),
(135, 'Uttara Sector 12', 1, 1, 3, 1, '2022-04-28 17:19:06', '2022-05-11 23:18:15'),
(136, 'Uttara Sector 11', 1, 1, 3, 1, '2022-04-28 17:19:24', '2022-05-11 23:18:31'),
(137, 'Uttara Sector 14', 1, 1, 3, 1, '2022-04-28 17:19:39', '2022-05-11 23:17:36'),
(138, 'Uttara Sector 9', 1, 1, 3, 1, '2022-04-28 17:20:28', '2022-05-11 23:12:02'),
(140, 'Uttara Sector 3', 1, 1, 3, 1, '2022-04-28 17:21:21', '2022-05-11 23:17:09'),
(141, 'Uttara Sector 13', 1, 1, 3, 1, '2022-04-28 17:21:55', '2022-05-11 23:17:59'),
(142, 'Uttara Sector 15', 1, 1, 3, 1, '2022-04-28 17:22:27', '2022-05-11 23:17:22'),
(143, 'Shyamoli', 1, 1, 3, 1, '2022-04-28 17:23:37', '2022-05-11 23:23:40'),
(144, 'Kallyanpur', 1, 1, 3, 1, '2022-04-28 17:24:08', '2022-05-11 23:25:01'),
(145, 'Agargaon', 1, 1, 3, 1, '2022-04-28 17:24:33', '2022-05-11 20:09:27'),
(146, 'Farmgate', 1, 1, 3, 1, '2022-04-28 17:24:56', '2022-05-11 23:19:52'),
(147, 'Kawran Bazar', 1, 1, 3, 1, '2022-04-28 17:25:33', '2022-05-11 23:26:33'),
(148, 'Panthapath', 1, 1, 3, 1, '2022-04-28 17:25:54', '2022-05-11 23:31:18'),
(149, 'Green Road', 1, 1, 3, 1, '2022-04-28 17:26:39', '2022-05-11 23:21:00'),
(150, 'Sreebordi', 5, 8, 1, 1, '2022-04-28 18:38:25', '2022-05-11 23:22:50'),
(151, 'Senpara', 1, 1, 3, 1, '2022-05-02 17:18:21', '2022-05-11 23:28:04'),
(152, 'Dhaka Cantonment', 1, 1, 3, 1, '2022-05-02 22:40:17', '2022-05-10 23:18:15'),
(153, 'Jurain', 1, 1, 3, 1, '2022-05-12 17:16:48', '2022-05-12 17:16:48'),
(154, 'Keranigonj', 1, 1, 2, 1, '2022-05-20 07:29:44', '2022-05-20 07:29:44'),
(155, 'Mirpur 11', 1, 1, 3, 1, '2022-05-21 07:06:37', '2022-05-21 07:12:07');

-- --------------------------------------------------------

--
-- Table structure for table `topbanners`
--

CREATE TABLE `topbanners` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_types`
--

CREATE TABLE `transaction_types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1:active,0:inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_types`
--

INSERT INTO `transaction_types` (`id`, `type_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Laundry Order', 1, '2022-09-12 16:43:15', '2022-09-12 16:43:15'),
(2, 'Service Booking', 1, '2022-09-12 16:43:15', '2022-09-12 16:43:15'),
(3, 'Service Commission', 1, '2022-09-14 10:41:37', '2022-09-14 10:41:37'),
(4, 'Salary Withdraw', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Advance', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit_type` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1:active,0:inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_type`, `status`) VALUES
(1, 'Gram', 1),
(2, 'Kilogram', 1),
(3, 'Litre', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public/avatar/avatar.png',
  `status` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branches` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `username`, `email`, `phone`, `designation`, `password`, `image`, `status`, `remember_token`, `branches`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Admin', 'superadmin', 'superadmin@gmail.com', '01729890904', 'Super Admin', '$2a$10$/MU/eMDSFUbHi/Q/YdeJD.WCOM7kowJv8v4EFjXimpfwpvYWu6Lh6', 'public/avatar/avatar.png', 1, 'adxDpnhJuIoBGbv2yEDaxCa7YNtqvJxaxbELd2qNAg3HZFScSmzf8Hifd7bF', NULL, '2022-04-05 09:23:34', '2022-04-05 09:23:34'),
(4, 1, 'Hafuzur Rahman', 'hafizur', 'mdhafizurrahman516@gmail.com', '01789725276', 'Accounten Meneger', '$2y$10$DEur6xSkgqJebB2ipkFYKe93Jlov1KW27I0gKu1MV7YcD7QrXnkpO', 'public/uploads/user/16631608297426a4bd1135c6e9c8ec10e8d8b183d1.jpg', 1, NULL, '1,2', '2022-09-14 13:07:09', '2022-09-14 13:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1:active,0:inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `type_name`, `status`) VALUES
(1, 'Admin', 1),
(2, 'Pickupman', 1),
(3, 'Deliveryman', 1);

-- --------------------------------------------------------

--
-- Table structure for table `weights`
--

CREATE TABLE `weights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bangla_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` double(20,2) DEFAULT '0.00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weights`
--

INSERT INTO `weights` (`id`, `name`, `bangla_name`, `value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Upto 1kg', '১ কেজি পর্যন্ত', 1.00, 1, '2022-05-10 06:16:44', '2022-05-10 06:16:44'),
(2, 'Upto 2kg', '২ কেজি পর্যন্ত', 2.00, 1, '2022-05-10 06:16:44', '2022-05-10 06:16:44'),
(3, 'Upto 3kg', '৩ কেজি পর্যন্ত', 3.00, 1, '2022-05-10 06:16:44', '2022-05-10 06:16:44'),
(4, 'Upto 4kg', '৪ কেজি পর্যন্ত', 4.00, 1, '2022-05-10 06:16:44', '2022-05-10 06:16:44'),
(5, 'Upto 5kg', '৫ কেজি পর্যন্ত', 5.00, 1, '2022-05-10 06:16:44', '2022-05-10 06:16:44');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=In Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, '2022', 1, NULL, NULL),
(2, '2021', 1, NULL, NULL),
(3, '2020', 1, NULL, NULL),
(4, '2019', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_heads`
--
ALTER TABLE `account_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_head_types`
--
ALTER TABLE `account_head_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agents_phone_unique` (`phone`),
  ADD UNIQUE KEY `agents_email_unique` (`email`);

--
-- Indexes for table `agent_thanas`
--
ALTER TABLE `agent_thanas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientfeedbacks`
--
ALTER TABLE `clientfeedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `codcharges`
--
ALTER TABLE `codcharges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corporate_customer_products`
--
ALTER TABLE `corporate_customer_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `createpages`
--
ALTER TABLE `createpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliverycharges`
--
ALTER TABLE `deliverycharges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveryman_agents`
--
ALTER TABLE `deliveryman_agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveryman_areas`
--
ALTER TABLE `deliveryman_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveryman_education`
--
ALTER TABLE `deliveryman_education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveryman_experiences`
--
ALTER TABLE `deliveryman_experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveryman_payments`
--
ALTER TABLE `deliveryman_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliverymen`
--
ALTER TABLE `deliverymen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `deliverymen_phone_unique` (`phone`),
  ADD UNIQUE KEY `deliverymen_email_unique` (`email`);

--
-- Indexes for table `delivery_charge_heads`
--
ALTER TABLE `delivery_charge_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_agents`
--
ALTER TABLE `employee_agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_areas`
--
ALTER TABLE `employee_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_education`
--
ALTER TABLE `employee_education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_experiences`
--
ALTER TABLE `employee_experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_services`
--
ALTER TABLE `employee_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hubs`
--
ALTER TABLE `hubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_discounts`
--
ALTER TABLE `laundry_discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_items`
--
ALTER TABLE `laundry_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_order_employees`
--
ALTER TABLE `laundry_order_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_packages`
--
ALTER TABLE `laundry_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_package_items`
--
ALTER TABLE `laundry_package_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_pkg_order_items`
--
ALTER TABLE `laundry_pkg_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_products`
--
ALTER TABLE `laundry_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_product_branches`
--
ALTER TABLE `laundry_product_branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_product_categories`
--
ALTER TABLE `laundry_product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_product_services`
--
ALTER TABLE `laundry_product_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_product_uses`
--
ALTER TABLE `laundry_product_uses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_service_costs`
--
ALTER TABLE `laundry_service_costs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_transactions`
--
ALTER TABLE `laundry_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry_transection_infos`
--
ALTER TABLE `laundry_transection_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_activities`
--
ALTER TABLE `log_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchantpayments`
--
ALTER TABLE `merchantpayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `months`
--
ALTER TABLE `months`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nearestzones`
--
ALTER TABLE `nearestzones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_billings`
--
ALTER TABLE `order_billings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_shippings`
--
ALTER TABLE `order_shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_views`
--
ALTER TABLE `order_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcelnotes`
--
ALTER TABLE `parcelnotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcels`
--
ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trackingCode` (`trackingCode`);

--
-- Indexes for table `parceltypes`
--
ALTER TABLE `parceltypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickupman_agents`
--
ALTER TABLE `pickupman_agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickupman_areas`
--
ALTER TABLE `pickupman_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickupman_education`
--
ALTER TABLE `pickupman_education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickupman_experiences`
--
ALTER TABLE `pickupman_experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickupman_payments`
--
ALTER TABLE `pickupman_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickupmen`
--
ALTER TABLE `pickupmen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickups`
--
ALTER TABLE `pickups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricetypes`
--
ALTER TABLE `pricetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_services`
--
ALTER TABLE `product_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotional_discounts`
--
ALTER TABLE `promotional_discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_bookings`
--
ALTER TABLE `salon_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_booking_items`
--
ALTER TABLE `salon_booking_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_carts`
--
ALTER TABLE `salon_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_cart_items`
--
ALTER TABLE `salon_cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_categories`
--
ALTER TABLE `salon_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_discounts`
--
ALTER TABLE `salon_discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_inventory_logs`
--
ALTER TABLE `salon_inventory_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_items`
--
ALTER TABLE `salon_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_order_employees`
--
ALTER TABLE `salon_order_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_parent_services`
--
ALTER TABLE `salon_parent_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_product_uses`
--
ALTER TABLE `salon_product_uses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_purchases`
--
ALTER TABLE `salon_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_purchase_items`
--
ALTER TABLE `salon_purchase_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_services`
--
ALTER TABLE `salon_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_service_costs`
--
ALTER TABLE `salon_service_costs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_transactions`
--
ALTER TABLE `salon_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_transection_infos`
--
ALTER TABLE `salon_transection_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slogans`
--
ALTER TABLE `slogans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_list`
--
ALTER TABLE `sms_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socialmedia`
--
ALTER TABLE `socialmedia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `deliverymen_phone_unique` (`phone`),
  ADD UNIQUE KEY `deliverymen_email_unique` (`email`);

--
-- Indexes for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thanas`
--
ALTER TABLE `thanas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topbanners`
--
ALTER TABLE `topbanners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_types`
--
ALTER TABLE `transaction_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weights`
--
ALTER TABLE `weights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `account_heads`
--
ALTER TABLE `account_heads`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `account_head_types`
--
ALTER TABLE `account_head_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agent_thanas`
--
ALTER TABLE `agent_thanas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2475;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `clientfeedbacks`
--
ALTER TABLE `clientfeedbacks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `codcharges`
--
ALTER TABLE `codcharges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `corporate_customer_products`
--
ALTER TABLE `corporate_customer_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `createpages`
--
ALTER TABLE `createpages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `deliverycharges`
--
ALTER TABLE `deliverycharges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deliveryman_agents`
--
ALTER TABLE `deliveryman_agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliveryman_areas`
--
ALTER TABLE `deliveryman_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliveryman_education`
--
ALTER TABLE `deliveryman_education`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliveryman_experiences`
--
ALTER TABLE `deliveryman_experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliveryman_payments`
--
ALTER TABLE `deliveryman_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliverymen`
--
ALTER TABLE `deliverymen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_charge_heads`
--
ALTER TABLE `delivery_charge_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee_agents`
--
ALTER TABLE `employee_agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_areas`
--
ALTER TABLE `employee_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_education`
--
ALTER TABLE `employee_education`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_experiences`
--
ALTER TABLE `employee_experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_services`
--
ALTER TABLE `employee_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hubs`
--
ALTER TABLE `hubs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `laundry_discounts`
--
ALTER TABLE `laundry_discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `laundry_items`
--
ALTER TABLE `laundry_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `laundry_order_employees`
--
ALTER TABLE `laundry_order_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `laundry_packages`
--
ALTER TABLE `laundry_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laundry_package_items`
--
ALTER TABLE `laundry_package_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `laundry_pkg_order_items`
--
ALTER TABLE `laundry_pkg_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `laundry_products`
--
ALTER TABLE `laundry_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `laundry_product_branches`
--
ALTER TABLE `laundry_product_branches`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `laundry_product_categories`
--
ALTER TABLE `laundry_product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laundry_product_services`
--
ALTER TABLE `laundry_product_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laundry_product_uses`
--
ALTER TABLE `laundry_product_uses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `laundry_service_costs`
--
ALTER TABLE `laundry_service_costs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `laundry_transactions`
--
ALTER TABLE `laundry_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `laundry_transection_infos`
--
ALTER TABLE `laundry_transection_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `log_activities`
--
ALTER TABLE `log_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `merchantpayments`
--
ALTER TABLE `merchantpayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `months`
--
ALTER TABLE `months`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nearestzones`
--
ALTER TABLE `nearestzones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `order_billings`
--
ALTER TABLE `order_billings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `order_shippings`
--
ALTER TABLE `order_shippings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_views`
--
ALTER TABLE `order_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `parcelnotes`
--
ALTER TABLE `parcelnotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `parcels`
--
ALTER TABLE `parcels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `parceltypes`
--
ALTER TABLE `parceltypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `pickupman_agents`
--
ALTER TABLE `pickupman_agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickupman_areas`
--
ALTER TABLE `pickupman_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickupman_education`
--
ALTER TABLE `pickupman_education`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickupman_experiences`
--
ALTER TABLE `pickupman_experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickupman_payments`
--
ALTER TABLE `pickupman_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickupmen`
--
ALTER TABLE `pickupmen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pickups`
--
ALTER TABLE `pickups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pricetypes`
--
ALTER TABLE `pricetypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_services`
--
ALTER TABLE `product_services`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `promotional_discounts`
--
ALTER TABLE `promotional_discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `salon_bookings`
--
ALTER TABLE `salon_bookings`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `salon_booking_items`
--
ALTER TABLE `salon_booking_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `salon_carts`
--
ALTER TABLE `salon_carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salon_cart_items`
--
ALTER TABLE `salon_cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `salon_categories`
--
ALTER TABLE `salon_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `salon_discounts`
--
ALTER TABLE `salon_discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `salon_inventory_logs`
--
ALTER TABLE `salon_inventory_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `salon_items`
--
ALTER TABLE `salon_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salon_order_employees`
--
ALTER TABLE `salon_order_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salon_parent_services`
--
ALTER TABLE `salon_parent_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `salon_product_uses`
--
ALTER TABLE `salon_product_uses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salon_purchases`
--
ALTER TABLE `salon_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salon_purchase_items`
--
ALTER TABLE `salon_purchase_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salon_services`
--
ALTER TABLE `salon_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `salon_service_costs`
--
ALTER TABLE `salon_service_costs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `salon_transactions`
--
ALTER TABLE `salon_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `salon_transection_infos`
--
ALTER TABLE `salon_transection_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `slogans`
--
ALTER TABLE `slogans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_list`
--
ALTER TABLE `sms_list`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `socialmedia`
--
ALTER TABLE `socialmedia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thanas`
--
ALTER TABLE `thanas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `topbanners`
--
ALTER TABLE `topbanners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_types`
--
ALTER TABLE `transaction_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `weights`
--
ALTER TABLE `weights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
