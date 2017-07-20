<?php
session_start();
require __DIR__.'/../../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'UserManager.php');
require_once (Config::getApplicationModelPath().'User.php');

if (isset($_SESSION['login'])) {
    if (filter_has_var(INPUT_POST, 'nome') && filter_has_var(INPUT_POST, 'morada') && filter_has_var(INPUT_POST, 'contacto')) {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $morada = filter_input(INPUT_POST, 'morada', FILTER_SANITIZE_SPECIAL_CHARS);
        $contacto = filter_input(INPUT_POST, 'contacto', FILTER_SANITIZE_NUMBER_INT);
        try {
            $userManager = new UserManager();
            $userManager->updatePerfil($_SESSION['login'], $nome, $morada, $contacto);
            header('Location: ../../Utilizador/VerPerfil.php?update=sucesso');
            
        } catch (Exception $e) {
            header('Location: ../../Utilizador/VerPerfil.php?update=erro');
        }
    } else {
        header('Location:../../Utilizador/VerPerfil.php?update=erro_form');
    }
} else {
    header("Location: ../../Autenticacao/fazerLogin.php");
}