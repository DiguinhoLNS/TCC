<?php

    // Cookies Status
    function CookieStatus(){

        if(isset($_COOKIE["CookiesStatus"])){

            if($_COOKIE["CookiesStatus"] == "0"){

                echo '
            
                    <script language = "javascript" type = "text/javascript">
                                
                        $(document).ready(function(){

                            $(".BottomMessage").css("bottom", "0px");

                        });
                    
                    </script> 
                
                ';

            }

        }else{

            setcookie("CookiesStatus", "0", time() + (86400 * 30), "/");

            echo '
            
                <script language = "javascript" type = "text/javascript">
                            
                    $(document).ready(function(){

                        $(".BottomMessage").css("bottom", "0px");

                    });
                
                </script> 
            
            ';

        }

    }

    // Negar uso da plataforma caso usuário negue os cookies
    function StopUserAccess(){

        if(isset($_COOKIE["CookiesStatus"])){

            if($_COOKIE["CookiesStatus"] == "0"){

                header("Location: index.php");

            }

        }else{

            setcookie("CookiesStatus", "0", time() + (86400 * 30), "/");

            header("Location: index.php");

        }

    }

    // Id Usuário
    function ID_User(){

        if(!isset($_COOKIE["ID"])){

            include "EndUserSession.php";

        }

    }

    // Verifica Usuário
    function V_User(){

        if(!isset($_COOKIE["ULogged"])){

            header("Location: LoginUser.php");
    
        }

    }

    // Cookie Usuário
    function C_LOGIN(){

        if(!isset($_COOKIE["ULogged"])){

            echo '
                
                <script language = "javascript" type = "text/javascript">
                        
                    $(document).ready(function(){

                        $("body").removeClass("UIL").addClass("UNT");

                    });
                
                </script> 

            ';

        }else{

            echo '
                
                <script language = "javascript" type = "text/javascript">
                
                    $(document).ready(function(){

                        $("body").removeClass("UNT").addClass("UIL");

                    });
                
                </script>

            ';

        }

    }

    function addNotification(){

        echo '
    
            <li class = "NotificationBox">
                <i class = "material-icons"> &#xe645; </i>
                <span> txt </span>
            </li>
        
        ';

    }
