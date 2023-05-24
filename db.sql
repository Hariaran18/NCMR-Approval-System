-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 05:16 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ncmr`
--
CREATE DATABASE IF NOT EXISTS `ncmr` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ncmr`;

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `issue_date` date DEFAULT NULL,
  `ncmr_no` int(255) NOT NULL,
  `lot_qty` int(255) DEFAULT NULL,
  `rejection_chk` enum('Internal','Supplier','Customer') DEFAULT NULL,
  `job_no` varchar(255) DEFAULT NULL,
  `dept_name` text,
  `operator_no` varchar(255) DEFAULT NULL,
  `classification_chk` enum('Mass Production','First Article','Others') DEFAULT NULL,
  `reject_class_other` text,
  `part_no` varchar(255) DEFAULT NULL,
  `nc_qty` int(255) DEFAULT NULL,
  `detected_at` text,
  `defect_desc` text,
  `disposition_chk` enum('Use as Is','Rework','Write Off','Exchange 1 to 1','Rejection from Store','RTV, PRN No') DEFAULT NULL,
  `rtv_prn_no` varchar(255) DEFAULT NULL,
  `remark1` text,
  `do_no` varchar(255) DEFAULT NULL,
  `customer_ref_no` varchar(255) DEFAULT NULL,
  `sort_rework` text,
  `accept_pcs` int(255) DEFAULT NULL,
  `reject_pcs` int(255) DEFAULT NULL,
  `checked_by` text,
  `remark2` varchar(255) DEFAULT NULL,
  `car_scar_no` varchar(255) DEFAULT NULL,
  `replacement_qty` int(255) DEFAULT NULL,
  `remark3` varchar(255) DEFAULT NULL,
  `issued_name` text,
  `issued_date` date DEFAULT NULL,
  `ack_name` text,
  `ack_date` date DEFAULT NULL,
  `review_name` text,
  `review_date` date DEFAULT NULL,
  `form_state` int(11) DEFAULT NULL,
  `corrective_sel` enum('Yes','No') DEFAULT NULL,
  `replacement_sel` enum('Yes','No') DEFAULT NULL,
  `notify_usr` varchar(255) DEFAULT NULL,
  `notify_usr2` varchar(255) DEFAULT NULL,
  `notify_usr3` varchar(255) DEFAULT NULL,
  `notify_usr4` varchar(255) DEFAULT NULL,
  `ack_usr` varchar(255) DEFAULT NULL,
  `rev_usr` varchar(255) DEFAULT NULL,
  `form_notify_email` varchar(255) DEFAULT NULL,
  `form_notify_email2` varchar(255) DEFAULT NULL,
  `form_notify_email3` varchar(255) DEFAULT NULL,
  `form_notify_email4` varchar(255) DEFAULT NULL,
  `form_issue_email` varchar(255) DEFAULT NULL,
  `form_ack_email` varchar(255) DEFAULT NULL,
  `form_rev_email` varchar(255) DEFAULT NULL,
  `img_1` varchar(255) DEFAULT NULL,
  `img_2` varchar(255) DEFAULT NULL,
  `img_3` varchar(255) DEFAULT NULL,
  `img_4` varchar(255) DEFAULT NULL,
  `img_5` varchar(255) DEFAULT NULL,
  `defect_cat` text,
  `rejection_name` varchar(255) DEFAULT NULL,
  `erp_part_no` varchar(255) DEFAULT NULL,
  `erp_qty` int(255) DEFAULT NULL,
  `loc_bin_code` varchar(255) DEFAULT NULL,
  `wo_type_chk` enum('Indirect Material','Purchase Part','WIP','FG','Rejection From Store','Customer Rejection','Supplier Rejection') DEFAULT NULL,
  `wo_type_sel` enum('Sheet Metal','Components','') DEFAULT NULL,
  `cc_1` int(11) DEFAULT NULL,
  `cc_2` int(11) DEFAULT NULL,
  `cc_3` int(11) DEFAULT NULL,
  `cc_4` int(11) DEFAULT NULL,
  `cc_4_others` text,
  `wo_material` text,
  `size_x` double DEFAULT NULL,
  `size_y` double DEFAULT NULL,
  `wo_thick` double DEFAULT NULL,
  `wo_cost` double DEFAULT NULL,
  `prod_mng` text,
  `prod_mng_date` date DEFAULT NULL,
  `qa_mng` text,
  `qa_mng_date` date DEFAULT NULL,
  `dgm_gm` text,
  `dgm_gm_date` date DEFAULT NULL,
  `comments1` text,
  `comments2` text,
  `comments3` text,
  `comments4` text,
  `comments5` text,
  `logistic_usr` text,
  `logistic_date` date DEFAULT NULL,
  `safety_usr` text,
  `safety_date` date DEFAULT NULL,
  `disposed_by` text,
  `disposed_date` date DEFAULT NULL,
  `witnessed_by` text,
  `witnessed_date` date DEFAULT NULL,
  `remark4` varchar(255) DEFAULT NULL,
  `production_email` varchar(255) DEFAULT NULL,
  `qa_email` varchar(255) DEFAULT NULL,
  `dgm_gm_email` varchar(255) DEFAULT NULL,
  `logistic_email` varchar(255) DEFAULT NULL,
  `safety_email` varchar(255) DEFAULT NULL,
  `witness_email` varchar(255) DEFAULT NULL,
  `finance_name` text,
  `finance_date` date DEFAULT NULL,
  `form_finance_email` text,
  `closed_date` date DEFAULT NULL,
  `unit` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scrap_cost`
--

CREATE TABLE `scrap_cost` (
  `id` int(11) NOT NULL,
  `material` text NOT NULL,
  `price` int(11) NOT NULL,
  `density` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `emp_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access` enum('admin','user','superuser') NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `role` enum('User','Approver') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`ncmr_no`);

--
-- Indexes for table `scrap_cost`
--
ALTER TABLE `scrap_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `index_user` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `ncmr_no` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scrap_cost`
--
ALTER TABLE `scrap_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
