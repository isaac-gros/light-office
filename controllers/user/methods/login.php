<?php

require $_SERVER['DOCUMENT_ROOT'] . '/config/database/define-database.php';
require $_SERVER['DOCUMENT_ROOT'] . '/controllers/database.php';

$username = $_POST['login_username'];
$password = $_POST['login_password'];

$connected = false;

if(isset($_POST['login_submit']) && !empty($username) && !empty($password)) {

    try {
        $catch_user = 'SELECT * from users WHERE name_user = "' . $username . '"';
        $verify_user = $database->prepare($catch_user);
        $verify_user->execute();
        $users_data = $verify_user->fetch(PDO::FETCH_ASSOC);

        if(password_verify($password, $users_data['password_user'])) {
            $connected = true;
        } else {
            echo '<i>Le mot de passe que vous avez saisi est incorrect.</i>';
        }
    } catch (PDOException $error) {
        print_r($error);
    }

} else {
    echo '<i>Veuillez saisir des informations.</i>';
}

if($connected) {
    //Success !
}