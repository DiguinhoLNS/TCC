<?php 

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    include 'sql/ConexaoBD.php'; 
    include_once "sql/Funcoes.php";

    if(isset($_COOKIE["ID"])){

        $id = base64_decode($_COOKIE["ID"]);

        $DadosEmpresas = PegarDadosEmpresaPeloIdUsuario($base, $id);

    }

    
    
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
            setcookie("VerificaErro", "0", time() + (86400 * 30), "/");

            include "include/Load.php";      

        ?>
        
		<header id = "HeaderIndex">

            <?php include "include/Header.php"; ?>

        </header>

        <main id = "MainIndex">

            <div class = "MainContent">

                <section id = "SectionIndexWelcome">

                    <div id = "WelcomeHeader">

                        <div id = "WelcomeNav">
                            <h1> Seus itens perdidos reunidos aqui </h1>
                            <p> Encontre os seus itens perdidos em nossa plataforma, ultilizada por empresas privadas e públicas </p>
                            <button class = "btn">
                                <a id = "WelcomeLogin" href = "LoginUser.php"> Encontrar </a>
                                <a id = "WelcomeFind" href = "Dashboard.php"> Encontrar </a>
                            </button>
                        </div>
                        <div id = "WelcomeBanner"> PLACEHOLDER - Imagem </div>

                    </div>

                </section>

                <section id = "SectionIndexDiscover">

                    <div class = "CompaniesQuickAccessBar">
                        <?php

                            $i = 0;
                            
                            if($DadosEmpresas["QuantidadeDeEmpresas"]>0){
                            
                                do{

                                    echo '
                                        <a href = "Company.php?q='.base64_encode($DadosEmpresas['Dados'][$i]['id_empresa']).'" class = "CompanyBox '.$DadosEmpresas['Dados'][$i]['Cor_layout'].'" title = "Acessar '.$DadosEmpresas['Dados'][$i]['Nome'].' ">

                                            <h1 class = "CompanyTitle"> '.$DadosEmpresas['Dados'][$i]['Nome'].' </h1>
                                        
                                        </a>
                                    ';

                                    $i++;
                                    if($i>2){
                                        break;
                                    }

                                }while($i<$DadosEmpresas["QuantidadeDeEmpresas"]);

                            }
                            
                        ?>
                    </div>

                    <div id = "DiscoverContent">

                        <h1> Conheça a nossa plataforma </h1>

                        <div id = "DiscoverBlocksGroup">

                            <nav>

                                <ul>

                                    <li class = "DiscoverBlockContent">
                                        <a id = "D1" title = "Leia mais">
                                            <i class = "material-icons"> &#xe1b1; </i>
                                        </a>
                                    </li>
                                    <li class = "DiscoverBlockContent">
                                        <a href = "RegisterUser.php" title = "Criar uma conta gratuitamente">
                                            <i class = "material-icons"> &#xe7fd; </i>
                                        </a>
                                    </li>
                                    <li class = "DiscoverBlockContent">
                                        <a id = "D2" title = "Leia mais">
                                            <i class = "material-icons"> &#xe32a; </i>
                                        </a>
                                    </li>

                                    <li class = "DiscoverBlockText">
                                        <span> Multiplataforma </span>
                                    </li>
                                    <li class = "DiscoverBlockText">
                                        <span> Conta Gratuita </span>
                                    </li>
                                    <li class = "DiscoverBlockText">
                                        <span> Segurança </span>
                                    </li>

                                </ul>

                            </nav>

                            <nav>

                                <ul>

                                    <li class = "DiscoverBlockContent">
                                        <a id = "D3" title = "Leia mais">
                                            <i class = "material-icons"> admin_panel_settings </i>
                                        </a>
                                    </li>
                                    <li class = "DiscoverBlockContent">
                                        <a id = "D4" title = "Leia mais">
                                            <i class = "material-icons"> &#xe1db; </i>
                                        </a>
                                    </li>
                                    <li class = "DiscoverBlockContent">
                                        <a class = "LightModeSwitch" title = "Mudar tema">
                                            <i class = "material-icons"> &#xe891; </i>
                                        </a>
                                        <a class = "DarkModeSwitch" title = "Mudar tema">
                                            <i class = "material-icons"> &#xe891; </i>
                                        </a>
                                    </li>

                                    <li class = "DiscoverBlockText">
                                        <span> Configurações Avançadas </span>
                                    </li>
                                    <li class = "DiscoverBlockText">
                                        <span> Armazenamento Gratuito </span>
                                    </li>
                                    <li class = "DiscoverBlockText">
                                        <span> Temas </span>
                                    </li>

                                </ul>

                            </nav>

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