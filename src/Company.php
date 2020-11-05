<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	
	require_once 'sql/ConexaoBD.php';
	require_once "sql/Funcoes.php";

	$conn = new ConexaoBD();
	$func = new Funcoes();

	function setLogin(){
		$_SESSION['TipoVerificação'] = 'LoginNaEmpresa'; 
	}
	$_SESSION['TipoVerificação'] = 'Empresa';

	if(isset($_COOKIE["ID"])){

		$id_user = base64_decode($_COOKIE["ID"]); 
		$id_empresa = base64_decode($_GET['q']);

		$DadosEmpresa = $func->PegarDadosEmpresaPeloIdEmpresa($id_empresa);
		
		$DadosUserEmpresa = $func->PegarDadosUserEmpresaPeloIdUserIdEmpresa($id_user, $id_empresa);

		$cnpj = $func->ColocarPontoCNPJ($DadosEmpresa[0]["CNPJ"]);

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

				<section id= "CompanyHeader">
				
					<h1><?php echo $DadosEmpresa[0]['Nome']; ?></h1>
				
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
														<a href = "Feed.php?q=<?php echo base64_encode($DadosEmpresa[0]["id_empresa"]);?>"> Acessar Feed </a>
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
														<a href = "sql/ApagarCadastros.php?q=<?php echo base64_encode($id_empresa) . "&v=". base64_encode("LoginNaEmpresa"); ?>"> Sair da Empresa </a>
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

											<h1 class = "HeaderCategory"> Configurar </h1>

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> Configurar feed </h1>
													<h2> Configurar o feed da sua empresa </h2>

												</div>

												<div class = "btnContent">

													<button class = "btnOption">
														<a href = "ConfigFeed.php?q=<?php echo base64_encode($id_empresa);?>"> Configurar Feed </a>
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
														<a href = "EditCompany.php?q=<?php echo base64_encode($id_empresa);?>"> Editar Empresa </a>
													</button>

												</div>

											</div>

										</li>

										<li class = "Category CategoryDanger">

											<h1 class = "HeaderCategory"> Zona de Perigo </h1>	

											<div class = "CategoryOptions">

												<div class = "CategoryText">

													<h1> Desativar empresa </h1>
													<h2> Desativar a empresa e o seu feed da nossa plataforma </h2>

												</div>

												<div class = "btnContent">

													<button class = "btnDanger">
														<a href = "sql/ApagarCadastros.php?q= <?php echo base64_encode($id_empresa) . "&v=". base64_encode("Empresa"); ?>"> Apagar Empresa </a>
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