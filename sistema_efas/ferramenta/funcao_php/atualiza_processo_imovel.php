<?php

function atualiza_processo_imovel($tipo_processo, $codigo_usuario, $codigo_imovel, $descricao_processo_imovel){
	
	// Insere data de inclusão do imóvel
	$sql_data_inclusao_imovel = "INSERT INTO processo_imovel (data_hora_processo, codigo_tipo_processo, codigo_usuario, codigo_imovel, descricao_processo_imovel) VALUES ('".date('Y-m-d h:i:s')."','".$tipo_processo."','".$codigo_usuario."','".$codigo_imovel."','".$descricao_processo_imovel."')";
	$query_data_inclusao_imovel = mysql_query($sql_data_inclusao_imovel);
	
	
}

?>