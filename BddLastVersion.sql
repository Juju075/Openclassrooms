-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 30 oct. 2021 à 16:53
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
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `title`, `content`, `updatedAt`, `chapo`, `createdAt`, `id_user`) VALUES
(131, 'Les royaumes africain.', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, 'il est de nouveau de ', '2021-10-15 13:48:36', NULL),
(132, 'Egypte antique', 'contenu ici', NULL, 'beaucoup d\'interpre', '2021-10-15 13:49:14', NULL),
(133, 'Kemet', 'un paradis perdu', NULL, 'une soiree au 31', '2021-10-15 13:49:47', NULL),
(145, 'test articles ', 'test articlesfsdfs', NULL, 'test articlessdfsdf', '2021-10-19 16:46:25', 89),
(146, 'sfsdf', 'sdfsdfs', '26-10-2021 1635270500', 'dfsfsf', '2021-10-19 16:46:25', 89),
(150, 'sdfsdfsdf', 'sdfdsdfsfsdfsd', NULL, 'sdfsdfs', '2021-10-26 19:49:27', 89),
(151, 'sdfsdfsdf', 'sdfdsdfsfsdfsd', NULL, 'sdfsdfs', '2021-10-26 19:50:27', 89);

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
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `content`, `createdat`, `disabled`, `id_article`, `id_user`) VALUES
(99, 'modification du commentaire par l admin', '2021-10-21 00:43:53', 1, 146, 89),
(200, 'dqsdqsdqsdqsdqs', '2021-10-30 00:24:35', 1, 150, 89),
(225, 'dsfsdfsdfsfsdfsdf', '2021-10-30 18:04:28', 1, 133, 14),
(226, 'dfgdgdgdgdgdgdgdgdgdgdgd', '2021-10-30 18:12:59', 0, 131, 89);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `moderator`
--

INSERT INTO `moderator` (`id_moderator`, `link`, `id_comment`, `createdat`, `erase`) VALUES
(6, 'admin&validation=comment&id=222&token=63aee5f60929e7e2aac8b25a3e826f0e', 222, '2021-10-30 18:01:45', ''),
(7, 'admin&validation=comment&id=223&token=63aee5f60929e7e2aac8b25a3e826f0e', 223, '2021-10-30 18:03:28', ''),
(8, 'admin&validation=comment&id=224&token=63aee5f60929e7e2aac8b25a3e826f0e', 224, '2021-10-30 18:03:57', ''),
(9, 'admin&validation=comment&id=225&token=63aee5f60929e7e2aac8b25a3e826f0e', 225, '2021-10-30 18:04:28', ''),
(10, 'admin&validation=comment&id=226&token=5ae1b1a56edabdb8b752439e4733ab85', 226, '2021-10-30 18:12:59', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `activated`, `validation_key`, `usertype`, `avatar`, `createdAt`, `prenom`, `nom`, `updatedAt`, `sentence`) VALUES
(14, 'testusername', 'monemail@gmail.com', '$2y$10$PB7BBTMqnoV0w0Zl1X7jZ.0rtZOkzUCnfWMnt9mRy0EapQVHh4nIK', 1, '63aee5f60929e7e2aac8b25a3e826f0e', 'MEMBRE', 'default_avatar.jpg', '2021-09-27 14:20:26', 'benoit', 'Grosse', NULL, 'qdqsdqdqdqdqd'),
(85, 'utilisateur1', 'ToddBBower@dayrep.com', '$2y$10$FmRRHGqDdrrkOv33tQv7BO1dP.U4NxWf2yj72pSFIjPuyfIqGmHLS', 1, 'b4489abcc06e34aff531b50caa5e40e4', 'MEMBRE', 'Capture.JPG', '2021-10-18 15:18:54', 'Todd B', 'Bower', NULL, 'Les cordonniers sont les plus mal chaussés'),
(87, 'utilisateur2', 'JohnSJohnson@teleworm.us', '$2y$10$gDegAMqgeUWqNFe1zIYrFeacakzFRPm7xj4Q3m6i0A5VerEEGJ6xq', 1, '0248fa8c97546a3180712114931c7dfb', 'MEMBRE', 'Capture1.jpg', '2021-10-18 15:25:21', 'John S', 'Johnson', NULL, 'Imite le moins possible les hommes dans leur énigmatique maladie de faire des noeuds'),
(89, 'Admin', 'amzfba.1bestbuy@gmail.com', '$2y$10$t7U5YM/ir5pKjk/XWOHz0e2ReuhjetuXunuuvvJ5unbph3PdUPtf2', 1, '5ae1b1a56edabdb8b752439e4733ab85', 'ADMIN', 'Capture1.jpg', '2021-10-18 18:59:00', 'Christian J', 'Grogan', NULL, 'Tout ce qui n\'est pas passion est sur un fond d\'ennui.');

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
