-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 31 oct. 2021 à 10:17
-- Version du serveur :  8.0.22
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `app_blog_mvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id_article` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `updatedAt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chapo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id_article`),
  KEY `fk_article_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `title`, `content`, `updatedAt`, `chapo`, `createdAt`, `id_user`) VALUES
(131, 'Les royaumes africain.', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, 'il est de nouveau de ', '2021-10-15 13:48:36', NULL),
(132, 'Egypte antique', 'contenu ici', NULL, 'beaucoup d\'interpre', '2021-10-15 13:49:14', NULL),
(153, 'Initiation aux mathématiques africaines pour les enfants de 5 a 15 ans.', 'Ce manuel a pour vocation d\'initier les enfants (mais aussi les parents) aux mathématiques africaines par le biais d\'une méthode pédagogique volontairement ludique.', NULL, 'Nioussérê Kalala Omotunde', '2021-10-30 22:13:55', 89),
(154, 'Valoriser nos Humanités Classiques Africaines', 'L\'Institut d\'Histoire ANYJART se veut être un espace de culture, d\'histoire et de découverte de l\'extême richesse du patrimoine historique, culturel, scientifique, technologique, littéraire et spirituel du Monde Noir. Dédié à la promotion de nos Humanités Classiques Africaines,  il vous invitera à porter un regard nouveau, positif et pragmatique sur notre culture africaine et panafricaine.', NULL, 'L\'Institut d\'Histoire Anyjart', '2021-10-30 22:15:18', 89),
(155, 'Immersion dans les civilisations africaines', 'z', NULL, 'z', '2021-10-30 22:16:29', 89),
(157, 'Les réacteurs nucléaires naturels existaient déjà il y a 2 milliards d\'années au Gabon', 'Nos premiers réacteurs nucléaires datent des années 1950… et suivent de près de 2 milliards d\'années les 17 « réacteurs » naturels qui ont fonctionné de manière stable pendant 100 000 à 500 000 ans sur une période d\'environ un million d\'années. Ils produisirent de l\'énergie avec des rendements modestes (100 kilowatts en moyenne par réacteur, bien inférieurs aux réacteurs actuels produisant 1 à 1,5 gigawatt, soit au moins 1 000 fois plus).', NULL, 'Terre d\'exception.', '2021-10-30 23:17:14', 89),
(158, '300 000 mille ans seul sur terre.', 'sdfsdfsdf', '31-10-2021 1635668556', 'ffsdfsdfsd', '2021-10-30 23:25:34', 89),
(160, 'Les sciences et l\'histoire.', 'qqsdqsd', NULL, 'sdqsd', '2021-10-31 11:09:27', 89),
(161, 'La spiritualité Africaine.', 'les 42 lois de la maat', '31-10-2021 1635675433', 'Maat', '2021-10-31 11:15:34', 89);

-- --------------------------------------------------------

--
-- Structure de la table `avatar`
--

DROP TABLE IF EXISTS `avatar`;
CREATE TABLE IF NOT EXISTS `avatar` (
  `id_avatar` int NOT NULL,
  `lien_avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_avatar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` int NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `disabled` int NOT NULL DEFAULT '0',
  `id_article` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `fk_comment_user` (`id_user`),
  KEY `fk_comment_article_0` (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `content`, `createdat`, `disabled`, `id_article`, `id_user`) VALUES
(226, 'dfgdgdgdgdgdgdgdgdgdgdgd', '2021-10-30 18:12:59', 0, 131, 89),
(231, 'sfsfsfsfdsdfsdfdfs', '2021-10-31 09:42:52', 0, 158, 89);

-- --------------------------------------------------------

--
-- Structure de la table `moderator`
--

DROP TABLE IF EXISTS `moderator`;
CREATE TABLE IF NOT EXISTS `moderator` (
  `id_moderator` int NOT NULL AUTO_INCREMENT,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_comment` int NOT NULL,
  `createdat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `erase` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_moderator`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `moderator`
--

