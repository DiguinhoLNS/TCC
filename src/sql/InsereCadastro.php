<?php

	date_default_timezone_set('America/Sao_Paulo');

	include "ConexaoBD.php";
	include_once "Funcoes.php";

	$base = mysqli_connect('localhost', 'root', '', 'bdape')or die("Erro de conexão");

	$tipo_verificacao = $_SESSION['TipoVerificação'];

	switch($tipo_verificacao){

		case "Usuario":

			$nome = $_POST["nome"];
			$cpf = $_SESSION['cpfsemponto'];
			$data = $_POST["data"];
			$telefone = $_POST["telefone"];
			$genero = $_POST["Genero"];
			$email = $_POST["email"];
			$senha = $_POST["senha"];

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

			$id_adm = $_COOKIE["ID"];
			$nome = $_POST["nome"];
			$email = $_POST["email"];
			$cnpj = $_SESSION['cnpjsemponto'];
			$telefone = $_POST["telefone"];
			$cor = $_POST["CorLayout"];
			$endereco = $_POST["endereco"];

			$sql = "INSERT INTO empresas (id_adm, codigo_acesso, Nome, CNPJ, Endereco, Email, Telefone, Cor_layout) VALUES";
			$sql .= " ('$id_adm', '$codigo_acesso', '$nome', '$cnpj', '$endereco', '$email', '$telefone', '$cor') ";

			$conexao->query($sql) === TRUE ? header("Location: InsereUser_Empresa.php?q=".$codigo_acesso) : header("Location: ../RegisterCompany.php");

		break;
		
	}

	$conexao->close();

?>