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

            //VERIFICA NOME MENOS QUE DOIS CARACTERES E SE POSSUI CARACTERES ESPECIAIS
            $ErroNosCampos["Nome"] = VerificarCadastroNome($nome);    

            //VERIFICA SE O CPF É VALIDO
            $ErroNosCampos["CPF"] = VerificaCPF($cpf);

            //VERIFICA SE O ANO CADASTRADO É MAIOR IGUAL AO ATUAL
            $ErroNosCampos["Data"] = VerificaData($data);

            //VERIFICA SE FOI DIGITADO O DDD JUNTO COM O CELULAR
            $ErroNosCampos["Telefone"] = VerificaTelefone($telefone);

            //VERIFICA SE A SENHA POSSUI PELO MENOS UMA MAIUSCULA E UM NUMERO
            $ErroNosCampos["Senha"] = VerificaSenha($senha);

            //VERIFICA SE JÁ NAO EXISTE UM USUARIO COM MESMO EMAIL OU MESMO CPF
            $ErroNosCampos["CPF"] ? : $ErroNosCampos["CPF"] = VerificarSeUsuarioJaCadastrado($base, $email, $cpf);
            $ErroNosCampos["Email"] = VerificarSeUsuarioJaCadastrado($base, $email, $cpf); 

            //Pegando todos erros e colocando em um array
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

            //VERIFICA NOME MENOS QUE DOIS CARACTERES E SE POSSUI CARACTERES ESPECIAIS
            $ErroNosCampos["Nome"] = VerificarCadastroNome($nome);

            //VERIFICA SE O CNPJ É VALIDO
            $ErroNosCampos["CNPJ"] = VerificaCNPJ($cnpj);

            //VERIFICA SE NO ENDEREÇO HÁ UMA DAS SEGUINTES PALAVRAS: RUA, AVENIDA, RODOVIA, ALAMEDA, VIELA, VIA, TRAVESSA, BECO, ESTRADA
            $ErroNosCampos["Endereco"] = VerificarEndereco($endereco);

            //VERIFICA SE FOI DIGITADO O DDD JUNTO COM O CELULAR
            $ErroNosCampos["Telefone"] = VerificaTelefone($telefone);

            //VERIFICA SE JÁ NAO EXISTE UM USUARIO COM MESMO EMAIL OU MESMO CNPJ
            $ErroNosCampos["CNPJ"] ? : $ErroNosCampos["CNPJ"] = VerificarSeEmpresaJaCadastrada($base, $email, $cnpj);
            $ErroNosCampos["Email"] = VerificarSeEmpresaJaCadastrada($base, $email, $cnpj);

            //Verifica se não houve erro 
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