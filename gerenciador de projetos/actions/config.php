<?php
$db_name = 'projeto_gerenciador';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

$pdo =  new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);