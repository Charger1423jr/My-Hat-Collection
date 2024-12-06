-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 03:24 AM
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
-- Database: `myhats`
--

-- --------------------------------------------------------

--
-- Table structure for table `hats`
--

CREATE TABLE `hats` (
  `id` int(11) NOT NULL,
  `imageAddress` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hats`
--

INSERT INTO `hats` (`id`, `imageAddress`, `name`, `bio`, `details`, `year`, `price`) VALUES
(1, './images/alaska.jpg', 'Alaska State', 'Acquired hat during vacation to Alaska. Bought in tourist shop in Skagway.', 'Green hat with brown felt brim. Has state name, along with a brown bear in the middle of the leather patch. At the bottom, it says \"The Last Frontier\", Alaskas state motto.', '2024', 25.00),
(2, './images/california.jpg', 'California State', 'Parents acquired hat when visiting San Francisco during vacation.', 'Black and gray hat. Big cursive \"Cali\" on front with small ones in a checkered pattern on underside of brim. Small grizzly bear walking, representing Californias State Flag.', '2022', 30.00),
(3, './images/colorado.jpg', 'Colorado State', 'Bought during Layover in Denver on the way to Alaska.', 'Trucker-Style hat. Front has the colors of Colorados state flag with the mountains at the bottom.', '2024', 25.00),
(4, './images/florida.jpg', 'Back To The Future', 'Hat from the Movie \"Back to the Future: Part II\". Bought during vacation to Universal Studios in Orlando, Florida.', 'Reflective rainbow colors all around hat.', '2021', 50.00),
(5, './images/hawaii.JPG', 'Hawaii State', 'Bought by Parents during vacation to Hawaii. Found in Hana.', 'Red base, \"Hana\", the citys name, written in cursive on the front, with the Hawaiian flag on the top of the brim.', '2021', 20.00),
(6, './images/illinois.jpg', 'Chicago Windy City', 'Bought during a school field trip to Chicago, found at a pier shop. My second hat in my collection.', 'Beige base with black brim and accents. Leather patch that says, \"Chicago The Windy City\", with the city flag behind it.', '2017', 35.00),
(7, './images/michigan.jpg', 'Lake Michigan Sunrise', 'Bought during Vacation to Michigan. Found in a Harbor town gift shop.', 'Black base with baby blue script saying, \"Michigan\". The Brim is a sunset over Lake Michigan.', '2018', 20.00),
(8, './images/newyork.jpg', 'New York Designer', 'Bought at the H&M in Times Square during a vacation to New York City. My first hat to begin my collection', 'Dark gray and light gray hat. Felt Brim, with patch that says \"YHH\".', '2016', 35.00),
(9, './images/scarolina.jpg', 'Coach Designer', 'Bought at Coach Outlet Store. On sale for half off. My most expensive hat in my collection.', 'Leather brim and clasp. Coach design on hat with cursive \"Coach\" in blue.', '2019', 120.00),
(10, './images/texas.jpg', 'Texas State', 'Bought in Dallas Airport during layover to Cincinnati from Seattle.', 'Trucker-Style. Texas state outline on front with \"Tx\" in the middle. Looks older than it really is.', '2024', 25.00);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imageAddress` varchar(200) NOT NULL,
  `width` int(255) DEFAULT NULL,
  `height` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imageAddress`, `width`, `height`) VALUES
('./images/alaska.jpg', 150, 200),
('./images/california.jpg', 150, 200),
('./images/colorado.jpg', 150, 200),
('./images/florida.jpg', 150, 200),
('./images/hawaii.JPG', 150, 200),
('./images/illinois.jpg', 150, 200),
('./images/michigan.jpg', 150, 200),
('./images/newyork.jpg', 150, 200),
('./images/scarolina.jpg', 150, 200),
('./images/texas.jpg', 150, 200);

-- --------------------------------------------------------

--
-- Table structure for table `posting`
--

CREATE TABLE `posting` (
  `id` int(11) NOT NULL,
  `imageAddress` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adminStatus` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `adminStatus`) VALUES
('Bobby1', 'password123', 0),
('JimmyAdmin', 'adminpassword', 1),
('Tommy2', 'password123', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hats`
--
ALTER TABLE `hats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imageAddress`);

--
-- Indexes for table `posting`
--
ALTER TABLE `posting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imageAddress` (`imageAddress`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hats`
--
ALTER TABLE `hats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posting`
--
ALTER TABLE `posting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posting`
--
ALTER TABLE `posting`
  ADD CONSTRAINT `posting_ibfk_1` FOREIGN KEY (`imageAddress`) REFERENCES `images` (`imageAddress`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
