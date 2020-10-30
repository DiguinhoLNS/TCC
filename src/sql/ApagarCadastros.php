<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    include "ConexaoBD.php";
    include_once "Funcoes.php";

    $tipo_verificacao = $_SESSION['TipoVerificação'];
    $id = ClearInjectionXSS($base, base64_decode($_COOKIE["ID"]));
    $id_empresa = ClearInjectionXSS($base, $_GET['q']);

    switch ($tipo_verificacao) {

        case "Usuario":

            $apagarUsuario = "DELETE FROM usuarios where id_user = '$id'";
            mysqli_query($base, $apagarUsuario);

            $apagarUser_Empresa = "DELETE FROM user_empresa where id_user = '$id'";
            mysqli_query($base, $apagarUser_Empresa);

            $conexao->query($apagarUsuario) === TRUE && $conexao->query($apagarUser_Empresa) ? EncerrarSessao() : header("Location: ../User.php");

        break;

        case "Empresa":

            $apagarEmpresa = "DELETE FROM empresas where id_empresa = '$id_empresa'";
            mysqli_query($base, $apagarEmpresa);

            $apagarUser_Empresa = "DELETE FROM user_empresa where id_empresa = '$id_empresa'";
            mysqli_query($base, $apagarUser_Empresa);

            $conexao->query($apagarEmpresa) === TRUE && $conexao->query($apagarUser_Empresa) === TRUE ? header("Location: ../Dashboard.php") : header("Location: ../Company.php?q=".base64_encode($id_empresa));

        break;

        case "LoginNaEmpresa":

            $apagarUser_Empresa = "DELETE FROM user_empresa where id_user = '$id' and id_empresa = '$id_empresa'";
            mysqli_query($base, $apagarUser_Empresa);

            $conexao->query($apagarUser_Empresa) ? header("Location: ../Dashboard.php") : header("Location: ../Company.php?q=".$id_empresa);

        break;

    }

?>