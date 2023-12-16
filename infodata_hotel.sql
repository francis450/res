-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2023 at 01:46 PM
-- Server version: 10.3.39-MariaDB-cll-lve
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infodata_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand` varchar(60) NOT NULL,
  `supplier` varchar(60) DEFAULT NULL,
  `code` varchar(60) DEFAULT NULL,
  `dated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand`, `supplier`, `code`, `dated`, `id`) VALUES
('Spaghetti', 'Mjengo Ltd', 'SpaghettiMjengo Ltd', '2023-09-03 10:19:30', 1),
('salt', 'Mjengo Ltd', 'saltMjengo Ltd', '2023-09-03 10:19:50', 2),
('Wheat Flour', 'Mjengo Ltd', 'Wheat FlourMjengo Ltd', '2023-09-03 10:24:41', 3),
('Sugar', 'Kabras', 'SugarKabras', '2023-09-03 10:27:27', 4),
('Cooking Oil', 'Rina', 'Cooking OilRina', '2023-09-03 10:28:36', 5),
('Cooking Gas', 'Total', 'Cooking GasTotal', '2023-09-03 10:30:12', 6),
('Bacon', NULL, NULL, '2023-09-05 06:29:31', 11),
('Chees', NULL, NULL, '2023-09-05 06:31:55', 12),
('Milk', NULL, NULL, '2023-09-05 06:32:53', 13),
('Chocolate', NULL, NULL, '2023-09-05 06:35:11', 14),
('Tea Leaves', NULL, NULL, '2023-09-05 06:36:42', 15),
('Coffee', NULL, NULL, '2023-09-05 06:38:22', 16),
('Sausage', NULL, NULL, '2023-09-05 06:46:45', 17),
('Bread', NULL, NULL, '2023-09-05 06:47:49', 18),
('Maize Flour', NULL, NULL, '2023-09-05 08:45:37', 19),
('Onions', NULL, NULL, '2023-09-12 17:23:42', 20),
('Tomatoes', NULL, NULL, '2023-09-12 17:24:06', 21),
('tomoato', NULL, NULL, '2023-09-12 17:24:23', 22),
('tomoato', NULL, NULL, '2023-09-12 17:24:39', 23),
('Tomatoes', NULL, NULL, '2023-09-12 17:24:39', 24),
('Meat', NULL, NULL, '2023-09-22 20:14:32', 25);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ordernumber` varchar(15) NOT NULL,
  `code` varchar(60) NOT NULL,
  `food` varchar(60) NOT NULL,
  `department` varchar(60) NOT NULL,
  `qnty` varchar(3) NOT NULL,
  `price` double NOT NULL,
  `cost` double NOT NULL,
  `profit` double NOT NULL,
  `cashier` varchar(30) NOT NULL,
  `dated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`ordernumber`, `code`, `food`, `department`, `qnty`, `price`, `cost`, `profit`, `cashier`, `dated`, `id`) VALUES
('1693813343', 'CHAPO', 'CHAPO', 'Restaurant', '1', 1.125, 0.75, 0.375, 'ad', '2023-09-04 07:42:30', 11);

-- --------------------------------------------------------

--
-- Table structure for table `deletedfrommenu`
--

CREATE TABLE `deletedfrommenu` (
  `code` varchar(10) NOT NULL,
  `item` varchar(255) NOT NULL,
  `cost` double NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `deletedfrommenu`
--

INSERT INTO `deletedfrommenu` (`code`, `item`, `cost`, `price`) VALUES
('191', 'Item', 48, 72),
('200', 'Ugali', 160, 240),
('310', 'Githeri', 0, 15),
('111', 'Toast', 7, 25),
('298', 'Mandazi', 209, 313.5);

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `dated` datetime NOT NULL DEFAULT current_timestamp(),
  `foodcode` varchar(60) NOT NULL,
  `food` varchar(60) NOT NULL,
  `ingredient` varchar(60) NOT NULL,
  `code` varchar(60) NOT NULL,
  `units` double NOT NULL,
  `measure` varchar(20) NOT NULL,
  `cost` double NOT NULL,
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`dated`, `foodcode`, `food`, `ingredient`, `code`, `units`, `measure`, `cost`, `id`) VALUES
('2023-09-05 14:06:35', '100', 'CHAPO', 'Wheat Flour', 'CHAPOWheat Flour', 50, 'g', 0.75, 3),
('2023-09-05 14:06:35', '100', 'CHAPO', 'salt', 'CHAPOsalt', 5, 'g', 0.025, 4),
('2023-09-05 14:06:35', '100', 'CHAPO', 'Sugar', 'CHAPOSugar', 10, 'g', 0.085, 7),
('2023-09-05 14:06:35', '100', 'CHAPO', 'Cooking Oil', 'CHAPOCooking Oil', 20, 'ml', 3.4, 8),
('2023-09-05 14:06:35', '100', 'CHAPO', 'Cooking Gas', 'CHAPOCooking Gas', 200, 'g', 32, 9),
('2023-09-07 17:54:15', '200', 'Ugali', 'Maize Flour', 'UgaliMaize Flour', 100, 'g', 2, 19),
('2023-09-07 18:37:04', '300', 'Pilau', 'Cooking Oil', 'PilauCooking Oil', 0.25, 'g', 13, 20),
('2023-09-07 22:34:27', '300', 'Pilau', 'salt', 'Pilausalt', 5, 'g', 10, 23),
('2023-09-07 22:43:41', '300', 'Pilau', 'Cooking Gas', 'PilauCooking Gas', 50, 'g', 160, 24),
('2023-09-07 22:51:38', '191', 'Item', 'Bread', 'ItemBread', 40, 'g', 6, 25),
('2023-09-07 23:21:41', '400', 'Item', 'Wheat Flour', 'ItemWheat Flour', 200, 'g', 1, 26),
('2023-09-09 17:25:46', '191', 'Item', 'Sausage', 'ItemSausage', 20.8, 'g', 48, 29),
('2023-09-11 11:04:17', '', 'Item', 'Ingredient', 'ItemIngredient', 0, 'Measure', 0, 30),
('2023-09-11 12:57:53', '100', 'CHAPO', 'Bread', 'CHAPOBread', 2, 'g', 125, 31),
('2023-09-11 14:46:42', '301', 'Item', 'Cooking Oil', 'ItemCooking Oil', 20, 'g', 170, 32),
('2023-09-11 14:48:00', '301', 'Item', 'salt', 'Itemsalt', 0.7, 'g', 71, 33),
('2023-09-12 00:19:51', '100', 'Item', 'Maize Flour', 'ItemMaize Flour', 50, 'g', 4, 34),
('2023-09-12 00:25:42', '310', 'Githeri', 'salt', 'Githerisalt', 5, 'g', 10, 36),
('2023-09-12 00:33:34', '111', 'Toast', 'Bread', 'ToastBread', 100, 'g', 3, 37),
('2023-09-12 00:36:01', '111', 'Toast', 'Wheat', 'ToastWheat', 50, 'g', 4, 38),
('2023-09-17 01:27:48', '605', 'Hambarger', 'Bread', 'HambargerBread', 3, 'g', 83, 39),
('2023-09-22 23:12:04', '298', 'Mandazi', 'Wheat Flour', 'MandaziWheat Flour', 20, 'g', 8, 41),
('2023-09-22 23:12:16', '298', 'Mandazi', 'Cooking Oil', 'MandaziCooking Oil', 20, 'ml', 170, 42),
('2023-09-22 23:12:27', '298', 'Mandazi', 'salt', 'Mandazisalt', 10, 'g', 5, 43),
('2023-09-22 23:12:39', '298', 'Mandazi', 'Sugar', 'MandaziSugar', 5, 'g', 34, 44),
('2023-09-22 23:16:04', '297', 'Samosa', 'Meat', 'SamosaMeat', 30, 'g', 17, 45),
('2023-09-22 23:16:16', '297', 'Samosa', 'Wheat Flour', 'SamosaWheat Flour', 30, 'g', 5, 46),
('2023-09-22 23:16:24', '297', 'Samosa', 'salt', 'Samosasalt', 5, 'g', 10, 47),
('2023-09-22 23:23:14', '605', 'Hambarger', 'Tomatoes', 'HambargerTomatoes', 5, 'g', 6, 48),
('2023-09-26 23:02:28', '111', 'CHAI', 'Tea Leaves', 'CHAITea Leaves', 10, 'g', 10, 49);

-- --------------------------------------------------------

--
-- Table structure for table `ingtemp`
--

CREATE TABLE `ingtemp` (
  `foodcode` varchar(60) NOT NULL,
  `product` varchar(60) NOT NULL,
  `code` varchar(60) NOT NULL,
  `units` double NOT NULL,
  `cost` double NOT NULL,
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ingtemp`
--

