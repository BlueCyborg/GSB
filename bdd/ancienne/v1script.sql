-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  jeu. 12 mai 2022 à 09:31
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gsb`
--

-- --------------------------------------------------------
--------------------------------------------------------

--
-- Structure de la table `collaborateur`
--

DROP TABLE IF EXISTS `collaborateur`;
CREATE TABLE IF NOT EXISTS `collaborateur` (
  `COL_MATRICULE` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `COL_NOM` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `COL_PRENOM` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `COL_ADRESSE` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `COL_CP` varchar(5) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `COL_VILLE` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `COL_DATEEMBAUCHE` datetime DEFAULT NULL,
  `HAB_ID` int(11) DEFAULT NULL,
  `LOG_ID` int(11) DEFAULT NULL,
  `SEC_CODE` varchar(1) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `REG_CODE` varchar(2) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`COL_MATRICULE`),
  UNIQUE KEY `collaborateur_login0_AK` (`LOG_ID`),
  KEY `collaborateur_habilitation0_FK` (`HAB_ID`),
  KEY `collaborateur_secteur0_FK` (`SEC_CODE`),
  KEY `collaborateur_region1_FK` (`REG_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `collaborateur`
--

INSERT INTO `collaborateur` (`COL_MATRICULE`, `COL_NOM`, `COL_PRENOM`, `COL_ADRESSE`, `COL_CP`, `COL_VILLE`, `COL_DATEEMBAUCHE`, `HAB_ID`, `LOG_ID`, `SEC_CODE`, `REG_CODE`) VALUES
('a131', 'Villechalane', 'Louis', '8 cours Lafontaine', '29000', 'BREST', '1992-12-11 00:00:00', 2, 1, 'E', 'BN'),
('a17', 'Andre', 'David', '1 r Aimon de Chissée', '38100', 'GRENOBLE', '1991-08-26 00:00:00', 1, 2, NULL, 'RA'),
('a55', 'Bedos', 'Christian', '1 r Bénédictins', '65000', 'TARBES', '1987-07-17 00:00:00', 2, 3, NULL, 'RO'),
('a93', 'Tusseau', 'Louis', '22 r Renou', '86000', 'POITIERS', '1999-01-02 00:00:00', 2, 4, NULL, 'PC'),
('t60', 'Tusseau', 'Josselin', '63 r Bon Repos', '28000', 'CHARTRES', '1991-03-29 00:00:00', 1, 67, NULL, 'CE');

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Structure de la table `dosage`
--

