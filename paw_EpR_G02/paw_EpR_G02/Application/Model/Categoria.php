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
/**
 * Description of Categoria
 *
 * @author Joana Baptista & Ana Martins
 */

class Categoria {
    private $id;
    private $nome;
    
    function __construct($id, $nome) {
        $this->id = $id;
        $this->nome = $nome;
    }
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function setId($id) {
          if (!MyValidations::isInteger($id)) {
            throw new Exception('Formato invalido');
        }
        $this->conteudo = $id;
    }

    function setNome($nome) {
          if (!MyValidations::isString($nome)) {
            throw new Exception('Formato invalido');
        }
        $this->conteudo = $nome;
    }
    
      public static function createObject($id, $nome) {
        $cat = new Categoria($id,$nome);
        return $cat;
    }
    
     public static function convertArrayToObject(Array $data) {
        return self::createObject($data['id'], $data['nome']);
    }

       public function convertObjectToArray() {
        $data = array(
            'id' => $this->id,
            'nome' => $this->nome
        );
        return $data;
    }
    
}


