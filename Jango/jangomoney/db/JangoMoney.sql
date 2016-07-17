-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 15, 2016 at 11:34 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `JangoMoney`
--

-- --------------------------------------------------------

--
-- Table structure for table `activator_id`
--

CREATE TABLE `activator_id` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `ref_id` int(10) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activator_id`
--

INSERT INTO `activator_id` (`id`, `user_id`, `ref_id`, `created_date`) VALUES
(4, 13, 103, '2016-06-09 10:39:46');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_addres` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `pass_word` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `email_addres`, `user_name`, `pass_word`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `app_url`
--

CREATE TABLE `app_url` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `ref_url` varchar(250) NOT NULL,
  `pkg_name` varchar(100) NOT NULL,
  `ref_id` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-deactive,1-active',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_url`
--

INSERT INTO `app_url` (`id`, `title`, `description`, `image`, `ref_url`, `pkg_name`, `ref_id`, `status`, `created_date`) VALUES
(1, 'Slide - Earn Free Recharge!', 'Slide - Earn Free Recharge!', 'slide_app.png', 'https://play.google.com/store/apps/details?id=company.fortytwo.slide.app', 'company.fortytwo.slide.app', '', 1, '2016-06-08 05:30:31'),
(2, 'UC Browser - Fast Download\r\n', 'UC Browser - Fast Download\r\n', 'ucbrowser.png', 'https://play.google.com/store/apps/details?id=com.UCMobile.intl', 'com.UCMobile.intl', '', 1, '2016-06-08 05:22:11'),
(3, 'Flipkart Seller Hub', 'Flipkart Seller Hub', 'flipkart.png', 'https://play.google.com/store/apps/details?id=com.flipkart.seller', 'com.flipkart.seller', '', 1, '2016-06-02 12:01:34'),
(4, 'Hotstar TV Movies Live Cricket', 'Hotstar TV Movies Live Cricket', 'hotstar.png', 'https://play.google.com/store/apps/details?id=in.startv.hotstar', 'in.startv.hotstar', '', 1, '2016-06-02 12:01:42'),
(5, 'Mobile Price Comparison App', 'Mobile Price Comparison App', 'mobileprice.png', 'https://play.google.com/store/apps/details?id=com.mob91', 'com.mob91', '', 1, '2016-06-02 12:01:58'),
(6, 'Ladooo - Free recharge', 'Ladooo - Free recharge', 'ladoo.png', 'https://play.google.com/store/apps/details?id=com.airloyal.ladooo', 'com.airloyal.ladooo', '', 1, '2016-06-02 12:01:52'),
(7, 'Cricbuzz Cricket Scores & News\r\n', 'Cricbuzz Cricket Scores & News\r\n', 'cricbuzz.png', 'https://play.google.com/store/apps/details?id=com.cricbuzz.android', 'com.cricbuzz.android', '', 1, '2016-06-02 12:02:03'),
(8, 'Voot', 'Voot', 'voot.png', 'https://play.google.com/store/apps/details?id=com.tv.v18.viola', 'com.tv.v18.viola', '', 1, '2016-06-02 12:02:09'),
(9, 'Ola cabs - Book taxi in India', 'Ola cabs - Book taxi in India', 'olacabs.png', 'https://play.google.com/store/apps/details?id=com.olacabs.customer', 'com.olacabs.customer', '', 1, '2016-06-02 12:02:15'),
(10, 'True Balance', 'True Balance', 'truebalance.png', 'https://play.google.com/store/apps/details?id=com.balancehero.truebalance', 'com.balancehero.truebalance', '', 1, '2016-06-02 12:02:21');

-- --------------------------------------------------------

--
-- Table structure for table `bank_detail`
--

CREATE TABLE `bank_detail` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `account_no` varchar(100) NOT NULL,
  `ifsc_code` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `holder_name` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `pan_no` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-pending, 1-approve',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_detail`
--

