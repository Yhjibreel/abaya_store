-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 02:55 PM
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
-- Database: `abayastore`
--
CREATE DATABASE IF NOT EXISTS `abayastore` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `abayastore`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `status` enum('pending','processing','shipped','delivered') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `order_date`, `user_id`, `status`) VALUES
(1, 4, 2, 'Muhammad musa jidda', 'muhammadmjidder8@gmail.com', 'Hadejia, Jigawa State\r\ngidan ganye 88', '2025-04-12 07:13:01', NULL, 'pending'),
(2, 4, 1, 'Muhammad musa jidda', 'muhammadmjidder8@gmail.com', 'Hadejia, Jigawa State\\r\\ngidan ganye 88', '2025-04-12 07:19:37', NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_path` varchar(100) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_path`, `category_id`, `stock`) VALUES
(4, 'Floral Print Abaya', 'Lightweight cotton with floral pattern', 75000.00, 'images/abaya11.jpg', NULL, 0),
(5, 'Royal Purple Abaya', 'Velvet abaya with satin trim', 129000.00, 'images/abaya10.jpg', NULL, 0),
(6, 'White Lace Abaya', 'Modest prayer abaya with lace detailing', 65000.00, 'images/abaya6.jpg', NULL, 0),
(7, 'Gold Belted Abaya', 'Modern design with detachable gold belt', 159000.00, 'images/abaya2.jpg', NULL, 0),
(8, 'Pink Crystal Abaya', 'Special occasion abaya with crystal beads', 219000.00, 'images/abaya5.jpg', NULL, 0),
(9, 'Black Velvet Abaya', 'Winter abaya with full sleeves', 110000.00, 'images/abaya12.jpg', NULL, 0),
(10, 'Grey Georgette Abaya', 'Casual everyday abaya with pockets', 79000.00, 'images/abaya15.jpg', NULL, 0),
(11, 'Embroidered Silk Abaya', 'Black silk abaya with gold embroidery', 149000.00, 'images/abaya4.jpg', NULL, 0),
(12, 'Navy Blue Kaftan Abaya', 'Flowly navy blue chiffon abaya', 89000.00, 'images/abaya9.jpg', NULL, 0),
(13, 'Silver Sequined Abaya', 'Evening abaya with silver sequin details', 199000.00, 'images/abaya1.jpg', NULL, 0),
(14, 'Floral Print Abaya', 'Lightweight cotton with floral pattern', 75000.00, 'images/abaya11.jpg', NULL, 0),
(15, 'Royal Purple Abaya', 'Velvet abaya with satin trim', 129000.00, 'images/abaya10.jpg', NULL, 0),
(16, 'White Lace Abaya', 'Modest prayer abaya with lace detailing', 65000.00, 'images/abaya6.jpg', NULL, 0),
(17, 'Gold Belted Abaya', 'Modern design with detachable gold belt', 159000.00, 'images/abaya2.jpg', NULL, 0),
(18, 'Pink Crystal Abaya', 'Special occasion abaya with crystal beads', 219000.00, 'images/abaya5.jpg', NULL, 0),
(19, 'Black Velvet Abaya', 'Winter abaya with full sleeves', 110000.00, 'images/abaya12.jpg', NULL, 0),
(20, 'Grey Georgette Abaya', 'Casual everyday abaya with pockets', 79000.00, 'images/abaya15.jpg', NULL, 0),
(21, 'Embroidered Silk Abaya', 'Black silk abaya with gold embroidery', 14900.99, 'images/abaya4.jpg', NULL, 0),
(22, 'Navy Blue Kaftan Abaya', 'Flowly navy blue chiffon abaya', 89000.00, 'images/abaya9.jpg', NULL, 0),
(23, 'Silver Sequined Abaya', 'Evening abaya with silver sequin details', 199000.00, 'images/abaya1.jpg', NULL, 0),
(24, 'Floral Print Abaya', 'Lightweight cotton with floral pattern', 75000.00, 'images/abaya11.jpg', NULL, 0),
(25, 'Royal Purple Abaya', 'Velvet abaya with satin trim', 129000.00, 'images/abaya10.jpg', NULL, 0),
(26, 'White Lace Abaya', 'Modest prayer abaya with lace detailing', 65000.00, 'images/abaya6.jpg', NULL, 0),
(27, 'Gold Belted Abaya', 'Modern design with detachable gold belt', 159000.00, 'images/abaya2.jpg', NULL, 0),
(28, 'Pink Crystal Abaya', 'Special occasion abaya with crystal beads', 219000.00, 'images/abaya5.jpg', NULL, 0),
(29, 'Black Velvet Abaya', 'Winter abaya with full sleeves', 110000.00, 'images/abaya12.jpg', NULL, 0),
(30, 'Grey Georgette Abaya', 'Casual everyday abaya with pockets', 79000.00, 'images/abaya15.jpg', NULL, 0),
(31, 'Embroidered Silk Abaya', 'Black silk abaya with gold embroidery', 14900.00, 'images/abaya4.jpg', NULL, 0),
(32, 'Navy Blue Kaftan Abaya', 'Flowly navy blue chiffon abaya', 89000.00, 'images/abaya9.jpg', NULL, 0),
(33, 'Silver Sequined Abaya', 'Evening abaya with silver sequin details', 199000.00, 'images/abaya1.jpg', NULL, 0),
(34, 'Floral Print Abaya', 'Lightweight cotton with floral pattern', 75000.00, 'images/abaya11.jpg', NULL, 0),
(35, 'Royal Purple Abaya', 'Velvet abaya with satin trim', 129000.00, 'images/abaya10.jpg', NULL, 0),
(36, 'White Lace Abaya', 'Modest prayer abaya with lace detailing', 65000.00, 'images/abaya6.jpg', NULL, 0),
(37, 'Gold Belted Abaya', 'Modern design with detachable gold belt', 159000.00, 'images/abaya2.jpg', NULL, 0),
(38, 'Pink Crystal Abaya', 'Special occasion abaya with crystal beads', 219000.00, 'images/abaya5.jpg', NULL, 0),
(39, 'Black Velvet Abaya', 'Winter abaya with full sleeves', 110000.00, 'images/abaya12.jpg', NULL, 0),
(40, 'Grey Georgette Abaya', '', 89000.00, 'images/abaya15.jpg', NULL, 10),
(41, 'pink abaya', 'a long pink abaya', 77000.00, '68012a2b5a07a_pink.jpg', NULL, 13);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'musajidder', 'musajidder@gmail.com', '$2y$10$FHhzVU0y1na.m5FcrsoCOup30dJnXyNcwHNf0Xkz8MT1LAR.0Gb3q', 'user', '2025-04-17 09:48:35'),
(2, 'musajidda1', 'muhammadmjidder8@gmail.com', '$2y$10$S4XIQeI9FP4aruNO4qEf7.9CQIQFD2TkHk/0RoACT7aBInyB9nj8y', 'admin', '2025-04-17 09:59:49'),
(3, 'musajidda9', 'musajidda9@gmail.com', '$2y$10$ucMOy5p3ERcCPmj9NT9poOly4i7kCE.qAEzOlx7Erto/3gcycx9Py', 'admin', '2025-04-17 16:37:37'),
(4, 'musajidda9', 'musajidda9@gmail.com', '$2y$10$Ysza3hwb3QBDw3CKJOLj..hvroF7Q3LYMn06KuKpRP1PdqdCPOvLy', 'admin', '2025-04-17 16:38:06'),
(5, 'zarah', 'zarah@gmail.com', '$2y$10$9op1yFy5rCH/SQrnC6FYiOngMamIfYI/9MXxg.ikiFVwG.s44m6/u', 'admin', '2025-04-17 18:34:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
