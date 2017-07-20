<?php
session_start();
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationManagerPath().'UserManager.php');

if (isset($_SESSION['login'])) {
    ?>
    <!DOCTYPE html>
    <!--
    P.Porto - Escola Superior de Tecnologia e Gestão
    LEI - Licenciatura em Engenharia Informática
    PAW - Programação em Ambiente Web
    -->
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Documentos ABC</title>
            <link rel="stylesheet" href="../CSS/styleVistaAdmin.css"/>
        </head>
        <body>
            <h1 class="titulo_vistaAdmin">Área do Administrador</h1>

            <p>Bem vindo !</p>
            <h2 class="titulo_que_pretender">Que pretende fazer?</h2>
            <a href="../Autenticacao/logout.php">Logout</a>


            <div class="conteudo">

                <ul class="lista_funcionalidades">
                    <li><a href="GestaoUtilizadores.php">Ativar Conta</a></li>      
                    <li><a href="GestaoCategorias.php">Gestão Categorias</a></li>
                </ul>
            </div>

    <?php require_once "../Partials/footer.php" ?>
            
        </body>
    </html>
    <?php
} else {
    header("Location: ../Autenticacao/fazerLoginAdministrador.php");
}


