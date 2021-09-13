-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 13, 2021 at 02:25 AM
-- Server version: 10.3.31-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jkelectr_jkeleccity`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_configs`
--

CREATE TABLE `app_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inventory MGT',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT 'Write about yourself.',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'contact@example.com',
  `helpline` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '018XXXXXXXXXX',
  `whatsapp_support` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Bangladesh',
  `working_days` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_configs`
--

INSERT INTO `app_configs` (`id`, `name`, `description`, `email`, `helpline`, `whatsapp_support`, `fax`, `facebook`, `address`, `working_days`, `logo`, `favicon`, `created_at`, `updated_at`) VALUES
(1, 'JKELECCITY', 'Write about yourself.', 'contact@example.com', '018423423', '34234324324', '34324324', 'https://www.facebook.com', 'Bahaddarhat<br>\r\nChittagon, Bangladesh', 'SUN-THU', 'logo-6076ba6f4295b.png', 'favicon-6076b80f00ae2.png', '2021-04-12 09:48:54', '2021-04-14 14:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `banner_images`
--

CREATE TABLE `banner_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `segment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner_images`
--

INSERT INTO `banner_images` (`id`, `segment`, `created_at`, `updated_at`) VALUES
(2, 'slider', '2021-04-14 08:43:38', '2021-04-14 08:43:38'),
(3, 'slider', '2021-04-14 08:57:27', '2021-04-14 08:57:27'),
(4, 'slider', '2021-04-14 12:57:53', '2021-04-14 12:57:53'),
(5, 'small-banner', '2021-04-14 13:07:10', '2021-04-14 13:07:10'),
(6, 'small-banner', '2021-04-14 13:16:48', '2021-04-14 13:16:48'),
(7, 'small-banner', '2021-04-14 13:20:29', '2021-04-14 13:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(21, 'Sony', 1, '2021-04-14 13:56:22', '2021-04-14 13:56:22'),
(22, 'Rangs', 1, '2021-04-14 13:56:27', '2021-04-14 13:56:27'),
(23, 'Samsung', 1, '2021-04-14 13:56:32', '2021-04-14 13:56:32'),
(24, 'Walton', 1, '2021-04-14 13:56:37', '2021-04-14 13:56:37'),
(25, 'General', 1, '2021-04-14 13:56:43', '2021-04-14 13:56:43'),
(27, 'Vision', 1, '2021-04-27 14:26:36', '2021-04-27 14:26:36'),
(29, 'Marcel Refrigerator', 1, '2021-05-19 14:08:18', '2021-05-19 14:08:18'),
(30, 'Marcel LED TV', 1, '2021-05-19 14:08:51', '2021-05-19 14:08:51'),
(31, 'Vision Refrigerator', 1, '2021-05-19 14:09:36', '2021-05-19 14:09:36'),
(32, 'Vision Rice Cooker', 1, '2021-05-19 14:10:04', '2021-05-19 14:10:04'),
(33, 'Vision Blender', 1, '2021-05-19 14:10:31', '2021-05-19 14:10:31'),
(34, 'RANGS Electronics', 1, '2021-06-17 11:05:38', '2021-06-17 11:05:38'),
(35, 'SONY LED TV', 1, '2021-06-17 11:13:00', '2021-06-17 11:13:00'),
(36, 'LED Television', 1, '2021-06-20 15:09:10', '2021-06-20 15:09:10'),
(37, 'Kelvinator Refrigerator', 1, '2021-08-12 11:52:45', '2021-08-12 11:52:45'),
(38, 'RANGS Refrigerator', 1, '2021-08-12 11:53:12', '2021-08-12 11:53:12'),
(39, 'RANGS  AC', 1, '2021-08-12 11:53:53', '2021-08-12 11:53:53'),
(40, 'Samsung New', 1, '2021-09-07 15:21:42', '2021-09-07 15:21:42');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(22, 'Refrigerator', 1, '2021-04-14 13:54:29', '2021-04-14 13:54:29'),
(23, 'Kitchen Appliances', 1, '2021-04-14 13:54:41', '2021-04-14 13:54:41'),
(24, 'Others', 1, '2021-04-14 13:54:47', '2021-04-14 13:54:47'),
(25, 'Television', 1, '2021-04-14 13:54:57', '2021-04-14 13:54:57'),
(26, 'Microwave Oven', 1, '2021-04-14 13:55:04', '2021-04-14 13:55:04'),
(27, 'Air Conditioner', 1, '2021-04-14 13:55:14', '2021-04-14 13:55:14'),
(28, 'Washing Machine', 1, '2021-04-14 13:55:21', '2021-04-14 13:55:21'),
(29, 'Fan', 1, '2021-04-27 10:52:23', '2021-04-27 10:52:23'),
(30, 'Blender', 1, '2021-04-27 13:38:46', '2021-04-27 13:39:05'),
(31, 'Bluetooth Speaker', 1, '2021-05-19 13:55:31', '2021-05-19 13:55:31'),
(32, 'Gas Stove', 1, '2021-05-19 13:55:46', '2021-05-19 13:55:46'),
(33, 'Walton Refrigerator', 1, '2021-05-19 15:08:20', '2021-05-19 15:08:20'),
(34, 'Vision LED TV', 1, '2021-05-19 15:08:46', '2021-05-19 15:08:46'),
(35, 'VISION Iron', 1, '2021-05-19 15:09:27', '2021-05-19 15:09:27'),
(36, 'VISION  Speaker', 1, '2021-05-19 15:10:07', '2021-05-19 15:10:07'),
(37, 'VISION 200 Ltr.', 1, '2021-05-19 15:10:29', '2021-05-19 15:10:29'),
(38, 'VISION 222 Ltr.', 1, '2021-05-19 15:10:50', '2021-05-19 15:10:50'),
(39, 'VISION  Sound Speaker', 1, '2021-05-19 15:11:24', '2021-05-19 15:11:24'),
(40, 'Walton Led TV', 1, '2021-05-19 15:12:03', '2021-05-19 15:12:03'),
(41, 'Walton Fan', 1, '2021-05-19 15:12:20', '2021-05-19 15:12:20'),
(42, 'Walton Rice Cooker', 1, '2021-05-19 15:12:36', '2021-05-19 15:12:36'),
(43, 'Walton Blender', 1, '2021-05-19 15:13:24', '2021-05-19 15:13:24'),
(44, 'Walton Iron', 1, '2021-05-19 15:13:44', '2021-05-19 15:13:44'),
(45, 'Walton Gas Stove', 1, '2021-05-19 15:14:00', '2021-05-19 15:14:00'),
(46, 'Walton Air Condition', 1, '2021-05-19 15:14:36', '2021-05-19 15:14:36'),
(47, 'SONY LED TV', 1, '2021-06-17 11:16:34', '2021-06-17 11:16:34'),
(48, 'RANGS TV', 1, '2021-06-17 11:20:39', '2021-06-17 11:20:39'),
(49, 'RANGS FAN', 1, '2021-06-17 11:21:01', '2021-06-17 11:21:01'),
(50, 'RANGS Refregarator', 1, '2021-06-17 11:21:43', '2021-06-17 11:21:43'),
(51, 'Majesty Gold', 1, '2021-06-17 11:26:06', '2021-06-17 11:26:06'),
(52, 'Caicias 36\'\'', 1, '2021-06-17 11:26:36', '2021-06-17 11:26:36'),
(53, 'Smart Jhilik', 1, '2021-06-17 11:27:15', '2021-06-17 11:27:15'),
(54, 'Celling Fan', 1, '2021-06-20 14:57:35', '2021-06-20 14:57:35'),
(55, 'Heavy Iron', 1, '2021-06-20 14:58:22', '2021-06-20 14:58:22'),
(56, 'smart LED', 1, '2021-06-20 14:59:13', '2021-06-20 14:59:13'),
(57, '18A.Air Condition', 1, '2021-06-20 14:59:56', '2021-06-20 14:59:56'),
(58, '12A(inverter),Air Codition', 1, '2021-06-20 15:00:34', '2021-06-20 15:00:34'),
(59, '24C, Air Condition', 1, '2021-06-20 15:01:17', '2021-06-20 15:01:17'),
(60, '18C,Air Conditioner', 1, '2021-06-20 15:02:05', '2021-06-20 15:02:05'),
(61, 'Stainless Steel,Gas Stove(NG,LPG)', 1, '2021-06-20 15:04:45', '2021-06-20 15:04:45'),
(62, 'Rice Cooker', 1, '2021-06-20 15:05:12', '2021-06-20 15:05:12'),
(63, 'Walton Celling Fan', 1, '2021-06-20 15:16:54', '2021-06-20 15:16:54'),
(65, 'RI-1010CD', 1, '2021-08-10 16:34:58', '2021-08-10 16:34:58'),
(66, 'REK-102', 1, '2021-08-10 16:35:18', '2021-08-10 16:35:18'),
(67, 'RL32G4D2S', 1, '2021-08-10 16:35:44', '2021-08-10 16:35:44'),
(68, 'RL-24G4D2S', 1, '2021-08-10 16:36:09', '2021-08-10 16:36:09'),
(69, 'RMG-23M', 1, '2021-08-10 16:37:18', '2021-08-10 16:37:18'),
(70, 'RL-24G300', 1, '2021-08-10 16:37:43', '2021-08-10 16:37:43'),
(71, 'Pure it Filter', 1, '2021-08-10 16:38:17', '2021-08-10 16:38:17'),
(72, 'klv-48w652d', 1, '2021-08-10 16:38:36', '2021-08-10 16:38:36'),
(73, 'SRC-76695', 1, '2021-08-10 16:38:56', '2021-08-10 16:38:56'),
(74, 'RL-32G402S', 1, '2021-08-10 16:39:10', '2021-08-10 16:39:10'),
(75, 'REK', 1, '2021-08-10 16:39:19', '2021-08-10 16:39:19'),
(76, 'KDL-32R300F', 1, '2021-08-10 16:40:24', '2021-08-10 16:40:24'),
(77, 'RL-40ASS222W', 1, '2021-08-10 16:40:41', '2021-08-10 16:40:41'),
(78, 'REPR-303', 1, '2021-08-10 16:40:56', '2021-08-10 16:40:56'),
(79, 'RL-32AS111W', 1, '2021-08-10 16:41:33', '2021-08-10 16:41:33'),
(80, 'RL-32ASS111W', 1, '2021-08-10 16:41:50', '2021-08-10 16:41:50'),
(81, 'RL-32G403D', 1, '2021-08-10 16:43:54', '2021-08-10 16:43:54'),
(82, 'RL-43ASS333W', 1, '2021-08-10 16:44:38', '2021-08-10 16:44:38'),
(83, 'Pencil Battery', 1, '2021-08-10 16:46:42', '2021-08-10 16:46:42'),
(84, 'Purity Kit', 1, '2021-08-10 16:47:29', '2021-08-10 16:47:29'),
(85, 'RCF 596 MF', 1, '2021-08-10 16:48:01', '2021-08-10 16:48:01'),
(86, 'kDL-50W660G', 1, '2021-08-10 16:48:46', '2021-08-10 16:48:46'),
(87, 'KMW-20DBM', 1, '2021-08-10 16:50:02', '2021-08-10 16:50:02'),
(88, 'MFM-Mesh', 1, '2021-08-10 16:50:34', '2021-08-10 16:50:34'),
(89, 'RI-1004', 1, '2021-08-10 16:53:03', '2021-08-10 16:53:03'),
(90, 'Pure it Classic', 1, '2021-08-10 16:53:31', '2021-08-10 16:53:31'),
(91, 'LED-RL-32EON2SS20', 1, '2021-08-10 16:54:08', '2021-08-10 16:54:08'),
(92, 'RANGS Kattle', 1, '2021-08-10 16:54:47', '2021-08-10 16:54:47'),
(93, 'RR-348BD', 1, '2021-08-10 16:55:30', '2021-08-10 16:55:30'),
(94, 'KHV-295DF', 1, '2021-08-10 16:56:04', '2021-08-10 16:56:04'),
(95, 'Germkill Kit-1500 ltr', 1, '2021-08-10 16:56:40', '2021-08-10 16:56:40'),
(96, 'Khv-333FF', 1, '2021-08-10 16:58:07', '2021-08-10 16:58:07'),
(97, 'KDL-40W650D', 1, '2021-08-11 08:53:25', '2021-08-11 08:53:25'),
(98, 'KDL-32W600D', 1, '2021-08-11 08:53:46', '2021-08-11 08:53:46'),
(99, 'KDL-32G402S/A', 1, '2021-08-11 08:54:18', '2021-08-11 08:54:18'),
(100, 'KLV-40R352E', 1, '2021-08-11 08:55:18', '2021-08-11 08:55:18'),
(101, 'KDL-43W660G', 1, '2021-08-11 08:56:18', '2021-08-11 08:56:18'),
(102, 'RR-350BT', 1, '2021-08-11 08:56:47', '2021-08-11 08:56:47'),
(103, 'RR-275BD', 1, '2021-08-11 08:56:58', '2021-08-11 08:56:58'),
(104, 'RR-142BT', 1, '2021-08-11 08:57:49', '2021-08-11 08:57:49'),
(105, 'RCF-175GD', 1, '2021-08-11 08:58:00', '2021-08-11 08:58:00'),
(106, 'RL-43ASS333', 1, '2021-08-11 08:58:20', '2021-08-11 08:58:20'),
(107, 'RR-226S', 1, '2021-08-11 08:58:30', '2021-08-11 08:58:30'),
(108, 'RR-844G', 1, '2021-08-11 08:58:43', '2021-08-11 08:58:43'),
(109, 'RSDC-18CH', 1, '2021-08-11 08:58:56', '2021-08-11 08:58:56'),
(110, 'ASGA-12AEC', 1, '2021-08-11 08:59:11', '2021-08-11 08:59:11'),
(111, 'RL-32ASS120W', 1, '2021-08-11 09:00:35', '2021-08-11 09:00:35'),
(112, 'RCF-596MC', 1, '2021-08-11 09:01:31', '2021-08-11 09:01:31'),
(113, 'KD-43X8000G', 1, '2021-08-11 09:02:05', '2021-08-11 09:02:05'),
(114, 'KMW-31CS', 1, '2021-08-11 09:02:18', '2021-08-11 09:02:18'),
(115, 'RL-3232EON2SS20', 1, '2021-08-11 09:02:43', '2021-08-11 09:02:43'),
(116, 'RMG-25M', 1, '2021-08-11 09:02:54', '2021-08-11 09:02:54'),
(117, 'KDL--43W660G', 1, '2021-08-11 09:03:45', '2021-08-11 09:03:45'),
(118, 'KHV-430FF', 1, '2021-08-11 09:04:03', '2021-08-11 09:04:03'),
(119, 'RCF-706MF', 1, '2021-08-11 09:04:32', '2021-08-11 09:04:32'),
(120, 'RAC-44SH', 1, '2021-08-11 09:04:46', '2021-08-11 09:04:46'),
(121, 'RCF-26SH', 1, '2021-08-11 09:04:59', '2021-08-11 09:04:59'),
(122, 'RAC-19SH', 1, '2021-08-11 09:05:45', '2021-08-11 09:05:45'),
(123, 'RSDC-24CH', 1, '2021-08-11 09:06:01', '2021-08-11 09:06:01'),
(124, 'RJC-56', 1, '2021-08-11 09:06:27', '2021-08-11 09:06:27'),
(125, 'RJC-36', 1, '2021-08-11 09:06:38', '2021-08-11 09:06:38'),
(126, 'RBT-305', 1, '2021-08-11 09:06:47', '2021-08-11 09:06:47'),
(127, 'RHM-28', 1, '2021-08-11 09:06:56', '2021-08-11 09:06:56'),
(128, 'RBJ-45', 1, '2021-08-11 09:07:10', '2021-08-11 09:07:10'),
(129, 'RB-89', 1, '2021-08-11 09:07:17', '2021-08-11 09:07:17'),
(130, 'REP-332PM', 1, '2021-08-11 09:07:49', '2021-08-11 09:07:49'),
(131, 'RMP-44PM', 1, '2021-08-11 09:08:04', '2021-08-11 09:08:04'),
(132, 'RRMP-44PM', 1, '2021-08-11 09:22:35', '2021-08-11 09:22:35'),
(133, 'SRC-7669S', 1, '2021-08-11 09:22:50', '2021-08-11 09:22:50'),
(134, 'RMC-18', 1, '2021-08-11 09:23:36', '2021-08-11 09:23:36'),
(135, 'KCT-2RF4HELM', 1, '2021-08-11 09:24:21', '2021-08-11 09:24:21'),
(136, 'KCE-SRF1W-ECT', 1, '2021-08-11 09:24:51', '2021-08-11 09:24:51'),
(137, 'KHV-427FF', 1, '2021-08-11 09:25:06', '2021-08-11 09:25:06'),
(138, 'ASGA-18FETA', 1, '2021-08-11 09:25:25', '2021-08-11 09:25:25'),
(139, 'ASGA-24FEETA', 1, '2021-08-11 09:25:41', '2021-08-11 09:25:41'),
(140, 'KHV-138DF', 1, '2021-08-11 09:25:59', '2021-08-11 09:25:59'),
(141, 'RL-21G301', 1, '2021-08-11 09:28:43', '2021-08-11 09:28:43'),
(142, 'RL-40G501', 1, '2021-08-11 09:29:23', '2021-08-11 09:29:23'),
(143, 'RL-43G601', 1, '2021-08-11 09:29:37', '2021-08-11 09:29:37'),
(144, 'Aura Smart', 1, '2021-08-11 09:30:07', '2021-08-11 09:30:07'),
(145, 'Harmony Smart', 1, '2021-08-11 09:30:32', '2021-08-11 09:30:32'),
(146, 'Jhilik Smart', 1, '2021-08-11 09:31:05', '2021-08-11 09:31:05'),
(147, 'kwm-k17020B', 1, '2021-08-11 09:31:31', '2021-08-11 09:31:31'),
(148, 'KWM-KT8020B', 1, '2021-08-11 09:31:50', '2021-08-11 09:31:50'),
(149, 'KLV-32W602D', 1, '2021-08-11 09:32:14', '2021-08-11 09:32:14'),
(150, 'KLV-40W650D', 1, '2021-08-11 09:32:31', '2021-08-11 09:32:31'),
(151, 'RSB-10', 1, '2021-08-11 09:33:35', '2021-08-11 09:33:35'),
(152, 'KHV-279GDF', 1, '2021-08-11 09:35:18', '2021-08-11 09:35:18'),
(153, 'RW-56', 1, '2021-08-11 09:36:04', '2021-08-11 09:36:04'),
(154, 'RL-32EON2SS2O', 1, '2021-08-11 09:36:43', '2021-08-11 09:36:43'),
(155, 'RL-4343ASS333', 1, '2021-08-11 09:37:00', '2021-08-11 09:37:00'),
(156, 'KSV-18BDINV', 1, '2021-08-11 09:37:36', '2021-08-11 09:37:36'),
(157, 'LS-12N3WG12', 1, '2021-08-11 09:37:59', '2021-08-11 09:37:59'),
(158, 'LS-12IN3WG12', 1, '2021-08-11 09:38:22', '2021-08-11 09:38:22'),
(159, 'RAC-14SH', 1, '2021-08-11 09:38:43', '2021-08-11 09:38:43'),
(160, 'RANGS A/C', 1, '2021-08-12 12:52:07', '2021-08-12 12:52:07'),
(161, 'OVEN', 1, '2021-08-12 12:55:58', '2021-08-12 12:55:58'),
(162, 'Electronics', 1, '2021-09-07 15:18:35', '2021-09-07 15:18:35'),
(163, 'Glass Door Freezer', 1, '2021-09-12 16:06:50', '2021-09-12 16:06:50'),
(164, 'General A/C', 1, '2021-09-12 16:32:08', '2021-09-12 16:32:08'),
(165, 'Dry Iron', 1, '2021-09-12 16:47:17', '2021-09-12 16:47:17'),
(166, 'Kettle', 1, '2021-09-12 17:21:24', '2021-09-12 17:21:24'),
(167, 'Rangs Toaster', 1, '2021-09-12 17:28:35', '2021-09-12 17:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_category_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `expense_by` bigint(20) UNSIGNED NOT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_category_id`, `date`, `amount`, `added_by`, `expense_by`, `purpose`, `created_at`, `updated_at`) VALUES
(1, 6, '2021-09-07', 123123, 1, 3, 'rwerwer', '2021-09-07 15:43:44', '2021-09-07 15:43:44');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Employees Salary', 1, NULL, NULL),
(2, 'Labour Cost', 1, NULL, NULL),
(3, 'Transport Cost', 1, NULL, NULL),
(4, 'Office Expense', 1, NULL, NULL),
(5, 'Others', 1, NULL, NULL),
(6, 'AAA', 1, '2021-09-07 15:43:07', '2021-09-07 15:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(3, 'App\\Models\\Product', 20, 'b295f0a3-baf5-40b4-bd6f-5c8d292ce508', 'product_image', 'Band-5-Mobile-_1_01_3.webp', '5xiTYS8QBL5ks4Hl022lp0OxpaWeW4-metaQmFuZC01LU1vYmlsZS1fMV8wMV8zLndlYnA=-.webp', 'image/webp', 'product_images', 'product_images', 106522, '[]', '[]', '[]', '[]', 3, '2021-04-13 09:48:18', '2021-04-13 09:48:18'),
(4, 'App\\Models\\Product', 21, '07729dc5-dea1-4b7c-94ef-1a1098dfa32b', 'product_image', 'php_8_error.png', 'gHwbuq9lN4Th2w0RdxThrxKPpyzm2I-metacGhwXzhfZXJyb3IucG5n-.png', 'image/png', 'product_images', 'product_images', 47093, '[]', '[]', '[]', '[]', 4, '2021-04-13 18:16:38', '2021-04-13 18:16:38'),
(5, 'App\\Models\\Product', 22, '2eca7726-9c34-488c-afa0-00bdaa78a5a4', 'product_image', 'Untitled.png', 'FZUuF16XIMlTLkLqs20aHEZSEThSgE-metaVW50aXRsZWQucG5n-.png', 'image/png', 'product_images', 'product_images', 179234, '[]', '[]', '[]', '[]', 5, '2021-04-13 21:25:21', '2021-04-13 21:25:21'),
(10, 'App\\Models\\BannerImage', 3, 'fb3a5bff-5ab1-453c-b578-48cd6417527a', 'banner_image', 'rsz_1rsz_6566', 'rsz_1rsz_6566.jpg', 'image/jpeg', 'banner_images', 'banner_images', 482896, '[]', '[]', '[]', '[]', 10, '2021-04-14 12:43:00', '2021-04-14 12:43:00'),
(12, 'App\\Models\\BannerImage', 2, '1c27773b-5390-4d74-8010-c0c9fa79bfe7', 'banner_image', '2', '2.jpg', 'image/jpeg', 'banner_images', 'banner_images', 140792, '[]', '[]', '[]', '[]', 12, '2021-04-14 12:54:10', '2021-04-14 12:54:10'),
(13, 'App\\Models\\BannerImage', 4, '5f935279-ad14-4a90-af51-80eea6a574d7', 'banner_image', '3', '3.jpg', 'image/jpeg', 'banner_images', 'banner_images', 123476, '[]', '[]', '[]', '[]', 13, '2021-04-14 12:57:54', '2021-04-14 12:57:54'),
(15, 'App\\Models\\BannerImage', 5, 'b607250b-7ad1-431b-991d-72da08408317', 'banner_image', 'small_b-1', 'small_b-1.jpg', 'image/jpeg', 'banner_images', 'banner_images', 59040, '[]', '[]', '[]', '[]', 15, '2021-04-14 13:14:01', '2021-04-14 13:14:01'),
(16, 'App\\Models\\BannerImage', 6, '952a55e2-3ef4-4e5d-8601-a5e4e62bd81f', 'banner_image', 'sb-2', 'sb-2.jpg', 'image/jpeg', 'banner_images', 'banner_images', 80531, '[]', '[]', '[]', '[]', 16, '2021-04-14 13:16:49', '2021-04-14 13:16:49'),
(18, 'App\\Models\\BannerImage', 7, 'a829b866-9c06-4ba0-94fb-aeb1e3d13f11', 'banner_image', 'sb-3', 'sb-3.jpg', 'image/jpeg', 'banner_images', 'banner_images', 91366, '[]', '[]', '[]', '[]', 18, '2021-04-14 13:22:32', '2021-04-14 13:22:32'),
(19, 'App\\Models\\Product', 23, '15dae62f-f6c2-4475-b87b-3ea0aad36a04', 'product_image', 'df2-18-rn.jpg', 'ZmWHplOnyWRQgJrseIxXxybFZiJwP5-metaZGYyLTE4LXJuLmpwZw==-.jpg', 'image/jpeg', 'product_images', 'product_images', 20333, '[]', '[]', '[]', '[]', 19, '2021-04-14 14:08:16', '2021-04-14 14:08:16'),
(20, 'App\\Models\\Product', 24, '13cb0535-5e5a-4c1e-87a6-3d3dd769cbb4', 'product_image', 'dd2-29.jpg', '0sVMMydZKkzDqWasKuVWlGfXecKUel-metaZGQyLTI5LmpwZw==-.jpg', 'image/jpeg', 'product_images', 'product_images', 12898, '[]', '[]', '[]', '[]', 20, '2021-04-14 14:13:47', '2021-04-14 14:13:47'),
(21, 'App\\Models\\Product', 25, 'f7fb2c63-2d48-49fc-8bff-7b10dcebf75b', 'product_image', 'wide_voltage-sb_2.jpg', '7NlPSS3BAowvgGzt5RB6yvCmXBIxIX-metad2lkZV92b2x0YWdlLXNiXzIuanBn-.jpg', 'image/jpeg', 'product_images', 'product_images', 19370, '[]', '[]', '[]', '[]', 21, '2021-04-14 14:51:33', '2021-04-14 14:51:33'),
(22, 'App\\Models\\Product', 26, 'ee5f70a0-4c99-4995-b278-1cb3a5c79bc0', 'product_image', 'wifi-inv-sb_2.jpg', '9Qwgb6Sezt8vzGLS8RGc0MOXJH7Nzw-metad2lmaS1pbnYtc2JfMi5qcGc=-.jpg', 'image/jpeg', 'product_images', 'product_images', 20100, '[]', '[]', '[]', '[]', 22, '2021-04-14 14:52:51', '2021-04-14 14:52:51'),
(23, 'App\\Models\\Product', 27, '816f858b-c4a4-4232-8cff-312cbeff9cbb', 'product_image', 'a7000gotv.jpg', 'Nf7y89bWNbg5feGMGF7SLR5iokoEd9-metaYTcwMDBnb3R2LmpwZw==-.jpg', 'image/jpeg', 'product_images', 'product_images', 31268, '[]', '[]', '[]', '[]', 23, '2021-04-14 14:54:48', '2021-04-14 14:54:48'),
(24, 'App\\Models\\Product', 28, '053b1c7f-7492-4987-b649-bf692a149085', 'product_image', 'twin_tub_semi_auto_washing_machine.jpg', 'qCmcE8I0o7cNO9mJOhzgPDFjwiZEKG-metadHdpbl90dWJfc2VtaV9hdXRvX3dhc2hpbmdfbWFjaGluZS5qcGc=-.jpg', 'image/jpeg', 'product_images', 'product_images', 30700, '[]', '[]', '[]', '[]', 24, '2021-04-14 14:56:09', '2021-04-14 14:56:09'),
(25, 'App\\Models\\Product', 29, 'bc3b9d02-11ef-45e7-9949-a825b96a8758', 'product_image', 'srcdb9918prime.jpg', 'dEzZIEK8tIJiCO3T3eOcMjxlmKsVtT-metac3JjZGI5OTE4cHJpbWUuanBn-.jpg', 'image/jpeg', 'product_images', 'product_images', 24555, '[]', '[]', '[]', '[]', 25, '2021-04-14 14:57:20', '2021-04-14 14:57:20'),
(26, 'App\\Models\\Product', 66, '2a54b496-9e65-4d79-942a-52db787d08d9', 'product_image', '7330e6d37c178d8930475bcc68628ca3.jpg', 'Yl4txWeasAn6KjOUa2286QdGQ0fMQR-metaNzMzMGU2ZDM3YzE3OGQ4OTMwNDc1YmNjNjg2MjhjYTMuanBn-.jpg', 'image/jpeg', 'product_images', 'product_images', 168291, '[]', '[]', '[]', '[]', 26, '2021-09-05 15:31:27', '2021-09-05 15:31:27'),
(30, 'App\\Models\\Product', 68, '5ab50be2-1640-489c-a0d9-d0875f607912', 'product_image', 'KDL-32W600D.jpg', 'z0Oh38406krGORQB2hpSguIkNFPrHU-metaS0RMLTMyVzYwMEQuanBn-.jpg', 'image/jpeg', 'product_images', 'product_images', 63480, '[]', '[]', '[]', '[]', 28, '2021-09-07 16:20:34', '2021-09-07 16:20:34'),
(31, 'App\\Models\\Product', 69, 'ccd26f40-253f-42d5-9490-1057fd780ba6', 'product_image', 'KDL-32W600D.jpg', 'xcSJyRwpVDX8KXkL34ra2ejlk7BQgF-metaS0RMLTMyVzYwMEQuanBn-.jpg', 'image/jpeg', 'product_images', 'product_images', 63480, '[]', '[]', '[]', '[]', 29, '2021-09-07 16:28:01', '2021-09-07 16:28:01'),
(32, 'App\\Models\\Product', 70, '588f730c-f790-437f-a08d-6d5b11a814a2', 'product_image', 'RL-32G402S.jpg', 'r2A9qKsCKC38QJFDUKb6YRbqbJ6eIS-metaUkwtMzJHNDAyUy5qcGc=-.jpg', 'image/jpeg', 'product_images', 'product_images', 38249, '[]', '[]', '[]', '[]', 30, '2021-09-07 16:32:21', '2021-09-07 16:32:21'),
(33, 'App\\Models\\Product', 71, 'b2d41c51-2747-401e-8cb8-07e70a8a8fc9', 'product_image', 'RL-32G403D.jpg', '6iB5dYO3viC3EhmoPbN3sDVEnEmk0w-metaUkwtMzJHNDAzRC5qcGc=-.jpg', 'image/jpeg', 'product_images', 'product_images', 35302, '[]', '[]', '[]', '[]', 31, '2021-09-07 16:40:45', '2021-09-07 16:40:45'),
(34, 'App\\Models\\Product', 72, '8a5863bd-48d8-4482-9ccb-7510bbf189e2', 'product_image', 'RL-32G402S.jpg', '4oyzTcmSPRTlVX8ezZLj8BzkVfJakO-metaUkwtMzJHNDAyUy5qcGc=-.jpg', 'image/jpeg', 'product_images', 'product_images', 38249, '[]', '[]', '[]', '[]', 32, '2021-09-07 16:45:51', '2021-09-07 16:45:51'),
(35, 'App\\Models\\Product', 73, '88665e8c-cd7c-48ca-9490-58e6ebc5e6d7', 'product_image', 'KLV-40R352E.jpg', '4Dbdv81sW40U6Ucsye2L34CEdaoYnF-metaS0xWLTQwUjM1MkUuanBn-.jpg', 'image/jpeg', 'product_images', 'product_images', 34259, '[]', '[]', '[]', '[]', 33, '2021-09-07 16:56:20', '2021-09-07 16:56:20'),
(36, 'App\\Models\\Product', 74, '43f0e26b-86b4-4bec-8375-3a39a768e51f', 'product_image', 'KDL-32W600D.jpg', '4wZB8gPZHcT1uWZ7RnJR05eIAfInZ7-metaS0RMLTMyVzYwMEQuanBn-.jpg', 'image/jpeg', 'product_images', 'product_images', 63480, '[]', '[]', '[]', '[]', 34, '2021-09-07 17:00:04', '2021-09-07 17:00:04'),
(37, 'App\\Models\\Product', 64, '4d5359b5-d97a-47ae-8f45-47035a0ea3a4', 'product_image', 'kdl-50W660G.jpg', 'WRE8hfa1sdfbsOJRTUgf83mYjvffM0-metaa2RsLTUwVzY2MEcuanBn-.jpg', 'image/jpeg', 'product_images', 'product_images', 54117, '[]', '[]', '[]', '[]', 35, '2021-09-07 17:08:25', '2021-09-07 17:08:25'),
(38, 'App\\Models\\Product', 75, 'cdaf6d21-0d67-46a5-91f9-5f6bcd65d586', 'product_image', 'RL-32G403D.jpg', 'S8W6keWFllbW0c8dWAbyzUOpI8snsy-metaUkwtMzJHNDAzRC5qcGc=-.jpg', 'image/jpeg', 'product_images', 'product_images', 35302, '[]', '[]', '[]', '[]', 36, '2021-09-07 17:13:49', '2021-09-07 17:13:49'),
(39, 'App\\Models\\Product', 76, 'fbb40b0a-51df-4e40-aaa3-96a17b26ceff', 'product_image', 'RL-40ASS222W.jpg', '8Alg44bDQvM9oEebrxkaD59kFV9hCM-metaUkwtNDBBU1MyMjJXLmpwZw==-.jpg', 'image/jpeg', 'product_images', 'product_images', 32067, '[]', '[]', '[]', '[]', 37, '2021-09-07 17:23:21', '2021-09-07 17:23:21'),
(40, 'App\\Models\\Product', 77, 'a2aa4cd9-0df3-49a3-829f-5b6b1ae735bf', 'product_image', 'RR-350.jpg', 'BSzCDxHIJ1iE9nYJZ8nhJ12BFxxmuT-metaUlItMzUwLmpwZw==-.jpg', 'image/jpeg', 'product_images', 'product_images', 54760, '[]', '[]', '[]', '[]', 38, '2021-09-07 17:29:52', '2021-09-07 17:29:52'),
(41, 'App\\Models\\Product', 78, '99d867e4-bd44-48dc-b140-310d33af021c', 'product_image', 'RR-350.jpg', '5KD7HbY8iDcrYUa4KvSsHcz8htjcaP-metaUlItMzUwLmpwZw==-.jpg', 'image/jpeg', 'product_images', 'product_images', 54760, '[]', '[]', '[]', '[]', 39, '2021-09-08 17:27:33', '2021-09-08 17:27:33'),
(43, 'App\\Models\\Product', 80, 'f78ae31d-e31a-4f51-85d1-628f1b952c56', 'product_image', 'RR-350.jpg', '2piba3fJe6WXvAazwufWd8rjQzhWpM-metaUlItMzUwLmpwZw==-.jpg', 'image/jpeg', 'product_images', 'product_images', 54760, '[]', '[]', '[]', '[]', 41, '2021-09-12 16:03:15', '2021-09-12 16:03:15'),
(44, 'App\\Models\\Product', 81, 'de3a6634-5227-47f4-ad8c-3327b99a9c58', 'product_image', 'RR-350.jpg', 'JfhVsNNbbf2M2MClRfwZJj38dtFneo-metaUlItMzUwLmpwZw==-.jpg', 'image/jpeg', 'product_images', 'product_images', 54760, '[]', '[]', '[]', '[]', 42, '2021-09-12 16:04:52', '2021-09-12 16:04:52'),
(45, 'App\\Models\\Product', 79, 'c4e154ad-1023-4121-9a81-e54521bd184c', 'product_image', 'Glass dor freezer red.jpg', 'MNH2PVCGJYiEco0YoOaFvDs1EhNgTL-metaR2xhc3MgZG9yIGZyZWV6ZXIgcmVkLmpwZw==-.jpg', 'image/jpeg', 'product_images', 'product_images', 13267, '[]', '[]', '[]', '[]', 43, '2021-09-12 16:10:28', '2021-09-12 16:10:28'),
(46, 'App\\Models\\Product', 82, '27aac4cd-79cf-47bc-b603-4476933e570c', 'product_image', 'kdl-50W660G.jpg', 'TeZLxANRTpdWbTFlfkfI85rlBd4jAr-metaa2RsLTUwVzY2MEcuanBn-.jpg', 'image/jpeg', 'product_images', 'product_images', 54117, '[]', '[]', '[]', '[]', 44, '2021-09-12 16:19:12', '2021-09-12 16:19:12'),
(47, 'App\\Models\\Product', 83, 'd84d160d-fbe6-4d4e-a2fa-4d230f8590b5', 'product_image', '202106290943461.jpg', 'PeH8DdUB6x0fC1h5t9xl9BqxagoPfK-metaMjAyMTA2MjkwOTQzNDYxLmpwZw==-.jpg', 'image/jpeg', 'product_images', 'product_images', 44885, '[]', '[]', '[]', '[]', 45, '2021-09-12 16:22:51', '2021-09-12 16:22:51'),
(48, 'App\\Models\\Product', 84, '2818e9c9-e6b4-4d08-af27-c0daf6edfb9e', 'product_image', '161760061002.jpg', 'N1lulPVDmehd2AUEnZ7l7v7eH1d2FC-metaMTYxNzYwMDYxMDAyLmpwZw==-.jpg', 'image/jpeg', 'product_images', 'product_images', 30859, '[]', '[]', '[]', '[]', 46, '2021-09-12 16:25:00', '2021-09-12 16:25:00'),
(49, 'App\\Models\\Product', 85, 'e39f26ae-7394-4b7a-b216-4c4e443773cc', 'product_image', 'AC.jpg', 'UeBuVmwKOmUmYfYwaMitM0KzA59Wpd-metaQUMuanBn-.jpg', 'image/jpeg', 'product_images', 'product_images', 8702, '[]', '[]', '[]', '[]', 47, '2021-09-12 16:29:11', '2021-09-12 16:29:11'),
(50, 'App\\Models\\Product', 86, '9f94c047-7017-4fdb-9d38-82e297c6de0b', 'product_image', 'AC 22.jpg', 'LTt9PKbZPd3LmQGY6wPU5yihUMUw2y-metaQUMgMjIuanBn-.jpg', 'image/jpeg', 'product_images', 'product_images', 11405, '[]', '[]', '[]', '[]', 48, '2021-09-12 16:35:46', '2021-09-12 16:35:46'),
(51, 'App\\Models\\Product', 87, '8dae20dd-969c-4430-88ff-d009264b2a46', 'product_image', 'Dry Iron.jpg', 'ARb0Aihatb9SjV0nFKuvthdz9aZfGA-metaRHJ5IElyb24uanBn-.jpg', 'image/jpeg', 'product_images', 'product_images', 17214, '[]', '[]', '[]', '[]', 49, '2021-09-12 16:49:26', '2021-09-12 16:49:26'),
(52, 'App\\Models\\Product', 88, 'ecb8abd5-e2f1-4aff-993e-162ad1cffa1f', 'product_image', '202003241156511.jpg', 'myXGcXo6JDe4fCrZInNoEqwUdGJMUH-metaMjAyMDAzMjQxMTU2NTExLmpwZw==-.jpg', 'image/jpeg', 'product_images', 'product_images', 24439, '[]', '[]', '[]', '[]', 50, '2021-09-12 16:55:48', '2021-09-12 16:55:48'),
(53, 'App\\Models\\Product', 89, '628d8cab-9f93-4b1a-84e4-dec5b71d7d9b', 'product_image', 'RL-32G402S.jpg', 'JJvTpOlBGIIbu8Gh9tKJG1Mz1QcsVX-metaUkwtMzJHNDAyUy5qcGc=-.jpg', 'image/jpeg', 'product_images', 'product_images', 38249, '[]', '[]', '[]', '[]', 51, '2021-09-12 16:57:23', '2021-09-12 16:57:23'),
(54, 'App\\Models\\Product', 90, 'ad4315b4-70f3-460f-a691-7f3d7ca52f88', 'product_image', 'Frezer.jpg', 'FxZueeKU5YDDC4PIu0vJ745rpRGDWO-metaRnJlemVyLmpwZw==-.jpg', 'image/jpeg', 'product_images', 'product_images', 18453, '[]', '[]', '[]', '[]', 52, '2021-09-12 17:01:52', '2021-09-12 17:01:52'),
(55, 'App\\Models\\Product', 91, '08220982-7ddd-49ad-8639-0d48b7198310', 'product_image', 'AC 22.jpg', 'R2tsFtT5wIhc0bUTRUmfBAAQQ1XKVr-metaQUMgMjIuanBn-.jpg', 'image/jpeg', 'product_images', 'product_images', 11405, '[]', '[]', '[]', '[]', 53, '2021-09-12 17:04:09', '2021-09-12 17:04:09'),
(56, 'App\\Models\\Product', 92, '62315d6a-3d42-4992-a5d9-6522e6ec1e36', 'product_image', 'AC 22.jpg', 'xdBNVsUnZfM11YdzVwybec74BQAG8D-metaQUMgMjIuanBn-.jpg', 'image/jpeg', 'product_images', 'product_images', 11405, '[]', '[]', '[]', '[]', 54, '2021-09-12 17:08:52', '2021-09-12 17:08:52'),
(57, 'App\\Models\\Product', 93, 'ef3a1511-54ba-47b3-9eee-8a64e594eeed', 'product_image', 'Frezer.jpg', 'NfBQR89yiKY5dKFXULWw2egP88LAS7-metaRnJlemVyLmpwZw==-.jpg', 'image/jpeg', 'product_images', 'product_images', 23143, '[]', '[]', '[]', '[]', 55, '2021-09-12 17:11:28', '2021-09-12 17:11:28'),
(58, 'App\\Models\\Product', 94, '91ac9d64-2125-4251-b28a-284b3acea227', 'product_image', 'Frezer.jpg', 'hY6nMktkGeJmCCDVx3rUxTjGzFfbNZ-metaRnJlemVyLmpwZw==-.jpg', 'image/jpeg', 'product_images', 'product_images', 23143, '[]', '[]', '[]', '[]', 56, '2021-09-12 17:12:58', '2021-09-12 17:12:58'),
(59, 'App\\Models\\Product', 95, '9a6a7213-c559-4492-961f-ec1804ef4330', 'product_image', 'Rang AC.jpg', '5Cni8eW6izffBYVYyGCvNNkGNRJCNH-metaUmFuZyBBQy5qcGc=-.jpg', 'image/jpeg', 'product_images', 'product_images', 8989, '[]', '[]', '[]', '[]', 57, '2021-09-12 17:15:27', '2021-09-12 17:15:27'),
(60, 'App\\Models\\Product', 96, '4757a7d3-a5de-4daf-bf0c-832ba4a1894e', 'product_image', 'AC.jpg', 'PHz9ZiuYlfCThC0Zk5u2mbczU3MAWN-metaQUMuanBn-.jpg', 'image/jpeg', 'product_images', 'product_images', 8702, '[]', '[]', '[]', '[]', 58, '2021-09-12 17:17:08', '2021-09-12 17:17:08'),
(61, 'App\\Models\\Product', 97, '77c34abb-803e-42a1-8b68-b44672898a30', 'product_image', 'Rang AC.jpg', '3w3NPc54J8eMdqbYzTINm1tdXUoaeX-metaUmFuZyBBQy5qcGc=-.jpg', 'image/jpeg', 'product_images', 'product_images', 12659, '[]', '[]', '[]', '[]', 59, '2021-09-12 17:22:43', '2021-09-12 17:22:43'),
(62, 'App\\Models\\Product', 98, '482074e1-6033-4d2b-9912-3c7dc15c0886', 'product_image', 'Rice Cooker.jpg', 'nDBNEblRrrj32OAi40Kh8zTusHmA7c-metaUmljZSBDb29rZXIuanBn-.jpg', 'image/jpeg', 'product_images', 'product_images', 15708, '[]', '[]', '[]', '[]', 60, '2021-09-12 17:25:45', '2021-09-12 17:25:45'),
(63, 'App\\Models\\Product', 99, '11068f36-f961-49bb-bd14-2d4a448047e4', 'product_image', 'Toaster.jpg', 'W7loSZYRWf3fTtaLQ5HQxFeozTpJsB-metaVG9hc3Rlci5qcGc=-.jpg', 'image/jpeg', 'product_images', 'product_images', 14361, '[]', '[]', '[]', '[]', 61, '2021-09-12 17:30:15', '2021-09-12 17:30:15'),
(64, 'App\\Models\\Product', 100, 'd2cb979b-00f8-4d2c-8715-0c496bc77d7b', 'product_image', 'Toaster.jpg', 'go7cmqEYd8tMezvTlXQw7Wy8BnISuv-metaVG9hc3Rlci5qcGc=-.jpg', 'image/jpeg', 'product_images', 'product_images', 14361, '[]', '[]', '[]', '[]', 62, '2021-09-12 17:31:38', '2021-09-12 17:31:38'),
(65, 'App\\Models\\Product', 101, '71aa637b-c2c3-4c48-9369-169022ff4235', 'product_image', 'Hand.jpg', 'iwcab8PmkAgHUpSyCsXmKNungxrYwt-metaSGFuZC5qcGc=-.jpg', 'image/jpeg', 'product_images', 'product_images', 4456, '[]', '[]', '[]', '[]', 63, '2021-09-12 17:34:50', '2021-09-12 17:34:50'),
(66, 'App\\Models\\Product', 102, 'd0ff97ad-401b-4e28-a6d6-a4337caa2c40', 'product_image', 'jfd.jpg', 'UCyqQGDtmqaVG5IhbbqqX0L1Y4ml9U-metaamZkLmpwZw==-.jpg', 'image/jpeg', 'product_images', 'product_images', 15837, '[]', '[]', '[]', '[]', 64, '2021-09-12 17:57:22', '2021-09-12 17:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2020_09_19_031007_create_categories_table', 1),
(7, '2020_09_19_204723_create_sessions_table', 1),
(8, '2020_09_19_204728_create_app_configs_table', 1),
(9, '2020_09_20_042529_create_product_types_table', 1),
(10, '2020_09_20_161604_create_brands_table', 1),
(11, '2020_09_20_161605_create_products_table', 1),
(12, '2020_09_22_102844_create_purchases_table', 1),
(13, '2020_09_22_281734_create_purchase_details_table', 1),
(14, '2020_09_23_113648_create_expense_categories_table', 1),
(15, '2020_09_23_113732_create_expenses_table', 1),
(16, '2020_09_25_081752_create_sales_table', 1),
(17, '2020_09_25_081753_create_sale_details_table', 1),
(18, '2020_10_03_162053_create_permission_tables', 1),
(19, '2020_11_22_171727_create_sale_returns_table', 1),
(20, '2021_03_21_135231_create_purchase_returns_table', 1),
(21, '2021_04_07_160543_create_media_table', 1),
(22, '2021_04_08_121746_create_banner_images_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 26),
(4, 'App\\Models\\User', 28),
(4, 'App\\Models\\User', 29),
(4, 'App\\Models\\User', 32),
(6, 'App\\Models\\User', 5),
(6, 'App\\Models\\User', 27),
(6, 'App\\Models\\User', 30);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'appConfig', 'web', '2021-04-12 09:48:54', '2021-04-12 09:48:54'),
(2, 'category.index', 'web', '2021-04-12 09:48:54', '2021-04-12 09:48:54'),
(3, 'category.create', 'web', '2021-04-12 09:48:54', '2021-04-12 09:48:54'),
(4, 'category.edit', 'web', '2021-04-12 09:48:54', '2021-04-12 09:48:54'),
(5, 'category.delete', 'web', '2021-04-12 09:48:54', '2021-04-12 09:48:54'),
(6, 'product_type.index', 'web', '2021-04-12 09:48:54', '2021-04-12 09:48:54'),
(7, 'product_type.create', 'web', '2021-04-12 09:48:54', '2021-04-12 09:48:54'),
(8, 'product_type.edit', 'web', '2021-04-12 09:48:54', '2021-04-12 09:48:54'),
(9, 'product_type.delete', 'web', '2021-04-12 09:48:54', '2021-04-12 09:48:54'),
(10, 'brand.index', 'web', '2021-04-12 09:48:54', '2021-04-12 09:48:54'),
(11, 'brand.create', 'web', '2021-04-12 09:48:54', '2021-04-12 09:48:54'),
(12, 'brand.edit', 'web', '2021-04-12 09:48:54', '2021-04-12 09:48:54'),
(13, 'brand.delete', 'web', '2021-04-12 09:48:54', '2021-04-12 09:48:54'),
(14, 'product.index', 'web', '2021-04-12 09:48:54', '2021-04-12 09:48:54'),
(15, 'product.create', 'web', '2021-04-12 09:48:54', '2021-04-12 09:48:54'),
(16, 'product.edit', 'web', '2021-04-12 09:48:54', '2021-04-12 09:48:54'),
(17, 'product.delete', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(18, 'expense.index', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(19, 'expense.create', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(20, 'expense.edit', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(21, 'expense.delete', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(22, 'expense_category.index', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(23, 'expense_category.create', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(24, 'expense_category.edit', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(25, 'expense_category.delete', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(26, 'purchase.index', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(27, 'purchase.create', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(28, 'purchase.show', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(29, 'purchase.edit', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(30, 'purchase.delete', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(31, 'sale.index', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(32, 'sale.create', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(33, 'sale.show', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(34, 'sale.edit', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(35, 'sale.delete', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(36, 'sale_return.index', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(37, 'sale_return.show', 'web', '2021-04-12 09:48:55', '2021-04-12 09:48:55'),
(38, 'sale_return.manage', 'web', '2021-04-12 09:48:56', '2021-04-12 09:48:56'),
(39, 'sale_return.delete', 'web', '2021-04-12 09:48:56', '2021-04-12 09:48:56'),
(40, 'purchase_return.index', 'web', '2021-04-12 09:48:56', '2021-04-12 09:48:56'),
(41, 'purchase_return.show', 'web', '2021-04-12 09:48:56', '2021-04-12 09:48:56'),
(42, 'purchase_return.manage', 'web', '2021-04-12 09:48:56', '2021-04-12 09:48:56'),
(43, 'purchase_return.delete', 'web', '2021-04-12 09:48:56', '2021-04-12 09:48:56'),
(44, 'user.index', 'web', '2021-04-12 09:48:56', '2021-04-12 09:48:56'),
(45, 'user.create', 'web', '2021-04-12 09:48:56', '2021-04-12 09:48:56'),
(46, 'user.show', 'web', '2021-04-12 09:48:56', '2021-04-12 09:48:56'),
(47, 'user.edit', 'web', '2021-04-12 09:48:56', '2021-04-12 09:48:56'),
(48, 'user.delete', 'web', '2021-04-12 09:48:56', '2021-04-12 09:48:56'),
(49, 'report.purchase', 'web', '2021-04-12 09:48:56', '2021-04-12 09:48:56'),
(50, 'report.sale', 'web', '2021-04-12 09:48:57', '2021-04-12 09:48:57'),
(51, 'report.stock', 'web', '2021-04-12 09:48:57', '2021-04-12 09:48:57'),
(52, 'report.expense', 'web', '2021-04-12 09:48:57', '2021-04-12 09:48:57'),
(53, 'report.transaction', 'web', '2021-04-12 09:48:57', '2021-04-12 09:48:57'),
(54, 'banner_image.index', 'web', '2021-04-12 09:48:57', '2021-04-12 09:48:57'),
(55, 'banner_image.create', 'web', '2021-04-12 09:48:57', '2021-04-12 09:48:57'),
(56, 'banner_image.edit', 'web', '2021-04-12 09:48:57', '2021-04-12 09:48:57'),
(57, 'banner_image.delete', 'web', '2021-04-12 09:48:57', '2021-04-12 09:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `product_type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_stock` int(11) NOT NULL DEFAULT 0,
  `purchase_return_stock` int(11) NOT NULL DEFAULT 0,
  `sale_return_stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `product_type_id`, `name`, `model_name`, `description`, `final_stock`, `purchase_return_stock`, `sale_return_stock`, `created_at`, `updated_at`) VALUES
(24, 24, 23, 'Refrigerator 229 Ltr Singer Black', 'SRREF-SINGER-DD2-29-BG', '- 229 Ltr Capacity<br>\n- Frost Refrigerator<br>\n- Bottom Mounted<br>\n- R600a Environment Friendly Gas<br>\n- Antibacterial Black Reflection Glass Door<br>\n- Stylish Interior Light<br>\n- Fresh & Cool Technology<br>\n- 10 Years Compressor + 2 Year Parts & Service Warranty<br>\n- মাসিক কিস্তি (১২ মাসে): ৳ ৩,১৯৪<br>', 0, 0, 0, '2021-04-14 14:13:46', '2021-04-14 14:46:40'),
(25, 25, 24, 'Air Conditioner 1.0 Ton Singer Wide Voltage', 'SRAC-SAS124L78WVMGA', '- 229 Ltr Capacity<br> - Frost Refrigerator<br> - Bottom Mounted<br> - R600a Environment Friendly Gas<br> - Antibacterial Black Reflection Glass Door<br> - Stylish Interior Light<br> - Fresh & Cool Technology<br> - 10 Years Compressor + 2 Year Parts & Service Warranty<br> - মাসিক কিস্তি (১২ মাসে): ৳ ৩,১৯৪<br>', 0, 0, 0, '2021-04-14 14:51:32', '2021-04-14 14:51:32'),
(27, 22, 27, 'SINGER GOOGLE ANDROID TV (S32)', 'SLE32A7000GOTV', 'Android 9.0 (Pie)\nOfficial Netflix Built-in\nChromecast Built-in\nGoogle Play Store\nGoogle Assistant\nVoice Browser\nNew UI\nGoogle Eco System\nPureSound', 0, 0, 0, '2021-04-14 14:54:48', '2021-04-14 14:54:48'),
(28, 25, 29, 'Washing Machine Singer 8 KG Top Loading', 'Model SRWM-STD80SFDA', 'Semi Auto\nFloral Glass Door\nUser Friendly and Energy Efficient\n2 years Full & 5 Years Motor Warranty', 0, 0, 0, '2021-04-14 14:56:09', '2021-04-14 14:56:09'),
(31, 24, 36, 'Walton Fridge', 'WFC-3A7-GDNE-XX', 'Color: M27', -2, 0, 1, '2021-04-27 13:56:25', '2021-06-20 16:53:34'),
(32, 24, 36, 'Walton Fridge 2', 'WFC-3D8-GDXX', 'Color: M57', 0, 0, 0, '2021-04-27 14:04:21', '2021-06-20 16:53:34'),
(33, 24, 46, 'Walton Fridge', 'WNH-3H6-GDEL-XX', 'NO Color', 0, 0, 0, '2021-05-19 14:14:03', '2021-05-19 14:14:03'),
(34, 24, 42, 'Walton Refrigerator', 'WFD-1F3-GDEL-XX', 'BK25', 2, 0, 0, '2021-05-19 14:18:54', '2021-06-20 16:51:30'),
(35, 24, 41, 'Walton Refrigerator', 'WFD-1D4-GDEL-XX', 'M60', 0, 0, 0, '2021-05-19 14:20:22', '2021-05-19 14:20:22'),
(36, 24, 49, 'Walton Refrigerator', 'WCF-1D5-GDEL-XX', 'No Color', 0, 0, 0, '2021-05-19 14:23:34', '2021-05-19 14:23:34'),
(37, 24, 37, 'Walton Refrigerator', '3JO DDGE', 'Deep Refrigerator', 0, 0, 0, '2021-05-19 14:56:47', '2021-05-19 14:56:47'),
(38, 24, 54, 'Walton Refrigerator', '1F3GDEL', 'Refrigaretor', 0, 0, 0, '2021-05-19 15:21:19', '2021-05-19 15:21:19'),
(39, 24, 54, 'Walton Refrigerator', '2A3GDEL-XX', 'Refrigerator', 0, 0, 0, '2021-05-19 15:24:06', '2021-05-19 15:24:06'),
(40, 24, 54, 'Walton Refrigerator', 'WFB-1B6-GDEL-XX', 'Refrigerator', 0, 0, 0, '2021-05-19 15:26:43', '2021-05-19 15:26:43'),
(41, 24, 54, 'Walton Refrigerator', 'WFE-2H2-GDXX', 'Refrigerator', 0, 0, 0, '2021-05-19 15:28:29', '2021-05-19 15:28:29'),
(42, 24, 54, 'Walton Refrigerator', 'WFD-2A3-GDEL', 'Refrigerator', 0, 0, 0, '2021-05-19 15:31:13', '2021-05-19 15:31:13'),
(44, 24, 54, 'Walton Refrigerator', 'WFB-2B-GDXX-XX', 'No Color', 0, 0, 0, '2021-06-20 14:42:42', '2021-06-20 14:42:42'),
(45, 24, 54, 'Walton Refrigerator', 'WCG-3JO-DDGE-XX', 'NO Color', 0, 0, 0, '2021-06-20 14:44:42', '2021-06-20 14:44:42'),
(46, 24, 54, 'Walton Refrigerator', 'WFA-2A3-GDEL-XX', 'NO Color\n', 0, 0, 0, '2021-06-20 14:45:47', '2021-06-20 14:45:47'),
(47, 24, 54, 'Walton Refrigerator', 'WFB-2B3GDSH-XX', 'NO Color\n', 0, 0, 0, '2021-06-20 14:47:03', '2021-06-20 14:47:03'),
(48, 24, 54, 'Walton Refrigerator', 'WFC-3D8-FDEH-XX', 'No Color', 0, 0, 0, '2021-06-20 14:48:11', '2021-06-20 14:48:11'),
(49, 24, 54, 'Walton Refrigerator', 'WFC-3D8-GDEH-XX', 'No Color\n', 0, 0, 0, '2021-06-20 14:52:48', '2021-06-20 14:52:48'),
(50, 24, 58, 'LED Television', 'WE-DH32V-Voice Control HD Smart LED', 'NO Color\n', 0, 0, 0, '2021-06-20 15:11:19', '2021-06-20 15:11:19'),
(51, 24, 58, 'LED Television', 'W32E110', 'No Color', 0, 0, 0, '2021-06-20 15:13:03', '2021-06-20 15:13:03'),
(52, 24, 59, 'Celling Fan', 'WCF5601EM-HILL ', 'INDIGO/SILVER', 0, 0, 0, '2021-06-20 15:22:15', '2021-06-20 15:22:15'),
(53, 24, 58, 'LED Television', 'W24D19-610mm', 'No Color', 0, 0, 0, '2021-06-20 15:24:45', '2021-06-20 15:24:45'),
(54, 24, 60, 'Heavy Iron', 'WIR-HD02(Dri)', 'No Color\n', 0, 0, 0, '2021-06-20 15:27:48', '2021-06-20 15:27:48'),
(55, 24, 60, 'IRON', 'WIR-SO3(Stream).Iron', 'No Color', 0, 0, 0, '2021-06-20 15:29:26', '2021-06-20 15:29:26'),
(56, 24, 58, 'LED Television', 'WD4-TS43-DL220-Smart led television', 'No Color\n', 0, 0, 0, '2021-06-20 15:32:47', '2021-06-20 15:32:47'),
(57, 24, 54, 'Walton Refrigerator', 'WCF-2T5-GDEL-XX', 'No Color', 0, 0, 0, '2021-06-20 16:59:35', '2021-06-20 16:59:35'),
(58, 24, 54, 'Walton Refrigerator', 'WNI-5F3-GDEL-XX', 'BK13', 0, 0, 0, '2021-06-20 17:01:13', '2021-06-20 17:01:13'),
(59, 24, 54, 'Walton Refrigerator', 'WFB-2EO-GDXX-XX', 'B28', 0, 0, 0, '2021-06-20 17:02:33', '2021-06-20 17:02:33'),
(60, 24, 54, 'Walton Refrigerator', 'WFA-2D4-GDXX-XX', 'B27', 0, 0, 0, '2021-06-20 17:03:38', '2021-06-20 17:03:38'),
(61, 24, 24, 'Walton Air Condition', 'WSN-RINERINE-18A', 'No Color\n', 0, 0, 0, '2021-06-20 17:05:29', '2021-06-20 17:05:29'),
(62, 24, 24, 'Walton Air Condition', 'WSN-RINERINE-12A', 'No Color', 0, 0, 0, '2021-06-20 17:14:35', '2021-06-20 17:14:35'),
(63, 24, 64, 'Walton Air Conditioner', 'WSI-REVERINE-24C', '3', 20, 0, 0, '2021-06-20 17:15:47', '2021-09-09 07:05:04'),
(64, 21, 26, 'TELEVISION', 'KDL-50W660G', 'Weight (kg)	11.4\nProduct Height (cm)	71.9cm\nProduct Width (cm)	113cm\nProduct Depth (cm)	26.8cm', 1, 0, 0, '2021-08-11 09:47:40', '2021-09-07 17:46:27'),
(65, 34, 57, 'RANGS TV', 'KL-24G300', 'Rangs Tv', 0, 0, 0, '2021-08-11 09:51:13', '2021-08-11 09:51:13'),
(66, 21, 26, 'TELEVISION', 'KDL-40W650D', 'DIMENSION OF TV WITH FLOOR STAND (W X H X D)\nSCREEN SIZE (INCH, MEASURED DIAGONALLY)\n40\" (40.0\")\nSCREEN SIZE (CM, MEASURED DIAGONALLY)\n101.6 cm\nCOLOUR ENHANCEMENT\nLive Colour™ Technology\nCONTRAST ENHANCEMENT\nDynamic Contrast Enhancer\n', 4, 0, 0, '2021-09-05 15:31:26', '2021-09-07 16:28:29'),
(67, 24, 84, 'Walton 200L Fridge', 'WF200', 'Aliqua Rerum volupt', -2, 1, 1, '2021-09-07 15:23:54', '2021-09-07 16:21:18'),
(68, 21, 26, 'TELEVISION', 'KDL-32W600D', 'Model: KDL-32W600D\nWiFi ,HDMI, RF, FM\nYoutube and more\nBuilt-in Wi-Fi\nWXGA Resolution', 4, 0, 0, '2021-09-07 16:20:34', '2021-09-07 17:46:27'),
(69, 21, 26, 'TELEVISION', 'KDL-32R300E', 'SCREEN SIZE (INCH, MEASURED DIAGONALLY)\n32\" (31.5\")\nDISPLAY RESOLUTION (H X V, PIXELS)\n1366x768\nPICTURE MODES\nVivid ,Standard ,Custom ,Photo-Vivid ,Photo-Standard ,Photo-Custom ,Cinema ,Game ,Graphics ,Sports\n', 4, 0, 0, '2021-09-07 16:28:01', '2021-09-07 17:46:27'),
(70, 22, 26, 'TELEVISION', 'RL-32G402S/A', 'FHD Resolution\nLenth : 50.80mm\nWidth:556.26mm\nHight:332.74mm\nUSB Input,\nHDMI Input,\nVGA Input,\nPC Audio Input\nPower Consumption: 45W\nAudio output: 8W*2\nVideo out put\nEarphone port\nPower Suppy: AC100-240V-, 50/60Hz', 3, 0, 0, '2021-09-07 16:32:21', '2021-09-07 17:46:27'),
(71, 22, 26, 'TELEVISION', 'RL-32G403D', 'Resolution : 1920x1080p\nDisplay Technology : LED\nScreen size : 32 inch\nDisplay Resolution Maximum : 1920p\nWi-Fi Enable : Yes\nNumber of HDMI Ports : 3 HDMI\nDish Port : YES\nAudio Port : YES\nDVD Out port : YES\nTotal USB Ports : 2 Port\nTotal VGA Ports : 1 Port\nLanguage : English\nKey Board : Built in Android Key Board\nBlue Screen Technology : YES\nTV hotspot : YES\nLAN Port : 01 (ONE)\nContrast Ratio : 3000:1\nCenter Luminance of white : 220cd/m2\nPreset Channels : 1-199\nSpeaker Output : 8w + 8w\nPower Requirement : AC 100V-240V\nPower Consumption : 45W\nSpeaker : Built In with Hi-Fi Technology\nIncludes Remote : Yes\nViewing angle : 178°,178°\nBrightness : 400cd/m\nContrast ratio : 1200 : 1\nResponse time : 8ms\nColor : 1.07B', 3, 0, 0, '2021-09-07 16:40:45', '2021-09-07 17:46:27'),
(72, 22, 26, 'TELEVISION', 'RL-24G300', 'Full HD (1080x1920) Resolution\nEqualizer Mode\nSmart Energy Saving\nUSB Input\nHDMI Input\nVGA Input PC Audio Input\n\nWarrenty Type: 05 Years Service\nWarranty & 04 Years Panel, Parts & Component Warranty', 3, 0, 0, '2021-09-07 16:45:51', '2021-09-07 17:46:27'),
(73, 21, 26, 'TELEVISION', 'KLV-40R352E', 'Display Size	40 inch\nScreen Type	LED\nColor	Black\n3D	No\nSmart TV	No\nCurve TV	No\nLaunch Year	2017\nResolution Standard	Full-HD\nResolution (pixels)	1920x1080\nDimensions\nWidth x Height x Depth (without stand)	924 mm x 550 mm x 65 mm\nWeight (without stand)	6.5 kg\nWidth x Height x Depth (with stand)	924 mm x 568 mm x 183 mm', 2, 0, 0, '2021-09-07 16:56:20', '2021-09-07 17:46:27'),
(74, 21, 26, 'TELEVISION', 'KLV-48W652D', 'Hdmi Ports	1(Side), 1(Rear)\nUsb Supports	Audio, Video, Image\nRf Inputanalog Coaxial Ports	1(Side)\nEthernet Sockets	1(Bottom)\nComposite Inputaudio Video Cable Ports	1(Bottom)\nMhl Enabled	Yes\nUsb Ports	2(Side)\nNfc Ports	No\nDigitaloptical Audio Output Ports	1(Rear)\nHeadphonespeaker Output Ports	1\nGeneral (4)\nBox Contents	Television, Remote Control(RMT-TX202P), Batteries(R03), Tabletop Stand, AC Power Adapter, AC Power Cord, User Manual, Warranty Card\nWarranty	2 Years\nModel	BRAVIA KLV-48W652D\nBrand	Sony\nPower Supply (5)\nVoltage Requirement	100 - 240 V\nPower Consmption Standby	0.5 W\nPower Saving Mode	Yes\nPower Consmption Running	75 W\nFrequency Requirement	50 - 60 Hz\nPhysical Design (9)\nWeight Without Stand	10.2 Kg\nDimensions With Standwxhxd	1092 x 683 x 235 mm\nStand Weight	0.5 Kg\nColour	Black\nWeight With Stand	10.7 Kg\nDimensions Without Standwxhxd	1092 x 643 x 66 mm\nStand Shape	U Shape\nStand Colour	Silver\nWall Mount Colour	Black\nVideo (5)\nVideo Signals	HDMI, Component\nAnalog Tv Reception Formats	PAL, NTSC, SECAM\nDigital Tv Reception Formats	DVB\nImage Formats Supported	JPEG, PNG\nVideo Formats Supported	3GP, AVI, FLV, MP4, MPEG, MPEG-1, MPEG-2, MPEG-4, MPO\nAudio (7)\nAudio Formats Supported	AAC, AC3(Dolby Digital), MP3, WAV\nSound Technology	Dolby Digital, Dolby Digital Plus, Dolby Pulse\nTotal Speaker Output	10 W\nOutput Per Speaker	5 W\nOther Smart Audio Features	Auto volume leveller: Balance, Bass reflex speaker\nSpeakers	2\nSound Type	2.0\nRemote (3)\nTouch Controls Present	No\nUniversal Control Present	No\nRemote Type	RF (Radio frequency)\nSmart Tv Features (9)\nInbuilt Apps	Yes\nMiracastscreen Mirroring Support	Yes\nOther Smart Features	Bravia Sync, Display Mirroring, MHL, SmartShare, SmartView, WiFi Direct, Future Ready\nGames	Yes\nSmart Tv	Yes\nFacebook And Social Media Integration	Yes\nCamera	Yes\nMicrophone	Yes\nWifi Present	Yes', 1, 0, 0, '2021-09-07 17:00:04', '2021-09-07 17:46:27'),
(75, 21, 26, 'TELEVISION', 'KDL-43W660G', 'Full HD Resolution (1920 x 1080)\nYouTube™ and more', 2, 0, 0, '2021-09-07 17:13:49', '2021-09-12 16:45:10'),
(76, 22, 26, 'TELEVISION', 'RL-40ASS222W', 'Screen Size : 40″ Diagonal\nPicture Mode : Standard, Vivid, Gentle, Movie, User\nSound Mode : Standard, Music, News, Movie, User\nWi-Fi : Turn on or turn off Wi-Fi\nEthernet : Set or open or close Ethernet\nAspect Ratio : 16:9\nSystem : PAL/SECAM BG/DK/1\nReceiving TV Band : All Channels Receiveable\nAC Supply Voltage : 100-240V, 50/60Hz\nPower Supply : DC 3V (Two batteries, size-AAA, recommend use alkaline type, batteries)\nFull Function Remote Control and 8 metres effective distance power.\nKey Point : Wi-Fi, Lan-Port, USB Input, HDMI, Input, VGA Input, PC Audio Input, Video Input, Earphone, Dynamic Contrast Ratio.', 2, 0, 0, '2021-09-07 17:23:21', '2021-09-07 17:46:27'),
(77, 38, 86, 'REFRIGERATOR', 'RR-350BT', 'Gross Volume: 365 Ltr\nNet Volume: 350 Ltr.', 3, 0, 0, '2021-09-07 17:29:52', '2021-09-08 17:08:04'),
(78, 38, 44, 'REFRIGERATOR', 'RR-275BD', 'XKHDSFH', 3, 0, 0, '2021-09-08 17:27:32', '2021-09-12 17:44:20'),
(79, 38, 37, 'REFRIGERATOR', 'RCF-175GD', 'Rangs RCF-175GD 175 Liter Glass Door Freezer- (Red)', 1039, 0, 0, '2021-09-08 17:32:32', '2021-09-12 16:17:33'),
(80, 38, 81, 'REFRIGERATOR', 'RR-348BD', 'Rangs 358 Ltr Refrigerator - (Black)', 3, 0, 0, '2021-09-12 16:03:15', '2021-09-12 17:44:20'),
(81, 38, 55, 'REFRIGERATOR', 'RR-142BT', 'Rangs RR-142BT 147 Ltr Refrigerator -(Red)', 3, 0, 0, '2021-09-12 16:04:52', '2021-09-12 16:17:33'),
(82, 22, 26, 'TELEVISION', 'RL-43ASS333', 'Model                    : RL-43ASS333\n\nPicture Mode        : Standard, Vivid, Gentle, Movie, User\n\nSound Mode         : Standard, Music, News, Movie, User\n\nWi-Fi                      : Turn on or turn off Wi-Fi\n\nEthernet                : Set or open or close Ethernet\n\nAspect Ratio          : 16:9\n\nSystem                   : PAL/SECAM BG/DK/1\n\nReceiving TV Band : All Channels Receivable\n\nAC Supply Voltage : 100-240V, 50/60Hz\n\nPower Supply        : DC 3V (Two batteries, size-AAA,\n\n                                 Recommend use alkaline type\n\n                                 Batteries)\n\nFull Function Remote Control and 8 meters effective distance power.\n\nKey Features         : Wi-Fi, Lan-Port, USB Input, HDMI\n\n                              Input, VGA Input, PC Audio Input,\n\n                              Video Input, Earphone, Dynamic', 2, 0, 0, '2021-09-12 16:19:12', '2021-09-12 16:40:47'),
(83, 38, 55, 'REFRIGERATOR', 'RR-226S', 'Rangs RR-226S 217 Liter Frost Refrigerator ( Black)', 2, 0, 0, '2021-09-12 16:22:51', '2021-09-12 16:40:47'),
(84, 38, 38, 'REFRIGERATOR', 'RR-844KG', 'Rangs RR-844KG 250 Liter Frost Refrigerator\n10 Years Compressor, 05 Years Service & 02 Years Parts Warranty\n\n \n\nRangs Frost Refrigerator\n\nCapacity : 250 liter\n\nDepth:22\"\n\nWidth:22.5\"\n\nHight:61\"\n\nElectric Shock Classification : Class-1, Voltage: 220-240V\n\nFrequency: 50Hz', 0, 0, 0, '2021-09-12 16:25:00', '2021-09-12 16:25:00'),
(85, 39, 89, 'AC', 'RSDC-18CH', 'Rangs Split type 1.5 ton Inverter Air-conditioner\n\nInstallation & 10 feet Copper Pipe Free with Angel\n\n10 Years Guarantee', 1, 0, 0, '2021-09-12 16:29:11', '2021-09-12 16:40:47'),
(86, 25, 90, 'AC', 'ASGA-12AEC', 'Model: ASGA-12AEC\nBrand: General\nCategory: Split AC\nPrice: BDT. 67,500.00(approx)\nShowrooms: Find Here\nDetails\nCapacity: 1.0 Ton (12,000 BTU)\nPowerful Cooling\nEasy Maintenance Design\nAuto Swing Louver\nLow Noise Design\nFeatures\nCapacity : 1.0 Ton\nBTU : 12000BTU\nOutdoor unit model : AOGR12AEC\nPower Source (V/Ø/Hz) : 220-240/1/50\nCooling Input Power (kW) : 1.27-1.33\nEER (Cooling) : 2.68-2.59\nRunning Current (A) : 6.1-6.2\nMoisture Removal (I/h) : 1.8\nSound Pressure (Indoor/Outdoor) : 39 dB / 45-46 dB\nIndoor Airflow Rate (m3/h) : 540\nOutdoor Airflow Rate (m3/h) : 1,760-1,830\nNet Dimension - Indoor (H x W x D) (mm) : 257 x 808 x 197\nNet Dimension - Outdoor (H x W x D) (mm) : 535 x 695 x 250\nNet Weight - Indoor (Kg) : 8\nNet Weight - Outdoor (Kg) : 30\nPiping Connections (Small / Large) (mm) : 6.35/12.7\nOperation Range (°CDB) : 21 to 43\nRefrigerant : R22', 1, 0, 0, '2021-09-12 16:35:46', '2021-09-12 16:40:47'),
(87, 22, 91, 'Rangs Electronics Ltd.', 'RI-1010CD', 'Brand Rangs\n\nModel RI-1010CD\n\nProduct Type Dry Iron\n\nPower 1000W\n\nVoltage 220V-240V\n\nFrequency 50/60Hz\n\nAdvantage Non - stick soleplate, Dry function, Variable ironing temperature, Over heat safety protection, Pilot Light\n\n', 2, 0, 0, '2021-09-12 16:49:26', '2021-09-12 16:50:25'),
(88, 38, 55, 'REFRIGERATOR', 'KHV-430FF', 'Mechanical temperature control\nReversible door with magnetic door seal\nStylish interior LED light optional\n3 wire shelves (glass shelf available)\n1 crystal crisper drawer with glass cover\n3 crystal door balconies (upper cover optional)\n1 wire freezer shelf\nWater dispenser device optional\n 472 liter\nBlack\nNo-Frost\nLeft Side\nGlass Door\nSide by Side', 1, 0, 0, '2021-09-12 16:55:48', '2021-09-12 16:59:24'),
(89, 22, 26, 'TELEVISION', 'RL-32ASS111W', 'Model                  : RL-32ASS111\n\nPicture Mode       : Standard, Vivid, Gentle, Movie, User\n\nSound Mode        : Standard, Music, News, Movie, User\n\nWi-Fi                    : Turn on or turn off Wi-Fi\n\nEthernet               : Set or open or close Ethernet\n\nAspect Ratio        : 16:9\n\nSystem                 : PAL/SECAM BG/DK/1\n\nReceiving TV Band: All Channels Receivable\n\nAC Supply Voltage: 100-240V, 50/60Hz\n\nPower Supply       : DC 3V (Two batteries, size-AAA,\n\n                              Recommend use alkaline type\n\n                              Batteries)\n\nFull Function Remote Control and 8 meters effective distance power.\n\nKey Features       : Wi-Fi, Lan-Port, USB Input, HDMI\n\n                              Input, VGA Input, PC Audio Input,\n\n                              Video Input, Earphone, Dynamic\n\n                              Contrast Ratio.', 3, 0, 0, '2021-09-12 16:57:23', '2021-09-12 16:59:24'),
(90, 38, 55, 'REFRIGERATOR', 'RCF-706ME', 'Rangs RCF-706ME 200 Liter Freezer\nRangs Freezer\n\nCapacity: 200 liter\n\nSliding Glass\n\nElectric Shock\n\nClassification : Class-1, Voltage: 220-240V\n\nFrequency: 50Hz\n\nDepth:20\"\nWidth:38\"\nHight:29\"', 1, 0, 0, '2021-09-12 17:01:52', '2021-09-12 17:44:20'),
(91, 39, 92, 'AC', 'RAC-14SH', 'Rangs RAC-14SH 01 Ton Split Type AC- Without Installation\n', 1, 0, 0, '2021-09-12 17:04:09', '2021-09-12 17:44:20'),
(92, 39, 93, 'AC', 'RAC-26SH', 'Rangs RAC-26SH 2 Ton Split Type AC- Without Installation', 1, 0, 0, '2021-09-12 17:08:52', '2021-09-12 17:44:20'),
(93, 34, 30, 'Rangs Electronics Ltd.', 'KMW-20DBM', 'Kelvinator KMW-20DBM 20 Liter Oven\n20 LITER\n\nDigital\n\nSolo Function\n\nBlack outlook\n\n700W\n\nChild Safety Lock, White Cavity\n\nLED Display, Preset, Express Cooking', 1, 0, 0, '2021-09-12 17:11:28', '2021-09-12 17:44:20'),
(94, 34, 30, 'Rangs Electronics Ltd.', 'RMG-23M', 'Brand	Rangs\nModel	RMG-23M\nProduct Type	 Oven\nFeatures	Grill, Microwave Oven\nCapacity	20 Liter \nRated Voltage	 230V~50Hz\nWarrenty	1 Year Guarantee', 1, 0, 0, '2021-09-12 17:12:58', '2021-09-12 17:44:20'),
(95, 39, 79, 'AC', 'RAC-19SH', 'Rangs RAC-19SH 1.5 Ton Split Type AC - Without Installation', 2, 0, 0, '2021-09-12 17:15:27', '2021-09-12 17:44:20'),
(96, 39, 80, 'AC', 'RSDC-24CH', 'Model:RSDC-24CH\n\nRangs Split type 2 ton Inverter Air-conditioner\n\nInstallation & 10 feet Copper Pipe Free with Angel\n\n10 Years Guarantee', 1, 0, 0, '2021-09-12 17:17:08', '2021-09-12 17:44:20'),
(97, 34, 82, 'Kettle', 'REK-102', 'Automatic boiling stop\n\nWater level indicator\n\nBoil dry protection\n\nOn/off switch\n\nPilot light', 12, 0, 0, '2021-09-12 17:22:43', '2021-09-12 17:49:14'),
(98, 34, 95, 'RICE COOKER', 'RJC-56', 'Durable non-stick aluminium inner pot\n\n-              Extendable steamer compartment\n\n-              Steam fish, meat, poultry & vegetables\n\n-              Cook food & rice simultaneously\n\n-              Micro switch for automatic control of heat to prevent over cooking\n\n-              Keep warm function With measuring cup and spoon', 2, 0, 0, '2021-09-12 17:25:45', '2021-09-12 17:49:14'),
(99, 34, 96, 'Rangs Toaster', 'RJC-36', 'Rangs RBT-305 Toaster\nAn amazing product from Rangs, this toaster delivers efficient performance with a variety of shade options. The extra-wide slots make it easy to fit any type of bread and the extended lift makes sure you retrieve the toast safely. With slots wide enough for bagels, waffles, and hand sliced bread and an automatic toast boost function, this toaster can fit all of your family\'s toasting needs.\n\nToaster with One Long slice option\nPower control\nStarting function\nAuto turn off function\nFood-grade material', 2, 0, 0, '2021-09-12 17:30:15', '2021-09-12 17:49:14'),
(100, 34, 96, 'Rangs Electronics Ltd.', 'RBT-305', 'An amazing product from Rangs, this toaster delivers efficient performance with a variety of shade options. The extra-wide slots make it easy to fit any type of bread and the extended lift makes sure you retrieve the toast safely. With slots wide enough for bagels, waffles, and hand sliced bread and an automatic toast boost function, this toaster can fit all of your family\'s toasting needs.\n\nToaster with One Long slice option\nPower control\nStarting function\nAuto turn off function\nFood-grade material', 2, 0, 0, '2021-09-12 17:31:38', '2021-09-12 17:51:24'),
(101, 34, 97, 'Hand Blender', 'RHM-28', 'Rangs RHM-28 Hand Blender \nInnovative and easy to use hand held mixer for batters, mixes, cream, eggs and more. Enclosed gears and removable stainless steel beaters. Detachable dishwasher safe base. Soft non- slip grips on turning knob and handle for easy use.', 2, 0, 0, '2021-09-12 17:34:50', '2021-09-12 17:49:14'),
(102, 34, 98, 'Rang Juicer', 'RBJ-45', 'Brand	Rangs\nModel	RBJ-45\nProduct Type	Home Appliance\nPower	30W\nVoltage	220V-240V\nVolume	1.0L\nFrequency	60Hz\nAdvantage	 High Speed, Low noise, Small Vibration,Transparent Cover\nWarrenty	1 Year', 0, 0, 0, '2021-09-12 17:57:21', '2021-09-12 17:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `category_id`, `created_at`, `updated_at`) VALUES
(22, 'Direct Cool', 22, '2021-04-14 13:57:02', '2021-04-14 13:57:02'),
(23, 'No Frost', 22, '2021-04-14 13:57:11', '2021-04-14 13:57:11'),
(24, 'Standard Series', 27, '2021-04-14 13:58:13', '2021-04-14 13:58:13'),
(25, 'Inverter Series', 27, '2021-04-14 13:58:28', '2021-04-14 13:58:28'),
(26, 'Full HD TV', 25, '2021-04-14 13:59:01', '2021-04-14 13:59:01'),
(27, 'Android TV', 25, '2021-04-14 13:59:23', '2021-04-14 13:59:23'),
(28, 'Semi Auto', 28, '2021-04-14 13:59:39', '2021-04-14 13:59:39'),
(29, 'Full Auto', 28, '2021-04-14 13:59:48', '2021-04-14 13:59:48'),
(30, 'Cooking', 26, '2021-04-14 14:00:08', '2021-04-14 14:00:08'),
(31, 'Baking', 26, '2021-04-14 14:00:16', '2021-04-14 14:00:16'),
(32, 'Rice Cooker', 23, '2021-04-14 14:00:48', '2021-04-14 14:00:48'),
(33, 'Gas Burner', 23, '2021-04-14 14:00:59', '2021-04-14 14:00:59'),
(34, 'Iron', 24, '2021-04-14 14:01:59', '2021-04-14 14:01:59'),
(35, 'Vacuum Cleaner', 24, '2021-04-14 14:02:39', '2021-04-14 14:02:39'),
(36, '200lt', 22, '2021-04-27 13:40:41', '2021-04-27 13:40:41'),
(37, '300lt', 22, '2021-04-27 13:40:57', '2021-04-27 13:40:57'),
(38, '250 letter', 22, '2021-05-19 13:58:50', '2021-05-19 13:58:50'),
(39, '244 ltr', 22, '2021-05-19 13:59:09', '2021-05-19 13:59:09'),
(40, '213 ltr', 22, '2021-05-19 13:59:23', '2021-05-19 13:59:23'),
(41, '157 ltr', 22, '2021-05-19 13:59:36', '2021-05-19 13:59:36'),
(42, '176 Ltr.', 22, '2021-05-19 14:00:26', '2021-05-19 14:00:26'),
(43, '132 Ltr.', 22, '2021-05-19 14:00:53', '2021-05-19 14:00:53'),
(44, '465 Ltr.', 22, '2021-05-19 14:01:21', '2021-05-19 14:01:21'),
(45, '348 Ltr.', 22, '2021-05-19 14:01:43', '2021-05-19 14:01:43'),
(46, '282 Ltr.', 22, '2021-05-19 14:01:59', '2021-05-19 14:01:59'),
(47, 'Deep 300 Ltr.', 22, '2021-05-19 14:02:46', '2021-05-19 14:02:46'),
(48, 'Deep 255 Ltr.', 22, '2021-05-19 14:03:08', '2021-05-19 14:03:08'),
(49, 'Deep 205 Ltr.', 22, '2021-05-19 14:03:36', '2021-05-19 14:03:36'),
(50, 'Deep 146 Ltr.', 22, '2021-05-19 14:03:54', '2021-05-19 14:03:54'),
(51, 'Marcel 252 Ltr.', 22, '2021-05-19 14:04:27', '2021-05-19 14:04:27'),
(52, 'Vision 240 Ltr.', 22, '2021-05-19 14:04:57', '2021-05-19 14:04:57'),
(53, 'Vision 180 Ltr.', 22, '2021-05-19 14:05:21', '2021-05-19 14:05:21'),
(54, 'Walton Refrigerator', 33, '2021-05-19 15:20:26', '2021-05-19 15:20:26'),
(55, 'RANGS Refregarator', 50, '2021-06-17 11:22:58', '2021-06-17 11:22:58'),
(56, 'SONY LED TV', 47, '2021-06-17 12:32:35', '2021-06-17 12:32:35'),
(57, 'RANGS TV', 48, '2021-06-17 12:37:36', '2021-06-17 12:37:36'),
(58, 'Walton Voice Control HD Smart LED', 40, '2021-06-20 14:54:34', '2021-06-20 14:54:34'),
(59, 'Celling Fan', 41, '2021-06-20 15:20:31', '2021-06-20 15:20:31'),
(60, 'Heavy Iron', 44, '2021-06-20 15:26:21', '2021-06-20 15:26:21'),
(61, 'Smart ,LED Television', 56, '2021-06-20 15:34:47', '2021-06-20 15:34:47'),
(63, 'Air-Condiditioner', 58, '2021-06-20 17:08:34', '2021-06-20 17:08:34'),
(64, 'Walton Air Conditioner', 59, '2021-06-20 17:09:06', '2021-06-20 17:09:06'),
(65, 'KDL-40W650D', 47, '2021-08-12 11:58:25', '2021-08-12 11:58:25'),
(66, 'KDL-32W600D', 47, '2021-08-12 11:58:51', '2021-08-12 11:58:51'),
(67, 'KDL-32R300E', 47, '2021-08-12 11:59:21', '2021-08-12 11:59:21'),
(68, 'RL-32R300E', 47, '2021-08-12 11:59:48', '2021-08-12 11:59:48'),
(69, 'RL-32G402S/A', 48, '2021-08-12 12:00:37', '2021-08-12 12:00:37'),
(70, 'RL-32G403D', 48, '2021-08-12 12:01:08', '2021-08-12 12:01:08'),
(71, 'RL-32R', 47, '2021-08-12 12:44:57', '2021-08-12 12:44:57'),
(72, 'KLV-48W652D', 47, '2021-08-12 12:47:06', '2021-08-12 12:47:06'),
(73, 'RL32ASS111W', 48, '2021-08-12 12:50:45', '2021-08-12 12:50:45'),
(74, 'RAC-14SH', 160, '2021-08-12 12:52:37', '2021-08-12 12:52:37'),
(75, 'RAC-26', 160, '2021-08-12 12:52:56', '2021-08-12 12:52:56'),
(76, 'RR-275BD', 50, '2021-08-12 12:53:54', '2021-08-12 12:53:54'),
(77, 'KMW-20DBM', 161, '2021-08-12 12:56:26', '2021-08-12 12:56:26'),
(78, 'RMG-23M', 161, '2021-08-12 12:56:45', '2021-08-12 12:56:45'),
(79, 'RAC-19SH', 160, '2021-08-12 12:57:13', '2021-08-12 12:57:13'),
(80, 'RSDC-24CH', 160, '2021-08-12 12:57:32', '2021-08-12 12:57:32'),
(81, 'RR-3488D', 50, '2021-08-12 12:58:25', '2021-08-12 12:58:25'),
(82, 'REK-', 92, '2021-08-12 12:58:45', '2021-08-12 12:58:45'),
(84, '200L Fridge', 22, '2021-09-07 15:25:21', '2021-09-07 15:25:21'),
(85, 'REFRIGERATOR', 102, '2021-09-07 17:31:26', '2021-09-07 17:31:26'),
(86, 'Rangs refrigerator 350ltr', 22, '2021-09-08 16:53:40', '2021-09-08 16:53:40'),
(87, 'Z', 25, '2021-09-08 17:53:12', '2021-09-08 17:53:12'),
(88, 'Glass Door Freezer', 163, '2021-09-12 16:07:27', '2021-09-12 16:07:27'),
(89, 'RSDC-18CH', 160, '2021-09-12 16:28:54', '2021-09-12 16:28:54'),
(90, 'General 1.0 Ton', 164, '2021-09-12 16:32:54', '2021-09-12 16:32:54'),
(91, 'Dry Iron', 165, '2021-09-12 16:49:15', '2021-09-12 16:49:15'),
(92, 'AC 01 TON', 160, '2021-09-12 17:03:56', '2021-09-12 17:03:56'),
(93, 'AC 02 TON', 160, '2021-09-12 17:08:12', '2021-09-12 17:08:42'),
(94, 'KETTLE', 166, '2021-09-12 17:22:25', '2021-09-12 17:22:25'),
(95, '2.8 LTR', 62, '2021-09-12 17:25:32', '2021-09-12 17:25:32'),
(96, 'Rangs Electronics Ltd.', 167, '2021-09-12 17:29:01', '2021-09-12 17:29:01'),
(97, 'Rangs hand blender', 30, '2021-09-12 17:34:28', '2021-09-12 17:34:28'),
(98, 'Home Appliance', 166, '2021-09-12 17:56:09', '2021-09-12 17:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost_amount` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cheque_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `user_id`, `invoice_no`, `c_invoice_no`, `date`, `remark`, `cost_amount`, `discount`, `paid_amount`, `payment_type`, `cheque_no`, `bank_name`, `card_no`, `card_type`, `status`, `created_at`, `updated_at`) VALUES
(2, 26, '0002', '00187', '2021-07-03', 'Refrigarator', 22250, 0, 22250, 'cash', NULL, NULL, NULL, NULL, 0, '2021-06-20 15:44:45', '2021-06-20 15:44:45'),
(3, 26, '0003', '00187', '2021-10-03', 'Refrigarator', 19500, 0, 19500, 'cash', NULL, NULL, NULL, NULL, 0, '2021-06-20 16:51:30', '2021-06-20 16:51:30'),
(5, 32, '0005', '152023', '2020-10-26', NULL, 1089721, 0, 826320, 'cash', NULL, NULL, NULL, NULL, 0, '2021-09-07 15:53:02', '2021-09-12 16:17:33'),
(6, 32, '0006', '333', '2021-09-09', NULL, 2200, 0, 2200, 'cash', NULL, NULL, NULL, NULL, 0, '2021-09-09 07:05:04', '2021-09-09 07:05:04'),
(7, 29, '0007', 'Velit qui iusto aspe', '1981-05-26', 'Id eaque amet minim', 904783, 0, 904783, 'cash', NULL, NULL, NULL, NULL, 0, '2021-09-09 17:42:36', '2021-09-09 17:42:36'),
(8, 29, '0008', 'Laborum Dolores id', '2012-04-04', 'Natus laborum Ipsam', 47138, 0, 47138, 'cash', NULL, NULL, NULL, NULL, 0, '2021-09-09 17:43:07', '2021-09-09 17:43:07'),
(9, 4, '0009', 'Dolorem neque aliqui', '2002-08-23', 'Ut maxime aut corrup', 7007, 0, 7007, 'cash', NULL, NULL, NULL, NULL, 0, '2021-09-11 21:20:02', '2021-09-11 21:20:02'),
(10, 4, '0010', 'Neque tempora in nih', '2018-05-21', 'Dolore officiis ex e', 105, 0, 105, 'cash', NULL, NULL, NULL, NULL, 0, '2021-09-11 21:24:25', '2021-09-11 21:25:19'),
(11, 28, '0011', '152034', '2020-10-31', NULL, 189456, 0, 189456, 'cash', NULL, NULL, NULL, NULL, 0, '2021-09-12 16:40:47', '2021-09-12 16:40:47'),
(12, 28, '0012', '00167', '2020-11-07', NULL, 45384, 0, 44436, 'cash', NULL, NULL, NULL, NULL, 0, '2021-09-12 16:45:10', '2021-09-12 16:50:25'),
(13, 28, '0013', '00179', '2020-11-09', NULL, 128560, 0, 217960, 'cash', NULL, NULL, NULL, NULL, 0, '2021-09-12 16:59:24', '2021-09-12 17:52:52'),
(14, 28, '0014', '152038', '2020-11-10', NULL, 339439, 0, 319797, 'cash', NULL, NULL, NULL, NULL, 0, '2021-09-12 17:44:20', '2021-09-12 17:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `regular_price` int(11) NOT NULL,
  `offer_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `purchase_id`, `product_id`, `quantity`, `unit_price`, `regular_price`, `offer_price`, `created_at`, `updated_at`) VALUES
(3, 2, 34, 1, 22250, 0, 28925, '2021-06-20 15:44:45', '2021-06-20 15:44:45'),
(4, 3, 34, 1, 19500, 0, 25350, '2021-06-20 16:51:30', '2021-06-20 16:51:30'),
(8, 5, 66, 4, 38855, 0, 38833, '2021-09-07 16:14:32', '2021-09-07 17:46:27'),
(9, 5, 68, 4, 31112, 0, 31112, '2021-09-07 17:46:27', '2021-09-07 17:46:27'),
(10, 5, 69, 4, 20641, 0, 20641, '2021-09-07 17:46:27', '2021-09-07 17:46:27'),
(11, 5, 70, 3, 14900, 0, 14900, '2021-09-07 17:46:27', '2021-09-07 17:46:27'),
(12, 5, 71, 3, 13000, 0, 13000, '2021-09-07 17:46:27', '2021-09-07 17:46:27'),
(13, 5, 72, 3, 9200, 0, 9200, '2021-09-07 17:46:27', '2021-09-07 17:46:27'),
(14, 5, 73, 2, 30305, 0, 30305, '2021-09-07 17:46:27', '2021-09-07 17:46:27'),
(15, 5, 74, 1, 47991, 0, 47991, '2021-09-07 17:46:27', '2021-09-07 17:46:27'),
(16, 5, 64, 1, 61655, 0, 61655, '2021-09-07 17:46:27', '2021-09-07 17:46:27'),
(17, 5, 75, 1, 44436, 0, 44436, '2021-09-07 17:46:27', '2021-09-07 17:46:27'),
(18, 5, 76, 2, 22964, 0, 22964, '2021-09-07 17:46:27', '2021-09-07 17:46:27'),
(19, 5, 77, 3, 30656, 0, 30656, '2021-09-07 17:46:27', '2021-09-07 17:46:27'),
(20, 5, 78, 2, 30110, 0, 30110, '2021-09-08 17:28:23', '2021-09-08 17:28:23'),
(21, 6, 79, 2, 100, 0, 200, '2021-09-09 07:05:04', '2021-09-09 07:05:04'),
(22, 6, 63, 20, 100, 0, 100, '2021-09-09 07:05:04', '2021-09-09 07:05:04'),
(23, 7, 79, 913, 991, 0, 649, '2021-09-09 17:42:36', '2021-09-09 17:42:36'),
(24, 8, 79, 98, 481, 0, 523, '2021-09-09 17:43:07', '2021-09-09 17:43:07'),
(25, 9, 79, 7, 1001, 1002, 1003, '2021-09-11 21:20:02', '2021-09-11 21:20:02'),
(26, 10, 79, 15, 7, 6, 9, '2021-09-11 21:24:25', '2021-09-11 21:25:19'),
(27, 5, 80, 2, 31500, 36225, 34999, '2021-09-12 16:17:33', '2021-09-12 16:17:33'),
(28, 5, 81, 3, 18987, 21800, 20999, '2021-09-12 16:17:33', '2021-09-12 16:17:33'),
(29, 5, 79, 4, 20805, 25900, 24500, '2021-09-12 16:17:33', '2021-09-12 16:17:33'),
(30, 11, 82, 2, 24605, 28500, 27000, '2021-09-12 16:40:47', '2021-09-12 16:40:47'),
(31, 11, 83, 2, 25218, 29000, 27500, '2021-09-12 16:40:47', '2021-09-12 16:40:47'),
(32, 11, 85, 1, 49655, 57500, 55000, '2021-09-12 16:40:47', '2021-09-12 16:40:47'),
(33, 11, 86, 1, 40155, 45000, 43500, '2021-09-12 16:40:47', '2021-09-12 16:40:47'),
(34, 12, 75, 1, 44436, 51000, 47500, '2021-09-12 16:45:10', '2021-09-12 16:45:10'),
(35, 12, 87, 2, 474, 675, 620, '2021-09-12 16:50:25', '2021-09-12 16:50:25'),
(36, 13, 88, 1, 83860, 92000, 89999, '2021-09-12 16:59:24', '2021-09-12 16:59:24'),
(37, 13, 89, 3, 14900, 18500, 17500, '2021-09-12 16:59:24', '2021-09-12 17:52:52'),
(38, 14, 90, 1, 25555, 31500, 28500, '2021-09-12 17:44:20', '2021-09-12 17:44:20'),
(39, 14, 91, 1, 26730, 31500, 30500, '2021-09-12 17:44:20', '2021-09-12 17:44:20'),
(40, 14, 92, 1, 44647, 51000, 49500, '2021-09-12 17:44:20', '2021-09-12 17:44:20'),
(41, 14, 78, 1, 30110, 35500, 34000, '2021-09-12 17:44:20', '2021-09-12 17:44:20'),
(42, 14, 93, 1, 8463, 10500, 10000, '2021-09-12 17:44:20', '2021-09-12 17:44:20'),
(43, 14, 94, 1, 14271, 17500, 16500, '2021-09-12 17:44:20', '2021-09-12 17:44:20'),
(44, 14, 95, 2, 37783, 43500, 41500, '2021-09-12 17:44:20', '2021-09-12 17:44:20'),
(45, 14, 96, 1, 62955, 67500, 66500, '2021-09-12 17:44:20', '2021-09-12 17:44:20'),
(46, 14, 80, 1, 31500, 35500, 34500, '2021-09-12 17:44:20', '2021-09-12 17:44:20'),
(47, 14, 97, 12, 660, 1350, 1250, '2021-09-12 17:49:14', '2021-09-12 17:49:14'),
(48, 14, 98, 2, 1854, 2650, 2450, '2021-09-12 17:49:14', '2021-09-12 17:49:14'),
(49, 14, 99, 2, 1660, 2350, 2250, '2021-09-12 17:49:14', '2021-09-12 17:49:14'),
(50, 14, 101, 2, 960, 1450, 1350, '2021-09-12 17:49:14', '2021-09-12 17:49:14'),
(51, 14, 100, 2, 1387, 2150, 2050, '2021-09-12 17:51:24', '2021-09-12 17:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_returns`
--

CREATE TABLE `purchase_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_details_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `policy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cause` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2021-04-12 09:48:57', '2021-04-12 09:48:57'),
(2, 'Admin', 'web', '2021-04-12 09:48:57', '2021-04-12 09:48:57'),
(3, 'Shop Manager', 'web', '2021-04-12 09:48:59', '2021-04-12 09:48:59'),
(4, 'Supplier', 'web', '2021-04-12 09:49:00', '2021-04-12 09:49:00'),
(5, 'Distributor', 'web', '2021-04-12 09:49:00', '2021-04-12 09:49:00'),
(6, 'Customer', 'web', '2021-04-12 09:49:00', '2021-04-12 09:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(2, 2),
(2, 3),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(10, 3),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(14, 3),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(18, 3),
(19, 2),
(19, 3),
(20, 2),
(20, 3),
(21, 2),
(22, 2),
(22, 3),
(23, 2),
(23, 3),
(24, 2),
(24, 3),
(25, 2),
(26, 2),
(26, 3),
(27, 2),
(27, 3),
(28, 2),
(29, 2),
(29, 3),
(30, 2),
(31, 2),
(31, 3),
(32, 2),
(32, 3),
(33, 2),
(34, 2),
(34, 3),
(35, 2),
(36, 2),
(36, 3),
(37, 2),
(38, 2),
(38, 3),
(39, 2),
(40, 2),
(40, 3),
(41, 2),
(42, 2),
(42, 3),
(43, 2),
(44, 2),
(44, 3),
(45, 2),
(45, 3),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(51, 3),
(52, 2),
(53, 2),
(54, 2),
(55, 2),
(56, 2),
(57, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_amount` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cheque_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `date`, `invoice_no`, `cost_amount`, `discount`, `paid_amount`, `payment_type`, `cheque_no`, `bank_name`, `card_no`, `card_type`, `created_at`, `updated_at`) VALUES
(1, 27, '2021-04-27', '0001', 10000, 0, 10000, 'cash', NULL, NULL, NULL, NULL, '2021-04-27 14:23:00', '2021-04-27 14:23:00'),
(2, 30, '2021-09-07', '0002', 9500, 100, 9400, 'cash', NULL, NULL, NULL, NULL, '2021-09-07 15:40:24', '2021-09-07 15:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 1, 31, 1, 10000, '2021-04-27 14:23:00', '2021-04-27 14:23:00'),
(2, 2, 67, 1, 9500, '2021-09-07 15:40:24', '2021-09-07 15:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `sale_returns`
--

CREATE TABLE `sale_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `sale_details_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `policy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cause` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_returns`
--

INSERT INTO `sale_returns` (`id`, `sale_id`, `sale_details_id`, `date`, `quantity`, `unit_price`, `policy`, `cause`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-04-27', 1, 10000, 'exchange', 'hjkjui', '2021-04-27 14:23:49', '2021-04-27 14:23:49'),
(2, 2, 2, '2021-09-07', 1, 9500, 'refund', 'sdfsdfsdf', '2021-09-07 15:42:11', '2021-09-07 15:42:11');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2iAWSRqHUA9Uz7C0I70wO6Rs71z7ji3cvE4USCIk', NULL, '66.249.75.215', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicDdCczNka1BJZnRSc0dQelRyYnpPNUhTb2dQVEJzUXZneDN3ZG9ZWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9qa2VsZWNjaXR5LmNvbS9wcm9kdWN0L2RldGFpbC8zNyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1631501354),
('5d2Y5KlXKRSzyQGsKN5jB3aNIjzx2ks1rhxpO4xb', NULL, '51.15.191.81', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:58.0) Gecko/20100101 Firefox/58.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia2FzQkZHMnBjMk9aM0J3R2JkMm9yNXBDc2tkTm1JTGFoM2w4Wm05UCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vamtlbGVjY2l0eS5jb20vbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1631494961),
('6BGn0cESyaVMietJoivwY1gVi7uj7Ut8fXqQkKxp', NULL, '18.237.93.41', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS0liVWozaEt3U3RlN1cxbkdYUzFUTkhuRFhDWXdlY0RTdk9RZ1BsciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9qa2VsZWNjaXR5LmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1631495923),
('btw7yWySZVSZcUhqiikoUSiKwuJldi91Kk0eWMLW', NULL, '108.62.9.235', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTG03WWFlVjJjTEJkZ3hmZ2JZMEQwYWJ5UDBJQklOOWxJdXU3Z1lIMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9qa2VsZWNjaXR5LmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1631460100),
('curqqKovHy73tSgnx65DoPP1djFMzZYjb2KAngsV', NULL, '62.4.14.198', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:58.0) Gecko/20100101 Firefox/58.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNEFLRDg0bTJ4MEd3Z0djOGZWaDd6Mld5ODhSbmZkYVJnUXcyV2RWOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vd3d3LmprZWxlY2NpdHkuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1631494237),
('D3L3PFiKGDQPuOXFJ5x4QKPVZu5RL1RPNqghSA72', NULL, '54.36.148.202', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWZUYWdwbmZBZU1GQlcxTEhtOFlza0J0ME54TFFvVlQ3dUxDU3dsVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LmprZWxlY2NpdHkuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1631499100),
('fsxx2JM1sctJfxsdZaBlx2qnWxZgo2DHAVdKQWU8', NULL, '103.200.92.220', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTzc4RXQyeTU2U1VVMFd5cGg0WTRvaWxGZGE3MXF5MUxnUGkwVDVEWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9qa2VsZWNjaXR5LmNvbS9wcm9kdWN0cy8yMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1631514168),
('HrDQywnoV99A6LLUhdzKqx7ox69Pzr0coEn1OSKN', NULL, '34.209.241.111', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmZWSjVhUWRDYUlGRXFaRVR2dWJsS2JCcHFaZmVpY2pkZ3U0RGFHdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9qa2VsZWNjaXR5LmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1631495886),
('JQFOs34u0Mz4YeJF9ogsYlaczQUxM3wQYr9diGPI', NULL, '54.36.148.202', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ0lJN3g0R2FXTmJDM0U1NXpCY2dVUlFPcEdTMG9KRmd0RG9KTGEyaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vamtlbGVjY2l0eS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1631492365),
('mJ0ScFR4Qu6g0hl1dkr1ajGSVCEji5mwnbvgccaf', NULL, '91.227.68.190', 'Opera/9.80 (Windows NT 6.1; U; ru) Presto/2.6.30 Version/10.61', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoidmJsNHZhQ0w0RklWWGpqcDY5TnZPVTdSUnVGYnkxTVdwRXMwQ2JUViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1631484969),
('Q467jBvGhezePeZtDqRqoZ3HmRLBTHtGvDcSOBeg', NULL, '54.191.90.115', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkRyNE1Iekk2MVc3MWdBQnVQZ1BSOGdZM2R2dkE0cGxzbXdQS0praCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vamtlbGVjY2l0eS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1631495877),
('slve8mV6QpKXMvx2k1H0EUbphioEhhxlEEUoMXmF', NULL, '18.236.70.85', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaWJLMjZXU3ViWVI0Tll0cHZKcHpiMEdYRVJSSm5EQW44QVp6YThKQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vamtlbGVjY2l0eS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1631495900),
('Swk8Ar2uwNHpDhuk1N5n7X2Yw2jw1Z9RHY9wvGvG', NULL, '54.36.148.202', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWp5cTdJMUZ6TWJpUDVNRHM4WFJFNE9zdzlVZFhWS1c1ZGdZUGZvMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly93d3cuamtlbGVjY2l0eS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1631466299),
('vPJpoxGMKdh1ID8ATWH9XFf7khurgueaxXopMZ6R', NULL, '92.118.160.41', 'NetSystemsResearch studies the availability of various services across the internet. Our website is netsystemsresearch.com', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidVQxZk5oa3o1Yng0OHBUcHFlWmplem1QSW14RURTeERvNEV0TFUwMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vamtlbGVjY2l0eS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1631507164),
('w2aqtgodCSKqvSAyASSHNxnv0UGF4wywbJzSnckf', 1, '103.70.170.24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSTE1TVBDOUNTcFVSbk9pdmxFbFA3QllwQTV0MkxLT012YmUxS0hIOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9qa2VsZWNjaXR5LmNvbS9kYXNoYm9hcmQvcHJvZHVjdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCQ4enZkQTVpVGxMVzhGOE9Pdm5EOHlPMnd6cGN1Q0Y2L0J0M1BQeXJ4d2ZYMVFVZVR4SFpKSyI7fQ==', 1631455042),
('xC0XDNbBwXzXlreDL6KFcbmqOas0CsxpEczsXvwe', NULL, '62.4.14.198', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:58.0) Gecko/20100101 Firefox/58.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZHZrTHl2VmFUOVlMV2tWRnlkd3pMYThSM01uZHh2cnJvN0NvZ2JHeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9qa2VsZWNjaXR5LmNvbS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1631493870);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_certificate_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `nid`, `birth_certificate_no`, `address`, `description`, `phone`, `fax`, `website`, `status`) VALUES
(1, 'Master', 'master', 'master@inventory.test', NULL, '$2y$10$8zvdA5iTlLW8F8OOvnD8yO2wzpcuCF6/Bt3PPyrxwfX1QUeTxHZJK', NULL, NULL, NULL, NULL, NULL, '2021-04-12 09:48:57', '2021-04-12 09:48:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 'admin', NULL, 'admin@inventory.test', NULL, '$2y$10$T1qbN1U0IEYg3YAGCaj91e7hHlXUWkU/dFY6Re89Y13LhNgyZnAtO', NULL, NULL, NULL, NULL, NULL, '2021-04-12 09:49:00', '2021-04-12 09:49:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 'manager', NULL, 'shopmanager@inventory.test', NULL, '$2y$10$XMDZU3MVz9Ot6A.MuJ5pX.o9ueBR3yifmA0TIYz7t9zDXjalfndpq', NULL, NULL, NULL, NULL, NULL, '2021-04-12 09:49:00', '2021-04-12 09:49:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4, 'supplier', NULL, 'supplier@inventory.test', NULL, '$2y$10$4aQaTt57UXgkkKGB/uJCbedc9gxWrIq0d6cFu83OSLpwS3PGFCU7u', NULL, NULL, NULL, NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(5, 'customer', NULL, 'customer@inventory.test', NULL, '$2y$10$xug37S1NfIkq05OXe8lEN./6K/NJsV/vKzKGzpX3u/W/Jr/fqXT4u', NULL, NULL, NULL, NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(6, 'Dr. Betsy Bauch Jr.', NULL, 'fritsch.herbert@example.net', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'XX04g4xQ0R', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(7, 'Faye Roob', NULL, 'berenice32@example.com', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'vGrjQGDvEz', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(8, 'Mr. Laverna Homenick PhD', NULL, 'sarmstrong@example.net', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'JFZCAAADjs', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(9, 'Selina Kihn', NULL, 'susie.schoen@example.org', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'HIWl74jsvV', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(10, 'Kara Zboncak', NULL, 'wehner.edd@example.org', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '6T2DIdBw1j', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(11, 'Margaret Wyman', NULL, 'lessie.klein@example.org', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'Ahy3EZ9vkR', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(12, 'Petra Beatty', NULL, 'donnie.ritchie@example.net', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'wLko4RTlG2', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(13, 'Alison Corkery', NULL, 'drake.feest@example.org', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'jEHLpSH7F2', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(14, 'Boris Haag', NULL, 'casimer44@example.net', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'dgC7ukhMhI', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(15, 'Stella Marvin Jr.', NULL, 'maci06@example.org', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '8TpCPL34sK', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(16, 'Prof. Jerry Stokes DDS', NULL, 'jherman@example.com', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'PjdKaFkOE4', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(17, 'Mr. Myles Hahn', NULL, 'vilma19@example.com', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'RtfQqWrXHf', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(18, 'Kayla Dibbert III', NULL, 'von.olen@example.org', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'IwA2Hpbt22', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(19, 'Robert Pouros', NULL, 'iliana05@example.com', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'bFLCsOAqOW', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(20, 'Miss Aubrey Feil', NULL, 'dubuque.timmy@example.org', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'M6SaiXEChK', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(21, 'Jake Schulist', NULL, 'ehirthe@example.org', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'KdcY0UzIDb', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(22, 'Shany Schiller PhD', NULL, 'florida45@example.com', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'UFuW6kmiM8', NULL, NULL, '2021-04-12 09:49:01', '2021-04-12 09:49:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(23, 'Jordan Friesen PhD', NULL, 'hilma.terry@example.org', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '2lQKXtToJs', NULL, NULL, '2021-04-12 09:49:02', '2021-04-12 09:49:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(24, 'Mrs. Alexandria Grant V', NULL, 'khalil.reichel@example.net', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'jFKP14UomI', NULL, NULL, '2021-04-12 09:49:02', '2021-04-12 09:49:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(25, 'Jeramy Ebert', NULL, 'ldickens@example.org', '2021-04-12 09:49:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'YxvEVjUWOs', NULL, NULL, '2021-04-12 09:49:02', '2021-04-12 09:49:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(26, 'Well-get', NULL, 'example@gmail.com', NULL, '$2y$10$BIO37fHih/6Rw33/mGffSuxU0IH4gnDZbnXw9Fng5hiJ7qqqdCLTa', NULL, NULL, NULL, NULL, NULL, '2021-04-27 13:59:37', '2021-04-27 13:59:37', NULL, NULL, 'Shodorghat, Chittagong.', 'gfdfgdf', '1916852285', '34234', 'dsfdsf', 1),
(27, 'Pervez', NULL, NULL, NULL, '$2y$10$5siBgsmEy8KvAHzlRhulTu.YzcK26lQADa83DvEKxwxivJh5g9I4m', NULL, NULL, NULL, NULL, NULL, '2021-04-27 14:21:54', '2021-04-27 14:21:54', '34234', '32423', 'chittagong', NULL, '1834255112', NULL, NULL, 1),
(28, 'Rangs Electronics Ltd.', NULL, 'Rags@gmail.com', NULL, '$2y$10$zaqsGNcSmHedjFUyt/99D.TZ391LA7Q7MPJC9kLEAXOGz12WYtewO', NULL, NULL, NULL, NULL, NULL, '2021-09-05 15:12:29', '2021-09-05 15:12:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(29, 'Walton Supplier', NULL, 'example@e-com.test', NULL, '$2y$10$42tP1Y9WfKrzj53hLcqNfe7wC2bzw9JcCS4UHrJ92wZg557E7UERm', NULL, NULL, NULL, NULL, NULL, '2021-09-07 15:29:26', '2021-09-07 15:29:26', NULL, NULL, 'dsfdfsdf', 'sdfsdf', '1691094052', '121', 'cofsdfsd', 1),
(30, 'Pervez Ali', NULL, NULL, NULL, '$2y$10$pRXbh4hGdj5gkxDmBCxgkOgzP04ozk30a6aLiN4qAqm8VAxMBumtu', NULL, NULL, NULL, NULL, NULL, '2021-09-07 15:39:13', '2021-09-07 15:39:13', '12312312', '123123', 'sdfdsfdsf', NULL, '1691094051', NULL, NULL, 1),
(31, 'Lysandra Nunez', NULL, 'wemi@mailinator.com', NULL, '$2y$10$VG2WFmo77ufALnH65txmrePEL6/DT93gHukMvv3DpzX9IxHBAK1tm', NULL, NULL, NULL, NULL, NULL, '2021-09-07 15:46:17', '2021-09-07 15:46:17', NULL, NULL, NULL, NULL, NULL, '+1 (681) 389-2571', 'https://www.gifigedo.co', 1),
(32, 'Sony', NULL, 'sony@gmail.com', NULL, '$2y$10$UiZprlgip9uf8JBJu7vDXuJlHE/ZIry6CjZgbV8QVmwqo8Gm3s3JC', NULL, NULL, NULL, NULL, NULL, '2021-09-07 16:07:52', '2021-09-07 16:07:52', NULL, NULL, ' Sony Center - Ctg. WASA, WASA Corner, 42 Lalkhan Bazar Cir, Chattogram 4000', 'Dealer', '1644726071', '031-611334', 'http://www.rangs.com.bd/', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_configs`
--
ALTER TABLE `app_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_images`
--
ALTER TABLE `banner_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_expense_category_id_foreign` (`expense_category_id`),
  ADD KEY `expenses_added_by_foreign` (`added_by`),
  ADD KEY `expenses_expense_by_foreign` (`expense_by`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_model_name_unique` (`model_name`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_product_type_id_foreign` (`product_type_id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_types_category_id_foreign` (`category_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_user_id_foreign` (`user_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_details_purchase_id_foreign` (`purchase_id`),
  ADD KEY `purchase_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchase_returns_purchase_details_id_unique` (`purchase_details_id`),
  ADD KEY `purchase_returns_purchase_id_foreign` (`purchase_id`);

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
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_user_id_foreign` (`user_id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_details_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `sale_returns`
--
ALTER TABLE `sale_returns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sale_returns_sale_details_id_unique` (`sale_details_id`),
  ADD KEY `sale_returns_sale_id_foreign` (`sale_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nid_unique` (`nid`),
  ADD UNIQUE KEY `users_birth_certificate_no_unique` (`birth_certificate_no`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_fax_unique` (`fax`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_configs`
--
ALTER TABLE `app_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner_images`
--
ALTER TABLE `banner_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sale_returns`
--
ALTER TABLE `sale_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_expense_by_foreign` FOREIGN KEY (`expense_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_expense_category_id_foreign` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_types`
--
ALTER TABLE `product_types`
  ADD CONSTRAINT `product_types_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_details_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD CONSTRAINT `purchase_returns_purchase_details_id_foreign` FOREIGN KEY (`purchase_details_id`) REFERENCES `purchase_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_returns_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sale_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `sale_details_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_returns`
--
ALTER TABLE `sale_returns`
  ADD CONSTRAINT `sale_returns_sale_details_id_foreign` FOREIGN KEY (`sale_details_id`) REFERENCES `sale_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_returns_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
