<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    require_once "ConexaoBD.php";
    require_once "Funcoes.php";

    $conn = new ConexaoBD();
	$func = new Funcoes();

    $tipo_verificacao = $_SESSION['TipoVerificação'];

    switch ($tipo_verificacao) {

        //(LOGANDO NA EMPRESA) Usuario nivel de acesso 2
        case "Usuario":

            $codigo_acesso = $func->ClearInjectionXSS(base64_decode($_GET['q']));
            $id_user = $func->ClearInjectionXSS(base64_decode($_COOKIE["ID"]));

            $DadosEmpresa = $func->PegarDadosEmpresaPeloCodigo($codigo_acesso);

            $sql = "INSERT INTO user_empresa (id_user, id_empresa, Nivel_acesso) VALUES";
            $sql .= " ('$id_user','".$DadosEmpresa['id_empresa']."','2') ";

            $conn->dbh->query($sql) ? header("Location: ../Company.php?q=".base64_encode($DadosEmpresa["id_empresa"])) : header("Location: ../LoginCompany.php");

        break;

        //(CRIANDO A EMPRESA) Usuario nivel de acesso 4
        case "Empresa":

            $codigo_acesso = $func->ClearInjectionXSS(base64_decode($_GET['q']));
            $id_adm = $func->ClearInjectionXSS(base64_decode($_COOKIE["ID"]));

            $DadosEmpresa = $func->PegarDadosEmpresaPeloId_Codigo($id_adm, $codigo_acesso);

            $sql = "INSERT INTO user_empresa (id_user, id_empresa, Nivel_acesso) VALUES";
            $sql .= " ('$id_adm','".$DadosEmpresa[0]['id_empresa']."','4') ";

            $conn->dbh->query($sql) ? header("Location: ../Company.php?q=".base64_encode($DadosEmpresa[0]["id_empresa"])) : header("Location: ../RegisterCompany.php");

        break;

    }
