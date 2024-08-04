<?php
function conecta_mysql() {
	// conecta banco aluguelmtnacopa
	$conexao = mysqli_connect(BD_HOST, BD_USUARIO, BD_SENHA, BD_BANCO);
	return $conexao;
}
?>