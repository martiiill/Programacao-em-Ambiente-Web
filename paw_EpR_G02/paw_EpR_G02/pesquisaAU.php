<?php
session_start();
require __DIR__.'./Config.php';

require_once (Config::getApplicationManagerPath().'DocumentoManager.php');

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pesquisa Por Autor</title>   
         <link rel="stylesheet" type="text/css" href="Application/CSS/stylePesquisa.css" title="style">
        <script src="Application/JavaScript/JQuerys.js" type="text/javascript"></script>
        <script src="Application/JavaScript/procurarUtilizador.js" type="text/javascript"></script>
    </head>
    <body>
        <?php if (isset($_SESSION['login'])) { ?>
            <h2>Resultados da pesquisa</h2>        
            <h3>:: Partilhados comigo</h3>
            <?php
            if (filter_has_var(INPUT_GET, 'nameUA') == TRUE) {
                $string = filter_input(INPUT_GET, 'nameUA', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $docMAN = new DocumentoManager();
                $meusDocs = $docMAN->getDocumentosPartilhados($_SESSION['login']);
                foreach ($meusDocs as $d) {
                    ?>
                    <table>  
                        <?php
                        if (stripos($d['autor'], $string) !== false) {
                            ?>
                            <tr>                               
                            <div><span>titulo </span><?php echo $d['titulo'] ?></div>  
                            <div><span>autor </span><?php echo $d['autor'] ?></div>
                            <div><span>categoria </span><?php echo $d['categoria'] ?></div>
                            <div><span>resumo </span><?php echo $d['resumo'] ?></div>
                            <br/>
                        </tr>
                        <?php
                    }
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
            } ?>
                        
                        <p><a href="Application/Utilizador/VistaUtilizador.php">Voltar</a></p>
                        
                        <?php
            include_once './Application/Partials/footer.php';
        } else {
            
            header("Location: ./Application/Autenticacao/fazerLogin.php");
        }
        ?>
</body>
</body>
</html>