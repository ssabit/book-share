-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2019 at 06:00 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_share_community`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_list`
--

CREATE TABLE `book_list` (
  `book_id` int(255) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `author_name` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `genre` varchar(1000) NOT NULL,
  `publishers` varchar(100) NOT NULL,
  `publication_year` varchar(100) NOT NULL,
  `pages` int(100) NOT NULL,
  `isbn` varchar(1000) NOT NULL,
  `price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_list`
--

INSERT INTO `book_list` (`book_id`, `book_name`, `author_name`, `country`, `genre`, `publishers`, `publication_year`, `pages`, `isbn`, `price`) VALUES
(2, 'A Golden Age', 'Tahmima Anam', 'Bangladesh ', 'Novel', 'John Murray', '2010', 276, '0719560098', 5000),
(3, 'Database System Concepts', 'Abraham Silberschatz and Hank Korth', 'United States of America', 'Computer Science', 'McGraw-Hill', '1986', 918, '0-07-044752-7', 3500),
(11, 'Web Programming', 'Haider', 'Germany', 'Computer Science', 'Hill', '2011', 1080, '1234567890-098', 5000),
(14, 'A Suitable Boy', 'Vikram Seth', 'India', 'Fiction', 'Prime Book', '2006', 150, '0060786523 ', 35011),
(15, 'Logic And Computer Design Fundamentals', 'Charles R. Kime And M. Morris Man', 'India', 'Computer Science', 'Addison Wesley Longman', '2008', 650, '81-7808-3345', 19360),
(16, 'Accounting Principles', 'Jerry J. Weygandt , Paul D. Kimmel, Donald E. Kieso', 'Asia', 'Accounting', 'Wiley', '2012', 1288, ' 978-1118130032', 3200),
(17, 'Java Program Design ', 'James P. Cohoon, Jack W. Davidson', 'United States Of America', 'Computer Science', 'Mcgraw-Hill ', '2004', 904, '978-0071192552', 74228),
(18, 'A History Of Bangladesh', 'Willem Van Schendel', 'Bangladesh', 'History', 'Cambridge University Press', '2011', 374, '978-0521679749', 7440),
(19, 'Ekattorer Dinguli', 'Jahanara Imam', 'Bangladesh', 'History', 'Sondhani', '1986', 270, '9844800005', 1500),
(20, 'Devi', 'Humayun Ahmed', 'Bangladesh', 'Horror', 'Oboshor Prokashoni', '2014', 80, '', 132),
(21, 'Dbms', 'Asdad', 'Hungary', 'Science Fiction', 'Sadad', '1819', 534, '5435345', 435);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(25) NOT NULL,
  `user_id` int(11) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `user_id`, `latitude`, `longitude`) VALUES
