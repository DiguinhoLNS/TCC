<div id = "HeaderConfig" class = "BS">

    <nav class = "NavOptions">

        <h1>
            <?php
           
                if(isset($_COOKIE["ID"])){

                    $id = $func->Descriptografar($_COOKIE["ID"]);
                    if($id == "false"){
                        die("Para de tentar hackear o site");
                    }

                    $query = "SELECT nome_user FROM usuarios WHERE id_user = '$id'";

                    $ResultadoQuery = $conn->dbh->query($query);
                    $UserName = $ResultadoQuery->fetchAll();

                    echo $UserName[0]['nome_user'];

                }
                
            ?>
        </h1>

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
            <li class = "DarkModeSwitch">
                <a>
                    <i class = "material-icons"> &#xe3a9; </i>
                    <span> Tema Escuro </span>
                </a>
            </li>
            <li class = "LightModeSwitch">
                <a>
                    <i class = "material-icons"> &#xe3aa; </i>
                    <span> Tema Claro </span>
                </a>
            </li>
        </ul>
        <ul>
            <li id = "EndUserSession">
                <a>
                    <i class = "material-icons"> login </i>
                    <span> Encerrar sessão </span>
                </a>
            </li>
        </ul>

    </nav>

</div>