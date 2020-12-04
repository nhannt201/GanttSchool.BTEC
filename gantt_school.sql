-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2020 at 09:14 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gantt_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `username`, `password`) VALUES
(1, 'Trung Nhan', 'trungnhan21.12@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `classID` int(11) NOT NULL,
  `className` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`classID`, `className`) VALUES
(1, 'CNTT-C1'),
(2, 'CNTT-P2'),
(3, 'IT-2002'),
(4, 'IT-2001');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `jobID` int(11) NOT NULL,
  `jobName` varchar(200) NOT NULL,
  `jobStart` date NOT NULL,
  `jobEnd` date NOT NULL,
  `teacherID` varchar(100) NOT NULL,
  `subID` varchar(3) NOT NULL,
  `classID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jobID`, `jobName`, `jobStart`, `jobEnd`, `teacherID`, `subID`, `classID`) VALUES
(32, 'Assigment 1', '2020-08-18', '2020-08-31', '1', 'DBS', 1),
(39, 'Summer Homework 2', '2020-08-19', '2020-08-19', '2', 'DBS', 1),
(42, 'GV 2 Tester.', '2020-08-15', '2020-08-30', '2', 'PRG', 2),
(43, 'Homework', '2020-08-19', '2020-08-21', '1', 'NET', 1),
(53, 'Math quickly', '2020-08-24', '2020-08-28', '2', 'PRG', 1),
(54, 'JOb 1', '2020-08-26', '2020-08-28', '3', 'PPT', 4);

-- --------------------------------------------------------

--
-- Table structure for table `jobs_details`
--

