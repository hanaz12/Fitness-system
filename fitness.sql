-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2024 at 03:51 PM
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
-- Database: `fitness`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_moderator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `status` enum('active','blocked') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_moderator_id`, `first_name`, `last_name`, `user_name`, `email`, `phone`, `address`, `password`, `salary`, `status`, `created_at`, `updated_at`) VALUES
(5, 2, 'Hana', 'Shaker', 'hanaz', 'hanashaker2004@gmail.com', '01282911237', 'cairo', '$2y$12$fTU984.S8zwGLdY0tf7X8.gp4Djys5J7t7MVR4PsQcz92NbhmJt26', 8000.00, 'active', NULL, NULL),
(6, 2, 'malak', 'shaker', 'malak', 'malak@gmail.com', '01282911237', 'cairo', '123456', 4000.00, 'blocked', NULL, NULL),
(8, 2, 'Yara', 'Shaker', 'yara', 'yarashaker15@gmail.com', '01002309017', 'cairo', '$2y$12$gynea9XKpxvKB5MrnGZpdebgj7s.73nTT8H3JWUkUcybGDr0/Ylja', 9000.00, 'blocked', NULL, NULL),
(9, 2, 'gehan', 'ouf', 'gehan', 'gehanouf79@gmail.com', '01228153370', 'cairo', '$2y$12$DcPy1.BY.VDiO1M5NZj.oeu53Pe7SuAHGbUtodt5Avx7vKR3T5oqq', 9000.00, 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_moderators`
--

CREATE TABLE `admin_moderators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_moderators`
--

INSERT INTO `admin_moderators` (`id`, `first_name`, `last_name`, `user_name`, `email`, `phone`, `address`, `password`, `created_at`, `updated_at`) VALUES
(2, 'Hanaa', 'Shaker', 'hanaz', 'hanashaker2004@gmail.com', '01282911237', 'cairo', '$2y$12$5heUOxBDalYHB67rWMjykef4FX6cphcWcPkx8BQZZEQDUQjBrYRsC', '2024-12-16 12:43:51', '2024-12-21 19:48:42');

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
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `status` enum('active','blocked') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`id`, `admin_id`, `first_name`, `last_name`, `user_name`, `email`, `phone`, `address`, `password`, `salary`, `status`, `created_at`, `updated_at`) VALUES
(4, 5, 'Hana', 'Shaker', 'hanaz', 'hanashaker@gmail.com', '01212103697', 'cairo', '123456', 5000.00, 'blocked', '2024-12-06 17:02:09', '2024-12-23 00:55:18'),
(5, 5, 'yosr', 'wael', 'yosrCoach', 'yosr@gmail.com', '01233663', 'cairo', '123456', 8000.00, 'blocked', '2024-12-08 16:23:44', '2024-12-23 19:11:12'),
(6, 5, 'menna', 'salman', 'menna', 'menna@gmail.com', '0123356', 'cairo', '123456', 7000.00, 'active', '2024-12-09 20:06:11', '2024-12-09 20:06:11'),
(10, 5, 'Hana', 'Shaker', 'hanazz', 'hanashaker200@gmail.com', '01282911237', 'cairo', '$2y$12$R9TVXPyjfE93pwbrvmrxd.C2E6b9Ikgwus02Z8To3rm7gnirQmCIy', 7000.00, 'active', '2024-12-12 10:59:17', '2024-12-12 11:00:03'),
(11, 5, 'Hana', 'Shaker', 'hanon', 'hanashaker20048@gmail.com', '01282911237', 'cairo', '$2y$12$uvxkbTMkDdG7bbKewXC1meViZ17lDszu4ysADopE9V.CSMmboBXkS', 9000.00, 'active', '2024-12-12 11:01:07', '2024-12-12 17:36:09'),
(12, 5, 'Hanaa', 'Shaker', 'hanat', 'hanashaker2004@gmail.com', '01282911237', 'cairo', '$2y$12$DVop6L6z/g4wRdy6Np1U3ea9eBGu.AiHgXMYVKES5u8McLZaLGyuu', 10000.00, 'active', '2024-12-12 17:36:53', '2024-12-21 19:42:36'),
(13, 5, 'Hager', 'Taher', 'hager', 'hagertaher257@gmail.com', '01096514357', 'cairo', '$2y$12$jNPo6ohPiz4qaw.U.95X7ewlRO9vZPIFHsARqmBm9Dptqub13jGH2', 8000.00, 'active', '2024-12-21 23:34:31', '2024-12-21 23:34:31');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_06_085013_admin_moderators', 1),
(5, '2024_12_06_085117_admins', 1),
(6, '2024_12_06_085250_packages', 1),
(7, '2024_12_06_085547_coaches', 1),
(8, '2024_12_06_085636_plans', 1),
(9, '2024_12_06_085724_trainees', 1),
(10, '2024_12_06_085948_notifications', 1),
(11, '2024_12_06_090347_payments', 1),
(12, '2024_12_06_111111_sessions', 2),
(13, '2024_12_06_153005_add_password_to_trainees_table', 3),
(14, '2024_12_10_113202_add_coach_id_to_packages_table', 4),
(15, '2024_12_10_113630_add_goal_to_trainees_table', 4),
(16, '2024_12_18_225702_add_status_to_admins_table', 5),
(17, '2024_12_19_171550_add_trainee_id_to_plans_table', 6),
(18, '2024_12_19_195828_create_trainee_package_plan_view', 7),
(19, '2024_12_21_001412_add_status_to_packages_table', 8),
(20, '2024_12_22_003144_add_status_to_coaches_table', 9),
(21, '2024_12_23_030633_add_status_to_trainees', 10);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sender_type` enum('Admin','Coach','AdminModerator','Trainee') DEFAULT NULL,
  `receiver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `receiver_type` enum('Admin','Coach','AdminModerator','Trainee') DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read') NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `sender_id`, `sender_type`, `receiver_id`, `receiver_type`, `message`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 'Coach', 1, 'Trainee', 'Don’t forget your training session tomorrow at 10 AM.', 'read', '2024-12-12 19:14:17', '2024-12-12 19:14:17'),
