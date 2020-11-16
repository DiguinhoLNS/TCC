<?php

require_once '../../../sql/Funcoes.php';
require_once '../../../sql/ConexaoBD.php';

$conn = new ConexaoBD();
$func = new Funcoes();

$id_empresa = $func->Descriptografar($_COOKIE["ID_Company"]);

$Documentos = $func->DocumentosAZ($id_empresa);
$Acessorios = $func->AcessoriosAZ($id_empresa);
$Roupas = $func->RoupasAZ($id_empresa);
$Eletronicos = $func->EletronicosAZ($id_empresa);
$Outros = $func->OutrosAZ($id_empresa);

if ($Acessorios["Quantidade"] > 0) {

    echo '

    <div class = "FeedCategoryContent">

        <h2> Acessórios ('.$Acessorios["Quantidade"].') </h2>

        <ul class = "FeedCategory FeedBoxGroup">';

        include "../../../include/LoadFeed.php";

    $i = 0;

    do {
        if($Acessorios["Objeto"][$i]["Categoria"] == "Acessorio"){
            $Acessorios["Objeto"][$i]["Categoria"] = "Acessório";
        }else if($Acessorios["Objeto"][$i]["Categoria" == "Eletronico"]){
            $Acessorios["Objeto"][$i]["Categoria"] = "Eletrônico";
        }
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

    echo '

        </ul>

    </div>';
}


if ($Documentos["Quantidade"] > 0) {

    echo '

    <div class = "FeedCategoryContent">

        <h2> Documentos ('.$Documentos["Quantidade"].') </h2>

        <ul class = "FeedCategory FeedBoxGroup">';

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

    echo '

        </ul>

    </div>';
}



if ($Eletronicos["Quantidade"] > 0) {


    echo '

    <div class = "FeedCategoryContent">

        <h2> Eletrônicos ('.$Eletronicos["Quantidade"].') </h2>

        <ul class = "FeedCategory FeedBoxGroup">';

    $i = 0;

    do {
        if($Eletronicos["Objeto"][$i]["Categoria"] == "Acessorio"){
            $Eletronicos["Objeto"][$i]["Categoria"] = "Acessório";
        }else if($Eletronicos["Objeto"][$i]["Categoria" == "Eletronico"]){
            $Eletronicos["Objeto"][$i]["Categoria"] = "Eletrônico";
        }
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

    echo '

        </ul>

    </div>';
}

if ($Roupas["Quantidade"] > 0) {


    echo '

    <div class = "FeedCategoryContent">

        <h2> Roupas ('.$Roupas["Quantidade"].') </h2>

        <ul class = "FeedCategory FeedBoxGroup">';

    $i = 0;

    do {
        $DataSeparada = $func->SepararData($Roupas["Objeto"][$i]["Data_cadastro"]);
        echo '

        <li class = "ItemBox CategoryItemBox">

            <a href = "Item.php?q='.$func->Criptografar($Roupas["Objeto"][$i]["id_obj"]).'">

                <div class = "ItemImg">
                    <img src = "imagesBD/'.$Roupas["Objeto"][$i]["Nome_foto"].'">
                </div>
                <div class = "ItemInfo">
                    
                    <h1 class = "ItemName"> '.$Roupas["Objeto"][$i]["Nome_obj"].' </h1>
                    <h2 class = "ItemData"> '.$DataSeparada["dia"].'/'.$DataSeparada["mes"].'/'.$DataSeparada["ano"].' </h2>
                    <h3 class = "ItemCategory"> '.$Roupas["Objeto"][$i]["Categoria"].' </h3>

                </div>

            </a>

        </li>';

        $i++;

    } while ($i < $Roupas["Quantidade"]);

    echo '

        </ul>

    </div>';
}

if ($Outros["Quantidade"] > 0) {


    echo '

    <div class = "FeedCategoryContent">

        <h2> Outros ('.$Outros["Quantidade"].') </h2>

        <ul class = "FeedCategory FeedBoxGroup">';

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

    echo '

        </ul>

    </div>';
}

