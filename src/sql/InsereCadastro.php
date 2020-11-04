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

			$sql = "INSERT INTO usuarios (Nome_user, Genero_user, Data_nasc_user, CPF_user, Email_user, Telefone_user, Senha_user) VALUES";
			$sql .= " ('$nome', '$genero', '$data', '$cpf', '$email', '$telefone', '$senhaCriptografada') ";

			$conn->dbh->query($sql) ? header("Location: ../LoginUser.php") : header("Location: ../RegisterUser.php");

			break;

		case "Empresa":

			$CodigoJaExiste = true;

			do {

				$codigo_acesso = strtoupper(bin2hex(random_bytes(3)));
				$Dados = $func->PegarDadosEmpresaPeloCodigo($codigo_acesso);
				$CodigoJaExiste = $Dados["CodigoExiste"] ? true : false;
			} while ($CodigoJaExiste);

			$id_adm = $func->ClearInjectionXSS(base64_decode($_COOKIE["ID"]));
			$nome = $func->ClearInjectionXSS($_POST["nome"]);
			$email = $func->ClearInjectionXSS($_POST["email"]);
			$cnpj = $func->ClearInjectionXSS($_SESSION['cnpjsemponto']);
			$telefone = $func->ClearInjectionXSS($_POST["telefone"]);
			$cor = $func->ClearInjectionXSS($_POST["CorLayout"]);
			$endereco = $func->ClearInjectionXSS($_POST["endereco"]);

			$sql = "INSERT INTO empresas (id_adm, codigo_acesso, Nome, CNPJ, Endereco, Email, Telefone, Cor_layout, Situacao) VALUES";
			$sql .= " ('$id_adm', '$codigo_acesso', '$nome', '$cnpj', '$endereco', '$email', '$telefone', '$cor', 'Ativada') ";

			$conn->dbh->query($sql) ? header("Location: InsereUser_Empresa.php?q=" . base64_encode($codigo_acesso)) : header("Location: ../RegisterCompany.php");

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

			move_uploaded_file($foto["tmp_name"], $diretorio . $novoNome);

			setlocale(LC_ALL, 'pt_BR', 'pt', 'Portuguese_Brazilian');

			$data = strftime('%Y-%m-%d');			

			$sql = "INSERT INTO objetos (id_empresa, Nome_foto, Nome_obj, Data_cadastro, Categoria, Descricao, situacao) VALUES";
			$sql .= " ('$id_empresa', '$novoNome', '$nome', '$data' , '$categoria', '$descricao', 'Perdido') ";

			$conn->dbh->query($sql) ? header("Location: ../Feed.php?q=".base64_encode($id_empresa)) : header("Location: ../RegisterItem.php?q=".base64_encode($id_empresa));
	}

	$conn=null;
