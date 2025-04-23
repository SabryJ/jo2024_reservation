-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 23 avr. 2025 à 11:48
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jo2024`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `billet`
--

CREATE TABLE `billet` (
  `id_billet` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `statut` varchar(20) DEFAULT NULL,
  `id_sport` int(11) DEFAULT NULL,
  `id_offre` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_poste` int(11) DEFAULT NULL,
  `id_utilisateur_paiement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `billet`
--

INSERT INTO `billet` (`id_billet`, `date`, `reference`, `statut`, `id_sport`, `id_offre`, `id_utilisateur`, `id_poste`, `id_utilisateur_paiement`) VALUES
(1, '2025-04-22', '2b47860de4a7201166ddd45e9c98d71a-6173', 'payé', 1, 2, 5, NULL, 1),
(2, '2025-04-22', '2b47860de4a7201166ddd45e9c98d71a-7080', 'payé', 1, 2, 5, NULL, 2),
(3, '2025-04-22', '2b47860de4a7201166ddd45e9c98d71a-5883', 'payé', 1, 2, 5, NULL, 3),
(4, '2025-04-22', '2b47860de4a7201166ddd45e9c98d71a-3200', 'payé', 1, 2, 5, NULL, 4),
(5, '2025-04-22', '2b47860de4a7201166ddd45e9c98d71a-2608', 'payé', 1, 2, 5, NULL, 5),
(6, '2025-04-22', '2b47860de4a7201166ddd45e9c98d71a-7614', 'payé', 1, 2, 5, NULL, 6),
(7, '2025-04-22', '2b47860de4a7201166ddd45e9c98d71a-8935', 'payé', 1, 2, 5, NULL, 7),
(8, '2025-04-22', '2b47860de4a7201166ddd45e9c98d71a-7735', 'payé', 1, 2, 5, NULL, 8),
(9, '2025-04-22', '2b47860de4a7201166ddd45e9c98d71a-3394', 'payé', 1, 2, 5, NULL, 9),
(10, '2025-04-23', '2b47860de4a7201166ddd45e9c98d71a-4034', 'payé', 1, 2, 5, NULL, 10),
(11, '2025-04-23', '2b47860de4a7201166ddd45e9c98d71a-1651', 'payé', 1, 2, 5, NULL, 11),
(12, '2025-04-23', '2b47860de4a7201166ddd45e9c98d71a-1454', 'payé', 1, 2, 5, NULL, 12);

-- --------------------------------------------------------

--
-- Structure de la table `cle_paiement`
--

CREATE TABLE `cle_paiement` (
  `id_cle_paiement` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_paiement` int(11) DEFAULT NULL,
  `cle_valeur` varchar(255) DEFAULT NULL,
  `cle_finale` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cle_paiement`
--

INSERT INTO `cle_paiement` (`id_cle_paiement`, `id_utilisateur`, `id_paiement`, `cle_valeur`, `cle_finale`) VALUES
(1, 5, 1, '6173', '2b47860de4a7201166ddd45e9c98d71a-6173'),
(2, 5, 2, '7080', '2b47860de4a7201166ddd45e9c98d71a-7080'),
(3, 5, 3, '5883', '2b47860de4a7201166ddd45e9c98d71a-5883'),
(4, 5, 4, '3200', '2b47860de4a7201166ddd45e9c98d71a-3200'),
(5, 5, 5, '2608', '2b47860de4a7201166ddd45e9c98d71a-2608'),
(6, 5, 6, '7614', '2b47860de4a7201166ddd45e9c98d71a-7614'),
(7, 5, 7, '8935', '2b47860de4a7201166ddd45e9c98d71a-8935'),
(8, 5, 8, '7735', '2b47860de4a7201166ddd45e9c98d71a-7735'),
(9, 5, 9, '3394', '2b47860de4a7201166ddd45e9c98d71a-3394'),
(10, 5, 10, '4034', '2b47860de4a7201166ddd45e9c98d71a-4034'),
(11, 5, 11, '1651', '2b47860de4a7201166ddd45e9c98d71a-1651'),
(12, 5, 12, '1454', '2b47860de4a7201166ddd45e9c98d71a-1454');

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

CREATE TABLE `offre` (
  `id_offre` int(11) NOT NULL,
  `nom_offre` varchar(50) DEFAULT NULL,
  `description_offre` text DEFAULT NULL,
  `prix_offre` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `offre`
--

INSERT INTO `offre` (`id_offre`, `nom_offre`, `description_offre`, `prix_offre`) VALUES
(1, 'Solo', 'Accès pour une personne à un événement sportif des JO 2024', 23.99),
(2, 'Duo', 'Accès pour deux personnes à un événement sportif des JO 2024', 49.99),
(3, 'Familiale', 'Accès pour une famille (jusqu’à 5 personnes) à un événement sportif des JO 2024', 123.99);

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_paiement` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `montant_total` decimal(10,2) DEFAULT NULL,
  `timestamp_paiement` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id_paiement`, `id_utilisateur`, `montant_total`, `timestamp_paiement`) VALUES
(1, 5, 49.99, '2025-04-22 18:35:59'),
(2, 5, 49.99, '2025-04-22 19:45:07'),
(3, 5, 49.99, '2025-04-22 19:54:31'),
(4, 5, 49.99, '2025-04-22 19:58:25'),
(5, 5, 49.99, '2025-04-22 20:23:29'),
(6, 5, 49.99, '2025-04-22 20:38:24'),
(7, 5, 49.99, '2025-04-22 20:38:38'),
(8, 5, 49.99, '2025-04-22 20:46:20'),
(9, 5, 49.99, '2025-04-22 21:10:15'),
(10, 5, 49.99, '2025-04-23 07:09:59'),
(11, 5, 49.99, '2025-04-23 07:13:52'),
(12, 5, 49.99, '2025-04-23 07:17:29');

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

CREATE TABLE `poste` (
  `id_poste` int(11) NOT NULL,
  `numero_poste` int(11) DEFAULT NULL,
  `categorie_poste` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `poste`
--

INSERT INTO `poste` (`id_poste`, `numero_poste`, `categorie_poste`) VALUES
(1, 1, 'A'),
(2, 2, 'A'),
(3, 3, 'A'),
(4, 4, 'A'),
(5, 5, 'A'),
(6, 6, 'A'),
(7, 7, 'A'),
(8, 8, 'A'),
(9, 9, 'A'),
(10, 10, 'A'),
(11, 1, 'B'),
(12, 2, 'B'),
(13, 3, 'B'),
(14, 4, 'B'),
(15, 5, 'B'),
(16, 6, 'B'),
(17, 7, 'B'),
(18, 8, 'B'),
(19, 9, 'B'),
(20, 10, 'B'),
(21, 1, 'C'),
(22, 2, 'C'),
(23, 3, 'C'),
(24, 4, 'C'),
(25, 5, 'C'),
(26, 6, 'C'),
(27, 7, 'C'),
(28, 8, 'C'),
(29, 9, 'C'),
(30, 10, 'C'),
(31, 1, 'D'),
(32, 2, 'D'),
(33, 3, 'D'),
(34, 4, 'D'),
(35, 5, 'D'),
(36, 6, 'D'),
(37, 7, 'D'),
(38, 8, 'D'),
(39, 9, 'D'),
(40, 10, 'D'),
(41, 1, 'E'),
(42, 2, 'E'),
(43, 3, 'E'),
(44, 4, 'E'),
(45, 5, 'E'),
(46, 6, 'E'),
(47, 7, 'E'),
(48, 8, 'E'),
(49, 9, 'E'),
(50, 10, 'E');

-- --------------------------------------------------------

--
-- Structure de la table `sport`
--

CREATE TABLE `sport` (
  `id_sport` int(11) NOT NULL,
  `nom_sport` varchar(50) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `lieu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sport`
--

INSERT INTO `sport` (`id_sport`, `nom_sport`, `image_url`, `lieu`) VALUES
(1, 'Escrime', 'fencing.jpg', 'Stade Pierre-Mauroy'),
(2, 'Judo', 'judo.jpg', 'Accor Arena'),
(3, 'Gymnastique artistique', 'artisticgymnastics.jpg', 'Aréna Paris Sud'),
(4, 'Tennis', 'tennis.jpg', 'Roland-Garros'),
(5, 'Basketball', 'basketball1.jpg', 'Stade Jean-Bouin'),
(6, 'Football', 'soccer.jpg', 'Parc des Princes'),
(7, 'Rugby', 'football.jpg', 'Stade de France'),
(8, 'Natation', 'swimming.jpg', 'Centre aquatique de Saint-Denis'),
(9, 'Athlétisme', 'athletics.jpg', 'Stade Charléty');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nom_utilisateur` varchar(50) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `cle_authentification` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `email`, `nom_utilisateur`, `mot_de_passe`, `cle_authentification`, `is_active`) VALUES
(5, 'Sabrine', 'Jabbouj', 'senorasabrine@outlook.fr', 'sabrine_senora', '$2y$10$LYPcrXwIm5p.70tlZHREMOy11KIVIdStSFv6R3s1UHg.o6cPLk5V6', '2b47860de4a7201166ddd45e9c98d71a', 0),
(6, 'Sabrine', 'Jabbouj', 'senorasabrinee@outlook.fr', 'sabrinesenora649', '$2y$10$YgyDY.UwXMgnx5oE1s6IaOvdY8.t4TJcjLRlphugtPhWmU.TuSg4W', '6500083eb1cdeb78a036f3f172598aea', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_paiement`
--

CREATE TABLE `utilisateur_paiement` (
  `id_utilisateur_paiement` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_paiement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur_paiement`
--

INSERT INTO `utilisateur_paiement` (`id_utilisateur_paiement`, `id_utilisateur`, `id_paiement`) VALUES
(1, 5, 1),
(2, 5, 2),
(3, 5, 3),
(4, 5, 4),
(5, 5, 5),
(6, 5, 6),
(7, 5, 7),
(8, 5, 8),
(9, 5, 9),
(10, 5, 10),
(11, 5, 11),
(12, 5, 12);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_billet_detail`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_billet_detail` (
`id_billet` int(11)
,`reference` varchar(50)
,`statut` varchar(20)
,`date_billet` date
,`nom_utilisateur` varchar(50)
,`prenom_utilisateur` varchar(50)
,`email` varchar(100)
,`nom_offre` varchar(50)
,`description_offre` text
,`prix_offre` decimal(10,2)
,`nom_sport` varchar(50)
,`lieu` varchar(100)
,`image_url` varchar(255)
,`timestamp_paiement` timestamp
,`cle_valeur` varchar(255)
,`cle_finale` varchar(512)
,`numero_poste` int(11)
,`categorie_poste` char(1)
);

-- --------------------------------------------------------

--
-- Structure de la vue `vue_billet_detail`
--
DROP TABLE IF EXISTS `vue_billet_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_billet_detail`  AS SELECT `b`.`id_billet` AS `id_billet`, `b`.`reference` AS `reference`, `b`.`statut` AS `statut`, `b`.`date` AS `date_billet`, `u`.`nom` AS `nom_utilisateur`, `u`.`prenom` AS `prenom_utilisateur`, `u`.`email` AS `email`, `o`.`nom_offre` AS `nom_offre`, `o`.`description_offre` AS `description_offre`, `o`.`prix_offre` AS `prix_offre`, `s`.`nom_sport` AS `nom_sport`, `s`.`lieu` AS `lieu`, `s`.`image_url` AS `image_url`, `p`.`timestamp_paiement` AS `timestamp_paiement`, `cp`.`cle_valeur` AS `cle_valeur`, `cp`.`cle_finale` AS `cle_finale`, `po`.`numero_poste` AS `numero_poste`, `po`.`categorie_poste` AS `categorie_poste` FROM (((((((`billet` `b` join `utilisateur` `u` on(`b`.`id_utilisateur` = `u`.`id_utilisateur`)) join `offre` `o` on(`b`.`id_offre` = `o`.`id_offre`)) join `sport` `s` on(`b`.`id_sport` = `s`.`id_sport`)) join `utilisateur_paiement` `up` on(`b`.`id_utilisateur_paiement` = `up`.`id_utilisateur_paiement`)) join `paiement` `p` on(`up`.`id_paiement` = `p`.`id_paiement`)) join `cle_paiement` `cp` on(`cp`.`id_paiement` = `p`.`id_paiement`)) join `poste` `po` on(`b`.`id_poste` = `po`.`id_poste`)) ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Index pour la table `billet`
--
ALTER TABLE `billet`
  ADD PRIMARY KEY (`id_billet`),
  ADD KEY `id_sport` (`id_sport`),
  ADD KEY `id_offre` (`id_offre`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_poste` (`id_poste`),
  ADD KEY `id_utilisateur_paiement` (`id_utilisateur_paiement`);

--
-- Index pour la table `cle_paiement`
--
ALTER TABLE `cle_paiement`
  ADD PRIMARY KEY (`id_cle_paiement`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_paiement` (`id_paiement`);

--
-- Index pour la table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`id_offre`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id_paiement`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `poste`
--
ALTER TABLE `poste`
  ADD PRIMARY KEY (`id_poste`);

--
-- Index pour la table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`id_sport`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nom_utilisateur` (`nom_utilisateur`),
  ADD UNIQUE KEY `cle_authentification` (`cle_authentification`);

--
-- Index pour la table `utilisateur_paiement`
--
ALTER TABLE `utilisateur_paiement`
  ADD PRIMARY KEY (`id_utilisateur_paiement`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_paiement` (`id_paiement`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `billet`
--
ALTER TABLE `billet`
  MODIFY `id_billet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `cle_paiement`
--
ALTER TABLE `cle_paiement`
  MODIFY `id_cle_paiement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `offre`
--
ALTER TABLE `offre`
  MODIFY `id_offre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id_paiement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `poste`
--
ALTER TABLE `poste`
  MODIFY `id_poste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `sport`
--
ALTER TABLE `sport`
  MODIFY `id_sport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `utilisateur_paiement`
--
ALTER TABLE `utilisateur_paiement`
  MODIFY `id_utilisateur_paiement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `billet`
--
ALTER TABLE `billet`
  ADD CONSTRAINT `billet_ibfk_1` FOREIGN KEY (`id_sport`) REFERENCES `sport` (`id_sport`),
  ADD CONSTRAINT `billet_ibfk_2` FOREIGN KEY (`id_offre`) REFERENCES `offre` (`id_offre`),
  ADD CONSTRAINT `billet_ibfk_3` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `billet_ibfk_4` FOREIGN KEY (`id_poste`) REFERENCES `poste` (`id_poste`),
  ADD CONSTRAINT `billet_ibfk_5` FOREIGN KEY (`id_utilisateur_paiement`) REFERENCES `utilisateur_paiement` (`id_utilisateur_paiement`);

--
-- Contraintes pour la table `cle_paiement`
--
ALTER TABLE `cle_paiement`
  ADD CONSTRAINT `cle_paiement_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `cle_paiement_ibfk_2` FOREIGN KEY (`id_paiement`) REFERENCES `paiement` (`id_paiement`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `utilisateur_paiement`
--
ALTER TABLE `utilisateur_paiement`
  ADD CONSTRAINT `utilisateur_paiement_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `utilisateur_paiement_ibfk_2` FOREIGN KEY (`id_paiement`) REFERENCES `paiement` (`id_paiement`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
