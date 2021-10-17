-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 17 oct. 2021 à 09:37
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
  `updatedAt` datetime DEFAULT NULL,
  `chapo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id_article`),
  KEY `fk_article_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `title`, `content`, `updatedAt`, `chapo`, `createdAt`, `id_user`) VALUES
(131, 'les elephants rose', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, 'il est de nouveau de ', '2021-10-15 13:48:36', NULL),
(132, 'la musique est un art ?', ' by accident, sometimes on purpose (injected humour and the like).', NULL, 'beaucoup d\'interpre', '2021-10-15 13:49:14', NULL),
(133, 'une petite tenue de soiree', 'ge when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, 'une soiree au 31', '2021-10-15 13:49:47', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `usertype` tinyint(1) NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `sentence` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `activated`, `validation_key`, `usertype`, `avatar`, `createdAt`, `prenom`, `nom`, `updatedAt`, `sentence`) VALUES
(14, 'testusername', 'monemail@gmail.com', '$2y$10$PB7BBTMqnoV0w0Zl1X7jZ.0rtZOkzUCnfWMnt9mRy0EapQVHh4nIK', 1, '63aee5f60929e7e2aac8b25a3e826f0e', 1, 'default_avatar.jpg', '2021-09-27 14:20:26', 'benoit', 'Grosse', NULL, NULL),
(15, 'testusername2', 'miki@gmail.com', '$2y$10$E8RwzxRQhh/Jsv9PhC3rOuRAfWin5PVBk/U3UTiyycS28HiWAp/2m', 0, '123456', 1, 'default_avatar.jpg', '2021-09-28 19:07:23', 'michael', 'jones', NULL, NULL),
(52, 'testformulaire', 'juniorkheve@gmail.com', '$2y$10$2SrpDDlel8FTGx0a7r3H6.z7w/u7Zys.8u6Ya/qCTPDrArxK2GdHG', 0, '5cd223aee63b5fe06b2cb84a3839f0eb', 1, 'default_avatar.jpg', '2021-10-11 15:02:44', 'sdfsdfs', 'sdfsf', NULL, 'sfsfsfsfs'),
(67, 'cfwcw', 'bempime.k@gmail.com', '$2y$10$CWZMFw3DFO173aHW21HONOKAaKzVL5voxP8nhTDSXp3W14IydGiPO', 0, '133d21cec05b90f4631ac1b8dda345f1', 1, 'image_telecharge.jpg', '2021-10-13 22:01:46', 'wxcwxc', 'cwcwcxw', NULL, 'ffqsffqs'),
(69, 'admin', 'amzfba.1bestbuy@gmail.com', '$2y$10$OAZy0rmIAdpJzHQ/UEDKBu/mEpNYbSS8YhzF9rJwyAlrr/rak0Ml2', 0, 'b7d2769dbf12e35f893b10711fc4152e', 2, 'image_telecharge.jpg', '2021-10-15 15:28:14', 'Robert', 'Ford', NULL, 'je suis le boss'),
(70, 'testnoimage', 'bempime.k@gmail.com', '$2y$10$vuyxcMwUYLDQOUiH9LNhoOImzxuMdOPFkccH89UPyjipV5RMsCYsm', 0, '39c8e9953fe8ea40ff1c59876e0e2f28', 2, 'image_telecharge.jpg', '2021-10-15 15:30:52', 'sdfsdf', 'sdfsdf', NULL, 'sdfsfds');

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
