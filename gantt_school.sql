-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2020 at 05:53 AM
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
(1, 'CNTT-C1');

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
(39, 'Summer Homework 2', '2020-08-19', '2020-08-19', '2', 'DBS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobs_details`
--

CREATE TABLE `jobs_details` (
  `details_id` int(11) NOT NULL,
  `jobID` int(11) NOT NULL,
  `jobChildName` text NOT NULL,
  `jobDateComplete` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs_details`
--

INSERT INTO `jobs_details` (`details_id`, `jobID`, `jobChildName`, `jobDateComplete`, `status`) VALUES
(8, 32, 'P1. What is database', '0000-00-00', 0),
(9, 32, 'P2. Definite of database ', '0000-00-00', 0),
(10, 32, 'P3. For example', '0000-00-00', 0),
(11, 32, 'P4. Introduce about SQL Server', '0000-00-00', 0);

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
(1, 'Nguyen Trung Nhan', 'trungnhan21.12@gmail.com', 'bsaf190011', '123456');

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
(1, 1, 1);

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
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(3, 2, 1, 'DBS');

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
(3, 2, 'DBS');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `jobs_details`
--
ALTER TABLE `jobs_details`
  MODIFY `details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_class`
--
ALTER TABLE `student_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_jobs`
--
ALTER TABLE `student_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher_class`
--
ALTER TABLE `teacher_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher_subs`
--
ALTER TABLE `teacher_subs`
  MODIFY `teacher_subsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
