-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql305.epizy.com
-- Generation Time: Apr 19, 2023 at 08:48 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_36270872_motorsquare`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoiceId` int(11) NOT NULL,
  `jobCost` varchar(50) NOT NULL,
  `notes` varchar(250) NOT NULL,
  `userId` int(11) NOT NULL,
  `jobId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoiceId`, `jobCost`, `notes`, `userId`, `jobId`) VALUES
(7, '50.00', 'Oil changed', 43, 31),
(8, '120.00', 'Oil Change and other related charges.', 45, 33);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `jobId` int(11) NOT NULL,
  `date` date NOT NULL,
  `bikeName` varchar(255) NOT NULL,
  `bikeBrand` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `jobStatus` varchar(50) DEFAULT NULL,
  `appointmentStatus` varchar(50) NOT NULL,
  `serviceType` varchar(50) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`jobId`, `date`, `bikeName`, `bikeBrand`, `description`, `status`, `jobStatus`, `appointmentStatus`, `serviceType`, `images`, `userId`) VALUES
(3, '2023-04-11', 'Yamaha', 'J1-1011', 'Yamaha Bike MOT service. I want to renew it as soon as possible', '2023-04-19T17:42', '1', '1', 'MOT', 'honda bike.jpg', 15),
(29, '2023-04-19', 'dkd', 'kkdk', 'kkdkd', '2023-04-27T23:17', '0', '', 'Repair', 'honda bike.jpg', 15),
(31, '2023-04-19', 'Honda', 'JC-123', 'I want a repair service', '2023-04-21T16:34', '1', '1', 'Repair', 'honda bike.jpg', 43),
(33, '2023-04-19', 'Yamaha', 'JK-123', 'I want repair service', '2023-04-27T03:07', '1', '1', 'Repair', 'honda bike.jpg', 45);

-- --------------------------------------------------------

--
-- Table structure for table `jobassign`
--

CREATE TABLE `jobassign` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `jobId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobassign`
--

INSERT INTO `jobassign` (`id`, `userId`, `jobId`) VALUES
(3, 28, 3),
(11, 28, 30),
(12, 44, 31),
(13, 46, 33);

-- --------------------------------------------------------

--
-- Table structure for table `mechanicinfo`
--

CREATE TABLE `mechanicinfo` (
  `id` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone2` int(250) NOT NULL,
  `currentStatus` varchar(50) DEFAULT 'Available',
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mechanicinfo`
--

INSERT INTO `mechanicinfo` (`id`, `address`, `phone2`, `currentStatus`, `userId`) VALUES
(3, 'New Address..', 488882, '1', 28),
(8, 'Test address.', 449392929, '1', 44),
(9, 'MY Address.', 7743838, '1', 46);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `level` int(1) NOT NULL,
  `dateJoined` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `fullName`, `email`, `password`, `image`, `phone`, `level`, `dateJoined`) VALUES
(15, 'John Deo', 'john@gmail.com', '99001a5b0f4fa6ea579a0dd4ef5895a7f0a6bb58', 'profile-customer.png', '+441216901039', 2, '2023-04-14'),
(18, 'Admin', 'admin@motorsquare.com', '99001a5b0f4fa6ea579a0dd4ef5895a7f0a6bb58', NULL, NULL, 1, '2023-04-14'),
(28, 'Ibrahim Mahmood', 'ibrahim@gmail.com', 'e1b45d1302ec2f15a40f6a1b83c9bdc360586ed3', NULL, '+444499939', 3, '2023-04-14'),
(33, 'Mike Melon', 'mike@gmail.com', '99001a5b0f4fa6ea579a0dd4ef5895a7f0a6bb58', 'profile-customer.png', '+441216901010', 2, '2023-04-17'),
(42, 'Test One', 'testOne@gmail.com', '99001a5b0f4fa6ea579a0dd4ef5895a7f0a6bb58', 'profile-customer.png', '', 2, '2023-04-19'),
(43, 'Smith Jane', 'smith@gmail.com', '99001a5b0f4fa6ea579a0dd4ef5895a7f0a6bb58', 'profile-customer.png', '+449838393', 2, '2023-04-19'),
(45, 'Jane jill', 'jane@gmail.com', '99001a5b0f4fa6ea579a0dd4ef5895a7f0a6bb58', 'profile-customer.png', '+447282882', 2, '2023-04-19'),
(46, 'Kamal Diriye', 'kamaldiriyeprojects@gmail.com', 'e1b45d1302ec2f15a40f6a1b83c9bdc360586ed3', NULL, '+4433838', 3, '2023-04-19');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicleId` int(11) NOT NULL,
  `regoNumber` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `regDate` date NOT NULL,
  `mot` date NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicleId`, `regoNumber`, `name`, `brand`, `regDate`, `mot`, `userId`) VALUES
(2, 'JN25KDS', 'Yamaha', 'YZF-R6', '2022-03-01', '2022-03-01', 15),
(3, 'SW47TAR', 'Honda', 'CBR500R', '2022-09-12', '2023-01-11', 15),
(5, 'GC833', 'Honda', 'JC-1011', '2023-04-18', '2023-04-18', 33),
(11, 'GHK1828', 'Honda', 'JC-1022', '2022-03-20', '2022-04-01', 43),
(12, 'ZHK123', 'Yamaha', 'CG-123', '2023-04-12', '2023-04-06', 43),
(13, 'HGT127', 'Yamaha', 'TR-1243', '2023-04-28', '2023-04-13', 45);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoiceId`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`jobId`);

--
-- Indexes for table `jobassign`
--
ALTER TABLE `jobassign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mechanicinfo`
--
ALTER TABLE `mechanicinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `jobId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `jobassign`
--
ALTER TABLE `jobassign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mechanicinfo`
--
ALTER TABLE `mechanicinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
