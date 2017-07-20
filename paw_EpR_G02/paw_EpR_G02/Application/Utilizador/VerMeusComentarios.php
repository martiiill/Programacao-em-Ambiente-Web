<?php
session_start();
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'ComentarioManager.php');
require_once (Config::getApplicationManagerPath().'EdicaoManager.php');

if (isset($_SESSION['login'])) {
    ?>
    <html>
        <head>
            <meta charset="UTF-8">            
            <title>Ver Meus Comentários</title>
            <link rel="stylesheet" type="text/css" href="../CSS/styleVerMeusComentarios.css" title="style">
        </head>
        <body>
            <h1>Os Meus Comentários</h1>

            <?php
            $manager = new ComentarioManager();
            $dd = $manager->getComentarioByUser($_SESSION['login']);
            if (count($dd) > 0) {
                foreach ($dd as $docs) {
                    ?>
                    <div class="content">                     
                        <p><span>Documento:</span><?php echo $docs['titulo']; ?></p>
                        <span>Comentário:</span><?php echo $docs['texto']; ?>
                    </div>
                     <br>
                <?php
                }
            } else { ?>
                <p>Ainda nao efetou nenhum comentário.</p>
            <?php } ?> 
            <div class="links">
                <button><a href="../Autenticacao/logout.php">Logout</a> </button>
                <button><a href="../Utilizador/VistaUtilizador.php">Voltar</a></button>
            </div>
            <?php include_once '../Partials/footer.php'; ?>
        </body>
    </html>
    <?php
} else {
    header("Location: ../Autenticacao/fazerLogin.php");
}
        