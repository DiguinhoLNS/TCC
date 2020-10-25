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

        <main id = "MainRegisterItem"></main>

    </body>
    
</html>