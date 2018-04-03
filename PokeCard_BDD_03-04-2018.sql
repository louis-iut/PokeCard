# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Hôte: 127.0.0.1 (MySQL 5.6.35)
# Base de données: pokecard
# Temps de génération: 2018-04-03 19:05:53 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table exchange
# ------------------------------------------------------------

DROP TABLE IF EXISTS `exchange`;

CREATE TABLE `exchange` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `firstPokemonID` int(11) DEFAULT NULL,
  `secondPokemonID` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `exchange` WRITE;
/*!40000 ALTER TABLE `exchange` DISABLE KEYS */;

INSERT INTO `exchange` (`id`, `userID`, `firstPokemonID`, `secondPokemonID`, `date`)
VALUES
	(1,5,1,2,'2018-03-09'),
	(2,5,1,2,'2018-03-09'),
	(3,5,1,2,'2018-03-09'),
	(4,5,1,2,'2018-03-09'),
	(5,12345678,1,6,NULL),
	(6,11,4,6,'2018-03-09');

/*!40000 ALTER TABLE `exchange` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `facebook_id` varchar(20) NOT NULL DEFAULT '',
  `pseudo` varchar(50) NOT NULL DEFAULT '',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `facebook_id` (`facebook_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`facebook_id`, `pseudo`, `id`)
VALUES
	('1','allo',3),
	('12','alloa',5),
	('13','alloaa',6),
	('2147483647','plop',7),
	('568811910118584','plopp',11),
	('11111','plopppp',19),
	('1234567890','AZERTYUIK',20),
	('106725906827895','JeanMichelTest',30);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table User_Pokemon_Association
# ------------------------------------------------------------

DROP TABLE IF EXISTS `User_Pokemon_Association`;

CREATE TABLE `User_Pokemon_Association` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pokemon_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `User_Pokemon_Association` WRITE;
/*!40000 ALTER TABLE `User_Pokemon_Association` DISABLE KEYS */;

INSERT INTO `User_Pokemon_Association` (`id`, `user_id`, `pokemon_id`)
VALUES
	(5,3,2147483647),
	(30,3,600),
	(31,3,2),
	(32,3,67),
	(33,20,98),
	(55,30,709),
	(56,30,413),
	(57,30,360),
	(58,30,315),
	(59,30,28),
	(60,30,232),
	(61,30,245),
	(62,30,480),
	(63,30,429),
	(64,30,330);

/*!40000 ALTER TABLE `User_Pokemon_Association` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
