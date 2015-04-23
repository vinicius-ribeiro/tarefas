<?php 

include 'functions.php';
include 'banco.php';

if (isset($_GET['Relatorio'])) 
{
	
	$relatorioEscolhido = $_GET['Relatorio'];

	if ($relatorioEscolhido == 'anexos') 
	{
		include 'relatorio_anexos.php';
	}
	else if ($relatorioEscolhido == 'tarefas')
	{
		include 'relatorio_tarefas.php';
	}

}


?>