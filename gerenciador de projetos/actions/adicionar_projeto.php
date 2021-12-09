<?php 
require 'config.php';
require 'ProjetoDaoMysql.php';

$projetoDao = new ProjetoDaoMysql($pdo);

$titulo = filter_input(INPUT_POST, 'titulo');
$descricao = filter_input(INPUT_POST, 'descricao');
$status = filter_input(INPUT_POST, 'status');
$data = date('d/m/Y');

if($titulo && $descricao && $status) {

    $novoProjeto = new Projeto();
    $novoProjeto->setTitulo($titulo);
    $novoProjeto->setDescricao($descricao);
    $novoProjeto->setData($data);
    $novoProjeto->setStatus($status);
   
    $projetoDao->add($novoProjeto);

    header("Location: ../index.php");
    exit;

} else {
    header("Location: ../index.php");
    exit;
}