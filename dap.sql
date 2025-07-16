-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2025 at 12:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dap`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_tasks`
--

CREATE TABLE `assign_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `assign_date` varchar(255) DEFAULT NULL,
  `expiry_date` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `group_id` varchar(255) DEFAULT NULL,
  `group_member` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active' COMMENT 'Active',
  `task_id` varchar(255) DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `case_management_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `brand_logo` varchar(255) DEFAULT NULL,
  `brand_pdf` varchar(255) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Active' COMMENT 'Active',
  `company_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_logo`, `brand_pdf`, `start_date`, `end_date`, `detail`, `status`, `company_id`, `created_at`, `updated_at`) VALUES
(6, 'Jameson Randall', 'Brand/020625_logo_.png', 'Brand/020625_pdf_1748861365.pdf', 'Rama Bates', 'Oren Harris', 'Voluptatem labore do', 'Active', '8', '2025-06-02 05:49:25', '2025-06-02 05:49:25'),
(7, 'xyz', NULL, NULL, '2025-06-01', '2025-06-04', 'sfs,dgsd', 'Active', '9', '2025-06-04 02:59:54', '2025-06-04 02:59:54'),
(8, 'tyu', NULL, NULL, '2025-06-03', '2025-06-27', 'ngk', 'Active', '10', '2025-06-27 01:43:04', '2025-06-27 01:43:04'),
(9, 'Melissa Kline', NULL, NULL, 'Peter Estes', '28-Feb-1975', 'Obcaecati quasi est', 'Active', '11', '2025-07-03 07:05:55', '2025-07-03 07:05:55'),
(10, 'Channing Hester', NULL, NULL, 'Paloma Beasley', '24-Nov-1975', 'Obcaecati in do ad o', 'Active', '11', '2025-07-03 07:10:21', '2025-07-03 07:10:21'),
(11, 'jj', NULL, NULL, '2035-04-05', '2025-07-26', NULL, 'Active', '13', '2025-07-10 01:04:38', '2025-07-10 01:04:38');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:3:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";}s:11:\"permissions\";a:102:{i:0;a:3:{s:1:\"a\";i:147;s:1:\"b\";s:12:\"view company\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:148;s:1:\"b\";s:14:\"create company\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:149;s:1:\"b\";s:12:\"edit company\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:150;s:1:\"b\";s:14:\"delete company\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:151;s:1:\"b\";s:10:\"view brand\";s:1:\"c\";s:3:\"web\";}i:5;a:3:{s:1:\"a\";i:152;s:1:\"b\";s:12:\"create brand\";s:1:\"c\";s:3:\"web\";}i:6;a:3:{s:1:\"a\";i:153;s:1:\"b\";s:10:\"edit brand\";s:1:\"c\";s:3:\"web\";}i:7;a:3:{s:1:\"a\";i:154;s:1:\"b\";s:12:\"delete brand\";s:1:\"c\";s:3:\"web\";}i:8;a:3:{s:1:\"a\";i:155;s:1:\"b\";s:12:\"view product\";s:1:\"c\";s:3:\"web\";}i:9;a:3:{s:1:\"a\";i:156;s:1:\"b\";s:14:\"create product\";s:1:\"c\";s:3:\"web\";}i:10;a:3:{s:1:\"a\";i:157;s:1:\"b\";s:12:\"edit product\";s:1:\"c\";s:3:\"web\";}i:11;a:3:{s:1:\"a\";i:158;s:1:\"b\";s:14:\"delete product\";s:1:\"c\";s:3:\"web\";}i:12;a:3:{s:1:\"a\";i:159;s:1:\"b\";s:20:\"view case management\";s:1:\"c\";s:3:\"web\";}i:13;a:3:{s:1:\"a\";i:160;s:1:\"b\";s:22:\"create case management\";s:1:\"c\";s:3:\"web\";}i:14;a:3:{s:1:\"a\";i:161;s:1:\"b\";s:20:\"edit case management\";s:1:\"c\";s:3:\"web\";}i:15;a:3:{s:1:\"a\";i:162;s:1:\"b\";s:22:\"delete case management\";s:1:\"c\";s:3:\"web\";}i:16;a:3:{s:1:\"a\";i:163;s:1:\"b\";s:18:\"view investigation\";s:1:\"c\";s:3:\"web\";}i:17;a:3:{s:1:\"a\";i:164;s:1:\"b\";s:20:\"create investigation\";s:1:\"c\";s:3:\"web\";}i:18;a:3:{s:1:\"a\";i:165;s:1:\"b\";s:18:\"edit investigation\";s:1:\"c\";s:3:\"web\";}i:19;a:3:{s:1:\"a\";i:166;s:1:\"b\";s:20:\"delete investigation\";s:1:\"c\";s:3:\"web\";}i:20;a:3:{s:1:\"a\";i:167;s:1:\"b\";s:10:\"view tasks\";s:1:\"c\";s:3:\"web\";}i:21;a:3:{s:1:\"a\";i:168;s:1:\"b\";s:12:\"create tasks\";s:1:\"c\";s:3:\"web\";}i:22;a:3:{s:1:\"a\";i:169;s:1:\"b\";s:10:\"edit tasks\";s:1:\"c\";s:3:\"web\";}i:23;a:3:{s:1:\"a\";i:170;s:1:\"b\";s:12:\"delete tasks\";s:1:\"c\";s:3:\"web\";}i:24;a:3:{s:1:\"a\";i:171;s:1:\"b\";s:13:\"view evidence\";s:1:\"c\";s:3:\"web\";}i:25;a:3:{s:1:\"a\";i:172;s:1:\"b\";s:15:\"create evidence\";s:1:\"c\";s:3:\"web\";}i:26;a:3:{s:1:\"a\";i:173;s:1:\"b\";s:13:\"edit evidence\";s:1:\"c\";s:3:\"web\";}i:27;a:3:{s:1:\"a\";i:174;s:1:\"b\";s:15:\"delete evidence\";s:1:\"c\";s:3:\"web\";}i:28;a:3:{s:1:\"a\";i:175;s:1:\"b\";s:16:\"view assign task\";s:1:\"c\";s:3:\"web\";}i:29;a:3:{s:1:\"a\";i:176;s:1:\"b\";s:18:\"create assign task\";s:1:\"c\";s:3:\"web\";}i:30;a:3:{s:1:\"a\";i:177;s:1:\"b\";s:16:\"edit assign task\";s:1:\"c\";s:3:\"web\";}i:31;a:3:{s:1:\"a\";i:178;s:1:\"b\";s:18:\"delete assign task\";s:1:\"c\";s:3:\"web\";}i:32;a:3:{s:1:\"a\";i:179;s:1:\"b\";s:15:\"view department\";s:1:\"c\";s:3:\"web\";}i:33;a:3:{s:1:\"a\";i:180;s:1:\"b\";s:17:\"create department\";s:1:\"c\";s:3:\"web\";}i:34;a:3:{s:1:\"a\";i:181;s:1:\"b\";s:15:\"edit department\";s:1:\"c\";s:3:\"web\";}i:35;a:3:{s:1:\"a\";i:182;s:1:\"b\";s:17:\"delete department\";s:1:\"c\";s:3:\"web\";}i:36;a:3:{s:1:\"a\";i:183;s:1:\"b\";s:19:\"view sub department\";s:1:\"c\";s:3:\"web\";}i:37;a:3:{s:1:\"a\";i:184;s:1:\"b\";s:21:\"create sub department\";s:1:\"c\";s:3:\"web\";}i:38;a:3:{s:1:\"a\";i:185;s:1:\"b\";s:19:\"edit sub department\";s:1:\"c\";s:3:\"web\";}i:39;a:3:{s:1:\"a\";i:186;s:1:\"b\";s:21:\"delete sub department\";s:1:\"c\";s:3:\"web\";}i:40;a:3:{s:1:\"a\";i:187;s:1:\"b\";s:9:\"view user\";s:1:\"c\";s:3:\"web\";}i:41;a:3:{s:1:\"a\";i:188;s:1:\"b\";s:11:\"create user\";s:1:\"c\";s:3:\"web\";}i:42;a:3:{s:1:\"a\";i:189;s:1:\"b\";s:9:\"edit user\";s:1:\"c\";s:3:\"web\";}i:43;a:3:{s:1:\"a\";i:190;s:1:\"b\";s:11:\"delete user\";s:1:\"c\";s:3:\"web\";}i:44;a:3:{s:1:\"a\";i:191;s:1:\"b\";s:11:\"view groups\";s:1:\"c\";s:3:\"web\";}i:45;a:3:{s:1:\"a\";i:192;s:1:\"b\";s:13:\"create groups\";s:1:\"c\";s:3:\"web\";}i:46;a:3:{s:1:\"a\";i:193;s:1:\"b\";s:11:\"edit groups\";s:1:\"c\";s:3:\"web\";}i:47;a:3:{s:1:\"a\";i:194;s:1:\"b\";s:13:\"delete groups\";s:1:\"c\";s:3:\"web\";}i:48;a:3:{s:1:\"a\";i:195;s:1:\"b\";s:30:\"view raid plaining & execution\";s:1:\"c\";s:3:\"web\";}i:49;a:3:{s:1:\"a\";i:196;s:1:\"b\";s:32:\"create raid plaining & execution\";s:1:\"c\";s:3:\"web\";}i:50;a:3:{s:1:\"a\";i:197;s:1:\"b\";s:30:\"edit raid plaining & execution\";s:1:\"c\";s:3:\"web\";}i:51;a:3:{s:1:\"a\";i:198;s:1:\"b\";s:32:\"delete raid plaining & execution\";s:1:\"c\";s:3:\"web\";}i:52;a:3:{s:1:\"a\";i:199;s:1:\"b\";s:23:\"view raid documentation\";s:1:\"c\";s:3:\"web\";}i:53;a:3:{s:1:\"a\";i:200;s:1:\"b\";s:25:\"create raid documentation\";s:1:\"c\";s:3:\"web\";}i:54;a:3:{s:1:\"a\";i:201;s:1:\"b\";s:23:\"edit raid documentation\";s:1:\"c\";s:3:\"web\";}i:55;a:3:{s:1:\"a\";i:202;s:1:\"b\";s:25:\"delete raid documentation\";s:1:\"c\";s:3:\"web\";}i:56;a:3:{s:1:\"a\";i:203;s:1:\"b\";s:24:\"view pending destruction\";s:1:\"c\";s:3:\"web\";}i:57;a:3:{s:1:\"a\";i:204;s:1:\"b\";s:26:\"create pending destruction\";s:1:\"c\";s:3:\"web\";}i:58;a:3:{s:1:\"a\";i:205;s:1:\"b\";s:24:\"edit pending destruction\";s:1:\"c\";s:3:\"web\";}i:59;a:3:{s:1:\"a\";i:206;s:1:\"b\";s:26:\"delete pending destruction\";s:1:\"c\";s:3:\"web\";}i:60;a:3:{s:1:\"a\";i:207;s:1:\"b\";s:26:\"view completed destruction\";s:1:\"c\";s:3:\"web\";}i:61;a:3:{s:1:\"a\";i:208;s:1:\"b\";s:28:\"create completed destruction\";s:1:\"c\";s:3:\"web\";}i:62;a:3:{s:1:\"a\";i:209;s:1:\"b\";s:26:\"edit completed destruction\";s:1:\"c\";s:3:\"web\";}i:63;a:3:{s:1:\"a\";i:210;s:1:\"b\";s:28:\"delete completed destruction\";s:1:\"c\";s:3:\"web\";}i:64;a:3:{s:1:\"a\";i:211;s:1:\"b\";s:13:\"view currency\";s:1:\"c\";s:3:\"web\";}i:65;a:3:{s:1:\"a\";i:212;s:1:\"b\";s:15:\"create currency\";s:1:\"c\";s:3:\"web\";}i:66;a:3:{s:1:\"a\";i:213;s:1:\"b\";s:13:\"edit currency\";s:1:\"c\";s:3:\"web\";}i:67;a:3:{s:1:\"a\";i:214;s:1:\"b\";s:15:\"delete currency\";s:1:\"c\";s:3:\"web\";}i:68;a:3:{s:1:\"a\";i:215;s:1:\"b\";s:22:\"view recieved payments\";s:1:\"c\";s:3:\"web\";}i:69;a:3:{s:1:\"a\";i:216;s:1:\"b\";s:24:\"create recieved payments\";s:1:\"c\";s:3:\"web\";}i:70;a:3:{s:1:\"a\";i:217;s:1:\"b\";s:22:\"edit recieved payments\";s:1:\"c\";s:3:\"web\";}i:71;a:3:{s:1:\"a\";i:218;s:1:\"b\";s:24:\"delete recieved payments\";s:1:\"c\";s:3:\"web\";}i:72;a:3:{s:1:\"a\";i:219;s:1:\"b\";s:17:\"view due tracking\";s:1:\"c\";s:3:\"web\";}i:73;a:3:{s:1:\"a\";i:220;s:1:\"b\";s:19:\"create due tracking\";s:1:\"c\";s:3:\"web\";}i:74;a:3:{s:1:\"a\";i:221;s:1:\"b\";s:17:\"edit due tracking\";s:1:\"c\";s:3:\"web\";}i:75;a:3:{s:1:\"a\";i:222;s:1:\"b\";s:19:\"delete due tracking\";s:1:\"c\";s:3:\"web\";}i:76;a:3:{s:1:\"a\";i:223;s:1:\"b\";s:22:\"view profit & expences\";s:1:\"c\";s:3:\"web\";}i:77;a:3:{s:1:\"a\";i:224;s:1:\"b\";s:24:\"create profit & expences\";s:1:\"c\";s:3:\"web\";}i:78;a:3:{s:1:\"a\";i:225;s:1:\"b\";s:22:\"edit profit & expences\";s:1:\"c\";s:3:\"web\";}i:79;a:3:{s:1:\"a\";i:226;s:1:\"b\";s:24:\"delete profit & expences\";s:1:\"c\";s:3:\"web\";}i:80;a:3:{s:1:\"a\";i:227;s:1:\"b\";s:17:\"view disbursement\";s:1:\"c\";s:3:\"web\";}i:81;a:3:{s:1:\"a\";i:228;s:1:\"b\";s:19:\"create disbursement\";s:1:\"c\";s:3:\"web\";}i:82;a:3:{s:1:\"a\";i:229;s:1:\"b\";s:17:\"edit disbursement\";s:1:\"c\";s:3:\"web\";}i:83;a:3:{s:1:\"a\";i:230;s:1:\"b\";s:19:\"delete disbursement\";s:1:\"c\";s:3:\"web\";}i:84;a:3:{s:1:\"a\";i:231;s:1:\"b\";s:13:\"view invoices\";s:1:\"c\";s:3:\"web\";}i:85;a:3:{s:1:\"a\";i:232;s:1:\"b\";s:15:\"create invoices\";s:1:\"c\";s:3:\"web\";}i:86;a:3:{s:1:\"a\";i:233;s:1:\"b\";s:13:\"edit invoices\";s:1:\"c\";s:3:\"web\";}i:87;a:3:{s:1:\"a\";i:234;s:1:\"b\";s:15:\"delete invoices\";s:1:\"c\";s:3:\"web\";}i:88;a:3:{s:1:\"a\";i:235;s:1:\"b\";s:16:\"view case report\";s:1:\"c\";s:3:\"web\";}i:89;a:3:{s:1:\"a\";i:236;s:1:\"b\";s:18:\"create case report\";s:1:\"c\";s:3:\"web\";}i:90;a:3:{s:1:\"a\";i:237;s:1:\"b\";s:16:\"edit case report\";s:1:\"c\";s:3:\"web\";}i:91;a:3:{s:1:\"a\";i:238;s:1:\"b\";s:18:\"delete case report\";s:1:\"c\";s:3:\"web\";}i:92;a:3:{s:1:\"a\";i:239;s:1:\"b\";s:19:\"view client reports\";s:1:\"c\";s:3:\"web\";}i:93;a:3:{s:1:\"a\";i:240;s:1:\"b\";s:21:\"create client reports\";s:1:\"c\";s:3:\"web\";}i:94;a:3:{s:1:\"a\";i:241;s:1:\"b\";s:19:\"edit client reports\";s:1:\"c\";s:3:\"web\";}i:95;a:3:{s:1:\"a\";i:242;s:1:\"b\";s:21:\"delete client reports\";s:1:\"c\";s:3:\"web\";}i:96;a:3:{s:1:\"a\";i:243;s:1:\"b\";s:20:\"view finance reports\";s:1:\"c\";s:3:\"web\";}i:97;a:3:{s:1:\"a\";i:244;s:1:\"b\";s:22:\"create finance reports\";s:1:\"c\";s:3:\"web\";}i:98;a:3:{s:1:\"a\";i:245;s:1:\"b\";s:20:\"edit finance reports\";s:1:\"c\";s:3:\"web\";}i:99;a:3:{s:1:\"a\";i:246;s:1:\"b\";s:22:\"delete finance reports\";s:1:\"c\";s:3:\"web\";}i:100;a:3:{s:1:\"a\";i:247;s:1:\"b\";s:9:\"follow-up\";s:1:\"c\";s:3:\"web\";}i:101;a:3:{s:1:\"a\";i:248;s:1:\"b\";s:8:\"settings\";s:1:\"c\";s:3:\"web\";}}s:5:\"roles\";a:0:{}}', 1752670046);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `case_managements`
--

