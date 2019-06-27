-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2019 年 6 月 27 日 18:57
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
-- テーブルの構造 `gs_player_table`
--

CREATE TABLE `gs_player_table` (
  `pid` int(12) NOT NULL,
  `pname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `pposition` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `pnumber` int(12) NOT NULL,
  `pheight` int(12) NOT NULL,
  `pweight` int(32) NOT NULL,
  `sfoot` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `pbirthday` date NOT NULL,
  `previousteam` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_player_table`
--

INSERT INTO `gs_player_table` (`pid`, `pname`, `pposition`, `pnumber`, `pheight`, `pweight`, `sfoot`, `pbirthday`, `previousteam`, `img`) VALUES
(54830001, '脇 裕基', 'FW', 9, 181, 74, '0', '1993-02-20', '藤枝MYFC', '20190620214034d41d8cd98f00b204e9800998ecf8427e.jpg'),
(54830002, 'イブラヒム', 'FW', 11, 188, 74, '0', '1997-02-18', 'ポフマデFC（ガーナ）', '20190620214711d41d8cd98f00b204e9800998ecf8427e.jpg'),
(54830003, '勝又 慶典', 'FW', 13, 174, 65, '0', '1985-12-07', 'AC長野パルセイロ', '20190620214928d41d8cd98f00b204e9800998ecf8427e.jpg'),
(54830004, '小久保 裕也', 'FW', 23, 179, 72, '0', '1996-10-17', '大阪産業大学', '20190621002816d41d8cd98f00b204e9800998ecf8427e.jpg'),
(54830005, 'エリック', 'FW', 25, 174, 70, '0', '1995-12-09', 'Stade Tunisien（チュニジア）', '20190621142108d41d8cd98f00b204e9800998ecf8427e.jpg'),
(54830006, 'ムスタファ', 'MF', 5, 182, 83, '0', '1983-11-28', 'ンカナFC（ザンビア）', '20190621142301d41d8cd98f00b204e9800998ecf8427e.jpg'),
(54830007, '青木 捷', 'MF', 6, 172, 68, '0', '1993-06-24', '藤枝MYFC', '20190621142433d41d8cd98f00b204e9800998ecf8427e.jpg'),
(54830008, '山本 大稀', 'MF', 10, 165, 61, '0', '1992-03-25', '栃木SC', '20190621142621d41d8cd98f00b204e9800998ecf8427e.jpg'),
(54830009, '守屋 鷹人', 'MF', 14, 174, 60, '0', '1998-02-21', '佐川印刷SC', '20190621142830d41d8cd98f00b204e9800998ecf8427e.jpg'),
(54830010, '柿木 亮介', 'MF', 18, 168, 64, '0', '1991-12-23', '藤枝MYFC', '20190621142958d41d8cd98f00b204e9800998ecf8427e.jpg'),
(54830011, 'サバン', 'MF', 19, 175, 68, '0', '1995-12-12', 'ダイア・ダワ・ケネマFC（エチオピア）', '20190621143202d41d8cd98f00b204e9800998ecf8427e.jpg'),
(54830012, '高橋 康平', 'MF', 20, 170, 60, '0', '1991-11-15', 'FC今治', '20190621143357d41d8cd98f00b204e9800998ecf8427e.jpg'),
(54830013, '高橋 俊樹', 'MF', 27, 157, 53, '0', '1994-05-31', '大阪産業大学', '20190621143604d41d8cd98f00b204e9800998ecf8427e.jpg'),
(54830014, '杉山 ビラル 正将', 'MF', 29, 168, 63, '0', '1996-08-21', '静岡産業大学', '20190621143739d41d8cd98f00b204e9800998ecf8427e.jpg'),
(54830015, '清水 良平', 'MF', 30, 175, 70, '0', '1990-08-07', '大阪産業大学', '20190621143908d41d8cd98f00b204e9800998ecf8427e.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gs_player_table`
--
ALTER TABLE `gs_player_table`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_player_table`
--
ALTER TABLE `gs_player_table`
  MODIFY `pid` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54830016;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
