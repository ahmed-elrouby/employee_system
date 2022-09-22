<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once __DIR__.'\..\..\vendor\autoload.php';
//Create an instance; passing `true` enables exceptions
class mail
{
    private $emailTo;
    private $subject;
    private $body;
    private $fname;

    function __construct($emailTo,$subject,$body)
    {
        $this->emailTo = $emailTo;
        $this->subject = $subject;
        $this->body = $body;
    }
    /**
     * Get the value of fname
     */ 
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * Set the value of fname
     *
     * @return  self
     */ 
    public function setFname($fname)
    {
        $this->fname = $fname;

        return $this;
    }
    public function sendMail()
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.mail.yahoo.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'elrouby0257@yahoo.com';                     //SMTP username
            $mail->Password   = 'hxejlxdmjhmpnkna';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            

            //Recipients
            $mail->setFrom('elrouby0257@yahoo.com', 'Fahd_King School');
            $mail->addAddress($this->emailTo);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $this->subject;
            $mail->Body    = $this->body;

            $mail->send();
            // echo 'Message has been sent';
            return TRUE;
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";die;
            return FALSE;
        }
    }
    public function sendMedia()
    {
		// $emailbody = '';
		// foreach ($enquirydata as $title => $data) {
		// $emailbody .= '<strong>' . $title . '</strong>: ' . $data . '<br />';}
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
			
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.mail.yahoo.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'elrouby0257@yahoo.com';                     //SMTP username
            $mail->Password   = 'ccwsbaulwueoybly';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            

            //Recipients
            $mail->setFrom('elrouby0257@yahoo.com', 'Fahd_King School');
            $mail->addAddress($this->emailTo);     //Add a recipient
			$mail->addAttachment(__DIR__."\\..\\..\\assets\\images\\certificate\\file\\".$this->fname.'.pdf','certification.pdf');
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $this->subject;
            $mail->Body    = $this->body;

            $mail->send();
            return TRUE;
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";die;
            return FALSE;
        }
    }

    
}
