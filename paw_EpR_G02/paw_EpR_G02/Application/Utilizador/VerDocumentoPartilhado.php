<?php
session_start();
require __DIR__ . '/../../Config.php';

require_once (Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath() . 'ComentarioManager.php');
require_once (Config::getApplicationManagerPath() . 'DocumentoManager.php');
require_once (Config::getApplicationManagerPath() . 'UserManager.php');
$i = 0;
if (isset($_SESSION['login'])) {
    $titulo = filter_input(INPUT_GET, 'titulo');
    $i++;
    ?>
    <html>
        <head>
            <meta charset="UTF-8">            
            <title>Detalhes Documentos</title>
            <link rel="stylesheet" type="text/css" href="../CSS/styleEdicao.css" title="style">
            <script src="../JavaScript/ValidarAdicionarObservacao.js" type="text/javascript"></script>
            <script src="../JavaScript/ObservacoesStorage.js" type="text/javascript"></script>
            <script src="../JavaScript/getObservacoes.js" type="text/javascript"></script>
        </head>
        <body>
            <?php include_once '../Partials/header.php'; ?>
            <a href="../Autenticacao/logout.php">Logout</a>

            <?php
            $i++;
            $manager = new DocumentoManager();
            $d = $manager->getDocumentoByTitulo($titulo);

            if ($d != NULL) {
                $nome = str_replace(" ", "", $d['titulo']); #porque uma cookie nao pode ter espacos              
                setcookie($nome, $d['titulo']);
                ?>
                <p><span>Titulo:</span> <?php echo $d['titulo'] ?></p>
                <p><span>Autor:</span> <?php echo $d['autor'] ?></p>
                <p><span>Categoria:</span> <?php echo $d['categoria'] ?></p>
                <p><span>Resumo:</span> <?php echo $d['resumo'] ?></p>
                <p><span>Conteúdo:</span> <?php echo $d['conteudo'] ?></p>

                <?php
                $trimmed = str_replace($_SESSION['login'], '', $d['partilha']);
                if ($trimmed === '') {
                    ?>
                    <p>Partilha: Só Comigo</p>
                <?php } else { ?>
                    <p><span>Partilha:</span> <?php echo $trimmed; ?></p>
                    <?php
                }
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
                <a href="VerHistoricoEdicoes.php?titulo=<?php echo filter_input(INPUT_GET, 'titulo'); ?>">Ver histórico de edições</a>
                <a href="AdicionarObservacao.php?titulo=<?php echo filter_input(INPUT_GET, 'titulo'); ?>">Adicionar Observação</a>    
                <a href="VerMinhasObservacoes.php?titulo=<?php echo filter_input(INPUT_GET, 'titulo'); ?>">Ver Observações</a>
                <a href="VistaUtilizador.php">Voltar</a>
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

    