<?php

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