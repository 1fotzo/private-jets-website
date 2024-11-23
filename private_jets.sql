-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2024 at 02:47 AM
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
-- Database: `private_jets`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'stephan', '$2y$10$ZGBv/aXFRSr3oMcr3zoQ4.3b4SR2bK76W69L8qoICm1G4hfl9M.ta', 'stephan@gmail.com', '2024-11-13 20:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `jet_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `jet_id`, `created_at`) VALUES
(1, 'bob', 'bob@gmail.com', 'Hello!', NULL, '2024-11-13 20:20:24'),
(2, 'yo', 'yo@gmdn.com', 'yo', NULL, '2024-11-19 20:32:52'),
(3, 'yo', 'yo@gmdn.com', 'yo', NULL, '2024-11-19 20:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `jets`
--

CREATE TABLE `jets` (
  `id` int(11) NOT NULL,
  `model_name` varchar(100) DEFAULT NULL,
  `manufacturer` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `capacity` int(11) NOT NULL,
  `range_km` int(11) NOT NULL,
  `speed_kmh` int(11) NOT NULL,
  `availability_status` enum('Available','Sold') NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jets`
--

INSERT INTO `jets` (`id`, `model_name`, `manufacturer`, `price`, `capacity`, `range_km`, `speed_kmh`, `availability_status`, `description`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Gulfstream G650', 'Gulfstream Aerospace', 65000000.00, 18, 13000, 982, 'Available', 'The Gulfstream G650 offers long-range capabilities with unmatched comfort and speed.', '2024-11-13 17:38:19', '2024-11-13 17:38:19', 'gulfstream_g650.jpg'),
(2, 'Bombardier Global 7500', 'Bombardier', 72000000.00, 19, 14260, 982, 'Available', 'The Bombardier Global 7500 is a world-class aircraft with exceptional range and luxurious interiors.', '2024-11-13 17:38:19', '2024-11-13 17:38:19', 'global_7500.jpg'),
(3, 'Dassault Falcon 8X', 'Dassault Aviation', 59000000.00, 14, 11945, 900, 'Available', 'The Falcon 8X is an ultra-long-range jet known for its versatility and cabin comfort.', '2024-11-13 17:38:19', '2024-11-13 17:38:19', 'falcon_8x.jpg'),
(4, 'Embraer Praetor 600', 'Embraer', 21000000.00, 12, 7400, 863, 'Available', 'The Praetor 600 offers performance and luxury, perfect for transcontinental flights.', '2024-11-13 17:38:19', '2024-11-13 17:38:19', 'praetor_600.jpg'),
(5, 'Cessna Citation Longitude', 'Cessna', 26000000.00, 12, 6500, 876, 'Available', 'The Citation Longitude delivers remarkable range, low operating costs, and a spacious cabin.', '2024-11-13 17:38:19', '2024-11-13 17:38:19', 'citation_longitude.jpg'),
(6, 'Boeing BBJ MAX 7', 'Boeing Business Jet', 90000000.00, 19, 12770, 890, 'Available', 'The Boeing BBJ MAX 7 is a business jet version of the Boeing 737 with exceptional range.', '2024-11-13 17:38:19', '2024-11-13 17:38:19', 'boeing_bbj_max_7.jpg'),
(7, 'Airbus ACJ319neo', 'Airbus Corporate Jets', 99999999.99, 25, 12500, 870, 'Available', 'The ACJ319neo is a luxurious corporate jet with a wide cabin and long-range capabilities.', '2024-11-13 17:38:19', '2024-11-13 17:38:19', 'acj319neo.jpg'),
(8, 'HondaJet Elite S', 'Honda Aircraft Company', 5300000.00, 7, 2665, 778, 'Available', 'The HondaJet Elite S is known for its innovative design and fuel efficiency.', '2024-11-13 17:38:19', '2024-11-13 17:38:19', 'hondajet_elite_s.jpg'),
(9, 'Pilatus PC-24', 'Pilatus Aircraft', 10800000.00, 9, 3600, 815, 'Available', 'The PC-24 combines the versatility of a turboprop with the performance of a light jet.', '2024-11-13 17:38:19', '2024-11-13 17:38:19', 'pilatus_pc24.jpg'),
(10, 'Learjet 75 Liberty', 'Bombardier', 9800000.00, 9, 3800, 859, 'Available', 'The Learjet 75 Liberty is designed to deliver superior speed and agility with comfort.', '2024-11-13 17:38:19', '2024-11-13 17:38:19', 'learjet_75.jpg'),
(11, 'Boeing BBJ 787-9', 'Boeing', 99999999.99, 40, 14800, 920, 'Available', 'The Boeing BBJ 787-9 is a luxurious, long-range private jet that offers exceptional space and comfort for business or leisure travel.', '2024-11-13 19:58:23', '2024-11-13 19:58:23', 'boeing_bbj_787_9.jpg'),
(12, 'Airbus A350 XWB', 'Airbus', 99999999.99, 45, 16000, 910, 'Sold', 'The Airbus A350 XWB is an ultra-long-range commercial jet converted into a luxury private jet with cutting-edge technology and unparalleled comfort.', '2024-11-13 19:58:23', '2024-11-13 19:58:23', 'airbus_a350_xwb.jpg'),
(13, 'Dassault Falcon 5X', 'Dassault', 45000000.00, 12, 9250, 1000, 'Available', 'The Falcon 5X offers advanced aerodynamics and cutting-edge technology in a luxurious, spacious cabin, ideal for long-haul travel.', '2024-11-13 19:58:23', '2024-11-13 19:58:23', 'falcon_5x.jpg'),
(14, 'Cessna Citation X+', 'Cessna', 23000000.00, 8, 6500, 978, 'Available', 'The Citation X+ is one of the fastest business jets in the world, providing luxurious and efficient travel for high-net-worth individuals.', '2024-11-13 19:58:23', '2024-11-13 19:58:23', 'cessna_citation_x+.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'bob', 'bob@gmail.com', '$2y$10$90VDmDK3BbICQL1dd2P3xu7kyM5H/Qcgx0arNgcoUfdhEreEoSnaC', '2024-11-17 18:05:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jets`
--
ALTER TABLE `jets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jets`
--
ALTER TABLE `jets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
