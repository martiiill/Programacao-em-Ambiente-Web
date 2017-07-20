<?php
session_start();
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'UserManager.php');
require_once (Config::getApplicationManagerPath().'DocumentoManager.php');

if (isset($_SESSION['login'])) {
    $mensagemUpdate = filter_input(INPUT_GET, 'update', FILTER_SANITIZE_SPECIAL_CHARS);
    ?>
    <html>
        <head>
            <meta charset="UTF-8">            
            <title>Meu Perfil</title>
            <link rel="stylesheet" type="text/css" href="../CSS/stylePerfil.css">
        </head>
        <body>
           
            <h1> :: Meu Perfil</h1>          

            <?php
            if ($mensagemUpdate == "sucesso") {
                ?><span class="green">Atualizado com sucesso.</span><?php
            } elseif ($mensagemUpdate == "erro") {
                ?><span class="red">Erro ao atualizar</span><?php
            } elseif ($mensagemUpdate == "erro_form") {
                ?><span class="red">Erro no formulario.</span><?php
            }

            $manager = new UserManager();
            $d = $manager->getUserByUsername($_SESSION['login']);
            foreach ($d as $u) {
                ?>
                <p><span>Nome:</span> <?php echo $u['nome'] ?></p>
                <p><span>Morada:</span> <?php echo $u['morada'] ?></p>
                <p><span>Contacto:</span> <?php echo $u['contacto'] ?></p>

                <?php
            }
            ?>
                <ul>
                    <li><a href="AlterarPerfil.php?user=<?php echo $_SESSION['login'] ?>">Editar Perfil</a></li>
                    <li><a href="../Autenticacao/logout.php">Logout</a></li>
                    <li><a href="../Utilizador/VistaUtilizador.php">Voltar</a></li>
                </ul>

            <?php
            ?>    
            <?php include_once '../Partials/footer.php'; ?>
        </body>
    </html>
    <?php
} else {
    header("Location: ../Autenticacao/fazerLogin.php");
}
