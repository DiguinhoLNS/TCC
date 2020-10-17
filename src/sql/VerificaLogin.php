<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	include "ConexaoBD.php";

	$base = mysqli_connect('localhost', 'root', '', 'bdape')or die("Erro de conexão");

	$tipo_verificacao = $_SESSION['V'];

	switch($tipo_verificacao){

		// User
		case 1: 
			
			$_SESSION["UserLoginError_1"] = 0;

			$email = $_POST['L_Email'];
			$senha = $_POST['L_PWD'];

			$regra1 = "SELECT Email_user, Senha_user, id_user FROM usuarios where Email_user =  '$email' and Senha_user = '$senha'";
			$res = mysqli_query($base, $regra1) or die("Usuario não cadastrado");
			$mostrar = mysqli_fetch_array($res);

			if (strtolower($mostrar['Email_user']) == strtolower($email) && $mostrar['Senha_user'] == $senha) {

				setcookie("ULogged", "1", time() + (86400 * 30), "/");
				setcookie("ID", $mostrar['id_user'], time() + (86400 * 30), "/");

				header("Location: ../Dashboard.php");

			} else {

				$_SESSION["UserLoginError_1"] = "1";

				header("Location: ../LoginUser.php");
				
			}

		break;

		// Company
		case 2:

			$_SESSION["CompanyLoginError_1"] = 0;

			$codigo_acesso = $_POST['cod'];

			$regra1 = "SELECT codigo_acesso FROM empresas where codigo_acesso =  '$codigo_acesso'";
			$res = mysqli_query($base, $regra1) or die("Erro na consulta");
			$mostrar = mysqli_fetch_array($res);

			if (strtolower($mostrar['codigo_acesso']) == $codigo_acesso) {

				header("Location: ../Company.php");

			} else {

				$_SESSION["UserLoginError_1"] = "1";

				header("Location: ../LoginCompany.php");
				
			}

		break;

	}

?>