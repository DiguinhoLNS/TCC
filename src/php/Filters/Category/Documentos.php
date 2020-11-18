<?php

    require_once '../../../sql/Funcoes.php';
    require_once '../../../sql/ConexaoBD.php';

    $conn = new ConexaoBD();
    $func = new Funcoes();

    $id_empresa = $func->Descriptografar($_COOKIE["ID_Company"]);

    $Documentos = $func->DocumentosAZ($id_empresa);

    if ($Documentos["Quantidade"] > 0) {

        include "../../../include/LoadFeed.php";

        echo '
            <li class = "CategoryHeaderBox">

                <h2> Documentos ('.$Documentos["Quantidade"].') </h2>

            </li>';

        $i = 0;

        do {

            $DataSeparada = $func->SepararData($Documentos["Objeto"][$i]["Data_cadastro"]);

            echo '

            <li class = "ItemBox CategoryItemBox">

                <a href = "Item.php?q='.$func->Criptografar($Documentos["Objeto"][$i]["id_obj"]).'">

                    <div class = "ItemImg">
                        <img src = "imagesBD/'.$Documentos["Objeto"][$i]["Nome_foto"].'">
                    </div>
                    <div class = "ItemInfo">
                        
                        <h1 class = "ItemName"> '.$Documentos["Objeto"][$i]["Nome_obj"].' </h1>
                        <h2 class = "ItemData"> '.$DataSeparada["dia"].'/'.$DataSeparada["mes"].'/'.$DataSeparada["ano"].' </h2>
                        <h3 class = "ItemCategory"> '.$Documentos["Objeto"][$i]["Categoria"].' </h3>

                    </div>

                </a>

            </li>';

            $i++;

        } while ($i < $Documentos["Quantidade"]);

    }else{

        echo '
            <li class = "CategoryHeaderBox">

                <h2> Documentos ('.$Documentos["Quantidade"].') </h2>

            </li>';

        echo '

            <li class = "NoFor">

                Nenhum item para mostrar!

            </li>';   

    }  
