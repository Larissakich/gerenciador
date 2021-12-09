<?php 
require 'config.php';
require 'ProjetoDaoMySql.php';

$tarefaDao = new ProjetoDaoMySql($pdo);

$id = filter_input(INPUT_GET, 'id');

if($id) {
    $tarefaDao->delete($id);
}
header("Location: ../index.php");
exit;
?>