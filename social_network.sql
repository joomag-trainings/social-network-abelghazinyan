-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 24, 2017 at 03:10 PM
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
  `id_1` int(100) NOT NULL,
  `id_2` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friendlist`
--

INSERT INTO `friendlist` (`id_1`, `id_2`) VALUES
(2, 1),
(1, 2),
(1, 4),
(4, 1),
(1, 8),
(8, 1),
(1, 20),
(20, 1),
(1, 21),
(21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id_1` int(100) UNSIGNED NOT NULL,
  `id_2` int(100) UNSIGNED NOT NULL,
  `type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `education` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `hash`, `fname`, `lname`, `dob`, `gender`, `city`, `work`, `education`) VALUES
(1, 'ghazinyan.abel@gmail.com', '$2y$10$hnQ6zolHytgY2sejAVGGiOSqsa9jkupyqiN8YiFcH5Bb4xGYLM0AO', 'Abel', 'Ghazinyan', '19-12-1998', 1, 'Yerevan/Armenia', 'Joomag Armenia', 'Moscow State University'),
(2, 'artak@mail.ru', '$2y$10$sgPRJKgK8JjUlgORVJ7YauEnx21hWwpKUIwdXsbpERz7XqaYiGV5q', 'Artak', 'Melkonyan', '14-10-2004', 1, 'Yerevan', '', 'MSU'),
(3, 'smith@noah.ruj', '$2y$10$Oq1YybGYj4O8Kd3QaWlEM.pz3NvmxC3VvEpWlergu4okqMCd1Ny3G', 'Noah', 'Smith', '18-12-1917', 1, NULL, NULL, NULL),
(4, 'liam@john.eur', '$2y$10$csX2UwT/TY0T01w9QB/pwuU8ByoCoZxUjwN2Td4rut.J3H/tLta7C', 'Liam', 'Johnson', '13-11-1907', 1, NULL, NULL, NULL),
(5, 'williwam@mas.jug', '$2y$10$YgdfDyxiVgmbu1AC4nkeve7uY.CKT8AWO2b99N1/sMFOpVXZw2jsm', 'Mason', 'Williams', '11-10-1912', 1, NULL, NULL, NULL),
(6, 'jones@jac.tuv', '$2y$10$F9hn1IAjOG3ABO6Ga1KhVuxaNQ8e/UM0Se5G1qDwp8YEC4xyalmnm', 'Jacob', 'Jones', '16-09-1916', 1, NULL, NULL, NULL),
(7, 'brown@will.sjks', '$2y$10$GBJh0Al0Sl7EGSHZ7qv88uYElLFQlV3/UGpG3gnDsUM4Tsgm7Dk46', 'William', 'Brown', '16-08-1907', 1, NULL, NULL, NULL),
(8, 'davis@eth.jsdh', '$2y$10$WfRBsyqU7ApIYmlJA7iVDexC4s4V8ssmHqpSgu/iqU5SMaVL5Orve', 'Ethan', 'Davis', '08-07-1965', 1, NULL, NULL, NULL),
(9, 'mill@alex.weyfj', '$2y$10$FmfTWdn5Vm2llLukX2hyOuKhbMZ93PuYSP1eEAoPrRdqYCEXeeLlW', 'Alexander', 'MIller', '15-08-1916', 1, NULL, NULL, NULL),
(10, 'daniel@taylor.jfv', '$2y$10$jpSAVFEdGYXkZzYhTqhHTuwzqsdq.fBOnBeY1xhfyMTlF5H.dZ8hK', 'Daniel', 'Taylor', '07-09-1915', 1, NULL, NULL, NULL),
(11, 'logan@ander.hbscj', '$2y$10$5HbhhtdsKOolxlgkl1HSZ./yztEBBPRLeb0htqvTQPExDiShoRzqK', 'Logan', 'Anderson', '12-10-1917', 1, 'London', 'Facebook', 'Harward'),
(12, 'thomas@log.bsjws', '$2y$10$R3qIKkXJLRNq9.30gvI/pO4MELHPkdKANdzuIg8IvpA.JX0uNT.Vy', 'Logan', 'Thomas', '06-07-1965', 1, NULL, NULL, NULL),
(13, 'thomas@log.bsjsc', '$2y$10$EsLlNmHNTU0wKpONrlxLcuAK0moMwlf5NL0wuou/qDvaj55qFIj7m', 'Lucas', 'Thomas', '03-05-1981', 1, NULL, NULL, NULL),
(14, 'jackson@oliver.whefb', '$2y$10$QHtaAjAasQa3RjGI6mag0uo8oxg1hcfWsMAgumKQAfLQipo.gSsYe', 'Oliver', 'Jackson', '09-04-1932', 1, NULL, NULL, NULL),
(15, 'white@oli.sjdh', '$2y$10$pIsNCPzDGvtGIRPH7WxAGuy.yCYys3Tf3w2DUcDDGeHBaLPEEIhKW', 'Oliver', 'White', '03-04-1916', 1, NULL, NULL, NULL),
(16, 'jack@harris.jshdk', '$2y$10$iev18LuiAV8JHf0MV5eWPeweIJ/dr7DvZrueN79HRh6L3V608HkVa', 'Jack', 'Harris', '06-03-1980', 1, NULL, NULL, NULL),
(17, 'owen@harris.shjqakw', '$2y$10$cyO3a2iXYYF8PYvXhbiaoujKhWIeETdcr3FhpULXuxpSu6ueijEHq', 'Owen', 'Harris', '02-01-1998', 1, NULL, NULL, NULL),
(18, 'owen@thompson.ksul', '$2y$10$xv8FE2E5Nv.tNjE2ijkIr.bJwjP3wgRj/KbVnbXGLcsTrBMX3rIca', 'Owen', 'Thompson', '16-04-1964', 1, NULL, NULL, NULL),
(19, 'aaron@garcia.qoql', '$2y$10$k1dC67au4DpkMl.q2/6MFuL/o7e6bsKfFejEbEU6SC4zIsMh3eERy', 'Aaron', 'Garcia', '03-11-1946', 1, NULL, NULL, NULL),
(20, 'coonor@martinez.wpgfjro', '$2y$10$eGtEHjtt0FPIHVRv3ixfFOCIdT16vlLmltFGbTG6z82ocsgjVGS82', 'Connor', 'Martinez', '02-03-1995', 1, NULL, NULL, NULL),
(21, 'jordan@mart.lewidos', '$2y$10$tMyyqWB6vj3xiYA7/2.o2eVY7o4sp2qAfrA1nGb7rtl58I7WxIlo6', 'Jordan', 'Martinez', '11-04-1912', 1, NULL, NULL, NULL),
(22, 'rob@robins.qoiwj', '$2y$10$JKZaSyrxPZm8OEi.HN6f1.hbx40DGgPxy47ukhh/0iHyFF6078x2.', 'Robert', 'Robinson', '07-03-1964', 1, NULL, NULL, NULL),
(23, 'clark@robert.qwods', '$2y$10$k5BuMZ001PZbLVbBCcPRo.OoEqX8mKt9p2CXm32D3SINMDJPIWoTW', 'Robert', 'Clark', '30-03-1981', 1, NULL, NULL, NULL),
(24, 'lee@abel.qpowdq', '$2y$10$82lcncqYb5PUovRJoMizBeFYBU2FVhO12ENnY1tQ4rNsLNwpzSjdS', 'Abel', 'Lee', '27-11-1912', 1, NULL, NULL, NULL),
(25, 'lee@chase.woeo', '$2y$10$.nyUbqHmTaX50ScMVJCrauFVCuXpCxoQ72aTsekFoDRRO4huhKnyi', 'Chase', 'Lee', '07-06-1931', 1, NULL, NULL, NULL),
(26, 'walker@chase.qowj', '$2y$10$W4Zfv3Epr3pcUu8M./HmdOcJn2iEGhesL7rcL0XfZIdoSypkJLlUO', 'Chase', 'Walker', '16-04-1964', 1, NULL, NULL, NULL),
(27, 'adam@hall.pwopkfcjm', '$2y$10$0LVnOdJPKUsArIphZzr4.uDTrq0CGkpUxhKMJDghjB6dlpBz5xPj.', 'Adam', 'Hall', '05-11-1980', 1, NULL, NULL, NULL),
(28, 'ian@young.paqowsfk', '$2y$10$5R4T8w6luaSVO2dHn2yBr.uuAmOIegj4dNo8/YeUEfiHRk17lCoN2', 'Ian', 'Young', '03-03-1946', 1, NULL, NULL, NULL),
(29, 'parkerking@aiknwsk.h', '$2y$10$4TFsqqMO/JEcQDWk4ezTgOB6I/v7L8/A9FZguvcN8lEC4/c4QtOUC', 'Parkeruhi', 'KIng', '14-05-2000', 0, NULL, NULL, NULL),
(30, 'parkabel@tijyot.sokg', '$2y$10$z1bDbBuCRHR.J3nPAK3ER.qXPTcoo/8Z9jL2QmLbW0ZwlNupd1QOq', 'Abel', 'KIng', '08-01-1958', 0, NULL, NULL, NULL),
(31, 'art-abel@gmail.com', '$2y$10$1X0YcvL7bOhDzHO6KTYki.XX2RAGPeQYP/l/JBtuk4DNMOo.Y0XSq', 'Karen', 'Abel sds', '18-11-1916', 1, '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id_1`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
