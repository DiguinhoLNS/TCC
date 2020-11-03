<?php

include '../../sql/ConexaoBD.php';
include '../../sql/Funcoes.php';

$id_empresa = base64_decode($_COOKIE["ID_Company"]);

$pesquisar = ClearInjectionXSS($base, $_GET["q"]);

if ($pesquisar != null) {

    $query = "SELECT * FROM objetos WHERE Nome_obj LIKE '%$pesquisar%' and id_empresa = $id_empresa";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 41");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
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
            $DataSeparada = SepararData($Dados["Objeto"][$i]["Data_cadastro"]);
            echo '          

                <li class = "SearchItemBox ItemBox">

                    <a href = "Item.php?q='.base64_encode($Dados["Objeto"][$i]["id_obj"]) .'" title = "' . $Dados["Objeto"][$i]["Nome_obj"] . '">

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
