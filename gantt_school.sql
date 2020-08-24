-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2020 at 07:29 AM
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
(1, 'Trung Nhan', 'trungnhan21.12@gmail.com', 'admin', 'admin');

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
(2, 'CNTT-P2');

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
(43, 'New Home', '2020-08-19', '2020-08-21', '1', 'NET', 1),
(53, 'Math quickly', '2020-08-24', '2020-08-28', '2', 'PRG', 1);

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
(8, 32, 'P1. What is database?'),
(9, 32, 'P2. Definite of database '),
(10, 32, 'P3. For example and screenshot'),
(11, 32, 'P4. Introduce about SQL Server'),
(24, 39, 'Job 2'),
(25, 39, 'Job 3'),
(26, 39, 'Job 4'),
(27, 42, 'Job test1'),
(28, 42, 'Job test2'),
(39, 40, 'Something 1'),
(40, 40, 'Something 2'),
(41, 40, 'Something 3'),
(42, 40, 'Something 4'),
(43, 40, 'Something 5'),
(44, 40, 'Something 6'),
(45, 40, 'Something 7'),
(46, 40, 'Something 8'),
(47, 40, 'Something 9'),
(48, 40, 'Something 10'),
(49, 43, 'Something 1'),
(50, 43, 'Something 2'),
(51, 0, 'Something 3'),
(52, 0, 'Something 4'),
(53, 0, 'Something 3'),
(54, 0, 'Something 4'),
(55, 0, 'Something 3'),
(56, 43, 'Something 3'),
(57, 43, 'Something 4'),
(60, 32, 'P5. What are you doing?'),
(105, 53, 'Example 1'),
(106, 53, 'Example 2'),
(107, 53, 'Example 3'),
(108, 53, 'Example 4');

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
(1, 'Nguyen Trung Nhan', 'trungnhan21.12@gmail.com', 'bsaf190011', '123456'),
(2, 'Tran Van Tai', 'taivan@gmail.com', 'vantai', '123456'),
(3, 'Le Van A', 'van@gmail.com', 'ducminh', '123456'),
(4, 'Phan Vinh Hai', 'haivinh@gmail.com', 'vinhhai', '123456');

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
(4, 4, 2);

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
(45, 8, 32, 1, '2020-08-24', 'A database is an organized collection of structured information, or data, typically stored electronically in a computer system', 1),
(46, 9, 32, 1, '2020-08-24', 'Before getting started with Bootstrap’s modal component, be sure to read the following as our menu options have recently changed.', 1),
(49, 8, 32, 2, '2020-08-24', 'For a complete reference of all collapse options, methods and events, go to our Bootstrap 4 JS Collapse Reference.\r\n\r\n', 1),
(50, 9, 32, 2, '2020-08-24', 'The following example shows a simple accordion by extending the card component.', 1),
(51, 11, 32, 2, '2020-08-24', 'The Gulf Coast will get walloped by a tropical storm and a hurricane this week, bringing torrential rain, fierce winds and ferocious storm surges.', 1),
(52, 10, 32, 3, '2020-08-24', 'The unprecedented kind of thing here is that it\'s the same state within 48 hours of each other', 1),
(53, 60, 32, 3, '2020-08-24', 'And the one-two punch from Marco and Laura means \"there may not be much of a window\" for rescuers or power restoration crews to respond to victims between the two storms, Louisiana Gov. John Bel Edwards said.\r\n', 1),
(54, 11, 32, 3, '2020-08-24', 'Ultimately, the big concern is going to be storm surge', 1),
(55, 8, 32, 3, '2020-08-24', 'A storm surge warning means there is a danger of life-threatening inundation, from rising water moving inland from the coastline, during the next 36 hours', 1),
(56, 9, 32, 3, '2020-08-24', 'Since New Orleans is not actually on the coast, it will be more indirectly impacted via Lake Pontchartrain, which is expected to have surge heights of 2 to 4 feet', 1);

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
(1, 'Tran Thi B', 'bbb@bbb.com', 'bbfe1901', '123456'),
(2, 'Luu Van Hoa', 'hoavan@gmail.com', 'vanhoa', '123456');

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
(5, 2, 1, 'PRG');

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
(4, 2, 'PRG');

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
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `jobs_details`
--
ALTER TABLE `jobs_details`
  MODIFY `details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_class`
--
ALTER TABLE `student_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_jobs`
--
ALTER TABLE `student_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher_class`
--
ALTER TABLE `teacher_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teacher_subs`
--
ALTER TABLE `teacher_subs`
  MODIFY `teacher_subsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
