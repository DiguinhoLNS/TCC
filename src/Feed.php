<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	include 'sql/ConexaoBD.php';
	include_once "sql/Funcoes.php";
	$id_empresa = $_GET['q'];

?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Feed </title>
		
		<?php include "include/Head.php"; ?>

	</head>

	<body id = "FeedPage" class = "UNT LightMode ADMView">

		<?php

			include "php/Pag.php";
			
			StopUserAccess();
            V_User();
            C_Login();

            include "include/Load.php";

        ?>

		<header id = "HeaderFeed">

			<?php include "include/Header.php"; ?>

		</header>

		<main id = "MainFeed" class = "ThemeBlue">

			<div class = "MainContent">

				<section id = "SectionCompanyHeader" class = "CompanyHeader">
					
					<h1> Feed </h1>
				
				</section>

				<section id = "SectionFeedNav">

					<ul id = "FeedNavBar">

						<li>

							<div id = "FeedSearchBar">

								<form>

									<input type = "text" placeholder = "Pesquisar itens" title = "Pesquisar Itens">
									<button id = "SearchFeed" title = "Pesquisar">
										<i class = "material-icons"> &#xe8b6; </i>	
									</button>

								</form>

							</div>

						</li>
						<li>

							<ul class = "FeedFilters">

								<li id = "btnAllFilter" class = "FilterItem FilterCategory active"> Todos </li>
								<li id = "btnCategoryFilter" class = "FilterItem FilterCategory"> Categorias </li>	

							</ul>

						</li>
						<li>

							<ul class = "FeedFilters">

								<li id = "P1" class = "FilterItem FilterParameter active"> A - Z </li>
								<li id = "P2" class = "FilterItem FilterParameter"> Z - A </li>
								<li id = "P3" class = "FilterItem FilterParameter"> Mais recentes </li>
								<li id = "P4" class = "FilterItem FilterParameter"> Mais antigos  </li>

							</ul>

						</li>

					</ul>

				</section>

				<section id = "SectionFeedMain">

					<nav id = "FeedFrameset">

						<div id = "AllItensFrame" class = "FeedFrame">

							<div class = "FeedFrameContent">

								<h1 class = "TitleGroup"> Todos </h1>

								<div class = "FeedFrameCategory">

									<ul class = "FeedBoxGroup">

										<li class = "ItemBox">

											<div class = "ItemImg"></div>

											<div class = "ItemInfo">
												
												<h1> Nome do item </h1>
												<h2> 00/00/2020 </h2>
												<h3> Categoria </h3>

											</div>

										</li>

									</ul>

								</div>

							</div>

						</div>
						<div id = "CategoryItensFrame" class = "FeedFrame">

							<div class = "FeedFrameContent">

								<h1 class = "TitleGroup"> Categorias </h1>

								<div class = "FeedFrameCategory">

									<h2> Eletrônicos </h2>

									<ul class = "FeedBoxGroup">

										<li class = "ItemBox">

											<div class = "ItemImg"></div>

											<div class = "ItemInfo">
												
												<h1> Nome do item </h1>
												<h2> 00/00/2020 </h2>
												<h3> Categoria </h3>

											</div>

										</li>

									</ul>

								</div>

								<div class = "FeedFrameCategory">

									<h2> Roupas </h2>

									<ul class = "FeedBoxGroup">

										<li class = "ItemBox">

											<div class = "ItemImg"></div>

											<div class = "ItemInfo">
												
												<h1> Nome do item </h1>
												<h2> 00/00/2020 </h2>
												<h3> Categoria </h3>

											</div>

										</li>

									</ul>

								</div>

								<div class = "FeedFrameCategory">

									<h2> Acessórios </h2>

									<ul class = "FeedBoxGroup">

										<li class = "ItemBox">

											<div class = "ItemImg"></div>

											<div class = "ItemInfo">
												
												<h1> Nome do item </h1>
												<h2> 00/00/2020 </h2>
												<h3> Categoria </h3>

											</div>

										</li>

									</ul>

								</div>

								<div class = "FeedFrameCategory">

									<h2> Documentos </h2>

									<ul class = "FeedBoxGroup">

										<li class = "ItemBox">

											<div class = "ItemImg"></div>

											<div class = "ItemInfo">
												
												<h1> Nome do item </h1>
												<h2> 00/00/2020 </h2>
												<h3> Categoria </h3>

											</div>

										</li>

									</ul>

								</div>

								<div class = "FeedFrameCategory">

									<h2> Outros </h2>

									<ul class = "FeedBoxGroup">

										<li class = "ItemBox">

											<div class = "ItemImg"></div>

											<div class = "ItemInfo">
												
												<h1> Nome do item </h1>
												<h2> 00/00/2020 </h2>
												<h3> Categoria </h3>

											</div>

										</li>

									</ul>

								</div>

							</div>

						</div>

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