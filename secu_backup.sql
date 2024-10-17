SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT;
SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS;
SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION;
SET NAMES utf8mb4;
SET @OLD_TIME_ZONE=@@TIME_ZONE;
SET TIME_ZONE='+00:00';
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `CB` varchar(16) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `solde` decimal(10,2) DEFAULT 0.00,
  `abonne` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `autheur` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `mynews`;
CREATE TABLE `mynews` (
  `id_utilisateur` int(11) NOT NULL,
  `id_news` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_news`),
  KEY `id_news` (`id_news`),
  CONSTRAINT `mynews_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  CONSTRAINT `mynews_ibfk_2` FOREIGN KEY (`id_news`) REFERENCES `news` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `news` WRITE;
INSERT INTO `news` VALUES
(1,'La Révolution Technologique','2024-10-05','Alice Martin','Cet article explore les dernières avancées technologiques et leur impact sur la société.','/static/images/image.webp'),
(2,'Les Enjeux de la Transition Écologique','2024-10-06','Jean Dupuis','Une analyse approfondie des défis environnementaux actuels et des solutions proposées.','/static/images/image3.webp'),
(3,'L\'Économie Mondiale en 2024','2024-10-07','Caroline Moreau','Un état des lieux de l\'économie mondiale en cette année, avec une focus sur les pays émergents.','/static/images/image2.webp'),
(4,'Sport et Santé : Les Bienfaits de l\'Activité Physique','2024-10-08','Marc Lefèvre','Découvrez comment le sport influence positivement la santé mentale et physique.','/static/images/image4.webp');
UNLOCK TABLES;

LOCK TABLES `utilisateur` WRITE;
UNLOCK TABLES;

LOCK TABLES `mynews` WRITE;
UNLOCK TABLES;

SET TIME_ZONE=@OLD_TIME_ZONE;
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT;
SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS;
SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION;
