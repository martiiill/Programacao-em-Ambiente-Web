<?php
session_start();
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'CategoriaManager.php');
require_once (Config::getApplicationManagerPath() . 'UserManager.php');



if (isset($_SESSION['login'])) {
        if (filter_has_var(INPUT_POST, 'idCategoria') && filter_has_var(INPUT_POST, 'nomeCategoria')) {
            
                    $idCategoria = filter_input(INPUT_POST, 'idCategoria', FILTER_SANITIZE_NUMBER_INT);
                    $nomeCategoria = filter_input(INPUT_POST, 'nomeCategoria', FILTER_SANITIZE_NUMBER_INT);
                    $categoriaManager = new CategoriaManager();
                    if ($categoriaManager->getCategoriaById($idCategoria) == TRUE) {
                        try {
                                header('Location: ../Administrador/GestaoCategorias.php?update=sucesso');
                        } catch (InvalidArgumentException $iae) {
                            header('Location: ../Administrador/GestaoCategorias.php?update=jaExisteId');
                        } catch (Exception $e) {
                            header('Location: ../Administrador/GestaoCategorias.php?update=erro');
                        }
                    } else {
                        header('Location: ../Administrador/GestaoCategorias.php?update=idInvalido');                   
        } 
                }
        
} else {
    header("Location: ../Autenticacao/fazerLoginAdministrador.php");
}