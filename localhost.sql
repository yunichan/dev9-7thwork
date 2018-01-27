-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018 年 1 月 27 日 07:06
-- サーバのバージョン： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `desing_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `css_t`
--

CREATE TABLE IF NOT EXISTS `css_t` (
`id` int(11) NOT NULL,
  `element` varchar(6000) COLLATE utf8_unicode_ci NOT NULL,
  `css` varchar(6000) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `css_t`
--

INSERT INTO `css_t` (`id`, `element`, `css`, `date`) VALUES
(58, '<a class="button">Button</a>', '.button {\r\n  position: relative;\r\n  z-index: 2;\r\n  background-color: #f34545;\r\n  border: 2px solid #f34545;\r\n  color: #fff;\r\n  line-height: 50px;\r\n  width:100px;\r\n  margin:auto;\r\n  text-align: center;\r\n  transition:all .5s ease;\r\n}\r\n.button:hover {\r\n  background-color: #fff;\r\n  border-color: #59b1eb;\r\n  color: #59b1eb;\r\n}', '2018-01-26'),
(59, '<div class=''box''>\r\n  <div class=''wave -one''></div>\r\n  <div class=''wave -two''></div>\r\n  <div class=''wave -three''></div>\r\n  <div class=''title''>test</div>\r\n</div>', '.box {\r\n  width: 100%;\r\n  height: 100%;\r\n  border-radius: 5px;\r\n  box-shadow: 0 2px 30px rgba(black, .2);\r\n  background: lighten(#f0f4c3, 10%);\r\n  position: relative;\r\n  overflow: hidden;\r\n  transform: translate3d(0, 0, 0);\r\n}\r\n\r\n.wave {\r\n  opacity: .4;\r\n  position: absolute;\r\n  top: 5%;\r\n  left: 60%;\r\n  background: #0af;\r\n  width: 400px;\r\n  height: 400px;\r\n  margin-left: -250px;\r\n  margin-top: -250px;\r\n  transform-origin: 50% 48%;\r\n  border-radius: 43%;\r\n  animation: drift 3000ms infinite linear;\r\n}\r\n\r\n.wave.-three {\r\n  animation: drift 5000ms infinite linear;\r\n}\r\n\r\n.wave.-two {\r\n  animation: drift 7000ms infinite linear;\r\n  opacity: .1;\r\n  background: yellow;\r\n}\r\n\r\n.box:after {\r\n  content: '''';\r\n  display: block;\r\n  left: 0;\r\n  top: 0;\r\n  width: 100%;\r\n  height: 100%;\r\n  background: linear-gradient(to bottom, rgba(#e8a, 1), rgba(#def, 0) 80%, rgba(white, .5));\r\n  z-index: 11;\r\n  transform: translate3d(0, 0, 0);\r\n}\r\n\r\n.title {\r\n  position: absolute;\r\n  left: 0;\r\n  top: 0;\r\n  width: 100%;\r\n  height:100%;\r\n  z-index: 1;\r\n  line-height: 300px;\r\n  text-align: center;\r\n  transform: translate3d(0, 0, 0);\r\n  color: white;\r\n  text-transform: uppercase;\r\n  font-family: ''Playfair Display'', serif;\r\n  letter-spacing: .4em;\r\n  font-size: 24px;\r\n  text-shadow: 0 1px 0 rgba(black, .1);\r\n  text-indent: .3em;\r\n  display: inline-flex;\r\n  justify-content:center;\r\n  align-items:center;\r\n}\r\n@keyframes drift {\r\n  from { transform: rotate(0deg); }\r\n  from { transform: rotate(360deg); }\r\n}', '2018-01-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `css_t`
--
ALTER TABLE `css_t`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `css_t`
--
ALTER TABLE `css_t`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=65;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
