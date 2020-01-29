-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2020 at 06:33 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysky`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_email` varchar(150) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Techno', 'info@technothinksup.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` bigint(20) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `company_address` varchar(350) NOT NULL,
  `company_city` varchar(150) NOT NULL,
  `company_state` varchar(150) NOT NULL,
  `company_district` varchar(150) NOT NULL,
  `company_statecode` bigint(20) NOT NULL,
  `company_pincode` varchar(20) DEFAULT NULL,
  `company_mob1` varchar(12) NOT NULL,
  `company_mob2` varchar(12) NOT NULL,
  `company_email` varchar(150) NOT NULL,
  `company_website` varchar(150) NOT NULL,
  `company_pan_no` varchar(12) NOT NULL,
  `company_gst_no` varchar(100) NOT NULL,
  `company_lic1` varchar(150) NOT NULL,
  `company_lic2` varchar(150) NOT NULL,
  `company_start_date` varchar(15) NOT NULL,
  `company_end_date` varchar(15) NOT NULL,
  `company_logo` varchar(200) NOT NULL,
  `company_seal` varchar(150) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `company_address`, `company_city`, `company_state`, `company_district`, `company_statecode`, `company_pincode`, `company_mob1`, `company_mob2`, `company_email`, `company_website`, `company_pan_no`, `company_gst_no`, `company_lic1`, `company_lic2`, `company_start_date`, `company_end_date`, `company_logo`, `company_seal`, `date`) VALUES
(1, 'My Sky & Rakha Digital', 'blok no 167/07 shop no 01, basharam marg,gandhinagar,kolhapur 416119', 'gandhinagar', 'Maharashtra', 'Kolhapur', 27, '111222', '9834576400', '7709392011', 'myskyrakha12@gmail.com', 'www.myskyrakhadigital.com', '', '', '', '444', '01-01-2019', '01-01-2021', '', '', '2020-01-10 08:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` bigint(20) NOT NULL,
  `cust_pre_id` varchar(50) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'Reference User Id ',
  `customer_type_id` int(11) DEFAULT NULL,
  `customer_name` varchar(250) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `customer_mob1` varchar(20) DEFAULT NULL,
  `customer_mob2` varchar(20) DEFAULT NULL,
  `customer_city` varchar(200) DEFAULT NULL,
  `customer_state` varchar(200) DEFAULT NULL,
  `customer_adhar_no` varchar(20) DEFAULT NULL,
  `customer_pan_no` varchar(20) DEFAULT NULL,
  `customer_bank` varchar(250) DEFAULT NULL,
  `customer_b_branch` varchar(250) DEFAULT NULL,
  `customer_acc_no` varchar(100) DEFAULT NULL,
  `customer_b_ifsc` varchar(50) DEFAULT NULL,
  `customer_password` varchar(100) DEFAULT NULL,
  `customer_img` varchar(250) DEFAULT NULL,
  `customer_status` varchar(50) NOT NULL DEFAULT 'active',
  `customer_addedby` int(11) DEFAULT NULL,
  `customer_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `cust_pre_id`, `company_id`, `user_id`, `customer_type_id`, `customer_name`, `customer_address`, `customer_mob1`, `customer_mob2`, `customer_city`, `customer_state`, `customer_adhar_no`, `customer_pan_no`, `customer_bank`, `customer_b_branch`, `customer_acc_no`, `customer_b_ifsc`, `customer_password`, `customer_img`, `customer_status`, `customer_addedby`, `customer_date`) VALUES
(2, 'TT_2', 1, 1, 2, 'api demo', 'vgsdfg', '8855442234', '', 'ghfgh', 'dfgh', '44', '55', 'fghfg', 'fgh', '88', '66', '123', NULL, 'active', 1, '2020-01-11 09:34:45'),
(3, 'TT_3', 1, 1, 2, 'api demo', 'vgsdfg', '8855442234', '', 'ghfgh', 'dfgh', '44', '55', 'fghfg', 'fgh', '88', '66', '123', NULL, 'active', 1, '2020-01-12 06:02:08'),
(4, 'TT_4', 1, 1, 2, 'api demo', 'vgsdfg', '8855442234', '', 'ghfgh', 'dfgh', '44', '55', 'fghfg', 'fgh', '88', '66', '123', NULL, 'active', 1, '2020-01-12 06:27:31'),
(5, 'TT_5', 1, 1, 2, 'api demo', 'vgsdfg', '8855442234', '', 'ghfgh', 'dfgh', '44', '55', 'fghfg', 'fgh', '88', '66', '123', NULL, 'active', 1, '2020-01-12 06:27:47'),
(6, 'TT_6', 1, 1, 2, 'api demo', 'vgsdfg', '8855442238', '', 'ghfgh', 'dfgh', '44', '55', 'fghfg', 'fgh', '88', '66', '123', NULL, 'active', 1, '2020-01-12 07:44:26'),
(7, 'TT_7', 1, 29, 2, 'api demo', 'vgsdfg', '8855442238', '', 'ghfgh', 'dfgh', '44', '55', 'fghfg', 'fgh', '88', '66', '123', 'customer_7_1580273574.jpg', 'active', 1, '2020-01-29 04:52:54'),
(8, 'TT_8', 1, 29, 2, 'api demo', 'vgsdfg', '7020261052', '', 'ghfgh', 'dfgh', '44', '55', 'fghfg', 'fgh', '88', '66', '123', 'customer_8_1580273539.jpg', 'active', 1, '2020-01-29 04:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `customer_type`
--

CREATE TABLE `customer_type` (
  `customer_type_id` int(11) NOT NULL,
  `type_name` varchar(250) NOT NULL,
  `no_of_members` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_type`
