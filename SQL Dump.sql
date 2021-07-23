-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 23 juil. 2021 à 13:59
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `videoformation`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(1, 'PHP', NULL),
(2, 'HTML', NULL),
(3, 'Symfony', NULL),
(4, 'JavaScript', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210713072543', '2021-07-13 07:25:56', 341);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_404021BF12469DE2` (`category_id`),
  KEY `IDX_404021BFF675F31B` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `category_id`, `author_id`, `title`, `description`, `duration`, `video`, `created_at`, `updated_at`, `image`) VALUES
(4, 1, 1, 'PHP pour débutant', 'Tester l\'envoi d\'emails d\'une application web n\'est jamais une chose simple. On se retrouve souvent à devoir configurer notre environnement local pour envoyer des emails vers l\'extérieur en essayant de contourner les limitations des FAI, ou en passant par un SMTP externe. Le problème, c\'est qu\'il faudra alors être très prudent afin de ne pas risquer d\'envoyer des emails de tests aux utilisateurs', '00:07:00', 'bee-651-60efea6a40b99888427847.mp4', '2021-07-13 07:50:17', '2021-07-22 07:58:48', 'php-60efea6a3f470237489125.png'),
(5, 3, 1, 'Symfony par l\'exemple', 'Dans ce premier chapitre nous allons découvrir ensemble le projet que l\'on va chercher à réaliser et on va découvrir comment installer et configurer Symfony 4.\r\n\r\nPour suivre cette formation dans les meilleurs conditions je vous conseille d\'installer la même version de symfony que dans la vidéo :\r\n\r\ncomposer create-project symfony/website-skeleton MONPROJET 4.1.99', '12:30:00', 'tester-l-envoi-d-email-avec-maildev-2-60ed465b6e834448038841.mp4', '2021-07-13 07:52:59', '2021-07-13 07:52:59', 'symfony-60ed465b6c151431545957.jpg'),
(6, 3, 2, 'Créer un champ pour gérer une ManyToMany', NULL, '00:30:00', 'tester-l-envoi-d-email-avec-maildev-2-60ed4772a27ae645014136.mp4', '2021-07-13 07:57:38', '2021-07-13 07:57:38', 'symfony-60ed4772a0eae658375483.jpg'),
(7, 4, 1, 'Effet de parallaxe au défilement', 'A propos de ce tutoriel\r\nDans ce tutoriel nous allons voir comment créer un effet de parallaxe en JavaScript au défilement de la page. L\'objectif est de faire en sorte que différents éléments de la page défilent plus ou moins vite que le scroll pour donner un effet de perspective / profondeur.\r\n\r\nQuelle approche ?\r\nPour créer cet effet l\'idée est d\'appliquer une translation sur l\'élément en fonction du niveau de défilement de l\'utilisateur. Pour calculer la translation à appliquer on va calculer la position de l\'élément par rapport au centre de l\'écran.\r\n\r\nOn a 2 possibilités pour faire ce calcul :\r\n\r\nUtiliser le getBoundingClientRect() qui permet d\'obtenir les informations sur la taille et la position de l\'élément par rapport à l\'écran.\r\nLe offsetTop qui permet d\'obtenir la position de l\'élément par rapport au conteneur positionné le plus proche.\r\nL\'offsetTop a l\'avantage de ne pas être affecté par les transformations ce qui peut simplifier le calcul. L\'autre avantage est que l\'offsetTop peut être calculé et sauvegardé en amont (si la structure de votre page ne change pas). On fera juste attention à calculer cet offsetTop récursivement pour avoir la position par rapport au haut de la page.', '00:35:00', 'tester-l-envoi-d-email-avec-maildev-2-60ed497353af2612724195.mp4', '2021-07-13 08:06:11', '2021-07-13 08:06:11', 'javascript-60ed497352092255916241.jpg'),
(8, 4, 1, 'Apprendre le JavaScript', 'Dans ce cours en ligne, nous allons apprendre à utiliser un langage génial : JavaScript.\r\nC\'est un des piliers pour coder en Front-End, et depuis quelques années on l\'utilise même en back, en application de bureau, en application mobile et j\'en passe !\r\n\r\nC\'est donc un incontournable. Il faut bien le maîtriser pour accéder à toutes ces possibilités.\r\n\r\nC\'est donc un incontournable. Il faut bien le maîtriser pour accéder à toutes ces possibilités.', '00:10:00', 'honeybee-31854-60efeadcadbb3068885432.mp4', '2021-07-13 08:20:58', '2021-07-22 09:16:25', 'javascript-60ed4cea49742043979687.jpg'),
(9, 1, 2, 'Déboguer son code PHP', 'Déboguer son code PHP', '00:13:00', 'bee-75037-60ed4d4de83ac917161528.mp4', '2021-07-13 08:22:37', '2021-07-13 08:22:37', 'php-60ed4d4de6a41483377804.png');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`, `created_at`, `updated_at`) VALUES
(1, 'thierry@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$F/GkJHCRmdeVmtwA3OriNeW7UsauQqVk9/4S/0KtBZK8geKBAOjNK', 'thierry', '2021-07-13 07:26:56', '2021-07-13 07:26:56'),
(2, 'jeremy@gmail.com', '[\"ROLE_EDITOR\"]', '$2y$13$iIIDfVwkKHr0TeBt5MfwxeeVyr6RvMYp1DG7YGrTrbgnN2N11XgxG', 'Jeremy', '2021-07-13 07:53:51', '2021-07-13 07:53:51'),
(4, 'nicolas@gmail.com', '[\"ROLE_USER\"]', '$2y$13$CgmnpdvR36gmYgydjwlF0umfoS7wgIllcSgQreuih8nPvd8WPfVxe', 'nicolas', '2021-07-22 09:22:09', '2021-07-22 09:22:09'),
(6, 'kamelb@gmail.com', '[\"ROLE_USER\"]', '$2y$13$pPEOIhlxqCBYhaPBBpcXIOxqmN7KkN6320M99euttgsF7nL0FyAme', 'kamelb', '2021-07-23 13:54:10', '2021-07-23 13:54:10');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `FK_404021BF12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_404021BFF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
