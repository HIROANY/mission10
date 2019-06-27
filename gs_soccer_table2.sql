-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2019 年 6 月 27 日 18:56
-- サーバのバージョン： 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gs_db_soccer`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_soccer_table2`
--

CREATE TABLE `gs_soccer_table2` (
  `id` int(12) NOT NULL,
  `pid` int(12) NOT NULL,
  `sdate` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `pcondition` int(2) NOT NULL,
  `pcare` int(2) NOT NULL,
  `training` int(2) NOT NULL,
  `training2` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_soccer_table2`
--

INSERT INTO `gs_soccer_table2` (`id`, `pid`, `sdate`, `pcondition`, `pcare`, `training`, `training2`) VALUES
(1, 54830001, '2019-06-27', 9, 2, 6, 6),
(2, 54830002, '2019-06-27', 5, 3, 9, 10),
(3, 54830003, '2019-06-27', 8, 2, 6, 5),
(5, 54830003, '2019-06-26', 7, 3, 3, 4),
(6, 54830003, '2019-06-25', 4, 3, 4, 3),
(7, 54830003, '2019-06-24', 8, 2, 6, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gs_soccer_table2`
--
ALTER TABLE `gs_soccer_table2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_soccer_table2`
--
ALTER TABLE `gs_soccer_table2`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
