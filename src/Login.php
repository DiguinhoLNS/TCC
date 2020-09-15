<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Login </title>
		
		<?php include "include/Head.php"; ?>

	</head>

	<body id = "LoginPage" class = "LightMode">
	
		<main id = "MainLogin">

			<div class = "UserForm BS">
		
				<form method = "POST" action = "sql/VerificaLogin.php">

					<ul class = "UserFormContent">

						<li class = "ContentHeader">
							<h1> Login </h1>
						</li>	
						<li class = "ContentInput">
							<label for = "L_Email"> Email </label>
							<input name = "L_Email" id = "L_Email" class = "UserInputData" type = "email" required/>
						</li>
						<li class = "ContentInput">
							<label for = "L_Senha"> Senha </label>
							<input name = "L_PWD" id = "L_Senha" class = "UserInputData" type = "password" required/>
						</li>
						<li class = "ContentBottom">	
							<a href = "Register.php"> Ainda não possui uma conta? </a>
							<input class = "UserInputSubmit btn" type = "submit" value = "Entrar">
						</li>

					</ul>

				</form>

			</div>
		
		</main>
	
	</body>

</html>