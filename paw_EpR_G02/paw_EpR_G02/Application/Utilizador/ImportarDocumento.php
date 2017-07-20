<?php
session_start();
require __DIR__ . '/../../Config.php';

require_once (Config::getApplicationManagerPath() . 'UserManager.php');
require_once (Config::getApplicationManagerPath() . 'CategoriaManager.php');
require_once (Config::getApplicationManagerPath() . 'DocumentoManager.php');
require_once (Config::getApplicationModelPath() . 'User.php');

if (isset($_SESSION['login'])) {
    ?>

    <head>
        <meta charset="UTF-8">
        <title>Importar um Documento</title>
        <link rel="stylesheet" type="text/css" href="../CSS/styleCriarDocumento.css" title="style">
        <script src="../JavaScript/ValidarImportacaoDocumento.js"></script>
        <script src="../JavaScript/JQuerys.js" type="text/javascript"></script>
        <script src="../JavaScript/hideForm.js" type="text/javascript"></script>
        <script src="../JavaScript/partilhaUsers.js" type="text/javascript"></script>
    </head>

    <h2>Importar Documento</h2>

    <form id="addDocImport_form" name="addDocImport_form" method="post" action="Validacoes/ValidarImportacaoDocumento.php" enctype="multipart/form-data">

        <label for="titulo">Titulo: (*)</label>
        <input id="titulo" required type="text" name="titulo" maxlength="60" placeholder="Titulo"/> 
        <label id="tituloValidationMessage"></label>
        <br>
        <label for="corpo">Corpo do documento:  (*)</label>
        <input type="file" required name="file" value="Upload"/>
        <label id="corpoValidationMessage"></label>
        <br>
        <label for="resumo">Resumo do documento:  (*)</label>
        <input id="resumo" required type="text" name="resumo" maxlength="100" placeholder="Resumo do documento"/>
        <label id="resumoValidationMessage"></label>
        <br>
        <p>Nome do Autor (*): <?php echo $_SESSION['login']; ?></p>
        <label id="autorValidationMessage"></label>
        <br>
        <label for="categoria">Categoria  (*)</label>
        <select name='cat'>
            <?php
            $catM = new CategoriaManager();
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
            <span>Data Criacao (AAAA-MM-DD):  (*)</span>
            <input type="text" id="dataCriacao" required name="dataCriacao" size="60">
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
                    Username 1 <input type="text" name="mytext[]">
                    <a href="#" class="add_field_button">Adicionar utilizador</a>                               
                </div>                          
                <div id="Geral">(escolha uma)<br>
                    <input type="radio" id="geral" name="geral" value="publico">Público<br>
                    <input type="radio" id="geral" name="geral" value="privado">Privado<br></div>
            </div>       
        </label>
        <label id="partilhaValidationMessage"></label>
        <br>
        <label for="palavraChave">Palavra-Chave:  (*)
            <input id="palavraChave" required type="text" name="palavraChave" maxlength="60" placeholder="Palavra chave"/>
        </label>
        <label id="palavraChaveValidationMessage"></label>
        <br>
        <label for="permissaoComentarios">Permitir comentários?(1 = sim ou 0 = não)  (*)
            <input id="permissao" required type="number" name="permissao" maxlength="1"/>                 
        </label>
        <br>
        <input type="submit" value="Criar documento" id="sbutton" required>
    </form>

    <a href="../Autenticacao/logout.php">Logout</a>
    <a href="../Utilizador/VistaUtilizador.php">Voltar</a>
    <?php
    include_once '../Partials/footer.php';
} else {
    header("Location: ../Autenticacao/fazerLogin.php");
}
  
