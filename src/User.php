<?php session_start(); ?>

<!DOCTYPE html>
<html lang = "pt-br">

    <head>

        <title> Usuário </title>

        <?php include "include/Head.php"; ?>

        <?php

            $id = $_SESSION['id'];

            $base = mysqli_connect('localhost', 'root', '', 'ape') or die("erro de conexão");
            $regra = "SELECT nome FROM user_plataforma WHERE id_user_plataforma = '$id'";

            $res = mysqli_query($base, $regra);
            $mostrar = mysqli_fetch_array($res);

        ?>

    </head>

    <body id = "UserPage" class = "UNT LightMode">

        <?php

            include "php/Pag.php";
            V_User();
            C_Login();

            include "include/Load.html";

        ?>

        <header id = "HeaderUser">

            <?php include "include/Header.php"; ?>

        </header>

        <main id = "MainUser">

            <div class = "MainContent">

                <section id = "SectionUserHeader">

                    <div>
                        <h1 id = "DTN"></h1>
                        <h2> <?php echo $mostrar['nome']; ?> </h2>
                    </div>

                </section>

                <section id = "SectionUserConfig">

                    <nav id = "NavUserConfig">

                        <ul>

                            <li id = "UFO1" class = "UserConfigOption active">
                                <i class = "material-icons"> &#xe7fd; </i>
                                <span> Usuário </span>
                            </li>
                            <li id = "UFO2" class = "UserConfigOption">
                                <i class = "material-icons"> &#xe0af; </i>
                                <span> Empresas </span>
                            </li>
                            <li id = "UFO3" class = "UserConfigOption">
                                <i class = "material-icons"> category </i>
                                <span> Itens </span>
                            </li>
                            <li id = "UFO4" class = "UserConfigOption">
                                <i class = "material-icons"> &#xe8b8; </i>
                                <span> Configurações </span>
                            </li>
                            <li id = "UFO5" class = "UserConfigOption">
                                <i class = "material-icons"> &#xe002; </i>
                                <span> Zona de Perigo </span>
                            </li>

                        </ul>

                    </nav>

                    <nav id = "NavUserFrameset">

                        <div id = "UF1" class = "NavUserFrame">

                            <div class = "NavUserFrameContent">

                                <div class = "FrameHeader FrameSection">

                                    <h1> Usuário </h1>

                                </div>

                                <div class = "FrameMain FrameSection">

                                    <ul>

                                        <h1> Perfil </h1>

                                    </ul>

                                    <ul>

                                        <h1> Contato </h1>

                                    </ul>

                                    <ul>

                                        <h1> Segurança </h1>

                                    </ul>

                                </div>

                            </div>

                        </div>

                        <div id = "UF2" class = "NavUserFrame">

                            <div class = "NavUserFrameContent">

                                <div class = "FrameHeader FrameSection">

                                    <h1> Empresas </h1>

                                    <div id = "NavUserViewBoxSwitch" class = "NavUserViewSwitch" title = "Alterar Visualização"> Visualização em Bloco </div>
                                    <div id = "NavUserViewListSwitch" class = "NavUserViewSwitch" title = "Alterar Visualização"> Visualização em Lista </div>

                                </div>

                                <div class = "FrameMain FrameSection">

                                    <ul id = "UserCompaniesView" class = "BoxView">

                                        <li>
                                            <a href = "" title = "Nome da Empresa">
                                                <h1> Nome da Empresa </h1>
                                            </a>
                                        </li>
                                        <li>
                                            <a href = "" title = "Nome da Empresa">
                                                <h1> Nome da Empresa </h1>
                                            </a>
                                        </li>
                                        <li>
                                            <a href = "" title = "Nome da Empresa">
                                                <h1> Nome da Empresa </h1>
                                            </a>
                                        </li>
                                        <li>
                                            <a href = "" title = "Nome da Empresa">
                                                <h1> Nome da Empresa </h1>
                                            </a>
                                        </li>
                                        <li>
                                            <a href = "" title = "Nome da Empresa">
                                                <h1> Nome da Empresa </h1>
                                            </a>
                                        </li>
                                        <li>
                                            <a href = "" title = "Nome da Empresa">
                                                <h1> Nome da Empresa </h1>
                                            </a>
                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                        <div id = "UF3" class = "NavUserFrame">

                            <div class = "NavUserFrameContent">

                                <div class = "FrameHeader FrameSection">

                                    <h1> Itens </h1>

                                </div>

                                <div class = "FrameMain FrameSection">

                                    <ul id = "UserItensView">

                                        <li>
                                            <a href = "">
                                                <div class = "Boximg"></div>
                                                <div class = "BoxInfo">
                                                    <h1> Nome do Item Perdido </h1>
                                                    <h2> Empresa.inc </h2>
                                                    <h3> 10/09/2020 </h3>
                                                </div>
                                            </a>
                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                        <div id = "UF4" class = "NavUserFrame">

                            <div class = "NavUserFrameContent">

                                <div class = "FrameHeader FrameSection">

                                    <h1> Configurações </h1>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultricies orci sit amet quam laoreet, eu efficitur lectus eleifend.
                                    </p>

                                </div>

                                <div class = "FrameMain FrameSection"></div>

                            </div>

                        </div>

                        <div id = "UF5" class = "NavUserFrame">

                            <div class = "NavUserFrameContent">

                                <div class = "FrameHeader FrameSection">

                                    <h1> Configurações Avançadas </h1>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultricies orci sit amet quam laoreet, eu efficitur lectus eleifend.
                                    </p>

                                </div>

                                <div class = "FrameMain FrameSection"></div>

                            </div>

                        </div>

                    </nav>

                </section>

            </div>

        </main>

        <?php include "include/Footer.php"; ?>

        <?php include "include/SideNavBar.php"; ?>
        <?php include "include/HeaderNotification.php"; ?>
        <?php include "include/HeaderConfig.php"; ?>

        <div id = "DarkEffect"></div>

        <script type = "text/javascript">

            var date = new Date();
            var hour = date.getHours();

            if (hour >= 0 && hour < 12) {

                txt = "Bom Dia";

            } else {

                if (hour >= 12 && hour < 18) {

                    txt = "Boa Tarde";

                } else {

                    if (hour >= 18) {

                        txt = "Boa Noite";

                    }

                }

            }

            document.getElementById("DTN").innerHTML = txt;

        </script>

        <?php include "include/Script.php"; ?>

    </body>

</html>