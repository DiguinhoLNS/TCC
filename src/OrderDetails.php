<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	require_once 'sql/ConexaoBD.php';
	require_once "sql/Funcoes.php";

	$conn = new ConexaoBD();
	$func = new Funcoes();
	
	$id = $func->Descriptografar($_GET["q"]);
	$Agendamento = $func->PedidoPeloID($id);
	$DataSeparadaPedido = $func->SepararData($Agendamento["Agendamento"][0]["data"]);
	$DataSeparadaItem = $func->SepararData($Agendamento["Agendamento"][0]["Data_cadastro"]);
    
?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Detalhes do Pedido <?= $Agendamento["Agendamento"][0]["id_agendamento"]?> </title>
		
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

								<h1> Pedido <?= $Agendamento["Agendamento"][0][0]?> </h1> 

							</div>

						</li>

						<li class = "Box">

							<ul id = "OrderBox2" class = "BoxContent">

								<h2 class = "ContentHeader"> Pedido </h2>

								<li class = "BoxCategory">
									<i class = "material-icons"> &#xe916; </i>
									<h1> Data </h1>
									<h2> <?= $DataSeparadaPedido["dia"] . '/' . $DataSeparadaPedido["mes"] . '/' . $DataSeparadaPedido["ano"] ?> </h2>
								</li>
								<li class = "BoxCategory">
									<i class = "material-icons"> &#xe8b5; </i>
									<h1> Horário </h1>
									<h2> <?= substr($Agendamento["Agendamento"][0]["horario"], 0, 5)?>h  </h2>
								</li>
								<li class = "BoxCategory">
									<i class = "material-icons"> &#xe7fd; </i>
									<h1> Usuário </h1>
									<h2> <?= $Agendamento["Agendamento"][0]["Nome_user"]?>  </h2>
								</li>
								<li class = "BoxCategory">
									<i class = "material-icons"> folder_shared </i>
									<h1> CPF </h1>
									<h2> <?= $func->ColocarPontoCPF($Agendamento["Agendamento"][0]["CPF_user"])?> </h2>
								</li>
								<li class = "BoxCategory">
									<i class = "material-icons"> email </i>
									<h1> Email </h1>
									<h2> <?= $Agendamento["Agendamento"][0]["Email_user"]?> </h2>
								</li>
								<li class = "BoxCategory">
									<i class = "material-icons"> &#xe88e; </i>
									<h1> Status </h1>
									<?php
										if($Agendamento["Agendamento"][0][5] == "Pendente"){
											echo '<h2 class = "Status1">'.  $Agendamento["Agendamento"][0][5] .' </h2>';
										}else if($Agendamento["Agendamento"][0][5] == "Aceito"){
											echo '<h2 class = "Status3">'.  $Agendamento["Agendamento"][0][5] .'</h2>';
										}else{
											echo '<h2 class = "Status3">'.  $Agendamento["Agendamento"][0][5] .'</h2>';
										}	
									?>
								</li>

							</ul>

						</li>

						<li class = "Box">

							<ul id = "OrderBox3" class = "BoxContent">

								<h2 class = "ContentHeader"> Item </h2>

								<li class = "BoxCategory">
									<i class = "material-icons"> widgets </i>
									<h1> Item </h1>
									<h2>
										<a href = "Item.php?q=<?=$func->Criptografar($Agendamento["Agendamento"][0]["id_obj"])?>"> <?= $Agendamento["Agendamento"][0]["Nome_obj"]?> </a>
									</h2>
								</li>
								<li class = "BoxCategory">
									<i class = "material-icons"> &#xe916; </i>
									<h1> Data </h1>
									<h2> <?= $DataSeparadaItem["dia"] . '/' . $DataSeparadaItem["mes"] . '/' . $DataSeparadaItem["ano"] ?> </h2>
								</li>
								<li class = "BoxCategory">
									<i class = "material-icons"> category </i>
									<h1> Categoria </h1>
									<h2> <?= $Agendamento["Agendamento"][0]["Categoria"]?> </h2>
								</li>
								<li class = "BoxCategory"> 
									<i class = "material-icons">  &#xe0af; </i>
									<h1> Empresa </h1>
									<h2>
										<a href = "Company.php?q=<?=$func->Criptografar($Agendamento["Agendamento"][0]["id_empresa"])?>"> <?= $Agendamento["Agendamento"][0]["Nome"]?> </a>
									</h2>
								</li>
								<li class = "BoxCategory">
									<i class = "material-icons"> &#xe88e; </i>
									<h1> Status </h1>

									<?php
									if($Agendamento["Agendamento"][0]["situacao"] == "Devolvido"){
										echo '<h2 class = "Status3"> '.$Agendamento["Agendamento"][0]["situacao"].' </h2>';
									}else{
										echo '<h2 class = "Status1"> '.$Agendamento["Agendamento"][0]["situacao"].' </h2>';
									}
									?>
								</li>

							</ul>

						</li>

						<li class = "Box BoxImg">

							<div id = "OrderBox4" class = "BoxContent">
								<img src = "imagesBD\<?= $Agendamento["Agendamento"][0]["Nome_foto"]?>"/>
							</div>

						</li>

						<li class = "Box OrderControl">

						<?php 

						if($Agendamento["Agendamento"][0][5] == "Pendente"){

							echo '

							<ul id = "OrderBox5" class = "BoxContent">

								<li>
									<a href = "sql/ConfigAgendamento.php?q='.$func->Criptografar($Agendamento["Agendamento"][0][0]).'&v='.$func->Criptografar("A").'">
										<h1> Confirmar Agendamento </h1>
									</a>
								</li>
								<li>
									<a href = "sql/ConfigAgendamento.php?q='.$func->Criptografar($Agendamento["Agendamento"][0][0]).'&v='.$func->Criptografar("B").'">
										<h1> Negar Agendamento </h1>
									</a>
								</li>

							</ul>';

						}else if($Agendamento["Agendamento"][0][5] == "Aceito"){

							echo '

							<ul id = "OrderBox5" class = "BoxContent">

								<li>
									<a href = "sql/EditarDados.php?q='.$func->Criptografar($Agendamento["Agendamento"][0]["id_obj"]).'&v='. $func->Criptografar("Devolvido").'&a='.$func->Criptografar($Agendamento["Agendamento"][0][0]).'&c='.$func->Criptografar($Agendamento["Agendamento"][0]["id_empresa"]).'">
										<h1> Confirmar Devolução </h1>
									</a>
								</li>
								<li>
									<a href = "sql/ConfigAgendamento.php?q='.$func->Criptografar($Agendamento["Agendamento"][0][0]).'&v='.$func->Criptografar("D").'">
										<h1> Negar Devolução </h1>
									</a>
								</li>

							</ul>';

						}

						?>

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