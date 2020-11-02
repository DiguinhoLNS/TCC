<?php

date_default_timezone_set('America/Sao_Paulo');

function EncerrarSessao()
{

    setcookie("ULogged", "", time() - (86400 * 30), "/");
    setcookie("ID", "", time() - (86400 * 30), "/");

    header("Location: ../Index.php");
}

function SepararData($DataJunta)
{

    list($ano, $mes, $dia) = explode('-', $DataJunta);

    $DataSeparda = [
        "ano" => $ano,
        "mes" => $mes,
        "dia" => $dia
    ];

    return $DataSeparda;
}

function ColocarPontoCPF($cpfSemPonto)
{
    $cpf =  substr_replace($cpfSemPonto, ".", 3, 0);
    $cpf =  substr_replace($cpf, ".", 7, 0);
    $cpf =  substr_replace($cpf, "-", 11, 0);

    return $cpf;
}

function TirarPontoCPF($CpfComPonto)
{
    $pontuacao = array(".", "-");
    $cpf = str_replace($pontuacao, "", $CpfComPonto);
    $_SESSION['cpfsemponto'] = $cpf;

    return $cpf;
}


function ColocarPontoCNPJ($cnpjSemPonto)
{
    $cnpj =  substr_replace($cnpjSemPonto, '.', 2, 0);
    $cnpj =  substr_replace($cnpj, '.', 6, 0);
    $cnpj =  substr_replace($cnpj, '/', 10, 0);
    $cnpj =  substr_replace($cnpj,  '-', 15, 0);

    return $cnpj;
}

function TirarPontoCNPJ($CnpjComPonto)
{
    $pontuacao = array(".", "-", "/");
    $cnpj = str_replace($pontuacao, "", $CnpjComPonto);
    $_SESSION['cnpjsemponto'] = $cnpj;

    return $cnpj;
}

function VerificarNomeOBJ($nome)
{

    if (strlen($nome) <= 2) {
        return true;
    }
    return false;
}

function VerificarCadastroNome($nome)
{
    if (strlen($nome) <= 2) {
        return true;
    } else if (strlen($nome) > 2) {

        for ($i = 0; $i < strlen($nome); $i++) {
            if (ord($nome[$i]) > 32 && ord($nome[$i]) < 65 || ord($nome[$i]) > 90 && ord($nome[$i]) < 96 || ord($nome[$i]) > 122 && ord($nome[$i]) < 126) {
                return true;
            }
        }
    }

    return false;
}

function VerificaCPF($cpf)
{

    $soma1 = 0;
    $soma2 = 0;
    $digitoVerificadorUm = 0;
    $digitoVerificadorDois = 0;

    if (empty($cpf) || strlen($cpf) < 11) {

        return true;
    }

    for ($i = 0; $i < 11; $i++) {

        if (ord($cpf[$i]) < 48 || ord($cpf[$i]) > 57) {
            return true;
        }
    }


    $soma1 = ($cpf[0] * 10) + ($cpf[1] * 9) + ($cpf[2] * 8) + ($cpf[3] * 7) + ($cpf[4] * 6) + ($cpf[5] * 5) + ($cpf[6] * 4) + ($cpf[7] * 3) + ($cpf[8] * 2);
    $digitoVerificadorUm = 11 - ($soma1 % 11);

    if ($digitoVerificadorUm > 9) {

        $digitoVerificadorUm = 0;
    }

    $soma2 = ($cpf[0] * 11) + ($cpf[1] * 10) + ($cpf[2] * 9) + ($cpf[3] * 8) + ($cpf[4] * 7) + ($cpf[5] * 6) + ($cpf[6] * 5) + ($cpf[7] * 4) + ($cpf[8] * 3) + ($digitoVerificadorUm * 2);
    $digitoVerificadorDois = 11 - ($soma2 % 11);

    if ($digitoVerificadorDois > 9) {

        $digitoVerificadorDois = 0;
    }

    //verificadores
    return $digitoVerificadorUm != $cpf[9] || $digitoVerificadorDois != $cpf[10] ? true : false;
}

