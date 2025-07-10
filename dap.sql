-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2025 at 01:09 PM
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
(1, 'Donna Mullins', 'Brand/230425_logo_.png', 'Brand/240425_pdf_1745494739.pdf', '1972-04-19', '2007-08-04', 'Quis cumque dolorem', 'Active', '1', '2025-04-23 05:15:15', '2025-04-24 06:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `task` varchar(255) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `case_location` varchar(255) NOT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_managements`
--

INSERT INTO `case_managements` (`id`, `auto_id`, `client_id`, `case_name`, `document`, `case_type`, `target_category`, `case_priority`, `case_fee`, `task`, `flag`, `case_location`, `start_date`, `end_date`, `status`, `description`, `company_id`, `brand_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'DP-001', 'Veronica Brock', 'Willow Cabrera', 'Case/280425_document_.jpg', 'Nutella', '2', 'Medium', 'Yeo Gallegos', 'Laudantium delectus', 'fkag', 'Sint veniam dolore', '2020-06-29', '1987-01-20', 'Pending Approval', 'Sit tempora iste no', 1, 1, 2, '2025-04-28 05:39:57', '2025-04-28 06:03:14'),
(5, 'DP-002', 'Amos Garrett', 'Mia Shelton', 'Case/280425_document_.jpg', '2', '3', 'Low', 'Kelsie Byers', 'Eaque ea qui dolorum', 'Et vel eum totam ver', 'Et maiores aut offic', '2009-01-03', '1982-03-21', 'Approved', 'Error dolores adipis', 1, 1, 2, '2025-04-28 06:04:19', '2025-04-28 06:04:19'),
(7, 'DP-006', 'DP-006-client', 'Simon Sears', 'Case/280425_document_.jpg', '3', '1', 'Medium', 'Yolanda Hanson', 'Sint blanditiis nost', 'Deserunt dignissimos', 'Sit aut qui minus c', '1989-06-25', '1972-06-05', 'Approved', 'Aute dolore voluptas', 1, 1, 4, '2025-04-28 07:17:45', '2025-04-28 07:17:45');

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
(1, 'Sanford Lane Trading', 'Le Stanley Trading', 'hoqi@mailinator.com', '03743768', 'eyJpdiI6Im1YdktjOExCTEZ1SlFqemVUOGMyanc9PSIsInZhbHVlIjoiUWhLbU53dWlvbXc1T1QyTWZLbjNMYkR2eURON3hNWnpMWlh1cHJUN3FsYz0iLCJtYWMiOiIyOGY5YWVhMWVlY2JkNDNhZjk4YTg4YzQ2MDdiNjNiOGVjZmRiNDZjM2QwMDIzNDI3ODE3NjAwZjdlNzZjMDFhIiwidGFnIjoiIn0=', '2001-08-15', '2005-06-18', 'Company/230425_logo_.jpg', 'Company/230425_pdf_1745403249.jpg', 'Dolorum neque except', 'Active', '2025-04-23 05:14:09', '2025-04-23 05:14:09');

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
(1, 'Petra Reed', 'Christopher Bond', 'Kimberly Stark', 'Active', 1, 4, '2025-04-29 06:12:54', '2025-04-29 06:16:57'),
(2, NULL, NULL, NULL, 'Active', NULL, NULL, '2025-04-29 06:36:54', '2025-04-29 06:36:54');

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
-- Table structure for table `investigations`
--

CREATE TABLE `investigations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `case_type` varchar(255) NOT NULL,
  `case_name` varchar(255) NOT NULL,
  `current_status` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `assign_case` varchar(255) NOT NULL,
  `task_start_date` varchar(255) NOT NULL,
  `task_deadline` varchar(255) NOT NULL,
  `investigation_description` varchar(255) NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `case_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(31, '2025_04_29_093858_create_departments_table', 7);

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
  `product_detail` varchar(255) DEFAULT NULL,
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
(2, 'Kareem Bowman', '1', 'Product/240425_logo_.png', '1979-03-20', '1982-08-23', '1995-09-05', 'Voluptas commodi ips', 'Active', 1, 1, '2025-04-24 05:56:47', '2025-04-24 05:56:47'),
(4, 'Elliott Cabrera', 'Nutella', 'Product/240425_logo_.webp', '2005-03-23', '1977-06-21', '2004-08-03', 'Et reprehenderit re', 'Active', 1, 1, '2025-04-24 06:58:13', '2025-04-24 06:58:13');

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
  `sub_name` varchar(255) DEFAULT NULL,
  `sub_location` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active' COMMENT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_departments`
--

INSERT INTO `sub_departments` (`id`, `sub_name`, `sub_location`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Ezekiel Mitchell', 'Portia Nixon', 'Active', '2025-04-29 06:07:57', '2025-04-29 06:07:57'),
(4, 'Cherokee Carr', 'Lillith Avila', 'Active', '2025-04-29 06:08:01', '2025-04-29 06:08:01');

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
  `last_name` varchar(255) DEFAULT NULL,
  `account_type` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `last_name`, `account_type`, `address`, `contact_number`, `country`, `province`, `city`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$tAEMMlSLkHxBx0mHA0JQgOWvLlXwPeQvUMuNTca70gLVVHoV.ppsi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-22 06:45:50', '2025-04-22 06:45:50');

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
(4, 'DP-004', 'User/230425_user_1745410217.png', 'masif', 'Duis sapiente reicie', 'mynu@mailinator.com', '+1 (827) 169-1314', NULL, 'At debitis qui conse', 'Libero cillum laboru', 'Omnis officiis minim', 'eyJpdiI6ImZ5aDMxSk1ZbHJ4SEJuTmhldDRuWFE9PSIsInZhbHVlIjoibDIwWko0NFErRXBGOUhqemxzVDhyUndDWEE2UmRTc0JXeTVxV1ZWWlcwdz0iLCJtYWMiOiI3YWVhZWIyZTZjMjYxZDM3ZTFjMTRhYTRmMDNmYWQ0NTRhZmE4MmNjZjRlMjA5ZjkzYjNiZjE0NDRlZDk3ZTczIiwidGFnIjoiIn0=', 'Nam ut quia facilis', 'Delectus ad volupta', 'Inactive', '2025-04-23 07:10:18', '2025-04-23 07:10:24');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_company_id_foreign` (`company_id`),
  ADD KEY `departments_sub_department_id_foreign` (`sub_department_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_company_id_foreign` (`company_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

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
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `case_managements`
--
ALTER TABLE `case_managements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investigations`
--
ALTER TABLE `investigations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_departments`
--
ALTER TABLE `sub_departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `case_managements`
--
ALTER TABLE `case_managements`
  ADD CONSTRAINT `case_managements_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `case_managements_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `case_managements_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `departments_sub_department_id_foreign` FOREIGN KEY (`sub_department_id`) REFERENCES `sub_departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `investigations`
--
ALTER TABLE `investigations`
  ADD CONSTRAINT `investigations_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `investigations_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `case_managements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `investigations_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `investigations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
