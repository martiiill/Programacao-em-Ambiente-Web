<?php
session_start();
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');

if (isset($_SESSION['login'])) {
    $titulo = filter_input(INPUT_GET, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
    $mensagem = filter_input(INPUT_GET, 'update', FILTER_SANITIZE_SPECIAL_CHARS);
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Atualizar Documento</title>
            <link rel="stylesheet" type="text/css" href="../CSS/styleEdicao.css" title="style">
        </head>
        <body>
        
            <?php include_once '../Partials/header.php'; ?>
            <a href="../Autenticacao/logout.php">Logout</a>
            <a href="../Utilizador/GestaoDocumentos.php">Voltar</a>

                <h2>Justificação de Edição do Documento <?php echo $titulo; ?></h2>
            
                <form id="pqEdit_form" name="pqEditarDocumento" method="get" action="Validacoes/ValidarEdicaoDocumento.php">
                <p>
                    <label>                    
                        <input type="hidden" id="titulo" name="titulo" size="60" value="<?php echo $titulo; ?>">
                    </label>
                    <br>
                    <label id="DocValidationMessage"></label>
                </p>
                <p>
                    <label>
                        <span>Justificação da Edição: </span>
                        <input type="text" id="porque" required name="porque" size="100" placeholder="Porque quer editar o documento?">
                    </label>
                    <br>
                    <label id="porqueValidationMessage"></label>
                </p>
                   <input type="submit" value="Enviar Justificação" id="sbutton" required>
            </form>
            <br>
        </body>
    </html>
    <?php
} else {
   header("Location: ../Autenticacao/fazerLogin.php");
}
    