function VerificaCNPJ($cnpj)
{

    $soma1 = 0;
    $soma2 = 0;
    $digitoVerificadorUm = 0;
    $digitoVerificadorDois = 0;

    if (empty($cnpj) || strlen($cnpj) < 14) {

        return true;
    }

    for ($i = 0; $i < 14; $i++) {

        if (ord($cnpj[$i]) < 48 || ord($cnpj[$i]) > 57) {

            return true;
        }
    }


    $soma1 = ($cnpj[0] * 5) + ($cnpj[1] * 4) + ($cnpj[2] * 3) + ($cnpj[3] * 2) + ($cnpj[4] * 9) + ($cnpj[5] * 8) + ($cnpj[6] * 7) + ($cnpj[7] * 6) + ($cnpj[8] * 5) + ($cnpj[9] * 4) + ($cnpj[10] * 3) + ($cnpj[11] * 2);
    $digitoVerificadorUm = 11 - ($soma1 % 11);

    if ($digitoVerificadorUm > 9) {

        $digitoVerificadorUm = 0;
    }

    $soma2 = ($cnpj[0] * 6) + ($cnpj[1] * 5) + ($cnpj[2] * 4) + ($cnpj[3] * 3) + ($cnpj[4] * 2) + ($cnpj[5] * 9) + ($cnpj[6] * 8) + ($cnpj[7] * 7) + ($cnpj[8] * 6) + ($cnpj[9] * 5) + ($cnpj[10] * 4) + ($cnpj[11] * 3) + ($cnpj[12] * 2);
    $digitoVerificadorDois = 11 - ($soma2 % 11);

    if ($digitoVerificadorDois > 9) {

        $digitoVerificadorDois = 0;
    }

    //verificadores
    return $digitoVerificadorUm != $cnpj[12] || $digitoVerificadorDois != $cnpj[13] ? true : false;
}

function VerificaData($data)
{

    list($ano, $mes, $dia) = explode('-', $data);
    return $ano >= date("Y") ? true : false;
}

function VerificaTelefone($telefone)
{
    return strlen($telefone) <= 13 ? true : false;
}

function VerificarEndereco($endereco)
{

    $possiveis = array("rua", "avenida", "rodovia", "alameda", "viela", "travessa", "beco", "estrada");

    for ($i = 0; $i < 8; $i++) {

        $achou = strpos(strtolower($endereco), $possiveis[$i]);

        return $achou !== false ? false : true;
    }
}

function VerificaSenha($senha)
{

    $i = 0;
    $maiusculas = false;
    $minusculas = false;
    $numeros = false;
    $tamanhoSenha = strlen($senha);

    do {

        if (ord($senha[$i]) >= 65 && ord($senha[$i]) <= 90) {

            $maiusculas = true;
            $i++;
        } else if (ord($senha[$i]) >= 97 && ord($senha[$i]) <= 122) {

            $minusculas = true;
            $i++;
        } else if (ord($senha[$i]) >= 48 && ord($senha[$i]) <= 57) {

            $numeros = true;
            $i++;
        } else {
            return true;
        }
    } while ($i < $tamanhoSenha);

    return $minusculas && $maiusculas && $numeros ? false : true;
}


//Querys usadas no VerificaCadastro.php
function VerificarSeUsuarioJaCadastrado($base, $email, $cpf)
{
    $query = "SELECT Email_user, CPF_user FROM usuarios where Email_user =  '$email' or CPF_user = '$cpf'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 1");
    $QuantidadeDeCadastros = $ResultadoQuery->num_rows;

    return !empty($QuantidadeDeCadastros) ? true : false;
}

function VerificarSeEmpresaJaCadastrada($base, $email, $cnpj)
{
    $query = "SELECT Email, CNPJ FROM empresas where Email =  '$email' or CNPJ = '$cnpj'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 2");
    $QuantidadeDeCadastros = $ResultadoQuery->num_rows;

    return $QuantidadeDeCadastros;
}

