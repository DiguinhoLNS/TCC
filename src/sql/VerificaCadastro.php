<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    include "ConexaoBD.php";
    include "Querys.php";

    $base = mysqli_connect('localhost', 'root', '', 'bdape')or die("Erro de conexão");

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

            //Tirando mascara de entrada de cpf
            $pontuacao = array(".", "-");
            $cpf = str_replace($pontuacao, "", $CpfComPonto);
            $_SESSION['cpfsemponto'] = $cpf;

            $erros = 0;
            $E1 = 0;
            $E2 = 0;
            $E3 = 0;
            $E4 = 0;
            $E5 = 0;
            $E6 = 0;
            $E8 = 0;

            //Nome
            $_SESSION["UserRegisterError_1"] = 0;
            //Email
            $_SESSION["UserRegisterError_2"] = 0;
            //CPF
            $_SESSION["UserRegisterError_3"] = 0;
            //Data nascimento
            $_SESSION["UserRegisterError_4"] = 0;
            //Endereço
            $_SESSION["UserRegisterError_5"] = 0;
            //Telefone
            $_SESSION["UserRegisterError_6"] = 0;
            //Senha
            $_SESSION["UserRegisterError_8"] = 0;

            //VERIFICA NOME MENOS QUE DOIS CARACTERES E SE POSSUI CARACTERES ESPECIAIS
            if (strlen($nome) <= 2) {

                $erros++;

                $E1 = "1";
                
            } else {

                for ($i = 0; $i < strlen($nome); $i++) {

                    if (ord($nome[$i]) > 32 && ord($nome[$i]) < 65 || ord($nome[$i]) > 90 && ord($nome[$i]) < 96 || ord($nome[$i]) > 122 && ord($nome[$i]) < 126) {

                        $E1 = "1";

                        $erros++;

                    }

                }
                
            }

            //VERIFICA SE JÁ NAO EXISTE UM USUARIO COM MESMO EMAIL OU MESMO CPF
            $QuantidadeDeCadastros = VerificarSeUsuarioJaCadastrado($base, $email, $cpf);

            if(!empty($QuantidadeDeCadastros)){
                $E2 = "1";
                $E3 = "1";
                $erros++;
            }

            //VERIFICA SE O CPF É VALIDO
            $soma1;
            $soma2;
            $digitoum;
            $digitodois;
            $val = 0;

            if (empty($cpf) || strlen($cpf) < 11) {

                $E3 = "1";

                $val++;
                $erros++;

            } else {

                for ($i = 0; $i < 11; $i++) {

                    if (ord($cpf[$i]) < 48 || ord($cpf[$i]) > 57) {

                        $E3 = "1";

                        $val++;
                        $erros++;

                    }

                }

            }

            // Definição de cpf válido
            if ($val == 0) {

                $soma1 = ($cpf[0] * 10) + ($cpf[1] * 9) + ($cpf[2] * 8) + ($cpf[3] * 7) + ($cpf[4] * 6) + ($cpf[5] * 5) + ($cpf[6] * 4) + ($cpf[7] * 3) + ($cpf[8] * 2);
                $digitoum = 11 - ($soma1 % 11);

                if ($digitoum > 9) {

                    $digitoum = 0;

                }

                $soma2 = ($cpf[0] * 11) + ($cpf[1] * 10) + ($cpf[2] * 9) + ($cpf[3] * 8) + ($cpf[4] * 7) + ($cpf[5] * 6) + ($cpf[6] * 5) + ($cpf[7] * 4) + ($cpf[8] * 3) + ($digitoum * 2);
                $digitodois = 11 - ($soma2 % 11);

                if ($digitodois > 9) {

                    $digitodois = 0;

                }

                //verificadores
                if ($digitoum != $cpf[9] || $digitodois != $cpf[10]) {

                    $erros++;

                    $E3 = "1";

                } else {

                    //echo "CPF válido<br> $digitoum--$digitodois";

                }

            }

            //VERIFICA SE O ANO CADASTRADO É MAIOR IGUAL AO ATUAL
            list($ano, $mes, $dia) = explode('-', $data);

            if ($ano >= date("Y")) {

                $E4 = "1";

                $erros++;
            }


            //VERIFICA SE FOI DIGITADO O DDD JUNTO COM O CELULAR
            if (strlen($telefone) <= 10) {

                $E6 = "1";

                $erros++;

            }

            //VERIFICA SE A SENHA POSSUI PELO MENOS UMA MAIUSCULA E UM NUMERO
            $i = 0;
            $Mais = 0;
            $Mins = 0;
            $Nmrs = 0;
            $chars = strlen($senha);

            do {

                if (ord($senha[$i]) >= 65 && ord($senha[$i]) <= 90) {

                    $Mais++;
                    $i++;

                } else if (ord($senha[$i]) >= 97 && ord($senha[$i]) <= 122) {

                    $Mins++;
                    $i++;

                } else if (ord($senha[$i]) >= 48 && ord($senha[$i]) <= 57) {

                    $Nmrs++;
                    $i++;

                }

            } while ($i < $chars);

            if ($Mins != 0 && $Mais != 0 && $Nmrs != 0) {
                //echo "Senha válida";
            } else if ($Mins == 0 && $Mais != 0 && $Nmrs != 0) {

                //echo "Senha inválida, coloque pelo menos uma letra minuscula";
                $E8 = "1";
                $erros++;

            } else if ($Mins != 0 && $Mais == 0 && $Nmrs != 0) {

                //echo "Senha inválida, coloque pelo menos uma letra maiuscula";
                $E8 = "1";
                $erros++;

            } else if ($Mins != 0 && $Mais != 0 && $Nmrs == 0) {

                //echo "Senha inválida, coloque pelo menos um numero";
                $E8 == "1";
                $erros++;

            } else if ($Mins == 0 && $Mais == 0 && $Nmrs == 0) {

                //echo "Senha inválida, digite alguma coisa";
                $E8 = "1";
                $erros++;

            } else if ($Mins == 0 && $Mais == 0 && $Nmrs != 0) {

                //echo "Senha inválida, coloque pelo menos uma letra";
                $E8 = "1";
                $erros++;

            } else if ($Mins != 0 && $Mais == 0 && $Nmrs == 0) {

                //echo "Senha inválida, coloque pelo menos uma letra maiuscula e um numero";
                $E8 = "1";
                $erros++;

            } else if ($Mins == 0 && $Mais != 0 && $Nmrs == 0) {

                //echo "Senha inválida, coloque pelo menos uma letra minuscula e um numero";
                $E8 = "1";
                $erros++;

            }

            //Verifica se não houve erro 
            if ($erros == 0) {

                $_SESSION["UserRegisterError_G"] = "0";

                include 'InsereCadastro.php';

            } else if ($erros > 0) {

                $_SESSION["UserRegisterError_G"] = "1";

                if ($E1 == "1") {
                    $_SESSION["UserRegisterError_1"] = "1";
                }

                if ($E2 == "1") {
                    $_SESSION["UserRegisterError_2"] = "1";
                }

                if ($E3 == "1") {
                    $_SESSION["UserRegisterError_3"] = "1";
                }

                if ($E4 == "1") {
                    $_SESSION["UserRegisterError_4"] = "1";
                }

                if ($E5 == "1") {
                    $_SESSION["UserRegisterError_5"] = "1";
                }

                if ($E6 == "1") {
                    $_SESSION["UserRegisterError_6"] = "1";
                }

                if ($E8 == "1") {
                    $_SESSION["UserRegisterError_8"] = "1";
                }
                header("Location: ../RegisterUser.php");
                //echo $E1." ".$E2." ".$E3." ".$E4." ".$E5." ".$E6." ".$E8;               

            }

        break;

        case "Empresa":

            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $CnpjComPonto = $_POST["cnpj"];
            $telefone = $_POST["telefone"];
            $cor = $_POST["CorLayout"];
            $endereco = $_POST["endereco"];

            //Tirando mascara de entrada de cnpj
            $pontuacao = array(".", "-", "/");
            $cnpj = str_replace($pontuacao, "", $CnpjComPonto);
            $_SESSION['cnpjsemponto'] = $cnpj;

            $erros=0;
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
                $erros++;

            } else {

                for ($i = 0; $i < strlen($nome); $i++) {

                    if (ord($nome[$i]) > 32 && ord($nome[$i]) < 65 || ord($nome[$i]) > 90 && ord($nome[$i]) < 96 || ord($nome[$i]) > 122 && ord($nome[$i]) < 126) {

                        $E1 = "1";
                        $erros++;

                    }

                }

            }

            //VERIFICA SE JÁ NAO EXISTE UMA EMPRESA COM MESMO EMAIL OU MESMO CNPJ
            $QuantidadeDeCadastros = VerificarSeEmpresaJaCadastrada($base, $email, $cnpj);

            if(!empty($QuantidadeDeCadastros)){
                $E2 = "1";
                $E3 = "1";
                $erros++;
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
                $erros++;
                $val++;

            } else {

                for ($i = 0; $i < 14; $i++) {

                    if (ord($cnpj[$i]) < 48 || ord($cnpj[$i]) > 57) {

                        //CNPJ INVALIDO - APENAS NUMEROS PODEM SER DIGITADOS
                        $E3 = "1";
                        $erros++;
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
                    $erros++;

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
                $erros++;

            }

            //VERIFICA SE FOI DIGITADO O DDD JUNTO COM O CELULAR
            if (strlen($telefone) < 10) {

                $E4 = "1";
                $erros++;

            }

            //Verifica se não houve erro 
            if ($erros == 0) {

                $_SESSION["CompanyRegisterError_G"] = "0";

                $_SESSION['V'] = "2";
                
                include 'InsereCadastro.php';

            } else if ($erros > 0) {

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