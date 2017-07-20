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
        <link rel="stylesheet" type="text/css" href="../CSS/styleFazerLogin.css" title="style">    
    </head>
    <body>
        <?php    
        $m = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($m == "erro") {
            ?><span>insucesso.</span><?php } ?>

        <h1>Login Utilizador</h1>

        <form id="login_form" action="checkLogin.php" method="post" id="login">
            <label for="username">
                <span>Username: (*)</span>
                <input type="text" id="username" name="username" required/>
            </label>                    
            <label for="password">
                <span>Password: (*)</span>
                <input type="password" id="password" name="password" required/>
            </label>
            <input type="submit" name="Login" value="Login"/>
        </form>


        <?php include_once '../Partials/footer.php'; ?>       
    </body>
</html>


