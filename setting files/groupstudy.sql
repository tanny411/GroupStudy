-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2018 at 08:30 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `groupstudy`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `group_id`, `user_id`, `username`, `text`, `timestamp`) VALUES
(54, 16, 22, 'panshi', 'hiritesh', '2018-07-22 15:08:20'),
(55, 16, 18, 'tanny411', 'hi', '2018-07-25 15:18:11'),
(56, 16, 18, 'tanny411', 'sja9a', '2018-07-25 15:18:15'),
(57, 19, 18, 'tanny411', 'ayhsa', '2018-08-14 05:52:58'),
(58, 19, 24, 'aa', 'ok', '2018-08-14 05:53:11'),
(59, 16, 18, 'tanny411', 'hi', '2018-08-14 06:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `group_id`, `file_id`, `user_id`, `comment`, `timestamp`) VALUES
(3, 16, 177, 20, 'dibaniba?', '2018-07-22 15:37:56'),
(4, 18, 180, 18, 'okay paisi', '2018-08-14 02:06:35'),
(5, 16, 185, 18, 'welcome ayesha', '2018-08-14 06:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `post` varchar(10000) NOT NULL,
  `file_name` varchar(30) NOT NULL,
  `file_type` varchar(30) NOT NULL,
  `folder` varchar(30) NOT NULL DEFAULT 'root',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `user_id`, `group_id`, `post`, `file_name`, `file_type`, `folder`, `timestamp`) VALUES
(176, 22, 16, 'okay babe', '', '', 'root', '2018-07-22 15:08:11'),
(177, 22, 16, 'ida', '', '', 'root', '2018-07-22 15:35:04'),
(178, 20, 16, 'lol', '', '', 'root', '2018-07-22 15:37:59'),
(179, 20, 16, 'ok', '', '', 'root', '2018-07-22 15:40:43'),
(180, 18, 18, '', 'mouse.pdf', 'pdf', 'aysha', '2018-08-14 02:06:28'),
(181, 18, 16, 'Project!', 'mouse.pdf', 'pdf', 'aysha', '2018-08-14 04:30:36'),
(182, 18, 16, 'today is database submission!!!\r\n', '', '', 'root', '2018-08-14 04:31:39'),
(183, 18, 19, 'Newpost', 'mouse.pdf', 'pdf', 'cse', '2018-08-14 05:41:31'),
(184, 24, 19, 'anythikng', '', '', 'root', '2018-08-14 05:53:50'),
(185, 18, 16, 'i am new here\r\n', '', '', 'root', '2018-08-14 06:13:20'),
(186, 18, 16, '', 'WIN_20180625_18_25_57_Pro.jpg', 'jpg', 'root', '2018-08-14 06:14:06'),
(187, 18, 16, 'aysha is awesome', '', '', 'root', '2018-08-14 06:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `folder`
--

CREATE TABLE `folder` (
  `group_id` int(11) NOT NULL,
  `folder` varchar(30) NOT NULL,
  `parent` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `folder`
--

INSERT INTO `folder` (`group_id`, `folder`, `parent`) VALUES
(16, 'aysha', 'root'),
(18, 'aysha', 'root'),
(19, 'cse', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `validity` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `board_pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `validity`, `board_id`, `pass`, `board_pass`) VALUES
(16, 'cse15', 'study group 1', 12, 3887799, '15', 'vUXdkK'),
(17, 'hu', 'aa', 1, 3899281, 'as', 'Np52sZ'),
(18, 'okay done!', 'alright i will', 3, 3909919, 'admin', 'ZCBc2D'),
(19, 'newGroup', 'desc', 1, 3910016, 'admin', '3Z11lk');

-- --------------------------------------------------------

--
-- Table structure for table `invites`
--

CREATE TABLE `invites` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `group_id` int(11) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invites`
--

INSERT INTO `invites` (`id`, `username`, `group_id`, `msg`) VALUES
(1, 'panshi', 17, 'ayiino'),
(3, 'paul', 18, 'Please join our group!');

-- --------------------------------------------------------

--
-- Table structure for table `notifs`
--

CREATE TABLE `notifs` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `file_id` int(11) NOT NULL,
  `com_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifs`
--

INSERT INTO `notifs` (`id`, `group_id`, `user_id`, `type`, `file_id`, `com_no`) VALUES
(123, 19, 19, 'post', 184, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `group_id` int(11) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`group_id`, `tag`, `file_id`) VALUES
(18, 'aysha', 180),
(19, 'dbms', 183),
(16, 'hide', 171),
(16, 'mim', 187),
(16, 'mouse', 181);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Firstname` varchar(30) DEFAULT NULL,
  `Lastname` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `PhoneNumber` int(11) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Gender` varchar(20) DEFAULT NULL,
  `Institution` varchar(100) DEFAULT NULL,
  `Country` varchar(20) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `pic` varchar(30) NOT NULL DEFAULT 'defaultpp.jpg',
  `Aboutme` varchar(1000) NOT NULL DEFAULT '<i>No information supplied</i>',
  `facebook` varchar(1000) NOT NULL,
  `linkedin` varchar(1000) NOT NULL,
  `github` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Username`, `Firstname`, `Lastname`, `email`, `PhoneNumber`, `DOB`, `Gender`, `Institution`, `Country`, `Password`, `pic`, `Aboutme`, `facebook`, `linkedin`, `github`) VALUES
(18, 'tanny411', 'Aisha', 'Khatun', 'aysha.kamal7@gmail.com', 2147483647, '2018-07-18', 'female', 'SUST', 'Mars', 'd784a8a4d86c2face8d6b8833723750f', 'tanny411.png', 'I am a student in Shahjalal University of science and technology, 20105331042', '', '', 'https://github.com/tanny411'),
(19, 'arek', 'Keu Ek', 'Jon', 'joi@koi.com', 6785, '2018-07-22', 'male', 'Blekh', 'Qatar', '0cc175b9c0f1b6a831c399e269772661', 'defaultpp.jpg', '<i>No information supplied</i>', '', '', ''),
(20, 'paul', 'Aisha', 'ahmed', 'aysha.kamal7@gmail.com', 0, '0000-00-00', 'other', '', '', '0cc175b9c0f1b6a831c399e269772661', 'defaultpp.jpg', '<i>No information supplied</i>', '', '', ''),
(22, 'panshi', 'a', 'a', 'aysha.kamal7@gmail.com', 0, '0000-00-00', 'other', '', '', '0cc175b9c0f1b6a831c399e269772661', 'defaultpp.jpg', '<i>No information supplied</i>', '', '', ''),
(23, 'polashnai', 'a', 'a', 'aysha.kamal7@gmail.com', 0, '0000-00-00', 'other', '', '', 'd784a8a4d86c2face8d6b8833723750f', 'defaultpp.jpg', '<i>No information supplied</i>', '', '', ''),
(24, 'aa', 'aisha', 'khatun', 'aysha.kamal7@gmail.com', 0, '0000-00-00', 'other', '', '', '0cc175b9c0f1b6a831c399e269772661', 'defaultpp.jpg', '<i>No information supplied</i>', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `offline` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`user_id`, `group_id`, `offline`) VALUES
(18, 16, 1),
(18, 18, 1),
(18, 19, 0),
(19, 16, 1),
(19, 17, 1),
(19, 19, 1),
(23, 17, 1),
(24, 19, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `time` (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `folder`
--
ALTER TABLE `folder`
  ADD PRIMARY KEY (`group_id`,`folder`,`parent`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invites`
--
ALTER TABLE `invites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifs`
--
ALTER TABLE `notifs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag`,`file_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `invites`
--
ALTER TABLE `invites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifs`
--
ALTER TABLE `notifs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
