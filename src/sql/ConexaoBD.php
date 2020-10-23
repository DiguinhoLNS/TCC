<?php

	$ServerName = "localhost";
	$UserName = "root";
	$ServerPassword = "";
	$ServerDataBase = "bdape";

	$conexao = mysqli_connect($ServerName, $UserName, $ServerPassword, $ServerDataBase);
	mysqli_set_charset($conexao, 'utf8');

	$conexao ? $base = $conexao : die("Falha ao realizar a conexão: " .mysqli_connect_error());

?>