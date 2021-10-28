<?php

require('cp_admin/mail/class.pop3.php');
require('cp_admin/mail/class.smtp.php');
require('cp_admin/mail/class.phpmailer.php');

class Mail
{
    private $Email = "noreply@acumenaccounting.co.uk";
    private $Password = "gVD4kLBy64Ba";
    private $server = "send.one.com";
    private $port = 465;
    private $mail = Null;
    public $Message = "";

    public function __CONSTRUCT()
    {
        $this->mail = new PHPMailer();
        $this->mail->IsSMTP();
        $this->mail->CharSet = "utf-8";
        $this->mail->SMTPDebug = false;
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->Host = $this->server;
        $this->mail->Port = $this->port;
        $this->mail->Username = $this->Email;
        $this->mail->Password = $this->Password;
        $this->mail->IsHTML(true);
        $this->mail->AddReplyTo($this->Email, "Acumen Accounting Uk");
        $this->mail->Sender = $this->Email;
        $this->mail->IsHTML(true);
        $this->mail->SetFrom($this->Email, "Acumen Accounting UK");

    }

    function SendMail($email_to, $subject, $body){
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
        $this->mail->AddAddress($email_to);

        if (!$this->mail->Send()) {
            print("<pre>");
            print_r($this->mail);
            print("</pre>");
            $this->Message = "Failed to send email.";
            return false;
        } else {
            $this->Message = "Email sent!";
            return true;
        }
    }


}