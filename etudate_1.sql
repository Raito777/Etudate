-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 19 avr. 2022 à 08:36
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `etudate`
--

-- --------------------------------------------------------

--
-- Structure de la table `compatible`
--

DROP TABLE IF EXISTS `compatible`;
CREATE TABLE IF NOT EXISTS `compatible` (
  `id_Match` int(11) NOT NULL AUTO_INCREMENT,
  `id_Utilisateurs_1` int(11) NOT NULL,
  `id_Utilisateurs_2` int(11) NOT NULL,
  `date_Matchs` datetime DEFAULT NULL,
  PRIMARY KEY (`id_Match`),
  KEY `FK_Compatible_id_Utilisateurs_1` (`id_Utilisateurs_1`),
  KEY `FK_Compatible_id_Utilisateurs_2` (`id_Utilisateurs_2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

DROP TABLE IF EXISTS `departements`;
CREATE TABLE IF NOT EXISTS `departements` (
  `num_Departements` int(11) NOT NULL AUTO_INCREMENT,
  `nom_Departements` int(11) DEFAULT NULL,
  PRIMARY KEY (`num_Departements`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etudie_a`
--

DROP TABLE IF EXISTS `etudie_a`;
CREATE TABLE IF NOT EXISTS `etudie_a` (
  `id_Utilisateurs` int(11) NOT NULL AUTO_INCREMENT,
  `id_Universite` int(11) NOT NULL,
  PRIMARY KEY (`id_Utilisateurs`,`id_Universite`),
  KEY `FK_ETUDIE_A_id_Universite` (`id_Universite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id_Question` int(11) NOT NULL AUTO_INCREMENT,
  `intitule_Question` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_Question`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id_Question`, `intitule_Question`) VALUES
(1, 'Que recherches-tu ?'),
(2, 'LA qualité que ton partenaire doit absolument avoir !'),
(3, 'Quelle est ta devise en amour ?'),
(4, 'Ce que tu détestes le plus (1) ?'),
(5, 'Ce que tu détestes le plus (2) ?'),
(6, 'Quel est pour toi le pire tue-l\'amour ?'),
(7, 'Si tu devais mourir demain, qu\'est-ce que tu ferais ?'),
(8, 'A quelle fréquence te laves-tu ?'),
(9, 'Quel est le lieu parfait pour faire un date ?'),
(10, 'Quel adjectif te décrit le mieux ?'),
(11, 'Quelle est ta sauce préférée ?'),
(12, 'Quelle sont tes gouts musicaux ?'),
(13, 'Quelle est ta plus grande peur ?'),
(14, 'Tu es en bad mood en ce moment quelle est ta méthode pour te remettre en forme ?'),
(15, 'Dans quelle position tu dors la nuit ?'),
(16, 'Que regardez-vous en premier chez votre partenaire ?');

-- --------------------------------------------------------

--
-- Structure de la table `repond`
--

DROP TABLE IF EXISTS `repond`;
CREATE TABLE IF NOT EXISTS `repond` (
  `idReponse_Reponses` int(11) NOT NULL AUTO_INCREMENT,
  `id_Utilisateurs` int(11) NOT NULL,
  PRIMARY KEY (`idReponse_Reponses`,`id_Utilisateurs`),
  KEY `FK_Repond_id_Utilisateurs` (`id_Utilisateurs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

DROP TABLE IF EXISTS `reponses`;
CREATE TABLE IF NOT EXISTS `reponses` (
  `idReponse_Reponses` int(11) NOT NULL AUTO_INCREMENT,
  `reponse_Reponses` varchar(128) DEFAULT NULL,
  `id_Question` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReponse_Reponses`),
  KEY `FK_Reponses_id_Question` (`id_Question`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`idReponse_Reponses`, `reponse_Reponses`, `id_Question`) VALUES
(1, 'Une personne qui te ressemble (qui se ressemble s\'assemble)', 1),
(2, 'Une personne qui est ton opposé  ( les opposés s\'attirent)', 1),
(3, 'Une personne qui te complète', 1),
(4, 'Peu importe, tu es ici et tu ressortiras pas tant que tu n\'auras pas trouver ton âme sœur', 1),
(5, 'Humour', 2),
(6, 'Honnêteté /Fidélité', 2),
(7, 'Intelligence/Avoir de la culture générale', 2),
(8, 'Une communication en béton', 2),
(9, 'La communication c\'est la clé !', 3),
(10, 'L\'amour est un plus, il faut déjà être heureux avec soi-même.', 3),
(11, 'Je donnerai tout pour mon partenaire.', 3),
(12, 'Pour une relation qui dure, il faut faire des concessions.', 3),
(13, 'Une personne trop têtue', 4),
(14, 'Une personne qui ne s\'affirme pas', 4),
(15, 'Une personne TROP gentille', 4),
(16, 'Une personne qui n\'a pas d\'ambition', 4),
(17, 'Une personne qui ne se met pas à la place des autres', 5),
(18, 'Une personne qui critique les apparences des autres', 5),
(19, 'Une personne sans ambition', 5),
(20, 'Une personne qui ne pense qu\'à elle', 5),
(21, 'Dormir avec ses chaussettes', 6),
(22, 'Odeurs nauséabondes', 6),
(23, 'Pets au lit', 6),
(24, 'Le bordel', 6),
(25, 'Je reste chez moi, c\'est le meilleur endroit', 7),
(26, 'Je vais voir ma famille/amis/partenaire, parce que les gens c\'est la vie', 7),
(27, 'Je voyage une dernière fois pour toute', 7),
(28, 'Tu te mets en boule et tu pleures', 7),
(29, '1 ou 2 fois par jour !!!', 8),
(30, 'Plusieurs fois par semaine', 8),
(31, 'Quelques fois par mois...', 8),
(32, 'Jamais, j\'adore la crasse', 8),
(33, 'Le fameux Netflix and chill', 9),
(34, 'Un parc d\'attraction pour les sensations', 9),
(35, 'Un restaurant chic car c\'est romantique', 9),
(36, 'Un musée ou une exposition pour se cultiver à deux', 9),
(37, 'Sérieux(se)', 10),
(38, 'Énergique', 10),
(39, 'Réservé(e)', 10),
(40, 'Rêveur(se)', 10),
(41, 'Mayonnaise, douce et grasse', 11),
(42, 'Ketchup, sucré et acidulé', 11),
(43, 'Samourai, piquante et crémeuse', 11),
(44, 'Barbecue, fumé et sucré', 11),
(45, 'Plutôt classique', 12),
(46, 'Plutôt pop', 12),
(47, 'Plutôt rock', 12),
(48, 'Plutôt rap', 12),
(49, 'L\'échec', 13),
(50, 'Parler en public', 13),
(51, 'La mort ou la mort d\'un de tes proches', 13),
(52, 'Peur d\'animaux ( araignées, serpent)', 13),
(53, 'Sortir faire la fête', 14),
(54, 'Faire du sport', 14),
(55, 'Tu pleures/ déprimes dans ton lit', 14),
(56, 'Tu regardes ta série préferé avec un bon chocolat chaud', 14),
(57, 'En boule / position fœtale', 15),
(58, 'Sur le ventre, tu respires pas', 15),
(59, 'Sur le dos , tu te prépares à rentrer dans le cerceuil', 15),
(60, 'Juste tu dors', 15),
(61, 'Ses yeux', 16),
(62, 'Son style vestimentaire', 16),
(63, 'Son portefeuille, michto vie', 16),
(64, 'Son sourire', 16);

-- --------------------------------------------------------

--
-- Structure de la table `universite`
--

DROP TABLE IF EXISTS `universite`;
CREATE TABLE IF NOT EXISTS `universite` (
  `id_Universite` int(11) NOT NULL AUTO_INCREMENT,
  `nom_Universite` varchar(32) DEFAULT NULL,
  `num_Departements` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_Universite`),
  KEY `FK_Universite_num_Departements` (`num_Departements`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_Utilisateurs` int(11) NOT NULL AUTO_INCREMENT,
  `prenom_Utilisateurs` varchar(32) DEFAULT NULL,
  `mdp_Utilisateurs` text,
  `age_Utilisateurs` int(11) DEFAULT NULL,
  `sexe_Utilisateurs` varchar(32) DEFAULT NULL,
  `email_Utilisateurs` varchar(128) DEFAULT NULL,
  `photo_Utilisateurs` varchar(32) DEFAULT NULL,
  `dateInscription_Utilisateurs` datetime DEFAULT NULL,
  PRIMARY KEY (`id_Utilisateurs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `compatible`
--
ALTER TABLE `compatible`
  ADD CONSTRAINT `FK_Compatible_id_Utilisateurs_1` FOREIGN KEY (`id_Utilisateurs_1`) REFERENCES `utilisateurs` (`id_Utilisateurs`),
  ADD CONSTRAINT `FK_Compatible_id_Utilisateurs_2` FOREIGN KEY (`id_Utilisateurs_2`) REFERENCES `utilisateurs` (`id_Utilisateurs`);

--
-- Contraintes pour la table `etudie_a`
--
ALTER TABLE `etudie_a`
  ADD CONSTRAINT `FK_ETUDIE_A_id_Universite` FOREIGN KEY (`id_Universite`) REFERENCES `universite` (`id_Universite`),
  ADD CONSTRAINT `FK_ETUDIE_A_id_Utilisateurs` FOREIGN KEY (`id_Utilisateurs`) REFERENCES `utilisateurs` (`id_Utilisateurs`);

--
-- Contraintes pour la table `repond`
--
ALTER TABLE `repond`
  ADD CONSTRAINT `FK_Repond_idReponse_Reponses` FOREIGN KEY (`idReponse_Reponses`) REFERENCES `reponses` (`idReponse_Reponses`),
  ADD CONSTRAINT `FK_Repond_id_Utilisateurs` FOREIGN KEY (`id_Utilisateurs`) REFERENCES `utilisateurs` (`id_Utilisateurs`);

--
-- Contraintes pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `FK_Reponses_id_Question` FOREIGN KEY (`id_Question`) REFERENCES `questions` (`id_Question`);

--
-- Contraintes pour la table `universite`
--
ALTER TABLE `universite`
  ADD CONSTRAINT `FK_Universite_num_Departements` FOREIGN KEY (`num_Departements`) REFERENCES `departements` (`num_Departements`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
