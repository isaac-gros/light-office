<form name="database" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
 	<input type="text" placeholder="Hôte" name="db_host">
 	<input type="text" placeholder="Nom de la base de données" name="db_name">
 	<input type="text" placeholder="Nom d'utilisateur" name="db_user">
 	<input type="password" placeholder="Mot de passe" name="db_password">
 	<input type="submit" name="submit" value="Test">
 </form>

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

		    if(file_exists('define-database.php') && is_writable('define-database.php')) {
		    	fwrite($create_dbfile, "<?php\n");
			    fwrite($create_dbfile, "\tdefine('DB_HOST', '$db_host');\n");
			    fwrite($create_dbfile, "\tdefine('DB_NAME', '$db_name');\n");
			    fwrite($create_dbfile, "\tdefine('DB_USER', '$db_user');\n");
			    fwrite($create_dbfile, "\tdefine('DB_PASSWORD', '$db_password');\n");
			    fwrite($create_dbfile, "?>");
		    }


		} catch (PDOException $e) {
		    $status['connected'] = false;
		    $status['message']['content'] = $e;
		}

	    print_r($status);

	}

?>