(1, 18, '22.3601', '90.0589'),
(2, 3, '23.8214097', '90.3657758'),
(3, 4, '23.634019', '90.493345'),
(4, 13, '20.8214097', '87.3657758'),
(5, 14, '20.3601', '91.0589'),
(6, 16, '19.3601', '90.0589'),
(7, 20, '22.3601', '92.0589'),
(8, 21, '23.3601', '24.0589'),
(9, 27, '23.817824', '90.430219'),
(10, 25, '23.821341', '90.366014');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(25) NOT NULL,
  `owner_id` int(25) NOT NULL,
  `borrower_id` int(25) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(255) NOT NULL,
  `post_owner` varchar(100) NOT NULL,
  `post_genre` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `post_owner_id` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_owner`, `post_genre`, `status`, `book_name`, `time`, `post_owner_id`) VALUES
(13, 'haider', 'Fiction', 'Hello', 'A Suitable Boy', 'Saturday, September 01st, 2018 12:17 AM', 4),
(16, 'saad', 'Computer Science', 'Elms', 'Database System Concepts', 'Thursday, September 13th, 2018 1:35 PM', 3),
(17, 'root', 'Satire', 'Sdfgdg', 'A Suitable Boy', 'Saturday, September 15th, 2018 1:03 PM', 18),
(18, 'root', 'Computer Science', 'Share', 'Web Programming', 'Tuesday, September 18th, 2018 11:59 PM', 18),
(19, 'root', 'Novel', 'sadad', 'A Golden Age', 'Wednesday, September 19th, 2018 12:13 PM', 18),
(20, '011133056', 'Computer Science', 'I want to share this book', 'Logic And Computer Design Fundamentals', 'Saturday, December 22nd, 2018 1:06 PM', 23),
(23, '011182125', 'Computer Science', 'i want to share book', 'Java Program Design ', 'Saturday, December 22nd, 2018 4:34 PM', 25);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(25) NOT NULL,
  `owner_id` int(25) NOT NULL,
  `request_id` int(25) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `rating` varchar(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `owner_id`, `request_id`, `comment`, `book_name`, `status`, `rating`) VALUES
(35, 13, 3, '1', 'Database System Concepts', 0, '4.2'),
(38, 4, 3, '1', 'A Suitable Boy', 0, '4.2'),
(40, 18, 3, '1', 'Database System Concepts', 1, '4.2'),
(46, 13, 21, '1', 'Database System Concepts', 1, ''),
(52, 3, 14, '1', 'Database System Concepts', 0, '4.1'),
(53, 18, 14, '1', 'Database System Concepts', 1, '4.1'),
(54, 18, 4, '1', 'Web Programming', 1, '4.2'),
(55, 14, 18, '1', 'A Simple Boy', 1, '2.5'),
(56, 18, 4, '1', 'A Golden Age', 0, '2.5'),
(57, 3, 18, '1', 'Database System Concepts', 0, '2.5'),
(62, 25, 27, '1', 'Java Program Design ', 1, '4.1'),
(63, 18, 25, '1', 'Web Programming', 1, '1.5'),
(64, 25, 27, '1', 'Java Program Design ', 1, '1.5');

-- --------------------------------------------------------

--
-- Table structure for table `share`
--

CREATE TABLE `share` (
  `id` int(100) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `days` varchar(100) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `returned` int(1) DEFAULT '0',
  `delivery_date` varchar(100) NOT NULL,
  `rate` int(11) NOT NULL DEFAULT '0',
  `rate2` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `share`
--

INSERT INTO `share` (`id`, `owner_id`, `borrower_id`, `days`, `book_name`, `status`, `returned`, `delivery_date`, `rate`, `rate2`) VALUES
(1, 12, 36, '3', 'Oop', 0, 0, '', 0, 0),
(35, 18, 3, '7', 'Web Programming', 0, 1, 'Saturday, December 22nd, 2018 12:43 PM', 0, 0),
(61, 13, 18, '7', 'Java Program Design', 1, 1, 'Tuesday, September 18th, 2018 1:27 AM', 1, 0),
(72, 13, 21, '7', 'Database System Concepts', 1, 0, '', 0, 0),
(73, 18, 3, '7', 'Database System Concepts', 1, 0, '', 0, 0),
(74, 18, 14, '7', 'ABC', 1, 0, 'Tuesday, September 18th, 2018 12:02 AM', 0, 0),
(75, 14, 4, '7', 'A Simple Boy', 1, 1, 'Friday, October 19th, 2018 12:54 PM', 0, 0),
(76, 18, 4, '7', 'Web Programming', 1, 1, 'Wednesday, September 19th, 2018 12:13 AM', 1, 1),
(77, 14, 18, '7', 'A Simple Boy', 1, 1, 'Wednesday, September 19th, 2018 12:19 PM', 1, 1),
(78, 4, 3, '7', 'A Suitable Boy', 1, 0, '', 0, 0),
(79, 18, 23, '7', 'A Golden Age', 1, 0, '', 0, 0),
(83, 25, 27, '7', 'Java Program Design ', 1, 1, 'Saturday, December 22nd, 2018 4:36 PM', 1, 1),
(84, 25, 27, '7', 'Java Program Design ', 1, 0, '', 0, 0),
(85, 18, 25, '7', 'Web Programming', 1, 1, 'Tuesday, December 25th, 2018 6:56 PM', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(25) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` int(1) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` char(11) NOT NULL,
  `public_info` text NOT NULL,
  `user_level` int(1) NOT NULL DEFAULT '1',
  `rating` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `username`, `password`, `email`, `phone`, `public_info`, `user_level`, `rating`) VALUES
(3, 'Saad', 'Sabit', 1, 'saad', '123', 'saad@gmail.com', '01671763399', 'Hello World!!', 3, '4.2'),
(4, 'Haider', 'Ali', 1, 'haider', '123', 'haider@gmail.com', '01775183544', 'I Am Haider', 2, '2.5'),
(13, 'Sony', 'Vaio', 1, 'vaio', 'vaio', 'vaio@gmail.com', '', 'I Am Vaio', 2, '1.5'),
(14, 'Nameer', 'Hassan', 0, 'nameer', 'nameer', 'nameer@gmail.com', '', 'I Am Nameer', 1, '2.5'),
(16, 'Book', 'Share', 0, 'book_share', 'bookshare', 'book_share@gmail.com', '', 'I Am Book Share', 1, '4.4'),
(18, 'Root', 'Root', 1, 'root', 'root', 'root@gmail.com', '0123456789', 'I Am Root', 1, '2.5'),
(20, 'Mohammad', 'Imam', 1, 'imam', 'imam', 'imam@gmail.com', '', 'I am mohammad Imam', 1, '4.5'),
(25, 'Saad', 'Sabit', 1, '011182125', '111', 'ssabit125@gmail.com', '0123456789', 'sabit', 1, '1.5'),
(27, 'Sajjadul', 'Alam', 1, '011152184', '1', 'sajjadul.alam71@gmail.com', '01811111111', 'Sajjad', 1, '1.5'),
(29, '', '', 0, 'rana', 'rana', 'rana@gmail.com', '', '', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_booklist`
--

