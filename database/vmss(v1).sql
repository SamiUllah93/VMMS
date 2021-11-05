-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2021 at 06:47 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vmss`
--

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `armyno` varchar(20) NOT NULL,
  `created` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_record`
--

CREATE TABLE `fuel_record` (
  `fuel_id` bigint(20) NOT NULL,
  `vehicle_id` bigint(20) NOT NULL,
  `total_fuel_added` decimal(10,0) NOT NULL,
  `total_running` decimal(10,0) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `maintenance_id` bigint(50) NOT NULL,
  `title` varchar(20) NOT NULL,
  `created` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_vehicle`
--

CREATE TABLE `maintenance_vehicle` (
  `maintenance_vehicle_ID` int(50) NOT NULL,
  `maintenance_ID` bigint(50) NOT NULL,
  `vehicle_ID` bigint(50) NOT NULL,
  `duration_In_days` int(50) NOT NULL,
  `distance` int(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `next_due` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `part_id` bigint(50) NOT NULL,
  `title` varchar(20) NOT NULL,
  `vehicle_ID` bigint(20) NOT NULL,
  `Added_date` datetime(6) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` int(50) NOT NULL,
  `password` int(50) NOT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `isadmin` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `Vehicle_ID` bigint(50) NOT NULL,
  `BA_NO` varchar(50) NOT NULL,
  `Make_Type` varchar(50) NOT NULL,
  `Issued_On` datetime(6) NOT NULL,
  `Year_of_Manufacturer` int(6) NOT NULL,
  `Driver_ID` bigint(50) NOT NULL,
  `created` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `Status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `fuel_record`
--
ALTER TABLE `fuel_record`
  ADD PRIMARY KEY (`fuel_id`),
  ADD KEY `vehicle_id_fk` (`vehicle_id`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`maintenance_id`);

--
-- Indexes for table `maintenance_vehicle`
--
ALTER TABLE `maintenance_vehicle`
  ADD PRIMARY KEY (`maintenance_vehicle_ID`),
  ADD KEY `maintenance_id-fk` (`maintenance_ID`),
  ADD KEY `vehicle_id_fk` (`vehicle_ID`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`part_id`),
  ADD KEY `vehicle_ID` (`vehicle_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`Vehicle_ID`),
  ADD KEY `Driver_ID_FK` (`Driver_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuel_record`
--
ALTER TABLE `fuel_record`
  MODIFY `fuel_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `maintenance_id` bigint(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenance_vehicle`
--
ALTER TABLE `maintenance_vehicle`
  MODIFY `maintenance_vehicle_ID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `part_id` bigint(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `Vehicle_ID` bigint(50) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `maintenance_vehicle`
--
ALTER TABLE `maintenance_vehicle`
  ADD CONSTRAINT `maintenance_vehicle_ibfk_1` FOREIGN KEY (`maintenance_ID`) REFERENCES `maintenance` (`maintenance_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maintenance_vehicle_ibfk_2` FOREIGN KEY (`vehicle_ID`) REFERENCES `vehicle` (`Vehicle_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parts`
--
ALTER TABLE `parts`
  ADD CONSTRAINT `parts_ibfk_1` FOREIGN KEY (`vehicle_ID`) REFERENCES `vehicle` (`Vehicle_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`Driver_ID`) REFERENCES `driver` (`driver_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
