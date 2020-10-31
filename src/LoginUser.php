<?php 

	session_start();
	date_default_timezone_set('America/Sao_Paulo'); 
    
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

			if($_COOKIE["VerificaErro"]){

				if (isset($_SESSION["ErroLoginUsuario"])) {

					//Zerar erros de cadastro
					$_SESSION["ErrosCadastroUsuario"] = null;

					$erro = $_SESSION["ErroLoginUsuario"];

					if ($erro) {

						echo '
								
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorLogin").css("display", "block");

								});
							
							</script>
						
						';

					}

				}
			}

		?>

		<main id = "MainLoginUser">

			<div class = "FormPlatform FormLogin BS">

				<form class = "FormData" method = "POST" action = "sql/VerificaLogin.php">

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
							<a href = "#"> Esqueceu a senha? </a>
							<input class = "UserInputSubmit btn" type = "submit" value = "Entrar">
						</li>

					</ul>

				</form>

				<div class = "FormControl">

					<ul class = "FormControlContent">
					
						<li class = "ContentHeader">
							<i class = "material-icons"> &#xe7fd; </i>
							<h1> Usuário APE </h1>
						</li>
						<li class = "ContentControl">
							<a href = "RegisterUser.php" class = "btn"> Criar Conta </a>
						</li>

					</ul>

				</div>

			</div>

		</main>

	</body>

</html>