<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	require_once 'sql/ConexaoBD.php';
	require_once "sql/Funcoes.php";

	$conn = new ConexaoBD();
	$func = new Funcoes();

	$id_empresa = $func->Descriptografar($_GET['q']);
	
	
	if(isset($_COOKIE["ID"])){

		$id = $func->Descriptografar($_COOKIE["ID"]);

		$DadosEmpresa = $func->PegarDadosEmpresaPeloIdEmpresa($id_empresa);
		$DadosUserEmpresa = $func->PegarDadosUserEmpresaPeloIdEmpresaTodos($id_empresa);
		$DadosItem = $func->PegarDadosItemPeloIdEmpresaTodos($id_empresa);

		$Perdidos = $func->PegarDadosItemPeloIdEmpresaPerdidos($id_empresa);
		$Devolvidos = $func->PegarDadosItemPeloIdEmpresaDevolvidos($id_empresa);

		$Adms = $func->PegarDadosUserEmpresaPeloIdEmpresaAdms($id_empresa);
		$Normais = $func->PegarDadosUserEmpresaPeloIdEmpresaNormais($id_empresa);
		$Banidos = $func->PegarDadosUserEmpresaPeloIdEmpresaBanidos($id_empresa);

	}
    
?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Configuração do Feed </title>
		
		<?php include "include/Head.php"; ?>

	</head>

	<body id = "ConfigFeedPage" class = "UNT LightMode CompanyLayout">

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

				<section id = "SectionConfigFeedHeader">
					
					<h1> Gerenciar Feed <?= $DadosEmpresa[0]['Nome'];?></h1>
				
				</section>

				<section id = "SectionConfigFeedMain" class = "SectionPlatformPanel">

					<nav id = "NavFeedConfig" class = "NavBarControl">

                        <ul>

                            <li id = "FCFO1" class = "NavListOption active">
                                <i class = "material-icons"> &#xe7fd; </i>
                                <span> Usuários </span>
							</li>
							<li id = "FCFO2" class = "NavListOption">
                                <i class = "material-icons"> category </i>
                                <span> Itens </span>
							</li>
							<li id = "FCFO3" class = "NavListOption">
                                <i class = "material-icons"> &#xe0c9; </i>
                                <span> Pedidos </span>
							</li>
							<li id = "FCFO4" class = "NavListOption">
                                <i class = "material-icons"> cached </i>
                                <span> Devoluções </span>
							</li>
							<li id = "FCFO5" class = "NavListOption">
                                <i class = "material-icons"> &#xe916; </i>
                                <span> Agenda </span>
							</li>
							<li id = "FCFO6" class = "NavListOption">
                                <i class = "material-icons"> &#xe0af; </i>
                                <span> Empresa </span>
                            </li>
												
                        </ul>

					</nav>
					
					<nav id = "NavCompanyFrameset" class = "NavFrameset">

						<div id = "FCF1" class = "NavFrame">

                            <div class = "NavFrameContent">

								<div class = "FrameMain FrameSection">

									<div class = "SubFramesetContent">

										<nav class = "SubNavBarControl">

											<ul>

												<li id = "UserSFCFO1" class = "SubNavOption UserSubNavOption active" title = "Todos os usuários"> Todos </li>
												<li id = "UserSFCFO2" class = "SubNavOption UserSubNavOption" title = "Usuários com previlégios"> Administradores </li>
												<li id = "UserSFCFO3" class = "SubNavOption UserSubNavOption" title = "Usuários sem privilégios"> Usuários </li>
												<li id = "UserSFCFO4" class = "SubNavOption UserSubNavOption" title = "Usuários banidos"> Banidos </li>

											</ul>

										</nav>

										<nav class = "SubNavFrameset">

											<div id = "UserSFCF1" class = "UserSubNavFrame SubNavFrame">

												<div class = "FrameHeader FrameSection">

													<h1> Todos (<?=$DadosUserEmpresa["Quantidade"]?>) </h1>

												</div>

												<div class = "FrameMain FrameSection">

													<ul class = "GroupHeader">

														<li class = "GroupContent">

															<ul class = "GroupUL">

																<li>
																	<h1> ID </h1>
																</li>
																<li>
																	<h1> Nome</h1>
																</li>
																<li>
																	<h1> Nível </h1>
																</li>
																<li>
																	<h1> Status </h1>
																</li>
																<li>
																	<h1> Opções </h1>
																</li>
															</ul>

														</li>

													</ul>

													<ul class = "GroupMain">
													<?php 
														$i=0;
														$i2=1;
														if($DadosUserEmpresa["Quantidade"] != 0){
														do{

															if($DadosUserEmpresa["Usuarios"][$i]["Banido"] == "N"){
																$status = "Normal";
															}else{
																$status = "Banido";
															}
														
															echo '

															<li class = "GroupContent">
																
																<ul class = "GroupUL">
																
																	<li>
																		<h1> '.($i2).'  </h1>
																	</li>
																	<li>
																		<h1> '.$DadosUserEmpresa["Usuarios"][$i]["Nome_user"].' </h1>
																	</li>
																	<li>
																		<h1> '.$DadosUserEmpresa["Usuarios"][$i]["Nivel_acesso"].' </h1>
																	</li>
																	<li>
																		<h1> '.$status.' </h1>
																	</li>
																	<li>
																		<ul class = "FeedConfigUserOptions FeedConfigOptions">';

																			if($DadosUserEmpresa["Usuarios"][$i]["Nivel_acesso"] < 3){
																				echo'
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($DadosUserEmpresa["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("A").'" class = "PromoteUserAccess" title = "Promover Usuário">
																					<i class = "material-icons"> &#xe5c7; </i>
																				</a>
																			</li>';}

																			if($DadosUserEmpresa["Usuarios"][$i]["Nivel_acesso"] > 1 && $DadosUserEmpresa["Usuarios"][$i]["Nivel_acesso"] < 4){
																				echo'
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($DadosUserEmpresa["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("B").'" class = "DemoteUserAccess" title = "Rebaixar Usuário">
																					<i class = "material-icons"> &#xe5c5; </i>
																				</a>
																			</li>';}

																			if($DadosUserEmpresa["Usuarios"][$i]["Banido"] == "S" && $DadosUserEmpresa["Usuarios"][$i]["Nivel_acesso"] < 4){
																				echo '
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($DadosUserEmpresa["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("C").'" class = "EnableUserAccess" title = "Desbanir Usuário">
																					<i class = "material-icons"> person_add </i>
																				</a>
																			</li>';}

																			if($DadosUserEmpresa["Usuarios"][$i]["Banido"] == "N" && $DadosUserEmpresa["Usuarios"][$i]["Nivel_acesso"] < 4){
																				echo '
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($DadosUserEmpresa["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("D").'" class = "DenyUserAccess" title = "Banir Usuário">
																					<i class = "material-icons"> person_remove </i>
																				</a>
																			</li>';}

																			if($DadosUserEmpresa["Usuarios"][$i]["Nivel_acesso"] != 4){
																			echo'
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($DadosUserEmpresa["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("E").'" class = "RemoveUserAccess" title = "Remover Usuário">
																					<i class = "material-icons"> delete_forever </i>
																				</a>
																			</li>';}

																			echo'
																		</ul>
																	</li>
																
																</ul>

															</li>';

															$i++;
															$i2++;

														}while($i < $DadosUserEmpresa["Quantidade"]);
													}
													?>

													</ul>

												</div>

											</div>

											<div id = "UserSFCF2" class = "UserSubNavFrame SubNavFrame">

												<div class = "FrameHeader FrameSection">

													<h1> Administradores (<?=$Adms["Quantidade"]?>)</h1>

												</div>

												<div class = "FrameMain FrameSection">

													<ul class = "GroupHeader">

														<li class = "GroupContent">

															<ul class = "GroupUL">

																<li>
																	<h1> ID </h1>
																</li>
																<li>
																	<h1> Nome</h1>
																</li>
																<li>
																	<h1> Nível </h1>
																</li>
																<li>
																	<h1> Status </h1>
																</li>
																<li>
																	<h1> Opções </h1>
																</li>
															</ul>

														</li>

													</ul>	

													<ul class = "GroupMain">
													<?php 
														$i=0;
														$i2=1;
														if($Adms["Quantidade"] != 0){
														do{

															if($Adms["Usuarios"][$i]["Banido"] == "N"){
																$status = "Normal";
															}else{
																$status = "Banido";
															}
														
															echo '

															<li class = "GroupContent">
																
																<ul class = "GroupUL">
																
																	<li>
																		<h1> '.($i2).'  </h1>
																	</li>
																	<li>
																		<h1> '.$Adms["Usuarios"][$i]["Nome_user"].' </h1>
																	</li>
																	<li>
																		<h1> '.$Adms["Usuarios"][$i]["Nivel_acesso"].' </h1>
																	</li>
																	<li>
																		<h1> '.$status.' </h1>
																	</li>
																	<li>
																		<ul class = "FeedConfigUserOptions FeedConfigOptions">';

																			if($Adms["Usuarios"][$i]["Nivel_acesso"] < 3){
																				echo'
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($Adms["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("A").'" class = "PromoteUserAccess" title = "Promover Usuário">
																					<i class = "material-icons"> &#xe5c7; </i>
																				</a>
																			</li>';}

																			if($Adms["Usuarios"][$i]["Nivel_acesso"] > 1 && $Adms["Usuarios"][$i]["Nivel_acesso"] < 4){
																				echo'
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($Adms["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("B").'" class = "DemoteUserAccess" title = "Rebaixar Usuário">
																					<i class = "material-icons"> &#xe5c5; </i>
																				</a>
																			</li>';}

																			if($Adms["Usuarios"][$i]["Banido"] == "S" && $Adms["Usuarios"][$i]["Nivel_acesso"] < 4){
																				echo '
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($Adms["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("C").'" class = "EnableUserAccess" title = "Desbanir Usuário">
																					<i class = "material-icons"> person_add </i>
																				</a>
																			</li>';}

																			if($Adms["Usuarios"][$i]["Banido"] == "N" && $Adms["Usuarios"][$i]["Nivel_acesso"] < 4){
																				echo '
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($Adms["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("D").'" class = "DenyUserAccess" title = "Banir Usuário">
																					<i class = "material-icons"> person_remove </i>
																				</a>
																			</li>';}

																			if($Adms["Usuarios"][$i]["Nivel_acesso"] != 4){
																			echo'
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($Adms["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("E").'" class = "RemoveUserAccess" title = "Remover Usuário">
																					<i class = "material-icons"> delete_forever </i>
																				</a>
																			</li>';}

																			echo'
																		</ul>
																	</li>
																
																</ul>

															</li>';

															$i++;
															$i2++;

														}while($i < $Adms["Quantidade"]);
													}
													?>
													</ul>

													
												</div>

											</div>

											<div id = "UserSFCF3" class = "UserSubNavFrame SubNavFrame">

												<div class = "FrameHeader FrameSection">

													<h1> Usuários (<?= $Normais["Quantidade"]?>)</h1>

												</div>

												<div class = "FrameMain FrameSection">

													<ul class = "GroupHeader">


														<li class = "GroupContent">

															<ul class = "GroupUL">

																<li>
																	<h1> ID </h1>
																</li>
																<li>
																	<h1> Nome</h1>
																</li>
																<li>
																	<h1> Nível </h1>
																</li>
																<li>
																	<h1> Status </h1>
																</li>
																<li>
																	<h1> Opções </h1>
																</li>
															</ul>

														</li>

													</ul>

													<ul class = "GroupMain">
													<?php 
														$i=0;
														$i2=1;
														if($Normais["Quantidade"] != 0){
														do{

															if($Normais["Usuarios"][$i]["Banido"] == "N"){
																$status = "Normal";
															}else{
																$status = "Banido";
															}
														
															echo '

															<li class = "GroupContent">
																
																<ul class = "GroupUL">
																
																	<li>
																		<h1> '.($i2).'  </h1>
																	</li>
																	<li>
																		<h1> '.$Normais["Usuarios"][$i]["Nome_user"].' </h1>
																	</li>
																	<li>
																		<h1> '.$Normais["Usuarios"][$i]["Nivel_acesso"].' </h1>
																	</li>
																	<li>
																		<h1> '.$status.' </h1>
																	</li>
																	<li>
																		<ul class = "FeedConfigUserOptions FeedConfigOptions">';

																			if($Normais["Usuarios"][$i]["Nivel_acesso"] < 3){
																				echo'
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($Normais["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("A").'" class = "PromoteUserAccess" title = "Promover Usuário">
																					<i class = "material-icons"> &#xe5c7; </i>
																				</a>
																			</li>';}

																			if($Normais["Usuarios"][$i]["Nivel_acesso"] > 1 && $Normais["Usuarios"][$i]["Nivel_acesso"] < 4){
																				echo'
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($Normais["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("B").'" class = "DemoteUserAccess" title = "Rebaixar Usuário">
																					<i class = "material-icons"> &#xe5c5; </i>
																				</a>
																			</li>';}

																			if($Normais["Usuarios"][$i]["Banido"] == "S" && $Normais["Usuarios"][$i]["Nivel_acesso"] < 4){
																				echo '
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($Normais["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("C").'" class = "EnableUserAccess" title = "Desbanir Usuário">
																					<i class = "material-icons"> person_add </i>
																				</a>
																			</li>';}

																			if($Normais["Usuarios"][$i]["Banido"] == "N" && $Normais["Usuarios"][$i]["Nivel_acesso"] < 4){
																				echo '
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($Normais["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("D").'" class = "DenyUserAccess" title = "Banir Usuário">
																					<i class = "material-icons"> person_remove </i>
																				</a>
																			</li>';}

																			if($Normais["Usuarios"][$i]["Nivel_acesso"] != 4){
																			echo'
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($Normais["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("E").'" class = "RemoveUserAccess" title = "Remover Usuário">
																					<i class = "material-icons"> delete_forever </i>
																				</a>
																			</li>';}

																			echo'
																		</ul>
																	</li>
																
																</ul>

															</li>';

															$i++;
															$i2++;

														}while($i < $Normais["Quantidade"]);
													}

													?>
													</ul>	
													
												</div>

											</div>
											
											<div id = "UserSFCF4" class = "UserSubNavFrame SubNavFrame">

												<div class = "FrameHeader FrameSection">

													<h1> Banidos (<?= $Banidos["Quantidade"]?>)</h1>

												</div>

												<div class = "FrameMain FrameSection">

													<ul class = "GroupHeader">

														<li class = "GroupContent">

															<ul class = "GroupUL">

																<li>
																	<h1> ID </h1>
																</li>
																<li>
																	<h1> Nome</h1>
																</li>
																<li>
																	<h1> Nível </h1>
																</li>
																<li>
																	<h1> Status </h1>
																</li>
																<li>
																	<h1> Opções </h1>
																</li>
															</ul>

														</li>

													</ul>
													
													<ul class = "GroupMain">
													<?php 
														$i=0;
														$i2=1;
														if($Banidos["Quantidade"] != 0){
														do{

															if($Banidos["Usuarios"][$i]["Banido"] == "N"){
																$status = "Normal";
															}else{
																$status = "Banido";
															}
														
															echo '

															<li class = "GroupContent">
																
																<ul class = "GroupUL">
																
																	<li>
																		<h1> '.($i2).'  </h1>
																	</li>
																	<li>
																		<h1> '.$Banidos["Usuarios"][$i]["Nome_user"].' </h1>
																	</li>
																	<li>
																		<h1> '.$Banidos["Usuarios"][$i]["Nivel_acesso"].' </h1>
																	</li>
																	<li>
																		<h1> '.$status.' </h1>
																	</li>
																	<li>
																		<ul class = "FeedConfigUserOptions FeedConfigOptions">';

																			if($Banidos["Usuarios"][$i]["Nivel_acesso"] < 3){
																				echo'
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($Banidos["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("A").'" class = "PromoteUserAccess" title = "Promover Usuário">
																					<i class = "material-icons"> &#xe5c7; </i>
																				</a>
																			</li>';}

																			if($Banidos["Usuarios"][$i]["Nivel_acesso"] > 1 && $Banidos["Usuarios"][$i]["Nivel_acesso"] < 4){
																				echo'
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($Banidos["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("B").'" class = "DemoteUserAccess" title = "Rebaixar Usuário">
																					<i class = "material-icons"> &#xe5c5; </i>
																				</a>
																			</li>';}

																			if($Banidos["Usuarios"][$i]["Banido"] == "S" && $Banidos["Usuarios"][$i]["Nivel_acesso"] < 4){
																				echo '
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($Banidos["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("C").'" class = "EnableUserAccess" title = "Desbanir Usuário">
																					<i class = "material-icons"> person_add </i>
																				</a>
																			</li>';}

																			if($Banidos["Usuarios"][$i]["Banido"] == "N" && $Banidos["Usuarios"][$i]["Nivel_acesso"] < 4){
																				echo '
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($Banidos["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("D").'" class = "DenyUserAccess" title = "Banir Usuário">
																					<i class = "material-icons"> person_remove </i>
																				</a>
																			</li>';}

																			if($Banidos["Usuarios"][$i]["Nivel_acesso"] != 4){
																			echo'
																			<li>
																				<a href = "sql/ConfigUserEmpresa.php?q='.$func->Criptografar($Banidos["Usuarios"][$i]["id_user_empresa"]).'&v='.$func->Criptografar("E").'" class = "RemoveUserAccess" title = "Remover Usuário">
																					<i class = "material-icons"> delete_forever </i>
																				</a>
																			</li>';}

																			echo'
																		</ul>
																	</li>
																
																</ul>

															</li>';

															$i++;
															$i2++;

														}while($i < $Banidos["Quantidade"]);
													}

													?>
													</ul>
													
												</div>

											</div>

										</nav>

									</div>	

								</div>
								
							</div>

						</div>

						<div id = "FCF2" class = "NavFrame">

                            <div class = "NavFrameContent">

								<div class = "FrameMain FrameSection">

									<div class = "SubFramesetContent">

										<nav class = "SubNavBarControl">

											<ul>

												<li id = "ItemSFCFO1" class = "SubNavOption ItemSubNavOption active" title = "Todos os itens"> Todos </li>
												<li id = "ItemSFCFO2" class = "SubNavOption ItemSubNavOption" title = "Itens perdidos"> Perdidos </li>
												<li id = "ItemSFCFO3" class = "SubNavOption ItemSubNavOption" title = "Itens devolvidos"> Devolvidos </li>

											</ul>

										</nav>

										<nav class = "SubNavFrameset">

											<div id = "ItemSFCF1" class = "ItemSubNavFrame SubNavFrame">

												<div class = "FrameHeader FrameSection">

													<h1> Todos (<?=$DadosItem["Quantidade"]?>)</h1>

												</div>

												<div class = "FrameMain FrameSection">

													<ul id = "FeedConfigItensView">
													<?php
														$i=0;
														if($DadosItem["Quantidade"] > 0){
															
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
																			<a href = "Item.php?q='.$func->Criptografar($DadosItem["Objeto"][$i]["id_obj"]) .'" title = "Visualizar Item">
																				<i class = "material-icons"> &#xe8f4; </i>
																			</a>
																			<a href = "EditItem.php?q='.$func->Criptografar($DadosItem["Objeto"][$i]["id_obj"]) .'" title = "Editar Item">
																				<i class = "material-icons"> &#xe150; </i>
																			</a>
																			<a href = "sql/ApagarCadastros.php?q='.$func->Criptografar($DadosItem["Objeto"][$i]["id_obj"]).'&v='.$func->Criptografar('Item').'" title = "Apagar Item">
																				<i class = "material-icons"> &#xe872; </i>
																			</a>
																		</div>

																	</div>

																</li>';

															$i++;
															}while($i<$DadosItem["Quantidade"]);
														}

													?>
													</ul>

												</div>
												
											</div>

											<div id = "ItemSFCF2" class = "ItemSubNavFrame SubNavFrame">

												<div class = "FrameHeader FrameSection">

													<h1> Perdidos (<?=$Perdidos["Quantidade"]?>)</h1>

												</div>

												<div class = "FrameMain FrameSection">

													<ul id = "FeedConfigItensView">
														<?php
															$i=0;
															if($Perdidos["Quantidade"] > 0){
																do{
																	if($Perdidos["Objeto"][$i]["Categoria"] == "Acessorio"){
																		$Perdidos["Objeto"][$i]["Categoria"] = "Acessório";
																	}else if($Perdidos["Objeto"][$i]["Categoria" == "Eletronico"]){
																		$Perdidos["Objeto"][$i]["Categoria"] = "Eletrônico";
																	}
																	$DataSeparada = $func->SepararData($Perdidos["Objeto"][$i]["Data_cadastro"]);

																	echo'
																	<li>
																		<div class = "ItemBox">
																		
																			<div class = "ItemImg">
																				<img src = "imagesBD/'.$Perdidos["Objeto"][$i]["Nome_foto"].'"/>
																			</div>
																			<div class = "ItemInfo">
																				<h1> '.$Perdidos["Objeto"][$i]["Nome_obj"]. ' </h1>
																			</div>
																			<div class = "ItemControl">
																				<a href = "Item.php?q='.$func->Criptografar($Perdidos["Objeto"][$i]["id_obj"]) .'" title = "Visualizar Item">
																					<i class = "material-icons"> &#xe8f4; </i>
																				</a>
																				<a href = "EditItem.php?q='.$func->Criptografar($Perdidos["Objeto"][$i]["id_obj"]) .'" title = "Editar Item">
																					<i class = "material-icons"> &#xe150; </i>
																				</a>
																				<a href = "sql/ApagarCadastros.php?q='.$func->Criptografar($Perdidos["Objeto"][$i]["id_obj"]).'&v='.$func->Criptografar('Item').'" title = "Apagar Item">
																					<i class = "material-icons"> &#xe872; </i>
																				</a>
																			</div>

																		</div>

																	</li>';

																$i++;
																}while($i<$Perdidos["Quantidade"]);
															}
														?>
													</ul>

												</div>
												
											</div>

											<div id = "ItemSFCF3" class = "ItemSubNavFrame SubNavFrame">

												<div class = "FrameHeader FrameSection">

													<h1> Devolvidos (<?=$Devolvidos["Quantidade"]?>)</h1>

												</div>

												<div class = "FrameMain FrameSection">

													<ul id = "FeedConfigItensView">
													<?php
														$i=0;
														if($Devolvidos["Quantidade"] > 0){

															do{
																if($Devolvidos["Objeto"][$i]["Categoria"] == "Acessorio"){
																	$Devolvidos["Objeto"][$i]["Categoria"] = "Acessório";
																}else if($Devolvidos["Objeto"][$i]["Categoria" == "Eletronico"]){
																	$Devolvidos["Objeto"][$i]["Categoria"] = "Eletrônico";
																}
																$DataSeparada = $func->SepararData($Devolvidos["Objeto"][$i]["Data_cadastro"]);
	
																echo'
																<li>
																	<div class = "ItemBox">
																	
																		<div class = "ItemImg">
																			<img src = "imagesBD/'.$Devolvidos["Objeto"][$i]["Nome_foto"].'"/>
																		</div>
																		<div class = "ItemInfo">
																			<h1> '.$Devolvidos["Objeto"][$i]["Nome_obj"]. ' </h1>
																		</div>
																		<div class = "ItemControl">
																			<a href = "Item.php?q='.$func->Criptografar($Devolvidos["Objeto"][$i]["id_obj"]) .'" title = "Visualizar Item">
																				<i class = "material-icons"> &#xe8f4; </i>
																			</a>
																			<a href = "EditItem.php?q='.$func->Criptografar($Devolvidos["Objeto"][$i]["id_obj"]) .'" title = "Editar Item">
																				<i class = "material-icons"> &#xe150; </i>
																			</a>
																			<a href = "sql/ApagarCadastros.php?q='.$func->Criptografar($Devolvidos["Objeto"][$i]["id_obj"]).'&v='.$func->Criptografar('Item').'" title = "Apagar Item">
																				<i class = "material-icons"> &#xe872; </i>
																			</a>
																		</div>
	
																	</div>
	
																</li>';
	
															$i++;
															}while($i<$Devolvidos["Quantidade"]);

														}
													?>
													</ul>

												</div>
												
											</div>

										</nav>

									</div>
								
								</div>
								
							</div>

						</div>

						<div id = "FCF3" class = "NavFrame">

                            <div class = "NavFrameContent">

								<div class = "FrameMain FrameSection">

									<div class = "SubFramesetContent">

										<nav class = "SubNavBarControl">

											<ul>

												<li id = "RequestSFCFO1" class = "SubNavOption UserSubNavOption active" title = "Todos os usuários"> Pendentes </li>
												<li id = "RequestSFCFO2" class = "SubNavOption UserSubNavOption" title = "Usuários com previlégios"> Aceitos </li>
												<li id = "RequestSFCFO3" class = "SubNavOption UserSubNavOption" title = "Usuários sem privilégios"> Recusados </li>

											</ul>

										</nav>

										<nav class = "SubNavFrameset">

											<div id = "RequestSFCF1" class = "RequestSubNavFrame SubNavFrame">

												<div class = "FrameHeader FrameSection">

													<h1> Pendentes (x) </h1>

												</div>

												<div class = "FrameMain FrameSection">

													<ul class = "GroupHeader">

														<li class = "GroupContent">

															<ul class = "GroupUL">

																<li>
																	<h1> ID </h1>
																</li>
																<li>
																	<h1> Data </h1>
																</li>
																<li>
																	<h1> Horário </h1>
																</li>
																<li>
																	<h1> Item </h1>
																</li>
																<li>
																	<h1> Nome </h1>
																</li>
																<li>
																	<h1> Status </h1>
																</li>
																<li>
																	<h1> Opções </h1>
																</li>
															</ul>

														</li>

													</ul>

													<ul class = "GroupMain">

														<li class = "GroupContent">

															<ul class = "GroupUL">

																<li>
																	<h1> 1 </h1>
																</li>
																<li>
																	<h1> 18/11/2020 </h1>
																</li>
																<li>
																	<h1> 13:30 </h1>
																</li>
																<li>
																	<h1> 12 </h1>
																</li>
																<li>
																	<h1> Nome do Sujeito </h1>
																</li>
																<li class = "Status1">
																	<h1> Pendente </h1>
																</li>
																<li>
																	<ul class = "FeedConfigDevolutionOptions FeedConfigOptions">
																		<li>
																			<a href = "OrderDetails.php" target = "_blank" title = "Ver Mais Detalhes">		
																				<i class = "material-icons"> &#xe8f4; </i>
																			</a>
																		</li>
																		<li>
																			<a href = "" class = "ConfirmOrder" title = "Confirmar Pedido">
																				<i class = "material-icons"> &#xe5ca; </i>
																			</a>
																		</li>
																		<li>
																			<a href = "" class = "DenyOrder" title = "Negar Pedido">
																				<i class = "material-icons"> &#xe5cd; </i>
																			</a>
																		</li>
																	</ul>
																</li>

															</ul>

														</li>

													</ul>

												</div>

											</div>

											<div id = "RequestSFCF2" class = "RequestSubNavFrame SubNavFrame">

												<div class = "FrameHeader FrameSection">

													<h1> Aceitos (x) </h1>

												</div>

												<div class = "FrameMain FrameSection">

													<ul class = "GroupHeader">

														<li class = "GroupContent">

															<ul class = "GroupUL">

																<li>
																	<h1> ID </h1>
																</li>	
																<li>
																	<h1> Data </h1>
																</li>
																<li>
																	<h1> Horário </h1>
																</li>
																<li>
																	<h1> Item </h1>
																</li>
																<li>
																	<h1> Nome </h1>
																</li>
																<li>
																	<h1> Status </h1>
																</li>
															</ul>

														</li>

													</ul>

													<ul class = "GroupMain">

														<li class = "GroupContent">

															<ul class = "GroupUL">

																<li>
																	<h1> 1 </h1>
																</li>
																<li>
																	<h1> 18/11/2020 </h1>
																</li>
																<li>
																	<h1> 13:30 </h1>
																</li>
																<li>
																	<h1> 12 </h1>
																</li>
																<li>
																	<h1> Nome do Sujeito </h1>
																</li>
																<li class = "Status2">
																	<h1> Aceito </h1>
																</li>

															</ul>

														</li>

													</ul>

												</div>

											</div>

											<div id = "RequestSFCF3" class = "RequestSubNavFrame SubNavFrame">

												<div class = "FrameHeader FrameSection">

													<h1> Recusados (x) </h1>

												</div>

												<div class = "FrameMain FrameSection">

													<ul class = "GroupHeader">

														<li class = "GroupContent">

															<ul class = "GroupUL">

																<li>
																	<h1> ID </h1>
																</li>
																<li>
																	<h1> Data </h1>
																</li>
																<li>
																	<h1> Horário </h1>
																</li>
																<li>
																	<h1> Item </h1>
																</li>
																<li>
																	<h1> Nome </h1>
																</li>
																<li>
																	<h1> Status </h1>
																</li>
															</ul>

														</li>

													</ul>

													<ul class = "GroupMain">

														<li class = "GroupContent">

															<ul class = "GroupUL">

																<li>
																	<h1> 1 </h1>
																</li>
																<li>
																	<h1> 18/11/2020 </h1>
																</li>
																<li>
																	<h1> 13:30 </h1>
																</li>
																<li>
																	<h1> 12 </h1>
																</li>
																<li>
																	<h1> Nome do Sujeito </h1>
																</li>
																<li class = "Status3">
																	<h1> Negado </h1>
																</li>

															</ul>

														</li>

													</ul>

												</div>
											
											</div>

										</nav>

									</div>

								</div>

							</div>
							
						</div>

						<div id = "FCF4" class = "NavFrame">

                            <div class = "NavFrameContent">

                                <div class = "SubFramesetContent">

									<nav class = "SubNavBarControl">

										<ul>

											<li id = "DevolutionSFCFO1" class = "SubNavOption DevolutionSubNavOption active" title = "Pedidos Pendentes"> Pendentes </li>
											<li id = "DevolutionSFCFO2" class = "SubNavOption DevolutionSubNavOption" title = "Pedidos Devolviods"> Devolvidos </li>

										</ul>

									</nav>

									<nav class = "SubNavFrameset">

										<div id = "DevolutionSFCF1" class = "DevolutionSubNavFrame SubNavFrame">

											<div class = "FrameHeader FrameSection">

												<h1> Pendentes (x) </h1>

											</div>

											<div class = "FrameMain FrameSection">

												<ul class = "GroupHeader">

													<li class = "GroupContent">

														<ul class = "GroupUL">

															<li>
																<h1> ID </h1>
															</li>
															<li>
																<h1> Data </h1>
															</li>
															<li>
																<h1> Horário </h1>
															</li>
															<li>
																<h1> Item </h1>
															</li>
															<li>
																<h1> Nome </h1>
															</li>
															<li>
																<h1> Status </h1>
															</li>
															<li>
																<h1> Opções </h1>
															</li>
														</ul>

													</li>

												</ul>

												<ul class = "GroupMain">

													<li class = "GroupContent">

														<ul class = "GroupUL">

															<li>
																<h1> 1 </h1>
															</li>
															<li>
																<h1> 18/11/2020 </h1>
															</li>
															<li>
																<h1> 13:30 </h1>
															</li>
															<li>
																<h1> 12 </h1>
															</li>
															<li>
																<h1> Nome do Sujeito </h1>
															</li>
															<li class = "Status1">
																<h1> Pendente </h1>
															</li>
															<li>
																<ul class = "FeedConfigDevolutionOptions FeedConfigOptions">			
																	<li>
																		<a href = "OrderDetails.php" target = "_blank" title = "Ver Pedido">		
																			<i class = "material-icons"> &#xe8f4; </i>
																		</a>
																	</li>
																	<li>
																		<a href = "" class = "ConfirmDevolution" title = "Pedido Devolvido">
																			<i class = "material-icons"> &#xe5ca; </i>
																		</a>
																	</li>
																	<li>
																		<a href = "" class = "DenyDevolution" title = "Pedido Não Devolvido">
																			<i class = "material-icons"> &#xe5cd; </i>
																		</a>
																	</li>
																</ul>
															</li>

														</ul>

													</li>

												</ul>

											</div>

										</div>

										<div id = "DevolutionSFCF2" class = "DevolutionSubNavFrame SubNavFrame">

											<div class = "FrameHeader FrameSection">

												<h1> Devolvidos (x) </h1>

											</div>

											<div class = "FrameMain FrameSection">

												<ul class = "GroupHeader">

													<li class = "GroupContent">

														<ul class = "GroupUL">

															<li>
																<h1> ID </h1>
															</li>
															<li>
																<h1> Data </h1>
															</li>
															<li>
																<h1> Horário </h1>
															</li>
															<li>
																<h1> Item </h1>
															</li>
															<li>
																<h1> Nome </h1>
															</li>
															<li>
																<h1> Status </h1>
															</li>
														</ul>

													</li>

												</ul>

												<ul class = "GroupMain">

													<li class = "GroupContent">

														<ul class = "GroupUL">

															<li>
																<h1> 1 </h1>
															</li>
															<li>
																<h1> 18/11/2020 </h1>
															</li>
															<li>
																<h1> 13:30 </h1>
															</li>
															<li>
																<h1> 12 </h1>
															</li>
															<li>
																<h1> Nome do Sujeito </h1>
															</li>
															<li class = "Status2">
																<h1> Devolvido </h1>
															</li>

														</ul>

													</li>

												</ul>

											</div>
										
										</div>

									</nav>

								</div>

							</div>
							
						</div>

						<div id = "FCF5" class = "NavFrame">

                            <div class = "NavFrameContent">

                                <div class = "FrameHeader FrameSection">

                                    <h1> Agenda </h1>

								</div>

								<div class = "FrameMain FrameSection"></div>

							</div>
							
						</div>

						<div id = "FCF6" class = "NavFrame">

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
														<a href = "Feed.php?q=<?php echo $func->Criptografar($DadosEmpresa[0]["id_empresa"]);?>"> Acessar Feed </a>
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
														<a href = "Company.php?q=<?php echo $func->Criptografar($DadosEmpresa[0]["id_empresa"]);?>"> Acessar Empresa </a>
													</button>

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