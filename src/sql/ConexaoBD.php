<?php

class ConexaoBD
{
    private $host = 'localhost';
    private $user = 'root';
    private $senha = '';
    private $banco = 'bdape';
    private $porta = '3306';
    public $dbh;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';port=' . $this->porta . ';dbname=' . $this->banco;
        $opcoes = [
            PDO::ATTR_PERSISTENT => TRUE,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->senha, $opcoes);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
