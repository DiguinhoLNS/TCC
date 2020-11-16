<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	require_once 'sql/ConexaoBD.php';
	require_once "sql/Funcoes.php";

	$conn = new ConexaoBD();
	$func = new Funcoes();

	$_SESSION['TipoVerificação'] = "EditarItem";
	$id_objeto = $func->Descriptografar($_GET["q"]);
	
	$DadosItem = $func->PegarDadosItemPeloId($id_objeto);
	$id_empresa = $DadosItem["Objeto"][0]["id_empresa"];

?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Editar Item </title>

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

        <main id = "MainRegisterItem" class = "MainFormPlatform">

			<div class = "FormPlatform FormEdit BS">

				<form class = "FormData" method = "POST" action = "sql/VerificaCadastro.php?q=<?= $func->Criptografar($id_objeto);?>" enctype="multipart/form-data">
			
					<ul class = "FormPlatformContent">

						<li class = "ContentHeader">
							<h1> Editar Item </h1>
						</li>
						<li class = "ContentInput">
							<label for = "R_ItemNome"> Nome </label>
							<span id = "ErrorNome" class = "txtError"> Nome inválido </span>
							<input id = "R_ItemNome" class = "UserInputData" type = "text" name = "nome" value = "<?= $DadosItem["Objeto"][0]["Nome_obj"];?>" require />
						</li>
						<li class = "ContentInput">
							<label for = "R_ItemCategoria"> Categoria </label>
							<select name = "categoria" id = "R_ItemCategoria" class = "UserSelectData" required>
								<option value = "Outros" <?php if($DadosItem["Objeto"][0]["Categoria"] == "Outros"){echo "selected";}?>> Outros </option>
								<option value = "Acessorio" <?php if($DadosItem["Objeto"][0]["Categoria"] == "Acessorio"){echo "selected";}?>> Acessórios </option>
								<option value = "Documento" <?php if($DadosItem["Objeto"][0]["Categoria"] == "Documento"){echo "selected";}?>> Documentos </option>
								<option value = "Eletronico" <?php if($DadosItem["Objeto"][0]["Categoria"] == "Eletronico"){echo "selected";}?>> Eletrônicos </option>
								<option value = "Roupa" <?php if($DadosItem["Objeto"][0]["Categoria"] == "Roupa"){echo "selected";}?>> Roupas </option>
                            </select>
						</li>
						<li class = "ContentInput">
							<label for = "R_ItemDesc"> Descrição </label>
							<textarea id = "R_ItemDesc" class = "FormTextareaData" name = "descricao" rows = "4" ><?= trim($DadosItem["Objeto"][0]["Descricao"]);?></textarea>
						</li>
						<li class = "ContentInput">
							<label for = "R_ItemStatus"> Status </label>
							<select name = "situacao" id = "R_ItemStatus" class = "UserSelectData" required>
								<option value = "Perdido" <?php if($DadosItem["Objeto"][0]["situacao"] == "Perdido"){echo "selected";}?>> Perdido </option>
								<option value = "Devolvido" <?php if($DadosItem["Objeto"][0]["situacao"] == "Devolvido"){echo "selected";}?>> Devolvido </option>
                            </select>
						</li>
						<li class = "ContentBottom">
							<a href = "Feed.php?q=<?= $func->Criptografar($id_empresa)?>"> Voltar para Feed </a>
							<input class = "UserInputSubmit btn" type = "submit" value = "Alterar Item"/>
						</li>

					</ul>
			
				</form>

			</div>

		</main>

    </body>
    
</html>