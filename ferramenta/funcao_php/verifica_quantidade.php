<?php
function verifica_quantidade($codigo_item,$codigo_imovel){
	
	$sql_quantidade_item_imovel = "SELECT quantidade_item FROM item_imovel WHERE codigo_imovel = '".$codigo_imovel."' AND codigo_item = '".$codigo_item."'";
	$query_quantidade_item_imovel = mysql_query($sql_quantidade_item_imovel) or mascara_erro_mysql($sql_quantidade_item_imovel,"consultar.php");
	$resultado_quantidade_item_imovel = mysql_fetch_assoc($query_quantidade_item_imovel);
	$quantidade_item = $resultado_quantidade_item_imovel["quantidade_item"];
	return $quantidade_item;

}
?>