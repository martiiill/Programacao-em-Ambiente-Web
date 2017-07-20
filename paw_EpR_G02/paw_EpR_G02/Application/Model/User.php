<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once __DIR__. '/../../Config.php';



/**
 * Description of Perfil
 *
 * @author Ana Martins & Joana Baptista
 */
class User {

    //Variáveis
    private $nome;
    private $morada;
    private $contacto;
    private $estadoConta;
    private $username;
    private $password;
 
    /**
     * 
     * @return type
     */
    function getNome() {
        return $this->nome;
    }

    function getMorada() {
        return $this->morada;
    }

    function getContacto() {
        return $this->contacto;
    }

    function setNome($nome) {
        
        $this->nome = $nome;
    }

    function setMorada($morada) {
       
        $this->morada = $morada;
    }

    function setContacto($contacto) {
        
        $this->contacto = $contacto;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function setUsername($username) {
       
        $this->username = $username;
    }

    function setPassword($password) {
        
        $this->password = $password;
    }
    function getEstadoConta() {
        return $this->estadoConta;
    }

    function setEstadoConta($estadoConta) {
        $this->estadoConta = $estadoConta;
    }
       
    public static function createObject($nome, $morada, $contacto, $username, $password, $estadoConta) {
        $user = new User();
        $user->setNome($nome);
        $user->setMorada($morada);
        $user->setEstadoConta($estadoConta);
        $user->setContacto($contacto);
        $user->setPassword($password);
        $user->setUsername($username);
        return $user;
    }

    public static function convertArrayToObject(Array $data) {
        return self::createObject($data['nome'], $data['morada'], $data['contacto'], $data['username'], $data['password'], $data['estadoConta']);
    }

    public function convertObjectToArray() {
        $data = array(
            'nome' => $this->nome,
            'morada' => $this->morada,
            'contacto' => $this->contacto,
            'username' => $this->username,
            'password' => $this->password,
            'estadoConta' => 'nao-ativada'
        );
        return $data;
    }

}

