<?php

require_once "ConexaoBD.php";
require_once "Funcoes.php";

$conn = new ConexaoBD();
$func = new Funcoes();

$tipoVerificacao = $_GET["v"];
$id_user_empresa = $_GET["q"];

$DadosUserEmpresa = $func->PegarDadosUserEmpresaPeloId($id_user_empresa);

switch ($tipoVerificacao) {

    case "A":

        $nivel_acesso = $DadosUserEmpresa["Usuarios"][0]["Nivel_acesso"] + 1;

        if ($DadosUserEmpresa["Usuarios"][0]["Nivel_acesso"] < 3) {
            try {

                $query = "UPDATE user_empresa SET Nivel_acesso= :nivel_acesso WHERE id_user_empresa= :id_user_empresa";
                $sql = $conn->dbh->prepare($query);
                $sql->execute([':nivel_acesso' => $nivel_acesso, ':id_user_empresa' => $id_user_empresa]);
                header("Location: ../ConfigFeed.php?q=" . base64_encode($DadosUserEmpresa["Usuarios"][0]["id_empresa"]));
            } catch (PDOException $e) {
                die("Erro na consulta");
            }
        } else {
            header("Location: ../ConfigFeed.php?q=" . base64_encode($DadosUserEmpresa["Usuarios"][0]["id_empresa"]));
        }

        break;

    case "B":

        $nivel_acesso = $DadosUserEmpresa["Usuarios"][0]["Nivel_acesso"] - 1;

        if ($DadosUserEmpresa["Usuarios"][0]["Nivel_acesso"] > 1) {
            try {

                $query = "UPDATE user_empresa SET Nivel_acesso= :nivel_acesso WHERE id_user_empresa = :id_user_empresa";
                $sql = $conn->dbh->prepare($query);
                $sql->execute([':nivel_acesso' => $nivel_acesso, ':id_user_empresa' => $id_user_empresa]);
                header("Location: ../ConfigFeed.php?q=" . base64_encode($DadosUserEmpresa["Usuarios"][0]["id_empresa"]));
            } catch (PDOException $e) {
                die("Erro na consulta");
            }
        } else {
            header("Location: ../ConfigFeed.php?q=" . base64_encode($DadosUserEmpresa["Usuarios"][0]["id_empresa"]));
        }


        break;

    case "C":

        $Banido = "N";

        if ($DadosUserEmpresa["Usuarios"][0]["Banido"] == "S") {
            try {

                $query = "UPDATE user_empresa SET Banido= :banido WHERE id_user_empresa = :id_user_empresa";
                $sql = $conn->dbh->prepare($query);
                $sql->execute([':banido' => $Banido, ':id_user_empresa' => $id_user_empresa]);
                header("Location: ../ConfigFeed.php?q=" . base64_encode($DadosUserEmpresa["Usuarios"][0]["id_empresa"]));
            } catch (PDOException $e) {
                die("Erro na consulta");
            }
        } else {
            header("Location: ../ConfigFeed.php?q=" . base64_encode($DadosUserEmpresa["Usuarios"][0]["id_empresa"]));
        }



        break;

    case "D":

        $Banido = "S";

        if ($DadosUserEmpresa["Usuarios"][0]["Banido"] == "N") {
            try {

                $query = "UPDATE user_empresa SET Banido= :banido WHERE id_user_empresa = :id_user_empresa";
                $sql = $conn->dbh->prepare($query);
                $sql->execute([':banido' => $Banido, ':id_user_empresa' => $id_user_empresa]);
                header("Location: ../ConfigFeed.php?q=" . base64_encode($DadosUserEmpresa["Usuarios"][0]["id_empresa"]));
            } catch (PDOException $e) {
                die("Erro na consulta");
            }
        } else {
            header("Location: ../ConfigFeed.php?q=" . base64_encode($DadosUserEmpresa["Usuarios"][0]["id_empresa"]));
        }

        break;

    case "E":


        if ($DadosUserEmpresa["Usuarios"][0]["Nivel_acesso"] < 4) {
            try {

                $query = "DELETE FROM user_empresa WHERE id_user_empresa = :id_user_empresa";
                $sql = $conn->dbh->prepare($query);
                $sql->execute([':id_user_empresa' => $id_user_empresa]);
                header("Location: ../ConfigFeed.php?q=" . base64_encode($DadosUserEmpresa["Usuarios"][0]["id_empresa"]));
            } catch (PDOException $e) {

                die("Erro na consulta");
            }
        }
        
        break;
}
