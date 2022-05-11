-- phpMyAdmin SQL Dump
-- version 4.8.4
-- SQLINES DEMO *** admin.net/
--
-- SQLINES DEMO *** :3306
-- SQLINES DEMO *** en. 08 oct. 2021 à 23:34
-- SQLINES DEMO *** r :  5.7.24
-- SQLINES DEMO ***  5.6.40

/* SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO"; */
AUTOCOMMIT := 0;
START TRANSACTION;
time_zone := "+00:00";


/* SQLINES DEMO *** ARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/* SQLINES DEMO *** ARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/* SQLINES DEMO *** LLATION_CONNECTION=@@COLLATION_CONNECTION */;
/* SQLINES DEMO *** tf8mb4 */;

--
-- SQLINES DEMO *** :  `ecommerce_voiture`
--

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** able `administrateurs`
--

BEGIN
   EXECUTE IMMEDIATE 'DROP TABLE administrateurs';
EXCEPTION
   WHEN OTHERS THEN NULL;
END;
/
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE administrateurs (
  REFADMIN number(10) NOT NULL,
  EMAIL clob,
  CONTACT clob,
  IDENTIFIENT clob,
  PASSE_CODE clob,
  DATE_ABONNE timestamp(0) DEFAULT SYSTIMESTAMP NULL,
  PRIMARY KEY (REFADMIN)
)   ;

-- Generate ID using sequence and trigger
CREATE SEQUENCE administrateurs_seq START WITH 2 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER administrateurs_seq_tr
 BEFORE INSERT ON administrateurs FOR EACH ROW
 WHEN (NEW.REFADMIN IS NULL)
BEGIN
 SELECT administrateurs_seq.NEXTVAL INTO :NEW.REFADMIN FROM DUAL;
END;
/

--
-- SQLINES DEMO ***  données de la table `administrateurs`
--

INSERT INTO administrateurs (REFADMIN, EMAIL, CONTACT, IDENTIFIENT, PASSE_CODE, DATE_ABONNE) VALUES
(1, 'kouaoboris@gmail.com', '000000000', 'admin', 'admin', '2021-09-13 20:37:21');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** able `articles`
--

BEGIN
   EXECUTE IMMEDIATE 'DROP TABLE articles';
EXCEPTION
   WHEN OTHERS THEN NULL;
END;
/
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE articles (
  CODEART number(10) NOT NULL,
  CODECATEGORIE number(10) NOT NULL,
  TITRE clob,
  DESCRIPTION clob,
  PRIX number(10) DEFAULT NULL,
  QUANTITE number(10) DEFAULT NULL CHECK (QUANTITE > 0),
  PHOTO blob,
  idmarque number(10) NOT NULL,
  date_publication timestamp(0) DEFAULT SYSTIMESTAMP NOT NULL,
  PRIMARY KEY (CODEART)
)   ;

-- Generate ID using sequence and trigger
CREATE SEQUENCE articles_seq START WITH 3 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER articles_seq_tr
 BEFORE INSERT ON articles FOR EACH ROW
 WHEN (NEW.CODEART IS NULL)
BEGIN
 SELECT articles_seq.NEXTVAL INTO :NEW.CODEART FROM DUAL;
END;
/

CREATE INDEX FK_ATTRIBUER ON articles (CODECATEGORIE);
CREATE INDEX idmarque ON articles (idmarque);
CREATE INDEX CODECATEGORIE ON articles (CODECATEGORIE);

--
-- SQLINES DEMO ***  données de la table `articles`
--

INSERT INTO articles (CODEART, CODECATEGORIE, TITRE, DESCRIPTION, PRIX, QUANTITE, PHOTO, idmarque, date_publication)
 SELECT 1, 1, 'CHEVROLET CAMARO ZL1', 'Ni modèle de course (quoique), ni préparation extravagante, cette Chevrolet sublime la définition de la muscle-car, au point d’une faire une supercar.rnAprès son temps canon sur le circuit du Nürburgring (Allemagne), il n’y avait plus vraiment de doute, la Camaro ZL1 en a sous la pédale. Et après avoir déjà revendiqué le titre de Camaro la plus puissante jamais produite, la ZL1 pourrait aussi rafler celui de Camaro, voire de Chevrolet, la plus rapide de l’histoire (hors modèles de compétition, bien entendu).rnrnAvec 318,65km/h de moyenne sur l’ovale du site de test de Papenburg, au nord de l' FROM dual UNION ALL   SELECT soit  FROM dual selon les chiffres officiellement donnés par Chevrolet), et même une pointe à 202,3 miles par heure (325km/h) dans un sens sur l’anneau, aidée par le vent, la Camaro ZL1 montre qu'elle n'avait pas usurpé son record du Nürburgring, devant les Koenigsegg CCX, Nissan GT-R de 2011 ou encore la Lexus LFA.', 24000000, 0, 0x63617231342e6a7067, 2, '2021-09-15 <<03>><<10>>31'),
