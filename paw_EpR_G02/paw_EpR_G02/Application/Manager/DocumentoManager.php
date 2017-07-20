<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__ . '/../../Config.php';

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationModelPath() . 'Documento.php');

/**
 * Description of DocumentoManager
 *
 * @author Ana Martins & Joana Baptista
 */
class DocumentoManager extends MyDataAccessPDO {

    const SQL_TABLE_NAME = 'documento';

    public function getDocumentos() {
        try {
            return $this->getRecords(self::SQL_TABLE_NAME);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getDocumentoById($id) {
        try {
            return $this->getRecords(self::SQL_TABLE_NAME, array('id' => $id));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getDocumentoByAutor($autor) {
        try {
            return $this->getRecords(self::SQL_TABLE_NAME, array('autor' => $autor));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getDocumentoByTitulo($t) {
        try {
            $result = $this->getRecords(self::SQL_TABLE_NAME, array('titulo' => $t));
            foreach ($result as $res) {
                return $res;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function alterarConteudoDoc($doc, $conteudo) {
        $campo = array("conteudo" => $conteudo, "titulo" => $doc);
        $where = array("titulo" => $doc);
        try {
            $this->update(self::SQL_TABLE_NAME, $campo, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getDocumentoByPermissaoComentario($permissao) {
        try {
            return $this->getRecords(self::SQL_TABLE_NAME, array('comentario' => $permissao));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getDocumentoByPermissaoUserComentario($permissao, $user) {
        try {
            return $this->getRecords(self::SQL_TABLE_NAME, array('partilha' => $user, 'comentario' => $permissao));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getDocumentosPartilhados($partilha) {
        try {
            return $this->getRecords(self::SQL_TABLE_NAME, array('partilha' => $partilha));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getDocumentosPartilhadosVarias($partilha) {
        $docs = $this->getDocumentos();
        $str = '';
        if (count($docs) > 0) {
            foreach ($docs as $d) {
            if (strpos($d['partilha'], $partilha) !== FALSE && $d['partilha'] !== 'publico' &&  $d['partilha'] !== 'privado')  {
                    $str[] = $d['partilha'];
                } else {
                    $str;
                }
            }
        } else if (strpos($docs['partilha'], $partilha) !== FALSE && docs['partilha'] !== 'publico' &&  docs['partilha'] !== 'privado') {
            $str[] = $docs['partilha'];
        } else {
            $str;
        }

        return $str;
    }

    public function getDocumentoByCategoria($categoria) {
        try {
            $result = $this->getRecords(self::SQL_TABLE_NAME, array('categoria' => $categoria));
            foreach ($result as $res) {
                return $res;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function createDocumento(Documento $obj) {
        try {
            $this->insert(self::SQL_TABLE_NAME, $obj->convertObjectToArray());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function addObservacao($titulo, $obs) {
        try {
            $this->update(self::SQL_TABLE_NAME, array('titulo' => $titulo, 'observacao' => $obs));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateDocumento(Documento $obj) {
        try {
            $this->update(self::SQL_TABLE_NAME, $obj->convertObjectToArray(), array('titulo' => $obj->getTitulo()));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteDocumento($obj) {
        try {
            $this->delete(self::SQL_TABLE_NAME, array('titulo' => $obj));
        } catch (Exception $e) {
            throw $e;
        }
    }

}
