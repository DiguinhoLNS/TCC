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

            <div class = "MainContent"></div>

        </main>

    </body>

</html>