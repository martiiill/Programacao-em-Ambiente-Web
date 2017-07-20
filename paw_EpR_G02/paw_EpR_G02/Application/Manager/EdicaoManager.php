<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__ . '/../../Config.php';

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationModelPath() . 'Edicao.php');

/**
 * Description of DocumentoManager
 *
 * @author Ana Martins & Joana Baptista
 */
class EdicaoManager extends MyDataAccessPDO {

    const SQL_TABLE_NAME = 'edicao';

    public function getEdicoes() {
        try {
            return $this->getRecords(self::SQL_TABLE_NAME);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getEdicoesByDoc($id) {
        try {
            return $result = $this->getRecords(self::SQL_TABLE_NAME, array('doc' => $id));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getEdicaoByPorque($autor) {
        try {
            return $result = $this->getRecords(self::SQL_TABLE_NAME, array('porque' => $autor));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function createComentario(Edicao $obj) {
        try {
            return $this->insert(self::SQL_TABLE_NAME, $obj->convertObjectToArray());
        } catch (Exception $e) {
            throw $e;
        }
    }
    
        
     public function deleteEdicaoByDoc( $obj) {
        try {
            $this->delete(self::SQL_TABLE_NAME, array('doc' => $obj));
        } catch (Exception $e) {
            throw $e;
        }
    }
    

}
