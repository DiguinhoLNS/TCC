<?php

date_default_timezone_set('America/Sao_Paulo');

require_once "ConexaoBD.php";
require_once "Funcoes.php";

$conn = new ConexaoBD();
$func = new Funcoes();

$tipo_verificacao = $_SESSION['TipoVerificação'];

switch ($tipo_verificacao) {

    case "Usuario":

        $id = $func->ClearInjectionXSS($func->Descriptografar($_COOKIE["ID"]));
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

        $conn->dbh->query($query) ? header("Location: ../Company.php?q=" . $func->Criptografar($id_empresa)) : header("Location: ../EditCompany.php?q=" . $func->Criptografar($id_empresa));


        break;

    case "Item":

        $id_obj = $func->ClearInjectionXSS(base64_decode($_GET['q']));
        $nome = $func->ClearInjectionXSS($_POST["nome"]);
        //$foto = $_FILES["foto"];
        $categoria = $func->ClearInjectionXSS($_POST["categoria"]);
        $descricao = $func->ClearInjectionXSS($_POST["descricao"]);
        $situacao = $func->ClearInjectionXSS($_POST["situacao"]);

        $DadosItem = $func->PegarDadosItemPeloId($id_obj);

        try {

            $query = "UPDATE objetos SET Nome_obj = :nome_obj, Categoria = :categoria, Descricao = :descricao, situacao = :situacao WHERE id_obj = :id_obj";

            $sql = $conn->dbh->prepare($query);
            $sql->execute([':nome_obj' => $nome, ':categoria' => $categoria, ':descricao' => $descricao, ':situacao' => $situacao, ':id_obj' => $id_obj]);
            header("Location: ../Feed.php?q=".$func->Criptografar($DadosItem["Objeto"][0]["id_empresa"]));

        } catch (PDOException $e) {
            die("Erro no SQL ". $e);
        }

        break;

        case "EditarEmail":

            $emailNovo = $func->ClearInjectionXSS($_POST["E_Email"]);
            $emailAntigo = $_SESSION["email"];

            try {

                $query = "UPDATE usuarios SET Email_user = :email WHERE Email_user = :email_antigo";
    
                $sql = $conn->dbh->prepare($query);
                $sql->execute([':email' => $emailNovo, ':email_antigo' => $emailAntigo]);
                $_SESSION["email"] = $emailNovo;
                header("Location: ../VerificationUser.php?q=".$func->Criptografar($emailNovo));
    
            } catch (PDOException $e) {
                die("Erro no SQL ". $e);
            }


        break;
}

$conn = null;
