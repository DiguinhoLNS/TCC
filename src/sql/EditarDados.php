<?php

date_default_timezone_set('America/Sao_Paulo');

include_once "ConexaoBD.php";
include_once "Funcoes.php";

$tipo_verificacao = $_SESSION['TipoVerificação'];

switch ($tipo_verificacao) {

    case "Usuario":

        $id = ClearInjectionXSS($base, base64_decode($_COOKIE["ID"]));
        $nome = ClearInjectionXSS($base, $_POST["nome"]);
        $cpf = ClearInjectionXSS($base, $_SESSION['cpfsemponto']);
        $data = ClearInjectionXSS($base, $_POST["data"]);
        $telefone = ClearInjectionXSS($base, $_POST["telefone"]);
        $genero = ClearInjectionXSS($base, $_POST["Genero"]);
        $email = ClearInjectionXSS($base, $_POST["email"]);

        $query = "UPDATE usuarios SET Nome_user='$nome', Genero_user='$genero', Data_nasc_user = '$data', CPF_user = '$cpf', Email_user = '$email', Telefone_user = '$telefone' WHERE id_user='$id'";

        $executandoQuery = mysqli_query($base, $query) or die("Deu errado");       

        $conexao->query($query) === TRUE ? header("Location: ../User.php") : header("Location: ../EditUser.php");

        break;

    case "Empresa":

        $id_empresa = ClearInjectionXSS($base, $_GET["q"]);
        $nome = ClearInjectionXSS($base, $_POST["nome"]);
        $email = ClearInjectionXSS($base, $_POST["email"]);
        $cnpj = ClearInjectionXSS($base, $_SESSION['cnpjsemponto']);
        $telefone = ClearInjectionXSS($base, $_POST["telefone"]);
        $cor = ClearInjectionXSS($base, $_POST["CorLayout"]);
        $endereco = ClearInjectionXSS($base, $_POST["endereco"]);

        $query = "UPDATE empresas SET Nome='$nome', Email='$email', CNPJ = '$cnpj', Telefone = '$telefone', Cor_layout = '$cor', Endereco = '$endereco' WHERE id_empresa='$id_empresa'";

        $executandoQuery = mysqli_query($base, $query) or die("Deu errado 2");       

        $conexao->query($query) === TRUE ? header("Location: ../Company.php?q=".$id_empresa) : header("Location: ../EditCompany.php");
   

        break;
}

$conexao->close();