(3, 3, 'AdminModerator', 1, 'Trainee', 'Your account has been updated successfully.', 'read', '2024-12-12 19:14:17', '2024-12-12 19:14:17'),
(4, 1, 'Admin', 1, 'Trainee', 'We have a new training package available. Check it out!', 'read', '2024-12-12 19:14:17', '2024-12-12 19:14:17'),
(5, 2, 'Coach', 1, 'Trainee', 'Great job on completing your training session today!', 'read', '2024-12-12 19:14:17', '2024-12-12 19:14:17'),
(8, 1, 'Admin', 1, 'Trainee', 'Welcome to the platform! Your subscription starts today.', 'read', '2024-12-12 19:32:34', '2024-12-12 19:32:34'),
(9, 1, 'Trainee', 4, 'Coach', 'The trainee has updated their medical history.', 'read', '2024-12-15 20:03:47', '2024-12-15 20:03:47'),
(10, 4, 'Trainee', 4, 'Trainee', 'Welcome! You have successfully registered. You can now navigate and choose your suitable package.', 'unread', '2024-12-15 20:36:52', '2024-12-15 20:36:52'),
(11, 4, 'Trainee', 1, 'Admin', 'A new trainee has just registered.', 'read', '2024-12-15 20:36:52', '2024-12-15 20:36:52'),
(12, 4, 'Trainee', 5, 'Admin', 'A new trainee has just registered.', 'read', '2024-12-15 20:36:52', '2024-12-15 20:36:52'),
(13, 5, 'Trainee', 5, 'Trainee', 'Welcome! You have successfully registered. You can now navigate and choose your suitable package.', 'read', '2024-12-15 20:39:31', '2024-12-15 20:39:31'),
(14, 5, 'Trainee', 1, 'Admin', 'A new trainee has just registered.', 'read', '2024-12-15 20:39:31', '2024-12-15 20:39:31'),
(15, 5, 'Trainee', 5, 'Admin', 'A new trainee has just registered.', 'read', '2024-12-15 20:39:31', '2024-12-15 20:39:31'),
(16, 5, 'Trainee', 5, 'Trainee', 'You have successfully unsubscribed from the package.', 'read', '2024-12-15 21:07:41', '2024-12-15 21:07:41'),
(17, 5, 'Trainee', 1, 'Admin', 'A trainee has unsubscribed from a package.', 'read', '2024-12-15 21:07:41', '2024-12-15 21:07:41'),
(18, 5, 'Trainee', 5, 'Admin', 'A trainee has unsubscribed from a package.', 'read', '2024-12-15 21:07:41', '2024-12-15 21:07:41'),
(19, 5, 'Trainee', 4, 'Coach', 'A trainee has unsubscribed from your package. Please update the plan accordingly. Trainee Name: Hana Shaker (ID: 5)', 'read', '2024-12-15 21:07:41', '2024-12-15 21:07:41'),
(20, 5, 'Trainee', 5, 'Trainee', 'You have successfully subscribed to the package.', 'read', '2024-12-15 21:10:13', '2024-12-15 21:10:13'),
(21, 5, 'Trainee', 1, 'Admin', 'A new trainee has just subscribed to a package.', 'unread', '2024-12-15 21:10:13', '2024-12-15 21:10:13'),
(22, 5, 'Trainee', 5, 'Admin', 'A new trainee has just subscribed to a package.', 'read', '2024-12-15 21:10:13', '2024-12-15 21:10:13'),
(23, 5, 'Trainee', 5, 'Trainee', 'You have successfully subscribed to the package.', 'read', '2024-12-15 21:10:55', '2024-12-15 21:10:55'),
(24, 5, 'Trainee', 1, 'Admin', 'A new trainee has just subscribed to a package.', 'unread', '2024-12-15 21:10:55', '2024-12-15 21:10:55'),
(25, 5, 'Trainee', 5, 'Admin', 'A new trainee has just subscribed to a package.', 'read', '2024-12-15 21:10:55', '2024-12-15 21:10:55'),
(26, 3, 'Trainee', 3, 'Trainee', 'You have successfully unsubscribed from the package.', 'unread', '2024-12-15 21:13:29', '2024-12-15 21:13:29'),
(27, 3, 'Trainee', 1, 'Admin', 'A trainee has unsubscribed from a package.', 'unread', '2024-12-15 21:13:30', '2024-12-15 21:13:30'),
(28, 3, 'Trainee', 5, 'Admin', 'A trainee has unsubscribed from a package.', 'read', '2024-12-15 21:13:30', '2024-12-15 21:13:30'),
(29, 3, 'Trainee', 4, 'Coach', 'A trainee has unsubscribed from your package. Please update the plan accordingly. Trainee Name: Hager Taher (ID: 3)', 'read', '2024-12-15 21:13:30', '2024-12-15 21:13:30'),
(30, 3, 'Trainee', 3, 'Trainee', 'You have successfully subscribed to the package.', 'unread', '2024-12-15 21:13:38', '2024-12-15 21:13:38'),
(31, 3, 'Trainee', 1, 'Admin', 'A new trainee has just subscribed to a package.', 'unread', '2024-12-15 21:13:38', '2024-12-15 21:13:38'),
(32, 3, 'Trainee', 5, 'Admin', 'A new trainee has just subscribed to a package.', 'read', '2024-12-15 21:13:38', '2024-12-15 21:13:38'),
(33, 3, 'Trainee', 4, 'Coach', 'A new trainee has subscribed to your package. Please assign a plan to them. Trainee Name: Hager Taher (ID: 3)', 'read', '2024-12-15 21:13:38', '2024-12-15 21:13:38'),
(34, 6, 'Trainee', 6, 'Trainee', 'Welcome! You have successfully registered. You can now navigate and choose your suitable package.', 'read', '2024-12-15 21:41:13', '2024-12-15 21:41:13'),
(35, 6, 'Trainee', 1, 'Admin', 'A new trainee has just registered.', 'unread', '2024-12-15 21:41:13', '2024-12-15 21:41:13'),
(36, 6, 'Trainee', 5, 'Admin', 'A new trainee has just registered.', 'read', '2024-12-15 21:41:13', '2024-12-15 21:41:13'),
(37, 7, 'Trainee', 7, 'Trainee', 'Welcome! You have successfully registered. You can now navigate and choose your suitable package.', 'read', '2024-12-16 18:24:45', '2024-12-16 18:24:45'),
(38, 7, 'Trainee', 5, 'Admin', 'A new trainee has just registered.', 'read', '2024-12-16 18:24:45', '2024-12-16 18:24:45'),
(39, 7, 'Trainee', 7, 'Trainee', 'You have successfully subscribed to the package.', 'read', '2024-12-16 21:42:33', '2024-12-16 21:42:33'),
(40, 7, 'Trainee', 5, 'Admin', 'A new trainee has just subscribed to a package.', 'read', '2024-12-16 21:42:33', '2024-12-16 21:42:33'),
(41, 7, 'Trainee', 7, 'Trainee', 'You have successfully unsubscribed from the package.', 'read', '2024-12-16 21:43:40', '2024-12-16 21:43:40'),
(42, 7, 'Trainee', 5, 'Admin', 'A trainee has unsubscribed from a package.', 'read', '2024-12-16 21:43:40', '2024-12-16 21:43:40'),
(43, NULL, 'Admin', 3, 'Trainee', 'A new package named test2 has been added. Check it out!', 'unread', '2024-12-16 22:17:07', '2024-12-16 22:17:07'),
(44, NULL, 'Admin', 6, 'Trainee', 'A new package named test2 has been added. Check it out!', 'read', '2024-12-16 22:17:07', '2024-12-16 22:17:07'),
(45, NULL, 'Admin', 7, 'Trainee', 'A new package named test2 has been added. Check it out!', 'read', '2024-12-16 22:17:07', '2024-12-16 22:17:07'),
(46, 7, 'Trainee', 7, 'Trainee', 'You have successfully subscribed to the package.', 'read', '2024-12-17 12:48:49', '2024-12-17 12:48:49'),
(47, 7, 'Trainee', 5, 'Admin', 'A new trainee has just subscribed to a package.', 'read', '2024-12-17 12:48:49', '2024-12-17 12:48:49'),
(49, NULL, NULL, 7, 'Trainee', 'Hello yara, you have been assigned a new plan: plan b.', 'read', '2024-12-17 19:56:57', '2024-12-17 19:56:57'),
(50, NULL, NULL, 7, 'Trainee', 'Hello yara, you have been assigned a new plan: .', 'read', '2024-12-17 20:14:26', '2024-12-17 20:14:26'),
(51, 7, 'Trainee', 7, 'Trainee', 'You have successfully unsubscribed from the package.', 'read', '2024-12-17 21:33:28', '2024-12-17 21:33:28'),
(52, 7, 'Trainee', 5, 'Admin', 'A trainee has unsubscribed from a package.', 'read', '2024-12-17 21:33:28', '2024-12-17 21:33:28'),
(53, 7, 'Trainee', 12, 'Coach', 'A trainee has unsubscribed from your package. Please update the plan accordingly. Trainee Name: yara shaker (ID: 7)', 'read', '2024-12-17 21:33:28', '2024-12-17 21:33:28'),
(54, 7, 'Trainee', 7, 'Trainee', 'You have successfully subscribed to the package.', 'read', '2024-12-17 21:33:41', '2024-12-17 21:33:41'),
(55, 7, 'Trainee', 5, 'Admin', 'A new trainee has just subscribed to a package.', 'read', '2024-12-17 21:33:41', '2024-12-17 21:33:41'),
(56, 7, 'Trainee', 12, 'Coach', 'A new trainee has subscribed to your package. Please assign a plan to them. Trainee Name: yara shaker (ID: 7)', 'read', '2024-12-17 21:33:41', '2024-12-17 21:33:41'),
(57, 7, 'Trainee', 7, 'Trainee', 'You have successfully subscribed to the package.', 'read', '2024-12-17 21:36:09', '2024-12-17 21:36:09'),
(58, 7, 'Trainee', 5, 'Admin', 'A new trainee has just subscribed to a package.', 'read', '2024-12-17 21:36:09', '2024-12-17 21:36:09'),
(59, 7, 'Trainee', 12, 'Coach', 'A new trainee has subscribed to your package. Please assign a plan to them. Trainee Name: yara shaker (ID: 7)', 'read', '2024-12-17 21:36:09', '2024-12-17 21:36:09'),
(60, 7, 'Trainee', 7, 'Trainee', 'You have successfully subscribed to the package.', 'read', '2024-12-17 21:40:17', '2024-12-17 21:40:17'),
(61, 7, 'Trainee', 5, 'Admin', 'A new trainee has just subscribed to a package.', 'read', '2024-12-17 21:40:17', '2024-12-17 21:40:17'),
(62, 7, 'Trainee', 12, 'Coach', 'A new trainee has subscribed to your package. Please assign a plan to them. Trainee Name: yara shaker (ID: 7)', 'read', '2024-12-17 21:40:17', '2024-12-17 21:40:17'),
(63, 7, 'Trainee', 7, 'Trainee', 'You have successfully subscribed to the package.', 'read', '2024-12-17 21:40:35', '2024-12-17 21:40:35'),
(64, 7, 'Trainee', 5, 'Admin', 'A new trainee has just subscribed to a package.', 'read', '2024-12-17 21:40:35', '2024-12-17 21:40:35'),
(65, 7, 'Trainee', 12, 'Coach', 'A new trainee has subscribed to your package. Please assign a plan to them. Trainee Name: yara shaker (ID: 7)', 'read', '2024-12-17 21:40:35', '2024-12-17 21:40:35'),
(66, 7, 'Trainee', 7, 'Trainee', 'You have successfully subscribed to the package.', 'read', '2024-12-17 21:42:30', '2024-12-17 21:42:30'),
(67, 7, 'Trainee', 5, 'Admin', 'A new trainee has just subscribed to a package.', 'read', '2024-12-17 21:42:30', '2024-12-17 21:42:30'),
(68, 7, 'Trainee', 12, 'Coach', 'A new trainee has subscribed to your package. Please assign a plan to them. Trainee Name: yara shaker (ID: 7)', 'read', '2024-12-17 21:42:30', '2024-12-17 21:42:30'),
(69, 7, 'Trainee', 7, 'Trainee', 'You have successfully subscribed to the package.', 'read', '2024-12-17 21:44:31', '2024-12-17 21:44:31'),
(70, 7, 'Trainee', 5, 'Admin', 'A new trainee has just subscribed to a package.', 'read', '2024-12-17 21:44:31', '2024-12-17 21:44:31'),
(71, 7, 'Trainee', 12, 'Coach', 'A new trainee has subscribed to your package. Please assign a plan to them. Trainee Name: yara shaker (ID: 7)', 'read', '2024-12-17 21:44:31', '2024-12-17 21:44:31'),
(72, 7, 'Trainee', 7, 'Trainee', 'You have successfully subscribed to the package.', 'read', '2024-12-17 21:49:03', '2024-12-17 21:49:03'),
(73, 7, 'Trainee', 5, 'Admin', 'A new trainee has just subscribed to a package.', 'read', '2024-12-17 21:49:03', '2024-12-17 21:49:03'),
(74, 7, 'Trainee', 12, 'Coach', 'A new trainee has subscribed to your package. Please assign a plan to them. Trainee Name: yara shaker (ID: 7)', 'read', '2024-12-17 21:49:03', '2024-12-17 21:49:03'),
(75, 7, 'Trainee', 7, 'Trainee', 'You have successfully subscribed to the package.', 'read', '2024-12-17 21:55:58', '2024-12-17 21:55:58'),
(76, 7, 'Trainee', 5, 'Admin', 'A new trainee has just subscribed to a package.', 'read', '2024-12-17 21:55:58', '2024-12-17 21:55:58'),
(77, 7, 'Trainee', 12, 'Coach', 'A new trainee has subscribed to your package. Please assign a plan to them. Trainee Name: yara shaker (ID: 7)', 'read', '2024-12-17 21:55:58', '2024-12-17 21:55:58'),
(78, 7, 'Trainee', 7, 'Trainee', 'You have successfully unsubscribed from the package.', 'read', '2024-12-17 21:59:55', '2024-12-17 21:59:55'),
(79, 7, 'Trainee', 5, 'Admin', 'A trainee has unsubscribed from a package.', 'read', '2024-12-17 21:59:55', '2024-12-17 21:59:55'),
(80, 7, 'Trainee', 12, 'Coach', 'A trainee has unsubscribed from your package. Please update the plan accordingly. Trainee Name: yara shaker (ID: 7)', 'read', '2024-12-17 21:59:55', '2024-12-17 21:59:55'),
(81, NULL, NULL, 6, 'Trainee', 'Hello Hana, you have been assigned a new plan: .', 'read', '2024-12-19 15:26:51', '2024-12-19 15:26:51'),
(82, NULL, NULL, 6, 'Trainee', 'Hello Hana, your plan has been updated: .', 'read', '2024-12-19 15:31:55', '2024-12-19 15:31:55'),
(83, NULL, NULL, 6, 'Trainee', 'Hello Hana, your plan has been updated: plan B.', 'read', '2024-12-19 15:51:09', '2024-12-19 15:51:09'),
(84, NULL, NULL, 6, 'Trainee', 'Hello Hana, your plan has been updated: plan B.', 'read', '2024-12-19 15:53:19', '2024-12-19 15:53:19'),
(85, NULL, NULL, 6, 'Trainee', 'Hello Hana, your plan has been updated: plan B.', 'read', '2024-12-19 15:53:36', '2024-12-19 15:53:36'),
(86, NULL, NULL, 6, 'Trainee', 'Hello Hana, your plan has been updated: plan B.', 'read', '2024-12-19 15:53:44', '2024-12-19 15:53:44'),
(87, NULL, NULL, 7, 'Trainee', 'Hello yara, your plan has been updated: yara.', 'read', '2024-12-19 15:54:01', '2024-12-19 15:54:01'),
(88, NULL, NULL, 7, 'Trainee', 'Hello yara, your plan has been updated: yara.', 'read', '2024-12-19 15:54:14', '2024-12-19 15:54:14'),
(89, NULL, NULL, 6, 'Trainee', 'Hello Hana, your plan has been updated: plan B.', 'read', '2024-12-19 17:53:24', '2024-12-19 17:53:24'),
(90, NULL, NULL, 6, 'Trainee', 'Hello Hana, your plan has been updated: plan B.', 'read', '2024-12-19 20:16:06', '2024-12-19 20:16:06'),
(91, NULL, NULL, 6, 'Trainee', 'Hello Hana, your plan has been updated: plan B.', 'unread', '2024-12-19 21:17:28', '2024-12-19 21:17:28'),
(92, NULL, NULL, 6, 'Trainee', 'Hello Hana, your plan has been updated: plan B.', 'unread', '2024-12-21 19:46:05', '2024-12-21 19:46:05'),
(93, 7, 'Trainee', 7, 'Trainee', 'You have successfully unsubscribed from the package.', 'read', '2024-12-21 20:18:24', '2024-12-21 20:18:24'),
(95, 7, 'Trainee', 6, 'Admin', 'A trainee has unsubscribed from a package.', 'unread', '2024-12-21 20:18:24', '2024-12-21 20:18:24'),
(96, 7, 'Trainee', 8, 'Admin', 'A trainee has unsubscribed from a package.', 'unread', '2024-12-21 20:18:24', '2024-12-21 20:18:24'),
(97, 7, 'Trainee', 12, 'Coach', 'A trainee has unsubscribed from your package. Please update the plan accordingly. Trainee Name: yara shaker (ID: 7)', 'read', '2024-12-21 20:18:24', '2024-12-21 20:18:24'),
(98, NULL, 'Admin', 6, 'Trainee', 'A new package named Ultimate Fitness Plan has been added. Check it out!', 'unread', '2024-12-22 00:05:19', '2024-12-22 00:05:19'),
(99, NULL, 'Admin', 7, 'Trainee', 'A new package named Ultimate Fitness Plan has been added. Check it out!', 'read', '2024-12-22 00:05:19', '2024-12-22 00:05:19'),
(100, NULL, 'Admin', 6, 'Trainee', '🚨 New Package Update! 🚨\n\nWe regret to inform you that the package \'Premium Fitness Package\' is currently unavailable. Stay tuned for updates on its availability!', 'unread', '2024-12-22 00:31:14', '2024-12-22 00:31:14'),
(101, NULL, 'Admin', 7, 'Trainee', '🚨 New Package Update! 🚨\n\nWe regret to inform you that the package \'Premium Fitness Package\' is currently unavailable. Stay tuned for updates on its availability!', 'read', '2024-12-22 00:31:14', '2024-12-22 00:31:14'),
(102, NULL, 'Admin', 6, 'Trainee', '🚨 New Package Update! 🚨\n\nWe regret to inform you that the package \'random\' is currently unavailable. Stay tuned for updates on its availability!', 'unread', '2024-12-22 00:53:29', '2024-12-22 00:53:29'),
(103, NULL, 'Admin', 7, 'Trainee', '🚨 New Package Update! 🚨\n\nWe regret to inform you that the package \'random\' is currently unavailable. Stay tuned for updates on its availability!', 'read', '2024-12-22 00:53:29', '2024-12-22 00:53:29'),
(104, NULL, 'Admin', 12, 'Coach', '🎉 Congratulations! You are now the responsible coach for the package \'hana\'. 🎉\n\nThis package is now available, and you can start working on it.', 'read', '2024-12-22 01:15:48', '2024-12-22 01:15:48'),
(105, NULL, 'Admin', 12, 'Coach', '🚨 Important Update! 🚨\n\nYou have been assigned as the responsible coach for the package \'hana3\', but it is currently unavailable.', 'read', '2024-12-22 01:19:20', '2024-12-22 01:19:20'),
(106, NULL, 'Admin', 6, 'Trainee', '🚨 Package Update! 🚨\n\nThe package \'hana3\' is currently unavailable. Stay tuned for updates.', 'unread', '2024-12-22 01:19:20', '2024-12-22 01:19:20'),
(107, NULL, 'Admin', 7, 'Trainee', '🚨 Package Update! 🚨\n\nThe package \'hana3\' is currently unavailable. Stay tuned for updates.', 'read', '2024-12-22 01:19:20', '2024-12-22 01:19:20'),
(108, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer the responsible coach for the package \'Basic Plan\'.', 'read', '2024-12-22 19:28:22', '2024-12-22 19:28:22'),
(109, NULL, 'Admin', 12, 'Coach', '🎉 You are now the responsible coach for the package \'Basic Plan\'.', 'read', '2024-12-22 19:28:22', '2024-12-22 19:28:22'),
(110, NULL, 'Admin', 11, 'Coach', '🚨 You are no longer the responsible coach for the package \'Basic Plan\'.', 'unread', '2024-12-22 19:29:02', '2024-12-22 19:29:02'),
(111, NULL, 'Admin', 11, 'Coach', '🎉 You are now the responsible coach for the package \'Basic Plan\'.', 'unread', '2024-12-22 19:29:02', '2024-12-22 19:29:02'),
(112, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer the responsible coach for the package \'Basic Plan\'.', 'read', '2024-12-22 19:37:59', '2024-12-22 19:37:59'),
(113, NULL, 'Admin', 12, 'Coach', '🎉 You are now the responsible coach for the package \'Basic Plan\'.', 'read', '2024-12-22 19:37:59', '2024-12-22 19:37:59'),
(114, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer the responsible coach for the package \'Standard plan\'.', 'read', '2024-12-22 19:38:20', '2024-12-22 19:38:20'),
(115, NULL, 'Admin', 12, 'Coach', '🎉 You are now the responsible coach for the package \'Standard plan\'.', 'read', '2024-12-22 19:38:20', '2024-12-22 19:38:20'),
(116, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer the responsible coach for the package \'Standard plan\'.', 'read', '2024-12-22 19:46:31', '2024-12-22 19:46:31'),
(117, NULL, 'Admin', 13, 'Coach', '🎉 You are now the responsible coach for the package \'Standard plan\'.', 'read', '2024-12-22 19:46:31', '2024-12-22 19:46:31'),
(118, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer the responsible coach for the package \'Basic Plan\'.', 'read', '2024-12-22 19:48:38', '2024-12-22 19:48:38'),
(119, NULL, 'Admin', 12, 'Coach', '🎉 You are now the responsible coach for the package \'Basic Plan\'.', 'read', '2024-12-22 19:48:38', '2024-12-22 19:48:38'),
(120, NULL, 'Admin', 6, 'Trainee', '🎉 The package \'Basic Plan\' is now available!', 'unread', '2024-12-22 19:52:46', '2024-12-22 19:52:46'),
(121, NULL, 'Admin', 7, 'Trainee', '🎉 The package \'Basic Plan\' is now available!', 'read', '2024-12-22 19:52:46', '2024-12-22 19:52:46'),
(122, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer the responsible coach for the package \'Basic Plan\'.', 'read', '2024-12-22 19:52:46', '2024-12-22 19:52:46'),
(123, NULL, 'Admin', 12, 'Coach', '🎉 You are now the responsible coach for the package \'Basic Plan\'.', 'read', '2024-12-22 19:52:46', '2024-12-22 19:52:46'),
(124, NULL, 'Admin', 6, 'Trainee', '🎉 The package \'Basic Plan\' is now available!', 'unread', '2024-12-22 19:53:00', '2024-12-22 19:53:00'),
(125, NULL, 'Admin', 7, 'Trainee', '🎉 The package \'Basic Plan\' is now available!', 'read', '2024-12-22 19:53:00', '2024-12-22 19:53:00'),
(126, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer the responsible coach for the package \'Basic Plan\'.', 'read', '2024-12-22 19:53:00', '2024-12-22 19:53:00'),
(127, NULL, 'Admin', 12, 'Coach', '🎉 You are now the responsible coach for the package \'Basic Plan\'.', 'read', '2024-12-22 19:53:00', '2024-12-22 19:53:00'),
(128, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer the responsible coach for the package \'Basic Plan\'.', 'read', '2024-12-22 19:56:15', '2024-12-22 19:56:15'),
(129, NULL, 'Admin', 12, 'Coach', '🎉 You are now the responsible coach for the package \'Basic Plan\'.', 'read', '2024-12-22 19:56:15', '2024-12-22 19:56:15'),
(130, NULL, 'Admin', 6, 'Trainee', '🚨 The package \'premium\' is now unavailable.', 'unread', '2024-12-22 19:56:31', '2024-12-22 19:56:31'),
(131, NULL, 'Admin', 7, 'Trainee', '🚨 The package \'premium\' is now unavailable.', 'read', '2024-12-22 19:56:31', '2024-12-22 19:56:31'),
(132, NULL, 'Admin', 5, 'Coach', '🎉 You are now the responsible coach for the package \'premium\'.', 'unread', '2024-12-22 19:56:31', '2024-12-22 19:56:31'),
(133, NULL, 'Admin', 6, 'Trainee', '🚨 The package \'hana\' is now unavailable.', 'unread', '2024-12-22 19:56:51', '2024-12-22 19:56:51'),
(134, NULL, 'Admin', 7, 'Trainee', '🚨 The package \'hana\' is now unavailable.', 'read', '2024-12-22 19:56:51', '2024-12-22 19:56:51'),
(135, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer the responsible coach for the package \'hana\'.', 'read', '2024-12-22 19:56:51', '2024-12-22 19:56:51'),
(136, NULL, 'Admin', 12, 'Coach', '🎉 You are now the responsible coach for the package \'hana\'.', 'read', '2024-12-22 19:56:51', '2024-12-22 19:56:51'),
(137, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer the responsible coach for the package \'Basic Plan\'.', 'read', '2024-12-22 21:51:38', '2024-12-22 21:51:38'),
(138, NULL, 'Admin', 12, 'Coach', '🎉 You are now the responsible coach for the package \'Basic Plan\'.', 'read', '2024-12-22 21:51:38', '2024-12-22 21:51:38'),
(139, NULL, 'Admin', 6, 'Trainee', '🚨 The package \'Premium Fitness Package\' is now unavailable.', 'unread', '2024-12-22 21:55:05', '2024-12-22 21:55:05'),
(140, NULL, 'Admin', 7, 'Trainee', '🚨 The package \'Premium Fitness Package\' is now unavailable.', 'read', '2024-12-22 21:55:05', '2024-12-22 21:55:05'),
(141, NULL, 'Admin', 5, 'Coach', '🎉 You are now the responsible coach for the package \'Premium Fitness Package\'.', 'unread', '2024-12-22 21:55:05', '2024-12-22 21:55:05'),
(142, NULL, 'Admin', 6, 'Trainee', '🎉 The package \'Premium Fitness Package\' is now available!', 'unread', '2024-12-22 21:55:25', '2024-12-22 21:55:25'),
(143, NULL, 'Admin', 7, 'Trainee', '🎉 The package \'Premium Fitness Package\' is now available!', 'read', '2024-12-22 21:55:25', '2024-12-22 21:55:25'),
(144, NULL, 'Admin', 5, 'Coach', '🚨 You are no longer the responsible coach for the package \'Premium Fitness Package\'.', 'unread', '2024-12-22 21:55:25', '2024-12-22 21:55:25'),
(145, NULL, 'Admin', 5, 'Coach', '🎉 You are now the responsible coach for the package \'Premium Fitness Package\'.', 'unread', '2024-12-22 21:55:25', '2024-12-22 21:55:25'),
(146, NULL, 'Admin', 6, 'Trainee', '🎉 The package \'hana3\' is now available!', 'unread', '2024-12-22 21:56:31', '2024-12-22 21:56:31'),
(147, NULL, 'Admin', 7, 'Trainee', '🎉 The package \'hana3\' is now available!', 'read', '2024-12-22 21:56:31', '2024-12-22 21:56:31'),
(148, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer the responsible coach for the package \'hana3\'.', 'read', '2024-12-22 21:56:31', '2024-12-22 21:56:31'),
(149, NULL, 'Admin', 12, 'Coach', '🎉 You are now the responsible coach for the package \'hana3\'.', 'read', '2024-12-22 21:56:31', '2024-12-22 21:56:31'),
(150, NULL, 'Admin', 6, 'Trainee', '🚨 The package \'hana3\' is now unavailable.', 'unread', '2024-12-22 21:57:28', '2024-12-22 21:57:28'),
(151, NULL, 'Admin', 7, 'Trainee', '🚨 The package \'hana3\' is now unavailable.', 'read', '2024-12-22 21:57:29', '2024-12-22 21:57:29'),
(152, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer the responsible coach for the package \'hana3\'.', 'read', '2024-12-22 21:57:29', '2024-12-22 21:57:29'),
(153, NULL, 'Admin', 12, 'Coach', '🎉 You are now the responsible coach for the package \'hana3\'.', 'read', '2024-12-22 21:57:29', '2024-12-22 21:57:29'),
(154, NULL, 'Admin', 6, 'Trainee', '🎉 The package \'hana3\' is now available!', 'unread', '2024-12-22 21:57:56', '2024-12-22 21:57:56'),
(155, NULL, 'Admin', 7, 'Trainee', '🎉 The package \'hana3\' is now available!', 'read', '2024-12-22 21:57:56', '2024-12-22 21:57:56'),
(156, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer the responsible coach for the package \'hana3\'.', 'read', '2024-12-22 21:57:56', '2024-12-22 21:57:56'),
(157, NULL, 'Admin', 12, 'Coach', '🎉 You are now the responsible coach for the package \'hana3\'.', 'read', '2024-12-22 21:57:56', '2024-12-22 21:57:56'),
(158, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer the responsible coach for the package \'Basic Plan\'.', 'read', '2024-12-22 21:59:43', '2024-12-22 21:59:43'),
(159, NULL, 'Admin', 12, 'Coach', '🎉 You are now the responsible coach for the package \'Basic Plan\'.', 'read', '2024-12-22 21:59:43', '2024-12-22 21:59:43'),
(160, NULL, 'Admin', 6, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'unread', '2024-12-22 22:27:01', '2024-12-22 22:27:01'),
(161, NULL, 'Admin', 6, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'unread', '2024-12-22 22:30:13', '2024-12-22 22:30:13'),
(162, NULL, 'Admin', 7, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'read', '2024-12-22 22:30:13', '2024-12-22 22:30:13'),
(163, NULL, 'Admin', 6, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'unread', '2024-12-22 22:32:47', '2024-12-22 22:32:47'),
(164, NULL, 'Admin', 7, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'read', '2024-12-22 22:32:48', '2024-12-22 22:32:48'),
(165, NULL, 'Admin', 6, 'Trainee', '🚨 The package \'hana3\' is now unavailable.', 'unread', '2024-12-22 22:33:21', '2024-12-22 22:33:21'),
(166, NULL, 'Admin', 7, 'Trainee', '🚨 The package \'hana3\' is now unavailable.', 'read', '2024-12-22 22:33:21', '2024-12-22 22:33:21'),
(167, NULL, 'Admin', 12, 'Coach', '🚨 The package \'hana3\' is now unavailable.', 'read', '2024-12-22 22:33:21', '2024-12-22 22:33:21'),
(168, NULL, 'Admin', 6, 'Trainee', '🎉 The package \'hana3\' is now available!', 'unread', '2024-12-22 22:33:38', '2024-12-22 22:33:38'),
(169, NULL, 'Admin', 7, 'Trainee', '🎉 The package \'hana3\' is now available!', 'read', '2024-12-22 22:33:38', '2024-12-22 22:33:38'),
(170, NULL, 'Admin', 12, 'Coach', '🎉 You are now responsible for the available package \'hana3\'.', 'read', '2024-12-22 22:33:38', '2024-12-22 22:33:38'),
(171, NULL, 'Admin', 6, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'unread', '2024-12-22 22:58:13', '2024-12-22 22:58:13'),
(172, NULL, 'Admin', 7, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'read', '2024-12-22 22:58:13', '2024-12-22 22:58:13'),
(173, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer responsible for the package \'Basic Plan\'.', 'read', '2024-12-22 22:58:13', '2024-12-22 22:58:13'),
(174, NULL, 'Admin', 13, 'Coach', '🎉 You are now responsible for the package \'Basic Plan\'.', 'unread', '2024-12-22 22:58:13', '2024-12-22 22:58:13'),
(175, NULL, 'Admin', 6, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'unread', '2024-12-22 22:58:44', '2024-12-22 22:58:44'),
(176, NULL, 'Admin', 7, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'read', '2024-12-22 22:58:44', '2024-12-22 22:58:44'),
(177, NULL, 'Admin', 13, 'Coach', '🚨 You are no longer responsible for the package \'Basic Plan\'.', 'unread', '2024-12-22 22:58:44', '2024-12-22 22:58:44'),
(178, NULL, 'Admin', 12, 'Coach', '🎉 You are now responsible for the package \'Basic Plan\'.', 'read', '2024-12-22 22:58:44', '2024-12-22 22:58:44'),
(179, NULL, 'Admin', 6, 'Trainee', '🎉 The package \'Basic Fitness Plan first version\' is now available!', 'unread', '2024-12-22 23:01:41', '2024-12-22 23:01:41'),
(180, NULL, 'Admin', 7, 'Trainee', '🎉 The package \'Basic Fitness Plan first version\' is now available!', 'read', '2024-12-22 23:01:41', '2024-12-22 23:01:41'),
(181, NULL, 'Admin', 6, 'Trainee', '📢 The package \'Basic Fitness Plan first version\' has been updated with new details!', 'unread', '2024-12-22 23:01:41', '2024-12-22 23:01:41'),
(182, NULL, 'Admin', 7, 'Trainee', '📢 The package \'Basic Fitness Plan first version\' has been updated with new details!', 'read', '2024-12-22 23:01:41', '2024-12-22 23:01:41'),
(183, NULL, 'Admin', 5, 'Coach', '🎉 You are now responsible for the package \'Basic Fitness Plan first version\'.', 'unread', '2024-12-22 23:01:41', '2024-12-22 23:01:41'),
(184, NULL, 'Admin', 6, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'unread', '2024-12-22 23:05:54', '2024-12-22 23:05:54'),
(185, NULL, 'Admin', 7, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'read', '2024-12-22 23:05:54', '2024-12-22 23:05:54'),
(186, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer responsible for the package \'Basic Plan\'.', 'read', '2024-12-22 23:05:54', '2024-12-22 23:05:54'),
(187, NULL, 'Admin', 13, 'Coach', '🎉 You are now responsible for the package \'Basic Plan\'.', 'unread', '2024-12-22 23:05:54', '2024-12-22 23:05:54'),
(188, NULL, 'Admin', 6, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'unread', '2024-12-22 23:08:36', '2024-12-22 23:08:36'),
(189, NULL, 'Admin', 7, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'read', '2024-12-22 23:08:36', '2024-12-22 23:08:36'),
(190, NULL, 'Admin', 13, 'Coach', '🚨 You are no longer responsible for the package \'Basic Plan\'.', 'unread', '2024-12-22 23:08:36', '2024-12-22 23:08:36'),
(191, NULL, 'Admin', 12, 'Coach', '🎉 You are now responsible for the package \'Basic Plan\'.', 'read', '2024-12-22 23:08:36', '2024-12-22 23:08:36'),
(192, NULL, 'Admin', 6, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'unread', '2024-12-22 23:09:43', '2024-12-22 23:09:43'),
(193, NULL, 'Admin', 7, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'read', '2024-12-22 23:09:43', '2024-12-22 23:09:43'),
(194, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer responsible for the package \'Basic Plan\'.', 'read', '2024-12-22 23:09:43', '2024-12-22 23:09:43'),
(195, NULL, 'Admin', 13, 'Coach', '🎉 You are now responsible for the package \'Basic Plan\'.', 'unread', '2024-12-22 23:09:43', '2024-12-22 23:09:43'),
(196, NULL, 'Admin', 6, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'unread', '2024-12-22 23:10:20', '2024-12-22 23:10:20'),
(197, NULL, 'Admin', 7, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'read', '2024-12-22 23:10:20', '2024-12-22 23:10:20'),
(198, NULL, 'Admin', 13, 'Coach', '🚨 You are no longer responsible for the package \'Basic Plan\'.', 'unread', '2024-12-22 23:10:20', '2024-12-22 23:10:20'),
(199, NULL, 'Admin', 12, 'Coach', '🎉 You are now responsible for the package \'Basic Plan\'.', 'read', '2024-12-22 23:10:20', '2024-12-22 23:10:20'),
(200, NULL, 'Admin', 6, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'unread', '2024-12-23 00:02:02', '2024-12-23 00:02:02'),
(201, NULL, 'Admin', 7, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'read', '2024-12-23 00:02:02', '2024-12-23 00:02:02'),
(202, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer responsible for the package \'Basic Plan\'.', 'read', '2024-12-23 00:02:02', '2024-12-23 00:02:02'),
(203, NULL, 'Admin', 12, 'Coach', '🎉 You are now responsible for the package \'Basic Plan\'.', 'read', '2024-12-23 00:02:02', '2024-12-23 00:02:02'),
(204, NULL, 'Admin', 6, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'unread', '2024-12-23 00:02:03', '2024-12-23 00:02:03'),
(205, NULL, 'Admin', 7, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'read', '2024-12-23 00:02:03', '2024-12-23 00:02:03'),
(206, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer responsible for the package \'Basic Plan\'.', 'read', '2024-12-23 00:02:03', '2024-12-23 00:02:03'),
(207, NULL, 'Admin', 12, 'Coach', '🎉 You are now responsible for the package \'Basic Plan\'.', 'read', '2024-12-23 00:02:03', '2024-12-23 00:02:03'),
(208, NULL, 'Admin', 12, 'Coach', '🎉 Congratulations! You are now the responsible coach for the package \'dija\'. 🎉\n\nThis package is now available, and you can start working on it.', 'read', '2024-12-23 00:14:56', '2024-12-23 00:14:56'),
(209, NULL, 'Admin', 6, 'Trainee', '🎉 New Package Available! 🎉\n\nThe package \'dija\' is now available! Check it out and get started.', 'unread', '2024-12-23 00:14:56', '2024-12-23 00:14:56'),
(210, NULL, 'Admin', 7, 'Trainee', '🎉 New Package Available! 🎉\n\nThe package \'dija\' is now available! Check it out and get started.', 'read', '2024-12-23 00:14:56', '2024-12-23 00:14:56'),
(211, NULL, NULL, 7, 'Trainee', 'Hello yara, you have been assigned a new plan: yara\'s plan.', 'read', '2024-12-23 00:29:28', '2024-12-23 00:29:28'),
(212, 8, 'Trainee', 8, 'Trainee', 'Welcome! You have successfully registered. You can now navigate and choose your suitable package.', 'read', '2024-12-23 01:21:15', '2024-12-23 01:21:15'),
(213, 8, 'Trainee', 5, 'Admin', 'A new trainee has just registered.', 'read', '2024-12-23 01:21:15', '2024-12-23 01:21:15'),
(214, 8, 'Trainee', 6, 'Admin', 'A new trainee has just registered.', 'unread', '2024-12-23 01:21:15', '2024-12-23 01:21:15'),
(215, 8, 'Trainee', 8, 'Admin', 'A new trainee has just registered.', 'unread', '2024-12-23 01:21:15', '2024-12-23 01:21:15'),
(216, 8, 'Trainee', 9, 'Admin', 'A new trainee has just registered.', 'unread', '2024-12-23 01:21:15', '2024-12-23 01:21:15'),
(217, 7, 'Trainee', 12, 'Coach', 'The trainee has updated their medical history.', 'read', '2024-12-23 01:25:33', '2024-12-23 01:25:33'),
(218, NULL, NULL, 7, 'Trainee', 'Hello yara, your plan has been updated: yara\'s plan.', 'read', '2024-12-23 11:37:04', '2024-12-23 11:37:04'),
(219, NULL, 'Admin', 12, 'Coach', '🎉 Congratulations! You are now the responsible coach for the package \'test11\'. 🎉\n\nThis package is now available, and you can start working on it.', 'read', '2024-12-23 14:55:11', '2024-12-23 14:55:11'),
(220, NULL, 'Admin', 6, 'Trainee', '🎉 New Package Available! 🎉\n\nThe package \'test11\' is now available! Check it out and get started.', 'unread', '2024-12-23 14:55:12', '2024-12-23 14:55:12'),
(221, NULL, 'Admin', 7, 'Trainee', '🎉 New Package Available! 🎉\n\nThe package \'test11\' is now available! Check it out and get started.', 'read', '2024-12-23 14:55:12', '2024-12-23 14:55:12'),
(222, NULL, 'Admin', 8, 'Trainee', '🎉 New Package Available! 🎉\n\nThe package \'test11\' is now available! Check it out and get started.', 'read', '2024-12-23 14:55:12', '2024-12-23 14:55:12'),
(223, NULL, 'Admin', 6, 'Trainee', '🚨 The package \'hana3\' is now unavailable.', 'unread', '2024-12-23 15:15:30', '2024-12-23 15:15:30'),
(224, NULL, 'Admin', 7, 'Trainee', '🚨 The package \'hana3\' is now unavailable.', 'read', '2024-12-23 15:15:30', '2024-12-23 15:15:30'),
(225, NULL, 'Admin', 8, 'Trainee', '🚨 The package \'hana3\' is now unavailable.', 'read', '2024-12-23 15:15:30', '2024-12-23 15:15:30'),
(226, NULL, 'Admin', 6, 'Trainee', '📢 The package \'hana3\' has been updated with new details!', 'unread', '2024-12-23 15:15:30', '2024-12-23 15:15:30'),
(227, NULL, 'Admin', 7, 'Trainee', '📢 The package \'hana3\' has been updated with new details!', 'read', '2024-12-23 15:15:30', '2024-12-23 15:15:30'),
(228, NULL, 'Admin', 8, 'Trainee', '📢 The package \'hana3\' has been updated with new details!', 'read', '2024-12-23 15:15:30', '2024-12-23 15:15:30'),
(229, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer responsible for the package \'hana3\'.', 'read', '2024-12-23 15:15:30', '2024-12-23 15:15:30'),
(230, NULL, 'Admin', 12, 'Coach', '🎉 You are now responsible for the package \'hana3\'.', 'read', '2024-12-23 15:15:30', '2024-12-23 15:15:30'),
(231, NULL, 'Admin', 6, 'Trainee', '🚨 The package \'dija\' is now unavailable.', 'unread', '2024-12-23 15:15:39', '2024-12-23 15:15:39'),
(232, NULL, 'Admin', 7, 'Trainee', '🚨 The package \'dija\' is now unavailable.', 'read', '2024-12-23 15:15:39', '2024-12-23 15:15:39'),
(233, NULL, 'Admin', 8, 'Trainee', '🚨 The package \'dija\' is now unavailable.', 'read', '2024-12-23 15:15:39', '2024-12-23 15:15:39'),
(234, NULL, 'Admin', 6, 'Trainee', '📢 The package \'dija\' has been updated with new details!', 'unread', '2024-12-23 15:15:39', '2024-12-23 15:15:39'),
(235, NULL, 'Admin', 7, 'Trainee', '📢 The package \'dija\' has been updated with new details!', 'read', '2024-12-23 15:15:39', '2024-12-23 15:15:39'),
(236, NULL, 'Admin', 8, 'Trainee', '📢 The package \'dija\' has been updated with new details!', 'read', '2024-12-23 15:15:39', '2024-12-23 15:15:39'),
(237, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer responsible for the package \'dija\'.', 'read', '2024-12-23 15:15:39', '2024-12-23 15:15:39'),
(238, NULL, 'Admin', 12, 'Coach', '🎉 You are now responsible for the package \'dija\'.', 'read', '2024-12-23 15:15:39', '2024-12-23 15:15:39'),
(239, NULL, 'Admin', 6, 'Trainee', '🚨 The package \'test11\' is now unavailable.', 'unread', '2024-12-23 15:15:49', '2024-12-23 15:15:49'),
(240, NULL, 'Admin', 7, 'Trainee', '🚨 The package \'test11\' is now unavailable.', 'read', '2024-12-23 15:15:49', '2024-12-23 15:15:49'),
(241, NULL, 'Admin', 8, 'Trainee', '🚨 The package \'test11\' is now unavailable.', 'read', '2024-12-23 15:15:49', '2024-12-23 15:15:49'),
(242, NULL, 'Admin', 6, 'Trainee', '📢 The package \'test11\' has been updated with new details!', 'unread', '2024-12-23 15:15:49', '2024-12-23 15:15:49'),
(243, NULL, 'Admin', 7, 'Trainee', '📢 The package \'test11\' has been updated with new details!', 'read', '2024-12-23 15:15:49', '2024-12-23 15:15:49'),
(244, NULL, 'Admin', 8, 'Trainee', '📢 The package \'test11\' has been updated with new details!', 'read', '2024-12-23 15:15:49', '2024-12-23 15:15:49'),
(245, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer responsible for the package \'test11\'.', 'read', '2024-12-23 15:15:49', '2024-12-23 15:15:49'),
(246, NULL, 'Admin', 12, 'Coach', '🎉 You are now responsible for the package \'test11\'.', 'read', '2024-12-23 15:15:49', '2024-12-23 15:15:49'),
(247, NULL, 'Admin', 6, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'unread', '2024-12-23 22:46:26', '2024-12-23 22:46:26'),
(248, NULL, 'Admin', 7, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'read', '2024-12-23 22:46:26', '2024-12-23 22:46:26'),
(249, NULL, 'Admin', 8, 'Trainee', '📢 The package \'Basic Plan\' has been updated with new details!', 'read', '2024-12-23 22:46:26', '2024-12-23 22:46:26'),
(250, NULL, 'Admin', 12, 'Coach', '🚨 You are no longer responsible for the package \'Basic Plan\'.', 'read', '2024-12-23 22:46:26', '2024-12-23 22:46:26'),
(251, NULL, 'Admin', 12, 'Coach', '🎉 You are now responsible for the package \'Basic Plan\'.', 'read', '2024-12-23 22:46:26', '2024-12-23 22:46:26'),
(252, NULL, 'Admin', 6, 'Trainee', '📢 The package \'premium\' has been updated with new details!', 'unread', '2024-12-23 22:46:41', '2024-12-23 22:46:41'),
(253, NULL, 'Admin', 7, 'Trainee', '📢 The package \'premium\' has been updated with new details!', 'read', '2024-12-23 22:46:41', '2024-12-23 22:46:41'),
(254, NULL, 'Admin', 8, 'Trainee', '📢 The package \'premium\' has been updated with new details!', 'read', '2024-12-23 22:46:41', '2024-12-23 22:46:41'),
(255, NULL, 'Admin', 6, 'Trainee', '📢 The package \'Ultimate Fitness Plan\' has been updated with new details!', 'unread', '2024-12-23 22:47:04', '2024-12-23 22:47:04'),
(256, NULL, 'Admin', 7, 'Trainee', '📢 The package \'Ultimate Fitness Plan\' has been updated with new details!', 'read', '2024-12-23 22:47:04', '2024-12-23 22:47:04'),
(257, NULL, 'Admin', 8, 'Trainee', '📢 The package \'Ultimate Fitness Plan\' has been updated with new details!', 'read', '2024-12-23 22:47:04', '2024-12-23 22:47:04'),
(258, NULL, 'Admin', 12, 'Coach', '🎉 You are now responsible for the package \'Ultimate Fitness Plan\'.', 'read', '2024-12-23 22:47:04', '2024-12-23 22:47:04'),
(259, NULL, NULL, 7, 'Trainee', 'Hello yara, your plan has been updated: yara\'s plan.', 'read', '2024-12-23 22:50:05', '2024-12-23 22:50:05'),
(260, NULL, NULL, 7, 'Trainee', 'Hello yara, your plan has been updated: yara\'s plan.', 'read', '2024-12-23 22:53:10', '2024-12-23 22:53:10'),
(261, 8, 'Trainee', 8, 'Trainee', 'You have successfully unsubscribed from the package.', 'read', '2024-12-23 23:36:56', '2024-12-23 23:36:56'),
(262, 8, 'Trainee', 5, 'Admin', 'A trainee has unsubscribed from a package.', 'read', '2024-12-23 23:36:56', '2024-12-23 23:36:56'),
(263, 8, 'Trainee', 6, 'Admin', 'A trainee has unsubscribed from a package.', 'unread', '2024-12-23 23:36:56', '2024-12-23 23:36:56'),
(264, 8, 'Trainee', 8, 'Admin', 'A trainee has unsubscribed from a package.', 'unread', '2024-12-23 23:36:56', '2024-12-23 23:36:56'),
(265, 8, 'Trainee', 9, 'Admin', 'A trainee has unsubscribed from a package.', 'unread', '2024-12-23 23:36:56', '2024-12-23 23:36:56'),
(266, 8, 'Trainee', 12, 'Coach', 'A trainee has unsubscribed from your package. Please update the plan accordingly. Trainee Name: gehan ouf (ID: 8)', 'read', '2024-12-23 23:36:56', '2024-12-23 23:36:56'),
(267, 8, 'Trainee', 8, 'Trainee', 'You have successfully subscribed to the package.', 'read', '2024-12-24 00:52:23', '2024-12-24 00:52:23'),
(268, 8, 'Trainee', 5, 'Admin', 'A new trainee has just subscribed to a package.', 'read', '2024-12-24 00:52:23', '2024-12-24 00:52:23'),
(269, 8, 'Trainee', 6, 'Admin', 'A new trainee has just subscribed to a package.', 'unread', '2024-12-24 00:52:23', '2024-12-24 00:52:23'),
(270, 8, 'Trainee', 8, 'Admin', 'A new trainee has just subscribed to a package.', 'unread', '2024-12-24 00:52:23', '2024-12-24 00:52:23'),
(271, 8, 'Trainee', 9, 'Admin', 'A new trainee has just subscribed to a package.', 'unread', '2024-12-24 00:52:23', '2024-12-24 00:52:23'),
(272, 8, 'Trainee', 12, 'Coach', 'A new trainee has subscribed to your package.', 'read', '2024-12-24 00:52:23', '2024-12-24 00:52:23'),
(273, NULL, NULL, 8, 'Trainee', 'Hello gehan, you have been assigned a new plan: gehan.', 'read', '2024-12-24 01:21:43', '2024-12-24 01:21:43'),
(274, 8, 'Trainee', 8, 'Trainee', 'You have successfully unsubscribed from the package.', 'read', '2024-12-24 01:22:10', '2024-12-24 01:22:10'),
(275, 8, 'Trainee', 5, 'Admin', 'A trainee has unsubscribed from a package.', 'read', '2024-12-24 01:22:10', '2024-12-24 01:22:10'),
(276, 8, 'Trainee', 6, 'Admin', 'A trainee has unsubscribed from a package.', 'unread', '2024-12-24 01:22:10', '2024-12-24 01:22:10'),
(277, 8, 'Trainee', 8, 'Admin', 'A trainee has unsubscribed from a package.', 'unread', '2024-12-24 01:22:10', '2024-12-24 01:22:10'),
(278, 8, 'Trainee', 9, 'Admin', 'A trainee has unsubscribed from a package.', 'unread', '2024-12-24 01:22:10', '2024-12-24 01:22:10'),
(279, 8, 'Trainee', 12, 'Coach', 'A trainee has unsubscribed from your package. Please update the plan accordingly. Trainee Name: gehan ouf (ID: 8)', 'read', '2024-12-24 01:22:10', '2024-12-24 01:22:10'),
(280, NULL, NULL, 7, 'Trainee', 'Hello yara, your plan has been updated: yara\'s plan.', 'unread', '2024-12-24 02:18:08', '2024-12-24 02:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `duration` int(11) NOT NULL,
  `description` text NOT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `coach_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('available','unavailable') NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `admin_id`, `name`, `price`, `duration`, `description`, `discount`, `created_at`, `updated_at`, `coach_id`, `status`) VALUES
(1, 5, 'Basic Plan', 800.00, 1, 'The Basic Plan offers access to all the essential gym equipment, group fitness classes, and personalized workout plans. It is ideal for those who are just starting their fitness journey and want to build a strong foundation. With this plan, you get access to a variety of classes like yoga, cardio, and strength training random random', 10.00, '2024-12-07 16:16:00', '2024-12-22 23:10:20', 12, 'available'),
(2, 5, 'Standard plan', 1000.00, 9, 'The Standard Plan includes everything in the Basic Plan, plus additional benefits such as personal trainer sessions and a wellness tracker to monitor your progress. You will receive expert guidance to help you achieve your fitness goals faster. This plan also gives you access to special fitness challenges and events', NULL, '2024-12-07 16:24:29', '2024-12-22 22:49:32', 12, 'available'),
(5, 5, 'premium', 600.00, 3, 'The Premium Plan provides the most comprehensive fitness experience. In addition to everything included in the Standard Plan, you will get access to exclusive classes with top instructors, a personalized nutrition plan to complement your fitness regimen, and priority customer support. This plan is designed for those who want the ultimate fitness experience with maximum results', 15.00, '2024-12-07 16:52:29', '2024-12-23 22:46:41', NULL, 'unavailable'),
(6, 5, 'Basic Fitness Plan first version', 150.00, 1, 'A basic fitness plan to help you get started with your fitness journey.', 5.00, '2024-12-15 22:09:40', '2024-12-22 23:01:41', 5, 'available'),
(12, 5, 'Ultimate Fitness Plan', 600.00, 6, 'This package includes unlimited access to all gym facilities, group classes, and personal training sessions', 20.00, '2024-12-22 00:16:47', '2024-12-23 22:47:04', 12, 'available'),
(13, 5, 'Premium Fitness Package', 800.00, 9, '\'A premium fitness package that includes all our top features.\'', 5.00, '2024-12-22 00:31:14', '2024-12-22 22:51:54', 12, 'available'),
(14, 5, 'random', 500.00, 1, 'test', 10.00, '2024-12-22 00:53:29', '2024-12-22 22:50:56', 12, 'available'),
(15, 5, 'hana', 100.00, 1, 'hana', 1.00, '2024-12-22 01:15:48', '2024-12-22 19:56:51', 12, 'unavailable'),
(16, 5, 'hana3', 150.00, 2, 'tttttttttttttt', NULL, '2024-12-22 01:19:20', '2024-12-23 15:15:30', 12, 'unavailable'),
(17, 5, 'dija', 100.00, 5, 'yyyyyyyyyyyyyyy', 10.00, '2024-12-23 00:14:56', '2024-12-23 15:15:39', 12, 'unavailable'),
(18, 5, 'test11', 500.00, 1, 'test randomly', 10.00, '2024-12-23 14:55:11', '2024-12-23 15:15:49', 12, 'unavailable');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trainee_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `method` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `getwayID` varchar(255) NOT NULL,
  `getwayName` varchar(255) NOT NULL,
  `payNumber` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `trainee_id`, `amount`, `method`, `status`, `getwayID`, `getwayName`, `payNumber`, `payment_date`, `created_at`, `updated_at`) VALUES
(1, 7, 400.00, 'paypal', 'completed', 'paypal_gateway_id', 'PayPal', '$2y$12$aHIFVC.GAv/mjBAVtYmEjeSPNXW1qMDD.KXjREhggjWmh/QpFXfEm', '2024-12-17', '2024-12-17 21:51:09', '2024-12-17 21:51:09'),
(2, 7, 400.00, 'credit_card', 'completed', 'creditcard_gateway_id', 'Credit Card', '$2y$12$ztLBV6B7npCFsIEFcKcKLutmunXb.IOys2jqi3rYd6BgFo75XhQ3q', '2024-12-17', '2024-12-17 21:56:26', '2024-12-17 21:56:26'),
(3, 7, 400.00, 'credit_card', 'completed', 'creditcard_gateway_id', 'Credit Card', '$2y$12$0.XAWXGvitvbkDc5CYTZGOR4yfD9wzfFsvRzMOVEUACRZdrlU7FXq', '2024-12-18', '2024-12-17 22:11:03', '2024-12-17 22:11:03'),
(4, 8, 800.00, 'paypal', 'completed', 'paypal_gateway_id', 'PayPal', '$2y$12$9YR6rw5LK0TEhXpVq5YFm.EhsizmURVdhQzG.2FiRelJQcHrf/9w2', '2024-12-24', '2024-12-24 00:46:28', '2024-12-24 00:46:28'),
(5, 8, 800.00, 'paypal', 'completed', 'paypal_gateway_id', 'PayPal', '$2y$12$7270KKtybsmVZN65unGuOu5o0yUEcB3tx/Vwy.6ZV/aDMbek8c8ly', '2024-12-24', '2024-12-24 00:49:41', '2024-12-24 00:49:41'),
(6, 8, 800.00, 'paypal', 'completed', 'paypal_gateway_id', 'PayPal', '$2y$12$z8Gb8.gtaddQ7gs9jfUQX.g7AAFDKqdKbOwM5jUwcP7JbXbOMolum', '2024-12-24', '2024-12-24 00:52:23', '2024-12-24 00:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coach_id` bigint(20) UNSIGNED DEFAULT NULL,
  `plan_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `trainee_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `coach_id`, `plan_name`, `description`, `created_at`, `updated_at`, `trainee_id`) VALUES
