<?php 

    session_start();
    date_default_timezone_set('America/Sao_Paulo'); 
    
    require_once 'sql/ConexaoBD.php';
    require_once "sql/Funcoes.php";

    $conn = new ConexaoBD();
	$func = new Funcoes();

    if(isset($_COOKIE["ID"])){

        $id = $func->Descriptografar($_COOKIE["ID"]);;
        

        $DadosEmpresas = $func->PegarDadosEmpresaPeloIdUsuario($id);

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
            CookieStatus();
            C_Login();
            setcookie("VerificaErro", "0", time() + (86400 * 30), "/");
            
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
                            
                                if($DadosEmpresas["QuantidadeDeEmpresas"]==0){

                                    echo '<li class = "NoFor"> Você não possui nenhuma empresa! </li>';
                            
                                }else{
                                    $i=0;
                                    do{

                                        $cnpj = $func->ColocarPontoCNPJ($DadosEmpresas['Dados'][$i]['CNPJ']);
                                        
                                        

                                        if($DadosEmpresas['Dados'][$i]['Nivel_acesso'] == 4 and $DadosEmpresas['Dados'][$i]['Situacao'] == "Desativada"){
                                            echo " <li class = 'Box ". $DadosEmpresas['Dados'][$i]['Cor_layout']." desactive'>";
                                        }else{
                                            echo " <li class = 'Box ". $DadosEmpresas['Dados'][$i]['Cor_layout']."'>";
                                        }

                                            echo "
                                            
                                                <a href = 'Feed.php?q=". $func->Criptografar($DadosEmpresas['Dados'][$i]['id_empresa'])."'>
                                                    <h1> ". $DadosEmpresas['Dados'][$i]['Nome'] ."</h1>
                                                    <h2> ". $DadosEmpresas['Dados'][$i]['Telefone'] ."</h2>
                                                    
                                                    ";

                                                    if($DadosEmpresas['Dados'][$i]['Nivel_acesso'] == 4 and $DadosEmpresas['Dados'][$i]['Situacao'] == "Desativada"){
                                                        echo "<h3> Desativada </h3>";
                                                    }

                                                    echo "

                                                </a>                      
                                                
                                            </li>
                                            
                                        ";

                                        $i++;

                                    }while($i<($DadosEmpresas["QuantidadeDeEmpresas"]));

                                }
                            
                            ?>
                        </ul>

                    </nav>
                
                </section>

                <button id = "btnDashboardControl" class = "btnControl">
                    <i class = "material-icons"> &#xe145; </i>
                </button>

                <div id = "DashboardControlPane" class = "ControlPane BS">

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
        <?php include "include/CookieMessage.php"; ?>

        <div id = "DarkEffect"></div>

        <?php include "include/Script.php"; ?>
    
    </body>

</html>
