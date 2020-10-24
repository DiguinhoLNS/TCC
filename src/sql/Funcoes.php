<?php

include 'ConexaoBD.php';
date_default_timezone_set('America/Sao_Paulo');

function EncerrarSessao()
{

    setcookie("ULogged", "", time() - (86400 * 30), "/");
    setcookie("ID", "", time() - (86400 * 30), "/");

    header("Location: ../Index.php");
}

function SepararData($DataJunta)
{

    list($ano, $mes, $dia) = explode('-', $DataJunta);

    $DataSeparda = [
        "ano" => $ano,
        "mes" => $mes,
        "dia" => $dia
    ];

    return $DataSeparda;
}

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
    }

    for ($i = 0; $i < 11; $i++) {

        if (ord($cpf[$i]) < 48 || ord($cpf[$i]) > 57) {
            return true;
        }
    }


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

function VerificaCNPJ($cnpj)
{

    $soma1 = 0;
    $soma2 = 0;
    $digitoVerificadorUm = 0;
    $digitoVerificadorDois = 0;

    if (empty($cnpj) || strlen($cnpj) < 14) {

        return true;
    }

    for ($i = 0; $i < 14; $i++) {

        if (ord($cnpj[$i]) < 48 || ord($cnpj[$i]) > 57) {

            return true;
        }
    }


    $soma1 = ($cnpj[0] * 5) + ($cnpj[1] * 4) + ($cnpj[2] * 3) + ($cnpj[3] * 2) + ($cnpj[4] * 9) + ($cnpj[5] * 8) + ($cnpj[6] * 7) + ($cnpj[7] * 6) + ($cnpj[8] * 5) + ($cnpj[9] * 4) + ($cnpj[10] * 3) + ($cnpj[11] * 2);
    $digitoVerificadorUm = 11 - ($soma1 % 11);

    if ($digitoVerificadorUm > 9) {

        $digitoVerificadorUm = 0;
    }

    $soma2 = ($cnpj[0] * 6) + ($cnpj[1] * 5) + ($cnpj[2] * 4) + ($cnpj[3] * 3) + ($cnpj[4] * 2) + ($cnpj[5] * 9) + ($cnpj[6] * 8) + ($cnpj[7] * 7) + ($cnpj[8] * 6) + ($cnpj[9] * 5) + ($cnpj[10] * 4) + ($cnpj[11] * 3) + ($cnpj[12] * 2);
    $digitoVerificadorDois = 11 - ($soma2 % 11);

    if ($digitoVerificadorDois > 9) {

        $digitoVerificadorDois = 0;
    }

    //verificadores
    return $digitoVerificadorUm != $cnpj[12] || $digitoVerificadorDois != $cnpj[13] ? true : false;
}

function VerificaData($data)
{

    list($ano, $mes, $dia) = explode('-', $data);
    return $ano >= date("Y") ? true : false;
}

function VerificaTelefone($telefone)
{
    return strlen($telefone) <= 13 ? true : false;
}

function VerificarEndereco($endereco)
{

    $possiveis = array("rua", "avenida", "rodovia", "alameda", "viela", "travessa", "beco", "estrada");

    for ($i = 0; $i < 8; $i++) {

        $achou = strpos(strtolower($endereco), $possiveis[$i]);

        return $achou !== false ? false : true;
    }
}

function VerificaSenha($senha)
{

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
        } else {
            return true;
        }
    } while ($i < $tamanhoSenha);

    return $minusculas && $maiusculas && $numeros ? false : true;
}


//Querys usadas no VerificaCadastro.php
function VerificarSeUsuarioJaCadastrado($base, $email, $cpf)
{
    $query = "SELECT Email_user, CPF_user FROM usuarios where Email_user =  '$email' or CPF_user = '$cpf'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 1");
    $QuantidadeDeCadastros = $ResultadoQuery->num_rows;

    return !empty($QuantidadeDeCadastros) ? true : false;
}

function VerificarSeEmpresaJaCadastrada($base, $email, $cnpj)
{
    $query = "SELECT Email, CNPJ FROM empresas where Email =  '$email' or CNPJ = '$cnpj'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 2");
    $QuantidadeDeCadastros = $ResultadoQuery->num_rows;

    return $QuantidadeDeCadastros;
}