(2, 1, 'AUDI Q7 45 TDI 231 QUATTRO ANNÉE 2019', '<<Cylindrée>> 3.0L V6 inj. directe turbor<<nPuissance>> 231 ch à 3250 tr/minrnBoite de <<vitesse>> Automatiquer<<nTransmission>> 4x4r<<nCouple>> 500 Nm à 1750 tr/minrnrnVitesse <<max>> 229 km/hrnConsommation (urbaine / extra urbaine / moyenne<<)>> 7.10 / 6.20 / 6.50 L/100 kmrnAutonomie <<optimale>> 1371 KmrnAutonomie <<moyenne>> 1308 KmrnAccélération (0 à 100km<<)>> 7.1 srnRejet de <<Co2>> 172 g/km', 14000000, 6, 0x417564692d51372d566f69747572652d536567656d656e742d4772616e64732d5355562e6a7067, 4, '2021-09-15 <<03>><<10>>31');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `CODECATEGORIE` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` text COLLATE utf8_bin,
  `PHOTO` longblob,
  PRIMARY KEY (`CODECATEGORIE`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`CODECATEGORIE`, `LIBELLE`, `PHOTO`) VALUES
(1, 'véhicules SUV et Crossover', NULL),
(2, 'véhicules citadines', NULL),
(3, 'véhicules berlines', NULL),
(4, 'véhicules monospaces', NULL),
(5, 'véhicules utilitaires', NULL),
(6, 'véhicules coupés', NULL),
(7, 'véhicules cabriolets', NULL),
(8, 'véhicules de sport', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `CODECL` int(11) NOT NULL AUTO_INCREMENT,
  `CONTACT` text COLLATE utf8_bin,
  `NOM` text COLLATE utf8_bin,
  `PRENOM` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `EMAIL` text COLLATE utf8_bin,
  `PASSE_CODE` text COLLATE utf8_bin,
  `DATE_ABONNE` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CODECL`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`CODECL`, `CONTACT`, `NOM`, `PRENOM`, `EMAIL`, `PASSE_CODE`, `DATE_ABONNE`) VALUES
(1, '0000', 'client', 'client', 'client@miage.com', 'client', '2021-09-27 <<14>><<58>>44'),
(2, '0103046839', 'kouao', 'Aye boris', 'kouaoboris@gmail.com', '12345', '2021-09-27 <<16>><<28>>03'),
(3, '0000', 'client', 'test', 'clienttest@g.com', 'clienttest', '2021-10-01 <<13>><<41>>01');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `NUMCOM` int(11) NOT NULL AUTO_INCREMENT,
  `CODECL` int(11) NOT NULL,
  `DESTINATION` text COLLATE utf8_bin,
  `LIEUDESTINATION` text COLLATE utf8_bin,
  `DATELIVRAISON` text COLLATE utf8_bin,
  `etats` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`NUMCOM`) USING BTREE,
  KEY `FK_PASSER` (`CODECL`),
  KEY `CODECL` (`CODECL`),
  KEY `NUMCOM` (`NUMCOM`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`NUMCOM`, `CODECL`, `DESTINATION`, `LIEUDESTINATION`, `DATELIVRAISON`, `etats`) VALUES
(1, 1, 'Bonoua', 'COCODY 2', '2021-10-09', 1);

-- --------------------------------------------------------

--
-- Structure de la table `injures`
--

