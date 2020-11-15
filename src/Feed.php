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

		<title> Feed <?php echo $DadosEmpresa[0]['Nome'];?></title>
		
		<?php include "include/Head.php"; ?>

	</head>

	<body id = "FeedPage" class = "UNT LightMode ADMView CompanyLayout">

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

				<section id = "SectionFeedNav" class = "SectionPlatformPanel">

					<nav id = "NavFeedConfig" class = "NavBarControl">

                        <ul>

                            <li id = "FFO1" class = "NavListOption active" title = "Todos os Itens">
                                <i class = "material-icons"> inbox  </i>
                                <span> Todos </span>
							</li>
							<li id = "FFO2" class = "NavListOption" title = "Itens em Categorias">
                                <i class = "material-icons"> all_inbox </i>
                                <span> Categorias </span>
							</li>
							<li id = "FFO3" class = "NavListOption" title = "Pesquisar Itens">
                                <i class = "material-icons"> &#xe8b6; </i>
                                <span> Pesquisa </span>
                            </li>
												
                        </ul>

					</nav>

					<nav id = "FeedFrameset" class = "NavFrameset">

						<div id = "FF1" class = "NavFrame">

							<div class = "NavFrameContent">

								<div class = "FrameMain FrameSection">

									<div class = "SubFramesetContent">

										<nav class = "SubNavBarControl">

											<ul>

												<li id = "FilterAll1" class = "SubNavOption AllSubNavOption active" title = "A-Z"> A-Z </li>
												<li id = "FilterAll2" class = "SubNavOption AllSubNavOption" title = "Z-A"> Z-A </li>
												<li id = "FilterAll3" class = "SubNavOption AllSubNavOption" title = "Recentes"> Recentes </li>
												<li id = "FilterAll4" class = "SubNavOption AllSubNavOption" title = "Antigos"> Antigos </li>

											</ul>

										</nav>

										<nav class = "SubNavFrameset">

											<div id = "AllSF" class = "UserSubNavFrame SubNavFrame">

												<div class = "FrameHeader FrameSection">

													<h1> Todos </h1>

												</div>

												<div class = "FrameMain FrameSection">

													<ul class = "FeedAll FeedBoxGroup">

														

													</ul>

												</div>

											</div>

										</nav>

									</div>

								</div>

							</div>

						</div>

						<div id = "FF2" class = "NavFrame">

							<div class = "NavFrameContent">

								<div class = "FrameMain FrameSection">

									<div class = "SubFramesetContent">

										<nav class = "SubNavBarControl">

											<ul>

												<li id = "FilterCategory1" class = "SubNavOption CategorySubNavOption active" title = "A-Z"> A-Z </li>
												<li id = "FilterCategory2" class = "SubNavOption CategorySubNavOption" title = "Z-A"> Z-A </li>
												<li id = "FilterCategory3" class = "SubNavOption CategorySubNavOption" title = "Recentes"> Recentes </li>
												<li id = "FilterCategory4" class = "SubNavOption CategorySubNavOption" title = "Antigos"> Antigos </li>

											</ul>

										</nav>

										<nav class = "SubNavFrameset">

											<div id = "CategorySF" class = "UserSubNavFrame SubNavFrame">

												<div class = "FrameHeader FrameSection">

													<h1> Categorias </h1>

												</div>

												<div class = "FrameMain FrameSection">

													<div class = "FeedCategoryContent">

														<h2> Acessórios </h2>

														<ul class = "FeedCategory FeedBoxGroup"></ul>

													</div>

													<div class = "FeedCategoryContent">

														<h2> Documentos </h2>

														<ul class = "FeedCategory FeedBoxGroup"></ul>

													</div>

													<div class = "FeedCategoryContent">

														<h2> Eletrônicos</h2>

														<ul class = "FeedCategory FeedBoxGroup"></ul>

													</div>

													<div class = "FeedCategoryContent">

														<h2> Roupas </h2>

														<ul class = "FeedCategory FeedBoxGroup"></ul>

													</div>

													<div class = "FeedCategoryContent">

														<h2> Outros </h2>

														<ul class = "FeedCategory FeedBoxGroup"></ul>

													</div>

												</div>

												<div class = "FrameMain FrameSection"></div>

											</div>

										</nav>

									</div>

								</div>

							</div>

						</div>

						<div id = "FF3" class = "NavFrame">

							<div class = "NavFrameContent">

								<div class = "FrameHeader FrameSection">

									<div id = "FeedSearchBar">

										<input id = "FeedSearchItens" type = "text" placeholder = "Pesquisar itens" title = "Pesquisar Itens">
										<button id = "btnSearchFeed" title = "Pesquisar">
											<i class = "material-icons"> &#xe8b6; </i>	
										</button>

									</div>

								</div>

								<div class = "FrameMain FrameSection">

									<ul class = "FeedSearch FeedBoxGroup">

										<li class = "ItemBox">

											<a href = "">

												<div class = "ItemImg">
													<img src = "">
												</div>
												<div class = "ItemInfo">
													
													<h1 class = "ItemName"> Nome </h1>
													<h2 class = "ItemData"> 00/00/0000 </h2>
													<h3 class = "ItemCategory"> Categoria </h3>
												</div>

											</a>

										</li>

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