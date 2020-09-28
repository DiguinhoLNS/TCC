<?php session_start(); ?>

<!DOCTYPE html>
<html lang = "pt-br">

    <head>

        <title> Conta APE </title>

        <?php include "include/Head.php"; ?>

        <?php

            $id = $_COOKIE["ID"];

            $base = mysqli_connect('localhost', 'root', '', 'ape') or die("erro de conexão");
            $regra = "SELECT nome, CPF, data_nasc, email, celular, telefone, senha_plataforma, id_user_plataforma FROM user_plataforma WHERE id_user_plataforma = '$id'";

            $res = mysqli_query($base, $regra);
            $mostrar = mysqli_fetch_array($res);

            list($ano, $mes, $dia) = explode('-', $mostrar['data_nasc']);

        ?>

    </head>

    <body id = "UserPage" class = "UNT LightMode">

        <?php

            include "php/Pag.php";

            V_User();
            C_Login();

            include "include/Load.php";

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

                        </ul>

                    </nav>

                    <nav id = "NavUserFrameset">

                        <div id = "UF1" class = "NavUserFrame">

                            <div class = "NavUserFrameContent">

                                <div class = "FrameHeader FrameSection">

                                    <h1> Usuário </h1>

                                </div>

                                <div class = "FrameMain FrameSection">

                                    <ul class = "DataCategory">

                                        <li class = "Category">

                                            <h1 class = "HeaderCategory"> Perfil </h1>

                                            <div class = "LeftContent">

                                                <div class = "DataContent">
                                                    <h1> Nome </h1>
                                                    <h2> <?php echo $mostrar['nome']; ?> </h2>
                                                </div>
                                                <div class = "DataContent">
                                                    <h1> CPF </h1>
                                                    <h2> <?php echo $mostrar['CPF']; ?> </h2>
                                                </div>
                                                <div class = "DataContent">
                                                    <h1> Gênero </h1>
                                                    <h2> Masculino / Feminino / Outro </h2>
                                                </div>
                                                <div class = "DataContent">
                                                    <h1> Data de Nascimento </h1>
                                                    <h2> <?php echo $dia . "/" . $mes . "/" . $ano ?> </h2>
                                                </div>

                                            </div>

                                            <div class = "RightContent">

                                                <h1> Informações sobre o usuário </h1>

                                            </div>

                                        </li>

                                        <li class = Category>

                                            <h1 class = "HeaderCategory"> Contato </h1>

                                            <div class = "LeftContent">

                                                <div class = "DataContent">
                                                    <h1> Email </h1>
                                                    <h2> <?php echo $mostrar['email']; ?> </h2>
                                                </div>
                                                <div class = "DataContent">
                                                    <h1> Telefone </h1>
                                                    <h2> <?php echo $mostrar['celular']; ?> </h2>
                                                </div>

                                            </div>

                                            <div class = "RightContent">

                                                <h1> Informações de contato do usuário </h1>

                                            </div>

                                        </li>

                                        <li class = Category>

                                            <h1 class = "HeaderCategory"> Segurança </h1>

                                            <div class = "LeftContent">

                                                <div class = "DataContent">
                                                    <h1> ID APE </h1>
                                                    <h2> <?php echo $mostrar['id_user_plataforma']; ?> </h2>
                                                </div>
                                                <div class = "DataContent">
                                                    <h1> Senha </h1>
                                                    <h2 id = "DataPlaceholderPWD"> Exibir Senha </h2>
                                                    <h2 id = "DataPWD"> <?php echo $mostrar['senha_plataforma']; ?> </h2>
                                                </div>

                                            </div>

                                            <div class = "RightContent">

                                                <h1> Informações de segurança </h1>

                                            </div>

                                        </li>

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

                                    <ul id = "UserItensView" class = "ItensView">

                                        <li>
                                            <a href = "">
                                                <div class = "ItenImg"></div>
                                                <div class = "ItenText">
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

                                </div>

                                <div class = "FrameMain FrameSection">

                                    <ul id = "ConfigCategory">

                                        <li id = "ConfigAccount" class = "Category">

                                            <h1 class = "HeaderCategory"> Conta </h1>

                                            <div class = "UserOptions">

                                                <div class = "UserText">

                                                    <h1> Editar perfil </h1>
                                                    <h2> Editar os dados do seu perfil </h2>

                                                </div>

                                                <div class = "btnContent">

                                                    <button>
                                                        <a href = "EditUser.php/?edit=profile"> Editar Perfil </a>
                                                    </button>

                                                </div>

                                            </div>

                                            <div class = "UserOptions">

                                                <div class = "UserText">

                                                    <h1> Editar contato </h1>
                                                    <h2> Editar os seus dados de contato </h2>

                                                </div>

                                                <div class = "btnContent">

                                                    <button>
                                                        <a href = "EditUser.php/?edit=contact"> Editar Contato </a>
                                                    </button>

                                                </div>

                                            </div>

                                            <div class = "UserOptions">

                                                <div class = "UserText">

                                                    <h1> Editar segurança </h1>
                                                    <h2> Editar os seus dados de segurança </h2>

                                                </div>

                                                <div class = "btnContent">

                                                    <button>
                                                        <a href = "EditUser.php/?edit=security"> Editar Segurança </a>
                                                    </button>

                                                </div>

                                            </div>

                                        </li>

                                        <li id = "ConfigPlatform" class = "Category">

                                            <h1 class = "HeaderCategory"> Plataforma </h1>

                                            <div class = "UserOptions">

                                                <div class = "UserText">

                                                    <h1> Alterar tema </h1>
                                                    <h2> Mudar tema do layout da página </h2>

                                                </div>

                                                <div class = "btnContent">

                                                    <button class = "LightModeSwitch">
                                                        <a> Tema Claro </a>
                                                    </button>
                                                    <button class = "DarkModeSwitch">
                                                        <a> Tema Escuro </a>
                                                    </button>

                                                </div>

                                            </div>

                                            <div class = "UserOptions">

                                                <div class = "UserText">

                                                    <h1> Encerrar sessão </h1>
                                                    <h2> Encerrar sessão na plataforma e voltar para a página principal </h2>

                                                </div>

                                                <div class = "btnContent">

                                                    <button>
                                                        <a href = "EndUserSession"> Encerrar Sessão </a>
                                                    </button>

                                                </div>

                                            </div>

                                        </li>

                                        <li id = "ConfigDangerZone" class = "Category">

                                            <h1 class = "HeaderCategory"> Zona de Perigo </h1>

                                            <div class = "UserOptions">

                                                <div class = "UserText">

                                                    <h1> Apagar dados </h1>
                                                    <h2> Apagar os seus dados e histórico em nossa base de dados </h2>

                                                </div>

                                                <div class = "btnContent">

                                                    <button>
                                                        <a href = ""> Apagar Dados </a>
                                                    </button>

                                                </div>

                                            </div>

                                            <div class = "UserOptions">

                                                <div class = "UserText">

                                                    <h1> Encerrar Conta </h1>
                                                    <h2> Apagar a conta e todos os seus dados em nossa base de dados </h2>

                                                </div>

                                                <div class = "btnContent">

                                                    <button>
                                                        <a href = ""> Encerrar Conta </a>
                                                    </button>

                                                </div>

                                            </div>

                                        </li>

                                    </ul>

                                </div>

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