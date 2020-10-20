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
			$id_user = $_COOKIE['ID'];

			$regra1 = "SELECT codigo_acesso, id_empresa FROM empresas where codigo_acesso =  '$codigo_acesso'";
			$res = mysqli_query($base, $regra1) or die("Erro na consulta");
			$mostrar = mysqli_fetch_array($res);

			$id_empresa = $mostrar['id_empresa'];

			$regra2 = "SELECT * FROM user_empresa inner join empresas on 'id_empresa' = 'id_empresa' where empresas.codigo_acesso = '$codigo_acesso' and user_empresa.id_user = $id_user and user_empresa.id_empresa = empresas.id_empresa";
			$res2 = mysqli_query($base, $regra2) or die("Erro na consulta");
			$mostrar2 = mysqli_fetch_array($res2);
			$linhas = $res2->num_rows;


			if ($mostrar['codigo_acesso'] == strtoupper($codigo_acesso) && $linhas == 0) {

				$_SESSION['V'] = 1;
				header("Location: InsereUser_Empresa.php?q=".$codigo_acesso);

			} else if($linhas>0){

				//$_SESSION["CompanyLoginError_1"] = "2";
				/*echo $linhas."<br>";
				print_r($mostrar2);*/
				header("Location: ../Company.php?q=".$id_empresa);
				
			}else{
				$_SESSION["CompanyLoginError_1"] = "1";

				header("Location: ../LoginCompany.php");
			}

		break;

	}

?>