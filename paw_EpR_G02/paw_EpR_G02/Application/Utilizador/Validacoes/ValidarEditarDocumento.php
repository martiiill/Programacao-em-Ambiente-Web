<?php
session_start();
require __DIR__.'/../../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'DocumentoManager.php');

if (isset($_SESSION['login'])) {
    if(filter_has_var(INPUT_GET, 'corpo') && filter_has_var(INPUT_GET, 'doc')){
    $titulo = filter_input(INPUT_GET, 'doc', FILTER_SANITIZE_SPECIAL_CHARS);
    $corpo = filter_input(INPUT_GET, 'corpo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    try {
        $d = new DocumentoManager();
        echo $titulo;
        echo $corpo;
        $d->alterarConteudoDoc($titulo, $corpo);
        header('Location: ../../Utilizador/GestaoDocumentos.php?edit=sucesso');
    } catch (InvalidArgumentException $iae) {
        header('Location: ../../Utilizador/GestaoDocumentos.php?edit=jaExiste');
    }
    } else {
         header('Location: ../../Utilizador/GestaoDocumentos.php?edit=erro');
    }
} else {
    header("Location: ../../Autenticacao/fazerLogin.php");
}