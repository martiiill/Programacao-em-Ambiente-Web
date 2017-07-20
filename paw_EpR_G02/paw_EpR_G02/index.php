<?php
session_start();
require __DIR__ . './Config.php';

require_once (Config::getApplicationModelPath() . 'Documento.php');
require_once (Config::getApplicationManagerPath() . 'DocumentoManager.php');

$msg = filter_input(INPUT_GET, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
$doc = new Documento();
$docManager = new DocumentoManager();
$manager = new DocumentoManager();
$lista = $manager->getDocumentos();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>:: Documentos ABC</title>
        <link rel="stylesheet" type="text/css" href="Application/CSS/index.css" title="style">
        <script src="Application/JavaScript/JQuerys.js" type="text/javascript"></script>
        <script src="Application/JavaScript/procuraPublico.js" type="text/javascript"></script>
    </head>
    <body>
        <h1>Documentos ABC</h1>
        <p>Bem Vindo ao Documentos ABC! Este é um site que irá organizar os documentos de forma segura e de fácil acesso. <br>
            Faça Login ou Registe-se Já. Estamos á sua espera!</p>
        <img alt="inicial" id="imgInicial" src="Application/Images/transferir.jpg" >
        <fieldset  class="autenticacao_area" ><legend>Autenticação</legend>
            <a href="Application/Autenticacao/fazerLogin.php"><p class="login_user">Login Utilizador</p></a>
            <a href="Application/Autenticacao/fazerLoginAdministrador.php"><p class="login_admin">Login Administrador</p></a>
            <a href="Application/Autenticacao/Registo.php"><p class="registo">Registo</p></a>
        </fieldset>

        <?php include_once './Application/Partials/procura.php'; ?>

        <a id="verDocumentos" href="./Application/Publico/VerDocumentosPublicos.php" >Ver Documentos Públicos</a>
        <section>
            <h3 class="titulo_ultimos_documentos">Últimos documentos públicos adicionados </h3> 

            <?php
            $listaa = $manager->getDocumentosPartilhados("publico");
            foreach ($listaa as $doc) {
                ?>
                <p id="documentos">Documento: <?php echo $doc['titulo'] ?> | Autor: <?php echo $doc['autor'] ?></p>                     
            <?php } ?>
        </section>
        <?php require_once "./Application/Partials/footer.php" ?>
    </body>
</html>
