<?php
session_start();
require_once __dir__.'/../model/database.php';
require_once __dir__.'/setting.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __dir__.'/../static/phpmailer/src/Exception.php';
require_once __dir__.'/../static/phpmailer/src/PHPMailer.php';
require_once __dir__.'/../static/phpmailer/src/SMTP.php';

class ContactUsController extends Database{

	protected $table_user = 'users';
	public function fetch($data){
    	$rows=[];
		while($row=mysqli_fetch_assoc($data)){
			$rows[]=$row;
		}
		return $rows;
    }
	public function contact_us(){
		global $server_root;
		$select_email = $this->select($this->table_user,array('email'));
		$email_admin = $this->fetch($select_email);
		foreach ($email_admin as $key => $value) {
			$admin_email = $value['email'];
		}
		if($_POST['robotest']){
      	echo "You are a gutless robot.";
        }else{
	        $name = $_POST['name'];
			$email = $_POST['email'];
			if(!empty($_POST['phone'])){
				$phone = $_POST['phone'];
			}else{
				$phone ='NULL';
			}

			if(!empty($_POST['message'])){
				$message = $_POST['message'];
			}else{
				$message='NULL';
			}

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
			    $mail->addAddress($admin_email);
			    //Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Contact from ' .ucfirst($name);
			    $mail->Body    = 'From :' .$mail->Username. '<br>
                    To: '.$email.'<br>
                    Reply To: '.$email.
                    '<br><br>
                    Hi Admin,<br>
                    You’ve received a message from website. <br>
                    <b>Name:</b>'.ucfirst($name).'<br>
                    <b>Phone Number:</b>'.$phone.'<br>
					<b>Message:</b>'.$message.'<br>
                    <br>Thank you,<br>'.ucfirst($name);
			    if($mail->send()) {
			    	// echo 'Message has been sent';
			    	$_SESSION['success']="success";
			    	$_SESSION['name']=$name;
			    	header('Location:'.$server_root.'user/success');
				}
			} catch (Exception $e) {
			    echo 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
			}
    	}
	}
}