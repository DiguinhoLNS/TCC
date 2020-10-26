<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    include "ConexaoBD.php";
    include_once "Funcoes.php";

    $tipo_verificacao = $_SESSION['TipoVerificação'];

    switch($tipo_verificacao){

        case "Usuario":

            $nome = ClearInjectionXSS($base, $_POST["nome"]);
            $email = ClearInjectionXSS($base, $_POST["email"]);
            $CpfComPonto = ClearInjectionXSS($base, $_POST["CPF"]);
            $data = ClearInjectionXSS($base, $_POST["data"]);
            $telefone = ClearInjectionXSS($base, $_POST["telefone"]);
            $genero = ClearInjectionXSS($base, $_POST["Genero"]);
            $senha = ClearInjectionXSS($base, $_POST["senha"]);

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

                setcookie("VerificaErro", "0", time() + (86400 * 30), "/");
                include 'InsereCadastro.php';

            } else {

                $_SESSION["ErrosCadastroUsuario"] = $erros;
                setcookie("VerificaErro", "1", time() + (86400 * 30), "/");
                header("Location: ../RegisterUser.php");          

            }

        break;

        case "Empresa":

            $nome = ClearInjectionXSS($base, $_POST["nome"]);
            $email = ClearInjectionXSS($base, $_POST["email"]);
            $CnpjComPonto = ClearInjectionXSS($base, $_POST["cnpj"]);
            $telefone = ClearInjectionXSS($base, $_POST["telefone"]);
            $endereco = ClearInjectionXSS($base, $_POST["endereco"]);
            $cor = ClearInjectionXSS($base, $_POST["CorLayout"]);

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
                setcookie("VerificaErro", "0", time() + (86400 * 30), "/");
                include 'InsereCadastro.php';

            } else {

                $_SESSION["ErrosCadastrosEmpresa"] = $erros;
                setcookie("VerificaErro", "1", time() + (86400 * 30), "/");
                header("Location: ../RegisterCompany.php");

            }


        break;

        case "EditarUsuario":
            $nome = ClearInjectionXSS($base, $_POST["nome"]);
            $email = ClearInjectionXSS($base, $_POST["email"]);
            $CpfComPonto = ClearInjectionXSS($base, $_POST["CPF"]);
            $data = ClearInjectionXSS($base, $_POST["data"]);
            $telefone = ClearInjectionXSS($base, $_POST["telefone"]);
            $genero = ClearInjectionXSS($base, $_POST["Genero"]);
            $senha = ClearInjectionXSS($base, $_POST["senha"]);

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
                setcookie("VerificaErro", "0", time() + (86400 * 30), "/");
                include 'EditarDados.php';

            } else {

                $_SESSION["ErrosEditarUsuario"] = $erros;
                setcookie("VerificaErro", "1", time() + (86400 * 30), "/");
                header("Location: ../EditUser.php");          

            }
        break;

        case "EditarEmpresa":
            $id_empresa = ClearInjectionXSS($base, $_GET['q']);
            $nome = ClearInjectionXSS($base, $_POST["nome"]);
            $email = ClearInjectionXSS($base, $_POST["email"]);
            $CnpjComPonto = ClearInjectionXSS($base, $_POST["cnpj"]);
            $telefone = ClearInjectionXSS($base, $_POST["telefone"]);
            $endereco = ClearInjectionXSS($base, $_POST["endereco"]);
            $cor = ClearInjectionXSS($base, $_POST["CorLayout"]);

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

                setcookie("VerificaErro", "0", time() + (86400 * 30), "/");
                $_SESSION['TipoVerificação'] = "Empresa";
                include "EditarDados.php";

            } else {

                setcookie("VerificaErro", "1", time() + (86400 * 30), "/");
                $_SESSION["ErrosEditarEmpresa"] = $erros;
                header("Location: ../EditCompany.php?q=".$id_empresa);

            }

        break;

        case "Item":
            $id_empresa = ClearInjectionXSS($base, $_GET['q']);
            $nome = ClearInjectionXSS($base, $_POST["nome"]);
            $foto = $_FILES["foto"];
            $categoria = ClearInjectionXSS($base, $_POST["categoria"]);
            $descricao = ClearInjectionXSS($base, $_POST["descricao"]);

            $ErroNosCampos = [
                "Nome" => false,
                "foto" => false,
                "categoria" => false,
                "descricao" => false,
            ];

            $ErroNosCampos["Nome"] = VerificarNomeOBJ($nome);   
            $ErroNosCampos["foto"] = VerificarFoto($foto);

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
                header("Location: ../RegisterItem.php?q=".$id_empresa);

            }

        break;

        default:
        break;

    }

?>