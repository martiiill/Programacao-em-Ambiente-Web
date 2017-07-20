<?php

session_start();
require __DIR__ . '/../../../Config.php';

require_once (Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath() . 'ComentarioManager.php');
require_once (Config::getApplicationModelPath() . 'Comentario.php');

if (isset($_SESSION['login'])) {
    if (filter_has_var(INPUT_POST, 'texto')) {
        if (strlen(filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) < 60) {
            $texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        } else {
            header('Location: ../../Utilizador/ComentarDocumentos.php?coment=errotexto');
        }
        $manager = new ComentarioManager();
        $doc = filter_input(INPUT_GET, 'titulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $c = new Comentario();
        $cc = $c->createObject($doc, $texto, $_SESSION['login']);
        $manager->createComentario($cc);
        header('Location: ../../Utilizador/ComentarDocumentos.php?coment=sucesso');
    } else {
        header('Location: ../../Utilizador/ComentarDocumentos.php?coment=erro');
    }
} else {
    header("Location: ../../Autenticacao/fazerLogin.php");
}