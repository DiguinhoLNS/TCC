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
            $ErroNosCampos["CPF"] = VerificarSeUsuarioJaCadastrado($base, $email, $cpf);
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
            $cor = $_POST["CorLayout"];
            $endereco = $_POST["endereco"];

            $cnpj = TirarPontoCNPJ($CnpjComPonto);

            $ErroNosCampos=0;
            $E1 = 0;
            $E2 = 0;
            $E3 = 0;
            $E4 = 0;
            $E5 = 0;

            //Nome
            $_SESSION["CompanyRegisterError_1"] = 0;
            //Email
            $_SESSION["CompanyRegisterError_2"] = 0;
            //CNPJ
            $_SESSION["CompanyRegisterError_3"] = 0;
            //Telefone
            $_SESSION["CompanyRegisterError_4"] = 0;
            //Endereço
            $_SESSION["CompanyRegisterError_5"] = 0;


            //VERIFICA NOME MENOS QUE DOIS CARACTERES E SE POSSUI CARACTERES ESPECIAIS
            if (strlen($nome) <= 2) {

                $E1 = "1";
                $ErroNosCampos++;

            } else {

                for ($i = 0; $i < strlen($nome); $i++) {

                    if (ord($nome[$i]) > 32 && ord($nome[$i]) < 65 || ord($nome[$i]) > 90 && ord($nome[$i]) < 96 || ord($nome[$i]) > 122 && ord($nome[$i]) < 126) {

                        $E1 = "1";
                        $ErroNosCampos++;

                    }

                }

            }

            //VERIFICA SE JÁ NAO EXISTE UMA EMPRESA COM MESMO EMAIL OU MESMO CNPJ
            $QuantidadeDeCadastros = VerificarSeEmpresaJaCadastrada($base, $email, $cnpj);

            if(!empty($QuantidadeDeCadastros)){
                $E2 = "1";
                $E3 = "1";
                $ErroNosCampos++;
            }

            //VERIFICA SE O CNPJ É VALIDO
            $soma1;
            $soma2;
            $digitoum;
            $digitodois;
            $val = 0;

            if (empty($cnpj) || strlen($cnpj) < 14) {

                //CNPJ INVALIDO - STRING MENOR DO QUE ESPERADA: ESPERADA 14 
                $E3 = "1";
                $ErroNosCampos++;
                $val++;

            } else {

                for ($i = 0; $i < 14; $i++) {

                    if (ord($cnpj[$i]) < 48 || ord($cnpj[$i]) > 57) {

                        //CNPJ INVALIDO - APENAS NUMEROS PODEM SER DIGITADOS
                        $E3 = "1";
                        $ErroNosCampos++;
                        $val++;

                    }

                }

            }

            // Definição de CNPJ válido
            if ($val == 0) {

                $soma1 = ($cnpj[0] * 5) + ($cnpj[1] * 4) + ($cnpj[2] * 3) + ($cnpj[3] * 2) + ($cnpj[4] * 9) + ($cnpj[5] * 8) + ($cnpj[6] * 7) + ($cnpj[7] * 6) + ($cnpj[8] * 5) + ($cnpj[9] * 4) + ($cnpj[10] * 3) + ($cnpj[11] * 2);
                $digitoum = 11 - ($soma1 % 11);

                if ($digitoum > 9) {

                    $digitoum = 0;

                }

                $soma2 = ($cnpj[0] * 6) + ($cnpj[1] * 5) + ($cnpj[2] * 4) + ($cnpj[3] * 3) + ($cnpj[4] * 2) + ($cnpj[5] * 9) + ($cnpj[6] * 8) + ($cnpj[7] * 7) + ($cnpj[8] * 6) + ($cnpj[9] * 5) + ($cnpj[10] * 4) + ($cnpj[11] * 3) + ($cnpj[12] * 2);
                $digitodois = 11 - ($soma2 % 11);

                if ($digitodois > 9) {

                    $digitodois = 0;

                }

                //verificadores
                if ($digitoum != $cnpj[12] || $digitodois != $cnpj[13]) {

                    //CNPJ INVALIDO - VERIFICADORES ERRADOS
                    $E3 = "1";
                    $ErroNosCampos++;

                }

            }

            //VERIFICA SE NO ENDEREÇO HÁ UMA DAS SEGUINTES PALAVRAS: RUA, AVENIDA, RODOVIA, ALAMEDA, VIELA, VIA, TRAVESSA, BECO, ESTRADA
            $possiveis = array("rua", "avenida", "rodovia", "alameda", "viela", "travessa", "beco", "estrada");

            $valid = 0;

            for ($i = 0; $i < 8; $i++) {

                $pos = strpos(strtolower($endereco), $possiveis[$i]);

                if ($pos === false) {

                    //echo "Endereço inválido"; Se apresentar nesse if ele apresenta invalido para todos os tipos que nao estao na string, resultando em muito texto repetido, por isso existe aquele if depois do fim do for
                    //NAO COLOQUE NENHUMA VARIVAEL AQUI

                } else {
                    
                    $valid = 1;
                    $E5 = "0";

                }

            }

            if ($valid != 1) {

                $E5 = "1";
                $ErroNosCampos++;

            }

            //VERIFICA SE FOI DIGITADO O DDD JUNTO COM O CELULAR
            if (strlen($telefone) < 10) {

                $E4 = "1";
                $ErroNosCampos++;

            }

            //Verifica se não houve erro 
            if ($ErroNosCampos == 0) {

                $_SESSION["CompanyRegisterError_G"] = "0";

                $_SESSION['TipoVerificação'] = "Empresa";
                
                include 'InsereCadastro.php';

            } else if ($ErroNosCampos > 0) {

                $_SESSION["CompanyRegisterError_G"] = "1";

                if ($E1 == "1") {
                    $_SESSION["CompanyRegisterError_1"] = "1";
                }

                if ($E2 == "1") {
                    $_SESSION["CompanyRegisterError_2"] = "1";
                }

                if ($E3 == "1") {
                    $_SESSION["CompanyRegisterError_3"] = "1";
                }

                if ($E4 == "1") {
                    $_SESSION["CompanyRegisterError_4"] = "1";
                }

                if ($E5 == "1") {
                    $_SESSION["CompanyRegisterError_5"] = "1";
                }

                header("Location: ../RegisterCompany.php");

            }


        break;

        case 3:
        break;

        default:
        break;

    }

?>