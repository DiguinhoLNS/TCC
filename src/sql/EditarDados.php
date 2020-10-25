<?php

date_default_timezone_set('America/Sao_Paulo');

include_once "ConexaoBD.php";
include_once "Funcoes.php";

$tipo_verificacao = $_SESSION['TipoVerificação'];

switch ($tipo_verificacao) {

    case "Usuario":

        $id = mysqli_real_escape_string($base, $_COOKIE['ID']);
        $nome = mysqli_real_escape_string($base, $_POST["nome"]);
        $cpf = mysqli_real_escape_string($base, $_SESSION['cpfsemponto']);
        $data = mysqli_real_escape_string($base, $_POST["data"]);
        $telefone = mysqli_real_escape_string($base, $_POST["telefone"]);
        $genero = mysqli_real_escape_string($base, $_POST["Genero"]);
        $email = mysqli_real_escape_string($base, $_POST["email"]);
        $senha = mysqli_real_escape_string($base, $_POST["senha"]);
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        $query = "UPDATE usuarios SET Nome_user='$nome', Genero_user='$genero', Data_nasc_user = '$data', CPF_user = '$cpf', Email_user = '$email', Telefone_user = '$telefone', Senha_user = '$senhaCriptografada' WHERE id_user='$id'";

        $executandoQuery = mysqli_query($base, $query) or die("Deu errado");       

        $conexao->query($query) === TRUE ? header("Location: ../User.php") : header("Location: ../EditUser.php");

        break;

    case "Empresa":

        $id_empresa = mysqli_real_escape_string($base, $_GET["q"]);
        $nome = mysqli_real_escape_string($base, $_POST["nome"]);
        $email = mysqli_real_escape_string($base, $_POST["email"]);
        $cnpj = mysqli_real_escape_string($base, $_SESSION['cnpjsemponto']);
        $telefone = mysqli_real_escape_string($base, $_POST["telefone"]);
        $cor = mysqli_real_escape_string($base, $_POST["CorLayout"]);
        $endereco = mysqli_real_escape_string($base, $_POST["endereco"]);

        $query = "UPDATE empresas SET Nome='$nome', Email='$email', CNPJ = '$cnpj', Telefone = '$telefone', Cor_layout = '$cor', Endereco = '$endereco' WHERE id_empresa='$id_empresa'";

        $executandoQuery = mysqli_query($base, $query) or die("Deu errado 2");       

        $conexao->query($query) === TRUE ? header("Location: ../Company.php?q=".$id_empresa) : header("Location: ../EditCompany.php");
   

        break;
}

$conexao->close();
