<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    require_once 'sql/ConexaoBD.php';
    require_once "sql/Funcoes.php";

    $conn = new ConexaoBD();
    $func = new Funcoes();

    if (isset($_COOKIE["ID"])) {

        $id = $func->Descriptografar($_COOKIE["ID"]);
        
        $DadosEmpresas = $func->PegarDadosEmpresaPeloIdUsuario($id);
    }

    setcookie("VerificaErro", "0", time() + (86400 * 30), "/");

?>

<!DOCTYPE html>
<html lang = "pt-br">

<head>

    <title> APE </title>

    <?php include "include/Head.php"; ?>

</head>

<body id = "IndexPage" class = "UNT LightMode">

    <?php

        include "php/Pag.php";

        CookieStatus();
        C_Login();
    
        include "include/Load.php";

    ?>

    <header id = "HeaderIndex">

        <?php include "include/Header.php"; ?>

    </header>

    <main id = "MainIndex">

        <div class = "MainContent">

            <section id = "SectionIndexWelcome" class = "SectionWelcome">

                <ul>

                    <li>

                        <h1> Seus itens perdidos reunidos aqui </h1>
                        <p> Encontre os seus itens perdidos em nossa plataforma, ultilizada por empresas públicas e privadas  </p>
                        <button class = "btn">
                            <a id = "WelcomeLogin" href = "LoginUser.php"> Encontrar </a>
                            <a id = "WelcomeFind" href = "Dashboard.php"> Encontrar </a>
                        </button>

                    </li>

                    <li id = "WelcomeBanner"></li>

                </ul>

            </section>

            <section id = "SectionIndexDiscover">

                <div class = "SectionContent">

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

                    <div id = "DiscoverContent">

                        <h1> Conheça a nossa plataforma </h1>

                        <div id = "DiscoverBlocksGroup">

                            <nav>

                                <ul>

                                    <li>
                                        <div class = "DiscoverIconContent">
                                            <a id = "D1" title = "Leia mais">
                                                <i class = "material-icons"> &#xe1b1; </i>
                                            </a>
                                        </div>
                                        <span> Multiplataforma </span>
                                    </li>

                                    <li>
                                        <div class = "DiscoverIconContent">
                                            <a href = "RegisterUser.php" id = "DiscoverNewUser" title = "Criar uma conta gratuitamente">
                                                <i class = "material-icons"> &#xe7fd; </i>
                                            </a>
                                            <a href = "User.php" id = "DiscoverUser" title = "Sua conta">
                                                <i class = "material-icons"> &#xe7fd; </i>
                                            </a>
                                        </div>
                                        <span> Conta Gratuita </span>
                                    </li>

                                    <li class = "DiscoverBlockContent">
                                        <div class = "DiscoverIconContent">
                                            <a id = "D2" title = "Leia mais">
                                                <i class = "material-icons"> &#xe32a; </i>
                                            </a>
                                        </div>
                                        <span> Segurança </span>
                                    </li>

                                    <li>
                                        <div class = "DiscoverIconContent">
                                            <a id = "D3" title = "Leia mais">
                                                <i class = "material-icons"> admin_panel_settings </i>
                                            </a>
                                        </div>
                                        <span> Configurações Avançadas </span>
                                    </li>

                                    <li>
                                        <div class = "DiscoverIconContent">
                                            <a id = "D4" title = "Leia mais">
                                                <i class = "material-icons"> &#xe1db; </i>
                                            </a>
                                        </div>
                                        <span> Armazenamento Gratuito </span>
                                    </li>

                                    <li>
                                        <div class = "DiscoverIconContent">
                                            <a class = "LightModeSwitch" title = "Mudar tema">
                                                <i class = "material-icons"> &#xe891; </i>
                                            </a>
                                            <a class = "DarkModeSwitch" title = "Mudar tema">
                                                <i class = "material-icons"> &#xe891; </i>
                                            </a>
                                        </div>
                                        <span> Temas </span>
                                    </li>

                                </ul>

                            </nav>

                        </div>

                    </div>

                </div>

            </section>

        </div>

    </main>

    <?php include "include/Footer.php"; ?>

    <?php include "include/SideNavBar.php"; ?>
    <?php include "include/HeaderNotification.php"; ?>
    <?php include "include/HeaderConfig.php"; ?>
    <?php include "include/CookieMessage.php"; ?>

    <div id = "DarkEffect"></div>

    <div id = "DiscoverOverlay" class = "MainOverlay">

        <div id = "CloseDiscoverOverlay" class = "CloseOverlay">
            <i class = "material-icons"> &#xe5cd; </i>
        </div>

        <ul id = "DiscoverContent1" class = "DiscoverOverlayUL OverlayUL BS">

            <li>
                <i class = "material-icons"> &#xe1b1; </i>
                <h1> Multiplataforma </h1>
            </li>
            <li>
                <p>
                    A plataforma APE está disponível em várias plataformas e navegadores, permitindo a conexão de muitos lugares diferentes.
                </p>
            </li>

        </ul>

        <ul id = "DiscoverContent2" class = "DiscoverOverlayUL OverlayUL BS">

            <li>
                <i class = "material-icons"> &#xe32a; </i>
                <h1> Segurança </h1>
            </li>
            <li>
                <p>
                    Todos os dados armazenados na plataforma APE são criptografados com tecnologia de ponta que mantém a sua segurança e a sua privacidade.
                </p>
            </li>

        </ul>

        <ul id = "DiscoverContent3" class = "DiscoverOverlayUL OverlayUL BS">

            <li>
                <i class = "material-icons"> admin_panel_settings </i>
                <h1> Configurações Avançadas </h1>
            </li>
            <li>
                <p>
                    Com uma conta nível 4 dentro de uma empresa, você terá opções avançadas para gerenciar a sua página.
                </p>
            </li>

        </ul>

        <ul id = "DiscoverContent4" class = "DiscoverOverlayUL OverlayUL BS">

            <li>
                <i class = "material-icons"> &#xe1db; </i>
                <h1> Armazenamento Gratuito </h1>
            </li>
            <li>
                <p>
                    O armazenamento de dados na plataforma APE é totalmente gratuito e seguro.
                </p>
            </li>

        </ul>

    </div>

    <?php include "include/Script.php"; ?>

</body>

</html>