-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 13 mai 2025 à 15:37
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
(1, 1, 'Visite avec un guide ', 500),
(2, 2, 'Ciel ouvert avec vue sur les étoiles ', 300),
(3, 3, 'baignade dans une source naturelle ', 75),
(4, 4, 'Accompagnement d\'un photographe animalier ', 100),
(5, 5, 'Sortie en petit zodiac pour une exploration rapprochée', 450),
(6, 6, 'Participation à une mini-expérience scientifique encadrée', 150),
(7, 7, 'Arrêts photos aux meilleurs points de vue pendant le safari', 200),
(8, 8, 'Atelier de conservation et de protection de la nature avec des experts', 75),
(9, 9, 'Observation nocturne de la faune sauvage ', 200),
(10, 10, 'Escale sur une île déserte pour un pique-nique et baignade', 200),
(11, 11, 'Observation des oiseaux migrateurs pendant l\'excursion', 100),
(12, 12, 'Randonnée à travers la forêt tropicale avec pauses pour découvrir la biodiversité', 150),
(13, 13, 'Séance photo avec un guide expert pour observer les pandas de près', 400),
(14, 14, ' Nuit en bivouac sous les étoiles avec un guide local', 370),
(15, 15, 'Séance de yoga dans l’ambiance paisible de la forêt de bambous', 200),
(16, 16, 'Balade féerique en calèche tirée par des licornes ', 450),
(17, 17, 'Champagne à bord ', 270),
(18, 18, 'Séance de cross dans les prairies magiques', 360),
(19, 19, 'Nuit dans des lodges traditionnels Sherpa', 375),
(20, 20, 'Veillée autour du feu avec les légendes de l’Himalaya', 50),
(21, 21, 'Excursion en hélicoptère au-dessus de l\'Everest', 450),
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
(34, 34, ' arrêts pour observer les célèbres cabanes Wookiee', 400),
(35, 35, 'Rencontres avec des civilisations galactiques avancées', 650),
(36, 36, 'Création de gadgets high-tech Wookiee', 150),
(37, 37, 'Collecte de feuilles et de graines pour créer un carnet de nature', 175),
(38, 38, 'Promenade avec les éléphants dans un environnement naturel', 350),
(39, 39, 'Massage doux des éléphants après la baignade', 400),
(40, 40, 'Exploration d\'autres animaux nocturnes à l’aide de la caméra thermique', 200),
(41, 41, 'Observation des constellations avec un guide', 100),
(42, 42, 'Rencontre avec les soigneurs pour découvrir les soins apportés aux animaux', 375),
(43, 43, 'Exploration de sentiers botaniques', 75),
(44, 44, 'Arrêts baignade dans des piscines naturelles et sous des cascades', 275),
(45, 45, 'Visite guidée d’une réserve communautaire', 200),
(48, 1, 'accès aux tombeaux', 400),
(49, 2, 'douches et toilettes privatives', 325),
(50, 3, 'pause sous les palmiers avec service de thé local', 60),
(51, 4, 'Visite commentée par un guide spécialiste de la faune', 150),
(52, 5, 'Balade encadrée sur la banquise depuis le bateau', 350),
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
(87, 42, 'Observation des animaux en cours de réhabilitation depuis des plateformes discrètes', 315),
(88, 43, 'Observation des indris avec un guide', 180),
(89, 44, ' Nuit en bivouac sur une plage de sable au bord du fleuve', 400),
(90, 45, 'Excursion d’observation des baleines avec un guide spécialisé', 475);

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
(20, 'Veillée autour du feu avec les légendes de l’Himalaya', 7, 2, 'img/trav/veilleeFeu.jpeg'),
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
(42, 'Visite d’un centre de réhabilitation de la faune nordique', 14, 3, 'img/trav/centreFinlande.jpeg'),
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT pour la table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
