-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2020 at 12:27 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travelgo`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_type`
--

CREATE TABLE `bank_type` (
  `id_bank_type` int(11) NOT NULL,
  `bank_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card_type`
--

CREATE TABLE `card_type` (
  `id_card_type` int(11) NOT NULL,
  `card_type_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id_city` int(11) NOT NULL,
  `city_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id_city`, `city_name`) VALUES
(1, 'Jakarta'),
(2, 'Bandung'),
(3, 'Makassar'),
(4, 'Surabaya'),
(5, 'Denpasar');

-- --------------------------------------------------------

--
-- Table structure for table `costumer`
--

CREATE TABLE `costumer` (
  `id_costumer` int(11) NOT NULL,
  `full_name` varchar(225) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `costumer`
--

INSERT INTO `costumer` (`id_costumer`, `full_name`, `email`, `phone`, `address`, `id_user`, `reg_date`) VALUES
(1, 'azis nuromdona maelandi', 'stevenazis71@gmail.com', '', '', 2, '2020-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `costumer_bank_account`
--

CREATE TABLE `costumer_bank_account` (
  `id_bank` int(11) NOT NULL,
  `id_costumer` int(11) NOT NULL,
  `bank_type` varchar(100) NOT NULL,
  `bank_account_name` varchar(225) NOT NULL,
  `bank_account_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `costumer_card_account`
--

CREATE TABLE `costumer_card_account` (
  `id_card` int(11) NOT NULL,
  `id_costumer` int(11) NOT NULL,
  `card_holder` varchar(200) NOT NULL,
  `card_number` varchar(100) NOT NULL,
  `card_type` int(11) NOT NULL,
  `exp_date` varchar(100) NOT NULL,
  `ccv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `level_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `level_name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `final_price` int(11) NOT NULL,
  `id_payment_type` int(11) NOT NULL,
  `buyer_name` varchar(100) NOT NULL,
  `buyer_email` varchar(100) NOT NULL,
  `buyer_phone` varchar(100) NOT NULL,
  `status` enum('Tertunda','Terbayar','Batal') NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time NOT NULL,
  `id_costumer` int(11) NOT NULL,
  `id_promo_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id_order`, `final_price`, `id_payment_type`, `buyer_name`, `buyer_email`, `buyer_phone`, `status`, `order_date`, `order_time`, `id_costumer`, `id_promo_code`) VALUES
(1, 900000, 2, 'azis nuromdona maelandi', 'stevenazis71@gmail.com', '087721434838', 'Terbayar', '2020-06-10', '17:05:44', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_cancel`
--

CREATE TABLE `order_cancel` (
  `id_order_cancel` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_costumer` int(11) NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `id_passenger` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `p_full_name` varchar(200) NOT NULL,
  `p_title` varchar(100) NOT NULL,
  `ticket_code` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`id_passenger`, `id_order`, `p_full_name`, `p_title`, `ticket_code`) VALUES
(1, 1, 'azis nuromdona maelandi', 'Tn', 'TGKIO4HTXBM');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id_payment` int(11) NOT NULL,
  `id_payment_type` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `id_reservation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `id_payment_type` int(11) NOT NULL,
  `payment_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`id_payment_type`, `payment_type_name`) VALUES
(1, 'Transfer Bank'),
(2, 'Kartu Kredit');

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `id_place` int(11) NOT NULL,
  `id_transportation_type` int(11) NOT NULL,
  `place_name` varchar(200) NOT NULL,
  `id_city` int(11) NOT NULL,
  `place_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`id_place`, `id_transportation_type`, `place_name`, `id_city`, `place_code`) VALUES
(1, 1, 'Halim Perdana', 1, 'HPK'),
(2, 1, 'Soekarno Hatta', 1, 'SH'),
(3, 2, 'Manggarai', 1, 'MG'),
(4, 2, 'Gedebage', 2, 'GDB');

-- --------------------------------------------------------

--
-- Table structure for table `promo_code`
--

CREATE TABLE `promo_code` (
  `id_promo_code` int(11) NOT NULL,
  `promo_code` varchar(50) NOT NULL,
  `promo_percentage` int(11) NOT NULL,
  `promo_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `id_rute` int(11) NOT NULL,
  `reservation_code` varchar(100) NOT NULL,
  `id_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `id_rute`, `reservation_code`, `id_order`) VALUES
(1, 1, '2727737643', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `id_rute` int(11) NOT NULL,
  `depart_at` date NOT NULL,
  `arrive_at` date NOT NULL,
  `depart_time` time NOT NULL,
  `arrive_time` time NOT NULL,
  `id_place_from` int(11) NOT NULL,
  `id_place_to` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `id_transportation` int(11) NOT NULL,
  `id_transportation_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`id_rute`, `depart_at`, `arrive_at`, `depart_time`, `arrive_time`, `id_place_from`, `id_place_to`, `price`, `id_transportation`, `id_transportation_type`) VALUES
(1, '2020-06-10', '2020-06-13', '16:34:00', '18:34:00', 1, 2, 900000, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transportation`
--

CREATE TABLE `transportation` (
  `id_transportation` int(11) NOT NULL,
  `transportation_code` varchar(50) NOT NULL,
  `transportation_name` varchar(225) NOT NULL,
  `id_transportation_class` int(11) NOT NULL,
  `id_transportation_type` int(11) NOT NULL,
  `seat_qty` int(11) NOT NULL,
  `id_transportation_company` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transportation`
--

INSERT INTO `transportation` (`id_transportation`, `transportation_code`, `transportation_name`, `id_transportation_class`, `id_transportation_type`, `seat_qty`, `id_transportation_company`) VALUES
(1, 'AirAsia x12', 'Airbus012', 1, 1, 20, 1),
(2, 'LiorAir B-99', 'Boeing 77', 1, 1, 50, 9),
(3, 'BTK91', 'Boeing 98', 1, 1, 20, 4),
(4, 'KAI', 'Kereta', 2, 2, 50, 14),
(5, 'KAI2', 'KeretaX', 2, 2, 30, 14);

-- --------------------------------------------------------

--
-- Table structure for table `transportation_class`
--

CREATE TABLE `transportation_class` (
  `id_transportation_class` int(11) NOT NULL,
  `id_transportation_type` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `class_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transportation_class`
--

INSERT INTO `transportation_class` (`id_transportation_class`, `id_transportation_type`, `class_name`, `class_price`) VALUES
(1, 1, 'Economy', 0),
(2, 2, 'Economy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transportation_company`
--

CREATE TABLE `transportation_company` (
  `id_transportation_company` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `id_transportation_type` int(11) NOT NULL,
  `company_logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transportation_company`
--

INSERT INTO `transportation_company` (`id_transportation_company`, `company_name`, `id_transportation_type`, `company_logo`) VALUES
(1, 'Air Asia', 1, 'airasia.png'),
(3, 'Air France', 1, 'airfrance.png'),
(4, 'Batik Air', 1, 'batikair.png'),
(5, 'British Air', 1, 'britishair.png'),
(6, 'Citilink', 1, 'citilink.png'),
(7, 'Etihad Air', 1, 'etihadair.png'),
(8, 'Garuda Indonesia', 1, 'garudaindonesia.png'),
(9, 'Lion Air', 1, 'lionair.png'),
(10, 'Malaysia Air', 1, 'malaysiaair.png'),
(11, 'Singapore Air', 1, 'singaporeair.png'),
(12, 'Sriwijaya Air', 1, 'sriwijayaair.png'),
(13, 'All Nippon Air', 1, 'allnipponair.png'),
(14, 'Kereta Api Indonesia', 2, 'kai.jpeg'),
(15, 'Railink', 2, 'railink.png');

-- --------------------------------------------------------

--
-- Table structure for table `transportation_type`
--

CREATE TABLE `transportation_type` (
  `id_transportation_type` int(11) NOT NULL,
  `transportation_type_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transportation_type`
--

INSERT INTO `transportation_type` (`id_transportation_type`, `transportation_type_name`) VALUES
(1, 'Pesawat'),
(2, 'Kereta Api');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'stevenazis71@gmail.com', 'dedd87f2364c4bd3e7e7753509f44338', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_type`
--
ALTER TABLE `bank_type`
  ADD PRIMARY KEY (`id_bank_type`);

--
-- Indexes for table `card_type`
--
ALTER TABLE `card_type`
  ADD PRIMARY KEY (`id_card_type`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id_city`);

--
-- Indexes for table `costumer`
--
ALTER TABLE `costumer`
  ADD PRIMARY KEY (`id_costumer`);

--
-- Indexes for table `costumer_bank_account`
--
ALTER TABLE `costumer_bank_account`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `costumer_card_account`
--
ALTER TABLE `costumer_card_account`
  ADD PRIMARY KEY (`id_card`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `order_cancel`
--
ALTER TABLE `order_cancel`
  ADD PRIMARY KEY (`id_order_cancel`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`id_passenger`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`id_payment_type`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`id_place`);

--
-- Indexes for table `promo_code`
--
ALTER TABLE `promo_code`
  ADD PRIMARY KEY (`id_promo_code`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id_rute`);

--
-- Indexes for table `transportation`
--
ALTER TABLE `transportation`
  ADD PRIMARY KEY (`id_transportation`);

--
-- Indexes for table `transportation_class`
--
ALTER TABLE `transportation_class`
  ADD PRIMARY KEY (`id_transportation_class`);

--
-- Indexes for table `transportation_company`
--
ALTER TABLE `transportation_company`
  ADD PRIMARY KEY (`id_transportation_company`);

--
-- Indexes for table `transportation_type`
--
ALTER TABLE `transportation_type`
  ADD PRIMARY KEY (`id_transportation_type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_type`
--
ALTER TABLE `bank_type`
  MODIFY `id_bank_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `card_type`
--
ALTER TABLE `card_type`
  MODIFY `id_card_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id_city` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `costumer`
--
ALTER TABLE `costumer`
  MODIFY `id_costumer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `costumer_bank_account`
--
ALTER TABLE `costumer_bank_account`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `costumer_card_account`
--
ALTER TABLE `costumer_card_account`
  MODIFY `id_card` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_cancel`
--
ALTER TABLE `order_cancel`
  MODIFY `id_order_cancel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `id_passenger` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `id_payment_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `id_place` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `promo_code`
--
ALTER TABLE `promo_code`
  MODIFY `id_promo_code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rute`
--
ALTER TABLE `rute`
  MODIFY `id_rute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transportation`
--
ALTER TABLE `transportation`
  MODIFY `id_transportation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transportation_class`
--
ALTER TABLE `transportation_class`
  MODIFY `id_transportation_class` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transportation_company`
--
ALTER TABLE `transportation_company`
  MODIFY `id_transportation_company` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transportation_type`
--
ALTER TABLE `transportation_type`
  MODIFY `id_transportation_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
