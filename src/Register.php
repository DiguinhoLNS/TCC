<?php

session_start();

$_SESSION['var'] = '1';


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

	<title> Cadastro </title>

	<?php include "include/Head.php"; ?>

</head>

<body id="RegisterPage" class="LightMode">

	<?php

	if (!isset($_SESSION["UserRegisterError_G"])) {

		$_SESSION["UserRegisterError_G"] = 0;
		$_SESSION["UserRegisterError_1"] = 0;
		$_SESSION["UserRegisterError_2"] = 0;
		$_SESSION["UserRegisterError_3"] = 0;
		$_SESSION["UserRegisterError_4"] = 0;
		$_SESSION["UserRegisterError_5"] = 0;
		$_SESSION["UserRegisterError_6"] = 0;
		$_SESSION["UserRegisterError_8"] = 0;
	} else {

		$UserRegisterError_G = $_SESSION["UserRegisterError_G"];
		$UserRegisterError_1 = $_SESSION["UserRegisterError_1"];
		$UserRegisterError_2 = $_SESSION["UserRegisterError_2"];
		$UserRegisterError_3 = $_SESSION["UserRegisterError_3"];
		$UserRegisterError_4 = $_SESSION["UserRegisterError_4"];
		$UserRegisterError_5 = $_SESSION["UserRegisterError_5"];
		$UserRegisterError_6 = $_SESSION["UserRegisterError_6"];
		$UserRegisterError_8 = $_SESSION["UserRegisterError_8"];


		if ($UserRegisterError_G == "1") {

			if ($UserRegisterError_1 == "1") {

				echo '
					
						<script language = "javascript" type = "text/javascript">
						
							$(document).ready(function(){

								$("#ErrorNome").css("display", "block");

							});
						
						</script>
					
					';
			}

			if ($UserRegisterError_2 == "1") {

				echo '
					
						<script language = "javascript" type = "text/javascript">
						
							$(document).ready(function(){

								$("#ErrorEmail").css("display", "block");

							});
						
						</script>
					
					';
			}

			if ($UserRegisterError_3 == "1") {

				echo '
					
						<script language = "javascript" type = "text/javascript">
						
							$(document).ready(function(){

								$("#ErrorCPF").css("display", "block");

							});
						
						</script>
					
					';
			}

			if ($UserRegisterError_4 == "1") {

				echo '
					
						<script language = "javascript" type = "text/javascript">
						
							$(document).ready(function(){

								$("#ErrorDataNasc").css("display", "block");

							});
						
						</script>
					
					';
			}

			if ($UserRegisterError_5 == "1") {

				echo '
					
						<script language = "javascript" type = "text/javascript">
						
							$(document).ready(function(){

								$("#ErrorTelefone").css("display", "block");

							});
						
						</script>
					
					';
			}

			if ($UserRegisterError_6 == "1") {

				echo '
					
						<script language = "javascript" type = "text/javascript">
						
							$(document).ready(function(){

								$("#ErrorCelular").css("display", "block");

							});
						
						</script>
					
					';
			}

			if ($UserRegisterError_8 == "1") {

				echo '
					
						<script language = "javascript" type = "text/javascript">
						
							$(document).ready(function(){

								$("#ErrorSenha").css("display", "block");

							});
						
						</script>
					
					';
			}
		}
	}

	?>

	<main id="MainLogin">

		<div class="UserForm BS">

			<form method="POST" action="sql/VerificaCadastro.php">

				<ul class="UserFormContent">

					<li class="ContentHeader">
						<h1> Cadastro </h1>
					</li>
					<li class="ContentInput">
						<label for="R_Nome"> Nome </label>
						<span id="ErrorNome" class="txtError"> Nome inválido </span>
						<input id="R_Nome" class="UserInputData" type="text" name="nome" required />
					</li>
					<li class="ContentInput">
						<label for="R_Email"> Email </label>
						<span id="ErrorEmail" class="txtError"> Email inválido </span>
						<input id="R_Email" class="UserInputData" type="email" name="email" required />
					</li>
					<li class="ContentInput">
						<label for="R_CPF"> CPF </label>
						<span id="ErrorCPF" class="txtError"> CPF inválido </span>
						<input id="R_CPF" class="UserInputData" type="number" name="CPF" required />
					</li>
					<li class="ContentInput">
						<label for="R_DataNasc"> Data de Nascimento </label>
						<span id="ErrorDataNasc" class="txtError"> Data inválida </span>
						<input id="R_DataNasc" class="UserInputData" type="date" name="data" required />
					</li>
					<li class="ContentInput">
						<label for="R_Telefone"> Telefone </label>
						<span id="ErrorTelefone" class="txtError"> Telefone inválido </span>
						<input id="R_Telefone" class="UserInputData" type="number" name="telefone" required />
					</li>
					<li class="ContentInput">
						<label for="R_Celular"> Celular </label>
						<span id="ErrorCelular" class="txtError"> Celular inválido </span>
						<input id="R_Celular" class="UserInputData" type="number" name="celular" required />
					</li>
					<li class="ContentInput">
						<label for="R_Endereco"> Endereço </label>
						<input id="R_Endereco" class="UserInputData" type="text" name="endereco" required />
					</li>
					<li class="ContentInput">
						<label for="R_Senha"> Senha </label>
						<span id="ErrorSenha" class="txtError"> Senha inválida </span>
						<input id="R_Senha" class="UserInputData" type="password" name="senha" required />
					</li>
					<li class="ContentBottom">
						<a href="Login.php"> Já possui uma conta? </a>
						<input class="UserInputSubmit btn" type="submit" value="Cadastrar">
					</li>

				</ul>

			</form>

		</div>

	</main>

</body>

</html>