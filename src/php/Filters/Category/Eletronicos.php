<?php

    require_once '../../../sql/Funcoes.php';
    require_once '../../../sql/ConexaoBD.php';

    $conn = new ConexaoBD();
    $func = new Funcoes();

    $id_empresa = $func->Descriptografar($_COOKIE["ID_Company"]);

    $Eletronicos = $func->EletronicosAZ($id_empresa);

    if ($Eletronicos["Quantidade"] > 0) {

        include "../../../include/LoadFeed.php";

        echo '
            <li class = "CategoryHeaderBox">

                <h2> Eletrônicos ('.$Eletronicos["Quantidade"].') </h2>

            </li>';

        $i = 0;

        do {
            $Eletronicos["Objeto"][$i]["Categoria"] = "Eletrônico";

            $DataSeparada = $func->SepararData($Eletronicos["Objeto"][$i]["Data_cadastro"]);

            echo '

            <li class = "ItemBox CategoryItemBox">

                <a href = "Item.php?q='.$func->Criptografar($Eletronicos["Objeto"][$i]["id_obj"]).'">

                    <div class = "ItemImg">
                        <img src = "imagesBD/'.$Eletronicos["Objeto"][$i]["Nome_foto"].'">
                    </div>
                    <div class = "ItemInfo">
                        
                        <h1 class = "ItemName"> '.$Eletronicos["Objeto"][$i]["Nome_obj"].' </h1>
                        <h2 class = "ItemData"> '.$DataSeparada["dia"].'/'.$DataSeparada["mes"].'/'.$DataSeparada["ano"].' </h2>
                        <h3 class = "ItemCategory"> '.$Eletronicos["Objeto"][$i]["Categoria"].' </h3>

                    </div>

                </a>

            </li>';

            $i++;

        } while ($i < $Eletronicos["Quantidade"]);

    }else{
        echo '
            <li class = "CategoryHeaderBox">

                <h2> Eletrônicos ('.$Eletronicos["Quantidade"].') </h2>

            </li>';

        echo '

            <li class = "ItemBox CategoryItemBox">

                Nada a mostrar

                </a>

            </li>'; 
    }
