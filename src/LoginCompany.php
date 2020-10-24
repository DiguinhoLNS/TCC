<?php 

    session_start();
    date_default_timezone_set('America/Sao_Paulo'); 
    
    $_SESSION['TipoVerificação'] = "Empresa";
    
?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Entrar em Página </title>

		<?php include "include/Head.php"; ?>

    </head>
    
    <body id = "LoginCompanyPage" class = "LightMode">

        <?php
        
            include "php/Pag.php";

            StopUserAccess();

        if($_COOKIE["VerificaErro"]){

            if (isset($_SESSION["ErroLoginEmpresa"])) {

                //Zerar erros no cadastro de empresa
                $_SESSION["ErrosCadastrosEmpresa"] = null;

                $erro = $_SESSION["ErroLoginEmpresa"];

                if ($erro) {

                    echo '
                            
                        <script language = "javascript" type = "text/javascript">
                        
                            $(document).ready(function(){

                                $("#ErrorCod").css("display", "block");

                            });
                        
                        </script>
                    
                    ';

                }


            }
        }
        
        ?>

        <main id = "MainLoginCompany">

            <div class = "FormPlatform BS">

                <form method = "POST" action = "sql/VerificaLogin.php">

                    <ul class = "FormPlatformContent">

                        <li class = "ContentHeader">
							<h1> Login Página </h1>
						</li>
						<li class = "ContentInput">
							<label for = "L_Cod"> Código </label>
							<input id = "L_Cod" class = "UserInputData" type = "text" name = "cod" required />
                        </li>
                        <li class = "ContentError">
							<span id = "ErrorCod" class = "txtError"> Código incorreto </span>
                        </li>
						<li class = "ContentBottom">
							<a href = "Dashboard.php"> Voltar para Dashboard </a>
							<input class = "UserInputSubmit btn" type = "submit" value = "Entrar">
						</li>

                    </ul>
                    
                </form>

            </div>
            
        </main>

    </body>

</html>