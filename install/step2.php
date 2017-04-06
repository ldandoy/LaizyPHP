<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Installation de LazyPHP v1</title>
    </head>
    <body>
        <h1>Installation de LazyPHP v1</h1>
        <h2>Chargement de la config</h2>
        <?php
            $ini_array = parse_ini_file("../config/config.ini");
            print_r($ini_array);
        ?>
        <p>OK</p>
        <h2>Chargement de la base de données</h2>
        <?php
        try {
            $pdo = new PDO('mysql:host='.$ini_array['URL'].';dbname='.$ini_array['DB'], $ini_array['USER'], $ini_array['PASSWORD']);
            
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
        ?>
        <p>OK</p>
        <h2>Création des tables</h2>
        <?php
        try {
            echo "<p>Tables `administrators`</p>";
            $sql = "CREATE TABLE `administrators` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`);ALTER TABLE `administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            echo "<p>Tables `articles`</p>";
            $sql = "CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            echo "<p>Tables `categories`</p>";
            $sql = "CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            echo "<p>Tables `medias`</p>";
            $sql = "CREATE TABLE `medias` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `origin_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`);ALTER TABLE `medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            echo "<p>Tables `menus`</p>";
            $sql = "CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            echo "<p>Tables `pages`</p>";
            $sql = "CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            echo "<p>Tables `products`</p>";
            $sql = "CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(19,4) NOT NULL DEFAULT '0.0000',
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;ALTER TABLE `products`
  ADD PRIMARY KEY (`id`); ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            echo "<p>Tables `users`</p>";
            $sql = "CREATE TABLE `users` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
        ?>
        <p>OK</p>

        <h2>Insertion données de tests</h2>
        <?php
        $admin_mdp = '$6$199337193b7024b3$TRIFwsRF9laQy/hxaZip20EzS2IAUwHyH66aiDq7k5QCE4j6BAdo7jK0gIzC17suC508WVLgvNRssDX9Ci2VF1';
        $user_mdp = '$6$199337193b7024b3$TRIFwsRF9laQy/hxaZip20EzS2IAUwHyH66aiDq7k5QCE4j6BAdo7jK0gIzC17suC508WVLgvNRssDX9Ci2VF1';
        $sql = "INSERT INTO `administrators` (`id`, `lastname`, `firstname`, `email`, `password`, `email_verification_code`, `email_verification_date`, `active`, `created_at`, `updated_at`) VALUES
(2, 'ADMIN', 'Admin', 'admin@test.com', '$admin_mdp', 'VUFMUE8OW386EPX979C4LPS709RL0E', '2017-04-01 17:45:35', 0, '2017-04-01 17:45:35', '2017-04-01 17:45:35');";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $sql = "INSERT INTO `articles` (`id`, `title`, `content`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Articles de test', 'Est-ce que çà marche ?', 5, '2017-04-04 16:30:03', '2017-04-04 16:30:03'),
(2, 'Articles 2', 'Contenu de l\'article 2', 5, '2017-04-04 16:30:03', '2017-04-04 16:30:03');";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $sql = "INSERT INTO `categories` VALUES (3,NULL,'aaa','aaa',0,1,'2017-03-24 10:00:21','2017-03-24 15:58:26'),(4,3,'bbb','bbb',0,1,'2017-03-24 10:22:17','2017-03-24 15:58:35'),(5,3,'ccc','ccc',1,1,'2017-03-24 16:00:39','2017-03-24 16:00:39'),(6,NULL,'ddd','ddd',0,1,'2017-03-24 16:00:49','2017-03-24 16:00:49'),(7,6,'eee','eee',0,1,'2017-03-24 16:00:58','2017-03-24 16:00:58'),(9,5,'fff','fff',0,1,'2017-03-25 17:45:26','2017-03-25 17:45:26');";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $sql = "INSERT INTO `products` VALUES (1,NULL,'a','',0.0000,1,'2017-03-24 06:08:14','2017-03-24 10:26:32'),(3,3,'b','',0.0000,1,'2017-03-24 06:22:25','2017-03-25 17:38:37'),(4,4,'aadazdfazfaf','ezfezfezfez',0.0000,1,'2017-03-25 17:38:30','2017-03-25 17:38:30');";

        $sql = "INSERT INTO `users` (`id`, `lastname`, `firstname`, `email`, `password`, `email_verification_code`, `email_verification_date`, `active`, `created_at`, `updated_at`, `address`) VALUES
(5, 'USER', 'User', 'user@test.com', '$user_mdp', '7N68HJZGH06NR0EN12XG2ET1NWAUTU', '2017-04-01 14:27:15', 0, '2017-04-01 14:27:15', '2017-04-01 14:27:15', 'test');";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        ?>
        <p>OK</p>
        
        <h2>Supression répertoire d'install</h2>
        <p>
        Merci de supprimer le répertoire d'installation
        </p>
        <p>OK</p>
    </body>
</html>