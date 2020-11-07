<?php

class Funcoes extends ConexaoBD
{

    //date_default_timezone_set('America/Sao_Paulo');

    public function GerarCodigoAcesso()
    {

        $rand = rand(1, 100);
        $salt = bin2hex(md5(sha1(random_bytes($rand))));
        $str = crypt($salt, null);
        $str = strtoupper($str);
        $str2 = str_split($str, 12);

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $LetraAleatoria = '';
        $LetraAleatoria = $characters[rand(0, 25)];

        $ParaTirar = ["/", "."];
        $codigo_acesso = str_replace($ParaTirar, $LetraAleatoria, $str2[1]);

        return $codigo_acesso;
    }

    public function EncerrarSessao()
    {

        setcookie("ULogged", "", time() - (86400 * 30), "/");
        setcookie("ID", "", time() - (86400 * 30), "/");

        header("Location: ../Index.php");
    }

    public function SepararData($DataJunta)
    {

        list($ano, $mes, $dia) = explode('-', $DataJunta);

        $DataSeparda = [
            "ano" => $ano,
            "mes" => $mes,
            "dia" => $dia
        ];

        return $DataSeparda;
    }

    public function ColocarPontoCPF($cpfSemPonto)
    {
        $cpf =  substr_replace($cpfSemPonto, ".", 3, 0);
        $cpf =  substr_replace($cpf, ".", 7, 0);
        $cpf =  substr_replace($cpf, "-", 11, 0);

        return $cpf;
    }

    public function TirarPontoCPF($CpfComPonto)
    {
        $pontuacao = array(".", "-");
        $cpf = str_replace($pontuacao, "", $CpfComPonto);
        $_SESSION['cpfsemponto'] = $cpf;

        return $cpf;
    }


    public function ColocarPontoCNPJ($cnpjSemPonto)
    {
        $cnpj =  substr_replace($cnpjSemPonto, '.', 2, 0);
        $cnpj =  substr_replace($cnpj, '.', 6, 0);
        $cnpj =  substr_replace($cnpj, '/', 10, 0);
        $cnpj =  substr_replace($cnpj,  '-', 15, 0);

        return $cnpj;
    }

    public function TirarPontoCNPJ($CnpjComPonto)
    {
        $pontuacao = array(".", "-", "/");
        $cnpj = str_replace($pontuacao, "", $CnpjComPonto);
        $_SESSION['cnpjsemponto'] = $cnpj;

        return $cnpj;
    }

    public function VerificarNomeOBJ($nome)
    {

        if (strlen($nome) <= 2) {
            return true;
        }
        return false;
    }

    public function VerificarCadastroNome($nome)
    {
        if (strlen($nome) <= 2 || strlen($nome) > 80) {
            return true;
        } else {
            for ($i = 0; $i < strlen($nome); $i++) {
                if (ord($nome[$i]) > 32 && ord($nome[$i]) < 65 || ord($nome[$i]) > 90 && ord($nome[$i]) < 96 || ord($nome[$i]) > 122 && ord($nome[$i]) < 126) {
                    return true;
                }
            }
        }

        return false;
    }

    public function VerificaCPF($cpf)
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

    public function VerificaCNPJ($cnpj)
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

    public function VerificaData($data)
    {

        list($ano, $mes, $dia) = explode('-', $data);
        return $ano >= date("Y") ? true : false;
    }

    public function VerificaTelefone($telefone)
    {
        return strlen($telefone) <= 13 ? true : false;
    }

    public function VerificarEndereco($endereco)
    {

        $possiveis = array("rua", "avenida", "rodovia", "alameda", "viela", "travessa", "beco", "estrada");

        for ($i = 0; $i < 8; $i++) {

            $achou = strpos(strtolower($endereco), $possiveis[$i]);
            if($achou !== false){
                return false;
            }
       
        }
        return true;

    }

