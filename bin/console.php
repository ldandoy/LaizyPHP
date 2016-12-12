<?php

# On regarde les arguments
var_dump($argv);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__).DS.'../');

switch ($argv[1]) {
	case 'generate':
	case 'g':
		# Génération de fichier
		switch ($argv[2]) {
			case 'controller':
				$file = ROOT.'app/'.$argv[2].'s/'.strtolower($argv[3]).ucfirst($argv[2]).'.php';
				$txt = "<?php\n\nnamespace app\\$argv[2]s;\n\nuse system\Controller;\n\nclass " . ucfirst($argv[3])." extends ".ucfirst($argv[2])."\n{\n\n\n}";
			break;

			case 'model':
				$file = ROOT.'app/'.$argv[2].'s/'.ucfirst($argv[3]).'.php';
				$txt = "<?php\n\nnamespace app\\$argv[2]s;\n\nuse system\Model;\n\nclass " . ucfirst($argv[3])." extends ".ucfirst($argv[2])."\n{\n\n\n}";
			break;
			default:
				echo "Erreur de commande: php bin/console.php <action> <object> <value>\n";
			break;
		}

		if (!file_exists($file)) {
			$myfile = fopen($file, 'w+') or die('Unable to open file !');
			fwrite($myfile, $txt);
			fclose($myfile);
		} else {
			echo "Erreur de commande: Le fichier existe déjà\n";
		}
	break;
	
	default:
		echo "Erreur de commande: php bin/console.php <action> <object> <value>\n";
	break;
}