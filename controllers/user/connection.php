<?php

$get_users = $database->prepare('SELECT * from users');
$get_users->execute();
$users_data = $get_users->fetch(PDO::FETCH_ASSOC);


include_once(ABSPATH . '/view/user/register.html');
include_once(ABSPATH . '/view/user/login.html');

if($connected) {
    echo 'Yay x2!';
}
?>