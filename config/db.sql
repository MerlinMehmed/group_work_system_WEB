-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23 юни 2018 в 07:06
-- Версия на сървъра: 10.1.30-MariaDB
-- PHP Version: 7.2.2

CREATE DATABASE IF NOT EXISTS `group_work_system` COLLATE utf8mb4_unicode_ci;
USE `group_work_system`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group_work_system`
--

-- --------------------------------------------------------

--
-- Структура на таблица `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `owner` varchar(20) NOT NULL,
  `content_url` varchar(50) NOT NULL,
  `last_update_user` varchar(20) DEFAULT NULL,
  `last_update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `document`
--

INSERT INTO `document` (`id`, `owner`, `content_url`, `last_update_user`, `last_update_date`) VALUES
(1, 'polly', 'polly/po', NULL, '2018-05-17 16:44:33'),
(3, 'polly', 'polly/olly', NULL, '2018-05-17 16:44:52'),
(4, 'polly', 'polly/olly', NULL, '2018-05-17 16:45:22'),
(5, 'merry', 'me', NULL, '2018-05-17 16:45:22');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`username`, `password`, `email`) VALUES
('merry', 'merry', 'erry'),
('polly', 'polly', 'olly');

-- --------------------------------------------------------

--
-- Структура на таблица `user_document`
--

CREATE TABLE `user_document` (
  `username` varchar(20) NOT NULL,
  `id_document` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `user_document`
--

INSERT INTO `user_document` (`username`, `id_document`) VALUES
('merry', 3),
('polly', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user_document`
--
ALTER TABLE `user_document`
  ADD PRIMARY KEY (`username`,`id_document`),
  ADD KEY `username` (`username`),
  ADD KEY `id_document` (`id_document`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `user_document`
--
ALTER TABLE `user_document`
  ADD CONSTRAINT `user_document_ibfk_1` FOREIGN KEY (`id_document`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_document_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
