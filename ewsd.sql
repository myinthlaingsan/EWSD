-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 30, 2025 at 05:42 PM
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
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `user_id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'testing', 'selected', '2025-03-20 14:54:48', '2025-03-30 13:41:12'),
(2, 2, 'Test2', 'submitted', '2025-03-21 08:36:56', '2025-03-21 08:36:56'),
(3, 2, 'test', 'selected', '2025-03-21 14:43:11', '2025-03-25 15:28:51'),
(4, 10, 'Computing', 'selected', '2025-03-27 15:12:11', '2025-03-29 13:42:07'),
(9, 10, 'Computing', 'selected', '2025-03-27 15:30:46', '2025-03-29 13:40:16'),
(10, 10, 'Science', 'selected', '2025-03-27 15:34:56', '2025-03-29 13:46:33');

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
(5, 8, 2, 'i already update my content', '2025-03-29 05:53:34', '2025-03-29 05:53:34');

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
(12, 1, '1743342072_Topic9NSC.docx', '2025-03-30 13:41:12', '2025-03-30 13:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `faculty_name` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `faculty_name`, `created_at`) VALUES
(1, 'Science', '2025-03-17 16:50:31'),
(2, 'Computing', '2025-03-22 05:14:40');

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
(12, 1, '1743342072_04_CSS_Design.png', '2025-03-30 13:41:12', '2025-03-30 13:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deadline_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `article_id`, `user_id`, `message`, `is_read`, `created_at`, `deadline_date`) VALUES
(1, 10, 8, 'New article submitted: \'Science\' requires your review within 14 days.', 0, '2025-03-27 15:34:56', '2025-04-10');

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
(11, 4);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_id` int(11) NOT NULL,
  `academicyear` varchar(100) NOT NULL,
  `closure_date` date NOT NULL,
  `final_closure_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `academicyear`, `closure_date`, `final_closure_date`, `created_at`, `updated_at`) VALUES
(1, '2025', '2025-03-17', '2025-03-24', '2025-03-17 15:53:47', '2025-03-17 15:53:47');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `phone`, `password`, `faculty_id`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'YGN', '123456789', '$2y$10$WET/HwHei98Soh/Dgrb2set9ixZWftfL.VKzGRdm8o4aY5BIXrKHi', NULL, '2025-03-06 14:48:05'),
(2, 'student', 'student@gmail.com', 'YGN', '123456789', '$2y$10$1.J7v2cnTfgi1OHlfqICQuOs7v5WzbsINOk/uvN34N4Auijr6B7TK', 1, '2025-03-06 16:48:33'),
(3, 'Manager', 'manager@gmail.com', 'YGN', '123456789', '$2y$10$WET/HwHei98Soh/Dgrb2set9ixZWftfL.VKzGRdm8o4aY5BIXrKHi', NULL, '2025-03-15 15:37:31'),
(8, 'Coordinator', 'coor@gmail.com', 'YGN', '123456789', '$2y$10$Pv1RKaAPY9ZkWA.MA0pJPu7WWP4JcVIzplEGXrOeQSsbv1E3yCEQi', 1, '2025-03-16 04:05:03'),
(9, 'Guest', 'guest@gmail.com', 'YGN', '123456789', '$2y$10$e.TisYIrLegn7rACQAtIke3iC0lG5R/9DtZyWiHp8I2lEPJLrHpEe', NULL, '2025-03-16 04:05:55'),
(10, 'Student2', 'student2@gmail.com', 'YGN', '123456789', '$2y$10$MC7heVk6s3mMQZvG4KFUeOcR1sYwq/UodyIY601rLDXiolKamOaGa', 2, '2025-03-22 05:12:33'),
(11, 'coordinator2', 'coordinator2@gmail.com', 'YGN', '123456789', '$2y$10$YmVI03.DkrVsYZHviLgytuhxv640siClN/5.54hUQpwTtAixB7ga.', 2, '2025-03-22 05:13:53');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`setting_id`),
  ADD UNIQUE KEY `academicyear` (`academicyear`);

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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doc_attachment`
--
ALTER TABLE `doc_attachment`
  MODIFY `doc_attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `img_attachment`
--
ALTER TABLE `img_attachment`
  MODIFY `img_attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

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
