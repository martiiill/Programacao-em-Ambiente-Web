<?php
session_start();
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'CategoriaManager.php');
require_once (Config::getApplicationManagerPath().'DocumentoManager.php');

if (isset($_SESSION['login'])) {
    $nomeCate = filter_input(INPUT_GET, 'nome');
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="../CSS/styleDetalhes.css" title="style">
            <title>Detalhes das Categorias</title>
        </head>
        <body>              

            <h1>Detalhes da Categoria</h1>

            <?php
            $catManager = new CategoriaManager();
            $docManager = new DocumentoManager();
            $contador = 0;
            if ($catManager->checkIfCategoriaExiste($nomeCate) == true) {
                $categoria = $catManager->getCategoriaByNome($nomeCate);
                foreach ($categoria as $c) {
                    ?>
                    <p><span>ID: </span> <?php echo $c['id'] ?></p>
                    <p><span>Nome Categoria: </span> <?php echo $nomeCate ?></p>
                    <a href="ApagarCategoria.php?nome=<?php echo $nomeCate; ?>">Eliminar Categoria e seus Documentos</a>
                    <?php
                }
            } else {
                header("Location: GestaoCategorias.php");
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
