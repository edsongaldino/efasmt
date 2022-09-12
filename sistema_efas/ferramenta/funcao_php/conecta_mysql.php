<?php
function conecta_mysql() {
	
	// conecta banco aluguelmtnacopa
	$conexao = mysql_connect(BD_HOST, BD_USUARIO, BD_SENHA) or die("Erro na conexão ".mysql_error());
	$database = BD_BANCO;
	$conecta_mysql = mysql_select_db($database, $conexao) or die("Nao foi possivel abrir o banco de dados ".mysql_error());
	
	return $conexao;
}
?>