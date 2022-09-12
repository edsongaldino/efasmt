<?php
// Função que verifica se inscrição é de trabalkhador
function verifica_inscricao_trabalhador($codigo_participante) {
	conecta_mysql();
 	// consulta total de crisnças inscritas
	$sql_consulta = "SELECT comissao_trabalho_participante.codigo_comissao_trabalho FROM comissao_trabalho_participante WHERE codigo_participante = '".$codigo_participante."'";
	$query_consulta = mysql_query($sql_consulta) or mascara_erro_mysql($sql_consulta);
	$resultado_consulta_trabalhador = mysql_fetch_assoc($query_consulta);
    
	if($resultado_consulta_trabalhador['codigo_comissao_trabalho']){
	    return true;
	}else{
		return false;
	}
	mysql_free_result($query_consulta);
	fecha_mysql();
	
}
?>