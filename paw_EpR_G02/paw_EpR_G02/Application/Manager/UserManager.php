<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__ . '/../../Config.php';

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationModelPath() . 'User.php');

/**
 * Description of PerfilManager
 *
 * @author Ana Martins & Joana Baptista
 */
class UserManager extends MyDataAccessPDO {

    const SQL_TABLE_NAME = 'user';

    public function getUsers() {
        try {
            return $this->getRecords(self::SQL_TABLE_NAME);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function checkUserExistence($user, $pass) {
        try {
            $user_Name = $this->getConnection()->quote($user);
            $user_Pass = $this->getConnection()->quote($pass);
            $results = $this->getRecordsByUserQuery('SELECT username,password FROM user WHERE EXISTS (SELECT username,password FROM user WHERE username=' . $user_Name . 'AND password=' . $user_Pass . ')');
            foreach ($results as $res) {
                return $res;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function checkUser($user) {
        try {
            $user_Name = $this->getConnection()->quote($user);
            $result = $this->getRecordsByUserQuery('SELECT username FROM user WHERE EXISTS (SELECT username FROM user WHERE username=' . $user_Name . ')');
        } catch (Exception $e) {
            throw $e;
        }
        foreach ($result as $res) {
            return $res;
        }
    }

    public function veriCheckUser(User $u) {
        try {
            $results = $this->getRecords(self::SQL_TABLE_NAME, array('username' => $u->getUsername(), 'password' => $u->getPassword()));
        } catch (Exception $e) {
            throw $e;
        }
        if (count($results) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function alterarContaUser($user, $estado) {
        $campo = array("estadoConta" => $estado, "username" => $user);
        $where = array("username" => $user);
        try {
            $result = $this->update(self::SQL_TABLE_NAME, $campo, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getUserByUsername($username) {
        try {
            return $this->getRecords(self::SQL_TABLE_NAME, array('username' => $username));
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getPasswordByUsername($username, $pass) {
        try {
            $result = $this->getRecords(self::SQL_TABLE_NAME, array('username' => $username, 'password' => $pass));
            foreach ($result as $res) {
                return $res;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getUserByName($name) {
        try {
            $result = $this->getRecords(self::SQL_TABLE_NAME, array('nome' => $name));
            foreach ($result as $res) {
                return $res;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getUserByEstadoConta($estado) {
        try {
            return $this->getRecords(self::SQL_TABLE_NAME, array('estadoConta' => $estado));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getEstadoByUsername($username) {
        $results = "SELECT estadoConta FROM " . self::SQL_TABLE_NAME . " WHERE username = '$username'";
        return $this->getRecordsByUserQuery($results);
    }

    public function createPerfil(User $obj) {
        try {
            $this->insert(self::SQL_TABLE_NAME, $obj->convertObjectToArray());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updatePerfil($user, $nome, $morada, $contacto) {
        $campo = array("nome" => $nome, "morada" => $morada, "contacto" => $contacto, "username" => $user);
        $where = array("username" => $user);
        try {
            $result = $this->update(self::SQL_TABLE_NAME, $campo, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getEstadoContaNaoAtivada($user) {
        $username_ = $this->getUserByUsername($user);

        if ($username_->getEstadoConta() == 'nao-ativada') {
            return true;
        } else {
            return false;
        }
    }

    public function deletePerfil(User $obj) {
        try {
            $this->delete(self::SQL_TABLE_NAME, array('nome' => $obj->getNome()));
        } catch (Exception $e) {
            throw $e;
        }
    }

}
