<?php
session_start();
?>

<div id="HeaderConfig" class="BS">

    <nav class="NavOptions">

        <?php

        $id = $_SESSION['id'];

        $base = mysqli_connect('localhost', 'root', '', 'ape') or die("erro de conexão");
        $regra = "SELECT nome FROM user_plataforma WHERE id_user_plataforma = '$id'";

        $res = mysqli_query($base, $regra);
        $mostrar = mysqli_fetch_array($res);
        ?>

        <h1>
            <?php  echo $mostrar['nome']; ?>
        </h1>

        <ul>
            <li>
                <a href="User.php">
                    <i class="material-icons"> &#xe7fd; </i>
                    <span> Usuário </span>
                </a>
            </li>
        </ul>
        <ul>
            <li>
                <a href="Config.php">
                    <i class="material-icons"> &#xe8b8; </i>
                    <span> Configurações </span>
                </a>
            </li>
            <li class="DarkModeSwitch">
                <a>
                    <i class="material-icons"> &#xe3a9; </i>
                    <span> Tema Escuro </span>
                </a>
            </li>
            <li class="LightModeSwitch">
                <a>
                    <i class="material-icons"> &#xe3aa; </i>
                    <span> Tema Claro </span>
                </a>
            </li>
        </ul>
        <ul>
            <li id="EndUserSession">
                <a>
                    <i class="material-icons"> login </i>
                    <span> Encerrar sessão </span>
                </a>
            </li>
        </ul>

    </nav>

</div>