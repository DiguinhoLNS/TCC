<?php session_start(); ?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Notas de Atualização </title>
		
		<?php include "include/Head.php"; ?>

	</head>

    <body id = "ReleaseNotesPage" class = "UNT LightMode">

        <?php 
        
            include "php/Pag.php";
            
            CookieStatus();
            C_Login();

            include "include/Load.php";      

        ?>
        
		<header id = "HeaderReleaseNotes">

            <?php include "include/Header.php"; ?>

        </header>

        <main id = "MainReleaseNotes">

            <div class = "MainContent">

                <section id = "SectionReleaseNotesHeader">

                    <h1> Notas de Atualização </h1>

                </section>

                <section id = "SectionReleaseNotesMain">

                    <div class = "ReleaseNotesVersionHeader">

                        <h2> APE </h2>
                        <h3> 0.6.4 </h3>

                    </div>

                    <ul id = "ReleaseNotesGroup">

                        <li id = "NewFeatures" class = "ReleaseNotesBox">

                            <h1> Novos Recursos </h1>

                            <ul class = "ReleaseNotesContent">

                                <li class = "ReleaseNotesText">

                                    <h2> Título da att </h2>

                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at tincidunt augue. Sed id metus semper, pellentesque felis at, condimentum mi. Mauris sagittis augue sed ligula hendrerit, in pharetra odio finibus. Cras at volutpat ligula. Sed id velit nec leo euismod mollis vitae non sapien. Pellentesque suscipit sollicitudin egestas. Integer fermentum dui augue, ac ultrices magna tempor vel. Pellentesque ullamcorper odio rhoncus enim cursus, facilisis viverra lacus maximus. Proin bibendum vel erat nec congue.
                                    </p> 

                                </li>

                                <li class = "ReleaseNotesText">

                                    <h2> Título da att </h2>

                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at tincidunt augue. Sed id metus semper, pellentesque felis at, condimentum mi. Mauris sagittis augue sed ligula hendrerit, in pharetra odio finibus. Cras at volutpat ligula. Sed id velit nec leo euismod mollis vitae non sapien. Pellentesque suscipit sollicitudin egestas. Integer fermentum dui augue, ac ultrices magna tempor vel. Pellentesque ullamcorper odio rhoncus enim cursus, facilisis viverra lacus maximus. Proin bibendum vel erat nec congue.
                                    </p> 

                                </li>

                            </ul>

                        </li>

                        <li id = "Updates" class = "ReleaseNotesBox">

                            <h1> Atualizações </h1>

                            <ul class = "ReleaseNotesContent">

                                <li class = "ReleaseNotesText">

                                    <h2> Título da att </h2>

                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at tincidunt augue. Sed id metus semper, pellentesque felis at, condimentum mi. Mauris sagittis augue sed ligula hendrerit, in pharetra odio finibus. Cras at volutpat ligula. Sed id velit nec leo euismod mollis vitae non sapien. Pellentesque suscipit sollicitudin egestas. Integer fermentum dui augue, ac ultrices magna tempor vel. Pellentesque ullamcorper odio rhoncus enim cursus, facilisis viverra lacus maximus. Proin bibendum vel erat nec congue.
                                    </p> 

                                </li>

                                <li class = "ReleaseNotesText">

                                    <h2> Título da att </h2>

                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at tincidunt augue. Sed id metus semper, pellentesque felis at, condimentum mi. Mauris sagittis augue sed ligula hendrerit, in pharetra odio finibus. Cras at volutpat ligula. Sed id velit nec leo euismod mollis vitae non sapien. Pellentesque suscipit sollicitudin egestas. Integer fermentum dui augue, ac ultrices magna tempor vel. Pellentesque ullamcorper odio rhoncus enim cursus, facilisis viverra lacus maximus. Proin bibendum vel erat nec congue.
                                    </p> 

                                </li>

                            </ul>

                        </li>

                        <li id = "FixedErrors" class = "ReleaseNotesBox">

                            <h1> Erros Corrigidos </h1>

                            <ul class = "ReleaseNotesContent">

                                <li class = "ReleaseNotesText">

                                    <h2> Título da att </h2>

                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at tincidunt augue. Sed id metus semper, pellentesque felis at, condimentum mi. Mauris sagittis augue sed ligula hendrerit, in pharetra odio finibus. Cras at volutpat ligula. Sed id velit nec leo euismod mollis vitae non sapien. Pellentesque suscipit sollicitudin egestas. Integer fermentum dui augue, ac ultrices magna tempor vel. Pellentesque ullamcorper odio rhoncus enim cursus, facilisis viverra lacus maximus. Proin bibendum vel erat nec congue.
                                    </p> 

                                </li>

                                <li class = "ReleaseNotesText">

                                    <h2> Título da att </h2>

                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at tincidunt augue. Sed id metus semper, pellentesque felis at, condimentum mi. Mauris sagittis augue sed ligula hendrerit, in pharetra odio finibus. Cras at volutpat ligula. Sed id velit nec leo euismod mollis vitae non sapien. Pellentesque suscipit sollicitudin egestas. Integer fermentum dui augue, ac ultrices magna tempor vel. Pellentesque ullamcorper odio rhoncus enim cursus, facilisis viverra lacus maximus. Proin bibendum vel erat nec congue.
                                    </p> 

                                </li>

                            </ul>

                        </li>

                    </ul>

                </section>

            </div>

        </main>

        <?php include "include/Footer.php"; ?>
        
        <?php include "include/SideNavBar.php"; ?>
        <?php include "include/HeaderNotification.php"; ?>
        <?php include "include/HeaderConfig.php"; ?>
        <?php include "include/CookieMessage.php"; ?>

        <div id = "DarkEffect"></div>

        <?php include "include/Script.php"; ?>

    </body>

</html>