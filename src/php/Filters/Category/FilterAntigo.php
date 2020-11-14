<?php

include '../../../sql/ConexaoBD.php';
include_once '../../../sql/Funcoes.php';

$id_empresa = $func->Descriptografar($_COOKIE["ID_Company"]);

$Documentos = DocumentosAntigo($base, $id_empresa);
$Acessorios = AcessoriosAntigo($base, $id_empresa);
$Roupas = RoupasAntigo($base, $id_empresa);
$Eletronicos = EletronicosAntigo($base, $id_empresa);
$Outros = OutrosAntigo($base, $id_empresa);

echo '
<div id="CategoryItensFrame" class="FeedFrame">

<div class="FeedFrameContent">

<h1 class="TitleHeader"> Categorias </h1>' ?>
<?php

if ($Eletronicos["Quantidade"] == 0) {

    echo '
        <div class = "FeedFrameCategory">											

        <ul class = "FeedBoxGroup">';
} else {
    $i = 0;
    echo '
        <div class = "FeedFrameCategory">

        <h2 class = "HeaderCategory"> Eletrônicos </h2>

        <ul class = "FeedBoxGroup">';
    do {
        $DataSeparada = SepararData($Eletronicos["Objeto"][$i]["Data_cadastro"]);
        echo '


                <li class = "ItemBox">

                    <a href = "#" title = "' . $Eletronicos["Objeto"][$i]["Nome_obj"] . '">

                        <div class = "ItemImg">
                            <img src = "imagesBD/' . $Eletronicos["Objeto"][$i]["Nome_foto"] . '">
                        </div>

                        <div class = "ItemInfo">
                            
                            <h1 class = "ItemName"> ' . $Eletronicos["Objeto"][$i]["Nome_obj"] . ' </h1>
                            <h2 class = "ItemData"> ' . $DataSeparada["dia"] . "/" . $DataSeparada["mes"] . "/" . $DataSeparada["ano"] . ' </h2>
                            <h3 class = "ItemCategory"> ' . $Eletronicos["Objeto"][$i]["Categoria"] . ' </h3>

                        </div>

                    </a>

                </li>
            ';
        $i++;
    } while ($i < ($Eletronicos["Quantidade"]));
}

?>
<?php echo '
</ul>

</div>'; ?>

        <?php

        if ($Roupas["Quantidade"] == 0) {

            echo '
                <div class = "FeedFrameCategory">									

                <ul class = "FeedBoxGroup">';
        } else {
            echo '
                <div class = "FeedFrameCategory">

                <h2 class = "HeaderCategory"> Roupas </h2>

                <ul class = "FeedBoxGroup">';

            $i = 0;
            do {
                $DataSeparada = SepararData($DadosItem["Objeto"][$i]["Data_cadastro"]);
                echo '
            <li class = "ItemBox">

            <a href = "#" title = "' . $Roupas["Objeto"][$i]["Nome_obj"] . '">

            <div class = "ItemImg">
            <img src = "imagesBD/' . $Roupas["Objeto"][$i]["Nome_foto"] . '">
            </div>

            <div class = "ItemInfo">

            <h1 class = "ItemName"> ' . $Roupas["Objeto"][$i]["Nome_obj"] . " aaa" . ' </h1>
            <h2 class = "ItemData"> ' . $DataSeparada["dia"] . "/" . $DataSeparada["mes"] . "/" . $DataSeparada["ano"] . ' </h2>
            <h3 class = "ItemCategory"> ' . $Roupas["Objeto"][$i]["Categoria"] . ' </h3>

            </div>

            </a>

            </li>
            ';
                $i++;
            } while ($i < ($Roupas["Quantidade"]));
        }

        ?>

            <?php echo '
            </ul>

            </div>'; ?>


<?php

