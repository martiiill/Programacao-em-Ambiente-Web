<?php
session_start();
require __DIR__ . '/../../Config.php';

require_once (Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath() . 'EdicaoManager.php');
require_once (Config::getApplicationManagerPath() . 'DocumentoManager.php');
require_once (Config::getApplicationManagerPath() . 'ComentarioManager.php');

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
            $manager = new DocumentoManager();
            $comentarioManager = new ComentarioManager();
            $par = $manager->getDocumentosPartilhadosVarias($_SESSION['login']);
            ?>
            <h3> >> Documentos Partilhados Comigo</h3>
            <?php
            $c = $comentarioManager->getComentarios();
            $editmanager = new EdicaoManager();
            foreach ($par as $ppp) {
                $d = $manager->getDocumentosPartilhados($ppp);
                foreach ($d as $dddd) {
                    $e = $editmanager->getEdicoesByDoc($dddd['titulo']);
                    ?>
                    <p><span>Documento: </span> <?php echo $dddd['titulo'] ?></p>
                    <p><span>Autor:</span> <?php echo $dddd['autor'] ?></p>
                    <p><span>Edicoes:</span> <?php echo count($e) ?></p>
                    <p><span>Comentários:</span> <?php echo count($c) ?></p>
                    <p> --------------------------------------- </p>
                    <?php
                }
            }

            $do = $manager->getDocumentosPartilhados("publico");
            $com = $comentarioManager->getComentarios();
            $edi = new EdicaoManager();
            ?>
            <h3> >> Documentos Públicos</h3>
            <?php
            if (count($do) > 0) {
                foreach ($do as $doo) {
                    $edit = $editmanager->getEdicoesByDoc($doo['titulo']);
                    ?>
                    <p><span>Documento: </span> <?php echo $doo['titulo'] ?></p>
                    <p><span>Autor:</span> <?php echo $doo['autor'] ?></p>
                    <p><span>Edicoes:</span> <?php echo count($edit) ?></p>
                    <p><span>Comentários:</span> <?php echo count($c) ?></p>
                    <?php
                }
            } else {
                $edit = $editmanager->getEdicoesByDoc($do['titulo']);
                ?>
                <p><span>Documento: </span> <?php echo $do['titulo'] ?></p>
                <p><span>Autor:</span> <?php echo $do['autor'] ?></p>
                <p><span>Edicoes:</span> <?php echo count($edit) ?></p>
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
    