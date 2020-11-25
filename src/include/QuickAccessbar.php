<ul class = "CompaniesQuickAccessBar">

    <?php

    $i = 0;

    if ($DadosEmpresas["QuantidadeDeEmpresas"] > 0) {

        do {

            echo '
            <li class = "CompanyBox">
                <a href = "Feed.php?q=' . $func->Criptografar($DadosEmpresas['Dados'][$i]['id_empresa']) . '" class = "'. $DadosEmpresas['Dados'][$i]['Cor_layout'] . '" title = "Acessar ' . $DadosEmpresas['Dados'][$i]['Nome'] . ' ">
                    <h1> ' . $DadosEmpresas['Dados'][$i]['Nome']. ' </h1>
                </a>
            </li>
            ';
            $i++;
            if ($i > 1) {
                break;
            }
        } while ($i < $DadosEmpresas["QuantidadeDeEmpresas"]);
    }
    ?>
    <li class = "SeeMore">
        <a href = "Dashboard.php" title = "Ir para Dashboard"> Ver Mais </a>
    </li>   

</ul>