<?php

require_once "../sql/ConexaoBD.php";
require_once "../sql/Funcoes.php";

$conn = new ConexaoBD();
$func = new Funcoes();

$tipoVerificacao = $_GET["q"];
$id_user_empresa = $_GET["v"];

$DadosUserEmpresa = $func->PegarDadosUserEmpresaPeloId($id_user_empresa);

switch ($tipoVerificacao) {

    case "Promover":

        if ($DadosUserEmpresa["Usuarios"][$i]["Nivel_acesso"] < 4) {
            try {

                $query = "UPDATE user_empresa SET Nivel_acesso= :nivel_acesso WHERE id_user_empresa= :id_user_empresa";
                $sql = $conn->dbh->prepare($query);
                $sql->execute([':nivel_acesso' => ($DadosUserEmpresa["Usuarios"][0]["Nivel_acesso"] + 1), ':id_user_empresa' => $id_user_empresa]);
            } catch (PDOException $e) {
                die("Erro na consulta");
            }
        } else {
            echo "<script type='text/javascript'> alert('Nivel máximo'); </script>";
        }


        $i = 0;
        $i2 = 1;

        do {

            echo '
                <li>
                    <h1> ' . ($i2) . '  </h1>
                </li>
                <li>
                    <h2> ' . utf8_encode($DadosUserEmpresa["Usuarios"][$i]["Nome_user"]) . ' </h2>
                </li>
                <li>
                    <h3> ' . $DadosUserEmpresa["Usuarios"][$i]["Nivel_acesso"] . ' </h3>
                </li>
                <li>
                    <h4> Status </h4>
                </li>
                <li>
                    <ul class = "FeedConfigUserOptions">
                        <li id = "PromoteUserAccess" title = "Promover Usuário">
                            <i class = "material-icons"> &#xe5c7; </i>
                        </li>
                        <li id = "DemoteUserAccess" title = "Rebaixar Usuário" >
                            <i class = "material-icons"> &#xe5c5; </i>
                        </li>
                        <li id = "DenyUserAccess" title = "Banir Usuário">
                            <i class = "material-icons"> &#xe14b; </i>
                        </li>
                        <li id = "RemoveUserAccess" title = "Remover Usuário">
                            <i class = "material-icons"> &#xe15b; </i>
                        </li>
                    </ul>
                </li>';

            $i++;
            $i2++;
        } while ($i < $DadosUserEmpresa["Quantidade"]);



        echo "67";
        break;

    case "Rebaixar":




        echo "4";
        break;

    case "Negar":





        break;

    case "Banir":






        break;
}
