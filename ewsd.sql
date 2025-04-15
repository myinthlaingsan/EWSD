-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 15, 2025 at 11:01 AM
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
-- Database: `ewsd`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `active_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `page_url` varchar(255) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `browser` varchar(255) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `view_count` int(11) DEFAULT 1,
  `last_viewed_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`active_id`, `user_id`, `page_url`, `file_name`, `browser`, `ip_address`, `view_count`, `last_viewed_at`) VALUES
(10, 3, '/ewsd/src/Admin/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-05 19:51:19'),
(11, 3, '/ewsd/src/Admin/design/role.php', 'role.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-05 19:57:24'),
(12, 3, '/ewsd/src/Admin/design/Reports.php', 'Reports.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 6, '2025-04-05 20:45:01'),
(13, 1, '/ewsd/src/Admin/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '::1', 1, '2025-04-05 20:44:42'),
(14, 8, '/ewsd/src/Coordinator/design/index.php', 'index.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 40, '2025-04-15 14:09:37'),
(15, 8, '/ewsd/src/Admin/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-05 21:40:05'),
(16, 8, '/ewsd/src/Admin/design/Reports.php', 'Reports.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-05 21:40:17'),
(17, 1, '/ewsd/src/Admin/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-06 20:18:59'),
(18, 1, '/ewsd/src/Admin/design/index.php', 'index.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 34, '2025-04-15 15:30:13'),
(19, 1, '/ewsd/src/Admin/design/role.php', 'role.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 5, '2025-04-14 22:31:11'),
(20, 1, '/ewsd/src/Coordinator/design/index.php', 'index.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-06 20:37:26'),
(21, 3, '/ewsd/src/Manager/design/index.php', 'index.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 32, '2025-04-15 14:59:13'),
(22, 3, '/ewsd/src/Manager/design/test.php', 'test.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 3, '2025-04-06 21:17:54'),
(23, 3, '/ewsd/src/Manager/design/All_Contribution.php', 'All_Contribution.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 12, '2025-04-15 15:25:07'),
(24, NULL, '/ewsd/src/Guest/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-06 21:25:14'),
(25, 9, '/ewsd/src/Guest/design/viewselected.php', 'viewselected.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 12, '2025-04-15 13:09:28'),
(26, NULL, '/ewsd/src/Guest/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-06 21:27:49'),
(27, 12, '/ewsd/src/Guest/design/viewselected.php', 'viewselected.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 6, '2025-04-06 23:10:45'),
(28, 12, '/ewsd/src/Guest/design/test.php', 'test.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 9, '2025-04-06 22:56:00'),
(29, 8, '/ewsd/src/Coordinator/design/viewarticlebyfaculty1.php', 'viewarticlebyfaculty1.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 48, '2025-04-15 14:09:53'),
(30, 8, '/ewsd/src/Coordinator/design/viewdetail.php?id=15', 'viewdetail.php?id=15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 2, '2025-04-06 22:57:26'),
(31, 8, '/ewsd/src/Coordinator/design/viewdetail.php?id=14', 'viewdetail.php?id=14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 6, '2025-04-10 14:42:08'),
(32, 8, '/ewsd/src/Coordinator/design/viewdetail.php?id=13', 'viewdetail.php?id=13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 4, '2025-04-10 14:40:54'),
(33, 8, '/ewsd/src/Coordinator/design/viewdetail.php?id=11', 'viewdetail.php?id=11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-06 22:57:55'),
(34, NULL, '/ewsd/src/Guest/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-06 23:05:46'),
(35, NULL, '/ewsd/src/Guest/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-06 23:12:31'),
(36, 9, '/ewsd/src/Coordinator/design/index.php', 'index.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-07 00:10:56'),
(37, 10, '/ewsd/src/Students/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-07 00:13:32'),
(38, 10, '/ewsd/src/Students/design/create_articles.php', 'create_articles.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-07 00:13:36'),
(39, 10, '/ewsd/src/Students/design/view_articles.php', 'view_articles.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 3, '2025-04-07 00:16:54'),
(40, 2, '/ewsd/src/Students/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 24, '2025-04-15 12:37:21'),
(41, 2, '/ewsd/src/Students/design/view_articles.php', 'view_articles.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 78, '2025-04-15 11:28:22'),
(42, 8, '/ewsd/src/Coordinator/design/viewdetail.php?id=1', 'viewdetail.php?id=1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 31, '2025-04-10 14:41:06'),
(43, 8, '/ewsd/src/Coordinator/design/viewdetail.php?id=2', 'viewdetail.php?id=2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 3, '2025-04-09 23:17:27'),
(44, 1, '/ewsd/src/Admin/design/dashboard.php?login=success', 'dashboard.php?login=success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 5, '2025-04-07 19:45:52'),
(45, 8, '/ewsd/src/Coordinator/design/Student_Lists.php', 'Student_Lists.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 5, '2025-04-10 15:12:55'),
(46, 11, '/ewsd/src/Coordinator/design/index.php', 'index.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-07 19:44:55'),
(47, 11, '/ewsd/src/Coordinator/design/Student_Lists.php', 'Student_Lists.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 2, '2025-04-07 19:45:30'),
(48, 11, '/ewsd/src/Coordinator/design/Guest_Lists.php', 'Guest_Lists.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-07 19:45:27'),
(49, 11, '/ewsd/src/Coordinator/design/viewarticlebyfaculty1.php', 'viewarticlebyfaculty1.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-07 19:45:31'),
(50, 1, '/ewsd/src/Admin/design/userlist.php', 'userlist.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 7, '2025-04-15 14:10:13'),
(51, 1, '/ewsd/src/Admin/design/setting.php', 'setting.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 19, '2025-04-15 15:28:54'),
(52, 1, '/ewsd/src/Admin/design/Reports.php', 'Reports.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 16, '2025-04-14 19:31:30'),
(53, 1, '/ewsd/src/Admin/design/profile.php', 'profile.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 42, '2025-04-15 14:26:37'),
(54, 1, '/ewsd/src/Admin/design/changepassword.php?id=1', 'changepassword.php?id=1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 4, '2025-04-14 21:53:04'),
(55, 1, '/ewsd/src/Admin/design/index.php?login=success', 'index.php?login=success', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 24, '2025-04-15 15:28:50'),
(56, 1, '/ewsd/src/Admin/design/profile.php?error=current_incorrect', 'profile.php?error=current_incorrect', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-07 21:36:49'),
(57, 1, '/ewsd/src/Admin/design/profile.php?success=1', 'profile.php?success=1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 16, '2025-04-07 21:55:31'),
(58, 8, '/ewsd/src/Coordinator/design/profile.php', 'profile.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 17, '2025-04-15 14:09:56'),
(59, 1, '/ewsd/src/Admin/design/permissions.php', 'permissions.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 3, '2025-04-14 19:29:21'),
(60, 1, '/ewsd/src/Admin/design/faculty.php', 'faculty.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 20, '2025-04-14 22:08:37'),
(61, 1, '/ewsd/src/Admin/design/eachfaculty.php?id=1', 'eachfaculty.php?id=1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 16, '2025-04-10 15:09:30'),
(62, 1, '/ewsd/src/Admin/design/eachfaculty.php?id=2', 'eachfaculty.php?id=2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-08 21:31:38'),
(63, 8, '/ewsd/src/Coordinator/design/Guest_Lists.php', 'Guest_Lists.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 4, '2025-04-10 15:12:54'),
(64, 8, '/ewsd/src/Coordinator/design/changepassword.php?id=8', 'changepassword.php?id=8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-08 22:26:17'),
(65, 3, '/ewsd/src/Manager/design/All_Reports.php', 'All_Reports.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 10, '2025-04-15 14:51:14'),
(66, 3, '/ewsd/src/Manager/design/viewdetail.php?id=11', 'viewdetail.php?id=11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 7, '2025-04-10 15:10:11'),
(67, 1, '/ewsd/src/statistics/test.php', 'test.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 6, '2025-04-15 14:27:47'),
(68, 1, '/ewsd/src/Admin/design/statistics.php', 'statistics.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 27, '2025-04-15 14:48:26'),
(69, 8, '/ewsd/src/Coordinator/design/update_article.php?id=1', 'update_article.php?id=1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 5, '2025-04-09 17:03:21'),
(70, 8, '/ewsd/src/Coordinator/design/update_article.php?id=14', 'update_article.php?id=14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 3, '2025-04-09 17:15:34'),
(71, 3, '/ewsd/src/Admin/design/statistics.php', 'statistics.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-09 21:42:15'),
(72, 3, '/ewsd/src/Admin/design/index.php', 'index.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-09 21:43:19'),
(73, 2, '/ewsd/src/Coordinator/design/viewdetail.php?id=13', 'viewdetail.php?id=13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-09 21:49:49'),
(74, 2, '/ewsd/src/Coordinator/design/viewdetail.php?id=1', 'viewdetail.php?id=1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-09 21:50:07'),
(75, 1, '/ewsd/src/Admin/design/update.php', 'update.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 2, '2025-04-09 22:20:14'),
(76, 1, '/ewsd/src/Admin/design/update.php?id=1', 'update.php?id=1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 4, '2025-04-14 21:53:07'),
(77, 2, '/ewsd/src/Students/design/create_articles.php', 'create_articles.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 14, '2025-04-15 11:28:23'),
(78, 8, '/ewsd/src/Coordinator/design/viewdetail.php?id=16', 'viewdetail.php?id=16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 60, '2025-04-10 23:03:31'),
(79, 8, '/ewsd/src/Coordinator/design/viewdetail.php?id=16?comment=error', 'viewdetail.php?id=16?comment=error', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 24, '2025-04-09 23:17:08'),
(80, 8, '/ewsd/src/Students/design/view_articles.php', 'view_articles.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 5, '2025-04-10 22:26:10'),
(81, 8, '/ewsd/src/Coordinator/design/Student_Details.php?id=2', 'Student_Details.php?id=2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-10 14:39:57'),
(82, 2, '/ewsd/src/Students/design/update_articles.php?id=16', 'update_articles.php?id=16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 2, '2025-04-10 15:14:02'),
(83, NULL, '/ewsd/src/Guest/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-10 14:44:31'),
(84, 3, '/ewsd/src/Manager/design/statistics.php', 'statistics.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 8, '2025-04-15 14:52:51'),
(85, NULL, '/ewsd/src/Guest/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-10 15:14:50'),
(86, 2, '/ewsd/src/Students/design/update_articles.php?id=17', 'update_articles.php?id=17', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 6, '2025-04-10 21:55:14'),
(87, 2, '/ewsd/src/Coordinator/design/viewdetail.php?id=16', 'viewdetail.php?id=16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-10 22:04:24'),
(88, 8, '/ewsd/src/Coordinator/design/viewdetail.php?id=', 'viewdetail.php?id=', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-10 22:42:48'),
(89, 2, '/ewsd/src/Students/design/test.php', 'test.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 7, '2025-04-14 13:39:01'),
(90, 1, '/ewsd/src/Students/design/test.php', 'test.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-14 11:49:39'),
(91, 1, '/ewsd/src/Students/design/create_articles.php', 'create_articles.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-14 11:50:34'),
(92, 1, '/ewsd/src/Admin/design/setting.php?id=1', 'setting.php?id=1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 4, '2025-04-14 13:32:51'),
(93, 2, '/ewsd/src/Admin/design/statistics.php', 'statistics.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-14 14:05:10'),
(94, 8, '/ewsd/src/Coordinator/design/viewdetail.php?id=18', 'viewdetail.php?id=18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 6, '2025-04-14 22:41:00'),
(95, 8, '/ewsd/src/Admin/design/statistics.php', 'statistics.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 5, '2025-04-14 14:36:37'),
(96, 8, '/ewsd/src/Admin/design/test.php', 'test.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-14 14:36:43'),
(97, 8, '/ewsd/src/Admin/design/test.php?year=2024', 'test.php?year=2024', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 4, '2025-04-14 14:47:37'),
(98, 8, '/ewsd/src/Admin/design/test.php?year=2025', 'test.php?year=2025', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 6, '2025-04-14 14:45:34'),
(99, 8, '/ewsd/src/Admin/design/test.php?year=2023', 'test.php?year=2023', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-14 14:45:37'),
(100, 8, '/ewsd/src/Admin/design/index.php', 'index.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-14 14:48:44'),
(101, 8, '/ewsd/src/Coordinator/design/update_article.php?id=18', 'update_article.php?id=18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 2, '2025-04-14 19:19:37'),
(102, 2, '/ewsd/src/Students/design/update_articles.php?id=18', 'update_articles.php?id=18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 3, '2025-04-14 23:34:24'),
(103, NULL, '/ewsd/src/Guest/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-14 19:28:48'),
(104, 1, '/ewsd/src/Admin/design/statistics.php?year=2024', 'statistics.php?year=2024', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 8, '2025-04-15 14:48:33'),
(105, 1, '/ewsd/src/Admin/design/statistics.php?year=2023', 'statistics.php?year=2023', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 3, '2025-04-14 19:31:22'),
(106, 1, '/ewsd/src/Admin/design/statistics.php?year=2025', 'statistics.php?year=2025', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-14 21:05:04'),
(107, 1, '/ewsd/src/Admin/design/eachfaculty.php?id=5', 'eachfaculty.php?id=5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 2, '2025-04-14 22:06:29'),
(108, 1, '/ewsd/src/Admin/design/eachfaculty.php?id=7', 'eachfaculty.php?id=7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-14 22:31:06'),
(109, NULL, '/ewsd/src/Guest/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-15 11:28:38'),
(110, NULL, '/ewsd/src/Guest/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-15 13:09:26'),
(111, NULL, '/ewsd/src/Guest/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-15 14:45:56'),
(112, 19, '/ewsd/src/Guest/design/viewselected.php', 'viewselected.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 4, '2025-04-15 14:46:05'),
(113, NULL, '/ewsd/src/Guest/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-15 14:45:59'),
(114, NULL, '/ewsd/src/Guest/design/dashboard.php', 'dashboard.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-15 14:46:03'),
(115, 3, '/ewsd/src/Manager/design/viewdetail.php?id=16', 'viewdetail.php?id=16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-15 14:51:04'),
(116, 3, '/ewsd/src/Manager/design/profile.php', 'profile.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 6, '2025-04-15 14:57:59'),
(117, 1, '/ewsd/src/Manager/design/All_Contribution.php', 'All_Contribution.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '::1', 1, '2025-04-15 15:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  `academicyear` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `user_id`, `title`, `status`, `academicyear`, `created_at`, `updated_at`) VALUES
(1, 2, 'Science', 'selected', '2025', '2025-03-20 14:54:48', '2025-04-13 15:03:38'),
(2, 2, 'Science', 'selected', '2025', '2025-03-21 08:36:56', '2025-04-13 15:03:38'),
(3, 2, 'Science', 'selected', '2025', '2025-03-21 14:43:11', '2025-04-13 15:03:38'),
(4, 10, 'Computing', 'selected', '2025', '2025-03-27 15:12:11', '2025-04-13 15:03:38'),
(9, 10, 'Computing', 'selected', '2025', '2025-03-27 15:30:46', '2025-04-13 15:03:38'),
(10, 10, 'Computing', 'selected', '2025', '2025-03-01 15:34:56', '2025-04-13 15:03:38'),
(11, 2, 'Science', 'selected', '2025', '2025-04-02 16:18:56', '2025-04-13 15:03:38'),
(13, 2, 'test', 'submitted', '2025', '2025-04-03 15:22:03', '2025-04-13 15:03:38'),
(14, 2, 'test', 'submitted', '2025', '2025-04-03 15:24:00', '2025-04-13 15:03:38'),
(16, 2, 'Science_test', 'selected', '2025', '2025-04-09 16:19:01', '2025-04-13 15:03:38'),
(17, 19, 'Engineering', 'submitted', '2024', '2025-04-10 08:31:24', '2025-04-15 08:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `article_id`, `comment_text`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'best content', '2025-03-22 08:34:10', '2025-03-22 08:34:10'),
(2, 2, 2, 'Re-write Content', '2025-03-22 12:41:44', '2025-03-22 12:41:44'),
(3, 2, 2, 'ok i will re-write this', '2025-03-22 13:17:51', '2025-03-22 13:17:51'),
(4, 8, 1, 'Test Comment', '2025-03-25 18:02:39', '2025-03-25 18:02:39'),
(5, 8, 2, 'i already update my content', '2025-03-29 05:53:34', '2025-03-29 05:53:34'),
(6, 2, 11, 'test', '2025-04-03 08:40:15', '2025-04-03 08:40:15'),
(7, 11, 4, 'test', '2025-04-03 08:41:48', '2025-04-03 08:41:48'),
(20, 8, 1, 'test 14 days', '2025-04-07 09:19:15', '2025-04-07 09:19:15'),
(34, 2, 16, 'test', '2025-04-15 04:57:53', '2025-04-15 04:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `doc_attachment`
--

CREATE TABLE `doc_attachment` (
  `doc_attachment_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `docfile` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doc_attachment`
--

INSERT INTO `doc_attachment` (`doc_attachment_id`, `article_id`, `docfile`, `created_at`, `updated_at`) VALUES
(2, 2, '1742546216_MyintHlaingSan(NS&C)Question.docx', '2025-03-21 08:36:56', '2025-03-21 08:36:56'),
(3, 3, '1742568191_MyintHlaingSan(NS&C)Question7.docx', '2025-03-21 14:43:11', '2025-03-21 14:43:11'),
(4, 4, '1743088331_Topic2NSC.docx', '2025-03-27 15:12:11', '2025-03-27 15:12:11'),
(9, 9, '1743089446_testing(6,7).docx', '2025-03-27 15:30:46', '2025-03-27 15:30:46'),
(10, 10, '1743089696_Topic6NSC.docx', '2025-03-27 15:34:56', '2025-03-27 15:34:56'),
(12, 1, '1743342072_Topic9NSC.docx', '2025-03-30 13:41:12', '2025-03-30 13:41:12'),
(13, 11, '1743610737_Topic9NSC.docx', '2025-04-02 16:18:57', '2025-04-02 16:18:57'),
(14, 11, '1743610737_Topic10NSC.docx', '2025-04-02 16:18:57', '2025-04-02 16:18:57'),
(16, 13, '1743693723_referenceAgile.txt', '2025-04-03 15:22:03', '2025-04-03 15:22:03'),
(17, 14, '1743693840_referenceAgile.txt', '2025-04-03 15:24:00', '2025-04-03 15:24:00'),
(19, 16, '1744215541_Topic 7NSC.docx', '2025-04-09 16:19:01', '2025-04-09 16:19:01'),
(20, 16, '1744215541_Topic2NSC.docx', '2025-04-09 16:19:01', '2025-04-09 16:19:01'),
(21, 16, '1744215541_Topic6NSC.docx', '2025-04-09 16:19:01', '2025-04-09 16:19:01'),
(22, 17, '1744273884_testing(6,7).docx', '2025-04-10 08:31:24', '2025-04-10 08:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `faculty_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `faculty_name`, `created_at`) VALUES
(1, 'Faculty of Social Science', '2025-03-17 16:50:31'),
(2, 'Faculty of Computing', '2025-03-22 05:14:40'),
(3, 'Faculty of Engineering', '2025-04-14 15:35:08'),
(4, 'Faculty of Business and Management', '2025-04-14 15:35:51'),
(5, 'Faculty of Environmental Studies', '2025-04-14 15:36:10'),
(6, 'Faculty of Media and Communication', '2025-04-14 15:38:26'),
(7, 'Faculty of Law and Politics', '2025-04-14 15:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `img_attachment`
--

CREATE TABLE `img_attachment` (
  `img_attachment_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `imagefile` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `img_attachment`
--

INSERT INTO `img_attachment` (`img_attachment_id`, `article_id`, `imagefile`, `created_at`, `updated_at`) VALUES
(2, 2, '1742546216_course1.jpg', '2025-03-21 08:36:56', '2025-03-21 08:36:56'),
(3, 3, '1742568191_erd.drawio.png', '2025-03-21 14:43:11', '2025-03-21 14:43:11'),
(4, 4, '1743088332_course1.jpg', '2025-03-27 15:12:12', '2025-03-27 15:12:12'),
(9, 9, '1743089446_course2.jpg', '2025-03-27 15:30:46', '2025-03-27 15:30:46'),
(10, 10, '1743089696_course6.jpg', '2025-03-27 15:34:56', '2025-03-27 15:34:56'),
(13, 11, '1743610737_course5.jpg', '2025-04-02 16:18:57', '2025-04-02 16:18:57'),
(14, 11, '1743610737_course6.jpg', '2025-04-02 16:18:57', '2025-04-02 16:18:57'),
(17, 13, '1743693723_02_Simple Form Design with CSS - HTML Training.png', '2025-04-03 15:22:03', '2025-04-03 15:22:03'),
(20, 1, '1744194809_course4.jpg', '2025-04-09 10:33:29', '2025-04-09 10:33:29'),
(22, 14, '1744195528_course7.jpg', '2025-04-09 10:45:28', '2025-04-09 10:45:28'),
(23, 16, '1744215541_course4.jpg', '2025-04-09 16:19:01', '2025-04-09 16:19:01'),
(24, 16, '1744215541_course5.jpg', '2025-04-09 16:19:01', '2025-04-09 16:19:01'),
(25, 16, '1744215541_course6.jpg', '2025-04-09 16:19:01', '2025-04-09 16:19:01'),
(26, 17, '1744273884_activity6.jpg', '2025-04-10 08:31:24', '2025-04-10 08:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deadline_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `article_id`, `user_id`, `message`, `created_at`, `deadline_date`) VALUES
(1, 10, 8, 'New article submitted: \'Science\' requires your review within 14 days.', '2025-03-27 15:34:56', '2025-04-10'),
(2, 11, 8, 'New article submitted: \'Science\' requires your review within 14 days.', '2025-04-02 16:18:57', '2025-04-16'),
(3, 11, 11, 'New article submitted: \'Science\' requires your review within 14 days.', '2025-04-02 16:18:57', '2025-04-16'),
(6, 13, 8, 'New article submitted: \'test\' requires your review within 14 days.', '2025-04-03 15:22:04', '2025-04-17'),
(7, 14, 8, 'New article submitted: \'test\' requires your review within 14 days.', '2025-04-03 15:24:00', '2025-04-17'),
(9, 16, 8, 'New article submitted: \'Science_test\' requires your review within 14 days.', '2025-04-09 16:19:01', '2025-04-23'),
(10, 17, 8, 'New article submitted: \'test\' requires your review within 14 days.', '2025-04-10 08:31:24', '2025-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission_name`, `created_at`) VALUES
(1, 'Manage Users', '2025-03-07 09:30:31'),
(2, 'Edit Articles', '2025-03-10 15:01:31'),
(3, 'Delete Users', '2025-03-10 15:01:46'),
(4, 'Submit Articles', '2025-03-10 15:02:03'),
(5, 'View All Articles', '2025-03-10 15:02:19'),
(6, 'View Articles ByID', '2025-03-10 15:02:29'),
(7, 'Download Articles', '2025-03-10 15:07:36');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`) VALUES
(1, 'Admin', '2025-03-06 15:20:22'),
(2, 'Student', '2025-03-06 16:52:17'),
(3, 'Manager', '2025-03-15 15:57:21'),
(4, 'Coordinator', '2025-03-16 11:44:42'),
(5, 'Guest', '2025-03-16 11:57:43');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 3),
(1, 5),
(1, 6),
(2, 2),
(2, 4),
(2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(8, 4),
(9, 5),
(10, 2),
(11, 4),
(12, 5),
(13, 5),
(19, 5);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_id` int(11) NOT NULL,
  `closure_date` date NOT NULL,
  `final_closure_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `closure_date`, `final_closure_date`, `created_at`, `updated_at`) VALUES
(1, '2025-04-12', '2025-04-14', '2025-03-17 15:53:47', '2025-04-15 09:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `phone`, `password`, `faculty_id`, `created_at`, `updated_at`, `last_login`) VALUES
(1, 'super admin', 'admin@gmail.com', 'YGN', '123456789', '$2y$10$u2CJ8Qwx2V1FKjbAhopBR./0ZztTI3nB74VqiMsT/8fU54s30nLEe', NULL, '2025-03-06 14:48:05', '2025-04-09 15:51:50', '2025-04-15 08:58:50'),
(2, 'super student', 'student@gmail.com', 'YGN', '123456789', '$2y$10$pkL67zyrjFJ4wgdLjCDgEuyiYH3v3oJ.JNralfG6eUMagb5jEX0KC', 1, '2025-03-06 16:48:33', '2025-04-15 06:14:18', '2025-04-15 06:07:21'),
(3, 'Manager', 'manager@gmail.com', 'YGN', '123456789', '$2y$10$WET/HwHei98Soh/Dgrb2set9ixZWftfL.VKzGRdm8o4aY5BIXrKHi', NULL, '2025-03-15 15:37:31', NULL, '2025-04-15 08:21:00'),
(8, 'Coordinator', 'coor@gmail.com', 'YGN', '123456789', '$2y$10$Pv1RKaAPY9ZkWA.MA0pJPu7WWP4JcVIzplEGXrOeQSsbv1E3yCEQi', 1, '2025-03-16 04:05:03', '2025-04-09 16:16:17', '2025-04-15 07:39:37'),
(9, 'Guest', 'guest@gmail.com', 'YGN', '123456789', '$2y$10$e.TisYIrLegn7rACQAtIke3iC0lG5R/9DtZyWiHp8I2lEPJLrHpEe', 2, '2025-03-16 04:05:55', NULL, '2025-04-15 06:39:25'),
(10, 'Student2', 'student2@gmail.com', 'YGN', '123456789', '$2y$10$MC7heVk6s3mMQZvG4KFUeOcR1sYwq/UodyIY601rLDXiolKamOaGa', 2, '2025-03-22 05:12:33', NULL, '2025-04-06 17:43:32'),
(11, 'coordinator2', 'coordinator2@gmail.com', 'YGN', '123456789', '$2y$10$YmVI03.DkrVsYZHviLgytuhxv640siClN/5.54hUQpwTtAixB7ga.', 2, '2025-03-22 05:13:53', NULL, '2025-04-07 13:14:55'),
(12, 'Guest2', 'guest2@gmail.com', 'YGN', '123456789', '$2y$10$IKxTbdlsjVAy8EWsgl0kYudeEZmfO9E.0f5k.gl5z49mHKV0Gl1te', 1, '2025-04-02 14:56:50', NULL, '2025-04-06 16:35:46'),
(13, 'Guest3', 'guest3@gmail.com', 'YGN', '123456789', '$2y$10$at9jOuKEPDUiqH8neW2RtuGZ2ZtfHWutKqZ.mvEdOwZXbuOd6aiFi', 2, '2025-04-02 14:59:43', NULL, NULL),
(19, 'Student3', 'student3@gmail.com', 'YGN', '123456789', '$2y$10$lpRl24yT4dh6ZSP7M726XOZTLNPCGzuPhreTci.0uIEsEcDHjF.Dq', 3, '2025-04-15 08:15:46', NULL, '2025-04-15 08:15:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`active_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `doc_attachment`
--
ALTER TABLE `doc_attachment`
  ADD PRIMARY KEY (`doc_attachment_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `img_attachment`
--
ALTER TABLE `img_attachment`
  ADD PRIMARY KEY (`img_attachment_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`permission_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`role_name`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `active_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `doc_attachment`
--
ALTER TABLE `doc_attachment`
  MODIFY `doc_attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `img_attachment`
--
ALTER TABLE `img_attachment`
  MODIFY `img_attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`);

--
-- Constraints for table `doc_attachment`
--
ALTER TABLE `doc_attachment`
  ADD CONSTRAINT `doc_attachment_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`);

--
-- Constraints for table `img_attachment`
--
ALTER TABLE `img_attachment`
  ADD CONSTRAINT `img_attachment_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
