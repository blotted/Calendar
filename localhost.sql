-- phpMyAdmin SQL Dump
-- version 4.4.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 14 2016 г., 21:52
-- Версия сервера: 5.7.9-log
-- Версия PHP: 5.6.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `calendar`
--

-- --------------------------------------------------------

--
-- Структура таблицы `random_dates`
--

CREATE TABLE IF NOT EXISTS `random_dates` (
  `id` smallint(5) unsigned NOT NULL,
  `date` date NOT NULL,
  `event_name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `random_dates`
--

INSERT INTO `random_dates` (`id`, `date`, `event_name`) VALUES
(25, '2016-02-14', 'День Св. Валентина'),
(26, '2016-01-07', 'Рождество Христово'),
(27, '2016-01-24', 'Международный день эскимо'),
(28, '2016-02-06', 'День бармена'),
(29, '2016-03-08', '8 марта');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `random_dates`
--
ALTER TABLE `random_dates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `random_dates`
--
ALTER TABLE `random_dates`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
