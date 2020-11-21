<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    require_once "sql/ConexaoBD.php";
    require_once "sql/Funcoes.php";

    $conn = new ConexaoBD();
	$func = new Funcoes();
  
    $id = $func->Descriptografar($_GET["q"]);
    $_SESSION["id_editar_senha"] = $id;
    $_SESSION['TipoVerificação'] = "EditarSenha";

?>

<!DOCTYPE html>
<html lang = "pt-br">

    <head>

        <title> Alterar Dados </title>

        <?php include "include/Head.php"; ?>

    </head>

    <body id = "EditSenhaPage" class = "LightMode">

        <?php

            include "php/Pag.php";

            StopUserAccess();

            if($_COOKIE["VerificaErro"]){

				if (isset($_SESSION["ErrosEditarSenha"])) {
					

					$erros = $_SESSION["ErrosEditarSenha"];

					if (isset($erros["senha"]) || isset($erros["senha2"])){

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

        <main id = "MainEditSenha" class = "MainFormPlatform">

            <div class = "FormPlatform FormEdit BS">

                <form class = "FormData" method = "POST" action = "sql/VerificaCadastro.php">

                    <ul class = "FormPlatformContent">
                    
                        <li class = "ContentHeader">
                            <h1> Editar Senha </h1>
                        </li>
                        <li class = "ContentInput">
							<label for = "E_UserSenha"> Nova Senha </label>
							<input id = "E_UserSenha" class = "UserInputData" type = "password" name = "senha" required />
                        </li>
                        <li class = "ContentInput">
							<label for = "E_UserSenha2"> Redigite a Senha </label>
							<input id = "E_UserSenha2" class = "UserInputData" type = "password" name = "senha2" required />
                        </li>
                        <li class = "ContentError">
                            <span id = "ErrorSenha" class = "txtError"> Senhas inválidas ou incompatíveis </span>
                        </li>
                        <li class = "ContentBottom">
                            <a href = "LoginUser.php"> Voltar </a>
							<input class = "UserInputSubmit btn" type = "submit" value = "Alterar Senha">
						</li>
                    
                    </ul>

                </form>

            </div>

        </main>

    </body>

</html>