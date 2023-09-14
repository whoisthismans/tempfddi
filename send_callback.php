<?php 
$enquiry_send=1;
$result=array();
$base_url="https://fddiindia.com/admission-session-2020/";
$send_to="fddiaist2020@gmail.com";
   if(isset($_POST['cb_fname']) && empty($_POST['cfrom_hidden'])) 
  {
      
      $cb_form_errors=array();
      $cb_fname=trim($_POST['cb_fname']);
      $cb_lname=trim($_POST['cb_lname']);
      $cb_phone=trim($_POST['cb_phone']);
      $cb_email=trim($_POST['cb_email']);
      $cb_message=trim($_POST['cb_message']);
      $utm_source=trim($_POST['utm_source']);
      $utm_medium=trim($_POST['utm_medium']);
      $utm_campaign=trim($_POST['utm_campaign']);
      $utm_term=trim($_POST['utm_term']);
      $utm_content=trim($_POST['utm_content']);


      if(empty($cb_fname))
      {
         $cb_form_errors['cb_fname']= 'First Name is required';

      }

      if(empty($cb_lname))
      {
         $cb_form_errors['cb_lname']= 'Last Name is required';

      }

      if(empty($cb_phone))
      {
         //$cb_form_errors['cb_phone']= 'Phone is required';

      }

      if(empty($cb_email))
      {
         $cb_form_errors['cb_email']= 'Email is required';

      }

      


      $date_added= date('Y-m-d');
      $status= 1;

      if(empty($cb_form_errors))
      {
        $enquiry_send=1;

        $name = $cb_fname;
        if(!empty($cb_lname))
        {
          $name = $cb_fname.' '.$cb_lname;

        }

        

        if($enquiry_send==1)
        {
          //Sending email to Admin code goes here
          $message = "<table cellspacing=\"0\" cellpadding=\"0\"  border=\"1\" bordercolor=\"#f1f1f1\" width=\"600\">";
          $message .= "<tr align=\"\">";
          $message .= "<td style=\"padding:4px;\" colspan=\"2\" bgcolor=\"#f1f1f1\">";
          $message .= "<img src="."\"".$base_url."images/logo-mail.png"."\" style=\"height: 60px;\">";
          $message .= "";
          $message .= "</td>";
          $message .= "</tr>";


          $message .= "<tr>";
          $message .= "<td style=\"padding:8px;\">Name: ";
          $message .= "</td>";
          $message .= "<td style=\"padding:8px;\">".trim($name);
          $message .= "</td>";
          $message .= "</tr>";


          $message .= "<tr>";
          $message .= "<td style=\"padding:8px;\">Email: ";
          $message .= "</td>";
          $message .= "<td style=\"padding:8px;\">".trim($cb_email);
          $message .= "</td>";
          $message .= "</tr>";

          $message .= "<tr>";
          $message .= "<td style=\"padding:8px;\">Phone: ";
          $message .= "</td>";
          $message .= "<td style=\"padding:8px;\">".trim($cb_phone);
          $message .= "</td>";
          $message .= "</tr>";

          $message .= "<tr>";
          $message .= "<td style=\"padding:8px;\">Message: ";
          $message .= "</td>";
          $message .= "<td style=\"padding:8px;\">".trim($cb_message);
          $message .= "</td>";
          $message .= "</tr>";


          $message .= "<tr>";
          $message .= "<td style=\"padding:8px;\">UTM Source: ";
          $message .= "</td>";
          $message .= "<td style=\"padding:8px;\">".trim($utm_source);
          $message .= "</td>";
          $message .= "</tr>";

          $message .= "<tr>";
          $message .= "<td style=\"padding:8px;\">Campaign Medium: ";
          $message .= "</td>";
          $message .= "<td style=\"padding:8px;\">".trim($utm_medium);
          $message .= "</td>";
          $message .= "</tr>";$message .= "<tr>";
          $message .= "<td style=\"padding:8px;\">Campaign Name: ";
          $message .= "</td>";
          $message .= "<td style=\"padding:8px;\">".trim($utm_campaign);
          $message .= "</td>";
          $message .= "</tr>";$message .= "<tr>";
          $message .= "<td style=\"padding:8px;\">Campaign Term: ";
          $message .= "</td>";
          $message .= "<td style=\"padding:8px;\">".trim($utm_term);
          $message .= "</td>";
          $message .= "</tr>";$message .= "<tr>";
          $message .= "<td style=\"padding:8px;\">Campaign Content: ";
          $message .= "</td>";
          $message .= "<td style=\"padding:8px;\">".trim($utm_content);
          $message .= "</td>";
          $message .= "</tr>";

          
          $message .= "</table>";


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
		$mail->SMTPSecure 				= "ssl";      
		$mail->Host = "smtp.gmail.com"; // sets the SMTP server
		$mail->Port = 465;                    // set the SMTP port for the GMAIL server
		$mail->Username = "fddiaist2020@gmail.com"; // SMTP account username
		$mail->Password = "FddiNoida@201301";        // SMTP account password
		
		$mail->AddReplyTo($cb_email,$cb_fname);
		$mail->setFrom('enquiry@fddiindia.com', 'FDDI');
		
		$mail->Subject    ='FDDI - Call Back Request , Date - '.date('d M Y');
		
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		
		$mail->MsgHTML($body);
		
		$address = $send_to;
		$mail->AddAddress($address, "FDDI");

		if(!$mail->Send())
		 {
		 	 $result['status']=0; 
    		$result['mess']='Some Error Occured!'.$mail->ErrorInfo; 
		 // echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		
		}
			$result['status']=1; 
      		$result['mess']='Thank you for showing interest. We will contact you soon.'; 
        }

      }


        

          
  }


/*  if($enquiry_send==1)
  {
     //echo '<div class="success_message">Thank you for showing interest. We will contact you soon.</div>';
      $result['status']=1; 
      $result['mess']='Thank you for showing interest. We will contact you soon.'; 

  }
  else
  {

    $result['status']=0; 
    $result['mess']='Some Error Occured!'; 

  }*/

 echo json_encode($result); 
?>