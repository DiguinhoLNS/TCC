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

                include 'InsereCadastro.php';

            } else {

                $_SESSION["Erros"] = $erros;
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
                
                include 'InsereCadastro.php';

            } else {

                $_SESSION["Erros"] = $erros;
                header("Location: ../RegisterCompany.php");

            }


        break;

        case "EditarUsuario":
        break;

        default:
        break;

    }

?>