-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2024 at 12:25 PM
-- Server version: 10.11.6-MariaDB-2
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aid`
--

-- --------------------------------------------------------

--
-- Table structure for table `Complaints`
--

CREATE TABLE `Complaints` (
  `complaint_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `admin_response` text DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  `date_responded` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Complaints`
--

INSERT INTO `Complaints` (`complaint_id`, `user_id`, `subject`, `description`, `status`, `admin_response`, `date_created`, `date_responded`) VALUES
(1, 1, 'Issue with First Aid module', 'Encountered errors while accessing the First Aid Basics module.', 'Open', NULL, '2024-04-23 22:50:49', NULL),
(2, 1, 'nnnnn', 'mmmmmmm', NULL, NULL, '2024-04-25 19:12:10', NULL),
(3, 1, 'ddddddddd', 'dddddddddddddd', NULL, NULL, '2024-04-25 19:13:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Modules`
--

CREATE TABLE `Modules` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `module_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Modules`
--

INSERT INTO `Modules` (`module_id`, `module_name`, `description`, `module_file`) VALUES
(3, 'First Aid Basics', 'Introduction to basic first aid techniques.', 'first_aid_basics.pdf'),
(4, 'Fire Safety Training', 'Training on fire prevention and safety measures.', 'fire_safety_training.ppt'),
(13, 'nnnnnnnnnnnnn', 'nnnnnnnnn', 'uploads/user_details.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `Roles`
--

CREATE TABLE `Roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Roles`
--

INSERT INTO `Roles` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `email`, `password`, `first_name`, `last_name`, `role_id`) VALUES
(1, 'john@example.com', '88e476566a43beea190852f78b93723a', 'John', 'Doe', 2),
(2, 'admin@maseno.ac.ke', '88e476566a43beea190852f78b93723a', 'Admin', 'User', 1),
(8, 'Maseno@20', 'c360aba35c84df365e6685ce77446291', 'Maseno@20249', 'Maseno@2029', 2),
(9, 'Maseno@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Maseno@gmail.com', 'Maseno@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Complaints`
--
ALTER TABLE `Complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `fk_user_complaint` (`user_id`);

--
-- Indexes for table `Modules`
--
ALTER TABLE `Modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `role_id_2` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Complaints`
--
ALTER TABLE `Complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Modules`
--
ALTER TABLE `Modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Roles`
--
ALTER TABLE `Roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Complaints`
--
ALTER TABLE `Complaints`
  ADD CONSTRAINT `fk_user_complaint` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `Roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
