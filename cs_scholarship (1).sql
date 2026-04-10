-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2026 at 03:33 AM
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
-- Database: `cs_scholarship`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `password`, `department`, `created_at`, `updated_at`) VALUES
(2, 'Department', 'Secretary', 'admin.college.of.business.accountancy@scholarnet.com', '$2y$12$T2IVA6KDfVq51blJ9jEZ3eMYn5OUzkkorSMdo0DbkxMEcUUGCuNdG', 'College of Business and Accountancy', '2026-03-27 18:17:06', '2026-03-29 19:40:10'),
(3, 'Department', 'Secretary', 'admin.college.of.computer.studies@scholarnet.com', '$2y$12$yYIOU3VSymbpOHSuGvTmDOiac10zOSh0Tzl1inwmbFy6qpbWuc1Hi', 'College of Computer Studies', '2026-03-27 18:17:06', '2026-03-29 19:40:10'),
(4, 'Department', 'Secretary', 'admin.college.of.criminology@scholarnet.com', '$2y$12$vxmuvx/QOhIPm44aivNXyOTh2qDxvEY3JNAnYJFufUYPs85UmRcwm', 'College of Criminology', '2026-03-27 18:17:06', '2026-03-29 19:40:10'),
(5, 'Department', 'Secretary', 'admin.college.of.education.liberal.arts@scholarnet.com', '$2y$12$3103yndy5sQKBTCLu.8W.OKlJauX5SKh7S66qbhM2HvBmscqxasgO', 'College of Education and Liberal Arts', '2026-03-27 18:17:07', '2026-03-29 19:40:10'),
(6, 'Department', 'Secretary', 'admin.college.of.hospitality.management@scholarnet.com', '$2y$12$2lnxNy24B1s/iQSD3SNMweiQV1hX.X8pvd6w5..qLv264JBl1CR0G', 'College of Hospitality Management', '2026-03-27 18:17:07', '2026-03-29 19:40:11'),
(7, 'Department', 'Secretary', 'admin.college.of.nursing@scholarnet.com', '$2y$12$715JYzEcdkyhthlu6VZDRumBWqVcoULSs7Ne02/ZoiP2DWxOQgb6i', 'College of Nursing', '2026-03-27 18:17:07', '2026-03-29 19:40:11'),
(8, 'Department', 'Secretary', 'admin.college.of.physical.therapy@scholarnet.com', '$2y$12$UhtTcxWVIz.6pF43P1p0kuaHmOLCkzoWj86sTdmDWu1ih3uDcGiN.', 'College of Physical Therapy', '2026-03-27 18:17:07', '2026-03-29 19:40:11'),
(9, 'Admin', 'Manager', 'admin.all@scholarnet.com', '$2y$12$UFBxHbVkJelM8jkJpLeIg.Pq0ymGsGndiObKppNTcpmeh.pwkGl6i', NULL, '2026-03-29 19:40:09', '2026-03-29 19:40:09');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `audience_type` enum('all_students','secretaries','department','personal') NOT NULL DEFAULT 'all_students',
  `target_department` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `audience_type`, `target_department`, `created_at`, `updated_at`, `user_id`, `admin_id`) VALUES