INSERT INTO `ingtemp` (`foodcode`, `product`, `code`, `units`, `cost`, `id`) VALUES
('CHAPO', 'Wheat Flour', 'CHAPOWheat Flour', 50, 0.75, 7),
('CHAPO', 'salt', 'CHAPOsalt', 5, 0.025, 8),
('CHAPO', 'Sugar', 'CHAPOSugar', 10, 0.085, 9),
('CHAPO', 'Cooking Oil', 'CHAPOCooking Oil', 20, 3.4, 10),
('CHAPO', 'Cooking Gas', 'CHAPOCooking Gas', 200, 32, 11),
('chapo', 'salt', 'salt', 10, 0.05, 12),
('chapo', 'Wheat Flour', 'Wheat Flour', 78000, 1170, 13),
('', 'Bread', 'Bread', 12, 3.75, 14),
('', 'Maize Flour', 'Maize Flour', 2000, 8.6805555555556, 15);

-- --------------------------------------------------------

--
-- Table structure for table `kitchenstock`
--

CREATE TABLE `kitchenstock` (
  `product` varchar(60) NOT NULL,
  `qnty` double NOT NULL,
  `unitcost` double NOT NULL,
  `smallunit` double NOT NULL,
  `bigunit` double NOT NULL,
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kitchenstock`
--

INSERT INTO `kitchenstock` (`product`, `qnty`, `unitcost`, `smallunit`, `bigunit`, `id`) VALUES
('Wheat Flour', -0.05, 150, 2172.222222222222, 2.172222222222222, 1),
('salt', -0.005, 50, -5, -0.005, 2);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `user` varchar(30) NOT NULL,
  `timed` datetime NOT NULL DEFAULT current_timestamp(),
  `activity` varchar(30) NOT NULL,
  `role` int(2) NOT NULL,
  `dated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`user`, `timed`, `activity`, `role`, `dated`, `id`) VALUES
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-02 13:10:20', 1),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-02 13:16:14', 2),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-02 13:16:14', 3),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 06:24:19', 4),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 06:24:19', 5),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 06:51:38', 6),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 06:51:38', 7),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 06:55:12', 8),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 06:55:12', 9),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 06:56:37', 10),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 06:56:37', 11),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 06:57:18', 12),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 06:57:18', 13),
('admin', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 07:48:34', 14),
('admin', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 07:48:34', 15),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 09:59:08', 16),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 09:59:08', 17),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 10:26:12', 18),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 10:26:12', 19),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 13:58:06', 20),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-03 13:58:06', 21),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-04 07:41:00', 22),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-04 07:41:00', 23),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-04 11:10:40', 24),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-04 11:10:40', 25),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-04 11:31:38', 26),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-04 11:31:38', 27),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-04 12:07:16', 28),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-04 12:07:16', 29),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-04 12:44:53', 30),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-04 12:44:53', 31),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-04 12:48:25', 32),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-04 12:48:25', 33),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-04 13:36:30', 34),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-04 13:36:30', 35),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-04 18:20:03', 36),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-04 18:20:03', 37),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-05 03:48:23', 38),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-05 03:48:23', 39),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-05 06:46:12', 40),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-05 06:46:12', 41),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-05 08:49:17', 42),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-05 08:49:17', 43),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-05 11:49:49', 44),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-05 11:49:49', 45),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-05 13:58:21', 46),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-05 13:58:21', 47),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-05 18:57:22', 48),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-05 18:57:22', 49),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-05 20:50:30', 50),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-05 20:50:30', 51),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-05 20:50:30', 52),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-05 20:50:30', 53),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-06 04:35:46', 54),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-06 04:35:46', 55),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-06 07:28:34', 56),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-06 07:28:34', 57),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-07 05:33:07', 58),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-07 05:33:07', 59),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-07 07:39:41', 60),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-07 07:39:41', 61),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-07 09:01:10', 62),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-07 09:01:10', 63),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-07 11:05:48', 64),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-07 11:05:48', 65),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-07 15:40:26', 66),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-07 15:40:26', 67),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-07 15:48:42', 68),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-07 15:48:42', 69),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-09 10:40:52', 70),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-09 10:40:52', 71),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-11 07:47:30', 72),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-11 07:47:30', 73),
('Ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-11 11:33:19', 74),
('Ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-11 11:33:19', 75),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-11 20:59:59', 76),
('ad', '2023-09-11 23:59:59', 'login', 0, '2023-09-11 20:59:59', 77),
('ad', '2023-09-12 00:04:20', 'DELETED Item', 0, '2023-09-11 21:04:20', 78),
('ad', '2023-09-12 00:19:02', 'DELETED Ugali', 0, '2023-09-11 21:19:02', 79),
('ad', '2023-09-12 00:37:07', 'DELETED Githeri', 0, '2023-09-11 21:37:07', 80),
('Ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-12 06:16:48', 81),
('Ad', '2023-09-12 09:16:48', 'login', 0, '2023-09-12 06:16:48', 82),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-12 07:04:43', 83),
('ad', '2023-09-12 10:04:43', 'login', 0, '2023-09-12 07:04:43', 84),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-12 16:49:29', 85),
('ad', '2023-09-12 19:49:29', 'login', 0, '2023-09-12 16:49:29', 86),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-12 17:20:07', 87),
('ad', '2023-09-12 20:20:07', 'login', 0, '2023-09-12 17:20:07', 88),
('ad', '2023-09-12 20:53:24', 'DELETED Toast', 0, '2023-09-12 17:53:24', 89),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-13 14:59:31', 90),
('ad', '2023-09-13 17:59:31', 'login', 0, '2023-09-13 14:59:31', 91),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-13 17:35:21', 92),
('ad', '2023-09-13 20:35:21', 'login', 0, '2023-09-13 17:35:21', 93),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-13 19:08:13', 94),
('ad', '2023-09-13 22:08:13', 'login', 0, '2023-09-13 19:08:13', 95),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-13 19:08:13', 96),
('ad', '2023-09-13 22:08:13', 'login', 0, '2023-09-13 19:08:13', 97),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-13 19:08:14', 98),
('ad', '2023-09-13 22:08:14', 'login', 0, '2023-09-13 19:08:14', 99),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-13 19:08:18', 100),
('ad', '2023-09-13 22:08:18', 'login', 0, '2023-09-13 19:08:18', 101),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-14 06:20:51', 102),
('ad', '2023-09-14 09:20:51', 'login', 0, '2023-09-14 06:20:51', 103),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-14 07:26:24', 104),
('ad', '2023-09-14 10:26:24', 'login', 0, '2023-09-14 07:26:24', 105),
('Ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-14 10:24:03', 106),
('Ad', '2023-09-14 13:24:03', 'login', 0, '2023-09-14 10:24:03', 107),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-22 08:46:01', 108),
('ad', '2023-09-22 11:46:01', 'login', 0, '2023-09-22 08:46:01', 109),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-22 18:56:28', 110),
('ad', '2023-09-22 21:56:28', 'login', 0, '2023-09-22 18:56:28', 111),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-23 09:54:21', 112),
('ad', '2023-09-23 12:54:21', 'login', 0, '2023-09-23 09:54:21', 113),
('Ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-26 12:59:08', 114),
('Ad', '2023-09-26 15:59:08', 'login', 0, '2023-09-26 12:59:08', 115),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-26 19:59:12', 116),
('ad', '2023-09-26 22:59:12', 'login', 0, '2023-09-26 19:59:12', 117),
('ad', '0000-00-00 00:00:00', 'login', 0, '2023-09-27 07:03:33', 118),
('ad', '2023-09-27 10:03:33', 'login', 0, '2023-09-27 07:03:33', 119),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-09-27 07:46:56', 120),
('ad', '2023-09-27 10:46:56', 'login', 1, '2023-09-27 07:46:56', 121),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-09-27 07:48:16', 122),
('ad', '2023-09-27 10:48:16', 'login', 1, '2023-09-27 07:48:16', 123),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-09-27 07:48:23', 124),
('ad', '2023-09-27 10:48:23', 'login', 1, '2023-09-27 07:48:23', 125),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-09-27 07:48:50', 126),
('ad', '2023-09-27 10:48:50', 'login', 1, '2023-09-27 07:48:50', 127),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-09-27 07:49:13', 128),
('ad', '2023-09-27 10:49:13', 'login', 1, '2023-09-27 07:49:13', 129),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-09-27 07:49:33', 130),
('ad', '2023-09-27 10:49:33', 'login', 1, '2023-09-27 07:49:33', 131),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-09-27 07:58:27', 132),
('ad', '2023-09-27 10:58:27', 'login', 1, '2023-09-27 07:58:27', 133),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-09-27 08:06:31', 134),
('ad', '2023-09-27 11:06:31', 'login', 1, '2023-09-27 08:06:31', 135),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-09-27 08:07:58', 136),
('ad', '2023-09-27 11:07:58', 'login', 1, '2023-09-27 08:07:58', 137),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-09-27 08:09:17', 138),
('ad', '2023-09-27 11:09:17', 'login', 1, '2023-09-27 08:09:17', 139),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-09-27 08:14:26', 140),
('ad', '2023-09-27 11:14:26', 'login', 1, '2023-09-27 08:14:26', 141),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-09-27 11:31:07', 142),
('ad', '2023-09-27 14:31:07', 'login', 1, '2023-09-27 11:31:07', 143),
('Ad', '0000-00-00 00:00:00', 'login', 1, '2023-09-30 13:45:02', 144),
('Ad', '2023-09-30 16:45:02', 'login', 1, '2023-09-30 13:45:02', 145),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-10-02 05:37:28', 146),
('ad', '2023-10-02 08:37:28', 'login', 1, '2023-10-02 05:37:28', 147),
('Ad', '2023-10-02 08:54:13', 'DELETED Mandazi', 0, '2023-10-02 05:54:13', 148),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-10-02 07:35:08', 149),
('ad', '2023-10-02 10:35:08', 'login', 1, '2023-10-02 07:35:08', 150),
('Ad', '0000-00-00 00:00:00', 'login', 1, '2023-10-04 12:36:59', 151),
('Ad', '2023-10-04 15:36:59', 'login', 1, '2023-10-04 12:36:59', 152),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-10-09 10:50:47', 153),
('ad', '2023-10-09 13:50:47', 'login', 1, '2023-10-09 10:50:47', 154),
('Ad', '0000-00-00 00:00:00', 'login', 1, '2023-10-18 07:35:20', 155),
('Ad', '2023-10-18 10:35:20', 'login', 1, '2023-10-18 07:35:20', 156),
('Ad', '0000-00-00 00:00:00', 'login', 1, '2023-10-19 14:54:30', 157),
('Ad', '2023-10-19 17:54:30', 'login', 1, '2023-10-19 14:54:30', 158),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-11-16 11:51:53', 159),
('ad', '2023-11-16 14:51:53', 'login', 1, '2023-11-16 11:51:53', 160),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-12-05 16:43:52', 161),
('ad', '2023-12-05 19:43:52', 'login', 1, '2023-12-05 16:43:52', 162),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-12-10 14:09:38', 163),
('ad', '2023-12-10 17:09:38', 'login', 1, '2023-12-10 14:09:38', 164),
('ad', '0000-00-00 00:00:00', 'login', 1, '2023-12-16 09:21:39', 165),
('ad', '2023-12-16 12:21:39', 'login', 1, '2023-12-16 09:21:39', 166);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `foodcode` varchar(60) NOT NULL,
  `food` varchar(60) NOT NULL,
  `category` varchar(120) NOT NULL,
  `department` varchar(60) NOT NULL,
  `cost` double NOT NULL,
  `price` double NOT NULL,
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`foodcode`, `food`, `category`, `department`, `cost`, `price`, `id`) VALUES
('100', 'CHAPO', 'SNACKS', 'Restaurant', 165.26, 450, 3),
('300', 'Pilau', 'MAIN-DISH', 'Restaurant', 183, 240, 14),
('605', 'Hambarger', 'SNACKS', 'Restaurant', 6, 100, 24),
('297', 'Samosa', 'SNACKS', 'Restaurant', 15, 22.5, 26),
('111', 'CHAI', 'BEVERAGES', 'Restaurant', 0, 15, 27);

