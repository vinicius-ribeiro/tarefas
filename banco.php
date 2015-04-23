<?php 

$conexao = mysqli_connect(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);

if ( mysqli_connect_errno( $conexao ) ) {
	echo "Ocorreu um erro ao conectar no banco de dados.";
	die();
}


/*******************
FUNÇÕES DE COMUNICAÇÃO COM O BANCO DE DADOS
*******************/

/* BUSCA LISTA DE TAREFAS */

function buscar_tarefas($conexao) {

	$sqlBusca = 'SELECT * FROM tarefas';
	$resultadoBusca = mysqli_query($conexao, $sqlBusca);

	$tarefas = array();

	while ( $tarefa = mysqli_fetch_assoc($resultadoBusca) ) {
		$tarefas[] = $tarefa;
	}

	return $tarefas;

}

/* GRAVA TAREFA NO BANCO */

function gravar_tarefa ($conexao, $tarefa)
{
	$sqlGravar = "
		INSERT INTO tarefas (nome, descricao, prioridade, prazo, concluida)
		VALUES (
			'{$tarefa['nome']}',
			'{$tarefa['descricao']}',
			'{$tarefa['prioridade']}',
			'{$tarefa['prazo']}',
			'{$tarefa['concluida']}'
		)
	";

	mysqli_query($conexao, $sqlGravar);

}


/* BUSCA TAREFA NO BANCO PARA EDIÇÃO */

function buscar_tarefa ( $conexao, $id )
{

	$sqlBusca = 'SELECT * FROM tarefas WHERE idTarefa = ' . $id;	
	$resultadoBusca = mysqli_query($conexao, $sqlBusca);
	return mysqli_fetch_assoc($resultadoBusca);

}

function editar_tarefa ($conexao, $tarefa)
{

	$sqlEditar = "		
		UPDATE tarefas SET
			nome = '{$tarefa['nome']}',
			descricao = '{$tarefa['descricao']}',
			prioridade = '{$tarefa['prioridade']}',
			prazo = '{$tarefa['prazo']}',
			concluida = {$tarefa['concluida']}
		WHERE idTarefa = {$tarefa['idTarefa']}
	";


	$finalizado = mysqli_query($conexao, $sqlEditar);

	if ($finalizado)
	{
		/*echo "
			<script>
			alert('Tarefa modificada com sucesso!');
			window.location.href('tarefas.php');
			</script>
		";*/
		header("Location: tarefas.php");
		die();
	}
	else
	{
		echo "
			<script>
			alert('Erro ao editar tarefa.');
			</script>
		";
	}

}

function remover_tarefa ($conexao, $id) 
{

	$sqlRemover = "DELETE FROM tarefas WHERE idTarefa = {$id}";

	mysqli_query($conexao, $sqlRemover);

} //FIM REMOVER TAREFA

function gravar_anexo ( $conexao, $anexo ) 
{
	$sqlGravar = "INSERT INTO anexos (tarefa_id, nome, arquivo)
	VALUES (
		'{$anexo['tarefa_id']}',
		'{$anexo['nome']}',
		'{$anexo['arquivo']}'
	)
	";

	mysqli_query( $conexao, $sqlGravar );

	echo "<script>alert('entrou aqui!');</script>";


}

function buscar_anexos ( $conexao, $tarefa_id )
{
	$sqlBusca = "SELECT * FROM anexos WHERE tarefa_id = {$tarefa_id}";
	$resultadoBusca = mysqli_query( $conexao, $sqlBusca );

	$anexos = array();

	while ( $anexo = mysqli_fetch_assoc( $resultadoBusca ) ) {
		$anexos[] = $anexo;
	}

	return $anexos;

} // FIM BUSCAR ANEXOS

function gera_relatorio_anexos ( $conexao )
{	

	$sqlRelatorio = "SELECT * FROM anexos WHERE (nome like '%".$tipoAnexo."%')";

	$resultadoRelatorio = mysqli_query( $conexao, $sqlRelatorio );

	$relatorios = array();

	while ( $relatorio = mysqli_fetch_assoc ( $resultadoRelatorio ) ) 
	{
		$relatorios[] = $relatorio;
	}

	return $relatorios;

}

 ?>
