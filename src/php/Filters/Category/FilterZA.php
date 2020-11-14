<?php

    include '../../../sql/ConexaoBD.php';
    include_once '../../../sql/Funcoes.php';

    $id_empresa = $func->Criptografar($_COOKIE["ID_Company"]);

?>