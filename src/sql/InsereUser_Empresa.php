<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    require_once "ConexaoBD.php";
    require_once "Funcoes.php";

    $conn = new ConexaoBD();
	$func = new Funcoes();

    $tipo_verificacao = $_SESSION['TipoVerificação'];

    switch ($tipo_verificacao) {

        //(LOGANDO NA EMPRESA) Usuario nivel de acesso 2
        case "Usuario":

            $codigo_acesso = $func->ClearInjectionXSS(base64_decode($_GET['q']));
            $id_user = $func->ClearInjectionXSS($func->Descriptografar($_COOKIE["ID"]));

            $DadosEmpresa = $func->PegarDadosEmpresaPeloCodigo($codigo_acesso);

            $query = "INSERT INTO user_empresa (id_user, id_empresa, Nivel_acesso, Banido) VALUES";
            $query .= " (:id_user, :id_empresa , :nivel_acesso, :banido) ";

            try{

                $sql = $conn->dbh->prepare($query);
                $sql->execute([':id_user' => $id_user, ':id_empresa' => $DadosEmpresa['id_empresa'], ':nivel_acesso' => '2', ':banido' => 'N' ]);
                header("Location: ../Feed.php?q=".base64_encode($DadosEmpresa["id_empresa"]));

            }catch(PDOException $e){
                die("Erro no SQL");
            }


        break;

        //(CRIANDO A EMPRESA) Usuario nivel de acesso 4
        case "Empresa":

            $codigo_acesso = $func->ClearInjectionXSS(base64_decode($_GET['q']));
            $id_adm = $func->ClearInjectionXSS($func->Descriptografar($_COOKIE["ID"]));

            $DadosEmpresa = $func->PegarDadosEmpresaPeloId_Codigo($id_adm, $codigo_acesso);

            var_dump($codigo_acesso);

            $query = "INSERT INTO user_empresa (id_user, id_empresa, Nivel_acesso, Banido) VALUES";
            $query .= " (:id_adm, :id_empresa , :nivel_acesso, :banido) ;";
            
            try{

                $sql = $conn->dbh->prepare($query);
                $sql->execute([':id_adm' => $id_adm, ':id_empresa' => $DadosEmpresa[0]['id_empresa'], ':nivel_acesso' => '4', ':banido' => 'N' ]);
                header("Location: ../Feed.php?q=".$func->Criptografar($DadosEmpresa[0]["id_empresa"]));

            }catch(PDOException $e){
                die("Erro no SQL") ;
            }

        break;

    }
