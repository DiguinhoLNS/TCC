<?php

date_default_timezone_set('America/Sao_Paulo');

include_once "ConexaoBD.php";
include_once "Funcoes.php";

$tipo_verificacao = $_SESSION['TipoVerificação'];

switch ($tipo_verificacao) {

    case "Usuario":

        $id = $_COOKIE['ID'];
        $nome = $_POST["nome"];
        $cpf = $_SESSION['cpfsemponto'];
        $data = $_POST["data"];
        $telefone = $_POST["telefone"];
        $genero = $_POST["Genero"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $query = "UPDATE usuarios SET Nome_user='$nome', Genero_user='$genero', Data_nasc_user = '$data', CPF_user = '$cpf', Email_user = '$email', Telefone_user = '$telefone', Senha_user = '$senha' WHERE id_user='$id'";

        $executandoQuery = mysqli_query($base, $query) or die("Deu errado");       

        $conexao->query($query) === TRUE ? header("Location: ../User.php") : header("Location: ../EditUser.php");

        break;

    case "Empresa":

        $id_empresa = $_GET["q"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $cnpj = $_SESSION['cnpjsemponto'];
        $telefone = $_POST["telefone"];
        $cor = $_POST["CorLayout"];
        $endereco = $_POST["endereco"];

        $query = "UPDATE empresas SET Nome='$nome', Email='$email', CNPJ = '$cnpj', Telefone = '$telefone', Cor_layout = '$cor', Endereco = '$endereco' WHERE id_empresa='$id_empresa'";

        $executandoQuery = mysqli_query($base, $query) or die("Deu errado 2");       

        $conexao->query($query) === TRUE ? header("Location: ../Company.php?q=".$id_empresa) : header("Location: ../EditCompany.php");
   

        break;
}

$conexao->close();
