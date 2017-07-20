<?php
require __DIR__ . './Config.php';
require_once (Config::getApplicationManagerPath() . 'DocumentoManager.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="Application/CSS/stylePesquisa.css" title="style">
        <script src=".Application/JavaScript/JQuerys.js" type="text/javascript"></script>
        <script src="Application/JavaScript/procuraPublico.js" type="text/javascript"></script>
        <title>Pesquisa</title>     
    </head>
    <body>
        <h2>Resultados da pesquisa.....</h2>        
        <?php
        $string = filter_input(INPUT_GET, 'nameA', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $docMAN = new DocumentoManager();
        $listaDOCS = $docMAN->getDocumentosPartilhados("publico");
        ?>
        <table>  
            <?php
            if (count($listaDOCS) > 0) {
                foreach ($listaDOCS as $docs) {
                    if (stripos($docs['autor'], $string) !== false) {
                        ?>
                        <tr>                               
                        <div><span>Titulo: </span><?php echo $docs['titulo'] ?></div>           
                        <div><span>Categoria: </span><?php echo $docs['categoria'] ?></div>
                        <div><span>Autor: </span><?php echo $docs['autor'] ?></div>
                        <div><span>Resumo: </span><?php echo $docs['autor'] ?></div>
                        <br/>
                    </tr>
                    <?php
                } else {
                    
                }
            }
        } else {
            ?>
            <p>Nao existem documentos públicos do utilizador <?php $string ?>.</p>
        <?php
        } ?>
        
            <p><a href="index.php">Voltar</a></p>
            
        <?php
        include_once './Application/Partials/footer.php';
        ?>

</body>
</html>