<?php
session_start();
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'UserManager.php');
require_once (Config::getApplicationManagerPath().'DocumentoManager.php');


if (isset($_SESSION['login'])) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="../CSS/stylePerfil.css" title="style">
            <script src="../JavaScript/ValidarAlterarPerfil.js" type="text/javascript"></script>
            <title>Atualizar Perfil</title>
        </head>
        <body>
            
            <h2> >> Atualizar os meus dados</h2>
            <h3>Username: <?php echo $_SESSION['login']; ?></h3>

            <?php
            $manager = new UserManager();
            $u = $manager->getUserByUsername($_SESSION['login']);
            foreach ($u as $uu) {
                ?>   
            <form id="formAlterarPerfil" name="alterarPerfil" method="post" action="Validacoes/ValidarAlterarPerfil.php">               
                    <p>
                        <label>
                            <span>Nome: </span>
                            <input type="text" id="nome" name="nome" size="30">
                        </label>
                        <label id="nomeValidationMessagem"></label>
                    </p>
                    <p>
                        <label>
                            <span>Morada: </span>
                            <input type="text" id="morada" required name="morada" size="60">
                        </label>
                        <label id="moradaValidationMessagem"></label>
                        <label>
                            <span>Contacto: </span>
                            <input type="text" id="contacto" required name="contacto" size="9">
                        </label>
                        <label id="contactoValidationMessagem"></label>
                    </p>
                    <input type="submit" name="atualizar" value="Atualizar" required/>
                </form>
                <br>
            <?php } ?>

            <a href="../Autenticacao/logout.php">Logout</a>
            <a href="../Utilizador/VistaUtilizador.php">Voltar</a>
            <?php include_once '../Partials/footer.php'; ?>

        </body>
    </html>
    <?php
} else {
    header("Location: ../Autenticacao/fazerLogin.php");
}
   