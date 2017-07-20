<?php

session_start();
require __DIR__ . '/../../../Config.php';

require_once (Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath() . 'UserManager.php');
require_once (Config::getApplicationManagerPath() . 'DocumentoManager.php');
require_once (Config::getApplicationModelPath() . 'Documento.php');

if (isset($_SESSION['login'])) {
    $data = date("YYYY-MM-DD", time());
    $formato = '/^(\d{4})\-(\d{2})\-(\d{2})$/';
    $user_manager = new UserManager();

    if (filter_input(INPUT_POST, 'permissao', FILTER_SANITIZE_NUMBER_INT) == 1 || filter_input(INPUT_POST, 'permissao', FILTER_SANITIZE_NUMBER_INT) == 2) {
        $comentario = filter_input(INPUT_POST, 'permissao', FILTER_SANITIZE_NUMBER_INT);
    } else {
        header('Location: ../../Utilizador/GestaoDocumentos.php?add=erropermissao');
    }

    if (preg_match($formato, filter_input(INPUT_POST, 'dataCriacao', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == 1 &&
            filter_input(INPUT_POST, 'dataCriacao', FILTER_SANITIZE_FULL_SPECIAL_CHARS) < $data) {
        $dataCriacao = filter_input(INPUT_POST, 'dataCriacao', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    } else {
        header('Location: ../../Utilizador/GestaoDocumentos.php?add=errodata');
    }

    if (strlen(filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) < 90) {
        $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    } else {
        header('Location: ../../Utilizador/GestaoDocumentos.php?add=errotitulo');
    }

    if (strlen(filter_input(INPUT_POST, 'resumo', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) < 100) {
        $resumo = filter_input(INPUT_POST, 'resumo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    } else {
        header('Location: ../../Utilizador/GestaoDocumentos.php?add=erroresumo');
    }

    $corpo = filter_input(INPUT_POST, 'corpo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $categoria = filter_input(INPUT_POST, 'cat', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $palavrasChave = filter_input(INPUT_POST, 'palavraChave', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $tamanho = strlen($corpo);
    $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (filter_input(INPUT_POST, 'tipo-partilha') == 'Users') {
        $tipo = $_POST['mytext']; #encontrar alternativa uma vez que aparece warnning a dizer pra nao usar o post assim
        $valores = '';
        foreach ($tipo as $va) {
            $user_manager = new UserManager();
            if ($user_manager->checkUser($va)) {
                $valores[] .= $va;
            } else {
                $mensagem[] .= $va;
            }
        }
        $v = implode(',', $valores);
        $partilha = $v;
    } else if (filter_input(INPUT_POST, 'tipo-partilha') == 'Geral') {
        $partilha = filter_input(INPUT_POST, 'geral', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if (count($mensagem) > 0) {
        $u = implode(',', $mensagem);
        header('Location: ../../Utilizador/GestaoDocumentos.php?usernao=' . $u);
    } else {
        $manager = new DocumentoManager();
        $doc = new Documento();
        $d = $doc->createObject($titulo, $_SESSION['login'], $resumo, $categoria, $dataCriacao, $corpo, $palavrasChave, $url, $tamanho, $partilha, $comentario);
        $manager->createDocumento($d);
        header('Location: ../../Utilizador/GestaoDocumentos.php?add=sucesso');
    }
} else {
    header("Location: ../../Autenticacao/fazerLogin.php");
}    