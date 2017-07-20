<?php
require __DIR__ . './Config.php';

require_once (Config::getApplicationManagerPath() . 'DocumentoManager.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="Application/CSS/stylePesquisa.css" title="style">
        <script src="Application/JavaScript/JQuerys.js" type="text/javascript"></script>
        <script src="Application/JavaScript/procuraPublico.js" type="text/javascript"></script>
        <title>Pesquisa</title>     
    </head>
    <body>      
        <h2>Resultados da pesquisa.....</h2>        
        <?php
        $string = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $docMAN = new DocumentoManager();
        $listaDOCS = $docMAN->getDocumentosPartilhados("publico");
        ?>

        <table>  
            <?php
            if (count($listaDOCS) > 0) {
                foreach ($listaDOCS as $d) {
                    if (stripos($d['titulo'], $string) !== false) {
                        ?>
                        <tr>                               
                        <div><span>titulo: </span><?php echo $d['titulo'] ?></div>           
                        <div><span>autor: </span><?php echo $d['autor'] ?></div>   
                        <div><span>categoria: </span><?php echo $d['categoria'] ?></div>
                        <div><span>resumo: </span><?php echo $d['resumo'] ?></div>
                        <br/>
                    </tr>
                    <?php
                }
            }
        } else {
            ?>
            <p>Nao existem documentos públicos com o titulo <?php $string ?>.</p>
        <?php } ?>

        <p><a href="index.php">Voltar</a></p>

        <?php
        include_once './Application/Partials/footer.php';
        ?>
</body>
</html>