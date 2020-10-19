<?php 

    session_start();
    
?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Sobre </title>
		
		<?php include "include/Head.php"; ?>

	</head>

    <body id = "AboutPage" class = "UNT LightMode">

        <?php 
        
            include "php/Pag.php";
            
            C_Login();

            include "include/Load.php";      

        ?>
        
		<header id = "HeaderAbout">

            <?php include "include/Header.php"; ?>

        </header>

        <main id = "MainAbout">

            <div class = "MainContent">
                    
			    <section id = "SectionAboutHeader">

                    <h1> APE </h1>

                </section>

                <section id = "SectionAboutMain">

                    <h2> Plataforma APE </h2>

                    <ul class = "TextBox">

                        <li class = "TextContent">

                            <h3> Título da Sessão </h3>

                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultricies orci sit amet quam laoreet, eu efficitur lectus eleifend.
                            </p>

                        </li>

                        <li class = "TextContent">

                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultricies orci sit amet quam laoreet, eu efficitur lectus eleifend.
                            </p>

                        </li>

                    </ul>

                    <ul class = "TextBox">

                        <li class = "TextContent">

                            <h3> Título da Sessão </h3>

                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultricies orci sit amet quam laoreet, eu efficitur lectus eleifend.
                            </p>

                        </li>

                        <li class = "TextContent">

                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultricies orci sit amet quam laoreet, eu efficitur lectus eleifend.
                            </p>

                        </li>

                    </ul>

                </section>

                <section id = "SectionAboutDevelopers">

                    <h2> Desenvolvedores </h2>

                    <ul class = "DeveloperBox">

                        <li class = "DeveloperPhoto">

                            <span></span>

                        </li>

                        <li class = "TextContent">

                            <h3> Luís Gustavo </h3>

                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a blandit dolor. Phasellus et massa dignissim, egestas libero eu, facilisis risus. Praesent vulputate magna lacus, nec egestas lorem sodales sit.
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

                            <span></span>

                        </li>

                        <li class = "TextContent">

                            <h3> Marcos Augusto </h3>

                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a blandit dolor. Phasellus et massa dignissim, egestas libero eu, facilisis risus. Praesent vulputate magna lacus, nec egestas lorem sodales sit.
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

                            <span></span>

                        </li>

                        <li class = "TextContent">

                            <h3> Rodrigo Lima </h3>

                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a blandit dolor. Phasellus et massa dignissim, egestas libero eu, facilisis risus. Praesent vulputate magna lacus, nec egestas lorem sodales sit.
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

                            <span></span>

                        </li>

                        <li class = "TextContent">

                            <h3> Tiago Barbosa </h3>

                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a blandit dolor. Phasellus et massa dignissim, egestas libero eu, facilisis risus. Praesent vulputate magna lacus, nec egestas lorem sodales sit.
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

                </section>

            </div>

        </main>

        <?php include "include/Footer.php"; ?>
        
        <?php include "include/SideNavBar.php"; ?>
        <?php include "include/HeaderNotification.php"; ?>
        <?php include "include/HeaderConfig.php"; ?>

        <div id = "DarkEffect"></div>

        <?php include "include/Script.php"; ?>

    </body>

</html>