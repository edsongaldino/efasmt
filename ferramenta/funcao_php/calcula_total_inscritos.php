<?php
// Função para converte valores para o padrão brasileiro REAL
function calcula_total_inscritos($tipo) {
 	conecta_mysql();
	if($tipo == 1){
    // consulta total de crisnças inscritas
	$sql_consulta = "SELECT count(inscricao_evento.codigo_participante) AS total_inscritos
						FROM inscricao_evento
						JOIN participante ON (inscricao_evento.codigo_participante = participante.codigo_participante)
					 WHERE participante.data_nascimento_participante < 2003-09-19";
	$query_consulta = mysql_query($sql_consulta) or mascara_erro_mysql($sql_consulta);
	$resultado_consulta_cursos = mysql_fetch_assoc($query_consulta);
	$total_inscritos = $resultado_consulta_cursos['total_inscritos'];
	}
	
	if($tipo == 2){
    // consulta total de jovens inscritos
	$sql_consulta = "SELECT count(inscricao_evento.codigo_participante) AS total_inscritos
						FROM inscricao_evento
						JOIN participante ON (inscricao_evento.codigo_participante = participante.codigo_participante)
					 WHERE participante.data_nascimento_participante > '2003-09-19' AND participante.data_nascimento_participante > '2001-09-19'";
	$query_consulta = mysql_query($sql_consulta) or mascara_erro_mysql($sql_consulta);
	$resultado_consulta_cursos = mysql_fetch_assoc($query_consulta);
	$total_inscritos = $resultado_consulta_cursos['total_inscritos'];
	}
	
	if($tipo == 3){
    // consulta total de adultos inscritos
	$sql_consulta = "SELECT count(inscricao_evento.codigo_participante) AS total_inscritos
						FROM inscricao_evento
						JOIN participante ON (inscricao_evento.codigo_participante = participante.codigo_participante)
					 WHERE participante.data_nascimento_participante < '2000-09-19'";
	$query_consulta = mysql_query($sql_consulta) or mascara_erro_mysql($sql_consulta);
	$resultado_consulta_cursos = mysql_fetch_assoc($query_consulta);
	$total_inscritos = $resultado_consulta_cursos['total_inscritos'];
	}
	
	mysql_free_result($query_consulta);
	fecha_mysql();
	
    return $total_inscritos;

}
?>