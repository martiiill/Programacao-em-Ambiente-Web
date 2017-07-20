<?php
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationManagerPath().'AdministradorManager.php');
require_once (Config::getApplicationManagerPath().'DocumentoManager.php');


$admin = filter_input(INPUT_POST, 'username');
$pass = filter_input(INPUT_POST, 'password');
$adminManager = new AdministradorManager();
    
if ($adminManager->checkAdminExistence($admin, $pass) != NULL) {
        session_start();
        $_SESSION['login'] = filter_input(INPUT_POST, 'username');
        header('Location: ../Administrador/VistaAdmin.php');
        
} else {
     $_SESSION['login'] = filter_input(INPUT_POST, 'error');
     header('Location: ./fazerLoginAdministrador.php?login=' . 'error');
}
