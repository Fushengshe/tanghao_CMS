-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-05-28 15:25:44
-- 服务器版本： 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `youme`
--

-- --------------------------------------------------------

--
-- 表的结构 `ym_article`
--

CREATE TABLE `ym_article` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL COMMENT '标题',
  `keywords` varchar(150) NOT NULL COMMENT '关键词',
  `lmdesc` varchar(255) NOT NULL COMMENT '描述',
  `pic` varchar(100) NOT NULL COMMENT '缩略图',
  `content` text NOT NULL COMMENT '内容',
  `click` mediumint(9) NOT NULL DEFAULT '0' COMMENT '点击量',
  `cateid` mediumint(9) NOT NULL,
  `time` int(10) NOT NULL COMMENT '发布时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- 转存表中的数据 `ym_article`
--

INSERT INTO `ym_article` (`id`, `title`, `keywords`, `lmdesc`, `pic`, `content`, `click`, `cateid`, `time`) VALUES
(1, '文章1', '文章1', '文章1', '/static/uploads/170527/3b6bd63ae975705e5cd5a2a8604e464c.jpg', '<p>文章11</p>', 0, 1, 1495879847),
(2, '文章2', '文章2', '文章2', '/static/uploads/170527/d4eb693db5939aded42fd6a9aaeed912.png', '<p>文章2</p>', 2, 2, 1495879891),
(3, '文章3', '文章3', '文章3', '', '<p>文章3</p>', 0, 1, 1495887135),
(4, '文章4', '文章4', '文章4', '', '<p>文章4</p>', 9, 1, 1495887147),
(15, '文章5', '文章5', '文章5', '/static/uploads/170527/eb7dc50bf7c24af014061583b4694e65.jpg', '<p>vv&#39;v&#39;vvvv</p>', 8, 1, 1495888413),
(17, '文章6', '文章6', '文章6', '', '<p>文章6</p>', 2, 3, 1495968109);

-- --------------------------------------------------------

--
-- 表的结构 `ym_cate`
--

CREATE TABLE `ym_cate` (
  `id` int(11) NOT NULL,
  `catename` varchar(30) NOT NULL COMMENT '栏目名称',
  `keywords` varchar(150) NOT NULL COMMENT '栏目关键词',
  `lmdesc` text NOT NULL COMMENT '栏目描述',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '栏目类型0 列表 1 留言'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `ym_cate`
--

INSERT INTO `ym_cate` (`id`, `catename`, `keywords`, `lmdesc`, `type`) VALUES
(1, '新闻', '新闻', '                                                                                                                                        ', 0),
(2, '军事', '军事', '', 0),
(3, '娱乐', '娱乐', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ym_link`
--

CREATE TABLE `ym_link` (
  `id` mediumint(9) NOT NULL,
  `title` varchar(30) NOT NULL COMMENT '链接标题',
  `lmdesc` varchar(255) NOT NULL COMMENT '链接描述',
  `url` varchar(60) NOT NULL COMMENT '链接地址'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `ym_link`
--

INSERT INTO `ym_link` (`id`, `title`, `lmdesc`, `url`) VALUES
(1, '百度', '                                    百度官网                                ', 'http://www.baidu.com'),
(2, '毛球', '                                                                        我的域名                                                                ', 'http://thmaoqiu.cn'),
(4, '测试', '                                  2                                                                      1                                ', 'http://'),
(5, '测试2', '', 'http://'),
(6, '丧尸', '', 'www.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ym_article`
--
ALTER TABLE `ym_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ym_cate`
--
ALTER TABLE `ym_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ym_link`
--
ALTER TABLE `ym_link`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `ym_article`
--
ALTER TABLE `ym_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- 使用表AUTO_INCREMENT `ym_cate`
--
ALTER TABLE `ym_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `ym_link`
--
ALTER TABLE `ym_link`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
