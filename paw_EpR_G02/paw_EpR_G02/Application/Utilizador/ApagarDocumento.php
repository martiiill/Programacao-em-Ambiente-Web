<?php
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'ObservacaoManager.php');
require_once (Config::getApplicationManagerPath().'DocumentoManager.php');
require_once (Config::getApplicationManagerPath().'EdicaoManager.php');

if (filter_has_var(INPUT_GET, 'titulo')) {
    $titulo = filter_input(INPUT_GET, 'titulo');
    try {
        $manager = new DocumentoManager();
        $obM = new ObservacaoManager();
        $edM = new EdicaoManager();
        $manager->deleteDocumento($titulo);
        $obM->deleteObservacaoByTitulo($titulo);
        $edM->deleteEdicaoByDoc($titulo);
        
        header('Location: ../Utilizador/GestaoDocumentos.php?delete=sucesso');
    } catch (Exception $e) {
        header('Location: ..Utilizador/GestaoDocumentos.php?delete=erro');
    }
} else {
    header("Location: ../Utilizador/VistaUtilizador.php");
}
