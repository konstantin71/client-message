-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.19-0ubuntu0.16.04.1 - (Ubuntu)
-- Операционная система:         Linux
-- HeidiSQL Версия:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных client_message
CREATE DATABASE IF NOT EXISTS `client_message` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `client_message`;

-- Дамп структуры для таблица client_message.api
CREATE TABLE IF NOT EXISTS `api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы client_message.api: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `api` DISABLE KEYS */;
INSERT INTO `api` (`id`, `name`) VALUES
	(5, 'facebook'),
	(4, 'skype'),
	(1, 'telegram'),
	(2, 'viber'),
	(3, 'vk');
/*!40000 ALTER TABLE `api` ENABLE KEYS */;

-- Дамп структуры для таблица client_message.browse_push
CREATE TABLE IF NOT EXISTS `browse_push` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user-browse-fk` (`user_id`),
  CONSTRAINT `user-browse-fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы client_message.browse_push: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `browse_push` DISABLE KEYS */;
/*!40000 ALTER TABLE `browse_push` ENABLE KEYS */;

-- Дамп структуры для таблица client_message.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы client_message.migration: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1521903752),
	('m180201_125243_init_migration', 1521903775),
	('m180201_141100_init_migration', 1521903775);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- Дамп структуры для таблица client_message.subscribe
CREATE TABLE IF NOT EXISTS `subscribe` (
  `api_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  KEY `api-subscribe-fk` (`api_id`),
  KEY `user-subscribe-fk` (`user_id`),
  CONSTRAINT `api-subscribe-fk` FOREIGN KEY (`api_id`) REFERENCES `api` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user-subscribe-fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы client_message.subscribe: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `subscribe` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscribe` ENABLE KEYS */;

-- Дамп структуры для таблица client_message.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `api_message_id` int(11) DEFAULT NULL,
  `push_message_id` int(11) DEFAULT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы client_message.user: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `api_message_id`, `push_message_id`, `login`, `password`) VALUES
	(1, NULL, NULL, 'user1', '1'),
	(2, NULL, NULL, 'user2', '2'),
	(3, NULL, NULL, 'user3', '3'),
	(4, NULL, NULL, 'user4', '4'),
	(5, NULL, NULL, 'admin', '5');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
