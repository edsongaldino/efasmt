<?php include("sistema_mod_include.php"); ?>
<?php

// Inclui o arquivo class.phpmailer.php localizado na pasta class
require_once("ferramenta/PHPMailer/class.phpmailer.php");

if($_POST['acao']){

	if(campo_form_decodifica($_POST['acao']) == "gravar_participante_crianca") {
		
		// dados participanteis
		$nome_participante							= protege_campo($_POST['nome_participante']);
		$nome_participante_cracha					= protege_campo($_POST['nome_participante_cracha']);
		$data_nascimento_participante 				= protege_campo(converte_data_ingles($_POST['data_nascimento_participante']));
		$cidade_participante 						= protege_campo($_POST['cidade_participante']);
		$centro_espirita_participante 				= protege_campo($_POST['centro_espirita_participante']);
		
		// dados responsável
		$nome_responsavel							= protege_campo($_POST['nome_responsavel']);
		$telefone_responsavel 						= protege_campo($_POST['telefone_responsavel']);
		$observacoes_crianca			 			= protege_campo($_POST['observacoes_crianca']);
		$grau_parentesco_responsavel			 	= protege_campo($_POST['grau_parentesco']);

	
		conecta_mysql();
		
		mysql_query("BEGIN");
		
		// inclui participante
		$sql_inclui_participante = "INSERT INTO participante (codigo_cidade, data_nascimento_participante, nome_participante, nome_participante_cracha, centro_espirita_participante) VALUES ('".$cidade_participante."', '".$data_nascimento_participante."','".$nome_participante."','".$nome_participante_cracha."','".$centro_espirita_participante."')";
		$query_inclui_participante = mysql_query($sql_inclui_participante) or mascara_erro_mysql($sql_inclui_participante,"index.php");
		$codigo_participante = mysql_insert_id();
		
		// inclui dados complementares
		$sql_inclui_dados_complementares = "INSERT INTO dados_complementares (codigo_participante, nome_responsavel, telefone_responsavel, observacoes_crianca, grau_parentesco_responsavel) VALUES ('".$codigo_participante."', '".$nome_responsavel."','".$telefone_responsavel."','".$observacoes_crianca."', '".$grau_parentesco_responsavel."')";
		$query_inclui_dados_complementares = mysql_query($sql_inclui_dados_complementares) or mascara_erro_mysql($sql_inclui_dados_complementares,"index.php");
		
		$data_atual = date("Y-m-d");
		// inclui participante ao evento
		$sql_inclui_usuario_participante = "INSERT INTO inscricao_evento (codigo_evento, codigo_participante, codigo_situacao_inscricao, valor_inscricao_evento, data_inscricao_evento, tipo_inscricao) VALUES ('9', '".$codigo_participante."', '1', '12.50', '".$data_atual."', 'C')";
		$query_inclui_usuario_participante = mysql_query($sql_inclui_usuario_participante) or mascara_erro_mysql($sql_inclui_usuario_participante,"index.php");
		$codigo_inscricao_evento = mysql_insert_id();
		
		// inclui curso participante
		for($i=0;$i<count($_POST['curso_crianca']);$i++){
			
		$sql_inclui_curso_participante = "INSERT INTO participante_evento_curso (codigo_participante, codigo_evento, codigo_curso) VALUES ('".$codigo_participante."','9', '".protege_campo($_POST['curso_crianca'][$i])."')";
		$query_inclui_curso_participante = mysql_query($sql_inclui_curso_participante) or mascara_erro_mysql($sql_inclui_curso_participante,"index.php");
		
		}
		
		if($query_inclui_participante && $query_inclui_dados_complementares && $query_inclui_usuario_participante && $query_inclui_curso_participante){

			mysql_query("COMMIT");
			fecha_mysql();
			redireciona("confirma_inscricao.php?tipo=".campo_form_codifica(1,true)."&codigo_inscricao_evento=".campo_form_codifica($codigo_inscricao_evento,true)."&me=".campo_form_codifica(0,true)."&mm=".campo_form_codifica("Inscrição realizada! veja abaixo."));
			
		} else {

			mysql_query("ROLLBACK");	
			fecha_mysql();
			redireciona("inscricao_crianca.php?me=".campo_form_codifica(1,true)."&mm=".campo_form_codifica("Ocorreram erros e a inscrição não foi realizada. Tente novamente!"));

		}

	}

	if(campo_form_decodifica($_POST['acao']) == "gravar_participante_adulto") {
		
		//dados participanteis
		$nome_participante							= protege_campo($_POST['nome_participante']);
		$nome_participante_cracha					= protege_campo($_POST['nome_participante_cracha']);
		$data_nascimento_participante 				= protege_campo(converte_data_ingles($_POST['data_nascimento_participante']));
		$cidade_participante 						= protege_campo($_POST['cidade_participante']);
		$centro_espirita_participante 				= protege_campo($_POST['centro_espirita_participante']);
		
		$telefone_participante						= protege_campo(limpa_campo($_POST['telefone_participante']));
		$email_participante							= protege_campo($_POST['email_participante']);

		
		conecta_mysql();
		mysql_query("BEGIN");
		
		// inclui participante
		$sql_inclui_participante = "INSERT INTO participante (codigo_cidade, data_nascimento_participante, nome_participante, nome_participante_cracha, centro_espirita_participante) VALUES ('".$cidade_participante."', '".$data_nascimento_participante."','".$nome_participante."','".$nome_participante_cracha."','".$centro_espirita_participante."')";
		$query_inclui_participante = mysql_query($sql_inclui_participante) or mascara_erro_mysql($sql_inclui_participante,"index.php");
		$codigo_participante = mysql_insert_id();
		
		// inclui telefone
		$sql_inclui_telefone_participante = "INSERT INTO telefone_participante (codigo_participante, numero_telefone_participante) VALUES ('".$codigo_participante."', '".$telefone_participante."')";
		$query_inclui_telefone_participante = mysql_query($sql_inclui_telefone_participante) or mascara_erro_mysql($sql_inclui_telefone_participante,"index.php");
		
		// inclui email
		$sql_inclui_email_participante = "INSERT INTO email_participante (codigo_participante, descricao_email_participante) VALUES ('".$codigo_participante."', '".$email_participante."')";
		$query_inclui_email_participante = mysql_query($sql_inclui_email_participante) or mascara_erro_mysql($sql_inclui_email_participante,"index.php");
		
		// inclui curso participante
		for($i=0;$i<count($_POST['curso_participante']);$i++){
			
			$sql_inclui_curso_participante = "INSERT INTO participante_evento_curso (codigo_participante, codigo_evento, codigo_curso) VALUES ('".$codigo_participante."','9', '".protege_campo($_POST['curso_participante'][$i])."')";
			$query_inclui_curso_participante = mysql_query($sql_inclui_curso_participante) or mascara_erro_mysql($sql_inclui_curso_participante,"index.php");
		
		}
		
		$data_atual = date("Y-m-d");
		
		// inclui participante ao evento
		$sql_inclui_usuario_participante = "INSERT INTO inscricao_evento (codigo_evento, codigo_participante, codigo_situacao_inscricao, valor_inscricao_evento, data_inscricao_evento, tipo_inscricao) VALUES ('9', '".$codigo_participante."', '1', '25,00', '".$data_atual."', 'A')";
		$query_inclui_usuario_participante = mysql_query($sql_inclui_usuario_participante) or mascara_erro_mysql($sql_inclui_usuario_participante,"index.php");
		$codigo_inscricao_evento = mysql_insert_id();
		

		if($query_inclui_participante && $query_inclui_telefone_participante && $query_inclui_email_participante && $query_inclui_curso_participante && $query_inclui_usuario_participante){
			mysql_query("COMMIT");

			$destino = $email_participante;
			$assunto = utf8_decode("Inscrição Realizada com Sucesso (EFAS 2022) Várzea Grande");
			$link_redirect = "https://efas.euripedesbarsanulfo.org.br/confirma_inscricao.php?tipo=".campo_form_codifica(2,true)."&codigo_inscricao_evento=".campo_form_codifica($codigo_inscricao_evento,true)."";
			require_once("email.php");

			envia_email($destino, $nome_participante, $assunto, $corpo_mensagem);

			fecha_mysql();
			redireciona("confirma_inscricao.php?tipo=".campo_form_codifica(2,true)."&codigo_inscricao_evento=".campo_form_codifica($codigo_inscricao_evento,true)."&me=".campo_form_codifica(0,true)."&mm=".campo_form_codifica("Inscrição realizada! veja abaixo."));
			
		} else {	
			mysql_query("ROLLBACK");
			fecha_mysql();
			redireciona("inscricao_adulto.php?me=".campo_form_codifica(1,true)."&mm=".campo_form_codifica("Ocorreram erros e a inscrição não foi realizada. Tente novamente!"));
		}
	}

	if(campo_form_decodifica($_POST['acao']) == "gravar_participante_jovem") {
		
		// dados participanteis
		$nome_participante							= protege_campo($_POST['nome_participante']);
		$nome_participante_cracha					= protege_campo($_POST['nome_participante_cracha']);
		$data_nascimento_participante 				= protege_campo(converte_data_ingles($_POST['data_nascimento_participante']));
		$cidade_participante 						= protege_campo($_POST['cidade_participante']);
		$centro_espirita_participante 				= protege_campo($_POST['centro_espirita_participante']);
		
		$telefone_participante						= protege_campo(limpa_campo($_POST['telefone_participante']));
		$email_participante							= protege_campo($_POST['email_participante']);

		
		conecta_mysql();
			
		mysql_query("BEGIN");
		
		// inclui participante
		$sql_inclui_participante = "INSERT INTO participante (codigo_cidade, data_nascimento_participante, nome_participante, nome_participante_cracha, centro_espirita_participante) VALUES ('".$cidade_participante."', '".$data_nascimento_participante."','".$nome_participante."','".$nome_participante_cracha."','".$centro_espirita_participante."')";
		$query_inclui_participante = mysql_query($sql_inclui_participante) or mascara_erro_mysql($sql_inclui_participante,"index.php");
		$codigo_participante = mysql_insert_id();
		
		// inclui telefone
		$sql_inclui_telefone_participante = "INSERT INTO telefone_participante (codigo_participante, numero_telefone_participante) VALUES ('".$codigo_participante."', '".$telefone_participante."')";
		$query_inclui_telefone_participante = mysql_query($sql_inclui_telefone_participante) or mascara_erro_mysql($sql_inclui_telefone_participante,"index.php");
		
		// inclui email
		$sql_inclui_email_participante = "INSERT INTO email_participante (codigo_participante, descricao_email_participante) VALUES ('".$codigo_participante."', '".$email_participante."')";
		$query_inclui_email_participante = mysql_query($sql_inclui_email_participante) or mascara_erro_mysql($sql_inclui_email_participante,"index.php");
		
		// inclui curso participante
		for($i=0;$i<count($_POST['curso_participante']);$i++){
			
		$sql_inclui_curso_participante = "INSERT INTO participante_evento_curso (codigo_participante, codigo_evento, codigo_curso) VALUES ('".$codigo_participante."','9', '".protege_campo($_POST['curso_participante'][$i])."')";
		$query_inclui_curso_participante = mysql_query($sql_inclui_curso_participante) or mascara_erro_mysql($sql_inclui_curso_participante,"index.php");
		
		}
		
		$data_atual = date("Y-m-d");
		
		// inclui participante ao evento
		$sql_inclui_usuario_participante = "INSERT INTO inscricao_evento (codigo_evento, codigo_participante, codigo_situacao_inscricao, valor_inscricao_evento, data_inscricao_evento, tipo_inscricao) VALUES ('9', '".$codigo_participante."', '1', '12.50', '".$data_atual."', 'J')";
		$query_inclui_usuario_participante = mysql_query($sql_inclui_usuario_participante) or mascara_erro_mysql($sql_inclui_usuario_participante,"index.php");
		$codigo_inscricao_evento = mysql_insert_id();
		

		if($query_inclui_participante && $query_inclui_telefone_participante && $query_inclui_email_participante && $query_inclui_curso_participante && $query_inclui_usuario_participante){

			mysql_query("COMMIT");

			$destino = $email_participante;
			$assunto = utf8_decode("inscrição realizada (EFAS 2022)");
			$link_redirect = "https://efas.euripedesbarsanulfo.org.br/confirma_inscricao.php?tipo=".campo_form_codifica(2,true)."&codigo_inscricao_evento=".campo_form_codifica($codigo_inscricao_evento,true)."";
			require_once("email.php");

			envia_email($destino, $nome_participante, $assunto, $corpo_mensagem);

			fecha_mysql();
			redireciona("confirma_inscricao.php?tipo=".campo_form_codifica(2,true)."&codigo_inscricao_evento=".campo_form_codifica($codigo_inscricao_evento,true)."&me=".campo_form_codifica(0,true)."&mm=".campo_form_codifica("Inscrição realizada! veja abaixo."));
			
		} else {	
			mysql_query("ROLLBACK");
			fecha_mysql();
			redireciona("inscricao_jovem.php?me=".campo_form_codifica(1,true)."&mm=".campo_form_codifica("Ocorreram erros e a inscrição não foi realizada. Tente novamente!"));
		}
	}

	if(campo_form_decodifica($_POST['acao']) == "gravar_participante_trabalhador") {
		
		// dados participanteis
		$nome_participante							= protege_campo($_POST['nome_participante']);
		$nome_participante_cracha					= protege_campo($_POST['nome_participante_cracha']);
		$data_nascimento_participante 				= protege_campo(converte_data_ingles($_POST['data_nascimento_participante']));
		$cidade_participante 						= protege_campo($_POST['cidade_participante']);
		$centro_espirita_participante 				= protege_campo($_POST['centro_espirita_participante']);
		
		$telefone_participante						= protege_campo(limpa_campo($_POST['telefone_participante']));
		$email_participante							= protege_campo($_POST['email_participante']);

		
		conecta_mysql();
		
		mysql_query("BEGIN");
		
		// inclui participante
		$sql_inclui_participante = "INSERT INTO participante (codigo_cidade, data_nascimento_participante, nome_participante, nome_participante_cracha, centro_espirita_participante) VALUES ('".$cidade_participante."', '".$data_nascimento_participante."','".$nome_participante."', '".$nome_participante_cracha."','".$centro_espirita_participante."')";
		$query_inclui_participante = mysql_query($sql_inclui_participante) or mascara_erro_mysql($sql_inclui_participante,"index.php");
		$codigo_participante = mysql_insert_id();
		
		// inclui telefone
		$sql_inclui_telefone_participante = "INSERT INTO telefone_participante (codigo_participante, numero_telefone_participante) VALUES ('".$codigo_participante."', '".$telefone_participante."')";
		$query_inclui_telefone_participante = mysql_query($sql_inclui_telefone_participante) or mascara_erro_mysql($sql_inclui_telefone_participante,"index.php");
		
		// inclui email
		$sql_inclui_email_participante = "INSERT INTO email_participante (codigo_participante, descricao_email_participante) VALUES ('".$codigo_participante."', '".$email_participante."')";
		$query_inclui_email_participante = mysql_query($sql_inclui_email_participante) or mascara_erro_mysql($sql_inclui_email_participante,"index.php");
		
		// inclui participante à comissão
		for($i=0;$i<count($_POST['comissao_trabalho']);$i++){
			
		$sql_inclui_participante_comissao = "INSERT INTO comissao_trabalho_participante (codigo_comissao_trabalho, codigo_participante) VALUES ('".protege_campo($_POST['comissao_trabalho'][$i])."', '".$codigo_participante."')";
		$query_inclui_participante_comissao = mysql_query($sql_inclui_participante_comissao) or mascara_erro_mysql($sql_inclui_participante_comissao,"index.php");
		
		}
		
		$data_atual = date("Y-m-d");
		
		// inclui participante ao evento
		$sql_inclui_usuario_participante = "INSERT INTO inscricao_evento (codigo_evento, codigo_participante, codigo_situacao_inscricao, valor_inscricao_evento, data_inscricao_evento, tipo_inscricao) VALUES ('9', '".$codigo_participante."', '1', '25,00', '".$data_atual."', 'T')";
		$query_inclui_usuario_participante = mysql_query($sql_inclui_usuario_participante) or mascara_erro_mysql($sql_inclui_usuario_participante,"index.php");
		$codigo_inscricao_evento = mysql_insert_id();
		
		
		if($query_inclui_participante && $query_inclui_telefone_participante && $query_inclui_email_participante && $query_inclui_participante_comissao && $query_inclui_usuario_participante){
			mysql_query("COMMIT");

			$destino = $email_participante;
			$assunto = utf8_decode("inscrição realizada (EFAS VG 2019)");
			$link_redirect = "https://efas.euripedesbarsanulfo.org.br/confirma_inscricao.php?tipo=".campo_form_codifica(2,true)."&codigo_inscricao_evento=".campo_form_codifica($codigo_inscricao_evento,true)."";
			require_once("email.php");

			envia_email($destino, $nome_participante, $assunto, $corpo_mensagem);

			fecha_mysql();
			redireciona("confirma_inscricao.php?tipo=".campo_form_codifica(2,true)."&codigo_inscricao_evento=".campo_form_codifica($codigo_inscricao_evento,true)."&me=".campo_form_codifica(0,true)."&mm=".campo_form_codifica("Inscrição realizada! veja abaixo."));
			
		} else {	
			mysql_query("ROLLBACK");
			fecha_mysql();
			redireciona("inscricao_trabalhador.php?me=".campo_form_codifica(1,true)."&mm=".campo_form_codifica("Ocorreram erros e a inscrição não foi realizada. Tente novamente!"));
		}
	}
}else{
	redireciona("inscricao.php?me=".campo_form_codifica(1,true)."&mm=".campo_form_codifica("Por favor, preencha o formulário de inscrição!"));	
}
?>