-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 21 nov. 2021 à 20:32
-- Version du serveur : 8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_lprs_sgs`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `idAdmin` int NOT NULL AUTO_INCREMENT,
  `statut` int NOT NULL DEFAULT '4',
  `idUtil` int NOT NULL,
  PRIMARY KEY (`idAdmin`),
  KEY `idUtil` (`idUtil`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`idAdmin`, `statut`, `idUtil`) VALUES
(1, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `discussion`
--

DROP TABLE IF EXISTS `discussion`;
CREATE TABLE IF NOT EXISTS `discussion` (
  `idDiscussion` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dateCreation` datetime NOT NULL,
  `idCreateurEleve` int DEFAULT NULL,
  `idCreateurProf` int DEFAULT NULL,
  `idInviteEleve` int DEFAULT NULL,
  `idInviteProf` int DEFAULT NULL,
  PRIMARY KEY (`idDiscussion`),
  KEY `idCreateurProf` (`idCreateurProf`),
  KEY `idCreateurEleve` (`idCreateurEleve`) USING BTREE,
  KEY `idInviteEleve` (`idInviteEleve`),
  KEY `idInviteProf` (`idInviteProf`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `idEleve` int NOT NULL AUTO_INCREMENT,
  `statut` int NOT NULL DEFAULT '1',
  `classe` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `idUtil` int NOT NULL,
  PRIMARY KEY (`idEleve`),
  KEY `idUtil` (`idUtil`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`idEleve`, `statut`, `classe`, `idUtil`) VALUES
(1, 1, 'SLAM2', 2),
(2, 1, 'Test2', 7);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `idEvent` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text NOT NULL,
  `type` char(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Interne',
  `date` date NOT NULL,
  `horaire` time NOT NULL,
  `dateCreation` datetime NOT NULL,
  `validEvent` int NOT NULL DEFAULT '0',
  `idCreateurEleve` int DEFAULT NULL,
  `idCreateurProf` int DEFAULT NULL,
  `idInscritEleve` int DEFAULT NULL,
  `idInscritParent` int DEFAULT NULL,
  `idInscritProf` int DEFAULT NULL,
  PRIMARY KEY (`idEvent`),
  KEY `idCreateurProf` (`idCreateurProf`),
  KEY `idInscritEleve` (`idInscritEleve`),
  KEY `idInscritProf` (`idInscritProf`),
  KEY `idInscritParent` (`idInscritParent`),
  KEY `idCreateurEleve` (`idCreateurEleve`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `parent`
--

DROP TABLE IF EXISTS `parent`;
CREATE TABLE IF NOT EXISTS `parent` (
  `idParent` int NOT NULL AUTO_INCREMENT,
  `statut` int NOT NULL DEFAULT '2',
  `metier` varchar(40) NOT NULL,
  `idUtil` int NOT NULL,
  PRIMARY KEY (`idParent`),
  KEY `idUtil` (`idUtil`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `parent`
--

INSERT INTO `parent` (`idParent`, `statut`, `metier`, `idUtil`) VALUES
(1, 2, 'Banque', 3);

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `idProf` int NOT NULL AUTO_INCREMENT,
  `statut` int NOT NULL DEFAULT '3',
  `matiere` varchar(40) NOT NULL,
  `idUtil` int NOT NULL,
  PRIMARY KEY (`idProf`),
  KEY `idUtil` (`idUtil`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`idProf`, `statut`, `matiere`, `idUtil`) VALUES
(1, 3, 'Math', 4);

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `idRdv` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `message` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` date NOT NULL,
  `horaire` time NOT NULL,
  `dateCreation` datetime NOT NULL,
  `idCreateurParent` int DEFAULT NULL,
  `idCreateurProf` int DEFAULT NULL,
  `idInviteParent` int DEFAULT NULL,
  `idInviteProf` int DEFAULT NULL,
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
  `idReponse` int NOT NULL AUTO_INCREMENT,
  `reponse` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dateCreation` date NOT NULL,
  `idDiscussion` int NOT NULL,
  `idCreateurEleve` int DEFAULT NULL,
  `idCreateurProf` int DEFAULT NULL,
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
  `idResponsable` int NOT NULL AUTO_INCREMENT,
  `idParent` int NOT NULL,
  `idEleve` int NOT NULL,
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
  `idUtilisateur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `dateNaissance` date NOT NULL,
  `adresse` text NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `mail` text NOT NULL,
  `login` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mdp` text NOT NULL,
  `validUtilisateur` int NOT NULL DEFAULT '0',
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
  ADD CONSTRAINT `evenement_ibfk_2` FOREIGN KEY (`idInscritEleve`) REFERENCES `eleve` (`idEleve`),
  ADD CONSTRAINT `evenement_ibfk_3` FOREIGN KEY (`idCreateurProf`) REFERENCES `professeur` (`idProf`),
  ADD CONSTRAINT `evenement_ibfk_4` FOREIGN KEY (`idInscritProf`) REFERENCES `professeur` (`idProf`),
  ADD CONSTRAINT `evenement_ibfk_5` FOREIGN KEY (`idInscritParent`) REFERENCES `parent` (`idParent`);

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
