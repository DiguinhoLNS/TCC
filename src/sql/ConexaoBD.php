<?php

	//cria a conexao mysqli_connect('localizacao BD', 'usuario de acesso', 'senha', 'banco de dados')
	$conexao = mysqli_connect('localhost', 'root', '', 'ape');
	
	//ajusta o charset de comunica�ao entre a aplica�ao e o banco de dados
	mysqli_set_charset($conexao, 'utf8');
	
	//verifica a conexao 
	if($conexao->connect_error){
		
		die("Falha ao realizar a conexao: " . $conexao->connect_error);

	}

?>