-- --------------------------------------------------------

--
-- Table structure for table `peddingorders`
--

CREATE TABLE `peddingorders` (
  `ordernumber` varchar(21) NOT NULL,
  `tablenumber` varchar(15) NOT NULL,
  `waiter` varchar(60) NOT NULL,
  `status` varchar(2) NOT NULL,
  `timed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `peddingorders`
--

INSERT INTO `peddingorders` (`ordernumber`, `tablenumber`, `waiter`, `status`, `timed`, `id`) VALUES
('1693813343', '1', 'ad', '5', '2023-09-13 15:01:01', 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product` varchar(60) NOT NULL,
  `qnty` double NOT NULL,
  `unitcost` double NOT NULL,
  `smallunit` double NOT NULL,
  `bigunit` double NOT NULL,
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product`, `qnty`, `unitcost`, `smallunit`, `bigunit`, `id`) VALUES
('Wheat Flour', 79, 150, 10000, 10, 1),
('salt', 10, 50, 10000, 10, 2),
('Sugar', 20, 170, 20000, 20, 3),
('Cooking Oil', 1, 3400, 20000, 20, 4),
('Cooking Gas', 1, 8000, 50000, 50, 5),
('Wheat', 12, 208.33333333333334, 24000, 24, 6),
('Bread', 2, 250, 800, 0.8, 7),
('Sausage', 20, 1000, 20000, 20, 8),
('Maize Flour', 24, 208.33333333333334, 48000, 48, 9),
('Tomatoes', 120, 30, 120000, 120, 10),
('Tea Leaves', 10, 100, 10000, 10, 11),
('Meat', 30, 400, 30000, 30, 12);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `receipt` varchar(60) NOT NULL,
  `supplier` varchar(60) NOT NULL,
  `product` varchar(60) NOT NULL,
  `units` varchar(5) NOT NULL,
  `weight` varchar(12) NOT NULL,
  `measure` varchar(12) NOT NULL,
  `smallunit` varchar(10) NOT NULL,
  `bigunit` varchar(10) NOT NULL,
  `unitcost` varchar(7) NOT NULL,
  `totalcost` varchar(7) NOT NULL,
  `paid` varchar(7) NOT NULL,
  `balance` varchar(7) NOT NULL,
  `method` varchar(60) NOT NULL,
  `description` varchar(60) DEFAULT NULL,
  `comment` varchar(60) DEFAULT NULL,
  `dated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`receipt`, `supplier`, `product`, `units`, `weight`, `measure`, `smallunit`, `bigunit`, `unitcost`, `totalcost`, `paid`, `balance`, `method`, `description`, `comment`, `dated`, `id`) VALUES