    public function VerificaSenha($senha)
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
    public function VerificarSeUsuarioJaCadastrado($email, $cpf)
    {
        $query = "SELECT Email_user, CPF_user FROM usuarios where Email_user =  '$email' or CPF_user = '$cpf'";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 1");
        $QuantidadeDeCadastros = $ResultadoQuery->rowCount();

        return !empty($QuantidadeDeCadastros) ? true : false;
    }

    public function VerificarSeEmpresaJaCadastrada($email, $cnpj)
    {
        $query = "SELECT Email, CNPJ FROM empresas where Email =  '$email' or CNPJ = '$cnpj'";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 2");
        $QuantidadeDeCadastros = $ResultadoQuery->rowCount();

        return $QuantidadeDeCadastros;
    }

    //Querys usadas no Company.php
    public function PegarDadosEmpresaPeloIdEmpresa($id_empresa)
    {
        $query = "SELECT * FROM empresas where id_empresa =  '$id_empresa'";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 3");
        $DadosEmpresa = $ResultadoQuery->fetchAll();

        return $DadosEmpresa;
    }

    public function PegarDadosUserEmpresaPeloIdUserIdEmpresa($id_user, $id_empresa)
    {
        $query = "SELECT * FROM user_empresa where id_user =  '$id_user' and id_empresa = '$id_empresa'";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 4");
        $DadosUserEmpresa = $ResultadoQuery->fetchAll();


        return $DadosUserEmpresa;
    }

    public function PegarDadosUserEmpresaPeloIdEmpresaTodos($id_empresa)
    {

        $query = "SELECT * FROM user_empresa inner join usuarios on user_empresa.id_user = usuarios.id_user where id_empresa = '$id_empresa' order by Nivel_acesso DESC, Nome_user ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 4");
        $DadosUserEmpresa = $ResultadoQuery->fetchAll();
        $QuantidadeDeUsuarios = $ResultadoQuery->rowCount();

        $Dados = [
            "Quantidade" => $QuantidadeDeUsuarios,
            "Usuarios" => $DadosUserEmpresa
        ];

