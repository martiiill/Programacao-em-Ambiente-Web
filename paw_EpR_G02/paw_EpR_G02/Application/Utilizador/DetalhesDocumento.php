<?php
session_start();
require __DIR__ . '/../../Config.php';

require_once (Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath() . 'ComentarioManager.php');
require_once (Config::getApplicationManagerPath() . 'DocumentoManager.php');

if (isset($_SESSION['login'])) {
    $titulo = filter_input(INPUT_GET, 'titulo');
    ?>
    <html>
        <head>
            <meta charset="UTF-8">            
            <title>Detalhes Documentos</title>
            <link rel="stylesheet" type="text/css" href="../CSS/styleVistaUtilizador.css" title="style">
            <script src="../JavaScript/ValidarAdicionarObservacao.js" type="text/javascript"></script>
            <script src="../JavaScript/ObservacoesStorage.js" type="text/javascript"></script>
        </head>
        <body>
            <a href="../Autenticacao/logout.php">Logout</a>
            <a href="../Utilizador/GestaoDocumentos.php">Voltar</a>

            <?php
            $manager = new DocumentoManager();
            $d = $manager->getDocumentoByTitulo($titulo);
            if ($d != NULL) {
                ?>
                <p><span>Titulo:</span> <?php echo $d['titulo'] ?></p>
                <p><span>Autor:</span> <?php echo $d['autor'] ?></p>
                <p><span>Categoria:</span> <?php echo $d['categoria'] ?></p>
                <p><span>Resumo:</span> <?php echo $d['resumo'] ?></p>
                <p><span>Conteúdo:</span> <?php echo $d['conteudo'] ?></p>

                <?php $trimmed = str_replace($_SESSION['login'], '', $d['partilha']); ?>
                <p><span>Partilha:</span> <?php echo $trimmed; ?></p>

                <?php
                $converted_res = ($d['comentario']) ? 'Sim' : 'Nao';

                $co = new ComentarioManager();
                $r = $co->getComentariosByDoc($titulo);
                $per = $manager->getDocumentoByPermissaoComentario(1);
                if ($converted_res === "Sim") {
                    if (count($r) > 0) {
                        ?>
                        <h4> >> Comentários</h4>
                        <?php foreach ($r as $rr) {
                            ?>
                            <p><span>Comentario:</span> <?php echo $rr['texto'] ?></p>
                            <p><span>User:</span> <?php echo $rr['username'] ?></p>
                            <?php
                        }
                    } else {
                        ?>
                        <p> Nao tem comentários para mostrar. </p>

                    <?php
                    }
                } else {
                    ?>
                    <p>Este documento nao permite comentários.</p>
        <?php }
        ?>
                <ul>
                    <li><a href="ApagarDocumento.php?titulo=<?php echo filter_input(INPUT_GET, 'titulo'); ?>">Eliminar</a></li>
                    <li><a href="EdicaoPorqueDocumento.php?titulo=<?php echo filter_input(INPUT_GET, 'titulo'); ?>">Editar</a></li>
                    <li><a href="VerHistoricoEdicoes.php?titulo=<?php echo filter_input(INPUT_GET, 'titulo'); ?>">Ver histórico de edições</a></li>
                    <li><a href="AdicionarObservacao.php?titulo=<?php echo filter_input(INPUT_GET, 'titulo'); ?>">Adicionar Observação</a>    </li>
                    <li><a href="VerMinhasObservacoes.php?titulo=<?php echo filter_input(INPUT_GET, 'titulo'); ?>">Ver Observações</a></li>
                </ul>

                <a href="GestaoDocumentos.php">Voltar</a>
                <?php
            } else {
                header("Location: ./GestaoDocumentos.php");
            }
            ?>    
    <?php include_once '../Partials/footer.php'; ?>
        </body>
    </html>
    <?php
} else {
    header("Location: ../Autenticacao/fazerLogin.php");
}
