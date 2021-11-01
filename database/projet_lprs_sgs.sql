-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 01, 2021 at 09:26 PM
-- Server version: 8.0.21
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_lprs_sgs`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `idAdmin` int NOT NULL,
  `statut` int NOT NULL DEFAULT '4',
  `validation` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrateur`
--

INSERT INTO `administrateur` (`idAdmin`, `statut`, `validation`) VALUES
(1, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

DROP TABLE IF EXISTS `discussion`;
CREATE TABLE IF NOT EXISTS `discussion` (
  `idDiscussion` int NOT NULL AUTO_INCREMENT,
  `idCreateur` int NOT NULL,
  `idInvite` int NOT NULL,
  `dateCreation` datetime NOT NULL,
  `archive` text NOT NULL,
  PRIMARY KEY (`idDiscussion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `idEleve` int NOT NULL,
  `statut` int NOT NULL DEFAULT '1',
  `classe` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idEleve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eleve`
--

INSERT INTO `eleve` (`idEleve`, `statut`, `classe`) VALUES
(2, 1, 'SLAM2');

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `idEvent` int NOT NULL AUTO_INCREMENT,
  `idCreateur` int NOT NULL,
  `nom` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `organisateur` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` char(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Interne',
  `date` date NOT NULL,
  `horaire` time NOT NULL,
  `dateCreation` datetime NOT NULL,
  `validEvent` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`idEvent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

DROP TABLE IF EXISTS `parent`;
CREATE TABLE IF NOT EXISTS `parent` (
  `idParent` int NOT NULL,
  `statut` int NOT NULL DEFAULT '2',
  `metier` varchar(40) NOT NULL,
  `idEleve` int NOT NULL,
  PRIMARY KEY (`idParent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`idParent`, `statut`, `metier`, `idEleve`) VALUES
(3, 2, 'Banque', 1);

-- --------------------------------------------------------

--
-- Table structure for table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `idProf` int NOT NULL,
  `statut` int NOT NULL DEFAULT '3',
  `matiere` varchar(40) NOT NULL,
  `validation` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idProf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `professeur`
--

INSERT INTO `professeur` (`idProf`, `statut`, `matiere`, `validation`) VALUES
(4, 3, 'Math', 1);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `dateNaissance` date NOT NULL,
  `adresse` text NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `mail` text NOT NULL,
  `login` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mdp` text NOT NULL,
  `statut` int NOT NULL DEFAULT '0',
  `validUtilisateur` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `nom`, `prenom`, `dateNaissance`, `adresse`, `telephone`, `mail`, `login`, `mdp`, `statut`, `validUtilisateur`) VALUES
(1, 'root', 'root', '2021-10-26', 'root', '0999999999', 'root@root.root', 'root', 'root', 4, 1),
(2, 'eleve', 'eleve', '2021-09-28', 'eleve', '0999999999', 'eleve@gmail.com', 'eleve', 'eleve', 1, 0),
(3, 'parent', 'parent', '2021-09-28', 'parent', '0999999999', 'parent@gmail.com', 'parent', 'parent', 2, 0),
(4, 'prof', 'prof', '2021-09-28', 'prof', '0999999999', 'prof@gmail.com', 'prof', 'prof', 3, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
