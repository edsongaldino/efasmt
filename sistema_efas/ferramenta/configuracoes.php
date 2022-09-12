<?php

// informações do banco de dados
define("BD_HOST","efasmt.com.br");
define("BD_USUARIO","efasmtco_sistema");
define("BD_SENHA","efa259864");
define("BD_BANCO","efasmtco_sistema");

// informações do paínel
define("TITULO_OFF","Sistema de Inscrições - EFAS");
define("CAMINHO_CONTEUDO","conteudos");
define("SERVIDOR_RAIZ","/");
define("SITE_RAIZ","");
define("SUBPASTA_RAIZ","/www/");
define("KEY_SESSAO",$_SERVER['HTTP_HOST'].BD_USUARIO."fdsa65f4sd699q8745sdf987fsd85652734857349eh39rf6dsa8f48f494w84sdf84sd".$_SERVER['REMOTE_ADDR']);
define("DOMINIO","http://".$_SERVER['HTTP_HOST']);

// informações de aviso ao administrador do sistema
define("ADMIN_RAZAO","O Centro Espírita");
define("ADMIN_NOME","O Centro Espírita");
define("ADMIN_EMAIL","edson@agenciaatrativa.com.br");
define("ADMIN_SITE","http://www.ocentroespirita.com/");

// informações do fuso horário
date_default_timezone_set('America/Cuiaba');

?>