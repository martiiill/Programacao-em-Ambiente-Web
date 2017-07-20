<?php
session_start();
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'CategoriaManager.php');
require_once (Config::getApplicationModelPath().'Categoria.php');

if (isset($_SESSION['login'])) {
    if (filter_has_var(INPUT_POST, 'idCategoria') && filter_has_var(INPUT_POST, 'nomeCategoria')) {
        $idCategoria = filter_input(INPUT_POST, 'idCategoria', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nomeCategoria = filter_input(INPUT_POST, 'nomeCategoria', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $categoria = new Categoria($idCategoria, $nomeCategoria);
        try {
            $categoriaManager = new CategoriaManager();
            $categoriaManager->createCategoria($categoria);
            header('Location: ../Administrador/GestaoCategorias.php?adicionar=sucesso');
        } catch (InvalidArgumentException $iae) {
            header('Location: ../Administrador/GestaoCategorias.php?adicionar=existeId');
        } catch (Exception $e) {
            header('Location: ../Administrador/GestaoCategorias.php?adicionar=erro');
        }
    } else {
        header('Location:../Administrador/GestaoCategorias.php?adicionar=Erro_Formulario');
    }
} else {
    header("Location: ../Autenticacao/fazerLoginAdministrador.php");
}
