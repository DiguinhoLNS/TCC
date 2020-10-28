<?php

	date_default_timezone_set('America/Sao_Paulo');

	include "ConexaoBD.php";
	include_once "Funcoes.php";

	$tipo_verificacao = $_SESSION['TipoVerificação'];

	switch ($tipo_verificacao) {

		case "Usuario":

			$nome = ClearInjectionXSS($base, $_POST["nome"]);
			$cpf = ClearInjectionXSS($base, $_SESSION['cpfsemponto']);
			$data = ClearInjectionXSS($base, $_POST["data"]);
			$telefone = ClearInjectionXSS($base, $_POST["telefone"]);
			$genero = ClearInjectionXSS($base, $_POST["Genero"]);
			$email = ClearInjectionXSS($base, $_POST["email"]);
			$senha = ClearInjectionXSS($base, $_POST["senha"]);
			$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

			$sql = "INSERT INTO usuarios (Nome_user, Genero_user, Data_nasc_user, CPF_user, Email_user, Telefone_user, Senha_user) VALUES";
			$sql .= " ('$nome', '$genero', '$data', '$cpf', '$email', '$telefone', '$senhaCriptografada') ";

			$conexao->query($sql) ? header("Location: ../LoginUser.php") : header("Location: ../RegisterUser.php");

			break;

		case "Empresa":

			$CodigoJaExiste = true;

			do {

				$codigo_acesso = strtoupper(bin2hex(random_bytes(3)));
				$Dados = PegarDadosEmpresaPeloCodigo($base, $codigo_acesso);
				$CodigoJaExiste = $Dados["CodigoExiste"] ? true : false;
			} while ($CodigoJaExiste);

			$id_adm = ClearInjectionXSS($base, base64_decode($_COOKIE["ID"]));
			$nome = ClearInjectionXSS($base, $_POST["nome"]);
			$email = ClearInjectionXSS($base, $_POST["email"]);
			$cnpj = ClearInjectionXSS($base, $_SESSION['cnpjsemponto']);
			$telefone = ClearInjectionXSS($base, $_POST["telefone"]);
			$cor = ClearInjectionXSS($base, $_POST["CorLayout"]);
			$endereco = ClearInjectionXSS($base, $_POST["endereco"]);

			$sql = "INSERT INTO empresas (id_adm, codigo_acesso, Nome, CNPJ, Endereco, Email, Telefone, Cor_layout) VALUES";
			$sql .= " ('$id_adm', '$codigo_acesso', '$nome', '$cnpj', '$endereco', '$email', '$telefone', '$cor') ";

			$conexao->query($sql) ? header("Location: InsereUser_Empresa.php?q=" . $codigo_acesso) : header("Location: ../RegisterCompany.php");

			break;

		case "Item":

			$nome = ClearInjectionXSS($base, $_POST["nome"]);
			$foto = $_FILES["foto"];
			$categoria = ClearInjectionXSS($base, $_POST["categoria"]);
			$descricao = ClearInjectionXSS($base, $_POST["descricao"]);

			list($tipo, $extensao) = explode("/", $foto["type"]);

			$tipo = strtolower($tipo);
			$extensao = strtolower($extensao);

			$novoNome = md5(time()) .".". $extensao;
			$diretorio = "C:\Users\T-Gamer\Documents\GitHub\TCC\src\imagesBD/";

			move_uploaded_file($foto["tmp_name"], $diretorio . $novoNome);

			setlocale(LC_ALL, 'pt_BR', 'pt', 'Portuguese_Brazilian');

			$horarioDeVerao = date('I');

			if($horarioDeVerao == 1){
				$Hora = date('H')-1;
				$data = strftime('%A %d/%m/%Y');
				$data .= " ".$Hora;
				$data .= date(':i:s');
				$DiaMaiusculo = strtoupper(substr($data, 0, 1));  
				$data = substr_replace($data, $DiaMaiusculo, 0, 1);
				$data = utf8_encode($data);
			}else{
				$Hora = date('H');
				$data = strftime('%A %d/%m/%Y');
				$data .= " ".$Hora;
				$data .= date(':i:s');
				$DiaMaiusculo = strtoupper(substr($data, 0, 1));  
				$data = substr_replace($data, $DiaMaiusculo, 0, 1);
				$data = utf8_encode($data);
			}
			

			$sql = "INSERT INTO objetos (id_empresa, Nome_foto, Nome_obj, Data_cadastro, Categoria, Descricao, situacao) VALUES";
			$sql .= " ('$id_empresa', '$novoNome', '$nome', '$data' , '$categoria', '$descricao', 'Perdido') ";

			$conexao->query($sql) ? header("Location: ../Feed.php?q=".$id_empresa) : header("Location: ../RegisterItem.php?q=".$id_empresa);
	}

	$conexao->close();
