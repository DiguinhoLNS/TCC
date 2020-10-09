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
							<label for = "R_Nome"> Nome </label>
							<span id = "ErrorNome" class = "txtError"> Nome inválido </span>
							<input id = "R_Nome" class = "UserInputData" type = "text" name = "nome" required />
                        </li>
                        <li class = "ContentInput">
							<label for = "R_CNPJ"> CNPJ </label>
							<span id = "ErrorCNPJ" class = "txtError"> CNPJ inválido </span>
							<input id = "R_CNPJ" class = "UserInputData" type = "number" name = "cnpj" required />
                        </li>
                        <li class = "ContentInput">
							<label for = "R_Endereco"> Endereço </label>
							<span id = "ErrorEndereco" class = "txtError"> Endereço inválido </span>
							<input id = "R_Endereco" class = "UserInputData" type = "text" name = "endereco" required />
                        </li>
                        <li class = "ContentInput">
							<label for = "R_Email"> Email </label>
							<span id = "ErrorEmail" class = "txtError"> Email inválido </span>
							<input id = "R_Email" class = "UserInputData" type = "email" name = "email" required />
                        </li>
                        <li class = "ContentInput">
							<label for = "R_Telefone"> Telefone </label>
							<span id = "ErrorTelefone" class = "txtError"> Telefone inválido </span>
							<input id = "R_Telefone" class = "UserInputData" type = "number" name = "telefone" required />
                        </li>
                        <li class = "ContentInput">
							<label for = "R_Cor"> Cor </label>
							<span id = "ErrorCor" class = "txtError"> Cor inválida </span>
							<select name = "CorLayout" id = "R_Cor" class = "UserSelectData">
                                <option value = "ThemeDefault"> Padrão </option>
                                <option value = "ThemeBlue"> Azul </option>
                                <option value = "ThemeRed"> Vermelho </option>
                                <option value = "ThemePink"> Rosa </option>
                                <option value = "ThemeGreen"> Verde </option>
                                <option value = "ThemePurple"> Roxo </option>
                                <option value = "ThemeOrange"> Laranja </option>
                                <option value = "ThemeTeal"> Ciano </option>
                                <option value = "ThemeBrown"> Marrom </option>
                            </select>
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