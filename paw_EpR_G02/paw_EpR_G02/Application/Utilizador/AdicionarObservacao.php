<?php
session_start();
require __DIR__ . '/../../Config.php';

require_once (Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath() . 'DocumentoManager.php');

if (isset($_SESSION['login'])) {
    $titulo = filter_input(INPUT_GET, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Adicionar Observacao a Documento</title>
            <link rel="stylesheet" type="text/css" href="../CSS/styleEdicao.css" title="style">
            <script src="../JavaScript/ValidarAdicionarObservacao.js" type="text/javascript"></script>
            <script src="../JavaScript/ObservacoesStorage.js" type="text/javascript"></script>
        </head>
        <body>

            <form id="addOb_form" name="adicionarOb" method="post" action="Validacoes/ValidarObservacaoDocumento.php">
                <p>Documento:<?php echo $titulo ?></p>
                <input type="hidden" id="doc" name="doc" value="<?php echo $titulo ?> "/>
                <label id="nomeObValidation"></label>
                <p>
                    <label>
                        <span>Observação: (Máximo 60 caracteres)</span>
                        <input type="text" id="ob" name="ob" size="60"/>
                    </label>
                    <br>
                    <label id="nomeObValidation"></label>
                </p>

                <input type="submit" name="adicionarOb" id="save" value="Adicionar Observacao" required>
            </form>
                
                 <ul>
                <li><a href="../Autenticacao/logout.php">Logout</a></li>
                <li><a href="../Utilizador/DetalhesDocumento.php">Voltar</a></li>
            </ul>       


            <?php include_once '../Partials/footer.php'; ?>
        </body>
    </html>
    <?php
} else {
    header("Location: ../Autenticacao/fazerLogin.php");
}
    