//Querys usadas no Company.php
function PegarDadosEmpresaPeloIdEmpresa($base, $id_empresa)
{
    $query = "SELECT * FROM empresas where id_empresa =  '$id_empresa'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 3");
    $DadosEmpresa = mysqli_fetch_array($ResultadoQuery);

    return $DadosEmpresa;
}

function PegarDadosUserEmpresaPeloIdUserIdEmpresa($base, $id_user, $id_empresa)
{
    $query = "SELECT * FROM user_empresa where id_user =  '$id_user' and id_empresa = $id_empresa";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 4");
    $DadosUserEmpresa = mysqli_fetch_array($ResultadoQuery);

    return $DadosUserEmpresa;
}

//Querys usadas no VerificaLogin
function PegarDadosUsuarioPeloEmailSenha($base, $email, $senha)
{

    $query = "SELECT Email_user, Senha_user, id_user FROM usuarios where Email_user =  '$email'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 5");
    $DadosUsuario = mysqli_fetch_array($ResultadoQuery);
    $EmailExiste = $ResultadoQuery->num_rows;

    if ($EmailExiste == 1) {
        if (password_verify($senha, $DadosUsuario["Senha_user"])) {
            $UsuarioExiste = true;
        }
    } else if ($EmailExiste == 0) {
        $UsuarioExiste = false;
    }

    $Dados = array(
        "id_user" => $DadosUsuario['id_user'],
        "UsuarioExiste" => $UsuarioExiste
    );

    return $Dados;
}

function PegarDadosEmpresaPeloCodigo($base, $codigo_acesso)
{
    $query = "SELECT codigo_acesso, id_empresa FROM empresas where codigo_acesso =  '$codigo_acesso'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 6");
    $DadosEmpresa = mysqli_fetch_array($ResultadoQuery);

    $CodigoExiste = (empty($ResultadoQuery->num_rows)) ? false : true;

    $Dados = array(
        "CodigoExiste" => $CodigoExiste,
        "id_empresa" => $DadosEmpresa['id_empresa']
    );

    return $Dados;
}

function VerificarSeUsuarioJaFezLoginAntes($base, $codigo_acesso, $id_user)
{
    $query = "SELECT * FROM user_empresa inner join empresas on 'id_empresa' = 'id_empresa' where empresas.codigo_acesso = '$codigo_acesso' and user_empresa.id_user = $id_user and user_empresa.id_empresa = empresas.id_empresa";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 7");
    $DadosUserEmpresa = mysqli_fetch_array($ResultadoQuery);
    $QuantidadeDeLoginsJaFeitos = $ResultadoQuery->num_rows;

    return $QuantidadeDeLoginsJaFeitos;
}

function PegarDadosEmpresaPeloId_Codigo($base, $id_adm, $codigo_acesso)
{
    $query = "SELECT id_adm, id_empresa FROM empresas where id_adm =  $id_adm and codigo_acesso = '$codigo_acesso'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 8 " . $id_adm . " " . $codigo_acesso);
    $DadosEmpresa = mysqli_fetch_array($ResultadoQuery);

    return $DadosEmpresa;
}

function PegarDadosUsuarioPeloId($base, $id)
{
    $query = "SELECT * FROM usuarios WHERE id_user = '$id'";

    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 9");
    $DadosUsuario = mysqli_fetch_array($ResultadoQuery);

    return $DadosUsuario;
}

function PegarDadosEmpresaPeloIdUsuario($base, $id)
{

    $query = "SELECT * FROM empresas inner join user_empresa on 'id_empresa' = 'id_empresa' where user_empresa.id_user = $id and empresas.id_empresa = user_empresa.id_empresa order by Nome ASC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 10");
    $QuantidadeDeEmpresas = $ResultadoQuery->num_rows;

    if ($QuantidadeDeEmpresas > 0) {
        while ($UmaEmpresa = mysqli_fetch_array($ResultadoQuery)) {
            $TodasEmpresas[] = $UmaEmpresa;
        }
    } else {
        $TodasEmpresas = null;
    }


    $Empresas = [

        "Dados" => $TodasEmpresas,
        "QuantidadeDeEmpresas" => $QuantidadeDeEmpresas

    ];

    return $Empresas;
}

