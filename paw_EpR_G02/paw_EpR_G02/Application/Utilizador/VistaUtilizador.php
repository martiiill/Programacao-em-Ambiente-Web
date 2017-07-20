<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
require __DIR__ . '/../../Config.php';

require_once (Config::getApplicationManagerPath() . 'UserManager.php');
require_once (Config::getApplicationManagerPath() . 'DocumentoManager.php');

if (isset($_SESSION['login'])) {
    $alerta = filter_input(INPUT_GET, 'alerta', FILTER_SANITIZE_SPECIAL_CHARS);
    $dados = new UserManager();
    $estado = $dados->getEstadoByUsername($_SESSION['login']);
    foreach ($estado as $e) {
        $estad = $e['estadoConta'];
    }
    if ($estad === 'ativada') {
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <title>Página Inicial Utilizador</title>
                <link rel="stylesheet" type="text/css" href="../CSS/styleVistaUtilizador.css" title="style">
            </head>
            <body>
                <h1>Área do Utilizador</h1>
                <h2>Bem-vindo, <?php echo $_SESSION['login']; ?> !!</h2>

                <?php
                $manager = new DocumentoManager();
                $d = $manager->getDocumentosPartilhadosVarias($_SESSION['login']); #vai buscar os documentos na qual existe o user joao por exemplo, na partilha

                if (count($d) > 1) { #se tiver mais que 1 partilha em cada documento (nao conta os docs pubicos e privados)
                    foreach ($d as $docs) { #se essa partilha contiver o joao  EXEMPLO rute, joao
                        $dP = $manager->getDocumentosPartilhados($docs); #vai buscar o doc dessa partilha
                        if (count($dP) > 0) { #se o joao tiver varios docs partilhados com ele                                                                                 
                            foreach ($dP as $dd) {
                                $nome = str_replace(" ", "", $dd['titulo']);
                                $autor = str_replace(" ", "", $dd['autor']);
                                if (!isset($_COOKIE[$nome]) || !isset($_COOKIE[$autor])) {
                                    ?>
                                    <h4 id="alertas">ALERTA: O utilizador <a href="../Utilizador/VerPerfilPublico.php?username=<?php echo $dd['autor'] ?>"><?php echo $dd['autor'] ?></a>
                                        partilhou um <a href="../Utilizador/VerDocumentoPartilhado.php?titulo=<?php echo $dd['titulo']; ?>">documento</a> consigo.</h4>
                                    <?php
                                }
                            }
                        } else {
                            ?>
                            <h4 id="alertas">ALERTA: O utilizador <a href="../Utilizador/VerPerfilPublico.php?username=<?php echo $dP['autor'] ?>"><?php echo $dP['autor'] ?></a>
                                partilhou um <a href="../Utilizador/VerDocumentoPartilhado.php?titulo=<?php echo $dP['titulo']; ?>">documento</a> consigo.</h4>
                            <?php
                        }
                    }
                } else { # e so partilhado com o joao neste exmeplo EXEMPLO partilha:joao
                    if (!isset($_COOKIE[$_SESSION['login']])) {
                        setcookie($_SESSION['login'], "sim");
                        $dP = $manager->getDocumentosPartilhados($d);
                        ?>
                        <h4 id="alertas">ALERTA: O utilizador <a href="../Utilizador/VerPerfilPublico.php?username=<?php echo $dP['autor'] ?>"><?php echo $dP['autor'] ?></a>
                            partilhou um <a href="../Utilizador/VerDocumentoPartilhado.php?titulo=<?php echo $dP['titulo']; ?>">documento</a> consigo.</h4>
                        <?php
                    } else {
                        ?>
                        <p>Nao existem alertas para mostrar.</p>
                        <?php
                    }
                }

                include_once '../Partials/procuraUser.php';
                ?>

                <h5>O que pretende fazer?</h5>
                <div >
                    <ul>
                        <li> <a href="VerPerfil.php">Ver Perfil</a></li>
                        <li><a href="ImportarDocumento.php">Importar um documento</a></li>
                        <li><a href="GestaoDocumentos.php">Gestão dos Meus Documentos</a></li>
                        <li> <a href="ComentarDocumentos.php">Comentar Documentos</a></li>
                        <li> <a href="AreaDocumentosPartilhados.php">Area de Documentos Partilhados</a></li>
                    </ul>
                </div>
                <a href="../Autenticacao/logout.php">Logout</a>
            </body>
        </html> 
        <?php
        include_once '../Partials/footer.php';
    } else {

        header("Location: ContaNaoAtiva.php");
    }
} else {
    header("Location: ../Autenticacao/fazerLogin.php");
}

    