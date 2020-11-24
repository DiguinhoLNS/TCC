<?php session_start(); ?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Notas de Atualização </title>
		
		<?php include "include/Head.php"; ?>

	</head>

    <body id = "ReleaseNotesPage" class = "UNT LightMode">

        <?php 
        
            include "php/Pag.php";
            
            CookieStatus();
            C_Login();

            include "include/Load.php";      

        ?>
        
		<header id = "HeaderReleaseNotes">

            <?php include "include/Header.php"; ?>

        </header>

        <main id = "MainReleaseNotes">

            <div class = "MainContent">

                <section id = "SectionReleaseNotesHeader">

                    <h1> Notas de Versão </h1>

                </section>

                <section id = "SectionReleaseNotesMain">

                    <div class = "ReleaseNotesVersionHeader">

                        <h2> APE </h2>
                        <h3> 1.0.0 </h3>

                    </div>

                    <ul id = "ReleaseNotesGroup">

                        <li id = "NewFeatures" class = "ReleaseNotesBox">

                            <h1> Novos Recursos </h1>

                            <ul class = "ReleaseNotesContent">

                                <li class = "ReleaseNotesText">

                                    <h2> Primeira versão - First Release </h2>

                                    <p>
                                    Primeira versão do nosso projeto Achados e Perdidos Empresarial, APE-Group.
                                    </p> 

                                </li>

                            </ul>

                        </li>

                        <li id = "FixedErrors" class = "ReleaseNotesBox">

                            <h1> Erros Corrigidos </h1>

                            <ul class = "ReleaseNotesContent">

                                <li class = "ReleaseNotesText">

                                    <h2> Primeira versão - First Release </h2>

                                    <p>
                                        Nenhum erro encontrado até esta versão.
                                    </p> 

                                </li>

                            </ul>

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