-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2022 at 09:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservation_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `InvoiceNo` int(11) NOT NULL,
  `PaymentDate` date NOT NULL DEFAULT current_timestamp(),
  `PaymentMode` varchar(50) NOT NULL,
  `CottagePrice` int(11) NOT NULL,
  `RoomPrice` int(11) NOT NULL,
  `videokeRent` int(11) NOT NULL,
  `CustomerId` varchar(50) NOT NULL,
  `ReservationId` varchar(50) NOT NULL,
  `TotalBill` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `isRefund` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`InvoiceNo`, `PaymentDate`, `PaymentMode`, `CottagePrice`, `RoomPrice`, `videokeRent`, `CustomerId`, `ReservationId`, `TotalBill`, `createdDate`, `isRefund`) VALUES
(65, '2022-09-22', 'Manual', 0, 0, 0, '72', '70', 2584, '2022-09-22 22:13:40', 0),
(66, '2022-09-22', 'Gcash', 0, 0, 0, '72', '70', -2067, '2022-09-22 22:14:52', 1),
(67, '2022-09-22', 'Manual', 0, 0, 0, '72', '71', 4, '2022-09-22 22:19:32', 0),
(68, '2022-09-22', 'Manual', 0, 0, 0, '72', '71', 60, '2022-09-22 22:38:24', 0),
(69, '2022-09-22', 'Gcash', 0, 0, 0, '72', '71', -51, '2022-09-22 23:17:51', 1),
(70, '2022-09-23', 'Manual', 0, 0, 0, '72', '72', 3230, '2022-09-23 07:39:25', 0),
(71, '2022-09-23', 'Gcash', 0, 0, 0, '72', '74', 646, '2022-09-23 07:57:48', 0),
(72, '2022-09-23', 'Gcash', 0, 0, 0, '72', '75', 0, '2022-09-23 14:05:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MiddleName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `PhoneNumber` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Age` varchar(3) NOT NULL,
  `Gender` varchar(7) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `FirstName`, `MiddleName`, `LastName`, `PhoneNumber`, `Address`, `Email`, `Age`, `Gender`, `createdDate`, `Password`, `username`) VALUES
(72, 'CLifford', 'Monterola', 'Ursabia', '09094373300', '', '', '', 'Male', '2022-09-14 20:22:29', 'asdasd', 'asdasd'),
(77, 'Clifford', 'CASIPONG', 'Ursabia', '322133', 'Level 5, 352 Kent St', 'clifford@alphasys.com.au', '3', 'Male', '2022-09-18 22:05:13', 'dsadsa', 'dsadsa'),
(78, 'Alpha', '', 'Test 4', '2312', 'Purok - 5', 'iamclifford321@gmail.com', '23', 'Male', '2022-09-18 22:05:48', 'qweqwe', 'qweqwe'),
(79, 'Clifford', 'CASIPONG', 'Ursabia', '3213', 'Level 5, 352 Kent St', 'clifford@alphasys.com.au', '321', 'Male', '2022-09-18 22:06:48', 'qweqwe', 'qweqwe'),
(80, 'Clifford', 'CASIPONG', 'Ursabia', '23423', 'Level 5, 352 Kent St', 'clifford@alphasys.com.au', '3', 'Male', '2022-09-18 22:07:56', 'qweqwe', 'qweqwe'),
(81, 'Clifford', '', 'Ursabi', '213', 'Purok - 1, Embargo', 'iamclifford321@gmail.com', '', 'Male', '2022-09-18 22:08:47', '123123', '123123'),
(82, 'Clifford', 'CASIPONG', 'Ursabia', '123123', 'Level 5, 352 Kent St', 'clifford@alphasys.com.au', '32', 'Male', '2022-09-18 22:09:34', 'sdasd', 'dsaasd'),
(83, 'Clifford', 'CASIPONG', 'Ursabia', '21', 'Level 5, 352 Kent St', 'clifford@alphasys.com.au', '2', 'Male', '2022-09-22 11:27:29', '', ''),
(84, 'Clifford', 'CASIPONG', 'Ursabia', '3213', 'Level 5, 352 Kent St', 'clifford@alphasys.com.au', '32', 'Male', '2022-09-22 23:52:58', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `Facility_name` varchar(255) NOT NULL,
  `Facility_id` int(11) NOT NULL,
  `Facility_type` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `description` text NOT NULL,
  `Image` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `createDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`Facility_name`, `Facility_id`, `Facility_type`, `Price`, `description`, `Image`, `status`, `createDate`) VALUES
('dsadas', 11, 0, 323, 'ewqewqe', '645655Screenshot 2022-09-14 072941.png', 'Activate', '2022-09-09 15:54:26'),
('Test', 12, 0, 32, 'ewqeqw', '215934Screenshot 2022-02-28 090205.png', 'Activate', '2022-09-09 15:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `Payment_id` int(11) NOT NULL,
  `Customer_id` varchar(50) NOT NULL,
  `Gcash_number` varchar(50) NOT NULL,
  `Payment_date` date NOT NULL DEFAULT current_timestamp(),
  `Reservation_id` varchar(50) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Amount` decimal(10,0) NOT NULL,
  `Receipt` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `isPartial` tinyint(1) NOT NULL,
  `isRefund` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`Payment_id`, `Customer_id`, `Gcash_number`, `Payment_date`, `Reservation_id`, `Status`, `createdDate`, `Amount`, `Receipt`, `type`, `isPartial`, `isRefund`) VALUES
