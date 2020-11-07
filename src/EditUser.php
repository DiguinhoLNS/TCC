<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    require_once "sql/ConexaoBD.php";
    require_once "sql/Funcoes.php";

    $conn = new ConexaoBD();
	$func = new Funcoes();

    $id = base64_decode($_COOKIE["ID"]);

    $DadosUsuario = $func->PegarDadosUsuarioPeloId($id);
        
    $_SESSION['TipoVerificação'] = "EditarUsuario";

?>

<!DOCTYPE html>
<html lang = "pt-br">

    <head>

        <title> Alterar Dados </title>

        <?php include "include/Head.php"; ?>

    </head>

    <body id = "EditUserPage" class = "LightMode">

        <?php

            include "php/Pag.php";

            StopUserAccess();
            if($_COOKIE["VerificaErro"]){

            if(isset($_SESSION["ErrosEditarUsuario"])){

                $erros = $_SESSION["ErrosEditarUsuario"];


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

                    if(isset($erros["CPF"])){

                        echo '
                            
                            <script language = "javascript" type = "text/javascript">
                            
                                $(document).ready(function(){

                                    $("#ErrorCPF").css("display", "block");

                                });
                            
                            </script>
                        
                        ';

                    }

                    if(isset($erros["Data"])){

                        echo '
                            
                            <script language = "javascript" type = "text/javascript">
                            
                                $(document).ready(function(){

                                    $("#ErrorDataNasc").css("display", "block");

                                });
                            
                            </script>
                        
                        ';
                        
                    }

                    if(isset($erros["Telefone"])){

                        echo '
                            
                            <script language = "javascript" type = "text/javascript">
                            
                                $(document).ready(function(){

                                    $("#ErrorTelefone").css("display", "block");

                                });
                            
                            </script>
                        
                        ';

                    }

                    if(isset($erros["Senha"])){

                        echo '
                            
                            <script language = "javascript" type = "text/javascript">
                            
                                $(document).ready(function(){

                                    $("#ErrorSenha").css("display", "block");

                                });
                            
                            </script>
                        
                        ';

                    }

                }
            }

        ?>

        <main id = "MainEditUser">

            <div class = "FormPlatform FormEdit BS">

                <form class = "FormData" method = "POST" action = "sql/VerificaCadastro.php">

                    <ul class = "FormPlatformContent">

                        <li class = "ContentHeader">
                            <h1> Editar Conta </h1>
                        </li>
                        <li class = "ContentInput">
							<label for = "E_UserNome"> Nome </label>
							<span id = "ErrorNome" class = "txtError"> Nome inválido </span>
							<input id = "E_UserNome" class = "UserInputData" type = "text" name = "nome" value = "<?php echo $DadosUsuario[0]["Nome_user"] ?>" required />
						</li>
						<li class = "ContentInput">
							<label for = "E_UserCPF"> CPF </label>
							<span id = "ErrorCPF" class = "txtError"> CPF inválido </span>
							<input id = "E_UserCPF" class = "UserInputData InputCPF" type = "text" name = "CPF" value = "<?php echo $DadosUsuario[0]["CPF_user"] ?>" required />
						</li>
						<li class = "ContentInput">
							<label for = "E_UserGenero"> Gênero </label>
							<select name = "Genero" id = "E_UserGenero" class = "UserSelectData" required>
                                <option value = "Feminino" <?php if($DadosUsuario[0]["Genero_user"] == "Feminino"){ echo "selected" ;}?>> Feminino </option>
								<option value = "Masculino" <?php if($DadosUsuario[0]["Genero_user"] == "Masculino"){ echo "selected" ;}?>> Masculino </option>
                                <option value = "Outros" <?php if($DadosUsuario[0]["Genero_user"] == "Outros"){ echo "selected" ;}?>> Prefiro não informar </option>';       
                            </select>
						</li>
						<li class = "ContentInput">
							<label for = "E_UserDataNasc"> Data de Nascimento </label>
							<span id = "ErrorDataNasc" class = "txtError"> Data inválida </span>
							<input id = "E_UserDataNasc" class = "UserInputData" type = "date" name = "data" value = "<?php echo $DadosUsuario[0]["Data_nasc_user"] ?>" required />
						</li>
						<li class = "ContentInput">
							<label for = "E_UserEmail"> Email </label>
							<span id = "ErrorEmail" class = "txtError"> Email inválido </span>
							<input id = "E_UserEmail" class = "UserInputData" type = "email" name = "email" value = "<?php echo $DadosUsuario[0]["Email_user"] ?>" required />
						</li>
						<li class = "ContentInput">
							<label for = "E_UserTelefone"> Telefone de contato </label>
							<span id = "ErrorTelefone" class = "txtError"> Telefone inválido </span>
							<input id = "E_UserTelefone" class = "UserInputData InputTelefone9" type = "text" name = "telefone" value = "<?php echo $DadosUsuario[0]["Telefone_user"] ?>" placeholder = "Fixo ou móvel" required />
						</li>
						<li class = "ContentBottom">
                        <a href = "User.php"> Voltar </a>
							<input class = "UserInputSubmit btn" type = "submit" value = "Confirmar Alterações">
						</li>

                    </ul>

                </form>

            </div>

        </main>

    </body>

</html>