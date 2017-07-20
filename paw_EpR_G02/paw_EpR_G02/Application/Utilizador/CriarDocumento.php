<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
require __DIR__ . '/../../Config.php';

require_once (Config::getApplicationManagerPath() . 'CategoriaManager.php');
require_once (Config::getApplicationModelPath() . 'User.php');
require_once (Config::getApplicationManagerPath() . 'UserManager.php');

$catM = new CategoriaManager();
$userM = new UserManager();

if (isset($_SESSION['login'])) {
    $mensagem = filter_input(INPUT_GET, 'add', FILTER_SANITIZE_SPECIAL_CHARS);
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Criar um novo documento</title>
            <link rel="stylesheet" type="text/css" href="../CSS/styleCriarDocumento.css" title="style">
            <script src="../JavaScript/ValidarCriarDocumento.js"></script>
            <script src="../JavaScript/JQuerys.js" type="text/javascript"></script>
            <script src="../JavaScript/hideForm.js" type="text/javascript"></script>
            <script src="../JavaScript/partilhaUsers.js" type="text/javascript"></script>
        </head>
        <body>

            <h2 class="titulo_criar_documento">Criar um novo documento</h2>

            <div class="form">
                <form id="addDoc_form" name="addDoc_form" method="post" action="Validacoes/ValidarCriarDocumento.php">
                    <label for="titulo">Titulo (*): (Máximo 90 caracteres)
                        <input id="titulo" required type="text" name="titulo" maxlength="90" placeholder="titulo"/> </label>
                    <label id="tituloValidationMessage"></label>
                    <br>
                    <label for="corpo">Corpo do documento (*):</label>
                    <textarea id="corpo" placeholder="Conteudo do documento" name="corpo" cols="40" rows="4" maxlength="200"></textarea>

                    <label id="corpoValidationMessage"></label>
                    <br>
                    <label for="resumo">Resumo do documento (*): (máximo 100 caracteres)</label>
                    <input id="resumo" required type="text" name="resumo" maxlength="100" placeholder="Resumo do documento"/>

                    <label id="resumoValidationMessage"></label>
                    <br>
                    <p>Nome do Autor (*): <?php echo $_SESSION['login']; ?></p>
                    <label id="autorValidationMessage"></label>
                    <br>
                    <label for="categoria">Categoria (*)</label>
                    <select id='cat' name='cat'>
                        <?php
                        $listaCt = $catM->getCategorias();
                        foreach ($listaCt as $c) {
                            ?> <option selected value="<?php echo $c['nome'] ?>"><?php echo $c['nome'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <label id="categoriaValidationMessage"></label>
                    <br>
                    <label>
                        <span>Data Criacao (AAAA-MM-DD) (*): </span>
                        <input type="text" id="dataCriacao" required name="dataCriacao" size="10">
                    </label>

                    <label id="dataCriacaoValidationMessage"></label>
                    <br>
                    <label for="partilha_" id="partilha_">Partilha (*):

                        <select name="tipo-partilha" id="tipo-partilha">
                            <option value="Geral">Geral</option>
                            <option value="Users">Utilizadores</option>
                        </select>

                        <div id="palco">
                            <div class="input_fields_wrap" id="Users">
                                <label>Username 1 <input type="text" name="mytext[]" id="mytext[]"></label>
                                <a href="#" class="add_field_button">Adicionar utilizador</a>                               
                            </div>                          
                            <div id="Geral">(escolha uma)<br>
                                <input type="radio" id="geral" name="geral" value="publico">Público<br>
                                <input type="radio" id="geral" name="geral" value="privado">Privado<br>
                            </div>
                        </div>       
                    </label>
                    <label id="partilhaValidationMessage"></label>
                    <br>
                    <label for="palavraChave">Palavra-Chave (*): 
                        <input id="palavraChave" required type="text" name="palavraChave" maxlength="60" placeholder="Palavra chave"/>
                    </label>
                    <label id="palavraChaveValidationMessage"></label>
                    <br>
                    <label for="url">Url (*): 
                        <input id="url" required type="text" name="url" maxlength="60" placeholder="url"/>
                    </label>
                    <label id="urlValidationMessage"></label>
                    <br>
                    <label for="permissaoComentarios">Permitir comentários?(1 = sim ou 0 = não) (*)
                        <input id="permissao" required type="number" name="permissao" maxlength="1"/>                 
                    </label>
                    <label id="permissaoValidationMessage"></label>
                    <br>
                    <input type="submit" value="Criar documento" id="sbutton" required>
                </form>
            </div>

            <?php include_once '../Partials/footer.php'; ?>
        </body>
    </html>
    <?php
} else {
    header("Location: ../Autenticacao/fazerLogin.php");
}

    
