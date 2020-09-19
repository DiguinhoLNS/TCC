<?php session_start(); ?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Empresa X </title>
		
		<?php include "include/Head.php"; ?>

	</head>

    <body id = "CompanyPage" class = "UNT LightMode">

		<?php

			include "php/Pag.php";
			V_User();
			C_Login();

			include "include/Load.html";

		?>
		
		<header id = "HeaderCompany">

			<?php include "include/Header.php"; ?>

		</header>

		<main id = "MainCompany">

			<div class = "MainContent">

				<section id = "SectionCompanyHeader"></section>

				<section id = "SectionCompanyMain"></section>

			</div>

		</main>

		<?php include "include/Footer.php"; ?>
        
        <?php include "include/SideNavBar.php"; ?>
        <?php include "include/HeaderNotification.php"; ?>
        <?php include "include/HeaderConfig.php"; ?>

		<div id = "DarkEffect"></div>
		
		<?php include "include/Script.php"; ?>

	</body>
    
</html>