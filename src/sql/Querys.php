<?php

function VerificarSeUsuarioJaCadastrado($base, $email, $cpf)
{
    include 'ConexaoBD.php';
    $regra1 = "SELECT Email_user, CPF_user FROM usuarios where Email_user =  '$email' or CPF_user = '$cpf'";
    $res = mysqli_query($base, $regra1) or die("Erro na consulta1");
    $mostrar = mysqli_fetch_array($res);
    $QuantidadeDeCadastros = $res->num_rows;

    return $QuantidadeDeCadastros;
}

function VerificarSeEmpresaJaCadastrada($base, $email, $cnpj)
{
    include 'ConexaoBD.php';
    $regra1 = "SELECT Email, CNPJ FROM empresas where Email =  '$email' or CNPJ = '$cnpj'";
    $res = mysqli_query($base, $regra1) or die("Erro na consulta2");
    $mostrar = mysqli_fetch_array($res);
    $QuantidadeDeCadastros = $res->num_rows;

    return $QuantidadeDeCadastros;
}

function PegarDadosEmpresaPeloIdEmpresa($base, $id_empresa)
{
    include 'ConexaoBD.php';
    $regra1 = "SELECT * FROM empresas where id_empresa =  '$id_empresa'";
    $res = mysqli_query($base, $regra1) or die("Erro na consulta3");
    $DadosEmpresa = mysqli_fetch_array($res);

    return $DadosEmpresa;
}

function PegarDadosUserEmpresaPeloIdUserEIdEmpresa($base, $id_user, $id_empresa)
{
    include 'ConexaoBD.php';
    $regra2 = "SELECT * FROM user_empresa where id_user =  '$id_user' and id_empresa = $id_empresa";
    $res2 = mysqli_query($base, $regra2) or die("Erro na consulta4");
    $DadosUserEmpresa = mysqli_fetch_array($res2);

    return $DadosUserEmpresa;
}
