-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 28, 2017 at 03:10 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_network`
--

-- --------------------------------------------------------

--
-- Table structure for table `friendlist`
--

CREATE TABLE `friendlist` (
  `id_1` int(11) NOT NULL,
  `id_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friendlist`
--

INSERT INTO `friendlist` (`id_1`, `id_2`) VALUES
(1, 2),
(2, 1),
(1, 3),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(3, 1),
(1, 4),
(4, 1),
(1, 5),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_1` int(100) UNSIGNED NOT NULL,
  `id_2` int(100) UNSIGNED NOT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `type` varchar(15) NOT NULL,
  `text` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `id_1`, `id_2`, `time`, `type`, `text`) VALUES
(39, 38, 1, '2017-07-26 20:54:27', 'post', 'Accepted your request'),
(40, 38, 1, '2017-07-26 20:54:39', 'post', 'Accepted your request'),
(41, 38, 1, '2017-07-26 20:55:54', 'post', 'Accepted your request'),
(42, 38, 1, '2017-07-26 20:55:56', 'post', 'Rejected your request'),
(43, 38, 1, '2017-07-26 20:56:29', 'post', 'Accepted your request'),
(45, 44, 1, '2017-07-26 20:58:28', 'post', 'Accepted your request'),
(46, 44, 1, '2017-07-26 20:59:35', 'post', 'Accepted your request'),
(47, 44, 1, '2017-07-26 20:59:36', 'post', 'Accepted your request'),
(48, 44, 1, '2017-07-26 21:00:00', 'post', 'Accepted your request'),
(49, 44, 1, '2017-07-26 21:00:28', 'post', 'Accepted your request'),
(50, 44, 1, '2017-07-26 21:01:06', 'post', 'Accepted your request'),
(51, 44, 1, '2017-07-26 21:03:47', 'post', 'Accepted your request'),
(52, 44, 1, '2017-07-26 21:05:21', 'post', 'Accepted your request'),
(53, 44, 1, '2017-07-26 21:05:41', 'post', 'Rejected your request'),
(54, 44, 1, '2017-07-26 21:05:59', 'post', 'Accepted your request'),
(57, 8, 1, '2017-07-26 21:20:23', 'post', 'Accepted your request'),
(93, 1, 8, '2017-07-27 08:54:59', 'post', 'Posted on your wall'),
(94, 1, 8, '2017-07-27 08:55:03', 'post', 'Posted on your wall'),
(95, 1, 8, '2017-07-27 08:55:07', 'post', 'Posted on your wall'),
(102, 10, 1, '2017-07-27 16:58:31', 'post', 'Accepted your request'),
(103, 9, 1, '2017-07-27 16:58:54', 'post', 'Accepted your request'),
(104, 8, 1, '2017-07-27 16:59:10', 'post', 'Accepted your request'),
(107, 1, 10, '2017-07-27 17:01:51', 'post', 'Posted on your wall'),
(108, 1, 12, '2017-07-27 17:02:07', 'post', 'Posted on your wall'),
(109, 1, 18, '2017-07-27 17:02:14', 'post', 'Posted on your wall'),
(110, 1, 7, '2017-07-27 17:02:20', 'post', 'Posted on your wall'),
(111, 1, 23, '2017-07-27 17:02:29', 'post', 'Posted on your wall'),
(112, 1, 31, '2017-07-27 17:02:39', 'post', 'Posted on your wall'),
(113, 1, 2, '2017-07-27 17:02:46', 'post', 'Posted on your wall'),
(114, 1, 23, '2017-07-27 17:02:53', 'post', 'Posted on your wall'),
(115, 10, 1, '2017-07-27 17:11:22', 'post', 'Accepted your request'),
(116, 10, 1, '2017-07-27 17:11:24', 'post', 'Accepted your request'),
(117, 1, 23, '2017-07-27 19:05:06', 'post', 'Posted on your wall'),
(118, 1, 23, '2017-07-27 19:05:10', 'post', 'Posted on your wall'),
(119, 1, 23, '2017-07-27 19:05:13', 'post', 'Posted on your wall'),
(120, 1, 23, '2017-07-27 19:05:16', 'post', 'Posted on your wall'),
(121, 1, 23, '2017-07-27 19:05:19', 'post', 'Posted on your wall');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `hash` varchar(60) DEFAULT NULL,
  `fname` varchar(35) DEFAULT NULL,
  `lname` varchar(35) DEFAULT NULL,
  `dob` varchar(35) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `work` varchar(50) DEFAULT NULL,
  `education` varchar(50) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `hash`, `fname`, `lname`, `dob`, `gender`, `city`, `work`, `education`, `avatar`) VALUES
