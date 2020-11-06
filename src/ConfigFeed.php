<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	require_once 'sql/ConexaoBD.php';
	require_once "sql/Funcoes.php";

	$conn = new ConexaoBD();
	$func = new Funcoes();

	$id_empresa = base64_decode($_GET['q']);
	
	if(isset($_COOKIE["ID"])){

		$id = base64_decode($_COOKIE["ID"]);

		$DadosEmpresa = $func->PegarDadosEmpresaPeloIdEmpresa($id_empresa);

	}
    
?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Configuração do Feed </title>
		
		<?php include "include/Head.php"; ?>

	</head>

	<body id = "ConfigFeedPage" class = "UNT LightMode ADMView CompanyLayout">

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

		<main id = "MainConfigFeed" class = "<?php echo $DadosEmpresa[0]['Cor_layout'];?>">

            <div class = "MainContent">

				<section id = "CompanyHeader">
					
					<h1> Configuração Feed <?= $DadosEmpresa[0]['Nome'];?></h1>
				
				</section>

				<section id = "SectionConfigFeedMain" class = "SectionPlatformPanel">

					<nav id = "NavFeedConfig" class = "NavBarControl">

                        <ul>

                            <li id = "FCFO1" class = "NavListOption active">
                                <i class = "material-icons"> &#xe0af; </i>
                                <span> Empresa </span>
                            </li>
                            <li id = "FCFO2" class = "NavListOption">
                                <i class = "material-icons"> &#xe7fd; </i>
                                <span> Usuários </span>
							</li>
							<li id = "FCFO3" class = "NavListOption">
                                <i class = "material-icons"> category </i>
                                <span> Itens </span>
							</li>
												
                        </ul>

					</nav>
					
					<nav id = "NavCompanyFrameset" class = "NavFrameset">

						<div id = "FCF1" class = "NavFrame">

                            <div class = "NavFrameContent">

                                <div class = "FrameHeader FrameSection">

                                    <h1> Empresa </h1>

								</div>

								<div class = "FrameMain FrameSection">

									<ul class = "DataCategory">

										<li class = "Category">

											<h1 class = "HeaderCategory"> Visualizar </h1>

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> Acessar Feed </h1>
													<h2> Vizualizar o feed de itens da sua empresa </h2>

												</div>

												<div class = "btnContent">

													<button class = "btnOption">
														<a href = "Feed.php?q=<?php echo base64_encode($DadosEmpresa[0]["id_empresa"]);?>"> Acessar Feed </a>
													</button>

												</div>

											</div>

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> Acessar Empresa </h1>
													<h2> Vizualizar a página principal da sua empresa </h2>

												</div>

												<div class = "btnContent">

													<button class = "btnOption">
														<a href = "Company.php?q=<?php echo base64_encode($DadosEmpresa[0]["id_empresa"]);?>"> Acessar Empresa </a>
													</button>

												</div>

											</div>

										</li>

									</ul>

								</div>
								
							</div>

						</div>

						<div id = "FCF2" class = "NavFrame">

                            <div class = "NavFrameContent">

                                <div class = "FrameHeader FrameSection">

                                    <h1> Usuários </h1>

								</div>

								<div class = "FrameMain FrameSection">

									<ul id = "UserGroupHeader">

										<li class = "GroupContent">

											<ul class = "GroupUL">

												<li>
													<h1> ID </h1>
												</li>
												<li>
													<h2> Nome</h2>
												</li>
												<li>
													<h3> Nível </h3>
												</li>
												<li>
													<h4> Opções </h4>
												</li>
											</ul>

										</li>

									</ul>

									<ul id = "UserGroupMain">

										<li class = "GroupContent">
											
											<ul class = "GroupUL">

												<li>
													<h1> 1 </h1>
												</li>
												<li>
													<h2> Rodrigo Lima </h2>
												</li>
												<li>
													<h3> 4 </h3>
												</li>
												<li>
													<ul class = "FeedConfigUserOptions">
														<li title = "Promover Usuário">
															<i class = "material-icons"> &#xe5c7; </i>
														</li>
														<li title = "Rebaixar Usuário">
															<i class = "material-icons"> &#xe5c5; </i>
														</li>
														<li title = "Remover Usuário">
															<i class = "material-icons"> &#xe15b; </i>
														</li>
													</ul>
												</li>

											</ul>

										</li>

									</ul>	

								</div>
								
							</div>

						</div>

						<div id = "FCF3" class = "NavFrame">

                            <div class = "NavFrameContent">

                                <div class = "FrameHeader FrameSection">

                                    <h1> Itens </h1>

								</div>

								<div class = "FrameMain FrameSection">
								
									<ul id = "FeedConfigItensView">

                                        <li>

											<div class = "ItemBox">

												<div class = "ItemImg">
													<img src = ""/>
												</div>
												<div class = "ItemInfo">
													<h1> Nome do Item Perdido </h1>
												</div>
												<div class = "ItemControl">
													<a href = "Item.php?q=">
														<i class = "material-icons"> &#xe8f4; </i>
													</a>
													<a href = "EditItem.php?q=">
														<i class = "material-icons"> &#xe150; </i>
													</a>
													<a href = "">
														<i class = "material-icons"> &#xe872; </i>
													</a>
												</div>

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
		<?php include "include/CookieMessage.php"; ?>

		<div id = "DarkEffect"></div>

		<?php include "include/Script.php"; ?>

    </body>

</html>