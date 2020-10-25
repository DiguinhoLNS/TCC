<?php 

	session_start(); 
	date_default_timezone_set('America/Sao_Paulo');
	
	$_SESSION['TipoVerificação'] = "Empresa";
	
?>

<!DOCTYPE html>
<html lang = "pt-br">

    <head>

        <title> Criar Página </title>

        <?php include "include/Head.php"; ?>

    </head>

    <body id = "RegisterCompanyPage" class = "LightMode">

        <?php
        
            include "php/Pag.php";

			StopUserAccess();
			if($_COOKIE["VerificaErro"]){

				if(isset($_SESSION["ErrosCadastrosEmpresa"])){

					$erros = $_SESSION["ErrosCadastrosEmpresa"];

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

						if(isset($erros["CNPJ"])){

							echo '
								
								<script language = "javascript" type = "text/javascript">
								
									$(document).ready(function(){

										$("#ErrorCNPJ").css("display", "block");

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

						if(isset($erros["Endereco"])){

							echo '
								
								<script language = "javascript" type = "text/javascript">
								
									$(document).ready(function(){

										$("#ErrorEndereco").css("display", "block");

									});
								
								</script>
							
							';
							
						}

					}
			}

		?>

        <main id = "MainRegisterCompany">

            <div class = "FormPlatform BS">

                <form method = "POST" action = "sql/VerificaCadastro.php">

                    <ul class = "FormPlatformContent">

                        <li class = "ContentHeader">
							<h1> Criar Página </h1>
                        </li>
                        <li class = "ContentInput">
							<label for = "R_CompanyNome"> Nome </label>
							<span id = "ErrorNome" class = "txtError"> Nome inválido </span>
							<input id = "R_CompanyNome" class = "UserInputData" type = "text" name = "nome" required />
						</li>
						<li class = "ContentInput">
							<label for = "R_CompanyEmail"> Email </label>
							<span id = "ErrorEmail" class = "txtError"> Email inválido </span>
							<input id = "R_CompanyEmail" class = "UserInputData" type = "email" name = "email" required />
                        </li>
                        <li class = "ContentInput">
							<label for = "R_CompanyCNPJ"> CNPJ </label>
							<span id = "ErrorCNPJ" class = "txtError"> CNPJ inválido </span>
							<input id = "R_CompanyCNPJ" class = "UserInputData InputCNPJ" type = "text" name = "cnpj" required />
						</li>
                        <li class = "ContentInput">
							<label for = "R_CompanyEndereco"> Endereço </label>
							<span id = "ErrorEndereco" class = "txtError"> Endereço inválido </span>
							<input id = "R_CompanyEndereco" class = "UserInputData" type = "text" name = "endereco" required />
                        </li>
                        <li class = "ContentInput">
							<label for = "R_CompanyTelefone"> Telefone Fixo </label>
							<span id = "ErrorTelefone" class = "txtError"> Telefone inválido </span>
							<input id = "R_CompanyTelefone" class = "UserInputData InputTelefone8" type = "text" name = "telefone" required />
                        </li>
                        <li class = "ContentInput">
							<label for = "R_CompanyCor"> Cor </label>
							<select name = "CorLayout" id = "R_CompanyCor" class = "UserSelectData">
                                <option value = "ThemeDefault"> Padrão </option>
                                <option value = "ThemeBlue"> Azul </option>
                                <option value = "ThemeRed"> Vermelho </option>
                                <option value = "ThemeYellow"> Amarelo </option>
                                <option value = "ThemeGreen"> Verde </option>
                                <option value = "ThemePink"> Rosa </option>
                                <option value = "ThemePurple"> Roxo </option>
                                <option value = "ThemeOrange"> Laranja </option>
                                <option value = "ThemeTeal"> Ciano </option>
                                <option value = "ThemeBrown"> Marrom </option>
                            </select>
                        </li>
                        <li class = "ContentBottom">
							<a href = "LoginCompany.php"> Já possui uma página? </a>
							<input class = "UserInputSubmit btn" type = "submit" value = "Criar">
						</li>
                        
                    </ul>

                </form>

            </div>

        </main>

    </body>

</html>