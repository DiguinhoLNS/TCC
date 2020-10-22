<?php

include 'ConexaoBD.php';
date_default_timezone_set('America/Sao_Paulo');

function ColocarPontoCPF($cpfSemPonto)
{
    $cpf =  substr_replace($cpfSemPonto, ".", 3, 0);
    $cpf =  substr_replace($cpf, ".", 7, 0);
    $cpf =  substr_replace($cpf, "-", 11, 0);

    return $cpf;
}

function TirarPontoCPF($CpfComPonto)
{
    $pontuacao = array(".", "-");
    $cpf = str_replace($pontuacao, "", $CpfComPonto);
    $_SESSION['cpfsemponto'] = $cpf;

    return $cpf;
}


function ColocarPontoCNPJ($cnpjSemPonto)
{
    $cnpj =  substr_replace($cnpjSemPonto, '.', 2, 0);
    $cnpj =  substr_replace($cnpj, '.', 6, 0);
    $cnpj =  substr_replace($cnpj, '/', 10, 0);
    $cnpj =  substr_replace($cnpj,  '-', 15, 0);

    return $cnpj;
}

function TirarPontoCNPJ($CnpjComPonto)
{
    $pontuacao = array(".", "-", "/");
    $cnpj = str_replace($pontuacao, "", $CnpjComPonto);
    $_SESSION['cnpjsemponto'] = $cnpj;

    return $cnpj;
}

function VerificarCadastroNome($nome)
{
    if (strlen($nome) <= 2) {
        return true;
    } else if (strlen($nome) > 2) {

        for ($i = 0; $i < strlen($nome); $i++) {
            if (ord($nome[$i]) > 32 && ord($nome[$i]) < 65 || ord($nome[$i]) > 90 && ord($nome[$i]) < 96 || ord($nome[$i]) > 122 && ord($nome[$i]) < 126) {
                return true;
            }
        }
    }

    return false;
}

function VerificaCPF($cpf)
{

    $soma1 = 0;
    $soma2 = 0;
    $digitoVerificadorUm = 0;
    $digitoVerificadorDois = 0;

    if (empty($cpf) || strlen($cpf) < 11) {

        return true;
    } else {

        for ($i = 0; $i < 11; $i++) {

            if (ord($cpf[$i]) < 48 || ord($cpf[$i]) > 57) {
                return true;
            }
        }
    }

    // Definição de cpf válido
    $soma1 = ($cpf[0] * 10) + ($cpf[1] * 9) + ($cpf[2] * 8) + ($cpf[3] * 7) + ($cpf[4] * 6) + ($cpf[5] * 5) + ($cpf[6] * 4) + ($cpf[7] * 3) + ($cpf[8] * 2);
    $digitoVerificadorUm = 11 - ($soma1 % 11);

    if ($digitoVerificadorUm > 9) {

        $digitoVerificadorUm = 0;
    }

    $soma2 = ($cpf[0] * 11) + ($cpf[1] * 10) + ($cpf[2] * 9) + ($cpf[3] * 8) + ($cpf[4] * 7) + ($cpf[5] * 6) + ($cpf[6] * 5) + ($cpf[7] * 4) + ($cpf[8] * 3) + ($digitoVerificadorUm * 2);
    $digitoVerificadorDois = 11 - ($soma2 % 11);

    if ($digitoVerificadorDois > 9) {

        $digitoVerificadorDois = 0;
    }

    //verificadores
    return $digitoVerificadorUm != $cpf[9] || $digitoVerificadorDois != $cpf[10] ? true : false;
}

function VerificaData($data)
{

    list($ano, $mes, $dia) = explode('-', $data);
    return $ano >= date("Y") ? true : false;
}

function VerificaTelefone($telefone){
    return strlen($telefone) <= 10 ? true : false;
}

function VerificaSenha($senha){

            $i = 0;
            $maiusculas = false;
            $minusculas = false;
            $numeros = false;
            $tamanhoSenha = strlen($senha);

            do {

                if (ord($senha[$i]) >= 65 && ord($senha[$i]) <= 90) {

                    $maiusculas = true;
                    $i++;

                } else if (ord($senha[$i]) >= 97 && ord($senha[$i]) <= 122) {

                    $minusculas = true;
                    $i++;

                } else if (ord($senha[$i]) >= 48 && ord($senha[$i]) <= 57) {

                    $numeros = true;
                    $i++;

                }else{
                    return true;
                }

            } while ($i < $tamanhoSenha);

            return $minusculas && $maiusculas && $numeros ? false : true;

}


