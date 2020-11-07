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
		$DadosUserEmpresa = $func->PegarDadosUserEmpresaPeloIdEmpresa($id_empresa);
		$DadosItem = $func->PegarDadosItemPeloIdEmpresa($id_empresa);

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
													<h4> Status </h4>
												</li>
												<li>
													<h5> Opções </h5>
												</li>
											</ul>

										</li>

									</ul>

									<ul id = "UserGroupMain">

										<li class = "GroupContent">
											
											<ul class = "GroupUL">


											<?php 

											$i=0;
											$i2=1;

											do{
											
												echo '
												<li>
													<h1> '.($i2).'  </h1>
												</li>
												<li>
													<h2> '.utf8_encode($DadosUserEmpresa["Usuarios"][$i]["Nome_user"]).' </h2>
												</li>
												<li>
													<h3> '.$DadosUserEmpresa["Usuarios"][$i]["Nivel_acesso"].' </h3>
												</li>
												<li>
													<h4> Status </h4>
												</li>
												<li>
													<ul class = "FeedConfigUserOptions">
														<li id = "PromoteUserAccess" title = "Promover Usuário">
															<i class = "material-icons"> &#xe5c7; </i>
														</li>
														<li id = "DemoteUserAccess" title = "Rebaixar Usuário" >
															<i class = "material-icons"> &#xe5c5; </i>
														</li>
														<li id = "DenyUserAccess" title = "Banir Usuário">
															<i class = "material-icons"> &#xe14b; </i>
														</li>
														<li id = "RemoveUserAccess" title = "Remover Usuário">
															<i class = "material-icons"> &#xe15b; </i>
														</li>
													</ul>
												</li>';

												$i++;
												$i2++;


											}while($i < $DadosUserEmpresa["Quantidade"]);

											?>

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

									<?php
										$i=0;
										do{
											if($DadosItem["Objeto"][$i]["Categoria"] == "Acessorio"){
												$DadosItem["Objeto"][$i]["Categoria"] = "Acessório";
											}else if($DadosItem["Objeto"][$i]["Categoria" == "Eletronico"]){
												$DadosItem["Objeto"][$i]["Categoria"] = "Eletrônico";
											}
											$DataSeparada = $func->SepararData($DadosItem["Objeto"][$i]["Data_cadastro"]);

											echo'
											<li>
												<div class = "ItemBox">
												
													<div class = "ItemImg">
														<img src = "imagesBD/'.$DadosItem["Objeto"][$i]["Nome_foto"].'"/>
													</div>
													<div class = "ItemInfo">
														<h1> '.$DadosItem["Objeto"][$i]["Nome_obj"]. ' </h1>
													</div>
													<div class = "ItemControl">
														<a href = "Item.php?q='.base64_encode($DadosItem["Objeto"][$i]["id_obj"]) .'" title = "Visualizar Item">
															<i class = "material-icons"> &#xe8f4; </i>
														</a>
														<a href = "EditItem.php?q='.base64_encode($DadosItem["Objeto"][$i]["id_obj"]) .'" title = "Editar Item">
															<i class = "material-icons"> &#xe150; </i>
														</a>
														<a href = "" title = "Apagar Item">
															<i class = "material-icons"> &#xe872; </i>
														</a>
													</div>

												</div>

											</li>';

										$i++;
										}while($i<$DadosItem["Quantidade"]);

									?>

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

		<script type="text/javascript"> var id_user_empresa = "<?php echo $DadosUserEmpresa["Usuarios"][0]["id_user_empresa"]?>"; </script>
		<?php include "include/Script.php"; ?>

    </body>

</html>