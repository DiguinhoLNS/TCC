<?php

session_start();
include "ConexaoBD.php";
include "../php/EndUserSession.php";

$tipo_verificacao = $_SESSION['V'];
$id = $_COOKIE["ID"];

switch ($tipo_verificacao) {

        //Apagar Conta de Usuario
    case 1:

        $base = mysqli_connect('localhost', 'root', '', 'bdape') or die("erro de conexão");
        $apagar = "DELETE FROM usuarios where id_user = '$id'";
        mysqli_query($base, $apagar);

        if ($conexao->query($apagar) === TRUE) {

            CloseSession();
            
        } else {

            header("Location: ../User.php");
       
        }
        break;

        //Apagar Página de Empresa
    case 2:
        $base = mysqli_connect('localhost', 'root', '', 'bdape') or die("erro de conexão");
        $apagar = "DELETE FROM empresas where id_adm = '$id'";
        mysqli_query($base, $apagar);

        if ($conexao->query($apagar) === TRUE) {

            header("Location: ../Dashboard.php");

        } else {

            header("Location: ../Company.php");
            
        }
        break;
}