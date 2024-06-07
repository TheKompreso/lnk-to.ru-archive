-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 07 2024 г., 07:35
-- Версия сервера: 5.7.27-30
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
--

-- --------------------------------------------------------

--
-- Структура таблицы `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(48) NOT NULL,
  `nickname` varchar(32) NOT NULL,
  `ownerid` int(13) NOT NULL,
  `vk` varchar(24) NOT NULL,
  `yt` varchar(32) NOT NULL,
  `inst` varchar(24) NOT NULL,
  `twit` varchar(24) NOT NULL,
  `face` varchar(24) NOT NULL,
  `size` smallint(6) NOT NULL DEFAULT '341'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `help`
--

CREATE TABLE `help` (
  `id` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `typereason` int(11) NOT NULL,
  `page` bigint(20) NOT NULL,
  `typeproblem` int(11) NOT NULL,
  `date` varchar(18) NOT NULL,
  `access` int(11) NOT NULL,
  `timeout` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `help-messages`
--

CREATE TABLE `help-messages` (
  `id` bigint(20) NOT NULL,
  `idhelp` bigint(20) NOT NULL,
  `text` text NOT NULL,
  `iduser` bigint(20) NOT NULL,
  `date` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `onlinetoken`
--

CREATE TABLE `onlinetoken` (
  `id` bigint(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `time` bigint(20) NOT NULL,
  `ctime` bigint(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `redict`
--

CREATE TABLE `redict` (
  `sub` varchar(48) NOT NULL,
  `name` varchar(48) NOT NULL,
  `ownerid` int(13) NOT NULL,
  `status` int(3) NOT NULL,
  `ArtistID` text NOT NULL,
  `paytime` int(12) NOT NULL,
  `id` int(11) NOT NULL,
  `access` int(11) NOT NULL DEFAULT '0',
  `accessinfo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `trackartists`
--

CREATE TABLE `trackartists` (
  `id` int(11) NOT NULL,
  `idtrack` int(11) NOT NULL,
  `idartist` int(11) NOT NULL,
  `relizdate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tracks`
--

CREATE TABLE `tracks` (
  `sub` varchar(48) NOT NULL,
  `name` varchar(48) NOT NULL,
  `ownerid` int(13) NOT NULL,
  `ArtistName` varchar(48) NOT NULL,
  `ArtistPHP` text NOT NULL,
  `RelizName` varchar(48) NOT NULL,
  `RelizInfo` varchar(16) NOT NULL,
  `RelizTittle` text NOT NULL,
  `RelizDate` int(9) NOT NULL,
  `AppleID` int(14) NOT NULL,
  `BoomID` text NOT NULL,
  `YaID` int(14) NOT NULL,
  `VKID` varchar(120) NOT NULL,
  `GoogleID` varchar(32) NOT NULL,
  `SpotyID` varchar(24) NOT NULL,
  `DeezerID` int(12) NOT NULL,
  `GeniusID` text NOT NULL,
  `paytime` int(12) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `vkid` int(14) NOT NULL,
  `ttlid` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `name_family` varchar(32) NOT NULL,
  `typeacc` int(3) NOT NULL,
  `timetype` int(9) NOT NULL,
  `balance` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(20) NOT NULL,
  `time` bigint(20) NOT NULL,
  `PageID` int(11) NOT NULL,
  `OwnerID` int(11) NOT NULL,
  `IP` varchar(17) NOT NULL,
  `Browser` text NOT NULL,
  `REDIRECT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `visitorsbot`
--

CREATE TABLE `visitorsbot` (
  `id` bigint(20) NOT NULL,
  `time` bigint(20) NOT NULL,
  `PageID` int(11) NOT NULL,
  `OwnerID` int(11) NOT NULL,
  `IP` varchar(17) NOT NULL,
  `Browser` text NOT NULL,
  `REDIRECT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `visits`
--

CREATE TABLE `visits` (
  `id` bigint(20) NOT NULL,
  `idpage` bigint(20) NOT NULL,
  `ownerid` int(11) NOT NULL,
  `uni` bigint(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `help`
--
ALTER TABLE `help`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `help-messages`
--
ALTER TABLE `help-messages`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `onlinetoken`
--
ALTER TABLE `onlinetoken`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `redict`
--
ALTER TABLE `redict`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `trackartists`
--
ALTER TABLE `trackartists`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tracks`
--
ALTER TABLE `tracks`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `visitorsbot`
--
ALTER TABLE `visitorsbot`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `visits`
--
ALTER TABLE `visits`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `help`
--
ALTER TABLE `help`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `help-messages`
--
ALTER TABLE `help-messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `onlinetoken`
--
ALTER TABLE `onlinetoken`
  MODIFY `id` bigint(32) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `redict`
--
ALTER TABLE `redict`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `trackartists`
--
ALTER TABLE `trackartists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `visitorsbot`
--
ALTER TABLE `visitorsbot`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `visits`
--
ALTER TABLE `visits`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
