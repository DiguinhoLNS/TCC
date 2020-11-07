<?php


case "Promover":

    $id_UserEmpresa = $func->ClearInjectionXSS(base64_decode($_GET["q"]));

    try {

        $query = "UPDATE user_empresa SET Nivel_acesso= :nivel_acesso WHERE id_user_empresa= :id_user_empresa";
        $sql = $conn->dbh->prepare($query);
        $sql->execute([':nivel_acesso' => $id_UserEmpresa, ':id_user_empresa' => $id_UserEmpresa]);
        
    } catch (PDOException $e) {
        die("Erro na consulta");
    }


    break;

case "Rebaixar":
    break;