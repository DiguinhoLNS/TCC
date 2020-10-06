<?php

	include "ConexaoBD.php";

	$nome = $_POST["nome"];
	$cpf = $_POST["CPF"];
	$data = $_POST["data"];
	$telefone = $_POST["telefone"];
	$genero = $_POST["Genero"];
	//$endereco = $_POST["endereco"];
	$email = $_POST["email"];
	$senha = $_POST["senha"];

	$sql = "INSERT INTO usuarios (Nome_user, Genero_user, Data_nasc_user, CPF_user, Email_user, Telefone_user, Senha_user) VALUES";
	$sql .= " ('$nome', '$genero', '$data', '$cpf', '$email', '$telefone', '$senha') ";

	//INSERT INTO workorders (column1, column2) VALUES ($column1, $column2)

	if ($conexao->query($sql) === TRUE) {
		
		header("Location: ../LoginUser.php");
		
	} else {

		echo "Erro no cadastro2<br>";
		echo "$nome<br>";
		echo "$cpf<br>";
		echo "$data<br>";
		echo "$telefone<br>";
		echo "$genero<br>";
		echo "$email<br>";
		echo "$senha<br>";
		//header("Location: ../RegisterUser.php");

	}

	$conexao->close();

?>