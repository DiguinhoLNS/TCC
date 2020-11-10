<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    require_once "mailer/Exception.php";
    require_once "mailer/SMTP.php";
    require_once "mailer/PHPMailer.php";
    require_once "sql/Funcoes.php";

    $func = new Funcoes();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if(isset($_COOKIE["ULogged"])){
        setcookie("ULogged", "", time() - (86400 * 30), "/");
        setcookie("ID", "", time() - (86400 * 30), "/");

        header("Location: Index.php");
    }

    $mail = new PHPMailer();

    isset($_GET['q']) ? $email = true: $email = false;

    if (isset($_POST['V'])) {
        if ($_SESSION['cod'] == $_POST["V_Cod"]) {
            header("Location: Dashboard.php");
            setcookie("ULogged", base64_encode("1"), time() + (86400 * 30), "/");
            //echo $_POST['V_Cod'] . "<br>erro1<br>" . $_SESSION['cod'];
        } else {
            //echo $_POST['V_Cod'] . "<br>erro2<br>" . $_SESSION['cod'];
            $erro = true;
        }
    }

    if ($email && !isset($erro) && !isset($_COOKIE["ULogged"])) {

        try {

            $emailUser = $_SESSION["email"];

            //echo $emailUser;

            $cod = $func->GerarCodigoAcesso();

            $cod = str_split($cod, 6);

            $rand = rand(0, 1);

            $cod = $cod[$rand];

            $_SESSION["cod"] = $cod;

            $mail->CharSet = 'UTF-8';
            $mail->setLanguage("pt");
            $mail->SMTPDebug = false;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->Username = 'ape.achadoseperdidos@gmail.com';
            $mail->Password = 'lmrt2020';

            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );

            //echo $cod;

            $mail->SetFrom('ape.achadoseperdidos@gmail.com', 'Ape Achados e Perdidos');
            $mail->addAddress($emailUser);

            $mail->isHTML(true);
            $mail->Subject = 'Código de verificação';
            //$mail->MsgHTML(file_get_contents('include/BodyMail.php'));
            $mail->Body = '
            <!DOCTYPE html>
            <html lang = "pt-br">
            
                <body class = "MailPage">
            
                    <main>
            
                        <h2 style = "color: #202124"> Aqui está o seu código de verificação de segurança da sua conta APE </h2>
                        <br/>
                        <h1 style = "color: #202124"> '.$cod.' </h1>
                        <br>
                        <p style = "color: #5F6368"> NÃO RESPONDA A ESSE EMAIL </p>
            
                    </main>
            
                </body>
            
            </html>';
            $mail->AltBody = $cod;

            if ($mail->send()) {
                //echo "Enviado";
            } else {
                //echo "Falha";
            }
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
        }
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
                            <h2> Enviamos para <?=$emailUser?><br> um código de verificação de segurança. </h2>
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

            </div>

        </main>

    </body>

</html>