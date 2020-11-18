<?php

    require_once '../../../sql/Funcoes.php';
    require_once '../../../sql/ConexaoBD.php';

    $conn = new ConexaoBD();
    $func = new Funcoes();

    $id_empresa = $func->Descriptografar($_COOKIE["ID_Company"]);

    $Acessorios = $func->AcessoriosAZ($id_empresa);

    if ($Acessorios["Quantidade"] > 0) {

        include "../../../include/LoadFeed.php";

        echo '
            <li class = "CategoryHeaderBox">

                <h2> Acessórios ('.$Acessorios["Quantidade"].') </h2>

            </li>';

        $i = 0;

        do {
            $Acessorios["Objeto"][$i]["Categoria"] = "Acessório";

            $DataSeparada = $func->SepararData($Acessorios["Objeto"][$i]["Data_cadastro"]);

            echo '

            <li class = "ItemBox CategoryItemBox">

                <a href = "Item.php?q='.$func->Criptografar($Acessorios["Objeto"][$i]["id_obj"]).'">

                    <div class = "ItemImg">
                        <img src = "imagesBD/'.$Acessorios["Objeto"][$i]["Nome_foto"].'">
                    </div>
                    <div class = "ItemInfo">
                        
                        <h1 class = "ItemName"> '.$Acessorios["Objeto"][$i]["Nome_obj"].' </h1>
                        <h2 class = "ItemData"> '.$DataSeparada["dia"].'/'.$DataSeparada["mes"].'/'.$DataSeparada["ano"].' </h2>
                        <h3 class = "ItemCategory"> '.$Acessorios["Objeto"][$i]["Categoria"].' </h3>

                    </div>

                </a>

            </li>';

            $i++;

        } while ($i < $Acessorios["Quantidade"]);

    }else{

        echo '
            <li class = "CategoryHeaderBox">

                <h2> Acessórios ('.$Acessorios["Quantidade"].') </h2>

            </li>';

        echo '

            <li class = "NoFor">

                Nenhum item para mostrar!

            </li>';


    }
