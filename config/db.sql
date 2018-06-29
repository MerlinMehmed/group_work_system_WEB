-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29 юни 2018 в 16:14
-- Версия на сървъра: 10.1.31-MariaDB
-- PHP Version: 7.2.4

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
(1, 'fmi', 'fmi/document', 'merry', '2018-06-29 14:44:26'),
(2, 'merry', 'merry/referat', 'fmi', '2018-06-28 10:32:00'),
(4, 'merry', 'merry/file2', 'polly', '2018-06-29 14:47:28'),
(5, 'polly', 'polly/document1', NULL, '2018-06-25 19:08:20');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`username`, `password`, `email`) VALUES
('fmi', 'fmipass', 'fmi@fmi.com'),
('merry', 'merrymerry', 'merry@gmail.com'),
('polly', 'pollypolly', 'polly@gmail.com');

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
('fmi', 2),
('fmi', 4),
('merry', 5),
('polly', 4);

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
