<?php include 'banco.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Relatório de Anexos</title>
</head>
<body>
	<form action="" method="post">
		<label for="">Tipo do anexo</label>
		<select name="tipoAnexo" id="">
			<option value="pdf">PDF</option>
			<option value="zip">ZIP</option>
		</select>
		<button type="submit">Gerar Relatorio</button>
	</form>

<?php 

if (tem_post()) 
{

	$tipoAnexo = $_POST['tipoAnexo'];

	echo "<script>alert('Tipo de anexo escolhido: ".$tipoAnexo."');</script>";

	$resultadoRelatorio = array();

	//$resultadoRelatorio = gera_relatorio_anexos($conexao);

	


}

?>


</body>
</html>