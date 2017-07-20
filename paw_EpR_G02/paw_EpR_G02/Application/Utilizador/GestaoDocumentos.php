<?php
session_start();
require __DIR__ . '/../../Config.php';

require_once (Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath() . 'UserManager.php');
require_once (Config::getApplicationManagerPath() . 'DocumentoManager.php');

if (isset($_SESSION['login'])) {
    $mensagemDelete = filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_SPECIAL_CHARS);
    $mensagemAdd = filter_input(INPUT_GET, 'add', FILTER_SANITIZE_SPECIAL_CHARS);
    $mensagemUpdate = filter_input(INPUT_GET, 'edit', FILTER_SANITIZE_SPECIAL_CHARS);
    $mensagemO = filter_input(INPUT_POST, 'o', FILTER_SANITIZE_SPECIAL_CHARS);
    $usernao = filter_input(INPUT_GET, 'usernao', FILTER_SANITIZE_STRING);
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Gestao de Documentos Documentos</title>
            <link rel="stylesheet" type="text/css" href="../CSS/styleCriarDocumento.css">
        </head>
        <body>
            <?php
            if ($mensagemAdd == "sucesso") {
                ?><span>Documento criado com sucesso..</span><?php
            } else if ($mensagemAdd == "errocorpo") {
                ?><span>Erro no corpo do documento</span><?php
            } else if ($mensagemAdd == "errotitulo") {
                ?><span>Erro no titulo do documento</span><?php
            } else if ($mensagemAdd == "erroresumo") {
                ?><span>Erro no resumo do documento</span><?php
            } else if ($mensagemAdd == "errodata") {
                ?><span>Erro na data de criacao do documento</span><?php
            } else if ($mensagemAdd == "erroform") {
                ?><span>Erro do formulario</span><?php
            }

            if (count($usernao) > 0) {
                $array = explode(',', $usernao);
                for ($i = 0; $i < count($array); $i++) {
                    if ($array[$i] !== '') {
                        ?><p><span>ERRO: O user <?php echo $array [$i]; ?> nao existe.</span></p><?php
                    }
                }
            } else if (count($usernao) === 0) {
                ?>
                <p></p>
                <?php
            }

            if ($mensagemO == "sucesso") {
                ?><p>Observação adicionada com sucesso.</p><?php
            } else if ($mensagemO == "erro") {
                ?><p>erro</p><?php
            } else if ($mensagemO == "erroob") {
                ?><p>tamanho de texto errado</p><?php
            }

            if ($mensagemDelete == "sucesso") {
                ?><span>Apagado com sucesso.</span><?php
                if ($mensagemAdd == "sucesso") {
                    ?><span> Adicionado com sucesso.</span><?php
                }
            }

            if ($mensagemUpdate == "sucesso") {
                ?><span>Atualizado com sucesso.</span><?php
            } elseif ($mensagemUpdate == "erro") {
                ?><span>Erro ao atualizar</span><?php
            } elseif ($mensagemUpdate == "jaExisteId") {
                ?><span>Ja Existe ID</span><?php
            } elseif ($mensagemUpdate == "erroporque") {
                ?><span>Erro na justificação</span><?php
            }
            ?>

            <h2> :: Meus Documentos</h2>
            <p><a href='CriarDocumento.php'>Criar Documento</a></p>
            <?php
            $manager = new DocumentoManager();
            $docs = $manager->getDocumentoByAutor($_SESSION['login']);
            if (count($docs) > 0) {
                ?>
                <table>
                    <tr>
                        <td>Titulo</td>
                        <td>Autor</td>
                        <td>Data de Criação</td>
                    </tr>
                    <?php
                    foreach ($docs as $d) {
                        ?>
                        <tr>
                            <td><?php echo $d['titulo'] ?></td>
                            <td><?php echo $d['autor'] ?></td>
                            <td><?php echo $d['dataCriacao'] ?></td>
                            <td><a href="DetalhesDocumento.php?titulo=<?php echo $d['titulo']; ?>">Detalhes</a></td>                          
                        </tr>        
                        <?php
                    }
                    ?>
                </table>
                <?php
            } else {
                echo 'Nao Existem documentos.';
            }
            ?>

            <a href="../Autenticacao/logout.php">Logout</a>
            <a href="../Utilizador/VistaUtilizador.php">Voltar</a>

            <?php include_once '../Partials/footer.php'; ?>

        </body>
    </html>
    <?php
} else {
    header("Location: ../Autenticacao/fazerLogin.php");
}

    