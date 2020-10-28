<?php

    include '../../../sql/ConexaoBD.php';

    $id_empresa = base64_decode($_COOKIE["ID_Company"]);

    $FeedQuery = TodosAntigo($base, $id_empresa);

    function TodosAntigo($base, $id_empresa){

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa order by Data_cadastro ASC";
        $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 21");
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
            return $Dados;
        } else {
            return $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
            ];
        }
    }

    if($FeedQuery["Quantidade"]==0){

        echo '<li class = "NoFor"> Nenhum item para mostrar </li>';

    }else{
        $i=0;
        do{
            echo '
                <li class = "ItemBox">

                    <a href = "#" title = "'.$FeedQuery["Objeto"][$i]["Nome_obj"].'">

                        <div class = "ItemImg">
                            <img src = "imagesBD/'.$FeedQuery["Objeto"][$i]["Nome_foto"].'">
                        </div>

                        <div class = "ItemInfo">
                            
                            <h1 class = "ItemName"> '.$FeedQuery["Objeto"][$i]["Nome_obj"].' </h1>
                            <h2 class = "ItemData"> '.$FeedQuery["Objeto"][$i]["Data_cadastro"].' </h2>
                            <h3 class = "ItemCategory"> '.$FeedQuery["Objeto"][$i]["Categoria"].' </h3>

                        </div>

                    </a>

                </li>
            ';

        $i++;

        }while($i<($FeedQuery["Quantidade"]));

    }

?>