(1, 'ghazinyan.abel@gmail.com', '$2y$10$hnQ6zolHytgY2sejAVGGiOSqsa9jkupyqiN8YiFcH5Bb4xGYLM0AO', 'Abel', 'Ghazinyan', '15-09-1992', 1, 'Yerevan/Armenia', '', 'Moscow State University', '/social-network/media/c8/e0/e9/c8e0e908c1246ece86f565366b4d446c.jpg'),
(2, 'artak@mail.ru', '$2y$10$sgPRJKgK8JjUlgORVJ7YauEnx21hWwpKUIwdXsbpERz7XqaYiGV5q', 'Artak', 'Melkonyan', '14-10-2004', 1, 'Yerevan', '', 'MSU', '/social-network/media/cd/d7/f1/cdd7f1d1d30d76e7b5e4b924903b8649.jpg'),
(3, 'smith@noah.ruj', '$2y$10$Oq1YybGYj4O8Kd3QaWlEM.pz3NvmxC3VvEpWlergu4okqMCd1Ny3G', 'Noah', 'Smith', '18-12-1917', 1, NULL, NULL, NULL, NULL),
(4, 'liam@john.eur', '$2y$10$csX2UwT/TY0T01w9QB/pwuU8ByoCoZxUjwN2Td4rut.J3H/tLta7C', 'Liam', 'Johnson', '13-11-1907', 1, NULL, NULL, NULL, NULL),
(5, 'williwam@mas.jug', '$2y$10$YgdfDyxiVgmbu1AC4nkeve7uY.CKT8AWO2b99N1/sMFOpVXZw2jsm', 'Mason', 'Williams', '11-10-1912', 1, NULL, NULL, NULL, NULL),
(6, 'jones@jac.tuv', '$2y$10$F9hn1IAjOG3ABO6Ga1KhVuxaNQ8e/UM0Se5G1qDwp8YEC4xyalmnm', 'Jacob', 'Jones', '16-09-1916', 1, NULL, NULL, NULL, NULL),
(7, 'brown@will.sjks', '$2y$10$GBJh0Al0Sl7EGSHZ7qv88uYElLFQlV3/UGpG3gnDsUM4Tsgm7Dk46', 'William', 'Brown', '16-08-1907', 1, NULL, NULL, NULL, NULL),
(8, 'davis@eth.jsdh', '$2y$10$WfRBsyqU7ApIYmlJA7iVDexC4s4V8ssmHqpSgu/iqU5SMaVL5Orve', 'Ethan', 'Davis', '08-07-1965', 1, NULL, NULL, NULL, NULL),
(9, 'mill@alex.weyfj', '$2y$10$FmfTWdn5Vm2llLukX2hyOuKhbMZ93PuYSP1eEAoPrRdqYCEXeeLlW', 'Alexander', 'MIller', '15-08-1916', 1, NULL, NULL, NULL, NULL),
(10, 'daniel@taylor.jfv', '$2y$10$jpSAVFEdGYXkZzYhTqhHTuwzqsdq.fBOnBeY1xhfyMTlF5H.dZ8hK', 'Daniel', 'Taylor', '07-09-1915', 1, NULL, NULL, NULL, NULL),
(11, 'logan@ander.hbscj', '$2y$10$5HbhhtdsKOolxlgkl1HSZ./yztEBBPRLeb0htqvTQPExDiShoRzqK', 'Logan', 'Anderson', '12-10-1917', 1, 'London', 'Facebook', 'Harward', '/social-network/media/7d/47/a2/7d47a2440c312e7e453080f4c1ee8cfe.jpg'),
(12, 'thomas@log.bsjws', '$2y$10$R3qIKkXJLRNq9.30gvI/pO4MELHPkdKANdzuIg8IvpA.JX0uNT.Vy', 'Logan', 'Thomas', '06-07-1965', 1, NULL, NULL, NULL, NULL),
(13, 'thomas@log.bsjsc', '$2y$10$EsLlNmHNTU0wKpONrlxLcuAK0moMwlf5NL0wuou/qDvaj55qFIj7m', 'Lucas', 'Thomas', '03-05-1981', 1, NULL, NULL, NULL, NULL),
(14, 'jackson@oliver.whefb', '$2y$10$QHtaAjAasQa3RjGI6mag0uo8oxg1hcfWsMAgumKQAfLQipo.gSsYe', 'Oliver', 'Jackson', '09-04-1932', 1, NULL, NULL, NULL, NULL),
(15, 'white@oli.sjdh', '$2y$10$pIsNCPzDGvtGIRPH7WxAGuy.yCYys3Tf3w2DUcDDGeHBaLPEEIhKW', 'Oliver', 'White', '03-04-1916', 1, NULL, NULL, NULL, NULL),
(16, 'jack@harris.jshdk', '$2y$10$iev18LuiAV8JHf0MV5eWPeweIJ/dr7DvZrueN79HRh6L3V608HkVa', 'Jack', 'Harris', '06-03-1980', 1, NULL, NULL, NULL, NULL),
(17, 'owen@harris.shjqakw', '$2y$10$cyO3a2iXYYF8PYvXhbiaoujKhWIeETdcr3FhpULXuxpSu6ueijEHq', 'Owen', 'Harris', '02-01-1998', 1, NULL, NULL, NULL, NULL),
(18, 'owen@thompson.ksul', '$2y$10$xv8FE2E5Nv.tNjE2ijkIr.bJwjP3wgRj/KbVnbXGLcsTrBMX3rIca', 'Owen', 'Thompson', '16-04-1964', 1, NULL, NULL, NULL, NULL),
(19, 'aaron@garcia.qoql', '$2y$10$k1dC67au4DpkMl.q2/6MFuL/o7e6bsKfFejEbEU6SC4zIsMh3eERy', 'Aaron', 'Garcia', '03-11-1946', 1, NULL, NULL, NULL, NULL),
(20, 'coonor@martinez.wpgfjro', '$2y$10$eGtEHjtt0FPIHVRv3ixfFOCIdT16vlLmltFGbTG6z82ocsgjVGS82', 'Connor', 'Martinez', '02-03-1995', 1, NULL, NULL, NULL, NULL),
(21, 'jordan@mart.lewidos', '$2y$10$tMyyqWB6vj3xiYA7/2.o2eVY7o4sp2qAfrA1nGb7rtl58I7WxIlo6', 'Jordan', 'Martinez', '11-04-1912', 1, NULL, NULL, NULL, NULL),
(22, 'rob@robins.qoiwj', '$2y$10$JKZaSyrxPZm8OEi.HN6f1.hbx40DGgPxy47ukhh/0iHyFF6078x2.', 'Robert', 'Robinson', '07-03-1964', 1, NULL, NULL, NULL, NULL),
(23, 'clark@robert.qwods', '$2y$10$k5BuMZ001PZbLVbBCcPRo.OoEqX8mKt9p2CXm32D3SINMDJPIWoTW', 'Robert', 'Clark', '30-03-1981', 1, NULL, NULL, NULL, NULL),
(24, 'lee@abel.qpowdq', '$2y$10$82lcncqYb5PUovRJoMizBeFYBU2FVhO12ENnY1tQ4rNsLNwpzSjdS', 'Abel', 'Lee', '27-11-1912', 1, NULL, NULL, NULL, NULL),
(25, 'lee@chase.woeo', '$2y$10$.nyUbqHmTaX50ScMVJCrauFVCuXpCxoQ72aTsekFoDRRO4huhKnyi', 'Chase', 'Lee', '07-06-1931', 1, NULL, NULL, NULL, NULL),
(26, 'walker@chase.qowj', '$2y$10$W4Zfv3Epr3pcUu8M./HmdOcJn2iEGhesL7rcL0XfZIdoSypkJLlUO', 'Chase', 'Walker', '16-04-1964', 1, NULL, NULL, NULL, NULL),
(27, 'adam@hall.pwopkfcjm', '$2y$10$0LVnOdJPKUsArIphZzr4.uDTrq0CGkpUxhKMJDghjB6dlpBz5xPj.', 'Adam', 'Hall', '05-11-1980', 1, NULL, NULL, NULL, NULL),
(28, 'ian@young.paqowsfk', '$2y$10$5R4T8w6luaSVO2dHn2yBr.uuAmOIegj4dNo8/YeUEfiHRk17lCoN2', 'Ian', 'Young', '03-03-1946', 1, NULL, NULL, NULL, NULL),
(29, 'parkerking@aiknwsk.h', '$2y$10$4TFsqqMO/JEcQDWk4ezTgOB6I/v7L8/A9FZguvcN8lEC4/c4QtOUC', 'Parkeruhi', 'KIng', '14-05-2000', 0, NULL, NULL, NULL, NULL),
(30, 'parkabel@tijyot.sokg', '$2y$10$z1bDbBuCRHR.J3nPAK3ER.qXPTcoo/8Z9jL2QmLbW0ZwlNupd1QOq', 'Abel', 'KIng', '08-01-1958', 0, NULL, NULL, NULL, NULL),
(31, 'art-abel@gmail.com', '$2y$10$1X0YcvL7bOhDzHO6KTYki.XX2RAGPeQYP/l/JBtuk4DNMOo.Y0XSq', 'Karen', 'Abel sds', '18-11-1916', 1, '', '', '', NULL),
(32, 'asdsa@dfdf.adasd', '$2y$10$SkhPG1Uiqhbzox8dW4E17.5QXSv2BIEusffalK13Wy74XZh.MjAJy', 'Abel', 'Poghosyan', '15-10-1914', 1, NULL, NULL, NULL, NULL),
(33, 'asa@sas.as', '$2y$10$V/1kNqHwOfQ7eB/aZUYANOrid2UzYrE2STwDWebTR9jBCoNVLHyna', 'Abel', 'Petrosyan', '16-10-1916', 1, NULL, NULL, NULL, NULL),
(34, 'asa@shas.as', '$2y$10$IYW/CM1lyfMNW9.CleeJne/UYcy6N/iyMGkQdLdx68jU718ffBHLm', 'Abel', 'Muradyan', '15-10-1916', 1, NULL, NULL, NULL, NULL),
(35, 'asha@shas.as', '$2y$10$KSyX9HIC7UIgpUMlfPuDK.aOq.sNJF/vVNpaxzE2EHeY1.ZA0ZsBe', 'Abel', 'Babayan', '15-12-1916', 1, NULL, NULL, NULL, NULL),
(36, 'ashha@shas.as', '$2y$10$lK9KrvyTIUFCnaJ5OxHkkuZoLzVn6MZt3rGMsc30iWdov3h33aDGu', 'Abel', 'Hovhannisyan', '13-04-1916', 1, NULL, NULL, NULL, NULL),
(37, 'jkdsfkjds@dsd.dsd', '$2y$10$DA5ljuhLzxDIXFZB2wCaueW5hkW6g.gxDi1P/YEf0g56/FoloUi0C', 'Abel', 'Abel', '17-11-1914', 1, NULL, NULL, NULL, NULL),
(38, 'sdfsd@sdfsdf.sfsdf', '$2y$10$/TBuVcIoJlluVU8jt7GkkeQ04GX2BvKbMq4f/oC.nrOB/iIxhBG9S', 'Abel', 'Ginosyan', '17-11-1915', 1, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
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
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
