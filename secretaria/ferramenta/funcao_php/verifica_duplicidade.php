<?php
// Função para verificar duplicidade de dados antes de gravar
function verifica_duplicidade($tabela, $campo, $valor) {
	
	// SQL duplicidade
	$sql_duplicidade = "SELECT * FROM $tabela WHERE $campo = '".$valor."' LIMIT 1";
	$query_duplicidade = mysql_query($sql_duplicidade) or mascara_erro_mysql($sql_duplicidade,"index.php");
	$resultado_duplicidade = mysql_fetch_assoc($query_duplicidade);
	
	
	if($resultado_duplicidade) {
		return true;
	} else {
		return false;
	}
}
?>