-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 03 2025 г., 13:27
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `web`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `resource_name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `publication_date` date NOT NULL,
  `release_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `author_name`, `resource_name`, `link`, `publication_date`, `release_id`) VALUES
(1, 'danil-pavlov', 'What\'s new in Kotlin 2.1.0', 'https://kotlinlang.org/docs/whatsnew21.html', '2024-12-19', 1),
(3, 'Quattro8', 'What\'s new in Kotlin 1.8.0', 'https://kotlinlang.org/docs/whatsnew18.html', '2024-09-25', 6),
(4, 'sarahhaggarty', 'What\'s new in Kotlin 2.0.20', 'https://kotlinlang.org/docs/whatsnew2020.html', '2024-10-29', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `releases`
--

CREATE TABLE `releases` (
  `id` int(11) NOT NULL,
  `release_date` date NOT NULL COMMENT 'Release Date',
  `code` varchar(45) NOT NULL COMMENT 'Code of release',
  `description` text NOT NULL COMMENT 'Description',
  `type` varchar(10) NOT NULL COMMENT 'Type'
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Дамп данных таблицы `releases`
--

INSERT INTO `releases` (`id`, `release_date`, `code`, `description`, `type`) VALUES
(1, '2024-11-27', '2.1.0', 'A language release introducing new language featuress.', 'language'),
(4, '2024-05-21', '2.0.0', 'A language release with the Stable Kotlin K2 compiler.', 'language'),
(6, '2022-12-28', '1.8.0', 'A feature release with improved kotlin-reflect performance, new recursively copy or delete directory content experimental functions for JVM, improved Objective-C/Swift interoperability.', 'feature'),
(7, '2024-10-10', '2.0.21', 'A bug fix release for Kotlin 2.0.20', 'bugfix'),
(8, '2024-08-22', '2.0.20', 'A tooling release for Kotlin 2.0.0 containing performance improvements and bug fixes. Features also include concurrent marking in Kotlin/Native\'s garbage collector, UUID support in Kotlin common standard library, Compose compiler updates, and support up to Gradle 8.8.', 'tooling');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `release_id` (`release_id`);

--
-- Индексы таблицы `releases`
--
ALTER TABLE `releases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_idx` (`code`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `releases`
--
ALTER TABLE `releases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`release_id`) REFERENCES `releases` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
