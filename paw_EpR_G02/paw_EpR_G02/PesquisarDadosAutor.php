<?php
require __DIR__.'./Config.php';

require_once (Config::getApplicationManagerPath().'DocumentoManager.php');

$documentoManager = new DocumentoManager();
$listaDocumentos = $documentoManager->getDocumentosPartilhados("publico");

if (filter_input(INPUT_GET, "stringA")) {
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
