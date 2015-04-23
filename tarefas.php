<?php 

session_start();

include 'config.php';
include 'banco.php';
include 'functions.php';

$exibir_tabela = true;

$tem_erros = false;
$erros_validacao = array();

$tarefa = array();

	if ( tem_post() ) {


	//VERIFICAÇÃO DE VARIAVEIS RECEBIDAS DO FORMULARIO

	if (isset($_POST['nome']) && strlen($_POST['nome']) > 0 ) {
		$tarefa['nome'] = $_POST['nome'];
	}
	else {
		$tem_erros = true;
		$erros_validacao['nome'] = 'O nome da tarefa é obrigatório!';
	}

	$tarefa['nome'] = $_POST['nome'];
	

	if (isset($_POST['descricao'])) {			
		$tarefa['descricao'] = $_POST['descricao'];
	}
	else {
		$tarefa['descricao'] = '';
	}

	if (isset($_POST['prazo']) && strlen( $_POST['prazo'] ) > 0 ) {

		if ( validar_data($_POST['prazo']) ) {
			$tarefa['prazo'] = traduz_data_para_banco($_POST['prazo']);
		}
		else {
			$tem_erros = true;
			$erros_validacao['prazo'] = 'O prazo informado não é uma data válida!';
		}
		
	}
	else
	{
		$tarefa['prazo'] = "";
	}


	$tarefa['prioridade'] = $_POST['prioridade'];

	if (isset($_POST['concluida'])) 
	{
		$tarefa['concluida'] = 1;
	}
	else 
	{
		$tarefa['concluida'] = 0;
	}
	

	/*******************
	// SE NÃO TIVER ERROS GRAVA NO BANCO
	*******************/

	if ( !$tem_erros ) {
		gravar_tarefa($conexao, $tarefa);

		if ( isset($_POST['lembrete']) && $_POST['lembrete'] == '1' ) {
			enviar_email( $tarefa );
		}

		header("Location: tarefas.php");
		die();
	}	

	}
	

	/*if (isset($_SESSION['lista_tarefas']))
	{
		$lista_tarefas = $_SESSION['lista_tarefas'];
	}
	else {
		$lista_tarefas = array();
	}*/

	$lista_tarefas = buscar_tarefas($conexao);


	$tarefa = array (
		'idTarefa' => 0,

		'nome' => (isset($_POST['nome'])) ? $_POST['nome'] : '',

		'descricao' => (isset($_POST['descricao'])) ? $_POST['descricao'] : '',

		'prazo' => isset($_POST['prazo']) ? traduz_data_para_banco($_POST['prazo']) : '',

		'prioridade' => (isset($_POST['prioridade'])) ? $_POST['prioridade'] : 1,

		'concluida' => (isset($_POST['concluida'])) ? $_POST['concluida'] : ''
	);


	include 'template.php';


?>
