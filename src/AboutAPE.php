<?php session_start(); ?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Sobre </title>
		
		<?php include "include/Head.php"; ?>

	</head>

    <body id = "AboutAPEPage" class = "UNT LightMode">

        <?php 
        
            include "php/Pag.php";
            
            CookieStatus();
            C_Login();

            include "include/Load.php";      

        ?>
        
		<header id = "HeaderAboutAPE">

            <?php include "include/Header.php"; ?>

        </header>

        <main id = "MainAboutAPE">

            <div class = "MainContent">
                    
			    <section id = "SectionAboutAPEHeader">

                    <h1> APE - Achados e Perdidos Empresarial </h1>
                    <a href = "ReleaseNotes.php" id = "AboutReleaseNotes" class = "ReleaseNotes"> Notas de Versão </a>

                </section>

                <section id = "SectionAboutAPEMain">

                    <h2> Plataforma APE </h2>

                    <ul class = "TextBox">

                        <li class = "TextContent">

                            <h3> Sobre Nós </h3>

                            <p>
                                Somos um grupo de amigos, estudantes do ensino médio integrado com o curso técnico de informática da ETEC da Zona Leste entre os anos de 2018 e 2020.
                            </p>

                        </li>

                        <li class = "TextContent">

                            <h3> Sobre o projeto </h3>

                            <p>
                                Este projeto foi realizado com a intenção de ser o nosso trabalho de conclusão de curso de informática. Foi desenvolvido no segundo semestre de 2020 
                                com a orientação de professores da ETEC da Zona Leste, com o nosso esforço e muitas noites de trabalho pesado.
                            </p>

                        </li>

                    </ul>

                    <ul class = "TextBox">

                        <li class = "TextContent">

                            <h3> Nossos Termos </h3>

                            <p>
                                Leia sobre os nossos Termos, Políticas e Licenças.
                            </p>

                        </li>

                        <li>

                            <button>
                                <a href = "Terms.php"> Termos </a>
                            </button>

                        </li>

                    </ul>

                </section>

                <section id = "SectionAboutAPEDevelopers">

                    <h2> Desenvolvedores </h2>

                    <ul class = "DeveloperBox">

                        <li class = "DeveloperPhoto">

                            <span>
                                <h1> L </h1>
                            </span>

                        </li>

                        <li class = "TextContent">

                            <h3> Luís Gustavo </h3>

                            <p>
                                Vulgo LG, amante de PHP. Dono da mágica por trás do site, ou seja, o Back-end. ENFP<br>
                                †ℐℋ𝒮†
                            </p>

                            <ul class = "DeveloperSocialBar SocialIconsBar">

                                <li>
                                    <a href = "https://www.facebook.com/gustavo.dasilvafeitoza/" class = "IconFacebook" target = "_blank">
                                        <i class = "fab"> &#xf09a; </i>
                                    </a>
                                </li>
                                <li>
                                    <a href = "https://www.instagram.com/luisfeitoza07/?hl=pt-br" class = "IconInstagram" target = "_blank">
                                        <i class = "fab"> &#xf16d; </i>
                                    </a>
                                </li>
                                <li>
                                    <a href = "https://twitter.com/__User__Name" class = "IconTwitter" target = "_blank">
                                        <i class = "fab"> &#xf099; </i>
                                    </a>
                                </li>
                                <li>
                                    <a href = "https://github.com/luiys" class = "IconGithub" target = "_blank">
                                        <i class = "fab"> &#xf09b; </i>
                                    </a>
                                </li>

                            </ul>

                        </li>

                    </ul>

                    <ul class = "DeveloperBox">

                        <li class = "DeveloperPhoto">

                            <span>
                                <h1> M </h1>
                            </span>

                        </li>

                        <li class = "TextContent">

                            <h3> Marcos Augusto </h3>

                            <p>
                                Amante da Gastronomia, Genética e Redes, responsável pela documentação e auxiliar de design do site. ENFP
                            </p>

                            <ul class = "DeveloperSocialBar SocialIconsBar">

                                <li>
                                    <a href = "#" class = "IconFacebook" target = "_blank">
                                        <i class = "fab"> &#xf09a; </i>
                                    </a>
                                </li>
                                <li>
                                    <a href = "#" class = "IconInstagram" target = "_blank">
                                        <i class = "fab"> &#xf16d; </i>
                                    </a>
                                </li>
                                <li>
                                    <a href = "#" class = "IconTwitter" target = "_blank">
                                        <i class = "fab"> &#xf099; </i>
                                    </a>
                                </li>
                                <li>
                                    <a href = "#" class = "IconPinterest" target = "_blank">
                                        <i class = "fab"> &#xf0d2; </i>
                                    </a>
                                </li>
                                <li>
                                    <a href = "" class = "IconReddit" target = "_blank">
                                        <i class = "fab"> &#xf1a1; </i>
                                    </a>
                                </li>
                                <li>
                                    <a href = "#" class = "IconLinkedin" target = "_blank">
                                        <i class = "fab"> &#xf08c; </i>
                                    </a>
                                </li>
                                <li>
                                    <a href = "" class = "IconGithub" target = "_blank">
                                        <i class = "fab"> &#xf09b; </i>
                                    </a>
                                </li>

                            </ul>

                        </li>

                    </ul>

                    <ul class = "DeveloperBox">

                        <li class = "DeveloperPhoto">

                            <span>
                                <h1> R </h1>
                            </span>

                        </li>

                        <li class = "TextContent">

                            <h3> Rodrigo Lima </h3>

                            <p>
                                Fã de programação e design, estou cursando ensino técnico de informática integrado ao ensino médio na ETEC ZL. Desenvolveu o Front-end da plataforma. ISTJ
                            </p>

                            <ul class = "DeveloperSocialBar SocialIconsBar">

                                <li>
                                    <a href = "https://www.facebook.com/profile.php?id=100023668262483" class = "IconFacebook" target = "_blank">
                                        <i class = "fab"> &#xf09a; </i>
                                    </a>
                                </li>
                                <li>
                                    <a href = "https://www.instagram.com/diguinho_lns/" class = "IconInstagram" target = "_blank">
                                        <i class = "fab"> &#xf16d; </i>
                                    </a>
                                </li>
                                <li>
                                    <a href = "https://twitter.com/Diguinho_lns" class = "IconTwitter" target = "_blank">
                                        <i class = "fab"> &#xf099; </i>
                                    </a>
                                </li>
                                <li>
                                    <a href = "https://github.com/DiguinhoLNS" class = "IconGithub" target = "_blank">
                                        <i class = "fab"> &#xf09b; </i>
                                    </a>
                                </li>

                            </ul>

                        </li>

                    </ul>

                    <ul class = "DeveloperBox">

                        <li class = "DeveloperPhoto">

                            <span>
                                <h1> T </h1>
                            </span>

                        </li>

                        <li class = "TextContent">

                            <h3> Tiago Barbosa </h3>

                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a blandit dolor. Phasellus et massa dignissim, egestas libero eu, facilisis risus. Praesent vulputate magna lacus, nec egestas lorem sodales sit.
                            </p>

                            <ul class = "DeveloperSocialBar SocialIconsBar">

                                <li>
                                    <a href = "https://www.facebook.com/marcosaugusto.quiuqui.1" class = "IconFacebook" target = "_blank">
                                        <i class = "fab"> &#xf09a; </i>
                                    </a>
                                </li>
                                <li>
                                    <a href = "https://www.instagram.com/marcosaquiuqui/" class = "IconInstagram" target = "_blank">
                                        <i class = "fab"> &#xf16d; </i>
                                    </a>
                                </li>
                                <li>
                                    <a href = "https://twitter.com/marcosaquiuqui" class = "IconTwitter" target = "_blank">
                                        <i class = "fab"> &#xf099; </i>
                                    </a>
                                </li>

                            </ul>

                        </li>

                    </ul>

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