<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Recuperar NOME DO OBJ </title>
		
        <?php include "include/Head.php"; ?>
        
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    </head>
    
    <body id = "RecoverItemPage" class = "LightMode">

        <main id = "MainRecoverItem" class = "MainFormPlatform">

			<div class = "FormPlatform FormRegister BS">

				<form class = "FormData" method = "POST" action = "sql/.php" enctype = "multipart/form-data">
			
					<ul class = "FormPlatformContent">

						<li class = "ContentHeader">
							<h1> Enviar Pedido de Recuperação de Item </h1>
                        </li>
                        <li class = "ContentInput">
                            <label for = "R_ItemFoto"> Foto </label>
                            <div class = "RecoverItemfoto">
                                <img src = ""/>
                            </div>
                        </li>
                        <li class = "ContentInput">
                            <label for = "R_ItemData"> Data </label>
                            <input id = "R_ItemData" class = "UserInputData" type = "date" name = "data" required />
                        </li>
                        <li class = "ContentInput">
                            <label for = "R_ItemTime"> Horário </label>
                            <input id = "R_ItemTime" class = "UserInputData" type = "time" name = "time" required />
                        </li>
                        <li class = "ContentCaptcha">
							<div class = "g-recaptcha" data-sitekey = "6LcNseAZAAAAAHJ_Z0_pIVNvaZEEoqhwHnGz2pMD"></div>
							<span id = "ErrorCaptcha" class = "txtError"> Preencha o captcha </span>
						</li>
						<li class = "ContentBottom">
							<a href = "URL DO ITEM"> Voltar </a>
							<input class = "UserInputSubmit btn" type = "submit" value = "Enviar Pedido"/>
						</li>
                        
                    </ul>
                    
                </form>
                
			</div>

    </body>

</html>