('0011', 'Mjengo Ltd', 'Wheat Flour', '100', '2', 'Kgs', '10000', '10', '150', '15000', '15000', '0', 'Mpesa', 'Payment on Delivery', 'no comment', '2023-09-03 10:48:38', 1),
('01122', 'Mjengo Ltd', 'salt', '10', '1', 'Kgs', '10000', '10', '50', '500', '500', '0', 'Mpesa', 'M-pesa on delivery', 'no comment', '2023-09-03 10:50:57', 2),
('4321', 'Kabras', 'Sugar', '20', '1', 'Kgs', '20000', '20', '170', '3400', '3400', '0', 'Mpesa', 'M-pesa on Delivery', 'no comment', '2023-09-03 10:53:51', 3),
('347892', 'Rina', 'Cooking Oil', '1', '20', 'Ltrs', '20000', '20', '3400', '3400', '3400', '0', 'Mpesa', 'Mpesa On Delivery', 'no comment', '2023-09-03 10:57:24', 4),
('12387', 'Total', 'Cooking Gas', '1', '50', 'Kgs', '50000', '50', '8000', '8000', '8000', '0', 'Mpesa', 'M-pesa on delivery', 'no comment', '2023-09-03 11:03:10', 5),
('12345', 'Mjengo', 'Wheat', '12', '2', 'kgs', '24000', '24', '208.333', '2500', '2500', '0', 'Cash', NULL, NULL, '2023-09-05 04:14:09', 6),
('54321', 'Broadway', 'Bread', '2', '400', 'g', '800', '0.8', '250', '500', '500', '0', 'Cash', NULL, NULL, '2023-09-05 06:48:46', 7),
('11111', 'Famers', 'Sausage', '10', '1', 'kgs', '10000', '10', '1000', '10000', '10000', '0', 'Mpesa', NULL, NULL, '2023-09-05 08:40:56', 8),
('111112', 'Famers', 'Sausage', '10', '1', 'kgs', '10000', '10', '1000', '10000', '10000', '0', 'Mpesa', NULL, NULL, '2023-09-05 08:44:30', 10),
('1212', 'Unga', 'Maize Flour', '24', '2', 'kgs', '48000', '48', '208.333', '5000', '5000', '0', 'Bank', NULL, NULL, '2023-09-05 08:47:28', 11),
('retrhytjtherw', 'Kabras', 'Tomatoes', '20', '1', 'kgs', '20000', '20', '100', '2000', '1500', '500', 'Mpesa', NULL, NULL, '2023-09-12 17:26:32', 12),
('1234545', 'Famers', 'Tea Leaves', '10', '1', 'kgs', '10000', '10', '100', '1000', '900', '100', 'Bank', NULL, NULL, '2023-09-12 17:28:33', 13),
('1234555', 'Githunguri Butchery', 'Meat', '20', '1', 'kgs', '20000', '20', '500', '10000', '10000', '0', 'Mpesa', NULL, NULL, '2023-09-22 20:15:14', 14),
('6BJ4N5KLM', 'Anga', 'Tomatoes', '100', '1', 'kgs', '100000', '100', '30', '3000', '3000', '0', 'Mpesa', NULL, NULL, '2023-09-22 20:22:35', 15),
('456', 'Kenbro', 'Meat', '10', '1', 'kgs', '10000', '10', '400', '4000', '3000', '1000', 'Mpesa', NULL, NULL, '2023-12-05 16:45:37', 16);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `receipt` varchar(15) NOT NULL,
  `amount` double NOT NULL,
  `cash` double NOT NULL,
  `mpesa` double NOT NULL,
  `bank` double NOT NULL,
  `balance` double NOT NULL,
  `dated` varchar(12) NOT NULL,
  `cashier` varchar(60) NOT NULL,
  `profit` double NOT NULL,
  `timed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`receipt`, `amount`, `cash`, `mpesa`, `bank`, `balance`, `dated`, `cashier`, `profit`, `timed`, `id`) VALUES
('1693813343', 1.13, 0, 3, 0, 1.87, '2023-09-13', 'ad', 0.375, '2023-09-13 15:01:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `fullname` varchar(60) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `dated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`fullname`, `email`, `phone`, `dated`, `id`) VALUES
('Mjengo Ltd', 'email@mjengo', '0712345678', '2023-09-02 13:24:24', 1),
('Kabras', 'sugar@kabras.com', '0709876567', '2023-09-03 10:27:08', 2),
('Rina', 'oil@rina.com', '0712345432', '2023-09-03 10:28:21', 3),
('Total', 'gas@total.com', '0756342791', '2023-09-03 10:29:03', 4),
('Unga Ltd', NULL, NULL, '2023-09-05 05:41:16', 5),
('Kenchic ', NULL, NULL, '2023-09-05 05:46:04', 6),
('Meatco', NULL, NULL, '2023-09-05 05:47:09', 8),
('Kenbro', NULL, NULL, '2023-09-05 05:53:58', 9),
('Anga', NULL, NULL, '2023-09-05 05:58:18', 10),
('Broadway', NULL, NULL, '2023-09-05 06:04:00', 11),
('Soko', NULL, NULL, '2023-09-05 06:07:18', 12),
('Pork Center', NULL, NULL, '2023-09-05 06:10:11', 13),
('Mayai com', NULL, NULL, '2023-09-05 06:12:45', 14),
('Famers Choice', NULL, NULL, '2023-09-05 06:47:06', 15),
('Githunguri Butchery', NULL, NULL, '2023-09-22 20:14:18', 16);

