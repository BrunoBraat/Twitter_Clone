<?php

	require_once('db.class.php');

	$sql = " SELECT * FROM usuarios ";

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	//recupera o retorno research referente a consula
	$resultado_id = mysqli_query($link, $sql);

	if ($resultado_id) {
		
		// transorma em array
		// MSQLI_NUM o sistema organiza os array por numeração
		// MSQLI_ASSOC o sistema organiza os array por parametro (EX ID, USUARIO, SENHA)
	$dados_usurario = array();


	while($linha = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){

		$dados_usurario[] = $linha;

	}

	//serve para percorrer array em PHP
	foreach ($dados_usurario as $usuario) {

		var_dump($usuario);
		echo '<br/><br/>';
		
	}

		;

	// serve para exibir um array 
	//var_dump($dados_usurario);
	
	} else {

		echo 'Erro na execução da consulta, favor entrar em contato com o Admin do site';

	}

?>