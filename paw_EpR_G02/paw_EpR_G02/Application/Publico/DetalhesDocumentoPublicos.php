<?php
require __DIR__ . '/../../Config.php';

require_once (Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath() . 'DocumentoManager.php');
require_once (Config::getApplicationManagerPath() . 'ComentarioManager.php');
$id = filter_input(INPUT_GET, 'titulo');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Detalhes Documentos Públicos</title>
        <link rel="stylesheet" href="../CSS/styleDetalhes.css">
    </head>
    <body>
        <h1>Detalhes</h1>
        <?php
        $manager = new DocumentoManager();
        $d = $manager->getDocumentoByTitulo($id);
        ?>
        <p><span>Titulo:</span> <?php echo $d['titulo'] ?></p>
        <p><span>Autor:</span> <?php echo $d['autor'] ?></p>
        <p><span>Categoria:</span> <?php echo $d['categoria'] ?></p>
        <p><span>Resumo:</span> <?php echo $d['resumo'] ?></p>
        <p><span>Categoria:</span> <?php echo $d['conteudo'] ?></p>
        <p><span>Data de Criação:</span> <?php echo $d['dataCriacao'] ?></p>
        <?php $converted_res = ($d['comentario']) ? 'Sim' : 'Nao'; ?> <!-- permitir a conversao de boolean para string -->
        <h4> >> Comentários</h4>
        <?php
        $co = new ComentarioManager();
        $r = $co->getComentariosByDoc($id);
        if (count($r) > 0) {
            foreach ($r as $rr) {
                ?>
                <p><span>Comentario:</span> <?php echo $rr['texto'] ?></p>
                <p><span>User:</span> <?php echo $rr['username'] ?></p>
                <?php
            }
        } else {
            ?>
            <p> Nao tem comentários para mostrar. </p>

        <?php }
        ?>
        <a href="../../index.php">Voltar</a>

    </body>
</html>

