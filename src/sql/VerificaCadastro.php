<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    include "ConexaoBD.php";
    include_once "Funcoes.php";

    $tipo_verificacao = $_SESSION['TipoVerificação'];

    switch($tipo_verificacao){

        case "Usuario":

            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $CpfComPonto = $_POST["CPF"];
            $data = $_POST["data"];
            $telefone = $_POST["telefone"];
            $genero = $_POST["Genero"];
            $senha = $_POST["senha"];

            $cpf = TirarPontoCPF($CpfComPonto);

            $ErroNosCampos = [
                "Nome" => false,
                "Email" => false,
                "CPF" => false,
                "Data" => false,
                "Endereco" => false,
                "Telefone" => false,
                "Senha" => false
            ];

            $ErroNosCampos["Nome"] = VerificarCadastroNome($nome);    

            $ErroNosCampos["CPF"] = VerificaCPF($cpf);

            $ErroNosCampos["Data"] = VerificaData($data);

            $ErroNosCampos["Telefone"] = VerificaTelefone($telefone);

            $ErroNosCampos["Senha"] = VerificaSenha($senha);

            $ErroNosCampos["CPF"] ? : $ErroNosCampos["CPF"] = VerificarSeUsuarioJaCadastrado($base, $email, $cpf);
            $ErroNosCampos["Email"] = VerificarSeUsuarioJaCadastrado($base, $email, $cpf); 

            foreach ($ErroNosCampos as $key => $verifica) {
                if ($verifica) {
                    $erros[$key] =  true;
                }
            }

            if (!isset($erros)) {

                $_SESSION["ErrosCadastroUsuario"] = null;
                include 'InsereCadastro.php';

            } else {

                $_SESSION["ErrosCadastroUsuario"] = $erros;
                header("Location: ../RegisterUser.php");          

            }

        break;

        case "Empresa":

            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $CnpjComPonto = $_POST["cnpj"];
            $telefone = $_POST["telefone"];
            $endereco = $_POST["endereco"];
            $cor = $_POST["CorLayout"];

            $cnpj = TirarPontoCNPJ($CnpjComPonto);

            $ErroNosCampos = [
                "Nome" => false,
                "Email" => false,
                "CNPJ" => false,
                "Telefone" => false,
                "Endereco" => false,
                "Cor" => false
            ];

            $ErroNosCampos["Nome"] = VerificarCadastroNome($nome);

            $ErroNosCampos["CNPJ"] = VerificaCNPJ($cnpj);

            $ErroNosCampos["Endereco"] = VerificarEndereco($endereco);

            $ErroNosCampos["Telefone"] = VerificaTelefone($telefone);

            $ErroNosCampos["CNPJ"] ? : $ErroNosCampos["CNPJ"] = VerificarSeEmpresaJaCadastrada($base, $email, $cnpj);
            $ErroNosCampos["Email"] = VerificarSeEmpresaJaCadastrada($base, $email, $cnpj);

            foreach ($ErroNosCampos as $key => $verifica) {
                if ($verifica) {
                    $erros[$key] =  true;
                }
            }

            if (!isset($erros)) {

                $_SESSION['TipoVerificação'] = "Empresa";
                $_SESSION["ErrosCadastrosEmpresa"] = null;
                include 'InsereCadastro.php';

            } else {

                $_SESSION["ErrosCadastrosEmpresa"] = $erros;
                header("Location: ../RegisterCompany.php");

            }


        break;

        case "EditarUsuario":
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $CpfComPonto = $_POST["CPF"];
            $data = $_POST["data"];
            $telefone = $_POST["telefone"];
            $genero = $_POST["Genero"];
            $senha = $_POST["senha"];

            $cpf = TirarPontoCPF($CpfComPonto);

            $ErroNosCampos = [
                "Nome" => false,
                "Email" => false,
                "CPF" => false,
                "Data" => false,
                "Endereco" => false,
                "Telefone" => false,
                "Senha" => false
            ];

            $ErroNosCampos["Nome"] = VerificarCadastroNome($nome);    

            $ErroNosCampos["CPF"] = VerificaCPF($cpf);

            $ErroNosCampos["Data"] = VerificaData($data);

            $ErroNosCampos["Telefone"] = VerificaTelefone($telefone);

            $ErroNosCampos["Senha"] = VerificaSenha($senha); 

            foreach ($ErroNosCampos as $key => $verifica) {
                if ($verifica) {
                    $erros[$key] =  true;
                }
            }

            if (!isset($erros)) {

                $_SESSION['TipoVerificação'] = "Usuario";
                include 'EditarDados.php';

            } else {

                $_SESSION["ErrosEditarUsuario"] = $erros;
                header("Location: ../EditUser.php");          

            }
        break;

        case "EditarEmpresa":
            $id_empresa = $_GET['q'];
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $CnpjComPonto = $_POST["cnpj"];
            $telefone = $_POST["telefone"];
            $endereco = $_POST["endereco"];
            $cor = $_POST["CorLayout"];

            $cnpj = TirarPontoCNPJ($CnpjComPonto);

            $ErroNosCampos = [
                "Nome" => false,
                "Email" => false,
                "CNPJ" => false,
                "Telefone" => false,
                "Endereco" => false,
                "Cor" => false
            ];

            $ErroNosCampos["Nome"] = VerificarCadastroNome($nome);

            $ErroNosCampos["CNPJ"] = VerificaCNPJ($cnpj);

            $ErroNosCampos["Endereco"] = VerificarEndereco($endereco);

            $ErroNosCampos["Telefone"] = VerificaTelefone($telefone);

            foreach ($ErroNosCampos as $key => $verifica) {
                if ($verifica) {
                    $erros[$key] =  true;
                }
            }

            if (!isset($erros)) {

                $_SESSION['TipoVerificação'] = "Empresa";
                include "EditarDados.php";

            } else {

                $_SESSION["ErrosEditarEmpresa"] = $erros;
                header("Location: ../EditCompany.php?q=".$id_empresa);

            }

        break;

        default:
        break;

    }

?>