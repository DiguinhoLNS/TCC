<?php

require_once "./mailer/Exception.php";
require_once "./mailer/SMTP.php";
require_once "./mailer/PHPMailer.php";
require_once "Funcoes.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email extends PHPMailer
{
    private static $from = "ape.achadoseperdidos@gmail.com";
    private static $password = "lmrt2020";
    private static $hostSMTP = "smtp.gmail.com";
    private static $port = 465;
    private $para;

    public function setPara($emailUser)
    {
        $this->para = $emailUser;
    }

    public function getPara()
    {
        return $this->para;
    }

    public function DuasEtapas($cod)
    {

        try {
            ob_start();
            include "./include/EstiloDuasEtapas.php";
            $TwoSteps = ob_get_clean();
            ob_end_clean();

            $this->CharSet = 'UTF-8';
            $this->setLanguage("pt");
            $this->SMTPDebug = false;
            $this->isSMTP();
            $this->Host = self::$hostSMTP;
            $this->SMTPAuth = true;
            $this->SMTPSecure = 'ssl';
            $this->Port = self::$port;
            $this->Username = self::$from;
            $this->Password = self::$password;

            $this->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $this->SetFrom(self::$from, 'Ape Achados e Perdidos');
            $this->addAddress($this->para);

            $this->isHTML(true);
            $this->Subject = 'Código de verificação';
            $this->MsgHTML($TwoSteps);
            $this->AltBody = $cod;

            if (!$this->send()) {
                die("Erro no envio do Email");
            }
                
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$this->ErrorInfo}";
        }
    }

    public function EditarSenha(){

        try {
            ob_start();
            include "./include/EstiloEditarSenha.php";
            $TwoSteps = ob_get_clean();
            ob_end_clean();

            $this->CharSet = 'UTF-8';
            $this->setLanguage("pt");
            $this->SMTPDebug = false;
            $this->isSMTP();
            $this->Host = self::$hostSMTP;
            $this->SMTPAuth = true;
            $this->SMTPSecure = 'ssl';
            $this->Port = self::$port;
            $this->Username = self::$from;
            $this->Password = self::$password;

            $this->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $this->SetFrom(self::$from, 'Ape Achados e Perdidos');
            $this->addAddress($this->para);

            $this->isHTML(true);
            $this->Subject = 'Código de verificação';
            $this->MsgHTML($TwoSteps);
            $this->AltBody = $cod;

            if (!$this->send()) {
                die("Erro no envio do Email");
            }
                
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$this->ErrorInfo}";
        }






    }
    
}
