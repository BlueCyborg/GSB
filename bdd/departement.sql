-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mer. 09 nov. 2022 à 15:39
-- Version du serveur : 10.6.5-MariaDB
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ferre_gsb_projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `DEP_NUM` int(11) NOT NULL,
  `DEP_NOM` varchar(30) NOT NULL,
  `REG_CODE` varchar(2) NOT NULL,
  PRIMARY KEY (`DEP_NUM`),
  KEY `FK_DEP_REG` (`REG_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`DEP_NUM`, `DEP_NOM`, `REG_CODE`) VALUES
(1, 'Ain', 'RA'),
(2, 'Aisne', 'PI'),
(3, 'Allier', 'AU'),
(4, 'Alpes-de-Haute-Provence', 'PA'),
(5, 'Hautes-Alpes', 'PA'),
(6, 'Alpes-Maritimes', 'PA'),
(7, 'Ardeche', 'RA'),
(8, 'Ardennes', 'CA'),
(9, 'Ariege', 'LG'),
(10, 'Aube', 'AL'),
(11, 'Aude', 'RO'),
(12, 'Aveyron', 'RO'),
(13, 'Bouches-du-Rhone', 'PA'),
(14, 'Calvados', 'HN'),
(15, 'Cantal', 'AU'),
(16, 'Charente', 'PC'),
(17, 'Charente-Maritime', 'PC'),
(18, 'Cher', 'CE'),
(19, 'Correze', 'AQ'),
(22, 'Cotes-du-Nord', 'BG'),
(23, 'Creuse', 'AQ'),
(24, 'Dordogne', 'AQ'),
(25, 'Doubs', 'FC'),
(26, 'Drome', 'RA'),
(27, 'Eure', 'BN'),
(28, 'Eure-et-Loir', 'CE'),
(29, 'Finistere', 'BG'),
(30, 'Gard', 'MP'),
(31, 'Haute-Garonne', 'MP'),
(32, 'Gers', 'MP'),
(33, 'Gironde', 'AQ'),
(34, 'Herault', 'RO'),
(35, 'Ille-et-Vilaine', 'BG'),
(36, 'Indre', 'CE'),
(37, 'Indre-et-Loire', 'CE'),
(38, 'Isere', 'AU'),
(39, 'Jura', 'FC'),
(40, 'Landes', 'AQ'),
(41, 'Loir-et-Cher', 'CE'),
(42, 'Loire', 'AU'),
(43, 'Haute-Loire', 'RA'),
(44, 'Loire-Atlantique', 'PL'),
(45, 'Loiret', 'CE'),
(46, 'Lot', 'LG'),
(47, 'Lot-et-Garonne', 'PC'),
(48, 'Lozere', 'MP'),
(49, 'Maine-et-Loire', 'PL'),
(50, 'Manche', 'HN'),
(51, 'Marne', 'CA'),
(52, 'Haute-Marne', 'AL'),
(53, 'Mayenne', 'PL'),
(54, 'Meurthe-et-Moselle', 'CA'),
(55, 'Meuse', 'CA'),
(56, 'Morbihan', 'BG'),
(57, 'Moselle', 'CA'),
(58, 'Nievre', 'BO'),
(59, 'Nord', 'NP'),
(60, 'Oise', 'PI'),
(61, 'Orne', 'BN'),
(62, 'Pas-de-Calais', 'NP'),
(63, 'Puy-de-Dome', 'RA'),
(64, 'Pyrenees-Atlantiques', 'PC'),
(65, 'Hautes-Pyrenees', 'MP'),
(66, 'Pyrenees-Orientales', 'MP'),
(67, 'Bas-Rhin', 'AL'),
(68, 'Haut-Rhin', 'AL'),
(69, 'Rhone', 'RA'),
(70, 'Haute-Saone', 'FC'),
(71, 'Saone-et-Loire', 'BO'),
(72, 'Sarthe', 'PL'),
(73, 'Savoie', 'RA'),
(74, 'Haute-Savoie', 'AU'),
(75, 'Paris', 'IF'),
(76, 'Seine-Maritime', 'BN'),
(77, 'Seine-et-Marne', 'IF'),
(78, 'Yvelines', 'IF'),
(79, 'Deux-Sevres', 'AQ'),
(80, 'Somme', 'PI'),
(81, 'Tarn', 'MP'),
(82, 'Tarn-et-Garonne', 'MP'),
(83, 'Var', 'PA'),
(84, 'Vaucluse', 'PA'),
(85, 'Vendee', 'PL'),
(86, 'Vienne', 'PC'),
(87, 'Haute-Vienne', 'AQ'),
(88, 'Vosges', 'CA'),
(89, 'Yonne', 'BO'),
(90, 'Territoire-de-Belfort', 'BO'),
(91, 'Essonne', 'IF'),
(92, 'Hauts-de-Seine', 'IF'),
(93, 'Seine-St-Denis', 'IF'),
(94, 'Val-de-Marne', 'IF'),
(95, 'Val-d-Oise', 'IF');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `FK_DEP_REG` FOREIGN KEY (`REG_CODE`) REFERENCES `region` (`REG_CODE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
