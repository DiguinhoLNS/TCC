<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    require_once "ConexaoBD.php";
    require_once "Funcoes.php";

    $conn = new ConexaoBD();
	$func = new Funcoes();

    $tipo_verificacao = $_SESSION['TipoVerificação'];

    switch($tipo_verificacao){

        case "Usuario":

            $nome = $func->ClearInjectionXSS($_POST["nome"]);
            $email = $func->ClearInjectionXSS($_POST["email"]);
            $CpfComPonto = $func->ClearInjectionXSS($_POST["CPF"]);
            $data = $func->ClearInjectionXSS($_POST["data"]);
            $telefone = $func->ClearInjectionXSS($_POST["telefone"]);
            $genero = $func->ClearInjectionXSS($_POST["Genero"]);
            $senha = $func->ClearInjectionXSS($_POST["senha"]);

            $cpf = $func->TirarPontoCPF($CpfComPonto);

            $ErroNosCampos = [
                "Nome" => false,
                "Email" => false,
                "CPF" => false,
                "Data" => false,
                "Endereco" => false,
                "Telefone" => false,
                "Senha" => false
            ];

            $ErroNosCampos["Nome"] = $func->VerificarCadastroNome($nome);    

            $ErroNosCampos["CPF"] = $func->VerificaCPF($cpf);

            $ErroNosCampos["Data"] = $func->VerificaData($data);

            $ErroNosCampos["Telefone"] = $func->VerificaTelefone($telefone);

            $ErroNosCampos["Senha"] = $func->VerificaSenha($senha);

            $ErroNosCampos["CPF"] ? : $ErroNosCampos["CPF"] = $func->VerificarSeUsuarioJaCadastrado($email, $cpf);
            $ErroNosCampos["Email"] = $func->VerificarSeUsuarioJaCadastrado($email, $cpf); 

            foreach ($ErroNosCampos as $key => $verifica) {
                if ($verifica) {
                    $erros[$key] =  true;
                }
            }

            if (!isset($erros)) {

                setcookie("VerificaErro", "0", time() + (86400 * 30), "/");
                include 'InsereCadastro.php';

            } else {

                $_SESSION["ErrosCadastroUsuario"] = $erros;
                setcookie("VerificaErro", "1", time() + (86400 * 30), "/");
                header("Location: ../RegisterUser.php");          

            }

        break;

        case "Empresa":

            $nome = $func->ClearInjectionXSS($_POST["nome"]);
            $email = $func->ClearInjectionXSS($_POST["email"]);
            $CnpjComPonto = $func->ClearInjectionXSS($_POST["cnpj"]);
            $telefone = $func->ClearInjectionXSS($_POST["telefone"]);
            $endereco = $func->ClearInjectionXSS($_POST["endereco"]);
            $cor = $func->ClearInjectionXSS($_POST["CorLayout"]);

            $cnpj = $func->TirarPontoCNPJ($CnpjComPonto);

            $ErroNosCampos = [
                "Nome" => false,
                "Email" => false,
                "CNPJ" => false,
                "Telefone" => false,
                "Endereco" => false,
                "Cor" => false
            ];

            $ErroNosCampos["Nome"] = $func->VerificarCadastroNome($nome);

            $ErroNosCampos["CNPJ"] = $func->VerificaCNPJ($cnpj);

            $ErroNosCampos["Endereco"] = $func->VerificarEndereco($endereco);

            $ErroNosCampos["Telefone"] = $func->VerificaTelefone($telefone);

            $ErroNosCampos["CNPJ"] ? : $ErroNosCampos["CNPJ"] = $func->VerificarSeEmpresaJaCadastrada($email, $cnpj);
            $ErroNosCampos["Email"] = $func->VerificarSeEmpresaJaCadastrada($email, $cnpj);

            foreach ($ErroNosCampos as $key => $verifica) {
                if ($verifica) {
                    $erros[$key] =  true;
                }
            }

            if (!isset($erros)) {

                $_SESSION['TipoVerificação'] = "Empresa";
                setcookie("VerificaErro", "0", time() + (86400 * 30), "/");
                include 'InsereCadastro.php';

            } else {

                $_SESSION["ErrosCadastrosEmpresa"] = $erros;
                setcookie("VerificaErro", "1", time() + (86400 * 30), "/");
                header("Location: ../RegisterCompany.php");

            }


        break;

        case "EditarUsuario":
            $nome = $func->ClearInjectionXSS($_POST["nome"]);
            $email = $func->ClearInjectionXSS($_POST["email"]);
            $CpfComPonto = $func->ClearInjectionXSS($_POST["CPF"]);
            $data = $func->ClearInjectionXSS($_POST["data"]);
            $telefone = $func->ClearInjectionXSS($_POST["telefone"]);
            $genero = $func->ClearInjectionXSS($_POST["Genero"]);

            $cpf = $func->TirarPontoCPF($CpfComPonto);

            $ErroNosCampos = [
                "Nome" => false,
                "Email" => false,
                "CPF" => false,
                "Data" => false,
                "Endereco" => false,
                "Telefone" => false
            ];

            $ErroNosCampos["Nome"] = $func->VerificarCadastroNome($nome);    

            $ErroNosCampos["CPF"] = $func->VerificaCPF($cpf);

            $ErroNosCampos["Data"] = $func->VerificaData($data);

            $ErroNosCampos["Telefone"] = $func->VerificaTelefone($telefone);

            foreach ($ErroNosCampos as $key => $verifica) {
                if ($verifica) {
                    $erros[$key] =  true;
                }
            }

            if (!isset($erros)) {

                $_SESSION['TipoVerificação'] = "Usuario";
                setcookie("VerificaErro", "0", time() + (86400 * 30), "/");
                include 'EditarDados.php';

            } else {

                $_SESSION["ErrosEditarUsuario"] = $erros;
                setcookie("VerificaErro", "1", time() + (86400 * 30), "/");
                header("Location: ../EditUser.php");          

            }
        break;

        case "EditarEmpresa":
            $id_empresa = $func->ClearInjectionXSS(base64_decode($_GET['q']));
            $nome = $func->ClearInjectionXSS($_POST["nome"]);
            $email = $func->ClearInjectionXSS($_POST["email"]);
            $CnpjComPonto = $func->ClearInjectionXSS($_POST["cnpj"]);
            $telefone = $func->ClearInjectionXSS($_POST["telefone"]);
            $endereco = $func->ClearInjectionXSS($_POST["endereco"]);
            $cor = $func->ClearInjectionXSS($_POST["CorLayout"]);

            $cnpj = $func->TirarPontoCNPJ($CnpjComPonto);

            $ErroNosCampos = [
                "Nome" => false,
                "Email" => false,
                "CNPJ" => false,
                "Telefone" => false,
                "Endereco" => false,
                "Cor" => false
            ];

            $ErroNosCampos["Nome"] = $func->VerificarCadastroNome($nome);

            $ErroNosCampos["CNPJ"] = $func->VerificaCNPJ($cnpj);

            $ErroNosCampos["Endereco"] = $func->VerificarEndereco($endereco);

            $ErroNosCampos["Telefone"] = $func->VerificaTelefone($telefone);

            foreach ($ErroNosCampos as $key => $verifica) {
                if ($verifica) {
                    $erros[$key] =  true;
                }
            }

            if (!isset($erros)) {

                setcookie("VerificaErro", "0", time() + (86400 * 30), "/");
                $_SESSION['TipoVerificação'] = "Empresa";
                include "EditarDados.php";

            } else {

                setcookie("VerificaErro", "1", time() + (86400 * 30), "/");
                $_SESSION["ErrosEditarEmpresa"] = $erros;

                header("Location: ../EditCompany.php?q=".base64_encode($id_empresa));

            }

        break;

        case "Item":
            $id_empresa = $func->ClearInjectionXSS(base64_decode($_GET['q']));
            $nome = $func->ClearInjectionXSS($_POST["nome"]);
            $foto = $_FILES["foto"];
            $categoria = $func->ClearInjectionXSS($_POST["categoria"]);
            $descricao = $func->ClearInjectionXSS($_POST["descricao"]);

            $ErroNosCampos = [
                "Nome" => false,
                "foto" => false,
                "categoria" => false,
                "descricao" => false,
            ];

            $ErroNosCampos["Nome"] = $func->VerificarNomeOBJ($nome);   
            $ErroNosCampos["foto"] = $func->VerificarFoto($foto);

            foreach ($ErroNosCampos as $key => $verifica) {
                if ($verifica) {
                    $erros[$key] =  true;
                }
            }

            if (!isset($erros)) {

                setcookie("VerificaErro", "0", time() + (86400 * 30), "/");
                include "InsereCadastro.php";

            } else {

                setcookie("VerificaErro", "1", time() + (86400 * 30), "/");
                $_SESSION["ErrosRegistrarItem"] = $erros;
                header("Location: ../RegisterItem.php?q=".base64_encode($id_empresa));

            }

        break;

        case "EditarItem":
            $id_obj = $func->ClearInjectionXSS(base64_decode($_GET['q']));
            $nome = $func->ClearInjectionXSS($_POST["nome"]);
            //$foto = $_FILES["foto"];
            $categoria = $func->ClearInjectionXSS($_POST["categoria"]);
            $descricao = $func->ClearInjectionXSS($_POST["descricao"]);
            $situacao = $func->ClearInjectionXSS($_POST["situacao"]);

            $ErroNosCampos = [
                "Nome" => false,
                "foto" => false,
                "categoria" => false,
                "descricao" => false,
            ];

            $ErroNosCampos["Nome"] = $func->VerificarNomeOBJ($nome);   
            //$ErroNosCampos["foto"] = $func->VerificarFoto($foto);

            foreach ($ErroNosCampos as $key => $verifica) {
                if ($verifica) {
                    $erros[$key] =  true;
                }
            }

            if (!isset($erros)) {
                $_SESSION['TipoVerificação'] = "Item";
                setcookie("VerificaErro", "0", time() + (86400 * 30), "/");
                include "EditarDados.php";

            } else {

                setcookie("VerificaErro", "1", time() + (86400 * 30), "/");
                $_SESSION["ErrosRegistrarItem"] = $erros;

                //var_dump($erros);
                header("Location: ../RegisterItem.php?q=".base64_encode($id_empresa));

            }
        break;

        default:
        break;

    }
