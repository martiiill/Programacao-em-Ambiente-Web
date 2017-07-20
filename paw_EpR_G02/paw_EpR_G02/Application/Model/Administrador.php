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
 * Description of Administrador
 *
 * @author Joana
 */
class Administrador {
    private $username;
    private $password;
    
    function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
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

 public static function createObject($username, $password) {
        $cat = new Administrador($username,$password);
        return $cat;
    }
    
     public static function convertArrayToObject(Array $data) {
        return self::createObject($data['username'], $data['password']);
    }

       public function convertObjectToArray() {
        $data = array(
            'username' => $this->username,
            'password' => $this->password
        );
        return $data;
    }
    

}
