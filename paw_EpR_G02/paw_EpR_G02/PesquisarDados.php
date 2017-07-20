<?php
require __DIR__.'./Config.php';

require_once (Config::getApplicationManagerPath().'DocumentoManager.php');

$documentoManager = new DocumentoManager();
$listaDocumentos = $documentoManager->getDocumentosPartilhados("publico");

if (filter_input(INPUT_GET, "string")) {
// initialize some variables
    $matches = array();

// grab the search string from $_POST
    $string = filter_input(INPUT_GET, "string", FILTER_SANITIZE_STRING);

// filter the array for matches
    foreach ($listaDocumentos as $documento) {
        if (stripos($documento['titulo'], $string) !== false) {
            array_push($matches, $documento['titulo']);
        } else {
        }
    }

// encode into JSON notiation and echo to browser
    echo json_encode($matches);
}    
