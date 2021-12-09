<?php 
require 'config.php';
require 'ProjetoDAOMysql.php';

$projetoDao = new ProjetoDaoMysql($pdo);

$id = filter_input(INPUT_POST, 'id');
$titulo = filter_input(INPUT_POST, 'titulo');
$descricao = filter_input(INPUT_POST, 'descricao');
$status = filter_input(INPUT_POST, 'status');

if($id && $titulo && $descricao && $status) {
    $projeto = $projetoDao->findById($id);
    $projeto->setTitulo($titulo);
    $projeto->setDescricao($descricao);
    $projeto->setStatus($status);

    $projetoDao->update($projeto);

    header('Location: ../index.php');
    exit;
} 
else {
    header("Location: ../index.php");
    exit;
}