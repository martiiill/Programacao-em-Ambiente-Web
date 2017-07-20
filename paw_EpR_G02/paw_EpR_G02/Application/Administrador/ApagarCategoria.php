<?php
session_start();
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'CategoriaManager.php');


if (isset($_SESSION['login'])) {
        if (filter_has_var(INPUT_GET, 'nome')) {
            $nomeCategoria = filter_input(INPUT_GET, 'nome');
            try {
                $categoriaManager = new CategoriaManager();
                $categoriaManager->deleteCategoriaByNome($nomeCategoria);
                header('Location: ../Administrador/GestaoCategorias.php?delete=sucesso');
            } catch (Exception $e) {
                header('Location: ../Administrador/GestaoCategorias.php?delete=erro');
            }
    } else {
       
        header("Location: ../Autenticacao/fazerLoginAdministrador.php");
    }
}