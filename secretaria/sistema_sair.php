<?php include("sistema_mod_include.php"); ?>
<?php
session_destroy();

redireciona("index.php?me=".campo_form_codifica(0,true)."&mm=".campo_form_codifica("Voc� saiu do sistema! Para acessar novamente fa�a seu login."));

?>