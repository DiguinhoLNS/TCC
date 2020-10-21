<?php 

	session_start(); 

    $_SESSION['V'] = '2';

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

            if(!isset($_SESSION["CompanyRegisterError_G"])){

				$_SESSION["CompanyRegisterError_G"] = 0;
				$_SESSION["CompanyRegisterError_1"] = 0;
				$_SESSION["CompanyRegisterError_2"] = 0;
				$_SESSION["CompanyRegisterError_3"] = 0;
				$_SESSION["CompanyRegisterError_4"] = 0;
				$_SESSION["CompanyRegisterError_5"] = 0;

			} else {

				$CompanyRegisterError_G = $_SESSION["CompanyRegisterError_G"];
				$CompanyRegisterError_1 = $_SESSION["CompanyRegisterError_1"];
				$CompanyRegisterError_2 = $_SESSION["CompanyRegisterError_2"];
				$CompanyRegisterError_3 = $_SESSION["CompanyRegisterError_3"];
				$CompanyRegisterError_4 = $_SESSION["CompanyRegisterError_4"];
                $CompanyRegisterError_5 = $_SESSION["CompanyRegisterError_5"];

                if ($CompanyRegisterError_G == "1"){

					if ($CompanyRegisterError_1 == "1"){

						echo '
							
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorNome").css("display", "block");

								});
							
							</script>
						
						';

					}

					if ($CompanyRegisterError_2 == "1"){

						echo '
							
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorEmail").css("display", "block");

								});
							
							</script>
						
						';

					}

					if($CompanyRegisterError_3 == "1"){

						echo '
							
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorCNPJ").css("display", "block");

								});
							
							</script>
						
						';

					}

					if($CompanyRegisterError_4 == "1"){

						echo '
							
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorTelefone).css("display", "block");

								});
							
							</script>
						
						';
						
					}

					if($CompanyRegisterError_5 == "1"){

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

        <main id = "MainEditCompany">

            <div class = "FormPlatform BS">

                <form method = "POST" action = "sql/.php">

                    <ul class = "FormPlatformContent">

                        <li class = "ContentHeader">
							<h1> Editar Empresa </h1>
                        </li>
                        <li class = "ContentInput">
							<label for = "E_CompanyNome"> Nome </label>
							<span id = "ErrorNome" class = "txtError"> Nome inválido </span>
							<input id = "E_CompanyNome" class = "UserInputData" type = "text" name = "nome" required />
						</li>
						<li class = "ContentInput">
							<label for = "E_CompanyEmail"> Email </label>
							<span id = "ErrorEmail" class = "txtError"> Email inválido </span>
							<input id = "E_CompanyEmail" class = "UserInputData" type = "email" name = "email" required />
                        </li>
                        <li class = "ContentInput">
							<label for = "E_CompanyCNPJ"> CNPJ </label>
							<span id = "ErrorCNPJ" class = "txtError"> CNPJ inválido </span>
							<input id = "E_CompanyCNPJ" class = "UserInputData" type = "text" name = "cnpj" required />
						</li>
                        <li class = "ContentInput">
							<label for = "E_CompanyEndereco"> Endereço </label>
							<span id = "ErrorEndereco" class = "txtError"> Endereço inválido </span>
							<input id = "E_CompanyEndereco" class = "UserInputData" type = "text" name = "endereco" required />
                        </li>
                        <li class = "ContentInput">
							<label for = "E_CompanyTelefone"> Telefone Fixo </label>
							<span id = "ErrorTelefone" class = "txtError"> Telefone inválido </span>
							<input id = "E_CompanyTelefone" class = "UserInputData" type = "text" name = "telefone" required />
                        </li>
                        <li class = "ContentInput">
							<label for = "E_CompanyCor"> Cor </label>
							<select name = "CorLayout" id = "E_CompanyCor" class = "UserSelectData">
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
							<a href = "Company.php/?company="> Voltar </a>
							<input class = "UserInputSubmit btn" type = "submit" value = "Editar">
						</li>
                        
                    </ul>

                </form>

            </div>

        </main>

    </body>

</html>