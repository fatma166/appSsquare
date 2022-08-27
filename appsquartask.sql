-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2022 at 10:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appsquartask`
--

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `body` text NOT NULL,
  `title` varchar(200) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(11) NOT NULL,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `num_hours` float NOT NULL,
  `days` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('accept','refuse','pending') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `leave_from`, `leave_to`, `num_hours`, `days`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(16, '2022-08-23', '2022-08-24', 0, 2, 8, 'accept', '2022-08-26 21:19:59', '2022-08-26 19:19:59'),
(17, '2022-08-27', '2022-08-28', 0, 2, 8, 'accept', '2022-08-27 07:35:06', '2022-08-27 05:35:06');

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
(1, '2022_08_19_202347_create_permission_table', 0),
(2, '2022_08_19_202347_create_permission_roles_table', 0),
(3, '2022_08_19_202347_create_roles_table', 0),
(4, '2022_08_20_043815_create_emails_table', 0),
(5, '2022_08_20_043815_create_notifications_table', 0),
(6, '2022_08_20_043815_create_permission_table', 0),
(7, '2022_08_20_043815_create_permission_roles_table', 0),
(8, '2022_08_20_043815_create_roles_table', 0),
(9, '2022_08_20_061617_create_emails_table', 0),
(10, '2022_08_20_061617_create_leave_requests_table', 0),
(11, '2022_08_20_061617_create_notifications_table', 0),
(12, '2022_08_20_061617_create_permission_table', 0),
(13, '2022_08_20_061617_create_permission_roles_table', 0),
(14, '2022_08_20_061617_create_roles_table', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `message` mediumtext NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `data_id` int(11) NOT NULL,
  `status` enum('delivered','seen') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `from`, `to`, `type`, `data_id`, `status`, `created_at`) VALUES
(3, 'طلب اذن', 'الموظف employee طالب اذن مغادرة', 8, 7, 'pending', 15, 'delivered', '2022-08-23 13:44:47'),
(4, 'طلب اذن', 'الموظف employee طالب اذن مغادرة', 8, 7, 'pending', 16, 'delivered', '2022-08-23 14:02:51'),
(5, 'تم الموافقه', 'الموظف employeeتم الموافقه', 8, 7, 'accept', 16, 'delivered', '2022-08-25 21:00:05'),
(6, 'تم الموافقه', 'الموظف employeeتم الموافقه', 7, 2, 'accept', 16, 'delivered', '2022-08-25 21:04:18'),
(7, 'تم الموافقه', 'الموظف employeeتم الموافقه', 7, 2, 'accept', 16, 'delivered', '2022-08-25 21:07:30'),
(8, 'تم الموافقه', 'الموظف employeeتم الموافقه', 8, 7, 'accept', 16, 'delivered', '2022-08-25 21:09:00'),
(9, 'تم الموافقه', 'الموظف employeeتم الموافقه', 8, 7, 'accept', 16, 'delivered', '2022-08-25 21:09:40'),
(10, 'تم الموافقه', 'الموظف employeeتم الموافقه', 7, 2, 'accept', 16, 'delivered', '2022-08-25 21:11:46'),
(11, 'تم الموافقه', 'الموظف employeeتم الموافقه', 7, 2, 'accept', 16, 'delivered', '2022-08-25 21:11:53'),
(12, 'تم الموافقه', 'الموظف employeeتم الموافقه', 7, 2, 'accept', 16, 'delivered', '2022-08-25 21:12:02'),
(13, 'تم الموافقه', 'الموظف employeeتم الموافقه', 7, 2, 'accept', 16, 'delivered', '2022-08-25 21:12:31'),
(14, 'تم الموافقه', 'الموظف employeeتم الموافقه', 7, 2, 'accept', 16, 'delivered', '2022-08-26 19:48:11'),
(15, 'تم الموافقه', 'الموظف employeeتم الموافقه', 8, 7, 'accept', 16, 'delivered', '2022-08-26 20:05:17'),
(16, 'تم الموافقه', 'الموظف employeeتم الموافقه', 7, 2, 'accept', 16, 'delivered', '2022-08-26 20:05:17'),
(17, 'تم الموافقه', 'الموظف employeeتم الموافقه', 8, 7, 'accept', 16, 'delivered', '2022-08-26 20:36:36'),
(18, 'تم الموافقه', 'الموظف employeeتم الموافقه', 8, 7, 'accept', 16, 'delivered', '2022-08-26 20:37:20'),
(19, 'تم الموافقه', 'الموظف employeeتم الموافقه', 8, 7, 'accept', 16, 'delivered', '2022-08-26 20:48:18'),
(20, 'تم الموافقه', 'الموظف employeeتم الموافقه', 8, 7, 'accept', 16, 'delivered', '2022-08-26 20:52:00'),
(21, 'تم الموافقه', 'الموظف employeeتم الموافقه', 8, 7, 'accept', 16, 'delivered', '2022-08-26 20:54:29'),
(22, 'تم الموافقه', 'الموظف employeeتم الموافقه', 8, 7, 'accept', 16, 'delivered', '2022-08-26 20:57:54'),
(23, 'تم الموافقه', 'الموظف employeeتم الموافقه', 7, 2, 'accept', 16, 'delivered', '2022-08-26 20:57:56'),
(24, 'تم الموافقه', 'الموظف employeeتم الموافقه', 8, 7, 'accept', 16, 'delivered', '2022-08-26 21:19:59'),
(25, 'تم الموافقه', 'الموظف employeeتم الموافقه', 7, 2, 'accept', 16, 'delivered', '2022-08-26 21:20:02'),
(26, 'طلب اذن', 'الموظف employee طالب اذن مغادرة', 8, 7, 'pending', 17, 'seen', '2022-08-27 07:24:20'),
(27, 'تم الموافقه', 'الموظف employeeتم الموافقه', 8, 7, 'accept', 17, 'delivered', '2022-08-27 07:35:06'),
(28, 'تم الموافقه', 'الموظف employeeتم الموافقه', 7, 2, 'accept', 17, 'delivered', '2022-08-27 07:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `key` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `type`) VALUES
(1, 'leave-store', 'leave_requests', 0),
(2, 'leave-index', 'leave_requests', 0),
(3, 'leave-update', 'leave_requests', 0),
(4, 'notify-index', 'notifications', 0),
(5, 'notify-update', 'notifications', 0);

-- --------------------------------------------------------

--
-- Table structure for table `permission_roles`
--

CREATE TABLE `permission_roles` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission_roles`
--

