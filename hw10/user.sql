-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 06 2018 г., 23:13
-- Версия сервера: 5.7.20-log
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `netology`
--

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
(1, 'as', '$2y$10$iInbPVDq8oZRBAeGHGMNCupSt6hL.zJVDML4MPKslUi1r8qvvI/Ma'),
(2, 'Aziza', '$2y$10$UfiW145lYczrbFrJx8OUWuo3PapEhVOOTX0QxVX1QOM9pyfeolAhK'),
(3, 'asd', '$2y$10$bbXbCPi8mpwkusWG.TAaBeNTNtSGThazJ/4FYsUS9QShIFc4/W6GC'),
(4, '123', '$2y$10$i6rsalHj6zvEzInSRHVprO7ww86k4nzkCVK9p.xOm8cTdbJcT4ihe'),
(5, 'gfd', '$2y$10$rv/YrNd2VXvZPD3slY/uZOlFONT9OIcP40n6rKB3PlYRNjohkklMq'),
(6, '1', '$2y$10$vkvTjEJGg/fhMt/SDnY1L.H.RDUfRHAlbvQXgYIfDiqydc3ujnXiS');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
