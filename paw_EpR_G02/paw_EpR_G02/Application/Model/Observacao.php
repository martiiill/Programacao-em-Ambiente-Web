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

class Observacao {

    private $titulo;
    private $observacao;

    function __construct($titulo, $observacao) {
        $this->titulo = $titulo;
        $this->observacao = $observacao;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getObservacao() {
        return $this->observacao;
    }

    function setTitulo($titulo) {
        if(!MyValidations::isString($titulo)){
            throw new Exception('Formato Invalido');
        }
        $this->titulo = $titulo;
    }

    function setObservacao($observacao) {
       if(!MyValidations::isString($observacao)){
            throw new Exception('Formato Invalido');
        }
        $this->observacao = $observacao;
    }

    public static function createObject($titulo, $observacao) {
        $per = new Observacao();
        $per->setTitulo($titulo);
        $per->setObservacao($observacao);
        return $per;
    }

    public static function convertArrayToObject(Array $data) {
        return self::createObject($data['titulo'], $data['observacao']);
    }

    public function convertObjectToArray() {
        $data = array(
            'titulo' => $this->titulo,
            'observacao' => $this->observacao
        );
        return $data;
    }

}
