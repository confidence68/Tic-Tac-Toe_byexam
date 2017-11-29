-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-11-29 11:23:41
-- 服务器版本： 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game_06`
--
CREATE DATABASE IF NOT EXISTS `game_06` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `game_06`;

-- --------------------------------------------------------

--
-- 表的结构 `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `status` int(11) DEFAULT '0' COMMENT '0表格空白，1people走了，2电脑走了'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `game`
--

INSERT INTO `game` (`id`, `status`) VALUES
(1, 1),
(2, 0),
(3, 2),
(4, 0),
(5, 1),
(6, 0),
(7, 2),
(8, 0),
(9, 1);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(36) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '用户名字（用户赢了或者输了之后输入）',
  `peoplestep` int(36) NOT NULL COMMENT '人走的步数',
  `computerstep` int(36) NOT NULL COMMENT '电脑走的步数',
  `headerimg` varchar(256) NOT NULL COMMENT '头像地址',
  `time` varchar(255) NOT NULL COMMENT '时间',
  `date` date NOT NULL COMMENT '当前日期',
  `status` int(11) NOT NULL COMMENT '1代表人赢了游戏，2代表电脑赢了游戏'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `peoplestep`, `computerstep`, `headerimg`, `time`, `date`, `status`) VALUES
(1, '76867', 4, 3, 'pictures/123asd.png', '1sec', '2017-11-12', 1),
(2, '76867', 4, 3, 'pictures/123asd.png', '1sec', '2017-11-12', 1),
(3, 'å“ˆå“ˆå“ˆ', 4, 3, 'pictures/123asd.png', '1sec', '2017-11-12', 1),
(4, 'å“ˆå“ˆå“ˆ', 4, 3, 'pictures/123asd.png', '1sec', '2017-11-12', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `id` (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(36) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
