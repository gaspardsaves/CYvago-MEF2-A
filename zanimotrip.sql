-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 04 mai 2025 à 19:55
-- Version du serveur : 8.0.41-0ubuntu0.22.04.1
-- Version de PHP : 8.1.2-1ubuntu2.21

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

CREATE TABLE `booking` (
  `id` int NOT NULL,
  `user` int NOT NULL,
  `travel` int NOT NULL,
  `departuredate` date NOT NULL,
  `nbrperson` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `engagement`
--

CREATE TABLE `engagement` (
  `booking` int NOT NULL,
  `extra` int NOT NULL,
  `nbrperson` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `extra`
--

CREATE TABLE `extra` (
  `id` int NOT NULL,
  `stage` int NOT NULL,
  `title` varchar(250) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `extra`
--

INSERT INTO `extra` (`id`, `stage`, `title`, `price`) VALUES
(1, 1, 'Visite intérieur d\'une pyramide avec un guide', 500),
(2, 2, 'Nuit sous une Tente de luxe', 250),
(3, 3, 'Exploration des oasis', 50),
(4, 4, 'Observation des pingouins.', 50),
(5, 5, 'Excursions en bateau', 450),
(6, 6, 'Visites de stations scientifiques', 150),
(7, 7, 'Safari en jeep', 650),
(8, 8, 'Visites de réserves naturelles', 75),
(9, 9, 'Nuit sous les étoiles', 150);

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

CREATE TABLE `payment` (
  `id` int NOT NULL,
  `reservation` int NOT NULL,
  `montant` float NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

CREATE TABLE `stage` (
  `id` int NOT NULL,
  `text` varchar(250) NOT NULL,
  `travel` int NOT NULL,
  `chronology` int NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `stage`
--

INSERT INTO `stage` (`id`, `text`, `travel`, `chronology`, `image`) VALUES
(1, 'Visite d\'une pyramide avec un guide ', 1, 1, 'img/trav/Pyramides-de-Gizeh.jpg'),
(2, 'Nuit sous une Tente de luxe', 1, 2, 'img/trav/nuitTenteDesert.jpg'),
(3, 'Exploration des oasis', 1, 3, 'img/trav/exploOasis.jpg'),
(4, 'Observation des pingouins.', 2, 1, 'img/trav/observationPingouin.jpg'),
(5, 'Excursions en bateau', 2, 2, 'img/trav/excursionBateau.jpg'),
(6, 'Visites de stations scientifiques', 2, 3, 'img/trav/stationScientifiques.jpeg'),
(7, 'Safari en jeep', 3, 1, 'img/trav/safariJeep.jpeg'),
(8, 'Visites de réserves naturelles', 3, 2, 'img/trav/visiteReserve.jpeg'),
(9, 'Nuit sous les étoiles', 3, 3, 'img/trav/NuitEtoile.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `travel`
--

CREATE TABLE `travel` (
  `id` int NOT NULL,
  `title` varchar(250) NOT NULL,
  `text` varchar(300) NOT NULL,
  `image` varchar(250) NOT NULL,
  `price` float NOT NULL,
  `nbrdays` int NOT NULL,
  `season` varchar(100) NOT NULL,
  `hotel` varchar(150) NOT NULL,
  `imghotel` varchar(150) NOT NULL,
  `meal` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `travel`
--

INSERT INTO `travel` (`id`, `title`, `text`, `image`, `price`, `nbrdays`, `season`, `hotel`, `imghotel`, `meal`) VALUES
(1, 'Desert', 'Partez pour une aventure inoubliable à dos de chameau à travers des paysages désertiques.', 'img/Desert.webp', 1200, 7, 'Printemps, Automne', 'Hôtel Sahara Lux', 'img/trav/HotelDesert.jpg', 'Demi-pension.'),
(2, 'Antarctique', 'Partez à la découverte en Antarctique, où les pingouins règnent en maîtres !', 'img/Pingouin.webp', 2500, 14, 'Été', 'Polar Lodge', 'img/trav/HotelAntarctique.jpg', 'Pension complète.'),
(3, 'Africa', 'Plongez au cœur de la savane africaine pour un safari inoubliable !', 'img/trav/afrique.jpg', 1800, 9, 'Printemps, Été, Automne', 'Safari Lodge', 'img/trav/HotelAfrique.jpg', 'Demi-pension.'),
(4, 'Costa Rica', 'Le Costa Rica vous offre une expérience unique en mer, avec des dauphins, des plages et des paysages à couper le souffle.', 'img/Dauphin3.jpg', 2200, 10, 'Hiver', 'EcoLodge Arenal Springs', 'img/trav/hotelCostaRica.jpeg', 'Demi-pension.'),
(5, 'Chine', 'Rencontrez les pandas géants dans leur habitat naturel et explorez la culture chinoise.', 'img/Panda2.jpg', 2100, 8, 'Printemps, Été, Automne, Hiver', 'Jade Garden Retreat', 'img/trav/HotelChine.jpeg', 'Demi-pension.'),
(6, 'Licorne', 'Un voyage féérique où vous vivrez une expérience magique au milieu de créatures mythiques.', 'img/Licorne.webp', 3500, 5, 'Printemps, Été, Automne, Hiver', 'Palais des Nuages', 'img/trav/HotelLicorne.jpeg', 'Pension complète'),
(7, 'Everest', 'Escaladez les pentes de l\"Everest et explorez la légende du Yéti à travers des paysages majestueux.', 'img/Yeti.jpg', 3000, 16, 'Printemps, Été', 'The Yeti Peak Lodge', 'img/trav/HotelEverest.jpeg', 'Pension complète.'),
(8, 'Dragon', 'Un voyage fantastique où vous partirez à la recherche de dragons et vivrez des aventures magiques.', 'img/Dragon2.jpg', 5000, 18, 'Printemps, Été, Automne, Hiver', 'Dragonfire Retreat', 'img/trav/HotelDragon.jpeg', 'Pension complète.'),
(9, 'Capybara', 'Découvrez ces animaux fascinants dans leur habitat naturel en Amérique du Sud.', 'img/Capybara.avif', 1500, 7, 'Printemps, Automne', 'Capybara Springs Resort', 'img/trav/HotelAmeriqueSud.jpeg', 'Demi-pension.'),
(10, 'Australie', 'Aventurez-vous dans l\'outback australien et observez les kangourous en liberté.', 'img/Kangourou.jpg', 1900, 10, 'Printemps, Automne', 'Outback Hop Inn', 'img/trav/HotelAustralie.jpeg', 'Demi-Pension.'),
(11, 'Mongolie', 'Explorez les montagnes de Mongolie, une expérience unique à dos de yak.', 'img/Yaks.jpeg', 2000, 20, 'Printemps, Été, Automne,', 'Yak & Peace Lodge', 'img/trav/HotelMongolie.jpeg', 'Pension complète.'),
(12, 'Chewbaca', 'Passez une journée inoubliable aux côtés de Chewbacca, le Wookiee légendaire', 'img/chewbacca.jpg', 1000, 3, 'Printemps, Été, Automne, Hiver', 'Wookiee Wilderness Retreat', 'img/trav/HotelChewbaca.jpeg', 'Demi-pension.'),
(13, 'Thaïlande ', 'Partez au cœur de la jungle de Chiang Mai pour vivre une immersion inoubliable avec les majestueux éléphants d’Asie. Vous visiterez un sanctuaire éthique où le bien-être animal est prioritaire, tout en découvrant la culture thaïlandaise et ses temples secrets.', 'img/elephants.jpeg', 2400, 10, 'Printemps, Hiver', 'Elephant Grove Retreat', 'img/trav/HotelThailande.jpeg', 'Pension complète.'),
(14, 'Finlande', 'Partez explorer la Laponie finlandaise sous les aurores boréales. Traque photographique des renards polaires, randonnée en raquettes et nuits dans des igloos de verre vous attendent. Un voyage magique pour les amoureux de nature arctique.', 'img/renards.jpeg', 3100, 6, 'Hiver', 'Aurora Fox Lodge', 'img/trav/HotelFinlande.jpeg', 'Demi-pension.'),
(15, 'Madagascar', 'Explorez les forêts tropicales de l’île Rouge à la recherche de ses caméléons uniques au monde. Ce voyage allie biodiversité, paysages spectaculaires, et rencontres avec les communautés locales.', 'img/cameleons.jpeg', 3600, 11, 'Eté, Automne', 'Chameleon Canopy Ecolodge', 'img/trav/HotelMadagascar.jpeg', 'Pension-complète.');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `email`, `password`, `role`) VALUES
(1, 'Maslanka', 'Jean-Luc', 'maslankaje@cytech.fr', '$2y$12$xgNWFok2a8rNzr5VUVL.5eXNQqzphrcW/TcsWAxOvAZv9vl7uu9LS', 0),
(2, 'Saves', 'Gaspard', 'gs@gmail.com', '$2y$12$f0.ITdKMgYLplWAQX98I6e1LYRpmr9TmYMHZqiFhjKEIodgupVxoa', 0),
(3, 'Stashenko', 'Albina', 'AS@gmai.com', '$2y$12$HnniYl8JQgq05n8WuwFcreyK97YOh264tIL6Ilgaz5rN/vDQJrUrC', 1),
(4, 'Trump', 'Donald', 'DonaldTrump@gmail.com', '$2y$12$9w9V5wG/pa6REDXXFzbCDO9p/GlxzU8Cm84TGxIUX6NA3LnIrkLwG', 1),
(5, 'Banica', 'Teodor', 'TB@gmail.com', '$2y$12$3.NkSlqdQwgNM6NnJjxR3eW2d2IaGMuSfx4zAe1PjsbEa371kST/e', 1),
(6, 'Saves', 'Gaspard', 'saves.gaspard@gmail.com', '$2y$12$YwmRB6E8DVHfMM.Qupv8CO5DeetFfbPBOE61Zcb3sw3fw4P1EqOBy', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `engagement`
--
ALTER TABLE `engagement`
  ADD PRIMARY KEY (`booking`);

--
-- Index pour la table `extra`
--
ALTER TABLE `extra`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `extra`
--
ALTER TABLE `extra`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stage`
--
ALTER TABLE `stage`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `travel`
--
ALTER TABLE `travel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
