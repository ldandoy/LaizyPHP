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

            $sql = "DROP TABLE IF EXISTS `medias`;CREATE TABLE `medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('image','video','music') NOT NULL DEFAULT 'image',
  `name` varchar(255) NOT NULL,
  `description` text,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            echo "<p>Tables `medias`</p>";

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

        <h2>Insertion données de tests</h2>
        <?php
        $sql = "INSERT INTO `administrators` VALUES (1,'Laurent','Comex','laurent.comex@gmail.com','$6$199337193b7024b3$me5IvytK5M95oMd2e7TtBuBCowDVYqx20ahJeHNraOXGIBxvpZXrSMtaJc.gxbIQOrpdHxg.1aHP0N7y2/N0p.','8XQAVGOQRFVF2KYQPYE25WVMZLBVAE','2017-03-14 18:48:03',0,'2017-03-14 18:48:03','2017-03-15 09:46:22');";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $sql = "INSERT INTO `categories` VALUES (3,NULL,'aaa','aaa',0,1,'2017-03-24 10:00:21','2017-03-24 15:58:26'),(4,3,'bbb','bbb',0,1,'2017-03-24 10:22:17','2017-03-24 15:58:35'),(5,3,'ccc','ccc',1,1,'2017-03-24 16:00:39','2017-03-24 16:00:39'),(6,NULL,'ddd','ddd',0,1,'2017-03-24 16:00:49','2017-03-24 16:00:49'),(7,6,'eee','eee',0,1,'2017-03-24 16:00:58','2017-03-24 16:00:58'),(9,5,'fff','fff',0,1,'2017-03-25 17:45:26','2017-03-25 17:45:26');";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $sql = "INSERT INTO `products` VALUES (1,NULL,'a','',0.0000,1,'2017-03-24 06:08:14','2017-03-24 10:26:32'),(3,3,'b','',0.0000,1,'2017-03-24 06:22:25','2017-03-25 17:38:37'),(4,4,'aadazdfazfaf','ezfezfezfez',0.0000,1,'2017-03-25 17:38:30','2017-03-25 17:38:30');";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        ?>
        <p>OK</p>
        
        <h2>Supression répertoire d'install</h2>
        <?php
        rmdir('../install');
        ?>
        <p>OK</p>
    </body>
</html>