INSERT INTO `permission_roles` (`role_id`, `permission_id`) VALUES
(1, 2),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `type`) VALUES
(1, 'manger', ''),
(2, 'human_resource_manger', ''),
(3, 'employee', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `manger_Parent` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_isverified` tinyint(1) DEFAULT 0,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT current_timestamp(),
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_isverified` tinyint(1) DEFAULT 0,
  `device_token` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `join_date` datetime NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `device_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`device_info`)),
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `manger_Parent`, `name`, `email`, `email_isverified`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `phone`, `phone_isverified`, `device_token`, `join_date`, `active`, `device_info`, `last_login`) VALUES
(1, 2, 0, 'human_resource', 'hr@hr.com', 1, NULL, NULL, '$2y$10$N7Kpuc4kkFPkewIH3QF2wuRi5fjGlsaIYMEC0gvhimWph1zCcUzUq', NULL, '2022-08-20 11:45:22', '2022-08-20 11:45:22', '2022-08-20 11:45:22', '', 0, '1', '2022-08-20 13:45:22', 1, NULL, NULL),
(2, 1, 1, 'hr', 'hr@company.com', 0, NULL, NULL, '$2y$10$N7Kpuc4kkFPkewIH3QF2wuRi5fjGlsaIYMEC0gvhimWph1zCcUzUq', NULL, '2022-08-20 11:45:22', '2022-08-20 11:45:22', '2022-08-20 11:45:22', '', 0, '1', '2022-08-20 13:45:22', 1, NULL, NULL),
(3, 3, 2, 'employee', 'employee@company.com', 0, NULL, NULL, '', NULL, '2022-08-20 11:45:22', '2022-08-20 11:45:22', '2022-08-20 11:45:22', '', 0, '1', '2022-08-20 13:45:22', 1, NULL, NULL),
(4, NULL, 0, 'manger', 'manger1@manger.com', 0, NULL, NULL, '$2y$10$u3ye5YiSVcfoDZzqltDbseEmsq5kRS5EXGDzcjYjjrtcxGdtOS2jO', '1234', '2022-08-21 09:02:50', '2022-08-21 09:02:50', '2022-08-21 11:02:50', '4546456575', 0, '1', '2022-08-21 13:02:50', 1, NULL, NULL),
(7, 2, 2, 'manger', 'manger1@manger.com2', 0, NULL, NULL, '123456', NULL, '2022-08-21 10:27:51', '2022-08-21 10:27:51', '2022-08-21 12:27:51', '45464565753', 0, '1', '2022-08-21 14:27:51', 1, NULL, NULL),
(8, 3, 7, 'employee', 'employee1@employee.com3', 0, NULL, NULL, '$2y$10$N7Kpuc4kkFPkewIH3QF2wuRi5fjGlsaIYMEC0gvhimWph1zCcUzUq', NULL, '2022-08-21 10:49:43', '2022-08-21 10:49:43', '2022-08-21 12:49:43', '45464565752', 0, '1', '2022-08-21 14:49:43', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from` (`from`),
  ADD KEY `to` (`to`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from` (`from`),
  ADD KEY `to` (`to`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_role_fk` (`role_id`),
  ADD KEY `manger_Parent` (`manger_Parent`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `emails_ibfk_1` FOREIGN KEY (`from`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `emails_ibfk_2` FOREIGN KEY (`to`) REFERENCES `users` (`id`);

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `leave_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`from`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`to`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
