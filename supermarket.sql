-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2022 at 12:27 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supermarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `sm_products`
--

CREATE TABLE `sm_products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `unit_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sm_products`
--

INSERT INTO `sm_products` (`id`, `title`, `unit_price`) VALUES
(1, 'A', 50),
(2, 'B', 30),
(3, 'C', 20),
(4, 'D', 15),
(5, 'E', 5);

-- --------------------------------------------------------

--
-- Table structure for table `sm_product_offers`
--

CREATE TABLE `sm_product_offers` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `offer_price` float NOT NULL,
  `offer_type` enum('combo','product','','') DEFAULT NULL,
  `related_product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sm_product_offers`
--

INSERT INTO `sm_product_offers` (`id`, `product_id`, `quantity`, `offer_price`, `offer_type`, `related_product_id`) VALUES
(1, 1, 3, 130, 'combo', NULL),
(2, 2, 2, 45, 'combo', NULL),
(3, 3, 2, 38, 'combo', NULL),
(4, 3, 3, 50, 'combo', NULL),
(5, 4, 0, 5, 'product', 1),
(6, 4, 0, 10, 'product', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sm_products`
--
ALTER TABLE `sm_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sm_product_offers`
--
ALTER TABLE `sm_product_offers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sm_products`
--
ALTER TABLE `sm_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sm_product_offers`
--
ALTER TABLE `sm_product_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
