<?php 
require 'config.php';
require 'TarefaDaoMySql.php';

$tarefaDao = new TarefaDaoMySql($pdo);

$id_tarefa = filter_input(INPUT_GET, 'id');

if($id_tarefa) {
    $tarefaDao->delete($id_tarefa);
}
header("Location: ../tarefas.php");
exit;
?>