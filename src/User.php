<?php 

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    require_once 'sql/ConexaoBD.php';
    require_once "sql/Funcoes.php";

    $conn = new ConexaoBD();
	$func = new Funcoes();

    $_SESSION['TipoVerificação'] = 'Usuario';

    $id = base64_decode($_COOKIE["ID"]);

    $DadosEmpresas = $func->PegarDadosEmpresaPeloIdUsuario($id);
                    
    $DadosUsuario =  $func->PegarDadosUsuarioPeloId($id);

    $DataSeparada = $func->SepararData($DadosUsuario[0]['Data_nasc_user']);

    $cpf = $func->ColocarPontoCPF($DadosUsuario[0]['CPF_user']);

    
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
            CookieStatus();
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
                        <h2> <?php echo utf8_encode($DadosUsuario[0]['Nome_user']); ?> </h2>
                    </div>

                </section>

                <section id = "SectionUserConfig" class = "SectionPlatformPanel">

                    <nav id = "NavUserConfig" class = "NavBarControl">

                        <ul>

                            <li id = "UFO1" class = "NavListOption active">
                                <i class = "material-icons"> &#xe7fd; </i>
                                <span> Usuário </span>
                            </li>
                            <li id = "UFO2" class = "NavListOption">
                                <i class = "material-icons"> &#xe0af; </i>
                                <span> Empresas </span>
                            </li>
                            <li id = "UFO3" class = "NavListOption">
                                <i class = "material-icons"> category </i>
                                <span> Itens </span>
                            </li>
                            <li id = "UFO4" class = "NavListOption">
                                <i class = "material-icons"> &#xe8b8; </i>
                                <span> Configurações </span>
                            </li>

                        </ul>

                    </nav>

                    <nav id = "NavUserFrameset" class = "NavFrameset">

                        <div id = "UF1" class = "NavFrame">

                            <div class = "NavFrameContent">

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
                                                    <h2> <?php echo utf8_encode($DadosUsuario[0]['Nome_user']); ?> </h2>
                                                </div>

                                            </div>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">
                                                    <h1> CPF </h1>
                                                    <h2> <?php echo $cpf; ?> </h2>
                                                </div>

                                            </div>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText"">
                                                    <h1> Gênero </h1>
                                                    <h2> <?php echo $DadosUsuario[0]['Genero_user']; ?> </h2>
                                                </div>

                                            </div>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">
                                                    <h1> Data de Nascimento </h1>
                                                    <h2> <?php echo $DataSeparada["dia"] . "/" . $DataSeparada["mes"] . "/" . $DataSeparada["ano"] ?> </h2>
                                                </div>

                                            </div>

                                        </li>

                                        <li class = Category>

                                            <h1 class = "HeaderCategory"> Contato </h1>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">
                                                    <h1> Email </h1>
                                                    <h2> <?php echo $DadosUsuario[0]['Email_user']; ?> </h2>
                                                </div>

                                            </div>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">
                                                    <h1> Telefone de contato </h1>
                                                    <h2> <?php echo $DadosUsuario[0]['Telefone_user']; ?> </h2>
                                                </div>

                                            </div>

                                        </li>

                                        <li class = Category>

                                            <h1 class = "HeaderCategory"> Segurança </h1>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">
                                                    <h1> ID APE </h1>
                                                    <h2> <?php echo $DadosUsuario[0]['id_user']; ?> </h2>
                                                </div>

                                            </div>

                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                        <div id = "UF2" class = "NavFrame">

                            <div class = "NavFrameContent">

                                <div class = "FrameHeader FrameSection">

                                    <h1> Empresas </h1>

                                    <div id = "NavUserViewBoxSwitch" class = "NavUserViewSwitch" title = "Alterar Visualização"> Visualização em Bloco </div>
                                    <div id = "NavUserViewListSwitch" class = "NavUserViewSwitch" title = "Alterar Visualização"> Visualização em Lista </div>

                                </div>

                                <div class = "FrameMain FrameSection">

                                    <ul id = "UserCompaniesView" class = "BoxView">
                                        <?php

                                            $i=0;

                                            if($DadosEmpresas["QuantidadeDeEmpresas"]>0){

                                                do{
                                                    echo '
                                                        <li>
                                                            <a href = "Company.php?q='.base64_encode($DadosEmpresas['Dados'][$i]['id_empresa']).'" title = "'. $DadosEmpresas['Dados'][$i]['Nome']. '">
                                                                <h1> '. utf8_encode($DadosEmpresas['Dados'][$i]['Nome']). ' </h1>
                                                            </a>
                                                        </li>
                                                    ';

                                                    $i++;
                                                    
                                                }while($i<$DadosEmpresas["QuantidadeDeEmpresas"]);

                                            }
                                            
                                        ?>
                                    </ul>

                                </div>

                            </div>

                        </div>

                        <div id = "UF3" class = "NavFrame">

                            <div class = "NavFrameContent">

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

                        <div id = "UF4" class = "NavFrame">

                            <div class = "NavFrameContent">

                                <div class = "FrameHeader FrameSection">

                                    <h1> Configurações </h1>

                                </div>

                                <div class = "FrameMain FrameSection">

                                    <ul class = "DataCategory">

                                        <li class = "Category">

                                            <h1 class = "HeaderCategory"> Conta </h1>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">

                                                    <h1> Editar perfil </h1>
                                                    <h2> Editar os dados do seu perfil </h2>

                                                </div>

                                                <div class = "btnContent">

                                                    <button class = "btnOption">
                                                        <a href = "EditUser.php"> Editar Perfil </a>
                                                    </button>

                                                </div>

                                            </div>

                                        </li>

                                        <li class = "Category">

                                            <h1 class = "HeaderCategory"> Plataforma </h1>

                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">

                                                    <h1> Alterar tema </h1>
                                                    <h2> Mudar tema do layout da página </h2>

                                                </div>

                                                <div class = "btnContent">

                                                    <button class = "btnOption LightModeSwitch">
                                                        <a> Tema Claro </a>
                                                    </button>
                                                    <button class = "btnOption DarkModeSwitch">
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

                                                    <button class = "btnOption">
                                                        <a href = "EndUserSession"> Encerrar Sessão </a>
                                                    </button>

                                                </div>

                                            </div>

                                        </li>

                                        <li class = "Category CategoryDanger">

                                            <h1 class = "HeaderCategory"> Zona de Perigo </h1>
                                                                
                                            <div class = "CategoryOptions">

                                                <div class = "CategoryText">

                                                    <h1> Apagar Conta </h1>
                                                    <h2> Apagar a sua conta em nossa plataforma </h2>

                                                </div>

                                                <div class = "btnContent">

                                                    <button class = "bntDanger">
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
        <?php include "include/CookieMessage.php"; ?>

        <div id = "DarkEffect"></div>

        <?php include "include/Script.php"; ?>

    </body>

</html>