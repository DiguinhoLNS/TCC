<?php

    function V_User(){

        if(!isset($_COOKIE["ULogged"])){

            header("Location: Login.php");
    
        }

    }

?>