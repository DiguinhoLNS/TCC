<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	require_once 'sql/ConexaoBD.php';
	require_once "sql/Funcoes.php";

	$conn = new ConexaoBD();
    $func = new Funcoes();
    
?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Detalhes do Pedido </title>
		
		<?php include "include/Head.php"; ?>

	</head>

	<body id = "OrderDetailsPage" class = "UNT LightMode CompanyLayout">

		<?php

			include "php/Pag.php";
			
			StopUserAccess();
			V_User();
			CookieStatus();
            C_Login();

            include "include/Load.php";

        ?>

		<header>

			<?php include "include/Header.php"; ?>

		</header>

		<main id = "MainOrderDetails" class = "ThemeBlue">

			<div class = "MainContent">

				<section id = "SectionOrderDetailsMain">

					<ul class = "BoxGroup">

						<li class = "Box">

							<div id = "OrderBox1" class = "BoxContent">

								<h1> Pedido 145665 </h1> 

							</div>

						</li>

						<li class = "Box">

							<ul id = "OrderBox2" class = "BoxContent">

								<h2 class = "ContentHeader"> Pedido </h2>

								<li class = "BoxCategory">
									<i class = "material-icons"> &#xe916; </i>
									<h1> Data </h1>
									<h2> 00/00/2020 </h2>
								</li>
								<li class = "BoxCategory">
									<i class = "material-icons"> &#xe8b5; </i>
									<h1> Horário </h1>
									<h2> 00:00 </h2>
								</li>
								<li class = "BoxCategory">
									<i class = "material-icons"> &#xe7fd; </i>
									<h1> Usuário </h1>
									<h2> Rodrigo Lima </h2>
								</li>
								<li class = "BoxCategory">
									<i class = "material-icons"> &#xe88e; </i>
									<h1> Status </h1>
									<h2 class = "Status1"> Status </h2>
								</li>

							</ul>

						</li>

						<li class = "Box">

							<ul id = "OrderBox3" class = "BoxContent">

								<h2 class = "ContentHeader"> Item </h2>

								<li class = "BoxCategory">
									<i class = "material-icons"> category </i>
									<h1> Item </h1>
									<h2>
										<a href = "Item.php?q="> Boné da Oakley </a>
									</h2>
								</li>
								<li class = "BoxCategory">
									<i class = "material-icons"> &#xe916; </i>
									<h1> Data </h1>
									<h2> 00/00/2020 </h2>
								</li>
								<li class = "BoxCategory">
									<i class = "material-icons"> category </i>
									<h1> Categoria </h1>
									<h2> Eletronicos </h2>
								</li>
								<li class = "BoxCategory"> 
									<i class = "material-icons">  &#xe0af; </i>
									<h1> Empresa </h1>
									<h2>
										<a href = "Company.php?q="> Nome Empresa </a>
									</h2>
								</li>
								<li class = "BoxCategory">
									<i class = "material-icons"> &#xe88e; </i>
									<h1> Status </h1>
									<h2 class = "Status1"> Status </h2>
								</li>

							</ul>

						</li>

						<li class = "Box BoxImg">

							<div id = "OrderBox4" class = "BoxContent">
								<img src = "imagesBD\3efebabd50c78670a7f4ffe156e50ea2.jpeg"/>
							</div>

						</li>

						<li class = "Box OrderControl">

							<ul id = "OrderBox5" class = "BoxContent">

								<li>
									<a href = "">
										<h1> Confirmar Devolução </h1>
									</a>
								</li>
								<li>
									<a href = "">
										<h1> Negar Devolução </h1>
									</a>
								</li>

							</ul>

						</li>

					</ul>

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