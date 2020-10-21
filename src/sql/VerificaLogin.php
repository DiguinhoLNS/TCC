<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	include "ConexaoBD.php";
	include "Querys.php";

	$base = mysqli_connect('localhost', 'root', '', 'bdape')or die("Erro de conexão");

	$tipo_verificacao = $_SESSION['TipoVerificação'];

	switch($tipo_verificacao){

		case "Usuario": 
			
			$_SESSION["UserLoginError_1"] = 0;

			$email = $_POST['L_Email'];
			$senha = $_POST['L_PWD'];

			$Dados = PegarDadosUsuarioPeloEmailSenha($base, $email, $senha);

			if (!empty($Dados['QuantidadeDeCadastros'])) {

				setcookie("ULogged", "1", time() + (86400 * 30), "/");
				setcookie("ID", $Dados['id_user'], time() + (86400 * 30), "/");

				header("Location: ../Dashboard.php");

			} else {

				$_SESSION["UserLoginError_1"] = "1";

				header("Location: ../LoginUser.php");
				
			}

		break;

		case "Empresa":

			$_SESSION["CompanyLoginError_1"] = 0;

			$codigo_acesso = $_POST['cod'];
			$id_user = $_COOKIE['ID'];

			$DadosEmpresa = PegarDadosEmpresaPeloCodigo($base, $codigo_acesso);

			$QuantidadeDeLoginsJaFeitos = VerificarSeUsuarioJaFezLoginAntes($base, $codigo_acesso, $id_user);
			
			if ($DadosEmpresa["CodigoExiste"] && empty($QuantidadeDeLoginsJaFeitos)) {

				$_SESSION['TipoVerificação'] = "Usuario";
				header("Location: InsereUser_Empresa.php?q=".$codigo_acesso);

			} else if(!empty($QuantidadeDeLoginsJaFeitos)){

				header("Location: ../Company.php?q=".$Dados['id_empresa']);
				
			}else if(!$DadosEmpresa["CodigoExiste"]) {

				$_SESSION["CompanyLoginError_1"] = "1";

				header("Location: ../LoginCompany.php");
			}

		break;

	}

?>