CREATE TABLE `user_booklist` (
  `id` int(255) NOT NULL,
  `user_id` int(25) NOT NULL,
  `bookname` varchar(1000) NOT NULL,
  `authorname` varchar(1000) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `publishers` varchar(1000) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_booklist`
--

INSERT INTO `user_booklist` (`id`, `user_id`, `bookname`, `authorname`, `genre`, `publishers`, `country`) VALUES
(2, 18, 'A Golden Age', 'Saad', 'CSE', 'John Murray', 'Bangladesh '),
(6, 3, 'Java', 'Sabit', 'CSE', 'Hill', 'USA\n'),
(8, 12, 'Web Programming', 'Saad', 'CSI', 'Haider', 'Brazil'),
(9, 14, 'OOP', 'Sabit', 'CSE', 'Haider', 'USA\n'),
(11, 5, 'Abc', 'Saad', 'Math', 'Hill-Gill', 'UK'),
(21, 20, 'Web Programming', 'Haider Ali', 'Computer Science', 'Hill', 'Bangladesh'),
(22, 18, 'A Suitable Boy', 'Vikram Seth', 'Fiction', 'Prime Book', 'India'),
(24, 21, 'A Golden Age', 'Tahmima Anam', 'Novel', 'John Murray', 'Bangladesh '),
(25, 21, 'A History Of Bangladesh', 'Willem Van Schendel', 'History', 'Cambridge University Press', 'Bangladesh'),
(32, 23, 'Web Programming', 'Haider', 'Computer Science', 'Hill', 'Germany'),
(33, 23, 'Database System Concepts', 'Abraham Silberschatz And Hank Korth', 'Computer Science', 'McGraw-Hill', 'United States Of America'),
(34, 27, 'A Golden Age', 'Tahmima Anam', 'Novel', 'John Murray', 'Bangladesh '),
(40, 25, 'Web Programming', 'Haider', 'Computer Science', 'Hill', 'Germany');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_list`
--
ALTER TABLE `book_list`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `share`
--
ALTER TABLE `share`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_booklist`
--
ALTER TABLE `user_booklist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_list`
--
ALTER TABLE `book_list`
  MODIFY `book_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `share`
--
ALTER TABLE `share`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `user_booklist`
--
ALTER TABLE `user_booklist`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
