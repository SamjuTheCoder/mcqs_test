-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2021 at 02:12 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mcqstest`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answer` int(11) DEFAULT NULL,
  `question_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answer`, `correct_answer`, `question_id`, `created_at`, `updated_at`) VALUES
(1, 'A', NULL, 5, '2021-06-02 15:01:07', '2021-06-02 15:01:07'),
(2, 'B', 1, 5, '2021-06-02 15:04:36', '2021-06-02 15:04:36'),
(3, 'C', NULL, 5, '2021-06-02 15:10:36', '2021-06-02 15:10:36'),
(4, 'D', NULL, 5, '2021-06-02 15:11:32', '2021-06-02 15:11:32'),
(6, 'Asynchronous', 1, 6, '2021-06-02 19:59:16', '2021-06-02 19:59:16'),
(7, 'Not Asynchronous', NULL, 6, '2021-06-02 19:59:30', '2021-06-02 19:59:30'),
(8, 'htnl', NULL, 6, '2021-06-02 19:59:40', '2021-06-02 19:59:40'),
(9, 'CSS', NULL, 6, '2021-06-02 19:59:44', '2021-06-02 19:59:44'),
(10, 'A', NULL, 7, '2021-06-03 09:39:42', '2021-06-03 09:39:42'),
(11, 'B', 1, 7, '2021-06-03 09:39:47', '2021-06-03 09:39:47'),
(12, 'C', NULL, 7, '2021-06-03 09:39:50', '2021-06-03 09:39:50'),
(13, 'D', NULL, 7, '2021-06-03 09:39:53', '2021-06-03 09:39:53');

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
(8, '2021_06_02_123125_create_questions_table', 2),
(9, '2021_06_02_123443_create_answers_table', 2),
(10, '2021_06_02_193054_create_roles_table', 3),
(11, '2021_06_02_193959_create_user_roles_table', 3),
(12, '2021_06_02_194351_create_module_roles_table', 3),
(13, '2021_06_02_194600_create_modules_table', 3),
(14, '2021_06_03_094754_create_take_exams_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `moduleName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `moduleName`, `route`, `created_at`, `updated_at`) VALUES
(1, 'Create Questions', 'viewQuestions', NULL, NULL),
(2, 'Create Options', 'viewAnswer', NULL, NULL),
(5, 'Take Exam', 'takeExam', '2021-06-03 07:55:02', '2021-06-03 07:55:02'),
(6, 'My Exams', 'myExam', '2021-06-03 09:47:54', '2021-06-03 09:47:54'),
(7, 'All Exams', 'allExam', '2021-06-03 10:19:46', '2021-06-03 10:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `module_roles`
--

CREATE TABLE `module_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roleID` int(11) NOT NULL,
  `moduleID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_roles`
--

INSERT INTO `module_roles` (`id`, `roleID`, `moduleID`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(5, 1, 5, '2021-06-03 07:55:14', '2021-06-03 07:55:14'),
(6, 1, 6, '2021-06-03 09:48:09', '2021-06-03 09:48:09'),
(7, 2, 6, '2021-06-03 10:04:07', '2021-06-03 10:04:07'),
(8, 2, 5, '2021-06-03 10:04:14', '2021-06-03 10:04:14'),
(9, 1, 7, '2021-06-03 10:19:57', '2021-06-03 10:19:57'),
(10, 1, 8, '2021-06-03 10:53:35', '2021-06-03 10:53:35');

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
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `score`, `created_at`, `updated_at`) VALUES
(5, 'What color is this?', 10, '2021-06-02 14:23:38', '2021-06-02 14:23:38'),
(6, 'Which of the following is Ajax?', 5, '2021-06-02 19:58:46', '2021-06-02 19:58:46'),
(7, 'What is the meaning of Laravel', 10, '2021-06-03 09:38:30', '2021-06-03 09:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rolename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `rolename`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Student', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `take_exams`
--

CREATE TABLE `take_exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userID` int(11) NOT NULL,
  `questionID` int(11) DEFAULT NULL,
  `answerID` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `take_exams`
--

INSERT INTO `take_exams` (`id`, `userID`, `questionID`, `answerID`, `created_at`, `updated_at`) VALUES
(15, 1, 5, 2, '2021-06-03 10:02:57', '2021-06-03 10:02:57'),
(16, 1, 6, 6, '2021-06-03 10:03:01', '2021-06-03 10:03:01'),
(17, 1, 7, 11, '2021-06-03 10:03:04', '2021-06-03 10:03:04'),
(18, 2, 5, 4, '2021-06-03 10:09:28', '2021-06-03 10:09:28'),
(19, 2, 5, 4, '2021-06-03 10:09:48', '2021-06-03 10:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `username`, `password`, `user_type`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mark George', 'mark.george@gmail.com', NULL, NULL, '$2y$10$7/kY3RbTRZhcqcQcHMKcd.R4YwtiRYAymjmwGzOHyvJ6DN7D/ge.G', 1, 1, NULL, '2021-06-02 12:03:26', '2021-06-02 12:03:26'),
(2, 'Lucky Timothy', 'lucky.timothy@gmail.com', NULL, NULL, '$2y$10$hOXhLZWGhieuxLEnzH6MB./stz5sOcrtMpy9syh/HiTVwOC.dc2Tq', 0, 1, NULL, '2021-06-02 12:18:05', '2021-06-02 12:18:05'),
(3, 'Nathan', 'nathan@gmail.com', NULL, NULL, '$2y$10$tlbpPR0cNWoiHMXFvHMXPeyI997KWYOcYe1eSyZ7wGK7vJ.umSPPu', 0, 1, NULL, '2021-06-02 20:13:54', '2021-06-02 20:13:54'),
(4, 'Francis', 'francis@gmail.com', NULL, NULL, '$2y$10$eu7hr8OasrXD7tgF7bXy3u7v6utWTQx7vQH330XPSJjnJlR9l0hC.', 0, 1, NULL, '2021-06-02 20:15:48', '2021-06-02 20:15:48'),
(5, 'Michael', 'michael@gmail.com', NULL, NULL, '$2y$10$818cOLCb5NKzBmWo9RLLeuu8xHCV9Z9EgNIghTHfcyPBwsuUvxJUG', 0, 1, NULL, '2021-06-03 10:05:59', '2021-06-03 10:05:59'),
(6, '', '', NULL, NULL, '', NULL, 1, NULL, '2021-06-03 11:03:44', '2021-06-03 11:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `userID`, `roleID`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 5, 2, '2021-06-03 11:11:52', '2021-06-03 11:11:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_roles`
--
ALTER TABLE `module_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `take_exams`
--
ALTER TABLE `take_exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `module_roles`
--
ALTER TABLE `module_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `take_exams`
--
ALTER TABLE `take_exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
