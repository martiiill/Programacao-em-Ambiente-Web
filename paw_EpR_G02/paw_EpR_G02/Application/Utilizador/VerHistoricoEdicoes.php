<?php
session_start();
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'EdicaoManager.php');
require_once (Config::getApplicationManagerPath().'DocumentoManager.php');

if (isset($_SESSION['login'])) {
    $titulo = filter_input(INPUT_GET, 'titulo');
    ?>
    <html>
        <head>
            <meta charset="UTF-8">            
            <title>Ver Histórico de Edições</title>
            <link rel="stylesheet" type="text/css" href="../CSS/styleHistorico.css">
        </head>
        <body>
            <h1>Histórico de Edições do Documentos <?php echo $titulo; ?></h1>

            <?php
            $manager = new EdicaoManager();
            $d = $manager->getEdicoesByDoc($titulo);

            foreach ($d as $dd) {
                if ($dd['doc'] != NULL) {
                    ?>
                    <p><span>Justificação:</span><?php echo $dd["porque"]; ?></p>    
                <?php } else {
                    ?>
                    <p>Este documento não sofreu nenhuma edição.</p>
                    <?php
                }
            }
            $contar = count($d);
            ?> 

            <p>Total de Edições: <?php echo $contar; ?></p>
            <a href="../Autenticacao/logout.php">Logout</a>
            <a href="../Utilizador/GestaoDocumentos.php">Voltar</a>
            <?php include_once '../Partials/footer.php'; ?>
        </body>
    </html>
    <?php
} else {
    header("Location: ../Autenticacao/fazerLogin.php");
}
