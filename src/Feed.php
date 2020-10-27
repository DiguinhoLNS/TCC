<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	include 'sql/ConexaoBD.php';
	include_once "sql/Funcoes.php";

	$id_empresa = $_GET['q'];

	if(isset($_COOKIE["ID"])){

		$id = base64_decode($_COOKIE["ID"]);

		$DadosEmpresa = PegarDadosEmpresaPeloIdEmpresa($base, $id_empresa);
		$DadosItem = PegarDadosItemPeloIdEmpresa ($base, $id_empresa);

		$Documentos = PegarDocumentos($base, $id_empresa);
		$Acessorios = PegarAcessorios($base, $id_empresa);
		$Roupas = PegarRoupas($base, $id_empresa);
		$Eletronicos = PegarEletronicos($base, $id_empresa);
		$Outros = PegarOutros($base, $id_empresa);	

		setcookie("VerificaErro", "0", time() + (86400 * 30), "/");

	}

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
			CookieStatus();
            C_Login();

            include "include/Load.php";

        ?>

		<header id = "HeaderFeed">

			<?php include "include/Header.php"; ?>

		</header>

		<main id = "MainFeed" class = "<?php echo $DadosEmpresa['Cor_layout'];?>">

			<div class = "MainContent">

				<section id = "SectionCompanyHeader" class = "CompanyHeader">
					
					<h1> Feed <?php echo $DadosEmpresa['Nome'];?></h1>
				
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

								<li id = "btnAllFilter" class = "FilterItem FilterCategory active" title = "Mostrar todos"> Todos </li>
								<li id = "btnCategoryFilter" class = "FilterItem FilterCategory" title = "Mostrar categorias"> Categorias </li>	

							</ul>

						</li>
						<li>

							<ul class = "FeedFilters">

								<li id = "P1" class = "FilterItem FilterParameter active" title = "Ordenar de A-Z"> A - Z </li>
								<li id = "P2" class = "FilterItem FilterParameter" title = "Ordenar de Z-A"> Z - A </li>
								<li id = "P3" class = "FilterItem FilterParameter" title = "Ordenar por mais recentes"> Mais recentes </li>
								<li id = "P4" class = "FilterItem FilterParameter" title = "Ordernar por mais antigos"> Mais antigos  </li>

							</ul>

						</li>

					</ul>

				</section>

				<section id = "SectionFeedMain">

					<nav id = "FeedFrameset">

						<div id = "AllItensFrame" class = "FeedFrame">

							<div class = "FeedFrameContent">

								<h1 class = "TitleHeader"> Todos </h1>

								<div class = "FeedFrameCategory">

									<ul class = "FeedBoxGroup">

									<?php

										if($DadosItem["Quantidade"]==0){

											echo '<li class = "NoFor"> Nenhum item para mostrar </li>';

										}else{
											$i=0;
											do{
												list($DiaSemana, $Data, $Hora) = explode(" ", $DadosItem["Objeto"][$i]["Data_cadastro"]);

												echo '
													<li class = "ItemBox">

														<a href = "#" title = "'.$DadosItem["Objeto"][$i]["Nome_obj"].'">

															<div class = "ItemImg">
																<img src = "imagesBD/'.$DadosItem["Objeto"][$i]["Nome_foto"].'">
															</div>

															<div class = "ItemInfo">
																
																<h1 class = "ItemName"> '.$DadosItem["Objeto"][$i]["Nome_obj"].' </h1>
																<h2 class = "ItemData"> '.$Data.' </h2>
																<h3 class = "ItemCategory"> '.$DadosItem["Objeto"][$i]["Categoria"].' </h3>

															</div>

														</a>

													</li>
												';
											$i++;
											}while($i<($DadosItem["Quantidade"]));
										}
										
									?>

									</ul>

								</div>

							</div>

						</div>
						<div id = "CategoryItensFrame" class = "FeedFrame">

							<div class = "FeedFrameContent">

								<h1 class = "TitleHeader"> Categorias </h1>
								<?php

										if($Eletronicos["Quantidade"]==0){

											echo '
											<div class = "FeedFrameCategory">											

											<ul class = "FeedBoxGroup">';									

										}else{
											$i=0;
											echo '
											<div class = "FeedFrameCategory">

											<h2 class = "HeaderCategory"> Eletrônicos </h2>

											<ul class = "FeedBoxGroup">';
											do{
												list($DiaSemana, $Data, $Hora) = explode(" ", $Eletronicos["Objeto"][$i]["Data_cadastro"]);
												echo '


													<li class = "ItemBox">

														<a href = "#" title = "'.$Eletronicos["Objeto"][$i]["Nome_obj"].'">

															<div class = "ItemImg">
																<img src = "imagesBD/'.$Eletronicos["Objeto"][$i]["Nome_foto"].'">
															</div>

															<div class = "ItemInfo">
																
																<h1 class = "ItemName"> '.$Eletronicos["Objeto"][$i]["Nome_obj"].' </h1>
																<h2 class = "ItemData"> '.$Data.' </h2>
																<h3 class = "ItemCategory"> '.$Eletronicos["Objeto"][$i]["Categoria"].' </h3>

															</div>

														</a>

													</li>
												';
											$i++;
											}while($i<($Eletronicos["Quantidade"]));
										}

									?>

									</ul>

								</div>

								<?php

										if($Roupas["Quantidade"]==0){

											echo '
											<div class = "FeedFrameCategory">									

											<ul class = "FeedBoxGroup">';									

										}else{
											echo'
											<div class = "FeedFrameCategory">

											<h2 class = "HeaderCategory"> Roupas </h2>

											<ul class = "FeedBoxGroup">';

											$i=0;
											do{
												list($DiaSemana, $Data, $Hora) = explode(" ", $Roupas["Objeto"][$i]["Data_cadastro"]);
												echo '

													<li class = "ItemBox">

														<a href = "#" title = "'.$Roupas["Objeto"][$i]["Nome_obj"].'">

															<div class = "ItemImg">
																<img src = "imagesBD/'.$Roupas["Objeto"][$i]["Nome_foto"].'">
															</div>

															<div class = "ItemInfo">
																
																<h1 class = "ItemName"> '.$Roupas["Objeto"][$i]["Nome_obj"].' </h1>
																<h2 class = "ItemData"> '.$Data.' </h2>
																<h3 class = "ItemCategory"> '.$Roupas["Objeto"][$i]["Categoria"].' </h3>

															</div>

														</a>

													</li>
												';
											$i++;
											}while($i<($Roupas["Quantidade"]));
										}

									?>

									</ul>

								</div>



									<?php

										if($Acessorios["Quantidade"]==0){
											echo '
											<div class = "FeedFrameCategory">	
		
											<ul class = "FeedBoxGroup">';

										}else{
											$i=0;
											echo'
											<div class = "FeedFrameCategory">

											<h2 class = "HeaderCategory"> Acessórios </h2>

											<ul class = "FeedBoxGroup">';
											do{

												list($DiaSemana, $Data, $Hora) = explode(" ", $Acessorios["Objeto"][$i]["Data_cadastro"]);
												echo '

													<li class = "ItemBox">

														<a href = "#" title = "'.$Acessorios["Objeto"][$i]["Nome_obj"].'">

															<div class = "ItemImg">
																<img src = "imagesBD/'.$Acessorios["Objeto"][$i]["Nome_foto"].'">
															</div>

															<div class = "ItemInfo">
																
																<h1 class = "ItemName"> '.$Acessorios["Objeto"][$i]["Nome_obj"].' </h1>
																<h2 class = "ItemData"> '.$Data.' </h2>
																<h3 class = "ItemCategory"> '.$Acessorios["Objeto"][$i]["Categoria"].' </h3>

															</div>

														</a>

													</li>
												';
											$i++;
											}while($i<($Acessorios["Quantidade"]));
										}

									?>

									</ul>

								</div>

									<?php

										if($Documentos["Quantidade"]==0){
											echo '
											<div class = "FeedFrameCategory">

											<ul class = "FeedBoxGroup">';

										}else{
											$i=0;
											echo '
											<div class = "FeedFrameCategory">

											<h2 class = "HeaderCategory"> Documentos </h2>

											<ul class = "FeedBoxGroup">';

											do{
												list($DiaSemana, $Data, $Hora) = explode(" ", $Documentos["Objeto"][$i]["Data_cadastro"]);
												echo '

													<li class = "ItemBox">

														<a href = "#" title = "'.$Documentos["Objeto"][$i]["Nome_obj"].'">

															<div class = "ItemImg">
																<img src = "imagesBD/'.$Documentos["Objeto"][$i]["Nome_foto"].'">
															</div>

															<div class = "ItemInfo">
																
																<h1 class = "ItemName"> '.$Documentos["Objeto"][$i]["Nome_obj"].' </h1>
																<h2 class = "ItemData"> '.$Data.' </h2>
																<h3 class = "ItemCategory"> '.$Documentos["Objeto"][$i]["Categoria"].' </h3>

															</div>

														</a>

													</li>
												';
											$i++;
											}while($i<($Documentos["Quantidade"]));
										}

									?>

									</ul>

								</div>

									<?php

										if($Outros["Quantidade"]==0){
											echo'

											<div class = "FeedFrameCategory">
		
											<ul class = "FeedBoxGroup">';

										}else{
											$i=0;
											echo '				
											<div class = "FeedFrameCategory">

											<h2 class = "HeaderCategory"> Outros </h2>
		
											<ul class = "FeedBoxGroup">';

											do{
												list($DiaSemana, $Data, $Hora) = explode(" ", $Outros["Objeto"][$i]["Data_cadastro"]);
												echo '

													<li class = "ItemBox">

														<a href = "#" title = "'.$Outros["Objeto"][$i]["Nome_obj"].'">

															<div class = "ItemImg">
																<img src = "imagesBD/'.$Outros["Objeto"][$i]["Nome_foto"].'">
															</div>

															<div class = "ItemInfo">
																
																<h1 class = "ItemName"> '.$Outros["Objeto"][$i]["Nome_obj"].' </h1>
																<h2 class = "ItemData"> '.$Data.' </h2>
																<h3 class = "ItemCategory"> '.$Outros["Objeto"][$i]["Categoria"].' </h3>

															</div>

														</a>

													</li>
												';
											$i++;
											}while($i<($Outros["Quantidade"]));
										}

									?>

									</ul>

								</div>

							</div>

						</div>

					</nav>

				</section>

			</div>

			<button id = "btnFeedControl" class = "btnControl FeedADM">
				<i class = "material-icons"> &#xe145; </i>
			</button>

			<div id = "FeedControlPane" class = "ControlPane BS">

				<h1> Feed </h1>

				<ul>
					<li>
						<a href = "RegisterItem.php?q=<?php echo $id_empresa;?>">
							<i class = "material-icons"> &#xe145; </i>
							<span> Criar Item </span>
						</a>
					</li>
					<li>
						<a href = "ConfigFeed.php">
							<i class = "material-icons"> &#xe8b8; </i>
							<span> Gerenciar </span>
						</a>
					</li>
				</ul>

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