function ClearInjectionXSS($base, $input)
{

    $input = mysqli_real_escape_string($base, $input);
    $input = htmlspecialchars($input);
    return $input;
}

function VerificarFoto($foto)
{

    $foto = $_FILES["foto"];
    list($tipo, $extensao) = explode("/", $foto["type"]);

    $tipo = strtolower($tipo);
    $extensao = strtolower($extensao);

    $extensoesPossiveis = ["jpg", "jpeg", "png"];

    return in_array($extensao, $extensoesPossiveis) && $tipo == "image" ?  false :  true;
}

function PegarDadosItemPeloIdEmpresa($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa =  '$id_empresa' order by Nome_obj ASC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 11");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function PegarDadosItemPeloId($base, $id)
{

    $query = "SELECT * FROM objetos inner join empresas on empresas.id_empresa = objetos.id_empresa where id_obj = '$id'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 11");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function PegarDocumentos($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa =  '$id_empresa' and Categoria = 'Documento'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 12");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function PegarRoupas($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa =  '$id_empresa' and Categoria = 'Roupa'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 13");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function PegarEletronicos($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa =  '$id_empresa' and Categoria = 'Eletrônico'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 14");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function PegarAcessorios($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa =  '$id_empresa' and Categoria = 'Acessório'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 15");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function PegarOutros($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa =  '$id_empresa' and Categoria = 'Outros'";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 17");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function AcessoriosAZ($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Acessório' order by Nome_obj ASC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 22");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function AcessoriosZA($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Acessório' order by Nome_obj DESC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 23");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function AcessoriosAntigo($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Acessório' order by Data_cadastro ASC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 24");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function AcessoriosRecente($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Acessório' order by Data_cadastro DESC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 24");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function DocumentosAZ($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Documento' order by Nome_obj ASC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 25");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function DocumentosZA($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Documento' order by Nome_obj DESC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 26");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function DocumentosAntigo($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Documento' order by Data_cadastro ASC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 27");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function DocumentosRecente($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Documento' order by Data_cadastro DESC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 28");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function EletronicosAZ($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Eletrônico' order by Nome_obj ASC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 29");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function EletronicosZA($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Eletrônico' order by Nome_obj DESC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 30");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function EletronicosAntigo($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Eletrônico' order by Data_cadastro ASC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 31");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function EletronicosRecente($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Eletrônico' order by Data_cadastro DESC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 32");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function RoupasAZ($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Roupa' order by Nome_obj ASC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 33");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function RoupasZA($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Roupa' order by Nome_obj DESC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 34");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function RoupasAntigo($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Roupa' order by Data_cadastro ASC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 35");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function RoupasRecente($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Roupa' order by Data_cadastro DESC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 36");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function OutrosAZ($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Outros' order by Nome_obj ASC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 37");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function OutrosZA($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Outros' order by Nome_obj DESC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 38");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function OutrosAntigo($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Outros' order by Data_cadastro ASC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 39");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}

function OutrosRecente($base, $id_empresa)
{

    $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Outros' order by Data_cadastro DESC";
    $ResultadoQuery = mysqli_query($base, $query) or die("Erro na consulta 40");
    $QuantidadeDeObjetos = $ResultadoQuery->num_rows;

    if ($QuantidadeDeObjetos > 0) {
        while ($DadosObjetos = mysqli_fetch_array($ResultadoQuery)) {
            $TodosObjetos[] = $DadosObjetos;
        }
    }

    if (isset($TodosObjetos)) {
        $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
            "Objeto" => $TodosObjetos
        ];
        return $Dados;
    } else {
        return $Dados = [
            "Quantidade" => $QuantidadeDeObjetos,
        ];
    }
}
