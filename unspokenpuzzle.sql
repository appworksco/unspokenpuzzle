-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2024 at 06:04 PM
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
-- Database: `unspokenpuzzle`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `banner_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `banner_image`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `book_image` text NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_image`, `book_name`, `description`, `price`) VALUES
(12, './assets/book-images/65c004533145a3.47760137.jpg', 'Zodion Academy', 'Zodion Academy description starts here', 50),
(14, './assets/book-images/65f7069beb3790.71541764.jpg', 'Eye Emperor', 'you just don\'t have to have a description here. its just an Eye Emperor anyway', 290);

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `chapter` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Guhit ng hegante', 'ang higante ay magaling mag guhit ng mga bagay2x kaya naman marami ang naiinis dito. at gustong kumuha ng mga anteng2x at mga buhok dito', '2024-03-18 14:02:07', '2024-03-18 14:02:08'),
(3, 'Espada ni Pandido', 'ang espada ni pandido ay isang napakahalagang bagay noong unang panahon, hindi lamang sa mga pilipino pero para din sa mga kano na kasama nila. kasi pag ito ay nakikita ng mga hapun ay tumatalon ang mga hapun sa tuwa kaya yun ang ginawa nilang paraan para manalo sa digmaan', '2024-03-18 14:09:29', '2024-03-18 15:10:17'),
(4, 'Kurama, Namatay na ', 'Hindi pa naman tiyak pero may mga kumakalat na usapin na si Kurama daw o mas kilala bilang nine tails ay namaalam na, totoo ba ito o haka2x lamang. abangan ang kasagutan sa mga susunod na araw. salamat sa pag babasa', '2024-03-18 14:41:57', '2024-03-18 14:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `parallax_1`
--

CREATE TABLE `parallax_1` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parallax_1`
--

INSERT INTO `parallax_1` (`id`, `book_id`) VALUES
(1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `parallax_2`
--

CREATE TABLE `parallax_2` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parallax_2`
--

INSERT INTO `parallax_2` (`id`, `book_id`) VALUES
(1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `parallax_3`
--

CREATE TABLE `parallax_3` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parallax_3`
--

INSERT INTO `parallax_3` (`id`, `book_id`) VALUES
(1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `purchased_books`
--

CREATE TABLE `purchased_books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchased_books`
--

INSERT INTO `purchased_books` (`id`, `user_id`, `book_id`, `price`, `date`) VALUES
(6, 5, 12, 50, '2024-01-19'),
(7, 5, 12, 50, '2024-03-15'),
(8, 5, 12, 50, '2024-03-15'),
(9, 5, 12, 50, '2024-03-17'),
(10, 5, 14, 290, '2024-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `image`, `name`, `price`, `link`) VALUES
(2, './assets/product-images/65ef134c1cecb0.49854404.png', 'Product 1', 150, 'www.product1.com'),
(4, './assets/product-images/65f86467b98159.73326684.png', 'Spade', 256, 'www.spade.com'),
(5, './assets/product-images/65f86eacb1a6a1.37456153.jpg', 'Empelock', 499, 'www.empelock.com'),
(6, './assets/product-images/65f873db677307.77786409.jpg', 'Google', 10000, 'www.google.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `wallet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `email`, `full_name`, `username`, `password`, `wallet`) VALUES
(2, 0, '', 'Administrator', 'admin', 'admin', 0),
(5, 1, 'test@gmail.com', 'Test', 'Test', 'test', 210);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parallax_1`
--
ALTER TABLE `parallax_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parallax_2`
--
ALTER TABLE `parallax_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parallax_3`
--
ALTER TABLE `parallax_3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchased_books`
--
ALTER TABLE `purchased_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
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
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parallax_1`
--
ALTER TABLE `parallax_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parallax_2`
--
ALTER TABLE `parallax_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parallax_3`
--
ALTER TABLE `parallax_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchased_books`
--
ALTER TABLE `purchased_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
