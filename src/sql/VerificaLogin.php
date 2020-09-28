<?php

	session_start();

	include "ConexaoBD.php";

	$_SESSION["UserLoginError_1"] = 0;

	$email = $_POST['L_Email'];
	$senha = $_POST['L_PWD'];

	$base = mysqli_connect('localhost', 'root', '', 'ape') or die("erro de conexão");

	$regra1 = "SELECT email, senha_plataforma, id_user_plataforma FROM user_plataforma where email =  '$email' and senha_plataforma = '$senha'";

	$res = mysqli_query($base, $regra1) or die("Usuario não cadastrado");

	$mostrar = mysqli_fetch_array($res);

	if (strtolower($mostrar['email']) == strtolower($email) && $mostrar['senha_plataforma'] == $senha) {

		setcookie("ULogged", "1", time() + (86400 * 30), "/");
		setcookie("ID", $mostrar['id_user_plataforma'], time() + (86400 * 30), "/");

		header("Location: ../Dashboard.php");

	} else {

		$_SESSION["UserLoginError_1"] = "1";

		header("Location: ../LoginUser.php");
		
	}

?>