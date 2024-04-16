-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2024 at 02:28 PM
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
  `date_created` timestamp NULL DEFAULT NULL,
  `date_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_assign`
--

INSERT INTO `tbl_assign` (`id`, `instructor_id`, `evaluation_form_id`, `user_id`, `is_active`, `date_created`, `date_updated`) VALUES
(11, 16, 8, 2, 1, '2024-03-04 10:44:32', NULL),
(12, 4, 8, 2, 1, '2024-03-04 10:44:32', NULL),
(13, 3, 8, 2, 1, '2024-03-04 10:44:32', '2024-03-27 01:26:16'),
(15, 16, 11, 2, 1, '2024-03-04 10:47:01', NULL),
(16, 4, 11, 2, 1, '2024-03-04 10:47:01', '2024-03-27 01:26:12'),
(17, 3, 11, 2, 1, '2024-03-04 10:47:01', '2024-03-27 01:26:15'),
(18, 16, 10, 2, 1, '2024-03-04 17:48:09', '2024-03-27 01:26:15'),
(19, 14, 8, 2, 1, '2024-04-16 05:13:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `category_no` int(11) NOT NULL,
  `category_description` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `category_no`, `category_description`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(17, 0, 'Category 1', 2, 1, '2024-03-02 15:31:20', NULL),
(18, 0, 'Category 2', 2, 1, '2024-03-02 15:31:25', NULL),
(19, 0, 'Category 3', 2, 1, '2024-03-02 15:31:32', NULL),
(20, 0, 'Category 4', 2, 1, '2024-03-04 14:50:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

CREATE TABLE `tbl_class` (
  `id` int(11) NOT NULL,
  `class_code` varchar(50) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_class`
--

INSERT INTO `tbl_class` (`id`, `class_code`, `class_name`, `instructor_id`, `subject_id`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'BSIT3', 'Bachelor of Science of Information Technology', 14, 1, 0, 1, '2024-03-11', NULL),
(3, 'BSHM', 'Bachelor of Science in Hospitality Management', 4, 1, 0, 1, '2024-03-11', NULL);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_evaluation_form`
--

INSERT INTO `tbl_evaluation_form` (`id`, `category_id`, `form_no`, `form_description`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(8, 17, '1', 'hahaha', 2, 1, '2024-03-02 15:31:45', NULL),
(10, 18, '1', 'hahaha', 2, 1, '2024-03-02 15:32:24', NULL),
(11, 19, '1', 'hahaha', 2, 1, '2024-03-02 15:32:31', NULL),
(12, 17, '1', 'This is form 1', 2, 1, '2024-03-21 05:25:59', NULL);

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
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_question`
--

INSERT INTO `tbl_question` (`id`, `evaluation_form_id`, `user_id`, `question`, `is_active`, `date_created`, `date_updated`) VALUES
(58, 8, 0, 'What is your name?', 1, '2024-03-04 18:05:07', NULL),
(59, 8, 0, 'What is your House?', 1, '2024-03-04 18:05:07', NULL),
(60, 8, 0, 'new1', 1, '2024-03-04 18:05:07', NULL),
(61, 8, 0, '98', 1, '2024-03-04 18:05:07', NULL),
(62, 8, 0, '1', 1, '2024-03-04 18:05:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_responses`
--

CREATE TABLE `tbl_responses` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_responses`
--

INSERT INTO `tbl_responses` (`id`, `student_id`, `teacher_id`, `question_id`, `rating`) VALUES
(11, 21, 4, 62, 1),
(12, 21, 4, 61, 2),
(13, 21, 4, 60, 2),
(14, 21, 4, 59, 2),
(15, 21, 4, 58, 2),
(16, 21, 14, 62, 1),
(17, 21, 14, 61, 1),
(18, 21, 14, 60, 1),
(19, 21, 14, 59, 1),
(20, 21, 14, 58, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_class`
--

CREATE TABLE `tbl_student_class` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student_class`
--

INSERT INTO `tbl_student_class` (`id`, `student_id`, `class_id`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(16, 21, 2, 1, 1, '2024-03-21', NULL),
(17, 21, 3, 1, 1, '2024-03-21', NULL),
(18, 18, 2, 1, 1, '2024-03-21', NULL),
(19, 19, 2, 1, 1, '2024-03-21', NULL),
(20, 22, 2, 1, 1, '2024-03-21', NULL),
(21, 18, 3, 1, 1, '2024-03-21', NULL),
(22, 19, 3, 1, 1, '2024-03-21', NULL),
(23, 22, 3, 1, 1, '2024-03-21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
  `id` int(11) NOT NULL,
  `subject_code` varchar(25) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`id`, `subject_code`, `subject_name`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'ITE302', 'Programming 1', 1, 1, '2024-03-10', NULL),
(2, 'asd', '', 1, 1, '2024-03-19', NULL),
(3, 'asdasd', 'asdasd', 1, 1, '2024-03-19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user-id` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  `department` int(11) NOT NULL,
  `date_created` date DEFAULT current_timestamp(),
  `date_updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user-id`, `firstname`, `lastname`, `email`, `password`, `created_by`, `type`, `department`, `date_created`, `date_updated`) VALUES
(1, 'A2702241', '', '', 'a@gmail.com', '123', 0, 'admin', 1, '2024-02-27', NULL),
(2, 'G2702241', '', '', 'guidance2@gmail.com', '123', 0, 'guidance', 1, '2024-02-27', NULL),
(3, 'T123123', '', '', 'teacher@gmail.com', '123', 0, 'teacher', 1, '2024-03-02', NULL),
(4, '0', 'test2', '', 'teacher2@gmail.com', '123', 0, 'teacher', 1, '2024-03-05', NULL),
(14, '123', 'Test', '2', 'a@gmail.com', '123', 0, 'teacher', 1, '2024-03-05', NULL),
(16, '321', 'Teacher', 'Teacher', 'guidance@gmail.com', '123', 0, 'teacher', 2, '2024-03-05', NULL),
(17, 'T321', 'guidance', 'account', 'guidance@gmail.com', '123', 0, 'guidance', 1, '2024-03-05', '2024-03-19'),
(18, 'C200166', '', '', 'janpauldaguman-it@srcb.edu.h', '123', 0, 'student', 2, '2024-03-11', NULL),
(19, 'C200167', 'Mark Paul', 'Daguman', 'mark@gmail.com', '123', 1, 'student', 2, '2024-03-12', '2024-03-19'),
(21, 'C654654', 'Jan Paul', 'Daguman', 'dodong.daguman@gmail.com', '123', 1, 'student', 2, '2024-03-19', '2024-03-19'),
(22, 'C789877', 'Augustine Bhern', 'Dumapias', 'bhern@gmail.com', '123', 1, 'student', 2, '2024-03-19', '2024-03-19'),
(35, 'C3213123', 'Jan Paul', 'Daguman', 'janpauldagum@gmail.com', '123', 1, 'admin', 1, '2024-03-19', NULL),
(36, 'C987', 'Raniel', 'Dagoc', 'ranieldagoc@gmail.com', '123', 1, 'student', 2, '2024-03-21', NULL);

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
-- Indexes for table `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_evaluation_form`
--
ALTER TABLE `tbl_evaluation_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_question`
--
ALTER TABLE `tbl_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_responses`
--
ALTER TABLE `tbl_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_student_class`
--
ALTER TABLE `tbl_student_class`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_class`
--
ALTER TABLE `tbl_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_evaluation_form`
--
ALTER TABLE `tbl_evaluation_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_question`
--
ALTER TABLE `tbl_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tbl_responses`
--
ALTER TABLE `tbl_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_student_class`
--
ALTER TABLE `tbl_student_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
