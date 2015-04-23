<?php 

function traduz_prioridade ($codigoPrioridade) {

	$prioridade = '';

	switch ($codigoPrioridade) {
		case 1:
			$prioridade = 'Baixa';
		break;
		
		case 2:
			$prioridade = 'Média';
		break;

		case 3:
			$prioridade = 'Alta';
		break;
	}

	return $prioridade;

} // TRADUZ PRIORIDADE

function traduz_data_para_banco ( $data ) {

	if ($data == "") {
		return "";
	}

	if (validar_data($data)) {
		$dados = explode("/", $data);

		$data_mysql = "{$dados[2]}-{$dados[1]}-{$dados[0]}";

		return $data_mysql;
	}

} // TRADUZ DATA PARA BANCO

function traduz_data_para_exibir ($data) {

	if ( $data == "" || $data == "0000-00-00" ) {
		return "";
	}

	$dados = explode("-", $data);
	$data_exibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";
	return $data_exibir;		

} // FIM TRADUZ DATA PARA EXIBIR

function traduz_concluida ($concluida) {

	if ($concluida) {
		return "Sim";
	}
	else {
		return "Não";
	}

} // FIM TRADUZ CONCLUIDA

function tem_post()
{
	if (count($_POST)  > 0) {
		return true;
	}
	else {
		return false;
	}
} //FIM TEM POST


function validar_data($data) {

	$padrao = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
	$resultado = preg_match($padrao, $data);

	if ( !$resultado ) {
		return false;
	}

	$dados = explode('/', $data);

	$dia = $dados[0];
	$mes = $dados[1];
	$ano = $dados[2];

	$resultado = checkdate($mes, $dia, $ano);

	return $resultado;

} // FIM VALIDAR DATA


function tratar_anexo ( $anexo ) {

	$padrao = '/^.+(\.pdf|\.zip)$/';
	$resultado = preg_match($padrao, $anexo['name']);

	if ( !$resultado ) {
		return false;
	}

	move_uploaded_file($anexo['tmp_name'], "anexos/{$anexo['name']}");

	return true;

} // FIM TRATAR ANEXO

function enviar_email($tarefa, $anexos = array())
{
	include 'bibliotecas/PHPMailer/PHPMailerAutoload.php';

	$corpo = preparar_corpo_email($tarefa, $anexos);	

	//Acessar o sistema de emails
	//Fazer a autenticação com usuario  senha
	//Usar opção para escrever o email

	$email = new PHPMailer();

	$email ->isSMTP();
	$emai ->Host = "smtp.gmail.com";
	$email ->Port = 587;
	$email ->SMTPSecure = 'tls';
	$email ->SMTPAuth = true;
	$email ->Username = 'meuemailaqui@email.com';
	$email ->Password = 'senha';
	$email ->setFrom('meuemailaqui@email.com', 'Avisador de Tarefas');

	//Digitar o email do destinatario
	$email ->addAddress(EMAIL_NOTIFICACAO);

	//Digitar o assunto do email
	$email ->Subject = "Aviso de tarefa: {$tarefa['nome']}";

	//Escrever o corpo do email
	$corpo = preparar_corpo_email($tarefa, $anexos);
	$email->msgHTML($corpo);

	//Adicionar os anexos quando necessário
	foreach($anexos as $anexo) {
		$email->addAttachment("anexos/{$anexo['arquivo']}");
	}
	
	//Usar a opção de enviar o email
	$email-> send();

} // FIM ENVIAR EMAIL


function preparar_corpo_email ($tarefa, $anexos)
{
	//Aqui entra o conteudo processado pela pagina template_email.php
	//Fala para o PHP para nao enviar o processamentoo para o navegador
	ob_start();

	//Incluir o arquivo template_email.php
	include 'template_email.php';

	//Guardar conteúdo do arquivo em uma variavel
	$corpo = ob_get_contents();

	//Falar para o php que ele pode voltar a mandar conteudos para o navegador.
	ob_end_clean();

	return $corpo;
}


?>