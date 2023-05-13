-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2023 at 05:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `managerproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_12_12_091023_create_project_table', 1),
(5, '2022_12_14_143243_create_tasks_table', 1),
(6, '2022_12_14_143905_create_task_detail_table', 1);

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
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cost` double DEFAULT 0,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `description` longtext DEFAULT 'text',
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `user_id`, `cost`, `date_start`, `date_end`, `status`, `description`, `file`, `created_at`, `updated_at`) VALUES
(3, 'Lập trình web', 2, 10000000, '2022-12-30', '2023-01-06', 0, 'hêllo', 'Thế giới Pixel_ (8).jpg', '2022-12-20 07:28:59', '2022-12-20 07:28:59'),
(4, 'Lập trình mobile', 2, 10000000, '2019-01-01', '2020-06-10', 0, 'App dành cho trẻ em dưới 10 tuổi, nội dung gồm ảnh, video hoạt hình.', 'Thế giới Pixel_ (9).jpg', '2022-12-20 07:30:36', '2022-12-21 08:19:28'),
(5, 'Lập trình Web', 2, 12000000, '2022-12-07', '2022-12-31', 1, 'Web quản lý shop quần áo', 'On-tap-csharp.docx', '2022-12-20 18:58:09', '2022-12-21 08:19:37'),
(6, 'Web quản lý quán ăn', 4, 250000000, '2022-12-22', '2022-12-30', 1, 'Ngôn ngữ php', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext DEFAULT NULL,
  `dealine` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `project_id`, `description`, `dealine`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Làm FontEnd', 3, 'Cực cháy', '2022-12-21', 0, '2022-12-20 07:33:23', '2022-12-20 07:33:23'),
(6, 'Làm bachend', 6, 'Ngôn ngữ Python', '2022-12-22', 1, '2022-12-21 08:01:47', '2022-12-21 08:01:47'),
(7, 'Làm giao diện', 5, 'JS, CSS', '2022-12-30', 0, '2022-12-21 08:02:40', '2022-12-21 08:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `task_detail`
--

CREATE TABLE `task_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_detail`
--

INSERT INTO `task_detail` (`id`, `user_id`, `task_id`, `created_at`, `updated_at`) VALUES
(7, 3, 5, '2022-12-20 07:33:23', '2022-12-20 07:33:23'),
(8, 4, 6, '2022-12-21 08:01:47', '2022-12-21 08:01:47'),
(9, 2, 7, '2022-12-21 08:02:40', '2022-12-21 08:02:40');

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
  `avartar` varchar(255) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `salary` double DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `dateJoinCompany` date DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avartar`, `sex`, `birthday`, `address`, `salary`, `position`, `dateJoinCompany`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Trần Văn Hanh', 'hanh@gmail.com', NULL, '$2y$10$i5mHD2TVhkyqMYeEimiZzuLVQ7JNDXe7NwJjegdelvJWoiSJ4g0d2', 'Thế giới Pixel_ (32).jpg', 0, '2002-07-24', 'Mỹ Đình - Hà Nội', 150000000, 'Lập trình AI', '2021-07-16', 0, NULL, '2022-12-20 07:11:59', '2022-12-20 18:53:33'),
(3, 'Phạm Đức Anh', 'anhduc@gmail.com', NULL, '$2y$10$p4Qa4LFiUe8PYbpslo8JSefPrTVWFW9jFXYjvNMQZyy9J12V70/Sm', 'Thế giới Pixel_ (1).jpg', 0, '2002-07-25', 'Phố Triều Khúc', 10000000, 'Lập trình Mobile', '2022-11-20', 1, NULL, '2022-12-20 07:14:05', '2022-12-20 07:14:05'),
(4, 'Phan Vũ Nguyên Hoàng', 'phanhoang@gmail.com', NULL, '$2y$10$IUX9xtHN/nvLSk.aVSwwy.JYpt6EsMgZQIo877ytHvXxa2W8rPDDa', 'Thế giới Pixel_ (9).jpg', 0, '2002-07-21', 'Hà Nội', 100000000, 'Trông xe', '2022-06-22', 1, NULL, '2022-12-20 07:22:02', '2022-12-20 07:22:02'),
(5, 'Kiều Nguyễn Việt Anh', 'anhnguyen@gmail.com', NULL, '$2y$10$5V6CLmOZh57E2Q1NVDV1cOBLGJr4i5KVOHSPCRhNG8dFiItdjbDbO', 'Thế giới Pixel_ (10).jpg', 0, '2017-06-21', 'Hà Nội', 2000000, 'Tester', '2022-12-22', 1, NULL, '2022-12-20 18:54:39', '2022-12-20 18:54:39'),
(6, 'Nguyễn Việt Dũng', 'dung@gamil.com', NULL, '123', NULL, 1, '2022-12-14', 'Hà Đông', 67598798, 'Trông xe', '2022-12-13', 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_user_id_foreign` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_project_id_foreign` (`project_id`);

--
-- Indexes for table `task_detail`
--
ALTER TABLE `task_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_detail_user_id_foreign` (`user_id`),
  ADD KEY `task_detail_task_id_foreign` (`task_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `task_detail`
--
ALTER TABLE `task_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

--
-- Constraints for table `task_detail`
--
ALTER TABLE `task_detail`
  ADD CONSTRAINT `task_detail_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `task_detail_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
