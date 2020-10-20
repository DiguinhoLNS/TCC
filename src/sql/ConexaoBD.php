<?php

	$conexao = mysqli_connect('localhost', 'root', '', 'bdape');
	mysqli_set_charset($conexao, 'utf8');
 
	if($conexao->connect_error){
		
		die("Falha ao realizar a conexao: " . $conexao->connect_error);

	}

?>