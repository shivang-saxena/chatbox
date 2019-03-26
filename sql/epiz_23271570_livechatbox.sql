-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql307.epizy.com
-- Generation Time: Mar 25, 2019 at 07:46 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `epiz_23271570_livechatbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `parent_comment_id`, `user_id`, `post_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 3, 'Hey Harsh!', '2019-01-21 17:55:26', '0000-00-00 00:00:00'),
(2, 0, 1, 4, 'This is a great place.', '2019-01-22 11:19:14', '0000-00-00 00:00:00'),
(3, 0, 1, 6, 'Hey buddy...', '2019-02-14 19:11:46', '0000-00-00 00:00:00'),
(4, 0, 1, 8, 'great~', '2019-03-10 09:39:10', '0000-00-00 00:00:00'),
(5, 0, 22, 11, 'same here', '2019-03-11 08:08:12', '0000-00-00 00:00:00'),
(6, 0, 22, 10, 'Thanks Rajesh  (;', '2019-03-11 08:19:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `time` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`c_id`),
  KEY `user_one` (`user_one`),
  KEY `user_two` (`user_two`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`c_id`, `user_one`, `user_two`, `ip`, `time`) VALUES
(1, 3, 1, '172.68.162.19', '23:15:33 01/21/2019'),
(2, 5, 1, '172.69.130.79', '23:18:44 01/21/2019'),
(3, 2, 3, '172.68.162.43', '16:38:19 01/26/2019'),
(4, 14, 1, '172.68.144.250', '18:58:14 02/06/2019'),
(5, 21, 1, '172.69.134.174', '18:00:55 02/09/2019'),
(6, 11, 1, '172.68.146.17', '02:33:20 02/13/2019'),
(7, 6, 1, '141.101.88.193', '22:40:58 02/14/2019'),
(8, 2, 1, '108.162.229.151', '00:40:38 02/15/2019'),
(9, 5, 3, '141.101.69.12', '23:44:22 02/17/2019'),
(10, 1, 22, '162.158.165.143', '16:43:12 02/21/2019'),
(11, 1, 23, '162.158.165.13', '17:44:08 02/27/2019'),
(12, 1, 25, '141.101.88.133', '13:18:00 03/11/2019'),
(13, 25, 22, '108.162.229.7', '13:31:02 03/11/2019'),
(14, 26, 22, '141.101.88.133', '13:40:06 03/11/2019'),
(15, 1, 29, '172.68.146.215', '17:04:27 03/25/2019');

-- --------------------------------------------------------

--
-- Table structure for table `conversation_reply`
--

CREATE TABLE IF NOT EXISTS `conversation_reply` (
  `cr_id` int(11) NOT NULL AUTO_INCREMENT,
  `reply` text,
  `user_id_fk` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `date` varchar(30) NOT NULL,
  `c_id_fk` int(11) NOT NULL,
  PRIMARY KEY (`cr_id`),
  KEY `c_id_fk` (`c_id_fk`),
  KEY `user_id_fk` (`user_id_fk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `conversation_reply`
--

INSERT INTO `conversation_reply` (`cr_id`, `reply`, `user_id_fk`, `ip`, `time`, `date`, `c_id_fk`) VALUES
(1, 'Hy Shivang!', 3, '172.68.162.19', '23:15:44', '01/21/2019', 1),
(2, 'Hello!', 1, '172.68.162.19', '23:18:51', '01/21/2019', 2),
(3, 'How are you buddy!', 1, '172.68.162.43', '23:19:06', '01/21/2019', 2),
(4, 'Hh', 5, '172.69.130.91', '23:19:43', '01/21/2019', 2),
(6, 'Hey Alia', 3, '172.68.162.25', '23:30:04', '01/21/2019', 1),
(7, 'joy', 1, '172.68.144.166', '16:49:03', '01/22/2019', 1),
(8, 'Uhhh', 1, '172.68.144.160', '14:52:20', '01/24/2019', 2),
(9, 'Ygrd', 3, '172.69.135.13', '14:29:21', '01/25/2019', 1),
(10, 'Helllo Alia!', 2, '172.68.162.19', '16:38:43', '01/26/2019', 3),
(11, 'hello', 1, '172.68.162.19', '19:26:31', '01/26/2019', 1),
(12, 'Hy Buddy!', 14, '162.158.167.57', '18:58:27', '02/06/2019', 4),
(13, 'Ya ! I am good...', 1, '141.101.88.193', '18:59:50', '02/06/2019', 4),
(14, 'Khare ji', 1, '172.69.226.104', '18:02:44', '02/09/2019', 5),
(15, 'jjjjj', 1, '141.101.88.193', '21:41:36', '02/13/2019', 1),
(16, 'hh', 1, '141.101.88.193', '21:41:39', '02/13/2019', 1),
(17, 'Hello buddy', 6, '108.162.229.151', '22:41:37', '02/14/2019', 7),
(18, 'Hi', 6, '108.162.229.151', '22:42:42', '02/14/2019', 7),
(19, 'kkkkkkkkkkkkkkkkkkkkk', 1, '172.69.134.222', '22:42:46', '02/14/2019', 7),
(20, 'hi', 22, '172.68.146.59', '16:43:23', '02/21/2019', 10),
(21, 'Hello', 23, '172.69.134.48', '17:44:22', '02/27/2019', 11),
(22, 'Hi', 1, '141.101.69.120', '17:44:54', '02/27/2019', 11),
(23, 'sovke', 1, '172.68.146.215', '17:28:51', '03/10/2019', 11),
(24, 'sovlet', 1, '172.68.146.215', '17:29:00', '03/10/2019', 11),
(25, 'Hello', 25, '172.69.226.122', '13:18:28', '03/11/2019', 12),
(26, 'Gully Boy', 1, '141.101.88.133', '13:18:46', '03/11/2019', 12),
(27, 'bc bol', 1, '172.69.226.180', '13:20:37', '03/11/2019', 10),
(28, 'i like u', 1, '141.101.88.133', '13:21:03', '03/11/2019', 10),
(29, 'Nope', 22, '172.69.226.122', '13:21:47', '03/11/2019', 10),
(30, 'me 2', 22, '172.69.226.122', '13:21:55', '03/11/2019', 10),
(31, ':(', 22, '172.69.226.122', '13:25:54', '03/11/2019', 10),
(32, ':)', 22, '172.69.226.122', '13:26:02', '03/11/2019', 10),
(33, ';_', 22, '172.69.226.122', '13:26:08', '03/11/2019', 10),
(34, '[;[p;[', 22, '172.69.226.122', '13:26:21', '03/11/2019', 10),
(35, 'Hi', 25, '108.162.229.7', '13:31:23', '03/11/2019', 13),
(36, 'bye', 22, '172.69.226.122', '13:32:00', '03/11/2019', 13),
(37, 'Why', 25, '108.162.229.7', '13:32:07', '03/11/2019', 13),
(38, 'coz i hate u', 22, '108.162.229.241', '13:32:31', '03/11/2019', 13),
(39, 'Same here ðŸ˜‘', 25, '108.162.229.7', '13:32:45', '03/11/2019', 13),
(40, 'Rupali', 25, '108.162.229.7', '13:33:16', '03/11/2019', 13),
(41, 'then why r u disturbing me!!', 22, '172.69.226.122', '13:33:37', '03/11/2019', 13),
(42, 'shrivastavi', 22, '172.69.226.122', '13:33:56', '03/11/2019', 13),
(43, 'Hii', 26, '141.101.88.133', '13:40:21', '03/11/2019', 14),
(44, 'bye', 22, '108.162.229.241', '13:40:38', '03/11/2019', 14),
(45, 'Helllo~', 3, '172.69.135.121', '21:08:40', '03/16/2019', 1),
(46, 'hello sourabh', 1, '141.101.107.201', '15:38:25', '03/25/2019', 7),
(47, 'hello dear I am your best friend', 1, '172.69.135.79', '17:05:01', '03/25/2019', 10),
(48, 'khud ko bahut hosiyaar samajhata hai', 1, '172.69.135.79', '17:05:23', '03/25/2019', 7);

-- --------------------------------------------------------

--
-- Table structure for table `hashtags`
--

CREATE TABLE IF NOT EXISTS `hashtags` (
  `id` int(11) NOT NULL,
  `hashtag` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(25, 1, 1),
(2, 3, 2),
(11, 3, 1),
(4, 5, 2),
(5, 5, 1),
(21, 1, 3),
(8, 5, 3),
(9, 1, 2),
(10, 3, 3),
(33, 1, 4),
(13, 20, 4),
(14, 3, 4),
(27, 1, 6),
(16, 2, 5),
(17, 2, 4),
(18, 3, 5),
(22, 5, 5),
(23, 10, 5),
(28, 14, 6),
(35, 1, 5),
(30, 21, 6),
(31, 21, 5),
(46, 1, 7),
(36, 1, 8),
(37, 5, 8),
(39, 22, 8),
(40, 5, 9),
(41, 1, 9),
(42, 3, 9),
(43, 23, 7),
(44, 23, 8),
(45, 23, 9),
(47, 25, 10),
(48, 25, 9),
(49, 25, 8),
(50, 1, 10),
(53, 22, 11),
(54, 22, 10),
(55, 1, 11),
(56, 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `srcid` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `since` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`nid`),
  KEY `sender` (`sender`),
  KEY `receiver` (`receiver`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`nid`, `sender`, `receiver`, `srcid`, `status`, `since`) VALUES
(1, 3, 1, 5, 'like', '2019-01-26 11:34:23'),
(16, 1, 0, 4, 'like', '2019-02-13 16:14:59'),
(8, 1, 1, 1, 'like', '2019-01-26 19:04:49'),
(4, 1, 5, 3, 'like', '2019-01-26 11:52:53'),
(5, 5, 1, 5, 'like', '2019-01-26 11:53:33'),
(6, 10, 1, 5, 'like', '2019-01-26 12:01:06'),
(10, 1, 14, 6, 'like', '2019-02-06 13:33:52'),
(11, 14, 0, 6, 'like', '2019-02-06 13:36:12'),
(18, 1, 1, 5, 'like', '2019-02-14 21:56:20'),
(13, 21, 14, 6, 'like', '2019-02-09 12:33:06'),
(14, 21, 1, 5, 'like', '2019-02-09 12:33:20'),
(29, 1, 11, 7, 'like', '2019-03-10 09:45:06'),
(19, 1, 1, 8, 'like', '2019-02-14 21:56:26'),
(20, 5, 1, 8, 'like', '2019-02-15 12:27:01'),
(22, 22, 1, 8, 'like', '2019-02-21 11:13:50'),
(23, 5, 5, 9, 'like', '2019-02-22 07:16:03'),
(24, 1, 5, 9, 'like', '2019-02-23 10:22:51'),
(25, 3, 5, 9, 'like', '2019-02-27 07:24:33'),
(26, 23, 11, 7, 'like', '2019-02-27 12:15:16'),
(27, 23, 1, 8, 'like', '2019-02-27 12:15:18'),
(28, 23, 5, 9, 'like', '2019-02-27 12:15:24'),
(30, 25, 20, 10, 'like', '2019-03-11 07:48:15'),
(31, 25, 5, 9, 'like', '2019-03-11 07:48:36'),
(32, 25, 1, 8, 'like', '2019-03-11 07:52:14'),
(33, 1, 20, 10, 'like', '2019-03-11 07:53:23'),
(36, 22, 25, 11, 'like', '2019-03-11 08:08:32'),
(37, 22, 20, 10, 'like', '2019-03-11 08:19:09'),
(38, 1, 0, 11, 'like', '2019-03-13 18:46:57'),
(39, 1, 1, 12, 'like', '2019-03-24 06:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `path` varchar(100) NOT NULL,
  `imgname` varchar(255) NOT NULL,
  `body` text,
  `status` tinyint(1) NOT NULL,
  `likes` int(10) NOT NULL DEFAULT '0',
  `comments` int(10) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `path`, `imgname`, `body`, `status`, `likes`, `comments`, `created_at`, `updated_at`) VALUES
(1, 1, 'assets/images/post-images/', '0469594001548092447.jpg', 'Believe in yourself! Have <a href="hashtag.php?tag=faith">#faith</a> in your abilities! Without a humble but reasonable <a href="hashtag.php?tag=confidence">#confidence</a> in your own powers you cannot be <a href="hashtag.php?tag=successful">#successful</a> or <a href="hashtag.php?tag=happy">#happy</a>.', 1, 3, 0, '2019-01-26 19:04:49', '2019-01-22 04:10:47'),
(2, 1, 'assets/images/post-images/', '0590760001548092677.jpg', 'War Begins. <a href="hashtag.php?tag=chatbox">#chatbox</a> <a href="hashtag.php?tag=social">#social</a>', 1, 3, 0, '2019-01-21 17:57:09', '2019-01-22 04:14:37'),
(3, 5, 'assets/images/post-images/', 'NULL', 'Hello everyone', 1, 3, 1, '2019-01-26 11:52:53', '2019-01-22 04:22:56'),
(4, 1, 'assets/images/post-images/', '0871984001548155854.jpg', '<a href="hashtag.php?tag=besocial">#besocial</a>', 1, 4, 1, '2019-02-13 16:14:59', '2019-01-22 21:47:34'),
(5, 1, 'assets/images/post-images/', '0612187001548493436.jpg', 'Get me busy! <a href="hashtag.php?tag=chatbox">#chatbox</a> <a href="hashtag.php?tag=college">#college</a>', 1, 6, 0, '2019-02-14 21:56:20', '2019-01-26 19:33:56'),
(6, 14, 'assets/images/post-images/', '0644955001549459898.png', 'Sketch made by me. <a href="hashtag.php?tag=sketch">#sketch</a> <a href="hashtag.php?tag=chatbox">#chatbox</a> <a href="hashtag.php?tag=social">#social</a>', 1, 3, 1, '2019-02-14 19:11:46', '2019-02-07 00:01:38'),
(7, 11, 'assets/images/post-images/', '0154766001550005511.png', '<a href="hashtag.php?tag=Ideas">#Ideas</a>', 1, 2, 0, '2019-03-10 09:45:06', '2019-02-13 07:35:11'),
(8, 1, 'assets/images/post-images/', '0026487001550181207.jpeg', '<a href="hashtag.php?tag=smartindiahackathon">#smartindiahackathon</a> <a href="hashtag.php?tag=aicte">#aicte</a>', 1, 5, 1, '2019-03-11 07:52:14', '2019-02-15 08:23:27'),
(9, 5, 'assets/images/post-images/', 'NULL', 'Hii anubha', 1, 5, 0, '2019-03-11 07:48:36', '2019-02-22 17:43:24'),
(10, 20, 'assets/images/post-images/', 'NULL', 'congratulations shivang for winning  SIH', 1, 3, 1, '2019-03-11 08:19:32', '2019-03-11 15:19:02'),
(11, 25, 'assets/images/post-images/', 'NULL', 'Working on projects..ðŸ˜‚ðŸ˜„â˜ºï¸ðŸ¤© <a href="hashtag.php?tag=chatbox">#chatbox</a>', 1, 2, 1, '2019-03-13 18:46:57', '2019-03-11 17:29:08'),
(12, 1, 'assets/images/post-images/', '0655860001553409384.jpg', 'Happy Holi. <a href="hashtag.php?tag=holicelebration">#holicelebration</a>', 1, 1, 0, '2019-03-24 06:38:51', '2019-03-24 16:06:24'),
(13, 29, 'assets/images/post-images/', 'NULL', 'hello', 1, 0, 0, '2019-03-25 20:42:50', '2019-03-25 20:42:50'),
(14, 29, 'assets/images/post-images/', 'NULL', '" --+', 1, 0, 0, '2019-03-25 20:43:37', '2019-03-25 20:43:37'),
(15, 29, 'assets/images/post-images/', 'NULL', '"', 1, 0, 0, '2019-03-25 20:43:46', '2019-03-25 20:43:46'),
(16, 29, 'assets/images/post-images/', 'NULL', '1', 1, 0, 0, '2019-03-25 20:44:13', '2019-03-25 20:44:13'),
(17, 29, 'assets/images/post-images/', 'NULL', '0', 1, 0, 0, '2019-03-25 20:44:57', '2019-03-25 20:44:57'),
(18, 29, 'assets/images/post-images/', 'NULL', '1', 1, 0, 0, '2019-03-25 20:59:54', '2019-03-25 20:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `relationship`
--

CREATE TABLE IF NOT EXISTS `relationship` (
  `user_one_id` int(11) NOT NULL,
  `user_two_id` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `action_user_id` int(11) NOT NULL,
  UNIQUE KEY `unique_users_id` (`user_one_id`,`user_two_id`),
  KEY `user_two_id` (`user_two_id`),
  KEY `action_user_id` (`action_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `relationship`
--

INSERT INTO `relationship` (`user_one_id`, `user_two_id`, `status`, `action_user_id`) VALUES
(1, 11, 1, 11),
(1, 14, 1, 14),
(1, 3, 1, 3),
(1, 5, 1, 5),
(1, 12, 0, 1),
(3, 11, 0, 3),
(1, 18, 0, 1),
(2, 3, 1, 2),
(3, 5, 1, 5),
(1, 20, 0, 1),
(1, 6, 1, 6),
(1, 2, 1, 2),
(1, 19, 0, 1),
(14, 20, 0, 14),
(1, 10, 0, 1),
(1, 21, 1, 21),
(6, 14, 0, 6),
(1, 15, 0, 1),
(1, 4, 0, 1),
(1, 7, 0, 1),
(6, 10, 0, 6),
(1, 17, 0, 1),
(3, 13, 0, 3),
(2, 5, 0, 5),
(1, 8, 0, 1),
(1, 22, 1, 1),
(1, 9, 0, 1),
(1, 23, 1, 1),
(3, 23, 0, 23),
(22, 23, 0, 23),
(1, 25, 1, 1),
(20, 25, 0, 25),
(22, 25, 1, 25),
(22, 26, 1, 26),
(1, 26, 0, 1),
(1, 24, 0, 1),
(1, 29, 1, 1),
(28, 29, 0, 29),
(12, 29, 0, 29);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `mobno` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `picpath` varchar(100) DEFAULT NULL,
  `time` varchar(30) NOT NULL,
  `lastlogin` varchar(30) DEFAULT NULL,
  `status` varchar(5) NOT NULL,
  `about` varchar(100) NOT NULL DEFAULT 'Hey there! I am using CHATBOX ',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `name`, `gender`, `mobno`, `city`, `picpath`, `time`, `lastlogin`, `status`, `about`) VALUES
(1, 'shivang', 'shivang', 'shivang5198@gmail.com', 'shivang saxena', 'Male', '488', 'Mumbai', 'assets/images/profile-pic/male6.png', '23rd December 2018 12:35:03 PM', NULL, '1', ' I have two choice to BE RICH or BE RICH.'),
(2, 'kapil', 'kapil', 'kapil@gmail.com', 'kapil saxena', 'Male', '', 'Indore', 'assets/images/profile-pic/male2.png', '23rd December 2018 12:35:42 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(3, 'Alia', 'alia', 'alia@gmail.com', 'Alia Bhatt', 'Female', '', 'Delhi', 'assets/images/profile-pic/female6.png', '23rd December 2018 12:37:02 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(4, 'ranveer', 'ranveer', 'ranveer@gmail.com', 'ranveer singh', 'Male', '', 'Delhi', 'assets/images/profile-pic/male3.png', '24th December 2018 09:36:57 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(5, 'harsh', 'harsh', 'harsh@gmail.com', 'harsh srivastava', 'Male', '', 'Bhopal', 'assets/images/profile-pic/male3.png', '25th December 2018 10:29:43 AM', NULL, '1', 'Hey there! I am using CHATBOX '),
(6, 'saurabh', 'saurabh', 'saurabh@gmail.com', 'saurabh sahu', 'Male', '', 'Indore', 'assets/images/profile-pic/male8.png', '26th December 2018 04:32:51 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(7, 'Ayushman', 'Ayushman', 'Ayushman@gmail.com', 'Ayushman khurana', 'Male', '', 'Bhopal', 'assets/images/profile-pic/male6.png', '23rd December 2018 12:35:03 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(8, 'Rohit', 'Rohit', 'Rohit@gmail.com', 'Rohit saxena', 'Male', '', 'Indore', 'assets/images/profile-pic/male4.png', '23rd December 2018 12:35:42 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(9, 'Swapnil', 'Swapnil', 'swapnil@gmail.com', 'Swapnil saxena', 'Female', '', 'Delhi', 'assets/images/profile-pic/female6.png', '23rd December 2018 12:37:02 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(10, 'Sandeep', 'Sandeep', 'Sandeep@gmail.com', 'Sandeep singh', 'Male', '', 'Delhi', 'assets/images/profile-pic/male6.png', '24th December 2018 09:36:57 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(11, 'Ashish', 'Ashish', 'Ashish@gmail.com', 'Ashish kumar', 'Male', '', 'Bhopal', 'assets/images/profile-pic/male5.png', '25th December 2018 10:29:43 AM', NULL, '1', 'Hey there! I am using CHATBOX '),
(12, 'Deepika', 'Deepika', 'Deepika@gmail.com', 'Deepika padukone', 'Female', '', 'Indore', 'assets/images/profile-pic/female7.png', '26th December 2018 04:32:51 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(13, 'Alok', 'Alok', 'Alok@gmail.com', 'Alok saxena', 'Male', '', 'Bhopal', 'assets/images/profile-pic/male8.png', '23rd December 2018 12:35:03 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(14, 'Vikash', 'Vikash', 'Vikash@gmail.com', 'Vikash kumar', 'Male', '', 'Indore', 'assets/images/profile-pic/male1.png', '23rd December 2018 12:35:42 PM', NULL, '1', 'Hello world this is Vikash!'),
(15, 'Aparna', 'Aparna', 'Aparna@gmail.com', 'Aparna gupta', 'Female', '', 'Delhi', 'assets/images/profile-pic/female6.png', '23rd December 2018 12:37:02 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(16, 'Ram', 'Ram', 'Ram@gmail.com', 'Ram singh', 'Male', '', 'Delhi', 'assets/images/profile-pic/male6.png', '24th December 2018 09:36:57 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(17, 'Atul', 'Atul', 'Atul@gmail.com', 'Atul kumar', 'Male', '', 'Bhopal', 'assets/images/profile-pic/male5.png', '25th December 2018 10:29:43 AM', NULL, '1', 'Hey there! I am using CHATBOX '),
(18, 'Pooja', 'Pooja', 'Pooja@gmail.com', 'Pooja sahu', 'Female', '', 'Indore', 'assets/images/profile-pic/female7.png', '26th December 2018 04:32:51 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(19, 'Sunil', 'sunil', 'shivang5199@gmail.com', 'Sunil kumar', 'Male', '', 'Bhopal', 'assets/images/profile-pic/male9.png', '13th January 2019 09:31:41 AM', NULL, '1', 'Hey there! I am using CHATBOX '),
(29, 'hello1234567', 'hello1234567', 'h123@hello.com', 'Kumar ashok', 'Male', '', '', 'assets/images/profile-pic/male7.png', '25th March 2019 07:01:40 AM', NULL, '1', 'Hey there! I am using CHATBOX '),
(20, 'rajesh_rkb', 'shivang', 'bagderajesh68@gmail.com', 'rajesh bhagde', 'Male', '', 'Bhopal', 'assets/images/profile-pic/male4.png', '24th January 2019 12:42:06 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(21, 'Nilaykhare', 'Nilaykhare', 'nilaykhare1998@gmail.com', 'Nilaykhare', 'Male', '', 'Bhopal', 'assets/images/profile-pic/male9.png', '9th February 2019 07:30:23 AM', NULL, '1', 'Hey there! I am using CHATBOX '),
(22, 'roopal', 'roopal', 'roopal@gmail.com', 'roopal buwade', 'Female', '', 'Bhopal', 'assets/images/profile-pic/female7.png', '21st February 2019 06:10:42 AM', NULL, '1', 'I am a barbie girl.'),
(23, 'rhlthakur8@gmail.com', 'password', 'rhlthakur8@gmail.com', 'Surya pratap', 'Male', '', 'Bhopal', 'assets/images/profile-pic/male4.png', '27th February 2019 07:11:08 AM', NULL, '1', 'Hey there! I am using CHATBOX '),
(24, 'Shivani123', '1234', 'shivani6042@gmail.com', 'Shivani', 'Female', '', 'Bhopal', 'assets/images/profile-pic/female1.png', '27th February 2019 07:56:13 AM', NULL, '1', 'Hey there! I am using CHATBOX '),
(25, 'widget', '1234', 'vijit@gmail.com', 'vijit srivastava', 'Male', '', 'Jhansi', 'assets/images/profile-pic/male4.png', '11th March 2019 03:44:45 AM', NULL, '1', 'Hey there! I am using CHATBOX '),
(26, 'Sazidkhan07', 'sazid123', 'itsme.sazid97@gmail.com', 'Sazid khan', 'Male', '', 'Bhopal', 'assets/images/profile-pic/male8.png', '11th March 2019 04:08:34 AM', NULL, '1', 'Hey there! I am using CHATBOX ');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
