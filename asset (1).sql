-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2025 at 10:28 AM
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
-- Database: `asset`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset_tb`
--

CREATE TABLE `asset_tb` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `CATEGORY` varchar(100) NOT NULL,
  `DATE` varchar(100) NOT NULL,
  `LOCATION_ID` int(100) NOT NULL,
  `CONDITION_ID` int(100) NOT NULL,
  `ASSIGNED_TO` varchar(100) NOT NULL,
  `NOTES` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_tb`
--

INSERT INTO `asset_tb` (`ID`, `NAME`, `CATEGORY`, `DATE`, `LOCATION_ID`, `CONDITION_ID`, `ASSIGNED_TO`, `NOTES`) VALUES
(1, 'Desktop', 'Electronics', '2025-02-13', 2, 2, 'Ciise Axmed', 'Desktop working'),
(4, 'Keyboard', 'Electronics', '2025-02-06', 1, 1, 'Sharmaake Axmed', 'Keyboard'),
(5, 'Laptop', 'Electronics', '2025-02-13', 1, 1, 'Muse Yusuf', 'laptop working');

-- --------------------------------------------------------

--
-- Table structure for table `condition_tb`
--

CREATE TABLE `condition_tb` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `condition_tb`
--

INSERT INTO `condition_tb` (`ID`, `NAME`) VALUES
(1, 'Working'),
(2, 'Scrap');

-- --------------------------------------------------------

--
-- Table structure for table `employee_tb`
--

CREATE TABLE `employee_tb` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PHONE` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_tb`
--

INSERT INTO `employee_tb` (`ID`, `NAME`, `EMAIL`, `PHONE`) VALUES
(1, 'Sharmaake Yuusuf', 'sharmaake@gmail.com', '8080800'),
(3, 'Maxamed Cismaan', 'maxamed@gmail.com', '11111111');

-- --------------------------------------------------------

--
-- Table structure for table `location_tb`
--

CREATE TABLE `location_tb` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `DATE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location_tb`
--

INSERT INTO `location_tb` (`ID`, `NAME`, `DATE`) VALUES
(1, 'Al-Nakhiil', '1/2/2025'),
(2, 'Main Campus', '1/2/2025');

-- --------------------------------------------------------

--
-- Table structure for table `system_tb`
--

CREATE TABLE `system_tb` (
  `ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `ACTION` varchar(100) NOT NULL,
  `DATE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_tb`
--

INSERT INTO `system_tb` (`ID`, `USER_ID`, `ACTION`, `DATE`) VALUES
(1, 1, 'Login', 'Thursday 13th of February 2025 08:33:38 AM'),
(2, 1, 'Logout', 'Thursday 13th of February 2025 09:40:25 AM'),
(3, 1, 'Login', 'Thursday 13th of February 2025 10:00:58 AM'),
(4, 1, 'Logout', 'Thursday 13th of February 2025 12:25:19 PM'),
(5, 1, 'Login', 'Thursday 13th of February 2025 12:28:16 PM');

-- --------------------------------------------------------

--
-- Table structure for table `users_tb`
--

CREATE TABLE `users_tb` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `PHONE` varchar(20) NOT NULL,
  `USER_TYPE` varchar(20) NOT NULL DEFAULT 'Employee',
  `IMAGE` varchar(255) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_tb`
--

INSERT INTO `users_tb` (`ID`, `NAME`, `EMAIL`, `PASSWORD`, `PHONE`, `USER_TYPE`, `IMAGE`) VALUES
(1, 'Abdimaalik Xamari', 'cxamari100@gmail.com', '$2y$10$Z9wWz3o56p3Prk9126oRxeHZT/KMHyDNwIJm4S/ZanMd/GY0R7wQi', '907442210', 'Admin', 'default.png'),
(2, 'Abdixakiin Maxamuud', 'iamismail@gmail.com', '$2y$10$5/8ijjuwLZ31Eof/v1r/SeLMQBJL0tE/lHeItv3N.hvu94Bl8YHC6', '907202657', 'Admin', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `ID` int(11) NOT NULL,
  `U_ID` int(11) NOT NULL,
  `TAKEN` varchar(255) NOT NULL,
  `EXPIRE_AT` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`ID`, `U_ID`, `TAKEN`, `EXPIRE_AT`) VALUES
(3, 1, '6c5ce373a023f916f72db7e6f467b62d5e3def16abaa9aa23f0f62ba6371b74c', '1742030896');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset_tb`
--
ALTER TABLE `asset_tb`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `LOCATION_ID` (`LOCATION_ID`),
  ADD KEY `CONDITION_ID` (`CONDITION_ID`);

--
-- Indexes for table `condition_tb`
--
ALTER TABLE `condition_tb`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employee_tb`
--
ALTER TABLE `employee_tb`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `location_tb`
--
ALTER TABLE `location_tb`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `system_tb`
--
ALTER TABLE `system_tb`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `users_tb`
--
ALTER TABLE `users_tb`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `U_ID` (`U_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset_tb`
--
ALTER TABLE `asset_tb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `condition_tb`
--
ALTER TABLE `condition_tb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_tb`
--
ALTER TABLE `employee_tb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `location_tb`
--
ALTER TABLE `location_tb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_tb`
--
ALTER TABLE `system_tb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_tb`
--
ALTER TABLE `users_tb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asset_tb`
--
ALTER TABLE `asset_tb`
  ADD CONSTRAINT `asset_tb_ibfk_1` FOREIGN KEY (`LOCATION_ID`) REFERENCES `location_tb` (`ID`),
  ADD CONSTRAINT `asset_tb_ibfk_2` FOREIGN KEY (`CONDITION_ID`) REFERENCES `condition_tb` (`ID`),
  ADD CONSTRAINT `asset_tb_ibfk_3` FOREIGN KEY (`LOCATION_ID`) REFERENCES `location_tb` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asset_tb_ibfk_4` FOREIGN KEY (`CONDITION_ID`) REFERENCES `condition_tb` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `system_tb`
--
ALTER TABLE `system_tb`
  ADD CONSTRAINT `system_tb_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users_tb` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`U_ID`) REFERENCES `users_tb` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