if ($Acessorios["Quantidade"] == 0) {
    echo '
        <div class = "FeedFrameCategory">	

        <ul class = "FeedBoxGroup">';
} else {
    $i = 0;
    echo '
        <div class = "FeedFrameCategory">

        <h2 class = "HeaderCategory"> Acessórios </h2>

        <ul class = "FeedBoxGroup">';
    do {
        $DataSeparada = SepararData($DadosItem["Objeto"][$i]["Data_cadastro"]);
        echo '

                <li class = "ItemBox">

                    <a href = "#" title = "' . $Acessorios["Objeto"][$i]["Nome_obj"] . '">

                        <div class = "ItemImg">
                            <img src = "imagesBD/' . $Acessorios["Objeto"][$i]["Nome_foto"] . '">
                        </div>

                        <div class = "ItemInfo">
                            
                            <h1 class = "ItemName"> ' . $Acessorios["Objeto"][$i]["Nome_obj"] . ' </h1>
                            <h2 class = "ItemData"> ' . $DataSeparada["dia"] . "/" . $DataSeparada["mes"] . "/" . $DataSeparada["ano"] . ' </h2>
                            <h3 class = "ItemCategory"> ' . $Acessorios["Objeto"][$i]["Categoria"] . ' </h3>

                        </div>

                    </a>

                </li>
            ';
        $i++;
    } while ($i < ($Acessorios["Quantidade"]));
}

?>

<?php echo '
</ul>

</div>'; ?>

<?php

if ($Documentos["Quantidade"] == 0) {
    echo '
        <div class = "FeedFrameCategory">

        <ul class = "FeedBoxGroup">';
} else {
    $i = 0;
    echo '
        <div class = "FeedFrameCategory">

        <h2 class = "HeaderCategory"> Documentos </h2>

        <ul class = "FeedBoxGroup">';

    do {
        $DataSeparada = SepararData($DadosItem["Objeto"][$i]["Data_cadastro"]);
        echo '

                <li class = "ItemBox">

                    <a href = "#" title = "' . $Documentos["Objeto"][$i]["Nome_obj"] . '">

                        <div class = "ItemImg">
                            <img src = "imagesBD/' . $Documentos["Objeto"][$i]["Nome_foto"] . '">
                        </div>

                        <div class = "ItemInfo">
                            
                            <h1 class = "ItemName"> ' . $Documentos["Objeto"][$i]["Nome_obj"] . ' </h1>
                            <h2 class = "ItemData"> ' . $DataSeparada["dia"] . "/" . $DataSeparada["mes"] . "/" . $DataSeparada["ano"] . ' </h2>
                            <h3 class = "ItemCategory"> ' . $Documentos["Objeto"][$i]["Categoria"] . ' </h3>

                        </div>

                    </a>

                </li>
            ';
        $i++;
    } while ($i < ($Documentos["Quantidade"]));
}

?>

<?php echo '
</ul>

</div>'; ?>

<?php

if ($Outros["Quantidade"] == 0) {
    echo '

        <div class = "FeedFrameCategory">

        <ul class = "FeedBoxGroup">';
} else {
    $i = 0;
    echo '				
        <div class = "FeedFrameCategory">

        <h2 class = "HeaderCategory"> Outros </h2>

        <ul class = "FeedBoxGroup">';

    do {
        $DataSeparada = SepararData($DadosItem["Objeto"][$i]["Data_cadastro"]);
        echo '

                <li class = "ItemBox">

                    <a href = "#" title = "' . $Outros["Objeto"][$i]["Nome_obj"] . '">

                        <div class = "ItemImg">
                            <img src = "imagesBD/' . $Outros["Objeto"][$i]["Nome_foto"] . '">
                        </div>

                        <div class = "ItemInfo">
                            
                            <h1 class = "ItemName"> ' . $Outros["Objeto"][$i]["Nome_obj"] . ' </h1>
                            <h2 class = "ItemData"> ' . $DataSeparada["dia"] . "/" . $DataSeparada["mes"] . "/" . $DataSeparada["ano"] . ' </h2>
                            <h3 class = "ItemCategory"> ' . $Outros["Objeto"][$i]["Categoria"] . ' </h3>

                        </div>

                    </a>

                </li>
            ';
        $i++;
    } while ($i < ($Outros["Quantidade"]));
}

?>

<?php echo '
</ul>

</div>

</div>

</div>'; ?>