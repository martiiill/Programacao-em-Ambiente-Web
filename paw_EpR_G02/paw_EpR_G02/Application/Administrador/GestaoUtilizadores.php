<?php
session_start();
require __DIR__.'/../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
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
            <title>Gestão de Utilizadores</title>
            <title>Documentos ABC</title>
            <link rel="stylesheet" type="text/css" href="../CSS/styleGestaoUtilizadores.css" title="style">    
        </head>
        <body>
            <?php
            $mensagemUpdate = filter_input(INPUT_GET, 'update', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($mensagemUpdate == "sucesso") {
                ?><span class="green">Atualizado com sucesso.</span><?php
            } elseif ($mensagemUpdate == "erro") {
                ?><span class="red">Erro ao atualizar</span><?php
            } elseif ($mensagemUpdate == "Erro_de_Formulario") {
                ?><span class="red">Preencher Todos os Campos Obrigatorios!!!</span><?php
            } elseif ($mensagemUpdate == "idInvalido") {
                ?><span class="red">ID Utilizador Invalido!!!</span><?php
            } elseif ($mensagemUpdate == "estadoInvalido") {
                ?><span class="red">Estado Utilizador Invalido!!!</span><?php }
            ?>
                
            <h2>Lista de Contas</h2>

            <table>
                <tr>
                    <th class="normal">Nome</th>
                    <th class="normal">Morada</th>
                    <th class="normal">Contacto</th>
                    <th class="normal">Username</th>
                    <th class="normal">Estado da Conta</th>
                </tr>

                <?php
                $userManager = new UserManager();
                $users = $userManager->getUsers();
                foreach ($users as $u) {
                    if (count($users) > 0) {
                        ?>
                        <tr>
                            <td><span><?php echo $u['nome'] ?></span></td>
                            <td><span><?php echo $u["morada"] ?></span></td>
                            <td><span><?php echo $u["contacto"] ?></span></td>
                            <td><span><?php echo $u["username"] ?></span></td>
                            <td><span><?php echo $u["estadoConta"] ?></span></td>

                            <td>                                         
                                <form action='AlterarEstadoContaUtilizador.php' method='post'  id='alterarEstadoConta'>
                                    <select id='novoEstado' name='novoEstado'>
                                        <option value ='ativada'>ativada</option>
                                        <option value ='nao-ativada'>nao-ativada</option>
                                    </select>
                                    <input type='hidden' value='<?php echo $u["username"] ?>' name='username'>
                                    <input class='botoes' type='submit' name='altEstadoConta' value='Alterar Estado da Conta'>
                                </form> 
                            </td>
                        </tr>
                    <?php } else {
                        ?>
                        <p>Nao ha contas por ativar</p>
                    <?php } ?>
                <?php }
                ?>
            </table>
            <a href="../Autenticacao/logout.php">Logout</a>
            <a href="VistaAdmin.php">Voltar</a>
            <?php include_once '../Partials/footer.php'; ?>
        </div>
    </body>
    </html>
    <?php
} else {
    header("Location: ../Autenticacao/fazerLoginAdministrador.php");
}    