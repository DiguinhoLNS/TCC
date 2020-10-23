<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	
	include 'sql/ConexaoBD.php';
	include_once "sql/Funcoes.php";

	$id_empresa = $_GET['q'];
	$_SESSION['TipoVerificação'] = 'Empresa';

	if(isset($_COOKIE["ID"])){

		$id_user = $_COOKIE["ID"]; 

		$DadosEmpresa = PegarDadosEmpresaPeloIdEmpresa($base, $id_empresa);

		$DadosUserEmpresa = PegarDadosUserEmpresaPeloIdUserIdEmpresa($base, $id_user, $id_empresa);

		$cnpj = ColocarPontoCNPJ($DadosEmpresa["CNPJ"]);

	}

?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title><?php echo $DadosEmpresa['Nome'];?></title>
		
		<?php include "include/Head.php"; ?>

	</head>

    <body id = "CompanyPage" class = "UNT LightMode <?php echo $DadosEmpresa['Cor_layout']; if($DadosUserEmpresa['Nivel_acesso'] == 4){ echo ' ADMView'; }else if($DadosUserEmpresa['Nivel_acesso'] == 2){echo ' UserView';}?>">

		<?php

			include "php/Pag.php";

			StopUserAccess();
			V_User();
			C_Login();

			include "include/Load.php";

		?>
		
		<header id = "HeaderCompany">

			<?php include "include/Header.php"; ?>

		</header>

		<main id = "MainCompany">

			<div class = "MainContent">

				<section id = "SectionCompanyHeader">
				
					<h1 id = "CompanyName"> <?php echo $DadosEmpresa['Nome']; ?> </h1>
				
				</section>

				<section id = "SectionCompanyMain">

					<ul>

						<div class = "CategoryHeader">
							<h1> Informações </h1>
						</div>

						<li class = "Category">

							<h1 class = "HeaderCategory"> Perfil </h1>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Nome </h1>
									<h2> <?php echo $DadosEmpresa['Nome']; ?> </h2>

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
									<h2> <?php echo utf8_encode($DadosEmpresa['Endereco']); ?> </h2>

								</div>

							</div>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Cor Tema </h1>
									<h2> <?php echo $DadosEmpresa['Cor_layout']; ?> </h2>

								</div>

							</div>

						</li>

						<li class = "Category">

							<h1 class = "HeaderCategory"> Contato </h1>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Telefone </h1>
									<h2> <?php echo $DadosEmpresa['Telefone']; ?> </h2>

								</div>

							</div>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Email </h1>
									<h2> <?php echo $DadosEmpresa['Email']; ?> </h2>

								</div>

							</div>
					
						</li>

					</ul>

					<ul>

						<div class = "CategoryHeader">
							<h1> Opções </h1>
						</div>
					
						<li class = "Category">

							<h1 class = "HeaderCategory"> Feed </h1>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Acessar Feed </h1>
									<h2> Vizualizar o feed de itens da empresa </h2>

								</div>

								<div class = "btnContent">

									<button>
										<a href = "Feed.php/?id=ID_DA_EMPRESA"> Acessar Feed </a>
									</button>

								</div>

							</div>

						</li>

						<li class = "Category CompanyADM">

							<h1 class = "HeaderCategory"> Editar </h1>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Editar empresa </h1>
									<h2> Editar os dados da sua empresa </h2>

								</div>

								<div class = "btnContent">

									<button>
										<a href = "EditCompany.php"> Editar Empresa </a>
									</button>

								</div>

							</div>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Editar feed </h1>
									<h2> Editar o feed da sua empresa </h2>

								</div>

								<div class = "btnContent">

									<button>
										<a href = ""> Editar Feed </a>
									</button>

								</div>

							</div>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Editar usuários da página </h1>
									<h2> Editar os usuários da sua empresa </h2>

								</div>

								<div class = "btnContent">

									<button>
										<a href = ""> Editar Usuários </a>
									</button>

								</div>

							</div>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Editar itens </h1>
									<h2> Editar os itens perdidos na sua empresa </h2>

								</div>

								<div class = "btnContent">

									<button>
										<a href = ""> Editar Itens </a>
									</button>

								</div>

							</div>

						</li>

						<li class = "Category">

							<h1 class = "HeaderCategory"> Configurações </h1>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Sair </h1>
									<h2> Sair da empresa </h2>

								</div>

								<div class = "btnContent">

									<button>
										<a href = ""> Sair da Empresa </a>
									</button>

								</div>

							</div>

						</li>

						<li class = "Category CategoryDanger CompanyADM">

							<h1 class = "HeaderCategory"> Zona de Perigo </h1>	

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Apagar empresa </h1>
									<h2> Apagar a empresa e o seu feed da nossa plataforma </h2>

								</div>

								<div class = "btnContent">

									<button>
										<a href = <?php echo "sql/ApagarCadastros.php?q=".$id_empresa; ?>> Apagar Empresa </a>
									</button>

								</div>

							</div>

						</li>

					</ul>

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