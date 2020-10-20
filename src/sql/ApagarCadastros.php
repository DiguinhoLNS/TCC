<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    include "ConexaoBD.php";
    include "../php/EndUserSession.php";

    $base = mysqli_connect('localhost', 'root', '', 'bdape') or die("erro de conexão");

    $tipo_verificacao = $_SESSION['V'];
    $id = $_COOKIE["ID"];
    $id_empresa = $_GET['q'];

    switch ($tipo_verificacao) {

        //Apagar Conta de Usuario
        case 1:

            $apagar = "DELETE FROM usuarios where id_user = '$id'";
            mysqli_query($base, $apagar);

            $apagar2 = "DELETE FROM user_empresa where id_user = '$id'";
            mysqli_query($base, $apagar2);

            if ($conexao->query($apagar) === TRUE && $conexao->query($apagar2) === TRUE){

                CloseSession();
                
            } else {

                header("Location: ../User.php");
        
            }

        break;

        //Apagar Página de Empresa
        case 2:

            $apagar = "DELETE FROM empresas where id_empresa = '$id_empresa'";
            mysqli_query($base, $apagar);

            if ($conexao->query($apagar) === TRUE) {

                header("Location: ../Dashboard.php");

            } else {

                header("Location: ../Company.php");
                
            }

        break;

    }

?>