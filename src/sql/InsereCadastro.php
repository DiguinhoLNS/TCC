<?php

	date_default_timezone_set('America/Sao_Paulo');

	include "ConexaoBD.php";
	include_once "Funcoes.php";

	$tipo_verificacao = $_SESSION['TipoVerificação'];

	switch($tipo_verificacao){

		case "Usuario":

			$nome = ClearInjectionXSS($base, $_POST["nome"]);
			$cpf = ClearInjectionXSS($base, $_SESSION['cpfsemponto']);
			$data = ClearInjectionXSS($base, $_POST["data"]);
			$telefone = ClearInjectionXSS($base, $_POST["telefone"]);
			$genero = ClearInjectionXSS($base, $_POST["Genero"]);
			$email = ClearInjectionXSS($base, $_POST["email"]);
			$senha = ClearInjectionXSS($base, $_POST["senha"]);
			$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

			$sql = "INSERT INTO usuarios (Nome_user, Genero_user, Data_nasc_user, CPF_user, Email_user, Telefone_user, Senha_user) VALUES";
			$sql .= " ('$nome', '$genero', '$data', '$cpf', '$email', '$telefone', '$senhaCriptografada') ";

			$conexao->query($sql) === TRUE ? header("Location: ../LoginUser.php") : header("Location: ../RegisterUser.php");

		break;

		case "Empresa":

			$CodigoJaExiste = true;

			do {

				$codigo_acesso = strtoupper(bin2hex(random_bytes(3)));
				$Dados = PegarDadosEmpresaPeloCodigo($base, $codigo_acesso);
				$CodigoJaExiste = $Dados["CodigoExiste"] ? true : false;

			} while ($CodigoJaExiste);

			$id_adm = ClearInjectionXSS($base, $_COOKIE["ID"]);
			$nome = ClearInjectionXSS($base, $_POST["nome"]);
			$email = ClearInjectionXSS($base, $_POST["email"]);
			$cnpj = ClearInjectionXSS($base, $_SESSION['cnpjsemponto']);
			$telefone = ClearInjectionXSS($base, $_POST["telefone"]);
			$cor = ClearInjectionXSS($base, $_POST["CorLayout"]);
			$endereco = ClearInjectionXSS($base, $_POST["endereco"]);

			$sql = "INSERT INTO empresas (id_adm, codigo_acesso, Nome, CNPJ, Endereco, Email, Telefone, Cor_layout) VALUES";
			$sql .= " ('$id_adm', '$codigo_acesso', '$nome', '$cnpj', '$endereco', '$email', '$telefone', '$cor') ";

			$conexao->query($sql) === TRUE ? header("Location: InsereUser_Empresa.php?q=".$codigo_acesso) : header("Location: ../RegisterCompany.php");

		break;
		
	}

	$conexao->close();

?>