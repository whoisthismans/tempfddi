<?php
require __DIR__ . '/admission-session-2021/vendor/autoload.php';
date_default_timezone_set("Asia/Kolkata");
$subject = "New Client Enquiry";
if (empty($_POST["name"])) die('*Please enter your name.');
if (empty($_POST["email"])) die('*Please enter your Email.');
if (empty($_POST["mobile"])) die('*Please enter your Mobile Number.');
if (empty($_POST["gender"])) die('*Please enter your gender.');
if (empty($_POST["address"])) die('*Please enter your address.');
if (empty($_POST["state"])) die('*Please enter your state.');
if (empty($_POST["program"])) die('*Please select your program.');
if (empty($_POST["campus"])) die('*Please select your campus.');
if (empty($_POST["lastschool"])) die('*Please enter your last school.');
if (empty($_POST["aboutfddi"])) die('*How did you hear about FDDI?.');
if (empty($_POST["message"])) die('*Please select your message.');
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$message = $_POST['message'];
$state = $_POST['state'];
$program = $_POST['program'];
$campus = $_POST['campus'];
$lastschool = $_POST['lastschool'];
$aboutfddi = $_POST['aboutfddi'];

    $name   = str_replace(' ', '-', $name);
    $phone  = $mobile;
    $redirect_link  =   "http://bhashsms.com/api/sendmsg.php?user=Webhedonic&pass=123456&sender=FDDIHQ&phone=".$phone."&text=Hello%20".$name."%20Thank%20you%20for%20showing%20interest%20in%20FDDI.%20Someone%20from%20our%20admission%20team%20will%20contact%20you%20soon!%20FDDI%20Admissions%20+918178448154&priority=ndnd&stype=normal";
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$redirect_link);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $output=curl_exec($ch);
    
    if($output == false)
    {
        echo "Error Number:".curl_errno($ch)."<br>";
        echo "Error String:".curl_error($ch);
    }
    $info = curl_getinfo($ch);
    curl_close($ch);


//save to google sheet



/**
 * Set here the full path to the private key .json file obtained when you
 * created the service account. Notice that this path must be readable by
 * this script.
 */
$service_account_file = __DIR__.'/../fddigsheet-cc6c192d1ee8.json';

/**
 * This is the long string that identifies the spreadsheet. Pick it up from
 * the spreadsheet's URL and paste it below.
 */
$spreadsheet_id = '1T73EQ_yWlT6pWVDU5sO9d8M2HR_APVCQl5dZyQHCPpU';

/**
 * This is the range that you want to extract out of the spreadsheet. It uses
 * A1 notation. For example, if you want a whole sheet of the spreadsheet, then
 * set here the sheet name.
 *
 * @see https://developers.google.com/sheets/api/guides/concepts#a1_notation
 */
$spreadsheet_range = 'homepage-popup-enquiries';

putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $service_account_file);
$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Google_Service_Sheets::SPREADSHEETS);
$service = new Google_Service_Sheets($client);
$date = date('d-m-Y');
$time = date('H:i:s');

$values = [
    [
        $name, $email, $mobile, $gender, $address, $state, $program, $campus, $lastschool, $aboutfddi, $message, $date, $time
    ],
];


$body = new Google_Service_Sheets_ValueRange([
    'values' => $values
]);

$params = [
    'valueInputOption' => 'RAW'
];

$check_rows = $service->spreadsheets_values->append($spreadsheet_id, $spreadsheet_range, $body, $params);
die('success');



/*$message = '
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
';*/


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
$mail->SMTPSecure = 'ssl';

$mail->Host = "smtp.gmail.com"; // sets the SMTP server
$mail->Port = 465;                    // set the SMTP port for the GMAIL server
$mail->Username = "fddiaist2021@gmail.com"; // SMTP account username
$mail->Password = "FddiNoida@201301";        // SMTP account password

$mail->AddReplyTo($email,$name);
$mail->setFrom('enquiry@fddiindia.com', 'FDDI');

$mail->Subject    = $subject;

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "fddiaist2020@gmail.com";
$mail->AddAddress($address, "FDDI");

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {?>
        <p style="color:#fff;">Thank you for submitting the form!! Admission team will get back to you within 72 hours. </p>
<?php }

?>