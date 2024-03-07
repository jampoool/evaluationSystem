-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 07, 2024 at 07:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evaluation_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblactivity`
--

CREATE TABLE `tblactivity` (
  `id` int(11) NOT NULL,
  `user-id` int(11) NOT NULL,
  `type` varchar(25) NOT NULL,
  `activity_details` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assign`
--

CREATE TABLE `tbl_assign` (
  `id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `evaluation_form_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_assign`
--

INSERT INTO `tbl_assign` (`id`, `instructor_id`, `evaluation_form_id`, `user_id`, `is_active`, `date_created`, `date_updated`) VALUES
(7, 3, 14, 2, 1, '2024-03-02 03:01:14', NULL),
(8, 4, 14, 2, 0, '2024-03-02 03:05:15', '2024-03-02 03:05:15'),
(9, 3, 18, 2, 1, '2024-03-02 03:09:21', NULL),
(10, 4, 18, 2, 1, '2024-03-02 03:09:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `category_description` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `category_description`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(11, 'Category 1', 2, 1, '2024-02-29 00:24:24', NULL),
(12, 'Category 2', 2, 1, '2024-02-29 00:26:02', NULL),
(13, 'Category 3', 2, 1, '2024-02-29 00:29:21', NULL),
(14, 'Category 4', 2, 1, '2024-02-29 00:31:26', NULL),
(15, 'Category 5', 2, 1, '2024-02-29 00:31:37', NULL),
(16, 'Category 6', 2, 1, '2024-02-29 00:31:53', NULL),
(21, 'Category 7', 2, 1, '2024-02-29 00:35:54', NULL),
(22, 'Category 1', 2, 1, '2024-02-29 00:42:48', NULL),
(23, 'Category 1', 2, 1, '2024-02-29 00:43:32', NULL),
(24, 'Category 2', 2, 1, '2024-02-29 00:44:03', NULL),
(25, 'Category 9765', 2, 1, '2024-02-29 00:44:21', '2024-02-29 08:10:05'),
(26, 'Category 123', 2, 1, '2024-02-29 07:45:16', '2024-02-29 01:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evaluation_form`
--

CREATE TABLE `tbl_evaluation_form` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `form_no` varchar(50) NOT NULL,
  `form_description` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_evaluation_form`
--

INSERT INTO `tbl_evaluation_form` (`id`, `category_id`, `form_no`, `form_description`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 11, '1', 'This is a form', 2, 1, '2024-02-29 08:47:02', NULL),
(14, 11, '2', 'Second form', 2, 1, '2024-02-29 08:50:27', NULL),
(18, 13, '3', 'This is a form 1 with Category 2', 2, 1, '2024-02-29 08:53:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question`
--

CREATE TABLE `tbl_question` (
  `id` int(11) NOT NULL,
  `evaluation_form_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_question`
--

INSERT INTO `tbl_question` (`id`, `evaluation_form_id`, `user_id`, `question`, `is_active`, `date_created`, `date_updated`) VALUES
(1, 1, 2, 'What is your house?', 1, '2024-03-02 01:45:27', NULL),
(3, 14, 2, 'What is your house?', 1, '2024-03-02 02:00:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
  `id` int(11) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `date_updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user-id` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` varchar(15) NOT NULL,
  `department` int(11) NOT NULL,
  `date_created` date DEFAULT NULL,
  `date_updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user-id`, `email`, `password`, `type`, `department`, `date_created`, `date_updated`) VALUES
(1, 'A2702241', 'a@gmail.com', '123', 'admin', 1, '2024-02-27', NULL),
(2, 'G2702241', 'guidance@gmail.com', '123', 'guidance', 1, '2024-02-27', NULL),
(3, 'T-123123', 'teacher@gmail.com', '123', 'teacher', 1, '2024-03-02', NULL),
(4, 'T-123123123', 'teacher2@gmail.com', '123', 'teacher', 2, '2024-03-02', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblactivity`
--
ALTER TABLE `tblactivity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_assign`
--
ALTER TABLE `tbl_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_evaluation_form`
--
ALTER TABLE `tbl_evaluation_form`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `form_no` (`form_no`);

--
-- Indexes for table `tbl_question`
--
ALTER TABLE `tbl_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_unique` (`user-id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblactivity`
--
ALTER TABLE `tblactivity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_assign`
--
ALTER TABLE `tbl_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_evaluation_form`
--
ALTER TABLE `tbl_evaluation_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_question`
--
ALTER TABLE `tbl_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
