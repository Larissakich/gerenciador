<?php 
require 'Projeto.php';

class ProjetoDaoMysql implements ProjetoDAO {
    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }


    public function findAll(){
        $array = [];
        
        $sql = $this->pdo->query("SELECT * FROM projetos");
        if($sql->rowCount() > 0) {
            $dados = $sql->fetchAll();

            foreach($dados as $item) {
                $projeto = new Projeto();
                $projeto->setId($item['id']);
                $projeto->setTitulo($item['titulo']);
                $projeto->setDescricao($item['descricao']);
                $projeto->setData($item['data']);
                $projeto->setStatus($item['status']);

                $array[] = $projeto;
            }
        }
        return $array;
    }

    public function findById($id){
        $sql = $this->pdo->prepare("SELECT * FROM projetos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $dados = $sql->fetch();

            $projeto = new Projeto();
            $projeto->setId($dados['id']);
            $projeto->setTitulo($dados['titulo']);
            $projeto->setDescricao($dados['descricao']);
            $projeto->setData($dados['data']);
            $projeto->setStatus($dados['status']);
            return $projeto;
        }else {
            return false;
        }
    }

    public function add(Projeto $projeto){
        $sql =  $this->pdo->prepare("INSERT INTO projetos (titulo, descricao, data, status) VALUES (:titulo, :descricao, :data, :status)");
        $sql->bindValue(':titulo', $projeto->getTitulo());
        $sql->bindValue(':descricao', $projeto->getDescricao());
        $sql->bindValue(':data', $projeto->getData());
        $sql->bindValue(':status', $projeto->getStatus());
        $sql->execute();

        $projeto->setId($this->pdo->lastInsertId());
        return $projeto;
    }

    public function update(Projeto $projeto){
        $sql = $this->pdo->prepare("UPDATE projetos SET titulo = :titulo, descricao = :descricao, status = :status WHERE id = :id");
        $sql->bindValue(':titulo', $projeto->getTitulo());
        $sql->bindValue(':descricao', $projeto->getDescricao());
        $sql->bindValue(':status', $projeto->getStatus());
        $sql->bindValue(':id', $projeto->getId());
        $sql->execute();

        return true;
    }

    public function delete($id){
        $sql = $this->pdo->prepare("DELETE FROM projetos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}