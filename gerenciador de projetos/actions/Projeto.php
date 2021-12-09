<?php

class Projeto {
    private $id;
    private $titulo;
    private $descricao;
    private $data;
    private $status;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = trim($id);
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = ucfirst(trim($titulo));
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = ucfirst(trim($descricao));
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = trim($status);
    }
}

interface ProjetoDAO {
    public function findAll();
    public function findById($id);
    public function add(Projeto $projeto);
    public function update(Projeto $projeto);
    public function delete($id);  
}