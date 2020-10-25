<?php

	date_default_timezone_set('America/Sao_Paulo');

	include "ConexaoBD.php";
	include_once "Funcoes.php";

	$tipo_verificacao = $_SESSION['TipoVerificação'];

	switch($tipo_verificacao){

		case "Usuario":

			$nome = mysqli_real_escape_string($base, $_POST["nome"]);
			$cpf = mysqli_real_escape_string($base, $_SESSION['cpfsemponto']);
			$data = mysqli_real_escape_string($base, $_POST["data"]);
			$telefone = mysqli_real_escape_string($base, $_POST["telefone"]);
			$genero = mysqli_real_escape_string($base, $_POST["Genero"]);
			$email = mysqli_real_escape_string($base, $_POST["email"]);
			$senha = mysqli_real_escape_string($base, $_POST["senha"]);

			$sql = "INSERT INTO usuarios (Nome_user, Genero_user, Data_nasc_user, CPF_user, Email_user, Telefone_user, Senha_user) VALUES";
			$sql .= " ('$nome', '$genero', '$data', '$cpf', '$email', '$telefone', '$senha') ";

			$conexao->query($sql) === TRUE ? header("Location: ../LoginUser.php") : header("Location: ../RegisterUser.php");

		break;

		case "Empresa":

			$CodigoJaExiste = true;

			do {

				$codigo_acesso = strtoupper(bin2hex(random_bytes(3)));
				$Dados = PegarDadosEmpresaPeloCodigo($base, $codigo_acesso);
				$CodigoJaExiste = $Dados["CodigoExiste"] ? true : false;

			} while ($CodigoJaExiste);

			$id_adm = mysqli_real_escape_string($base, $_COOKIE["ID"]);
			$nome = mysqli_real_escape_string($base, $_POST["nome"]);
			$email = mysqli_real_escape_string($base, $_POST["email"]);
			$cnpj = mysqli_real_escape_string($base, $_SESSION['cnpjsemponto']);
			$telefone = mysqli_real_escape_string($base, $_POST["telefone"]);
			$cor = mysqli_real_escape_string($base, $_POST["CorLayout"]);
			$endereco = mysqli_real_escape_string($base, $_POST["endereco"]);

			$sql = "INSERT INTO empresas (id_adm, codigo_acesso, Nome, CNPJ, Endereco, Email, Telefone, Cor_layout) VALUES";
			$sql .= " ('$id_adm', '$codigo_acesso', '$nome', '$cnpj', '$endereco', '$email', '$telefone', '$cor') ";

			$conexao->query($sql) === TRUE ? header("Location: InsereUser_Empresa.php?q=".$codigo_acesso) : header("Location: ../RegisterCompany.php");

		break;
		
	}

	$conexao->close();

?>