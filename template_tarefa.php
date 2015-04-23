<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Gerenciador de Tarefas</title>
	<link rel="stylesheet" href="css/screen.css">
</head>
<body>
	<h1>Tarefa: <?php echo $tarefa['nome']; ?></h1>
	<p>
		<a href="tarefas.php">Voltar para a lista de tarefas.</a>
	</p>
	<p>
		<strong>Concluída</strong>
		<?php echo traduz_concluida($tarefa['concluida']); ?>
	</p>
	<p>
		<strong>Descrição</strong>
		<?php echo nl2br($tarefa['descricao']); ?>
	</p>
	<p>
		<strong>Prazo</strong>
		<?php echo traduz_data_para_exibir($tarefa['prazo']); ?>
	</p>
	<p>
		<strong>Prioridade</strong>
		<?php echo traduz_prioridade($tarefa['prioridade']); ?>
	</p>
	<h2>Anexos:</h2>
	<!-- Lista de anexos -->
	
	<?php if ( count( $anexos ) > 0 ) { ?>
	
		<table border="1" class="lista-anexos">
			<tr>
				<th>Arquivo</th>
				<th>Opções</th>
			</tr>
			<?php foreach ( $anexos as $anexo ) : ?>
			<tr>
				<td><?php echo $anexo['nome']; ?></td>
				<td>
					<a href="anexos/<?php echo $anexo['arquivo']; ?>">Download</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>

	<?php 
		
	} // fim if (existem anexos)

	else {
	?>
	<br>
	<p>Não existem anexos cadastradas nessa tarefa.</p>
	<br>
	<?php } ?>

	<!-- Fomulario para um novo anexo -->
	<form action="" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend>Novo Anexo</legend>
			
			<input type="hidden" name="tarefa_id" value="<?php echo $tarefa['idTarefa']; ?>">

			<label for="">
				<?php if ( $tem_erros && isset( $erros_validacao['anexo'] )) : ?>
				<span class="erro">
					<?php echo $erros_validacao['anexo']; ?>
				</span>	
				<?php endif; ?>
			</label>
			<input type="file" name="anexo">
			<br>
			<br>
			<button type="submit">Cadastrar</button>
		</fieldset>
	</form>
</body>
</html>