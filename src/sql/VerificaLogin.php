<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	require_once "ConexaoBD.php";
	require_once "Funcoes.php";

	$conn = new ConexaoBD();
	$func = new Funcoes();

	$tipo_verificacao = $_SESSION['TipoVerificação'];

	switch($tipo_verificacao){

		case "Usuario": 
			
			$_SESSION["UserLoginError_1"] = 0;

			$email = $func->ClearInjectionXSS($_POST['L_Email']);
			$senha = $func->ClearInjectionXSS($_POST['L_PWD']);

			$Dados = $func->PegarDadosUsuarioPeloEmailSenha($email, $senha);

			$Captcha = $func->reCaptcha();

			if ($Dados['UsuarioExiste'] && $Captcha == false) {

				setcookie("ID", $func->Criptografar($Dados['id_user']), time() + (86400 * 30), "/");
				setcookie("MessageNotification", "Login realizado", time() + 900, "/");
				setcookie("VerificaErro", "0", time() + (86400 * 30), "/");

				$_SESSION["email"] = $email;

				header("Location: ../VerificationUser.php?q=53875823");

			} else {

				$_SESSION["ErroLoginUsuario"] = true;
				setcookie("VerificaErro", "1", time() + (86400 * 30), "/");

				header("Location: ../LoginUser.php");
				
			}

		break;

		case "Empresa":

			$_SESSION["CompanyLoginError_1"] = 0;

			$codigo_acesso = $func->ClearInjectionXSS($_POST['cod']);
			$id_user = $func->ClearInjectionXSS($func->Descriptografar($_COOKIE['ID']));

			$Dados = $func->PegarDadosEmpresaPeloCodigo($codigo_acesso);

			$QuantidadeDeLoginsJaFeitos = $func->VerificarSeUsuarioJaFezLoginAntes($codigo_acesso, $id_user);

			$Captcha = $func->reCaptcha();
			
			if ($Dados["CodigoExiste"] && empty($QuantidadeDeLoginsJaFeitos) && $Dados["Empresa"][0]["Situacao"] == 'Ativada' && $Captcha == false) {

				$_SESSION['TipoVerificação'] = "Usuario";
				setcookie("VerificaErro", "0", time() + (86400 * 30), "/");
				header("Location: InsereUser_Empresa.php?q=".$func->Criptografar($codigo_acesso));

			} else if(!empty($QuantidadeDeLoginsJaFeitos && $Dados["Empresa"][0]["Situacao"] == 'Ativada' && $Captcha == false)){

				setcookie("VerificaErro", "0", time() + (86400 * 30), "/");
				header("Location: ../Feed.php?q=".$func->Criptografar($Dados['id_empresa']));	
				
			}else if(!$Dados["CodigoExiste"] || $Dados["Empresa"][0]["Situacao"] != 'Ativada' || $Captcha == true) {

				$_SESSION["ErroLoginEmpresa"] = true;
				setcookie("VerificaErro", "1", time() + (86400 * 30), "/");

				header("Location: ../LoginCompany.php");
			}

		break;

	}
