<?php

    session_start();

    $tipo_verificacao = $_SESSION['var'];

    date_default_timezone_set('America/Sao_Paulo');

    include "ConexaoBD.php";

    $_SESSION["UserRegisterError_1"] = 0;
    $_SESSION["UserRegisterError_2"] = 0;
    $_SESSION["UserRegisterError_3"] = 0;
    $_SESSION["UserRegisterError_4"] = 0;
    $_SESSION["UserRegisterError_5"] = 0;
    $_SESSION["UserRegisterError_6"] = 0;
    $_SESSION["UserRegisterError_8"] = 0;

    switch ($tipo_verificacao) {

            // User Register
        case 1:

            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $cpf = $_POST["CPF"];
            $data = $_POST["data"];
            $telefone = $_POST["telefone"];
            $celular = $_POST["celular"];
            $endereco = $_POST["endereco"];
            $senha = $_POST["senha"];
            $E1 = 0;
            $E2 = 0;
            $E3 = 0;
            $E4 = 0;
            $E5 = 0;
            $E6 = 0;
            $E8 = 0;

            $erros = 0;

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
            $base = mysqli_connect('localhost', 'root', '', 'ape') or die("erro de conexão");

            $regra1 = "SELECT email, CPF FROM user_plataforma where email =  '$email' and CPF = '$cpf'";

            $res = mysqli_query($base, $regra1) or die("Usuario não cadastrado");

            $mostrar = mysqli_fetch_array($res);

            if (strtolower($mostrar['email']) == strtolower($email) || $mostrar['CPF'] == $cpf) {

                //echo "Email ou CPF ja cadastrados";

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

            //VERIFICA SE FOI DIGITADO O DDD JUNTO COM O TELEFONE
            if (strlen($telefone) != 10) {

                $E5 = "1";

                $erros++;

            }

            //VERIFICA SE FOI DIGITADO O DDD JUNTO COM O CELULAR
            if (strlen($celular) < 10) {

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

                //setError($E1, $E2, $E3, $E4, $E5, $E6, $E8);

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

            }

        break;

        case 2:break;

        case 3:break;

        default:break;

    }

?>