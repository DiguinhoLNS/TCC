<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    require_once "sql/Email.php";
    require_once "sql/Funcoes.php";

    $func = new Funcoes();

    if(isset($_COOKIE["ULogged"])){
        setcookie("ULogged", "", time() - (86400 * 30), "/");
        setcookie("ID", "", time() - (86400 * 30), "/");

        header("Location: Index.php");
    }

    isset($_GET['q']) ? $email = true: $email = false;
    if (isset($_GET['e'])) {
        
        $email = false; 
        $emailUser = $func->Descriptografar($_GET['e']);

    }

    if (isset($_POST['V'])) {
        if ($_SESSION['cod'] == strtoupper($_POST["V_Cod"])) {
            header("Location: Dashboard.php");
            setcookie("ULogged",$func->Criptografar("1"), time() + (86400 * 30), "/");
        } else {
            $emailUser = isset($_SESSION["email"]) ? $_SESSION["email"] : $func->Descriptografar($_GET["q"]);

            $erro = true;
        }
    }

    if ($email && !isset($erro) && !isset($_COOKIE["ULogged"])) {
        $emailUser = isset($_SESSION["email"]) ? $_SESSION["email"] : $func->Descriptografar($_GET["q"]);

        $email = new Email();
        $cod = $func->GerarCodigoDuasEtapas();
        $email->setPara($emailUser);
        $_SESSION['cod'] = $cod;
        $email->DuasEtapas($cod);
    }

?>

<!DOCTYPE html>
<html lang = "pt-br">

    <head>

        <title> Verificação </title>

        <?php include "include/Head.php"; ?>

    </head>

    <body id = "LoginUserPage" class = "LightMode">

        <?php

            include "php/Pag.php";

            StopUserAccess();

            if (isset($erro)) {

                echo '
                            
                    <script language = "javascript" type = "text/javascript">
                    
                        $(document).ready(function(){

                            $("#ErrorCod").css("display", "block");

                        });
                    
                    </script>
                
                ';
            
            } 

        ?>

        <main id = "MainLoginUser" class = "MainFormPlatform">

            <div class = "FormPlatform FormVerification BS">

                <form class = "FormData" method = "POST" action = "VerificationUser.php">

                    <ul class = "FormPlatformContent">

                        <li class = "ContentHeader">
                            <h1> Verificação </h1>
                        </li>
                        <li class = "ContentInfo">
                            <h2> Enviamos um código de verificação para <?=$emailUser?> </h2>
                        </li>
                        <li class = "ContentInput">
                            <label for = "V_Cod"> Código de Verificação </label>
                            <input name = "V_Cod" id = "V_Cod" class = "UserInputData" type = "text" maxlength = "6" required />
                        </li>
                        <li class = "ContentError">
                            <span id = "ErrorCod" class = "txtError"> Código incorreto </span>
                        </li>
                        <li class = "ContentBottom">
                            <a href = "VerificationUser.php?q=456283650135783"> Enviar código novamente </a>
                            <input class = "UserInputSubmit btn" type = "submit" value = "Verificar" name = "V">
                        </li>

                    </ul>

                </form>

                <!-- <div class = "FormControl">

					<ul class = "FormControlContent">
					
						<li class = "ContentHeader">
							<i class = "material-icons"> &#xe0da; </i>
							<h1> Verificação APE </h1>
						</li>
						<li class = "ContentControl">
							<a href = "EditEmail.php" class = "btn"> Editar Email </a>
						</li>

					</ul>

				</div> -->

            </div>

        </main>

    </body>

</html>