//Querys usadas no Company.php
function PegarDadosEmpresaPeloIdEmpresa($base, $id_empresa)
{
    $query = "SELECT * FROM empresas where id_empresa =  '$id_empresa'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 3");
    $DadosEmpresa = mysqli_fetch_array($ResultadoQuery);

    return $DadosEmpresa;
}

function PegarDadosUserEmpresaPeloIdUserIdEmpresa($base, $id_user, $id_empresa)
{
    $query = "SELECT * FROM user_empresa where id_user =  '$id_user' and id_empresa = $id_empresa";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 4");
    $DadosUserEmpresa = mysqli_fetch_array($ResultadoQuery);

    return $DadosUserEmpresa;
}

//Querys usadas no VerificaLogin
function PegarDadosUsuarioPeloEmailSenha($base, $email, $senha)
{
    $query = "SELECT Email_user, Senha_user, id_user FROM usuarios where Email_user =  '$email' and Senha_user = '$senha'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 5");
    $DadosUsuario = mysqli_fetch_array($ResultadoQuery);
    $QuantidadeDeCadastros = $ResultadoQuery->num_rows;

    $Dados = array(
        "id_user" => $DadosUsuario['id_user'],
        "QuantidadeDeCadastros" => $QuantidadeDeCadastros
    );

    return $Dados;
}

function PegarDadosEmpresaPeloCodigo($base, $codigo_acesso)
{
    $query = "SELECT codigo_acesso, id_empresa FROM empresas where codigo_acesso =  '$codigo_acesso'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 6");
    $DadosEmpresa = mysqli_fetch_array($ResultadoQuery);

    $CodigoExiste = (empty($ResultadoQuery->num_rows)) ? false : true;

    $Dados = array(
        "CodigoExiste" => $CodigoExiste,
        "id_empresa" => $DadosEmpresa['id_empresa']
    );

    return $Dados;
}

function VerificarSeUsuarioJaFezLoginAntes($base, $codigo_acesso, $id_user)
{
    $query = "SELECT * FROM user_empresa inner join empresas on 'id_empresa' = 'id_empresa' where empresas.codigo_acesso = '$codigo_acesso' and user_empresa.id_user = $id_user and user_empresa.id_empresa = empresas.id_empresa";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 7");
    $DadosUserEmpresa = mysqli_fetch_array($ResultadoQuery);
    $QuantidadeDeLoginsJaFeitos = $ResultadoQuery->num_rows;

    return $QuantidadeDeLoginsJaFeitos;
}

function PegarDadosEmpresaPeloId_Codigo($base, $id_adm, $codigo_acesso)
{
    $query = "SELECT id_adm, id_empresa FROM empresas where id_adm =  $id_adm and codigo_acesso = '$codigo_acesso'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 8 " . $id_adm . " " . $codigo_acesso);
    $DadosEmpresa = mysqli_fetch_array($ResultadoQuery);

    return $DadosEmpresa;
}

function PegarDadosUsuarioPeloId($base, $id)
{
    $query = "SELECT * FROM usuarios WHERE id_user = '$id'";

    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 9");
    $DadosUsuario = mysqli_fetch_array($ResultadoQuery);

    return $DadosUsuario;
}

function PegarDadosEmpresaPeloIdUsuario($base, $id)
{

    $query = "SELECT * FROM empresas inner join user_empresa on 'id_empresa' = 'id_empresa' where user_empresa.id_user = $id and empresas.id_empresa = user_empresa.id_empresa order by Nome ASC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 10");

    while ($UmaEmpresa = mysqli_fetch_array($ResultadoQuery)) {

        $TodasEmpresas[] = $UmaEmpresa;
    }

    $QuantidadeDeEmpresas = $ResultadoQuery->num_rows;

    $Empresas = [

        "Dados" => $TodasEmpresas,
        "QuantidadeDeEmpresas" => $QuantidadeDeEmpresas

    ];

    return $Empresas;
}