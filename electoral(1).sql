-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2019 at 10:48 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electoral`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `FullName` varchar(200) NOT NULL,
  `birthDate` date NOT NULL,
  `gennder` int(1) NOT NULL,
  `image` varchar(100) NOT NULL,
  `party_id` int(11) NOT NULL,
  `eleC_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `FullName`, `birthDate`, `gennder`, `image`, `party_id`, `eleC_id`) VALUES
(2, 'عمر عبداللة أدم', '1984-11-13', 1, '2.png', 3, 1),
(3, 'مالك علي يحي', '1987-11-15', 1, '3.jpg', 2, 1),
(4, 'الطيب أبوبكر الشيخ', '1980-09-07', 1, '4.jpg', 4, 1),
(5, 'الطاهر محمد عثمان', '1988-09-22', 1, '5.jpg', 2, 3),
(6, 'الطاهر محمد عثمان', '1989-11-16', 1, '6.jpg', 5, 4),
(7, 'عمر رشوة', '2018-11-16', 1, '7.jpg', 2, 10),
(8, 'omar mohammed', '1990-11-09', 1, '8.jpg', 6, 8),
(9, 'mohamed  tana', '1978-11-10', 1, '9.jpg', 4, 8),
(10, 'ali alhassan', '1976-12-30', 1, '10.jpg', 6, 9),
(11, 'sala adam', '1985-11-16', 1, '11.jpg', 7, 8),
(12, 'مهند ابراهيم', '1980-11-02', 1, '12.jpg', 2, 11),
(13, 'التجاني خالد', '1989-12-19', 1, '13.jpg', 6, 12),
(14, 'يوسف', '1995-12-14', 1, '14.jpg', 6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `electoral_circuite`
--

CREATE TABLE `electoral_circuite` (
  `id` int(11) NOT NULL,
  `e_name` varchar(200) NOT NULL,
  `descript` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `electoral_circuite`
--

INSERT INTO `electoral_circuite` (`id`, `e_name`, `descript`) VALUES
(1, 'رائسة الجمهورية', 'لترشيح مرشح لمنصب رائسة الجمهورية'),
(8, 'والي', 'والي ولاية'),
(9, 'معتمد', 'معتمد'),
(10, 'وزير ', 'وزير اتصالات'),
(11, 'مجلس التشريعي', 'مجلس تشريعي');

-- --------------------------------------------------------

--
-- Table structure for table `electoral_cycle`
--

CREATE TABLE `electoral_cycle` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `start_at` date NOT NULL,
  `end_at` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `electoral_cycle`
--

INSERT INTO `electoral_cycle` (`id`, `title`, `start_at`, `end_at`, `status`) VALUES
(3, 'المحلية', '2018-11-23', '2018-12-30', 2),
(4, '2015', '2018-11-07', '2018-11-14', 2),
(5, 'الانتخابات العامة2020', '2018-11-24', '2018-12-28', 2),
(6, 'انتخات تشريعية ', '2018-11-29', '2019-12-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `electoral_result`
--

CREATE TABLE `electoral_result` (
  `id` int(11) NOT NULL,
  `cycle_id` int(11) NOT NULL,
  `cand_id` int(11) NOT NULL,
  `eleC_id` int(11) NOT NULL,
  `num_vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `electoral_result`
--

INSERT INTO `electoral_result` (`id`, `cycle_id`, `cand_id`, `eleC_id`, `num_vote`) VALUES
(1, 1, 2, 1, 2),
(2, 1, 3, 1, 1),
(3, 1, 8, 8, 2),
(4, 1, 9, 8, 1),
(5, 1, 10, 9, 3),
(6, 1, 7, 10, 3),
(7, 1, 12, 11, 2),
(8, 5, 2, 1, 2),
(9, 5, 3, 1, 1),
(10, 5, 9, 8, 2),
(11, 5, 10, 9, 1),
(12, 5, 7, 10, 1),
(13, 5, 12, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `birthDate` date NOT NULL,
  `id_num` varchar(100) NOT NULL,
  `addrss` varchar(200) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`id`, `FullName`, `phone`, `birthDate`, `id_num`, `addrss`, `user`, `pass`) VALUES
(4, 'ibrahim', '0920094948', '1996-11-13', '15-1112209', 'الابيض', 'ibrahim', '2020'),
(5, 'محمد الحسن', '0912345677', '1977-11-14', '66655544', 'الخرطوم بحري', 'm alhassan', '2030'),
(7, 'عبدالمهيمن', '091222367', '1988-10-02', '0212131313', 'امدرمان', 'عبدو', '85208520');

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

CREATE TABLE `parties` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `publish_at` date NOT NULL,
  `brand` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parties`
--

INSERT INTO `parties` (`id`, `name`, `logo`, `publish_at`, `brand`) VALUES
(2, 'المؤتمر الوطني', '2.jpg', '2029-11-14', ' الله اكبر'),
(3, 'الموتمر الشعبي', '3.jpg', '2018-11-15', 'الموتمر الشعبي'),
(4, 'حزب العدالة و التحرير الديمقراطي', '4.jpg', '1980-11-16', 'حزب العدالة و التحرير الديمقراطي'),
(5, 'الحزب السوداني', '5.jpg', '1994-11-28', 'الحزب السوداني الحزب السوداني'),
(6, 'حزب البعث', '6.jpg', '2018-11-21', 'مروحة'),
(7, 'الحزب النيل السوداني', '7.jpg', '1998-11-08', 'البرج');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `FullName` varchar(200) NOT NULL,
  `id_num` varchar(100) NOT NULL,
  `birthDate` date NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `FullName`, `id_num`, `birthDate`, `pass`) VALUES
(1, 'الحاج الزين إسحاق', '12-355777-11', '1988-11-16', '123123'),
(2, 'الحاج الزين إسحاق', '12-123-12', '2018-11-14', '123123'),
(3, 'Ali Adam', '123-123', '2018-11-15', 'ali123'),
(4, 'Mosab Alhaj', '2005-1', '2006-11-17', '123123'),
(6, 'Malik Ali', '123-321', '2018-11-15', '123123'),
(7, 'بابكر احمد', '660066', '1966-11-04', '123123'),
(12, 'emam', '4567', '4855-11-13', '0000'),
(13, 'mm', '6600', '2018-11-20', '6600'),
(14, 'khaled omar', '888-55', '1992-10-29', '4'),
(15, 'sala adam', '1264', '2018-11-09', '55'),
(16, 'igabal', '2009', '2018-11-09', '2009'),
(17, 'hhh', '1414', '2018-11-14', '1414'),
(18, 'rtr', '4141', '2018-11-18', '4141'),
(19, 'mohammed hamad', '3636', '2018-11-09', '3636'),
(20, 'm', '55', '2018-11-15', '55'),
(21, 'محمد', '12-1112209', '2018-11-01', '0221133'),
(22, 'ff', '77', '2018-11-15', '77'),
(23, '12345', '123', '2018-11-17', '123'),
(24, '2123', '3333', '0333-03-31', '3333'),
(25, 'احمد محمد عيسى', '2018', '1996-02-11', '09228'),
(26, 'احمد', '1996', '1996-02-11', '09228'),
(27, 'مأمون عباس', '0929619744', '1995-07-02', '097318'),
(28, 'osm', '123478', '0001-11-11', '123478'),
(29, 'd', '11996', '2018-11-22', '00'),
(30, 'احمد محمد عيسى', '0922814443', '1996-11-02', '0966730161'),
(31, 'احمد محمد عيسى', '0999599913', '1992-01-02', '0966730161'),
(33, 'ahmed abdu', '202020', '2018-11-28', '202020'),
(34, 'احمد محمد عيسى', '092281443', '1992-02-11', '0966730161'),
(35, 'ih', '005', '2018-11-10', '005'),
(36, 'uu', '0005', '2018-11-22', '0005'),
(37, 'mm', '111', '2018-11-23', '111'),
(38, 'البخيت', '09797988', '2000-11-20', '303030'),
(39, 'ihuj', '0652456454', '1989-10-20', '02582580'),
(40, 'IASAM', '012345678', '1989-11-15', '987654'),
(42, 'jaber', '019998885', '1970-11-13', '55555'),
(43, 'mhssen', '19999998', '1999-11-14', '66666'),
(44, 'بريمة محمد', '66000', '1988-11-13', '6060'),
(45, 'jehan', '77777', '1988-11-12', '88888'),
(46, 'صديق محمد', '99999', '1989-11-06', '777777'),
(47, 'jekeen jaror', '078945', '1992-12-05', '654654'),
(48, 'hamed eshahk', '98765432100', '1994-01-28', '0123456789'),
(49, 'hjhh', '1212', '1988-11-16', '2121'),
(50, 'التوم محمد', '121987', '1987-12-12', '2000'),
(52, 'mohand ibrahim', '1997', '1997-12-17', '2020'),
(53, 'اخلاص احم', '12365', '0005-12-09', '123456'),
(54, 'اخلاص احم', '445566', '0005-12-09', '445566'),
(55, 'احمد محمد عيسى', '1183588', '2018-12-12', '123'),
(56, 'عبدالمهيمن', '01234', '1988-12-13', '00012'),
(57, 'lll', '2121', '2018-12-07', '2020'),
(58, 'احمد محمد عيسى', '0916587866', '1992-01-01', '0999599913'),
(59, 'aa', '2019', '2019-01-11', '2020');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `cand_id` int(11) NOT NULL,
  `cycle_id` int(11) NOT NULL,
  `eleC_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voter_id`, `cand_id`, `cycle_id`, `eleC_id`) VALUES
(1, 2, 2, 1, 1),
(2, 2, 8, 1, 8),
(3, 2, 10, 1, 9),
(4, 2, 7, 1, 10),
(5, 2, 12, 1, 11),
(6, 5, 3, 1, 1),
(7, 5, 9, 1, 8),
(8, 5, 10, 1, 9),
(9, 5, 7, 1, 10),
(10, 5, 12, 1, 11),
(11, 3, 2, 1, 1),
(12, 3, 8, 1, 8),
(13, 3, 10, 1, 9),
(14, 3, 7, 1, 10),
(15, 30, 2, 5, 1),
(16, 35, 3, 5, 1),
(17, 35, 9, 5, 8),
(18, 36, 2, 5, 1),
(19, 36, 9, 5, 8),
(20, 36, 10, 5, 9),
(21, 36, 7, 5, 10),
(22, 36, 12, 5, 11),
(23, 40, 12, 6, 11),
(24, 40, 13, 6, 12),
(25, 32, 3, 6, 1),
(26, 42, 3, 6, 1),
(27, 42, 8, 6, 8),
(28, 42, 10, 6, 9),
(29, 42, 7, 6, 10),
(30, 42, 12, 6, 11),
(31, 42, 13, 6, 12),
(32, 43, 3, 6, 1),
(33, 43, 10, 6, 9),
(34, 43, 7, 6, 10),
(35, 43, 12, 6, 11),
(36, 43, 13, 6, 12),
(37, 44, 3, 6, 1),
(38, 44, 9, 6, 8),
(39, 44, 10, 6, 9),
(40, 44, 7, 6, 10),
(41, 44, 12, 6, 11),
(42, 44, 13, 6, 12),
(43, 45, 3, 6, 1),
(44, 45, 9, 6, 8),
(45, 45, 10, 6, 9),
(46, 45, 7, 6, 10),
(47, 45, 12, 6, 11),
(48, 45, 13, 6, 12),
(49, 46, 4, 6, 1),
(50, 46, 11, 6, 8),
(51, 46, 10, 6, 9),
(52, 46, 7, 6, 10),
(53, 46, 12, 6, 11),
(54, 46, 13, 6, 12),
(55, 47, 2, 6, 1),
(56, 47, 9, 6, 8),
(57, 47, 10, 6, 9),
(58, 47, 7, 6, 10),
(59, 47, 12, 6, 11),
(60, 47, 13, 6, 12),
(61, 48, 4, 6, 1),
(62, 48, 8, 6, 8),
(63, 48, 10, 6, 9),
(64, 48, 7, 6, 10),
(65, 48, 12, 6, 11),
(66, 48, 13, 6, 12),
(67, 49, 2, 6, 1),
(68, 49, 9, 6, 8),
(69, 49, 10, 6, 9),
(70, 49, 7, 6, 10),
(71, 49, 12, 6, 11),
(72, 49, 13, 6, 12),
(73, 50, 3, 6, 1),
(74, 50, 11, 6, 8),
(75, 50, 7, 6, 10),
(76, 50, 12, 6, 11),
(77, 50, 13, 6, 12),
(78, 51, 7, 6, 10),
(79, 54, 7, 6, 10),
(80, 58, 3, 6, 1),
(81, 58, 9, 6, 8),
(82, 58, 10, 6, 9),
(83, 58, 7, 6, 10),
(84, 58, 12, 6, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electoral_circuite`
--
ALTER TABLE `electoral_circuite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electoral_cycle`
--
ALTER TABLE `electoral_cycle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electoral_result`
--
ALTER TABLE `electoral_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `electoral_circuite`
--
ALTER TABLE `electoral_circuite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `electoral_cycle`
--
ALTER TABLE `electoral_cycle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `electoral_result`
--
ALTER TABLE `electoral_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `emp`
--
ALTER TABLE `emp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `parties`
--
ALTER TABLE `parties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
