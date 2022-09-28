#
# DUMP FILE
#
# Database is ported from MS Access
#------------------------------------------------------------------
# Created using "MS Access to MySQL" form http://www.bullzip.com
# Program Version 5.5.282
#
# OPTIONS:
#   sourcefilename=Z:/POO/GSB/Swiss_Visite v2.accdb
#   sourceusername=
#   sourcepassword=
#   sourcesystemdatabase=
#   destinationdatabase=gsb2022
#   storageengine=MyISAM
#   dropdatabase=0
#   createtables=1
#   unicode=1
#   autocommit=1
#   transferdefaultvalues=1
#   transferindexes=1
#   transferautonumbers=1
#   transferrecords=1
#   columnlist=1
#   tableprefix=
#   negativeboolean=0
#   ignorelargeblobs=0
#   memotype=LONGTEXT
#   datetimetype=DATETIME
#

CREATE DATABASE IF NOT EXISTS `gsb2022`;
USE `gsb2022`;

#
# Table structure for table 'ACTIVITE_COMPL'
#

DROP TABLE IF EXISTS `ACTIVITE_COMPL`;

CREATE TABLE `ACTIVITE_COMPL` (
  `AC_NUM` INTEGER NOT NULL AUTO_INCREMENT, 
  `AC_DATE` DATETIME, 
  `AC_LIEU` VARCHAR(25), 
  `AC_THEME` VARCHAR(10), 
  `AC_MOTIF` VARCHAR(50), 
  PRIMARY KEY (`AC_NUM`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'ACTIVITE_COMPL'
#

# 0 records

#
# Table structure for table 'COMPOSANT'
#

DROP TABLE IF EXISTS `COMPOSANT`;

CREATE TABLE `COMPOSANT` (
  `CMP_CODE` VARCHAR(4) NOT NULL, 
  `CMP_LIBELLE` VARCHAR(25), 
  PRIMARY KEY (`CMP_CODE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'COMPOSANT'
#

# 0 records

#
# Table structure for table 'CONSTITUER'
#

DROP TABLE IF EXISTS `CONSTITUER`;

CREATE TABLE `CONSTITUER` (
  `MED_DEPOTLEGAL` VARCHAR(10) NOT NULL, 
  `CMP_CODE` VARCHAR(4) NOT NULL, 
  `CST_QTE` FLOAT NULL, 
  PRIMARY KEY (`MED_DEPOTLEGAL`, `CMP_CODE`), 
  INDEX (`MED_DEPOTLEGAL`), 
  INDEX (`CMP_CODE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'CONSTITUER'
#

# 0 records

#
# Table structure for table 'DOSAGE'
#

DROP TABLE IF EXISTS `DOSAGE`;

CREATE TABLE `DOSAGE` (
  `DOS_CODE` VARCHAR(10) NOT NULL, 
  `DOS_QUANTITE` VARCHAR(10), 
  `DOS_UNITE` VARCHAR(10), 
  PRIMARY KEY (`DOS_CODE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'DOSAGE'
#

# 0 records

#
# Table structure for table 'FAMILLE'
#

DROP TABLE IF EXISTS `FAMILLE`;

CREATE TABLE `FAMILLE` (
  `FAM_CODE` VARCHAR(3) NOT NULL, 
  `FAM_LIBELLE` VARCHAR(80), 
  PRIMARY KEY (`FAM_CODE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'FAMILLE'
#

INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('AA', 'Antalgiques en association');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('AAA', 'Antalgiques antipyrétiques en association');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('AAC', 'Antidépresseur d\'action centrale');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('AAH', 'Antivertigineux antihistaminique H1');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('ABA', 'Antibiotique antituberculeux');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('ABC', 'Antibiotique antiacnéique local');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('ABP', 'Antibiotique de la famille des béta-lactamines (pénicilline A)');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('AFC', 'Antibiotique de la famille des cyclines');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('AFM', 'Antibiotique de la famille des macrolides');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('AH', 'Antihistaminique H1 local');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('AIM', 'Antidépresseur imipraminique (tricyclique)');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('AIN', 'Antidépresseur inhibiteur sélectif de la recapture de la sérotonine');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('ALO', 'Antibiotique local (ORL)');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('ANS', 'Antidépresseur IMAO non sélectif');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('AO', 'Antibiotique ophtalmique');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('AP', 'Antipsychotique normothymique');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('AUM', 'Antibiotique urinaire minute');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('CRT', 'Corticoïde, antibiotique et antifongique à  usage local');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('HYP', 'Hypnotique antihistaminique');
INSERT INTO `FAMILLE` (`FAM_CODE`, `FAM_LIBELLE`) VALUES ('PSA', 'Psychostimulant, antiasthénique');
# 20 records

#
# Table structure for table 'FORMULER'
#

DROP TABLE IF EXISTS `FORMULER`;

CREATE TABLE `FORMULER` (
  `MED_DEPOTLEGAL` VARCHAR(10) NOT NULL, 
  `PRE_CODE` VARCHAR(2) NOT NULL, 
  PRIMARY KEY (`MED_DEPOTLEGAL`, `PRE_CODE`), 
  INDEX (`MED_DEPOTLEGAL`), 
  INDEX (`PRE_CODE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'FORMULER'
#

# 0 records

#
# Table structure for table 'INTERAGIR'
#

DROP TABLE IF EXISTS `INTERAGIR`;

CREATE TABLE `INTERAGIR` (
  `MED_PERTURBATEUR` VARCHAR(10) NOT NULL, 
  `MED_MED_PERTURBE` VARCHAR(10) NOT NULL, 
  PRIMARY KEY (`MED_PERTURBATEUR`, `MED_MED_PERTURBE`), 
  INDEX (`MED_MED_PERTURBE`), 
  INDEX (`MED_PERTURBATEUR`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'INTERAGIR'
#

# 0 records

#
# Table structure for table 'LABO'
#

DROP TABLE IF EXISTS `LABO`;

CREATE TABLE `LABO` (
  `LAB_CODE` VARCHAR(2) NOT NULL, 
  `LAB_NOM` VARCHAR(10), 
  `LAB_CHEFVENTE` VARCHAR(20), 
  PRIMARY KEY (`LAB_CODE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'LABO'
#

INSERT INTO `LABO` (`LAB_CODE`, `LAB_NOM`, `LAB_CHEFVENTE`) VALUES ('BC', 'Bichat', 'Suzanne Terminus');
INSERT INTO `LABO` (`LAB_CODE`, `LAB_NOM`, `LAB_CHEFVENTE`) VALUES ('GY', 'Gyverny', 'Marcel MacDouglas');
INSERT INTO `LABO` (`LAB_CODE`, `LAB_NOM`, `LAB_CHEFVENTE`) VALUES ('SW', 'Swiss Kane', 'Alain Poutre');
# 3 records

#
# Table structure for table 'MEDICAMENT'
#

DROP TABLE IF EXISTS `MEDICAMENT`;

CREATE TABLE `MEDICAMENT` (
  `MED_DEPOTLEGAL` VARCHAR(10) NOT NULL, 
  `MED_NOMCOMMERCIAL` VARCHAR(25), 
  `FAM_CODE` VARCHAR(3) NOT NULL, 
  `MED_COMPOSITION` VARCHAR(255), 
  `MED_EFFETS` VARCHAR(255), 
  `MED_CONTREINDIC` VARCHAR(255), 
  `MED_PRIXECHANTILLON` FLOAT NULL, 
  INDEX (`FAM_CODE`), 
  PRIMARY KEY (`MED_DEPOTLEGAL`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'MEDICAMENT'
#

INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('3MYC7', 'TRIMYCINE', 'CRT', 'Triamcinolone (acétonide) + Néomycine + Nystatine', 'Ce médicament est un corticoïde à  activité forte ou très forte associé à  un antibiotique et un antifongique, utilisé en application locale dans certaines atteintes cutanées surinfectées.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants, d\'infections de la peau ou de parasitisme non traités, d\'acné. Ne pas appliquer sur une plaie, ni sous un pansement occlusif.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('ADIMOL9', 'ADIMOL', 'ABP', 'Amoxicilline + Acide clavulanique', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie aux pénicillines ou aux céphalosporines.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('AMOPIL7', 'AMOPIL', 'ABP', 'Amoxicilline', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie aux pénicillines. Il doit être administré avec prudence en cas d\'allergie aux céphalosporines.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('AMOX45', 'AMOXAR', 'ABP', 'Amoxicilline', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'La prise de ce médicament peut rendre positifs les tests de dépistage du dopage.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('AMOXIG12', 'AMOXI Gé', 'ABP', 'Amoxicilline', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie aux pénicillines. Il doit être administré avec prudence en cas d\'allergie aux céphalosporines.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('APATOUX22', 'APATOUX Vitamine C', 'ALO', 'Tyrothricine + Tétracaïne + Acide ascorbique (Vitamine C)', 'Ce médicament est utilisé pour traiter les affections de la bouche et de la gorge.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants, en cas de phénylcétonurie et chez l\'enfant de moins de 6 ans.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('BACTIG10', 'BACTIGEL', 'ABC', 'Erythromycine', 'Ce médicament est utilisé en application locale pour traiter l\'acné et les infections cutanées bactériennes associées.', 'Ce médicament est contre-indiqué en cas d\'allergie aux antibiotiques de la famille des macrolides ou des lincosanides.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('BACTIV13', 'BACTIVIL', 'AFM', 'Erythromycine', 'Ce médicament est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie aux macrolides (dont le chef de file est l\'érythromycine).', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('BITALV', 'BIVALIC', 'AAA', 'Dextropropoxyphène + Paracétamol', 'Ce médicament est utilisé pour traiter les douleurs d\'intensité modérée ou intense.', 'Ce médicament est contre-indiqué en cas d\'allergie aux médicaments de cette famille, d\'insuffisance hépatique ou d\'insuffisance rénale.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('CARTION6', 'CARTION', 'AAA', 'Acide acétylsalicylique (aspirine) + Acide ascorbique (Vitamine C) + Paracétamol', 'Ce médicament est utilisé dans le traitement symptomatique de la douleur ou de la fièvre.', 'Ce médicament est contre-indiqué en cas de troubles de la coagulation (tendances aux hémorragies), d\'ulcère gastroduodénal, maladies graves du foie.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('CLAZER6', 'CLAZER', 'AFM', 'Clarithromycine', 'Ce médicament est utilisé pour traiter des infections bactériennes spécifiques. Il est également utilisé dans le traitement de l\'ulcère gastro-duodénal, en association avec d\'autres médicaments.', 'Ce médicament est contre-indiqué en cas d\'allergie aux macrolides (dont le chef de file est l\'érythromycine).', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('DEPRIL9', 'DEPRAMIL', 'AIM', 'Clomipramine', 'Ce médicament est utilisé pour traiter les épisodes dépressifs sévères, certaines douleurs rebelles, les troubles obsessionnels compulsifs et certaines énurésies chez l\'enfant.', 'Ce médicament est contre-indiqué en cas de glaucome ou d\'adénome de la prostate, d\'infarctus récent, ou si vous avez reà§u un traitement par IMAO durant les 2 semaines précédentes ou en cas d\'allergie aux antidépresseurs imipraminiques.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('DIMIRTAM6', 'DIMIRTAM', 'AAC', 'Mirtazapine', 'Ce médicament est utilisé pour traiter les épisodes dépressifs sévères.', 'La prise de ce produit est contre-indiquée en cas de d\'allergie à  l\'un des constituants.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('DOLRIL7', 'DOLORIL', 'AAA', 'Acide acétylsalicylique (aspirine) + Acide ascorbique (Vitamine C) + Paracétamol', 'Ce médicament est utilisé dans le traitement symptomatique de la douleur ou de la fièvre.', 'Ce médicament est contre-indiqué en cas d\'allergie au paracétamol ou aux salicylates.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('DORNOM8', 'NORMADOR', 'HYP', 'Doxylamine', 'Ce médicament est utilisé pour traiter l\'insomnie chez l\'adulte.', 'Ce médicament est contre-indiqué en cas de glaucome, de certains troubles urinaires (rétention urinaire) et chez l\'enfant de moins de 15 ans.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('EQUILARX6', 'EQUILAR', 'AAH', 'Méclozine', 'Ce médicament est utilisé pour traiter les vertiges et pour prévenir le mal des transports.', 'Ce médicament ne doit pas être utilisé en cas d\'allergie au produit, en cas de glaucome ou de rétention urinaire.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('EVILR7', 'EVEILLOR', 'PSA', 'Adrafinil', 'Ce médicament est utilisé pour traiter les troubles de la vigilance et certains symptomes neurologiques chez le sujet agé.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('INSXT5', 'INSECTIL', 'AH', 'Diphénydramine', 'Ce médicament est utilisé en application locale sur les piqûres d\'insecte et l\'urticaire.', 'Ce médicament est contre-indiqué en cas d\'allergie aux antihistaminiques.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('JOVAI8', 'JOVENIL', 'AFM', 'Josamycine', 'Ce médicament est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie aux macrolides (dont le chef de file est l\'érythromycine).', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('LIDOXY23', 'LIDOXYTRACINE', 'AFC', 'Oxytétracycline +Lidocaïne', 'Ce médicament est utilisé en injection intramusculaire pour traiter certaines infections spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants. Il ne doit pas être associé aux rétinoïdes.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('LITHOR12', 'LITHORINE', 'AP', 'Lithium', 'Ce médicament est indiqué dans la prévention des psychoses maniaco-dépressives ou pour traiter les états maniaques.', 'Ce médicament ne doit pas être utilisé si vous êtes allergique au lithium. Avant de prendre ce traitement, signalez à  votre médecin traitant si vous souffrez d\'insuffisance rénale, ou si vous avez un régime sans sel.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('PARMOL16', 'PARMOCODEINE', 'AA', 'Codéine + Paracétamol', 'Ce médicament est utilisé pour le traitement des douleurs lorsque des antalgiques simples ne sont pas assez efficaces.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants, chez l\'enfant de moins de 15 Kg, en cas d\'insuffisance hépatique ou respiratoire, d\'asthme, de phénylcétonurie et chez la femme qui allaite.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('PHYSOI8', 'PHYSICOR', 'PSA', 'Sulbutiamine', 'Ce médicament est utilisé pour traiter les baisses d\'activité physique ou psychique, souvent dans un contexte de dépression.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('PIRIZ8', 'PIRIZAN', 'ABA', 'Pyrazinamide', 'Ce médicament est utilisé, en association à  d\'autres antibiotiques, pour traiter la tuberculose.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants, d\'insuffisance rénale ou hépatique, d\'hyperuricémie ou de porphyrie.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('POMDI20', 'POMADINE', 'AO', 'Bacitracine', 'Ce médicament est utilisé pour traiter les infections oculaires de la surface de l\'oeil.', 'Ce médicament est contre-indiqué en cas d\'allergie aux antibiotiques appliqués localement.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('TROXT21', 'TROXADET', 'AIN', 'Paroxétine', 'Ce médicament est utilisé pour traiter la dépression et les troubles obsessionnels compulsifs. Il peut également être utilisé en prévention des crises de panique avec ou sans agoraphobie.', 'Ce médicament est contre-indiqué en cas d\'allergie au produit.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('TXISOL22', 'TOUXISOL Vitamine C', 'ALO', 'Tyrothricine + Acide ascorbique (Vitamine C)', 'Ce médicament est utilisé pour traiter les affections de la bouche et de la gorge.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants et chez l\'enfant de moins de 6 ans.', NULL);
INSERT INTO `MEDICAMENT` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`) VALUES ('URIEG6', 'URIREGUL', 'AUM', 'Fosfomycine trométamol', 'Ce médicament est utilisé pour traiter les infections urinaires simples chez la femme de moins de 65 ans.', 'La prise de ce médicament est contre-indiquée en cas d\'allergie à  l\'un des constituants et d\'insuffisance rénale.', NULL);
# 28 records

#
# Table structure for table 'OFFRIR'
#

DROP TABLE IF EXISTS `OFFRIR`;

CREATE TABLE `OFFRIR` (
  `VIS_MATRICULE` VARCHAR(10) NOT NULL, 
  `RAP_NUM` INTEGER NOT NULL, 
  `MED_DEPOTLEGAL` VARCHAR(10) NOT NULL, 
  `OFF_QTE` INTEGER, 
  INDEX (`MED_DEPOTLEGAL`), 
  INDEX (`VIS_MATRICULE`, `RAP_NUM`), 
  PRIMARY KEY (`VIS_MATRICULE`, `RAP_NUM`, `MED_DEPOTLEGAL`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'OFFRIR'
#

INSERT INTO `OFFRIR` (`VIS_MATRICULE`, `RAP_NUM`, `MED_DEPOTLEGAL`, `OFF_QTE`) VALUES ('a17', 4, '3MYC7', 3);
INSERT INTO `OFFRIR` (`VIS_MATRICULE`, `RAP_NUM`, `MED_DEPOTLEGAL`, `OFF_QTE`) VALUES ('a17', 4, 'AMOX45', 12);
# 2 records

#
# Table structure for table 'POSSEDER'
#

DROP TABLE IF EXISTS `POSSEDER`;

CREATE TABLE `POSSEDER` (
  `PRA_NUM` INTEGER NOT NULL, 
  `SPE_CODE` VARCHAR(5) NOT NULL, 
  `POS_DIPLOME` VARCHAR(10), 
  `POS_COEFPRESCRIPTION` FLOAT NULL, 
  INDEX (`PRA_NUM`), 
  INDEX (`SPE_CODE`), 
  PRIMARY KEY (`PRA_NUM`, `SPE_CODE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'POSSEDER'
#

# 0 records

#
# Table structure for table 'PRATICIEN'
#

DROP TABLE IF EXISTS `PRATICIEN`;

CREATE TABLE `PRATICIEN` (
  `PRA_NUM` INTEGER NOT NULL, 
  `PRA_NOM` VARCHAR(25), 
  `PRA_PRENOM` VARCHAR(30), 
  `PRA_ADRESSE` VARCHAR(50), 
  `PRA_CP` VARCHAR(5), 
  `PRA_VILLE` VARCHAR(25), 
  `PRA_COEFNOTORIETE` FLOAT NULL, 
  `TYP_CODE` VARCHAR(3) NOT NULL, 
  PRIMARY KEY (`PRA_NUM`), 
  INDEX (`TYP_CODE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'PRATICIEN'
#

INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (1, 'Notini', 'Alain', '114 r Authie', '85000', 'LA ROCHE SUR YON', 290.03, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (2, 'Gosselin', 'Albert', '13 r Devon', '41000', 'BLOIS', 307.49, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (3, 'Delahaye', 'André', '36 av 6 Juin', '25000', 'BESANCON', 185.79, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (4, 'Leroux', 'André', '47 av Robert Schuman', '60000', 'BEAUVAIS', 172.04, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (5, 'Desmoulins', 'Anne', '31 r St Jean', '30000', 'NIMES', 94.75, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (6, 'Mouel', 'Anne', '27 r Auvergne', '80000', 'AMIENS', 45.2, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (7, 'Desgranges-Lentz', 'Antoine', '1 r Albert de Mun', '29000', 'MORLAIX', 20.07, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (8, 'Marcouiller', 'Arnaud', '31 r St Jean', '68000', 'MULHOUSE', 396.52, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (9, 'Dupuy', 'Benoit', '9 r Demolombe', '34000', 'MONTPELLIER', 395.66, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (10, 'Lerat', 'Bernard', '31 r St Jean', '59000', 'LILLE', 257.79, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (11, 'Marçais-Lefebvre', 'Bertrand', '86Bis r Basse', '67000', 'STRASBOURG', 450.96, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (12, 'Boscher', 'Bruno', '94 r Falaise', '10000', 'TROYES', 356.14, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (13, 'Morel', 'Catherine', '21 r Chateaubriand', '75000', 'PARIS', 379.57, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (14, 'Guivarch', 'Chantal', '4 av Gén Laperrine', '45000', 'ORLEANS', 114.56, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (15, 'Bessin-Grosdoit', 'Christophe', '92 r Falaise', '6000', 'NICE', 222.06, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (16, 'Rossa', 'Claire', '14 av Thiès', '6000', 'NICE', 529.78, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (17, 'Cauchy', 'Denis', '5 av Ste Thérèse', '11000', 'NARBONNE', 458.82, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (18, 'Gaffé', 'Dominique', '9 av 1ère Armée Française', '35000', 'RENNES', 213.4, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (19, 'Guenon', 'Dominique', '98 bd Mar Lyautey', '44000', 'NANTES', 175.89, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (20, 'Prévot', 'Dominique', '29 r Lucien Nelle', '87000', 'LIMOGES', 151.36, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (21, 'Houchard', 'Eliane', '9 r Demolombe', '49100', 'ANGERS', 436.96, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (22, 'Desmons', 'Elisabeth', '51 r Bernières', '29000', 'QUIMPER', 281.17, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (23, 'Flament', 'Elisabeth', '11 r Pasteur', '35000', 'RENNES', 315.6, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (24, 'Goussard', 'Emmanuel', '9 r Demolombe', '41000', 'BLOIS', 40.72, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (25, 'Desprez', 'Eric', '9 r Vaucelles', '33000', 'BORDEAUX', 406.85, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (26, 'Coste', 'Evelyne', '29 r Lucien Nelle', '19000', 'TULLE', 441.87, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (27, 'Lefebvre', 'Frédéric', '2 pl Wurzburg', '55000', 'VERDUN', 573.63, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (28, 'Lemée', 'Frédéric', '29 av 6 Juin', '56000', 'VANNES', 326.4, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (29, 'Martin', 'Frédéric', 'Bât A 90 r Bayeux', '70000', 'VESOUL', 506.06, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (30, 'Marie', 'Frédérique', '172 r Caponière', '70000', 'VESOUL', 313.31, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (31, 'Rosenstech', 'Geneviève', '27 r Auvergne', '75000', 'PARIS', 366.82, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (32, 'Pontavice', 'Ghislaine', '8 r Gaillon', '86000', 'POITIERS', 265.58, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (33, 'Leveneur-Mosquet', 'Guillaume', '47 av Robert Schuman', '64000', 'PAU', 184.97, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (34, 'Blanchais', 'Guy', '30 r Authie', '8000', 'SEDAN', 502.48, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (35, 'Leveneur', 'Hugues', '7 pl St Gilles', '62000', 'ARRAS', 7.39, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (36, 'Mosquet', 'Isabelle', '22 r Jules Verne', '76000', 'ROUEN', 77.1, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (37, 'Giraudon', 'Jean-Christophe', '1 r Albert de Mun', '38100', 'VIENNE', 92.62, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (38, 'Marie', 'Jean-Claude', '26 r Hérouville', '69000', 'LYON', 120.1, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (39, 'Maury', 'Jean-François', '5 r Pierre Girard', '71000', 'CHALON SUR SAONE', 13.73, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (40, 'Dennel', 'Jean-Louis', '7 pl St Gilles', '28000', 'CHARTRES', 550.69, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (41, 'Ain', 'Jean-Pierre', '4 résid Olympia', '2000', 'LAON', 5.59, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (42, 'Chemery', 'Jean-Pierre', '51 pl Ancienne Boucherie', '14000', 'CAEN', 396.58, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (43, 'Comoz', 'Jean-Pierre', '35 r Auguste Lechesne', '18000', 'BOURGES', 340.35, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (44, 'Desfaudais', 'Jean-Pierre', '7 pl St Gilles', '29000', 'BREST', 71.76, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (45, 'Phan', 'JérÃ´me', '9 r Clos Caillet', '79000', 'NIORT', 451.61, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (46, 'Riou', 'Line', '43 bd Gén Vanier', '77000', 'MARNE LA VALLEE', 193.25, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (47, 'Chubilleau', 'Louis', '46 r Eglise', '17000', 'SAINTES', 202.07, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (48, 'Lebrun', 'Lucette', '178 r Auge', '54000', 'NANCY', 410.41, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (49, 'Goessens', 'Marc', '6 av 6 Juin', '39000', 'DOLE', 548.57, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (50, 'Laforge', 'Marc', '5 résid Prairie', '50000', 'SAINT LO', 265.05, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (51, 'Millereau', 'Marc', '36 av 6 Juin', '72000', 'LA FERTE BERNARD', 430.42, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (52, 'Dauverne', 'Marie-Christine', '69 av Charlemagne', '21000', 'DIJON', 281.05, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (53, 'Vittorio', 'Myriam', '3 pl Champlain', '94000', 'BOISSY SAINT LEGER', 356.23, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (54, 'Lapasset', 'Nhieu', '31 av 6 Juin', '52000', 'CHAUMONT', 107, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (55, 'Plantet-Besnier', 'Nicole', '10 av 1ère Armée Française', '86000', 'CHATELLEREAULT', 369.94, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (56, 'Chubilleau', 'Pascal', '3 r Hastings', '15000', 'AURRILLAC', 290.75, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (57, 'Robert', 'Pascal', '31 r St Jean', '93000', 'BOBIGNY', 162.41, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (58, 'Jean', 'Pascale', '114 r Authie', '49100', 'SAUMUR', 375.52, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (59, 'Chanteloube', 'Patrice', '14 av Thiès', '13000', 'MARSEILLE', 478.01, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (60, 'Lecuirot', 'Patrice', 'résid St Pères 55 r Pigacière', '54000', 'NANCY', 239.66, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (61, 'Gandon', 'Patrick', '47 av Robert Schuman', '37000', 'TOURS', 599.06, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (62, 'Mirouf', 'Patrick', '22 r Puits Picard', '74000', 'ANNECY', 458.42, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (63, 'Boireaux', 'Philippe', '14 av Thiès', '10000', 'CHALON EN CHAMPAGNE', 454.48, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (64, 'Cendrier', 'Philippe', '7 pl St Gilles', '12000', 'RODEZ', 164.16, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (65, 'Duhamel', 'Philippe', '114 r Authie', '34000', 'MONTPELLIER', 98.62, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (66, 'Grigy', 'Philippe', '15 r Mélingue', '44000', 'CLISSON', 285.1, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (67, 'Linard', 'Philippe', '1 r Albert de Mun', '81000', 'ALBI', 486.3, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (68, 'Lozier', 'Philippe', '8 r Gaillon', '31000', 'TOULOUSE', 48.4, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (69, 'Dechâtre', 'Pierre', '63 av Thiès', '23000', 'MONTLUCON', 253.75, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (70, 'Goessens', 'Pierre', '22 r Jean Romain', '40000', 'MONT DE MARSAN', 426.19, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (71, 'Leménager', 'Pierre', '39 av 6 Juin', '57000', 'METZ', 118.7, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (72, 'Née', 'Pierre', '39 av 6 Juin', '82000', 'MONTAUBAN', 72.54, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (73, 'Guyot', 'Pierre-Laurent', '43 bd Gén Vanier', '48000', 'MENDE', 352.31, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (74, 'Chauchard', 'Roger', '9 r Vaucelles', '13000', 'MARSEILLE', 552.19, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (75, 'Mabire', 'Roland', '11 r Boutiques', '67000', 'STRASBOURG', 422.39, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (76, 'Leroy', 'Soazig', '45 r Boutiques', '61000', 'ALENCON', 570.67, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (77, 'Guyot', 'Stéphane', '26 r Hérouville', '46000', 'FIGEAC', 28.85, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (78, 'Delposen', 'Sylvain', '39 av 6 Juin', '27000', 'DREUX', 292.01, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (79, 'Rault', 'Sylvie', '15 bd Richemond', '2000', 'SOISSON', 526.6, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (80, 'Renouf', 'Sylvie', '98 bd Mar Lyautey', '88000', 'EPINAL', 425.24, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (81, 'Alliet-Grach', 'Thierry', '14 av Thiès', '7000', 'PRIVAS', 451.31, 'MH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (82, 'Bayard', 'Thierry', '92 r Falaise', '42000', 'SAINT ETIENNE', 271.71, 'MV');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (83, 'Gauchet', 'Thierry', '7 r Desmoueux', '38100', 'GRENOBLE', 406.1, 'PS');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (84, 'Bobichon', 'Tristan', '219 r Caponière', '9000', 'FOIX', 218.36, 'PH');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (85, 'Duchemin-Laniel', 'Véronique', '130 r St Jean', '33000', 'LIBOURNE', 265.61, 'PO');
INSERT INTO `PRATICIEN` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES (86, 'Laurent', 'Younès', '34 r Demolombe', '53000', 'MAYENNE', 496.1, 'MH');
# 86 records

#
# Table structure for table 'PRESCRIRE'
#

DROP TABLE IF EXISTS `PRESCRIRE`;

CREATE TABLE `PRESCRIRE` (
  `MED_DEPOTLEGAL` VARCHAR(10) NOT NULL, 
  `TIN_CODE` VARCHAR(5) NOT NULL, 
  `DOS_CODE` VARCHAR(10) NOT NULL, 
  `PRE_POSOLOGIE` VARCHAR(40), 
  INDEX (`MED_DEPOTLEGAL`), 
  INDEX (`TIN_CODE`), 
  INDEX (`DOS_CODE`), 
  PRIMARY KEY (`MED_DEPOTLEGAL`, `TIN_CODE`, `DOS_CODE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'PRESCRIRE'
#

# 0 records

#
# Table structure for table 'PRESENTATION'
#

DROP TABLE IF EXISTS `PRESENTATION`;

CREATE TABLE `PRESENTATION` (
  `PRE_CODE` VARCHAR(2) NOT NULL, 
  `PRE_LIBELLE` VARCHAR(20), 
  PRIMARY KEY (`PRE_CODE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'PRESENTATION'
#

# 0 records

#
# Table structure for table 'RAPPORT_VISITE'
#

DROP TABLE IF EXISTS `RAPPORT_VISITE`;

CREATE TABLE `RAPPORT_VISITE` (
  `VIS_MATRICULE` VARCHAR(10) NOT NULL, 
  `RAP_NUM` INTEGER NOT NULL AUTO_INCREMENT, 
  `PRA_NUM` INTEGER NOT NULL, 
  `RAP_DATE` DATETIME, 
  `RAP_BILAN` VARCHAR(255), 
  `RAP_MOTIF` VARCHAR(255), 
  INDEX (`PRA_NUM`), 
  PRIMARY KEY (`VIS_MATRICULE`, `RAP_NUM`), 
  INDEX (`VIS_MATRICULE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'RAPPORT_VISITE'
#

INSERT INTO `RAPPORT_VISITE` (`VIS_MATRICULE`, `RAP_NUM`, `PRA_NUM`, `RAP_DATE`, `RAP_BILAN`, `RAP_MOTIF`) VALUES ('a131', 3, 23, '2002-04-18 00:00:00', 'Médecin curieux, à recontacer en décembre pour réunion', 'Actualisation annuelle');
INSERT INTO `RAPPORT_VISITE` (`VIS_MATRICULE`, `RAP_NUM`, `PRA_NUM`, `RAP_DATE`, `RAP_BILAN`, `RAP_MOTIF`) VALUES ('a131', 7, 41, '2003-03-23 00:00:00', 'RAS\r\nChangement de tel : 05 89 89 89 89', 'Rapport Annuel');
INSERT INTO `RAPPORT_VISITE` (`VIS_MATRICULE`, `RAP_NUM`, `PRA_NUM`, `RAP_DATE`, `RAP_BILAN`, `RAP_MOTIF`) VALUES ('a17', 4, 4, '2003-05-21 00:00:00', 'Changement de direction, redéfinition de la politique médicamenteuse, recours au générique', 'Baisse activité');
# 3 records

#
# Table structure for table 'REGION'
#

DROP TABLE IF EXISTS `REGION`;

CREATE TABLE `REGION` (
  `REG_CODE` VARCHAR(2) NOT NULL, 
  `SEC_CODE` VARCHAR(1) NOT NULL, 
  `REG_NOM` VARCHAR(50), 
  INDEX (`SEC_CODE`), 
  PRIMARY KEY (`REG_CODE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'REGION'
#

INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('AL', 'E', 'Alsace Lorraine');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('AQ', 'S', 'Aquitaine');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('AU', 'P', 'Auvergne');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('BG', 'O', 'Bretagne');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('BN', 'O', 'Basse Normandie');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('BO', 'E', 'Bourgogne');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('CA', 'N', 'Champagne Ardennes');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('CE', 'P', 'Centre');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('FC', 'E', 'Franche Comté');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('HN', 'N', 'Haute Normandie');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('IF', 'P', 'Ile de France');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('LG', 'S', 'Languedoc');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('LI', 'P', 'Limousin');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('MP', 'S', 'Midi Pyrénée');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('NP', 'N', 'Nord Pas de Calais');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('PA', 'S', 'Provence Alpes Cote d\'Azur');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('PC', 'O', 'Poitou Charente');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('PI', 'N', 'Picardie');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('PL', 'O', 'Pays de Loire');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('RA', 'E', 'Rhone Alpes');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('RO', 'S', 'Roussilon');
INSERT INTO `REGION` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES ('VD', 'O', 'Vendée');
# 22 records

#
# Table structure for table 'SECTEUR'
#

DROP TABLE IF EXISTS `SECTEUR`;

CREATE TABLE `SECTEUR` (
  `SEC_CODE` VARCHAR(1) NOT NULL, 
  `SEC_LIBELLE` VARCHAR(15), 
  PRIMARY KEY (`SEC_CODE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'SECTEUR'
#

INSERT INTO `SECTEUR` (`SEC_CODE`, `SEC_LIBELLE`) VALUES ('E', 'Est');
INSERT INTO `SECTEUR` (`SEC_CODE`, `SEC_LIBELLE`) VALUES ('N', 'Nord');
INSERT INTO `SECTEUR` (`SEC_CODE`, `SEC_LIBELLE`) VALUES ('O', 'Ouest');
INSERT INTO `SECTEUR` (`SEC_CODE`, `SEC_LIBELLE`) VALUES ('P', 'Paris centre');
INSERT INTO `SECTEUR` (`SEC_CODE`, `SEC_LIBELLE`) VALUES ('S', 'Sud');
# 5 records

#
# Table structure for table 'SPECIALITE'
#

DROP TABLE IF EXISTS `SPECIALITE`;

CREATE TABLE `SPECIALITE` (
  `SPE_CODE` VARCHAR(5) NOT NULL, 
  `SPE_LIBELLE` VARCHAR(150), 
  PRIMARY KEY (`SPE_CODE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'SPECIALITE'
#

INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('ACP', 'anatomie et cytologie pathologiques');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('AMV', 'angéiologie, médecine vasculaire');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('ARC', 'anesthésiologie et réanimation chirurgicale');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('BM', 'biologie médicale');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('CAC', 'cardiologie et affections cardio-vasculaires');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('CCT', 'chirurgie cardio-vasculaire et thoracique');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('CG', 'chirurgie générale');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('CMF', 'chirurgie maxillo-faciale');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('COM', 'cancérologie, oncologie médicale');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('COT', 'chirurgie orthopédique et traumatologie');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('CPR', 'chirurgie plastique reconstructrice et esthétique');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('CU', 'chirurgie urologique');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('CV', 'chirurgie vasculaire');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('DN', 'diabétologie-nutrition, nutrition');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('DV', 'dermatologie et vénéréologie');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('EM', 'endocrinologie et métabolismes');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('ETD', 'évaluation et traitement de la douleur');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('GEH', 'gastro-entérologie et hépatologie (appareil digestif)');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('GMO', 'gynécologie médicale, obstétrique');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('GO', 'gynécologie-obstétrique');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('HEM', 'maladies du sang (hématologie)');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('MBS', 'médecine et biologie du sport');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('MDT', 'médecine du travail');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('MMO', 'médecine manuelle - ostéopathie');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('MN', 'médecine nucléaire');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('MPR', 'médecine physique et de réadaptation');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('MTR', 'médecine tropicale, pathologie infectieuse et tropicale');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('NEP', 'néphrologie');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('NRC', 'neurochirurgie');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('NRL', 'neurologie');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('ODM', 'orthopédie dento maxillo-faciale');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('OPH', 'ophtalmologie');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('ORL', 'oto-rhino-laryngologie');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('PEA', 'psychiatrie de l\'enfant et de l\'adolescent');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('PME', 'pédiatrie maladies des enfants');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('PNM', 'pneumologie');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('PSC', 'psychiatrie');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('RAD', 'radiologie (radiodiagnostic et imagerie médicale)');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('RDT', 'radiothérapie (oncologie option radiothérapie)');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('RGM', 'reproduction et gynécologie médicale');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('RHU', 'rhumatologie');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('STO', 'stomatologie');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('SXL', 'sexologie');
INSERT INTO `SPECIALITE` (`SPE_CODE`, `SPE_LIBELLE`) VALUES ('TXA', 'toxicomanie et alcoologie');
# 44 records

#
# Table structure for table 'Switchboard Items'
#

DROP TABLE IF EXISTS `Switchboard Items`;

CREATE TABLE `Switchboard Items` (
  `SwitchboardID` INTEGER NOT NULL, 
  `ItemNumber` INTEGER NOT NULL DEFAULT 0, 
  `ItemText` VARCHAR(255), 
  `Command` INTEGER, 
  `Argument` VARCHAR(255), 
  PRIMARY KEY (`SwitchboardID`, `ItemNumber`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'Switchboard Items'
#

INSERT INTO `Switchboard Items` (`SwitchboardID`, `ItemNumber`, `ItemText`, `Command`, `Argument`) VALUES (1, 0, 'Gestion des comptes rendus', NULL, 'Par défaut');
INSERT INTO `Switchboard Items` (`SwitchboardID`, `ItemNumber`, `ItemText`, `Command`, `Argument`) VALUES (1, 1, 'Comptes-Rendus', 3, 'RAPPORT_VISITE');
INSERT INTO `Switchboard Items` (`SwitchboardID`, `ItemNumber`, `ItemText`, `Command`, `Argument`) VALUES (1, 2, 'Visiteurs', 3, 'F_VISITEUR');
INSERT INTO `Switchboard Items` (`SwitchboardID`, `ItemNumber`, `ItemText`, `Command`, `Argument`) VALUES (1, 3, 'Praticiens', 3, 'F_PRATICIEN');
INSERT INTO `Switchboard Items` (`SwitchboardID`, `ItemNumber`, `ItemText`, `Command`, `Argument`) VALUES (1, 4, 'Medicaments', 3, 'F_MEDICAMENT');
INSERT INTO `Switchboard Items` (`SwitchboardID`, `ItemNumber`, `ItemText`, `Command`, `Argument`) VALUES (1, 5, 'Quitter', 8, 'quitter');
# 6 records

#
# Table structure for table 'TRAVAILLER'
#

DROP TABLE IF EXISTS `TRAVAILLER`;

CREATE TABLE `TRAVAILLER` (
  `VIS_MATRICULE` VARCHAR(10) NOT NULL, 
  `REG_CODE` VARCHAR(2) NOT NULL, 
  `TRA_ROLE` VARCHAR(11), 
  INDEX (`VIS_MATRICULE`), 
  INDEX (`REG_CODE`), 
  PRIMARY KEY (`VIS_MATRICULE`, `REG_CODE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'TRAVAILLER'
#

INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('p49', 'CE', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('g53', 'BG', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('a55', 'MP', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('m35', 'MP', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('e39', 'IF', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('c14', 'PA', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('e22', 'AL', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('p7', 'RO', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('r58', 'BG', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('t60', 'CE', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('c54', 'AL', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('p8', 'BO', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('a17', 'RA', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('e52', 'HN', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('d13', 'PL', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('k53', 'AL', 'Délégué');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('c3', 'CA', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('n58', 'CE', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('s21', 'LI', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('h40', 'CA', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('a131', 'BN', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('j50', 'NP', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('p32', 'IF', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('h13', 'LI', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('e24', 'AL', 'Délégué');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('f21', 'RA', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('h35', 'AU', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('b34', 'CE', 'Délégué');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('f4', 'MP', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('t55', 'MP', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('p42', 'PI', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('n59', 'PI', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('o26', 'LG', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('l14', 'PL', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('t43', 'BO', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('l23', 'PC', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('b59', 'RA', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('s10', 'FC', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('g7', 'LI', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('g19', 'IF', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('e49', 'MP', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('l56', 'FC', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('n42', 'HN', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('b13', 'AL', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('k4', 'LG', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('l46', 'PL', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('f39', 'RA', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('b16', 'BG', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('p6', 'AQ', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('t47', 'PI', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('q17', 'BN', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('b4', 'AQ', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('d51', 'FC', 'Délégué');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('b50', 'PA', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('j45', 'CA', 'Responsable');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('h30', 'IF', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('r24', 'BN', 'Responsable');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('j8', 'IF', 'Responsable');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('p41', 'PC', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('a93', 'PC', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('b19', 'PL', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('g30', 'PI', 'Délégué');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('m45', 'AL', 'Délégué');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('p40', 'BN', 'Responsable');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('b28', 'LG', 'Visiteur');
INSERT INTO `TRAVAILLER` (`VIS_MATRICULE`, `REG_CODE`, `TRA_ROLE`) VALUES ('e5', 'AQ', 'Responsable');
# 66 records

#
# Table structure for table 'TYPE_INDIVIDU'
#

DROP TABLE IF EXISTS `TYPE_INDIVIDU`;

CREATE TABLE `TYPE_INDIVIDU` (
  `TIN_CODE` VARCHAR(5) NOT NULL, 
  `TIN_LIBELLE` VARCHAR(50), 
  PRIMARY KEY (`TIN_CODE`), 
  INDEX (`TIN_CODE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'TYPE_INDIVIDU'
#

# 0 records

#
# Table structure for table 'TYPE_PRATICIEN'
#

DROP TABLE IF EXISTS `TYPE_PRATICIEN`;

CREATE TABLE `TYPE_PRATICIEN` (
  `TYP_CODE` VARCHAR(3) NOT NULL, 
  `TYP_LIBELLE` VARCHAR(25), 
  `TYP_LIEU` VARCHAR(35), 
  PRIMARY KEY (`TYP_CODE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'TYPE_PRATICIEN'
#

INSERT INTO `TYPE_PRATICIEN` (`TYP_CODE`, `TYP_LIBELLE`, `TYP_LIEU`) VALUES ('MH', 'Médecin Hospitalier', 'Hopital ou clinique');
INSERT INTO `TYPE_PRATICIEN` (`TYP_CODE`, `TYP_LIBELLE`, `TYP_LIEU`) VALUES ('MV', 'Médecine de Ville', 'Cabinet');
INSERT INTO `TYPE_PRATICIEN` (`TYP_CODE`, `TYP_LIBELLE`, `TYP_LIEU`) VALUES ('PH', 'Pharmacien Hospitalier', 'Hopital ou clinique');
INSERT INTO `TYPE_PRATICIEN` (`TYP_CODE`, `TYP_LIBELLE`, `TYP_LIEU`) VALUES ('PO', 'Pharmacien Officine', 'Pharmacie');
INSERT INTO `TYPE_PRATICIEN` (`TYP_CODE`, `TYP_LIBELLE`, `TYP_LIEU`) VALUES ('PS', 'Personnel de santé', 'Centre paramédical');
# 5 records

#
# Table structure for table 'VISITEUR'
#

DROP TABLE IF EXISTS `VISITEUR`;

CREATE TABLE `VISITEUR` (
  `VIS_MATRICULE` VARCHAR(10) NOT NULL, 
  `VIS_NOM` VARCHAR(25), 
  `Vis_PRENOM` VARCHAR(50), 
  `VIS_ADRESSE` VARCHAR(50), 
  `VIS_CP` VARCHAR(5), 
  `VIS_VILLE` VARCHAR(30), 
  `VIS_DATEEMBAUCHE` DATETIME, 
  `SEC_CODE` VARCHAR(1), 
  `LAB_CODE` VARCHAR(2) NOT NULL, 
  INDEX (`LAB_CODE`), 
  INDEX (`SEC_CODE`), 
  PRIMARY KEY (`VIS_MATRICULE`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'VISITEUR'
#

INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('a131', 'Villechalane', 'Louis', '8 cours Lafontaine', '29000', 'BREST', '1992-12-11 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('a17', 'Andre', 'David', '1 r Aimon de Chissée', '38100', 'GRENOBLE', '1991-08-26 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('a55', 'Bedos', 'Christian', '1 r Bénédictins', '65000', 'TARBES', '1987-07-17 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('a93', 'Tusseau', 'Louis', '22 r Renou', '86000', 'POITIERS', '1999-01-02 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('b13', 'Bentot', 'Pascal', '11 av 6 Juin', '67000', 'STRASBOURG', '1996-03-11 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('b16', 'Bioret', 'Luc', '1 r Linne', '35000', 'RENNES', '1997-03-21 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('b19', 'Bunisset', 'Francis', '10 r Nicolas Chorier', '85000', 'LA ROCHE SUR YON', '1999-01-31 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('b25', 'Bunisset', 'Denise', '1 r Lionne', '49100', 'ANGERS', '1994-07-03 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('b28', 'Cacheux', 'Bernard', '114 r Authie', '34000', 'MONTPELLIER', '2000-08-02 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('b34', 'Cadic', 'Eric', '123 r Caponière', '41000', 'BLOIS', '1993-12-06 00:00:00', 'P', 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('b4', 'Charoze', 'Catherine', '100 pl Géants', '33000', 'BORDEAUX', '1997-09-25 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('b50', 'Clepkens', 'Christophe', '12 r Fédérico Garcia Lorca', '13000', 'MARSEILLE', '1998-01-18 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('b59', 'Cottin', 'Vincenne', '36 sq Capucins', '5000', 'GAP', '1995-10-21 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('c14', 'Daburon', 'François', '13 r Champs Elysées', '6000', 'NICE', '1989-02-01 00:00:00', 'S', 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('c3', 'De', 'Philippe', '13 r Charles Peguy', '10000', 'TROYES', '1992-05-05 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('c54', 'Debelle', 'Michel', '181 r Caponière', '88000', 'EPINAL', '1991-04-09 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('d13', 'Debelle', 'Jeanne', '134 r Stalingrad', '44000', 'NANTES', '1991-12-05 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('d51', 'Debroise', 'Michel', '2 av 6 Juin', '70000', 'VESOUL', '1997-11-18 00:00:00', 'E', 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('e22', 'Desmarquest', 'Nathalie', '14 r Fédérico Garcia Lorca', '54000', 'NANCY', '1989-03-24 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('e24', 'Desnost', 'Pierre', '16 r Barral de Montferrat', '55000', 'VERDUN', '1993-05-17 00:00:00', 'E', 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('e39', 'Dudouit', 'Frédéric', '18 quai Xavier Jouvin', '75000', 'PARIS', '1988-04-26 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('e49', 'Duncombe', 'Claude', '19 av Alsace Lorraine', '9000', 'FOIX', '1996-02-19 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('e5', 'Enault-Pascreau', 'Céline', '25B r Stalingrad', '40000', 'MONT DE MARSAN', '1990-11-27 00:00:00', 'S', 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('e52', 'Eynde', 'Valérie', '3 r Henri Moissan', '76000', 'ROUEN', '1991-10-31 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('f21', 'Finck', 'Jacques', 'rte Montreuil Bellay', '74000', 'ANNECY', '1993-06-08 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('f39', 'Frémont', 'Fernande', '4 r Jean Giono', '69000', 'LYON', '1997-02-15 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('f4', 'Gest', 'Alain', '30 r Authie', '46000', 'FIGEAC', '1994-05-03 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('g19', 'Gheysen', 'Galassus', '32 bd Mar Foch', '75000', 'PARIS', '1996-01-18 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('g30', 'Girard', 'Yvon', '31 av 6 Juin', '80000', 'AMIENS', '1999-03-27 00:00:00', 'N', 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('g53', 'Gombert', 'Luc', '32 r Emile Gueymard', '56000', 'VANNES', '1985-10-02 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('g7', 'Guindon', 'Caroline', '40 r Mar Montgomery', '87000', 'LIMOGES', '1996-01-13 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('h13', 'Guindon', 'François', '44 r Picotière', '19000', 'TULLE', '1993-05-08 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('h30', 'Igigabel', 'Guy', '33 gal Arlequin', '94000', 'CRETEIL', '1998-04-26 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('h35', 'Jourdren', 'Pierre', '34 av Jean Perrot', '15000', 'AURRILLAC', '1993-08-26 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('h40', 'Juttard', 'Pierre-Raoul', '34 cours Jean Jaurès', '8000', 'SEDAN', '1992-11-01 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('j45', 'Labouré-Morel', 'Saout', '38 cours Berriat', '52000', 'CHAUMONT', '1998-02-25 00:00:00', 'N', 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('j50', 'Landré', 'Philippe', '4 av Gén Laperrine', '59000', 'LILLE', '1992-12-16 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('j8', 'Langeard', 'Hugues', '39 av Jean Perrot', '93000', 'BAGNOLET', '1998-06-18 00:00:00', 'P', 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('k4', 'Lanne', 'Bernard', '4 r Bayeux', '30000', 'NIMES', '1996-11-21 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('k53', 'Le', 'Noël', '4 av Beauvert', '68000', 'MULHOUSE', '1983-03-23 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('l14', 'Le', 'Jean', '39 r Raspail', '53000', 'LAVAL', '1995-02-02 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('l23', 'Leclercq', 'Servane', '11 r Quinconce', '18000', 'BOURGES', '1995-06-05 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('l46', 'Lecornu', 'Jean-Bernard', '4 bd Mar Foch', '72000', 'LA FERTE BERNARD', '1997-01-24 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('l56', 'Lecornu', 'Ludovic', '4 r Abel Servien', '25000', 'BESANCON', '1996-02-27 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('m35', 'Lejard', 'Agnès', '4 r Anthoard', '82000', 'MONTAUBAN', '1987-10-06 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('m45', 'Lesaulnier', 'Pascal', '47 r Thiers', '57000', 'METZ', '1990-10-13 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('n42', 'Letessier', 'Stéphane', '5 chem Capuche', '27000', 'EVREUX', '1996-03-06 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('n58', 'Loirat', 'Didier', 'Les Pêchers cité Bourg la Croix', '45000', 'ORLEANS', '1992-08-30 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('n59', 'Maffezzoli', 'Thibaud', '5 r Chateaubriand', '2000', 'LAON', '1994-12-19 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('o26', 'Mancini', 'Anne', '5 r D\'Agier', '48000', 'MENDE', '1995-01-05 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('p32', 'Marcouiller', 'Gérard', '7 pl St Gilles', '91000', 'ISSY LES MOULINEAUX', '1992-12-24 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('p40', 'Michel', 'Jean-Claude', '5 r Gabriel Péri', '61000', 'FLERS', '1992-12-14 00:00:00', 'O', 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('p41', 'Montecot', 'Françoise', '6 r Paul Valéry', '17000', 'SAINTES', '1998-07-27 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('p42', 'Notini', 'Veronique', '5 r Lieut Chabal', '60000', 'BEAUVAIS', '1994-12-12 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('p49', 'Onfroy', 'Den', '5 r Sidonie Jacolin', '37000', 'TOURS', '1977-10-03 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('p6', 'Pascreau', 'Charles', '57 bd Mar Foch', '64000', 'PAU', '1997-03-30 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('p7', 'Pernot', 'Claude-Noël', '6 r Alexandre 1 de Yougoslavie', '11000', 'NARBONNE', '1990-03-01 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('p8', 'Perrier', 'Maître', '6 r Aubert Dubayet', '71000', 'CHALON SUR SAONE', '1991-06-23 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('q17', 'Petit', 'Jean-Louis', '7 r Ernest Renan', '50000', 'SAINT LO', '1997-09-06 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('r24', 'Piquery', 'Patrick', '9 r Vaucelles', '14000', 'CAEN', '1984-07-29 00:00:00', 'O', 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('r58', 'Quiquandon', 'Joël', '7 r Ernest Renan', '29000', 'QUIMPER', '1990-06-30 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('s10', 'Retailleau', 'Josselin', '88Bis r Saumuroise', '39000', 'DOLE', '1995-11-14 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('s21', 'Retailleau', 'Pascal', '32 bd Ayrault', '23000', 'MONTLUCON', '1992-09-25 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('t43', 'Souron', 'Maryse', '7B r Gay Lussac', '21000', 'DIJON', '1995-03-09 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('t47', 'Tiphagne', 'Patrick', '7B r Gay Lussac', '62000', 'ARRAS', '1997-08-29 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('t55', 'Tréhet', 'Alain', '7D chem Barral', '12000', 'RODEZ', '1994-11-29 00:00:00', NULL, 'SW');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('t60', 'Tusseau', 'Josselin', '63 r Bon Repos', '28000', 'CHARTRES', '1991-03-29 00:00:00', NULL, 'GY');
INSERT INTO `VISITEUR` (`VIS_MATRICULE`, `VIS_NOM`, `Vis_PRENOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES ('zzz', 'swiss', 'bourdin', NULL, NULL, NULL, '2003-06-18 00:00:00', NULL, 'BC');
# 68 records

