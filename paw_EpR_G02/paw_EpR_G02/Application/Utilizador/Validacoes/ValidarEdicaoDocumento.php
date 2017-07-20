<?php

session_start();
require __DIR__ . '/../../../Config.php';

require_once (Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath() . 'EdicaoManager.php');
require_once (Config::getApplicationModelPath() . 'Edicao.php');

if (isset($_SESSION['login'])) {
    if (filter_has_var(INPUT_GET, 'porque')) {
        $titulo = filter_input(INPUT_GET, 'titulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pq = filter_input(INPUT_GET, 'porque', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        try {
            $editmanager = new EdicaoManager();
            $editmanager->createComentario(new Edicao($titulo, $pq));
            header('Location: ../../Utilizador/EditarDocumento.php?doc=' . $titulo);
        } catch (InvalidArgumentException $iae) {
            header('Location: ../../Utilizador/GestaoDocumentos.php?edit=jaExiste');
        }
    } else {
        header('Location: ../../Utilizador/GestaoDocumentos.php?edit=erroporque');
    }
} else {
    header("Location: ../../Autenticacao/fazerLogin.php");
}