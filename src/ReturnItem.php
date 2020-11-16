<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	require_once 'sql/ConexaoBD.php';
	require_once "sql/Funcoes.php";

	$conn = new ConexaoBD();
    $func = new Funcoes();
    
?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Devolver Item </title>
		
		<?php include "include/Head.php"; ?>

	</head>

	<body id = "ReturnItemPage" class = "UNT LightMode CompanyLayout">

		<?php

			include "php/Pag.php";
			
			StopUserAccess();
			V_User();
			CookieStatus();
            C_Login();

            include "include/Load.php";

        ?>

		<header id = "HeaderConfigFeed">

			<?php include "include/Header.php"; ?>

        </header>

        <main id = "MainReturnItem">

			<div class = "MainContent"></div>

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