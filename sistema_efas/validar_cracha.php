<?php require_once("sistema_mod_include.php"); ?>
<?php

// codigo
$codigo_inscricao_evento = campo_form_decodifica($_GET["codigo_inscricao_evento"]);
$acao = campo_form_decodifica($_GET["acao"]);

conecta_mysql();

// inicio da transacao
$begin_transacao = true;
$query_begin = mysql_query("BEGIN");


//Valida Crachá do participante
$sql_valida_cracha_participante = "UPDATE inscricao_evento SET validacao_cracha = '".$acao."' WHERE codigo_inscricao_evento = '".$codigo_inscricao_evento."'";
$query_valida_cracha_participante = mysql_query($sql_valida_cracha_participante) or mascara_erro_mysql($sql_valida_cracha_participante,"index.php");

if($query_valida_cracha_participante) {
	$sql_log[] = $sql_valida_cracha_participante;
}else{
	$flag_erro_sql = true;
}


if(!$flag_erro_sql) {
	// fim da transacao
	$query_rollback = mysql_query("COMMIT");
	
	fecha_mysql();
		
	redireciona("participantes.php?me=".campo_form_codifica(0,true)."&mm=".campo_form_codifica("Impressão do crachá validada!"));
} else {
	// fim da transacao
	$query_rollback = mysql_query("ROLLBACK");
	
	fecha_mysql();
	
	redireciona("participantes.php?me=".campo_form_codifica(1,true)."&mm=".campo_form_codifica("Não foi possível validar a inscrição!"));
}

?>