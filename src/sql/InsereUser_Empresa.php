<?php

session_start();

$tipo_verificacao = $_SESSION['var'];

include "ConexaoBD.php";

switch ($tipo_verificacao) {

    case 1:
        break;


    case 2:
        $id_adm= $_COOKIE["ID"];
        $nivel_acesso = 4;

        $base = mysqli_connect('localhost', 'root', '', 'bdape') or die("erro de conexão");
        $regra1 = "SELECT id_adm, id_empresa FROM empresas where id_adm =  '$id_adm' ";
        $res = mysqli_query($base, $regra1) or die("Erro na consulta");
        $mostrar = mysqli_fetch_array($res);

        $id_adm = $mostrar['id_adm'];
        $id_empresa = $mostrar['id_empresa'];

        //INCLUDE NA TABELA USER_EMPRESA
		$sql = "INSERT INTO user_empresa (id_user, id_empresa, Nivel_acesso) VALUES";
		$sql .= " ('$id_adm','$id_empresa','$nivel_acesso') ";

        if ($conexao->query($sql) === TRUE) {

			header("Location: ../Company.php");
		} else {

            echo "Erro no cadastro de User_Empresa";
			//header("Location: ../RegisterCompany.php");
		}

        break;
}
