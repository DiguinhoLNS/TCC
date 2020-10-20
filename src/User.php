<?php 

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    include 'sql/ConexaoBD.php';

    $base = mysqli_connect('localhost', 'root', '', 'bdape')or die("Erro de conexão");

    $_SESSION['V'] = '1';

    if(isset($_COOKIE["ID"])){

        $id = $_COOKIE["ID"];

        $regra = "SELECT * FROM empresas inner join user_empresa on 'id_empresa' = 'id_empresa' where user_empresa.id_user = $id and empresas.id_empresa = user_empresa.id_empresa order by Nome ASC";
        $res = mysqli_query($base, $regra) or die("Erro na consulta");
    
        while($mostrar = mysqli_fetch_array($res)){
    
            $rows[] = $mostrar;
    
        }
    
        $linhas = $res->num_rows;
                    
        $regra1 = "SELECT Nome_user, CPF_user, Data_nasc_user, Email_user, Telefone_user, Genero_user, Senha_user, id_user FROM usuarios WHERE id_user = '$id'";
    
        $res1 = mysqli_query($base, $regra1);
        $mostrar1 = mysqli_fetch_array($res1);
    
        list($ano, $mes, $dia) = explode('-', $mostrar1['Data_nasc_user']);

    }
?>

<!DOCTYPE html>
<html lang = "pt-br">

    <head>

        <title> Conta APE </title>

        <?php include "include/Head.php"; ?>

    </head>

    <body id = "UserPage" class = "UNT LightMode">

        <?php

            include "php/Pag.php";

            StopUserAccess();
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
                        <h2> <?php echo $mostrar1['Nome_user']; ?> </h2>
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

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">
                                                    <h1> Nome </h1>
                                                    <h2> <?php echo $mostrar1['Nome_user']; ?> </h2>
                                                </div>

                                            </div>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">
                                                    <h1> CPF </h1>
                                                    <h2> <?php echo $mostrar1['CPF_user']; ?> </h2>
                                                </div>

                                            </div>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText"">
                                                    <h1> Gênero </h1>
                                                    <h2> <?php echo $mostrar1['Genero_user']; ?> </h2>
                                                </div>

                                            </div>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">
                                                    <h1> Data de Nascimento </h1>
                                                    <h2> <?php echo $dia . "/" . $mes . "/" . $ano ?> </h2>
                                                </div>

                                            </div>

                                        </li>

                                        <li class = Category>

                                            <h1 class = "HeaderCategory"> Contato </h1>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">
                                                    <h1> Email </h1>
                                                    <h2> <?php echo $mostrar1['Email_user']; ?> </h2>
                                                </div>

                                            </div>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">
                                                    <h1> Telefone de contato </h1>
                                                    <h2> <?php echo $mostrar1['Telefone_user']; ?> </h2>
                                                </div>

                                            </div>

                                        </li>

                                        <li class = Category>

                                            <h1 class = "HeaderCategory"> Segurança </h1>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">
                                                    <h1> ID APE </h1>
                                                    <h2> <?php echo $mostrar1['id_user']; ?> </h2>
                                                </div>

                                            </div>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">
                                                    <h1> Senha </h1>
                                                    <h2 id = "DataPlaceholderPWD"> Exibir Senha </h2>
                                                    <h2 id = "DataPWD"> <?php echo $mostrar1['Senha_user']; ?> </h2>
                                                </div>

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
                                        <?php

                                            $i=0;

                                            if($linhas>0){

                                                do{
                                                    echo '
                                                        <li>
                                                            <a href = "Company.php?q='.$rows[$i]['id_empresa'].'" title = "'. $rows[$i]['Nome']. '">
                                                                <h1> '. $rows[$i]['Nome']. ' </h1>
                                                            </a>
                                                        </li>
                                                    ';

                                                    $i++;
                                                    
                                                }while($i<$linhas);

                                            }
                                            
                                        ?>
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

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">

                                                    <h1> Editar perfil </h1>
                                                    <h2> Editar os dados do seu perfil </h2>

                                                </div>

                                                <div class = "btnContent">

                                                    <button>
                                                        <a href = "EditUser.php/?edit=profile"> Editar Perfil </a>
                                                    </button>

                                                </div>

                                            </div>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">

                                                    <h1> Editar contato </h1>
                                                    <h2> Editar os seus dados de contato </h2>

                                                </div>

                                                <div class = "btnContent">

                                                    <button>
                                                        <a href = "EditUser.php/?edit=contact"> Editar Contato </a>
                                                    </button>

                                                </div>

                                            </div>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">

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

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">

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

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">

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

                                        <li id = "ConfigDangerZone" class = "Category CategoryDanger">

                                            <h1 class = "HeaderCategory"> Zona de Perigo </h1>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">

                                                    <h1> Apagar dados </h1>
                                                    <h2> Apagar os seus dados e o seu histórico em nossa plataforma </h2>

                                                </div>

                                                <div class = "btnContent">

                                                    <button>
                                                        <a href = ""> Apagar Dados </a>
                                                    </button>

                                                </div>

                                            </div>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">

                                                    <h1> Apagar Conta </h1>
                                                    <h2> Apagar a sua conta em nossa plataforma </h2>

                                                </div>

                                                <div class = "btnContent">

                                                    <button>
                                                        <a href = "sql/ApagarCadastros.php"> Apagar Conta </a>
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