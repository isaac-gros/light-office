<?php

    define('ROOT', 'http://light-office.test');
    define('ABSPATH', dirname(__FILE__));

	if(file_exists('./config/database/define-database.php')) {
		
		include('./config/database/define-database.php');

		if(defined('DB_HOST') && defined('DB_NAME') && defined('DB_USER') && defined('DB_PASSWORD')) {
			include('./controllers/database.php');
			include('./controllers/user/connection.php');
		} else {
			echo '<i>Aucune valeur définie. Vérifiez votre fichier de configuration.</i>';
		}
 	} else {
		include('./view/database/init-database.html');
		echo '<i>Première liaison.</i>';
	}

?>