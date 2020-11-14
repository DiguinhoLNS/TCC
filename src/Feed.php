<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	require_once 'sql/ConexaoBD.php';
	require_once "sql/Funcoes.php";

	$conn = new ConexaoBD();
	$func = new Funcoes();

	$id_empresa = $func->Descriptografar($_GET['q']);
	setcookie("ID_Company", $func->Criptografar($id_empresa), time() + (86400 * 30), "/");

	if(isset($_COOKIE["ID"])){

		$id = $func->Descriptografar($_COOKIE["ID"]);

		$DadosEmpresa = $func->PegarDadosEmpresaPeloIdEmpresa($id_empresa);
		$DadosItem = $func->PegarDadosItemPeloIdEmpresaPerdidos($id_empresa);
		$DadosUserEmpresa = $func->PegarDadosUserEmpresaPeloIdUserIdEmpresa($id, $id_empresa);

		$Documentos = $func->PegarDocumentos($id_empresa);
		$Acessorios = $func->PegarAcessorios($id_empresa);
		$Roupas = $func->PegarRoupas($id_empresa);
		$Eletronicos = $func->PegarEletronicos($id_empresa);
		$Outros = $func->PegarOutros($id_empresa);

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

		<main id = "MainFeed" class = "<?php echo $DadosEmpresa[0]['Cor_layout'];?>">

			<div class = "MainContent">

				<section id = "CompanyHeader">

					<a href = "Company.php?q=<?php echo $func->Criptografar($DadosEmpresa[0]["id_empresa"]);?>" title = "Acessar <?php echo $DadosEmpresa[0]['Nome'];?>">
						<h1> Feed <?php echo $DadosEmpresa[0]['Nome']; ?></h1>
					</a>
				
				</section>

				<section id = "SectionFeedNav">

					<ul id = "FeedNavBar">

						<li>

							<div id = "FeedSearchBar">

								<input id = "FeedSearchItens" type = "text" placeholder = "Pesquisar itens" title = "Pesquisar Itens">
								<button id = "btnSearchFeed" title = "Pesquisar">
									<i class = "material-icons"> &#xe8b6; </i>	
								</button>

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

								<li id = "btnFeedAZ" class = "FilterItem FilterParameter active" title = "Ordenar de A-Z"> A - Z </li>
								<li id = "btnFeedZA" class = "FilterItem FilterParameter" title = "Ordenar de Z-A"> Z - A </li>
								<li id = "btnFeedRecente" class = "FilterItem FilterParameter" title = "Ordenar por mais recentes"> Mais recentes </li>
								<li id = "btnFeedAntigo" class = "FilterItem FilterParameter" title = "Ordernar por mais antigos"> Mais antigos  </li>

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

									<ul id = "FeedAll" class = "FeedBoxGroup">

									<?php

										include "include/LoadFeed.php";

										if($DadosItem["Quantidade"]==0){

											echo '<li class = "NoFor"> Nenhum item para mostrar </li>';

										}else{
											$i=0;
											
											do{
												if($DadosItem["Objeto"][$i]["Categoria"] == "Acessorio"){
													$DadosItem["Objeto"][$i]["Categoria"] = "Acessório";
												}else if($DadosItem["Objeto"][$i]["Categoria" == "Eletronico"]){
													$DadosItem["Objeto"][$i]["Categoria"] = "Eletrônico";
												}
												$DataSeparada = $func->SepararData($DadosItem["Objeto"][$i]["Data_cadastro"]);
												echo '
													<li class = "ItemBox AllItemBox">

														<a href = "Item.php?q='.$func->Criptografar($DadosItem["Objeto"][$i]["id_obj"]) .'" title = "'.$DadosItem["Objeto"][$i]["Nome_obj"].'">

															<div class = "ItemImg">
																<img src = "imagesBD/'.$DadosItem["Objeto"][$i]["Nome_foto"].'">
															</div>

															<div class = "ItemInfo">
																
																<h1 class = "ItemName"> '.$DadosItem["Objeto"][$i]["Nome_obj"].' </h1>
																<h2 class = "ItemData"> '.$DataSeparada["dia"] . "/" . $DataSeparada["mes"] . "/" . $DataSeparada["ano"].' </h2>
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
												$DataSeparada = $func->SepararData($Eletronicos["Objeto"][$i]["Data_cadastro"]);
												echo '


													<li class = "ItemBox">

														<a href = "Item.php?q='.$func->Criptografar($Eletronicos["Objeto"][$i]["id_obj"]) .'" title = "'.$Eletronicos["Objeto"][$i]["Nome_obj"].'">

															<div class = "ItemImg">
																<img src = "imagesBD/'.$Eletronicos["Objeto"][$i]["Nome_foto"].'">
															</div>

															<div class = "ItemInfo">
																
																<h1 class = "ItemName"> '.$Eletronicos["Objeto"][$i]["Nome_obj"].' </h1>
																<h2 class = "ItemData"> '.$DataSeparada["dia"] . "/" . $DataSeparada["mes"] . "/" . $DataSeparada["ano"].' </h2>
																<h3 class = "ItemCategory"> Eletrônico </h3>

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
												$DataSeparada = $func->SepararData($Roupas["Objeto"][$i]["Data_cadastro"]);
												echo '

													<li class = "ItemBox">

														<a href = "Item.php?q='.$func->Criptografar($Roupas["Objeto"][$i]["id_obj"]) .'" title = "'.$Roupas["Objeto"][$i]["Nome_obj"].'">

															<div class = "ItemImg">
																<img src = "imagesBD/'.$Roupas["Objeto"][$i]["Nome_foto"].'">
															</div>

															<div class = "ItemInfo">
																
																<h1 class = "ItemName"> '.$Roupas["Objeto"][$i]["Nome_obj"].' </h1>
																<h2 class = "ItemData"> '.$DataSeparada["dia"] . "/" . $DataSeparada["mes"] . "/" . $DataSeparada["ano"].' </h2>
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
												$DataSeparada = $func->SepararData($Acessorios["Objeto"][$i]["Data_cadastro"]);
												echo '

													<li class = "ItemBox">

														<a href = "Item.php?q='.$func->Criptografar($Acessorios["Objeto"][$i]["id_obj"]).'" title = "'.$Acessorios["Objeto"][$i]["Nome_obj"].'">

															<div class = "ItemImg">
																<img src = "imagesBD/'.$Acessorios["Objeto"][$i]["Nome_foto"].'">
															</div>

															<div class = "ItemInfo">
																
																<h1 class = "ItemName"> '.$Acessorios["Objeto"][$i]["Nome_obj"].' </h1>
																<h2 class = "ItemData"> '.$DataSeparada["dia"] . "/" . $DataSeparada["mes"] . "/" . $DataSeparada["ano"].' </h2>
																<h3 class = "ItemCategory"> Acessório </h3>

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
												$DataSeparada = $func->SepararData($Documentos["Objeto"][$i]["Data_cadastro"]);
												echo '

													<li class = "ItemBox">

														<a href = "Item.php?q='.$func->Criptografar($Documentos["Objeto"][$i]["id_obj"]).'" title = "'.$Documentos["Objeto"][$i]["Nome_obj"].'">

															<div class = "ItemImg">
																<img src = "imagesBD/'.$Documentos["Objeto"][$i]["Nome_foto"].'">
															</div>

															<div class = "ItemInfo">
																
																<h1 class = "ItemName"> '.$Documentos["Objeto"][$i]["Nome_obj"].' </h1>
																<h2 class = "ItemData"> '.$DataSeparada["dia"] . "/" . $DataSeparada["mes"] . "/" . $DataSeparada["ano"].' </h2>
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
												$DataSeparada = $func->SepararData($Outros["Objeto"][$i]["Data_cadastro"]);
												echo '

													<li class = "ItemBox">

														<a href = "Item.php?q='.$func->Criptografar($Outros["Objeto"][$i]["id_obj"]).'" title = "'.$Outros["Objeto"][$i]["Nome_obj"].'">

															<div class = "ItemImg">
																<img src = "imagesBD/'.$Outros["Objeto"][$i]["Nome_foto"].'">
															</div>

															<div class = "ItemInfo">
																
																<h1 class = "ItemName"> '.$Outros["Objeto"][$i]["Nome_obj"].' </h1>
																<h2 class = "ItemData"> '.$DataSeparada["dia"] . "/" . $DataSeparada["mes"] . "/" . $DataSeparada["ano"].' </h2>
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

			<?php if($DadosUserEmpresa[0]['Nivel_acesso'] == 4 || $DadosUserEmpresa[0]['Nivel_acesso'] == 3){
				echo'

			<button id = "btnFeedControl" class = "btnControl FeedADM">
				<i class = "material-icons"> &#xe145; </i>
			</button>
			
			
			<div id = "FeedControlPane" class = "ControlPane BS">

				<h1> Feed </h1>

				<ul>
					<li>
						<a href = "RegisterItem.php?q='.$func->Criptografar($id_empresa).'">
							<i class = "material-icons"> &#xe145; </i>
							<span> Criar Item </span>
						</a>
					</li>

					<li>
						<a href = "ConfigFeed.php?q='.$func->Criptografar($id_empresa).'">
							<i class = "material-icons"> &#xe8b8; </i>
							<span> Gerenciar </span>
						</a>
					</li>
				</ul>

			</div>';
			}
			?>


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