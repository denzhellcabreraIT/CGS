-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2025 at 01:10 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cgs`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `hash_password` (`plain_password` VARCHAR(255)) RETURNS VARCHAR(255) CHARSET utf8mb4 DETERMINISTIC BEGIN
    -- Using SHA-256 with a salt (second parameter 0 means SHA-256)
    RETURN SHA2(CONCAT(plain_password, 'your_random_salt_here'), 256);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `acc_table`
--

CREATE TABLE `acc_table` (
  `ID` int(11) NOT NULL,
  `stud_num` varchar(11) DEFAULT NULL,
  `FULL_NAME` varchar(50) NOT NULL,
  `USERNAME` varchar(25) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `account_type` enum('regular','staff','admin','teacher') NOT NULL DEFAULT 'regular',
  `account_status` enum('Enabled','Disabled') NOT NULL DEFAULT 'Enabled',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acc_table`
--

INSERT INTO `acc_table` (`ID`, `stud_num`, `FULL_NAME`, `USERNAME`, `EMAIL`, `PASSWORD`, `account_type`, `account_status`, `last_activity`) VALUES
(15, '03210003379', 'Robert Burce Ignacio', 'bert10', 'rbignacio3379ant@student.fatima.edu.ph', '$2y$10$K13b5I9elzm611aigpcM0Ov7uPRnQymeo5t0AFdOsl4WXkZqVRi6q', 'staff', 'Enabled', NULL),
(16, '00000000000', 'Robert Burce Ignacio', 'adminCGS', 'admin@gmail.com', '$2y$10$quU1/57.PBf0TsMcpv4x7OFvBHDDA38xvzFsP1QAuvdLUrfCfim3e', 'admin', 'Enabled', NULL),
(17, '11111111111', 'Rhey Delizo', 'Rhey_Delizo', 'rheydelizo@teacher.fatima.edu.ph', '$2y$10$0pv.AD2P1dDLVBkW/yjBBOE8atebs32mEEfDMk4fEGgBaIdnlxxj2', 'teacher', 'Enabled', NULL),
(18, '03210001123', 'Robert Daniel Ignacio', 'berto', 'robertignacio@student.fatima.edu.ph', '$2y$10$qBod/HhuK8eN9OzX8JR8y.zf8rCTRT7rdnGTPzIqvpg4P0WyAyt02', 'regular', 'Enabled', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `adhd_results`
--

CREATE TABLE `adhd_results` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `q1` int(11) DEFAULT NULL,
  `q2` int(11) DEFAULT NULL,
  `q3` int(11) DEFAULT NULL,
  `q4` int(11) DEFAULT NULL,
  `q5` int(11) DEFAULT NULL,
  `q6` int(11) DEFAULT NULL,
  `total_score` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adhd_results`
--

INSERT INTO `adhd_results` (`id`, `name`, `email`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `total_score`, `created_at`) VALUES
(1, 'Robert Burce Ignacio', 'robertignacio486@gmail.com', 4, 2, 2, 3, 1, 3, 15, '2025-05-01 06:47:36'),
(2, 'Robert Burce Ignacio', 'robertignacio486@gmail.com', 4, 2, 2, 3, 1, 3, 15, '2025-05-01 06:52:07');

-- --------------------------------------------------------

--
-- Table structure for table `adhd_tests`
--

CREATE TABLE `adhd_tests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `test_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expiry` datetime NOT NULL,
  `used` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `token`, `expiry`, `used`, `created_at`) VALUES
(1, 15, '95712116c73def9e4f1d3d1d2a71ab91e15c697894343a85deeaefd64e39ea2e', '2025-05-17 00:22:39', 0, '2025-05-16 21:22:39'),
(2, 15, '5d2091dbcdeaa3c20b0c4b1917786441dba4709f9f059700c5a19c143a3e03b3', '2025-05-17 00:22:48', 0, '2025-05-16 21:22:48'),
(3, 15, '09171f7ddf6fa4214556d8cd5b3b829294d5213b556f05c96897c705bfa585eb', '2025-05-17 00:24:51', 0, '2025-05-16 21:24:51'),
(4, 15, '8f72537335ae4db371d863a656761f57c8d0b16e00ee52ce90f84c7105d14112', '2025-05-17 00:24:55', 0, '2025-05-16 21:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `student_number` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `concern_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `talked_to_someone` varchar(20) NOT NULL,
  `mood` varchar(20) DEFAULT NULL,
  `help_type` varchar(30) NOT NULL,
  `communication_mode` varchar(30) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `urgency` enum('low','medium','high') NOT NULL DEFAULT 'low',
  `consent` varchar(3) NOT NULL,
  `date_submitted` datetime DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'pending',
  `reporter_type` enum('teacher','student') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `student_number`, `full_name`, `age`, `contact_number`, `concern_type`, `description`, `talked_to_someone`, `mood`, `help_type`, `communication_mode`, `duration`, `urgency`, `consent`, `date_submitted`, `status`, `reporter_type`) VALUES
