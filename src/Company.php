<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	
	require_once 'sql/ConexaoBD.php';
	require_once "sql/Funcoes.php";

	$conn = new ConexaoBD();
	$func = new Funcoes();

	$_SESSION['TipoVerificação'] = 'Empresa';

	if(isset($_COOKIE["ID"])){

		$id_user = $func->Descriptografar($_COOKIE["ID"]); 
		$id_empresa = $func->Descriptografar($_GET['q']);

		$UsuarioEstaLogado = $func->VerificarSeUsuarioJaFezLoginNestaEmpresa($id_user, $id_empresa);
		if($UsuarioEstaLogado){

		$DadosEmpresa = $func->PegarDadosEmpresaPeloIdEmpresa($id_empresa);
		$DadosUserEmpresa = $func->PegarDadosUserEmpresaPeloIdUserIdEmpresa($id_user, $id_empresa);
		$cnpj = $func->ColocarPontoCNPJ($DadosEmpresa[0]["CNPJ"]);

		}else{
			die("Algo deu errado, tente voltar para a tela de inicio");
		}

	}

?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title><?php echo $DadosEmpresa[0]['Nome'] ;?></title>
		
		<?php include "include/Head.php"; ?>

	</head>

    <body id = "CompanyPage" class = "UNT LightMode CompanyLayout <?php if($DadosUserEmpresa[0]['Nivel_acesso'] == 4){ echo ' ADMView'; }else if($DadosUserEmpresa[0]['Nivel_acesso'] == 2){echo ' UserView';}?>">

		<?php

			include "php/Pag.php";

			StopUserAccess();
			V_User();
			CookieStatus();
			C_Login();

			include "include/Load.php";

		?>
		
		<header id = "HeaderCompany">

			<?php include "include/Header.php"; ?>

		</header>

		<main id = "MainCompany" class = "<?php echo $DadosEmpresa[0]['Cor_layout'];?>">

			<div class = "MainContent">

				<section id = "CompanyHeader">

					<a href = "Company.php?q=<?php echo $func->Criptografar($DadosEmpresa[0]["id_empresa"]);?>" title = "Acessar <?php echo $DadosEmpresa[0]['Nome'];?>">
						<h1><?=$DadosEmpresa[0]['Nome']; ?></h1>
					</a>

				</section>

				<section id = "SectionCompanyConfig" class = "SectionPlatformPanel">

                    <nav id = "NavCompanyConfig" class = "NavBarControl">

                        <ul>

                            <li id = "CFO1" class = "NavListOption active">
                                <i class = "material-icons"> &#xe0af; </i>
                                <span> Empresa </span>
                            </li>
                            <li id = "CFO2" class = "NavListOption">
                                <i class = "material-icons"> &#xe8f0; </i>
                                <span> Opções </span>
                            </li>
							<?php if($DadosUserEmpresa[0]['Nivel_acesso'] == 4){
								echo '
								<li id = "CFO3" class = "NavListOption">
									<i class = "material-icons"> &#xe8b8; </i>
									<span> Configurações </span>
                            	</li>
								';
							}
							?>							
                        </ul>

                    </nav>

					<nav id = "NavCompanyFrameset" class = "NavFrameset">

						<div id = "CF1" class = "NavFrame">

                            <div class = "NavFrameContent">

                                <div class = "FrameHeader FrameSection">

                                    <h1> Empresa </h1>

                                </div>

                                <div class = "FrameMain FrameSection">

									<ul class = "DataCategory">

										<li class = "Category">

											<h1 class = "HeaderCategory"> Perfil </h1>

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> Nome </h1>
													<h2><?php echo $DadosEmpresa[0]['Nome']; ?></h2>

												</div>

											</div>

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> CNPJ </h1>
													<h2> <?php echo $cnpj; ?> </h2>

												</div>

											</div>

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> Endereço </h1>
													<h2><?= $DadosEmpresa[0]['Endereco']; ?></h2>

												</div>

											</div>

										</li>

										<li class = "Category">

											<h1 class = "HeaderCategory"> Contato </h1>

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> Telefone </h1>
													<h2><?php echo $DadosEmpresa[0]['Telefone']; ?></h2>

												</div>

											</div>

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> Email </h1>
													<h2><?php echo $DadosEmpresa[0]['Email']; ?></h2>

												</div>

											</div>
									
										</li>

										<li class = "Category CompanyADM">

											<h1 class = "HeaderCategory"> Segurança </h1>

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> ID APE </h1>
													<h2><?php echo $DadosEmpresa[0]['id_empresa']; ?></h2>

												</div>

											</div>

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> Código de acesso </h1>
													<h2><?php echo $DadosEmpresa[0]['codigo_acesso']; ?></h2>

												</div>

											</div>
									
										</li>

									</ul>
									
								</div>

							</div>

						</div>

						<div id = "CF2" class = "NavFrame">

                            <div class = "NavFrameContent">

                                <div class = "FrameHeader FrameSection">

                                    <h1> Opções </h1>

                                </div>

                                <div class = "FrameMain FrameSection">

									<ul class = "DataCategory">

										<li class = "Category">

											<h1 class = "HeaderCategory"> Feed </h1>

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> Acessar Feed </h1>
													<h2> Vizualizar o feed de itens da empresa </h2>

												</div>

												<div class = "btnContent">

													<button class = "btnOption">
														<a href = "Feed.php?q=<?php echo $func->Criptografar($DadosEmpresa[0]["id_empresa"]);?>"> Acessar Feed </a>
													</button>

												</div>

											</div>

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> Sair </h1>
													<h2> Sair da empresa </h2>

												</div>

												<div class = "btnContent">

													<button class = "btnOption">
														<a href = "sql/ApagarCadastros.php?q=<?php echo $func->Criptografar($id_empresa) . "&v=". $func->Criptografar("LoginNaEmpresa"); ?>"> Sair da Empresa </a>
													</button>

												</div>

											</div>

										</li>	

									</ul>
									
								</div>

							</div>

						</div>

						<div id = "CF3" class = "NavFrame">

                            <div class = "NavFrameContent">

                                <div class = "FrameHeader FrameSection">

                                    <h1> Configurações </h1>

                                </div>

                                <div class = "FrameMain FrameSection">

									<ul class = "DataCategory">

										<li class = "Category">

											<h1 class = "HeaderCategory"> Gerenciar </h1>

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> Gerenciar feed </h1>
													<h2> Gerenciar o feed da sua empresa </h2>

												</div>

												<div class = "btnContent">

													<button class = "btnOption">
														<a href = "ConfigFeed.php?q=<?php echo $func->Criptografar($id_empresa);?>"> Gerenciar Feed </a>
													</button>

												</div>

											</div>

										</li>

										<li class = "Category">

											<h1 class = "HeaderCategory"> Editar </h1>

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> Editar empresa </h1>
													<h2> Editar os dados da sua empresa </h2>

												</div>

												<div class = "btnContent">

													<button class = "btnOption">
														<a href = "EditCompany.php?q=<?php echo $func->Criptografar($id_empresa);?>"> Editar Empresa </a>
													</button>

												</div>

											</div>

										</li>

										<li class = "Category CategoryDanger">

											<h1 class = "HeaderCategory"> Zona de Perigo </h1>	





										<?php

										if($DadosEmpresa[0]['Situacao'] == "Ativada"){

											echo '

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> Desativar empresa </h1>
													<h2> Desativar a empresa e o seu feed da nossa plataforma </h2>

												</div>

												<div class = "btnContent">

													<button class = "btnDanger">
														<a href = "sql/ApagarCadastros.php?q='. $func->Criptografar($id_empresa) . "&v=". $func->Criptografar("EmpresaD") .'"> Desativar Empresa </a>
													</button>

												</div>

											</div>';

										}else if($DadosEmpresa[0]['Situacao'] == "Desativada"){

											echo'

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> Ativar empresa </h1>
													<h2> Ativar a empresa e o seu feed na nossa plataforma </h2>

												</div>

												<div class = "btnContent">

													<button class = "btnDanger">
														<a href = "sql/ApagarCadastros.php?q='. $func->Criptografar($id_empresa) . "&v=". $func->Criptografar("EmpresaA") .'"> Ativar Empresa </a>
													</button>

												</div>

											</div>';

										}

										?>

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