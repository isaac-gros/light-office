<?php

	$status = array(
	    'connected' => false,
	    'message' => array(
	        'heading' => 'Échec de la connexion à la base de données. Vérifiez les informations saisies.',
	        'content' => null,
	    ),
	);

	if(isset($_POST['submit'])) {

		$db_host = $_POST['db_host'];
		$db_name = $_POST['db_name'];
		$db_user = $_POST['db_user'];
		$db_password = $_POST['db_password'];

		try {
		
		    $database = new PDO (
		        'mysql:host=' . $db_host . ';dbname=' . $db_name,
		        $db_user,
		        $db_password
		    );

		    $status['connected'] = true;
		    $status['message']['heading'] = 'Connexion à la base de données réussie.';

		    $create_dbfile = fopen(__DIR__ . '/define-database.php', 'w+');

		    if(file_exists('define-database.php')) {
		    	fwrite($create_dbfile, "<?php\n");
			    fwrite($create_dbfile, "\tdefine('DB_HOST', '$db_host');\n");
			    fwrite($create_dbfile, "\tdefine('DB_NAME', '$db_name');\n");
			    fwrite($create_dbfile, "\tdefine('DB_USER', '$db_user');\n");
			    fwrite($create_dbfile, "\tdefine('DB_PASSWORD', '$db_password');\n");
			    fwrite($create_dbfile, "?>");
		    }

            $root = "http://light-office.test";
		    header("Location: " . $root);

		} catch (PDOException $e) {
		    $status['connected'] = false;
		    $status['message']['content'] = $e;
		}

	    print_r($status);

	}

?>