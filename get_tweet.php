<?php

//sempre que trabalhar com variaveis de sessão e necessario incluir o metedo session
	session_start();

    if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');

    $id_usuario = $_SESSION['id_usuario'];

    $objDb = new db();
    $link = $objDb->conecta_mysql();
 	//DATE recebe 2 parametros o do SQL que esta em Norte Americano e informo o padrão de retorno que eu quero.
 	$sql = " SELECT DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, t.tweet, u.usuario ";
 	$sql.= " FROM tweet AS t JOIN usuarios AS u ON(t.id_usuario = u.id) ";
 	$sql.= " WHERE id_usuario = $id_usuario";
 	// o IN verifica se os campos a esquerda corresponde aos valores contidos dentro dos () do IN
 	$sql.= " OR id_usuario IN (SELECT seguindo_id_usuario FROM usuarios_seguidores where id_usuario = $id_usuario)";
 	$sql.= " ORDER BY data_inclusao DESC ";

	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){

		// para cada interção a variavel registro ira receber um registro do BD 
		while ($registro = mysqli_fetch_array($resultado_id,MYSQLI_ASSOC)) {
			echo '<a href="#" class="list-group-item" ';
				echo '<h4 class="list-group-item-heading">'.$registro['usuario'].' <small> - '.$registro['data_inclusao_formatada'].'</small></h4>';
				echo '<p class="list-group-item-text">'.$registro['tweet'].'</p>';
			echo '</a>';
			/*var_dump($registro);
			echo '<br/><br/>';*/
		}


	} else {

		echo 'Erro na consulta de Tweets no banco de dados!';

	}




?>