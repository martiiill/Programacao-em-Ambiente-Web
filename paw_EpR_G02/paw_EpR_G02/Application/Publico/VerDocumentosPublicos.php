<?php
session_start();
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationModelPath().'Documento.php');
require_once (Config::getApplicationManagerPath().'DocumentoManager.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Documentos ABC</title>
        <link rel="stylesheet" type="text/css" href="../CSS/index.css" title="style">
    </head>
    <body>
        <h2 class="titulo_documentos_publicos"> :: Documentos Públicos </h2>
        <?php
        $manager = new DocumentoManager();
        $listaPublicos = $manager->getDocumentosPartilhados("publico");
        if (count($listaPublicos) > 0) {
            ?>
            <table>
                <th>Titulo</th>

                <?php foreach ($listaPublicos as $l) { ?>
                    <tr>
                        <td><?php echo $l['titulo'] ?></td>
                        <td></td>
                        <td><a href="DetalhesDocumentoPublicos.php?titulo=<?php echo $l['titulo']; ?>">Detalhes</a></td>
                    </tr>    
                <?php } ?>
            </table>
            <?php
        } else {
            echo 'Nao Existem documentos para mostrar.';
        }
        ?>
    </body>
</html>