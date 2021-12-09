<?php 
require 'config.php';
require 'TarefaDaoMysql.php';

$tarefaDao = new TarefaDaoMysql($pdo);

$id_tarefa = filter_input(INPUT_POST, 'id_tarefa');
$titulo = filter_input(INPUT_POST, 'titulo');
$descricao = filter_input(INPUT_POST, 'descricao');
$prioridade = filter_input(INPUT_POST, 'prioridade');
$status = filter_input(INPUT_POST, 'status');

if($id_tarefa && $titulo && $descricao && $status && $prioridade) {
    $tarefa = $tarefaDao->findById($id_tarefa);
    $tarefa->setTitulo($titulo);
    $tarefa->setDescricao($descricao);
    $tarefa->setPrioridade($prioridade);
    $tarefa->setStatus($status);

    $tarefaDao->update($tarefa);

    header('Location: ../tarefas.php');
    exit;
} 
else {
    header("Location: ../tarefas.php");
    exit;
}