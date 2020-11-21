<?php

require_once "sql/ConexaoBD.php";
require_once "sql/Funcoes.php";
require_once "sql/Email.php";

$email = new Email();
$func = new Funcoes();

if(isset($_POST["Enviar"])){

    $email_user = $_POST["email"];
    $DadosUsuario = $func->PegarDadosUsuarioPeloEmail($email_user);

    if($DadosUsuario["EmailExiste"]){

        try{
        $email->setPara($email_user);
        $email->EditarSenha($func->Criptografar($DadosUsuario["Dados"][0]["id_user"]));
        echo "Email Enviado, caso não tenha recebido, digite o seu endereço de email novamente";
        }catch(Exception $e){
            echo "Erro no envio do email";
        }

    }else{
        echo "O email não existe";
    }

}



?>

<form action="ResetPWD.php" method="POST">

    <input type="email" name="email" placeholder="email" required>
    <input type="submit" name="Enviar" value="Enviar"> 

</form>