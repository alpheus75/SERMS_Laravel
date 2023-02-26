-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2023 at 01:07 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serms`
--

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
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` double(9,6) NOT NULL,
  `latitude` double(8,6) NOT NULL,
  `status` enum('Active','Resolved') COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`id`, `sender`, `description`, `location`, `longitude`, `latitude`, `status`, `assigned_to`, `remarks`, `rating`, `created_at`, `updated_at`) VALUES
(1, 'S001/2021', 'student mugged', 'Nairobi', 36.815500, -1.284100, 'Active', 'W002/2021', 'awaiting personnel feedback', 0, '2023-02-18 23:45:23', '2023-02-18 23:45:23'),
(2, 'S001/2021', 'student mugged', 'Nairobi', 36.815500, -1.284100, 'Resolved', 'W001/2021', 'student assissted', 3, '2023-02-18 23:55:37', '2023-02-24 06:57:24');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_15_205220_create_students_table', 1),
(6, '2023_01_15_205457_create_incidents_table', 1),
(7, '2023_01_15_205545_create_personnels_table', 1),
(8, '2023_01_25_182935_create_sos_table', 2),
(9, '2023_02_15_220516_create_notifications_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `personnels`
--

CREATE TABLE `personnels` (
  `work_id` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Available','Engaged') COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` bigint(20) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personnels`
--

INSERT INTO `personnels` (`work_id`, `name`, `email`, `telephone`, `status`, `rating`, `created_at`, `updated_at`) VALUES
('W001/2021', 'Staff 001', 'staff001@gmail.com', 987087850, 'Available', 3, '2023-01-26 19:26:47', '2023-02-24 06:57:24'),
('W002/2021', 'Satff 002', 'satff002@gmail.com', 987087654, 'Engaged', 0, '2023-01-26 19:26:47', '2023-02-18 20:45:23'),
('W003/2021', 'Staff 003', 'staff003@gmail.com', 123456789, 'Available', 0, '2023-01-26 19:26:47', '2023-02-18 18:46:09'),
('W004/2021', 'Staff 004', 'staff004@gmail.com', 198765432, 'Available', 0, '2023-01-26 19:26:47', '2023-02-18 18:46:29');

-- --------------------------------------------------------

--
-- Table structure for table `sos`
--

CREATE TABLE `sos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` double(9,6) NOT NULL,
  `latitude` double(8,6) NOT NULL,
  `status` enum('Admitted','Dismissed','Pending') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sos`
--

INSERT INTO `sos` (`id`, `sender`, `location`, `longitude`, `latitude`, `status`, `created_at`, `updated_at`) VALUES
(1, 'S001/2021', 'Nairobi', 36.815500, -1.284100, 'Admitted', '2023-02-12 17:19:20', '2023-02-14 18:44:49'),
(2, 'S001/2021', 'Nairobi', 36.815500, -1.284100, 'Admitted', '2023-02-16 19:17:11', '2023-02-18 18:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `reg_no` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` bigint(20) UNSIGNED NOT NULL,
  `program` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`reg_no`, `name`, `email`, `telephone`, `program`, `created_at`, `updated_at`) VALUES
('S001/2021', 'Student 001', 'student001@gmail.com', 198765432, 'Bsc IT', '2023-01-17 22:16:30', '2023-01-17 22:16:30'),
('S002/2021', 'Student-002', 'student002@gmail.com', 345678921, 'Bsc Computer Science', '2023-01-19 21:09:59', '2023-02-26 06:36:27'),
('S003/2021', 'Student 003', 'student003@gmail.com', 789654783, 'Bsc Computer Science', '2023-02-15 20:11:38', '2023-02-15 20:11:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Staff 001', 'staff001@gmail.com', NULL, '$2y$10$vomppCBQQhxLkkv6ysZVqOHDfDTJ0S2O1QQUeHHlbIv2VwTp3JThS', NULL, 2, '2023-01-23 17:38:53', '2023-01-23 17:38:53'),
(2, 'Admin001', 'admin001@gmail.com', NULL, '$2y$10$CGG6jIzFujqMRddvFlk5..Rlyv9CmTlLibVBNPGpG53tkZvBqWtVK', NULL, 0, '2023-01-23 18:01:17', '2023-01-23 18:01:17'),
(3, 'Satff 001', 'satff002@gmail.com', NULL, '$2y$10$8L8jWSN1nSsBwA7EQE5gpegUCgQGGyQNs6m5FT0b62kVNv31w6dGO', NULL, 2, '2023-01-24 16:20:37', '2023-01-24 16:20:37'),
(4, 'Staff 003', 'staff003@gmail.com', NULL, '$2y$10$aj2Oik28ShcXr2gA4sD00el3siAv8ucoP/g96r/lXRcW3kwQInTn.', NULL, 2, '2023-01-24 16:32:56', '2023-01-24 16:32:56'),
(5, 'Staff 004', 'staff004@gmail.com', NULL, '$2y$10$FDYUuLXNxjc1Jx7mkZsuTOPtpcDmfLPhr4o6dKqUnF.kd2YC6ksaC', NULL, 2, '2023-01-24 16:37:59', '2023-01-24 16:37:59'),
(6, 'Admin002', 'admin002@gmail.com', NULL, '$2y$10$HRkvOYpUZLxRhnRAn3vPueo8GAI3BD4G4d6s4FokApK/dHzoBpomG', NULL, 0, '2023-01-24 17:00:22', '2023-01-24 17:00:22'),
(7, 'Student 001', 'student001@gmail.com', NULL, '$2y$10$7H5zYM/OzVHyEmJfFePz0uQ0F97LxyrwaZfI0YMYTtbhj2F7dolKq', NULL, 1, '2023-01-24 17:12:30', '2023-01-24 17:12:30'),
(8, 'Student-002', 'student002@gmail.com', NULL, '$2y$10$RMCWUpDsD.pqV4mYxP07auVoqKFpoqF9/y38XfvDrGp2bXKhnCA3S', NULL, 1, '2023-01-24 17:19:22', '2023-02-26 06:36:27'),
(9, 'Admin003', 'admin003@gmail.com', NULL, '$2y$10$I9VdKwHYVTcx5HbdB5TrNubKa6HMISkgU4ygkBjMyK5iymStku4dm', NULL, 0, '2023-01-24 17:26:09', '2023-01-24 17:26:09'),
(10, 'Student 003', 'student003@gmail.com', NULL, '$2y$10$iWSCcz0Fhbu9EysHVvT6G.GA.z4B02XKzzdXGyz2w.Oi.uGSRT3eG', NULL, 1, '2023-02-15 17:11:39', '2023-02-15 17:11:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incidents_sender_foreign` (`sender`);

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
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- Indexes for table `personnels`
--
ALTER TABLE `personnels`
  ADD PRIMARY KEY (`work_id`),
  ADD UNIQUE KEY `personnels_email_unique` (`email`),
  ADD UNIQUE KEY `personnels_telephone_unique` (`telephone`);

--
-- Indexes for table `sos`
--
ALTER TABLE `sos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sos_sender_foreign` (`sender`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`reg_no`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD UNIQUE KEY `students_telephone_unique` (`telephone`);

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
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sos`
--
ALTER TABLE `sos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `incidents_sender_foreign` FOREIGN KEY (`sender`) REFERENCES `students` (`reg_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sos`
--
ALTER TABLE `sos`
  ADD CONSTRAINT `sos_sender_foreign` FOREIGN KEY (`sender`) REFERENCES `students` (`reg_no`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
