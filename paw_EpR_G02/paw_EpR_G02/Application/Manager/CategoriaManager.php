<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__ . '/../../Config.php';

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationModelPath() . 'Categoria.php');

/**
 * Description of DocumentoManager
 *
 * @author Ana Martins & Joana Baptista
 */
class CategoriaManager extends MyDataAccessPDO {

    const SQL_TABLE_NAME = 'categoria';

    public function getCategoriaById($id) {
        try {
            $result = $this->getRecords(self::SQL_TABLE_NAME, array('id' => $id));
            foreach ($result as $res) {
                return $res;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getCategoriaByNome($nome) {
        try {
            return $this->getRecords(self::SQL_TABLE_NAME, array('nome' => $nome));
            
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function createCategoria(Categoria $obj) {
        try {
            $this->insert(self::SQL_TABLE_NAME, $obj->convertObjectToArray());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateCategoria(Categoria $obj) {
        try {
            $this->update(self::SQL_TABLE_NAME, $obj->convertObjectToArray(), array('nome' => $obj->getNome()));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteCategoria(Categoria $obj) {
        try {
            $this->delete(self::SQL_TABLE_NAME, array('id' => $obj->getId()));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function checkIfCategoriaExiste($cate) {
        try {
            $nomeC = $this->getConnection()->quote($cate);
            return $results = $this->getRecordsByUserQuery('SELECT nome FROM ' . self::SQL_TABLE_NAME . ' WHERE EXISTS (SELECT nome FROM ' . self::SQL_TABLE_NAME . ' WHERE nome=' . $nomeC . ')');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteCategoriaByNome($nome) {
        try {
            $this->delete(self::SQL_TABLE_NAME, array('nome' => $nome));
            $this->delete("documento", array("categoria" => $nome));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getCategorias() {
        try {
           return $this->getRecords(self::SQL_TABLE_NAME);
        } catch (Exception $e) {
            throw $e;
        }
    }

}
