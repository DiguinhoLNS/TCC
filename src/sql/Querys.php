<?php

include 'ConexaoBD.php';

function VerificarSeUsuarioJaCadastrado($base, $email, $cpf)
{
    $regra1 = "SELECT Email_user, CPF FROM usuarios where Email_user =  '$email' or CPF_user = '$cpf'";
    $res = mysqli_query($base, $regra1) or die("Usuario não cadastrado");
    $mostrar = mysqli_fetch_array($res);
    $QuantidadeDeCadastros = $res->num_rows;

    return $QuantidadeDeCadastros;
}


function VerificarSeEmpresaJaCadastrada($base, $email, $cnpj)
{
    $regra1 = "SELECT Email, CNPJ FROM empresas where Email =  '$email' or CNPJ = '$cnpj'";
    $res = mysqli_query($base, $regra1) or die("Usuario não cadastrado");
    $mostrar = mysqli_fetch_array($res);
    $QuantidadeDeCadastros = $res->num_rows;

    return $QuantidadeDeCadastros;
}
