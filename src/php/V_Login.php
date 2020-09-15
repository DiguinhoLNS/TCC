<?php

    setcookie("ULogged", "1", time() + (86400 * 30), "/");

    header("Location: ../Index.php");

?>