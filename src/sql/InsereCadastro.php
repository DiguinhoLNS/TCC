<html>

	<head>

		<meta charset="utf8">
		
	</head>

	<body>

		<?php

			include "ConexaoBD.php";

			$nome = $_POST["nome"];
			$cpf = $_POST["CPF"];
			$data = $_POST["data"];
			$telefone = $_POST["telefone"];
			$celular = $_POST["celular"];
			$endereco = $_POST["endereco"];
			$email = $_POST["email"];
			$senha = $_POST["senha"];

			$sql = "INSERT INTO user_plataforma (Nome, CPF, data_nasc, telefone, celular, endereco, email, senha_plataforma) VALUES";
			$sql .= " ('$nome', '$cpf', '$data', '$telefone', '$celular', '$endereco', '$email', '$senha') ";

			//INSERT INTO workorders (column1, column2) VALUES ($column1, $column2)


			if ($conexao->query($sql) === TRUE) {
				
				header("Location: ../Login.php");
				
			} else {

				echo "Erro <br>" . $sql . "<br>" . $conexao->error;

			}

			$conexao->close();

		?>

	</body>

</html>