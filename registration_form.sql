-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 21, 2020 at 03:04 PM
-- Server version: 8.0.22-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `GitAssignmentDatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration_form`
--

CREATE TABLE `registration_form` (
  `Fname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Contact` bigint NOT NULL,
  `Age` int NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ConfirmPassword` varchar(255) NOT NULL,
  `Pimage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registration_form`
--

INSERT INTO `registration_form` (`Fname`, `Lname`, `Email`, `Contact`, `Age`, `Password`, `ConfirmPassword`, `Pimage`) VALUES
('Abhilasha', 'Mishra', 'abhilasha@mishra.com', 5554785555, 20, 'abhi', 'abhi', 'user_images/Screenshot from 2020-12-03 15-29-18.png'),
('Rahul', 'Tiwari', 'rahul@tiwari.com', 5554785544, 20, 'rahul', 'rahul', 'user_images/Screenshot from 2020-12-03 15-53-03.png'),
('Sahil', 'Kumbhar', 'sahil@kumbhar.com', 5554785544, 20, 'sahil', 'sahil', 'user_images/Screenshot from 2020-11-26 22-41-56.png'),
('Shubham', 'Tiwari', 'shubham@tiwari.com', 5554785555, 20, 'shubh', 'shubh', 'user_images/Screenshot from 2020-12-03 13-55-30.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration_form`
--
ALTER TABLE `registration_form`
  ADD UNIQUE KEY `Email` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
