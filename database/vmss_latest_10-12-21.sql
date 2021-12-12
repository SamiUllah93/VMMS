-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2021 at 11:52 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `updated` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `title`, `created`, `updated`, `status`) VALUES
(2, 'Bin Qasim', '2021-11-21', NULL, 1),
(6, 'Alpha', '2021-11-22', NULL, 1);

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

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `name`, `armyno`, `created`, `status`) VALUES
(3, 'Imtiaz Ali', 'PA-987654', '2021-11-05 19:32:59.897449', 1),
(5, 'Laeeq Rehman', 'PA-45645', '2021-11-06 21:36:28.490528', 1),
(6, 'Anees Ahmad Khan', 'PA-5467', '2021-11-06 21:36:38.005154', 1),
(7, 'Ghafoor', 'PAL-998', '2021-11-21 21:05:32.521151', 1);

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

--
-- Dumping data for table `fuel_record`
--

INSERT INTO `fuel_record` (`fuel_id`, `vehicle_id`, `total_fuel_added`, `total_running`, `created`, `status`) VALUES
(5, 20, '10', '180', '2021-12-07 20:04:58', 0),
(6, 20, '20', '360', '2021-12-07 20:05:19', 0),
(7, 17, '10', '180', '2021-12-07 20:05:42', 0),
(8, 18, '10', '50', '2021-12-07 20:06:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `maintenance_id` bigint(50) NOT NULL,
  `title` varchar(80) NOT NULL,
  `created` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`maintenance_id`, `title`, `created`, `status`) VALUES
(1, 'Engine Oil Changed', '2021-11-05 19:39:07.885281', 0),
(2, 'Brake Oil Change', '2021-11-05 19:39:40.453604', 0),
(3, 'Clutch Set Update', '2021-11-05 19:39:54.421050', 0),
(4, 'Tire Replacement', '2021-11-05 19:40:03.601611', 0),
(5, 'Oil Filter Change', '2021-11-05 19:40:16.113508', 0);

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_vehicle`
--

CREATE TABLE `maintenance_vehicle` (
  `maintenance_vehicle_ID` bigint(50) NOT NULL,
  `maintenance_ID` bigint(50) NOT NULL,
  `vehicle_ID` bigint(50) NOT NULL,
  `duration_In_days` int(50) NOT NULL,
  `distance` int(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `next_due` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maintenance_vehicle`
--

INSERT INTO `maintenance_vehicle` (`maintenance_vehicle_ID`, `maintenance_ID`, `vehicle_ID`, `duration_In_days`, `distance`, `status`, `next_due`) VALUES
(9, 1, 17, 20, 3000, 0, '2021-12-30'),
(10, 4, 17, 730, 25000, 0, '2023-11-23'),
(11, 1, 18, 30, 3000, 0, '2021-12-23'),
(12, 2, 18, 25, 30000, 0, '2021-12-08'),
(15, 1, 20, 90, 3000, 0, '2021-12-07'),
(16, 2, 20, 365, 10000, 0, '2022-12-08'),
(17, 2, 22, 3000, 2500, 0, '2030-02-26'),
(18, 1, 23, 123, 123, 0, '2022-04-12'),
(19, 1, 24, 90, 3000, 0, '2022-03-10'),
(20, 1, 25, 3000, 3000, 0, '2030-02-26'),
(21, 1, 26, 123, 123, 0, '2022-04-12');

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
-- Table structure for table `process_maintenance`
--

