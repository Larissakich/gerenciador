<?php 
require 'Tarefa.php';

class TarefaDaoMysql implements TarefaDAO {
    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }

    public function findAll(){
        $array = [];
        
        $sql = $this->pdo->query("SELECT * FROM tarefas");
        if($sql->rowCount() > 0) {
            $dados = $sql->fetchAll();

            foreach($dados as $item) {
                $tarefa = new Tarefa();
                $tarefa->setId($item['id_tarefa']);
                $tarefa->setTitulo($item['titulo']);
                $tarefa->setDescricao($item['descricao']);
                $tarefa->setData($item['data']);
                $tarefa->setPrioridade($item['prioridade']);
                $tarefa->setStatus($item['status']);

                $array[] = $tarefa;
            }
        }

        return $array;
    }

    public function findById($id_tarefa){
        $sql = $this->pdo->prepare("SELECT * FROM tarefas WHERE id_tarefa = :id_tarefa");
        $sql->bindValue(':id_tarefa', $id_tarefa);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $dados = $sql->fetch();

            $tarefa = new Tarefa();
            $tarefa->setId($dados['id_tarefa']);
            $tarefa->setTitulo($dados['titulo']);
            $tarefa->setDescricao($dados['descricao']);
            $tarefa->setData($dados['data']);
            $tarefa->setStatus($dados['status']);
            $tarefa->setPrioridade($dados['prioridade']);
            return $tarefa;
        }else {
            return false;
        }
    }

    public function add(Tarefa $tarefa){
        $sql =  $this->pdo->prepare("INSERT INTO tarefas (titulo, descricao, data, prioridade ,status) VALUES (:titulo, :descricao, :data, :prioridade, :status)");
        $sql->bindValue(':titulo', $tarefa->getTitulo());
        $sql->bindValue(':descricao', $tarefa->getDescricao());
        $sql->bindValue(':data', $tarefa->getData());
        $sql->bindValue(':prioridade', $tarefa->getPrioridade());
        $sql->bindValue(':status', $tarefa->getStatus());
        $sql->execute();

        $tarefa->setId($this->pdo->lastInsertId());
        return $tarefa;
    }

    public function update(Tarefa $tarefa){
        $sql = $this->pdo->prepare("UPDATE tarefas SET titulo = :titulo, descricao = :descricao, prioridade = :prioridade, status = :status WHERE id_tarefa = :id_tarefa");
        $sql->bindValue(':titulo', $tarefa->getTitulo());
        $sql->bindValue(':descricao', $tarefa->getDescricao());
        $sql->bindValue(':prioridade', $tarefa->getPrioridade());
        $sql->bindValue(':status', $tarefa->getStatus());
        $sql->bindValue(':id_tarefa', $tarefa->getId());
        $sql->execute();

        return true;
    }

    public function delete($id_tarefa){
        $sql = $this->pdo->prepare("DELETE FROM tarefas WHERE id_tarefa = :id_tarefa");
        $sql->bindValue(':id_tarefa', $id_tarefa);
        $sql->execute();
    }
}