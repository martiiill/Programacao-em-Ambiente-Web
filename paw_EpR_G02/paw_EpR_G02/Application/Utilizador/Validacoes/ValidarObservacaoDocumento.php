<?php

session_start();
require __DIR__.'/../../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'ObservacaoManager.php');
require_once (Config::getApplicationModelPath().'Observacao.php');

if (isset($_SESSION['login'])) {
    if (filter_has_var(INPUT_POST, 'ob')) {
        if(strlen(filter_input(INPUT_POST, 'ob', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) < 60){
             $ob = filter_input(INPUT_POST, 'ob', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        } else {
             header('Location: ../../Utilizador/GestaoDocumentos.php?o=erroob');
        }
        $titulo = filter_input(INPUT_POST, 'doc');
       
        try {
            $obManager = new ObservacaoManager();
            $obManager->createObservacao(new Observacao($titulo, $ob));
            header('Location: ../../Utilizador/GestaoDocumentos.php?o=sucesso');
        } catch (InvalidArgumentException $iae) {
            header('Location: ../../Utilizador/GestaoDocumentos.php?o=jaExiste');
        }
    } else {
        header('Location: ../../Utilizador/GestaoDocumentos.php?o=erro');
    }
} else {
    header("Location: ../../Autenticacao/fazerLogin.php");
}