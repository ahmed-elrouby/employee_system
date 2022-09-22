-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 22, 2022 at 09:13 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `employee_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `description`, `start_date`, `end_date`, `employee_id`, `created_at`, `updated_at`, `status`) VALUES
(3, 'Comment&Chat', 'You Should Make Comment Tasks', '2021-09-07', '2021-09-26', 1, '2022-09-21 11:36:22', '2022-09-21 11:36:22', 1),
(4, 'Post', 'All Emmployee Make one Task in Post', '2022-09-14', '2022-09-20', 1, '2022-09-21 10:24:21', '2022-09-21 10:24:21', 1),
(6, 'Share', 'Share Knowledge with our friends', '2022-10-08', '2022-10-07', 1, '2022-09-21 13:18:35', '2022-09-21 13:18:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `empolyee_task` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `name`, `description`, `empolyee_task`, `start_date`, `end_date`, `created_at`, `updated_at`, `employee_id`, `project_id`, `status`) VALUES
(1, 'chat 1.1', 'make some note in chat task', '', '2022-09-02', '2022-09-16', '2022-09-21 14:47:13', '2022-09-21 14:47:13', 4, 3, 1),
(5, 'Changing Title', 'change name in chat app 11', 'ok', '2022-09-24', '2022-09-03', '2022-09-21 18:28:19', '2022-09-21 18:28:19', 2, 3, 1),
(6, 'take exam', 'enter to organization web site and take exam', 'I take exam and it is very well', '2022-09-01', '2022-09-02', '2022-09-21 19:00:14', '2022-09-21 19:00:14', 2, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `code` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `image`, `status`, `code`, `created_at`, `updated_at`, `verified_at`, `is_admin`) VALUES
(1, 'ahmed', 'elrouby@gmail.com', '@Aa12345', 'default.jpg', 1, 34560, '2022-09-20 15:50:15', '2022-09-20 15:50:15', NULL, 1),
(2, 'ali', 'ali@gmail.com', '@Aa12345', 'default.jpg', 1, 45645, '2022-09-21 13:20:23', '2022-09-21 13:20:23', '2021-10-15 10:30:35', 0),
(4, 'sayed', 'sayed@gmail.com', '@Bb12345', 'default.jpg', 1, 46544, '2022-09-21 15:33:04', '2022-09-21 15:33:04', '2021-10-15 10:30:35', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Supervisor_Create_Project` (`employee_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assign_employee_task` (`employee_id`),
  ADD KEY `assign_task_project` (`project_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `Supervisor_Create_Project` FOREIGN KEY (`employee_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `assign_employee_task` FOREIGN KEY (`employee_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `assign_task_project` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
