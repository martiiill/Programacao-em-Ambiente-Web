<?php
session_start();
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'ComentarioManager.php');
require_once (Config::getApplicationManagerPath().'DocumentoManager.php');
require_once (Config::getApplicationManagerPath().'EdicaoManager.php');

if (isset($_SESSION['login'])) {
    ?>
    <html>
        <head>
            <meta charset="UTF-8">            
            <title>Area de Documentos Parilhados</title>
            <link rel="stylesheet" type="text/css" href="../CSS/styleAlertas.css">
        </head>
        <body>

            <h1> >> Area de Documentos Partilhados</h1>
            <a href="../Autenticacao/logout.php">Logout</a>
            <a href="../Utilizador/VistaUtilizador.php">Voltar</a>
            <?php
            $edit = 0;
            $coment = 0;
            $manager = new DocumentoManager();
            $comentarioManager = new ComentarioManager();
            $d = $manager->getDocumentosPartilhados($_SESSION['login']);
            $c = $comentarioManager->getComentarios();
            $editmanager = new EdicaoManager();


            foreach ($d as $dddd) {
                $e = $editmanager->getEdicoesByDoc($dddd['titulo']);
                ?>
                <h2> >> Documentos Partilhados Comigo</h2>
                <p><span>Documento: </span> <?php echo $dddd['titulo'] ?></p>
                <p><span>Autor:</span> <?php echo $dddd['autor'] ?></p>
                <p><span>Edicoes:</span> <?php echo count($e) ?></p>
                <p><span>Comentários:</span> <?php echo count($c) ?></p>
                <?php
            }
            include_once '../Partials/footer.php';
            ?>
        </body>
    </html>
    <?php
} else {
   header("Location: ../Autenticacao/fazerLogin.php");
}
    