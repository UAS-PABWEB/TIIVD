-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2020 at 05:39 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple-classroom-id`
--

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kelas` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang_ilmu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`id`, `user_id`, `token`, `nama_kelas`, `bidang_ilmu`, `deskripsi`, `created_at`, `updated_at`) VALUES
(11, 1, 'qeSsBizI', 'TI - IVD', 'Pemrograman Web', 'DeskripsiLorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce laoreet nisl metus, quis tincidunt purus egestas sit amet.', '2020-06-11 21:25:01', '2020-06-11 21:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2020_06_08_003839_add_is_admin_to_users', 2),
(22, '2014_10_12_000000_create_users_table', 3),
(23, '2014_10_12_100000_create_password_resets_table', 3),
(24, '2019_08_19_000000_create_failed_jobs_table', 3),
(25, '2020_06_08_021536_add_somecolum_to_users', 3),
(26, '2020_06_09_085211_add_username_to_users', 3),
(27, '2020_06_09_232903_create_classroom_table', 4),
(28, '2020_06_10_013513_add_token_to_classroom', 5),
(29, '2020_06_10_103842_create_participants_table', 6),
(30, '2020_06_11_065239_create_theories_table', 7),
(31, '2020_06_11_071548_create_theories_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `classroom_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Ada','Keluar','Dikeluarkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ada',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `user_id`, `classroom_id`, `status`, `created_at`, `updated_at`) VALUES
(20, 1, 11, 'Ada', '2020-06-11 21:25:01', '2020-06-11 21:25:01'),
(21, 5, 11, 'Ada', '2020-06-11 21:25:18', '2020-06-11 21:25:18'),
(22, 3, 11, 'Ada', '2020-06-11 21:25:26', '2020-06-11 21:25:26');

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
-- Table structure for table `theories`
--

CREATE TABLE `theories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `classroom_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theories`
--

INSERT INTO `theories` (`id`, `user_id`, `classroom_id`, `judul`, `deskripsi`, `file`, `file_name`, `slug`, `created_at`, `updated_at`) VALUES
(14, 1, 11, 'UAS', 'Buat CRUD, Login, Database !', 'theory_files/g5V2PCrVUboWvsFkhjJvOGAJ8U8NVyM0ILbgqzfn.jpeg', 'pinguin.jpg', 'riQtZuap8w', '2020-06-11 21:25:59', '2020-06-11 21:25:59');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `roles` enum('Admin','User') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatars/default.png',
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `roles`, `address`, `phone`, `avatar`, `status`, `username`) VALUES
(1, 'Muhamad Iqbal Rivaldi', 'muhamadiqbalrivaldi03@gmail.com', '2020-06-09 17:00:40', '$2y$10$r3M9JYWmoXFfEgChSk/Ui.A5H93jKIFeY/vMfb5HGy9zW2etEsa9G', 'lnTyZGy8wQzKALmPI4t7u2a1A9Q2adYoDPpQtsjzBLU3eRv4eTIGREGF9917', '2020-06-09 17:00:17', '2020-06-11 21:23:41', 'Admin', 'Sumedang Utara', '085795992899', 'avatars/default.png', 'ACTIVE', 'iqbal'),
(3, 'Galih Ramanda', 'galih@gmail.com', '2020-06-10 08:20:02', '$2y$10$nadI8UPm.3SW6DYuKeWmZeg8bx.P/YKYPxP98Mm7IVRYo272iC4/6', 'pJJ0SxjJE0Fwbl6xx971nEnkg4VPZAW8WtVdCsd1IZyLNYuJDZyOsu8WEvcp', '2020-06-10 08:20:02', '2020-06-11 06:45:30', 'User', 'Alamat', '111', 'avatars/Iklwg7VKDNpdrLYPUM5OMzS9FUKO9QGBK9qTqHBx.jpeg', 'ACTIVE', 'galih'),
(5, 'Muhammad Arsyad F', 'arsyadf@gmail.com', '2020-06-11 06:52:44', '$2y$10$6TgcFtfWZO4nNDL2NkcHQOsK8Z7of/u5h4E3emYfy/2XUKeXpvUcS', 'dUpi1rXiSkzLVn316I96rrY4ojcrJwSg037edmOHKyossoBPR8aetSFNpDAV', '2020-06-11 06:52:44', '2020-06-11 21:23:57', 'User', 'Sumedang Selatan', '08723128372', 'avatars/F933APnqHL9PkqJSeVCIV30NabyOdWcldQx060is.jpeg', 'ACTIVE', 'arsyadf'),
(7, 'admin', 'kelompok9pabweb@gmail.com', '2020-06-11 21:19:13', '$2y$10$ReYDOMXorTi1rnztBgJiuunfTqLa2itQxQfEstiAyYgOkWoqVZe..', 'dZzolv2usE', '2020-06-11 21:19:13', '2020-06-11 21:19:13', 'Admin', 'STMIK SUMEDANG', '085795992899', 'avatars/zIHdEU4rrIOwSfWO4cxY3ZcGQ8i6110jmSiiT3Za.jpeg', 'ACTIVE', 'admin'),
(8, 'capruk', 'capruk2ndval@gmail.com', '2020-06-11 21:27:44', '$2y$10$LJO5PG0kHA3tvWpFdf.GbOVJvKYHN9w4DMpH/8BZgO4mri8MaNOFm', 'NrRYlfmrwLZCEr5tFT4ECljWHGyqDP6ONfZXVcmWGbnG8yzRcsNpJoVY9ZMg', '2020-06-11 21:27:14', '2020-06-11 21:28:58', 'User', NULL, NULL, 'avatars/default.png', 'ACTIVE', 'capruk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classroom_token_unique` (`token`),
  ADD KEY `classroom_user_id_foreign` (`user_id`);

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
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participants_user_id_foreign` (`user_id`),
  ADD KEY `participants_classroom_id_foreign` (`classroom_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `theories`
--
ALTER TABLE `theories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theories_user_id_foreign` (`user_id`),
  ADD KEY `theories_classroom_id_foreign` (`classroom_id`);

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
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `theories`
--
ALTER TABLE `theories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classroom`
--
ALTER TABLE `classroom`
  ADD CONSTRAINT `classroom_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classroom` (`id`),
  ADD CONSTRAINT `participants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `theories`
--
ALTER TABLE `theories`
  ADD CONSTRAINT `theories_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classroom` (`id`),
  ADD CONSTRAINT `theories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
