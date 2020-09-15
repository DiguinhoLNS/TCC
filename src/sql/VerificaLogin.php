<head>

	<meta charset="UTF-8">
	<title> ADMIN </title>

</head>


<?php

session_start();

include "ConexaoBD.php";

$email = $_POST['L_Email'];
$senha = $_POST['L_PWD'];


$base = mysqli_connect('localhost', 'root', '', 'ape') or die("erro de conexão");

$regra1 = "SELECT email, senha_plataforma, id_user_plataforma FROM user_plataforma where email =  '$email' and senha_plataforma = '$senha'";

$res = mysqli_query($base, $regra1) or die("Usuario não cadastrado");

$mostrar = mysqli_fetch_array($res);

$_SESSION['id'] = $mostrar['id_user_plataforma'];

if (strtolower($mostrar['email']) == strtolower($email) && $mostrar['senha_plataforma'] == $senha) {

	setcookie("ULogged", "1", time() + (86400 * 30), "/");

	header("Location: ../Dashboard.php");
} else {

	header("Location: ../Login.php");
}

?>