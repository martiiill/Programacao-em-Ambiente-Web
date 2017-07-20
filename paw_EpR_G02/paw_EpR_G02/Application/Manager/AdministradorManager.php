<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__ . '/../../Config.php';

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationModelPath() . 'Administrador.php');

/**
 * Description of AdministradorManager
 *
 * @author Joana
 */
class AdministradorManager extends MyDataAccessPDO {

    const SQL_TABLE_NAME = 'administrador';

    public function checkAdminId($id) {
        $admin = new AdministradorManager();
        $exists = $admin->getAdminById($id);
       
        for($i=0;$i<count($exists);$i++){
            if($exists[$i]==$id){
                return true;
            }else{
                return false;
            }
        }             
    }
      public function checkAdminExistence($admin,$pass) {
        try {
            $admin_Name = $this->getConnection()->quote($admin);
            $admin_Pass = $this->getConnection()->quote($pass);
            return $results = $this->getRecordsByUserQuery('SELECT username,password FROM administrador WHERE EXISTS (SELECT username,password FROM administrador WHERE username=' . $admin_Name . 'AND password=' .$admin_Pass.')');
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    
    public function getAdminByNome($nome) {
        try {
            return $this->getRecords(self::SQL_TABLE_NAME, array('nome' => $nome));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function createAdministrador(Administrador $obj) {
        try {
            $this->insert(self::SQL_TABLE_NAME, $obj->convertObjectToArray());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateAdministrador(Administrador $obj) {
        try {
            $this->update(self::SQL_TABLE_NAME, $obj->convertObjectToArray(), array('nome' => $obj->getNome()));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteAdministrador(Administrador $obj) {
        try {
            $this->delete(self::SQL_TABLE_NAME, array('id' => $obj->getId()));
        } catch (Exception $e) {
            throw $e;
        }
    }

}