(1, 'Submission of Requirements', 'April 12, 2005', 'all_students', NULL, '2026-03-30 21:27:09', '2026-03-30 21:27:09', NULL, NULL),
(2, 'For Computer Science Students', 'Meeting on the faculty lobby', 'department', 'College of Computer Studies', '2026-03-30 21:44:32', '2026-03-30 21:44:32', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_level` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `curriculums`
--

CREATE TABLE `curriculums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `curriculums`
--

INSERT INTO `curriculums` (`id`, `department`, `semester`, `course_title`, `created_at`, `updated_at`) VALUES
(1, 'College of Computer Studies', 'First Year – First Semester', 'Introduction to Computing', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(2, 'College of Computer Studies', 'First Year – First Semester', 'Fundamentals of Programming', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(3, 'College of Computer Studies', 'First Year – First Semester', 'Living in the IT Era', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(4, 'College of Computer Studies', 'First Year – First Semester', 'Understanding the Self', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(5, 'College of Computer Studies', 'First Year – First Semester', 'Mathematics in the Modern World', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(6, 'College of Computer Studies', 'First Year – First Semester', 'National Service Training Program 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(7, 'College of Computer Studies', 'First Year – First Semester', 'Rhythmic Activities', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(8, 'College of Computer Studies', 'First Year – Second Semester', 'Intermediate Programming', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(9, 'College of Computer Studies', 'First Year – Second Semester', 'Discrete Structure 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(10, 'College of Computer Studies', 'First Year – Second Semester', 'Information Management', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(11, 'College of Computer Studies', 'First Year – Second Semester', 'Readings in Philippine History', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(12, 'College of Computer Studies', 'First Year – Second Semester', 'Purposive Communication', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(13, 'College of Computer Studies', 'First Year – Second Semester', 'National Service Training Program 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(14, 'College of Computer Studies', 'First Year – Second Semester', 'Team Sports', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(15, 'College of Computer Studies', 'Second Year – First Semester', 'Data Structure and Algorithm', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(16, 'College of Computer Studies', 'Second Year – First Semester', 'Application Development & Emerging', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(17, 'College of Computer Studies', 'Second Year – First Semester', 'Discrete Structure 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(18, 'College of Computer Studies', 'Second Year – First Semester', 'Object Oriented Programming', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(19, 'College of Computer Studies', 'Second Year – First Semester', 'Art Appreciation', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(20, 'College of Computer Studies', 'Second Year – First Semester', 'Reading in Visual Arts', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(21, 'College of Computer Studies', 'Second Year – First Semester', 'Badminton and Volleyball', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(22, 'College of Computer Studies', 'Second Year – Second Semester', 'Algorithms and Complexity', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(23, 'College of Computer Studies', 'Second Year – Second Semester', 'Architecture and Organization', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(24, 'College of Computer Studies', 'Second Year – Second Semester', 'Human Computer Interaction 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(25, 'College of Computer Studies', 'Second Year – Second Semester', 'Advanced Differential Calculus', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(26, 'College of Computer Studies', 'Second Year – Second Semester', 'The Contemporary World', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(27, 'College of Computer Studies', 'Second Year – Second Semester', 'Science, Technology and Society', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(28, 'College of Computer Studies', 'Second Year – Second Semester', 'Wellness', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(29, 'College of Computer Studies', 'Third Year – First Semester', 'Automata Theory and Formal Language', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(30, 'College of Computer Studies', 'Third Year – First Semester', 'Information Assurance and Security 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(31, 'College of Computer Studies', 'Third Year – First Semester', 'Networks and Communication', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(32, 'College of Computer Studies', 'Third Year – First Semester', 'Software Engineering 1 – Analysis', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(33, 'College of Computer Studies', 'Third Year – First Semester', 'Professional Elective 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(34, 'College of Computer Studies', 'Third Year – First Semester', 'Professional Elective 3', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(35, 'College of Computer Studies', 'Third Year – First Semester', 'Ethics', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(36, 'College of Computer Studies', 'Third Year – Second Semester', 'Operating System and Applications', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(37, 'College of Computer Studies', 'Third Year – Second Semester', 'Programming Languages', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(38, 'College of Computer Studies', 'Third Year – Second Semester', 'Software Engineering 2 – Implementation', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(39, 'College of Computer Studies', 'Third Year – Second Semester', 'Information Assurance and Security 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(40, 'College of Computer Studies', 'Third Year – Second Semester', 'Professional Elective 4', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(41, 'College of Computer Studies', 'Third Year – Second Semester', 'Life and Works of Rizal', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(42, 'College of Computer Studies', 'Third Year – Second Semester', 'The Entrepreneurial Mind', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(43, 'College of Computer Studies', 'Fourth Year – First Semester', 'CS Thesis 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(44, 'College of Computer Studies', 'Fourth Year – First Semester', 'Professional Elective 5', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(45, 'College of Computer Studies', 'Fourth Year – First Semester', 'Computational Science', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(46, 'College of Computer Studies', 'Fourth Year – First Semester', 'HCI 2 – Multimedia and Visual Computing', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(47, 'College of Computer Studies', 'Fourth Year – First Semester', 'OS – Parallel and Distributing', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(48, 'College of Computer Studies', 'Fourth Year – First Semester', 'Advanced Project Management', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(49, 'College of Computer Studies', 'Fourth Year – Second Semester', 'Practicum (324 hours)', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(50, 'College of Business and Accountancy', 'First Year – First Semester', 'Introduction to Business Administration', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(51, 'College of Business and Accountancy', 'First Year – First Semester', 'Business Mathematics', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(52, 'College of Business and Accountancy', 'First Year – First Semester', 'Accounting Principles 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(53, 'College of Business and Accountancy', 'First Year – First Semester', 'English Communication', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(54, 'College of Business and Accountancy', 'First Year – First Semester', 'Understanding the Self', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(55, 'College of Business and Accountancy', 'First Year – First Semester', 'Fundamentals of Accounting', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(56, 'College of Business and Accountancy', 'First Year – First Semester', 'Physical Education 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(57, 'College of Business and Accountancy', 'First Year – Second Semester', 'Business Organization and Management', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(58, 'College of Business and Accountancy', 'First Year – Second Semester', 'Accounting Principles 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(59, 'College of Business and Accountancy', 'First Year – Second Semester', 'Economics 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(60, 'College of Business and Accountancy', 'First Year – Second Semester', 'Purposive Communication', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(61, 'College of Business and Accountancy', 'First Year – Second Semester', 'Philippine History', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(62, 'College of Business and Accountancy', 'First Year – Second Semester', 'Microeconomics', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(63, 'College of Business and Accountancy', 'First Year – Second Semester', 'Physical Education 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(64, 'College of Business and Accountancy', 'Second Year – First Semester', 'Cost Accounting 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(65, 'College of Business and Accountancy', 'Second Year – First Semester', 'Intermediate Accounting 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(66, 'College of Business and Accountancy', 'Second Year – First Semester', 'Management Accounting', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(67, 'College of Business and Accountancy', 'Second Year – First Semester', 'Business Laws', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(68, 'College of Business and Accountancy', 'Second Year – First Semester', 'Art Appreciation', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(69, 'College of Business and Accountancy', 'Second Year – First Semester', 'Tax Accounting 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(70, 'College of Business and Accountancy', 'Second Year – First Semester', 'Wellness', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(71, 'College of Business and Accountancy', 'Second Year – Second Semester', 'Cost Accounting 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(72, 'College of Business and Accountancy', 'Second Year – Second Semester', 'Intermediate Accounting 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(73, 'College of Business and Accountancy', 'Second Year – Second Semester', 'Audit Fundamentals', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(74, 'College of Business and Accountancy', 'Second Year – Second Semester', 'Business Ethics', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(75, 'College of Business and Accountancy', 'Second Year – Second Semester', 'Contemporary World', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(76, 'College of Business and Accountancy', 'Second Year – Second Semester', 'Tax Accounting 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(77, 'College of Business and Accountancy', 'Second Year – Second Semester', 'Elective', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(78, 'College of Business and Accountancy', 'Third Year – First Semester', 'Advanced Accounting 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(79, 'College of Business and Accountancy', 'Third Year – First Semester', 'Auditing Principles', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(80, 'College of Business and Accountancy', 'Third Year – First Semester', 'Financial Reporting', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(81, 'College of Business and Accountancy', 'Third Year – First Semester', 'Management Accounting 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(82, 'College of Business and Accountancy', 'Third Year – First Semester', 'Professional Elective 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(83, 'College of Business and Accountancy', 'Third Year – First Semester', 'Ethics', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(84, 'College of Business and Accountancy', 'Third Year – First Semester', 'Elective', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(85, 'College of Business and Accountancy', 'Third Year – Second Semester', 'Advanced Accounting 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(86, 'College of Business and Accountancy', 'Third Year – Second Semester', 'Auditing Practice', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(87, 'College of Business and Accountancy', 'Third Year – Second Semester', 'Financial Analysis', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(88, 'College of Business and Accountancy', 'Third Year – Second Semester', 'Forensic Accounting', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(89, 'College of Business and Accountancy', 'Third Year – Second Semester', 'Professional Elective 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(90, 'College of Business and Accountancy', 'Third Year – Second Semester', 'Rizal Course', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(91, 'College of Business and Accountancy', 'Third Year – Second Semester', 'Elective', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(92, 'College of Business and Accountancy', 'Fourth Year – First Semester', 'Advanced Auditing', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(93, 'College of Business and Accountancy', 'Fourth Year – First Semester', 'Case Studies in Accounting', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(94, 'College of Business and Accountancy', 'Fourth Year – First Semester', 'International Accounting Standards', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(95, 'College of Business and Accountancy', 'Fourth Year – First Semester', 'Advanced Tax', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(96, 'College of Business and Accountancy', 'Fourth Year – First Semester', 'Capstone 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(97, 'College of Business and Accountancy', 'Fourth Year – First Semester', 'Professional Elective 3', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(98, 'College of Business and Accountancy', 'Fourth Year – Second Semester', 'Internship/Practicum (300 hours)', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(99, 'College of Business and Accountancy', 'Fourth Year – Second Semester', 'Capstone 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(100, 'College of Nursing', 'First Year – First Semester', 'Anatomy and Physiology 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(101, 'College of Nursing', 'First Year – First Semester', 'General Chemistry', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(102, 'College of Nursing', 'First Year – First Semester', 'Nursing Fundamentals 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(103, 'College of Nursing', 'First Year – First Semester', 'English Communication', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(104, 'College of Nursing', 'First Year – First Semester', 'Understanding the Self', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(105, 'College of Nursing', 'First Year – First Semester', 'Microbiology', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(106, 'College of Nursing', 'First Year – First Semester', 'Physical Education 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(107, 'College of Nursing', 'First Year – Second Semester', 'Anatomy and Physiology 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(108, 'College of Nursing', 'First Year – Second Semester', 'Organic Chemistry', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(109, 'College of Nursing', 'First Year – Second Semester', 'Nursing Fundamentals 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(110, 'College of Nursing', 'First Year – Second Semester', 'Purposive Communication', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(111, 'College of Nursing', 'First Year – Second Semester', 'Philippine History', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(112, 'College of Nursing', 'First Year – Second Semester', 'Pathophysiology', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(113, 'College of Nursing', 'First Year – Second Semester', 'Physical Education 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(114, 'College of Nursing', 'Second Year – First Semester', 'Clinical Medicine 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(115, 'College of Nursing', 'Second Year – First Semester', 'Medical-Surgical Nursing 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(116, 'College of Nursing', 'Second Year – First Semester', 'Pharmacology 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(117, 'College of Nursing', 'Second Year – First Semester', 'Nutrition and Diet', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(118, 'College of Nursing', 'Second Year – First Semester', 'Art Appreciation', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(119, 'College of Nursing', 'Second Year – First Semester', 'Pathology', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(120, 'College of Nursing', 'Second Year – First Semester', 'Wellness', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(121, 'College of Nursing', 'Second Year – Second Semester', 'Clinical Medicine 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(122, 'College of Nursing', 'Second Year – Second Semester', 'Medical-Surgical Nursing 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(123, 'College of Nursing', 'Second Year – Second Semester', 'Pharmacology 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(124, 'College of Nursing', 'Second Year – Second Semester', 'Health Assessment', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(125, 'College of Nursing', 'Second Year – Second Semester', 'Psychology', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(126, 'College of Nursing', 'Second Year – Second Semester', 'Elective', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(127, 'College of Nursing', 'Second Year – Second Semester', 'Practicum 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(128, 'College of Nursing', 'Third Year – First Semester', 'Pediatric Nursing', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(129, 'College of Nursing', 'Third Year – First Semester', 'Maternal and Child Health Nursing', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(130, 'College of Nursing', 'Third Year – First Semester', 'Community Health Nursing 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(131, 'College of Nursing', 'Third Year – First Semester', 'Mental Health Nursing', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(132, 'College of Nursing', 'Third Year – First Semester', 'Clinical Nursing 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(133, 'College of Nursing', 'Third Year – First Semester', 'Ethics', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(134, 'College of Nursing', 'Third Year – Second Semester', 'Geriatric Nursing', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(135, 'College of Nursing', 'Third Year – Second Semester', 'Care of Patient with Gynecologic Issues', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(136, 'College of Nursing', 'Third Year – Second Semester', 'Community Health Nursing 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(137, 'College of Nursing', 'Third Year – Second Semester', 'Public Health Nursing', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(138, 'College of Nursing', 'Third Year – Second Semester', 'Clinical Nursing 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(139, 'College of Nursing', 'Third Year – Second Semester', 'Practicum 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(140, 'College of Nursing', 'Fourth Year – First Semester', 'Leadership and Management in Nursing', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(141, 'College of Nursing', 'Fourth Year – First Semester', 'Nursing Research', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(142, 'College of Nursing', 'Fourth Year – First Semester', 'Elective 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(143, 'College of Nursing', 'Fourth Year – First Semester', 'Elective 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(144, 'College of Nursing', 'Fourth Year – First Semester', 'Clinical Nursing 3', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(145, 'College of Nursing', 'Fourth Year – First Semester', 'Thesis', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(146, 'College of Nursing', 'Fourth Year – Second Semester', 'Clinical Rotation/Internship (400 hours)', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(147, 'College of Nursing', 'Fourth Year – Second Semester', 'Thesis Defense', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(148, 'College of Education and Liberal Arts', 'First Year – First Semester', 'Introduction to Education', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(149, 'College of Education and Liberal Arts', 'First Year – First Semester', 'Filipino Communication', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(150, 'College of Education and Liberal Arts', 'First Year – First Semester', 'English Communication', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(151, 'College of Education and Liberal Arts', 'First Year – First Semester', 'Understanding the Self', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(152, 'College of Education and Liberal Arts', 'First Year – First Semester', 'History of the Philippines', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(153, 'College of Education and Liberal Arts', 'First Year – First Semester', 'General Psychology', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(154, 'College of Education and Liberal Arts', 'First Year – First Semester', 'Physical Education 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(155, 'College of Education and Liberal Arts', 'First Year – Second Semester', 'Educational Psychology', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(156, 'College of Education and Liberal Arts', 'First Year – Second Semester', 'Purposive Communication', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(157, 'College of Education and Liberal Arts', 'First Year – Second Semester', 'General Psychology Advanced', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(158, 'College of Education and Liberal Arts', 'First Year – Second Semester', 'World History', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(159, 'College of Education and Liberal Arts', 'First Year – Second Semester', 'Introduction to Linguistics', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(160, 'College of Education and Liberal Arts', 'First Year – Second Semester', 'Mathematics for Teachers', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(161, 'College of Education and Liberal Arts', 'First Year – Second Semester', 'Physical Education 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(162, 'College of Education and Liberal Arts', 'Second Year – First Semester', 'Curriculum Development', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(163, 'College of Education and Liberal Arts', 'Second Year – First Semester', 'Teaching Methods 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(164, 'College of Education and Liberal Arts', 'Second Year – First Semester', 'Philosophy of Education', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(165, 'College of Education and Liberal Arts', 'Second Year – First Semester', 'Adolescent Psychology', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(166, 'College of Education and Liberal Arts', 'Second Year – First Semester', 'Art Appreciation', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(167, 'College of Education and Liberal Arts', 'Second Year – First Semester', 'Science for Teachers 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(168, 'College of Education and Liberal Arts', 'Second Year – First Semester', 'Wellness', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(169, 'College of Education and Liberal Arts', 'Second Year – Second Semester', 'Teaching Methods 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(170, 'College of Education and Liberal Arts', 'Second Year – Second Semester', 'Assessment and Evaluation', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(171, 'College of Education and Liberal Arts', 'Second Year – Second Semester', 'Classroom Management', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(172, 'College of Education and Liberal Arts', 'Second Year – Second Semester', 'Child Development', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(173, 'College of Education and Liberal Arts', 'Second Year – Second Semester', 'Science for Teachers 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(174, 'College of Education and Liberal Arts', 'Second Year – Second Semester', 'Contemporary World', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(175, 'College of Education and Liberal Arts', 'Second Year – Second Semester', 'Literature', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(176, 'College of Education and Liberal Arts', 'Third Year – First Semester', 'Special Education', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(177, 'College of Education and Liberal Arts', 'Third Year – First Semester', 'Practical Research 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(178, 'College of Education and Liberal Arts', 'Third Year – First Semester', 'Subject Matter Specialization 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(179, 'College of Education and Liberal Arts', 'Third Year – First Semester', 'Inclusive Education', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(180, 'College of Education and Liberal Arts', 'Third Year – First Semester', 'Professional Elective 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(181, 'College of Education and Liberal Arts', 'Third Year – First Semester', 'Ethics', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(182, 'College of Education and Liberal Arts', 'Third Year – Second Semester', 'Practical Research 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(183, 'College of Education and Liberal Arts', 'Third Year – Second Semester', 'Subject Matter Specialization 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(184, 'College of Education and Liberal Arts', 'Third Year – Second Semester', 'Technology in Education', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(185, 'College of Education and Liberal Arts', 'Third Year – Second Semester', 'Professional Elective 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(186, 'College of Education and Liberal Arts', 'Third Year – Second Semester', 'Practicum 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(187, 'College of Education and Liberal Arts', 'Fourth Year – First Semester', 'Advanced Teaching Strategies', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(188, 'College of Education and Liberal Arts', 'Fourth Year – First Semester', 'Teacher Leadership', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(189, 'College of Education and Liberal Arts', 'Fourth Year – First Semester', 'Capstone Project 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(190, 'College of Education and Liberal Arts', 'Fourth Year – First Semester', 'Professional Elective 3', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(191, 'College of Education and Liberal Arts', 'Fourth Year – First Semester', 'Internship Seminar', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(192, 'College of Education and Liberal Arts', 'Fourth Year – Second Semester', 'Student Teaching/Internship (360 hours)', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(193, 'College of Education and Liberal Arts', 'Fourth Year – Second Semester', 'Capstone Project 2', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(194, 'College of Criminology', 'First Year – First Semester', 'Introduction to Criminal Justice', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(195, 'College of Criminology', 'First Year – First Semester', 'Criminal Law 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(196, 'College of Criminology', 'First Year – First Semester', 'Criminalistics 1', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(197, 'College of Criminology', 'First Year – First Semester', 'English Communication', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(198, 'College of Criminology', 'First Year – First Semester', 'Philippine History', '2026-03-29 21:26:38', '2026-03-29 21:26:38'),
(199, 'College of Criminology', 'First Year – First Semester', 'Understanding Self', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(200, 'College of Criminology', 'First Year – First Semester', 'Physical Education 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(201, 'College of Criminology', 'First Year – Second Semester', 'Criminal Justice Administration', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(202, 'College of Criminology', 'First Year – Second Semester', 'Criminal Law 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(203, 'College of Criminology', 'First Year – Second Semester', 'Criminalistics 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(204, 'College of Criminology', 'First Year – Second Semester', 'Purposive Communication', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(205, 'College of Criminology', 'First Year – Second Semester', 'World History', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(206, 'College of Criminology', 'First Year – Second Semester', 'General Psychology', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(207, 'College of Criminology', 'First Year – Second Semester', 'Physical Education 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(208, 'College of Criminology', 'Second Year – First Semester', 'Criminal Investigation 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(209, 'College of Criminology', 'Second Year – First Semester', 'Evidence and Investigation', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(210, 'College of Criminology', 'Second Year – First Semester', 'Fingerprinting and Photography', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(211, 'College of Criminology', 'Second Year – First Semester', 'Constitutional Law', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(212, 'College of Criminology', 'Second Year – First Semester', 'Art Appreciation', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(213, 'College of Criminology', 'Second Year – First Semester', 'Forensic Chemistry', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(214, 'College of Criminology', 'Second Year – First Semester', 'Wellness', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(215, 'College of Criminology', 'Second Year – Second Semester', 'Criminal Investigation 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(216, 'College of Criminology', 'Second Year – Second Semester', 'Narcotics', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(217, 'College of Criminology', 'Second Year – Second Semester', 'Emergency Response', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(218, 'College of Criminology', 'Second Year – Second Semester', 'Criminal Procedure', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(219, 'College of Criminology', 'Second Year – Second Semester', 'Forensic Biology', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(220, 'College of Criminology', 'Second Year – Second Semester', 'Contemporary Issues', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(221, 'College of Criminology', 'Second Year – Second Semester', 'Forensic Medicine', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(222, 'College of Criminology', 'Third Year – First Semester', 'Police Administration', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(223, 'College of Criminology', 'Third Year – First Semester', 'Corrections', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(224, 'College of Criminology', 'Third Year – First Semester', 'Cybercrime Investigation', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(225, 'College of Criminology', 'Third Year – First Semester', 'Special Operations', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(226, 'College of Criminology', 'Third Year – First Semester', 'Professional Elective 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(227, 'College of Criminology', 'Third Year – First Semester', 'Ethics', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(228, 'College of Criminology', 'Third Year – Second Semester', 'Community Policing', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(229, 'College of Criminology', 'Third Year – Second Semester', 'Juvenile Delinquency', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(230, 'College of Criminology', 'Third Year – Second Semester', 'Traffic Management', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(231, 'College of Criminology', 'Third Year – Second Semester', 'Professional Elective 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(232, 'College of Criminology', 'Third Year – Second Semester', 'Practicum 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(233, 'College of Criminology', 'Fourth Year – First Semester', 'Legal Medicine', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(234, 'College of Criminology', 'Fourth Year – First Semester', 'Crisis Management', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(235, 'College of Criminology', 'Fourth Year – First Semester', 'Capstone 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(236, 'College of Criminology', 'Fourth Year – First Semester', 'Professional Elective 3', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(237, 'College of Criminology', 'Fourth Year – First Semester', 'Internship', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(238, 'College of Criminology', 'Fourth Year – Second Semester', 'Field Training (300 hours)', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(239, 'College of Criminology', 'Fourth Year – Second Semester', 'Capstone 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(240, 'College of Hospitality Management', 'First Year – First Semester', 'Introduction to Hospitality', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(241, 'College of Hospitality Management', 'First Year – First Semester', 'Front Office Operations', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(242, 'College of Hospitality Management', 'First Year – First Semester', 'Food Service 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(243, 'College of Hospitality Management', 'First Year – First Semester', 'English Communication', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(244, 'College of Hospitality Management', 'First Year – First Semester', 'Understanding the Self', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(245, 'College of Hospitality Management', 'First Year – First Semester', 'Basic Cooking', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(246, 'College of Hospitality Management', 'First Year – First Semester', 'Physical Education 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(247, 'College of Hospitality Management', 'First Year – Second Semester', 'Hospitality Management 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(248, 'College of Hospitality Management', 'First Year – Second Semester', 'Housekeeping Operations', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(249, 'College of Hospitality Management', 'First Year – Second Semester', 'Food Service 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(250, 'College of Hospitality Management', 'First Year – Second Semester', 'Purposive Communication', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(251, 'College of Hospitality Management', 'First Year – Second Semester', 'Philippine History', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(252, 'College of Hospitality Management', 'First Year – Second Semester', 'Kitchen Management', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(253, 'College of Hospitality Management', 'First Year – Second Semester', 'Physical Education 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(254, 'College of Hospitality Management', 'Second Year – First Semester', 'Hospitality Management 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(255, 'College of Hospitality Management', 'Second Year – First Semester', 'Guest Relations', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(256, 'College of Hospitality Management', 'Second Year – First Semester', 'Food and Beverage 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(257, 'College of Hospitality Management', 'Second Year – First Semester', 'Culinary Arts 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(258, 'College of Hospitality Management', 'Second Year – First Semester', 'Art Appreciation', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(259, 'College of Hospitality Management', 'Second Year – First Semester', 'Restaurant Management', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(260, 'College of Hospitality Management', 'Second Year – First Semester', 'Wellness', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(261, 'College of Hospitality Management', 'Second Year – Second Semester', 'Events Management 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(262, 'College of Hospitality Management', 'Second Year – Second Semester', 'Hotel Operations', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(263, 'College of Hospitality Management', 'Second Year – Second Semester', 'Food and Beverage 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(264, 'College of Hospitality Management', 'Second Year – Second Semester', 'Culinary Arts 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(265, 'College of Hospitality Management', 'Second Year – Second Semester', 'Psychology of Service', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(266, 'College of Hospitality Management', 'Second Year – Second Semester', 'Contemporary World', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(267, 'College of Hospitality Management', 'Second Year – Second Semester', 'Sommelier Basics', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(268, 'College of Hospitality Management', 'Third Year – First Semester', 'Events Management 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(269, 'College of Hospitality Management', 'Third Year – First Semester', 'Banquet Management', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(270, 'College of Hospitality Management', 'Third Year – First Semester', 'Pastry and Baking', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(271, 'College of Hospitality Management', 'Third Year – First Semester', 'Professional Elective 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(272, 'College of Hospitality Management', 'Third Year – First Semester', 'Tourism Management', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(273, 'College of Hospitality Management', 'Third Year – First Semester', 'Ethics', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(274, 'College of Hospitality Management', 'Third Year – Second Semester', 'Sustainable Hospitality', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(275, 'College of Hospitality Management', 'Third Year – Second Semester', 'Hospitality Marketing', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(276, 'College of Hospitality Management', 'Third Year – Second Semester', 'Advanced Culinary', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(277, 'College of Hospitality Management', 'Third Year – Second Semester', 'Professional Elective 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(278, 'College of Hospitality Management', 'Third Year – Second Semester', 'Practicum 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(279, 'College of Hospitality Management', 'Fourth Year – First Semester', 'Strategic Management', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(280, 'College of Hospitality Management', 'Fourth Year – First Semester', 'Quality Assurance', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(281, 'College of Hospitality Management', 'Fourth Year – First Semester', 'Hospitality Analytics', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(282, 'College of Hospitality Management', 'Fourth Year – First Semester', 'Professional Elective 3', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(283, 'College of Hospitality Management', 'Fourth Year – First Semester', 'Capstone 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(284, 'College of Hospitality Management', 'Fourth Year – Second Semester', 'Internship (360 hours)', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(285, 'College of Hospitality Management', 'Fourth Year – Second Semester', 'Capstone 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(286, 'College of Physical Therapy', 'First Year – First Semester', 'Anatomy and Physiology 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(287, 'College of Physical Therapy', 'First Year – First Semester', 'General Chemistry', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(288, 'College of Physical Therapy', 'First Year – First Semester', 'Healthcare Fundamentals', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(289, 'College of Physical Therapy', 'First Year – First Semester', 'English Communication', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(290, 'College of Physical Therapy', 'First Year – First Semester', 'Understanding the Self', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(291, 'College of Physical Therapy', 'First Year – First Semester', 'Medical Terminology', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(292, 'College of Physical Therapy', 'First Year – First Semester', 'Physical Education 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(293, 'College of Physical Therapy', 'First Year – Second Semester', 'Anatomy and Physiology 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(294, 'College of Physical Therapy', 'First Year – Second Semester', 'Organic Chemistry', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(295, 'College of Physical Therapy', 'First Year – Second Semester', 'Health Assessment', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(296, 'College of Physical Therapy', 'First Year – Second Semester', 'Purposive Communication', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(297, 'College of Physical Therapy', 'First Year – Second Semester', 'Philippine History', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(298, 'College of Physical Therapy', 'First Year – Second Semester', 'Pathophysiology', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(299, 'College of Physical Therapy', 'First Year – Second Semester', 'Physical Education 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(300, 'College of Physical Therapy', 'Second Year – First Semester', 'Physical Therapy Sciences 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(301, 'College of Physical Therapy', 'Second Year – First Semester', 'Pharmacology', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(302, 'College of Physical Therapy', 'Second Year – First Semester', 'Biomechanics', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(303, 'College of Physical Therapy', 'Second Year – First Semester', 'Musculoskeletal Disorders', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(304, 'College of Physical Therapy', 'Second Year – First Semester', 'Art Appreciation', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(305, 'College of Physical Therapy', 'Second Year – First Semester', 'Clinical Anatomy', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(306, 'College of Physical Therapy', 'Second Year – First Semester', 'Wellness', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(307, 'College of Physical Therapy', 'Second Year – Second Semester', 'Physical Therapy Sciences 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(308, 'College of Physical Therapy', 'Second Year – Second Semester', 'Therapeutic Exercises', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(309, 'College of Physical Therapy', 'Second Year – Second Semester', 'Electrotherapy', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(310, 'College of Physical Therapy', 'Second Year – Second Semester', 'Neurological Disorders', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(311, 'College of Physical Therapy', 'Second Year – Second Semester', 'Psychology of Rehabilitation', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(312, 'College of Physical Therapy', 'Second Year – Second Semester', 'Contemporary Medicine', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(313, 'College of Physical Therapy', 'Second Year – Second Semester', 'Practicum 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(314, 'College of Physical Therapy', 'Third Year – First Semester', 'Cardiopulmonary Physical Therapy', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(315, 'College of Physical Therapy', 'Third Year – First Semester', 'Orthopedic Physical Therapy 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(316, 'College of Physical Therapy', 'Third Year – First Semester', 'Pediatric Physical Therapy', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(317, 'College of Physical Therapy', 'Third Year – First Semester', 'Geriatric Rehabilitation', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(318, 'College of Physical Therapy', 'Third Year – First Semester', 'Professional Elective 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(319, 'College of Physical Therapy', 'Third Year – First Semester', 'Ethics', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(320, 'College of Physical Therapy', 'Third Year – Second Semester', 'Orthopedic Physical Therapy 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(321, 'College of Physical Therapy', 'Third Year – Second Semester', 'Neurology and Neurorehabilitation', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(322, 'College of Physical Therapy', 'Third Year – Second Semester', 'Sports Physical Therapy', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(323, 'College of Physical Therapy', 'Third Year – Second Semester', 'Professional Elective 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(324, 'College of Physical Therapy', 'Third Year – Second Semester', 'Practicum 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(325, 'College of Physical Therapy', 'Fourth Year – First Semester', 'Rehabilitation Management', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(326, 'College of Physical Therapy', 'Fourth Year – First Semester', 'Physical Therapy Research', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(327, 'College of Physical Therapy', 'Fourth Year – First Semester', 'Capstone 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(328, 'College of Physical Therapy', 'Fourth Year – First Semester', 'Professional Elective 3', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(329, 'College of Physical Therapy', 'Fourth Year – First Semester', 'Clinical Rotation 1', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(330, 'College of Physical Therapy', 'Fourth Year – Second Semester', 'Clinical Internship (500 hours)', '2026-03-29 21:26:39', '2026-03-29 21:26:39'),
(331, 'College of Physical Therapy', 'Fourth Year – Second Semester', 'Capstone 2', '2026-03-29 21:26:39', '2026-03-29 21:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `grade` decimal(3,2) NOT NULL,
  `semester` varchar(255) DEFAULT NULL,
  `school_year` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"8ef172dc-02c6-480f-bb79-186d7a476837\",\"displayName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\TerminateStudentAccountJob\\\":2:{s:7:\\\"student\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-04-01 08:14:52.567866\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}\",\"batchId\":null},\"createdAt\":1774944892,\"delay\":86400}', 0, NULL, 1775031292, 1774944892),
(2, 'default', '{\"uuid\":\"c402e9b4-d53e-4663-8eda-2e3a4a77e07b\",\"displayName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\TerminateStudentAccountJob\\\":2:{s:7:\\\"student\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-04-01 08:14:57.364797\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}\",\"batchId\":null},\"createdAt\":1774944897,\"delay\":86400}', 0, NULL, 1775031297, 1774944897),
(3, 'default', '{\"uuid\":\"c8c98847-32db-4e2a-a584-30c1be9efb0a\",\"displayName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\TerminateStudentAccountJob\\\":2:{s:7:\\\"student\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-04-01 08:15:14.132409\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}\",\"batchId\":null},\"createdAt\":1774944914,\"delay\":86400}', 0, NULL, 1775031314, 1774944914),
(4, 'default', '{\"uuid\":\"037d6b4e-e540-494b-b9f6-dc7f97faa142\",\"displayName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\TerminateStudentAccountJob\\\":2:{s:7:\\\"student\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-04-01 08:18:37.001111\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}\",\"batchId\":null},\"createdAt\":1774945117,\"delay\":86400}', 0, NULL, 1775031517, 1774945117),
(5, 'default', '{\"uuid\":\"c878df99-ed86-4e96-9262-9d221ff13484\",\"displayName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\TerminateStudentAccountJob\\\":2:{s:7:\\\"student\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-04-01 08:18:42.756136\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}\",\"batchId\":null},\"createdAt\":1774945122,\"delay\":86400}', 0, NULL, 1775031522, 1774945122),
(6, 'default', '{\"uuid\":\"43df5c48-628c-4720-b894-1760ada8f5d7\",\"displayName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\TerminateStudentAccountJob\\\":2:{s:7:\\\"student\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-04-01 08:34:07.576766\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}\",\"batchId\":null},\"createdAt\":1774946047,\"delay\":86400}', 0, NULL, 1775032447, 1774946047),
(7, 'default', '{\"uuid\":\"77cbfc1a-cd0c-4f0f-beb2-6a661784b16c\",\"displayName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\TerminateStudentAccountJob\\\":2:{s:7:\\\"student\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-04-01 08:41:37.171736\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}\",\"batchId\":null},\"createdAt\":1774946497,\"delay\":86400}', 0, NULL, 1775032897, 1774946497),
(8, 'default', '{\"uuid\":\"da651c5f-be05-426b-8422-663705f7ae27\",\"displayName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\TerminateStudentAccountJob\\\":2:{s:7:\\\"student\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-04-01 08:44:32.283701\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}\",\"batchId\":null},\"createdAt\":1774946672,\"delay\":86400}', 0, NULL, 1775033072, 1774946672),
(9, 'default', '{\"uuid\":\"4dc40b24-c2ef-4541-8d95-9f12c77cc6a8\",\"displayName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\TerminateStudentAccountJob\\\":2:{s:7:\\\"student\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-04-01 08:44:58.324164\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}\",\"batchId\":null},\"createdAt\":1774946698,\"delay\":86400}', 0, NULL, 1775033098, 1774946698),
(10, 'default', '{\"uuid\":\"0486545d-842e-4fb9-8a75-4a5f34a6202c\",\"displayName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\TerminateStudentAccountJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\TerminateStudentAccountJob\\\":2:{s:7:\\\"student\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2026-04-01 08:50:10.686476\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}\",\"batchId\":null},\"createdAt\":1774947010,\"delay\":86400}', 0, NULL, 1775033410, 1774947010);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_17_095125_add_role_to_users_table', 1),
(5, '2026_02_17_095721_create_announcements_table', 1),
(6, '2026_02_19_050829_create_applications_table', 1),
(7, '2026_02_19_110946_create_subjects_table', 1),
(8, '2026_02_20_095247_create_requirements_table', 1),
(9, '2026_02_26_103145_add_rejection_reason_to_requirements_table', 1),
(10, '2026_03_12_082720_add_student_fields_to_users_table', 1),
(11, '2026_03_12_090716_drop_name_from_users_table', 1),
(12, '2026_03_14_052145_add_scholarship_name_to_requirements_table', 1),
(13, '2026_03_14_053348_create_grades_table', 2),
(15, '2026_03_14_054213_create_admins_table', 3),
(16, '2026_03_14_054341_create_admins_table', 4),
(17, '2026_03_14_090750_add_user_id_to_announcements_table', 5),
(18, '2026_03_27_141453_add_course_and_year_level_to_users_table', 6),
(19, '2026_03_28_034003_add_profile_photo_to_users_table', 7),
(20, '2026_03_28_120000_add_is_approved_to_users_table', 8),
(21, '2026_03_30_000000_make_department_nullable_in_admins_table', 8),
(22, '2026_03_30_000001_create_curriculums_table', 9),
(23, '2026_03_30_000002_update_announcements_for_targeting', 10),
(24, '2026_03_31_084811_add_termination_at_to_users_table', 11),
(25, '2026_03_31_000000_add_screening_remarks_to_requirements_table', 12),
(26, '2026_03_31_131534_add_screening_at_to_requirements_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `scholastic_record` varchar(255) DEFAULT NULL,
  `scholarship_name` varchar(255) NOT NULL,
  `sponsor` varchar(255) NOT NULL,
  `year_level` varchar(255) NOT NULL,
  `gpa` decimal(3,2) NOT NULL,
  `plan` longtext NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `screening_remarks` text DEFAULT NULL,
  `application_letter` text DEFAULT NULL,
  `application_pdf` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `screening_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`id`, `user_id`, `scholastic_record`, `scholarship_name`, `sponsor`, `year_level`, `gpa`, `plan`, `status`, `screening_remarks`, `application_letter`, `application_pdf`, `created_at`, `updated_at`, `rejection_reason`, `screening_at`) VALUES
(3, 7, 'scholastic_records/qRr97cYe1OlrDBMteXXKvZ8q56n2wsXnWvvyWUza.png', 'Academic Scholar', 'Tomas Claudio Colleges', '3rd Year', 1.58, 'I am writing to express my sincere intention to apply for a scholarship that will support my academic journey and future aspirations. As a dedicated and hardworking student, I have always believed that education is the key to achieving my goals and contributing meaningfully to society.\r\n\r\nCurrently pursuing a degree in Information Technology, I strive to excel in my studies while continuously improving my skills in programming and web development. Despite the challenges that come with being a student, I remain committed to maintaining good academic standing and developing myself both academically and personally. My passion for learning drives me to seek knowledge beyond the classroom and apply it to real-world situations.\r\n\r\nHowever, financial limitations remain one of the biggest challenges I face in continuing my education. This scholarship would not only ease the burden on my family but also allow me to focus more on my studies and further enhance my abilities. It would serve as a strong motivation for me to work even harder and prove that I am worthy of the opportunity given.\r\n\r\nBeyond academics, I aim to use my knowledge and skills to contribute to the development of systems that can help improve efficiency and accessibility in communities. I aspire to become a professional who not only succeeds in his field but also makes a positive impact on others.\r\n\r\nI am determined to make the most out of this opportunity and uphold the values and expectations of the scholarship. With dedication, perseverance, and integrity, I will continue striving for excellence and making my education a tool for a better future.', 'screening', NULL, NULL, NULL, '2026-03-30 00:41:42', '2026-03-31 05:25:09', NULL, '2026-03-31 05:25:09'),
(4, 5, 'scholastic_records/R7DUg9waipX8VblDScpuGXklIQKFW2uhpVsRC8B7.png', 'Marching Band Scholar', 'Tomas Claudio Colleges', '3rd Year', 1.58, 'I am applying for this scholarship with a strong commitment to pursuing my education and achieving my long-term goals. As a student, I have always believed that education is the most powerful tool to improve not only my life but also the lives of others around me. However, financial challenges have made it difficult to fully focus on my studies, which is why this opportunity is very important to me.\r\n\r\nGrowing up, I learned the value of hard work, perseverance, and discipline. These values have shaped my academic journey and motivated me to do my best despite obstacles. I consistently strive to improve my performance and actively participate in school activities that help me grow both academically and personally. My goal is to complete my education and build a stable career that will allow me to support my family and contribute positively to my community.\r\n\r\nReceiving this scholarship would greatly ease the financial burden on my family. It would allow me to focus more on my studies without worrying about expenses such as tuition, materials, and daily needs. More importantly, it would serve as a reminder that my efforts are recognized and that I am capable of achieving greater things.\r\n\r\nIn the future, I aim to use my knowledge and skills to give back to society. I want to become someone who inspires others to pursue their dreams despite difficulties. This scholarship will not only help me reach my goals but also strengthen my determination to succeed.\r\n\r\nI am deeply grateful for your consideration and for providing students like me the opportunity to continue our education and create a better future.', 'pending', NULL, NULL, NULL, '2026-03-31 05:39:07', '2026-03-31 05:39:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('E3xmexfso7YwUVeX54CiQDFeF3J5nsoTy7PwxpyR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYXpWT1Q3S0p5cE03d2pveTZIYXdyQW11dFBNNTFjVDU3Z0EyVmx4TyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1775542922),
('n9aClB9PyEdTmdJDWxHHov5GiLTnZNWSRKCrj9fb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZzlEOUp1TlJsc2hUSnl3enVkV0hwalFNcnV5cWRQTE1yQ1JxdkZlTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775542746),
('q2HJRmT8gefE3fzu9OCazr1aGaUWQ60TqiAgod40', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMlNwc25WbkRLbHMyY2gwZjMzUjJzSU9uV3JCd2ZocFN1bnI5cEVKUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1775742089),
('uJX6qVeBtoEgb6hlNztQCGUxhaMSYP4fk8X0IkMc', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibDRkNEdNalRVVHl5cjBjbTVPVVQzakVYSG1LZm5BVlpWd1dQUmpKViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdHVkZW50L2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czoxNzoic3R1ZGVudC5kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3O30=', 1775543682),
('VCcxkfWTA1LUlZk1KYr56VLCl92ZEItvunmBrBbn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2t1aWRtZFJBczlkcnJCdFQ5WFlNRVdGYWRhNmpOV1F3RmtBMDhDaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czoyNzoiZ2VuZXJhdGVkOjo4REticWJJaUR2b0xEbHZpIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775749824),
('xFj2pVYlCB3mQut8qewJUsRdVmLWVPPIzA7dXE2o', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ2NxNzBqeWxrbUhndzU4SEQ3dHhZTXBsSXFERDUyVVFMZjhwNmxNTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czoyNzoiZ2VuZXJhdGVkOjo4REticWJJaUR2b0xEbHZpIjt9fQ==', 1775750011),
('Y6DcTO7UhuaVEzIdb1lDybvkwz6gLTDfG0RWxEf3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMlNDWHM0eVpWS3JDa3RMQjVjY0hKWVlFUEhmVlRFdE1GSHZqZjlxayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czoyNzoiZ2VuZXJhdGVkOjo4REticWJJaUR2b0xEbHZpIjt9fQ==', 1775750018);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `student_number` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_level` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'student',
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `termination_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `student_number`, `course`, `year_level`, `profile_photo`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `is_approved`, `termination_at`) VALUES
(5, 'Jhezz Louise', 'G.', 'Licudan', '2021-00038', 'College of Education and Liberal Arts', '3rd Year', NULL, 'jhelolicudan16@gmail.com', NULL, '$2y$12$qbDRVdnwE4G6RgNpCuoMgehfubDX81wSxX7XOgXzZLE/NPNLnzya.', NULL, '2026-03-27 21:22:55', '2026-03-27 21:34:50', 'student', 1, NULL),
(6, 'Gerald', 'P.', 'Baldogo', '2023-00663', 'College of Criminology', '3rd Year', 'profile-photos/vX3H6KUFh21miJuS5RlHwRZyfDonF3aTJPPCIC22.jpg', 'gerald@gmail.com', NULL, '$2y$12$qiyqqiQOnmX/9lArsCW0euZ7W3GTVpLnP5FLnAcxVMcJRLwlC2sFG', NULL, '2026-03-27 23:25:38', '2026-03-27 23:30:10', 'student', 1, NULL),
(7, 'Aaron', 'F.', 'Pineda', '2023-00062', 'College of Computer Studies', '3rd Year', 'profile-photos/M1u3AOzkQp4BKOX2ONGJJvVrGOhayBICduIDjLuj.jpg', 'fragoaaron@gmail.com', NULL, '$2y$12$TSK//26faDmdqSW2dWpZrOzX6wZrBfKb/L/wVB9uplX1yyY31px2S', NULL, '2026-03-29 20:01:06', '2026-03-30 23:13:42', 'student', 1, NULL),
(9, 'Andrei', 'S.', 'Gonzales', '2021-00062', 'College of Hospitality Management', '3rd Year', NULL, 'gonzalesandrei9224@gmail.com', NULL, '$2y$12$Qp7cVxn6Pi0xvwC4AtB5Au8pgYQETq1glI80t8iJnazIZOrolIEkW', NULL, '2026-03-30 21:22:14', '2026-03-31 00:52:31', 'student', 1, NULL),
(10, 'Roy', 'N.', 'Mandreza', '2023-01096', 'College of Nursing', '3rd Year', NULL, 'zekielyvelxerion@gmail.com', NULL, '$2y$12$AKPIltu4TrHsM5D5lwzImeZl9qHKwq/5WwMKiaW0vK0WUrDs/IK1S', NULL, '2026-03-30 23:30:01', '2026-03-31 00:50:10', 'student', 0, '2026-04-01 00:50:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcements_user_id_foreign` (`user_id`),
  ADD KEY `announcements_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applications_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `curriculums`
--
ALTER TABLE `curriculums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curriculums_department_semester_index` (`department`,`semester`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grades_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requirements_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_student_number_unique` (`student_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `curriculums`
--
ALTER TABLE `curriculums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `announcements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requirements`
--
ALTER TABLE `requirements`
  ADD CONSTRAINT `requirements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
