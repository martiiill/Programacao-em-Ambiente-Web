<?php
session_start();
require __DIR__ . '/../../Config.php';

require_once (Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath() . 'ComentarioManager.php');
require_once (Config::getApplicationManagerPath() . 'DocumentoManager.php');
require_once (Config::getApplicationModelPath() . 'Documento.php');
$manager = new DocumentoManager();

if (isset($_SESSION['login'])) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Comentar Documentos</title>
            <link rel="stylesheet" type="text/css" href="../CSS/styleComentarDocumentos.css" title="style">
        </head>
        <body>
            <?php
            $msgCom = filter_input(INPUT_GET, 'coment', FILTER_SANITIZE_SPECIAL_CHARS);
            ?>

            <?php
            if ($msgCom == "sucesso") {
                ?><span>sucesso.</span><?php
            } else if ($msgCom == "erro") {
                ?><span>erro</span><?php
            } else if ($msgCom == "errotexto") {
                ?><span>Tamanho de texto invalido</span><?php
            }

            $permite = $manager->getDocumentoByPermissaoUserComentario(1, 'publico');
            ?>
            <h3> >> Comentar Documentos Públicos</h3>
            <?php
            if (count($permite) > 0) {
                foreach ($permite as $p) {
                    ?>
                    <div class="content">
                        <p id="documento"><span>Documento:</span> <?php echo $p['titulo'] ?></p>
                        <a id="link" href="AdicionarComentario.php?titulo=<?php echo $p['titulo'] ?>">Adicionar Comentário</a>
                    </div>
                    <br>
                    <?php
                }
            } else {
                ?>
                <p> Nao existem documentos publicos que permitam comentarios</p>
                <?php
            }
            ?>

            <h3> >> Comentar Documentos Partilhados Comigo</h3>
            <?php
            $d = $manager->getDocumentosPartilhadosVarias($_SESSION['login']);

            if ($d > 0) {
                foreach ($d as $D) {
                    $doc = $manager->getDocumentoByPermissaoUserComentario(1, $D);
                    if (count($doc) > 0) {
                        foreach ($doc as $docc) {
                            ?>
                            <div class="content">
                                <p id="documento"><span>Documento:</span> <?php echo $docc['titulo'] ?></p>
                                <a id="link" href="AdicionarComentario.php?titulo=<?php echo $docc['titulo'] ?>">Adicionar Comentário</a>
                            </div>
                            <br>
                            <?php
                        }
                    } else {
                        ?>
                        <p> Nao existem documentos partilhados comigo que permitam comentarios</p>
                        <?php
                    }
                }
            } else { ?>

          <?php  }
            ?>
            <p><a href="VerMeusComentarios.php">Ver Meus Comentarios</a></p>
            <p><a href="../Autenticacao/logout.php">Logout</a></p>
            <p><a href="../Utilizador/VistaUtilizador.php">Voltar</a></p>

            <?php include_once '../Partials/footer.php'; ?>
        </body>
    </html>
    <?php
} else {
    header("Location: ../Autenticacao/fazerLogin.php");
}
    