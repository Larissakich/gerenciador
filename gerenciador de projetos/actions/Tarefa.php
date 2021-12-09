<?php

class Tarefa {
    private $id_tarefa;
    private $titulo;
    private $descricao;
    private $data;
    private $status;
    private $prioridade;

    public function getId() {
        return $this->id_tarefa;
    }

    public function setId($id_tarefa) {
        $this->id_tarefa = trim($id_tarefa);
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
        $this->status= $status;
    }

    public function getPrioridade() {
        return $this->prioridade;
    }

    public function setPrioridade($prioridade) {
        $this->prioridade = $prioridade;
    }
}

interface TarefaDAO {
    public function findAll();
    public function findById($id_tarefa);
    public function add(Tarefa $tarefa);
    public function update(Tarefa $tarefa);
    public function delete($id_tarefa);   
}