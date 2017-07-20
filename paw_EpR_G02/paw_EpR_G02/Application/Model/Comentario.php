<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once __DIR__. '/../../Config.php';

use Config as Conf;

require_once (Conf::getApplicationUtilsPath() . 'Validations.php');

use Validations as MyValidations;

class Comentario {

    private $titulo;
    private $texto;
    private $username;

    function getIdDocumento() {
        return $this->titulo;
    }

    function getTexto() {
        return $this->texto;
    }

    function getIdUtilizador() {
        return $this->username;
    }

    function setIdDocumento($idDocumento) {

        if (!MyValidations::isString($idDocumento)) {
            throw new Exception('Formato invalido');
        }
        $this->titulo = $idDocumento;
    }

    function setTexto($texto) {
        if(!MyValidations::isString($texto)){
            throw new Exception('Formato invalido');
        }
        $this->texto = $texto;
    }

    function setIdUtilizador($idUtilizador) {
        if(!MyValidations::isString($idUtilizador)){
            throw new Exception('Formato invalido');
        }
        $this->username = $idUtilizador;
    }
    
      public static function createObject($idDocumento, $texto,$idUtilizador) {
        $com = new Comentario();
        $com->setIdDocumento($idDocumento);
        $com->setTexto($texto);
        $com->setIdUtilizador($idUtilizador);
        return $com;
    }
    
     public static function convertArrayToObject(Array $data) {
        return self::createObject($data['titulo'], $data['texto'],$data['username']);
    }

       public function convertObjectToArray() {
        $data = array(
            'titulo' => $this->titulo,
            'texto' => $this->texto,
            'username' => $this->username
        );
        return $data;
    }
    
}