CREATE TABLE `process_maintenance` (
  `process_maintenance_id` bigint(50) NOT NULL,
  `maintenance_vehicleid` bigint(50) NOT NULL,
  `odometer_reading` int(50) NOT NULL,
  `created` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `Status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `process_maintenance`
--

INSERT INTO `process_maintenance` (`process_maintenance_id`, `maintenance_vehicleid`, `odometer_reading`, `created`, `Status`) VALUES
(16, 16, 986565, '2021-12-07 19:57:31.170409', 0),
(17, 9, 123465, '2021-12-09 21:48:48.600409', 0);

-- --------------------------------------------------------

--
-- Table structure for table `quarterly_checklist`
--

CREATE TABLE `quarterly_checklist` (
  `quarterly_checklist_ID` bigint(50) NOT NULL,
  `maintenance_name` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quarterly_checklist`
--

INSERT INTO `quarterly_checklist` (`quarterly_checklist_ID`, `maintenance_name`, `status`, `created`) VALUES
(1, 'Olugboi Fashiyon', 1, '2021-11-23 02:34:56'),
(3, 'TEst', 0, '2021-11-23 02:40:39'),
(5, 'Mori mai dard', 0, '2021-11-23 03:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `quarterly_maintenance_vehicle`
--

CREATE TABLE `quarterly_maintenance_vehicle` (
  `quarterly_maintenance_vehicle_ID` bigint(20) NOT NULL,
  `quarterly_checklist_ID` bigint(20) NOT NULL,
  `vehicle_ID` bigint(20) NOT NULL,
  `Remarks` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quarterly_maintenance_vehicle`
--

INSERT INTO `quarterly_maintenance_vehicle` (`quarterly_maintenance_vehicle_ID`, `quarterly_checklist_ID`, `vehicle_ID`, `Remarks`, `status`, `created`) VALUES
(33, 1, 26, '123', 0, '2021-12-10 03:48:44'),
(34, 3, 26, '123', 0, '2021-12-10 03:48:44'),
(35, 5, 26, '123', 0, '2021-12-10 03:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `isadmin` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `created`, `updated`, `isadmin`, `status`) VALUES
(1, 'Faisal', 'faisal@gmail.com', 'BetaHouse123#', '2021-11-05 17:55:45', '2021-11-05 17:55:45', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `Vehicle_ID` bigint(50) NOT NULL,
  `BA_NO` varchar(50) NOT NULL,
  `Make_Type` varchar(50) NOT NULL,
  `Issued_On` date NOT NULL,
  `Year_of_Manufacturer` int(6) NOT NULL,
  `odo_reading` bigint(20) NOT NULL DEFAULT 0,
  `qtrly_service_date` date DEFAULT NULL,
  `yrly_service_date` date DEFAULT NULL,
  `Driver_ID` bigint(50) DEFAULT NULL,
  `company_id` bigint(20) DEFAULT NULL,
  `created` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `Status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`Vehicle_ID`, `BA_NO`, `Make_Type`, `Issued_On`, `Year_of_Manufacturer`, `odo_reading`, `qtrly_service_date`, `yrly_service_date`, `Driver_ID`, `company_id`, `created`, `Status`) VALUES
(17, 'IDK3946', '5ton', '2021-11-23', 2010, 0, '2021-09-17', '2021-09-22', 5, NULL, '2021-11-22 19:47:45.941444', 0),
(18, 'RIA225', '10ton', '2021-11-17', 2010, 0, '2021-09-15', '2021-09-17', 7, NULL, '2021-11-22 19:48:45.165134', 0),
(20, 'LXR 8000', 'Honda Civic', '2020-11-07', 2001, 0, '2021-09-15', '2021-09-17', 6, NULL, '2021-12-07 19:38:00.895518', 0),
(22, 'Test123', 'STEST', '2020-11-09', 2012, 0, '2020-12-10', '2021-09-17', 3, NULL, '2021-12-09 21:22:59.448650', 0),
(23, 'TEST', 'Test', '2020-11-09', 2012, 0, '2021-11-30', '2022-12-10', NULL, 2, '2021-12-09 21:23:26.576057', 0),
(24, 'SV-307', 'City', '2020-11-09', 2018, 0, '2022-03-01', '2022-12-10', NULL, 2, '2021-12-09 21:32:11.141055', 0),
(25, 'AVU-202', 'Kia Sportage', '2020-11-09', 2021, 526, '2021-10-09', '2020-11-09', NULL, 6, '2021-12-09 22:43:37.212461', 0),
(26, 'TEST99', 'Test99', '2021-12-10', 2018, 123465, '2022-03-02', '2022-12-01', NULL, 2, '2021-12-09 22:44:40.868789', 0);

-- --------------------------------------------------------

--
-- Table structure for table `yearly_checklist`
--

CREATE TABLE `yearly_checklist` (
  `yearly_checklist_ID` bigint(20) NOT NULL,
  `maintenance_name` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `yearly_checklist`
--

INSERT INTO `yearly_checklist` (`yearly_checklist_ID`, `maintenance_name`, `status`, `created`) VALUES
(1, 'Body Paint', 0, '2021-11-23 02:46:17'),
(2, 'Rim Job', 0, '2021-11-23 02:46:23');

-- --------------------------------------------------------

--
-- Table structure for table `yearly_checklist_maintenance`
--

CREATE TABLE `yearly_checklist_maintenance` (
  `yearly_checklist_maintenance_ID` bigint(20) NOT NULL,
  `yearly_checklist_ID` bigint(20) NOT NULL,
  `vehicle_ID` bigint(11) NOT NULL,
  `Remarks` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `yearly_checklist_maintenance`
--

INSERT INTO `yearly_checklist_maintenance` (`yearly_checklist_maintenance_ID`, `yearly_checklist_ID`, `vehicle_ID`, `Remarks`, `status`, `created`) VALUES
(17, 1, 26, 321, 0, '2021-12-10 03:49:30'),
(18, 2, 26, 132, 0, '2021-12-10 03:49:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

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
-- Indexes for table `process_maintenance`
--
ALTER TABLE `process_maintenance`
  ADD PRIMARY KEY (`process_maintenance_id`),
  ADD KEY `process_maintenance_fk` (`maintenance_vehicleid`);

--
-- Indexes for table `quarterly_checklist`
--
ALTER TABLE `quarterly_checklist`
  ADD PRIMARY KEY (`quarterly_checklist_ID`);

--
-- Indexes for table `quarterly_maintenance_vehicle`
--
ALTER TABLE `quarterly_maintenance_vehicle`
  ADD PRIMARY KEY (`quarterly_maintenance_vehicle_ID`),
  ADD KEY `checklist` (`quarterly_checklist_ID`),
  ADD KEY `vid` (`vehicle_ID`);

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
  ADD KEY `Driver_ID_FK` (`Driver_ID`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `yearly_checklist`
--
ALTER TABLE `yearly_checklist`
  ADD PRIMARY KEY (`yearly_checklist_ID`);

--
-- Indexes for table `yearly_checklist_maintenance`
--
ALTER TABLE `yearly_checklist_maintenance`
  ADD PRIMARY KEY (`yearly_checklist_maintenance_ID`),
  ADD KEY `FK` (`yearly_checklist_ID`),
  ADD KEY `FK1` (`vehicle_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fuel_record`
--
ALTER TABLE `fuel_record`
  MODIFY `fuel_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `maintenance_id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `maintenance_vehicle`
--
ALTER TABLE `maintenance_vehicle`
  MODIFY `maintenance_vehicle_ID` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `part_id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `process_maintenance`
--
ALTER TABLE `process_maintenance`
  MODIFY `process_maintenance_id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `quarterly_checklist`
--
ALTER TABLE `quarterly_checklist`
  MODIFY `quarterly_checklist_ID` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quarterly_maintenance_vehicle`
--
ALTER TABLE `quarterly_maintenance_vehicle`
  MODIFY `quarterly_maintenance_vehicle_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `Vehicle_ID` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `yearly_checklist`
--
ALTER TABLE `yearly_checklist`
  MODIFY `yearly_checklist_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `yearly_checklist_maintenance`
--
ALTER TABLE `yearly_checklist_maintenance`
  MODIFY `yearly_checklist_maintenance_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fuel_record`
--
ALTER TABLE `fuel_record`
  ADD CONSTRAINT `fuel_record_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`Vehicle_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `process_maintenance`
--
ALTER TABLE `process_maintenance`
  ADD CONSTRAINT `process_maintenance_ibfk_1` FOREIGN KEY (`maintenance_vehicleid`) REFERENCES `maintenance_vehicle` (`maintenance_vehicle_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quarterly_maintenance_vehicle`
--
ALTER TABLE `quarterly_maintenance_vehicle`
  ADD CONSTRAINT `FK ` FOREIGN KEY (`quarterly_checklist_ID`) REFERENCES `quarterly_checklist` (`quarterly_checklist_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK 1` FOREIGN KEY (`vehicle_ID`) REFERENCES `vehicle` (`Vehicle_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`Driver_ID`) REFERENCES `driver` (`driver_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehicle_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `yearly_checklist_maintenance`
--
ALTER TABLE `yearly_checklist_maintenance`
  ADD CONSTRAINT `VCID` FOREIGN KEY (`vehicle_ID`) REFERENCES `vehicle` (`Vehicle_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `YCID` FOREIGN KEY (`yearly_checklist_ID`) REFERENCES `yearly_checklist` (`yearly_checklist_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
