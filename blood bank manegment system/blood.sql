-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 06:53 AM
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
-- Database: `blood`
--

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `D_ID` int(11) NOT NULL,
  `H_ID` int(11) NOT NULL,
  `H_NAME` varchar(40) NOT NULL,
  `H_EMAIL` varchar(30) NOT NULL,
  `H_PHONE` int(15) NOT NULL,
  `H_CITY` varchar(20) NOT NULL,
  `H_ADDRESS` varchar(30) NOT NULL,
  `D_NAME` varchar(30) NOT NULL,
  `D_GENDER` varchar(10) NOT NULL DEFAULT 'Male',
  `D_EMAIL` varchar(30) NOT NULL,
  `D_PHONE` int(15) NOT NULL,
  `D_BLOOD` varchar(10) NOT NULL,
  `ACTION` varchar(20) NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`D_ID`, `H_ID`, `H_NAME`, `H_EMAIL`, `H_PHONE`, `H_CITY`, `H_ADDRESS`, `D_NAME`, `D_GENDER`, `D_EMAIL`, `D_PHONE`, `D_BLOOD`, `ACTION`) VALUES
(36, 12, 'Manhal hospital', 'manhal@gmail.com', 908768676, 'bosaso', 'New bosaso', 'Ali axmed ciise', 'Male', 'ali@gmail.com', 78967656, 'B+', 'Available'),
(37, 12, 'Manhal hospital', 'manhal@gmail.com', 908768676, 'bosaso', 'New bosaso', 'siciid faarax ismaaciil', 'Male', 'siciid@gmail.com', 78656766, 'A+', 'Available'),
(40, 12, 'manhal Hospital', 'manhal@gmail.com', 11111111, 'bosaso', 'M-faadumo', 'cabdi ali', 'Male', 'abdi@gmail.com', 6576576, 'A+', 'Taked');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `H_ID` int(11) NOT NULL,
  `H_NAME` varchar(40) NOT NULL,
  `H_EMAIL` varchar(30) NOT NULL,
  `H_PASSWORD` varchar(255) NOT NULL,
  `H_PHONE` int(15) NOT NULL,
  `H_CITY` varchar(20) NOT NULL,
  `H_ADDRESS` varchar(20) NOT NULL,
  `H_IMAGE` varchar(255) NOT NULL DEFAULT 'hospital_profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`H_ID`, `H_NAME`, `H_EMAIL`, `H_PASSWORD`, `H_PHONE`, `H_CITY`, `H_ADDRESS`, `H_IMAGE`) VALUES
(12, 'manhal Hospital', 'manhal@gmail.com', '1234', 11111111, 'bosaso', 'M-faadumo', 'download (1).png6763fbfb8dbdd5.56440532.png');

-- --------------------------------------------------------

--
-- Table structure for table `receiver`
--

CREATE TABLE `receiver` (
  `R_ID` int(11) NOT NULL,
  `R_BLOOD` varchar(5) NOT NULL,
  `R_NAME` varchar(30) NOT NULL,
  `R_GENDER` varchar(10) NOT NULL DEFAULT 'Male',
  `R_EMAIL` varchar(30) NOT NULL,
  `R_PASSWORD` varchar(255) NOT NULL,
  `R_PHONE` int(15) NOT NULL,
  `R_CITY` varchar(20) NOT NULL,
  `R_IMAGE` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receiver`
--

INSERT INTO `receiver` (`R_ID`, `R_BLOOD`, `R_NAME`, `R_GENDER`, `R_EMAIL`, `R_PASSWORD`, `R_PHONE`, `R_CITY`, `R_IMAGE`) VALUES
(19, 'O+', 'Faarax maxamed', 'Male', 'faarax@gmail.com', '1234', 2147483647, 'bosaso', 'default.jpg'),
(20, 'A+', 'maxamed axmed', 'Male', 'maxamed@gmail.com', '1234', 222222222, 'bosaso', 'download (2).png6763ffdc06a5c1.65222742.png');

-- --------------------------------------------------------

--
-- Table structure for table `request_tb`
--

CREATE TABLE `request_tb` (
  `RQ_ID` int(11) NOT NULL,
  `H_ID` int(11) NOT NULL,
  `H_NAME` varchar(40) NOT NULL,
  `H_EMAIL` varchar(30) NOT NULL,
  `H_PHONE` int(15) NOT NULL,
  `H_CITY` varchar(20) NOT NULL,
  `H_ADDRESS` varchar(20) NOT NULL,
  `D_ID` int(11) NOT NULL,
  `R_ID` int(11) NOT NULL,
  `R_NAME` varchar(40) NOT NULL,
  `R_GENDER` varchar(10) NOT NULL DEFAULT 'Male',
  `R_EMAIL` varchar(30) NOT NULL,
  `R_PHONE` int(15) NOT NULL,
  `R_BLOOD` varchar(10) NOT NULL,
  `ACTION` varchar(20) NOT NULL DEFAULT 'Requested'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_tb`
--

INSERT INTO `request_tb` (`RQ_ID`, `H_ID`, `H_NAME`, `H_EMAIL`, `H_PHONE`, `H_CITY`, `H_ADDRESS`, `D_ID`, `R_ID`, `R_NAME`, `R_GENDER`, `R_EMAIL`, `R_PHONE`, `R_BLOOD`, `ACTION`) VALUES
(27, 12, 'manhal Hospital', 'manhal@gmail.com', 11111111, 'bosaso', 'M-faadumo', 37, 20, 'maxamed', 'Male', 'maxamed@gmail.com', 987686987, 'A+', 'Rejected'),
(28, 12, 'manhal Hospital', 'manhal@gmail.com', 11111111, 'bosaso', 'M-faadumo', 40, 20, 'maxamed', 'Male', 'maxamed@gmail.com', 987686987, 'A+', 'Accepted');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`D_ID`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`H_ID`),
  ADD UNIQUE KEY `H_EMAIL` (`H_EMAIL`);

--
-- Indexes for table `receiver`
--
ALTER TABLE `receiver`
  ADD PRIMARY KEY (`R_ID`),
  ADD UNIQUE KEY `R_ID` (`R_ID`,`R_EMAIL`);

--
-- Indexes for table `request_tb`
--
ALTER TABLE `request_tb`
  ADD PRIMARY KEY (`RQ_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `D_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `H_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `receiver`
--
ALTER TABLE `receiver`
  MODIFY `R_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `request_tb`
--
ALTER TABLE `request_tb`
  MODIFY `RQ_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
