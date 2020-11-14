<?php session_start(); ?>

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

                <section id = "SectionAboutCompaniesHeader">

                    <h1> Empresas APE </h1>
                   
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