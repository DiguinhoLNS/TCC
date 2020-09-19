<?php

    // Id Usuário
    function ID_User(){

        if(!isset($_SESSION["id"])){

            include "EndUserSession.php";

            header("Location: Login.php");

        }

    }

    // Verifica Usuário
    function V_User(){

        if(!isset($_COOKIE["ULogged"])){

            header("Location: Login.php");
    
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

?>