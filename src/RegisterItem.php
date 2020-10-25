<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	$_SESSION['TipoVerificação'] = "Item";

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
            
		?>
		
		<script type = "text/javascript">

			 function PreviewImage() {

				var oFReader = new FileReader();
				oFReader.readAsDataURL(document.getElementById("R_ItemFoto").files[0]);

				oFReader.onload = function (oFREvent) {
					document.getElementById("FormFoto").src = oFREvent.target.result;
				};

			};

		</script>

        <main id = "MainRegisterItem">

			<div class = "FormPlatform BS">

				<form method = "POST" action = "sql/VerificaCadastro.php">
			
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
							<input id = "R_ItemFoto" type = "file" name = "foto" onchange = "PreviewImage();"/>
							<img id = "FormFoto" />
						</li>
						<li class = "ContentInput">
							<label for = "R_ItemCategoria"> Categoria </label>
							<select name = "Categoria" id = "R_ItemCategoria" class = "UserSelectData" required>
								<option value = "outros"> Outros </option>
								<option value = "acessorio"> Acessórios </option>
								<option value = "documento"> Documentos </option>
								<option value = "eletronico"> Eletrônicos </option>
								<option value = "roupa"> Roupas </option>
                            </select>
						</li>
						<li class = "ContentInput">
							<label for = "R_ItemDesc"> Descrição </label>
							<textarea id = "R_ItemDesc" class = "FormTextareaData" name = "descricao" rows = "4"></textarea>
						</li>
						<li class = "ContentBottom">
							<a href = "Feed.php"> Voltar para Feed </a>
							<input class = "UserInputSubmit btn" type = "submit" value = "Criar"/>
						</li>

					</ul>
			
				</form>

			</div>

		</main>

    </body>
    
</html>