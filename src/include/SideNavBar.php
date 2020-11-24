<?php 

    require_once 'sql/ConexaoBD.php';
    require_once 'sql/Funcoes.php';

    $conn = new ConexaoBD();
    $func = new Funcoes();

    if(isset ($_COOKIE["ID"])){

        $id = $func->Descriptografar($_COOKIE["ID"]);
        
        
        $DadosEmpresas = $func->PegarDadosEmpresaPeloIdUsuario($id);

    }

?> 

<div id = "SideNavBar">

    <nav class = "NavOptions">

        <h1> APE </h1>

        <ul>
            <li id = "SideNavBarOptionHome">
                <a href = "index.php">
                    <i class = "material-icons"> &#xe88a; </i>
                    <span> Home </span>
                </a>
            </li>
            <li id = "SideNavBarOptionDashboard">
                <a href = "Dashboard.php">
                    <i class = "material-icons"> &#xe871; </i>
                    <span> Dashboard </span>
                </a>
            </li>
            <li id = "SideNavBarOptionUser">
                <a href = "User.php">
                    <i class = "material-icons"> &#xe7fd; </i>
                    <span> Usuário </span>
                </a>
            </li>
        </ul>
        <ul>
            <?php

                $i=0; 
                
                if(isset ($_COOKIE["ID"])){

                    if($DadosEmpresas["QuantidadeDeEmpresas"]>0){

                        do{

                            echo '
                                <li>               
                                    <a href = "Feed.php?q='.$func->Criptografar($DadosEmpresas['Dados'][$i]['id_empresa']).'">
                                        <i class = "material-icons"> &#xe0af; </i>
                                        <span>'. $DadosEmpresas['Dados'][$i]['Nome'] .'</span>
                                    </a>                
                                </li>
                            ';

                            $i++;

                        }while($i<$DadosEmpresas["QuantidadeDeEmpresas"]);

                    }
                
                }

            ?>
        </ul>
        
    </nav>

</div>