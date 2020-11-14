<?php

require_once '../../sql/ConexaoBD.php';
require_once '../../sql/Funcoes.php';

$conn = new ConexaoBD();
$func = new Funcoes();

$id_empresa = $func->Descriptografar($_COOKIE["ID_Company"]);

$pesquisar = $func->ClearInjectionXSS($_GET["q"]);

if ($pesquisar != null) {

    $query = "SELECT * FROM objetos WHERE Nome_obj LIKE '%$pesquisar%' and id_empresa = = '$id_empresa'";
    $ResultadoQuery = $conn->dbh->query($query) or die("Erro na consulta 41");
    $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

    if ($QuantidadeDeObjetos > 0) {
        $DadosObjetos = $ResultadoQuery->fetchAll();
    }

    if (isset($DadosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $DadosObjetos
        ];
        $Dados;
    } else {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }

    if ($Dados["Quantidade"] == 0) {

        echo '<li class = "NoFor"> Nenhum item para mostrar </li>';
    } else {
        include "../../include/LoadFeed.php";
        $i = 0;
        do {
            $DataSeparada = $func->SepararData($Dados["Objeto"][$i]["Data_cadastro"]);
            echo '          

                <li class = "SearchItemBox ItemBox">

                    <a href = "Item.php?q=' . $func->Criptografar($Dados["Objeto"][$i]["id_obj"]) . '" title = "' . $Dados["Objeto"][$i]["Nome_obj"] . '">

                        <div class = "ItemImg">
                            <img src = "imagesBD/' . $Dados["Objeto"][$i]["Nome_foto"] . '">
                        </div>

                        <div class = "ItemInfo">
                            
                            <h1 class = "ItemName"> ' . $Dados["Objeto"][$i]["Nome_obj"] . ' </h1>
                            <h2 class = "ItemData"> ' . $DataSeparada["dia"] . "/" . $DataSeparada["mes"] . "/" . $DataSeparada["ano"] . ' </h2>
                            <h3 class = "ItemCategory"> ' . $Dados["Objeto"][$i]["Categoria"] . ' </h3>

                        </div>

                    </a>

                </li>
            ';
            $i++;
        } while ($i < ($Dados["Quantidade"]));
    }
} else {
    echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
}
