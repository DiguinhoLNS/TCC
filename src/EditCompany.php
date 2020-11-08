<?php 

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	require_once "sql/ConexaoBD.php";
	require_once "sql/Funcoes.php";

	$conn = new ConexaoBD();
	$func = new Funcoes();

	$_SESSION['TipoVerificação'] = "EditarEmpresa";
	$id_empresa = base64_decode($_GET['q']);

	$DadosEmpresa = $func->PegarDadosEmpresaPeloIdEmpresa($id_empresa);

?>

<!DOCTYPE html>
<html lang = "pt-br">

    <head>

        <title> Criar Página </title>

        <?php include "include/Head.php"; ?>

    </head>

    <body id = "RegisterCompanyPage" class = "LightMode">

        <?php
        
            include "php/Pag.php";

			StopUserAccess();
		if($_COOKIE["VerificaErro"]){

            if(isset($_SESSION["ErrosEditarEmpresa"])){

				$erros = $_SESSION["ErrosEditarEmpresa"];

					if (isset($erros["Nome"])){

						echo '
							
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorNome").css("display", "block");

								});
							
							</script>
						
						';

					}

					if (isset($erros["Email"])){

						echo '
							
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorEmail").css("display", "block");

								});
							
							</script>
						
						';

					}

					if(isset($erros["CNPJ"])){

						echo '
							
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorCNPJ").css("display", "block");

								});
							
							</script>
						
						';

					}

					if(isset($erros["Telefone"])){

						echo '
							
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorTelefone).css("display", "block");

								});
							
							</script>
						
						';
						
					}

					if(isset($erros["Endereco"])){

						echo '
							
							<script language = "javascript" type = "text/javascript">
							
								$(document).ready(function(){

									$("#ErrorEndereco").css("display", "block");

								});
							
							</script>
						
						';
						
					}

			}
				
		}
		?>

        <main id = "MainEditCompany" class = "MainFormPlatform">

            <div class = "FormPlatform FormEdit BS">

                <form class = "FormData" method = "POST" action = "sql/VerificaCadastro.php?q=<?php echo base64_encode($id_empresa);?>" >

                    <ul class = "FormPlatformContent">

                        <li class = "ContentHeader">
							<h1> Editar Empresa </h1>
                        </li>
                        <li class = "ContentInput">
							<label for = "E_CompanyNome"> Nome </label>
							<span id = "ErrorNome" class = "txtError"> Nome inválido </span>
							<input id = "E_CompanyNome" class = "UserInputData" type = "text" name = "nome" value = "<?php echo $DadosEmpresa[0]["Nome"]; ?> " required />
						</li>
						<li class = "ContentInput">
							<label for = "E_CompanyEmail"> Email </label>
							<span id = "ErrorEmail" class = "txtError"> Email inválido </span>
							<input id = "E_CompanyEmail" class = "UserInputData" type = "email" name = "email" value = "<?php echo $DadosEmpresa[0]["Email"]; ?> " required />
                        </li>
                        <li class = "ContentInput">
							<label for = "E_CompanyCNPJ"> CNPJ </label>
							<span id = "ErrorCNPJ" class = "txtError"> CNPJ inválido </span>
							<input id = "E_CompanyCNPJ" class = "UserInputData InputCNPJ" type = "text" name = "cnpj" value = "<?php echo $DadosEmpresa[0]["CNPJ"]; ?> " required />
						</li>
                        <li class = "ContentInput">
							<label for = "E_CompanyEndereco"> Endereço </label>
							<span id = "ErrorEndereco" class = "txtError"> Endereço inválido </span>
							<input id = "E_CompanyEndereco" class = "UserInputData" type = "text" name = "endereco" value = "<?php echo $DadosEmpresa[0]["Endereco"]; ?> " required />
                        </li>
                        <li class = "ContentInput">
							<label for = "E_CompanyTelefone"> Telefone Fixo </label>
							<span id = "ErrorTelefone" class = "txtError"> Telefone inválido </span>
							<input id = "E_CompanyTelefone" class = "UserInputData InputTelefone8" type = "text" name = "telefone" value = "<?php echo $DadosEmpresa[0]["Telefone"]; ?> " required />
                        </li>
                        <li class = "ContentInput">
							<label for = "E_CompanyCor"> Cor </label>
							<select name = "CorLayout" id = "E_CompanyCor" class = "UserSelectData">
                                <option value = "ThemeDefault" <?php if ($DadosEmpresa[0]["Cor_layout"] == "ThemeDefault"){ echo "selected" ;} ?> > Padrão </option>
                                <option value = "ThemeBlue" <?php if ($DadosEmpresa[0]["Cor_layout"] == "ThemeBlue"){ echo "selected" ;} ?> > Azul </option>
                                <option value = "ThemeRed" <?php if ($DadosEmpresa[0]["Cor_layout"] == "ThemeRed"){ echo "selected" ;} ?> > Vermelho </option>
                                <option value = "ThemeYellow" <?php if ($DadosEmpresa[0]["Cor_layout"] == "ThemeYellow"){ echo "selected" ;} ?>> Amarelo </option>
                                <option value = "ThemeGreen" <?php if ($DadosEmpresa[0]["Cor_layout"] == "ThemeGreen"){ echo "selected" ;} ?>> Verde </option>
                                <option value = "ThemePink" <?php if ($DadosEmpresa[0]["Cor_layout"] == "ThemePink"){ echo "selected" ;} ?>> Rosa </option>
                                <option value = "ThemePurple" <?php if ($DadosEmpresa[0]["Cor_layout"] == "ThemePurple"){ echo "selected" ;} ?>> Roxo </option>
                                <option value = "ThemeOrange" <?php if ($DadosEmpresa[0]["Cor_layout"] == "ThemeOrange "){ echo "selected" ;} ?>> Laranja </option>
                                <option value = "ThemeTeal" <?php if ($DadosEmpresa[0]["Cor_layout"] == "ThemeTeal"){ echo "selected" ;} ?>> Ciano </option>
                                <option value = "ThemeBrown" <?php if ($DadosEmpresa[0]["Cor_layout"] == "ThemeBrown"){ echo "selected" ;} ?>> Marrom </option>
                            </select>
                        </li>
                        <li class = "ContentBottom">
							<a href = "Company.php?q=<?php echo base64_encode($id_empresa);?>"> Voltar </a>
							<input class = "UserInputSubmit btn" type = "submit" value = "Confirmar Alterações">
						</li>
                        
                    </ul>

                </form>

            </div>

        </main>

    </body>

</html>