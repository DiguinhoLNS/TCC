<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');

require_once "ConexaoBD.php";
require_once "Funcoes.php";

$conn = new ConexaoBD();
$func = new Funcoes();

$idU = $func->ClearInjectionXSS($func->Descriptografar($_COOKIE["ID"]));

$idQ = $func->ClearInjectionXSS(base64_decode(($_GET['q'])));
$tipo_verificacao = $func->ClearInjectionXSS(base64_decode(($_GET['v'])));

switch ($tipo_verificacao) {

    case "Usuario":

        $apagarUsuario = "DELETE FROM usuarios where id_user = '$idU'";
        $apagarUser_Empresa = "DELETE FROM user_empresa where id_user = '$idU'";

        try {
            $conn->dbh->query($apagarUsuario);
            $conn->dbh->query($apagarUser_Empresa);

            $func->EncerrarSessao();
        } catch (PDOException $e) {
            header("Location: ../User.php");
        }

        break;

    case "Empresa":

        $DesativarEmpresa = "UPDATE empresas SET Situacao='Desativada' WHERE id_empresa = '$idQ'";
        $apagarUser_Empresa = "DELETE FROM user_empresa where id_empresa = '$idQ'";

        try {
            $conn->dbh->query($DesativarEmpresa);
            $conn->dbh->query($apagarUser_Empresa);
            header("Location: ../Dashboard.php");
        } catch (PDOException $e) {
            header("Location: ../Company.php?q=" . base64_encode($idQ));
        }

        break;

    case "LoginNaEmpresa":

        $apagarUser_Empresa2 = "DELETE FROM user_empresa where id_user = '$idU' and id_empresa = '$idQ'";

        try {
            $conn->dbh->query($apagarUser_Empresa2);
            header("Location: ../Dashboard.php");
        } catch (PDOException $e) {
            header("Location: ../Company.php?q=" . base64_encode($idQ));
        }

        break;

    case "Item":

        $DadosItemEmpresa = $func->PegarDadosItemPeloId($idQ);
        $apagarItem = "DELETE FROM objetos where id_obj = '$idQ'";

        try {
            $conn->dbh->query($apagarItem);
            header("Location: ../ConfigFeed.php?q=" . base64_encode($DadosItemEmpresa["Objeto"][0]["id_empresa"]));
        } catch (PDOException $e) {
            header("Location: ../ConfigFeed.php?q=" . base64_encode($DadosItemEmpresa["Objeto"][0]["id_empresa"]));
        }

        break;
}
