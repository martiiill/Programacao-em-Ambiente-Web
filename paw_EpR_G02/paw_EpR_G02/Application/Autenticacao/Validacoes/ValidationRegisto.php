<?php
require __DIR__.'/../../../Config.php';

require_once (Config::getApplicationDatabasePath().'MyDataAccessPDO.php');
require_once (Config::getApplicationManagerPath().'UserManager.php');
require_once (Config::getApplicationModelPath().'User.php');


$errosUser = array();

if (filter_has_var(INPUT_POST, 'nome')) {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    if (!is_string($nome)) {
        $errosUser['nome'] = 'O nome tem de ser uma string!';
    } 
}

if (filter_has_var(INPUT_POST, 'morada')) {
    $morada = filter_input(INPUT_POST, 'morada', FILTER_SANITIZE_STRING);
    if (!is_string($morada)) {
        $errosUser['morada'] = 'A morada não é uma string!';        
    } 
}

if (filter_has_var(INPUT_POST, 'contacto')) { // a funcionar
    $contacto = filter_input(INPUT_POST, 'contacto', FILTER_SANITIZE_NUMBER_INT);

    if (strlen($contacto) != 9 && is_integer($contacto)) {
        $errosUser['contacto'] = 'O contacto tem de ter exatamente 9 numeros e ser composto apenas por numeros.';
    } 
}


if (filter_has_var(INPUT_POST, 'username')) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $manager = new UserManager();
    $exists = $manager->getUserByUsername($username);

    if (strlen($username) < 4) {
        $errosUser['username'] = 'O usename tem de ter mais de 4 caracteres.';
    }

    for($i=0;$i<count($exists);$i++){
    if (!isset($exists[$i])) {
        $errosUser['username'] = 'Este username já existe!';
    }
    }
}

if (filter_has_var(INPUT_POST, 'password')) { //a funcionar
    $password =  md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

    if (strlen($password) < 2) {
        $errosUser['password'] = 'A password tem de ter pelo menos 2 caracteres!';
    }
}


if (count($errosUser) == 0) {
    
    $user = new User();
    $manager = new UserManager();

    $user->setNome($nome);
    $user->setMorada($morada);
    $user->setContacto($contacto);
    $user->setUsername($username);
    $user->setPassword($password);
    $user->setEstadoConta('nao-validada');
    
    $manager->createPerfil($user);
     echo 'Utilizador registado com sucesso';
     header("Location: ../../../index.php");
} else {
    echo 'Insucesso';
}