        return $Dados;
    }

    public function PegarDadosUserEmpresaPeloIdEmpresaAdms($id_empresa)
    {

        $query = "SELECT * FROM user_empresa inner join usuarios on user_empresa.id_user = usuarios.id_user where id_empresa = '$id_empresa' and nivel_acesso > 2 order by Nivel_acesso DESC, Nome_user ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 4");
        $DadosUserEmpresa = $ResultadoQuery->fetchAll();
        $QuantidadeDeUsuarios = $ResultadoQuery->rowCount();

        $Dados = [
            "Quantidade" => $QuantidadeDeUsuarios,
            "Usuarios" => $DadosUserEmpresa
        ];

        return $Dados;
    }

    public function PegarDadosUserEmpresaPeloIdEmpresaNormais($id_empresa)
    {

        $query = "SELECT * FROM user_empresa inner join usuarios on user_empresa.id_user = usuarios.id_user where id_empresa = '$id_empresa' and nivel_acesso < 3 and Banido = 'N' order by Nivel_acesso DESC, Nome_user ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 4");
        $DadosUserEmpresa = $ResultadoQuery->fetchAll();
        $QuantidadeDeUsuarios = $ResultadoQuery->rowCount();

        $Dados = [
            "Quantidade" => $QuantidadeDeUsuarios,
            "Usuarios" => $DadosUserEmpresa
        ];

        return $Dados;
    }

    public function PegarDadosUserEmpresaPeloIdEmpresaBanidos($id_empresa)
    {

        $query = "SELECT * FROM user_empresa inner join usuarios on user_empresa.id_user = usuarios.id_user where id_empresa = '$id_empresa' and Banido = 'S' order by Nivel_acesso DESC, Nome_user ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 4");
        $DadosUserEmpresa = $ResultadoQuery->fetchAll();
        $QuantidadeDeUsuarios = $ResultadoQuery->rowCount();

        $Dados = [
            "Quantidade" => $QuantidadeDeUsuarios,
            "Usuarios" => $DadosUserEmpresa
        ];

        return $Dados;
    }

    public function PegarDadosUserEmpresaPeloId($id){

        $query = "SELECT * FROM user_empresa inner join usuarios on user_empresa.id_user = usuarios.id_user where id_user_empresa = '$id' order by Nivel_acesso DESC, Nome_user ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 4");
        $DadosUserEmpresa = $ResultadoQuery->fetchAll();
        $QuantidadeDeUsuarios = $ResultadoQuery->rowCount();

        $Dados = [
            "Quantidade" => $QuantidadeDeUsuarios,
            "Usuarios" => $DadosUserEmpresa
        ];

        return $Dados;


    }

    //Querys usadas no VerificaLogin
    public function PegarDadosUsuarioPeloEmailSenha($email, $senha)
    {

        $query = "SELECT Email_user, Senha_user, id_user FROM usuarios where Email_user =  '$email'";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 5");
        $DadosUsuario = $ResultadoQuery->fetchAll();
        $EmailExiste = $ResultadoQuery->rowCount();

        if ($EmailExiste == 1) {
            if (password_verify($senha, $DadosUsuario[0]["Senha_user"])) {
                $UsuarioExiste = true;
            }
        } else if ($EmailExiste == 0) {
            $UsuarioExiste = false;
        }

        $Dados = array(
            "id_user" => $DadosUsuario[0]['id_user'],
            "UsuarioExiste" => $UsuarioExiste
        );

        return $Dados;
    }

    public function PegarDadosEmpresaPeloCodigo($codigo_acesso)
    {
        $query = "SELECT codigo_acesso, id_empresa FROM empresas where codigo_acesso =  '$codigo_acesso'";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 6");
        $QuantidadeDeEmpresas = $ResultadoQuery->rowCount();

        if ($QuantidadeDeEmpresas > 0) {
            $DadosEmpresa = $ResultadoQuery->fetchAll();
        } else {
            $DadosEmpresa = null;
        }

        $CodigoExiste = (empty($ResultadoQuery->rowCount())) ? false : true;

        $Dados = array(
            "CodigoExiste" => $CodigoExiste,
            "id_empresa" => $DadosEmpresa[0]['id_empresa']
        );

        return $Dados;
    }

    public function VerificarSeUsuarioJaFezLoginAntes($codigo_acesso, $id_user)
    {
        $query = "SELECT * FROM user_empresa inner join empresas on 'id_empresa' = 'id_empresa' where empresas.codigo_acesso = '$codigo_acesso' and user_empresa.id_user = $id_user and user_empresa.id_empresa = empresas.id_empresa";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 7");
        $DadosUserEmpresa = $ResultadoQuery->fetchAll();
        $QuantidadeDeLoginsJaFeitos = $ResultadoQuery->rowCount();

        return $QuantidadeDeLoginsJaFeitos;
    }

    public function PegarDadosEmpresaPeloId_Codigo($id_adm, $codigo_acesso)
    {
        $query = "SELECT id_adm, id_empresa FROM empresas where id_adm =  $id_adm and codigo_acesso = '$codigo_acesso'";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 8 " . $id_adm . " " . $codigo_acesso);
        $DadosEmpresa = $ResultadoQuery->fetchAll();

        return $DadosEmpresa;
    }

    public function PegarDadosUsuarioPeloId($id)
    {
        $query = "SELECT * FROM usuarios WHERE id_user = '$id'";

        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 9");
        $DadosUsuario = $ResultadoQuery->fetchAll();

        return $DadosUsuario;
    }

    public function PegarDadosEmpresaPeloIdUsuario($id)
    {

        $query = "SELECT * FROM empresas inner join user_empresa on 'id_empresa' = 'id_empresa' where user_empresa.id_user = $id and empresas.id_empresa = user_empresa.id_empresa and user_empresa.banido = 'N' order by Nome ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 10");
        $QuantidadeDeEmpresas = $ResultadoQuery->rowCount();

        if ($QuantidadeDeEmpresas > 0) {
            $UmaEmpresa = $ResultadoQuery->fetchAll();
        } else {
            $UmaEmpresa = null;
        }

        $Empresas = [

            "Dados" => $UmaEmpresa,
            "QuantidadeDeEmpresas" => $QuantidadeDeEmpresas

        ];

        return $Empresas;
    }

    public function ClearInjectionXSS($input)
    {
        //$input = mysqli_real_escape_string($input);
        $input = trim($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    public function VerificarFoto($foto)
    {

        $foto = $_FILES["foto"];
        list($tipo, $extensao) = explode("/", $foto["type"]);

        $tipo = strtolower($tipo);
        $extensao = strtolower($extensao);

        $extensoesPossiveis = ["jpg", "jpeg", "png"];

        return in_array($extensao, $extensoesPossiveis) && $tipo == "image" ?  false :  true;
    }

    public function PegarDadosItemPeloIdEmpresaPerdidos($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa =  '$id_empresa' and situacao = 'Perdido' order by Nome_obj ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 11");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

        if ($QuantidadeDeObjetos > 0) {
            $DadosObjetos = $ResultadoQuery->fetchAll();
        }

        if (isset($DadosObjetos)) {
            $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
                "Objeto" => $DadosObjetos
            ];
            return $Dados;
        } else {
            return $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
            ];
        }
    }

    public function PegarDadosItemPeloIdEmpresaTodos($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa =  '$id_empresa' order by Nome_obj ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 11");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

        if ($QuantidadeDeObjetos > 0) {
            $DadosObjetos = $ResultadoQuery->fetchAll();
        }

        if (isset($DadosObjetos)) {
            $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
                "Objeto" => $DadosObjetos
            ];
            return $Dados;
        } else {
            return $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
            ];
        }
    }

    public function PegarDadosItemPeloId($id)
    {

        $query = "SELECT * FROM objetos inner join empresas on empresas.id_empresa = objetos.id_empresa where id_obj = '$id'";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 11");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

        if ($QuantidadeDeObjetos > 0) {
            $DadosObjetos = $ResultadoQuery->fetchAll();
        }

        if (isset($DadosObjetos)) {
            $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
                "Objeto" => $DadosObjetos
            ];
            return $Dados;
        } else {
            return $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
            ];
        }
    }

    public function PegarDocumentos($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa =  '$id_empresa' and Categoria = 'Documento'";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 12");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

        if ($QuantidadeDeObjetos > 0) {
            $DadosObjetos = $ResultadoQuery->fetchAll();
        }

        if (isset($DadosObjetos)) {
            $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
                "Objeto" => $DadosObjetos
            ];
            return $Dados;
        } else {
            return $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
            ];
        }
    }

    public function PegarRoupas($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa =  '$id_empresa' and Categoria = 'Roupa'";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 13");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

        if ($QuantidadeDeObjetos > 0) {
            $DadosObjetos = $ResultadoQuery->fetchAll();
        }

        if (isset($DadosObjetos)) {
            $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
                "Objeto" => $DadosObjetos
            ];
            return $Dados;
        } else {
            return $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
            ];
        }
    }

    public function PegarEletronicos($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa =  '$id_empresa' and Categoria = 'Eletronico'";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 14");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

        if ($QuantidadeDeObjetos > 0) {
            $DadosObjetos = $ResultadoQuery->fetchAll();
        }

        if (isset($DadosObjetos)) {
            $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
                "Objeto" => $DadosObjetos
            ];
            return $Dados;
        } else {
            return $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
            ];
        }
    }

    public function PegarAcessorios($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa =  '$id_empresa' and Categoria = 'Acessorio'";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 15");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

        if ($QuantidadeDeObjetos > 0) {
            $DadosObjetos = $ResultadoQuery->fetchAll();
        }

        if (isset($DadosObjetos)) {
            $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
                "Objeto" => $DadosObjetos
            ];
            return $Dados;
        } else {
            return $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
            ];
        }
    }

    public function PegarOutros($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa =  '$id_empresa' and Categoria = 'Outros'";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 17");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

        if ($QuantidadeDeObjetos > 0) {
            $DadosObjetos = $ResultadoQuery->fetchAll();
        }

        if (isset($DadosObjetos)) {
            $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
                "Objeto" => $DadosObjetos
            ];
            return $Dados;
        } else {
            return $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
            ];
        }
    }

    public function TodosAZ($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa order by Nome_obj ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 18");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

        if ($QuantidadeDeObjetos > 0) {
            $DadosObjetos = $ResultadoQuery->fetchAll();
        }

        if (isset($DadosObjetos)) {
            $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
                "Objeto" => $DadosObjetos
            ];
            return $Dados;
        } else {
            return $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
            ];
        }
    }

    public function TodosZA($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa order by Nome_obj DESC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 19");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

        if ($QuantidadeDeObjetos > 0) {
            $DadosObjetos = $ResultadoQuery->fetchAll();
        }

        if (isset($DadosObjetos)) {
            $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
                "Objeto" => $DadosObjetos
            ];
            return $Dados;
        } else {
            return $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
            ];
        }
    }

    public function TodosAntigo($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa order by Data_cadastro ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 20");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

        if ($QuantidadeDeObjetos > 0) {
            $DadosObjetos = $ResultadoQuery->fetchAll();
        }

        if (isset($DadosObjetos)) {
            $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
                "Objeto" => $DadosObjetos
            ];
            return $Dados;
        } else {
            return $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
            ];
        }
    }

    public function TodosRecente($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa order by Data_cadastro DESC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 21");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

        if ($QuantidadeDeObjetos > 0) {
            $DadosObjetos = $ResultadoQuery->fetchAll();
        }

        if (isset($DadosObjetos)) {
            $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
                "Objeto" => $DadosObjetos
            ];
            return $Dados;
        } else {
            return $Dados = [
                "Quantidade" => $QuantidadeDeObjetos,
            ];
        }
    }


    public function AcessoriosAZ($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Acessório' order by Nome_obj ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 22");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function AcessoriosZA($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Acessório' order by Nome_obj DESC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 23");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function AcessoriosAntigo($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Acessório' order by Data_cadastro ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 24");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function AcessoriosRecente($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Acessório' order by Data_cadastro DESC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 24");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function DocumentosAZ($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Documento' order by Nome_obj ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 25");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function DocumentosZA($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Documento' order by Nome_obj DESC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 26");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function DocumentosAntigo($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Documento' order by Data_cadastro ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 27");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function DocumentosRecente($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Documento' order by Data_cadastro DESC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 28");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function EletronicosAZ($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Eletrônico' order by Nome_obj ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 29");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function EletronicosZA($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Eletrônico' order by Nome_obj DESC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 30");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function EletronicosAntigo($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Eletrônico' order by Data_cadastro ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 31");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function EletronicosRecente($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Eletrônico' order by Data_cadastro DESC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 32");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function RoupasAZ($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Roupa' order by Nome_obj ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 33");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function RoupasZA($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Roupa' order by Nome_obj DESC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 34");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function RoupasAntigo($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Roupa' order by Data_cadastro ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 35");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function RoupasRecente($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Roupa' order by Data_cadastro DESC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 36");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function OutrosAZ($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Outros' order by Nome_obj ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 37");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function OutrosZA($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Outros' order by Nome_obj DESC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 38");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function OutrosAntigo($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Outros' order by Data_cadastro ASC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 39");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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

    public function OutrosRecente($id_empresa)
    {

        $query = "SELECT * FROM objetos where id_empresa = $id_empresa and categoria = 'Outros' order by Data_cadastro DESC";
        $ResultadoQuery = $this->dbh->query($query) or die("Erro na consulta 40");
        $QuantidadeDeObjetos = $ResultadoQuery->rowCount();

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
}
