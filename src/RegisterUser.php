<?php 

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	$_SESSION['TipoVerificação'] = "Usuario";

?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Criar Conta </title>

		<?php include "include/Head.php"; ?>

	</head>

	<body id = "RegisterUserPage" class = "LightMode">

		<?php
    
			include "php/Pag.php";

			StopUserAccess();

				if (isset($_SESSION["ErrosCadastroUsuario"])) {

					$erros = $_SESSION["ErrosCadastroUsuario"];

					if (isset($erros["Nome"])){

						echo '
							
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorNome").css("display", "block");

								});
							
							</script>
						
						';

					}

					if (isset($erros["Email"])){

						echo '
							
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorEmail").css("display", "block");

								});
							
							</script>
						
						';

					}

					if(isset($erros["CPF"])){

						echo '
							
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorCPF").css("display", "block");

								});
							
							</script>
						
						';

					}

					if(isset($erros["Data"])){

						echo '
							
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorDataNasc").css("display", "block");

								});
							
							</script>
						
						';
						
					}

					if(isset($erros["Telefone"])){

						echo '
							
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorTelefone").css("display", "block");

								});
							
							</script>
						
						';

					}

					if(isset($erros["Celular"])){

						echo '
							
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorCelular").css("display", "block");

								});
							
							</script>
						
						';

					}

					if(isset($erros["Senha"])){

						echo '
							
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorSenha").css("display", "block");

								});
							
							</script>
						
						';

					}

				}
				

		?>

		<main id = "MainRegisterUser">

			<div class = "FormPlatform BS">

				<form method = "POST" action = "sql/VerificaCadastro.php">

					<ul class = "FormPlatformContent">

						<li class = "ContentHeader">
							<h1> Criar Conta </h1>
						</li>
						<li class = "ContentInput">
							<label for = "R_UserNome"> Nome </label>
							<span id = "ErrorNome" class = "txtError"> Nome inválido </span>
							<input id = "R_UserNome" class = "UserInputData" type = "text" name = "nome" required />
						</li>
						<li class = "ContentInput">
							<label for = "R_UserCPF"> CPF </label>
							<span id = "ErrorCPF" class = "txtError"> CPF inválido </span>
							<input id = "R_UserCPF" class = "UserInputData" type = "text" name = "CPF" required />
						</li>
						<li class = "ContentInput">
							<label for = "R_UserGenero"> Gênero </label>
							<select name = "Genero" id = "R_UserGenero" class = "UserSelectData" required>
								<option value = "Feminino"> Feminino </option>
								<option value = "Masculino"> Masculino </option>
								<option value = "Outros"> Prefiro não informar </option>
                            </select>
						</li>
						<li class = "ContentInput">
							<label for = "R_UserDataNasc"> Data de Nascimento </label>
							<span id = "ErrorDataNasc" class = "txtError"> Data inválida </span>
							<input id = "R_UserDataNasc" class = "UserInputData" type = "date" name = "data" required />
						</li>
						<li class = "ContentInput">
							<label for = "R_UserEmail"> Email </label>
							<span id = "ErrorEmail" class = "txtError"> Email inválido </span>
							<input id = "R_UserEmail" class = "UserInputData" type = "email" name = "email" required />
						</li>
						<li class = "ContentInput">
							<label for = "R_UserTelefone"> Telefone de contato </label>
							<span id = "ErrorTelefone" class = "txtError"> Telefone inválido </span>
							<input id = "R_UserTelefone" class = "UserInputData" type = "text" name = "telefone" placeholder = "Fixo ou móvel" required />
						</li>
						<li class = "ContentInput">
							<label for = "R_UserSenha"> Senha </label>
							<span id = "ErrorSenha" class = "txtError"> Senha inválida </span>
							<input id = "R_UserSenha" class = "UserInputData" type = "password" name = "senha" required />
						</li>
						<li class = "ContentBottom">
							<a href="LoginUser.php"> Já possui uma conta? </a>
							<input class = "UserInputSubmit btn" type = "submit" value = "Cadastrar">
						</li>

					</ul>

				</form>

			</div>

		</main>

	</body>

</html>