<?php

    CloseSession();

    function CloseSession(){

        setcookie("ULogged", "", time() - (86400 * 30), "/");

        header("Location: ../Login.php");

    }    

?>