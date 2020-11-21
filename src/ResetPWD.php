<?php

    require_once "sql/ConexaoBD.php";
    require_once "sql/Funcoes.php";
    require_once "sql/Email.php";

    $email = new Email();
    $func = new Funcoes();

    if(isset($_POST["Enviar"])){

        $EnvioEmail = false;
        $email_user = $_POST["E_Email"];
        $DadosUsuario = $func->PegarDadosUsuarioPeloEmail($email_user);

        if($DadosUsuario["EmailExiste"]){

            try{
                
                $email->setPara($email_user);
                $email->EditarSenha($func->Criptografar($DadosUsuario["Dados"][0]["id_user"]));

                $EnvioEmail = true;

            }catch(Exception $e){

                $EnvioEmail = false;

            }

        }else{

            $EnvioEmail = false;

        }

    }

?>

<!DOCTYPE html>
<html lang = "pt-br">

    <head>

        <title> Redefinir Senha </title>

        <?php include "include/Head.php"; ?>

    </head>

    <body id = "EditSenhaPage" class = "LightMode">

        <?php
        
            include "php/Pag.php";

            StopUserAccess();

            if(isset($EnvioEmail)){

                if($EnvioEmail){

                    echo '
                        <script language = "javascript" type = "text/javascript">
                                
                            $(document).ready(function(){
    
                                $(".EmailContent").css("display", "block");
    
                            });
                        
                        </script> 
                    
                    ';
    
                }else{
    
                    echo '
                            <script language = "javascript" type = "text/javascript">
                                    
                            $(document).ready(function(){

                                $(".txtError").css("display", "block");

                            });
                        
                        </script>
                    
                    ';
    
                }

            }

        ?>

        <main id = "MainEditSenha" class = "MainFormPlatform">

            <div class = "FormPlatform FormEdit BS">

                <form class = "FormData" method = "POST" action = "ResetPWD.php">

                    <ul class = "FormPlatformContent">
                    
                        <li class = "ContentHeader">
                            <h1> Redefinir Senha </h1>
                        </li>
                        <li class = "ContentInfo EmailContent" style = "display: none">
                            <h2> Enviamos um email para você redefinir a sua senha </h2>
                        </li>
                        <li class = "ContentInput">
							<label for = "E_Email"> Enviar Email </label>
							<input name = "E_Email" id = "E_Email" class = "UserInputData" type = "email" required />
						</li>
						<li class = "ContentError">
							<span id = "ErrorEmail" class = "txtError"> Email inexistente </span>
						</li>
						<li class = "ContentBottom">
							<a href = "LoginUser.php"> Voltar </a>
							<input class = "UserInputSubmit btn" type = "submit" name = "Enviar" value = "Redefinir Senha">
						</li>

                    </ul>

                </form>

            </div>

        </main>

    </body>

</html>