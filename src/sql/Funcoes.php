<?php

include 'ConexaoBD.php';

function ColocarPontoCPF($cpfSemPonto)
{
    $cpf =  substr_replace($cpfSemPonto, ".", 3, 0);
    $cpf =  substr_replace($cpf, ".", 7, 0);
    $cpf =  substr_replace($cpf, "-", 11, 0);

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

//Querys usadas no VerificaCadastro.php
function VerificarSeUsuarioJaCadastrado($base, $email, $cpf)
{
    $regra1 = "SELECT Email_user, CPF_user FROM usuarios where Email_user =  '$email' or CPF_user = '$cpf'";
    $res = mysqli_query($base, $regra1) or die("Erro na consulta1");
    $mostrar = mysqli_fetch_array($res);
    $QuantidadeDeCadastros = $res->num_rows;

    return $QuantidadeDeCadastros;
}

function VerificarSeEmpresaJaCadastrada($base, $email, $cnpj)
{
    $regra1 = "SELECT Email, CNPJ FROM empresas where Email =  '$email' or CNPJ = '$cnpj'";
    $res = mysqli_query($base, $regra1) or die("Erro na consulta2");
    $mostrar = mysqli_fetch_array($res);
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

function PegarDadosEmpresaPeloIdCodigo($base, $id_adm, $codigo_acesso)
{
    $regra1 = "SELECT id_adm, id_empresa FROM empresas where id_adm =  $id_adm and codigo_acesso = '$codigo_acesso'";
    $res = mysqli_query($base, $regra1) or die("Erro na consulta8 ". $id_adm ." ". $codigo_acesso);
    $DadosEmpresa = mysqli_fetch_array($res);

    return $DadosEmpresa;
}
