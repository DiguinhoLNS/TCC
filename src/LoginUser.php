<?php 

    session_start(); 
    
    $_SESSION['TipoVerificação'] = "Usuario"; 
    
?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Login </title>

		<?php include "include/Head.php"; ?>

	</head>

	<body id = "LoginUserPage" class = "LightMode">

		<?php

			include "php/Pag.php";

			StopUserAccess();

			if (!isset($_SESSION["UserLoginError_1"])) {

				$_SESSION["UserRegisterError_1"] = 0;

			} else {

				$UserLoginError_1 = $_SESSION["UserLoginError_1"];

				if ($UserLoginError_1 == "1") {

					echo '
							
						<script language = "javascript" type = "text/javascript">
						
							$(document).ready(function(){

								$("#ErrorLogin").css("display", "block");

							});
						
						</script>
					
					';

				}

			}

		?>

		<main id = "MainLoginUser">

			<div class = "FormPlatform BS">

				<form method = "POST" action = "sql/VerificaLogin.php">

					<ul class = "FormPlatformContent">

						<li class = "ContentHeader">
							<h1> Login </h1>
						</li>
						<li class = "ContentInput">
							<label for = "L_Email"> Email </label>
							<input name="L_Email" id = "L_Email" class = "UserInputData" type = "email" required />
						</li>
						<li class = "ContentInput">
							<label for = "L_Senha"> Senha </label>
							<input name="L_PWD" id = "L_Senha" class = "UserInputData" type = "password" required />
						</li>
						<li class = "ContentError">
							<span id = "ErrorLogin" class = "txtError"> Email ou Senha incorretos </span>
						</li>
						<li class = "ContentBottom">
							<a href = "RegisterUser.php"> Ainda não possui uma conta? </a>
							<input class = "UserInputSubmit btn" type = "submit" value="Entrar">
						</li>

					</ul>

				</form>

			</div>

		</main>

	</body>

</html>