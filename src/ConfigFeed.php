<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	include 'sql/ConexaoBD.php';
	include_once "sql/Funcoes.php";

	$id_empresa = base64_decode($_GET['q']);
	
	if(isset($_COOKIE["ID"])){

		$id = base64_decode($_COOKIE["ID"]);

		$DadosEmpresa = PegarDadosEmpresaPeloIdEmpresa($base, $id_empresa);

	}
    
?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Configurações do Feed </title>
		
		<?php include "include/Head.php"; ?>

	</head>

	<body id = "ConfigFeedPage" class = "UNT LightMode ADMView">

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

		<main id = "MainConfigFeed" class = "<?php echo $DadosEmpresa['Cor_layout'];?>">

            <div class = "MainContent">

				<section id = "CompanyHeader">
					
					<h1> Configuração Feed <?php echo $DadosEmpresa['Nome'];?></h1>
				
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