(3, 12, 'plan B', 'a fenhance your strength, endurance, and overall health. Here\'s what you can expect each day:\r\n\r\nDay 1 (Monday):\r\n\r\nMorning: 30-minute cardio session (running or cycling).\r\nAfternoon: Upper body strength training (push-ups, pull-ups, dumbbell exercises).\r\nEvening: Stretching and light yoga for recovery.\r\nDay 2 (Tuesday):\r\n\r\nMorning: 20-minute HIIT workout (burpees, jumping jacks, squats).\r\nAfternoon: Core exercises (planks, Russian twists, leg raises).\r\nEvening: Guided meditation for relaxation.', '2024-12-19 15:26:51', '2024-12-19 21:17:28', 6),
(4, 12, 'yara\'s plan', 'Welcome to the Ultimate Fitness Challenge! This 7-day program is designed to enhance your strength, endurance, and overall health. Here\'s what you can expect each day: Day 1 (Monday): Morning: 30-minute cardio session (running or cycling). Afternoon: Upper body strength training (push-ups, pull-ups, dumbbell exercises). Evening: Stretching and light yoga for recovery. Day 2 (Tuesday): Morning: 20-minute HIIT workout (burpees, jumping jacks, squats). Afternoon: Core exercises (planks, Russian twists, leg raises). Evening: Guided meditation for relaxation.randommm Welcome to the Ultimate Fitness Challenge! This 7-day program is designed to enhance your strength, endurance, and overall health. Here\'s what you can expect each day: Day 1 (Monday): Morning: 30-minute cardio session (running or cycling). Afternoon: Upper body strength training (push-ups, pull-ups, dumbbell exercises). Evening: Stretching and light yoga for recovery. Day 2 (Tuesday): Morning: 20-minute HIIT workout (burpees, jumping jacks, squats). Afternoon: Core exercises (planks, Russian twists, leg raises). Evening: Guided meditation for relaxation.randommmWelcome to the Ultimate Fitness Challenge! This 7-day program is designed to enhance your strength, endurance, and overall health. Here\'s what you can expect each day: Day 1 (Monday): Morning: 30-minute cardio session (running or cycling). Afternoon: Upper body strength training (push-ups, pull-ups, dumbbell exercises). Evening: Stretching and light yoga for recovery. Day 2 (Tuesday): Morning: 20-minute HIIT workout (burpees, jumping jacks, squats). Afternoon: Core exercises (planks, Russian twists, leg raises). Evening: Guided meditation for relaxation.randommmWelcome to the Ultimate Fitness Challeh-ups, pull-ups, dumbbell exercises). Evenin', '2024-12-23 00:29:28', '2024-12-24 02:18:08', 7);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text NOT NULL,
  `payload` text NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`, `created_at`, `updated_at`) VALUES
('KB9w1qLZhAseEWI7sVR33NepIbZo1H0SkpU8brlJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRG9aWDBvWU5VZm9hSkpIb0N1ZUo2NUhDaFhITWwwckpsbmFhMng2bCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbnBhZ2U/X3Rva2VuPURvWlgwb1lOVWZvYUpKSG9DdWVKNjVIQ2hYSE1sMHJKbG5hYTJ4NmwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1735049976, NULL, NULL),
('rS4SZFHBttbAYgCYy4hjLPFwRoprNXfewX28C2xL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVFEcVphWTByenQ0NkluZGNyd2xINVh4TkR2UXdSZXR1MDZKclc4WCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaWdudXAiO319', 1735015615, NULL, NULL),
('u9ioy2VofgYFU5K9suBJYPVXRiQpPLYrYB7Anr7W', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiOENScVlHajlWcVRDeE5yZG5QSldHSW5GeEVQbFRMZlppb2hyQXVtYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ub3RpZmljYXRpb25zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjEyO3M6OToidXNlcl9uYW1lIjtzOjU6ImhhbmF0IjtzOjk6InVzZXJfcm9sZSI7czo1OiJDb2FjaCI7czo1OiJlbWFpbCI7czoyNDoiaGFuYXNoYWtlcjIwMDRAZ21haWwuY29tIjtzOjEwOiJmaXJzdF9uYW1lIjtzOjU6IkhhbmFhIjtzOjk6Imxhc3RfbmFtZSI7czo2OiJTaGFrZXIiO30=', 1735010557, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trainees`
--

