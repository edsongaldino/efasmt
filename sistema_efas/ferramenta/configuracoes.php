<?php

// informa��es do banco de dados
define("BD_HOST","efasmt.mysql.dbaas.com.br");
define("BD_USUARIO","efasmt");
define("BD_SENHA","Web@259864");
define("BD_BANCO","efasmt");

// informa��es do pa�nel
define("TITULO_OFF","Sistema de Inscrições - EFAS");
define("CAMINHO_CONTEUDO","conteudos");
define("SERVIDOR_RAIZ","/");
define("SITE_RAIZ","");
define("SUBPASTA_RAIZ","/www/");
define("KEY_SESSAO",$_SERVER['HTTP_HOST'].BD_USUARIO."fdsa65f4sd699q8745sdf987fsd85652734857349eh39rf6dsa8f48f494w84sdf84sd".$_SERVER['REMOTE_ADDR']);
define("DOMINIO","http://".$_SERVER['HTTP_HOST']);

// informa��es de aviso ao administrador do sistema
define("ADMIN_RAZAO","O Centro Esp�rita");
define("ADMIN_NOME","O Centro Esp�rita");
define("ADMIN_EMAIL","edson@agenciaatrativa.com.br");
define("ADMIN_SITE","http://www.ocentroespirita.com/");

// informa��es do fuso hor�rio
date_default_timezone_set('America/Cuiaba');

?>