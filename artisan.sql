-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 30, 2024 at 08:12 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artisan`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `username`, `comment`, `created_at`) VALUES
(80, 5, 'toasty genie', 'username update', '2024-04-26 14:20:59'),
(81, 5, 'Shadman Sakib', 'username update 1', '2024-04-26 14:23:25'),
(83, 9, 'toasty genie', 'updated ui', '2024-05-04 14:27:14'),
(84, 9, 'tester1', 'new change', '2024-05-04 16:40:00'),
(89, 9, 'toasty genie', 'test', '2024-05-04 18:57:21'),
(90, 9, 'toasty genie', 'realtime update\r\n', '2024-05-04 18:57:44'),
(91, 9, 'toasty genie', '2', '2024-05-04 19:00:27'),
(92, 9, 'Shadman Sakib', 'checking realtime for both users', '2024-05-04 19:01:39'),
(93, 8, 'toasty genie', 'test', '2024-05-04 19:18:18'),
(94, 9, 'Shadman Sakib', 'its done, 5s interval', '2024-05-04 19:18:59'),
(95, 8, 'toasty genie', 'no u', '2024-05-04 19:21:23'),
(96, 8, 'toasty genie', '5s?', '2024-05-04 19:23:21'),
(97, 8, 'toasty genie', '10s?\r\n', '2024-05-04 19:24:15'),
(98, 4, 'toasty genie', 'new', '2024-05-04 19:25:17'),
(100, 9, 'toasty genie', 'fetching is bugged', '2024-05-04 20:10:46'),
(101, 8, 'toasty genie', 'a', '2024-05-05 12:33:08'),
(103, 4, 'toasty genie', '123', '2024-05-05 13:17:08'),
(104, 4, 'toasty genie', '456', '2024-05-05 13:23:04'),
(105, 4, 'toasty genie', '789', '2024-05-05 13:23:18'),
(106, 9, 'toasty genie', 'fixed', '2024-05-10 17:24:51'),
(107, 9, 'tester1', 'refresh btn check', '2024-05-10 17:29:02'),
(108, 9, 'tester1', 'clear form check', '2024-05-10 17:40:01'),
(109, 9, 'tester1', 'check 2', '2024-05-10 17:43:49'),
(110, 5, 'tester1', 'check', '2024-05-10 17:44:31'),
(111, 4, 'tester1', '101112', '2024-05-10 17:49:48'),
(112, 4, 'tester1', '131415', '2024-05-10 17:51:27'),
(113, 4, 'toasty genie', '161718', '2024-05-10 17:51:44'),
(114, 9, 'tester1', 'check3', '2024-05-10 17:57:50'),
(115, 4, 'toasty genie', '1', '2024-05-10 17:59:52'),
(116, 4, 'toasty genie', '2', '2024-05-10 18:04:49'),
(117, 4, 'toasty genie', '3', '2024-05-10 18:05:47'),
(118, 4, 'toasty genie', '4', '2024-05-10 18:07:14'),
(119, 4, 'tester1', '5', '2024-05-10 18:08:39'),
(120, 4, 'tester1', '6', '2024-05-10 18:09:20'),
(121, 4, 'toasty genie', '7', '2024-05-10 18:14:12'),
(122, 4, 'toast', 'hi', '2024-05-12 17:56:51'),
(123, 9, 'Sakib Shadman', 'final checks', '2024-05-26 19:55:12'),
(124, 9, 'Shadman Sakib', 'desc', '2024-05-26 20:48:25'),
(125, 9, 'Shadman Sakib', 'desc sub', '2024-05-26 20:48:54'),
(126, 9, 'Shadman Sakib', 'test 3', '2024-05-26 20:49:54'),
(127, 9, 'Sakib Shadman', 'new', '2024-05-26 20:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE `commission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `verification_code` varchar(32) NOT NULL,
  `verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commission`
--

INSERT INTO `commission` (`id`, `name`, `email`, `description`, `submission_date`, `verification_code`, `verified`) VALUES
(6, 'toasty genie', 'toastthegenie@gmail.com', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available. It is also used to temporarily replace text in a process called greeking, which allows designers to consider the form of a webpage or publication, without the meaning of the text influencing the design.', '2024-05-12 20:08:45', '', 0),
(14, 'Shadman Sakib', 'shadman.sakib11@northsouth.edu', 'test 12', '2024-05-28 15:11:34', '06f9396397e6d1c291094c9453a4b4d8', 0),
(15, 'tester1', 'sadmansakib10000@gmail.com', 'test 13', '2024-05-28 15:13:40', '79fe3b7b1e0f3f44cf97706d72ff78b3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `email`, `subscribed_at`, `verified`) VALUES
(1, 'sadmansakib10000@gmail.com', '2024-05-30 05:47:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `access` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `upload_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `access`, `image_url`, `upload_time`) VALUES
(4, 'test', 'testing 123', 'public', 'uploads/ai.jpg', '2024-04-21 14:58:06'),
(5, 'test 2', 'testing 456', 'exclusive', 'uploads/ai1.png', '2024-04-21 15:05:08'),
(7, 'Test 4', 'lorem ispum...', 'exclusive', 'uploads/3.png', '2024-04-22 06:25:30'),
(8, 'Test 5', 'testing changes', 'public', 'uploads/4.png', '2024-04-22 06:30:33'),
(9, 'Demo', 'Lorem', 'public', 'uploads/6.jpeg', '2024-04-22 08:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `subs`
--

CREATE TABLE `subs` (
  `username` varchar(255) NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subs`
--

INSERT INTO `subs` (`username`, `end_date`) VALUES
('toasty genie', '2025-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `tips`
--

CREATE TABLE `tips` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `tip` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tips`
--

INSERT INTO `tips` (`id`, `username`, `tip`, `created_at`) VALUES
(1, 'toasty genie', '100.00', '2024-05-12 14:42:09'),
(2, 'toasty genie', '50.00', '2024-05-12 14:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `user_type`) VALUES
('Sakib Shadman', 'sakib123@gmail.com', '$2y$10$Cgtl1DyoZatwPDBAqQ2DuOeTP8iPxTXsYLOybwfCikNM3m5xqqt22', 0),
('Shadman Sakib', 'shadman.sakib11@northsouth.edu', '$2y$10$cGZiXMy9eL8C6nDRIoRlDuHiw.Lm6Ja5xd42tLycdjMJPDKP4FBY2', 2),
('tester1', 'sadmansakib@gmail.com', '$2y$10$8kgSfVtP/79dBo4qjAY7NuT6uLDk1KJmfEdD9wQmMhFYg47K5mBmq', 0),
('toasty genie', 'toastthegenie@gmail.com', '$2y$10$4jikWJaunIBw6//fs3NzK.8sMfE.yzi2QPCg/7J0tPZD/r6PPR/1i', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subs`
--
ALTER TABLE `subs`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tips`
--
ALTER TABLE `tips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tips`
--
ALTER TABLE `tips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subs`
--
ALTER TABLE `subs`
  ADD CONSTRAINT `subs_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `tips`
--
ALTER TABLE `tips`
  ADD CONSTRAINT `tips_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
