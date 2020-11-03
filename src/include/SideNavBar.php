<?php 

    include 'sql/ConexaoBD.php';
    include_once 'sql/Funcoes.php';

    if(isset ($_COOKIE["ID"])){

        $id = base64_decode($_COOKIE["ID"]);
        
        $DadosEmpresas = PegarDadosEmpresaPeloIdUsuario($base, $id);

    }

?> 

<div id = "SideNavBar">

    <nav class = "NavOptions">

        <h1> APE </h1>

        <ul>
            <li id = "SideNavBarOptionHome">
                <a href = "Index.php">
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
                                    <a href = "Company.php?q='.base64_encode($DadosEmpresas['Dados'][$i]['id_empresa']).'">
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