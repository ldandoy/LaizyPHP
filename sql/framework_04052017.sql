-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 04, 2017 at 01:04 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 5.6.30-10+deb.sury.org~xenial+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `framework`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verification_code` varchar(255) DEFAULT NULL,
  `email_verification_date` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `lastname`, `firstname`, `email`, `password`, `email_verification_code`, `email_verification_date`, `active`, `created_at`, `updated_at`) VALUES
(2, 'ADMIN', 'Admin', 'admin@test.com', '$6$199337193b7024b3$TRIFwsRF9laQy/hxaZip20EzS2IAUwHyH66aiDq7k5QCE4j6BAdo7jK0gIzC17suC508WVLgvNRssDX9Ci2VF1', 'VUFMUE8OW386EPX979C4LPS709RL0E', '2017-04-01 17:45:35', 1, '2017-04-01 17:45:35', '2017-04-11 15:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `user_id`, `site_id`, `media_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Articles de test', 'Est-ce que çà marche ?', 5, 1, 0, 0, '2017-04-04 16:30:03', '2017-04-04 16:30:03'),
(2, 'Articles 2', 'Contenu de l\'article 2', 5, 1, 0, 0, '2017-04-04 16:30:03', '2017-04-04 16:30:03'),
(3, '456 Test', 'ha ha on sait jamais quoi', 5, 1, 0, 0, '2017-04-11 15:48:00', '2017-04-11 15:48:00'),
(4, 'Test', 'Articles pour le site 1', 5, 2, 9, 1, '2017-04-21 18:14:05', '2017-04-22 16:40:54');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent`, `name`, `description`, `active`, `created_at`, `updated_at`, `position`) VALUES
(1, NULL, 'Test', 'rez', 1, '2017-04-10 15:40:59', '2017-04-10 15:40:59', 0),
(2, NULL, 'Toto', 'qsdqsd', 1, '2017-04-11 17:17:54', '2017-04-11 17:18:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(3, 'aaa', 'aaa', '2017-04-07 14:49:41', '2017-04-22 16:07:31');

-- --------------------------------------------------------

--
-- Table structure for table `galleries_medias`
--

CREATE TABLE `galleries_medias` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `title` text,
  `position` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galleries_medias`
--

INSERT INTO `galleries_medias` (`id`, `gallery_id`, `media_id`, `description`, `title`, `position`, `active`, `created_at`, `updated_at`) VALUES
(1, 3, 7, NULL, NULL, 0, 1, '2017-04-22 16:07:31', '2017-04-22 16:07:31');

-- --------------------------------------------------------

--
-- Table structure for table `mediacategories`
--

CREATE TABLE `mediacategories` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mediacategories`
--

INSERT INTO `mediacategories` (`id`, `code`, `label`, `created_at`, `updated_at`) VALUES
(1, 'product', 'Product', '2017-04-22 12:42:50', '2017-04-22 12:42:50'),
(2, 'user', 'User', '2017-04-22 12:43:00', '2017-04-22 12:43:00'),
(3, 'article', 'Article', '2017-04-22 13:45:17', '2017-04-22 14:06:55'),
(4, 'menuitem', 'Menu Item', '2017-05-03 08:28:30', '2017-05-03 08:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

CREATE TABLE `medias` (
  `id` int(11) NOT NULL,
  `type` enum('image','video','audio') NOT NULL DEFAULT 'image',
  `name` varchar(255) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `audio` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `mediacategory_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medias`
--

INSERT INTO `medias` (`id`, `type`, `name`, `description`, `image`, `video`, `audio`, `url`, `mediacategory_id`, `created_at`, `updated_at`) VALUES
(7, 'image', 'Test', 'sdqsdqsd', '/uploads/media/7/7_image.png', NULL, NULL, '', 0, '2017-04-12 15:28:57', '2017-04-12 15:35:05'),
(8, 'image', 'Peugot 206', '', '/uploads/media/8/8_image.jpg', NULL, NULL, NULL, 3, '2017-04-22 16:19:38', '2017-04-22 16:19:38'),
(9, 'image', '20170422162742', NULL, '/uploads/media/9/9_image.jpg', NULL, NULL, NULL, 3, '2017-04-22 16:27:42', '2017-04-22 16:27:42'),
(10, 'image', '20170503103015', NULL, '/uploads/media/1/0/10_image.jpg', NULL, NULL, NULL, 4, '2017-05-03 10:30:15', '2017-05-03 10:30:15'),
(11, 'image', '20170503163740', NULL, '/uploads/media/1/1/11_image.jpg', NULL, NULL, NULL, 4, '2017-05-03 16:37:40', '2017-05-03 16:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `menuitems`
--

CREATE TABLE `menuitems` (
  `id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `link` varchar(255) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuitems`
--

INSERT INTO `menuitems` (`id`, `parent`, `label`, `position`, `active`, `created_at`, `updated_at`, `link`, `menu_id`, `media_id`) VALUES
(1, NULL, 'Articles', 0, 1, '2017-04-03 16:59:51', '2017-05-03 10:31:23', '/articles/index', 1, 10),
(11, NULL, 'Test', 0, 1, '2017-04-24 16:32:38', '2017-05-03 16:38:29', '/pages/1', 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `principal` tinyint(1) NOT NULL,
  `site_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `label`, `active`, `principal`, `site_id`, `created_at`, `updated_at`) VALUES
