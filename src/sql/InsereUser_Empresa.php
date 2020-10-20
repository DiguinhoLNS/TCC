<?php

session_start();

$tipo_verificacao = $_SESSION['V'];

include "ConexaoBD.php";

switch ($tipo_verificacao) {

        //(LOGANDO NA EMPRESA) Usuario nivel de acesso 2
    case 1:
        $codigo_acesso = $_GET['q'];
        $nivel_acesso = 2;
        $id_user = $_COOKIE["ID"];

        $base = mysqli_connect('localhost', 'root', '', 'bdape') or die("erro de conexão");
        $regra1 = "SELECT * FROM empresas where codigo_acesso =  '$codigo_acesso'  ";
        $res = mysqli_query($base, $regra1) or die("Erro na consulta2");
        $mostrar = mysqli_fetch_array($res);

        $id_empresa = $mostrar['id_empresa'];

        //INCLUDE NA TABELA USER_EMPRESA
        $sql = "INSERT INTO user_empresa (id_user, id_empresa, Nivel_acesso) VALUES";
        $sql .= " ('$id_user','$id_empresa','$nivel_acesso') ";

        if ($conexao->query($sql) === TRUE) {
            header("Location: ../Company.php?q=".$id_empresa);
        } else {

            //echo "Erro 3";
            header("Location: ../LoginCompany.php");
        }

    break;

    //(CRIANDO A EMPRESA) Usuario nivel de acesso 4
    case 2:
        $id_adm = $_COOKIE["ID"];
        $nivel_acesso = 4;

        $base = mysqli_connect('localhost', 'root', '', 'bdape') or die("erro de conexão");
        $regra1 = "SELECT id_adm, Max(id_empresa) FROM empresas where id_adm =  '$id_adm'  ";
        $res = mysqli_query($base, $regra1) or die("Erro na consulta2");
        $mostrar = mysqli_fetch_array($res);

        $id_adm = $mostrar['id_adm'];
        $id_empresa = $mostrar['Max(id_empresa)'];

        //INCLUDE NA TABELA USER_EMPRESA
        $sql = "INSERT INTO user_empresa (id_user, id_empresa, Nivel_acesso) VALUES";
        $sql .= " ('$id_adm','$id_empresa','$nivel_acesso') ";

        if ($conexao->query($sql) === TRUE) {
            header("Location: ../Company.php?q=".$id_empresa);
        } else {

            //echo "Erro 3";
            header("Location: ../RegisterCompany.php");
        }

        break;
}