CREATE TABLE `jobs_details` (
  `details_id` int(11) NOT NULL,
  `jobID` int(11) NOT NULL,
  `jobChildName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs_details`
--

INSERT INTO `jobs_details` (`details_id`, `jobID`, `jobChildName`) VALUES
(9, 32, 'P2. Definite of database '),
(10, 32, 'P3. For example and screenshot'),
(11, 32, 'P4. Introduce about SQL Server'),
(24, 39, 'Job 2'),
(25, 39, 'Job 3'),
(26, 39, 'Job 4'),
(27, 42, 'Job test1'),
(28, 42, 'Job test2'),
(39, 40, 'What is DNS?'),
(40, 40, 'Device supports DNS'),
(41, 40, 'Types of DNS'),
(42, 40, 'Something 4'),
(43, 40, 'Example of DNS'),
(44, 40, 'Something 6'),
(45, 40, 'Something 7'),
(46, 40, 'Something 8'),
(47, 40, 'Something 9'),
(48, 40, 'Something 10'),
(49, 43, 'What is DNS?'),
(50, 43, 'Definite DNS'),
(51, 0, 'Something 3'),
(52, 0, 'Something 4'),
(53, 0, 'Something 3'),
(54, 0, 'Something 4'),
(55, 0, 'Something 3'),
(56, 43, 'Types of DNS'),
(57, 43, 'For example'),
(60, 32, 'P5. What are you doing?'),
(105, 53, 'Example 1'),
(106, 53, 'Example 2'),
(107, 53, 'Example 3'),
(108, 53, 'Example 4'),
(110, 32, 'P6. What is ERD?'),
(112, 0, 'fd sfdfdsf'),
(119, 54, 'Job 1'),
(120, 54, 'Job 2'),
(121, 32, 'M1. Description of the function of the database connection program');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `parentID` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `studentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parentID`, `name`, `email`, `username`, `password`, `studentID`) VALUES
(1, 'Van Kien', 'trungnhan21.12@gmail.com', 'trungnhan', '5f4dcc3b5aa765d61d8327deb882cf99', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `name`, `email`, `username`, `password`) VALUES
(1, 'Nguyen Trung Nhan', 'trungnhan21.12@gmail.com', 'bsaf190011', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'Tran Van Tai', 'taivan@gmail.com', 'vantai', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'Le Van A', 'van@gmail.com', 'ducminh', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'Phan Vinh Hai', 'haivinh@gmail.com', 'vinhhai', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'Nguyen Nhan', 'trungnhan@gmail.com', 'trungnhan', 'e10adc3949ba59abbe56e057f20f883e'),
(6, 'Hoc sinh moi', 'newstudent@gmail.com', 'newstudent', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `student_class`
--

CREATE TABLE `student_class` (
  `id` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `classID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_class`
--

INSERT INTO `student_class` (`id`, `studentID`, `classID`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 2),
(5, 5, 1),
(6, 6, 4),
(7, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_jobs`
--

CREATE TABLE `student_jobs` (
  `id` int(11) NOT NULL,
  `details_id` int(11) NOT NULL,
  `jobID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `jobDateComplete` date NOT NULL,
  `answer` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_jobs`
--

INSERT INTO `student_jobs` (`id`, `details_id`, `jobID`, `studentID`, `jobDateComplete`, `answer`, `status`) VALUES
(46, 9, 32, 1, '2020-08-24', 'A database is an organized collection of data, generally stored and accessed electronically from a computer system. Where databases are more complex they are often developed using formal design and modeling techniques.\r\n\r\n', 1),
(50, 9, 32, 2, '2020-08-24', 'The following example shows a simple accordion by extending the card component.', 1),
(51, 11, 32, 2, '2020-08-24', 'The Gulf Coast will get walloped by a tropical storm and a hurricane this week, bringing torrential rain, fierce winds and ferocious storm surges.', 1),
(52, 10, 32, 3, '2020-08-24', 'The unprecedented kind of thing here is that it\'s the same state within 48 hours of each other', 1),
(53, 60, 32, 3, '2020-08-24', 'And the one-two punch from Marco and Laura means \"there may not be much of a window\" for rescuers or power restoration crews to respond to victims between the two storms, Louisiana Gov. John Bel Edwards said.\r\n', 1),
(54, 11, 32, 3, '2020-08-24', 'Ultimately, the big concern is going to be storm surge', 1),
(56, 9, 32, 3, '2020-08-24', 'Since New Orleans is not actually on the coast, it will be more indirectly impacted via Lake Pontchartrain, which is expected to have surge heights of 2 to 4 feet', 1),
(57, 10, 32, 1, '2020-08-24', 'Campouuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu', 1),
(58, 11, 32, 1, '2020-08-24', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 1),
(59, 60, 32, 1, '2020-08-24', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 1),
(60, 110, 32, 1, '2020-08-24', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 1),
(61, 119, 54, 6, '2020-08-26', 'Completed job 1!', 1),
(62, 120, 54, 6, '2020-08-26', 'Completed job 2!', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subID` varchar(10) NOT NULL,
  `subName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subID`, `subName`) VALUES
('DBS', 'DATABASE'),
('NET', 'NETWORKING'),
('PPT', 'PROFESSIONAL PRACTICE'),
('PRG', 'PROGRAMMING');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacherID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherID`, `name`, `email`, `username`, `password`) VALUES
(1, 'Tran Thi B', 'bbb@bbb.com', 'bbfe1901', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'Luu Van Hoa', 'hoavan@gmail.com', 'vanhoa', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_class`
--

CREATE TABLE `teacher_class` (
  `id` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `classID` int(11) NOT NULL,
  `subID` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_class`
--

INSERT INTO `teacher_class` (`id`, `teacherID`, `classID`, `subID`) VALUES
(1, 1, 1, 'NET'),
(3, 2, 1, 'DBS'),
(4, 2, 2, 'PRG'),
(5, 2, 1, 'PRG'),
(7, 1, 1, 'DBS');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subs`
--

CREATE TABLE `teacher_subs` (
  `teacher_subsID` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `subID` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_subs`
--

INSERT INTO `teacher_subs` (`teacher_subsID`, `teacherID`, `subID`) VALUES
(1, 1, 'DBS'),
(2, 1, 'NET'),
(3, 2, 'DBS'),
(4, 2, 'PRG'),
(6, 1, 'DBS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`classID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jobID`);

--
-- Indexes for table `jobs_details`
--
ALTER TABLE `jobs_details`
  ADD PRIMARY KEY (`details_id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`parentID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `student_class`
--
ALTER TABLE `student_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_jobs`
--
ALTER TABLE `student_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacherID`);

--
-- Indexes for table `teacher_class`
--
ALTER TABLE `teacher_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_subs`
--
ALTER TABLE `teacher_subs`
  ADD PRIMARY KEY (`teacher_subsID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `jobs_details`
--
ALTER TABLE `jobs_details`
  MODIFY `details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `parentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_class`
--
ALTER TABLE `student_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_jobs`
--
ALTER TABLE `student_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher_class`
--
ALTER TABLE `teacher_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teacher_subs`
--
ALTER TABLE `teacher_subs`
  MODIFY `teacher_subsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
