<?php

	$conexao = mysqli_connect('localhost', 'root', '', 'bdape');
	mysqli_set_charset($conexao, 'utf8');

	$base = mysqli_connect('localhost', 'root', '', 'bdape')or die("Erro de conexão");

	mysqli_query($base,"SET NAMES 'utf8'");
	mysqli_query($base,'SET character_set_connection=utf8');
	mysqli_query($base,'SET character_set_client=utf8');
	mysqli_query($base,'SET character_set_results=utf8');
 
	if($conexao->connect_error){
		
		die("Falha ao realizar a conexao: " . $conexao->connect_error);

	}

?>