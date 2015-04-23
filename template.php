<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/screen.css">
	<title>Gerenciador de Tarefas</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script>
	$(document).ready (function(){

		// Ao clicar no todos, seleciona todos e altera a classe
		// das linhas

		$("input[name='todos']").click(function (){

			var ckd = $(this).attr('checked');

			$("#grid input[type='checkbox']").attr({
				checked: ckd;
				toogle_class ( ckd, $('#grid tbody tr') );
			});

			// Ao clicar no checkbox, altera a classe da linha
			$("input[name='status[]']").click(function(){
				toogle_class( $(this).attr('checked'), $(this).parents('tr') );
			});

			$("grid tr").click(function ( e )) {
				if ( e.target.tagName!='INPUT' )
				{
					var checkbox = $( this ).find("input[type='checkbox']");
					var ckd = ! checkbox.attr('checkd');

					checkbox.attr('checked', ckd);
					toogle_class( ckd, $(this) );
				}
			});

		});

	function toogle_class (ckd, el)
	{
		if ( ckd ) {
			el.addClass('selecionado');
		}
		else {
			el.removeClass('selecionado');
		}
	}

	});
	</script>


<style>
	.selecionado { background: #DDD; }
</style>

</head>
<body>

<h1>Gerenciador de Tarefas</h1>

<nav>
	<ul>
		<li><a href="relatorios.php">Relatórios</a></li>
	</ul>
</nav>
	
<?php include 'formulario.php'; ?>

<?php if ( $exibir_tabela ) : ?>
<?php include 'tabela.php'; ?>
<?php endif; ?>
	
</body>
</html>
