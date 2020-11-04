<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');

require_once "ConexaoBD.php";
require_once "Funcoes.php";

$conn = new ConexaoBD();
$func = new Funcoes();

$id = $func->ClearInjectionXSS(base64_decode($_COOKIE["ID"]));

$id_empresa = $func->ClearInjectionXSS(base64_decode(($_GET['q'])));
$tipo_verificacao = $func->ClearInjectionXSS(base64_decode(($_GET['v'])));



switch ($tipo_verificacao) {

    case "Usuario":

        $apagarUsuario = "DELETE FROM usuarios where id_user = '$id'";
        $conn->dbh->query($apagarUsuario);

        $apagarUser_Empresa = "DELETE FROM user_empresa where id_user = '$id'";
        $conn->dbh->query($apagarUser_Empresa);

        $conn->dbh->query($apagarUsuario) && $conn->dbh->query($apagarUser_Empresa) ? $func->EncerrarSessao() : header("Location: ../User.php");

        break;

    case "Empresa":

        $DesativarEmpresa = "UPDATE empresas SET Situacao='Desativada' WHERE id_empresa = '$id_empresa'";
        $conn->dbh->query($DesativarEmpresa);

        $apagarUser_Empresa = "DELETE FROM user_empresa where id_empresa = '$id_empresa'";
        $conn->dbh->query($apagarUser_Empresa);

        $conn->dbh->query($DesativarEmpresa) && $conn->dbh->query($apagarUser_Empresa) ? header("Location: ../Dashboard.php") : header("Location: ../Company.php?q=" . base64_encode($id_empresa));

        break;

    case "LoginNaEmpresa":

        $apagarUser_Empresa2 = "DELETE FROM user_empresa where id_user = '$id' and id_empresa = '$id_empresa'";
        echo $apagarUser_Empresa2;

        $conn->dbh->query($apagarUser_Empresa2);

        $conn->dbh->query($apagarUser_Empresa2) ? header("Location: ../Dashboard.php") : header("Location: ../Company.php?q=".$id_empresa);

        break;
}
