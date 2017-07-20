<?php
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'UserManager.php');


if (filter_has_var(INPUT_POST, 'username') && filter_has_var(INPUT_POST, 'password')) {
    $user = filter_input(INPUT_POST, 'username');
    $pass = md5(filter_input(INPUT_POST, 'password'));
    $userManager = new UserManager();
    if ($userManager->checkUserExistence($user,$pass)) {
        session_start();
        $_SESSION['login'] = filter_input(INPUT_POST, 'username');
        header('Location: ./../Utilizador/VistaUtilizador.php');
    } else {
        $_SESSION['login'] = filter_input(INPUT_POST, 'error');
        header('Location: fazerLogin.php?login=error');
    }
} else {
    header('Location: fazerLogin.php?login=error');
}