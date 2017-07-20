<?php

session_start();
require __DIR__.'./Config.php';

require_once (Config::getApplicationManagerPath().'DocumentoManager.php');



if (isset($_SESSION['login'])) {

    if (filter_input(INPUT_GET, "stringA")) {
        $documentoManager = new DocumentoManager();
        $listaDocumentos = $documentoManager->getDocumentosPartilhados($_SESSION['login']);

// initialize some variables
        $matches = array();

// grab the search string from $_POST
        $string = filter_input(INPUT_GET, "stringA", FILTER_SANITIZE_STRING);

// filter the array for matches
        foreach ($listaDocumentos as $documento) {
            if (stripos($documento['autor'], $string) !== false) {
                array_push($matches, $documento['autor']);
            } else {
                
            }
        }

// encode into JSON notiation and echo to browser
        echo json_encode($matches);
    }
} else {
    
    header("Location: ./Application/Autenticacao/fazerLogin.php");
}