-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 22 mai 2025 à 03:33
-- Version du serveur : 8.0.42-0ubuntu0.22.04.1
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
  `nbrperson` int NOT NULL,
  `status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `booking`
--

INSERT INTO `booking` (`id`, `user`, `travel`, `departuredate`, `nbrperson`, `status`) VALUES
(3, 6, 2, '2025-05-19', 1, ''),
(4, 6, 5, '2025-05-31', 5, ''),
(5, 6, 1, '2025-05-19', 1, ''),
(6, 6, 1, '2025-05-31', 4, ''),
(7, 6, 1, '2025-05-19', 1, ''),
(8, 6, 1, '2025-05-19', 1, ''),
(10, 6, 2, '2025-05-31', 5, ''),
(11, 6, 2, '2025-05-19', 1, ''),
(12, 6, 2, '2025-05-19', 1, ''),
(13, 6, 2, '2025-05-19', 1, ''),
(14, 6, 2, '2025-05-19', 1, ''),
(15, 6, 1, '2025-05-19', 7, ''),
(16, 6, 1, '2025-05-20', 1, ''),
(17, 6, 1, '2025-05-20', 1, ''),
(18, 6, 2, '2025-05-20', 6, ''),
(19, 6, 2, '2025-05-20', 6, ''),
(20, 6, 2, '2025-05-20', 6, ''),
(21, 6, 2, '2025-05-20', 6, ''),
(22, 6, 2, '2025-05-20', 1, ''),
(23, 6, 2, '2025-05-20', 1, ''),
(24, 6, 2, '2025-05-20', 1, ''),
(25, 6, 2, '2025-05-20', 1, ''),
(26, 6, 2, '2025-05-20', 1, ''),
(27, 6, 2, '2025-05-20', 1, ''),
(28, 6, 2, '2025-05-20', 1, ''),
(29, 6, 2, '2025-05-20', 1, ''),
(30, 6, 2, '2025-05-20', 5, ''),
(31, 6, 2, '2025-05-20', 5, ''),
(32, 6, 1, '2025-05-20', 1, ''),
(33, 6, 2, '2025-05-20', 1, ''),
(34, 6, 1, '2025-05-20', 4, ''),
(35, 6, 1, '2025-05-20', 1, ''),
(36, 6, 1, '2025-05-20', 1, ''),
(37, 6, 1, '2025-05-20', 1, ''),
(38, 6, 1, '2025-05-20', 1, ''),
(39, 6, 1, '2025-05-20', 1, ''),
(40, 6, 1, '2025-05-20', 1, ''),
(41, 6, 1, '2025-05-20', 1, ''),
(42, 6, 2, '2025-05-20', 1, NULL),
(43, 6, 2, '2025-05-20', 4, 'confirmed'),
(44, 6, 2, '2025-05-20', 1, 'confirmed'),
(45, 6, 1, '2025-05-20', 5, NULL),
(46, 6, 2, '2025-05-20', 4, 'confirmed'),
(47, 6, 3, '2025-05-20', 7, 'confirmed'),
(48, 6, 2, '2025-05-20', 1, NULL),
(49, 6, 2, '2025-05-20', 1, NULL),
(50, 6, 2, '2025-05-20', 1, NULL),
(51, 6, 2, '2025-05-20', 1, NULL),
(52, 6, 2, '2025-05-20', 1, NULL),
(53, 6, 2, '2025-05-21', 9, 'confirmed'),
(54, 6, 2, '2025-05-21', 1, NULL),
(55, 6, 2, '2025-05-21', 1, 'confirmed'),
(56, 6, 7, '2025-05-21', 1, NULL),
(57, 6, 3, '2025-05-21', 1, NULL),
(58, 6, 2, '2025-05-21', 4, 'confirmed'),
(59, 6, 2, '2025-05-21', 1, NULL),
(60, 6, 2, '2025-05-21', 2, NULL),
(61, 6, 2, '2025-05-21', 2, 'confirmed'),
(62, 6, 2, '2025-05-21', 2, 'confirmed'),
(63, 3, 2, '2025-05-21', 1, NULL),
(64, 3, 2, '2025-05-21', 1, 'confirmed'),
(65, 6, 1, '2025-05-22', 1, 'confirmed'),
(66, 6, 2, '2025-05-22', 1, 'confirmed'),
(67, 6, 1, '2025-05-22', 1, 'confirmed'),
(68, 6, 9, '2025-05-28', 3, 'confirmed'),
(69, 6, 12, '2025-05-22', 2, 'confirmed');

-- --------------------------------------------------------

--
-- Structure de la table `engagement`
--

CREATE TABLE `engagement` (
  `id` int NOT NULL,
  `booking` int NOT NULL,
  `extra` int NOT NULL,
  `nbrperson` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `engagement`
--

INSERT INTO `engagement` (`id`, `booking`, `extra`, `nbrperson`) VALUES
(8, 3, 51, 1),
(9, 3, 52, 1),
(10, 3, 6, 1),
(11, 4, 60, 4),
(12, 4, 61, 4),
(13, 4, 62, 4),
(14, 5, 48, 1),
(15, 5, 1, 1),
(16, 5, 3, 1),
(17, 6, 48, 3),
(18, 6, 2, 2),
(22, 10, 51, 3),
(23, 10, 4, 2),
(24, 10, 52, 1),
(25, 10, 53, 4),
(26, 11, 51, 1),
(27, 11, 52, 1),
(28, 11, 6, 1),
(29, 12, 53, 1),
(30, 15, 1, 4),
(31, 15, 49, 5),
(32, 15, 50, 2),
(33, 16, 49, 1),
(34, 16, 50, 1),
(35, 17, 49, 1),
(36, 17, 50, 1),
(37, 18, 51, 3),
(38, 18, 52, 4),
(39, 18, 53, 3),
(40, 19, 51, 3),
(41, 19, 52, 4),
(42, 19, 53, 3),
(43, 20, 51, 3),
(44, 20, 52, 4),
(45, 20, 53, 3),
(46, 21, 51, 3),
(47, 21, 52, 4),
(48, 21, 53, 3),
(49, 28, 51, 1),
(50, 28, 52, 1),
(51, 28, 6, 1),
(52, 29, 51, 1),
(53, 29, 52, 1),
(54, 29, 6, 1),
(55, 30, 51, 2),
(56, 30, 5, 2),
(57, 30, 6, 5),
(58, 31, 51, 2),
(59, 31, 5, 2),
(60, 31, 6, 5),
(61, 32, 1, 1),
(62, 34, 50, 4),
(63, 43, 51, 2),
(64, 43, 52, 3),
(65, 43, 6, 1),
(66, 45, 48, 3),
(67, 45, 1, 2),
(68, 47, 54, 2),
(69, 47, 7, 2),
(70, 53, 52, 4),
(71, 53, 53, 4),
(72, 57, 9, 1),
(73, 62, 53, 2),
(74, 67, 3, 1),
(75, 68, 70, 3);

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
(1, 1, 'Visite avec un guide ', 500),
(2, 2, 'Ciel ouvert avec vue sur les étoiles ', 300),
(3, 3, 'Baignade dans une source naturelle ', 75),
(4, 4, 'Accompagnement d\'un photographe animalier ', 100),
(5, 5, 'Sortie en petit zodiac pour une exploration rapprochée', 450),
(6, 6, 'Participation à une mini-expérience scientifique encadrée', 150),
(7, 7, 'Arrêts photos aux meilleurs points de vue pendant le safari', 200),
(8, 8, 'Atelier de conservation et de protection de la nature avec des experts', 75),
(9, 9, 'Observation nocturne de la faune sauvage ', 200),
(10, 10, 'Escale sur une île déserte pour un pique-nique et baignade', 200),
(11, 11, 'Observation des oiseaux migrateurs pendant l\'excursion', 100),
(12, 12, 'Randonnée à travers la forêt tropicale avec pauses pour découvrir la biodiversité', 150),
(13, 13, 'Séance photo avec les pandas', 400),
(14, 14, 'Nuit en bivouac sous les étoiles avec un guide local', 370),
(15, 15, 'Séance de yoga dans l’ambiance paisible de la forêt de bambous', 200),
(16, 16, 'Balade féerique en calèche tirée par des licornes ', 450),
(17, 17, 'Champagne à bord ', 270),
(18, 18, 'Séance de cross dans les prairies magiques', 360),
(19, 19, 'Nuit dans des lodges traditionnels Sherpa', 375),
(20, 20, 'Atelier de cuisine locale', 50),
(21, 21, 'Survol de l’Everest Base Camp depuis Katmandou', 450),
(22, 22, 'Visite guidée du temple', 260),
(23, 23, 'Exploration de grottes mystérieuses', 125),
(24, 24, 'Exploration des légendes locales avec un guide', 180),
(25, 25, 'Excursion en canoë sur les rivières sinueuses', 300),
(26, 26, 'Randonnée guidée avec un expert en écosystèmes marécageux', 175),
(27, 27, 'Guide pour observer les plantes et arbres ', 250),
(28, 28, 'Escalade d\'une montagne pour un panorama à 360°', 300),
(29, 29, 'Observation des kangourous et émeus guidée au lever du soleil', 100),
(30, 30, 'Observation des animaux nocturnes', 250),
(31, 31, 'Découverte de la culture locale avec des arrêts dans des villages traditionnels', 375),
(32, 32, 'Aider à la conduite des yaks dans les pâturages', 200),
(33, 33, 'Visite de sites historiques et culturels le long du trajet', 350),
(34, 34, 'Arrêts pour observer les célèbres cabanes Wookiee', 400),
(35, 35, 'Rencontres avec des civilisations galactiques avancées', 650),
(36, 36, 'Création de gadgets high-tech Wookiee', 150),
(37, 37, 'Collecte de feuilles et de graines pour créer un carnet de nature', 175),
(38, 38, 'Promenade avec les éléphants dans un environnement naturel', 350),
(39, 39, 'Massage doux des éléphants après la baignade', 400),
(40, 40, 'Exploration d\'autres animaux nocturnes à l’aide de la caméra thermique', 200),
(41, 41, 'Observation des constellations avec un astronome', 100),
(42, 42, 'Rencontre avec les soigneurs pour découvrir les soins apportés aux animaux', 375),
(43, 43, 'Exploration de sentiers botaniques', 75),
(44, 44, 'Arrêts baignade dans des piscines naturelles et sous des cascades', 275),
(45, 45, 'Visite guidée d’une réserve communautaire', 200),
(48, 1, 'Accès aux tombeaux', 400),
(49, 2, 'Douches et toilettes privatives', 325),
(50, 3, 'Pause sous les palmiers avec service de thé local', 60),
(51, 4, 'Visite commentée par un guide spécialiste de la faune', 150),
(52, 5, 'Balade encadrée sur la banquise', 350),
(53, 6, 'Rencontre avec des chercheurs pour échanger sur leurs travaux', 200),
(54, 7, 'Safari au lever du soleil pour une lumière magique', 300),
(55, 8, 'Guide spécialisé dans la faune et la flore de la région', 250),
(56, 9, 'Veillée autour d’un feu de camp avec musique locale', 250),
(57, 10, 'Bateau à fond transparent pour observer les fonds marin', 150),
(58, 11, 'Arrêt pour un cocktail sur une plage isolée au coucher du soleil', 140),
(59, 12, 'Randonnée au lever du soleil pour admirer les premières lueurs sur les volcans', 180),
(60, 13, 'Visite des installations où les pandas sont élevés ', 300),
(61, 14, 'Arrêts photo pour capturer les paysages', 150),
(62, 15, 'Observation des oiseaux et autres animaux vivant dans la forêt de bambous', 250),
(63, 16, 'Séance photo avec les licornes sauvages  ', 500),
(64, 17, 'Vol au lever du soleil ', 330),
(65, 18, 'Séance de dressage sur les meilleures licornes du pays', 400),
(66, 19, 'Repas traditionnels Sherpa lors des pauses', 225),
(67, 22, 'Initiation aux rituels magiques du temple ', 350),
(68, 23, 'Découverte de la faune et de la flore de la vallée', 165),
(69, 24, 'Arrêts photo aux endroits où les dragons apparaissent ', 200),
(70, 25, 'Safari nocturne pour observer la faune active la nuit', 500),
(71, 26, 'Utilisation de jumelles et de télescopes pour observer les oiseaux et animaux distants', 100),
(72, 27, 'Séance photo dans les paysages spectaculaires de la jungle', 150),
(73, 28, 'Observation des plantes endémiques et des arbres anciens', 180),
(74, 29, 'Pause café ou thé avec un petit déjeuner léger au milieu de la nature', 80),
(75, 30, 'Séance de méditation sous les étoiles pour se reconnecter avec la nature', 200),
(76, 31, 'Exploration de lacs glaciaires ou de rivières de montagne', 315),
(77, 32, 'Participation à des soirées autour du feu', 150),
(78, 33, 'Séance photo au coucher du soleil', 275),
(79, 34, 'Excursion en speederbike pour une exploration rapide et palpitante', 500),
(80, 35, 'Initiation au pilotage du vaisseau', 550),
(81, 36, 'Customisation de pièces mécaniques', 100),
(82, 37, 'Séance de méditation avec les bruits de la nature ', 200),
(83, 38, 'Participation à la préparation des repas pour les éléphants', 350),
(84, 39, 'Séance photo avec les éléphants dans la rivière ', 300),
(85, 40, 'Pause dans un abri pour observer les renards de plus près', 250),
(86, 41, 'Pause autour d\'un feu de camp en pleine forêt enneigée', 170),
(87, 42, 'Observation des animaux en cours de rémission depuis des plateformes discrètes', 315),
(88, 43, 'Observation des indris avec un guide', 180),
(89, 44, 'Nuit en bivouac sur une plage de sable au bord du fleuve', 400),
(90, 45, 'Excursion d’observation des baleines avec un guide spécialisé', 475),
(91, 21, 'Excursion en hélicoptère vers le Annapurna Base Camp', 350),
(92, 20, 'En présence de chanteurs et de musiciens traditionnels', 50);

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

CREATE TABLE `payment` (
  `id` int NOT NULL,
  `reservation` int NOT NULL,
  `montant` float NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `payment`
--

INSERT INTO `payment` (`id`, `reservation`, `montant`, `date`, `status`) VALUES
(1, 41, 1200, '2025-05-20 09:49:41', 'accepted'),
(2, 43, 11500, '2025-05-20 09:59:17', 'accepted'),
(3, 44, 2500, '2025-05-20 10:01:33', 'accepted'),
(4, 45, 8200, '2025-05-20 23:00:32', 'denied'),
(5, 46, 10000, '2025-05-20 23:21:51', 'accepted'),
(6, 47, 13600, '2025-05-20 23:29:19', 'accepted'),
(7, 53, 24700, '2025-05-21 13:35:48', 'accepted'),
(8, 53, 24700, '2025-05-21 13:48:32', 'accepted'),
(9, 55, 2500, '2025-05-21 13:50:13', 'accepted'),
(10, 56, 3000, '2025-05-21 14:06:52', 'denied'),
(11, 58, 10000, '2025-05-21 16:36:48', 'accepted'),
(12, 59, 2500, '2025-05-21 16:37:53', 'denied'),
(13, 61, 4850, '2025-05-21 23:12:50', 'accepted'),
(14, 62, 5238, '2025-05-21 23:14:54', 'accepted'),
(15, 64, 2500, '2025-05-21 23:25:30', 'accepted'),
(16, 65, 1164, '2025-05-22 00:09:42', 'accepted'),
(17, 66, 2425, '2025-05-22 00:51:03', 'accepted'),
(18, 67, 1236.75, '2025-05-22 01:15:19', 'accepted'),
(19, 68, 5820, '2025-05-22 01:44:13', 'accepted'),
(20, 68, 5820, '2025-05-22 01:44:25', 'denied'),
(21, 68, 0, '2025-05-22 02:08:51', 'accepted'),
(22, 69, 1940, '2025-05-22 02:18:39', 'denied'),
(23, 69, 1940, '2025-05-22 02:27:37', 'accepted');

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
(1, 'Visite d\'une pyramide', 1, 1, 'img/trav/Pyramides-de-Gizeh.jpg'),
(2, 'Nuit sous une tente de luxe', 1, 2, 'img/trav/nuitTenteDesert.jpg'),
(3, 'Exploration des oasis', 1, 3, 'img/trav/exploOasis.jpg'),
(4, 'Observation des pingouins', 2, 1, 'img/trav/observationPingouin.jpg'),
(5, 'Excursions en bateau', 2, 2, 'img/trav/excursionBateau.jpg'),
(6, 'Visites de stations scientifiques', 2, 3, 'img/trav/stationScientifiques.jpeg'),
(7, 'Safari en jeep', 3, 1, 'img/trav/safariJeep.jpeg'),
(8, 'Visites de réserves naturelles', 3, 2, 'img/trav/visiteReserve.jpeg'),
(9, 'Nuit sous les étoiles', 3, 3, 'img/trav/NuitEtoile.jpeg'),
(10, 'Excursion en bateau et snorkeling', 4, 1, 'img/trav/excursionBateau.jpeg'),
(11, 'Kayak au coucher du soleil', 4, 2, 'img/trav/Kayak.jpeg'),
(12, 'Randonnée et observation depuis la montagne', 4, 3, 'img/trav/rando.jpeg'),
(13, 'Visite du Centre de Recherche de Chengdu', 5, 1, 'img/trav/CentreChengdu.jpeg'),
(14, 'Randonnée dans la montagne de Qinling', 5, 2, 'img/trav/randoChine.jpeg'),
(15, 'Promenade en forêt de bambous ', 5, 3, 'img/trav/foretBambous.jpeg'),
(16, 'Safari magique en forêt enchantée  ', 6, 1, 'img/trav/foretMagique.jpeg'),
(17, 'Vol en montgolfière au-dessus des prairies arc-en-ciel ', 6, 2, 'img/trav/montgolfiere.jpeg'),
(18, 'Équitation avec les licornes', 6, 3, 'img/trav/EquitationLicorne.jpeg'),
(19, 'Trekking au Mont Everest avec un guide Sherpa', 7, 1, 'img/trav/trekkingEverest.jpeg'),
(20, 'Veillée autour du feu', 7, 2, 'img/trav/veilleeFeu.jpeg'),
(21, 'Excursion en hélicoptère', 7, 3, 'img/trav/helicoEverest.jpeg'),
(22, 'Exploration du Temple du Dragon', 8, 1, 'img/trav/TempleDragon.jpeg'),
(23, 'Randonnée dans la Vallée des Dragons', 8, 2, 'img/trav/ValleeDragon.jpeg'),
(24, 'Croisière sur la rivière des Dragons', 8, 3, 'img/trav/riviereDragons.jpeg'),
(25, 'Safari au cœur de la jungle amazonienne', 9, 1, 'img/trav/JungleAmazonienne.jpeg'),
(26, 'Randonnée à travers les marais', 9, 2, 'img/trav/maraisAmazonie.jpeg'),
(27, 'Visite de réserves naturelles ', 9, 3, 'img/trav/reserveAmazonie.jpeg'),
(28, 'Safari dans le parc national de Grampians', 10, 1, 'img/trav/safariAustralie.jpeg'),
(29, 'Promenade au lever du soleil', 10, 2, 'img/trav/promenadeleversoleil.jpeg'),
(30, 'Nuit sous les étoiles en camping à Kangaroo Island ', 10, 3, 'img/trav/campingAustralie.jpeg'),
(31, 'Trek dans les montagnes de l\'Altaï', 11, 1, 'img/trav/trekAltai.jpeg'),
(32, 'Séjour nomade avec les éleveurs de yaks', 11, 2, 'img/trav/eleveursYaks.jpeg'),
(33, 'Voyage en chameau à travers le désert de Gobi', 11, 3, 'img/trav/desertGobi.jpeg'),
(34, 'Aventure dans la forêt de Wookiee', 12, 1, 'img/trav/foretWookie.jpeg'),
(35, 'Voyage en vaisseau spatial à travers la galaxie', 12, 2, 'img/trav/VaisseauSpatial.jpeg'),
(36, 'Atelier de fabrication d’armes et de gadgets Wookiee', 12, 3, 'img/trav/FabricationArmes.jpeg'),
(37, 'Safari au parc national de Khao Yai', 13, 1, 'img/trav/SafariKhaiYai.jpeg'),
(38, 'Séjour dans un sanctuaire d’éléphants', 13, 2, 'img/trav/SanctuaireElephants.jpeg'),
(39, 'Baignade avec les éléphants dans la rivière de Chiang Mai', 13, 3, 'img/trav/BaignadeElephants.jpeg'),
(40, 'Observation des renards à la caméra thermique', 14, 1, 'img/trav/observationRenards.jpeg'),
(41, 'Randonnée au crépuscule dans les forêts enneigées', 14, 2, 'img/trav/randoFinlande.jpeg'),
(42, 'Visite d’un centre de soins de la faune nordique', 14, 3, 'img/trav/centreFinlande.jpeg'),
(43, 'Randonnée dans le parc national d\'Andasibe-Mantadia ', 15, 1, 'img/trav/randoMada.jpeg'),
(44, 'Croisière sur le fleuve Tsiribihina', 15, 2, 'img/trav/croisiereMada.jpeg'),
(45, 'Visite des réserves naturelles de l\'île Sainte-Marie', 15, 3, 'img/trav/reserveMada.jpeg');

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
  `role` tinyint NOT NULL,
  `birth` date DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `email`, `password`, `role`, `birth`, `phone`) VALUES
(1, 'Maslanka', 'Jean-Luc', 'maslankaje@cy-tech.fr', '$2y$12$otC4EkyMoO/sywmjh.oUbOHEMDE511P0X.9f6Ugn7nfA3tM1UKJpO', 0, NULL, NULL),
(2, 'Savès', 'Gaspard', 'gs@gmail.com', '$2y$12$znAisyEpXVR.nlRDqsBZLe98zmMwE2azXRMkIidU9/kPu8ogYyGKu', 0, NULL, NULL),
(3, 'Stashenko', 'Albina', 'as@gmail.com', '$2y$12$OHaYsiFPiikxZ/IZxkFJouC0WPpldAvIGnOjto0grzoO0fpZ4xwA.', 1, NULL, NULL),
(4, 'Trump', 'Donald', 'dt@gmail.com', '$2y$12$jrcXb9CRjwZxDJHVhn8S2u4AhrBJa0uldaKoSPkfmJAIfcFAgqXJi', 1, NULL, NULL),
(5, 'Banica', 'Teodor', 'tb@gmail.com', '$2y$12$yRthDqmUcgjhl0tNSJkv6.n4p5Kl2DcNRGLvXlusIqfkU9J8djsv2', 1, NULL, NULL),
(6, 'Savès', 'Gaspard', 'saves.gaspard@gmail.com', '$2y$12$GOIGxcw8hYNsQWRrq5PQf.mF2MTdahNRKODH3XelIYFXVdxfdoei2', 2, NULL, NULL),
(8, 'Vasilyev', 'Ioann', 'iv@gmail.com', '$2y$12$PjZ2gRYOdweRP2SnuEsLEOz1iX4ai1c0XMkSp/cCxD37/1cu/A7bq', 1, '1986-12-12', '0569584359');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT pour la table `engagement`
--
ALTER TABLE `engagement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `extra`
--
ALTER TABLE `extra`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT pour la table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `stage`
--
ALTER TABLE `stage`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `travel`
--
ALTER TABLE `travel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
