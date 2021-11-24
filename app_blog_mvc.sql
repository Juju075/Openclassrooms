-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 24 nov. 2021 à 11:42
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
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `title`, `content`, `updatedAt`, `chapo`, `createdAt`, `id_user`) VALUES
(131, 'Les royaumes africain.', 'L\'histoire du continent africain est passionnante. Nous connaissons tous les pharaons d\'Egypte et leurs tombeaux magnifiques. Mais combien d\'entre nous ont entendu parler des anciens empires de l\'Afrique de l\'Ouest ? Le premier de ces empire, le Ghana, s\'est développé de l\'an 300 à l\'an 1300. Le Ghana était alors si riche que, dans le palais du roi, les chiens portaient des colliers d\'or. La Charte de Kurugan Fuga contient déjà, en 1232, des prescriptions qui relèvent de la problématique moderne des droits de l\'homme ou des droits humains. Elle figure ainsi parmi les premiers édits de ce type tous continents confondus', '07-11-2021 1636269330', 'Première déclaration des \"droits de l\'homme.\"', '2021-10-15 13:48:36', 89),
(132, 'Egypte antique', 'Les Égyptiens de l\'antiquité donnaient parfois à leur pays le nom de Kemet ou Kêmi. Les égyptologues traduisent généralement ce mot par « la terre noire », en référence à la bande de terre rendue fertile par le limon noir déposé par la crue annuelle du Nil, artère vitale de la civilisation de l\'égypte antique.', '07-11-2021 1636266247', 'Les bases de la civilisation.', '2021-10-15 13:49:14', 89),
(153, 'Initiation aux mathématiques africaines pour les enfants de 5 a 15 ans.', 'Ce manuel a pour vocation d\'initier les enfants (mais aussi les parents) aux mathématiques africaines par le biais d\'une méthode pédagogique volontairement ludique.', NULL, 'Nioussérê Kalala Omotunde', '2021-10-30 22:13:55', 89),
(154, 'Valoriser nos Humanités Classiques Africaines', 'L\'Institut d\'Histoire ANYJART se veut être un espace de culture, d\'histoire et de découverte de l\'extême richesse du patrimoine historique, culturel, scientifique, technologique, littéraire et spirituel du Monde Noir. Dédié à la promotion de nos Humanités Classiques Africaines,  il vous invitera à porter un regard nouveau, positif et pragmatique sur notre culture africaine et panafricaine.', NULL, 'L\'Institut d\'Histoire Anyjart', '2021-10-30 22:15:18', 89),
(155, 'Immersion dans les civilisations africaines', 'La racine du mot « KaMa » est omniprésente chez bon nombre de peuples d’Afrique centrale, d’Afrique de l’Ouest : « KaMa » signifie noir en copte,<<KAMeen>> signifie chez nous en peulh du fouta djallon ,« iKaMa » signifie noirci en mbochi (Congo-Brazzaville, Gabon, Cameroun), « Ka-FFiin » signifie (le noici), I ka-fiin, cela veut dire aussi tu la noici. en bambara (Mali, Burkina Faso, Côte d\'Ivoire, etc.), « KeM » signifie brûlé en wolof (Sénégal), « Kanbé » signifie brûlé en mossi (Burkina Faso, Niger, etc.)', '07-11-2021 1636267884', 'z', '2021-10-30 22:16:29', 89),
(157, 'Les réacteurs nucléaires naturels existaient déjà il y a 2 milliards d\'années au Gabon', 'Les réacteurs nucléaires naturels d’Oklo auraient fonctionné il y a environ deux milliards d\'années. On a retrouvé dans la mine d\'uranium d\'Oklo, près de la ville de Franceville dans la province de Haut-Ogooué au Gabon, les résidus fossiles de réacteurs nucléaires naturels, où des réactions de fission nucléaire en chaîne auto-entretenues auraient eu lieu, bien avant l\'apparition de l\'être humain.', '07-11-2021 1636266549', 'Réacteur nucléaire naturel d\'Oklo.', '2021-10-30 23:17:14', 89),
(158, '300 000 mille ans seul sur terre.', 'Les traces des civilisations noire à travers le monde bien avant la découverte des continents par les \"explorateurs\" L\'origine africaine du peuple asiatique et européen.', '07-11-2021 1636268759', 'dispersés aux quatre coins du monde.', '2021-10-30 23:25:34', 89),
(160, 'Les sciences et l\'histoire.', 'L’origine des sciences est bel et bien africaine. Un os pétrifié prouve que les mathématiques étaient pratiquées dans la région des Grands Lacs il y a plus de 20 000 ans. Le bâton d’Ishango (à gauche), exposé à l’Institut royal des sciences naturelles de Belgique, constitue le plus ancien témoignage mathématique de l’humanité. D’une dizaine de centimètres, il a été mis au jour lors de fouilles près du lac Rutanzige, à la frontière de l’Ouganda et de la République démocratique du Congo', '07-11-2021 1636266814', 'L’origine des sciences est bel et bien africaine', '2021-10-31 11:09:27', 89),
(161, 'La spiritualité Africaine.', 'a', '01-11-2021 1635774549', 'A l\'origine des religions ditent \"revelées\".', '2021-10-31 11:15:34', 89);

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
) ENGINE=InnoDB AUTO_INCREMENT=280 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `content`, `createdat`, `disabled`, `id_article`, `id_user`) VALUES
(268, 'Abandonner famille et patrie, renoncer aux biens de ce monde nouveau, sans lois, et que certains écrivains ont parfois souhaité vaguement, c\'est plutôt un indice qu\'un embarras... Ailleurs il y avait rencontré des femmes qui aiment vraiment soupçonnaient sur quels misérables racontars de salons, où l\'attendaient comme d\'habitude près du lit de tout son courage pour l\'amour d\'un phoque. Penses-tu que je laisserais s\'agiter en même temps il lui montra ', '2021-11-19 12:15:08', 0, 131, 89),
(269, ' la porte béante, l\'emporta dans un petit local avec de vieux tabliers. Contez-moi un peu cela, nous faisons notre marché ensemble tous les jours une nouvelle extension du principe, tout en mangeant.', '2021-11-19 12:15:32', 0, 132, 89),
(270, 'Orgueil humilié, passion dupée, jalousie bestiale, impatience devant les obstacles. Soudainement, je me sens incapable de répondre à ces questions. Mettez-vous dans l\'esprit si tortueux... Avouons que le coeur lui manquait...', '2021-11-19 12:16:05', 0, 153, 89),
(271, 'semblables à des papillons. Circulent aussi des voitures électriques, roulant sur lui-même, et n\'aurais pas de grâce. Travaillant dans un profond silence, que vous courez le risque de rencontrer du monde. Sais-tu, ma fille et moi serions pris au piège ou au filet dans les criques ou cultivés sur le sol... Vice-roi, gouverneur et capitaine de dragons... Enterrement', '2021-11-19 12:16:27', 0, 160, 89);

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
  `id_article` int NOT NULL,
  PRIMARY KEY (`id_moderator`),
  KEY `fk_moderator_comment` (`id_comment`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `moderator`
--

INSERT INTO `moderator` (`id_moderator`, `link`, `id_comment`, `createdat`, `erase`, `id_article`) VALUES
(21, 'admin&validation=comment&id=268&token=5ae1b1a56edabdb8b752439e4733ab85', 268, '2021-11-19 12:15:08', 'admin&comment=delete&id=268', 0),
(22, 'admin&validation=comment&id=269&token=5ae1b1a56edabdb8b752439e4733ab85', 269, '2021-11-19 12:15:32', 'admin&comment=delete&id=269', 0),
(23, 'admin&validation=comment&id=270&token=5ae1b1a56edabdb8b752439e4733ab85', 270, '2021-11-19 12:16:05', 'admin&comment=delete&id=270', 0),
(24, 'admin&validation=comment&id=271&token=5ae1b1a56edabdb8b752439e4733ab85', 271, '2021-11-19 12:16:27', 'admin&comment=delete&id=271', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `activated`, `validation_key`, `usertype`, `avatar`, `createdAt`, `prenom`, `nom`, `updatedAt`, `sentence`) VALUES
(14, 'testusername', 'monemail@gmail.com', '$2y$10$PB7BBTMqnoV0w0Zl1X7jZ.0rtZOkzUCnfWMnt9mRy0EapQVHh4nIK', 1, '63aee5f60929e7e2aac8b25a3e826f0e', 'MEMBRE', 'default_avatar.jpg', '2021-09-27 14:20:26', 'benoit', 'Grosse', NULL, 'qdqsdqdqdqdqd'),
(85, 'utilisateur1', 'ToddBBower@dayrep.com', '$2y$10$FmRRHGqDdrrkOv33tQv7BO1dP.U4NxWf2yj72pSFIjPuyfIqGmHLS', 1, 'b4489abcc06e34aff531b50caa5e40e4', 'MEMBRE', 'Capture.JPG', '2021-10-18 15:18:54', 'Todd B', 'Bower', NULL, 'Les cordonniers sont les plus mal chaussés'),
(87, 'utilisateur2', 'JohnSJohnson@teleworm.us', '$2y$10$gDegAMqgeUWqNFe1zIYrFeacakzFRPm7xj4Q3m6i0A5VerEEGJ6xq', 1, '0248fa8c97546a3180712114931c7dfb', 'MEMBRE', 'Capture1.jpg', '2021-10-18 15:25:21', 'John S', 'Johnson', NULL, 'Imite le moins possible les hommes dans leur énigmatique maladie de faire des noeuds'),
(89, 'Admin', 'amzfba.1bestbuy@gmail.com', '$2y$10$t7U5YM/ir5pKjk/XWOHz0e2ReuhjetuXunuuvvJ5unbph3PdUPtf2', 1, '5ae1b1a56edabdb8b752439e4733ab85', 'ADMIN', 'Capture1.jpg', '2021-10-18 18:59:00', 'Christian J', 'Grogan', NULL, 'Tout ce qui n\'est pas passion est sur un fond d\'ennui.'),
(91, 'testusername2', 'amzfba.1bestbuy@gmail.com', '$2y$10$CnB6zB88lexDjdS0w8ej2.mX4suF.bFnX1w.jmXwrLCZEDTlKRo1C', 1, '6117a912a7d347620cf1f91c5eeac794', 'MEMBRE', 'default_avatar.jpg', '2021-10-31 00:13:57', 'Hanna', 'Hossi', NULL, 'C\'est par la force des images que, par la suite des temps, pourraient bien s\'accomplir les « vraies » révolutions.'),
(92, 'utilisateur3', 'bempime.k@gmail.com', '$2y$10$oYmAy.I.LHFVkcRIuBO3tOYGtw6E68nJ7jAL/FdiBbd5ytjErEzyu', 1, '583a96854d8470f98f40754d7cd3b38c', 'MEMBRE', 'Capture1.jpg', '2021-10-31 20:52:45', 'Phillip P', 'Wood', NULL, 'Quand la langue cesse de faire du chichi l\'attention se porte du côté du dedans là où l\'énergie rit'),
(95, 'testimage', 'bempime.k@gmail.com', '$2y$10$o6hon/4/HcciaKjdZTXfSOqUPhBuXWIrq3bs5L4hNytfBYkkfv1B2', 1, '81230da75c851cab59664c29815eba6b', 'MEMBRE', '6187ca659ccf9', '2021-11-07 13:45:25', 'rezerze', 'rzerzer', NULL, 'erzrzerzerz'),
(96, 'dfsqf', 'amzfba.1bestbuy@gmail.com', '$2y$10$xKgxqdbC8A5SQnvviPvMF.RZriCC1eTsy5ET1A6WPfJA3cyhGwMoq', 1, 'f669ec6437f90b35ff7647f32b46f3aa', 'MEMBRE', '61956d28b1992', '2021-11-17 21:59:20', 'sfsdf', 'fdsff', NULL, 'qsdqsdqsdq');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_article_0` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`),
  ADD CONSTRAINT `fk_comment_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `moderator`
--
ALTER TABLE `moderator`
  ADD CONSTRAINT `fk_moderator_comment` FOREIGN KEY (`id_comment`) REFERENCES `comment` (`id_comment`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