CREATE TABLE `case_managements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` varchar(255) DEFAULT NULL,
  `client_id` varchar(255) NOT NULL,
  `case_name` varchar(255) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `case_type` varchar(255) NOT NULL,
  `target_category` varchar(255) NOT NULL,
  `case_priority` varchar(255) NOT NULL,
  `case_fee` varchar(255) NOT NULL,
  `task` varchar(255) DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `case_location` varchar(255) NOT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_managements`
--

INSERT INTO `case_managements` (`id`, `auto_id`, `client_id`, `case_name`, `document`, `case_type`, `target_category`, `case_priority`, `case_fee`, `task`, `flag`, `case_location`, `start_date`, `end_date`, `status`, `description`, `company_id`, `brand_id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(29, 'DP-001', 'DP-001-client', 'Leroy Zamora', 'Case/020625_document_.jpg', 'Pro Active', '2', 'Medium', '23', NULL, '1', 'Voluptatum consectet', '2025-06-01', '2025-06-03', 'Approved', 'Dolorem aliqua Qui', 6, 6, 10, '7', '2025-06-02 05:51:11', '2025-06-02 05:51:11'),
(30, 'DP-030', 'DP-030-client', 'xyz', NULL, 'Targeted', '3', 'Low', '5000', NULL, '1', 'xyz', '2025-06-04', '2025-06-26', 'High-Risk-case', 'wejie', 9, 7, 12, '7', '2025-06-04 04:49:34', '2025-06-04 04:49:34'),
(31, 'DP-031', 'DP-031-client', 'tl', NULL, 'Targeted', '2', 'Medium', '675', NULL, '0', 'trty', '2025-06-30', '2025-06-30', 'High-Risk-case', 'gtrgtr', 7, 6, 11, '7', '2025-06-27 01:52:28', '2025-06-27 01:52:28'),
(32, 'DP-032', 'DP-032-client', 'Lila Mayer', NULL, 'Pro Active', '2', 'Medium', '23', NULL, '1', 'Aut aliqua Laborum', '28-Dec-1988', '06-Jun-2006', 'Pending Approval', NULL, 10, 9, 11, '7', '2025-07-03 07:12:48', '2025-07-03 07:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `case_reports`
--

CREATE TABLE `case_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` varchar(255) DEFAULT NULL,
  `raid_type` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `case_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_reports`
--

CREATE TABLE `client_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` varchar(255) DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `raid_type` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `payed_amount` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `case_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mou_start_date` varchar(255) DEFAULT NULL,
  `mou_end_date` varchar(255) DEFAULT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `company_pdf` varchar(255) DEFAULT NULL,
  `company_detail` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Active' COMMENT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `company_address`, `company_email`, `phone_no`, `password`, `mou_start_date`, `mou_end_date`, `company_logo`, `company_pdf`, `company_detail`, `status`, `created_at`, `updated_at`) VALUES
(5, 'stackbuffers', 'rawalpindi', 'stack@gmail.com', '0328787283', 'eyJpdiI6ImV6b3ByTmZWaHpiY1pOSmdHcCtvaHc9PSIsInZhbHVlIjoiR3h5MkdiUHRuQXFvRGNVbytOYTlkZz09IiwibWFjIjoiZDE4ZGM0NzdjNDczMDVlNTY3NDA4Y2Q1ZDg3MGVjNWIxZWM5YzY5YjMwNTY1YWY5Y2FmZWUzYTNmMTdhZWNiZSIsInRhZyI6IiJ9', '2025-05-04', '2025-05-31', 'Company/150525_logo_1747302436.webp', NULL, 'abc', 'Active', '2025-05-12 12:06:51', '2025-05-15 04:47:16'),
(6, 'test123', 'rawalpindi', 'test123@gmail.com', '0328787283', 'eyJpdiI6ImtOekhEYjlNSkJRRmQrbUM1MEdwaXc9PSIsInZhbHVlIjoic1AvTzdxc0pERndPT1lDK3p6RXNydz09IiwibWFjIjoiZTY0NDU0NDAzYjUyOTM3YTFhM2UxYWU0YTgxNjczNjc0NzA1YzA3MzBkMTBlZmY2NDMyOTgyMWU0ZTRkY2M2ZSIsInRhZyI6IiJ9', '2025-05-04', '2025-05-30', 'Company/150525_logo_1747302426.jpg', NULL, 'abc', 'Active', '2025-05-13 06:02:58', '2025-05-15 04:47:06'),
(7, 'soft', 'rawalpindi', 'soft@gmail.com', '0328787283', 'eyJpdiI6Ijl2SXdoR0VONnEzTmJodW40d20vRmc9PSIsInZhbHVlIjoiVjYxQlBmbkl0Uk1oNGpuMVBBWHR6UT09IiwibWFjIjoiOGU0Yzk2NDU2Mzg3ZTIxMDU4YjMyNDg1MDEwOWRlNTAzNzliYjg5YzM2YTc3YjIwYThhZWExYTU2NzkxOGRhMyIsInRhZyI6IiJ9', '2025-05-01', '2025-05-26', 'Company/150525_logo_1747302415.jpg', NULL, 'abc', 'Active', '2025-05-13 06:03:40', '2025-05-15 04:46:55'),
(8, 'Black Holder Plc', 'Velazquez and Guerrero Associates', 'wysaw@mailinator.com', 'Inez Oneill', 'eyJpdiI6InRkbmtlV1lENHROcnlIVzZ6cE5lWlE9PSIsInZhbHVlIjoiM1hyT2lBWjdVaEYwVWJ0OG5xTzlIQT09IiwibWFjIjoiZjBkZGE2ODBkMDYwMzAyZTkyYmYxOTc1Mjc0OWNlNjkyMmQ5ODVmMmZmMTY3N2YzMGFmMDJmZWEyNDMxYzI0ZiIsInRhZyI6IiJ9', '24-Sep-1982', '10-Mar-1982', 'Company/150525_logo_1747302301.png', 'Company/100725_pdf_1752132559.pdf', 'Repudiandae quis sin', 'Active', '2025-05-14 07:18:04', '2025-07-10 02:29:20'),
(9, 'xyz', 'xyz', 'xyz@gmail.com', '03123456788', 'eyJpdiI6Ik9CSVFoalZhVDMxYk9PaEZkd3Q0Qmc9PSIsInZhbHVlIjoiNGFDV3JxNXBBbFBLRVBDNHZ4RHB4QT09IiwibWFjIjoiNzQyMDllNzZlZDQ1NWRmYTY2NzdiMmIxNTMwYWM4YjkwZGNhOWYyZGUxMjJmZDFkZTdhN2Q0NzhjNDc0MzkwYyIsInRhZyI6IiJ9', '2020-05-01', '2025-05-31', NULL, NULL, 'eiiwetj', 'Active', '2025-06-04 02:50:17', '2025-06-04 02:50:17'),
(10, 'xyzbv', 'dsnng', 'hfh@gmail.com', '346565436', 'eyJpdiI6IjZQTUpBV1ArVm13ZzZ0c2psVnZEY0E9PSIsInZhbHVlIjoiV1loSUc1KzEzdG9YaER2Y1FOQ1ExUT09IiwibWFjIjoiNjRmM2Q0NWU4ZDliNDdkMTg3YmQ4NjcxZTRjOTY0MTdlMWY1ZTk0NzI3MDNjZjgzNjZkNzZiNzEyNTI3ZDk5OCIsInRhZyI6IiJ9', '2025-05-05', '2025-06-30', NULL, NULL, 'dfgdk', 'Active', '2025-06-27 01:21:57', '2025-06-27 01:22:42'),
(11, 'Valencia Griffin Traders', 'Cooley and Serrano Associates', 'xynilaqyfy@mailinator.com', 'Caryn Estes', 'eyJpdiI6IkM4N1RwTHQ1djNPVDVzQXdXYnF3VXc9PSIsInZhbHVlIjoiOU1nNFNMNEc2UG5vcm5Xbk82Mzl5QT09IiwibWFjIjoiZTlhNWEwZGRhZDkzYjU3NGQwMmY1NzNkYTZjZWI4NDkzMGZiOTgzNGUzMjMyN2FmYzMyNTdmYTA1MjEzYzg0NCIsInRhZyI6IiJ9', '2025-06-10', '2025-06-19', NULL, NULL, 'Eos aperiam facere', 'Active', '2025-06-30 02:30:42', '2025-06-30 02:30:42'),
(12, 'SKMG LLC', '8622 Valley Ranch Pkwy W Apt 2097', 'sales@skmgwholesale.com', '12819685103', 'eyJpdiI6IlRCc1hlMWxWNjF0TmpmdXdUVlNXQnc9PSIsInZhbHVlIjoiNXFWbU5xTHVqMUdZSDdheVdKck1UQT09IiwibWFjIjoiNzMyNWE4ZjNlMjJiNGRlNDU3ZTM2NGY1NGZkYmIwZTlkMWMzMzY5M2QzN2FhNjY2NjEzOTlkMDc2ZGJlMTRmNiIsInRhZyI6IiJ9', '2020-05-01', '2025-06-30', NULL, NULL, 'kkfdgk', 'Active', '2025-07-03 01:11:31', '2025-07-03 01:11:31'),
(13, 'jgfk', 'fjtj', 'jtfj@gmail.com', '08544353536', NULL, '2025-07-31', '2025-05-17', NULL, NULL, NULL, 'Active', '2025-07-10 00:50:08', '2025-07-10 00:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `completed_destructions`
--

CREATE TABLE `completed_destructions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` varchar(255) DEFAULT NULL,
  `raid_type` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `case_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_name` varchar(255) DEFAULT NULL,
  `country_name` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `symbol` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active' COMMENT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency_name`, `country_name`, `country_code`, `symbol`, `status`, `created_at`, `updated_at`) VALUES
(3, 'PKR', 'Pakistan', '+92', 'CurrencySymbol/020625_symbol_.png', 'Inactive', '2025-06-02 04:29:54', '2025-06-02 04:50:03'),
(5, 'USD', 'United States', '+1', 'CurrencySymbol/020625_symbol_.jpg', 'Active', '2025-06-02 04:49:17', '2025-06-02 04:50:35'),
(7, 'USD', 'Afghanistan', '+93', NULL, 'Active', '2025-06-04 02:34:04', '2025-07-10 04:41:41');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `head_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active' COMMENT 'Active',
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `head_name`, `location`, `status`, `company_id`, `sub_department_id`, `created_at`, `updated_at`) VALUES
(6, 'Accountant', 'Cot', 'Islamabad', 'Active', 5, NULL, '2025-07-11 05:27:53', '2025-07-11 05:27:53');

-- --------------------------------------------------------

--
-- Table structure for table `evidence`
--

CREATE TABLE `evidence` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` varchar(255) DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `case_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evidence`
--

INSERT INTO `evidence` (`id`, `auto_id`, `client_id`, `document`, `case_id`, `created_at`, `updated_at`) VALUES
(5, 'DP-001', 'DP-001-client', NULL, 29, '2025-06-04 07:25:58', '2025-06-04 07:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `evidence_images`
--

CREATE TABLE `evidence_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `evidence_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evidence_images`
--

INSERT INTO `evidence_images` (`id`, `evidence_id`, `image_path`, `created_at`, `updated_at`) VALUES
(3, 5, 'Evidence/040625_122558_0_68403b568e27c.png', '2025-06-04 07:25:58', '2025-06-04 07:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` varchar(255) DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `case_name` varchar(255) DEFAULT NULL,
  `case_type` varchar(255) DEFAULT NULL,
  `target_category` varchar(255) DEFAULT NULL,
  `case_priority` varchar(255) DEFAULT NULL,
  `advance_fee` varchar(255) DEFAULT NULL,
  `case_expense` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `case_location` varchar(255) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `desbursement` varchar(255) DEFAULT 'Active' COMMENT 'Active',
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `currency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `case_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `auto_id`, `client_id`, `case_name`, `case_type`, `target_category`, `case_priority`, `advance_fee`, `case_expense`, `total_amount`, `case_location`, `start_date`, `end_date`, `status`, `desbursement`, `company_id`, `brand_id`, `product_id`, `currency_id`, `case_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'DP-001', 'DP-001-client', NULL, 'Pro Active', '3', 'High', '34', '43', '450', 'pindi', '2025-06-01', '2025-06-02', 'Pending Approval', 'Inactive', 6, 6, 10, 3, 29, NULL, '2025-06-02 06:11:47', '2025-06-02 06:50:20'),
(2, 'DP-002', 'DP-002-client', NULL, 'Pro Active', '1', 'Low', '23', '78', '456', 'islamabad', '2025-06-01', '2025-06-02', 'In Progress', 'Active', 8, 6, 10, 5, 29, NULL, '2025-06-02 07:17:53', '2025-07-10 04:42:56');

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
-- Table structure for table `finance_reports`
--

CREATE TABLE `finance_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` varchar(255) DEFAULT NULL,
  `raid_type` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `expenses` varchar(255) DEFAULT NULL,
  `profit` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `group_member` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active' COMMENT 'Active',
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investigations`
--

CREATE TABLE `investigations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` varchar(255) NOT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `invest_name` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `case_type` varchar(255) NOT NULL,
  `case_name` varchar(255) DEFAULT NULL,
  `current_status` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `assign_case` varchar(255) DEFAULT NULL,
  `task_start_date` varchar(255) NOT NULL,
  `task_deadline` varchar(255) NOT NULL,
  `investigation_description` varchar(255) DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `case_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` int(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investigations`
--

INSERT INTO `investigations` (`id`, `auto_id`, `client_id`, `invest_name`, `document`, `case_type`, `case_name`, `current_status`, `location`, `assign_case`, `task_start_date`, `task_deadline`, `investigation_description`, `company_id`, `brand_id`, `product_id`, `case_id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 'DP-001', NULL, 'testing', NULL, 'Pro Active', NULL, 'Approved', 'Ariel Gilbert', NULL, '2025-06-02', '2025-06-06', 'Aut reprehenderit qu', 6, 6, 10, 29, 23, '2025-06-04 01:13:51', '2025-06-04 05:18:59'),
(5, 'DP-005', NULL, 'xyz', NULL, 'Targeted', NULL, 'Pending Approval', 'qwerty', NULL, '2025-06-04', '2025-06-24', 'qwerty', 9, 7, 12, 30, 7, '2025-06-04 07:21:59', '2025-06-04 07:21:59'),
(6, 'DP-006', NULL, 'xyz', NULL, 'Targeted', NULL, 'Pending Approval', '05', NULL, '2025-06-12', '2025-06-30', 'yt', 9, 7, 12, 30, 22, '2025-06-11 01:44:29', '2025-06-11 01:44:29'),
(7, 'DP-007', NULL, 'xyz9', NULL, 'Pro Active', NULL, 'Pending Approval', 'wqeqw', NULL, '2025-06-03', '2025-06-30', 'ret', 6, 6, 10, 29, 7, '2025-06-11 01:50:02', '2025-06-11 01:50:02'),
(8, 'DP-008', NULL, 'Tanisha Sosa', NULL, 'Pro Active', NULL, 'Pending Approval', 'Karleigh Mcmahon', NULL, '2025-06-03', '2025-06-18', 'Iste consequatur di', 6, 6, 10, 29, 22, '2025-06-26 05:28:03', '2025-06-26 05:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` varchar(255) DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `case_type` varchar(255) DEFAULT NULL,
  `target_category` varchar(255) DEFAULT NULL,
  `case_priority` varchar(255) DEFAULT NULL,
  `advance_fee` varchar(255) DEFAULT NULL,
  `case_expense` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `case_location` varchar(255) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `currency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `case_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `auto_id`, `client_id`, `case_type`, `target_category`, `case_priority`, `advance_fee`, `case_expense`, `total_amount`, `discount`, `case_location`, `start_date`, `end_date`, `status`, `company_id`, `brand_id`, `product_id`, `currency_id`, `case_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'DP-001', 'DP-001-client', 'Targeted', '1', 'Medium', '32', 'Other Expenses', '343', '43', 'Laborum elit dolor', '2025-06-01', '2025-06-02', 'In Progress', 5, 6, 10, 5, 29, NULL, '2025-06-03 07:23:35', '2025-06-03 07:23:35'),
(3, 'DP-003', 'DP-003-client', 'Targeted', '2', 'Medium', '323', 'Other Expenses', '343', '233', 'rawal', '2025-06-01', '2025-06-03', 'Approved', 5, 6, 10, 3, 29, NULL, '2025-06-03 07:29:09', '2025-06-03 07:29:27');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(16, '0001_01_01_000000_create_users_table', 1),
(17, '0001_01_01_000001_create_cache_table', 1),
(18, '0001_01_01_000002_create_jobs_table', 1),
(19, '2025_04_21_072818_create_brands_table', 1),
(20, '2025_04_21_073406_create_companies_table', 1),
(21, '2025_04_21_101827_create_user_accounts_table', 1),
(23, '2025_04_24_100358_create_products_table', 2),
(25, '2025_04_25_042645_create_case_management_table', 3),
(26, '2025_04_25_042645_create_case_managements_table', 4),
(29, '2025_04_25_045358_create_investigations_table', 5),
(30, '2025_04_29_094133_create_sub_departments_table', 6),
(31, '2025_04_29_093858_create_departments_table', 7),
(32, '2025_05_01_101437_create_permission_tables', 8),
(33, '2025_05_02_092137_create_product_images_table', 9),
(34, '2025_05_15_073537_create_tasks_table', 10),
(35, '2025_05_20_044526_create_evidence_table', 11),
(36, '2025_05_20_052521_create_evidence_images_table', 12),
(39, '2025_05_20_065735_create_assign_tasks_table', 13),
(41, '2025_05_22_041424_create_groups_table', 14),
(42, '2025_05_22_095352_create_raid_plainings_table', 15),
(44, '2025_05_23_050437_create_raid_documentations_table', 16),
(45, '2025_05_23_070449_create_pending_destructions_table', 17),
(46, '2025_05_30_103208_create_completed_destructions_table', 18),
(47, '2025_05_30_111850_create_currencies_table', 19),
(49, '2025_06_02_095320_create_expenses_table', 20),
(50, '2025_06_03_051205_create_invoices_table', 21),
(51, '2025_06_03_060120_create_case_reports_table', 22),
(54, '2025_06_03_075232_create_client_reports_table', 23),
(55, '2025_06_04_042557_create_finance_reports_table', 24),
(56, '2025_06_25_102028_add_case_management_id_to_assign_tasks_table', 25);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(147, 'App\\Models\\User', 7),
(147, 'App\\Models\\User', 8),
(147, 'App\\Models\\User', 10),
(147, 'App\\Models\\User', 15),
(147, 'App\\Models\\User', 16),
(147, 'App\\Models\\User', 18),
(148, 'App\\Models\\User', 7),
(148, 'App\\Models\\User', 8),
(148, 'App\\Models\\User', 10),
(148, 'App\\Models\\User', 16),
(149, 'App\\Models\\User', 7),
(149, 'App\\Models\\User', 15),
(150, 'App\\Models\\User', 7),
(150, 'App\\Models\\User', 8),
(151, 'App\\Models\\User', 7),
(152, 'App\\Models\\User', 7),
(153, 'App\\Models\\User', 7),
(154, 'App\\Models\\User', 7),
(155, 'App\\Models\\User', 7),
(156, 'App\\Models\\User', 7),
(157, 'App\\Models\\User', 7),
(158, 'App\\Models\\User', 7),
(159, 'App\\Models\\User', 7),
(159, 'App\\Models\\User', 8),
(159, 'App\\Models\\User', 18),
(159, 'App\\Models\\User', 19),
(159, 'App\\Models\\User', 22),
(159, 'App\\Models\\User', 23),
(160, 'App\\Models\\User', 7),
(160, 'App\\Models\\User', 8),
(160, 'App\\Models\\User', 18),
(160, 'App\\Models\\User', 19),
(161, 'App\\Models\\User', 7),
(161, 'App\\Models\\User', 19),
(162, 'App\\Models\\User', 7),
(162, 'App\\Models\\User', 19),
(163, 'App\\Models\\User', 7),
(164, 'App\\Models\\User', 7),
(165, 'App\\Models\\User', 7),
(166, 'App\\Models\\User', 7),
(167, 'App\\Models\\User', 7),
(168, 'App\\Models\\User', 7),
(169, 'App\\Models\\User', 7),
(170, 'App\\Models\\User', 7),
(171, 'App\\Models\\User', 7),
(172, 'App\\Models\\User', 7),
(173, 'App\\Models\\User', 7),
(174, 'App\\Models\\User', 7),
(175, 'App\\Models\\User', 7),
(176, 'App\\Models\\User', 7),
(177, 'App\\Models\\User', 7),
(178, 'App\\Models\\User', 7),
(179, 'App\\Models\\User', 7),
(180, 'App\\Models\\User', 7),
(181, 'App\\Models\\User', 7),
(182, 'App\\Models\\User', 7),
(183, 'App\\Models\\User', 7),
(184, 'App\\Models\\User', 7),
(185, 'App\\Models\\User', 7),
(186, 'App\\Models\\User', 7),
(187, 'App\\Models\\User', 7),
(188, 'App\\Models\\User', 7),
(189, 'App\\Models\\User', 7),
(190, 'App\\Models\\User', 7),
(191, 'App\\Models\\User', 7),
(192, 'App\\Models\\User', 7),
(193, 'App\\Models\\User', 7),
(194, 'App\\Models\\User', 7),
(195, 'App\\Models\\User', 7),
(196, 'App\\Models\\User', 7),
(197, 'App\\Models\\User', 7),
(198, 'App\\Models\\User', 7),
(199, 'App\\Models\\User', 7),
(200, 'App\\Models\\User', 7),
(201, 'App\\Models\\User', 7),
(202, 'App\\Models\\User', 7),
(203, 'App\\Models\\User', 7),
(204, 'App\\Models\\User', 7),
(205, 'App\\Models\\User', 7),
(206, 'App\\Models\\User', 7),
(207, 'App\\Models\\User', 7),
(208, 'App\\Models\\User', 7),
(209, 'App\\Models\\User', 7),
(210, 'App\\Models\\User', 7),
(211, 'App\\Models\\User', 7),
(212, 'App\\Models\\User', 7),
(213, 'App\\Models\\User', 7),
(214, 'App\\Models\\User', 7),
(215, 'App\\Models\\User', 7),
(216, 'App\\Models\\User', 7),
(217, 'App\\Models\\User', 7),
(218, 'App\\Models\\User', 7),
(219, 'App\\Models\\User', 7),
(220, 'App\\Models\\User', 7),
(221, 'App\\Models\\User', 7),
(222, 'App\\Models\\User', 7),
(223, 'App\\Models\\User', 7),
(224, 'App\\Models\\User', 7),
(225, 'App\\Models\\User', 7),
(226, 'App\\Models\\User', 7),
(227, 'App\\Models\\User', 7),
(228, 'App\\Models\\User', 7),
(229, 'App\\Models\\User', 7),
(230, 'App\\Models\\User', 7),
(231, 'App\\Models\\User', 7),
(232, 'App\\Models\\User', 7),
(233, 'App\\Models\\User', 7),
(234, 'App\\Models\\User', 7),
(235, 'App\\Models\\User', 7),
(236, 'App\\Models\\User', 7),
(237, 'App\\Models\\User', 7),
(238, 'App\\Models\\User', 7),
(239, 'App\\Models\\User', 7),
(240, 'App\\Models\\User', 7),
(241, 'App\\Models\\User', 7),
(242, 'App\\Models\\User', 7),
(243, 'App\\Models\\User', 7),
(243, 'App\\Models\\User', 15),
(244, 'App\\Models\\User', 7),
(245, 'App\\Models\\User', 7),
(246, 'App\\Models\\User', 7),
(247, 'App\\Models\\User', 7),
(248, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pending_destructions`
--

CREATE TABLE `pending_destructions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` varchar(255) DEFAULT NULL,
  `raid_type` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `case_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(147, 'view company', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(148, 'create company', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(149, 'edit company', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(150, 'delete company', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(151, 'view brand', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(152, 'create brand', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(153, 'edit brand', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(154, 'delete brand', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(155, 'view product', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(156, 'create product', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(157, 'edit product', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(158, 'delete product', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(159, 'view case management', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(160, 'create case management', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(161, 'edit case management', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(162, 'delete case management', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(163, 'view investigation', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(164, 'create investigation', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(165, 'edit investigation', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(166, 'delete investigation', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(167, 'view tasks', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(168, 'create tasks', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(169, 'edit tasks', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(170, 'delete tasks', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(171, 'view evidence', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(172, 'create evidence', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(173, 'edit evidence', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(174, 'delete evidence', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(175, 'view assign task', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(176, 'create assign task', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(177, 'edit assign task', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(178, 'delete assign task', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(179, 'view department', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(180, 'create department', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(181, 'edit department', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(182, 'delete department', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(183, 'view sub department', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(184, 'create sub department', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(185, 'edit sub department', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(186, 'delete sub department', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(187, 'view user', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(188, 'create user', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(189, 'edit user', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(190, 'delete user', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(191, 'view groups', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(192, 'create groups', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(193, 'edit groups', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(194, 'delete groups', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(195, 'view raid plaining & execution', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(196, 'create raid plaining & execution', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(197, 'edit raid plaining & execution', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(198, 'delete raid plaining & execution', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(199, 'view raid documentation', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(200, 'create raid documentation', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(201, 'edit raid documentation', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(202, 'delete raid documentation', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(203, 'view pending destruction', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(204, 'create pending destruction', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(205, 'edit pending destruction', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(206, 'delete pending destruction', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(207, 'view completed destruction', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(208, 'create completed destruction', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(209, 'edit completed destruction', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(210, 'delete completed destruction', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(211, 'view currency', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(212, 'create currency', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(213, 'edit currency', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(214, 'delete currency', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(215, 'view recieved payments', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(216, 'create recieved payments', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(217, 'edit recieved payments', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(218, 'delete recieved payments', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(219, 'view due tracking', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(220, 'create due tracking', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(221, 'edit due tracking', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(222, 'delete due tracking', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(223, 'view profit & expences', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(224, 'create profit & expences', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(225, 'edit profit & expences', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(226, 'delete profit & expences', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(227, 'view disbursement', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(228, 'create disbursement', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(229, 'edit disbursement', 'web', '2025-05-06 01:37:25', '2025-05-06 01:37:25'),
(230, 'delete disbursement', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(231, 'view invoices', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(232, 'create invoices', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(233, 'edit invoices', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(234, 'delete invoices', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(235, 'view case report', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(236, 'create case report', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(237, 'edit case report', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(238, 'delete case report', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(239, 'view client reports', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(240, 'create client reports', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(241, 'edit client reports', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(242, 'delete client reports', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(243, 'view finance reports', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(244, 'create finance reports', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(245, 'edit finance reports', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(246, 'delete finance reports', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(247, 'follow-up', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26'),
(248, 'settings', 'web', '2025-05-06 01:37:26', '2025-05-06 01:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_category` varchar(255) DEFAULT NULL,
  `product_img` text DEFAULT NULL,
  `trademark_date` varchar(255) DEFAULT NULL,
  `copyright_date` varchar(255) DEFAULT NULL,
  `patient_date` varchar(255) DEFAULT NULL,
  `product_detail` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active' COMMENT 'Active',
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_category`, `product_img`, `trademark_date`, `copyright_date`, `patient_date`, `product_detail`, `status`, `company_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(10, 'John Larson', '3', NULL, '08-May-1995', '21-Oct-1975', '06-May-2025', 'Optio dicta dolor m', 'Active', 8, 6, '2025-06-02 05:49:58', '2025-06-02 05:49:58'),
(11, 'Men Luxury Watches', '3', NULL, '2025-06-26', '2025-06-11', '2025-06-16', 'gfghjkl;', 'Active', 9, 7, '2025-06-04 03:02:04', '2025-06-04 03:02:04'),
(12, 'xyz', '3', NULL, '2025-05-03', '2025-06-11', '2025-06-28', 'xxyyzz', 'Active', 9, 7, '2025-06-04 04:41:48', '2025-06-04 04:41:48'),
(13, 'Garments', '3', NULL, '2025-05-03', '2025-06-20', '2025-06-30', 'fdkgdfkgk', 'Active', 10, 8, '2025-06-27 01:44:09', '2025-06-27 01:44:09'),
(14, 'Tatum Lynch', 'Nutella', NULL, '2025-06-02', '2025-06-05', '2025-06-10', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries', 'Active', 8, 8, '2025-06-30 00:29:55', '2025-06-30 02:25:30'),
(15, 'Keelie Hughes', '3', NULL, '16-Aug-1996', '17-Jun-1989', '18-Apr-2007', 'Sunt in quis at sus', 'Active', 12, 9, '2025-07-03 07:12:17', '2025-07-03 07:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`) VALUES
(4, 10, 'Product/020625_104958_0_683d81d657ea6.png', '2025-06-02 05:49:58', '2025-06-02 05:49:58'),
(5, 14, 'Product/300625_052955_0_686220d3cc47a.webp', '2025-06-30 00:29:56', '2025-06-30 00:29:56'),
(6, 14, 'Product/300625_071759_0_68623a271e0e5.jpg', '2025-06-30 02:17:59', '2025-06-30 02:17:59'),
(7, 14, 'Product/300625_071759_1_68623a272570d.jpg', '2025-06-30 02:17:59', '2025-06-30 02:17:59'),
(8, 14, 'Product/300625_071759_2_68623a2726cfe.jpg', '2025-06-30 02:17:59', '2025-06-30 02:17:59'),
(9, 14, 'Product/300625_071759_3_68623a272b560.jpg', '2025-06-30 02:17:59', '2025-06-30 02:17:59'),
(10, 14, 'Product/300625_071759_4_68623a272cb6a.webp', '2025-06-30 02:17:59', '2025-06-30 02:17:59');

-- --------------------------------------------------------

--
-- Table structure for table `raid_documentations`
--

CREATE TABLE `raid_documentations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` varchar(255) DEFAULT NULL,
  `raid_type` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `document` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `case_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `raid_plainings`
--

CREATE TABLE `raid_plainings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` varchar(255) DEFAULT NULL,
  `raid_type` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `document` text DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2025-05-01 05:23:03', '2025-05-01 05:23:03'),
(2, 'user', 'web', '2025-05-01 05:23:03', '2025-05-01 05:23:03'),
(4, 'tester', 'web', '2025-05-06 02:32:52', '2025-05-06 02:32:52');

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
(6, 1),
(7, 1),
(7, 2),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_departments`
--

CREATE TABLE `sub_departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(10) UNSIGNED DEFAULT NULL,
  `sub_name` varchar(255) DEFAULT NULL,
  `sub_location` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active' COMMENT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_departments`
--

INSERT INTO `sub_departments` (`id`, `department_id`, `sub_name`, `sub_location`, `status`, `created_at`, `updated_at`) VALUES
(9, 6, 'testing', 'Lahore', 'Active', '2025-07-11 05:28:21', '2025-07-11 05:28:21');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` varchar(255) DEFAULT NULL,
  `task_name` varchar(255) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `expiry_date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `task_location` varchar(255) DEFAULT NULL,
  `task_description` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `account_type` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `auto_id` varchar(255) DEFAULT NULL,
  `user_img` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `designation` varchar(225) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_phone` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `department_id` int(20) UNSIGNED DEFAULT NULL,
  `sub_department` varchar(255) DEFAULT NULL,
  `user_location` varchar(255) DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `status` varchar(225) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `last_name`, `account_type`, `address`, `contact_number`, `country`, `province`, `city`, `auto_id`, `user_img`, `user_name`, `designation`, `user_email`, `user_phone`, `company_id`, `department_id`, `sub_department`, `user_location`, `user_address`, `detail`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'admin', 'admin@gmail.com', NULL, '$2y$12$Nhkr9EFaSoV8PF2Vt1Ii.eCs/ZXwelefw.wg4DIfflospu5UuBlNW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DP-007', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-06 05:51:14', '2025-05-06 05:51:14'),
(22, 'danyal', 'danyal@gmail.com', NULL, '$2y$12$HPHOKk1VPD/0jd5lkKuwDOLyU0SPKLRSE2P.UqstIuieGqfilD1Ci', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DP-008', NULL, NULL, 'testing', NULL, '+1 (307) 624-3667', '5', 1, '4', 'uk', 'islamabad', 'abc', 'Active', NULL, '2025-05-13 06:09:08', '2025-05-13 06:09:08'),
(23, 'Asim', 'asim@gmail.com', NULL, '$2y$12$8C7ntdFh7n3oFLjDuiSpnOOy6fOetmxphuJFsMjbKreqbPLAWxAFG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DP-009', NULL, NULL, 'dev', NULL, '+1 (307) 624-3667', '8', 3, '4', 'islamabad', 'islamabad', 'abc', 'Active', NULL, '2025-05-13 06:10:10', '2025-05-13 06:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` varchar(255) DEFAULT NULL,
  `user_img` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_phone` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `sub_department` varchar(255) DEFAULT NULL,
  `user_location` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `auto_id`, `user_img`, `user_name`, `designation`, `user_email`, `user_phone`, `company_id`, `department`, `sub_department`, `user_location`, `password`, `user_address`, `detail`, `status`, `created_at`, `updated_at`) VALUES
(1, 'DP-001', 'User/220425_user_1745322371.jpg', 'tucujesumo', 'Repudiandae corrupti', 'qivivuhivo@mailinator.com', '+1 (307) 624-3667', NULL, NULL, NULL, 'Dolore libero impedi', 'eyJpdiI6IlJEZ2Q1MXZrdytDTExEbUdUZkhzbnc9PSIsInZhbHVlIjoid1BEWElhM0dmSUJPNUUrWExDdmErdz09IiwibWFjIjoiNmQ0NDcxMGJlNzdlODU1OWQyMTdmODE4NjA1NjdlYmM4MjRkYzBjNTFjYTgwYTAyMjY1NTg5NDBkMWYzZGQ4ZiIsInRhZyI6IiJ9', 'Laudantium iusto si', 'abc', 'Inactive', '2025-04-22 06:46:11', '2025-04-23 05:11:19'),
(2, 'DP-002', 'User/220425_user_1745322953.png', 'abc', 'Quaerat iusto tempor', 'kegegynu@mailinator.com', '+1 (975) 448-4374', NULL, NULL, NULL, 'Ut laboriosam in pr', 'eyJpdiI6ImJFcGo0WU4vam52bVpHUVpJaThnbmc9PSIsInZhbHVlIjoiU2FrRE1QbTRIQXV4NGJvM25zU3NWUT09IiwibWFjIjoiOWJmMzViNzRkZjUyZTI1MTlkNmY4OWQ5OGZkMGJlNzcxMjAyZGMwOTczOGVhYTRkMTY5YWM5NThlYjY2MzNjZCIsInRhZyI6IiJ9', 'Nostrud ut esse ill', 'abc', 'Active', '2025-04-22 06:55:53', '2025-04-23 04:56:24'),
(3, 'DP-003', 'User/230425_user_1745410038.jpg', 'tewarogysi', 'Quod dolore Nam mole', 'xefuwo@mailinator.com', '+1 (231) 244-3484', '1', 'Tempore odit sed at', 'Obcaecati eum delect', 'Eaque labore expedit', 'eyJpdiI6IlVjK0NrRlNPektmYmwrc3BmT1FUU0E9PSIsInZhbHVlIjoiaWN0S3N0cXhhSmJqM1ZOZGo3akxtVzdXRDJ6cXFUa0VQdVBzbFNva25Kdz0iLCJtYWMiOiJlYmRiYzgwMjQ3YjY5NGZiMWFlNjAxYTJjYzJkMzIyM2YwNTU2ZDA1OTAwOWE3ZGQ0OGMxZjQ0NjA1YzFmYjBhIiwidGFnIjoiIn0=', 'Id tempor aperiam co', 'Ut asperiores enim q', 'Active', '2025-04-23 07:07:18', '2025-04-23 07:07:18'),
(4, 'DP-004', 'User/230425_user_1745410217.png', 'masif', 'Duis sapiente reicie', 'mynu@mailinator.com', '+1 (827) 169-1314', NULL, 'At debitis qui conse', 'Libero cillum laboru', 'Omnis officiis minim', 'eyJpdiI6ImZ5aDMxSk1ZbHJ4SEJuTmhldDRuWFE9PSIsInZhbHVlIjoibDIwWko0NFErRXBGOUhqemxzVDhyUndDWEE2UmRTc0JXeTVxV1ZWWlcwdz0iLCJtYWMiOiI3YWVhZWIyZTZjMjYxZDM3ZTFjMTRhYTRmMDNmYWQ0NTRhZmE4MmNjZjRlMjA5ZjkzYjNiZjE0NDRlZDk3ZTczIiwidGFnIjoiIn0=', 'Nam ut quia facilis', 'Delectus ad volupta', 'Inactive', '2025-04-23 07:10:18', '2025-04-23 07:10:24'),
(6, 'DP-005', NULL, 'fokyp', 'Ipsa velit fugiat', 'zesedir@mailinator.com', '+1 (447) 781-8751', '2', 'Et cumque rerum elig', 'Ea et vitae sit tot', 'Ipsum et explicabo', 'eyJpdiI6Ik94b3VaOXpscWtYM3NERE1CNjRKSmc9PSIsInZhbHVlIjoiUWx1eEpZbGlYWjhUVE5JVm5MTit3V09lSDZPYVlMYXVkU3pCNTNKOXh0Yz0iLCJtYWMiOiIyYmFhMGExODc3YWMyMWE2MmY4MTgyYTUxOWY0ZTg4ZDgyOGIxMzNlM2RkMzM2MjZiMzk5NTIxMjZmMGZkMzkyIiwidGFnIjoiIn0=', 'Est maiores iste har', 'Accusamus sed aut do', 'Active', '2025-05-06 02:55:03', '2025-05-06 02:55:03'),
(8, 'DP-007', NULL, 'vumidogavi', 'Qui explicabo Repud', 'merebyf@mailinator.com', '+1 (421) 561-4796', '1', 'Libero quasi quam vo', 'Velit accusantium in', 'Facere ab aut est ev', 'eyJpdiI6ImtJb2F2Zk5nWXBIWXF2K3YzV3RWRGc9PSIsInZhbHVlIjoiNmhCYStxZ2tJK2Z4QURNWGZlZm1WQT09IiwibWFjIjoiYTY0NDE1NGNjMmMxMDgzYjlmNjczMTExMTUxODU4NDBjMTFhMWE5Mjk0M2ZmNzU5YmJjNzM4MzY4NDk2NTgyOCIsInRhZyI6IiJ9', 'Laudantium iusto si', 'kjhkhoi', 'Active', '2025-05-06 03:01:25', '2025-05-06 03:01:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_tasks`
--
ALTER TABLE `assign_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assign_tasks_department_id_foreign` (`department_id`),
  ADD KEY `assign_tasks_user_id_foreign` (`user_id`(768)),
  ADD KEY `assign_tasks_case_management_id_foreign` (`case_management_id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `case_managements`
--
ALTER TABLE `case_managements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_managements_company_id_foreign` (`company_id`),
  ADD KEY `case_managements_brand_id_foreign` (`brand_id`),
  ADD KEY `case_managements_product_id_foreign` (`product_id`);

--
-- Indexes for table `case_reports`
--
ALTER TABLE `case_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_reports_case_id_foreign` (`case_id`),
  ADD KEY `case_reports_company_id_foreign` (`company_id`),
  ADD KEY `case_reports_brand_id_foreign` (`brand_id`),
  ADD KEY `case_reports_product_id_foreign` (`product_id`),
  ADD KEY `case_reports_department_id_foreign` (`department_id`),
  ADD KEY `case_reports_sub_department_id_foreign` (`sub_department_id`),
  ADD KEY `case_reports_group_id_foreign` (`group_id`);

--
-- Indexes for table `client_reports`
--
ALTER TABLE `client_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_reports_case_id_foreign` (`case_id`),
  ADD KEY `client_reports_company_id_foreign` (`company_id`),
  ADD KEY `client_reports_brand_id_foreign` (`brand_id`),
  ADD KEY `client_reports_product_id_foreign` (`product_id`),
  ADD KEY `client_reports_department_id_foreign` (`department_id`),
  ADD KEY `client_reports_sub_department_id_foreign` (`sub_department_id`),
  ADD KEY `client_reports_group_id_foreign` (`group_id`),
  ADD KEY `client_reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `completed_destructions`
--
ALTER TABLE `completed_destructions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `completed_destructions_department_id_foreign` (`department_id`),
  ADD KEY `completed_destructions_sub_department_id_foreign` (`sub_department_id`),
  ADD KEY `completed_destructions_company_id_foreign` (`company_id`),
  ADD KEY `completed_destructions_group_id_foreign` (`group_id`),
  ADD KEY `completed_destructions_product_id_foreign` (`product_id`),
  ADD KEY `completed_destructions_brand_id_foreign` (`brand_id`),
  ADD KEY `completed_destructions_case_id_foreign` (`case_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_company_id_foreign` (`company_id`),
  ADD KEY `departments_sub_department_id_foreign` (`sub_department_id`);

--
-- Indexes for table `evidence`
--
ALTER TABLE `evidence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evidence_case_id_foreign` (`case_id`);

--
-- Indexes for table `evidence_images`
--
ALTER TABLE `evidence_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evidence_images_evidence_id_foreign` (`evidence_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_company_id_foreign` (`company_id`),
  ADD KEY `expenses_brand_id_foreign` (`brand_id`),
  ADD KEY `expenses_product_id_foreign` (`product_id`),
  ADD KEY `expenses_currency_id_foreign` (`currency_id`),
  ADD KEY `expenses_case_id_foreign` (`case_id`),
  ADD KEY `expenses_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `finance_reports`
--
ALTER TABLE `finance_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `finance_reports_company_id_foreign` (`company_id`),
  ADD KEY `finance_reports_brand_id_foreign` (`brand_id`),
  ADD KEY `finance_reports_product_id_foreign` (`product_id`),
  ADD KEY `finance_reports_department_id_foreign` (`department_id`),
  ADD KEY `finance_reports_sub_department_id_foreign` (`sub_department_id`),
  ADD KEY `finance_reports_group_id_foreign` (`group_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_department_id_foreign` (`department_id`),
  ADD KEY `groups_sub_department_id_foreign` (`sub_department_id`),
  ADD KEY `groups_company_id_foreign` (`company_id`),
  ADD KEY `groups_user_id_foreign` (`user_id`);

--
-- Indexes for table `investigations`
--
ALTER TABLE `investigations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investigations_company_id_foreign` (`company_id`),
  ADD KEY `investigations_brand_id_foreign` (`brand_id`),
  ADD KEY `investigations_product_id_foreign` (`product_id`),
  ADD KEY `investigations_case_id_foreign` (`case_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_company_id_foreign` (`company_id`),
  ADD KEY `invoices_brand_id_foreign` (`brand_id`),
  ADD KEY `invoices_product_id_foreign` (`product_id`),
  ADD KEY `invoices_currency_id_foreign` (`currency_id`),
  ADD KEY `invoices_case_id_foreign` (`case_id`),
  ADD KEY `invoices_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pending_destructions`
--
ALTER TABLE `pending_destructions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pending_destructions_department_id_foreign` (`department_id`),
  ADD KEY `pending_destructions_sub_department_id_foreign` (`sub_department_id`),
  ADD KEY `pending_destructions_company_id_foreign` (`company_id`),
  ADD KEY `pending_destructions_group_id_foreign` (`group_id`),
  ADD KEY `pending_destructions_product_id_foreign` (`product_id`),
  ADD KEY `pending_destructions_brand_id_foreign` (`brand_id`),
  ADD KEY `pending_destructions_case_id_foreign` (`case_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_company_id_foreign` (`company_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `raid_documentations`
--
ALTER TABLE `raid_documentations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `raid_documentations_department_id_foreign` (`department_id`),
  ADD KEY `raid_documentations_sub_department_id_foreign` (`sub_department_id`),
  ADD KEY `raid_documentations_group_id_foreign` (`group_id`),
  ADD KEY `raid_documentations_case_id_foreign` (`case_id`);

--
-- Indexes for table `raid_plainings`
--
ALTER TABLE `raid_plainings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `raid_plainings_department_id_foreign` (`department_id`),
  ADD KEY `raid_plainings_sub_department_id_foreign` (`sub_department_id`),
  ADD KEY `raid_plainings_company_id_foreign` (`company_id`),
  ADD KEY `raid_plainings_group_id_foreign` (`group_id`),
  ADD KEY `raid_plainings_product_id_foreign` (`product_id`),
  ADD KEY `raid_plainings_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sub_departments`
--
ALTER TABLE `sub_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_department_id_foreign` (`department_id`),
  ADD KEY `tasks_sub_department_id_foreign` (`sub_department_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_tasks`
--
ALTER TABLE `assign_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `case_managements`
--
ALTER TABLE `case_managements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `case_reports`
--
ALTER TABLE `case_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client_reports`
--
ALTER TABLE `client_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `completed_destructions`
--
ALTER TABLE `completed_destructions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `evidence`
--
ALTER TABLE `evidence`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `evidence_images`
--
ALTER TABLE `evidence_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finance_reports`
--
ALTER TABLE `finance_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `investigations`
--
ALTER TABLE `investigations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `pending_destructions`
--
ALTER TABLE `pending_destructions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `raid_documentations`
--
ALTER TABLE `raid_documentations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `raid_plainings`
--
ALTER TABLE `raid_plainings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_departments`
--
ALTER TABLE `sub_departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_tasks`
--
ALTER TABLE `assign_tasks`
  ADD CONSTRAINT `assign_tasks_case_management_id_foreign` FOREIGN KEY (`case_management_id`) REFERENCES `case_managements` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `assign_tasks_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `case_managements`
--
ALTER TABLE `case_managements`
  ADD CONSTRAINT `case_managements_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `case_managements_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `case_managements_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `case_reports`
--
ALTER TABLE `case_reports`
  ADD CONSTRAINT `case_reports_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `case_reports_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `case_managements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `case_reports_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `case_reports_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `case_reports_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `case_reports_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `case_reports_sub_department_id_foreign` FOREIGN KEY (`sub_department_id`) REFERENCES `sub_departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client_reports`
--
ALTER TABLE `client_reports`
  ADD CONSTRAINT `client_reports_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_reports_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `case_managements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_reports_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_reports_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_reports_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_reports_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_reports_sub_department_id_foreign` FOREIGN KEY (`sub_department_id`) REFERENCES `sub_departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `completed_destructions`
--
ALTER TABLE `completed_destructions`
  ADD CONSTRAINT `completed_destructions_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `completed_destructions_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `case_managements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `completed_destructions_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `completed_destructions_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `completed_destructions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `completed_destructions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `completed_destructions_sub_department_id_foreign` FOREIGN KEY (`sub_department_id`) REFERENCES `sub_departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `departments_sub_department_id_foreign` FOREIGN KEY (`sub_department_id`) REFERENCES `sub_departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `evidence`
--
ALTER TABLE `evidence`
  ADD CONSTRAINT `evidence_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `case_managements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `evidence_images`
--
ALTER TABLE `evidence_images`
  ADD CONSTRAINT `evidence_images_evidence_id_foreign` FOREIGN KEY (`evidence_id`) REFERENCES `evidence` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `case_managements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `finance_reports`
--
ALTER TABLE `finance_reports`
  ADD CONSTRAINT `finance_reports_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `finance_reports_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `finance_reports_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `finance_reports_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `finance_reports_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `finance_reports_sub_department_id_foreign` FOREIGN KEY (`sub_department_id`) REFERENCES `sub_departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `groups_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `groups_sub_department_id_foreign` FOREIGN KEY (`sub_department_id`) REFERENCES `sub_departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `investigations`
--
ALTER TABLE `investigations`
  ADD CONSTRAINT `investigations_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `investigations_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `case_managements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `investigations_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `investigations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `case_managements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `pending_destructions`
--
ALTER TABLE `pending_destructions`
  ADD CONSTRAINT `pending_destructions_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pending_destructions_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `case_managements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pending_destructions_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pending_destructions_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pending_destructions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pending_destructions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pending_destructions_sub_department_id_foreign` FOREIGN KEY (`sub_department_id`) REFERENCES `sub_departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `raid_documentations`
--
ALTER TABLE `raid_documentations`
  ADD CONSTRAINT `raid_documentations_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `case_managements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `raid_documentations_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `raid_documentations_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `raid_documentations_sub_department_id_foreign` FOREIGN KEY (`sub_department_id`) REFERENCES `sub_departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `raid_plainings`
--
ALTER TABLE `raid_plainings`
  ADD CONSTRAINT `raid_plainings_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `raid_plainings_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `raid_plainings_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `raid_plainings_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `raid_plainings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `raid_plainings_sub_department_id_foreign` FOREIGN KEY (`sub_department_id`) REFERENCES `sub_departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_sub_department_id_foreign` FOREIGN KEY (`sub_department_id`) REFERENCES `sub_departments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