(1, 'Menu Principal', 1, 1, 1, '2017-04-03 16:59:51', '2017-04-21 17:57:16'),
(2, 'Menu Footer', 0, 0, 1, '2017-04-11 13:33:14', '2017-04-11 13:33:14'),
(3, 'Menu Principal', 1, 1, 2, '2017-04-21 17:22:22', '2017-04-21 18:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `site_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `site_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Accueil', '{\"section_1\":{\"name\":\"section_1\",\"class\":\"\",\"lignes\":{\"section_1_ligne_1\":{\"name\":\"section_1_ligne_1\",\"class\":\"\",\"styles\":{},\"cols\":{\"section_1_ligne_1_col_1\":{\"name\":\"section_1_ligne_1_col_1\",\"class\":\"\",\"styles\":{\"text-align\":\"center\"},\"widgets\":{\"widget_text_content\":\"Vos avantages 1\"}}}}},\"styles\":{}},\"section_2\":{\"name\":\"section_2\",\"class\":\"\",\"lignes\":{\"section_2_ligne_1\":{\"name\":\"section_2_ligne_1\",\"class\":\"\",\"styles\":{},\"cols\":{\"section_2_ligne_1_col_1\":{\"name\":\"section_2_ligne_1_col_1\",\"class\":\"\",\"styles\":{\"color\":\"#FFF\",\"font-size\":\"40px\",\"text-align\":\"center\"},\"widgets\":{\"widget_text_content\":\"Comment çà marche ?\"}}}}},\"styles\":{\"background\":\"#35ccbb\",\"height\":\"200px\"}},\"section_3\":{\"name\":\"section_3\",\"class\":\"\",\"lignes\":{\"section_3_ligne_1\":{\"name\":\"section_3_ligne_1\",\"class\":\"\",\"styles\":{},\"cols\":{\"section_3_ligne_1_col_1\":{\"name\":\"section_3_ligne_1_col_1\",\"class\":\"\",\"styles\":{\"text-align\":\"center\"},\"widgets\":{\"widget_text_content\":\"LES  DERNIERS EVENEMENTS\\n<br>\\nChaque mois, retouvez les offres flash du CE\"}}}}},\"styles\":{\"background\":\"#283138\",\"height\":\"\",\"color\":\"#FFF\"}},\"section_4\":{\"name\":\"section_4\",\"class\":\"container\",\"lignes\":{\"section_4_ligne_1\":{\"name\":\"section_4_ligne_1\",\"class\":\"\",\"styles\":{},\"cols\":{\"section_4_ligne_1_col_1\":{\"name\":\"section_4_ligne_1_col_1\",\"class\":\"\",\"styles\":{\"text-align\":\"center\",\"font-size\":\"20px\"},\"widgets\":{\"widget_text_content\":\"<i class=\\\"fa fa-commenting-o\\\" aria-hidden=\\\"true\\\"></i>\\n<br>\\nCONTACT\"}},\"section_4_ligne_1_col_2\":{\"name\":\"section_4_ligne_1_col_2\",\"class\":\"\",\"styles\":{\"text-align\":\"center\",\"font-size\":\"20px\"},\"widgets\":{\"widget_text_content\":\"<i class=\\\"fa fa-users\\\" aria-hidden=\\\"true\\\"></i>\\n<br>\\nVIE DU CE\"}},\"section_4_ligne_1_col_3\":{\"name\":\"section_4_ligne_1_col_3\",\"class\":\"\",\"styles\":{\"text-align\":\"center\",\"font-size\":\"20px\"},\"widgets\":{\"widget_text_content\":\"<i class=\\\"fa fa-calendar\\\" aria-hidden=\\\"true\\\"></i>\\n<br>\\nAGENDA\"}},\"section_4_ligne_1_col_4\":{\"name\":\"section_4_ligne_1_col_4\",\"class\":\"\",\"styles\":{\"text-align\":\"center\",\"font-size\":\"20px\"},\"widgets\":{\"widget_text_content\":\"<i class=\\\"fa fa-comments-o\\\" aria-hidden=\\\"true\\\"></i>\\n<br>\\nFAQ\"}}}}},\"styles\":{\"background\":\"#0d141e\",\"color\":\"#FFF\"}}}', 1, 1, '2017-04-06 15:50:15', '2017-05-04 11:02:39'),
(2, 'Test 2', '{\"section_1\":{\"name\":\"section_1\",\"class\":\"\",\"lignes\":{\"section_1_ligne_1\":{\"name\":\"section_1_ligne_1\",\"class\":\"\",\"styles\":{},\"cols\":{\"section_1_ligne_1_col_1\":{\"name\":\"section_1_ligne_1_col_1\",\"class\":\"\",\"styles\":{},\"widgets\":{\"styles\":{\"color\":\"red\"},\"widget_text_content\":\"Test\"}}}}},\"styles\":{}}}', 1, 1, '2017-04-29 15:42:35', '2017-05-04 12:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(19,4) NOT NULL DEFAULT '0.0000',
  `quantity` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `media_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `host` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `label`, `description`, `host`, `created_at`, `updated_at`, `active`) VALUES
(1, 'LazyPHP', 'Site de LazyPHP', 'lazyphp.fixe', '2017-04-16 12:27:46', '2017-04-21 15:15:47', 1),
(2, 'Site 1', '', 'site1.fixe', '2017-04-16 13:48:15', '2017-04-21 15:19:21', 1),
(5, 'Test 2', 'sqdqsd', 'test2.fixe', '2017-04-21 17:07:20', '2017-04-21 15:19:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` int(11) NOT NULL,
  `description` text NOT NULL,
  `delay` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verification_code` varchar(255) DEFAULT NULL,
  `email_verification_date` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `email`, `password`, `email_verification_code`, `email_verification_date`, `active`, `created_at`, `updated_at`, `address`) VALUES
(5, 'DANDOY', 'Loïc', 'ldandoy@gmail.com', '$6$199337193b7024b3$TRIFwsRF9laQy/hxaZip20EzS2IAUwHyH66aiDq7k5QCE4j6BAdo7jK0gIzC17suC508WVLgvNRssDX9Ci2VF1', '7N68HJZGH06NR0EN12XG2ET1NWAUTU', '2017-04-01 14:27:15', 0, '2017-04-01 14:27:15', '2017-04-01 14:27:15', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `site_id` (`site_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries_medias`
--
ALTER TABLE `galleries_medias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_galleries_medias_gallery_idx` (`gallery_id`),
  ADD KEY `fk_galleries_medias_media_idx` (`media_id`);

--
-- Indexes for table `mediacategories`
--
ALTER TABLE `mediacategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mediacategory_id` (`mediacategory_id`);

--
-- Indexes for table `menuitems`
--
ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_id` (`site_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_id` (`site_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `galleries_medias`
--
ALTER TABLE `galleries_medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mediacategories`
--
ALTER TABLE `mediacategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `medias`
--
ALTER TABLE `medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `galleries_medias`
--
ALTER TABLE `galleries_medias`
  ADD CONSTRAINT `fk_galleries_medias_gallery` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_galleries_medias_media` FOREIGN KEY (`media_id`) REFERENCES `medias` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `menuitems`
--
ALTER TABLE `menuitems`
  ADD CONSTRAINT `menuitems_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
