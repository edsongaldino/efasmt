<?php
// Documentação disponível em: 
// https://dev.pagseguro.uol.com.br/documentacao/pagamentos/pagamento-padrao

// URL DE SANDBOX
$url = 'https://ws.sandbox.pagseguro.uol.com.br';

$data['email'] = 'aosamapostolo@gmail.com';
$data['token'] = '1a82b6b2-366e-4b0a-928e-1ee0c2cd2c623fcd8cd64eed975a9a8469b97e40075eba49-536c-4f38-8d58-7ea376940b76';
$data['currency'] = 'BRL';

$data['itemId1'] = "1";
$data['itemDescription1'] = "Descrição do item/produto";
$data['itemAmount1'] = 199.90;
$data['itemQuantity1'] = 1;
$data['itemWeight1'] = 0;

$data['itemId2'] = "2";
$data['itemDescription2'] = "Descrição do item/produto";
$data['itemAmount2'] = 25.90;
$data['itemQuantity2'] = 1;
$data['itemWeight2'] = 0;


$data['reference'] = $id_produto; //aqui vai o código que será usado para receber os retornos das notificações
$data['senderName'] = "Nome do comprador";
// $data['senderAreaCode'] = "";
// $data['senderPhone'] = "";
$data['senderEmail'] = "comprador@gmail.com";
// $data['shippingType'] = "";
// $data['shippingAddressStreet'] = "";
// $data['shippingAddressNumber'] = "";
// $data['shippingAddressComplement'] = "";
// $data['shippingAddressDistrict'] = "";
// $data['shippingAddressPostalCode'] = "";
// $data['shippingAddressCity'] = "";
// $data['shippingAddressState'] = "";
// $data['shippingAddressCountry'] = "";

$data['redirectURL'] = 'https://secretaria.efasmt.com.br/pedido-finalizado';

$data = http_build_query($data);

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$xml= curl_exec($curl);

if($xml == 'Unauthorized'){
  echo "Unauthorized";
  exit();
}

curl_close($curl);

$xml= simplexml_load_string($xml);

if(count($xml->error) > 0){
  echo "XML ERRO";
  exit();
}

// Utilize sua lógica para atualizar o pedido com o código da transação, para ser atualizado depois
$db->query("UPDATE pedido SET token = '{$xml->code}' WHERE id = $pedido_id"); 

// Redireciona o comprador para a página de pagamento
header('Location: https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code='.$xml->code);