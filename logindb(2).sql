-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 30, 2020 at 04:11 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `APPOINTMENT`
--

CREATE TABLE `APPOINTMENT` (
  `ID` bigint(20) NOT NULL,
  `DAY_LVL` tinyint(4) NOT NULL,
  `DAY_TYPE` tinyint(4) NOT NULL,
  `CLIENT_ID` bigint(20) DEFAULT NULL,
  `CLIENT_ID2` bigint(20) DEFAULT NULL,
  `EMPLOYEE_ID` bigint(20) NOT NULL,
  `CLIENT_NAME` tinytext DEFAULT NULL,
  `CLIENT_CONTACT` varchar(20) DEFAULT NULL,
  `CLIENT_NAME2` tinytext DEFAULT NULL,
  `CLIENT_CONTACT2` varchar(20) DEFAULT NULL,
  `RIDE_DAY` date NOT NULL,
  `CANCELED` tinyint(4) NOT NULL,
  `CANCELLATION_REASON` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `APPOINTMENT`
--

INSERT INTO `APPOINTMENT` (`ID`, `DAY_LVL`, `DAY_TYPE`, `CLIENT_ID`, `CLIENT_ID2`, `EMPLOYEE_ID`, `CLIENT_NAME`, `CLIENT_CONTACT`, `CLIENT_NAME2`, `CLIENT_CONTACT2`, `RIDE_DAY`, `CANCELED`, `CANCELLATION_REASON`) VALUES
(1, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-10-25', 1, NULL),
(2, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-10-25', 1, NULL),
(3, 1, 1, 15, NULL, 1, NULL, NULL, NULL, NULL, '2020-10-30', 1, NULL),
(4, 1, 1, 15, NULL, 1, 'Samuel Wade', '5126619124', NULL, NULL, '2020-10-28', 1, NULL),
(5, 1, 2, 15, 13, 1, NULL, NULL, 'Cameron Cross', '123456789', '2020-10-31', 1, NULL),
(6, 2, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-11-02', 1, NULL),
(7, 1, 2, 15, NULL, 1, 'Samuel Wade', '5126619124', NULL, NULL, '2020-11-05', 1, NULL),
(8, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-11-07', 1, NULL),
(9, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-11-06', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `CLIENT`
--

CREATE TABLE `CLIENT` (
  `ID` bigint(20) NOT NULL,
  `FIRST_NAME` tinytext NOT NULL,
  `LAST_NAME` tinytext NOT NULL,
  `EMAIL` tinytext NOT NULL,
  `PASSWORD` longtext NOT NULL,
  `PHONE` varchar(20) DEFAULT NULL,
  `RIDER_LVL` tinyint(4) DEFAULT NULL,
  `NOTES` longtext DEFAULT NULL,
  `EMERGENCY_NAME` text DEFAULT NULL,
  `EMERGENCY_PHONE` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `CLIENT`
--

INSERT INTO `CLIENT` (`ID`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `PASSWORD`, `PHONE`, `RIDER_LVL`, `NOTES`, `EMERGENCY_NAME`, `EMERGENCY_PHONE`) VALUES
(13, 'Cameron', 'Cross', 'samwade2021@gmail.com', '$2y$10$JK4oW93xrKsKiuCvZpjaIeKgPZRGpHAJ0DsJg22KU6sKEJ0fAeo9.', '123456789', 1, '', NULL, NULL),
(15, 'Samuel', 'Wade', 'stwade@csustudent.net', '$2y$10$Rh85t88GFTNaBGYGf8uq1.JW1RrjbzHD0mdVtfOQKTBeLA04VQ8wO', '5126619124', 1, NULL, 'Annie', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `EMPLOYEE`
--

CREATE TABLE `EMPLOYEE` (
  `ID` bigint(20) NOT NULL,
  `FIRST_NAME` tinytext NOT NULL,
  `LAST_NAME` tinytext NOT NULL,
  `EMAIL` tinytext NOT NULL,
  `PASSWORD` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `EMPLOYEE`
--

INSERT INTO `EMPLOYEE` (`ID`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `PASSWORD`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$coxj1xm9SR941JgaXtDSO.cC90g.qBjjs1iNYbYo.XioJnBCAyuwy'),
(2, 'Admin', 'Admin', 'admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `NEWS`
--

CREATE TABLE `NEWS` (
  `NEWS_POST` longtext NOT NULL,
  `DATE_POSTED` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `NEWS`
--

INSERT INTO `NEWS` (`NEWS_POST`, `DATE_POSTED`) VALUES
('Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', '2020-10-08'),
('Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', '2020-10-17'),
('Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', '2020-10-02'),
('Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', '2020-10-28'),
('This is a new news post', '2020-10-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `APPOINTMENT`
--
ALTER TABLE `APPOINTMENT`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EMPLOYEE_ID` (`EMPLOYEE_ID`),
  ADD KEY `CLIENT_ID` (`CLIENT_ID`),
  ADD KEY `CLIENT_ID2` (`CLIENT_ID2`);

--
-- Indexes for table `CLIENT`
--
ALTER TABLE `CLIENT`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `APPOINTMENT`
--
ALTER TABLE `APPOINTMENT`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `CLIENT`
--
ALTER TABLE `CLIENT`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `APPOINTMENT`
--
ALTER TABLE `APPOINTMENT`
  ADD CONSTRAINT `APPOINTMENT_ibfk_1` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `EMPLOYEE` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `APPOINTMENT_ibfk_2` FOREIGN KEY (`CLIENT_ID`) REFERENCES `CLIENT` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `APPOINTMENT_ibfk_3` FOREIGN KEY (`CLIENT_ID2`) REFERENCES `CLIENT` (`ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
