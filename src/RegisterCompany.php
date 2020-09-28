<?php session_start(); ?>

<!DOCTYPE html>
<html lang = "pt-br">

    <head>

        <title> Criar Página </title>

        <?php include "include/Head.php"; ?>

    </head>

    <body id = "RegisterCompanyPage" class = "LightMode">

        <main id = "MainRegisterCompany">

            <div class = "FormPlatform BS">

                <form method = "POST" action = "sql/.php">

                    <ul class = "FormPlatformContent">

                        <li class = "ContentHeader">
							<h1> Criar Página </h1>
                        </li>
                        <li class = "ContentInput">
							<label for = "R_"> Placeholder </label>
							<span id = "Error" class = "txtError"> Placeholder inválido </span>
							<input id = "R_" class = "UserInputData" type = "text" name = "" required />
                        </li>
                        <li class = "ContentBottom">
							<a href = "LoginCompany.php"> Já possui uma página? </a>
							<input class = "UserInputSubmit btn" type = "submit" value = "Cadastrar">
						</li>
                        
                    </ul>

                </form>

            </div>

        </main>

    </body>

</html>