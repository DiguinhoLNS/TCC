<html>

<body>

    <?php

    session_start();

    $tipo_verificacao = $_SESSION['var'];

    date_default_timezone_set('America/Sao_Paulo');

    include "ConexaoBD.php";

    //se a verificacao tiver que ser feita a partir do cadastro de um usuário:
    if ($tipo_verificacao == '1') {

        $cpfome = $_POST["nome"];
        $email = $_POST["email"];
        $cpf = $_POST["CPF"];
        $data = $_POST["data"];
        $telefone = $_POST["telefone"];
        $celular = $_POST["celular"];
        $endereco = $_POST["endereco"];
        $senha = $_POST["senha"];

        $erro = 0;

        //echo $data;

        //VERIFICA SE JÁ NAO EXISTE UM USUARIO COM MESMO EMAIL OU MESMO CPF
        $base = mysqli_connect('localhost', 'root', '', 'ape') or die("erro de conexão");

        $regra1 = "SELECT email, CPF FROM user_plataforma where email =  '$email' and CPF = '$cpf'";

        $res = mysqli_query($base, $regra1) or die("Usuario não cadastrado");

        $mostrar = mysqli_fetch_array($res);

        if (strtolower($mostrar['email']) == strtolower($email) || $mostrar['CPF'] == $cpf) {

            //echo "Email ou CPF ja cadastrados";
            $erro++;
        }


        //VERIFICA NOME MENOS QUE DOIS CARACTERES E SE POSSUI CARACTERES ESPECIAIS
        if (strlen($cpfome) <= 2) {
            echo "Favor digitar seu nome corretamente.<br>";
            $erro++;
        } else {
            for ($i = 0; $i < 11; $i++) {
                if (ord($cpfome[$i]) > 32 && ord($cpfome[$i]) < 65 || ord($cpfome[$i]) > 90 && ord($cpfome[$i]) < 96 || ord($cpfome[$i]) > 122 && ord($cpfome[$i]) < 126) {
                    echo "Digite apenas letras<br>";
                    $erro++;
                }
            }
        }


        //VERIFICA SE O CPF É VALIDO
        $soma1;
        $soma2;
        $digitoum;
        $digitodois;
        $val = 0;

        if (empty($cpf) || $cpf < 11) {
            echo "CPF inválido<br>";
            $val++;
            $erro++;
        } else {
            for ($i = 0; $i < 11; $i++) {
                if (ord($cpf[$i]) < 48 || ord($cpf[$i]) > 57) {
                    echo "CPF inválido<br>";
                    $val++;
                    $erro++;
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

                echo "CPF inválido<br> $digitoum--$digitodois";
                $erro++;
            } else {

                //echo "CPF válido<br> $digitoum--$digitodois";
            }
        }

        //VERIFICA SE O ANO CADASTRADO É MAIOR IGUAL AO ATUAL
        list($ano, $mes, $dia) = explode('-', $data);
        //echo "Mês: $mes; Dia: $dia; Ano: $ano<br />\n";

        if ($ano >= date("Y")) {
            echo "Favor digitar um ano válido.<br>";
            $erro++;
        }

        //VERIFICA SE FOI DIGITADO O DDD JUNTO COM O TELEFONE
        if (strlen($telefone) != 10) {
            echo "DDD do telefone não especificado<br>";
            $erro++;
        }

        //VERIFICA SE FOI DIGITADO O DDD JUNTO COM O CELULAR
        if (strlen($celular) < 10) {
            echo "DDD do celular não especificado<br>";
            $erro++;
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

        //echo $Mais." ".$Mins." ".$cpfmrs." ".$Chares;
        if ($Mins != 0 && $Mais != 0 && $Nmrs != 0) {
            //echo "Senha válida";
        } else if ($Mins == 0 && $Mais != 0 && $Nmrs != 0) {
            echo "Senha inválida, coloque pelo menos uma letra minuscula";
            $erro++;
        } else if ($Mins != 0 && $Mais == 0 && $Nmrs != 0) {
            echo "Senha inválida, coloque pelo menos uma letra maiuscula";
            $erro++;
        } else if ($Mins != 0 && $Mais != 0 && $Nmrs == 0) {
            echo "Senha inválida, coloque pelo menos um numero";
            $erro++;
        } else if ($Mins == 0 && $Mais == 0 && $Nmrs == 0) {
            echo "Senha inválida, digite alguma coisa";
            $erro++;
        } else if ($Mins == 0 && $Mais == 0 && $Nmrs != 0) {
            echo "Senha inválida, coloque pelo menos uma letra";
            $erro++;
        } else if ($Mins != 0 && $Mais == 0 && $Nmrs == 0) {
            echo "Senha inválida, coloque pelo menos uma letra maiuscula e um numero";
            $erro++;
        } else if ($Mins == 0 && $Mais != 0 && $Nmrs == 0) {
            echo "Senha inválida, coloque pelo menos uma letra minuscula e um numero";
            $erro++;
        }

        //Verifica se não houve erro 
        if ($erro == 0) {

            echo "Todos os dados foram digitados corretamente!<br>";
            include 'InsereCadastro.php';
            //include 'lista.php';

        }

        //se a verificacao tiver que ser feita a partir do cadastro de uma empresa:
    } else if ($tipo_verificacao == '2') {
        //nada por enquanto
    }

    ?>

</body>

</html>