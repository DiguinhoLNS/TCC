<?php

	session_start();

	$_SESSION['var'] = '1';

?>

<!DOCTYPE html>
<html lang = "pt-br">

<head>

	<title> Cadastro </title>

	<?php include "include/Head.php"; ?>

</head>

<body id = "RegisterPage" class = "LightMode">

	<main id = "MainLogin">

		<div class = "UserForm BS">

			<form method = "POST" action = "sql/VerificaCadastro.php">

				<ul class = "UserFormContent">

					<li class = "ContentHeader">
						<h1> Cadastro </h1>
					</li>
					<li class = "ContentInput">
						<label for = "R_Nome"> Nome </label>
						<input id = "R_Nome" class = "UserInputData" type = "text" name = "nome" required />
					</li>
					<li class = "ContentInput">
						<label for = "R_Email"> Email </label>
						<input id = "R_Email" class = "UserInputData" type = "email" name = "email" required />
					</li>
					<li class = "ContentInput">
						<label for = "R_CPF"> CPF </label>
						<input id = "R_CPF" class = "UserInputData" type = "number" name = "CPF" required />
					</li>
					<li class = "ContentInput">
						<label for = "R_DataNasc"> Data de Nascimento </label>
						<input id = "R_DataNasc" class = "UserInputData" type = "date" name = "data" required />
					</li>
					<li class = "ContentInput">
						<label for = "R_Telefone"> Telefone </label>
						<input id = "R_Telefone" class = "UserInputData" type = "number" name = "telefone" required />
					</li>
					<li class = "ContentInput">
						<label for = "R_Celular"> Celular </label>
						<input id = "R_Celular" class = "UserInputData" type = "number" name = "celular" required />
					</li>
					<li class = "ContentInput">
						<label for = "R_Endereco"> Endereço </label>
						<input id = "R_Endereco" class = "UserInputData" type = "text" name = "endereco" required />
					</li>
					<li class = "ContentInput">
						<label for = "R_Senha"> Senha </label>
						<input id = "R_Senha" class = "UserInputData" type = "password" name = "senha" required />
					</li>
					<li class = "ContentBottom">
						<a href = "Login.php"> Já possui uma conta? </a>
						<input class = "UserInputSubmit btn" type = "submit" value = "Cadastrar">
					</li>

				</ul>

			</form>

		</div>

	</main>

</body>

</html>