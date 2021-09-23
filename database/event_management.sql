-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2021 at 06:03 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `event_list`
--

CREATE TABLE `event_list` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `recurrence` tinyint(2) NOT NULL DEFAULT 0 COMMENT '1=>Repeat;2=>Repeat on the',
  `added_on` varchar(255) DEFAULT NULL,
  `updated_on` varchar(255) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0=>inactive;1=>active;2=>delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `event_repeat`
--

CREATE TABLE `event_repeat` (
  `id` int(11) NOT NULL,
  `recurence_id` int(11) NOT NULL DEFAULT 0,
  `repeat_every_id` int(11) NOT NULL DEFAULT 0,
  `repeat_day_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `event_repeat_on_the`
--

CREATE TABLE `event_repeat_on_the` (
  `id` int(11) NOT NULL,
  `recurence_id` int(11) NOT NULL DEFAULT 0,
  `repeat_on_the_count_id` int(11) NOT NULL DEFAULT 0,
  `repeat_on_the_week_id` int(11) NOT NULL DEFAULT 0,
  `repeat_on_the_year_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `repeat_day`
--

CREATE TABLE `repeat_day` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repeat_day`
--

INSERT INTO `repeat_day` (`id`, `name`) VALUES
(1, 'Day'),
(2, 'Week'),
(3, 'Month'),
(4, 'Year');

-- --------------------------------------------------------

--
-- Table structure for table `repeat_every`
--

CREATE TABLE `repeat_every` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repeat_every`
--

INSERT INTO `repeat_every` (`id`, `name`) VALUES
(1, 'Every'),
(2, 'Every Other'),
(3, 'Every Third'),
(4, 'Every Fourth');

-- --------------------------------------------------------

--
-- Table structure for table `repeat_on_the_count`
--

CREATE TABLE `repeat_on_the_count` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repeat_on_the_count`
--

INSERT INTO `repeat_on_the_count` (`id`, `name`) VALUES
(1, 'First'),
(2, 'Second'),
(3, 'Third'),
(4, 'Fourth');

-- --------------------------------------------------------

--
-- Table structure for table `repeat_on_the_week`
--

CREATE TABLE `repeat_on_the_week` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repeat_on_the_week`
--

INSERT INTO `repeat_on_the_week` (`id`, `name`) VALUES
(1, 'Sun'),
(2, 'Mon'),
(3, 'Tue'),
(4, 'Wed'),
(5, 'Thu'),
(6, 'Fri'),
(7, 'Sat');

-- --------------------------------------------------------

--
-- Table structure for table `repeat_on_the_year`
--

CREATE TABLE `repeat_on_the_year` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repeat_on_the_year`
--

INSERT INTO `repeat_on_the_year` (`id`, `name`) VALUES
(1, 'Month'),
(2, '3 Months'),
(3, '4 Months'),
(4, '6 Months'),
(5, 'Year');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event_list`
--
ALTER TABLE `event_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_repeat`
--
ALTER TABLE `event_repeat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_repeat_on_the`
--
ALTER TABLE `event_repeat_on_the`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repeat_day`
--
ALTER TABLE `repeat_day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repeat_every`
--
ALTER TABLE `repeat_every`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repeat_on_the_count`
--
ALTER TABLE `repeat_on_the_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repeat_on_the_week`
--
ALTER TABLE `repeat_on_the_week`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repeat_on_the_year`
--
ALTER TABLE `repeat_on_the_year`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event_list`
--
ALTER TABLE `event_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_repeat`
--
ALTER TABLE `event_repeat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_repeat_on_the`
--
ALTER TABLE `event_repeat_on_the`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repeat_day`
--
ALTER TABLE `repeat_day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `repeat_every`
--
ALTER TABLE `repeat_every`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `repeat_on_the_count`
--
ALTER TABLE `repeat_on_the_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `repeat_on_the_week`
--
ALTER TABLE `repeat_on_the_week`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `repeat_on_the_year`
--
ALTER TABLE `repeat_on_the_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
