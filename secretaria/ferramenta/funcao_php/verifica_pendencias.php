<?php

function verifica_pendencia_imovel($tipo, $codigo_imovel){

	if($tipo == "coordenadas"){	
		//Verifica pendencia latitude
		$sql_imovel = "SELECT latitude_imovel, longitude_imovel FROM imovel WHERE codigo_imovel = '".$codigo_imovel."'";
		$query_imovel = mysql_query($sql_imovel);
		$coordenadas = mysql_fetch_assoc($query_imovel);
		
		if($coordenadas["latitude_imovel"] == '-0' || $coordenadas["longitude_imovel"] == '-0'){
			$situacao = "ERRO";
			return $situacao;
		}else{
			$situacao = "OK";
			return $situacao;
		}
	}
	
	
	if($tipo == "fotos"){	
		//Verifica pendencia latitude
		$sql_imovel_foto = "SELECT codigo_imovel_foto FROM imovel_foto WHERE codigo_imovel = '".$codigo_imovel."'";
		$query_imovel_foto = mysql_query($sql_imovel_foto);
		$total_fotos = mysql_num_rows($query_imovel_foto);
		
		if($total_fotos < 5){
			$situacao = "ERRO";
			return $situacao;
		}else{
			$situacao = "OK";
			return $situacao;
		}
	}

	
	if($tipo == "dados"){	
	
		//Verifica pendencia dados
		$sql_dados_imovel = "SELECT valor_diaria_imovel, data_inicial_imovel, data_final_imovel FROM imovel WHERE codigo_imovel = '".$codigo_imovel."'";
		$query_dados_imovel = mysql_query($sql_dados_imovel);
		$resultado_dados_imovel = mysql_fetch_assoc($query_dados_imovel);
		
		if($resultado_dados_imovel["valor_diaria_imovel"] == '0.00' || $resultado_dados_imovel["data_inicial_imovel"] == '0000-00-00' || $resultado_dados_imovel["data_final_imovel"] == '0000-00-00'){
			$situacao = "ERRO";
			return $situacao;
		}else{
			$situacao = "OK";
			return $situacao;
		}
	}
	
	if($tipo == "valor_diaria_imovel"){	
	
		//Verifica pendencia dados
		$sql_dados_imovel = "SELECT valor_diaria_imovel FROM imovel WHERE codigo_imovel = '".$codigo_imovel."'";
		$query_dados_imovel = mysql_query($sql_dados_imovel);
		$resultado_dados_imovel = mysql_fetch_assoc($query_dados_imovel);
		
		if($resultado_dados_imovel["valor_diaria_imovel"] == '0.00'){
			$situacao = "ERRO";
			return $situacao;
		}else{
			$situacao = "OK";
			return $situacao;
		}
	}
	
	if($tipo == "data_inicial_imovel"){	
	
		//Verifica pendencia dados
		$sql_dados_imovel = "SELECT data_inicial_imovel FROM imovel WHERE codigo_imovel = '".$codigo_imovel."'";
		$query_dados_imovel = mysql_query($sql_dados_imovel);
		$resultado_dados_imovel = mysql_fetch_assoc($query_dados_imovel);
		
		if($resultado_dados_imovel["data_inicial_imovel"] == '0000-00-00'){
			$situacao = "ERRO";
			return $situacao;
		}else{
			$situacao = "OK";
			return $situacao;
		}
	}
	
	if($tipo == "data_final_imovel"){	
	
		//Verifica pendencia dados
		$sql_dados_imovel = "SELECT data_final_imovel FROM imovel WHERE codigo_imovel = '".$codigo_imovel."'";
		$query_dados_imovel = mysql_query($sql_dados_imovel);
		$resultado_dados_imovel = mysql_fetch_assoc($query_dados_imovel);
		
		if($resultado_dados_imovel["data_final_imovel"] == '0000-00-00'){
			$situacao = "ERRO";
			return $situacao;
		}else{
			$situacao = "OK";
			return $situacao;
		}
	}
	
	if($tipo == "capacidade_hospedes"){	
	
		//Verifica pendencia dados
		$sql_dados_imovel = "SELECT capacidade_hospedes FROM imovel WHERE codigo_imovel = '".$codigo_imovel."'";
		$query_dados_imovel = mysql_query($sql_dados_imovel);
		$resultado_dados_imovel = mysql_fetch_assoc($query_dados_imovel);
		
		if($resultado_dados_imovel["capacidade_hospedes"] == ''){
			$situacao = "ERRO";
			return $situacao;
		}else{
			$situacao = "OK";
			return $situacao;
		}
	}
	
}

function verifica_pendencia_proprietario($tipo, $cpf_proprietario){

		//Verifica pendencia documentos
		$sql_documento = "SELECT codigo_tipo_documento FROM documento WHERE cpf_proprietario = '".$cpf_proprietario."'";
		$query_documento = mysql_query($sql_documento);
		$total_documentos = mysql_num_rows($query_documento);
		
		if($total_documentos < 4){
			$situacao = "ERRO";
			return $situacao;
		}else{
			$situacao = "OK";
			return $situacao;
		}
		
}

function verifica_pendencia_documento_proprietario($tipo_documento, $cpf_proprietario){

		//Verifica pendencia documentos
		$sql_documento = "SELECT codigo_tipo_documento FROM documento WHERE cpf_proprietario = '".$cpf_proprietario."' AND codigo_tipo_documento = '".$tipo_documento."'";
		$query_documento = mysql_query($sql_documento);
		$total_documentos = mysql_num_rows($query_documento);
		
		if($total_documentos < 1){
			$situacao = "ERRO";
			return $situacao;
		}else{
			$situacao = "OK";
			return $situacao;
		}
		
}

function verifica_pendencia_telefone_proprietario($cpf_proprietario){

		//Verifica pendencia telefone
		$sql_telefone = "SELECT codigo_telefone FROM telefone WHERE cpf_proprietario = '".$cpf_proprietario."'";
		$query_telefone = mysql_query($sql_telefone);
		$total_telefone = mysql_num_rows($query_telefone);
		
		if($total_telefone < 1){
			$situacao = "ERRO";
			return $situacao;
		}else{
			$situacao = "OK";
			return $situacao;
		}
		
}

function verifica_pendencia_conta_proprietario($cpf_proprietario){

		//Verifica pendencia conta
		$sql_conta = "SELECT codigo_conta FROM conta WHERE cpf_proprietario = '".$cpf_proprietario."'";
		$query_conta = mysql_query($sql_conta);
		$total_conta = mysql_num_rows($query_conta);
		
		if($total_conta < 1){
			$situacao = "ERRO";
			return $situacao;
		}else{
			$situacao = "OK";
			return $situacao;
		}
		
}

?>