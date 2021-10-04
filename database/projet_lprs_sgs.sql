-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 01, 2021 at 09:01 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

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
  `statut` int(1) DEFAULT '4',
  `validation` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrateur`
--

INSERT INTO `administrateur` (`statut`, `validation`) VALUES
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

DROP TABLE IF EXISTS `discussion`;
CREATE TABLE IF NOT EXISTS `discussion` (
  `idDiscussion` int(11) NOT NULL,
  `idCreateur` int(11) NOT NULL,
  `idInvite` int(11) NOT NULL,
  `dateCreation` datetime NOT NULL,
  `archive` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `statut` int(1) NOT NULL DEFAULT '2',
  `classe` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eleve`
--

INSERT INTO `eleve` (`statut`, `classe`) VALUES
(2, '2nde'),
(2, '1ere'),
(2, 'Term');

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `idEvent` int(11) NOT NULL AUTO_INCREMENT,
  `idCreateur` int(11) NOT NULL,
  `date` date NOT NULL,
  `horaire` time NOT NULL,
  `dateCreation` datetime NOT NULL,
  `description` varchar(40) NOT NULL,
  `organisateur` varchar(40) NOT NULL,
  `validEvenement` int(11) NOT NULL,
  PRIMARY KEY (`idEvent`),
  KEY `idCreateur` (`idCreateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

DROP TABLE IF EXISTS `parent`;
CREATE TABLE IF NOT EXISTS `parent` (
  `statut` int(1) NOT NULL DEFAULT '3',
  `metier` varchar(40) DEFAULT NULL,
  `idEleve` int(11) NOT NULL,
  KEY `idEleve` (`idEleve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`statut`, `metier`, `idEleve`) VALUES
(3, 'Banque', 1);

-- --------------------------------------------------------

--
-- Table structure for table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `statut` int(1) NOT NULL DEFAULT '1',
  `matiere` varchar(40) DEFAULT NULL,
  `validation` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `professeur`
--

INSERT INTO `professeur` (`statut`, `matiere`, `validation`) VALUES
(1, 'Math', 1);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(2) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) DEFAULT NULL,
  `prenom` varchar(40) DEFAULT NULL,
  `dateNaissance` date DEFAULT NULL,
  `adresse` text,
  `telephone` varchar(10) DEFAULT NULL,
  `mail` text,
  `login` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `mdp` text,
  `statut` int(1) NOT NULL DEFAULT '0',
  `validUtilisateur` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `nom`, `prenom`, `dateNaissance`, `adresse`, `telephone`, `mail`, `login`, `mdp`, `statut`, `validUtilisateur`) VALUES
(1, 'root', 'root', '2021-09-28', 'root', '0999999999', 'root@gmail.com', 'root', 'root', 4, 1),
(2, 'eleve', 'eleve', '2021-09-28', 'eleve', '0999999999', 'eleve@gmail.com', 'eleve', 'eleve', 1, 0),
(3, 'parent', 'parent', '2021-09-28', 'parent', '0999999999', 'parent@gmail.com', 'parent', 'parent', 2, 0),
(4, 'prof', 'prof', '2021-09-28', 'prof', '0999999999', 'prof@gmail.com', 'prof', 'prof', 3, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;