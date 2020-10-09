<?php session_start(); ?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Nome da Empresa </title>
		
		<?php include "include/Head.php"; ?>

	</head>

    <body id = "CompanyPage" class = "UNT LightMode ThemeRed ADMView">

		<?php

			include "php/Pag.php";
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
				
					<h1 id = "CompanyName"> Nome da Empresa </h1>
				
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
									<h2> Nome da Empresa </h2>

								</div>

							</div>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> CNPJ </h1>
									<h2> 00.000.000/0000-00 </h2>

								</div>

							</div>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Endereço </h1>
									<h2> Avenida Teste 311 </h2>

								</div>

							</div>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Cor Tema </h1>
									<h2> Roxo </h2>

								</div>

							</div>

						</li>

						<li class = "Category">

							<h1 class = "HeaderCategory"> Contato </h1>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Telefone </h1>
									<h2> (00) 0000-0000 </h2>

								</div>

							</div>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Email </h1>
									<h2> email@email.com </h2>

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

									<h1> Editar página </h1>
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

									<h1> Apagar dados </h1>
									<h2> Apagar os seus dados armazenados nessa empresa </h2>

								</div>

								<div class = "btnContent">

									<button>
										<a href = ""> Apagar dados </a>
									</button>

								</div>

							</div>

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

									<h1> Apagar dados </h1>
									<h2> Apagar todos os dados da sua empresa em nossa plataforma </h2>

								</div>

								<div class = "btnContent">

									<button>
										<a href = ""> Apagar Dados </a>
									</button>

								</div>

							</div>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Apagar empresa </h1>
									<h2> Apagar a empresa e o seu feed da nossa plataforma </h2>

								</div>

								<div class = "btnContent">

									<button>
										<a href = ""> Apagar Empresa </a>
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