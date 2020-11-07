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

    case "Item":

        $id_obj = $func->ClearInjectionXSS(base64_decode($_GET['q']));
        $nome = $func->ClearInjectionXSS($_POST["nome"]);
        $foto = $_FILES["foto"];
        $categoria = $func->ClearInjectionXSS($_POST["categoria"]);
        $descricao = $func->ClearInjectionXSS($_POST["descricao"]);

        $func->PegarDadosItemPeloId($id_obj);

        list($tipo, $extensao) = explode("/", $foto["type"]);

        $tipo = strtolower($tipo);
        $extensao = strtolower($extensao);

        $novoNome = md5(time()) . "." . $extensao;
        $diretorio = "C:\Users\T-Gamer\Documents\GitHub\TCC\src\imagesBD/";

        move_uploaded_file($foto["tmp_name"], $diretorio . $novoNome);

        try {

            $query = "UPDATE objetos SET Nome_foto = :nome_foto, Nome_obj = :nome_obj, Categoria = :categoria, Descricao = :descricao WHERE id_obj = :id_obj";

            $sql = $conn->dbh->prepare($query);
            $sql->execute([':nome_foto' => $novoNome, ':nome_obj' => $nome, ':categoria' => $categoria, ':descricao' => $descricao]);
            header("Location: ../Feed.php?q=" . base64_encode($id_empresa));

        } catch (PDOException $e) {
            die("Erro no SQL");
        }



        break;
}

$conn = null;
