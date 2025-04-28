-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 07:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin@123'),
(2, 'munam', 'mm123@gmail.com', 'munam@123');

-- --------------------------------------------------------

--
-- Table structure for table `interviewschedule`
--

CREATE TABLE `interviewschedule` (
  `studentemail` varchar(250) NOT NULL,
  `organizationname` varchar(250) NOT NULL,
  `interviewslot` varchar(250) NOT NULL,
  `allocatedroom` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `interviewschedule`
--

INSERT INTO `interviewschedule` (`studentemail`, `organizationname`, `interviewslot`, `allocatedroom`) VALUES
('mm123@gmail.com', 'jazz', '15:00', 'A006');

-- --------------------------------------------------------

--
-- Table structure for table `jobfairdates`
--

CREATE TABLE `jobfairdates` (
  `startdate` varchar(250) NOT NULL,
  `enddate` varchar(250) NOT NULL,
  `starttime` varchar(250) NOT NULL,
  `endtime` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jobfairdates`
--

INSERT INTO `jobfairdates` (`startdate`, `enddate`, `starttime`, `endtime`) VALUES
('2024-05-07', '2024-05-24', '08:00', '17:00');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `ID` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `Field` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`ID`, `name`, `Field`, `email`, `password`) VALUES
(3, 'jazz', 'CS', 'jazz@gmail.com', '$2y$10$QK3U7Q3zxufx9766lYElA.gn5LLRflWA3v7Fr.aIdLe9ZuTv9tLI2'),
(4, 'zong', 'CS', 'zong@gmail.com', '$2y$10$hlFG2jPlI8Jed1PIxXG/5uMthKFZkyLYBgmZE..xu.3mSfILYZh36'),
(6, 'ufone', 'CS', 'ufone123@gmail.com', '$2y$10$sikBd8MzLCtPopImtDsXLOcob7S.Ap8VokhaT2HjQgRHEMjnmXjEe'),
(7, 'Telenor', 'CS', 'telenor123@gmail.com', '$2y$10$HMDcKvGcDe9yGClgiTO6GO0d0nr/I99Armpar5oavRU91dCusIIk2');

-- --------------------------------------------------------

--
-- Table structure for table `organizationreviews`
--

CREATE TABLE `organizationreviews` (
  `studentemail` varchar(250) NOT NULL,
  `reviews` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `organizationreviews`
--

INSERT INTO `organizationreviews` (`studentemail`, `reviews`) VALUES
('mm123@gmail.com', 'fgjgjygu'),
('mm123@gmail.com', 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj');

-- --------------------------------------------------------

--
-- Table structure for table `organizerproposaldecision`
--

CREATE TABLE `organizerproposaldecision` (
  `studentemail` varchar(250) NOT NULL,
  `organizationname` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `organizerproposaldecision`
--

INSERT INTO `organizerproposaldecision` (`studentemail`, `organizationname`, `status`) VALUES
('mm123@gmail.com', 'jazz', 'approved'),
('mm123@gmail.com', 'zong', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `ID` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `name`, `username`, `email`, `password`) VALUES
(1, 'Munam Mustafa ', '21I-0460', 'mm123@gmail.com', '$2y$10$NDjbFnipDbIFAWy2IAa0EO9wjwoNFyt1z54FQsk8SCHytP53DTul.'),
(3, 'muzammil', 'muzi', 'muzi123@gmail.com', '$2y$10$f2semBUXiKHub8FK7q5xHev4WwsYKXQQshFWGQ.c3MbIxbwItXFEW'),
(8, 'Ammar Arshad', 'Ammar123', 'ammar123@gmail.com', '$2y$10$dlkV81GaAo/EVw8wYSrNF.PFGC.fqGwxsZJs6/zNvbjDo5sCJE7vi');

-- --------------------------------------------------------

--
-- Table structure for table `studentresumedetails`
--

CREATE TABLE `studentresumedetails` (
  `fullname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `field` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `language` varchar(250) NOT NULL,
  `experties` varchar(250) NOT NULL,
  `currentsemester` varchar(250) NOT NULL,
  `skills` varchar(250) NOT NULL,
  `about` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `studentresumedetails`
--

INSERT INTO `studentresumedetails` (`fullname`, `email`, `field`, `phone`, `language`, `experties`, `currentsemester`, `skills`, `about`) VALUES
('Munam Mustafa Ahmed', '', 'CS', '03435231909', 'English, Urdu', 'All, All', '6', 'All, All', 'fdfdsfds'),
('Munam Mustafa Ahmed', '', 'CS', '03435231909', 'English, Urdu', 'All, All', '1', 'All, All', 'cdc'),
('Munam Mustafa', 'mm123@gmail.com', 'CS', '03435231909', 'English, Urdu', 'All, All', '1', 'All, All', 'sa'),
('Ammar Arshad', 'ammar123@gmail.com', 'CS', '03435231909', 'English, Urdu', 'All, All', '7', 'All, All', 'njnkjkj');

-- --------------------------------------------------------

--
-- Table structure for table `studentssubmittedproposal`
--

CREATE TABLE `studentssubmittedproposal` (
  `ID` int(11) NOT NULL,
  `studentemail` varchar(250) NOT NULL,
  `field` varchar(250) NOT NULL,
  `companyname` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `studentssubmittedproposal`
--

INSERT INTO `studentssubmittedproposal` (`ID`, `studentemail`, `field`, `companyname`) VALUES
(0, 'mm123@gmail.com', 'CS', 'jazz'),
(0, 'munam123@gmail.com', 'CS', 'jazz'),
(0, 'muzi123@gmail.com', 'CS', 'jazz'),
(0, 'mm123@gmail.com', 'CS', 'zong');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
