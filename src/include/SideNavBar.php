<?php //session_start(); 
    include 'sql/ConexaoBD.php';
    if(isset ($_COOKIE["ID"])){
        $id = $_COOKIE["ID"];
    $base = mysqli_connect('localhost', 'root', '', 'bdape') or die("erro de conexão");
    $regra1 = "SELECT * FROM empresas inner join user_empresa on 'id_empresa' = 'id_empresa' where user_empresa.id_user = $id and empresas.id_empresa = user_empresa.id_empresa order by Nome ASC";
    $res = mysqli_query($base, $regra1) or die("Erro na consulta");

    while($mostrar = mysqli_fetch_array($res)){
    $rows[] = $mostrar;
    }

    $linhas = $res->num_rows;
    }
?> 

<div id = "SideNavBar">

    <nav class = "NavOptions">

        <h1> APE </h1>

        <ul>
            <li>
                <a href = "Index.php">
                    <i class = "material-icons"> &#xe88a; </i>
                    <span> Home </span>
                </a>
            </li>
            <li>
                <a href = "Dashboard.php">
                    <i class = "material-icons"> &#xe871; </i>
                    <span> Dashboard </span>
                </a>
            </li>
            <li>
                <a href = "User.php">
                    <i class = "material-icons"> &#xe7fd; </i>
                    <span> Usuário </span>
                </a>
            </li>
        </ul>
        <ul>
            
            <?php $i=0; if(isset ($_COOKIE["ID"])){if($linhas>0){do{ echo '
            <li>               
                <a href = "Company.php?q='.$rows[$i]['id_empresa'].'">
                    <i class = "material-icons"> &#xe0af; </i>
                    <span>'. $rows[$i]['Nome'] .'</span>
                </a>                
            </li>'
            ;$i++;}while($i<$linhas);}}?>
        </ul>
        
    </nav>

</div>