CREATE TABLE `trainees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `height` decimal(5,2) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `medical_history` text DEFAULT NULL,
  `goal` text DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('active','blocked') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainees`
--

INSERT INTO `trainees` (`id`, `package_id`, `plan_id`, `admin_id`, `first_name`, `last_name`, `user_name`, `email`, `phone`, `address`, `age`, `height`, `weight`, `medical_history`, `goal`, `gender`, `created_at`, `updated_at`, `password`, `status`) VALUES
(6, 1, 3, NULL, 'Hana', 'Shaker', 'hanaz', 'hanashaker2004@gmail.com', '01068767713', 'cairo', 20, 70.00, 50.00, 'stressed but never mind', 'increase weight', 'female', '2024-12-15 21:41:11', '2024-12-24 02:44:11', '$2y$12$n1sMNnz/22XZIkh//C3TEeEr4kzTE5A.YjkurLcG3MZHLtwMsHVKW', 'blocked'),
(7, 1, 4, NULL, 'yara', 'shaker', 'yara', 'dryarashaker2000@gmail.com', '01282911237', 'cairo', 18, 170.00, 50.00, 'stressed but never mind', 'increase weight', 'female', '2024-12-16 18:24:39', '2024-12-23 19:39:22', '$2y$12$TMhTqMsZuD4U3ojiPl8puOEPQKj8VXh8ynJFIMYkcY.ydxgduyJFW', 'active'),
(8, NULL, NULL, NULL, 'gehan', 'ouf', 'gehan', 'gehanouf79@gmail.com', '01228153370', 'cairo', 40, 170.00, 60.00, NULL, NULL, 'female', '2024-12-23 01:21:12', '2024-12-24 01:21:43', '$2y$12$5YewXekpWa8s4m2FBliKMOvvfJPfd3d3vc7FeWGu30oWMNuQnsCaS', 'active');

