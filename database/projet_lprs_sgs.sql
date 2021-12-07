-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 30 nov. 2021 à 09:11
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
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `idUtil` int(11) NOT NULL,
  PRIMARY KEY (`idAdmin`),
  KEY `idUtil` (`idUtil`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`idAdmin`, `idUtil`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `discussion`
--

DROP TABLE IF EXISTS `discussion`;
CREATE TABLE IF NOT EXISTS `discussion` (
  `idDiscussion` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `dateCreation` datetime NOT NULL,
  `idCreateurEleve` int(11) DEFAULT NULL,
  `idCreateurProf` int(11) DEFAULT NULL,
  `idInviteEleve` int(11) DEFAULT NULL,
  `idInviteProf` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDiscussion`),
  KEY `idCreateurProf` (`idCreateurProf`),
  KEY `idCreateurEleve` (`idCreateurEleve`) USING BTREE,
  KEY `idInviteEleve` (`idInviteEleve`),
  KEY `idInviteProf` (`idInviteProf`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `idEleve` int(11) NOT NULL AUTO_INCREMENT,
  `classe` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `idUtil` int(11) NOT NULL,
  PRIMARY KEY (`idEleve`),
  KEY `idUtil` (`idUtil`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`idEleve`, `classe`, `idUtil`) VALUES
(1, 'SLAM2', 2),
(2, 'Test2', 7);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `idEvent` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `type` char(7) NOT NULL DEFAULT 'Interne',
  `date` date NOT NULL,
  `horaire` time NOT NULL,
  `dateCreation` datetime NOT NULL,
  `validEvent` int(11) NOT NULL DEFAULT '0',
  `idCreateurEleve` int(11) DEFAULT NULL,
  `idCreateurParent` int(11) DEFAULT NULL,
  `idCreateurProf` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEvent`),
  KEY `idCreateurProf` (`idCreateurProf`),
  KEY `idCreateurEleve` (`idCreateurEleve`) USING BTREE,
  KEY `idCreateurParent` (`idCreateurParent`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`idEvent`, `titre`, `description`, `type`, `date`, `horaire`, `dateCreation`, `validEvent`, `idCreateurEleve`, `idCreateurParent`, `idCreateurProf`) VALUES
(5, 'A', 'A', 'Interne', '2021-12-01', '10:00:00', '2021-11-29 00:00:00', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `inscription_event`
--

DROP TABLE IF EXISTS `inscription_event`;
CREATE TABLE IF NOT EXISTS `inscription_event` (
  `idInscription` int(11) NOT NULL AUTO_INCREMENT,
  `idEleve` int(11) DEFAULT NULL,
  `idParent` int(11) DEFAULT NULL,
  `idProf` int(11) DEFAULT NULL,
  `idEvent` int(11) NOT NULL,
  PRIMARY KEY (`idInscription`),
  KEY `idEvent` (`idEvent`),
  KEY `idEleve` (`idEleve`) USING BTREE,
  KEY `idParent` (`idParent`),
  KEY `idProf` (`idProf`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `inscription_event`
--

INSERT INTO `inscription_event` (`idInscription`, `idEleve`, `idParent`, `idProf`, `idEvent`) VALUES
(3, NULL, NULL, 1, 5),
(4, 1, NULL, NULL, 5),
(5, 1, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Structure de la table `parent`
--

DROP TABLE IF EXISTS `parent`;
CREATE TABLE IF NOT EXISTS `parent` (
  `idParent` int(11) NOT NULL AUTO_INCREMENT,
  `metier` varchar(40) NOT NULL,
  `idUtil` int(11) NOT NULL,
  PRIMARY KEY (`idParent`),
  KEY `idUtil` (`idUtil`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `parent`
--

INSERT INTO `parent` (`idParent`, `metier`, `idUtil`) VALUES
(1, 'Banque', 3);

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `idProf` int(11) NOT NULL AUTO_INCREMENT,
  `matiere` varchar(40) NOT NULL,
  `idUtil` int(11) NOT NULL,
  PRIMARY KEY (`idProf`),
  KEY `idUtil` (`idUtil`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`idProf`, `matiere`, `idUtil`) VALUES
(1, 'Math', 4);

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `idRdv` int(11) NOT NULL AUTO_INCREMENT,
  `objet` varchar(40) NOT NULL,
  `message` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `horaire` time NOT NULL,
  `dateCreation` datetime NOT NULL,
  `idCreateurParent` int(11) DEFAULT NULL,
  `idCreateurProf` int(11) DEFAULT NULL,
  `idInviteParent` int(11) DEFAULT NULL,
  `idInviteProf` int(11) DEFAULT NULL,
  `validEvent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idRdv`),
  KEY `idCreateurProf` (`idCreateurProf`),
  KEY `idCreateurParent` (`idCreateurParent`) USING BTREE,
  KEY `idInviteParent` (`idInviteParent`),
  KEY `idInviteProf` (`idInviteProf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `idReponse` int(11) NOT NULL AUTO_INCREMENT,
  `reponse` text NOT NULL,
  `dateCreation` date NOT NULL,
  `idDiscussion` int(11) NOT NULL,
  `idCreateurEleve` int(11) DEFAULT NULL,
  `idCreateurProf` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReponse`),
  KEY `idDiscussion` (`idDiscussion`),
  KEY `idCreateurProf` (`idCreateurProf`),
  KEY `idCreateurEleve` (`idCreateurEleve`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `responsable`
--

DROP TABLE IF EXISTS `responsable`;
CREATE TABLE IF NOT EXISTS `responsable` (
  `idResponsable` int(11) NOT NULL AUTO_INCREMENT,
  `idParent` int(11) NOT NULL,
  `idEleve` int(11) NOT NULL,
  PRIMARY KEY (`idResponsable`),
  KEY `idParent` (`idParent`),
  KEY `idEleve` (`idEleve`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `responsable`
--

INSERT INTO `responsable` (`idResponsable`, `idParent`, `idEleve`) VALUES
(1, 1, 1);

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
  `statut` int(1) NOT NULL DEFAULT '0',
  `validUtilisateur` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `nom`, `prenom`, `dateNaissance`, `adresse`, `telephone`, `mail`, `login`, `mdp`, `statut`, `validUtilisateur`) VALUES
(1, 'root', 'root', '2021-10-26', 'root', '1111111111', 'root@root.root', 'root', 'root', 4, 1),
(2, 'eleve', 'eleve', '2021-09-28', 'eleve', '2222222222', 'eleve@gmail.com', 'eleve', 'eleve', 1, 1),
(3, 'parent', 'parent', '2021-09-28', 'parent', '3333333333', 'parent@gmail.com', 'parent', 'parent', 2, 1),
(4, 'prof', 'prof', '2021-09-28', 'prof', '4444444444', 'prof@gmail.com', 'prof', 'prof', 3, 1),
(5, 'Sedjai', 'Nora', '2021-11-16', '10 rue du pain', '0202908943', 'n.sedjai@lprs.fr', 'Nora', 'SED', 0, 1),
(6, 'TestCO', 'TestCO', '2021-11-16', 'TestCO', '2436121212', 'norasejai@gmail.com', 'TestCO', 'TestCO', 0, 0),
(7, 'Test2', 'Test2', '2021-11-09', 'Test2', '8695894738', 'nora.sedj@gmail.com', 'Test2', 'Test2', 1, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`idUtil`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `discussion`
--
ALTER TABLE `discussion`
  ADD CONSTRAINT `discussion_ibfk_1` FOREIGN KEY (`idCreateurProf`) REFERENCES `professeur` (`idProf`),
  ADD CONSTRAINT `discussion_ibfk_2` FOREIGN KEY (`idInviteProf`) REFERENCES `professeur` (`idProf`),
  ADD CONSTRAINT `discussion_ibfk_3` FOREIGN KEY (`idCreateurEleve`) REFERENCES `eleve` (`idEleve`),
  ADD CONSTRAINT `discussion_ibfk_4` FOREIGN KEY (`idInviteEleve`) REFERENCES `eleve` (`idEleve`);

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `eleve_ibfk_1` FOREIGN KEY (`idUtil`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`idCreateurEleve`) REFERENCES `eleve` (`idEleve`),
  ADD CONSTRAINT `evenement_ibfk_3` FOREIGN KEY (`idCreateurProf`) REFERENCES `professeur` (`idProf`),
  ADD CONSTRAINT `evenement_ibfk_4` FOREIGN KEY (`idCreateurParent`) REFERENCES `parent` (`idParent`);

--
-- Contraintes pour la table `inscription_event`
--
ALTER TABLE `inscription_event`
  ADD CONSTRAINT `inscription_event_ibfk_1` FOREIGN KEY (`idEvent`) REFERENCES `evenement` (`idEvent`),
  ADD CONSTRAINT `inscription_event_ibfk_2` FOREIGN KEY (`idEleve`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `inscription_event_ibfk_3` FOREIGN KEY (`idParent`) REFERENCES `parent` (`idParent`),
  ADD CONSTRAINT `inscription_event_ibfk_4` FOREIGN KEY (`idProf`) REFERENCES `professeur` (`idProf`);

--
-- Contraintes pour la table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `parent_ibfk_1` FOREIGN KEY (`idUtil`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD CONSTRAINT `professeur_ibfk_2` FOREIGN KEY (`idUtil`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD CONSTRAINT `rdv_ibfk_1` FOREIGN KEY (`idCreateurProf`) REFERENCES `professeur` (`idProf`),
  ADD CONSTRAINT `rdv_ibfk_2` FOREIGN KEY (`idCreateurParent`) REFERENCES `parent` (`idParent`),
  ADD CONSTRAINT `rdv_ibfk_3` FOREIGN KEY (`idInviteParent`) REFERENCES `parent` (`idParent`),
  ADD CONSTRAINT `rdv_ibfk_4` FOREIGN KEY (`idInviteProf`) REFERENCES `professeur` (`idProf`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`idDiscussion`) REFERENCES `discussion` (`idDiscussion`),
  ADD CONSTRAINT `reponse_ibfk_2` FOREIGN KEY (`idCreateurProf`) REFERENCES `professeur` (`idProf`),
  ADD CONSTRAINT `reponse_ibfk_3` FOREIGN KEY (`idCreateurEleve`) REFERENCES `eleve` (`idEleve`);

--
-- Contraintes pour la table `responsable`
--
ALTER TABLE `responsable`
  ADD CONSTRAINT `responsable_ibfk_1` FOREIGN KEY (`idParent`) REFERENCES `parent` (`idParent`),
  ADD CONSTRAINT `responsable_ibfk_2` FOREIGN KEY (`idEleve`) REFERENCES `eleve` (`idEleve`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
