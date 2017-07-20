<?php

session_start();
require __DIR__ . '/../../../Config.php';

require_once (Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath() . 'CategoriaManager.php');
require_once (Config::getApplicationManagerPath() . 'UserManager.php');
require_once (Config::getApplicationModelPath() . 'Documento.php');
require_once (Config::getApplicationManagerPath() . 'DocumentoManager.php');

//função usada para obter o conteudo de um ficheiro
function read_file_docx($filename) {

    $striped_content = '';
    $content = '';

    if (!$filename || !file_exists($filename)) {
        return false;
    }

    $zip = zip_open($filename);

    if (!$zip || is_numeric($zip)) {
        return false;
    }

    while ($zip_entry = zip_read($zip)) {

        if (zip_entry_open($zip, $zip_entry) == FALSE) {
            continue;
        }

        if (zip_entry_name($zip_entry) != "word/document.xml") {
            continue;
        }

        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

        zip_entry_close($zip_entry);
    }// end while

    zip_close($zip);

//echo $content;
//echo "<hr>";
//file_put_contents('1.xml', $content);

    $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
    $content = str_replace('</w:r></w:p>', "\r\n", $content);
    $striped_content = strip_tags($content);

    return $striped_content;
}

if (isset($_SESSION['login'])) {
    $mensagem='';
    $uploaddir = basename(__DIR__);
    $uploadfile = $uploaddir . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile) == TRUE) {
        echo "sucesso\n";
    } else {
        echo "insucesso";
    }
    
    $data = date("YYYY-MM-DD", time());
    $formato = '/^(\d{4})\-(\d{2})\-(\d{2})$/';
    $read = read_file_docx($uploadfile);
    $tamanho = filesize($uploadfile);

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
    $palavraChave = filter_input(INPUT_POST, 'palavraChave', FILTER_SANITIZE_SPECIAL_CHARS);
    $categoria = filter_input(INPUT_POST, 'cat', FILTER_SANITIZE_SPECIAL_CHARS);

    if (filter_input(INPUT_POST, 'tipo-partilha') === 'Users') {
        $tipo = $_POST['mytext']; #encontrar alternativa uma vez que aparece warnning a dizer pra nao usar o post assim
        $valores[] = '';
        foreach ($tipo as $va) {
            $user_manager = new UserManager();
            if ($user_manager->checkUser($va)) {
                $valores[] .= $va;
            } else {
                $mensagem[] .= $va;
                ;
            }
        }
        $v = implode(',', $valores);
        $partilha = $v;
    } else if (filter_input(INPUT_POST, 'tipo-partilha') === 'Geral') {
        $partilha = filter_input(INPUT_POST, 'geral', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if (count($mensagem) > 1) {
        $u = implode(',', $mensagem);
        header('Location: ../../Utilizador/GestaoDocumentos.php?usernao=' . $u);
    } else {
        $doc = new Documento();
        $docM = new DocumentoManager();
        $d = $doc->createObject($titulo, $_SESSION['login'], $resumo, $categoria, $dataCriacao, $read, $palavraChave, $uploadfile, $tamanho, $partilha, $comentario);
        $docM->createDocumento($d);
        header('Location: ../../Utilizador/GestaoDocumentos.php?add=sucesso');
    }
} else {
    header("Location: ../../Autenticacao/fazerLogin.php");
}