-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2019 年 07 月 21 日 17:52
-- 伺服器版本: 10.1.35-MariaDB
-- PHP 版本： 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `messagebook`
--
CREATE DATABASE IF NOT EXISTS `messagebook` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `messagebook`;

-- --------------------------------------------------------

--
-- 資料表結構 `content`
--

CREATE TABLE `content` (
  `conid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED DEFAULT NULL COMMENT 'user表的主鍵',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '新文章標題',
  `content` text COMMENT '新文章內容',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '文章狀態 1 顯示 0關閉',
  `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '格林威治時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `content`
--

INSERT INTO `content` (`conid`, `uid`, `title`, `content`, `status`, `createtime`) VALUES
(4, 1, 'test1', 'content1', 1, 1563617768),
(5, 1, '你好喔', '你好喔', 1, 1563630410),
(6, 3, 'jacktitle', 'jackconten', 1, 1563637688),
(7, 1, '123555', '5555', 1, 1563722720);

-- --------------------------------------------------------

--
-- 資料表結構 `message`
--

CREATE TABLE `message` (
  `mesid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'users主鍵',
  `conid` int(10) UNSIGNED DEFAULT NULL COMMENT 'content主鍵',
  `message` varchar(255) NOT NULL DEFAULT '',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '格林威治時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `message`
--

INSERT INTO `message` (`mesid`, `uid`, `conid`, `message`, `createtime`) VALUES
(1, 1, 6, '123456test', 1563639845),
(2, 3, 6, 'teststetst', 1563640831),
(3, 3, 5, '哈哈哈哈哈哈', 1563643007),
(4, 3, 5, '哈哈哈哈哈哈', 1563643008),
(5, 3, 5, '123456', 1563643230),
(6, 3, 5, '123456', 1563643276),
(7, 3, 6, '123456', 1563643340),
(8, 3, 4, '123456', 1563643410);

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `uid` int(10) UNSIGNED NOT NULL,
  `userName` varchar(100) NOT NULL DEFAULT '',
  `account` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(150) NOT NULL DEFAULT '',
  `regTime` varchar(255) NOT NULL COMMENT '格林威治時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`uid`, `userName`, `account`, `password`, `email`, `regTime`) VALUES
(1, 'hogan', '123456', '$2y$10$yHggNPHcihtlFRbu4A0Uee73/HcAYe1H0aAx3.cf.LwswDq/KbxZy', '456@yahoo.com', '1563556281'),
(2, 'jack', '654231', '$2y$10$BOuwBMyaTy9AiY6PyeCcROJHw8Av28AoVx6mZv5k17OT7o/qW8mWm', 'jack@yahoo.com', '1563637612'),
(3, 'jack', '654321', '$2y$10$Pko61sORhM8KczmnEMVE6eVdZNubXlBnm6uo9JEhuRN.wWEZltWnC', 'cheng.teg0210@yahoo.com.tw', '1563637655');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`conid`),
  ADD KEY `uid` (`uid`);

--
-- 資料表索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mesid`),
  ADD KEY `conid` (`conid`),
  ADD KEY `uid` (`mesid`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `content`
--
ALTER TABLE `content`
  MODIFY `conid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表 AUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `mesid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- 資料表的 Constraints `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`conid`) REFERENCES `content` (`conid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
