<?php

    CloseSession();

    function CloseSession(){

        setcookie("ULogged", "", time() - (86400 * 30), "/");
        setcookie("ID", "", time() - (86400 * 30), "/");

        header("Location: ../../Index.php");

    }    

?>