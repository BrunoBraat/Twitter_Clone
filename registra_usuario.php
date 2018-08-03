<?php

	require_once('db.class.php');


$usuario = $_POST['usuario'];
$email =  $_POST['email'];
// MD% serve para criptografar os dados , ele recebe um parametro e retorna um hash de 32 caracteres
// nao tem como saber o que sera criptografado
$senha = md5($_POST['senha']);

$objDb = new db();
$link = $objDb->conecta_mysql();

$usuario_existe = false;
$email_existe = false;

//verificar se o usuario ja existe
$sql = " select * from usuarios where usuario = '$usuario' ";
if($resultado_id = mysqli_query($link, $sql)){

 $dados_usario = mysqli_fetch_array($resultado_id);

 if(isset($dados_usario['usuario'])){

 	$usuario_existe = true;

 } /*else {

 	echo 'Usuario não cadastrado, ok, pode cadastrar';
 }*/


 //var_dump($dados_usario);

}else{
	echo 'Erro ao tentar localizar o registro do usuario';


};


// verifica se o email ja existe
$sql = " select * from usuarios where email = '$email' ";
if($resultado_id = mysqli_query($link, $sql)){

 $dados_usario = mysqli_fetch_array($resultado_id);

 if(isset($dados_usario['email'])){

 	$email_existe = true;

 } /*else {

 	echo 'Email não cadastrado, ok, pode cadastrar';
 }*/

 //var_dump($dados_usario);

}else{
	echo 'Erro ao tentar localizar o registro de email';

};

// || -> ou

//se usuario e/ou usaruio existem siga o fluxo abaixo
if ($usuario_existe || $email_existe ) {


		$retorno_get = '';

		if ($usuario_existe) {
			// & sereve para separar ou delimitar os valores
			$retorno_get.="erro_usuario=1&";//esta frase sera mostrada na url apos a inscrição do usuario		
			
		}

		if ($email_existe) {
			// se email for true
			$retorno_get.="erro_email=1&"; 
		}

		// header serve para encaminhar para a pagina
		//na diretia da ? sera o script e a esquerda os parametros
		header('Location: inscrevase.php?'.$retorno_get);	
		//a função die interrompe a função do script
		die(); // se o usuario ainda nao estiver cadastrado segue o fluxo normal
}



$sql = "insert into usuarios(usuario,email,senha) values('$usuario','$email','$senha')";

// executar a query
if(mysqli_query($link, $sql)){
	echo 'Usuario registrado com sucesso';
} else {
	echo 'Erro ao registrar usuario';

} ;



?>