<?php
// Função para converte valores para o padrão brasileiro REAL
function calcula_total_inscritos($tipo) {
 	conecta_mysql();

    // consulta total de crisnças inscritas
	$sql_consulta = "SELECT count(inscricao_evento.codigo_participante) AS total_inscritos
						FROM inscricao_evento
					 WHERE inscricao_evento.codigo_evento = '".$_SESSION["codigo_evento_acesso"]."' AND inscricao_evento.tipo_inscricao = '$tipo'";
	$query_consulta = mysql_query($sql_consulta) or mascara_erro_mysql($sql_consulta);
	$resultado_consulta_cursos = mysql_fetch_assoc($query_consulta);
	$total_inscritos = $resultado_consulta_cursos['total_inscritos'];
	
	
	mysql_free_result($query_consulta);
	fecha_mysql();
	
    return $total_inscritos;

}
?>