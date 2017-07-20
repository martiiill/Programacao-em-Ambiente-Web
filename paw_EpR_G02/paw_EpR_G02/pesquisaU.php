<?php
session_start();
require __DIR__ . './Config.php';

require_once (Config::getApplicationManagerPath() . 'DocumentoManager.php');
require_once './Application/Manager/DocumentoManager.php';

if (isset($_SESSION['login'])) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="Application/CSS/stylePesquisa.css" title="style">
            <script src="Application/JavaScript/JQuerys.js" type="text/javascript"></script>
            <script src="Application/JavaScript/procurarUtilizador.js" type="text/javascript"></script>
            <title>Pesquisa Utilizador</title>     
        </head>
        <body>
            <h2>Resultados da pesquisa.....</h2>    

            <h3>:: Partilhados comigo</h3>
            <?php
            $string = filter_input(INPUT_GET, 'nameU', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $docMAN = new DocumentoManager();
            $meusDocs = $docMAN->getDocumentosPartilhados($_SESSION['login']);
            foreach ($meusDocs as $d) {
                if (stripos($d['titulo'], $string) !== false) {
                    ?>
                <tr>                               
                <div><span>titulo </span><?php echo $d['titulo'] ?></div>           
                <div><span>autor </span><?php echo $d['autor'] ?></div>   
                <div><span>categoria </span><?php echo $d['categoria'] ?></div>
                <div><span>resumo </span><?php echo $d['resumo'] ?></div>
                <?php
            }
            ?>
            <h3>:: Publicos</h3>
            <?php
            $meusDoc = $docMAN->getDocumentosPartilhados("publico");
            foreach ($meusDoc as $d) {
                ?>
                <?php
                if (stripos($d['titulo'], $string) !== false) {
                    ?>
                    <tr>                               
                    <div><span>titulo </span><?php echo $d['titulo'] ?></div>           
                    <div><span>autor </span><?php echo $d['autor'] ?></div>   
                    <div><span>categoria </span><?php echo $d['categoria'] ?></div>
                    <div><span>resumo </span><?php echo $d['resumo'] ?></div>
                    <?php
                } else {
                    
                }
            }
        }
        ?>

        <p><a href="Application/Utilizador/VistaUtilizador.php">Voltar</a></p>

        <?php
        include_once './Application/Partials/footer.php';
    } else {
        header("Location: ./Application/Autenticacao/fazerLogin.php");
    }
    ?>
</body>
</html>