-- --------------------------------------------------------

--
-- Stand-in structure for view `trainee_package_plan_view`
-- (See below for the actual view)
--
CREATE TABLE `trainee_package_plan_view` (
`trainee_id` bigint(20) unsigned
,`user_name` varchar(255)
,`first_name` varchar(255)
,`last_name` varchar(255)
,`phone` varchar(255)
,`email` varchar(255)
,`medical_history` text
,`goal` text
,`gender` varchar(255)
,`height` decimal(5,2)
,`weight` decimal(5,2)
,`registration_date` timestamp
,`package_name` varchar(255)
,`plan_name` varchar(255)
,`coach_id` bigint(20) unsigned
,`status` enum('active','blocked')
);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure for view `trainee_package_plan_view`
--
DROP TABLE IF EXISTS `trainee_package_plan_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `trainee_package_plan_view`  AS SELECT `t`.`id` AS `trainee_id`, `t`.`user_name` AS `user_name`, `t`.`first_name` AS `first_name`, `t`.`last_name` AS `last_name`, `t`.`phone` AS `phone`, `t`.`email` AS `email`, `t`.`medical_history` AS `medical_history`, `t`.`goal` AS `goal`, `t`.`gender` AS `gender`, `t`.`height` AS `height`, `t`.`weight` AS `weight`, `t`.`created_at` AS `registration_date`, `p`.`name` AS `package_name`, `pl`.`plan_name` AS `plan_name`, `p`.`coach_id` AS `coach_id`, `t`.`status` AS `status` FROM ((`trainees` `t` left join `packages` `p` on(`t`.`package_id` = `p`.`id`)) left join `plans` `pl` on(`t`.`id` = `pl`.`trainee_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_user_name_unique` (`user_name`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD KEY `admins_admin_moderator_id_foreign` (`admin_moderator_id`);

--
-- Indexes for table `admin_moderators`
--
ALTER TABLE `admin_moderators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_moderators_user_name_unique` (`user_name`),
  ADD UNIQUE KEY `admin_moderators_email_unique` (`email`);

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
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coaches_user_name_unique` (`user_name`),
  ADD UNIQUE KEY `coaches_email_unique` (`email`),
  ADD KEY `coaches_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `packages_admin_id_foreign` (`admin_id`),
  ADD KEY `packages_coach_id_foreign` (`coach_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_trainee_id_foreign` (`trainee_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plans_coach_id_foreign` (`coach_id`),
  ADD KEY `plans_trainee_id_foreign` (`trainee_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainees`
--
ALTER TABLE `trainees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trainees_user_name_unique` (`user_name`),
  ADD UNIQUE KEY `trainees_email_unique` (`email`),
  ADD KEY `trainees_package_id_foreign` (`package_id`),
  ADD KEY `trainees_plan_id_foreign` (`plan_id`),
  ADD KEY `trainees_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admin_moderators`
--
ALTER TABLE `admin_moderators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trainees`
--
ALTER TABLE `trainees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_admin_moderator_id_foreign` FOREIGN KEY (`admin_moderator_id`) REFERENCES `admin_moderators` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `coaches`
--
ALTER TABLE `coaches`
  ADD CONSTRAINT `coaches_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `packages_coach_id_foreign` FOREIGN KEY (`coach_id`) REFERENCES `coaches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_trainee_id_foreign` FOREIGN KEY (`trainee_id`) REFERENCES `trainees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `plans_coach_id_foreign` FOREIGN KEY (`coach_id`) REFERENCES `coaches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `plans_trainee_id_foreign` FOREIGN KEY (`trainee_id`) REFERENCES `trainees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trainees`
--
ALTER TABLE `trainees`
  ADD CONSTRAINT `trainees_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `trainees_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `trainees_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
