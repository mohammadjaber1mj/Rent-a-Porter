-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2024 at 10:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent_a_porter_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`) VALUES
(1, 1),
(2, 6),
(3, 9),
(4, 10),
(5, 11),
(6, 12),
(7, 13);

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_item_id` int(11) NOT NULL,
  `dress_code` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`cart_item_id`, `dress_code`, `cart_id`, `start_date`, `end_date`) VALUES
(1, 1, 2, '2024-05-23', '2024-05-25');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Wedding guest'),
(2, 'Date night'),
(3, 'Prom'),
(4, 'BLACK TIE'),
(5, 'Bridal'),
(6, 'Casual wear'),
(7, 'Cocktail'),
(8, 'Daytime'),
(9, 'Formal'),
(10, 'Graduation'),
(11, 'Vacation'),
(12, 'Night out'),
(13, 'Engagement'),
(14, 'Corporate'),
(15, 'Bridesmaid');

-- --------------------------------------------------------

--
-- Table structure for table `designers`
--

CREATE TABLE `designers` (
  `designer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designers`
--

INSERT INTO `designers` (`designer_id`, `name`) VALUES
(1, 'Abbas Harajli'),
(2, 'Nour Azhari'),
(3, 'Gucci'),
(4, 'Elie Saab'),
(5, 'Aden'),
(6, 'Bianca Sara'),
(7, 'Rent à Porter'),
(8, 'Alaa Najd'),
(9, 'Alex Perry'),
(10, 'Alexander McQueen'),
(11, 'Allure Bridal'),
(12, 'BAZAZA'),
(13, 'Barbara Casasola'),
(14, 'Bebe'),
(15, 'Calvin Klein'),
(16, 'Catherine Deane'),
(17, 'Catwalk Couture'),
(18, 'Chloe Haddad'),
(19, 'David Koma'),
(20, 'Diane von Furstenberg'),
(21, 'Dolce & Gabbana'),
(22, 'Eli The Label'),
(23, 'Elio Moussallem'),
(24, 'Emilio Pucci'),
(25, 'Fadel Jaber'),
(26, 'Fendi'),
(27, 'Fabienne Alagama'),
(28, 'Fouad Sarkis'),
(29, 'Gaby Charbachy'),
(30, 'Galvan'),
(31, 'Georges Farah'),
(32, 'Geyanna Younes'),
(33, 'Hanadi Abboud'),
(34, 'Housam Seif Eldin'),
(35, 'Issam Nahhas'),
(36, 'Jad Couture'),
(37, 'Jad Khalil'),
(38, 'Mohammad Murad'),
(39, 'Moschino'),
(40, 'Michael Kors'),
(41, 'Zuhair Murad'),
(42, 'Elegant Wineberry'),
(43, 'Rami Kadi');

-- --------------------------------------------------------

--
-- Table structure for table `dresses`
--

CREATE TABLE `dresses` (
  `dress_code` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `rental_price` double NOT NULL,
  `color` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `length` varchar(50) NOT NULL,
  `notes` varchar(250) NOT NULL,
  `description` varchar(200) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `designer_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dresses`
--

INSERT INTO `dresses` (`dress_code`, `image`, `rental_price`, `color`, `size`, `length`, `notes`, `description`, `owner_id`, `designer_id`, `category_id`, `price`) VALUES
(1, 'A1.png', 230, 'Gold', '36', 'Tall', 'Needs a lot of fixing, and has a lot of potential.', 'Sleeveless Crew-Neck Beads Dress', 1, 5, 1, 175),
(2, 'A2.png', 200, 'Gold', '36', 'Tall', 'Comes with an extra piece.', 'Sleeveless High-Low Flowy Dress', 1, 6, 2, 150),
(3, 'B1.png', 150, 'Light Blue', '38', 'Tall', 'Embroided', 'Embroidered Light Blue Princess Cut Long', 1, 7, 3, 110),
(4, 'B17.png', 130, 'Blue', '38', 'Short', 'None', 'Short Strapless Dress', 2, 7, 3, 170),
(5, 'R1.jpg', 310, 'Red', '40', 'Tall', 'Embroided', 'Bordeaux full embroidered long princess cut ', 2, 4, 1, 260),
(11, 'G3.jpg', 450, 'Green', '38', 'Midi', 'this dress was only used once by me to a prom night,and is still in perfect condition.', 'midnight green sleevless dress', 4, 3, 3, 22500),
(12, 'K6.jpg', 200, 'Black', '40', 'Midi', 'none', 'Long Sleeve Black Midi Dress', 2, 7, 2, 2500),
(13, 'R4(1).jpg', 110, 'Others', '34', 'Short', 'none', 'Flowy Backless Dress', 4, 42, 4, 2000),
(14, 'W5(1).jpg', 280, 'Light Blue', '36', 'Tall', 'Can not go without short, embroidered', 'Bridal Embroidered Corset Dress With Ruffled Skirt', 1, 43, 5, 9000),
(15, 'B10.jpg', 135, 'Light Blue', '34', 'Tall', 'none', 'Sleeveless Long Embroidered Dress', 2, 17, 1, 1500),
(16, 'B11.jpg', 120, 'Blue', '38', 'Tall', 'none', 'Silk Long Dress', 2, 2, 3, 1200),
(17, 'P5(1).jpg', 270, 'Pink', '36', 'Tall', 'none', 'Strapless Corset Beaded Gown', 2, 43, 4, 1700),
(18, 'S7.jpg', 250, 'White', '38', 'Tall', 'none', 'Sleeveless Slit Fitted Dress', 1, 7, 5, 1400),
(19, 'S6(1).jpg', 195, 'Others', '38', 'Midi', 'none', 'Sleeveless V-Neck Pleated Dress', 1, 43, 7, 2100),
(20, 'S2.jpg', 200, 'Purple', '38', 'Midi', 'none', 'no desc', 7, 43, 2, 3500);

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `fav_id` int(11) NOT NULL,
  `dress_code` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`fav_id`, `dress_code`, `user_id`) VALUES
(1, 1, 1),
(2, 4, 1),
(9, 4, 6),
(10, 2, 1),
(11, 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `gift_cards`
--

CREATE TABLE `gift_cards` (
  `card_id` int(11) NOT NULL,
  `recipient_name` varchar(50) NOT NULL,
  `recipient_email` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `message` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gift_cards`
--

INSERT INTO `gift_cards` (`card_id`, `recipient_name`, `recipient_email`, `amount`, `message`, `user_name`, `user_id`, `purchase_date`) VALUES
(7, 'Mira', 'mohammadjaber.mj@gmail.com', 490, 'Happy Birthday', 'mj', 1, '2024-05-26');

-- --------------------------------------------------------

--
-- Table structure for table `lenders`
--

CREATE TABLE `lenders` (
  `lender_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lenders`
--

INSERT INTO `lenders` (`lender_id`, `fname`, `lname`, `phone_number`, `email`, `password`) VALUES
(1, 'Mohammad Ali', 'Jaber', 76811429, 'mohammadjaber.mj.2001@gmail.com', '$2y$10$v2lo5.MUOIxY0LRqgjnKde4zZgOFTPtfy87BJu3PPejCLRNp4X0t2'),
(2, 'Mohammad', 'Dbouk', 76942204, 'mhmdddouk84@gmail.com', '$2y$10$IhRhsCannkGZ8ZfcqmYpb.hMubw6A6kGxT0avdBGG2e0k4INkyC8S'),
(4, 'Bob', 'Bannout', 70016601, 'bobannout433@icloud.com', '$2y$10$g.Ub4qJmUhDxk2/MCkmpDevjlSlWyMnHLHK3/Y3VevFkuKBgTDHia'),
(7, 'Nehme', 'Rmeity', 71887887, 'nehmermeity@liu.edu.lb', '$2y$10$VuJsCs0Rrsvy.8ty63xqI.g5MLqzkwX47qIrPDwVFsd95RlJWpRB.');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `rental_id` int(11) NOT NULL,
  `dress_code` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`rental_id`, `dress_code`, `user_id`, `price`, `start_date`, `end_date`) VALUES
(1, 1, 1, 230, '2024-05-22', '2024-05-24'),
(2, 2, 1, 200, '2024-05-31', '2024-06-02'),
(3, 3, 1, 150, '2024-05-20', '2024-05-22'),
(11, 1, 1, 230, '2024-05-25', '2024-05-31'),
(12, 1, 9, 230, '2024-06-06', '2024-06-08'),
(13, 11, 9, 450, '2024-06-21', '2024-06-27'),
(14, 5, 12, 310, '2024-06-07', '2024-06-13'),
(15, 1, 1, 230, '2024-06-18', '2024-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phone_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `password`, `address`, `phone_number`) VALUES
(1, 'Mohammad Ali', 'Jaber', 'mohammadjaber.mj.2001@gmail.com', '$2y$10$/7wFQjRrrnYCioTgZrHmSOfCm9.kUxJ5NDubZAsBE3x7Vgth28PA.', '1', 76811429),
(6, 'Mohammad', 'Dbouk', 'mhmdddouk84@gmail.com', '$2y$10$60gm/8ROrwwQXMB0ZjzSyODy9/nUToQ2R4wqx79RjUNl8bOMzKI7K', '2', 76942204),
(9, 'Johan', 'Mougharbel', 'Johan123mougharbel.jm@hotmail.com', '$2y$10$jv4098YqHwb4iTg6oyNKeuX7QikGxR7cXICpaltgJSOYIWKPBGAfa', '', 78997995),
(10, 'Ibrahim', 'Bannout', 'bobannout433@icloud.com', '$2y$10$mNvJdqFEdMRo..z2B4ep9uqu7KF/AHANzZJWIgNE6az0wOexLt4Pm', '', 70016601),
(11, 'Hasan', 'Abou Hachem', 'hassanabohachem@gmail.com', '$2y$10$2Z9W0iZ8cYHvKwervldtce5PW.fe.XnEfjuFuaqmpvTpQJI.i1JJa', '', 76612452),
(12, 'sara', 'taleb', 'sarajabertaleb20@gmail.com', '$2y$10$Rx.3u3C3ThaMIhn4PoWskOAPBe.h1vLgSuJn..Msli1QLzDwb.Ese', '', 70827517),
(13, 'Mira', 'Taleb', 'mirataleb.mt.2024@gmail.com', '$2y$10$U9R0mubRrscsp2z5P2f8J.XGuCe7/JQ2DmOdsUH43sD4P3RrhJ9HS', '', 70677452);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `building` varchar(50) NOT NULL,
  `floor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`address_id`, `user_id`, `country`, `city`, `street`, `building`, `floor`) VALUES
(13, 1, 'Lebanon', 'Beirut', 'hadat', '99', 7),
(14, 9, 'Lebanong', 'Beirut', 'hadat', 'mougharbel building', 3),
(15, 12, 'Lebanon', 'Beirut', 'sfeir', 'haydar', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `dress_code` (`dress_code`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `designers`
--
ALTER TABLE `designers`
  ADD PRIMARY KEY (`designer_id`);

--
-- Indexes for table `dresses`
--
ALTER TABLE `dresses`
  ADD PRIMARY KEY (`dress_code`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `designer_id` (`designer_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `dress_code` (`dress_code`);

--
-- Indexes for table `gift_cards`
--
ALTER TABLE `gift_cards`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `lenders`
--
ALTER TABLE `lenders`
  ADD PRIMARY KEY (`lender_id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `dress_code` (`dress_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD KEY `address_id` (`address`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `designers`
--
ALTER TABLE `designers`
  MODIFY `designer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `dresses`
--
ALTER TABLE `dresses`
  MODIFY `dress_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `gift_cards`
--
ALTER TABLE `gift_cards`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lenders`
--
ALTER TABLE `lenders`
  MODIFY `lender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`),
  ADD CONSTRAINT `cart_item_ibfk_3` FOREIGN KEY (`dress_code`) REFERENCES `dresses` (`dress_code`);

--
-- Constraints for table `dresses`
--
ALTER TABLE `dresses`
  ADD CONSTRAINT `dresses_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `lenders` (`lender_id`),
  ADD CONSTRAINT `dresses_ibfk_2` FOREIGN KEY (`designer_id`) REFERENCES `designers` (`designer_id`),
  ADD CONSTRAINT `dresses_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `favourites_ibfk_3` FOREIGN KEY (`dress_code`) REFERENCES `dresses` (`dress_code`);

--
-- Constraints for table `gift_cards`
--
ALTER TABLE `gift_cards`
  ADD CONSTRAINT `gift_cards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `rentals_ibfk_3` FOREIGN KEY (`dress_code`) REFERENCES `dresses` (`dress_code`);

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
