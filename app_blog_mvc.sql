-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 22 sep. 2021 à 19:48
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
  PRIMARY KEY (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `title`, `content`, `updatedAt`, `chapo`, `createdAt`, `id_user`) VALUES
(39, 'Article 1', 'le contenu de mon article 1', '2020-09-20 21:00:00', 'Mon chapeau 1', '2021-09-20 20:28:21', 0),
(45, 'fsfsdfsd', 'sdfsfsdfsdf', NULL, 'dfsfdsdf', '2021-09-21 16:03:12', NULL),
(46, 'dfgdgdf', 'dfgdgdfg', NULL, 'dfgdgdf', '2021-09-22 15:09:31', NULL),
(47, 'dfgdgdf', 'dfgdgdfg', NULL, 'dfgdgdf', '2021-09-22 15:10:02', NULL),
(48, 'zerze', 'zerze', NULL, 'zerze', '2021-09-22 15:21:59', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `avatar`
--

DROP TABLE IF EXISTS `avatar`;
CREATE TABLE IF NOT EXISTS `avatar` (
  `id_avatar` int NOT NULL,
  `lien_avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `disabled` int NOT NULL DEFAULT '1',
  `id_article` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `fk_comment_user` (`id_user`),
  KEY `fk_comment_article_0` (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `content`, `createdat`, `disabled`, `id_article`, `id_user`) VALUES
(2, 'fzefzefzezerz', '2021-09-21 18:53:59', 1, NULL, NULL),
(3, 'commentaire', '2021-09-22 15:54:27', 1, NULL, NULL),
(4, 'nouveau commentaire', '2021-09-22 15:54:39', 1, NULL, NULL),
(5, 'nouveau commentaire', '2021-09-22 15:55:52', 1, NULL, NULL),
(6, 'nouveau commentaire', '2021-09-22 16:01:03', 1, NULL, NULL),
(7, 'dernier commentaire', '2021-09-22 16:01:41', 1, NULL, NULL),
(8, 'zouzoul le commentaire', '2021-09-22 16:03:40', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messaging`
--

DROP TABLE IF EXISTS `messaging`;
CREATE TABLE IF NOT EXISTS `messaging` (
  `id_messaging` int NOT NULL AUTO_INCREMENT,
  `title` int DEFAULT NULL,
  `message` int DEFAULT NULL,
  `id_user` int NOT NULL,
  `createdat` datetime NOT NULL,
  PRIMARY KEY (`id_messaging`),
  KEY `fk_messaging_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `activated`, `validation_key`, `usertype`, `avatar`, `createdAt`, `prenom`, `nom`, `updatedAt`) VALUES
(11, 'testutilisateur', 'testemail@gmail.com', '$2y$10$NoKCkMeVJQRP6tDGzPELgu6SAUWOGYRkcs6UkLLZ8ELKl0okj2QHS', 1, '123456', 1, 'default_avatar.jpg', '2021-09-10 15:52:11', 'testprenom', 'testnom', NULL),
(12, 'testusername', 'testuser@user.com', '$2y$10$xx9/qZiszTLxl8CkcKcyaOXXKnrtXISfpajqPkGNMS4MKysi9VLFu', 1, '123456', 1, 'default_avatar.jpg', '2021-09-10 19:13:00', 'testprenom', 'testnom', NULL),
(13, 'sfsf', 'sfsfsfs@moi.fr', '$2y$10$UGh.9FOT9XYNb3tvcz/flOTbYktUIv.hbEyVxcjhfP2OpKoY8eLX.', 1, '123456', 1, 'default_avatar.jpg', '2021-09-20 22:03:03', 'sfsf', 'sfsf', NULL);

--
-- Contraintes pour les tables déchargées
--

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

--
-- Contraintes pour la table `messaging`
--
ALTER TABLE `messaging`
  ADD CONSTRAINT `fk_messaging_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
