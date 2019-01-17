-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 17, 2019 at 01:00 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `livechatbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `parent_comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `c_id` int(11) NOT NULL,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `time` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Table structure for table `conversation_reply`
--

CREATE TABLE `conversation_reply` (
  `cr_id` int(11) NOT NULL,
  `reply` text,
  `user_id_fk` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `date` varchar(30) NOT NULL,
  `c_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Table structure for table `hashtags`
--

CREATE TABLE `hashtags` (
  `id` int(11) NOT NULL,
  `hashtag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `nid` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `srcid` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `since` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `path` varchar(100) NOT NULL,
  `imgname` varchar(255) NOT NULL,
  `body` text,
  `status` tinyint(1) NOT NULL,
  `likes` int(10) NOT NULL DEFAULT '0',
  `comments` int(10) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




--
-- Table structure for table `relationship`
--

CREATE TABLE `relationship` (
  `user_one_id` int(11) NOT NULL,
  `user_two_id` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `action_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
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
  `about` varchar(100) NOT NULL DEFAULT 'Hey there! I am using CHATBOX '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `name`, `gender`, `mobno`, `city`, `picpath`, `time`, `lastlogin`, `status`, `about`) VALUES
(1, 'shivang', 'shivang', 'shivang5198@gmail.com', 'Shivang Saxena', 'Male', '', 'Mumbai', 'assets/images/profile-pic/male6.png', '23rd December 2018 12:35:03 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(2, 'kapil', 'kapil', 'kapil@gmail.com', 'Kapil Saxena', 'Male', '', 'Indore', 'assets/images/profile-pic/male2.png', '23rd December 2018 12:35:42 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(3, 'Alia', 'alia', 'alia@gmail.com', 'Alia Bhatt', 'Female', '', 'Delhi', 'assets/images/profile-pic/female6.png', '23rd December 2018 12:37:02 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(4, 'ranveer', 'ranveer', 'ranveer@gmail.com', 'Ranveer Singh', 'Male', '', 'Delhi', 'assets/images/profile-pic/male3.png', '24th December 2018 09:36:57 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(5, 'harsh', 'harsh', 'harsh@gmail.com', 'Hasrh Srivastava', 'Male', '', 'Bhopal', 'assets/images/profile-pic/male3.png', '25th December 2018 10:29:43 AM', NULL, '1', 'Hey there! I am using CHATBOX '),
(6, 'saurabh', 'saurabh', 'saurabh@gmail.com', 'Saurabh Sahu', 'Male', '', 'Indore', 'assets/images/profile-pic/male8.png', '26th December 2018 04:32:51 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(7, 'Ayushman', 'Ayushman', 'Ayushman@gmail.com', 'Ayushman Saxena', 'Male', '', 'Bhopal', 'assets/images/profile-pic/male6.png', '23rd December 2018 12:35:03 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(8, 'Rohit', 'Rohit', 'Rohit@gmail.com', 'Rohit Saxena', 'Male', '', 'Indore', 'assets/images/profile-pic/male4.png', '23rd December 2018 12:35:42 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(9, 'Swapnil', 'Swapnil', 'swapnil@gmail.com', 'Swapnil Bhatt', 'Female', '', 'Delhi', 'assets/images/profile-pic/female6.png', '23rd December 2018 12:37:02 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(10, 'Sandeep', 'Sandeep', 'Sandeep@gmail.com', 'Sandeep Singh', 'Male', '', 'Delhi', 'assets/images/profile-pic/male6.png', '24th December 2018 09:36:57 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(11, 'Ashish', 'Ashish', 'Ashish@gmail.com', 'Ashish Srivastava', 'Male', '', 'Bhopal', 'assets/images/profile-pic/male5.png', '25th December 2018 10:29:43 AM', NULL, '1', 'Hey there! I am using CHATBOX '),
(12, 'Deepika', 'Deepika', 'Deepika@gmail.com', 'Deepika Sahu', 'Female', '', 'Indore', 'assets/images/profile-pic/female7.png', '26th December 2018 04:32:51 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(13, 'Alok', 'Alok', 'Alok@gmail.com', 'Alok Saxena', 'Male', '', 'Bhopal', 'assets/images/profile-pic/male8.png', '23rd December 2018 12:35:03 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(14, 'Vikash', 'Vikash', 'Vikash@gmail.com', 'Vikash Saxena', 'Male', '', 'Indore', 'assets/images/profile-pic/male1.png', '23rd December 2018 12:35:42 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(15, 'Aparna', 'Aparna', 'Aparna@gmail.com', 'Aparna Bhatt', 'Female', '', 'Delhi', 'assets/images/profile-pic/female6.png', '23rd December 2018 12:37:02 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(16, 'Ram', 'Ram', 'Ram@gmail.com', 'Ram Singh', 'Male', '', 'Delhi', 'assets/images/profile-pic/male6.png', '24th December 2018 09:36:57 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(17, 'Atul', 'Atul', 'Atul@gmail.com', 'Atul Srivastava', 'Male', '', 'Bhopal', 'assets/images/profile-pic/male5.png', '25th December 2018 10:29:43 AM', NULL, '1', 'Hey there! I am using CHATBOX '),
(18, 'Pooja', 'Pooja', 'Pooja@gmail.com', 'Pooja Sahu', 'Female', '', 'Indore', 'assets/images/profile-pic/female7.png', '26th December 2018 04:32:51 PM', NULL, '1', 'Hey there! I am using CHATBOX '),
(19, 'Sunil', 'sunil', 'shivang5199@gmail.com', 'Sunil Kumar Saxena', 'Male', '', 'Bhopal', 'assets/images/profile-pic/male9.png', '13th January 2019 09:31:41 AM', NULL, '1', 'Hey there! I am using CHATBOX ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `user_one` (`user_one`),
  ADD KEY `user_two` (`user_two`);

--
-- Indexes for table `conversation_reply`
--
ALTER TABLE `conversation_reply`
  ADD PRIMARY KEY (`cr_id`),
  ADD KEY `c_id_fk` (`c_id_fk`),
  ADD KEY `user_id_fk` (`user_id_fk`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`nid`),
  ADD KEY `sender` (`sender`),
  ADD KEY `receiver` (`receiver`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);


--
-- Indexes for table `relationship`
--
ALTER TABLE `relationship`
  ADD UNIQUE KEY `unique_users_id` (`user_one_id`,`user_two_id`),
  ADD KEY `user_two_id` (`user_two_id`),
  ADD KEY `action_user_id` (`action_user_id`);


--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `conversation_reply`
--
ALTER TABLE `conversation_reply`
  MODIFY `cr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;


--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `conversation_ibfk_1` FOREIGN KEY (`user_one`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `conversation_ibfk_2` FOREIGN KEY (`user_two`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `conversation_reply`
--
ALTER TABLE `conversation_reply`
  ADD CONSTRAINT `conversation_reply_ibfk_1` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `conversation_reply_ibfk_2` FOREIGN KEY (`c_id_fk`) REFERENCES `conversation` (`c_id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`receiver`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


--
-- Constraints for table `relationship`
--
ALTER TABLE `relationship`
  ADD CONSTRAINT `relationship_ibfk_1` FOREIGN KEY (`user_one_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `relationship_ibfk_2` FOREIGN KEY (`user_two_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `relationship_ibfk_3` FOREIGN KEY (`action_user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
