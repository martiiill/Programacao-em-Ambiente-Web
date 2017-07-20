<?php session_start();
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationModelPath().'Documento.php');
require_once (Config::getApplicationManagerPath().'ComentarioManager.php');
require_once (Config::getApplicationManagerPath().'EdicaoManager.php');

$manager = new EdicaoManager();
$managerCome = new ComentarioManager();

if (isset($_SESSION['login'])) {
    $titulo = filter_input(INPUT_GET, 'doc', FILTER_SANITIZE_SPECIAL_CHARS);
    $msg = filter_input(INPUT_GET, 'porque');
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Adicionar Comentário ao Documento</title>
             <link rel="stylesheet" type="text/css" href="../CSS/styleEdicao.css" title="style">
        </head>
        <body>
            <?php include_once '../Partials/header.php'; ?>

            <a href="../Autenticacao/logout.php">Logout</a>
            <a href="../Utilizador/VistaUtilizador.php">Voltar</a>
            <?php
            if ($msg == "aceite") {
                ?><span class="green">Justificação aceite. Pode editar o documento.</span>
            <?php } ?>

            <h2 class="titulo_criar_documento">Editar Conteúdo Documento <?php echo $titulo; ?></h2>

            <form id="editDoc_form" name="editDoc_form" method="get" action="Validacoes/ValidarEditarDocumento.php">
                <input type="hidden" id="doc" name="doc" value="<?php echo $titulo; ?>">
                <label for="user">Conteudo: (*)</label>
                <input id="corpo" required type="text" name="corpo" maxlength="150">
                <input type="submit" value="Editar Documento" id="sbutton" required>
            </form>

            <?php include_once '../Partials/footer.php'; ?>
        </body>
    </html>
    <?php
} else {
 header("Location: ../Autenticacao/fazerLogin.php");
}


    