DROP TABLE IF EXISTS `dosage`;
CREATE TABLE IF NOT EXISTS `dosage` (
  `DOS_CODE` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `DOS_QUANTITE` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `DOS_UNITE` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`DOS_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--

DROP TABLE IF EXISTS `famille`;
CREATE TABLE IF NOT EXISTS `famille` (
  `FAM_CODE` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `FAM_LIBELLE` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`FAM_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `famille`
--

INSERT INTO `famille` (`FAM_CODE`, `FAM_LIBELLE`) VALUES
('AA', 'Antalgiques en association'),
('AAA', 'Antalgiques antipyrétiques en association'),
('AAC', 'Antidépresseur d\'action centrale'),
('AAH', 'Antivertigineux antihistaminique H1'),
('ABA', 'Antibiotique antituberculeux'),
('ABC', 'Antibiotique antiacnéique local'),
('ABP', 'Antibiotique de la famille des béta-lactamines (pénicilline A)'),
('AFC', 'Antibiotique de la famille des cyclines'),
('AFM', 'Antibiotique de la famille des macrolides'),
('AH', 'Antihistaminique H1 local'),
('AIM', 'Antidépresseur imipraminique (tricyclique)'),
('AIN', 'Antidépresseur inhibiteur sélectif de la recapture de la sérotonine'),
('ALO', 'Antibiotique local (ORL)'),
('ANS', 'Antidépresseur IMAO non sélectif'),
('AO', 'Antibiotique ophtalmique'),
('AP', 'Antipsychotique normothymique'),
('AUM', 'Antibiotique urinaire minute'),
('CRT', 'Corticoïde, antibiotique et antifongique à  usage local'),
('HYP', 'Hypnotique antihistaminique'),
('PSA', 'Psychostimulant, antiasthénique');

-- --------------------------------------------------------

--
-- Structure de la table `formuler`
--

DROP TABLE IF EXISTS `formuler`;
CREATE TABLE IF NOT EXISTS `formuler` (
  `MED_DEPOTLEGAL` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `PRE_CODE` varchar(2) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`MED_DEPOTLEGAL`,`PRE_CODE`),
  KEY `FORMULER_presentation1_FK` (`PRE_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `habilitation`
--

DROP TABLE IF EXISTS `habilitation`;
CREATE TABLE IF NOT EXISTS `habilitation` (
  `HAB_ID` int(11) NOT NULL,
  `HAB_LIB` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`HAB_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `habilitation`
--

INSERT INTO `habilitation` (`HAB_ID`, `HAB_LIB`) VALUES
(1, 'Visiteur'),
(2, 'Délégué Régional'),
(3, 'Responsable Secteur');

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Structure de la table `interagir`
--

DROP TABLE IF EXISTS `interagir`;
CREATE TABLE IF NOT EXISTS `interagir` (
  `MED_DEPOTLEGAL` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `MED_DEPOTLEGAL_medicament` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`MED_DEPOTLEGAL`,`MED_DEPOTLEGAL_medicament`),
  KEY `INTERAGIR_medicament1_FK` (`MED_DEPOTLEGAL_medicament`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `LOG_ID` int(11) NOT NULL,
  `LOG_LOGIN` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `LOG_MOTDEPASSE` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `COL_MATRICULE` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`LOG_ID`),
  UNIQUE KEY `login_collaborateur0_AK` (`COL_MATRICULE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`LOG_ID`, `LOG_LOGIN`, `LOG_MOTDEPASSE`, `COL_MATRICULE`) VALUES
(1, 'villou', '6cf17e0501b8078722f316f094e230341b4f1b2d4d14cc082c41494d6b462024f031beff6fc25145ed02a58181fc90a7fca58f0d879b349638df19dca85efa7f', 'a131'),
(2, 'anddav', 'ff781e873746adf59e3165b217034477ca29d4f2322720e05492ea90d21010378252a85f2d66025874647c6d162d45df2766e8003f33c885bbc3c4dbbe92141f', 'a17'),
(3, 'bedchr', 'dbb65dd51a8348771883fae9cd7cc40ce1cf33e3756b4ca798bfcdcc37499b7e7236af7bd16d469bdaf8b039f3d5f414cb8a840d3675862675c0dc4a18fb5946', 'a55'),
(4, 'tuslou', 'd0f2a12b1928e2a54043a3e360b2f9ed7df27b780f668b066ed9de61e0007898a07ff05fbf2f062348d55cb4bf824c8c96e9102050271204713f228034ce709c', 'a93'),
(67, 'tusjos', 'd49fe42f1ce6ebd4d2f147ed3e14fc5816c6ef735c2a3cd7b60e143cafa30db0d835fe37bac1340b7fc6f7cb6f34b307ba869cdf341c2c09e216b21021104d84', 't60');

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

DROP TABLE IF EXISTS `medicament`;
CREATE TABLE IF NOT EXISTS `medicament` (
  `MED_DEPOTLEGAL` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `MED_NOMCOMMERCIAL` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `MED_COMPOSITION` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `MED_EFFETS` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `MED_CONTREINDIC` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `MED_PRIXECHANTILLON` float DEFAULT NULL,
  `FAM_CODE` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`MED_DEPOTLEGAL`),
  KEY `medicament_famille0_FK` (`FAM_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `medicament`
--

INSERT INTO `medicament` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`, `FAM_CODE`) VALUES
('3MYC7', 'TRIMYCINE', 'Triamcinolone (acétonide) + Néomycine + Nystatine', 'Ce médicament est un corticoïde à  activité forte ou très forte associé à  un antibiotique et un antifongique, utilisé en application locale dans certaines atteintes cutanées surinfectées.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants, d\'infections de la peau ou de parasitisme non traités, d\'acné. Ne pas appliquer sur une plaie, ni sous un pansement occlusif.', 78.99, 'CRT'),
('ADIMOL9', 'ADIMOL', 'Amoxicilline + Acide clavulanique', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie aux pénicillines ou aux céphalosporines.', 40.99, 'ABP'),
('AMOPIL7', 'AMOPIL', 'Amoxicilline', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie aux pénicillines. Il doit être administré avec prudence en cas d\'allergie aux céphalosporines.', 29.99, 'ABP'),
('AMOX45', 'AMOXAR', 'Amoxicilline', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'La prise de ce médicament peut rendre positifs les tests de dépistage du dopage.', 24.99, 'ABP'),
('AMOXIG12', 'AMOXI Gé', 'Amoxicilline', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie aux pénicillines. Il doit être administré avec prudence en cas d\'allergie aux céphalosporines.', 25.99, 'ABP'),
('APATOUX22', 'APATOUX Vitamine C', 'Tyrothricine + Tétracaïne + Acide ascorbique (Vitamine C)', 'Ce médicament est utilisé pour traiter les affections de la bouche et de la gorge.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants, en cas de phénylcétonurie et chez l\'enfant de moins de 6 ans.', 89.99, 'ALO'),
('BACTIG10', 'BACTIGEL', 'Erythromycine', 'Ce médicament est utilisé en application locale pour traiter l\'acné et les infections cutanées bactériennes associées.', 'Ce médicament est contre-indiqué en cas d\'allergie aux antibiotiques de la famille des macrolides ou des lincosanides.', 46.99, 'ABC'),
('BACTIV13', 'BACTIVIL', 'Erythromycine', 'Ce médicament est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie aux macrolides (dont le chef de file est l\'érythromycine).', 34.99, 'AFM'),
('BITALV', 'BIVALIC', 'Dextropropoxyphène + Paracétamol', 'Ce médicament est utilisé pour traiter les douleurs d\'intensité modérée ou intense.', 'Ce médicament est contre-indiqué en cas d\'allergie aux médicaments de cette famille, d\'insuffisance hépatique ou d\'insuffisance rénale.', 87.99, 'AAA'),
('CARTION6', 'CARTION', 'Acide acétylsalicylique (aspirine) + Acide ascorbique (Vitamine C) + Paracétamol', 'Ce médicament est utilisé dans le traitement symptomatique de la douleur ou de la fièvre.', 'Ce médicament est contre-indiqué en cas de troubles de la coagulation (tendances aux hémorragies), d\'ulcère gastroduodénal, maladies graves du foie.', 50.99, 'AAA'),
('CLAZER6', 'CLAZER', 'Clarithromycine', 'Ce médicament est utilisé pour traiter des infections bactériennes spécifiques. Il est également utilisé dans le traitement de l\'ulcère gastro-duodénal, en association avec d\'autres médicaments.', 'Ce médicament est contre-indiqué en cas d\'allergie aux macrolides (dont le chef de file est l\'érythromycine).', 46.99, 'AFM'),
('DEPRIL9', 'DEPRAMIL', 'Clomipramine', 'Ce médicament est utilisé pour traiter les épisodes dépressifs sévères, certaines douleurs rebelles, les troubles obsessionnels compulsifs et certaines énurésies chez l\'enfant.', 'Ce médicament est contre-indiqué en cas de glaucome ou d\'adénome de la prostate, d\'infarctus récent, ou si vous avez reà§u un traitement par IMAO durant les 2 semaines précédentes ou en cas d\'allergie aux antidépresseurs imipraminiques.', 96.99, 'AIM'),
('DIMIRTAM6', 'DIMIRTAM', 'Mirtazapine', 'Ce médicament est utilisé pour traiter les épisodes dépressifs sévères.', 'La prise de ce produit est contre-indiquée en cas de d\'allergie à  l\'un des constituants.', 74.99, 'AAC'),
('DOLRIL7', 'DOLORIL', 'Acide acétylsalicylique (aspirine) + Acide ascorbique (Vitamine C) + Paracétamol', 'Ce médicament est utilisé dans le traitement symptomatique de la douleur ou de la fièvre.', 'Ce médicament est contre-indiqué en cas d\'allergie au paracétamol ou aux salicylates.', 22.99, 'AAA'),
('DORNOM8', 'NORMADOR', 'Doxylamine', 'Ce médicament est utilisé pour traiter l\'insomnie chez l\'adulte.', 'Ce médicament est contre-indiqué en cas de glaucome, de certains troubles urinaires (rétention urinaire) et chez l\'enfant de moins de 15 ans.', 79.99, 'HYP'),
('EQUILARX6', 'EQUILAR', 'Méclozine', 'Ce médicament est utilisé pour traiter les vertiges et pour prévenir le mal des transports.', 'Ce médicament ne doit pas être utilisé en cas d\'allergie au produit, en cas de glaucome ou de rétention urinaire.', 66.99, 'AAH'),
('EVILR7', 'EVEILLOR', 'Adrafinil', 'Ce médicament est utilisé pour traiter les troubles de la vigilance et certains symptomes neurologiques chez le sujet agé.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants.', 41.99, 'PSA'),
('INSXT5', 'INSECTIL', 'Diphénydramine', 'Ce médicament est utilisé en application locale sur les piqûres d\'insecte et l\'urticaire.', 'Ce médicament est contre-indiqué en cas d\'allergie aux antihistaminiques.', 19.99, 'AH'),
('JOVAI8', 'JOVENIL', 'Josamycine', 'Ce médicament est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie aux macrolides (dont le chef de file est l\'érythromycine).', 63.99, 'AFM'),
('LIDOXY23', 'LIDOXYTRACINE', 'Oxytétracycline +Lidocaïne', 'Ce médicament est utilisé en injection intramusculaire pour traiter certaines infections spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants. Il ne doit pas être associé aux rétinoïdes.', 74.99, 'AFC'),
('LITHOR12', 'LITHORINE', 'Lithium', 'Ce médicament est indiqué dans la prévention des psychoses maniaco-dépressives ou pour traiter les états maniaques.', 'Ce médicament ne doit pas être utilisé si vous êtes allergique au lithium. Avant de prendre ce traitement, signalez à  votre médecin traitant si vous souffrez d\'insuffisance rénale, ou si vous avez un régime sans sel.', 84.99, 'AP'),
('PARMOL16', 'PARMOCODEINE', 'Codéine + Paracétamol', 'Ce médicament est utilisé pour le traitement des douleurs lorsque des antalgiques simples ne sont pas assez efficaces.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants, chez l\'enfant de moins de 15 Kg, en cas d\'insuffisance hépatique ou respiratoire, d\'asthme, de phénylcétonurie et chez la femme qui allaite.', 54.99, 'AA'),
('PHYSOI8', 'PHYSICOR', 'Sulbutiamine', 'Ce médicament est utilisé pour traiter les baisses d\'activité physique ou psychique, souvent dans un contexte de dépression.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants.', 67.99, 'PSA'),
('PIRIZ8', 'PIRIZAN', 'Pyrazinamide', 'Ce médicament est utilisé, en association à  d\'autres antibiotiques, pour traiter la tuberculose.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants, d\'insuffisance rénale ou hépatique, d\'hyperuricémie ou de porphyrie.', 72.99, 'ABA'),
('POMDI20', 'POMADINE', 'Bacitracine', 'Ce médicament est utilisé pour traiter les infections oculaires de la surface de l\'oeil.', 'Ce médicament est contre-indiqué en cas d\'allergie aux antibiotiques appliqués localement.', 46.99, 'AO'),
('TROXT21', 'TROXADET', 'Paroxétine', 'Ce médicament est utilisé pour traiter la dépression et les troubles obsessionnels compulsifs. Il peut également être utilisé en prévention des crises de panique avec ou sans agoraphobie.', 'Ce médicament est contre-indiqué en cas d\'allergie au produit.', 37.99, 'AIN'),
('TXISOL22', 'TOUXISOL Vitamine C', 'Tyrothricine + Acide ascorbique (Vitamine C)', 'Ce médicament est utilisé pour traiter les affections de la bouche et de la gorge.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants et chez l\'enfant de moins de 6 ans.', 57.99, 'ALO'),
('URIEG6', 'URIREGUL', 'Fosfomycine trométamol', 'Ce médicament est utilisé pour traiter les infections urinaires simples chez la femme de moins de 65 ans.', 'La prise de ce médicament est contre-indiquée en cas d\'allergie à  l\'un des constituants et d\'insuffisance rénale.', 42.99, 'AUM');

-- --------------------------------------------------------

--
-- Structure de la table `prescrire`
--

DROP TABLE IF EXISTS `prescrire`;
CREATE TABLE IF NOT EXISTS `prescrire` (
  `TIN_CODE` varchar(5) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `DOS_CODE` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `MED_DEPOTLEGAL` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `PRE_POSOLOGIE` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`TIN_CODE`,`DOS_CODE`,`MED_DEPOTLEGAL`),
  KEY `PRESCRIRE_dosage1_FK` (`DOS_CODE`),
  KEY `PRESCRIRE_medicament2_FK` (`MED_DEPOTLEGAL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `presentation`
--

DROP TABLE IF EXISTS `presentation`;
CREATE TABLE IF NOT EXISTS `presentation` (
  `PRE_CODE` varchar(2) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `PRE_LIBELLE` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`PRE_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `presentation_produit`
--

DROP TABLE IF EXISTS `presentation_produit`;
CREATE TABLE IF NOT EXISTS `presentation_produit` (
  `MED_DEPOTLEGAL` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `COL_MATRICULE` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `RAP_NUM` int(11) NOT NULL,
  PRIMARY KEY (`MED_DEPOTLEGAL`,`COL_MATRICULE`,`RAP_NUM`),
  KEY `PRESENTATION_PRODUIT_rapport_visite1_FK` (`COL_MATRICULE`,`RAP_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------
-------------------------------------

--
-- Structure de la table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `REG_CODE` varchar(2) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `REG_NOM` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `SEC_CODE` varchar(1) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`REG_CODE`),
  KEY `region_secteur0_FK` (`SEC_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `region`
--

INSERT INTO `region` (`REG_CODE`, `REG_NOM`, `SEC_CODE`) VALUES
('AL', 'Alsace Lorraine', 'E'),
('AQ', 'Aquitaine', 'S'),
('AU', 'Auvergne', 'P'),
('BG', 'Bretagne', 'O'),
('BN', 'Basse Normandie', 'O'),
('BO', 'Bourgogne', 'E'),
('CA', 'Champagne Ardennes', 'N'),
('CE', 'Centre', 'P'),
('FC', 'Franche Comté', 'E'),
('HN', 'Haute Normandie', 'N'),
('IF', 'Ile de France', 'P'),
('LG', 'Languedoc', 'S'),
('LI', 'Limousin', 'P'),
('MP', 'Midi Pyrénée', 'S'),
('NP', 'Nord Pas de Calais', 'N'),
('PA', 'Provence Alpes Cote d\'Azur', 'S'),
('PC', 'Poitou Charente', 'O'),
('PI', 'Picardie', 'N'),
('PL', 'Pays de Loire', 'O'),
('RA', 'Rhone Alpes', 'E'),
('RO', 'Roussilon', 'S'),
('VD', 'Vendée', 'O');

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

DROP TABLE IF EXISTS `secteur`;
CREATE TABLE IF NOT EXISTS `secteur` (
  `SEC_CODE` varchar(1) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `SEC_LIBELLE` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`SEC_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `secteur`
--

INSERT INTO `secteur` (`SEC_CODE`, `SEC_LIBELLE`) VALUES
('E', 'Est'),
('N', 'Nord'),
('O', 'Ouest'),
('P', 'Paris centre'),
('S', 'Sud');

-- --------------------------------------------------------

--
-- Structure de la table `type_individu`
--

DROP TABLE IF EXISTS `type_individu`;
CREATE TABLE IF NOT EXISTS `type_individu` (
  `TIN_CODE` varchar(5) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `TIN_LIBELLE` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`TIN_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

----------------------------------------------------------

--
-- Contraintes pour la table `collaborateur`
--
ALTER TABLE `collaborateur`
  ADD CONSTRAINT `collaborateur_habilitation0_FK` FOREIGN KEY (`HAB_ID`) REFERENCES `habilitation` (`HAB_ID`),
  ADD CONSTRAINT `collaborateur_login1_FK` FOREIGN KEY (`LOG_ID`) REFERENCES `login` (`LOG_ID`),
  ADD CONSTRAINT `collaborateur_region1_FK` FOREIGN KEY (`REG_CODE`) REFERENCES `region` (`REG_CODE`),
  ADD CONSTRAINT `collaborateur_secteur0_FK` FOREIGN KEY (`SEC_CODE`) REFERENCES `secteur` (`SEC_CODE`);

--
-- Contraintes pour la table `formuler`
--
ALTER TABLE `formuler`
  ADD CONSTRAINT `FORMULER_medicament0_FK` FOREIGN KEY (`MED_DEPOTLEGAL`) REFERENCES `medicament` (`MED_DEPOTLEGAL`),
  ADD CONSTRAINT `FORMULER_presentation1_FK` FOREIGN KEY (`PRE_CODE`) REFERENCES `presentation` (`PRE_CODE`);

--
-- Contraintes pour la table `interagir`
--
ALTER TABLE `interagir`
  ADD CONSTRAINT `INTERAGIR_medicament0_FK` FOREIGN KEY (`MED_DEPOTLEGAL`) REFERENCES `medicament` (`MED_DEPOTLEGAL`),
  ADD CONSTRAINT `INTERAGIR_medicament1_FK` FOREIGN KEY (`MED_DEPOTLEGAL_medicament`) REFERENCES `medicament` (`MED_DEPOTLEGAL`);

--
-- Contraintes pour la table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_collaborateur0_FK` FOREIGN KEY (`COL_MATRICULE`) REFERENCES `collaborateur` (`COL_MATRICULE`);

--
-- Contraintes pour la table `medicament`
--
ALTER TABLE `medicament`
  ADD CONSTRAINT `medicament_famille0_FK` FOREIGN KEY (`FAM_CODE`) REFERENCES `famille` (`FAM_CODE`);

--
-- Contraintes pour la table `prescrire`
--
ALTER TABLE `prescrire`
  ADD CONSTRAINT `PRESCRIRE_dosage1_FK` FOREIGN KEY (`DOS_CODE`) REFERENCES `dosage` (`DOS_CODE`),
  ADD CONSTRAINT `PRESCRIRE_medicament2_FK` FOREIGN KEY (`MED_DEPOTLEGAL`) REFERENCES `medicament` (`MED_DEPOTLEGAL`),
  ADD CONSTRAINT `PRESCRIRE_type_individu0_FK` FOREIGN KEY (`TIN_CODE`) REFERENCES `type_individu` (`TIN_CODE`);

--
-- Contraintes pour la table `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `region_secteur0_FK` FOREIGN KEY (`SEC_CODE`) REFERENCES `secteur` (`SEC_CODE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
