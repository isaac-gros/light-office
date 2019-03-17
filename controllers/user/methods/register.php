<?php

require $_SERVER['DOCUMENT_ROOT'] . '/config/database/define-database.php';
require $_SERVER['DOCUMENT_ROOT'] . '/controllers/database.php';

$username = $_POST['register_username'];
$password = $_POST['register_password'];
$confirm_password = $_POST['register_confirm_password'];

$validated = false;

if (isset($_POST['register_submit']) && !empty($username) && !empty($password) && !empty($confirm_password)) {
    if ($password == $confirm_password) {

        try {
            $create_table_user = "CREATE TABLE `users` (
    			`id_user` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    			`name_user` VARCHAR(64) NULL,
    			`password_user` VARCHAR(255) NULL
			)";
            $database->exec($create_table_user);

        } catch(PDOException $error) {
            print_r($error);
        }

        try {
            $user_exist = $database->prepare('SELECT * FROM users WHERE name_user = "' . $username . '"');
            $user_exist->execute();
            $user_data = $user_exist->fetch(PDO::FETCH_ASSOC);
            print_r($user_data);

            if(!$user_data) {
                $validated = true;
            } else {
                echo '<i>Un utilisateur portant le même nom a déjà été créé.</i>';
            }
        } catch(PDOException $error) {
            print_r($error);
        }

    } else {
        echo '<i>Les mots de passes ne correspondent pas.</i>';
    }
} else {
    echo '<i>Erreur. Vérifiez les données saisies.</i>';
}

if($validated == true) {
    $data = array(
        'user' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT),
    );

    $create_user = $database->prepare('INSERT INTO users (name_user, password_user) VALUE (:user , :password) ');
    $create_user->execute($data);
    //header('Location: http://light-office.test' );
} else {
    echo '<i>Une erreur dans le formulaire a été détectée.</i>';
}