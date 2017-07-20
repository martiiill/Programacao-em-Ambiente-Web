<?php
session_start();
require __DIR__ . '/../../Config.php';

require_once (Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath() . 'UserManager.php');

if (isset($_SESSION['login'])) {
    $user = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    ?>
    <html>
        <head>
            <meta charset="UTF-8">            
            <title>Perfil Público</title>
            <link rel="stylesheet" type="text/css" href="../CSS/stylePerfil.css">
        </head>
        <body>
            <h1>Perfil Público do Utilizador <?php echo $user; ?></h1>
            <?php
            $manager = new UserManager();
            $d = $manager->getUserByUsername($user);
            foreach ($d as $u) {
                $nome = str_replace(" ", "", $u['username']);
                setcookie($nome, $u['username']);
                ?>
                <p><span>Nome:</span> <?php echo $u['nome'] ?></p>
                <p><span>Morada:</span> <?php echo $u['morada'] ?></p>
                <p><span>Contacto:</span> <?php echo $u['contacto'] ?></p>
                 <p><span>Username :</span> <?php echo $u['username'] ?></p>
                <?php
            }
            ?>          
            <a href="../Autenticacao/logout.php">Logout</a>
            <a href="../Utilizador/VistaUtilizador.php">Voltar</a>
            <?php
            ?>    
            <?php include_once '../Partials/footer.php'; ?>
        </body>
    </html>
    <?php
} else {
    header("Location: ../Autenticacao/fazerLogin.php");
}
