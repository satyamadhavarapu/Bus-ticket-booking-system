-- --------------------------------------------------------
-- Modified Table structure for `bus_details`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `bus_details`; -- Drop the table if it already exists

CREATE TABLE `bus_details` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,  -- New primary key for better indexing
  `bus_name` VARCHAR(255) NOT NULL,
  `source` VARCHAR(100) NOT NULL,
  `destination` VARCHAR(100) NOT NULL,
  `fare` INT(10) NOT NULL,
  `seats_available` INT(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data
INSERT INTO `bus_details` (`bus_name`, `source`, `destination`, `fare`, `seats_available`) VALUES
('Durgapur-Kolkata 8:00am Volvo Non-AC', 'Durgapur', 'Kolkata', 660, 10),
('Durgapur-Kolkata 6:30am Volvo Non-AC', 'Durgapur', 'Kolkata', 650, 97),
('Durgapur-Kolkata 6:45am Volvo Non-AC', 'Durgapur', 'Kolkata', 650, 98),
('Burnpur-Bishnupur 7:00am Volvo AC', 'Burnpur', 'Bishnupur', 700, 70),
('Burnpur-Bishnupur 7:00am Volvo Non-AC', 'Burnpur', 'Bishnupur', 600, 50);


-- --------------------------------------------------------
-- Modified Table structure for `user__details`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `user__details`; -- Drop the table if it already exists

CREATE TABLE `user__details` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,  -- New primary key for better indexing
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,  -- Ensure unique emails
  `password` VARCHAR(255) NOT NULL,      -- Increased length for password hashes
  `cont_num` VARCHAR(10) NOT NULL        -- Use VARCHAR(10) for contact numbers
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data
-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2022 at 05:24 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_bus`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus_details`
--

CREATE TABLE `bus_details` (
  `bus_name` text NOT NULL,
  `source` text NOT NULL,
  `destination` text NOT NULL,
  `fare` int(50) NOT NULL,
  `seats_available` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus_details`
--

INSERT INTO `bus_details` (`bus_name`, `source`, `destination`, `fare`, `seats_available`) VALUES
('Durgapur-Kolkata 8:00am Volvo Non-AC', '', '', 660, 10),
('Durgapur-Kolkata 6:30am Volvo Non-AC', 'Durgapur', 'Kolkata', 650, 97),
('Durgapur-Kolkata 6:45am Volvo Non-AC', 'Durgapur', 'Kolkata', 650, 98),
('Burnpur-Bishnupur 7:00am volvo AC ', 'Burnpur', 'Bishnupur', 700, 70),
('Burnpur-Bishnupur 7:00am volvo non AC ', 'Burnpur', 'Bishnupur', 600, 50);

-- --------------------------------------------------------

--
-- Table structure for table `user__details`
--

CREATE TABLE `user__details` (
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(6) NOT NULL,
  `cont_num` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user__details`
--

INSINSERT INTO `user__details` (`name`, `email`, `password`, `cont_num`) VALUES
('satya', 'satya@gmail.com', '12345', '9133610252'),
('deepthi', 'deepthi@gmail.com', '12345', '7896541230'),
('savi', 'savi1928@gmail.com', '192808', '8978987457'),
('Rahul', 'rahul@gmail.com', '98745', '9856321478');
-- --------------------------------------------------------
-- Modified Table structure for `passenger_details`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `passenger_details`; -- Drop the table if it already exists

CREATE TABLE `passenger_details` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,  -- New primary key for better indexing
  `name` VARCHAR(255) NOT NULL,
  `age` INT NOT NULL,
  `gender` ENUM('male', 'female') NOT NULL,
  `phone_number` VARCHAR(15) NOT NULL,
  `email` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Indexes for table `user__details`
--
ALTER TABLE `user__details`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

