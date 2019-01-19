-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  sam. 19 jan. 2019 à 14:31
-- Version du serveur :  10.1.32-MariaDB
-- Version de PHP :  5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `framework`
--

-- --------------------------------------------------------

--
-- Structure de la table `articlecategories`
--

CREATE TABLE `articlecategories` (
  `id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articlecategories`
--

INSERT INTO `articlecategories` (`id`, `site_id`, `code`, `label`, `created_at`, `updated_at`) VALUES
(2, 2, 'cat_a', 'Actualité', '2017-08-01 16:43:48', '2018-02-06 11:43:53'),
(4, 7, 'news', 'News', '2017-12-07 16:03:23', '2017-12-07 16:03:23');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `media_id` int(11) DEFAULT NULL,
  `articlecategory_id` int(11) DEFAULT NULL,
  `status` enum('draft','pending','published','tomodify','deleted') DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `hooked` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `in_phototheque` int(11) NOT NULL DEFAULT '0',
  `une` int(11) NOT NULL DEFAULT '0',
  `media_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `galleries`
--

INSERT INTO `galleries` (`id`, `site_id`, `title`, `description`, `in_phototheque`, `une`, `media_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Test de gallerie', '', 0, 0, NULL, '2017-12-11 14:59:06', '2017-12-11 14:59:26');

-- --------------------------------------------------------

--
-- Structure de la table `galleries_medias`
--

CREATE TABLE `galleries_medias` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `title` text,
  `position` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  `url` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `cockpit` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `groups`
--

INSERT INTO `groups` (`id`, `code`, `label`, `cockpit`, `created_at`, `updated_at`) VALUES
(1, 'administrators', 'Administrateurs', 1, '2017-07-05 14:46:15', '2017-07-05 14:46:15'),
(3, 'users', 'Utilisateurs', 0, '2017-07-05 14:46:15', '2017-07-05 14:46:15'),
(4, 'writers_ce', 'Rédacteurs', 1, '2017-12-07 11:31:12', '2017-12-07 11:33:01');

-- --------------------------------------------------------

--
-- Structure de la table `mediacategories`
--

CREATE TABLE `mediacategories` (
  `id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `mediacategories`
--

INSERT INTO `mediacategories` (`id`, `site_id`, `code`, `label`, `created_at`, `updated_at`) VALUES
(1, 1, 'product', 'Produit', '2017-04-22 14:42:50', '2017-04-22 14:42:50'),
(2, 1, 'user', 'Utilisateur', '2017-04-22 14:43:00', '2017-04-22 14:43:00'),
(3, 1, 'article', 'Article', '2017-04-22 15:45:17', '2017-04-22 16:06:55'),
(4, 1, 'menuitem', 'Menu Item', '2017-05-03 10:28:30', '2017-05-03 10:28:30'),
(5, 1, 'page', 'Page', '2017-07-25 13:22:58', '2017-07-25 13:22:58');

-- --------------------------------------------------------

--
-- Structure de la table `mediaformats`
--

CREATE TABLE `mediaformats` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `mediaformats`
--

INSERT INTO `mediaformats` (`id`, `code`, `label`, `width`, `height`, `created_at`, `updated_at`) VALUES
(1, 'icon_menu', 'Icones Menu', 64, 64, '2017-07-25 12:36:42', '2017-07-25 12:37:42'),
(2, 'media_thumbnail', 'Vignette media', 50, 50, '2017-07-25 12:36:42', '2017-07-25 12:37:42');

-- --------------------------------------------------------

--
-- Structure de la table `medias`
--

CREATE TABLE `medias` (
  `id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `mediacategory_id` int(11) DEFAULT NULL,
  `type` enum('image','video','audio') NOT NULL DEFAULT 'image',
  `name` varchar(255) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `audio` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `menuitems`
--

CREATE TABLE `menuitems` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `link` varchar(255) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `new_window` int(11) NOT NULL DEFAULT '0',
  `show_label` int(11) NOT NULL DEFAULT '1',
  `show_icon` int(11) NOT NULL DEFAULT '1',
  `groups` text,
  `active` int(11) NOT NULL DEFAULT '1',
  `connected` tinyint(1) NOT NULL DEFAULT '1',
  `notconnected` tinyint(1) NOT NULL DEFAULT '0',
  `important` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `site_id`, `label`, `active`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, 'Menu Principal', 1, 'main', '2017-04-03 16:59:51', '2017-07-24 16:12:42'),
(2, 1, 'Menu Footer 2', 1, 'footer2', '2017-07-24 16:31:28', '2017-07-24 16:31:28'),
(3, 1, 'Menu Footer 1', 1, 'footer1', '2017-07-24 16:23:00', '2017-07-24 16:23:00');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `layout` varchar(255) DEFAULT NULL,
  `show_page_title` int(11) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL,
  `status` enum('draft','pending','published','tomodify','deleted') NOT NULL,
  `meta_description` text,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pages`
--

INSERT INTO `pages` (`id`, `site_id`, `page_id`, `user_id`, `title`, `content`, `layout`, `show_page_title`, `active`, `status`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, 'Accueil', '{\"title\":\"Accueil\",\"active\":\"1\",\"sections\":[{\"blockType\":\"section\",\"fullwidth\":true,\"attributes\":{},\"styles\":{},\"rows\":[{\"blockType\":\"row\",\"attributes\":{},\"styles\":{},\"cols\":[{\"blockType\":\"row\",\"attributes\":{},\"styles\":{},\"content\":\"%3Ch1%20style%3D%22text-align%3A%20center%3B%22%3EBienvenue%20sur%20le%20Bureau%20virtuel%3C%2Fh1%3E\",\"widget\":null}]}]}],\"dialog\":null}', '', 1, 1, 'published', NULL, NULL, '2017-04-06 15:50:15', '2017-12-07 11:28:13');

-- --------------------------------------------------------

--
-- Structure de la table `productcategories`
--

CREATE TABLE `productcategories` (
  `id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `description` text,
  `parent` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `productcategory_id` int(11) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(19,4) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `roleassignments`
--

CREATE TABLE `roleassignments` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `roleassignments`
--

INSERT INTO `roleassignments` (`id`, `role_id`, `group_id`, `user_id`, `created_at`, `updated_at`) VALUES
(12, 1, 1, NULL, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(13, 2, 1, NULL, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(14, 3, 1, NULL, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(15, 4, 1, NULL, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(16, 1, 2, NULL, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(17, 2, 2, NULL, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(18, 3, 2, NULL, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(19, 4, 2, NULL, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(20, 1, 4, NULL, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(21, 3, 4, NULL, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(22, 1, NULL, 8, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(23, 2, NULL, 8, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(24, 3, NULL, 8, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(25, 4, NULL, 8, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(26, 1, NULL, 9, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(27, 2, NULL, 9, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(28, 3, NULL, 9, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(29, 4, NULL, 9, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(30, 1, NULL, 10, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(31, 2, NULL, 10, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(32, 3, NULL, 10, '2017-12-07 11:31:42', '2017-12-07 11:31:42'),
(33, 4, NULL, 10, '2017-12-07 11:31:42', '2017-12-07 11:31:42');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `code`, `label`, `created_at`, `updated_at`) VALUES
(1, 'cms_page_write', 'Créer / Modifier pages', '2016-12-31 23:00:00', '2016-12-31 23:00:00'),
(2, 'cms_page_publish', 'Publier page', '2016-12-31 23:00:00', '2016-12-31 23:00:00'),
(3, 'cms_article_write', 'Créer / Modifier articles page', '2016-12-31 23:00:00', '2016-12-31 23:00:00'),
(4, 'cms_article_publish', 'Publier article', '2016-12-31 23:00:00', '2016-12-31 23:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `sites`
--

CREATE TABLE `sites` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `host` varchar(255) NOT NULL,
  `brand_logo` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `home_page` varchar(255) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `googleplus` varchar(255) DEFAULT NULL,
  `pinterest` varchar(255) DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `signup_opt` int(11) NOT NULL DEFAULT '0',
  `maintenance` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sites`
--

INSERT INTO `sites` (`id`, `label`, `description`, `host`, `brand_logo`, `created_at`, `updated_at`, `active`, `home_page`, `facebook`, `twitter`, `googleplus`, `pinterest`, `theme`, `signup_opt`, `maintenance`) VALUES
(1, 'LazyPHP', 'LazyPHP', 'lazyphp.fixe', '/assets/images/logo-lazyphp-150px.png', '2018-04-20 10:44:52', NULL, 1, '/pages/1', NULL, NULL, NULL, NULL, '', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verification_code` varchar(255) DEFAULT NULL,
  `email_verification_date` varchar(255) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `site_id`, `lastname`, `firstname`, `email`, `password`, `email_verification_code`, `email_verification_date`, `group_id`, `media_id`, `active`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin', 'ADMIN', 'admin@test.com', '$6$199337193b7024b3$TRIFwsRF9laQy/hxaZip20EzS2IAUwHyH66aiDq7k5QCE4j6BAdo7jK0gIzC17suC508WVLgvNRssDX9Ci2VF1', NULL, NULL, 1, NULL, 1, '2018-05-28 13:38:58', NULL),
(2, 1, 'LOLO', 'lolo', 'ldandoy@gmail.com', '$6$199337193b7024b3$TRIFwsRF9laQy/hxaZip20EzS2IAUwHyH66aiDq7k5QCE4j6BAdo7jK0gIzC17suC508WVLgvNRssDX9Ci2VF1', 'SYXUX3YQZEU02JRLODQSN21EBCCJ34', '2018-04-06 10:32:27', 3, NULL, 1, '2018-04-06 10:32:27', '2018-04-06 10:32:27');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articlecategories`
--
ALTER TABLE `articlecategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_id` (`site_id`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `site_id` (`site_id`);

--
-- Index pour la table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `galleries_medias`
--
ALTER TABLE `galleries_medias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_galleries_medias_gallery_idx` (`gallery_id`),
  ADD KEY `fk_galleries_medias_media_idx` (`media_id`);

--
-- Index pour la table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mediacategories`
--
ALTER TABLE `mediacategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_id` (`site_id`);

--
-- Index pour la table `mediaformats`
--
ALTER TABLE `mediaformats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mediacategory_id` (`mediacategory_id`),
  ADD KEY `site_id` (`site_id`);

--
-- Index pour la table `menuitems`
--
ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_id` (`site_id`);

--
-- Index pour la table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_id` (`site_id`);

--
-- Index pour la table `productcategories`
--
ALTER TABLE `productcategories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roleassignments`
--
ALTER TABLE `roleassignments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_id` (`media_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articlecategories`
--
ALTER TABLE `articlecategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `galleries_medias`
--
ALTER TABLE `galleries_medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `mediacategories`
--
ALTER TABLE `mediacategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `mediaformats`
--
ALTER TABLE `mediaformats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `medias`
--
ALTER TABLE `medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `productcategories`
--
ALTER TABLE `productcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roleassignments`
--
ALTER TABLE `roleassignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
