<?php require_once("sistema_mod_include.php"); ?>
<?php
   /**
   * função que devolve em formato JSON os dados do cliente
   */
  function retorna( $nome, $db )
  {
    $sql = "SELECT 
                participante.nome_participante, participante.nome_participante_cracha, participante.data_nascimento_participante, participante.centro_espirita_participante,
                email_participante.descricao_email_participante, telefone_participante.numero_telefone_participante

                FROM participante 
                LEFT JOIN email_participante ON participante.codigo_participante = email_participante.codigo_participante
                LEFT JOIN telefone_participante ON participante.codigo_participante = telefone_participante.codigo_participante
                WHERE participante.nome_participante LIKE '%".$nome."%' LIMIT 1";

    $query = $db->query( $sql );

    $arr = Array();
    if( $query->num_rows )
    {
      while( $dados = $query->fetch_object() )
      {
        $arr['nome_participante_cracha'] = $dados->nome_participante_cracha;
        $arr['data_nascimento_participante'] = converte_data_portugues($dados->data_nascimento_participante);
        $arr['numero_telefone_participante'] = $dados->numero_telefone_participante;
        $arr['email_participante'] = $dados->descricao_email_participante;
        $arr['centro_espirita_participante'] = $dados->centro_espirita_participante;
      }
    }
    else
      $arr['nome_participante_cracha'] = '';

    return json_encode( $arr );
  }

/* só se for enviado o parâmetro, que devolve os dados */
if( isset($_GET['nome']) )
{
  $db = new mysqli('efasmt.com.br', 'efasmtco_sistema', 'efa259864', 'efasmtco_sistema');
  echo retorna( filter ($_GET['nome'] ), $db );
}

function filter( $var ){
  return $var;//a implementação desta, fica a cargo do leitor
}

?>