(60, '72', '', '2022-09-22', '70', 'Success', '2022-09-22 22:13:40', '2584', '', 'Manual', 0, 0),
(61, '72', '432', '2022-09-22', '70', 'Success', '2022-09-22 22:14:52', '2067', '70Screenshot 2022-09-14 072941.png', 'Electronic Pay', 0, 1),
(62, '72', '', '2022-09-22', '71', 'Success', '2022-09-22 22:19:32', '4', '', 'Manual', 1, 0),
(63, '72', '', '2022-09-22', '71', 'Success', '2022-09-22 22:38:24', '60', '', 'Manual', 0, 0),
(64, '72', '31242343', '2022-09-22', '71', 'Success', '2022-09-22 23:17:51', '51', '71Screenshot 2022-09-15 210038.png', 'Electronic Pay', 0, 1),
(65, '72', '', '2022-09-23', '72', 'Success', '2022-09-23 07:39:25', '3230', '', 'Manual', 0, 0),
(66, '72', '2321', '2022-09-23', '74', 'Success', '2022-09-23 07:57:48', '646', '74Screenshot 2022-09-14 072941.png', 'Electronic Pay', 0, 0),
(67, '72', '21123', '2022-09-23', '75', 'Success', '2022-09-23 14:05:56', '0', '75Screenshot 2022-09-14 072941.png', 'Electronic Pay', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `Reservation_id` int(11) NOT NULL,
  `Customer_id` varchar(50) NOT NULL,
  `Number_of_guest` int(11) NOT NULL,
  `Reservation_status` varchar(50) NOT NULL,
  `Event` varchar(50) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`Reservation_id`, `Customer_id`, `Number_of_guest`, `Reservation_status`, `Event`, `createdDate`) VALUES
(70, '72', 3, 'Cencelled', '32', '2022-09-22 22:13:31'),
(71, '72', 4, 'Cencelled', 'Test', '2022-09-22 22:19:14'),
(73, '72', 2, 'Cencelled', 'Test', '2022-09-23 07:43:29'),
(74, '72', 2, 'Reserved', 'Birthday to you', '2022-09-23 07:57:32'),
(75, '72', 3, 'Reserved', 'Birthday to you', '2022-09-23 08:06:40');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_facility`
--

CREATE TABLE `reservation_facility` (
  `facilityId` varchar(11) NOT NULL,
  `reservationId` varchar(11) NOT NULL,
  `dateIn` date NOT NULL,
  `dateOut` date NOT NULL,
  `totalAmout` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `reservationFacilityId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation_facility`
--

INSERT INTO `reservation_facility` (`facilityId`, `reservationId`, `dateIn`, `dateOut`, `totalAmout`, `createdDate`, `reservationFacilityId`) VALUES
('11', '70', '2022-09-19', '2022-09-26', 2584, '2022-09-22 22:13:31', 71),
('12', '71', '2022-09-29', '2022-09-30', 64, '2022-09-22 22:19:14', 72),
('11', '72', '2022-10-04', '2022-10-13', 3230, '2022-09-22 22:45:48', 73),
('12', '73', '2022-09-23', '2022-09-24', 64, '2022-09-23 07:43:29', 74),
('11', '74', '2022-09-19', '2022-09-20', 646, '2022-09-23 07:57:32', 75),
('13', '75', '2022-10-12', '2022-10-14', 69, '2022-09-23 08:06:40', 76);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_id` int(11) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `FirstName`, `LastName`, `Address`, `Username`, `Password`, `createdDate`) VALUES
(2, 'rwer', 'rewr', 'werew', 'asdasd', 'asdasd', '2022-08-14 15:36:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`InvoiceNo`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`Facility_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`Payment_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Reservation_id`);

--
-- Indexes for table `reservation_facility`
--
ALTER TABLE `reservation_facility`
  ADD PRIMARY KEY (`reservationFacilityId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `InvoiceNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `Facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `Payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `reservation_facility`
--
ALTER TABLE `reservation_facility`
  MODIFY `reservationFacilityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
