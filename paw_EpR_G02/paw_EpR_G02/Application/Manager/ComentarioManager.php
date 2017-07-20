<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__ . '/../../Config.php';

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationModelPath() . 'Comentario.php');

/**
 * Description of DocumentoManager
 *
 * @author Ana Martins & Joana Baptista
 */
class ComentarioManager extends MyDataAccessPDO {

    const SQL_TABLE_NAME = 'comentario';

    public function getComentarios() {
        try {
            return $this->getRecords(self::SQL_TABLE_NAME);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getComentariosByDoc($id) {
        try {
            return $this->getRecords(self::SQL_TABLE_NAME, array('titulo' => $id));        
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getComentarioByUser($autor) {
        try {
            return $this->getRecords(self::SQL_TABLE_NAME, array('username' => $autor));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getComentarioByText($t) {
        try {
            $result = $this->getRecords(self::SQL_TABLE_NAME, array('texto' => $t));
            foreach ($result as $res) {
                return $res;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function createComentario(Comentario $obj) {
        try {
           return $this->insert(self::SQL_TABLE_NAME, $obj->convertObjectToArray());
        } catch (Exception $e) {
            throw $e;
        }
    }
    
        
     public function deleteComentario(Comentario $obj) {
        try {
            $this->delete(self::SQL_TABLE_NAME, array('titulo' => $obj->getIdDocumento()));
        } catch (Exception $e) {
            throw $e;
        }
    }
    

}
