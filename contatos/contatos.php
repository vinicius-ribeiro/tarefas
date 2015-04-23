<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Gerenciador de Contatos</title>
</head>
<body>

<h1>Gerenciador de contatos</h1>

	<form name="tarefas">
		<fieldset>
			<legend>Nova contato:</legend>

			<label for="nome">Nome:</label>
			<input type="text" name="nome" id="nome">

			<br>

			<label for="telefone">Telefone</label>
			<input type="text" name="telefone" id="telefone">

			<br>

			<label for="email">E-mail</label>
			<input type="text" name="email" id="email">

			<button type="submit" value="cadastrar">Enviar</button>
		</fieldset>
	</form>

<?php 

if ( isset( $_GET['nome'] ) && isset( $_GET['telefone'] ) && isset( $_GET['email'] ) ) 
{
	$_SESSION['lista_contatos'][] = $_GET['nome'];
	$_SESSION['lista_contatos'][] = $_GET['telefone'];
	$_SESSION['lista_contatos'][] = $_GET['email'];
}

$lista_contatos = array();

if ( isset( $_SESSION['lista_contatos'] ) ) 
{
	$lista_contatos = $_SESSION['lista_contatos'];
}

?>

<table border="1">
	<tr>
		<th>Contatos</th>
	</tr>
	<?php 
		foreach ( $lista_contatos as $contato ) :
	?>
	<tr>
		<td> <?php echo $contato; ?> </td>
		
	</tr>
	<br>	
	<?php endforeach; ?>
</table>

</body>
</html>
