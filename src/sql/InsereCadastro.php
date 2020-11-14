<?php

	date_default_timezone_set('America/Sao_Paulo');

	require_once "ConexaoBD.php";
	require_once "Funcoes.php";

	$conn = new ConexaoBD();
	$func = new Funcoes();	


	$tipo_verificacao = $_SESSION['TipoVerificação'];

	switch ($tipo_verificacao) {

		case "Usuario":

			$nome = $func->ClearInjectionXSS($_POST["nome"]);
			$cpf = $func->ClearInjectionXSS($_SESSION['cpfsemponto']);
			$data = $func->ClearInjectionXSS($_POST["data"]);
			$telefone = $func->ClearInjectionXSS($_POST["telefone"]);
			$genero = $func->ClearInjectionXSS($_POST["Genero"]);
			$email = $func->ClearInjectionXSS($_POST["email"]);
			$senha = $func->ClearInjectionXSS($_POST["senha"]);
			$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

			try{
			$query = "INSERT INTO usuarios (Nome_user, Genero_user, Data_nasc_user, CPF_user, Email_user, Telefone_user, Senha_user) VALUES";
			$query .= " (:nome , :genero , :data , :cpf, :email, :telefone, :senha) ;" ;

			$sql = $conn->dbh->prepare($query);
			$sql->execute([':nome' => $nome, ':genero' => $genero, ':data' => $data, ':cpf' => $cpf, ':email' => $email, ':telefone' => $telefone, ':senha' => $senhaCriptografada]);
			header("Location: ../LoginUser.php");

			}catch(PDOException $e){
				die("Erro SQL");
			}

			break;

		case "Empresa":

			$CodigoJaExiste = true;

			do {

				$codigo_acesso = $func->GerarCodigoAcesso();
				$Dados = $func->PegarDadosEmpresaPeloCodigo($codigo_acesso);
				$CodigoJaExiste = $Dados["CodigoExiste"] ? true : false;

			} while ($CodigoJaExiste);

			$id_adm = $func->ClearInjectionXSS($func->Descriptografar($_COOKIE["ID"]));
			$nome = $func->ClearInjectionXSS($_POST["nome"]);
			$email = $func->ClearInjectionXSS($_POST["email"]);
			$cnpj = $func->ClearInjectionXSS($_SESSION['cnpjsemponto']);
			$telefone = $func->ClearInjectionXSS($_POST["telefone"]);
			$cor = $func->ClearInjectionXSS($_POST["CorLayout"]);
			$endereco = $func->ClearInjectionXSS($_POST["endereco"]);			

			try{
				
				$query = "INSERT INTO empresas (id_adm, codigo_acesso, Nome, CNPJ, Endereco, Email, Telefone, Cor_layout, Situacao) VALUES";
				$query .= " (:id_adm, :codigo_acesso, :nome, :cnpj, :endereco, :email, :telefone, :cor, :situacao) ;" ;

				$sql = $conn->dbh->prepare($query);
				$sql->execute([':id_adm' => $id_adm, ':codigo_acesso' => $codigo_acesso, ':nome' => $nome, ':cnpj' => $cnpj, ':email' => $email, ':telefone' => $telefone, ':endereco' => $endereco, ':cor' => $cor, ':situacao' => 'Ativada']);
				
				header("Location: InsereUser_Empresa.php?q=" . $func->Criptografar($codigo_acesso));
			
			}catch(PDOException $e){
				die("Erro no SQL");
			}

			break;

		case "Item":

			$nome = $func->ClearInjectionXSS($_POST["nome"]);
			$foto = $_FILES["foto"];
			$categoria = $func->ClearInjectionXSS($_POST["categoria"]);
			$descricao = $func->ClearInjectionXSS($_POST["descricao"]);

			list($tipo, $extensao) = explode("/", $foto["type"]);

			$tipo = strtolower($tipo);
			$extensao = strtolower($extensao);

			$novoNome = md5(time()) .".". $extensao;
			$diretorio = "C:\Users\T-Gamer\Documents\GitHub\TCC\src\imagesBD/";

			setlocale(LC_ALL, 'pt_BR', 'pt', 'Portuguese_Brazilian');

			$data = strftime('%Y-%m-%d');			


			try{
				
				$query = "INSERT INTO objetos (id_empresa, Nome_foto, Nome_obj, Data_cadastro, Categoria, Descricao, situacao) VALUES";
				$query .= " (:id_empresa, :nome_foto, :nome_obj, :data , :categoria, :descricao, :situacao) ";

				$sql = $conn->dbh->prepare($query);
				$sql->execute([':id_empresa' => $id_empresa, ':nome_foto' => $novoNome, ':nome_obj' => $nome, ':data' => $data, ':categoria' => $categoria, ':descricao' => $descricao, ':situacao' => 'Perdido']);
				move_uploaded_file($foto["tmp_name"], $diretorio . $novoNome);
				header("Location: ../Feed.php?q=".$func->Criptografar($id_empresa));

			}catch(PDOException $e){
				die("Erro no SQL ".var_dump($_POST). " ". var_dump($_FILES));
			}



		break;
	}

	$conn=null;
