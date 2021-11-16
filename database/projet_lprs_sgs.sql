-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 16 nov. 2021 à 10:48
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_lprs_sgs`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `idAdmin` int(11) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT '4',
  `RefUser` int(11) NOT NULL,
  PRIMARY KEY (`idAdmin`),
  KEY `RefUser` (`RefUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`idAdmin`, `statut`, `RefUser`) VALUES
(1, 4, 0);

-- --------------------------------------------------------

--
-- Structure de la table `discussion`
--

DROP TABLE IF EXISTS `discussion`;
CREATE TABLE IF NOT EXISTS `discussion` (
  `idDiscussion` int(11) NOT NULL AUTO_INCREMENT,
  `idCreateur` int(11) NOT NULL,
  `idInvite` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `dateCreation` datetime NOT NULL,
  PRIMARY KEY (`idDiscussion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `discussion`
--

INSERT INTO `discussion` (`idDiscussion`, `idCreateur`, `idInvite`, `titre`, `description`, `dateCreation`) VALUES
(1, 2, 4, 'aaaaaaaaaaaa', 'aaaaaaaaaaaa', '2021-11-10 14:38:32'),
(2, 4, 4, 'test', 'test', '2021-11-14 18:12:36'),
(3, 2, 4, 'Test2', 'Test2', '2021-11-16 08:18:41');

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `idEleve` int(11) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT '1',
  `classe` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `RefUser` int(11) NOT NULL,
  PRIMARY KEY (`idEleve`),
  KEY `RefUser` (`RefUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`idEleve`, `statut`, `classe`, `RefUser`) VALUES
(2, 1, 'SLAM2', 0),
(7, 1, 'Test2', 7);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `idEvent` int(11) NOT NULL AUTO_INCREMENT,
  `idCreateur` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `organisateur` varchar(40) NOT NULL,
  `type` char(7) NOT NULL DEFAULT 'Interne',
  `date` date NOT NULL,
  `horaire` time NOT NULL,
  `dateCreation` datetime NOT NULL,
  `validEvent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idEvent`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`idEvent`, `idCreateur`, `nom`, `description`, `organisateur`, `type`, `date`, `horaire`, `dateCreation`, `validEvent`) VALUES
(1, 1, 'T', 'T', 'T', 'Interne', '2021-11-02', '22:00:00', '2021-11-02 10:21:27', 1);

-- --------------------------------------------------------

--
-- Structure de la table `parent`
--

DROP TABLE IF EXISTS `parent`;
CREATE TABLE IF NOT EXISTS `parent` (
  `idParent` int(11) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT '2',
  `metier` varchar(40) NOT NULL,
  `idEleve` int(11) NOT NULL,
  `RefUser` int(11) NOT NULL,
  PRIMARY KEY (`idParent`),
  KEY `RefUser` (`RefUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `parent`
--

INSERT INTO `parent` (`idParent`, `statut`, `metier`, `idEleve`, `RefUser`) VALUES
(3, 2, 'Banque', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `idProf` int(11) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT '3',
  `matiere` varchar(40) NOT NULL,
  `RefUser` int(11) NOT NULL,
  PRIMARY KEY (`idProf`),
  KEY `RefUser` (`RefUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`idProf`, `statut`, `matiere`, `RefUser`) VALUES
(4, 3, 'Math', 0);

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `idRdv` int(11) NOT NULL AUTO_INCREMENT,
  `idCreateur` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `message` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `horaire` time NOT NULL,
  `dateCreation` datetime NOT NULL,
  PRIMARY KEY (`idRdv`),
  KEY `idCreateur` (`idCreateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `idReponse` int(11) NOT NULL AUTO_INCREMENT,
  `idDiscussion` int(11) NOT NULL,
  `idCreateur` int(11) NOT NULL,
  `reponse` text CHARACTER SET utf8 NOT NULL,
  `dateCreation` date NOT NULL,
  PRIMARY KEY (`idReponse`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`idReponse`, `idDiscussion`, `idCreateur`, `reponse`, `dateCreation`) VALUES
(1, 3, 2, 'Hola!!\r\n', '2021-11-16');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `dateNaissance` date NOT NULL,
  `adresse` text NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `mail` text NOT NULL,
  `login` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mdp` text NOT NULL,
  `validUtilisateur` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `nom`, `prenom`, `dateNaissance`, `adresse`, `telephone`, `mail`, `login`, `mdp`, `validUtilisateur`) VALUES
(1, 'root', 'root', '2021-10-26', 'root', '1111111111', 'root@root.root', 'root', 'root', 1),
(2, 'eleve', 'eleve', '2021-09-28', 'eleve', '2222222222', 'eleve@gmail.com', 'eleve', 'eleve', 1),
(3, 'parent', 'parent', '2021-09-28', 'parent', '3333333333', 'parent@gmail.com', 'parent', 'parent', 1),
(4, 'prof', 'prof', '2021-09-28', 'prof', '4444444444', 'prof@gmail.com', 'prof', 'prof', 1),
(5, 'Sedjai', 'Nora', '2021-11-16', '10 rue du pain', '0202908943', 'n.sedjai@lprs.fr', 'Nora', 'SED', 1),
(6, 'TestCO', 'TestCO', '2021-11-16', 'TestCO', '2436121212', 'norasejai@gmail.com', 'TestCO', 'TestCO', 0),
(7, 'Test2', 'Test2', '2021-11-09', 'Test2', '8695894738', 'nora.sedj@gmail.com', 'Test2', 'Test2', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
