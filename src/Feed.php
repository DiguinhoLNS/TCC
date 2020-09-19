<?php session_start(); ?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Feed X </title>
		
		<?php include "include/Head.php"; ?>

	</head>

	<body id = "FeedPage" class = "UNT LightMode">

		<?php

            include "php/Pag.php";
            V_User();
            C_Login();

            include "include/Load.html";

        ?>

		<header id = "HeaderFeed">

			<?php include "include/Header.php"; ?>

		</header>

		<main id = "MainFeed">

			<div class = "MainContent">

				<section id = "SectionFeedHeader">

					<h1> Items Perdidos </h1>

				</section>

				<section id = "SectionFeedFilters">

					<h1> Filtros </h1>

					<nav>

						<ul>
							
							<li class = "FilterActive" title = "Todos"> Todos </li>
							<li class = "FilterDesactive" title = "Nome"> Nome </li>
							<li class = "FilterDesactive" title = "Data"> Data </li>
							<li class = "FilterDesactive" title = "Categorias"> Categorias </li>
							
						</ul>

					</nav>

				</section>

				<section id = "SectionFeedItems">

					<nav>

						<ul id = "FeedBoxContent">

							<li class = "NoFor"> NOME DA EMPRESA não possui nenhum item! </li>

							<li class = "BoxSpace">

								<div class = "Box">
									<a href = "#">
										<div class = "Boximg"></div>
										<div class = "BoxInfo">
											<h1 class = "BoxTitulo"> Nome do Item Perdido </h1>
											<h1 class = "BoxData"> 20/07/2020 </h1>
										</div>
									</a>
								</div>

							</li>
							
						</ul>

					</nav>

				</section>

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