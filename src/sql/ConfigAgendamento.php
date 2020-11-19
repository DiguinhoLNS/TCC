<?php

require_once "ConexaoBD.php";
require_once "Funcoes.php";

$conn = new ConexaoBD();
$func = new Funcoes();

$tipoVerificacao = $func->Descriptografar($_GET["v"]);
$id_agendamento = $func->Descriptografar($_GET["q"]);

$Pedido = $func->PedidoPeloID($id_agendamento);

switch ($tipoVerificacao) {

    case "A":

        try {

            $query = "UPDATE agendamento SET situacao= :situacao WHERE id_agendamento= :id_agendamento";
            $sql = $conn->dbh->prepare($query);
            $sql->execute([':situacao' => "Aceito", ':id_agendamento' => $id_agendamento]);

            header("Location: ../ConfigFeed.php?q=" . $func->Criptografar($Pedido["Agendamento"][0]["id_empresa"]));

        } catch (PDOException $e) {

            die("Erro na consulta");
        }

        break;

    case "B":

        try {

            $query = "UPDATE agendamento SET situacao= :situacao WHERE id_agendamento= :id_agendamento";
            $sql = $conn->dbh->prepare($query);
            $sql->execute([':situacao' => "Negado", ':id_agendamento' => $id_agendamento]);
            header("Location: ../ConfigFeed.php?q=" . $func->Criptografar($Pedido["Agendamento"][0]["id_empresa"]));
        } catch (PDOException $e) {

            die("Erro na consulta");
        }


        break;
}
