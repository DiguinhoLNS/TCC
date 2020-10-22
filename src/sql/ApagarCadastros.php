<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    include "ConexaoBD.php";
    include_once "../php/EndUserSession.php";

    $base = mysqli_connect('localhost', 'root', '', 'bdape') or die("erro de conexão");

    $tipo_verificacao = $_SESSION['TipoVerificação'];
    $id = $_COOKIE["ID"];
    $id_empresa = $_GET['q'];

    switch ($tipo_verificacao) {

        case "Usuario":

            $apagarUsuario = "DELETE FROM usuarios where id_user = '$id'";
            mysqli_query($base, $apagarUsuario);

            $apagarUser_Empresa = "DELETE FROM user_empresa where id_user = '$id'";
            mysqli_query($base, $apagarUser_Empresa);

            $conexao->query($apagarUsuario) === TRUE && $conexao->query($apagarUser_Empresa) ? CloseSession() : header("Location: ../User.php");

        break;

        case "Empresa":

            $apagarEmpresa = "DELETE FROM empresas where id_empresa = '$id_empresa'";
            mysqli_query($base, $apagarEmpresa);

            $apagarUser_Empresa = "DELETE FROM user_empresa where id_empresa = '$id_empresa'";
            mysqli_query($base, $apagarUser_Empresa);

            $conexao->query($apagarEmpresa) === TRUE && $conexao->query($apagarUser_Empresa) === TRUE ? header("Location: ../Dashboard.php") : header("Location: ../Company.php?q=".$id_empresa);

        break;

    }

?>