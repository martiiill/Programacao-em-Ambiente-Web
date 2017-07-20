<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registo</title>
        <link rel="stylesheet" href="../CSS/styleRegisto.css"  type="text/css"/>
    </head>
    <body>
        <h1>Registo de Utilizador</h1>

        <div id="content">
            <h2 class="titulo_registo_user">Registar Utilizador</h2>
            <p>Já tem uma conta? Faça <a href="../Autenticacao/fazerLogin.php">login</a></p>   
            <?php
            require_once __DIR__ . '/../../Config.php';
            
            ?>
            <section>
                <form method="post" action="Validacoes/ValidationRegisto.php">
                    <label for="nome">Nome: (*)</label>
                    <input id="nome" required type="text" name="nome" maxlength="60" placeholder="Nome" size="60"> 

                    <label for="morada">Morada: (*)</label>
                    <input id="morada" type="text" name="morada" placeholder="Morada" size="60">

                    <label for="contacto">Contacto: (*)</label>
                    <input id="contacto" type="tel" name="contacto" maxlength="9" placeholder="Contacto" size="60">

                    <label for="username">Username: (*)</label>
                    <input id="username" required type="text" name="username" placeholder="Username" size="60">

                    <label for="password">Password: (*) (> 3 caractes)</label>
                    <input id="password" required type="password" name="password" placeholder="Password" size="60">

                    <input type="reset" value="Reset" id="resetbutton">
                    <input type="submit" value="Criar conta" id="sbutton">
                </form>             
            </section>

            <a href="../../index.php">Voltar</a>
            <?php include_once '../Partials/footer.php'; ?>
        </div>
    </body>

</html>
