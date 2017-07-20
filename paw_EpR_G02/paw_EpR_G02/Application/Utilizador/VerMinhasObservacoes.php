<?php
session_start();

if (isset($_SESSION['login'])) {
    $titulo = filter_input(INPUT_GET, 'titulo');
    ?>
    <html>
        <head>
            <meta charset="UTF-8">            
            <title>Minhas Observações</title>
            <link rel="stylesheet" type="text/css" href="../CSS/styleObservacoes.css">                   
        </head>
        <body>
            <h1> Observações</h1>
            <div id="Ob"></div>
            <div id="doc"> <?php echo $titulo; ?></div>
            <p>-----------------------------------</p>
            <script src="../JavaScript/getObservacoes.js" type="text/javascript"></script>
            <a href="../Autenticacao/logout.php">Logout</a>
            <a href="../Utilizador/DetalhesDocumento.php">Voltar</a>
            <?php include_once '../Partials/footer.php'; ?>
        </body>
    </html>
    <?php
} else {
    header("Location: ../Autenticacao/fazerLogin.php");
}
