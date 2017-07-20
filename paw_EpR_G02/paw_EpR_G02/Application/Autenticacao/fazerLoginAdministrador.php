<!DOCTYPE html>
<!--
P.Porto - Escola Superior de Tecnologia e Gestão
LEI - Licenciatura em Engenharia Informática
PAW - Programação em Ambiente Web
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Documentos ABC - Login Administrador</title>
        <link rel="stylesheet" type="text/css" href="../CSS/styleFazerLogin.css" title="style">
    </head>
    <body>

        <?php
        $msg = filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_SPECIAL_CHARS);
        ?>
        <h1>Login Administrador</h1>

        <div id="form">
            <form id="login_form" action="checkLoginAdministrador.php" method="post" >
                <label for="username">
                    <span>Username:</span>
                    <input type="text" id="username" name="username" required/>
                </label>                    
                <label for="password">
                    <span>Password:</span>
                    <input type="password" id="password" name="password" required/>
                </label>
                <?php
                if ($msg == 'erro') {
                    ?>
                    <p>Dados introduzidos estao errados</p>
                    <?php
                }
                ?>
                <input type="submit" name="Login" value="Login"/>
            </form>
        </div>

        <?php include_once '../Partials/footer.php'; ?>       
    </body>
</html>

