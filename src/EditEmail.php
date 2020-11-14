<?php 

    session_start();
	date_default_timezone_set('America/Sao_Paulo'); 

	require_once "sql/Funcoes.php";
    $func = new Funcoes();

	$email = $_SESSION["email"];
	$_SESSION["email"] = $email;
	$_SESSION['TipoVerificação'] = "EditarEmail";
    
?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Alterar Email </title>

        <?php include "include/Head.php"; ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    </head>
    
    <body id = "EditEmailPage" class = "LightMode">

	<?php

		if($_COOKIE["VerificaErro"] == 1){

			echo '
						
				<script language = "javascript" type = "text/javascript">
				
					$(document).ready(function(){

						$("#ErrorEmail").css("display", "block");

					});
				
				</script>
			
			';
			}

		?>

        <main id = "MainEditEmail" class = "MainFormPlatform">

			<div class = "FormPlatform FormEdit BS">

				<form class = "FormData" method = "POST" action = "sql/VerificaCadastro.php">

					<ul class = "FormPlatformContent">

						<li class = "ContentHeader">
							<h1> Alterar Email </h1>
						</li>
						<li class = "ContentInput">
							<label for = "E_Email"> Novo Email </label>
							<input name = "E_Email" id = "E_Email" class = "UserInputData" type = "email" required />
						</li>
						<li class = "ContentError">
							<span id = "ErrorEmail" class = "txtError"> Email já cadastrado </span><br>
						</li>
						<li class = "ContentBottom">
							<a href = "VerificationUser.php?e=<?= $func->Criptografar($email)?>"> Voltar </a>
							<input class = "UserInputSubmit btn" type = "submit" value = "Alterar Email">
						</li>

					</ul>

				</form>

			</div>

		</main>

    </body>

</html>