<?php 

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    include 'sql/ConexaoBD.php'; 

    $base = mysqli_connect('localhost', 'root', '', 'bdape')or die("Erro de conexão");

    if(isset($_COOKIE["ID"])){

        $id = $_COOKIE["ID"];

        $regra1 = "SELECT * FROM empresas inner join user_empresa on 'id_empresa' = 'id_empresa' where user_empresa.id_user = $id and empresas.id_empresa = user_empresa.id_empresa order by Nome ASC";
        $res = mysqli_query($base, $regra1) or die("Erro na consulta");

        while($mostrar = mysqli_fetch_array($res)){
       
            $rows[] = $mostrar;

        }

        $linhas = $res->num_rows;

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
                            
                            if($linhas>0){
                            
                                do{

                                    echo '
                                        <a href = "Company.php?q='.$rows[$i]['id_empresa'].'" class = "CompanyBox '.$rows[$i]['Cor_layout'].'" title = "Acessar '.$rows[$i]['Nome'].' ">

                                        <h1> '.$rows[$i]['Nome'].' </h1>
                                        
                                        </a>
                                    ';

                                    $i++;
                                    if($i>2){
                                        $i=$linhas;
                                    }

                                }while($i<$linhas);

                            }
                            
                        ?>
                    </div>

                    <div id = "DiscoverContent">

                        <h1> Conheça a nossa plataforma </h1>

                        <div id = "DiscoverBlocksGroup">

                            <nav>

                                <ul>

                                    <li class = "DiscoverBlockContent">
                                        <a id = "D1">
                                            <i class = "material-icons"> &#xe1b1; </i>
                                        </a>
                                    </li>
                                    <li class = "DiscoverBlockContent">
                                        <a href = "RegisterUser.php" title = "Criar conta gratuitamente">
                                            <i class = "material-icons"> &#xe7fd; </i>
                                        </a>
                                    </li>
                                    <li class = "DiscoverBlockContent">
                                        <a id = "D2">
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
                                        <a id = "D3">
                                            <i class = "material-icons"> admin_panel_settings </i>
                                        </a>
                                    </li>
                                    <li class = "DiscoverBlockContent">
                                        <a id = "D4">
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

        <div class = "BottomMessage">

            <div class = "MessageContent">

                <div id = "TopContent">

                    <h1> Ao utilizar a nossa plataforma você concorda em utilizar cookies para personalizar o conteúdo da página. <a href = "Sobre.php/#Cookies"> Saiba mais </a></h1>

                </div>

                <div id = "BottomContent">

                    <button class = "ExitMessageBottom CookiesON"> Aceitar Cookies </button>

                </div>

            </div>

        </div>

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
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultricies orci sit amet quam laoreet, eu efficitur lectus eleifend.
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
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultricies orci sit amet quam laoreet, eu efficitur lectus eleifend.
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
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultricies orci sit amet quam laoreet, eu efficitur lectus eleifend.
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
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultricies orci sit amet quam laoreet, eu efficitur lectus eleifend.
                    </p>
                </li>

            </ul>

        </div>

        <?php include "include/Script.php"; ?>

    </body>
    
</html>