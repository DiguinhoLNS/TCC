<?php

	session_start();

	include "ConexaoBD.php";

	$_SESSION["UserLoginError_1"] = 0;

	$email = $_POST['L_Email'];
	$senha = $_POST['L_PWD'];

	$base = mysqli_connect('localhost', 'root', '', 'bdape') or die("erro de conexão");

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

?>