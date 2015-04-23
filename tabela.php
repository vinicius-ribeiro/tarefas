<!--<form action="" method="post" id="form-grid" class="exibe-tarefas">-->
<table id="grid" border="1" >
	<thead>
	<tr>
		<th><input type="checkbox" name="todos" value="todos"></th>
		<th>Tarefa</th>
		<th>Descrição</th>
		<th>Prazo</th>
		<th>Prioridade</th>
		<th>Concluída</th>
		<th>Opções</th>
	</tr>
	</thead>
	<tbody>
	<?php
	foreach ( $lista_tarefas as $tarefa ) :
	?>
	<tr>
	<td>
		<input type="checkbox" name="status[]" value="1">
		<input type="hidden" name="idTarefa" value="<?php echo $tarefa['idTarefa']; ?>">
	</td>
		<td> 
		<a href="tarefa.php?idTarefa=<?php echo $tarefa['idTarefa']; ?>">
			<?php echo $tarefa['nome']; ?> 
		</a>
		</td>
		<td> <?php echo $tarefa['descricao']; ?> </td>
		<td> <?php echo traduz_data_para_exibir($tarefa['prazo']); ?> </td>
		<td> <?php echo traduz_prioridade($tarefa['prioridade']); ?> </td>
		<td> <?php echo traduz_concluida($tarefa['concluida']); ?> </td>
		<td> 
			<a href="editar.php?idTarefa=<?php echo $tarefa['idTarefa']; ?>">Editar</a>
			<a href="remover.php?idTarefa=<?php echo $tarefa['idTarefa']; ?>">Remover</a>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<td><small>Com os selecionados:</small><button>Apagar</button></td>
			<td colspan="6"></td>
		</tr>
	</tfoot>
</table>
<!--</form>-->