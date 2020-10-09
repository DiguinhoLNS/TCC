<?php

    // Id Usuário
    function ID_User(){

        if(!isset($_COOKIE["ID"])){

            include "EndUserSession.php"; header("Location: Index.php");

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

?>