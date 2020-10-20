<?php session_start(); include 'sql/ConexaoBD.php';

    $id = $_COOKIE["ID"];
    $base = mysqli_connect('localhost', 'root', '', 'bdape') or die("erro de conexão");
    $regra1 = "SELECT * FROM empresas where id_adm =  '$id' ORDER BY Nome ASC ";
    $res = mysqli_query($base, $regra1) or die("Erro na consulta");

    while($mostrar = mysqli_fetch_array($res)){
    $rows[] = $mostrar;
    }

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

                                    //$i1=-1;
                                    $i=0;

                                    /*for($i1=0;$i1!=($linhas);$i1++){
                                    $nomes = array($i1 => print_r($rows[$i1]['Nome']));
                                    $cnpjs = array($i1 =>print_r($rows[$i1]['CNPJ']));
                                    $telefones = array($i1 =>print_r($rows[$i1]['Telefone']));
                                    }*/
                                    $nome1 =  $rows[$i]['Nome'];

                                    do{   
                                        

                            echo( "
                            
                            <li class = 'Box ". $rows[$i]['Cor_layout']."'>
                               
                                <a href = 'Company.php?q=".$rows[$i]['id_empresa']."' title =' ".$i."'>
                                    <h1> ". $rows[$i]['Nome'] ."</h1>
                                    <h2> ". $rows[$i]['CNPJ']." </h2>
                                    <h3> ". $rows[$i]['Telefone'] ."</h3>
                                </a>                      
                                 
                            </li>");

                            $i++;
                                    }while($i<($linhas));
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