-- --------------------------------------------------------

--
-- Table structure for table `tempcart`
--

CREATE TABLE `tempcart` (
  `ordernumber` varchar(15) NOT NULL,
  `code` varchar(60) NOT NULL,
  `food` varchar(60) NOT NULL,
  `department` varchar(60) NOT NULL,
  `qnty` varchar(3) NOT NULL,
  `price` double NOT NULL,
  `cost` double NOT NULL,
  `profit` double NOT NULL,
  `cashier` varchar(60) NOT NULL,
  `dated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tempcart`
--

INSERT INTO `tempcart` (`ordernumber`, `code`, `food`, `department`, `qnty`, `price`, `cost`, `profit`, `cashier`, `dated`, `id`) VALUES
('1694538982', '111', 'Toast', 'Restaurant', '1', 25, 7, 18, 'ad', '2023-09-12 17:16:27', 12),
('1694538982', '300', 'Pilau', 'Restaurant', '1', 240, 183, 57, 'ad', '2023-09-12 17:16:29', 13),
('1694538982', '100', 'CHAPO', 'Restaurant', '1', 434.625, 165.26, 269.365, 'ad', '2023-09-12 17:16:30', 14),
('1694538982', '300', 'Pilau', 'Restaurant', '1', 240, 183, 57, 'ad', '2023-09-12 17:16:33', 15),
('1694538982', '111', 'Toast', 'Restaurant', '1', 25, 7, 18, 'ad', '2023-09-12 17:16:34', 16),
('1694538982', '100', 'CHAPO', 'Restaurant', '1', 434.625, 165.26, 269.365, 'ad', '2023-09-12 17:16:37', 17),
('1694538982', '300', 'Pilau', 'Restaurant', '1', 240, 183, 57, 'ad', '2023-09-12 17:16:39', 18),
('1694619019', '300', 'Pilau', 'Restaurant', '1', 240, 183, 57, 'ad', '2023-09-13 15:30:43', 21),
('1694626539', '100', 'CHAPO', 'Restaurant', '1', 434.625, 165.26, 269.365, 'ad', '2023-09-13 17:37:00', 22),
('1694626926', '300', 'Pilau', 'Restaurant', '1', 240, 183, 57, 'ad', '2023-09-13 19:06:17', 23);

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `transferid` varchar(60) NOT NULL,
  `product` varchar(60) NOT NULL,
  `productid` varchar(6) NOT NULL,
  `qnty` double NOT NULL,
  `unitcost` double NOT NULL,
  `smallunit` double NOT NULL,
  `bigunit` double NOT NULL,
  `valuation` double NOT NULL,
  `dated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`transferid`, `product`, `productid`, `qnty`, `unitcost`, `smallunit`, `bigunit`, `valuation`, `dated`, `id`) VALUES
('1693813362', 'Wheat Flour', '1', 0, 150, 0, 0, 0, '2023-09-04 07:43:26', 1),
('1693813417', 'salt', '2', 0, 50, 0, 0, 0, '2023-09-04 07:43:47', 2),
('1693851644', 'Wheat Flour', '1', 10, 150, 1000, 1, 0, '2023-09-04 18:21:31', 3),
('1697726252', 'Wheat Flour', '1', 11, 150, 1222.2222222222222, 1.222222222222222, 0, '2023-10-19 14:54:25', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `fullname` varchar(60) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(125) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `role` int(2) NOT NULL,
  `active` int(2) NOT NULL,
  `dated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fullname`, `username`, `password`, `email`, `phone`, `role`, `active`, `dated`, `id`) VALUES
('Admin', 'ad', '7215ee9c7d9dc229d2921a40e899ec5f', 'franciskamande2001@gmail.com', '0768599868', 1, 1, '2023-09-27 07:44:57', 1),
('Administrator AdminTwo', 'admin', '23b58def11b45727d3351702515f86af', 'admin@two.co.ke', '071111111', 2, 0, '2023-09-27 22:02:51', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `ingtemp`
--
ALTER TABLE `ingtemp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `kitchenstock`
--
ALTER TABLE `kitchenstock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product` (`product`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `foodcode` (`foodcode`),
  ADD UNIQUE KEY `food` (`food`);

--
-- Indexes for table `peddingorders`
--
ALTER TABLE `peddingorders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ordernumber` (`ordernumber`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product` (`product`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `receipt` (`receipt`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `receipt` (`receipt`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tempcart`
--
ALTER TABLE `tempcart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transferid` (`transferid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `ingtemp`
--
ALTER TABLE `ingtemp`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kitchenstock`
--
ALTER TABLE `kitchenstock`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `peddingorders`
--
ALTER TABLE `peddingorders`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tempcart`
--
ALTER TABLE `tempcart`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
