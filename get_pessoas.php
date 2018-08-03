<?php

//sempre que trabalhar com variaveis de sessão e necessario incluir o metedo session
	session_start();

    if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');

	$nome_pessoa = $_POST['nome_pessoa'];
    $id_usuario = $_SESSION['id_usuario'];

    $objDb = new db();
    $link = $objDb->conecta_mysql();
 	//o like permitir procurar parte do nome da pessoa e retornar o nome completo EX: Nanda ele retorna Fernanda
 	// o simbolo de % permite procurar por trechos dos nomes informando somente caracteres do lado direito ou esquerdo
 	$sql = "SELECT u.*, us.* "; 
    $sql .= "FROM usuarios AS u ";
    $sql .= "LEFT JOIN usuarios_seguidores AS us ON (us.id_usuario = $id_usuario AND u.id = us.seguindo_id_usuario) ";
    $sql .= "WHERE usuario LIKE '%$nome_pessoa%' AND id <> $id_usuario";

	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){

		// para cada interção a variavel registro ira receber um registro do BD 
		while ($registro = mysqli_fetch_array($resultado_id,MYSQLI_ASSOC)) {
			echo '<a href="#" class="list-group-item" ';
			echo '<strong>'.$registro['usuario'].'</strong> <small> - '.$registro['email'].' </small>';
			echo '<p class="list-group-item-text pull-right">';// a Tag P ira encapsular o botão e faça com que flutue na região direita
				//btn

//Variavel que identifica se o registro em questao possui o indice_id_usario possui um id_seguidor
// sn = sim ou nao
$esta_seguindo_usuario_sn = isset($registro['id_usuario_seguidor']) && !empty($registro['id_usuario_seguidor']) ? 'S' : 'N';

                    $btn_seguir_display = 'block';
                    $btn_deixar_seguir_display = 'block';

             if($esta_seguindo_usuario_sn == 'N'){
                        $btn_deixar_seguir_display = 'none';
                    }else{
                        $btn_seguir_display = 'none';
                    }
			
			echo '<button type="button" id="btn_seguir_' . $registro['id'] . '" style="display: ' . $btn_seguir_display . '" class="btn btn-default btn_seguir" data-id_usuario="' . $registro['id'] . '">Seguir</button>';

            echo '<button type="button" id="btn_deixar_seguir_' . $registro['id'] . '" style="display: ' . $btn_deixar_seguir_display . '" class="btn btn-primary btn_deixar_seguir" data-id_usuario="' . $registro['id'] . '">Deixar de Seguir</button>';
			
			echo '</p>';
			echo '<div class="clearfix"></div>';
			echo '</a>';
			/*var_dump($registro);
			echo '<br/><br/>';*/
		}

	} else {

		echo 'Erro na consulta de usuarios no banco de dados!';

	}



?>