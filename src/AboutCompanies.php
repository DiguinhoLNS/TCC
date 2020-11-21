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

?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Empresas </title>
		
		<?php include "include/Head.php"; ?>

	</head>

    <body id = "AboutCompaniesPage" class = "UNT LightMode">

        <?php 
        
            include "php/Pag.php";
            
            CookieStatus();
            C_Login();

            include "include/Load.php";      

        ?>
        
		<header id = "HeaderAboutCompanies">

            <?php include "include/Header.php"; ?>

        </header>

        <main id = "MainAboutCompanies">

            <div class = "MainContent">

                <section id = "SectionAboutCompaniesWelcome" class = "SectionWelcome">

                    <ul>

                        <li>
                            <h1> Empresas APE </h1>
                            <p> Crie uma empresa agora mesmo e comece a gerenciar os itens perdidos em sua empresa </p>
                            <button class = "btn">
                                <a href = "RegisterCompany.php"> Nova Empresa </a>
                            </button>
                        </li>

                        <li></li>

                    </ul>
                   
                </section>

                <section id = "SectionAboutCompaniesYourCompanies">

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

                </section>

                <section id = "SectionAboutCompaniesDiscover">

                    <ul class = "LeftAlign">

                        <li class = "IconAboutCompanies">
                            <span>
                                <i class = "material-icons"> category </i>
                            </span>
                        </li>

                        <li class = "TextAboutCompanies">
                            <p>
                                Cadastre itens no feed de sua empresa para que os usuários possam ver o que a sua empresa possui no achados e perdidos.
                            </p>
                        </li>

                    </ul>

                    <ul class = "RightAlign">
                        
                        <li class = "TextAboutCompanies">
                            <p>
                                Para recuperar o item, o usuário poderá enviar um pedido de agendamento para ir buscá-lo pessoalmente na empresa, você poderá aceitar ou negar esses pedidos.
                            </p>
                        </li>

                        <li class = "IconAboutCompanies">
                            <span>
                                <i class = "material-icons"> admin_panel_settings </i>
                            </span>
                        </li>

                    </ul>

                     <ul class = "LeftAlign">

                        <li class = "IconAboutCompanies">
                            <span>
                                <i class = "material-icons"> vpn_key </i>
                            </span>
                        </li>

                        <li class = "TextAboutCompanies">
                            <p>
                                Para que um usuário acesse o feed de sua empresa, é necessário que ele faça o login nela através do código de acesso que geramos automaticamente assim que você criar uma empresa. É possivel encontrar esse código na página de informações sobre a empresa na parte de "Segurança".
                            </p>
                        </li>

                    </ul>

                    <ul class = "RightAlign">

                        <li class = "TextAboutCompanies">
                            <p>
                                Controle o acesso que os usuários possuem no feed de sua empresa, você possui a opção de banir algum usuário que seja incoveniente, e também adicionar outros administradores para que eles possam cadastrar novos itens perdidos.
                            </p>
                        </li>

                        <li class = "IconAboutCompanies">
                            <span>
                                <i class = "material-icons"> &#xe897; </i>
                            </span>
                        </li>

                    </ul>

                </section>

            </div>

        </main>

        <?php include "include/Footer.php"; ?>
        
        <?php include "include/SideNavBar.php"; ?>
        <?php include "include/HeaderNotification.php"; ?>
        <?php include "include/HeaderConfig.php"; ?>
        <?php include "include/CookieMessage.php"; ?>

        <div id = "DarkEffect"></div>

        <?php include "include/Script.php"; ?>

    </body>

</html>