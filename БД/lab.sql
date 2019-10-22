-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 22 2019 г., 08:01
-- Версия сервера: 5.6.43
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lab`
--

-- --------------------------------------------------------

--
-- Структура таблицы `analytics`
--

CREATE TABLE `analytics` (
  `visitor_id` int(11) NOT NULL,
  `visitor_ip` varchar(12) NOT NULL,
  `visited_page_id` int(11) NOT NULL,
  `visited_this_page` int(11) NOT NULL DEFAULT '0',
  `visitor_ref` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `analytics`
--

INSERT INTO `analytics` (`visitor_id`, `visitor_ip`, `visited_page_id`, `visited_this_page`, `visitor_ref`) VALUES
(43, '127.0.0.1', 26, 13, 'lab/admin.php'),
(44, '127.0.0.1', 28, 16, ''),
(45, '127.0.0.1', 27, 2, 'http://lab/map.php');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `page_url` varchar(60) NOT NULL,
  `page_title` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`page_id`, `page_url`, `page_title`) VALUES
(26, '/map.php', 'Рестораны'),
(27, '/menu.php', 'Меню'),
(28, '/index.php', 'Главная');

-- --------------------------------------------------------

--
-- Структура таблицы `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `deposit` float DEFAULT '0',
  `name` varchar(60) DEFAULT NULL,
  `table_number` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `date`, `time`, `telephone`, `deposit`, `name`, `table_number`) VALUES
(15, '2019-10-22', '09:09:00', '+79178424366', 0, 'Antipasti', '4'),
(16, '2019-10-23', '11:00:00', '+79178424366', 1000, 'Никита', '2'),
(18, '2019-10-29', '20:00:00', '+7 (917) 842-43-66', 10000, 'Дмитрий', '12'),
(19, '2019-10-23', '09:00:00', '+7 (917) 842-43-66', 2000, 'Андрей', '5'),
(20, '2019-10-23', '16:00:00', '+7 (917) 842-43-66', 3500, 'Марина', '23');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`) VALUES
(1, 'admin', 'admin'),
(3, 'nikita', 'nikita123'),
(4, 'login', 'admin'),
(5, 'superadmin', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `analytics`
--
ALTER TABLE `analytics`
  ADD PRIMARY KEY (`visitor_id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Индексы таблицы `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `analytics`
--
ALTER TABLE `analytics`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
