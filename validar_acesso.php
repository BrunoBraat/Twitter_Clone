<?php

	// por convenção usar sempre o session primeiro
	session_start();

	require_once('db.class.php');

	// a varialvel post recebe os valores dos atributos name no HTML
	$usuario = $_POST['usuario'];
	$senha = md5($_POST['senha']);

	$sql = " SELECT id, usuario, email FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha' ";

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	//recupera o retorno research referente a consula
	$resultado_id = mysqli_query($link, $sql);

	if ($resultado_id) {
		
		// transorma em array
	$dados_usurario = mysqli_fetch_array($resultado_id);

	//verifica se o usuari existe
	if(isset($dados_usurario['usuario'])){

		$_SESSION['id_usuario'] = $dados_usurario['id'];
 		$_SESSION['usuario'] = $dados_usurario['usuario'];
 		$_SESSION['email'] = $dados_usurario['email'];

		header('Location: home.php');

	} else {
		//header serve para redirecionar a pagina
		header('Location: index.php?erro=1');

	}

	} else {

		echo 'Erro na execução da consulta, favor entrar em contato com o Admin do site';

	}

	
?>