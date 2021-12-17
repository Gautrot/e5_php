-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 17 déc. 2021 à 11:26
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
  `idUtil` int NOT NULL,
  PRIMARY KEY (`idAdmin`),
  KEY `idUtil` (`idUtil`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`idAdmin`, `idUtil`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id_classe` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(10) NOT NULL,
  PRIMARY KEY (`id_classe`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id_classe`, `nom`) VALUES
(1, 'SLAM1'),
(2, 'SLAM2'),
(3, 'SISR1'),
(4, 'SISR2'),
(5, 'CPRP1'),
(6, 'CPRP2');

-- --------------------------------------------------------

--
-- Structure de la table `discussion`
--

DROP TABLE IF EXISTS `discussion`;
CREATE TABLE IF NOT EXISTS `discussion` (
  `idDiscussion` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `dateCreation` datetime NOT NULL,
  `idCreateurEleve` int DEFAULT NULL,
  `idCreateurProf` int DEFAULT NULL,
  `idCreateurParent` int DEFAULT NULL,
  `idInviteEleve` int DEFAULT NULL,
  `idInviteProf` int DEFAULT NULL,
  `idInviteParent` int DEFAULT NULL,
  PRIMARY KEY (`idDiscussion`),
  KEY `idCreateurProf` (`idCreateurProf`),
  KEY `idCreateurEleve` (`idCreateurEleve`),
  KEY `idCreateurParent` (`idCreateurParent`),
  KEY `idInviteEleve` (`idInviteEleve`),
  KEY `idInviteProf` (`idInviteProf`),
  KEY `idInviteParent` (`idInviteParent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `idEleve` int NOT NULL AUTO_INCREMENT,
  `ref_classe` int NOT NULL,
  `idUtil` int NOT NULL,
  PRIMARY KEY (`idEleve`),
  KEY `idUtil` (`idUtil`),
  KEY `ref_classe` (`ref_classe`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`idEleve`, `ref_classe`, `idUtil`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `idEvent` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `type` char(7) NOT NULL DEFAULT 'Interne',
  `date` date NOT NULL,
  `horaire` time NOT NULL,
  `dateCreation` datetime NOT NULL,
  `validEvent` int NOT NULL DEFAULT '0',
  `idCreateurEleve` int DEFAULT NULL,
  `idCreateurProf` int DEFAULT NULL,
  PRIMARY KEY (`idEvent`),
  KEY `idCreateurProf` (`idCreateurProf`),
  KEY `idCreateurEleve` (`idCreateurEleve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `inscription_event`
--

DROP TABLE IF EXISTS `inscription_event`;
CREATE TABLE IF NOT EXISTS `inscription_event` (
  `idInscription` int NOT NULL AUTO_INCREMENT,
  `idEleve` int DEFAULT NULL,
  `idParent` int DEFAULT NULL,
  `idProf` int DEFAULT NULL,
  `idEvent` int NOT NULL,
  PRIMARY KEY (`idInscription`),
  KEY `idEvent` (`idEvent`),
  KEY `idEleve` (`idEleve`),
  KEY `idParent` (`idParent`),
  KEY `idProf` (`idProf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `parent`
--

DROP TABLE IF EXISTS `parent`;
CREATE TABLE IF NOT EXISTS `parent` (
  `idParent` int NOT NULL AUTO_INCREMENT,
  `metier` varchar(40) NOT NULL,
  `idUtil` int NOT NULL,
  PRIMARY KEY (`idParent`),
  KEY `idUtil` (`idUtil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `idProf` int NOT NULL AUTO_INCREMENT,
  `matiere` varchar(40) NOT NULL,
  `idUtil` int NOT NULL,
  PRIMARY KEY (`idProf`),
  KEY `idUtil` (`idUtil`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`idProf`, `matiere`, `idUtil`) VALUES
(1, 'A', 3);

-- --------------------------------------------------------

--
-- Structure de la table `projet_edu`
--

DROP TABLE IF EXISTS `projet_edu`;
CREATE TABLE IF NOT EXISTS `projet_edu` (
  `id_projet` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ref_classe` int NOT NULL,
  `date` date NOT NULL,
  `ref_prof` int NOT NULL,
  PRIMARY KEY (`id_projet`),
  KEY `ref_prof` (`ref_prof`),
  KEY `ref_classe` (`ref_classe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `idRdv` int NOT NULL AUTO_INCREMENT,
  `objet` varchar(40) NOT NULL,
  `message` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `horaire` time NOT NULL,
  `dateCreation` datetime NOT NULL,
  `idCreateurParent` int DEFAULT NULL,
  `idCreateurProf` int DEFAULT NULL,
  `idInviteParent` int DEFAULT NULL,
  `idInviteProf` int DEFAULT NULL,
  `validEvent` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`idRdv`),
  KEY `idCreateurProf` (`idCreateurProf`),
  KEY `idCreateurParent` (`idCreateurParent`),
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
  `reponse` text NOT NULL,
  `dateCreation` date NOT NULL,
  `idDiscussion` int NOT NULL,
  `idCreateurEleve` int DEFAULT NULL,
  `idCreateurParent` int DEFAULT NULL,
  `idCreateurProf` int DEFAULT NULL,
  PRIMARY KEY (`idReponse`),
  KEY `idDiscussion` (`idDiscussion`),
  KEY `idCreateurProf` (`idCreateurProf`),
  KEY `idCreateurEleve` (`idCreateurEleve`),
  KEY `idCreateurParent` (`idCreateurParent`)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `statut` int NOT NULL DEFAULT '0',
  `validUtilisateur` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `nom`, `prenom`, `dateNaissance`, `adresse`, `telephone`, `mail`, `login`, `mdp`, `statut`, `validUtilisateur`) VALUES
(1, 'A', 'A', '2021-12-17', 'A 99999 A', '0111111111', 'a@a.a', 'A', '$2y$10$lX7ml9RGq55Q4B8PjVu9lO/Pki0UPip.C15EQseckLE4sfcV4yBDy', 1, 1),
(2, 'B', 'B', '2021-12-17', 'B 99999 B', '0222222222', 'b@b.b', 'B', '$2y$10$wO0CjzS4J2HKWj0O3Yt16uLgu5PQ2ikjmphzOSyGdS4frPzJhUxIq', 2, 1),
(3, 'C', 'C', '2021-12-17', 'C 99999 C', '0333333333', 'c@c.c', 'C', '$2y$10$W6WzuYnA13qFRYqIYbkY8e2//BYmdDEifyTB0y7DqHsI7V97oe27u', 3, 1),
(4, 'root', 'root', '2021-12-17', 'root 99999 root', '0444444444', 'root@root.root', 'root', '$2y$10$btW2uftZ87oqUGFRGxgwiemTAuYerisoTRycQ6wcuIpZBW0htyHYu', 4, 1);

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
  ADD CONSTRAINT `discussion_ibfk_4` FOREIGN KEY (`idInviteEleve`) REFERENCES `eleve` (`idEleve`),
  ADD CONSTRAINT `discussion_ibfk_5` FOREIGN KEY (`idCreateurParent`) REFERENCES `parent` (`idParent`),
  ADD CONSTRAINT `discussion_ibfk_6` FOREIGN KEY (`idInviteParent`) REFERENCES `parent` (`idParent`);

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `eleve_ibfk_1` FOREIGN KEY (`idUtil`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `eleve_ibfk_2` FOREIGN KEY (`ref_classe`) REFERENCES `classe` (`id_classe`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`idCreateurEleve`) REFERENCES `eleve` (`idEleve`),
  ADD CONSTRAINT `evenement_ibfk_3` FOREIGN KEY (`idCreateurProf`) REFERENCES `professeur` (`idProf`);

--
-- Contraintes pour la table `inscription_event`
--
ALTER TABLE `inscription_event`
  ADD CONSTRAINT `inscription_event_ibfk_1` FOREIGN KEY (`idEvent`) REFERENCES `evenement` (`idEvent`),
  ADD CONSTRAINT `inscription_event_ibfk_2` FOREIGN KEY (`idEleve`) REFERENCES `eleve` (`idEleve`),
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
-- Contraintes pour la table `projet_edu`
--
ALTER TABLE `projet_edu`
  ADD CONSTRAINT `projet_edu_ibfk_1` FOREIGN KEY (`ref_prof`) REFERENCES `professeur` (`idProf`),
  ADD CONSTRAINT `projet_edu_ibfk_2` FOREIGN KEY (`ref_classe`) REFERENCES `classe` (`id_classe`);

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
