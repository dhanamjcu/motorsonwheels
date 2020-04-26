

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `motoronwheels`
--

-- --------------------------------------------------------

--
-- Table structure for table `adapprove`
--

CREATE TABLE `adapprove` (
  `token_id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `mailsent` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adapprove`
--

INSERT INTO `adapprove` (`token_id`, `ad_id`, `token`, `mailsent`, `created_at`) VALUES
(3, 56, 'cff889575d854b4d9342a9ac30eb1d0bdbe3b8169f5f16393f', 1, '2020-04-01 08:46:29'),
(4, 57, '0c87391eec37eba9d59b9319e2237db9fa3a9e62acee3eb818', 0, '2020-04-01 08:54:53'),
(5, 58, '3aab81c8c2aba2368a214378b10180edf543c5e0fca3de0801', 0, '2020-04-01 09:00:04'),
(6, 59, '0686bbefec197c2a65bfaff7dac4289369f97b877a47d80f56', 0, '2020-04-01 10:22:26'),
(7, 60, 'f3b45788a4509f1ab34504e36859548ac6ec5643bbd3227b8f', 1, '2020-04-01 10:24:52'),
(8, 61, 'bfb3013d111dd4511b3d5e9ce42ce68afe11a47b340957e017', 1, '2020-04-01 12:28:29'),
(9, 62, '267d81ebd112b9869bfd8664144fdf23e40949e6dd29d34cdf', 1, '2020-04-03 05:15:54'),
(10, 63, '7628cc3d4ab9338e7fcdab045a98d00f586d80e8efb6246684', 1, '2020-04-03 08:25:41'),
(11, 64, '12e967ae780a773756697aef9f2bbd731818f366be6b35a6aa', 1, '2020-04-03 08:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `adimg`
--

CREATE TABLE `adimg` (
  `imgId` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ads_id` int(11) NOT NULL,
  `imgname` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adimg`
--

INSERT INTO `adimg` (`imgId`, `user_id`, `ads_id`, `imgname`, `created_at`) VALUES
(2635, 9, 50, '5e37d5197e29f.jpg', '2020-02-03 08:08:57'),
(2636, 9, 50, '5e37d5197ea0b.jpg', '2020-02-03 08:08:57'),
(2637, 10, 51, '5e37f370063e7.jpg', '2020-02-03 10:18:24'),
(2638, 10, 51, '5e37f37006b4b.jpg', '2020-02-03 10:18:24'),
(2639, 9, 52, '5e3d84a930d50.jpg', '2020-02-07 15:39:21'),
(2640, 9, 52, '5e3d84a93144d.jpg', '2020-02-07 15:39:21'),
(2644, 13, 54, '5e4bd0e687da6.jpg', '2020-02-18 11:56:22'),
(2645, 13, 54, '5e4bd0e68846c.jpg', '2020-02-18 11:56:22'),
(2649, 9, 56, '5e8454e54f69c.jpg', '2020-04-01 08:46:29'),
(2650, 9, 57, '5e8456dd83500.jpg', '2020-04-01 08:54:53'),
(2651, 9, 57, '5e8456dd837cc.jpg', '2020-04-01 08:54:53'),
(2652, 9, 57, '5e8456dd839df.jpg', '2020-04-01 08:54:53'),
(2653, 9, 58, '5e845813cb32d.jpg', '2020-04-01 09:00:03'),
(2654, 9, 58, '5e845813cb5ca.jpg', '2020-04-01 09:00:03'),
(2655, 9, 59, '5e846b6281d20.jpg', '2020-04-01 10:22:26'),
(2656, 9, 59, '5e846b6282006.jpg', '2020-04-01 10:22:26'),
(2657, 9, 60, '5e846bf4ce0b8.jpg', '2020-04-01 10:24:52'),
(2658, 9, 60, '5e846bf4ce3a8.jpg', '2020-04-01 10:24:52'),
(2659, 9, 61, '5e8488ed436c2.jpg', '2020-04-01 12:28:29'),
(2660, 9, 61, '5e8488ed43a67.jpg', '2020-04-01 12:28:29'),
(2661, 9, 61, '5e8488ed43e0a.jpg', '2020-04-01 12:28:29'),
(2662, 9, 62, '5e86c68a09d2f.jpg', '2020-04-03 05:15:54'),
(2663, 9, 62, '5e86c68a0a061.jpg', '2020-04-03 05:15:54'),
(2664, 9, 63, '5e86f3050f58b.jpg', '2020-04-03 08:25:41'),
(2665, 9, 63, '5e86f3050f92b.jpg', '2020-04-03 08:25:41'),
(2666, 9, 64, '5e86f39cc77b2.jpg', '2020-04-03 08:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending',
  `cartype` varchar(50) NOT NULL,
  `carname` varchar(100) NOT NULL,
  `carmodel` varchar(50) DEFAULT NULL,
  `bodytype` varchar(50) DEFAULT NULL,
  `odometer` varchar(50) DEFAULT NULL,
  `transmission` varchar(50) DEFAULT NULL,
  `engine` varchar(50) DEFAULT NULL,
  `price` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `cylinder` varchar(50) DEFAULT NULL,
  `engineDes` varchar(255) DEFAULT NULL,
  `fuelEconomy` varchar(50) DEFAULT NULL,
  `turbo` varchar(50) DEFAULT NULL,
  `power` varchar(50) DEFAULT NULL,
  `tow` varchar(50) DEFAULT NULL,
  `colour` varchar(50) DEFAULT NULL,
  `seats` varchar(50) DEFAULT NULL,
  `doors` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `user_id`, `status`, `cartype`, `carname`, `carmodel`, `bodytype`, `odometer`, `transmission`, `engine`, `price`, `year`, `cylinder`, `engineDes`, `fuelEconomy`, `turbo`, `power`, `tow`, `colour`, `seats`, `doors`, `created_at`) VALUES
(50, 9, 'approved', 'new', 'BMW', 'M2', 'Coupe', '8522', 'manual', NULL, '9999', '2018', '3', 'Turbo 3.2 Diesel', '11', NULL, NULL, NULL, 'red', '2', '2', '2020-02-26 08:57:20'),
(51, 10, 'Pending', 'new', 'Mercedes-Benz', 'SLS-Class', 'Convertible', '1200', 'automatic', NULL, '90000', '2020', '6', 'Turbo 2.2 Petrol', '8', NULL, NULL, NULL, 'red', '2', '2', '2020-02-13 12:27:08'),
(52, 9, 'approved', 'used', 'Hyundai', 'Accent', 'Sedan', '12', 'automatic', NULL, '9999', '2018', '4', 'turbo petrol', '12', NULL, NULL, NULL, 'indigo', '4', '4', '2020-02-13 11:05:08'),
(54, 13, 'approved', 'used', 'ford', 'F100', 'Cab Chassis', '3000', 'automatic', NULL, '12999', '2018', '10', 'Turbo 2.2 Diesel', '5', NULL, NULL, NULL, 'teal', '6', '3', '2020-02-18 12:01:14'),
(56, 9, 'pending', 'used', 'BMW', 'M2', 'Coupe', '5236', 'automatic', NULL, '99999', '2017', '8', 'Turbo 2.2 Petrol', '10', NULL, NULL, NULL, 'red', '4', '4', '2020-04-01 08:46:29'),
(57, 9, 'pending', 'new', 'ford', 'bronco', 'Cab Chassis', '122', 'automatic', NULL, '1234', '2017', '8', 'petrol', '8', NULL, NULL, NULL, 'cyan', '4', '4', '2020-04-01 08:54:53'),
(58, 9, 'pending', 'new', 'Hyundai', 'Accent', 'Sedan', '12345', 'automatic', NULL, '98765', '2017', '8', 'petrol', '9', NULL, NULL, NULL, 'black', '4', '4', '2020-04-01 09:00:03'),
(59, 9, 'pending', 'new', 'audi', 'A2', 'Hatch', '1234', 'automatic', NULL, '9876', '2017', '6', 'petrol', '8', NULL, NULL, NULL, 'brown', '4', '4', '2020-04-01 10:22:26'),
(60, 9, 'pending', 'new', 'audi', 'A1', 'Hatch', '566', 'automatic', NULL, '9876', '2017', '12234', 'p', '9', NULL, NULL, NULL, 'magenta', '4', '4', '2020-04-01 10:24:52'),
(61, 9, 'rejected', 'used', 'BMW', 'M3', 'Sedan', '1452', 'automatic', NULL, '7893', '2018', '8', 'petrol', '4563', NULL, NULL, NULL, 'tan', '4', '4', '2020-04-01 19:20:13'),
(62, 9, 'approved', 'new', 'BMW', 'M3', 'Sedan', '8789', 'automatic', NULL, '7890', '2018', '8', 'petrol', '8', NULL, NULL, NULL, 'black', '4', '4', '2020-04-03 08:14:53'),
(63, 9, 'pending', 'new', 'audi', 'A2', 'Hatch', '456321', 'automatic', NULL, '41256', '2017', '12', 'petrol', '12', NULL, NULL, NULL, 'orange', '1', '2', '2020-04-03 08:25:40'),
(64, 9, 'rejected', 'new', 'BMW', 'M3', 'Sedan', '123', 'automatic', NULL, '222', '2018', '12', '22', '2', NULL, NULL, NULL, 'purple', '2', '2', '2020-04-03 17:31:40'),
(65, 9, 'pending', 'new', 'BMW', 'M4', 'Convertible', '123', 'automatic', NULL, '12345', '2017', '1', 'petrol', '12', NULL, NULL, NULL, 'blue', '21', '2', '2020-04-03 08:33:51');

-- --------------------------------------------------------

--
-- Table structure for table `bodytype`
--

CREATE TABLE `bodytype` (
  `id` int(11) NOT NULL,
  `bodytype` varchar(50) NOT NULL,
  `bodyimg` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bodytype`
--

INSERT INTO `bodytype` (`id`, `bodytype`, `bodyimg`, `created_at`) VALUES
(4, 'sedan', 'sedan.png', '2020-02-08 14:25:18'),
(5, 'ute', 'ute.png', '2020-02-08 14:35:30'),
(8, 'hatch', 'hatch.png', '2020-02-08 14:52:49'),
(9, 'bus', 'bus.png', '2020-02-08 14:58:04'),
(10, 'van', 'van.png', '2020-02-08 15:00:25'),
(11, 'people mover', 'people mover.png', '2020-02-08 15:01:57'),
(12, 'wagon', 'wagon.png', '2020-02-08 15:06:48'),
(13, 'light truck', 'light truck.png', '2020-02-08 15:07:42'),
(14, 'coupe', 'coupe.png', '2020-02-08 15:09:32'),
(15, 'suv', 'suv.png', '2020-02-08 15:18:17'),
(16, 'cab chassis', 'cab chassis.png', '2020-02-08 15:20:13'),
(18, 'convertible', 'convertible.png', '2020-02-10 18:18:53');

-- --------------------------------------------------------

--
-- Table structure for table `carbrands`
--

CREATE TABLE `carbrands` (
  `brand_id` int(11) NOT NULL,
  `brandname` varchar(50) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carbrands`
--

INSERT INTO `carbrands` (`brand_id`, `brandname`, `logo`, `created_at`) VALUES
(3, ' Audi', ' audi.png', '2020-02-08 11:16:05'),
(4, 'Mercedes-Benz', 'mercedes-benz.png', '2020-02-08 11:18:49'),
(5, 'Maserati', 'maserati.png', '2020-02-08 11:20:24'),
(6, 'ferrari', 'ferrari.png', '2020-02-08 11:23:49'),
(7, 'BMW', 'bmw.png', '2020-02-08 11:25:54'),
(8, 'ford', 'ford.png', '2020-02-08 11:26:57'),
(11, 'renault', 'renault.png', '2020-02-08 18:19:28'),
(12, 'chervolet', 'chervolet.png', '2020-02-09 05:21:27'),
(17, 'mini', 'mini.png', '2020-02-10 18:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `carname` varchar(50) NOT NULL,
  `carmodel` varchar(50) NOT NULL,
  `bodytype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `carname`, `carmodel`, `bodytype`) VALUES
(2, 'audi', 'A1', 'Hatch'),
(3, 'audi', 'A2', 'Hatch'),
(4, 'audi', 'A3', 'Hatch'),
(5, 'audi', 'A4', 'Sedan'),
(6, 'audi', 'A5', 'Hatch'),
(7, 'BMW', 'M2', 'Coupe'),
(8, 'BMW', 'M3', 'Sedan'),
(9, 'BMW', 'M4', 'Convertible'),
(10, 'BMW', 'M5', 'Sedan'),
(11, 'ford', 'bronco', 'Cab Chassis'),
(12, 'ford', 'capri', 'Coupe'),
(13, 'ford', 'endura', 'SUV'),
(14, 'Mercedes-Benz', 'R-Class', 'Sedan'),
(15, 'Mercedes-Benz', 'S-Class', 'Sedan'),
(16, 'Mercedes-Benz', 'SL-Class', 'Convertible'),
(17, 'Mercedes-Benz', 'SLS-Class', 'Convertible'),
(18, 'Mercedes-Benz', 'V-Class', 'Minivan'),
(19, 'Nisan', 'Bluebird', 'Compact'),
(20, 'Nisan', 'Cima', 'Sedan'),
(21, 'Nisan', 'Cube', 'Hatch'),
(22, 'Nisan', 'Dualis', 'SUV'),
(23, 'ford', 'F100', 'Cab Chassis'),
(24, 'Hyundai', 'Accent', 'Sedan'),
(25, 'Hyundai', 'Accent', 'hatch'),
(26, 'kia', 'Carnival', 'people mover'),
(27, 'kia', 'Rio', 'hatch'),
(28, 'kia', 'Rio', 'sedan'),
(37, 'mini', 'roadster', 'convertible');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `enqId` int(11) NOT NULL,
  `adId` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `action` varchar(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`enqId`, `adId`, `name`, `email`, `contact`, `message`, `action`, `created_at`) VALUES
(15, NULL, 'as', 'dhanamjayan83@gmail.com', '7412589630', 'as', '0', '2020-04-04 19:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'subscriber',
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `password`, `phone`, `city`, `state`, `country`, `address`, `zip`, `pic`, `created_at`) VALUES
(9, 'admin', 'Dhanam Jayan', 'dhanamjayan83@gmail@gmail.com', '$2y$10$dHFQ4cLtikcvPvNewl6R/OVpGXQLQgPbE8kgOsATr1D9eAh92yQXy', '0452415476', 'brisbane', 'brisbane', 'Australia', 'abc', '110086', '5e590630a4946.jpg', '2020-02-28 10:58:31'),
(10, 'subscriber', 'shivani', 'shivani@gmail.com', '$2y$10$86811iBRFx2Q4FItbb2GvOE8tTFatXX9jdnaEAhfMVCeKhDiksBmy', '', '', '', '', '', '', '', '2020-02-28 10:58:31'),
(11, 'admin', 'deepika', 'deepika@gmail.com', '$2y$10$i39FuTPQyajHYDPdHY1GyeIljVhRYxOC59qhYgacUlg3iJH8HBPLK', '9968335517', 'melborne', 'melbrone', 'austraila', '27/29, Street No. 9 ', '67687', '5e79ee14761d3.png', '2020-02-28 10:58:31'),
(12, 'subscriber', 'janny deo', 'janny@demomail.com', '$2y$10$BDZKEG2/4DUlrIbwtpn1Be1FIVaW9WABhoUgF2MIjnIPzbHaueBzi', '', '', '', '', '', '', '', '2020-02-28 10:58:31'),
(13, 'subscriber', 'lak', 'lakshmi@gmail.com', '$2y$10$n7xE3tAK.ANizvXgmC4wvOODD5RwTPfYXOXKBS4P5esXmOHgIO1Tq', '', '', '', '', '', '', '', '2020-02-28 10:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ads_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `ads_id`, `created_at`) VALUES
(23, 9, 50, '2020-02-03 17:55:22'),
(25, 9, 54, '2020-02-22 05:43:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adapprove`
--
ALTER TABLE `adapprove`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `adimg`
--
ALTER TABLE `adimg`
  ADD PRIMARY KEY (`imgId`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `ads` ADD FULLTEXT KEY `carname` (`carname`,`carmodel`,`bodytype`);
ALTER TABLE `ads` ADD FULLTEXT KEY `carname_2` (`carname`);
ALTER TABLE `ads` ADD FULLTEXT KEY `cartype` (`cartype`,`carname`,`carmodel`,`transmission`,`price`,`year`,`fuelEconomy`,`colour`,`seats`,`doors`);

--
-- Indexes for table `bodytype`
--
ALTER TABLE `bodytype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carbrands`
--
ALTER TABLE `carbrands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`enqId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adapprove`
--
ALTER TABLE `adapprove`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `adimg`
--
ALTER TABLE `adimg`
  MODIFY `imgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2667;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `bodytype`
--
ALTER TABLE `bodytype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `carbrands`
--
ALTER TABLE `carbrands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `enqId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