--

INSERT INTO `customer_type` (`customer_type_id`, `type_name`, `no_of_members`) VALUES
(1, 'SS Customer', '3'),
(2, 'TT Customer', '2'),
(3, 'IN Customer', '3');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `news_name` text DEFAULT NULL,
  `news_addedby` varchar(50) DEFAULT NULL,
  `news_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roll`
--

CREATE TABLE `roll` (
  `roll_id` int(11) NOT NULL,
  `roll_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roll`
--

INSERT INTO `roll` (`roll_id`, `roll_name`) VALUES
(1, 'Admin'),
(2, 'Office Admin'),
(3, 'SRM'),
(4, 'RM'),
(5, 'Customer'),
(6, 'CRE');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sale_id` bigint(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `sale_no` bigint(20) NOT NULL,
  `sale_date` varchar(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `total_amount` double NOT NULL,
  `sale_addedby` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sale_descr`
--

CREATE TABLE `sale_descr` (
  `sale_descr_id` bigint(20) NOT NULL,
  `sale_id` bigint(20) NOT NULL,
  `sale_description` varchar(250) NOT NULL,
  `sale_descr_amt` double NOT NULL,
  `descr_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `roll_id` int(11) DEFAULT NULL,
  `srm_id` bigint(20) DEFAULT NULL COMMENT 'added_SRM_id_if_roll_4_RM ,  added_RM_id_if_roll_6_CRE',
  `user_name` varchar(250) NOT NULL,
  `user_city` varchar(150) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_mobile` varchar(12) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_status` varchar(20) NOT NULL DEFAULT 'active',
  `user_addedby` varchar(100) NOT NULL,
  `user_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `company_id`, `roll_id`, `srm_id`, `user_name`, `user_city`, `user_email`, `user_mobile`, `user_password`, `user_status`, `user_addedby`, `user_date`, `is_admin`) VALUES
(1, 1, 1, NULL, 'Admin', 'Kolhapur', 'demo@email.com', '9876543210', '123456', 'active', 'Admin', '2020-01-15 11:02:08', 1),
(28, 1, 2, NULL, 'Off Admin', 'Kop', 'asdf@mail.com', '9988776655', '123456', 'active', '1', '2020-01-11 06:00:25', 0),
(29, 1, 3, NULL, 'Demo SRM', 'Kop', 'aaa@mail.com', '9966332211', '123456', 'active', '1', '2020-01-11 06:01:24', 0),
(30, 1, 4, 29, 'Demo RM', 'Kop', 'hhh@mail.com', '9955112233', '123456', 'active', '1', '2020-01-11 06:01:20', 0),
(32, 1, 6, 30, 'Manag', 'Kop', 'qqq@mail.com', '8844663322', '123456', 'active', '1', '2020-01-11 07:44:25', 0),
(33, 1, 5, NULL, 'api demo', 'ghfgh', '', '8855442234', '123', 'active', '1', '2020-01-11 09:34:45', 0),
(34, 1, 5, NULL, 'api demo', 'ghfgh', '', '8855442234', '123', 'active', '1', '2020-01-12 06:02:08', 0),
(35, 1, 5, NULL, 'api demo', 'ghfgh', '', '8855442234', '123', 'active', '1', '2020-01-12 06:27:31', 0),
(36, 1, 5, NULL, 'api demo', 'ghfgh', '', '8855442234', '123', 'active', '1', '2020-01-12 06:27:47', 0),
(37, 1, 5, NULL, 'api demo', 'ghfgh', '', '8855442238', '123', 'active', '1', '2020-01-12 07:44:26', 0),
(38, 1, 5, NULL, 'api demo', 'ghfgh', '', '8855442238', '123', 'active', '1', '2020-01-12 07:45:02', 0),
(39, 1, 5, NULL, 'api demo', 'ghfgh', '', '7020261052', '123', 'active', '1', '2020-01-12 09:23:15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_rel`
--

CREATE TABLE `user_rel` (
  `user_rel_id` bigint(20) NOT NULL,
  `rm_id` bigint(20) NOT NULL COMMENT 'rm user id',
  `srm_id` bigint(20) NOT NULL COMMENT 'srm user id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_reg`
--

CREATE TABLE `vehicle_reg` (
  `vehicle_reg_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `sponser_id` varchar(50) DEFAULT NULL,
  `full_name` varchar(250) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `state` varchar(250) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `transaction_no` varchar(100) DEFAULT NULL,
  `vehicle_name` varchar(250) DEFAULT NULL,
  `vehicle_image` varchar(100) DEFAULT NULL,
  `vehicle_reg_addedby` varchar(50) DEFAULT NULL,
  `vehicle_reg_status` varchar(20) NOT NULL DEFAULT 'active',
  `vehicle_reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle_reg`
--

INSERT INTO `vehicle_reg` (`vehicle_reg_id`, `company_id`, `sponser_id`, `full_name`, `mobile_no`, `email`, `address`, `city`, `state`, `country`, `amount`, `payment_type`, `transaction_no`, `vehicle_name`, `vehicle_image`, `vehicle_reg_addedby`, `vehicle_reg_status`, `vehicle_reg_date`) VALUES
(3, 1, '3', 'sdfg', '9988556633', 'sdfg@dfg.kkk', 'fxdgh', 'fgh', 'gh', 'dfgh', 444, 'Cash', '', 'Activa', 'vehicle_3_1578721172.', '1', 'active', '2020-01-11 05:39:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_type`
--
ALTER TABLE `customer_type`
  ADD PRIMARY KEY (`customer_type_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `roll`
--
ALTER TABLE `roll`
  ADD PRIMARY KEY (`roll_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `sale_descr`
--
ALTER TABLE `sale_descr`
  ADD PRIMARY KEY (`sale_descr_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_rel`
--
ALTER TABLE `user_rel`
  ADD PRIMARY KEY (`user_rel_id`);

--
-- Indexes for table `vehicle_reg`
--
ALTER TABLE `vehicle_reg`
  ADD PRIMARY KEY (`vehicle_reg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer_type`
--
ALTER TABLE `customer_type`
  MODIFY `customer_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roll`
--
ALTER TABLE `roll`
  MODIFY `roll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_descr`
--
ALTER TABLE `sale_descr`
  MODIFY `sale_descr_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_rel`
--
ALTER TABLE `user_rel`
  MODIFY `user_rel_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_reg`
--
ALTER TABLE `vehicle_reg`
  MODIFY `vehicle_reg_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
