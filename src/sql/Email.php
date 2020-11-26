<?php

require_once "/storage/ssd1/621/15485621/public_html/mailer/Exception.php";
require_once "/storage/ssd1/621/15485621/public_html/mailer/SMTP.php";
require_once "/storage/ssd1/621/15485621/public_html/mailer/PHPMailer.php";
require_once "/storage/ssd1/621/15485621/public_html/sql/Funcoes.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email extends PHPMailer
{
    const from = "ape.achadoseperdidos@gmail.com";
    const password = "lmrt2020";
    const hostSMTP = "smtp.gmail.com";
    const port = 465;
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
            $this->Host = self::hostSMTP;
            $this->SMTPAuth = true;
            $this->SMTPSecure = 'ssl';
            $this->Port = self::port;
            $this->Username = self::from;
            $this->Password = self::password;

            $this->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $this->SetFrom(self::from, 'Ape Achados e Perdidos');
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

    public function EditarSenha($id_user)
    {

        try {
            ob_start();
            include "./include/EstiloEsqueciMinhaSenha.php";
            $ForgetPWD = ob_get_clean();
            ob_end_clean();

            $this->CharSet = 'UTF-8';
            $this->setLanguage("pt");
            $this->SMTPDebug = false;
            $this->isSMTP();
            $this->Host = self::hostSMTP;
            $this->SMTPAuth = true;
            $this->SMTPSecure = 'ssl';
            $this->Port = self::port;
            $this->Username = self::from;
            $this->Password = self::password;

            $this->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $this->SetFrom(self::from, 'Ape Achados e Perdidos');
            $this->addAddress($this->para);

            $this->isHTML(true);
            $this->Subject = 'Redefinir senha da conta APE';
            $this->MsgHTML($ForgetPWD);
            $this->AltBody = $id_user;

            if (!$this->send()) {
                die("Erro no envio do Email");
            }
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$this->ErrorInfo}";
        }
    }

    public function PedidoAceito($Nome_obj)
    {

        try {
            ob_start();
            include "/storage/ssd1/621/15485621/public_html/include/EstiloPedidoAceito.php";
            $Accepted = ob_get_clean();
            ob_end_clean();

            $this->CharSet = 'UTF-8';
            $this->setLanguage("pt");
            $this->SMTPDebug = false;
            $this->isSMTP();
            $this->Host = self::hostSMTP;
            $this->SMTPAuth = true;
            $this->SMTPSecure = 'ssl';
            $this->Port = self::port;
            $this->Username = self::from;
            $this->Password = self::password;

            $this->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $this->SetFrom(self::from, 'Ape Achados e Perdidos');
            $this->addAddress($this->para);

            $this->isHTML(true);
            $this->Subject = 'Pedido de agendamento';
            $this->MsgHTML($Accepted);
            $this->AltBody = 'Pedido de agendamento do item ' . $Nome_obj . ' aceito';

            if (!$this->send()) {
                die("Erro no envio do Email");
            }
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$this->ErrorInfo}";
        }
    }
}
