<?php 

    session_start();
    date_default_timezone_set('America/Sao_Paulo'); 
    
    include 'sql/ConexaoBD.php';
    include "sql/Funcoes.php";

    $base = mysqli_connect('localhost', 'root', '', 'bdape')or die("Erro de conexão");

    if(isset($_COOKIE["ID"])){

        $id = $_COOKIE["ID"];

        $regra1 = "SELECT * FROM empresas inner join user_empresa on 'id_empresa' = 'id_empresa' where user_empresa.id_user = $id and empresas.id_empresa = user_empresa.id_empresa order by Nome ASC";
        $res = mysqli_query($base, $regra1) or die("Erro na consultaDB");

        while($mostrar = mysqli_fetch_array($res)){

            $rows[] = $mostrar;

        }

        $linhas = $res->num_rows;


    }

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
                            <?php 
                            
                                if($linhas==0){

                                    echo '<li class = "NoFor"> Você não possui nenhuma empresa! </li>';
                            
                                }else{
                                    $i=0;
                                    do{

                                        $cnpj = ColocarPontoCNPJ($rows[$i]['CNPJ']);
                                        
                                        echo "
                                        
                                            <li class = 'Box ". $rows[$i]['Cor_layout']."'>
                                            
                                                <a href = 'Company.php?q=".$rows[$i]['id_empresa']."' title =' ".$i."'>
                                                    <h1> ". utf8_encode($rows[$i]['Nome']) ."</h1>
                                                    <h2> ". $cnpj." </h2>
                                                    <h3> ". $rows[$i]['Telefone'] ."</h3>
                                                </a>                      
                                                
                                            </li>
                                            
                                        ";

                                        $i++;

                                    }while($i<($linhas));

                                }
                            
                            ?>
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