INSERT INTO `bank_detail` (`id`, `user_id`, `account_no`, `ifsc_code`, `amount`, `holder_name`, `state`, `address`, `pan_no`, `status`, `created_date`) VALUES
(1, 13, '12', '1232', '80.00', 'james', 'gujarat', 'abad', '20101', 0, '2016-05-30 12:21:28'),
(2, 42, '12', '20', '20.00', 'yatin', 'gujarat', 'rajkot', '1021012', 0, '2016-05-30 13:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `ci_cookies`
--

CREATE TABLE `ci_cookies` (
  `id` int(11) NOT NULL,
  `cookie_id` varchar(255) DEFAULT NULL,
  `netid` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `orig_page_requested` varchar(120) DEFAULT NULL,
  `php_session_id` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('1a3dc752862ff940f7fa049254ddda2d', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.84 Safari/537.36', 1465556335, 'a:3:{s:9:"user_data";s:0:"";s:9:"user_name";s:5:"admin";s:12:"is_logged_in";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `complete_challange`
--

CREATE TABLE `complete_challange` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `app_id` int(10) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complete_challange`
--

INSERT INTO `complete_challange` (`id`, `user_id`, `app_id`, `created_date`) VALUES
(1, 13, 1, '2016-06-02 08:06:57'),
(2, 13, 3, '2016-06-02 08:09:40'),
(3, 13, 3, '2016-06-02 08:17:22'),
(4, 13, 5, '2016-06-02 08:21:28'),
(5, 50, 3, '2016-06-02 10:02:29'),
(6, 13, 6, '2016-06-02 13:05:32'),
(7, 13, 7, '2016-06-02 13:06:42'),
(8, 13, 8, '2016-06-02 13:10:24'),
(9, 13, 9, '2016-06-02 13:12:12'),
(10, 13, 10, '2016-06-02 13:13:08'),
(11, 13, 4, '2016-06-02 13:16:00'),
(12, 47, 1, '2016-06-03 10:06:19'),
(13, 47, 2, '2016-06-03 10:14:30'),
(14, 47, 2, '2016-06-03 10:14:38'),
(15, 47, 3, '2016-06-03 10:15:55'),
(16, 47, 5, '2016-06-03 10:17:06'),
(17, 47, 6, '2016-06-03 10:18:13'),
(18, 47, 8, '2016-06-03 10:20:49'),
(19, 47, 9, '2016-06-03 10:23:49'),
(20, 13, 3, '2016-06-03 11:07:06'),
(21, 13, 2, '2016-06-03 11:13:50'),
(22, 13, 1, '2016-06-03 11:19:29'),
(23, 13, 2, '2016-06-03 11:19:32'),
(24, 50, 1, '2016-06-03 11:50:04'),
(25, 50, 1, '2016-06-03 11:50:19'),
(26, 50, 1, '2016-06-03 11:54:54'),
(27, 42, 2, '2016-06-03 12:29:56'),
(28, 45, 6, '2016-06-06 03:10:57');

-- --------------------------------------------------------

--
-- Table structure for table `complete_earnmore`
--

CREATE TABLE `complete_earnmore` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `app_id` int(10) NOT NULL,
  `point` int(10) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-deactive,1-active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `status`) VALUES
(1, 'India', 1),
(2, 'USA', 1),
(3, 'Indonesia', 1),
(4, 'Malaysia', 1),
(5, 'UK', 1),
(6, 'Singapore', 1),
(7, 'UAE', 1),
(8, 'China', 1),
(9, 'Russia', 1),
(10, 'Poland', 1);

-- --------------------------------------------------------

--
-- Table structure for table `earn_more`
--

CREATE TABLE `earn_more` (
  `id` int(10) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `point` int(10) NOT NULL,
  `url` varchar(250) NOT NULL,
  `pkg_name` varchar(100) NOT NULL,
  `country_id` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-desctive,1-active',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `earn_more`
--

INSERT INTO `earn_more` (`id`, `title`, `description`, `image`, `point`, `url`, `pkg_name`, `country_id`, `status`, `created_date`) VALUES
(5, 'rr', '   rrr ', '561f9f3c0400a.jpg', 555, '', '', 1, 1, '2016-06-06 13:06:31'),
(6, 'xx', '  xx', '561f9f37d9897.jpg', 1111, '', '', 8, 1, '2016-06-06 13:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(10) NOT NULL,
  `type` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `type`, `name`, `email`, `message`, `created_date`) VALUES
(1, 'Accept Challenge Issue', 'xyz', 'xyz@yahoo.com', 'nic app', '2016-05-30 07:51:43'),
(2, 'Application Issue', 'abc', 'abc@gmail.com', 'apps crash', '2016-05-31 16:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `invite_earn_more`
--

CREATE TABLE `invite_earn_more` (
  `id` int(10) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-deactive,1-active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invite_earn_more`
--

INSERT INTO `invite_earn_more` (`id`, `description`, `status`) VALUES
(1, 'sale sale sale', 1),
(2, 'Earn money from android Mobile....', 1),
(3, '100% free from investment time and place', 1),
(6, 'Introducing India''s 1st worlds best android\r\napplication which gives you money', 1),
(7, 'Earn more money by installing Apps.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invite_earn_unlimited`
--

CREATE TABLE `invite_earn_unlimited` (
  `id` int(10) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-deactive,1-active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invite_earn_unlimited`
--

INSERT INTO `invite_earn_unlimited` (`id`, `description`, `status`) VALUES
(1, 'Introducing India''s 1st worlds best android application which gives you money', 1),
(2, 'sale sale sale', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`id`, `name`) VALUES
(1, 'Champion'),
(2, 'Royal Ambassador'),
(3, 'Ambassador'),
(4, 'Crown Diamond'),
(5, 'Diamond'),
(6, 'Platinum'),
(7, 'Gold'),
(8, 'Silver'),
(9, 'Bronze');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `type` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `account_no` varchar(100) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-pending,1-active',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `device_id` text NOT NULL,
  `ref_id` varchar(10) NOT NULL,
  `upline_id` varchar(10) NOT NULL,
  `fb_id` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_image` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-no,1-yes',
  `birth_date` date NOT NULL,
  `joining` int(10) NOT NULL DEFAULT '0',
  `earning` decimal(10,2) NOT NULL DEFAULT '1.00',
  `balance` decimal(10,2) NOT NULL DEFAULT '1.00',
  `point` int(10) NOT NULL,
  `current_level` int(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-pending,1-active',
  `rank` int(2) NOT NULL,
  `country` int(3) NOT NULL,
  `completed_challenge` int(2) NOT NULL DEFAULT '0',
  `is_notification` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-no,1-yes',
  `active_date` datetime NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `device_id`, `ref_id`, `upline_id`, `fb_id`, `first_name`, `last_name`, `email`, `password`, `profile_image`, `phone`, `is_visible`, `birth_date`, `joining`, `earning`, `balance`, `point`, `current_level`, `status`, `rank`, `country`, `completed_challenge`, `is_notification`, `active_date`, `created_date`) VALUES
(13, '3c51c76ddd4781f9', '101', '000', '', 'James Bond', '', 'james@gmail.com', '123456', '13_image.jpg', '9876543210', 1, '0000-00-00', 10, '201.00', '201.00', 0, 1, 1, 0, 2, 14, 1, '0000-00-00 00:00:00', '2016-06-04 05:56:53'),
(42, 'c10e38dc678c1511', '102', '101', '', 'yatin', '', 'gondhayatin@gmail.com', '123', '42_image.jpg', '7405127951', 1, '0000-00-00', 0, '1.00', '1.00', 0, 1, 1, 0, 0, 1, 1, '0000-00-00 00:00:00', '2016-06-03 12:29:56'),
(43, '17122d43ce29a65d', '103', '101', '', 'Mayur Kothiya', '', 'imprecare@gmail.com', 'mayur007', '43_image.jpg', '987654321', 1, '0000-00-00', 0, '1.00', '1.00', 0, 1, 1, 0, 5, 0, 1, '0000-00-00 00:00:00', '2016-06-09 10:39:46'),
(44, 'ad0611114aba4557', '104', '101', '', 'Brijesh', '', 'brijesh_526@yahoo.in', '123456', '', '9974099704', 1, '0000-00-00', 1, '21.00', '21.00', 0, 1, 0, 0, 1, 0, 1, '0000-00-00 00:00:00', '2016-06-04 16:08:54'),
(45, 'b8bc407cdd8c50ca', '105', '104', '', 'bbb', '', 'tapan_6464@yahoo.co.in', '123456', '', '9998831764', 1, '0000-00-00', 3, '61.00', '61.00', 0, 1, 0, 0, 1, 1, 1, '0000-00-00 00:00:00', '2016-06-06 03:10:57'),
(46, 'e40e21d2ee7c2b3f', '106', '105', '', 'bbzbjx', '', 'rapan@gmail.com', '123456', '', '9898989898', 1, '0000-00-00', 1, '21.00', '21.00', 0, 1, 0, 0, 1, 0, 1, '0000-00-00 00:00:00', '2016-06-04 05:56:53'),
(47, 'c9ac71c0e8a49c0b', '107', '101', '', 'Sandi', '', 'sandimaxi18@gmail.com', '18maxisandi', '', '9016919779', 1, '0000-00-00', 0, '1.00', '1.00', 0, 1, 0, 0, 1, 8, 1, '0000-00-00 00:00:00', '2016-06-03 10:23:49'),
(48, '', '108', '101', '', 'demo', '', 'demo@gmail.com', '123', '', '1234567809', 1, '0000-00-00', 0, '1.00', '1.00', 0, 1, 0, 0, 1, 0, 1, '0000-00-00 00:00:00', '2016-05-30 09:35:23'),
(49, '', '109', '101', '', 'abc', '', 'abc@gmail.com', '123', '', '8888999666', 1, '0000-00-00', 0, '1.00', '1.00', 0, 1, 0, 0, 1, 0, 1, '0000-00-00 00:00:00', '2016-05-30 08:42:52'),
(50, 'cfb4ae37a115f687', '110', '101', '', 'rani', '', 'rani@gmail.com', '123', '', '8080808080', 1, '0000-00-00', 0, '1.00', '1.00', 0, 1, 1, 0, 1, 4, 1, '0000-00-00 00:00:00', '2016-06-03 11:54:54'),
(51, '23f1562e03dd8389', '111', '105', '', 'Kamlesh', '', 'Dha', 'rkd', '', '9898700411', 1, '0000-00-00', 0, '1.00', '1.00', 0, 1, 0, 0, 1, 0, 1, '0000-00-00 00:00:00', '2016-06-03 08:29:24'),
(52, 'b8ed56c40dcb5764', '112', '106', '', 'Sanjay', '', 'sanjay.patel1512@yahoo.com', '123456', '', '7600854170', 1, '0000-00-00', 0, '1.00', '1.00', 0, 1, 0, 0, 1, 0, 1, '0000-00-00 00:00:00', '2016-06-04 05:56:53'),
(53, '1b8056879d0ddd29', '113', '111', '', 'tapan', '', 'tapan64.tp@gmail.com', 'tapanpatel', '', '7043436464', 1, '0000-00-00', 0, '1.00', '1.00', 0, 1, 0, 0, 1, 0, 1, '0000-00-00 00:00:00', '2016-06-04 16:08:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `level` int(1) NOT NULL,
  `joining` int(10) NOT NULL,
  `earning` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id`, `user_id`, `level`, `joining`, `earning`) VALUES
(1, 13, 1, 8, '161.00'),
(2, 13, 2, 80, '161.00'),
(3, 13, 3, 800, '161.00'),
(4, 13, 4, 8000, '161.00'),
(5, 13, 5, 80000, '161.00'),
(6, 13, 6, 800000, '161.00'),
(7, 13, 7, 8000000, '161.00'),
(8, 13, 8, 80000000, '161.00'),
(9, 50, 8, 80000000, '161.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activator_id`
--
ALTER TABLE `activator_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_url`
--
ALTER TABLE `app_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_detail`
--
ALTER TABLE `bank_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_cookies`
--
ALTER TABLE `ci_cookies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `complete_challange`
--
ALTER TABLE `complete_challange`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complete_earnmore`
--
ALTER TABLE `complete_earnmore`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earn_more`
--
ALTER TABLE `earn_more`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invite_earn_more`
--
ALTER TABLE `invite_earn_more`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invite_earn_unlimited`
--
ALTER TABLE `invite_earn_unlimited`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activator_id`
--
ALTER TABLE `activator_id`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `app_url`
--
ALTER TABLE `app_url`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `bank_detail`
--
ALTER TABLE `bank_detail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ci_cookies`
--
ALTER TABLE `ci_cookies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `complete_challange`
--
ALTER TABLE `complete_challange`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `complete_earnmore`
--
ALTER TABLE `complete_earnmore`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `earn_more`
--
ALTER TABLE `earn_more`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `invite_earn_more`
--
ALTER TABLE `invite_earn_more`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `invite_earn_unlimited`
--
ALTER TABLE `invite_earn_unlimited`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rank`
--
ALTER TABLE `rank`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
