<?php session_start(); include 'sql/ConexaoBD.php';

    $id = $_COOKIE["ID"];
    $base = mysqli_connect('localhost', 'root', '', 'bdape') or die("erro de conexão");
    $regra1 = "SELECT * FROM empresas where id_adm =  '$id' ";
    $res = mysqli_query($base, $regra1) or die("Erro na consulta");
    $mostrar = mysqli_fetch_array($res);
    $linhas = $res->num_rows;

?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Dashboard </title>
		
        <?php include "include/Head.php"; ?>

	</head>

	<body id = "DashboardPage" class = "UNT LightMode">

        <?php

            include "php/Pag.php";

            StopUserAccess();
            V_User();
            C_Login();

            include "include/Load.php";

        ?>
    
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

                            <?php if($linhas==0){

                            echo '<li class = "NoFor"> Você não possui nenhuma empresa! </li>';
                        
                                }else{

                                    $i=0;

                                    do{   


                            echo '
                            
                            <li class = "Box ThemeDefault">
                               
                                <a href = "" title = "Nome da Empresa">
                                    <h1> '. $linhas .'</h1>
                                    <h2> cnpj </h2>
                                    <h3> (XX) XXXX-XXXX </h3>
                                </a>                      
                                 
                            </li>';

                            $i++;
                                    }while($i!=$linhas);
                            }?>

                        </ul>

                    </nav>
                
                </section>

                <button id = "btnDashboardControl">
                    <i class = "material-icons"> &#xe145; </i>
                </button>

                <div id = "DashboardControlPane" class = "BS">

                    <h1> Páginas </h1>

                    <ul>
                        <li>
                            <a href = "LoginCompany.php">
                                <i class = "material-icons"> login </i>
                                <span> Entrar em página </span>
                            </a>
                        </li>
                        <li>   
                            <a href = "RegisterCompany.php">          
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

        <?php include "include/Script.php"; ?>
    
    </body>

</html>
