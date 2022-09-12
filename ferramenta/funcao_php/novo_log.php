<?php
function novo_log($codigo_usuario,$codigo_tipo_log,$descricao,$comando) {
	
	$codigo_usuario = $codigo_usuario;
	$codigo_tipo_log = $codigo_tipo_log;
	$descricao = $descricao;
	$comando = protege_campo($comando);
	
	// novo log
	$sql_novo = "INSERT INTO log (codigo_usuario,codigo_tipo_log,ip_log,data_log,hora_log,operacao_log,comando_log) VALUES ('".$codigo_usuario."','".$codigo_tipo_log."','".$_SERVER["REMOTE_ADDR"]."','".date("Ymd")."','".date("His", time())."','".$descricao."','".$comando."')";
	$query_novo = mysql_query($sql_novo);// or mascara_erro_mysql($sql_novo)
	$codigo_log = mysql_insert_id();
	
}
?>