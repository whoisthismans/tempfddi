<?php
$subject = "New Client Enquiry";
if (empty($_POST["name"])) die('*Please enter your name.');
if (empty($_POST["email"])) die('*Please enter your Email.');
if (empty($_POST["mobile"])) die('*Please enter your Mobile Number.');
if (empty($_POST["message"])) die('*Please enter your message.');
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$messag = $_POST['message'];

$message = '
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Enquiry Form</title>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TMPF9TS');</script>
<!-- End Google Tag Manager -->
</head>
<body>
<p>Name : '.$name.'</p>
<p>Email : '.$email.'</p>
<p>Mobile : '.$mobile.'</p>
<p>Message :<br>'.$messag.'</p>
</body>
</html>
';
?>

<?php

error_reporting(E_ALL);
error_reporting(E_STRICT);

require_once('phpMailer/class.phpmailer.php');
//include("phpMailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$body             = $message;

$mail->IsSMTP(); // telling the class to use SMTP
//$mail->Host = "smtp.sparkpostmail.com"; // SMTP server
$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host = "ssl://smtp.gmail.com"; // sets the SMTP server
$mail->Port = 465;                    // set the SMTP port for the GMAIL server
$mail->Username = "fddiaist2020@gmail.com"; // SMTP account username
$mail->Password = "FddiNoida@201301";        // SMTP account password

$mail->AddReplyTo($email,$name);
$mail->setFrom('enquiry@fddiindia.com', 'FDDI');

$mail->Subject    = $subject;

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "enquiry@fddiindia.com";
$mail->AddAddress($address, "FDDI");

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {?>
        <p style="color:#fff;">Thank you for the message, We will get back you shortly. </p>
<?php }

?>