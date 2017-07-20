<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once __DIR__. '/../../Config.php';

use Config as Conf;

require_once (Conf::getApplicationUtilsPath() . 'Validations.php');

use Validations as MyValidations;

class Edicao {

    private $doc;
    private $porque;
     
    function __construct($doc, $porque) {
        $this->doc = $doc;
        $this->porque = $porque;
    }

    function getDoc() {
        return $this->doc;
    }

    function getPorque() {
        return $this->porque;
    }

        
        function setDoc($doc) {

        if (!MyValidations::isInteger($doc)) {
            throw new Exception('Formato invalido');
        }
        $this->doc = $doc;
    }

    function setPorque($porque) {
        if(!MyValidations::isString($porque)){
            throw new Exception('Formato invalido');
        }
        $this->porque = $porque;
    }

      public static function createObject($doc,$porque) {
        $e = new Edicao();
        $e->setDoc($doc);
        $e->setPorque($porque);
        return $e;
    }
    
     public static function convertArrayToObject(Array $data) {
        return self::createObject($data['doc'], $data['porque']);
    }

       public function convertObjectToArray() {
        $data = array(
            'doc' => $this->doc,
            'porque' => $this->porque
        );
        return $data;
    }

}