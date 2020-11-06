<?php

date_default_timezone_set('America/Sao_Paulo');

require_once "ConexaoBD.php";
require_once "Funcoes.php";

$conn = new ConexaoBD();
$func = new Funcoes();

$tipo_verificacao = $_SESSION['TipoVerificação'];

switch ($tipo_verificacao) {

    case "Usuario":

        $id = $func->ClearInjectionXSS(base64_decode($_COOKIE["ID"]));
        $nome = $func->ClearInjectionXSS($_POST["nome"]);
        $cpf = $func->ClearInjectionXSS($_SESSION['cpfsemponto']);
        $data = $func->ClearInjectionXSS($_POST["data"]);
        $telefone = $func->ClearInjectionXSS($_POST["telefone"]);
        $genero = $func->ClearInjectionXSS($_POST["Genero"]);
        $email = $func->ClearInjectionXSS($_POST["email"]);

        $query = "UPDATE usuarios SET Nome_user='$nome', Genero_user='$genero', Data_nasc_user = '$data', CPF_user = '$cpf', Email_user = '$email', Telefone_user = '$telefone' WHERE id_user='$id'";

        $executandoQuery = $conn->dbh->query($query) or die("Deu errado");

        $conn->dbh->query($query) ? header("Location: ../User.php") : header("Location: ../EditUser.php");

        break;

    case "Empresa":

        $id_empresa = $func->ClearInjectionXSS(base64_decode($_GET["q"]));
        $nome = $func->ClearInjectionXSS($_POST["nome"]);
        $email = $func->ClearInjectionXSS($_POST["email"]);
        $cnpj = $func->ClearInjectionXSS($_SESSION['cnpjsemponto']);
        $telefone = $func->ClearInjectionXSS($_POST["telefone"]);
        $cor = $func->ClearInjectionXSS($_POST["CorLayout"]);
        $endereco = $func->ClearInjectionXSS($_POST["endereco"]);

        $query = "UPDATE empresas SET Nome='$nome', Email='$email', CNPJ = '$cnpj', Telefone = '$telefone', Cor_layout = '$cor', Endereco = '$endereco' WHERE id_empresa='$id_empresa'";

        $executandoQuery = $conn->dbh->query($query) or die("Deu errado 2");

        $conn->dbh->query($query) ? header("Location: ../Company.php?q=" . base64_encode($id_empresa)) : header("Location: ../EditCompany.php?q=" . base64_encode($id_empresa));


        break;

    case "Promover":

        $id_UserEmpresa = $func->ClearInjectionXSS(base64_decode($_GET["q"]));

        try {

            $query = "UPDATE user_empresa SET Nivel_acesso= :nivel_acesso WHERE id_user_empresa= :id_user_empresa";
            $sql = $conn->dbh->prepare($query);
            $sql->execute([':nivel_acesso' => $id_UserEmpresa, ':id_user_empresa' => $id_UserEmpresa]);
            
        } catch (PDOException $e) {
            die("Erro na consulta");
        }


        break;

    case "Rebaixar":
        break;
}

$conn = null;
