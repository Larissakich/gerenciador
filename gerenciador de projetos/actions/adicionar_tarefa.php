<?php 
require 'config.php';
require 'TarefaDaoMysql.php';

$tarefaDao = new TarefaDaoMysql($pdo);

$titulo = filter_input(INPUT_POST, 'titulo');
$descricao = filter_input(INPUT_POST, 'descricao');
$prioridade = filter_input(INPUT_POST, 'prioridade');
$status = filter_input(INPUT_POST, 'status');
$data = date('d/m/Y');

if($titulo && $descricao && $status && $prioridade) {

    $novaTarefa = new Tarefa();
    $novaTarefa->setTitulo($titulo);
    $novaTarefa->setDescricao($descricao);
    $novaTarefa->setData($data);
    $novaTarefa->setPrioridade($prioridade);
    $novaTarefa->setStatus($status);
      
    $tarefaDao->add($novaTarefa);
    
    header("Location: ../tarefas.php");
    exit;

} else {
    header("Location: ../tarefas.php");
    exit;
}