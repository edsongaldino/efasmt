<?php

function atualiza_situacao_imovel($situacao_imovel, $codigo_imovel){

// Altera situação imóvel
$sql_alterar_imovel = "UPDATE imovel SET situacao_imovel = '".$situacao_imovel."' WHERE codigo_imovel = ".$codigo_imovel."";
$query_alterar_imovel = mysql_query($sql_alterar_imovel);
return $situacao_imovel;


}

?>