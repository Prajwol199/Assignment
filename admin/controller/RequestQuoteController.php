<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __dir__.'/../static/phpmailer/src/Exception.php';
require_once __dir__.'/../static/phpmailer/src/PHPMailer.php';
require_once __dir__.'/../static/phpmailer/src/SMTP.php';

require_once __dir__.'/../model/database.php';
class RequestQuoteController extends Database{
	protected $table = 'users';

	public function fetch($data){
    	$rows=[];
		while($row=mysqli_fetch_assoc($data)){
			$rows[]=$row;
		}
		return $rows;
    }
	
	public function quoteMail(){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$date = $_POST['date'];
		if(isset($_POST['sex'])){
			$sex = $_POST['sex'];
		}
		if(!empty($_POST['add1'])){
			$peradd = $_POST['add1'];
		}else{
			$peradd = 'NULL';
		}
		if(!empty($_POST['add2'])){
			$temadd = $_POST['add2'];
		}else{
			$temadd = 'NULL';
		}
		if(!empty($_POST['country'])){
			$country = $_POST['country'];
		}else{
			$country = 'NULL';
		}
		if(!empty($_POST['state'])){
			$state = $_POST['state'];
		}else{
			$state = 'NULL';
		}
		if(!empty($_POST['city'])){
			$city = $_POST['city'];
		}else{
			$city = 'NULL';
		}
		if(!empty($_POST['postal'])){
			$postal = $_POST['postal'];
		}else{
			$postal = 'NULL';
		}
		if(!empty($_POST['contact'])){
			$contact = $_POST['contact'];
			$con = implode(",",$contact);
		}else{
			echo $con = 'NULL';
		}
		if(!empty($_POST['service'])){
			$service = $_POST['service'];
			$ser = implode(",",$service);
		}else{
			echo $ser = 'NULL';
		}
		if(!empty($_POST['note'])){
			$note = $_POST['note'];
		}else{
			$note = 'NULL';
		}

		$robotest = $_POST['robotest'];
		$data= array(
			'*'
		);
		$result = $this->select($this->table,$data);
		$fetch_email = $this->fetch($result);
		foreach ($fetch_email as $key => $value) {
			$email = $value['email'];
		}

		$admin_email = $email;

		if($robotest){
      	echo "You are a gutless robot.";
        }else{
        	$this->mailer($email,$fname,$date,$lname,$phone,$peradd,$temadd,$city,$postal,$con,$ser,$note);
        }
	}

	public function mailer($email,$fname,$date,$lname,$phone,$peradd,$temadd,$city,$postal,$con,$ser,$note){
		$mail = new PHPMailer;

		try {
		    //Server settings
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'cloudprazol@gmail.com';                 // SMTP username
		    $mail->Password = 'cloud_prajwol';                           // SMTP password
		    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 465;                                    // TCP port to connect to
		    $mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    	)
				);
	 		//Recipients
		    $mail->setFrom('cloudprazol@gmail.com', '');
		    $mail->addAddress($email);
		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Quote request from ' .$fname.' '.$lname;
		    $mail->Body    = 'From :' .$mail->Username. '<br>
									  To: '.$email.
									  '<br>Reply To: ' .$mail->Username.
									  '<br><br>
										Hi Admin,<br>
										You’ve received a quote request from website on:' .$date.
										'<br><b>Details below:</b><br>
										<b>Phone Number:</b>'.$phone.'<br>
										<b>Permanent Address:</b>'.$peradd.'<br>
										<b>Temporary Address:</b>'.$temadd.'<br>
										<b>city:</b>'.$city.'<br>
										<b>Postal Code:</b>'.$postal.'<br>
										<b>Contact me via:</b>'.$con.'<br>
										<b>Services Interested:</b>'.$ser.'<br>
										<b>Other Note:</b>'.$note.
										'<br><br>Thank you,<br>' .ucfirst($fname).' '.$lname;
		    if($mail->send()) {
		    	// echo 'Message has been sent';
		    	header("Location:../index.php");
			}
		} catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
		}
	}
}