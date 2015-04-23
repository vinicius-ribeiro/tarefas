<?php 

include 'config.php';
include 'banco.php';

remover_tarefa($conexao, $_GET['idTarefa']);

header("Location: tarefas.php");

?>