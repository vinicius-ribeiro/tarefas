<?php 

class Tarefas
{

	public $conexao;
	public $tarefas = array();

	public function __construct($nova_conexao)
	{
		$this->conexao = $nova_conexao;
	}

	/* BUSCA LISTA DE TAREFAS */

function buscar_tarefas() {

	$sqlBusca = 'SELECT * FROM tarefas';
	$resultadoBusca = mysqli_query($conexao, $sqlBusca);

	$this->tarefas = array();

	while ( $tarefa = mysqli_fetch_assoc($resultadoBusca) ) {
		$this->tarefas[] = $tarefa;
	}

} // FIM BUSCAR TAREFAS

} // FIM CLASSE



?>