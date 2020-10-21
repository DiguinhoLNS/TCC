<?php session_start(); ?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Termos </title>
		
		<?php include "include/Head.php"; ?>

	</head>

    <body id = "TermsPage" class = "UNT LightMode">

        <?php 
        
            include "php/Pag.php";
            
            C_Login();

            include "include/Load.php";      

        ?>
        
		<header id = "HeaderAbout">

            <?php include "include/Header.php"; ?>

        </header>

        <main id = "MainTerms">

            <div class = "MainContent">
            
                <section id = "SectionTermsHeader">

                    <h1> Termos APE </h1>
                    
                </section>

                <section id = "SectionTermsMain">

                    <ul>

                        <h2> Licenças </h2>

                        <li id = "License">

                            <h3> Licença Creative Commons </h3>

                            <span>

                                <p> Achados e Perdidos Empresarial está licenciado com uma Licença Creative Commons - Atribuição-NãoComercial-SemDerivações 4.0 Internacional. </p>

                            </span>

                            <span>

                                <a rel = "license" href = "http://creativecommons.org/licenses/by-nc-nd/4.0/" target = "_blank">
                                    <img alt = "Licença Creative Commons" style = "border-width:0" src = "https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png"/>
                                </a> 

                            </span>

                        </li>

                    </ul>

                    <ul>

                        <h2> Termos </h2>

                        <li id = "TermsUse">

                            <h3> Termos de Uso </h3>

                            <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at tincidunt augue. Sed id metus semper, pellentesque felis at, condimentum mi. Mauris sagittis augue sed ligula hendrerit, in pharetra odio finibus. Cras at volutpat ligula. Sed id velit nec leo euismod mollis vitae non sapien. Pellentesque suscipit sollicitudin egestas. Integer fermentum dui augue, ac ultrices magna tempor vel. Pellentesque ullamcorper odio rhoncus enim cursus, facilisis viverra lacus maximus. Proin bibendum vel erat nec congue.
                            </p>

                        </li>

                    </ul>

                    <ul>

                        <h2> Políticas </h2>

                        <li id = "PrivacyPolicy">

                            <h3> Política de Privacidade </h3>

                            <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at tincidunt augue. Sed id metus semper, pellentesque felis at, condimentum mi. Mauris sagittis augue sed ligula hendrerit, in pharetra odio finibus. Cras at volutpat ligula. Sed id velit nec leo euismod mollis vitae non sapien. Pellentesque suscipit sollicitudin egestas. Integer fermentum dui augue, ac ultrices magna tempor vel. Pellentesque ullamcorper odio rhoncus enim cursus, facilisis viverra lacus maximus. Proin bibendum vel erat nec congue.
                            </p>

                        </li>

                        <li id = "CookiesPolicy">

                            <h3> Política de Cookies </h3>

                            <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at tincidunt augue. Sed id metus semper, pellentesque felis at, condimentum mi. Mauris sagittis augue sed ligula hendrerit, in pharetra odio finibus. Cras at volutpat ligula. Sed id velit nec leo euismod mollis vitae non sapien. Pellentesque suscipit sollicitudin egestas. Integer fermentum dui augue, ac ultrices magna tempor vel. Pellentesque ullamcorper odio rhoncus enim cursus, facilisis viverra lacus maximus. Proin bibendum vel erat nec congue.
                            </p>

                        </li>

                    </ul>

                </section>

            </div>

        </main>

        <?php include "include/Footer.php"; ?>
        
        <?php include "include/SideNavBar.php"; ?>
        <?php include "include/HeaderNotification.php"; ?>
        <?php include "include/HeaderConfig.php"; ?>

        <div id = "DarkEffect"></div>

        <?php include "include/Script.php"; ?>

    </body>

</html>