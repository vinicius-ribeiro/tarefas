<?php 

include 'config.php';
include 'banco.php';
include 'functions.php';

$tem_erros = false;
$erros_validacao = array();

if ( tem_post() ) {

	//UPLOAD DE ANEXOS

	$tarefa_id = $_POST['tarefa_id'];

	if ( !isset($_FILES['anexo']) ) {
		
		$tem_erros = true;
		$erros_validacao['anexo'] = 'Você deve selecionar um arquivo para anexar.';
	
	} // FIM IF VERIFICAÇÃO DE ANEXO
	else {

		if ( tratar_anexo($_FILES['anexo']) ) {
			$anexo = array();
			$anexo['tarefa_id'] = $tarefa_id;
			$anexo['nome'] = $_FILES['anexo']['name'];
			$anexo['arquivo'] = $_FILES['anexo']['name'];
		}
		else {
			$tem_erros = true;
			$erros_validacao['anexo'] = 'Envie apenas anexos no formato zip ou pdf.';
		}

	} //FIM ELSE VALIDAÇÃO


	if ( !$tem_erros ) {
		gravar_anexo($conexao, $anexo);
	}

}

$tarefa = buscar_tarefa($conexao, $_GET['idTarefa']);
$anexos = buscar_anexos($conexao, $_GET['idTarefa']);
include "template_tarefa.php";

?>