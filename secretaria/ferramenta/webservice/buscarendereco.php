<?
//------------------------------------------------------------------------
// Web Service CEP, desenvolvido por Evanil Rosano de Paula.
// Este Web Service est� habilitado para funcionar em qualquer servidor, 
// no entanto ter� melhor desempenho em sites hospedados pela Via Virtual.
// Visite nosso site e conhe�a nossos servi�os.
// Via Virtual - Soluc�es WEB
// http://www.viavirtual.com.br
//-------------------------------------------------------------------------
$consulta = 'http://viavirtual.com.br/webservicecep.php?cep='.$_GET['cep'];
$consulta = file($consulta);
$consulta = explode('||',$consulta[0]);
// Caso seja necess�rio poder� salvar os dados em SESSION
$rua=utf8_encode($consulta[0]);
$bairro=utf8_encode($consulta[1]);
$cidade=utf8_encode($consulta[2]);
$uf=$consulta[4];
?>