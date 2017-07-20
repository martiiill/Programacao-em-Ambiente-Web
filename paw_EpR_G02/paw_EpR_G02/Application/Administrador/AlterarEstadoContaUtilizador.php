<?php
session_start();
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'UserManager.php');


if (isset($_SESSION['login'])) {
    if (filter_has_var(INPUT_POST, 'novoEstado') && filter_has_var(INPUT_POST, 'username')) {
        $userName = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $userManager = new UserManager();
        if ($userManager->checkUser($userName) != NULL) {
            $estado = filter_input(INPUT_POST, 'novoEstado', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($estado == 'ativada' || $estado == 'nao-ativada') {
                $userManager->alterarContaUser($userName, $estado);
                header('Location: GestaoUtilizadores.php?update=sucesso');
            } else {
                header('Location: GestaoUtilizadores.php?update=estadoInvalido');
            }
        } else {
            header('Location: GestaoUtilizadores.php?update=idInvalido');
        }
    }
} else {
    header("Location: ../Autenticacao/fazerLoginAdministrador.php");
}
