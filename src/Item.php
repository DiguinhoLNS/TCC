<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	require_once 'sql/ConexaoBD.php';
	require_once "sql/Funcoes.php";

	$conn = new ConexaoBD();
	$func = new Funcoes();

	if(isset($_COOKIE["ID"])){

		$id = $func->Descriptografar($_COOKIE["ID"]);
		$id_item = $func->Descriptografar($_GET['q']);
		
		$DadosItem = $func->PegarDadosItemPeloId($id_item);
		$DataSeparada = $func->SepararData($DadosItem["Objeto"][0]["Data_cadastro"]);

		if($DadosItem['Quantidade'] == 0 || $DadosItem['Quantidade'] > 1){
			die("Erro de ID de Objeto ". $DadosItem["Quantidade"]);
		}

	}else{
		die("Erro de ID de usuario");
	}
    
?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> <?= $DadosItem["Objeto"][0]["Nome_obj"]; ?> </title>
		
		<?php include "include/Head.php"; ?>

	</head>

	<body id = "itemPage" class = "UNT LightMode ADMView">

		<?php

			include "php/Pag.php";
			
			StopUserAccess();
			V_User();
			CookieStatus();
            C_Login();

            include "include/Load.php";

        ?>

		<header id = "HeaderItem">

			<?php include "include/Header.php"; ?>

		</header>

		<main id = "MainItem" class = "<?= $DadosItem["Objeto"][0]["Cor_layout"] ?>">

			<div class = "MainContent">

				<section id = "SectionItemMain">

					<ul class = "BoxGroup">

						<li class = "Box">

							<div id = "InfoBox1" class = "BoxContent">

								<h1> <?= $DadosItem["Objeto"][0]["Nome_obj"]; ?> </h1>

							</div>

						</li>
						<li class = "Box">	

							<div id = "InfoBox2" class = "BoxContent">

								<p class = "ItemDescription">
								<?php $DadosItem["Objeto"][0]["Descricao"] == null ? print "O item não possui descrição." : print $DadosItem["Objeto"][0]["Descricao"]; ?>
								</p>

							</div>

						</li>
						<li class = "Box">

							<ul id = "InfoBox3" class = "BoxContent">

								<li>
									<i class = "material-icons"> &#xe916; </i>
									<h1> Data </h1>
									<h2> <?= $DataSeparada["dia"] . "/" . $DataSeparada["mes"] . "/" . $DataSeparada["ano"] ?></h2>
								</li>
							
								<li>
									<i class = "material-icons"> category </i>
									<h1> Categoria </h1>
									<h2> <?php									
									if($DadosItem["Objeto"][0]["Categoria"] == "Acessorio"){
										$DadosItem["Objeto"][0]["Categoria"] = "Acessório";
									}else if($DadosItem["Objeto"][0]["Categoria" == "Eletronico"]){
										$DadosItem["Objeto"][0]["Categoria"] = "Eletrônico";
									}									
									echo $DadosItem["Objeto"][0]["Categoria"]; ?> </h2>
								</li>

								<li>
									<i class = "material-icons"> &#xe0af; </i>
									<h1> Empresa </h1>
									<h2>
										<a href = "Company.php?q=<?= $func->Criptografar($DadosItem["Objeto"][0][1]); ?>"> <?= $DadosItem["Objeto"][0]["Nome"]; ?> </a>
									</h2>
								</li>

								<li>
									<i class = "material-icons"> &#xe88e; </i>
									<h1> Status </h1>
									<h2 <?php $DadosItem["Objeto"][0]["situacao"] == "Perdido" ? print "class = 'Status1'" : print "class = 'Status2'";?>> <?= $DadosItem["Objeto"][0]["situacao"]; ?> </h2>
								</li>

							</ul>

						</li>
						<li class = "Box Boximg">

							<img src = "imagesBD\<?= $DadosItem["Objeto"][0]["Nome_foto"]; ?>"/>

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