<?php
session_start();
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'CategoriaManager.php');
require_once (Config::getApplicationManagerPath().'DocumentoManager.php');

if (isset($_SESSION['login'])) {
    $mensagemDelete = filter_input(INPUT_GET, 'apagar', FILTER_SANITIZE_SPECIAL_CHARS);
    $mensagemAdd = filter_input(INPUT_GET, 'adicionar', FILTER_SANITIZE_SPECIAL_CHARS);
    ?>

    <html>
        <head>
            <meta charset="UTF-8">
            <title>Gestao de Categorias</title>
            <link rel="stylesheet" type="text/css" href="../CSS/styleCategorias.css" title="style">
        </head>
        <body>

            <h1>Gestão de Categorias</h1>

            <p><a href='AdicionarCategoria.php'>Adicionar Categoria</a></p>
            <?php
            if ($mensagemDelete == "sucesso") {
                ?><span class="green">Apagado com sucesso.</span><?php
            } elseif ($mensagemDelete == "erro") {
                ?><span class="red">Para Eliminar Esta Categoria terá de eliminar os seus documentos</span><?php
            }
            if ($mensagemAdd == "sucesso") {
                ?><span class="green">Categoria Adicionada com sucesso.</span><?php
            }

            $categoriaManager = new CategoriaManager();
            $docManager = new DocumentoManager();
            $contDoc = 0;
            $listaCategorias = $categoriaManager->getCategorias();
            $listaDocumentos = $docManager->getDocumentos();
            if (count($listaCategorias) > 0) {
                ?>
                <table>
                    <tr>
                        <td>Nome Categoria</td>
                    </tr>
                    <?php
                    foreach ($listaCategorias as $categ) {
                        ?>
                        <tr>
                            <td><?php echo $categ['nome'] ?></td>
                            <td><a href="DetalhesCategorias.php?nome=<?php echo $categ['nome']; ?>">Detalhes</a></td>
                        </tr>   

                        <?php
                    }
                    ?>
                </table>
                <?php
            } else {
                echo 'Nao existe categorias';
            }
            ?>

            <a href="../Autenticacao/logout.php">Logout</a>
            <a href="VistaAdmin.php">Voltar</a>
            <?php
            include_once '../Partials/footer.php';
            ?>

        </body>
    </html>
    <?php
} else {
    header("Location: ../Autenticacao/fazerLoginAdministrador.php");
}

