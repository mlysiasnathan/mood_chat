-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2022 at 11:55 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mood`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message` text CHARACTER SET utf8mb4 NOT NULL,
  `opened` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`chat_id`, `from_id`, `to_id`, `message`, `opened`, `created_at`) VALUES
(1, 4, 1, 'salut', 1, '2022-10-21 16:42:49'),
(2, 1, 2, 'Hey', 0, '2022-11-05 20:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `conversation_id` int(11) NOT NULL,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`conversation_id`, `user_1`, `user_2`) VALUES
(1, 4, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `forgotpwd`
--

CREATE TABLE `forgotpwd` (
  `forgotpwd_id` int(11) NOT NULL,
  `reset_email` varchar(100) NOT NULL,
  `reset_selector` varchar(255) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `reset_expires` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `names` varchar(200) NOT NULL,
  `email` varchar(70) NOT NULL,
  `bday` varchar(20) NOT NULL,
  `role` text NOT NULL DEFAULT 'user',
  `img` varchar(30) NOT NULL DEFAULT 'user.jpg',
  `last_seen` datetime NOT NULL DEFAULT current_timestamp(),
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `names`, `email`, `bday`, `role`, `img`, `last_seen`, `password`) VALUES
(1, 'Lysias MHD', 'user@g.c', '2022-10-21', 'user', 'Lysias MHD.jpg', '2022-11-05 20:41:27', '$2y$10$Ofp8GOVlzX16dovhRO4GIeIUP0ILd4SfRswtrPOSWDFyB22HzBrk6'),
(2, 'King Joe', 'joe@g.c', '2022-10-21', 'user', 'user.jpg', '2022-10-21 15:48:10', '$2y$10$XET2ffhMynm8R2mcZj8rMOZpml9zdL692mU74n8k9O8lqKWk22k/.'),
(3, 'Sasuke Uchiha', 'sas@g.c', '2022-10-21', 'user', 'Sasuke Uchiha.jpg', '2022-10-21 15:53:15', '$2y$10$9hMdAV2okAEWsaOFTmX7guaF9BrSkRl4UIjaWRLV40qaTOtnx6N0W'),
(4, 'Madara Uchiha', 'mad@g.c', '2022-10-21', 'user', 'user.jpg', '2022-10-21 18:00:48', '$2y$10$y.5DPBQgC8LhsLK76KE1yOYQoUE7w.ZcCW7wWfmayC0dz/wV2sTDi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Indexes for table `forgotpwd`
--
ALTER TABLE `forgotpwd`
  ADD PRIMARY KEY (`forgotpwd_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `forgotpwd`
--
ALTER TABLE `forgotpwd`
  MODIFY `forgotpwd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
