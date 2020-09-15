<?php

    function V_User(){

        if(!isset($_COOKIE["ULogged"])){

            header("Location: Login.php");
    
        }

    }

    function addUserError($n){

        $RegisterReturnError[$n] = "1";

    }

    function setError($S1, $S2, $S3, $S4, $S5, $S6, $S8){

        if($S1 == "1"){ $_SESSION["UserRegisterError_1"] = "1"; }

        if($S2 == "1"){ $_SESSION["UserRegisterError_2"] = "1"; }

        if($S3 == "1"){ $_SESSION["UserRegisterError_3"] = "1"; }

        if($S4 == "1"){ $_SESSION["UserRegisterError_4"] = "1"; }

        if($S5 == "1"){ $_SESSION["UserRegisterError_5"] = "1"; }

        if($S6 == "1"){ $_SESSION["UserRegisterError_6"] = "1"; }

        if($S8 == "1"){ $_SESSION["UserRegisterError_8"] = "1"; }

    }

    function V_UserRegister(){}

?>