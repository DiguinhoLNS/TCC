<?php

    setcookie("ULogged", "", time() - (86400 * 30), "/");

    header("Location: ../Index.php");

?>