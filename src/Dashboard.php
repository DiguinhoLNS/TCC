<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Dashboard </title>
		
        <?php include "include/Head.php"; ?>
        
        <?php

            include "php/C_Login.php"; 
            C_Login();

            include "php/Pag.php";
            V_User();

        ?>

	</head>

	<body id = "DashboardPage" class = "UNT LightMode">
    
        <header id = "HeaderDashboard">

            <?php include "include/Header.php"; ?>

        </header>

        <main id = "MainDashboard">

            <div class = "MainContent">

                <section id = "SectionDashboardHeader">

                    <h1> Dashboard </h1>

                </section>

                <section id = "SectionDashboardItems">
                
                    <nav>

                        <ul id = "DashboardBoxContent">

                            <li class = "NoFor"> Você não possui nenhuma empresa! </li>
                            
                            <li class = "BoxSpace">
                
                                <div class = "Box">
                                    <a href = "Feed.php" title = "Nome da Empresa">
                                        <div class = "CompanyImage"></div>
                                        <h1> Nome da Empresa </h1>
                                        <h2> Empresa.inc </h2>
                                        <h3> (XX) XXXX-XXXX </h3>
                                    </a>
                                </div>
                            
                            </li>

                        </ul>

                    </nav>
                
                </section>

                <button id = "btnDashboardControl">
                    <i class = "material-icons"> &#xe145; </i>
                </button>

                <div id = "DashboardControlPane" class = "BS">

                    <h1> Páginas </h1>

                    <ul>
                        <li id = "LoginFeed">
                            <a href = "">
                                <i class = "material-icons"> login </i>
                                <span> Entrar em página </span>
                            </a>
                        </li>
                        <li id = "AddFeed">   
                            <a href = "">          
                                <i class = "material-icons"> &#xe145; </i>
                                <span> Criar página </span>
                            </a>               
                        </li>
                    </ul>

                </div>

            </div>

        </main>

        <?php include "include/Footer.php"; ?>
        
        <?php include "include/SideNavBar.php"; ?>
        <?php include "include/HeaderNotification.php"; ?>
        <?php include "include/HeaderConfig.php"; ?>

        <div id = "DarkEffect"></div>
    
    </body>

</html>
