<?php 
require '../thirdparties/PHPMailer/src/Exception.php';
require '../thirdparties/PHPMailer/src/PHPMailer.php';
require '../thirdparties/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['tea_type'])){

	$fullname = trim($_POST['fullname']);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	$address = trim($_POST['address']);
	$quantity = trim($_POST['quantity']);
	$tea_type = trim($_POST['tea_type']);

	//send an email..
	//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
	    //Server settings
		    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		    $mail->isSMTP();                                            //Send using SMTP
		    $mail->Host       = 'smtp.gmail.com';              //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = 'sophiajerometea@gmail.com';                     //SMTP username
		    $mail->Password   = 'Teaorb100';                               //SMTP password
		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		    $mail->Port  = 587; //TCP port to connect to, use 465 for `PHP  ` above

		    //Recipients
		    $mail->setFrom('no-reply@sophiajerometea.com', 'New Order Placed');
		    $mail->addAddress('sophiajerometea@gmail.com', "{$fullname}");     //Add a recipient
		   

		    //Content
		    $mail->isHTML(true); //Set email format to HTML
		    $mail->Subject = "A new customer has placed an order for {$tea_type}";
		    $mail->Body    = "fullname: {$fullname}<br>
		    				  phone: {$phone}<br>
		    				  email: {$email}<br>
		    				  address: {$address}<br>
		    				  quantity: {$quantity}";
		   

		    $mail->send();
		    echo 'Order placed successfully!';
	} catch (Exception $e) {
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}



}