<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	include 'sql/ConexaoBD.php';
	include_once "sql/Funcoes.php";

	//$id_empresa = base64_decode($_GET['q']);
	//$id_item = base64_decode($_GET['i']);

	if(isset($_COOKIE["ID"])){

		$id = base64_decode($_COOKIE["ID"]);

	}
    
?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> NOME DO ITEM </title>
		
		<?php include "include/Head.php"; ?>

	</head>

	<body id = "itemPage" class = "UNT LightMode ADMView">

		<?php

			include "php/Pag.php";
			
			StopUserAccess();
			V_User();
			CookieStatus();
            C_Login();

            include "include/Load.php";

        ?>

		<header id = "HeaderItem">

			<?php include "include/Header.php"; ?>

		</header>

		<main id = "MainItem" class = "ThemeDefault">

			<div class = "MainContent">

				<section id = "SectionItemMain">

					<ul class = "BoxGroup">

						<li class = "Box">

							<div id = "InfoBox1" class = "BoxContent">

								<h1> Nome do Item </h1>

							</div>

						</li>
						<li class = "Box">	

							<div id = "InfoBox2" class = "BoxContent">

								<p class = "ItemDescription">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tempus, massa iaculis sodales finibus, est arcu sagittis quam, nec aliquam.
								</p>

							</div>

						</li>
						<li class = "Box">

							<ul id = "InfoBox3" class = "BoxContent">

								<li>
									<h1> Data </h1>
									<h2> 01/11/2020 </h2>
								</li>
							
								<li>
									<h1> Categoria </h1>
									<h2> Nome da Categoria </h2>
								</li>

								<li>
									<h1> Empresa </h1>
									<h2>
										<a href = ""> Nome da Empresa </a>
									</h2>
								</li>

								<li>
									<h1> Status </h1>
									<h2 class = "Status1"> Perdido </h2>
								</li>

							</ul>

						</li>
						<li class = "Box Boximg">

							<img src = "imagesBD\4632496204ddd2e1b1d414517ef8059d.jpeg"/>

						</li>

					</ul>
					
				</section>

				<section id = "SectionItemPane">

					<ul class = "ItemControlPane">

						<li>

							<h1> Deseja recuperar esse item? </h1>

						</li>
						<li></li>

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