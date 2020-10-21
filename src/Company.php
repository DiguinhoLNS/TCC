<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	
	include 'sql/ConexaoBD.php';

	$base = mysqli_connect('localhost', 'root', '', 'bdape')or die("Erro de conexão");

	$id_empresa = $_GET['q'];
	$_SESSION['V'] = '2';

	if(isset($_COOKIE["ID"])){

		$id_user = $_COOKIE["ID"]; 

		$regra1 = "SELECT * FROM empresas where id_empresa =  '$id_empresa'";
		$res = mysqli_query($base, $regra1) or die("Usuario não cadastrado");
		$mostrar = mysqli_fetch_array($res);

		$regra2 = "SELECT * FROM user_empresa where id_user =  '$id_user' and id_empresa = $id_empresa";
		$res2 = mysqli_query($base, $regra2) or die("Usuario não cadastrado");
		$mostrar2 = mysqli_fetch_array($res2);

		$cnpj =  substr_replace($mostrar['CNPJ'], '.', 2, 0);
    	$cnpj =  substr_replace($cnpj, '.', 6, 0);
        $cnpj =  substr_replace($cnpj, '/', 10, 0);
        $cnpj =  substr_replace($cnpj,  '-', 15, 0);

	}

?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title><?php echo $mostrar['Nome'];?></title>
		
		<?php include "include/Head.php"; ?>

	</head>

    <body id = "CompanyPage" class = "UNT LightMode <?php echo $mostrar['Cor_layout']; if($mostrar2['Nivel_acesso'] == 4){ echo ' ADMView'; }else if($mostrar2['Nivel_acesso'] == 2){echo ' UserView';}?>">

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
				
					<h1 id = "CompanyName"> <?php echo $mostrar['Nome']; ?> </h1>
				
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
									<h2> <?php echo utf8_encode($mostrar['Nome']); ?> </h2>

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
									<h2> <?php echo utf8_encode($mostrar['Endereco']); ?> </h2>

								</div>

							</div>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Cor Tema </h1>
									<h2> <?php echo $mostrar['Cor_layout']; ?> </h2>

								</div>

							</div>

						</li>

						<li class = "Category">

							<h1 class = "HeaderCategory"> Contato </h1>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Telefone </h1>
									<h2> <?php echo $mostrar['Telefone']; ?> </h2>

								</div>

							</div>

							<div class = "CategoryOptions">

								<div class = "CategoryText">

									<h1> Email </h1>
									<h2> <?php echo $mostrar['Email']; ?> </h2>

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