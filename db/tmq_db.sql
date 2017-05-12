-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2017 at 10:11 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tmq`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(25) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'testCategory'),
(2, 'IT'),
(3, 'Writing'),
(4, 'HR'),
(5, 'Security');

-- --------------------------------------------------------

--
-- Table structure for table `member_details`
--

CREATE TABLE `member_details` (
  `pk_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `team` varchar(50) NOT NULL,
  `position` varchar(80) NOT NULL,
  `settings` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_details`
--

INSERT INTO `member_details` (`pk_id`, `user_id`, `username`, `team`, `position`, `settings`) VALUES
(13, 25, 'user1', 'TWQ', 'Web dev', 'clock'),
(14, 26, 'William_Shakespeare', 'TWQ', 'Content Writer', 'both'),
(15, 27, 'Dendy', 'Asian', 'Game dev', 'clock'),
(16, 28, 'James123', 'Rocket', 'Web dev', 'both');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `task_name` varchar(50) NOT NULL,
  `task_desc` varchar(50) NOT NULL,
  `estimated_date` date NOT NULL,
  `estimated_time` text NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `user_id`, `category_id`, `task_name`, `task_desc`, `estimated_date`, `estimated_time`, `type`, `status`) VALUES
(2, 26, 4, 'new HR task', '', '2017-05-24', '17:00', 'timer', 0),
(3, 25, 4, 'another one', '', '0000-00-00', '00:00:00', '', 0),
(4, 25, 4, 'and another', '', '0000-00-00', '00:00:00', '', 0),
(5, 28, 2, 'program', '', '2017-05-09', '01:00', 'clock', 0),
(6, 28, 3, 'Write ebook', 'clock', '2017-05-30', '01:30:22', 'timer', 2);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(25) NOT NULL,
  `team_name` varchar(30) NOT NULL,
  `team_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `team_description`) VALUES
(1, 'TWQ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer elit dolor, convallis vel dui ut, maximus hendrerit sem. Sed finibus venenatis ipsum, sed tristique nisl egestas consectetur. Fusce condimentum pharetra risus ac pellentesque. Sed lobortis gravida sagittis. Curabitur tristique enim porttitor p'),
(2, 'Rocket', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer elit dolor, convallis vel dui ut, maximus hendrerit sem. Sed finibus venenatis ipsum, sed tristique nisl egestas consectetur. Fusce condimentum pharetra risus ac pellentesque. Sed lobortis gravida sagittis. Curabitur tristique enim porttitor p'),
(4, 'black', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer elit dolor, convallis vel dui ut, '),
(5, 'Asian', 'asdfasdfasdf'),
(6, 'Blue', 'jfalksdjfl asdf asdf asdf '),
(9, 'newTeam', 'sdf sdfsdf ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `privilege` tinyint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `privilege`) VALUES
(1, 'admin', 'admin', 1),
(25, 'user1', 'user1', 2),
(26, 'William_Shakespeare', 'POyuLm', 2),
(27, 'Dendy', 'swdzuU', 2),
(28, 'James123', '8D8tpJ', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `member_details`
--
ALTER TABLE `member_details`
  ADD PRIMARY KEY (`pk_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `member_details`
--
ALTER TABLE `member_details`
  MODIFY `pk_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
