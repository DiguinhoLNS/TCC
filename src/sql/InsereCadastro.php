<?php

	//session_start();
	date_default_timezone_set('America/Sao_Paulo');

	include "ConexaoBD.php";

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

			//INSERT INTO workorders (column1, column2) VALUES ($column1, $column2)

			if ($conexao->query($sql) === TRUE) {

				header("Location: ../LoginUser.php");

			} else {

				/*echo $cpf." 2<br>";
				echo $nome." ".$genero." ".$cpf." ".$data." ".$email." ".$telefone." ".$senha;*/
				header("Location: ../RegisterUser.php");

			}

		break;

		case "Empresa":

			$valid = 0;

			do {

				$bytes = random_bytes(3);
				$bytes2 = strtoupper(bin2hex($bytes));

				$regra1 = "SELECT codigo_acesso FROM empresas where codigo_acesso =  '$bytes' ";
				$res = mysqli_query($base, $regra1) or die("Erro na consulta1");

				$mostrar = mysqli_fetch_array($res);

				if (strtolower($mostrar['codigo_acesso']) == $bytes) {

					$valid = 0;

				} else {

					$valid = 1;

				}

			} while ($valid == 0);

			$id_adm = $_COOKIE["ID"];
			$nome = $_POST["nome"];
			$email = $_POST["email"];
			$cnpj = $_SESSION['cnpjsemponto'];
			$telefone = $_POST["telefone"];
			$cor = $_POST["CorLayout"];
			$endereco = $_POST["endereco"];

			//INCLUDE NA TABELA EMPRESA
			$sql = "INSERT INTO empresas (id_adm, codigo_acesso, Nome, CNPJ, Endereco, Email, Telefone, Cor_layout) VALUES";
			$sql .= " ('$id_adm', '$bytes2', '$nome', '$cnpj', '$endereco', '$email', '$telefone', '$cor') ";

			if ($conexao->query($sql) === TRUE) {

				header("Location: InsereUser_Empresa.php");

			} else {

				/*echo "Erro 2<br>";
				echo $id_adm." ".$bytes2." ".$nome." ".$cnpj." ".$endereco." ".$email." ".$telefone." ".$cor;*/
				header("Location: ../RegisterCompany.php");
			}

		break;
		
	}

	$conexao->close();

?>