//Querys usadas no VerificaCadastro.php
function VerificarSeUsuarioJaCadastrado($base, $email, $cpf)
{
    $regra1 = "SELECT Email_user, CPF_user FROM usuarios where Email_user =  '$email' or CPF_user = '$cpf'";
    $res = mysqli_query($base, $regra1) or die("Erro na consulta1");
    $QuantidadeDeCadastros = $res->num_rows;

    return !empty($QuantidadeDeCadastros) ? true : false;
}

function VerificarSeEmpresaJaCadastrada($base, $email, $cnpj)
{
    $regra1 = "SELECT Email, CNPJ FROM empresas where Email =  '$email' or CNPJ = '$cnpj'";
    $res = mysqli_query($base, $regra1) or die("Erro na consulta2");
    $QuantidadeDeCadastros = $res->num_rows;

    return $QuantidadeDeCadastros;
}

//Querys usadas no Company.php
function PegarDadosEmpresaPeloIdEmpresa($base, $id_empresa)
{
    $regra1 = "SELECT * FROM empresas where id_empresa =  '$id_empresa'";
    $res = mysqli_query($base, $regra1) or die("Erro na consulta3");
    $DadosEmpresa = mysqli_fetch_array($res);

    return $DadosEmpresa;
}

function PegarDadosUserEmpresaPeloIdUserIdEmpresa($base, $id_user, $id_empresa)
{
    $regra2 = "SELECT * FROM user_empresa where id_user =  '$id_user' and id_empresa = $id_empresa";
    $res2 = mysqli_query($base, $regra2) or die("Erro na consulta4");
    $DadosUserEmpresa = mysqli_fetch_array($res2);

    return $DadosUserEmpresa;
}

//Querys usadas no VerificaLogin
function PegarDadosUsuarioPeloEmailSenha($base, $email, $senha)
{
    $regra1 = "SELECT Email_user, Senha_user, id_user FROM usuarios where Email_user =  '$email' and Senha_user = '$senha'";
    $res = mysqli_query($base, $regra1) or die("Erro na consulta5");
    $DadosUsuario = mysqli_fetch_array($res);
    $QuantidadeDeCadastros = $res->num_rows;

    $Dados = array(
        "id_user" => $DadosUsuario['id_user'],
        "QuantidadeDeCadastros" => $QuantidadeDeCadastros
    );

    return $Dados;
}

function PegarDadosEmpresaPeloCodigo($base, $codigo_acesso)
{
    $regra1 = "SELECT codigo_acesso, id_empresa FROM empresas where codigo_acesso =  '$codigo_acesso'";
    $res = mysqli_query($base, $regra1) or die("Erro na consulta6");
    $DadosEmpresa = mysqli_fetch_array($res);

    $CodigoExiste = (empty($res->num_rows)) ? false : true;

    $Dados = array(
        "CodigoExiste" => $CodigoExiste,
        "id_empresa" => $DadosEmpresa['id_empresa']
    );

    return $Dados;
}

function VerificarSeUsuarioJaFezLoginAntes($base, $codigo_acesso, $id_user)
{
    $regra2 = "SELECT * FROM user_empresa inner join empresas on 'id_empresa' = 'id_empresa' where empresas.codigo_acesso = '$codigo_acesso' and user_empresa.id_user = $id_user and user_empresa.id_empresa = empresas.id_empresa";
    $res2 = mysqli_query($base, $regra2) or die("Erro na consulta7");
    $DadosUserEmpresa = mysqli_fetch_array($res2);
    $QuantidadeDeLoginsJaFeitos = $res2->num_rows;

    return $QuantidadeDeLoginsJaFeitos;
}

function PegarDadosEmpresaPeloId_Codigo($base, $id_adm, $codigo_acesso)
{
    $regra1 = "SELECT id_adm, id_empresa FROM empresas where id_adm =  $id_adm and codigo_acesso = '$codigo_acesso'";
    $res = mysqli_query($base, $regra1) or die("Erro na consulta8 " . $id_adm . " " . $codigo_acesso);
    $DadosEmpresa = mysqli_fetch_array($res);

    return $DadosEmpresa;
}
