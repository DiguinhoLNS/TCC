<?php session_start(); ?>

<!DOCTYPE html>
<html lang = "pt-br">

	<head>

		<title> Termos </title>
		
		<?php include "include/Head.php"; ?>

	</head>

    <body id = "TermsPage" class = "UNT LightMode">

        <?php 
        
            include "php/Pag.php";
            
            CookieStatus();
            C_Login();

            include "include/Load.php";      

        ?>
        
		<header id = "HeaderAbout">

            <?php include "include/Header.php"; ?>

        </header>

        <main id = "MainTerms">

            <div class = "MainContent">
            
                <section id = "SectionTermsHeader">

                    <h1> Termos APE </h1>
                    
                </section>

                <section id = "SectionTermsMain">

                    <ul>

                        <h2> Licenças </h2>

                        <li id = "License">

                            <h3> Licença Creative Commons </h3>

                            <span>

                                <p> Achados e Perdidos Empresarial está licenciado com uma Licença Creative Commons - Atribuição-NãoComercial-SemDerivações 4.0 Internacional. </p>

                            </span>

                            <span>

                                <a rel = "license" href = "http://creativecommons.org/licenses/by-nc-nd/4.0/" target = "_blank">
                                    <img alt = "Licença Creative Commons" style = "border-width:0" src = "https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png"/>
                                </a> 

                            </span>

                        </li>

                    </ul>

                    <ul>

                        <h2> Termos </h2>

                        <li id = "TermsUse">

                            <h3> Termos de Uso </h3>

                            <span>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at tincidunt augue. Sed id metus semper, pellentesque felis at, condimentum mi. Mauris sagittis augue sed ligula hendrerit, in pharetra odio finibus. Cras at volutpat ligula. Sed id velit nec leo euismod mollis vitae non sapien. Pellentesque suscipit sollicitudin egestas. Integer fermentum dui augue, ac ultrices magna tempor vel. Pellentesque ullamcorper odio rhoncus enim cursus, facilisis viverra lacus maximus. Proin bibendum vel erat nec congue.
                            </span>

                        </li>

                    </ul>

                    <ul>

                        <h2> Políticas </h2>

                        <li id = "PrivacyPolicy">

                            <h3> Política de Privacidade </h3>

                            <span>
                                A sua privacidade é importante para nós. É política do APE respeitar a sua privacidade em relação a qualquer informação sua que possamos coletar no site APE, e outros sites que possuímos e operamos.
                            </span>

                            <span>
                                Solicitamos informações pessoais apenas quando realmente precisamos delas para lhe fornecer um serviço. Fazemo-lo por meios justos e legais, com o seu conhecimento e consentimento. Também informamos por que estamos coletando e como será usado.
                            </span>

                            <span>
                                Apenas retemos as informações coletadas pelo tempo necessário para fornecer o serviço solicitado. Quando armazenamos dados, protegemos dentro de meios comercialmente aceitáveis ​​para evitar perdas e roubos, bem como acesso, divulgação, cópia, uso ou modificação não autorizados.
                            </span>

                            <span>
                                Não compartilhamos informações de identificação pessoal publicamente ou com terceiros, exceto quando exigido por lei.
                            </span>

                            <span>
                                O nosso site pode ter links para sites externos que não são operados por nós. Esteja ciente de que não temos controle sobre o conteúdo e práticas desses sites e não podemos aceitar responsabilidade por suas respectivas políticas de privacidade.
                            </span>

                            <span>
                                Você é livre para recusar a nossa solicitação de informações pessoais, entendendo que talvez não possamos fornecer alguns dos serviços desejados.
                            </span>

                            <span>
                                O uso continuado de nosso site será considerado como aceitação de nossas práticas em torno de privacidade e informações pessoais. Se você tiver alguma dúvida sobre como lidamos com dados do usuário e informações pessoais, entre em contacto connosco.
                            </span>

                        </li>

                        <li id = "CookiesPolicy">

                            <h3> Política de Cookies </h3>

                            <h4> O que são cookies? </h4>

                            <span>
                                Como é prática comum em quase todos os sites profissionais, este site usa cookies, que são pequenos arquivos baixados no seu computador, para melhorar sua experiência. Esta página descreve quais informações eles coletam, como as usamos e por que às vezes precisamos armazenar esses cookies. Também compartilharemos como você pode impedir que esses cookies sejam armazenados, no entanto, isso pode fazer o downgrade ou 'quebrar' certos elementos da funcionalidade do site.
                            </span>

                            <h4> Como usamos os cookies? </h4>

                            <span>
                                Utilizamos cookies por vários motivos, detalhados abaixo. Infelizmente, na maioria dos casos, não existem opções padrão do setor para desativar os cookies sem desativar completamente a funcionalidade e os recursos que eles adicionam a este site. É recomendável que você deixe todos os cookies se não tiver certeza se precisa ou não deles, caso sejam usados ​​para fornecer um serviço que você usa.
                            </span>

                            <h4> Cookies definidos </h4>
                            
                            <h5> Cookies relacionados à conta </h5>

                            <span>
                                Se você criar uma conta connosco, usaremos cookies para o gerenciamento do processo de inscrição e administração geral. Esses cookies geralmente serão excluídos quando você sair do sistema, porém, em alguns casos, eles poderão permanecer posteriormente para lembrar as preferências do seu site ao sair.
                            </span>

                            <h5> Cookies relacionados ao login </h5>

                            <span>
                                Utilizamos cookies quando você está logado, para que possamos lembrar dessa ação. Isso evita que você precise fazer login sempre que visitar uma nova página. Esses cookies são normalmente removidos ou limpos quando você efetua logout para garantir que você possa acessar apenas a recursos e áreas restritas ao efetuar login.
                            </span>

                            <h5> Cookies relacionados a formulários </h5>

                            <span>
                                Quando você envia dados por meio de um formulário como os encontrados nas páginas de contacto ou nos formulários de comentários, os cookies podem ser configurados para lembrar os detalhes do usuário para correspondência futura.
                            </span>

                            <h5> Cookies de preferências do site </h5>

                            <span>
                                Para proporcionar uma ótima experiência neste site, fornecemos a funcionalidade para definir suas preferências de como esse site é executado quando você o usa. Para lembrar suas preferências, precisamos definir cookies para que essas informações possam ser chamadas sempre que você interagir com uma página for afetada por suas preferências.
                            </span>

                        </li>

                    </ul>

                </section>

            </div>

        </main>

        <?php include "include/Footer.php"; ?>
        
        <?php include "include/SideNavBar.php"; ?>
        <?php include "include/HeaderNotification.php"; ?>
        <?php include "include/HeaderConfig.php"; ?>
        <?php include "include/CookiesMessage"; ?>

        <div id = "DarkEffect"></div>

        <?php include "include/Script.php"; ?>

    </body>

</html>