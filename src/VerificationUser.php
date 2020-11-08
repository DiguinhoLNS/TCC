<?php 

	session_start();
	date_default_timezone_set('America/Sao_Paulo'); 
    
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
            
        ?>

        <main id = "MainLoginUser" class = "MainFormPlatform">

            <div class = "FormPlatform FormVerification BS">

                <form class = "FormData" method = "POST" action = "sql/VerificaLogin.php">

                    <ul class = "FormPlatformContent">

                        <li class = "ContentHeader">
                            <h1> Verificação </h1>
                        </li>
                        <li class = "ContentInput">
                            <label for = "V_Cod"> Código de Verificação </label>
                            <input name = "V_Cod" id = "V_Cod" class = "UserInputData" type = "text" maxlength = "6" required/>
                        </li>
                        <li class = "ContentError">
                            <span id = "ErrorCod" class = "txtError"> Código incorretos </span>
                        </li>
                        <li class = "ContentBottom">
                            <a> Enviar código novamente </a>
                            <input class = "UserInputSubmit btn" type = "submit" value = "Verificar">
                        </li>

                    </ul>

                </form>

            </div>

        </main>

    </body>

</html>