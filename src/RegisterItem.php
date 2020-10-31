<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	$_SESSION['TipoVerificação'] = "Item";
	$id_empresa = base64_decode($_GET["q"]);

?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Criar Item </title>

		<?php include "include/Head.php"; ?>

	</head>

	<body id = "RegisterItemPage" class = "LightMode">

		<?php
    
			include "php/Pag.php";

			StopUserAccess();
			if($_COOKIE["VerificaErro"]){

				if(isset($_SESSION["ErrosRegistrarItem"])){

					$erros = $_SESSION["ErrosRegistrarItem"];

						if (isset($erros["Nome"])){

							echo '
								
								<script language = "javascript" type = "text/javascript">
								
									$(document).ready(function(){

										$("#ErrorNome").css("display", "block");

									});
								
								</script>
							
							';

						}

						if (isset($erros["foto"])){

							echo '
								
								<script language = "javascript" type = "text/javascript">
								
									$(document).ready(function(){

										$("#ErrorFoto").css("display", "block");

									});
								
								</script>
							
							';

						}

						
				}
			}

            
		?>

        <main id = "MainRegisterItem">

			<div class = "FormPlatform FormRegister BS">

				<form class = "FormData" method = "POST" action = "sql/VerificaCadastro.php?q=<?php echo base64_encode($id_empresa);?>" enctype="multipart/form-data">
			
					<ul class = "FormPlatformContent">

						<li class = "ContentHeader">
							<h1> Criar Item </h1>
						</li>
						<li class = "ContentInput">
							<label for = "R_ItemNome"> Nome </label>
							<span id = "ErrorNome" class = "txtError"> Nome inválido </span>
							<input id = "R_ItemNome" class = "UserInputData" type = "text" name = "nome" require />
						</li>
						<li class = "ContentInput">
							<label for = "R_ItemFoto"> Foto </label>
							<span id = "ErrorFoto" class = "txtError"> Foto inválida </span>
							<input id = "R_ItemFoto" type = "file" name = "foto"/>
							<label id = "imgContent" for = "R_ItemFoto">
								<i id = "imgIcon" class = "material-icons"> &#xe251; </i>
								<img id = "FormFoto"/>
							</label>	
						</li>
						<li class = "ContentInput">
							<label for = "R_ItemCategoria"> Categoria </label>
							<select name = "categoria" id = "R_ItemCategoria" class = "UserSelectData" required>
								<option value = "Outros"> Outros </option>
								<option value = "Acessório"> Acessórios </option>
								<option value = "Documento"> Documentos </option>
								<option value = "Eletrônico"> Eletrônicos </option>
								<option value = "Roupa"> Roupas </option>
                            </select>
						</li>
						<li class = "ContentInput">
							<label for = "R_ItemDesc"> Descrição </label>
							<textarea id = "R_ItemDesc" class = "FormTextareaData" name = "descricao" rows = "4"></textarea>
						</li>
						<li class = "ContentBottom">
							<a href = "Feed.php?q=<?php echo base64_encode($id_empresa)?>"> Voltar para Feed </a>
							<input class = "UserInputSubmit btn" type = "submit" value = "Criar"/>
						</li>

					</ul>
			
				</form>

			</div>

		</main>

		<script type = "text/javascript">

			document.getElementById("R_ItemFoto").onchange = function() {PreviewImage()};

			function PreviewImage() {

				var oFReader = new FileReader();
				oFReader.readAsDataURL(document.getElementById("R_ItemFoto").files[0]);

				oFReader.onload = function (oFREvent) {
					document.getElementById("FormFoto").src = oFREvent.target.result;
				};

			};

		</script>

    </body>
    
</html>