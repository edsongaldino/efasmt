<?php
function encurta_url($url) {
	if($url) {	
		$url = urlencode($url);
			
		$return = @file_get_contents ("http://migre.me/api.json?url=".$url."") or die ('<script> alert("Ocorreu um erro de comunicação com o Migre.me!"); history.go(-1); </script>');
			
		$return = json_decode($return);
	
		if ($return -> info != 'OK') {
			die ('<script> alert("Ocorreu um erro ao encurtar URL. Por favor, tente novamente!"); history.go(-1); </script>');
		}
				
		return $return -> migre;
	}
}

function baseUrl(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
?>