INSERT INTO `moderator` (`id_moderator`, `link`, `id_comment`, `createdat`, `erase`) VALUES
(6, 'admin&validation=comment&id=222&token=63aee5f60929e7e2aac8b25a3e826f0e', 222, '2021-10-30 18:01:45', ''),
(7, 'admin&validation=comment&id=223&token=63aee5f60929e7e2aac8b25a3e826f0e', 223, '2021-10-30 18:03:28', ''),
(8, 'admin&validation=comment&id=224&token=63aee5f60929e7e2aac8b25a3e826f0e', 224, '2021-10-30 18:03:57', ''),
(9, 'admin&validation=comment&id=225&token=63aee5f60929e7e2aac8b25a3e826f0e', 225, '2021-10-30 18:04:28', ''),
(10, 'admin&validation=comment&id=226&token=5ae1b1a56edabdb8b752439e4733ab85', 226, '2021-10-30 18:12:59', ''),
(11, 'admin&validation=comment&id=227&token=63aee5f60929e7e2aac8b25a3e826f0e', 227, '2021-10-30 22:03:07', ''),
(14, 'admin&validation=comment&id=231&token=5ae1b1a56edabdb8b752439e4733ab85', 231, '2021-10-31 09:42:52', 'admin&comment=delete&id=231');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `validation_key` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `sentence` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `activated`, `validation_key`, `usertype`, `avatar`, `createdAt`, `prenom`, `nom`, `updatedAt`, `sentence`) VALUES
(14, 'testusername', 'monemail@gmail.com', '$2y$10$PB7BBTMqnoV0w0Zl1X7jZ.0rtZOkzUCnfWMnt9mRy0EapQVHh4nIK', 1, '63aee5f60929e7e2aac8b25a3e826f0e', 'MEMBRE', 'default_avatar.jpg', '2021-09-27 14:20:26', 'benoit', 'Grosse', NULL, 'qdqsdqdqdqdqd'),
(85, 'utilisateur1', 'ToddBBower@dayrep.com', '$2y$10$FmRRHGqDdrrkOv33tQv7BO1dP.U4NxWf2yj72pSFIjPuyfIqGmHLS', 1, 'b4489abcc06e34aff531b50caa5e40e4', 'MEMBRE', 'Capture.JPG', '2021-10-18 15:18:54', 'Todd B', 'Bower', NULL, 'Les cordonniers sont les plus mal chaussés'),
(87, 'utilisateur2', 'JohnSJohnson@teleworm.us', '$2y$10$gDegAMqgeUWqNFe1zIYrFeacakzFRPm7xj4Q3m6i0A5VerEEGJ6xq', 1, '0248fa8c97546a3180712114931c7dfb', 'MEMBRE', 'Capture1.jpg', '2021-10-18 15:25:21', 'John S', 'Johnson', NULL, 'Imite le moins possible les hommes dans leur énigmatique maladie de faire des noeuds'),
(89, 'Admin', 'amzfba.1bestbuy@gmail.com', '$2y$10$t7U5YM/ir5pKjk/XWOHz0e2ReuhjetuXunuuvvJ5unbph3PdUPtf2', 1, '5ae1b1a56edabdb8b752439e4733ab85', 'ADMIN', 'Capture1.jpg', '2021-10-18 18:59:00', 'Christian J', 'Grogan', NULL, 'Tout ce qui n\'est pas passion est sur un fond d\'ennui.'),
(91, 'testusername2', 'amzfba.1bestbuy@gmail.com', '$2y$10$CnB6zB88lexDjdS0w8ej2.mX4suF.bFnX1w.jmXwrLCZEDTlKRo1C', 1, '6117a912a7d347620cf1f91c5eeac794', 'MEMBRE', 'default_avatar.jpg', '2021-10-31 00:13:57', 'Hanna', 'Hossi', NULL, 'C\'est par la force des images que, par la suite des temps, pourraient bien s\'accomplir les « vraies » révolutions.');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `avatar`
--
ALTER TABLE `avatar`
  ADD CONSTRAINT `fk_avatar_user` FOREIGN KEY (`id_avatar`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_article_0` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`),
  ADD CONSTRAINT `fk_comment_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
