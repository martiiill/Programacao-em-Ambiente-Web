<?php
session_start();

require __DIR__.'/../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'CategoriaManager.php');

if (isset($_SESSION['login'])) {
    $mensagem = filter_input(INPUT_GET, 'adicionar', FILTER_SANITIZE_SPECIAL_CHARS);
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="../CSS/styleCategorias.css" title="style">
            <script src="../JavaScript/ValidarFormularioAdicionarCategoria.js" type="text/javascript"></script>
            <title>Adicionar Categoria</title>
        </head>
        <body>
            <h2>Adicionar uma Categoria</h2>

            <form id="adicionarCategoriaFormulario" name="adicionarCategoria" method="post" action="ValidarAdicionarCategoria.php" enctype="multipart/form-data">
                <p>
                    <label>
                        <span>ID Categoria: </span>
                        <input type="number" id="idCategoria" required name="idCategoria" size="60">
                    </label>               
                    <br>
                    <label id="idCategoriaValidationMessage"></label>
                </p>
                <p>
                    <label>
                        <span>Nome Categoria: </span>
                        <input type="text" id="nomeCategoria" name="nomeCategoria" size="60"/>
                    </label>
                    <br>
                    <label id="nomeCategoriaValidationMessage"></label>
                </p>

                <input type="submit" name="submit" value="Adicionar" required/>
            </form>
            <a href="../Autenticacao/logout.php">Logout</a>
            <a href="VistaAdmin.php">Voltar</a>
        </body>
    </html>
    <?php
} else {
    header("Location: ../Autenticacao/fazerLoginAdministrador.php");
}