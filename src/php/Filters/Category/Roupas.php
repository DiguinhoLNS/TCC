<?php

    require_once '../../../sql/Funcoes.php';
    require_once '../../../sql/ConexaoBD.php';

    $conn = new ConexaoBD();
    $func = new Funcoes();

    $id_empresa = $func->Descriptografar($_COOKIE["ID_Company"]);