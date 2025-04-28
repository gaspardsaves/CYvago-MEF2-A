-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 27 avr. 2025 à 11:01
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zanimotrip`
--

-- --------------------------------------------------------

--
-- Structure de la table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` int NOT NULL,
  `travel` int NOT NULL,
  `departuredate` date NOT NULL,
  `nbrperson` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `engagement`
--

DROP TABLE IF EXISTS `engagement`;
CREATE TABLE IF NOT EXISTS `engagement` (
  `booking` int NOT NULL,
  `extra` int NOT NULL,
  `nbrperson` int NOT NULL,
  PRIMARY KEY (`booking`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `extra`
--

DROP TABLE IF EXISTS `extra`;
CREATE TABLE IF NOT EXISTS `extra` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stage` int NOT NULL,
  `title` varchar(250) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `extra`
--

INSERT INTO `extra` (`id`, `stage`, `title`, `price`) VALUES
(1, 1, 'Visite intérieur d\'une pyramide avec un guide', 500),
(2, 2, 'Nuit sous une Tente de luxe', 250),
(3, 3, 'Exploration des oasis', 50);

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reservation` int NOT NULL,
  `montant` float NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

DROP TABLE IF EXISTS `stage`;
CREATE TABLE IF NOT EXISTS `stage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `text` varchar(250) NOT NULL,
  `travel` int NOT NULL,
  `chronology` int NOT NULL,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `stage`
--

INSERT INTO `stage` (`id`, `text`, `travel`, `chronology`, `image`) VALUES
(1, 'Visite d\'une pyramide avec un guide ', 1, 1, 'img/trav/Pyramides-de-Gizeh.jpg'),
(2, 'Nuit sous une Tente de luxe', 1, 2, 'img/trav/nuitTenteDesert.jpg'),
(3, 'Exploration des oasis', 1, 3, 'img/trav/exploOasis.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `travel`
--

DROP TABLE IF EXISTS `travel`;
CREATE TABLE IF NOT EXISTS `travel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `text` varchar(300) NOT NULL,
  `image` varchar(250) NOT NULL,
  `price` float NOT NULL,
  `nbrdays` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `travel`
--

INSERT INTO `travel` (`id`, `title`, `text`, `image`, `price`, `nbrdays`) VALUES
(1, 'Desert', 'Partez pour une aventure inoubliable à dos de chameau à travers des paysages désertiques.', 'img/Desert.webp', 1200, 62),
(2, 'Antarctique', 'Partez à la découverte en Antarctique, où les pingouins règnent en maîtres !', 'img/Pingouin.webp', 2500, 90),
(3, 'Africa', 'Plongez au cœur de la savane africaine pour un safari inoubliable !', 'img/trav/afrique.jpg', 1800, 62),
(4, 'Costa Rica', 'Le Costa Rica vous offre une expérience unique en mer, avec des dauphins, des plages et des paysages à couper le souffle.', 'img/Dauphin3.jpg', 2200, 122),
(5, 'Chine', 'Rencontrez les pandas géants dans leur habitat naturel et explorez la culture chinoise.', 'img/Panda2.jpg', 2100, 91),
(6, 'Licorne', 'Un voyage féérique où vous vivrez une expérience magique au milieu de créatures mythiques.', 'img/Licorne.webp', 3500, 92),
(7, 'Everest', 'Escaladez les pentes de l\"Everest et explorez la légende du Yéti à travers des paysages majestueux.', 'img/Yeti.jpg', 3000, 91),
(8, 'Dragon', 'Un voyage fantastique où vous partirez à la recherche de dragons et vivrez des aventures magiques.', 'img/Dragon2.jpg', 5000, 31),
(9, 'Capybara', 'Découvrez ces animaux fascinants dans leur habitat naturel en Amérique du Sud.', 'img/Capybara.avif', 1500, 122),
(10, 'Australie', 'Aventurez-vous dans l\"outback australien et observez les kangourous en liberté.', 'img/Kangourou.jpg', 1900, 89),
(11, 'Mongolie', 'Explorez les montagnes de Mongolie, une expérience unique à dos de yak.', 'img/Yaks.jpeg', 0, 92),
(12, 'Chewbaca', 'Passez une journée inoubliable aux côtés de Chewbacca, le Wookiee légendaire', 'img/chewbacca.jpg', 1000, 200);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lastname` varchar(250) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `email`, `password`, `role`) VALUES
(1, 'Maslanka', 'Jean-Luc', 'maslankaje@cytech.fr', '$2y$12$xgNWFok2a8rNzr5VUVL.5eXNQqzphrcW/TcsWAxOvAZv9vl7uu9LS', 0),
(2, 'Saves', 'Gaspard', 'gs@gmail.com', '$2y$12$f0.ITdKMgYLplWAQX98I6e1LYRpmr9TmYMHZqiFhjKEIodgupVxoa', 0),
(3, 'Stashenko', 'Albina', 'AS@gmai.com', '$2y$12$HnniYl8JQgq05n8WuwFcreyK97YOh264tIL6Ilgaz5rN/vDQJrUrC', 1),
(4, 'Trump', 'Donald', 'DonaldTrump@gmail.com', '$2y$12$9w9V5wG/pa6REDXXFzbCDO9p/GlxzU8Cm84TGxIUX6NA3LnIrkLwG', 1),
(5, 'Banica', 'Teodor', 'TB@gmail.com', '$2y$12$3.NkSlqdQwgNM6NnJjxR3eW2d2IaGMuSfx4zAe1PjsbEa371kST/e', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
