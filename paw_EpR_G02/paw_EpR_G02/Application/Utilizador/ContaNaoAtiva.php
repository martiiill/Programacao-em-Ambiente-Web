<?php
session_start();

if (isset($_SESSION['login'])) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Conta Não Ativada</title>
        </head>
        <body>
            <?php include_once '../Partials/header.php'; ?>

            <a href="../../index.php">Voltar ao Inicio</a>

            <div id="content">
                <p class="red">Esta conta não está ativa. Contacte o Administrador da plataforma.</p>
            </div>  
        </section>
        <?php include_once '../Partials/footer.php'; ?>
    </div>
    </body>
    </html>
    <?php
} else {
   header("Location: ../Autenticacao/fazerLogin.php");
}