<?php 

    session_start();
    date_default_timezone_set('America/Sao_Paulo'); 
    
?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Alterar Email </title>

        <?php include "include/Head.php"; ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    </head>
    
    <body id = "EditEmailPage" class = "LightMode">

        <main id = "MainEditEmail" class = "MainFormPlatform">

			<div class = "FormPlatform FormEdit BS">

				<form class = "FormData" method = "POST" action = "sql/.php">

					<ul class = "FormPlatformContent">

						<li class = "ContentHeader">
							<h1> Alterar Email </h1>
						</li>
						<li class = "ContentInput">
							<label for = "E_Email"> Novo Email </label>
							<input name = "E_Email" id = "E_Email" class = "UserInputData" type = "email" required />
						</li>
						<li class = "ContentCaptcha">
							<div class = "g-recaptcha" data-sitekey = "6LcNseAZAAAAAHJ_Z0_pIVNvaZEEoqhwHnGz2pMD"></div>
						</li>
						<li class = "ContentError">
							<span id = "ErrorEmail" class = "txtError"> Email incorreto </span>
							<span id = "ErrorCaptcha" class = "txtError"> Preencha o captcha </span>
						</li>
						<li class = "ContentBottom">
							<input class = "UserInputSubmit btn" type = "submit" value = "Alterar Email">
						</li>

					</ul>

				</form>

			</div>

		</main>

    </body>

</html>