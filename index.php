<?php

	if(file_exists('./config/database/define-database.php')) {
		
		include('./config/database/define-database.php');

		if(defined('DB_HOST') && defined('DB_NAME') && defined('DB_USER') && defined('DB_PASSWORD')) {
			include('./controllers/database.php');
		}
 	} else {
		include('./config/database/init-database.php');
	}

?>