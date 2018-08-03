<?php

	class db {

		//host
		private $host = 'localhost';

		//usuario
		private $usuario = 'root';

		//senha
		private $senha = '';

		//banco de dados
		private $database = 'twitter_clone';

		public function conecta_mysql(){

				/* criar a conexão com o banco de dados
				esta função espera receber 4 parametros(localização do BD,usuario de acesso,senha,banco de dados)*/
				//this serve para chamar a variavel dentro da propria classe

			$con =  mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

			//ajustar o charset de comunicação entre a aplcação e o banco de dados
			mysqli_set_charset($con,'utf8');

			//verificar se houve erro de conexao
			if (mysqli_connect_errno()) {
				echo 'Erro ao tentar se conectar com o banco de dados MySql: ' .mysqli_connect_error();
			}
				return $con;

		}


	}



?>