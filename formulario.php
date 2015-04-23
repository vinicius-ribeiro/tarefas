<form name="tarefas" method="POST">
<input type="hidden" name="idTarefa" value="<?php echo $tarefa['idTarefa']; ?>">
	<fieldset>
		<legend>Nova Tarefa:</legend>
	<ul>

	<li>
		<label for="nome">Tarefa:</label>
		
		<?php if ( $tem_erros && isset($erros_validacao['nome']) ) { ?>
			<span class="erro">
				<?php echo $erros_validacao['nome']; ?>
			</span>
		<?php } ?>
	
		<input type="text" name="nome" id="nome" class="campo" value="<?php echo $tarefa['nome']; ?>">
	</li>
	<li>
		<label for="descricao">Descrição</label>
		<textarea name="descricao" id="descricao" class="mensagem"><?php echo $tarefa['descricao']; ?></textarea>
	</li>
	<li>
		<label for="prazo">Prazo</label>
		<?php if ( $tem_erros && isset( $erros_validacao['prazo'] ) ) : ?>
			<span class="erro">
				<?php echo $erros_validacao['prazo']; ?>
			</span>
		<?php endif ?>
		<input type="text" name="prazo" id="prazo" class="campo" value="<?php echo  traduz_data_para_exibir($tarefa['prazo']); ?>">
	</li>
	<li>
		<fieldset>
			<legend>Prioridade</legend>

			<input type="radio" name="prioridade" value="1" id="prioridadeBaixa" 
			<?php 
				echo ($tarefa['prioridade'] == 1)
				? 'checked'
				: '';
			 ?>
			>
			<label for="prioridadeBaixa" class="label-inline">Baixa</label>

			<br>

			<input type="radio" name="prioridade" value="2" id="prioridadeMedia"
			<?php 
				echo ($tarefa['prioridade'] == 2) 
				? 'checked'
				: '';
			?>
			>
			<label for="prioridadeMedia" class="label-inline">Média</label>

			<br>

			<input type="radio" name="prioridade" value="3" id="prioridadeAlta"
			<?php 
				echo ($tarefa['prioridade'] == 3)
				? 'checked'
				: '';
			?>
			>
			<label for="prioridadeAlta" class="label-inline">Alta</label>				

		</fieldset>
	</li>
	<li>
		<input type="checkbox" id="concluida" name="concluida" value="1"
		<?php 
			echo ($tarefa['concluida'] == 1)
			? 'checked'
			: '';
		?>
		>
		<label for="concluida" class="label-inline">Tarefa Concluída</label>
	</li>
	<li>
		<label for="lembrete" class="label-inline">Lembrete por e-mail:</label>
		<input type="checkbox" name="lembrete" value="1" id="lembrete">
	</li>
	<button type="submit" value="cadastrar">
	<?php echo ($tarefa['idTarefa'] > 0) ? 'Atualizar' : 'Cadastrar'; ?>
	</button>
	</fieldset>
</form>