-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2017 at 03:13 AM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `go_wash`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
`id` int(10) NOT NULL,
  `item` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `item`, `harga`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Kiloan', '5000', 'Kiloan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Handuk', '12000', 'Satuan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Karpet', '15000', 'Satuan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Boneka', '8000', 'Satuan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Gaun Pengantin', '20000', 'Satuan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Celana', '3000', 'Satuan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Bed Cover', '19000', 'Satuan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Jas Setelan', '32500', 'Satuan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Bantal Besar', '15000', 'Satuan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Jas', '15000', 'Satuan', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE IF NOT EXISTS `deposit` (
`id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `nominal` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`id`, `user_id`, `nominal`, `foto`, `created_at`) VALUES
(3, 3, '0', '20170311072659-31637.jpg', '2017-03-14 09:53:13'),
(4, 3, '300000', '20170311073129-26932.png', '2017-03-14 09:53:22'),
(5, 3, '100000', '20170314121712-24374.jpg', '2017-03-14 11:17:12'),
(6, 8, '', '20170315003202-28901.jpg', '2017-03-14 17:32:02'),
(7, 8, '', '20170315003416-12165.jpg', '2017-03-14 17:34:16'),
(8, 8, '300000', '20170315063720-1978.jpg', '2017-03-14 23:37:20'),
(9, 10, '200000', '20170315090430-12227.jpg', '2017-03-15 02:04:30');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE IF NOT EXISTS `feedbacks` (
`id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `komentar` text NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `order_id`, `komentar`, `rating`) VALUES
(2, 43, 'cepat pelayanannya', 4),
(3, 45, 'wangi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_stars`
--

CREATE TABLE IF NOT EXISTS `feedback_stars` (
`id` int(1) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`id` int(10) NOT NULL,
  `ordered_by_id` int(10) NOT NULL,
  `status_id` int(1) NOT NULL,
  `total` varchar(255) NOT NULL,
  `ordered_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `choose_to_id` int(10) NOT NULL,
  `paid_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `finish_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ordered_by_id`, `status_id`, `total`, `ordered_at`, `choose_to_id`, `paid_at`, `finish_at`) VALUES
(38, 3, 1, '50000', '2017-02-20 01:38:29', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 6, 1, '42000', '2017-02-22 11:59:17', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 2, 5, '90000', '2017-02-23 20:14:51', 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 7, 5, '51000', '2017-02-27 03:41:30', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 9, 5, '56000', '2017-03-03 03:04:55', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 7, 5, '40000', '2017-03-08 15:27:30', 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 2, 1, '41000', '2017-03-11 19:10:37', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_claims`
--

CREATE TABLE IF NOT EXISTS `order_claims` (
`id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `claim_status` enum('1','2') NOT NULL COMMENT '1=claim, 2=skip'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
`id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `barang_id` int(10) NOT NULL,
  `qty` int(3) NOT NULL,
  `harga_total_item` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `barang_id`, `qty`, `harga_total_item`) VALUES
(9, 38, 1, 0, 0),
(10, 38, 2, 0, 0),
(11, 38, 3, 0, 0),
(12, 38, 4, 0, 0),
(15, 41, 1, 0, 0),
(16, 41, 4, 0, 0),
(17, 41, 7, 0, 0),
(18, 42, 1, 1, 5000),
(19, 42, 3, 1, 15000),
(20, 42, 4, 2, 16000),
(21, 42, 7, 1, 19000),
(22, 42, 9, 1, 15000),
(23, 43, 1, 2, 10000),
(24, 43, 4, 1, 8000),
(25, 43, 7, 1, 19000),
(26, 44, 1, 1, 5000),
(27, 44, 5, 1, 20000),
(28, 44, 6, 2, 6000),
(29, 45, 1, 1, 5000),
(30, 45, 9, 1, 15000),
(31, 46, 4, 0, 0),
(32, 46, 5, 0, 0),
(33, 46, 6, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE IF NOT EXISTS `order_status` (
`id` int(1) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`id` int(1) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nama`, `level`) VALUES
(1, 'admin', 1),
(2, 'customer', 2),
(3, 'washer', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(1) NOT NULL,
  `request_join` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `role_id`, `request_join`, `created_at`, `updated_at`) VALUES
(1, 'Admin Go Wash', 'admin', 'admin@go_wash.com', '21232f297a57a5a743894a0e4a801fc3', 1, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'ardhi', 'aisipan', 'ipanfifanfi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '0', '2017-03-13 21:18:40', '0000-00-00 00:00:00'),
(3, 'ipan', 'ipanfifanfi', 'ipan_fifanfi@yahoo.co.id', 'e10adc3949ba59abbe56e057f20f883e', 3, '1', '2017-02-07 21:04:02', '0000-00-00 00:00:00'),
(4, 'nurian', 'nurian', 'nurian@habi.com', 'e10adc3949ba59abbe56e057f20f883e', 3, '1', '2017-02-07 21:05:53', '0000-00-00 00:00:00'),
(5, 'Ade Mustofa', 'ademus', 'ade@gmail.com', '699460cfb115dcac4351d1b6d998921e', 2, '0', '2017-02-10 00:47:32', '0000-00-00 00:00:00'),
(6, 'pipi', 'pipikajol', 'pipi@kajol.com', '81df3de5bd60448f87852e81c3799f12', 2, '0', '2017-02-13 12:17:30', '0000-00-00 00:00:00'),
(7, 'shofi', 'shofye', 'shofye@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '0', '2017-02-13 12:19:44', '0000-00-00 00:00:00'),
(8, 'ratno dwi mulya', 'ratno', 'ratno@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 3, '1', '2017-02-27 03:55:28', '0000-00-00 00:00:00'),
(9, 'darsih', 'darsih', 'drs@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '0', '2017-03-03 03:02:36', '0000-00-00 00:00:00'),
(10, 'Tantowi Yahya', 'tantowi', 'tantowi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 3, '1', '2017-03-15 01:53:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
`id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `alamat` text NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `no_hp` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `alamat`, `lat`, `lng`, `no_hp`) VALUES
(1, 1, '', 0, 0, ''),
(2, 2, 'Balongan, Indramayu Regency, West Java, Indonesia', 0, 0, '0891829189'),
(3, 3, 'Lohbener, Indramayu Regency, West Java, Indonesia', -6.39995, 108.283, '085724232478'),
(4, 4, 'Sindang', 0, 0, '089298392'),
(5, 5, '', 0, 0, ''),
(6, 6, 'Tokyo Bay, Japan', 0, 0, '0891821919'),
(7, 7, 'Pantai Karang Song, West Java, Indonesia', -6.30634, 108.368, '023912'),
(8, 8, 'Jalan Mt Haryono, Sindang, Indramayu Regency, West Java, Indonesia', -6.33286, 108.318, '08927823728'),
(9, 9, 'Sindang, Indramayu Regency, West Java, Indonesia', 0, 0, '0897786756'),
(10, 10, '', 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_stars`
--
ALTER TABLE `feedback_stars`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_claims`
--
ALTER TABLE `order_claims`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `feedback_stars`
--
ALTER TABLE `feedback_stars`
MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `order_claims`
--
ALTER TABLE `order_claims`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `id` int(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
