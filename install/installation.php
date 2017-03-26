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
            $sql = "DROP TABLE IF EXISTS `administrators`;CREATE TABLE `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verification_code` varchar(255) DEFAULT NULL,
  `email_verification_date` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            echo "<p>Tables `administrators`</p>";
            $sql = "DROP TABLE IF EXISTS `categories`;CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            echo "<p>Tables `categories`</p>";
            $sql = "DROP TABLE IF EXISTS `products`;CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(19,4) NOT NULL DEFAULT '0.0000',
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            echo "<p>Tables `products`</p>";
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
        ?>
        <p>OK</p>
        <h2>Supression répertoire d'install</h2>
        <?php
        rmdir('../install');
        ?>
        <p>OK</p>
    </body>
</html>