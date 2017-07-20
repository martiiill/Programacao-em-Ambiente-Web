<?php

require_once __DIR__ . '/../../Config.php';

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationModelPath() . 'Observacao.php');


/**
 * Description of DocumentoManager
 *
 * @author Ana Martins & Joana Baptista
 */
class ObservacaoManager extends MyDataAccessPDO {

    const SQL_TABLE_NAME = 'observacao';

    public function getObservacoes() {
        try {
            return  $this->getRecords(self::SQL_TABLE_NAME);          
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getObservacoesByTitulo($id) {
        try {
            $result = $this->getRecords(self::SQL_TABLE_NAME, array('titulo' => $id));
            foreach ($result as $res) {
                return $res;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getObervacoesByText($autor) {
        try {
            $result = $this->getRecords(self::SQL_TABLE_NAME, array('observacao' => $autor));
            foreach ($result as $res) {
                return $res;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function createObservacao(Observacao $obj) {
        try {
            $this->insert(self::SQL_TABLE_NAME, $obj->convertObjectToArray());
        } catch (Exception $e) {
            throw $e;
        }
    }
    
        
     public function deleteObservacaoByTitulo($obj) {
        try {
            $this->delete(self::SQL_TABLE_NAME, array('titulo' => $obj));
        } catch (Exception $e) {
            throw $e;
        }
    }
    

}