DROP TABLE IF EXISTS `injures`;
CREATE TABLE IF NOT EXISTS `injures` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` text COLLATE utf8_bin,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `injures`
--

INSERT INTO `injures` (`ID`, `LIBELLE`) VALUES
(1, 'malade'),
(2, 'cougnon');

-- --------------------------------------------------------

--
-- Structure de la table `lignecom`
--

DROP TABLE IF EXISTS `lignecom`;
CREATE TABLE IF NOT EXISTS `lignecom` (
  `ligneDetaille` int(11) NOT NULL AUTO_INCREMENT,
  `CODEART` int(11) NOT NULL,
  `NUMCOM` int(11) NOT NULL,
  `QUANTITE` int(11) DEFAULT NULL,
  `SOUSTOTAL` int(11) DEFAULT NULL,
  PRIMARY KEY (`ligneDetaille`),
  KEY `FK_LIGNECOM` (`NUMCOM`),
  KEY `CODEART` (`CODEART`),
  KEY `NUMCOM` (`NUMCOM`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='cela liste la liste des comandes du clientquantite = ';

--
-- Déchargement des données de la table `lignecom`
--

INSERT INTO `lignecom` (`ligneDetaille`, `CODEART`, `NUMCOM`, `QUANTITE`, `SOUSTOTAL`) VALUES
(1, 1, 1, 1, 24000000),
(2, 2, 1, 2, 52000000);

--
-- Déclencheurs `lignecom`
--
DROP TRIGGER IF EXISTS `After_Insert_LigneCom`;
DELIMITER $$
CREATE TRIGGER `After_Insert_LigneCom` AFTER INSERT ON `lignecom` FOR EACH ROW BEGIN 
UPDATE lignecom,commandes,articles SET articles.QUANTITE= articles.QUANTITE - NEW.QUANTITE WHERE new.NUMCOM = commandes.NUMCOM AND articles.CODEART = new.CODEART ; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `marques`
--

DROP TABLE IF EXISTS `marques`;
CREATE TABLE IF NOT EXISTS `marques` (
  `idmarque` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(225) COLLATE utf8_bin NOT NULL,
  `photo` longblob NOT NULL,
  PRIMARY KEY (`idmarque`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `marques`
--

INSERT INTO marques (idmarque, libelle, photo)
 SELECT 1, 'BMW', 0x626d772e706e67 FROM dual UNION ALL 
 SELECT 2, 'chevrolet', 0x63686576726f6c65742e706e67 FROM dual UNION ALL 
 SELECT 3, 'Ford', 0x466f72642e706e67 FROM dual UNION ALL 
 SELECT 4, 'audi', 0x617564692d6c6f676f2e706e67 FROM dual UNION ALL 
 SELECT 5, 'toyota', 0x746f796f74612d6179676f2d6d696e692d6369746164696e652e6a7067 FROM dual UNION ALL 
 SELECT 6, 'mazda', 0x6d617a64612d6c6f676f2e706e67 FROM dual UNION ALL 
 SELECT 7, 'mercedes', 0x6d657263656465732d62656e7a2d6c6f676f2e706e67 FROM dual;

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** able `noter`
--

BEGIN
   EXECUTE IMMEDIATE 'DROP TABLE noter';
EXCEPTION
   WHEN OTHERS THEN NULL;
END;
/
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE noter (
  CODECL number(10) NOT NULL,
  CODEART number(10) NOT NULL,
  NOTE number(10) DEFAULT NULL,
  COMMENTAIRE clob,
  DATE_VOTE timestamp(0) DEFAULT SYSTIMESTAMP NULL,
  CONSTRAINT DATE_VOTE UNIQUE  (DATE_VOTE)
)  ;

CREATE INDEX FK_NOTER ON noter (CODEART);
CREATE INDEX CODEART ON noter (CODEART);
CREATE INDEX CODECL ON noter (CODECL);

--
-- SQLINES DEMO *** les tables déchargées
--

--
-- SQLINES DEMO *** la table `articles`
--
ALTER TABLE articles
  ADD CONSTRAINT articles_ibfk_1 FOREIGN KEY (CODECATEGORIE) REFERENCES categorie (CODECATEGORIE),
  ADD CONSTRAINT articles_ibfk_2 FOREIGN KEY (idmarque) REFERENCES `marques` (idmarque);

--
-- SQLINES DEMO *** la table `lignecom`
--
ALTER TABLE lignecom
  ADD CONSTRAINT lignecom_ibfk_1 FOREIGN KEY (CODEART) REFERENCES articles (CODEART),
  ADD CONSTRAINT lignecom_ibfk_2 FOREIGN KEY (NUMCOM) REFERENCES `commandes` (NUMCOM);

--
-- SQLINES DEMO *** la table `noter`
--
ALTER TABLE noter
  ADD CONSTRAINT noter_ibfk_1 FOREIGN KEY (CODECL) REFERENCES clients (CODECL),
  ADD CONSTRAINT noter_ibfk_2 FOREIGN KEY (CODEART) REFERENCES `articles` (CODEART);
COMMIT;

/* SQLINES DEMO *** ER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/* SQLINES DEMO *** ER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/* SQLINES DEMO *** ON_CONNECTION=@OLD_COLLATION_CONNECTION */;