<?php include("sistema_mod_include.php"); ?>
<?php
     
    //get search term
    $estado = $_GET['estado'];
    
    conecta_mysql();

    $sql = "SELECT codigo_cidade, nome_cidade FROM cidade WHERE codigo_estado = '".$estado."' ORDER BY nome_cidade ASC";  //busco todos os estados e ordeno pela sigla
    $res = mysql_query($sql);
    $num = mysql_num_rows($res);  //numero de estados encontrados

    for ($i = 0; $i < $num; $i++) {
        $dados = mysql_fetch_array($res);
        $arrCidades[$dados['codigo_cidade']] = utf8_encode($dados['nome_cidade']);
    }

    fecha_mysql();

    
?>
<span>Cidade :</span>
<select name="cidade_participante" id="cidade_participante" required>

     <?php foreach($arrCidades as $value => $nome){
        echo "<option value='{$value}'>{$nome}</option>";
        }
     ?>

</select>