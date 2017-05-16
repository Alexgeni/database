-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 16, 2017 at 05:00 PM
-- Server version: 5.7.18-0ubuntu0.17.04.1
-- PHP Version: 7.0.18-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faculty`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `cid` int(11) NOT NULL,
  `name` char(50) DEFAULT NULL,
  `c_code` char(50) NOT NULL,
  `hrs` int(50) NOT NULL,
  `did` int(11) NOT NULL,
  `div_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`cid`, `name`, `c_code`, `hrs`, `did`, `div_id`) VALUES
(0, 'Computer programming', 'cs201', 2, 6, 0),
(1, 'Advanced programming', 'cs206', 3, 6, 0),
(2, 'Networks', 'cs304', 3, 6, 0),
(3, 'Biological Diversity and Insect Environment', 'i202', 3, 3, 0),
(4, 'Classification and emergence of insects', 'i206', 3, 3, 0),
(5, 'Insect Physiology', 'i306', 3, 3, 0),
(6, 'physology', 'p204', 2, 4, 0),
(7, 'Algae biology', 'p208', 2, 4, 0),
(8, 'Plant cell biology\r\n', 'p221', 2, 4, 0),
(9, 'General Physics', 'ph112', 3, 2, 1),
(10, 'Crystalline Physics and Electronics', 'ph204', 2, 2, 0),
(11, 'Electromagnetism', 'ph210', 2, 2, 0),
(12, 'Introduction to Probability and Statistics', 's102', 2, 5, 1),
(13, 'Biostatistics', 's122', 2, 5, 1),
(14, 'Statistical Methods', 's201', 3, 5, 0),
(15, 'Introdaction into programming', 'cs102', 3, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `did` int(255) NOT NULL,
  `dname` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`did`, `dname`) VALUES
(1, 'Chemistry'),
(2, 'Physics'),
(3, 'Insects'),
(4, 'Plant'),
(5, 'Statistics'),
(6, 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `departmentdivision`
--

CREATE TABLE `departmentdivision` (
  `did` int(11) NOT NULL,
  `div_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departmentdivision`
--

INSERT INTO `departmentdivision` (`did`, `div_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 2),
(4, 2),
(1, 1),
(5, 1),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `div_id` int(50) NOT NULL,
  `div_name` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`div_id`, `div_name`) VALUES
(0, 'not registered'),
(1, 'Nature Science'),
(2, 'Biology');

-- --------------------------------------------------------

--
-- Table structure for table `finished_courses`
--

CREATE TABLE `finished_courses` (
  `sid` bigint(20) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registered_courses`
--

CREATE TABLE `registered_courses` (
  `sid` bigint(20) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registered_courses`
--

INSERT INTO `registered_courses` (`sid`, `cid`) VALUES
(17711402991, 9),
(17711402991, 12);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `sid` bigint(255) NOT NULL,
  `fname` char(50) NOT NULL,
  `lname` char(50) NOT NULL,
  `sname` char(50) NOT NULL,
  `tname` char(50) NOT NULL,
  `pword` char(50) NOT NULL,
  `tel` bigint(255) NOT NULL,
  `phone` bigint(255) NOT NULL,
  `amail` char(50) NOT NULL,
  `email` char(50) NOT NULL,
  `nid` bigint(255) NOT NULL,
  `address` char(50) NOT NULL,
  `gender` char(50) NOT NULL,
  `div_id` int(40) NOT NULL,
  `cgpa` double NOT NULL,
  `hrs` int(50) NOT NULL,
  `major` char(50) NOT NULL,
  `minor` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sid`, `fname`, `lname`, `sname`, `tname`, `pword`, `tel`, `phone`, `amail`, `email`, `nid`, `address`, `gender`, `div_id`, `cgpa`, `hrs`, `major`, `minor`) VALUES
(17711402991, 'Isaac', 'Said', 'Omar', 'Newton', '12345', 3241234, 1298389212, '', 'esne@phy.edi', 3178231361, 'abdeen cairo', 'Male', 1, 4, 60, '6', '5'),
(123123123123, 'Mohamed', 'ahmed', 'Adel', 'atia', '123123123123', 123123123123, 123123123123, '', 'weffd', 123123132, 'asd', 'Male', 1, 4, 0, '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `c_code` (`c_code`),
  ADD KEY `did` (`did`),
  ADD KEY `div_id` (`div_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `departmentdivision`
--
ALTER TABLE `departmentdivision`
  ADD KEY `did` (`did`),
  ADD KEY `div_id` (`div_id`);

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`div_id`);

--
-- Indexes for table `finished_courses`
--
ALTER TABLE `finished_courses`
  ADD KEY `sid` (`sid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `registered_courses`
--
ALTER TABLE `registered_courses`
  ADD KEY `sid` (`sid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nid` (`nid`),
  ADD KEY `sid` (`sid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`did`) REFERENCES `department` (`did`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`div_id`) REFERENCES `division` (`div_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departmentdivision`
--
ALTER TABLE `departmentdivision`
  ADD CONSTRAINT `departmentdivision_ibfk_1` FOREIGN KEY (`did`) REFERENCES `department` (`did`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `departmentdivision_ibfk_2` FOREIGN KEY (`div_id`) REFERENCES `division` (`div_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `finished_courses`
--
ALTER TABLE `finished_courses`
  ADD CONSTRAINT `finished_courses_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`) ON DELETE CASCADE,
  ADD CONSTRAINT `finished_courses_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `courses` (`cid`) ON DELETE CASCADE;

--
-- Constraints for table `registered_courses`
--
ALTER TABLE `registered_courses`
  ADD CONSTRAINT `registered_courses_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`) ON DELETE CASCADE,
  ADD CONSTRAINT `registered_courses_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `courses` (`cid`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
