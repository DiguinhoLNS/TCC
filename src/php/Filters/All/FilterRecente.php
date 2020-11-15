<?php

    require_once '../../../sql/ConexaoBD.php';
    require_once '../../../sql/Funcoes.php';

    $conn = new ConexaoBD();
	$func = new Funcoes();

    $id_empresa = $func->Descriptografar($_COOKIE["ID_Company"]);

    $FeedQuery = $func->TodosRecente($id_empresa);

    if($FeedQuery["Quantidade"]==0){

        echo '<li class = "NoFor"> Nenhum item para mostrar </li>';

    }else{
        include "../../../include/LoadFeed.php";
        $i=0;
        do{
            $DataSeparada = $func->SepararData($FeedQuery["Objeto"][$i]["Data_cadastro"]);
            echo '
                <li class = "AllItemBox ItemBox">

                    <a href = "Item.php?q='.$func->Criptografar($FeedQuery["Objeto"][$i]["id_obj"]) .'" title = "'.$FeedQuery["Objeto"][$i]["Nome_obj"].'" title = "'.$FeedQuery["Objeto"][$i]["Nome_obj"].'">

                        <div class = "ItemImg">
                            <img src = "imagesBD/'.$FeedQuery["Objeto"][$i]["Nome_foto"].'">
                        </div>

                        <div class = "ItemInfo">
                            
                            <h1 class = "ItemName"> '.$FeedQuery["Objeto"][$i]["Nome_obj"].' </h1>
                            <h2 class = "ItemData"> '.$DataSeparada["dia"] . "/" . $DataSeparada["mes"] . "/" . $DataSeparada["ano"].' </h2>
                            <h3 class = "ItemCategory"> '.$FeedQuery["Objeto"][$i]["Categoria"].' </h3>

                        </div>

                    </a>

                </li>
            ';

        $i++;

        }while($i<($FeedQuery["Quantidade"]));

    }
