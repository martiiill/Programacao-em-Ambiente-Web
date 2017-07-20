<?php

require_once __DIR__ . '/../../Config.php';

use Config as Conf;

require_once (Conf::getApplicationUtilsPath() . 'Validations.php');

use Validations as MyValidations;

/**
 * Description of Documento
 *
 * @author Ana Martins & Joana Baptista
 */
class Documento {

    private $titulo;
    private $autor;
    private $resumo;
    private $categoria;
    private $dataCriacao;
    private $conteudo;
    private $palavrasChave;
    private $url;
    private $tamanho;
    private $partilha;
    private $comentario;
    
    function getComentario() {
        return $this->comentario;
    }

    function setComentario($comentario) {
        $this->comentario = $comentario;
    }
        
    function getTitulo() {
        return $this->titulo;
    }

    function getAutor() {
        return $this->autor;
    }

    function getResumo() {
        return $this->resumo;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getDataCriacao() {
        return $this->dataCriacao;
    }

    function getConteudo() {
        return $this->conteudo;
    }

    function getPalavrasChave() {
        return $this->palavrasChave;
    }

    function getUrl() {
        return $this->url;
    }

    function getTamanho() {
        return $this->tamanho;
    }

    function setTitulo($titulo) {
        if (!MyValidations::isString($titulo)) {
            throw new Exception('Formato invalido');
        }
        $this->titulo = $titulo;
    }

    function setAutor($autor) {
        if (!MyValidations::isString($autor)) {
            throw new Exception('Autor invalido');
        }
        $this->autor = $autor;
    }

    function setResumo($resumo) {
        if (!MyValidations::isString($resumo)) {
            throw new Exception('Formato invalido');
        }
        $this->resumo = $resumo;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setDataCriacao($dataCriacao) {
        $this->dataCriacao = $dataCriacao;
    }

    function setConteudo($conteudo) {
        if (!MyValidations::isString($conteudo)) {
            throw new Exception('Conteudo invalido');
        }
        $this->conteudo = $conteudo;
    }

    function setPalavrasChave($palavrasChave) {
        if (!MyValidations::isString($palavrasChave)) {
            throw new Exception('Palavra chave invalido');
        }
        $this->palavrasChave = $palavrasChave;
    }

    function setUrl($url) {
        if (!MyValidations::isString($url)) {
            throw new Exception('Url invalido');
        }
        $this->url = $url;
    }

    function setTamanho($tamanho) {
        if (!MyValidations::isInteger($tamanho)) {
            throw new Exception('Tamanho invalido');
        }
        $this->tamanho = $tamanho;
    }

    function getPartilha() {
        return $this->partilha;
    }

    function setPartilha($partilha) {
        $this->partilha = $partilha;
    }

    public static function createObject($titulo, $autor, $resumo, $categoria, $dataCriacao, $conteudo, $palavrasChave, $url, $tamanho, $partilha, $comentario) {
        $doc= new Documento();
        $doc->setAutor($autor);
        $doc->setTitulo($titulo);
        $doc->setResumo($resumo);
        $doc->setCategoria($categoria);
        $doc->setDataCriacao($dataCriacao);
        $doc->setConteudo($conteudo);
        $doc->setPalavrasChave($palavrasChave);
        $doc->setUrl($url);
        $doc->setTamanho($tamanho);
        $doc->setPartilha($partilha);
        $doc->setComentario($comentario);  
        return $doc;
    }

    public static function convertArrayToObject(Array $data) {
        return self::createObject($data['titulo'], $data['autor'], $data['resumo'], $data['categoria'], $data['dataCriacao'], $data['conteudo'], $data['palavrasChave'], $data['url'], $data['tamanho'], $data['partilha'], $data['comentario']);
    }

    public function convertObjectToArray() {
        $data = array(
            'titulo' => $this->titulo,
            'autor' => $this->autor,
            'resumo' => $this->resumo,
            'categoria' => $this->categoria,
            'dataCriacao' => $this->dataCriacao,
            'conteudo' => $this->conteudo,
            'palavrasChave' => $this->palavrasChave,
            'url' => $this->url,
            'tamanho' => $this->tamanho,
            'partilha' => $this->partilha,
            'comentario' => $this->comentario
        );
        return $data;
    }

}
