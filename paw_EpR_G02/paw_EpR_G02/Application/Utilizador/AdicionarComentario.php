<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
require __DIR__ . '/../../Config.php';
require_once (Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php');

if (isset($_SESSION['login'])) {
    $titulo = filter_input(INPUT_GET, 'titulo');
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Adicionar Comentário ao Documento</title>
            <link rel="stylesheet" type="text/css" href="../CSS/styleAdicionarComentario.css" title="style">
            <script src="../JavaScript/ValidarCriarComentario.js" type="text/javascript"></script>
        </head>
        <body>                   
            <h2 class="titulo_criar_documento">Adicionar Comentário ao Documento <?php echo $titulo; ?></h2>

            <div class="form">
                <form id="addCom_form" name="addCom_form" method="post" action="Validacoes/ValidarCriarComentario.php?titulo=<?php echo $titulo; ?>">
                    <label for="texto">Comentário: (Máximo 60 caracteres)</label>
                    <input id="texto" required type="text" name="texto" maxlength="60" placeholder="Comentario"/> 
                    <label id="textoValidationMessage"></label>

                    <input type="submit" value="Criar comentario" id="sbutton" required>
                </form>
            </div>

             <ul>
                <li><a href="../Autenticacao/logout.php">Logout</a></li>
                <li><a href="../Utilizador/VistaUtilizador.php">Voltar</a></li>
            </ul>       

            <?php include_once '../Partials/footer.php'; ?>
        </body>
    </html>
    <?php
} else {
    header("Location: ../Autenticacao/fazerLogin.php");
}
    
