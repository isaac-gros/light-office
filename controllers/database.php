<?php

try {

	$database = new PDO (
        'mysql:host=' . constant('DB_HOST') . ';dbname=' . constant('DB_NAME'),
        constant('DB_USER'),
        constant('DB_PASSWORD')
    );

} catch (PDOException $e) {
	print_r($e);
}

?>