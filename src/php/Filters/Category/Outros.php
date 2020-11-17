<?php

    require_once '../../../sql/Funcoes.php';
    require_once '../../../sql/ConexaoBD.php';

    $conn = new ConexaoBD();
    $func = new Funcoes();

    $id_empresa = $func->Descriptografar($_COOKIE["ID_Company"]);

    $Outros = $func->OutrosAZ($id_empresa);

    if ($Outros["Quantidade"] > 0) {

        include "../../../include/LoadFeed.php";

        echo '
            <li class = "CategoryHeaderBox">

                <h2> Outros ('.$Outros["Quantidade"].') </h2>

            </li>';

        $i = 0;

        do {

            $DataSeparada = $func->SepararData($Outros["Objeto"][$i]["Data_cadastro"]);

            echo '

            <li class = "ItemBox CategoryItemBox">

                <a href = "Item.php?q='.$func->Criptografar($Outros["Objeto"][$i]["id_obj"]).'">

                    <div class = "ItemImg">
                        <img src = "imagesBD/'.$Outros["Objeto"][$i]["Nome_foto"].'">
                    </div>
                    <div class = "ItemInfo">
                        
                        <h1 class = "ItemName"> '.$Outros["Objeto"][$i]["Nome_obj"].' </h1>
                        <h2 class = "ItemData"> '.$DataSeparada["dia"].'/'.$DataSeparada["mes"].'/'.$DataSeparada["ano"].' </h2>
                        <h3 class = "ItemCategory"> '.$Outros["Objeto"][$i]["Categoria"].' </h3>

                    </div>

                </a>

            </li>';

            $i++;

        } while ($i < $Outros["Quantidade"]);

    }else{

        echo '
            <li class = "CategoryHeaderBox">

                <h2> Outros ('.$Outros["Quantidade"].') </h2>

            </li>';

        echo '

            <li class = "ItemBox CategoryItemBox">

                Nada a mostrar

                </a>

            </li>';    

    }
