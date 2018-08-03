<?php

	session_start();

	//Elimina os indices de array da super global session

	unset($_SESSION['usuario']);
	unset($_SESSION['senha']);

	//echo 'Esperamos você de volta em breve!!!!'

	header('Location: index.php');

?>