(6, '03210003379', 'Robert Daniel Ignacio', 21, '09459831502', 'Academic', 'AYOKO NA MAG ARAL GUSTO KO NA LANG SUMAKSES', 'no', '2', 'Just want someone to listen', 'Face-to-face session', '', 'medium', 'yes', '2025-04-11 02:41:35', 'In progress', 'teacher'),
(8, '123', '123', 123, '123', 'Career Guidance', '123', 'No', 'Very Happy', 'Just want someone to listen', 'Face-to-face session', 'Select Duration', 'low', 'Yes', '2025-05-14 23:47:17', 'pending', 'teacher');

-- --------------------------------------------------------

--
-- Table structure for table `staff_checklist`
--

CREATE TABLE `staff_checklist` (
  `id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `task_description` text NOT NULL,
  `assigned_by` varchar(255) NOT NULL,
  `status` enum('pending','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_checklist`
--

INSERT INTO `staff_checklist` (`id`, `report_id`, `task_description`, `assigned_by`, `status`, `created_at`, `completed_at`) VALUES
(1, 6, 'Workout', 'bert10', 'pending', '2025-05-16 14:57:45', NULL),
(2, 6, 'get girls', 'bert10', 'pending', '2025-05-16 14:57:58', NULL),
(3, 6, 'get girls', 'root', 'completed', '2025-05-16 15:16:56', '2025-05-16 15:17:26'),
(4, 6, 'get girls', 'root', 'pending', '2025-05-16 15:39:01', NULL),
(5, 6, 'get girls', 'root', 'pending', '2025-05-16 16:16:48', NULL),
(6, 6, 'get girls', 'root', 'pending', '2025-05-16 16:18:07', NULL),
(7, 6, 'get girls', 'root', 'pending', '2025-05-16 16:18:11', NULL),
(8, 6, 'get girls', 'adminCGS', 'pending', '2025-05-16 16:53:53', NULL),
(9, 6, 'get girls', 'adminCGS', 'completed', '2025-05-16 17:56:39', '2025-05-16 19:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `teachers_reports`
--

CREATE TABLE `teachers_reports` (
  `id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `building` varchar(255) NOT NULL,
  `year_level` varchar(50) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `contact_number` varchar(20) NOT NULL,
  `reported_by` varchar(100) DEFAULT NULL,
  `concern_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `duration` varchar(50) NOT NULL,
  `communication_mode` varchar(50) NOT NULL,
  `urgency` varchar(50) NOT NULL,
  `reported_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','in_progress','resolved') DEFAULT 'pending',
  `follow_up_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers_reports`
--

INSERT INTO `teachers_reports` (`id`, `student_name`, `department`, `building`, `year_level`, `age`, `contact_number`, `reported_by`, `concern_type`, `description`, `duration`, `communication_mode`, `urgency`, `reported_at`, `status`, `follow_up_notes`) VALUES
(1, 'Jecker Dela Pena', 'Computer Science', '', '3rd year', 23, '09459831502', 'adminCGS', 'Anger outbursts', 'NAGDADABOG', 'More than a week', 'Face-to-face session', 'high', '2025-05-16 17:48:46', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_checklist`
--

CREATE TABLE `user_checklist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_description` text NOT NULL,
  `status` enum('pending','done') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_checklist`
--

INSERT INTO `user_checklist` (`id`, `user_id`, `item_description`, `status`, `created_at`, `completed_at`) VALUES
(1, 15, 'make new friend', 'done', '2025-05-16 08:00:17', '2025-05-16 08:02:25'),
(2, 15, 'add task', 'done', '2025-05-16 08:00:22', '2025-05-16 08:00:23'),
(3, 15, 'add', 'done', '2025-05-16 08:02:16', '2025-05-16 08:02:22'),
(9, 15, 'make new friend', 'done', '2025-05-16 10:24:06', '2025-05-16 10:24:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_table`
--
ALTER TABLE `acc_table`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `stud_num` (`stud_num`);

--
-- Indexes for table `adhd_results`
--
ALTER TABLE `adhd_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adhd_tests`
--
ALTER TABLE `adhd_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_checklist`
--
ALTER TABLE `staff_checklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_id` (`report_id`);

--
-- Indexes for table `teachers_reports`
--
ALTER TABLE `teachers_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_checklist`
--
ALTER TABLE `user_checklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_table`
--
ALTER TABLE `acc_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `adhd_results`
--
ALTER TABLE `adhd_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `adhd_tests`
--
ALTER TABLE `adhd_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff_checklist`
--
ALTER TABLE `staff_checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teachers_reports`
--
ALTER TABLE `teachers_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_checklist`
--
ALTER TABLE `user_checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adhd_tests`
--
ALTER TABLE `adhd_tests`
  ADD CONSTRAINT `adhd_tests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `acc_table` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `acc_table` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `staff_checklist`
--
ALTER TABLE `staff_checklist`
  ADD CONSTRAINT `staff_checklist_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_checklist`
--
ALTER TABLE `user_checklist`
  ADD CONSTRAINT `user_checklist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `acc_table` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
